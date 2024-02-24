<?php
namespace Image;
use Geomerty\Point;
use Geomerty\Rect;

class Output {
	use \HasAccessors;
	const ASPECT_RATIO_NONE = 0;	// Do not keep aspect ratio
	const ASPECT_RATIO_COVER = 1;	// Keep aspect ratio and cover the whole area (some parts may be cropped)
	const ASPECT_RATIO_CONTAIN = 2;	// Keep aspect ratio and fit the whole image (some parts may be transparent)
	const ASPECT_RATIO_CONTAIN_CROP = 3;	// Keep aspect ratio and fit the whole image (image may not have given final size)
	public Image $input;
	static public $default_pattern = '%s{name}_%d{width}x%d{height}.%s';
	static public $default_folder = '';
	public $path_pattern;
	public Format $format;	// Output format
	public Rect $size;	// Wanted size
	public $aspect_ratio = self::ASPECT_RATIO_COVER;
	public $overflow = ['x' => .5, 'y' => .5];	// [0, 0] = top left, [1, 1] = bottom right
	public $scale_up = false;
	public $force_size = false;
	public $folder = false;

	private Rect $_final_size;
	private Rect $_scaled_size;

	function __construct(  $format, Rect $size, $options = []) {
		$this->format = is_string($format) ? new Format($format) : $format;
		$this->size = $size;
		$this->path_pattern = $options['path_pattern'] ?? self::$default_pattern;
		$this->aspect_ratio = $options['aspect_ratio'] ?? $this->aspect_ratio;
		$this->overflow = (object) ($options['overflow'] ?? $this->overflow);
		$this->scale_up = $options['scale_up'] ?? $this->scale_up;
		$this->force_size = $options['force_size'] ?? $this->force_size;
		$this->folder = $options['folder'] ?? self::$default_folder;
	}

	function get_width() {
		return $this->size->x;
	}
	function get_height() {
		return $this->size->y;
	}
	function get_final_width() {
		return $this->final_size->width;
	}
	function get_final_height() {
		return $this->final_size->height;
	}
	function get_x_ratio() {
		return $this->input->width / $this->width;
	}
	function get_y_ratio() {
		return $this->input->height / $this->height;
	}
	function get_ratios() {
		$result = $this->input->size->ratios($this->wanted_size);
		if ($this->scale_up) return $result;
		return $result->max(1);
	}
	function get_cover_ratio() {
		$ratios = $this->ratios;
		$result = min($ratios->x, $ratios->y);
		return $result;
	}
	function get_contain_ratio() {
		$ratios = $this->ratios;
		$result = max($ratios->width, $ratios->height);
		return $result;
	}
	function get_wanted_size() {
		if ($this->size->width && $this->size->height) {
			return new Rect($this->size->width, $this->size->height);
		}
		$ratio = $this->input->size->ratio;
		if ($this->size->width) {
			if ($this->scale_up) {
				return $this->input->size->div($ratio);
			}
			if ($this->size->width >= $this->input->width) {
				return new Rect($this->input->width, $this->input->height);
			}
			return new Rect($this->size->width, $this->size->width / $ratio);
		}
		if ($this->size->height) {
			if ($this->scale_up) {
				return $this->input->size->mul($ratio);
			}
			if ($this->size->height >= $this->input->height) {
				return new Rect($this->input->width, $this->input->height);
			}
			return new Rect($this->size->width, $this->size->width / $ratio);
		}
		return new Rect($this->input->width, $this->input->height);
	}
	function get_scaled_size() {
		$result = new Rect();
		switch ($this->aspect_ratio) {
			case self::ASPECT_RATIO_COVER:
				return $this->input->size->div($this->cover_ratio);
			case self::ASPECT_RATIO_CONTAIN:
			case self::ASPECT_RATIO_CONTAIN_CROP:
				return $this->input->size->div($this->contain_ratio);
			default:
				return $this->input->size->div($this->ratios);
		}
		return $result;
	}
	function get_final_size() {
		$scaled_size = $this->scaled_size;
		$result = $this->get_wanted_size();
		if (!$this->force_size) {
			$result = $result->min($scaled_size);
		}
		$overflow = new Point($this->overflow->x, $this->overflow->y);
		$offset = $result->sub($scaled_size)->mul($overflow);
		$result->moveTo($offset->width, $offset->height);
		return $result;
	}
	function path2url($path, $absolute = false) {
		$root = $_SERVER['DOCUMENT_ROOT'];
		$root = str_replace('\\', '/', $root);
		$path = str_replace('\\', '/', $path);
		$path = str_replace($root, '', $path);
		$path = str_replace('//', '/', $path);
		if ($absolute) {
			$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
			$path = $protocol . '://' . $_SERVER['HTTP_HOST'] . $path;
		}
		return $path;
	}
	function out() {
		$size = $this->final_size;
		$scaled_size = $this->scaled_size;
		$out = imagecreatetruecolor($size->width, $size->height);
		imagecopyresampled($out, $this->input->gd_object, $size->x, $size->y, 0, 0, $scaled_size->width, $scaled_size->height, $this->input->width, $this->input->height);
		preg_match_all('#(\\{[a-z\\.]+\})#', $this->path_pattern, $matches);
		$vars = array_map(function ($match) {
			return substr($match, 1, -1);
		}, $matches[0]);
		if (!$this->folder) {
			$folder = dirname(realpath($this->input->path));
		} else if ($this->folder[0] === '/') {
			$folder = $_SERVER['DOCUMENT_ROOT'] . $this->folder;
		} else {
			$folder = $this->folder;
		}
		$timestamp = time();
		$name = $this->input->name;
		$width = $this->size->width;
		$height = $this->size->height;
		$path_pattern = preg_replace('#(\\{[a-z\\.]+\})#', "", $this->path_pattern);
		$path_pattern = "%s" . DIRECTORY_SEPARATOR . $path_pattern;
		$data = [$path_pattern, $folder, ...array_values(compact(...$vars)), $this->format->getExt()];
		$path = sprintf(...array_values($data));
		$status = (file_exists($path)) ? 'updated' : 'created';
		$this->format->out($out, $path); // Output the image
		return [
			'name' => $name,
			'width' => $width,
			'height' => $height,
			'status' => $status,
			'mime-type' => $this->format->mime_type,
			'url' => $this->path2url($path, true),
		];
	}
}
