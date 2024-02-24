<?php
namespace Geomerty;
class Rect extends Point {
	public Point $origin;
	function __construct($width = 0, $height = 0, $x = 0, $y = 0) {
		$this->origin = new Point($x, $y);
		parent::__construct($width, $height);
	}
	function get_x() {
		return $this->origin->x;
	}
	function set_x($x) {
		$this->origin->x = $x;
	}
	function get_y() {
		return $this->origin->y;
	}
	function set_y($y) {
		$this->origin->y = $y;
	}
	// function get_width() {
	// 	return $this->_x;
	// }
	// function set_width($value) {
	// 	$this->_x = $value;
	// 	return $this;
	// }
	// function get_height() {
	// 	return $this->_y;
	// }
	// function set_height($value) {
	// 	$this->_y = $value;
	// 	return $this;
	// }
	function get_ratio() {
		return $this->width / $this->height;
	}
	function ratios(Rect $other) {
		if ($other->width && $other->height) {
			return new Point($this->width / $other->width, $this->height / $other->height);
		}
		if ($other->width) {
			return new Point($this->width / $other->width, $this->height / $other->width);
		}
		if ($other->height) {
			return new Point($this->width / $other->height, $this->height / $other->height);
		}
		return new Point(1, 1);
	}
	function min($other) {
		if (is_scalar($other)) {
			return new static(min($this->width, $other), min($this->height, $other));
		} else if ($other instanceof Point) {
			return new static(min($this->width, $other->width), min($this->height, $other->height));
		}
	}
	function max($other) {
		if (is_scalar($other)) {
			return new static(max($this->width, $other), max($this->height, $other));
		} else if ($other instanceof Point) {
			return new static(max($this->width, $other->width), max($this->height, $other->height));
		}
	}
	function add($other) {
		if (is_scalar($other)) {
			return new static($this->width + $other, $this->height + $other);
		} else if ($other instanceof Point) {
			return new static($this->width + $other->width, $this->height + $other->height);
		}
	}
	function sub($other) {
		if (is_scalar($other)) {
			return new static($this->width - $other, $this->height - $other);
		} else if ($other instanceof Point) {
			return new static($this->width - $other->width, $this->height - $other->height);
		}
	}
}
