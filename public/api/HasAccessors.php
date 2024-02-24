<?php
trait HasAccessors {
	function __get($name) {
		$getName = 'get' . ucfirst($name);
		$get_name = 'get_' . $name;
		if (method_exists($this, $getName)) {
			return $this->$getName();
		} else if (method_exists($this, $get_name)) {
			return $this->$get_name();
		}
	}
	function __set($name, $value) {
		$setName = 'set' . ucfirst($name);
		$set_name = 'set_' . $name;
		if (method_exists($this, $setName)) {
			$this->$setName($value);
		} else if (method_exists($this, $set_name)) {
			$this->$set_name($value);
		}
	}
	function __isset($name) {
		$issetName = 'isset' . ucfirst($name);
		$isset_name = 'isset_' . $name;
		$_name = '_' . $name;
		if (method_exists($this, $issetName)) {
            return $this->$issetName();
		} else if (method_exists($this, $isset_name)) {
            return $this->$isset_name();
		} else {
            return isset($this->$_name);
        }
	}
	function __unset($name) {
        $unsetName = 'unset' . ucfirst($name);
		$unset_name = 'unset_' . $name;
        $_name = '_' . $name;
		if (method_exists($this, $unsetName)) {
			$this->$unsetName();
		} else if (method_exists($this, $unset_name)) {
			$this->$unset_name();
		} else {
            unset($this->$_name);
        }
	}
	
}
