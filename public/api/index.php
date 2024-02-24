<?php
include_once 'autoload.php';

use ArrestDB\ArrestDB;
use Geomerty\Rect;
use Image\Image;
use Image\Output;

$dsn = 'mysql://root@localhost:3306/quidditch/';
// $dsn = 'sqlite://C:\Users\mboudrea\Downloads\synthese_james_29-08_new_api\database\db.sqlite';
$clients = [];

/**
 * The MIT License
 * http://creativecommons.org/licenses/MIT/
 *
 * ArrestDB 1.9.0 (github.com/alixaxel/ArrestDB/)
 * Copyright (c) 2014 Alix Axel <alix.axel@gmail.com>
 **/
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

 function traiterFILES($array, $table, $name)
 {
	 Output::$default_folder = "/img/" . $table;
	 Output::$default_pattern = "%s{name}/%d{width}x%d{height}.%s";
	 $result = [];
	 foreach ($array as $value) {
		 $image = new Image($value['tmp_name']);
		 $image->name = $name;
		 $image->addOutput(512, 512, "image/webp");
		 $image->addOutput(512, 0, "image/webp");
		 $image->addOutput(0, 512, "image/webp");
		 $image->addOutput(256, 256, "image/webp");
		 $image->addOutput(256, 0, "image/webp");
		 $image->addOutput(0, 256, "image/webp");
		 $image->addOutput(128, 128, "image/webp");
		 $image->addOutput(64, 64, "image/webp");
		 $image->addOutput(32, 32, "image/webp");
		
		 $result[] = $image->out();
	 }
	 return $result;
 }




if (strcmp(PHP_SAPI, 'cli') === 0) {
	exit('ArrestDB should not be run from CLI.' . PHP_EOL);
}

if ((empty($clients) !== true) && (in_array($_SERVER['REMOTE_ADDR'], (array) $clients) !== true)) {
	exit(ArrestDB::Reply(ArrestDB::$HTTP[403]));
} else if (ArrestDB::Query($dsn) === false) {
	exit(ArrestDB::Reply(ArrestDB::$HTTP[503]));
}

if (array_key_exists('_method', $_GET) === true) {
	$_SERVER['REQUEST_METHOD'] = strtoupper(trim($_GET['_method']));
} else if (array_key_exists('HTTP_X_HTTP_METHOD_OVERRIDE', $_SERVER) === true) {
	$_SERVER['REQUEST_METHOD'] = strtoupper(trim($_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE']));
}

ArrestDB::Serve('GET', '/(#any)/(#any)/(#any)', function ($table, $id, $data) {
	$query = array(
		sprintf('SELECT * FROM "%s"', $table),
		sprintf('WHERE "%s" %s ?', $id, (ctype_digit($data) === true) ? '=' : 'LIKE'),
	);

	if (isset($_GET['by']) === true) {
		if ($_GET['by'] === 'rand') {
			$query[] = sprintf('ORDER BY RAND()');
		} else {
			if (isset($_GET['order']) !== true) {
				$_GET['order'] = 'ASC';
			}
			$query[] = sprintf('ORDER BY "%s" %s', $_GET['by'], $_GET['order']);
		}
	}

	if (isset($_GET['limit']) === true) {
		$query[] = sprintf('LIMIT %u', $_GET['limit']);

		if (isset($_GET['offset']) === true) {
			$query[] = sprintf('OFFSET %u', $_GET['offset']);
		}
	}

	$query = sprintf('%s;', implode(' ', $query));
	$result = ArrestDB::Query($query, $data);

	if ($result === false) {
		$result = ArrestDB::$HTTP[404];
	} else if (empty($result) === true) {
		$result = ArrestDB::$HTTP[204];
	}

	return ArrestDB::Reply($result);
});

ArrestDB::Serve('GET', '/(#any)/(#num)?', function ($table, $id = null) {
	$query = array(
		sprintf('SELECT * FROM "%s"', $table),
	);

	if (isset($id) === true) {
		$query[] = sprintf('WHERE "%s" = ? LIMIT 1', 'id');
	} else {
		if (isset($_GET['by']) === true) {
			if ($_GET['by'] === 'rand') {
				$query[] = sprintf('ORDER BY RAND()');
			} else {
				if (isset($_GET['order']) !== true) {
					$_GET['order'] = 'ASC';
				}
				$query[] = sprintf('ORDER BY "%s" %s', $_GET['by'], $_GET['order']);
			}
		}

		if (isset($_GET['limit']) === true) {
			$query[] = sprintf('LIMIT %u', $_GET['limit']);

			if (isset($_GET['offset']) === true) {
				$query[] = sprintf('OFFSET %u', $_GET['offset']);
			}
		}
	}

	$query = sprintf('%s;', implode(' ', $query));
	$result = (isset($id) === true) ? ArrestDB::Query($query, $id) : ArrestDB::Query($query);

	if ($result === false) {
		$result = ArrestDB::$HTTP[404];
	} else if (empty($result) === true) {
		$result = ArrestDB::$HTTP[204];
	} else if (isset($id) === true) {
		$result = array_shift($result);
	}

	return ArrestDB::Reply($result);
});

ArrestDB::Serve('DELETE', '/(#any)/(#num)', function ($table, $id) {
	$query = array(
		sprintf('DELETE FROM "%s" WHERE "%s" = ?', $table, 'id'),
	);

	$query = sprintf('%s;', implode(' ', $query));
	$result = ArrestDB::Query($query, $id);

	if ($result === false) {
		$result = ArrestDB::$HTTP[404];
	} else if (empty($result) === true) {
		$result = ArrestDB::$HTTP[204];
	} else {
		$result = ArrestDB::$HTTP[200];
	}

	return ArrestDB::Reply($result);
});

if (in_array($http = strtoupper($_SERVER['REQUEST_METHOD']), ['POST', 'PUT']) === true) {
	if (preg_match('~^\x78[\x01\x5E\x9C\xDA]~', $data = file_get_contents('php://input')) > 0) {
		$data = gzuncompress($data);
	}

	if ((array_key_exists('CONTENT_TYPE', $_SERVER) === true) && (empty($data) !== true)) {
		if (strncasecmp($_SERVER['CONTENT_TYPE'], 'application/json', 16) === 0) {
			$GLOBALS['_' . $http] = json_decode($data, true);
		} else if ((strncasecmp($_SERVER['CONTENT_TYPE'], 'application/x-www-form-urlencoded', 33) === 0) && (strncasecmp($_SERVER['REQUEST_METHOD'], 'PUT', 3) === 0)) {
			parse_str($data, $GLOBALS['_' . $http]);
		}
	}

	if ((isset($GLOBALS['_' . $http]) !== true) || (is_array($GLOBALS['_' . $http]) !== true)) {
		$GLOBALS['_' . $http] = [];
	}

	unset($data);
}

ArrestDB::Serve('POST', '/(#any)/(#num)', function ($table, $id) {
	if (empty($GLOBALS['_POST']) === true) {
		$result = ArrestDB::$HTTP[204];
	} else if (is_array($GLOBALS['_POST']) === true) {
		$data = [];
		
		foreach ($GLOBALS['_POST'] as $key => $value) {
			$data[$key] = sprintf('"%s" = ?', $key);
		}
		
		$query = array(
			sprintf('UPDATE "%s" SET %s WHERE "%s" = ?', $table, implode(', ', $data), 'id'),
		);
		$query = sprintf('%s;', implode(' ', $query));
		$result = ArrestDB::Query($query, $GLOBALS['_POST'], $id);
		if (count($_FILES)) {
			$result = traiterFILES($_FILES, $table, $id);
		}

		if ($result === false) {
			$result = ArrestDB::$HTTP[409];
		} else {
			$result = ArrestDB::$HTTP[200];
		}
	}

	return ArrestDB::Reply($result);
});

ArrestDB::Serve('POST', '/(#any)', function ($table) {
	if (empty($_POST) === true) {
		$result = ArrestDB::$HTTP[204];
	} else if (is_array($_POST) === true) {
		$queries = [];

		if (count($_POST) == count($_POST, COUNT_RECURSIVE)) {
			$_POST = [$_POST];
		}

		foreach ($_POST as $row) {
			$data = [];

			foreach ($row as $key => $value) {
				$data[sprintf('"%s"', $key)] = $value;
			}

			$query = array(
				sprintf('INSERT INTO "%s" (%s) VALUES (%s)', $table, implode(', ', array_keys($data)), implode(', ', array_fill(0, count($data), '?'))),
			);

			$queries[] = array(
				sprintf('%s;', implode(' ', $query)),
				$data,
			);
		}

		if (count($queries) > 1) {
			ArrestDB::Query()->beginTransaction();

			while (is_null($query = array_shift($queries)) !== true) {
				if (($result = ArrestDB::Query($query[0], $query[1])) === false) {
					ArrestDB::Query()->rollBack();
					break;
				}
			}

			if (($result !== false) && (ArrestDB::Query()->inTransaction() === true)) {
				$result = ArrestDB::Query()->commit();
			}
		} else if (is_null($query = array_shift($queries)) !== true) {
			$result = ArrestDB::Query($query[0], $query[1]);
		}

		if (count($_FILES)) {
			$result = traiterFILES($_FILES, $table, $result);
		}

		if ($result === false) {
			$result = ArrestDB::$HTTP[409];
		} else {
			$result = ArrestDB::$HTTP[201];
		}
	}

	return ArrestDB::Reply($result);
});

exit(ArrestDB::Reply(ArrestDB::$HTTP[400]));
