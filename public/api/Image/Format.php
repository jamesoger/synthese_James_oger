<?php
namespace Image;
class Format {
	public $format;
	public $extension;
	public $mime_type;
	public $gd_in_function;
	public $gd_out_function;
	static $formats = [
		'image/jpeg' => [
			'extension' => ['jpg', 'jpeg'],
			'mime_type' => 'image/jpeg',
			'gd_in_function' => 'imagecreatefromjpeg',
			'gd_out_function' => 'imagejpeg',
		],
		'image/png' => [
			'extension' => 'png',
			'mime_type' => 'image/png',
			'gd_in_function' => 'imagecreatefrompng',
			'gd_out_function' => 'imagepng',
		],
		'image/gif' => [
			'extension' => 'gif',
			'mime_type' => 'image/gif',
			'gd_in_function' => 'imagecreatefromgif',
			'gd_out_function' => 'imagegif',
		],
		'image/bmp' => [
			'extension' => 'bmp',
			'mime_type' => 'image/bmp',
			'gd_in_function' => 'imagecreatefrombmp',
			'gd_out_function' => 'imagebmp',
		],
		'image/webp' => [
			'extension' => 'webp',
			'mime_type' => 'image/webp',
			'gd_in_function' => 'imagecreatefromwebp',
			'gd_out_function' => 'imagewebp',
		],
	];
	function __construct($mime_type) {
		$this->format = self::$formats[$mime_type];
		$this->extension = $this->format['extension'];
		$this->mime_type = $this->format['mime_type'];
		$this->gd_in_function = $this->format['gd_in_function'];
		$this->gd_out_function = $this->format['gd_out_function'];

	}
	function getExt() {
		return (is_string($this->extension)) ? $this->extension : $this->extension[0];
	}
	static function setFormat($extension, $mime_type, $gd_in_function, $gd_out_function) {
		self::$formats[$mime_type] = [
			'extension' => $extension,
			'mime_type' => $mime_type,
			'gd_in_function' => $gd_in_function,
			'gd_out_function' => $gd_out_function,
		];
	}
	static public function get_image_mime_type( $file) {
		if (is_object($file)) {
			return $file->mime_type;
		}
		if (file_exists($file) && is_file($file)) {
			$finfo = finfo_open(FILEINFO_MIME_TYPE);
			$mime_type = finfo_file($finfo, $file);
			return $mime_type;
		}
		$extension = array_slice(explode('.', $file), -1)[0];
		foreach (self::$formats as $mime_type => $format) {
			if ($extension === $format['extension'] || in_array($extension, $format['extension'])) {
				return $mime_type;
			}
		}
		return false;
	}
	static function fromFile($file) {
		$mime_type = self::get_image_mime_type($file);
		if (!$mime_type) {
			throw new \Exception('Unknown image format');
		}
		return new self($mime_type);
	}
	function mkdir($path) {
		if (file_exists($path)) return;
		$this->mkdir(dirname($path));
		mkdir($path);
		return $path;
	}
	function out($image, $path) {
		$folder = $this->mkdir(dirname($path));
		while ($folder && !file_exists($folder)) {
			while ($folder && !file_exists($folder)) {
				mkdir($folder);
				$folder = dirname($folder);
			}
			$folder = dirname($path);
		}
		call_user_func($this->gd_out_function, $image, $path); // Output the image
	}
}
