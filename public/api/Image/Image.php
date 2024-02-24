<?php

namespace Image;

use Geomerty\Rect;

class Image
{
	use \HasAccessors;
	static $format_out = 'image/jpeg';

	public $path;
	public $format;
	public $outputs = [];
	public $gd_object;
	public Rect $size;
	private $_name = '';
	function __construct($path)
	{
		$this->path = $path;
		$this->format = Format::fromFile($path);
		$this->gd_object = call_user_func($this->format->gd_in_function, $this->path);
		$this->size = new Rect(imagesx($this->gd_object), imagesy($this->gd_object));
	}
	function get_width()
	{
		return $this->size->width;
	}
	function get_height()
	{
		return $this->size->height;
	}
	function get_name()
	{
		if ($this->_name) return $this->_name;
		return pathinfo($this->path, PATHINFO_FILENAME);
	}
	function set_name($value)
	{
		$this->_name = $value;
		return $this;
	}
	function addOutput($width, $height, $format, $options = [])
	{
		$output = new Output($format, new Rect($width, $height), $options);
		$output->input = $this;
		$this->outputs[] = $output;
		return $this;
	}
	function out()
	{
		$result = array_map(function ($output) {
			return $output->out();
		}, $this->outputs);
		return $result;
	}
	static function traiterFILES($array, $folder, $name)
	{
		// ATTENTION! Cette fonction a été temporairement déplacée dans public\api\index.php NE PAS s'en servir
		Output::$default_pattern = "%s{name}/%d{width}x%d{height}.%s";
		Output::$default_folder = $folder;
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
}
