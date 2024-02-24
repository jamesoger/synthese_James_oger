<?php
namespace Geomerty;
class Point {
	use \HasAccessors;
	private $_x;
	private $_y;
	function __construct($x = 0, $y = 0) {
		$this->_x = $x;
		$this->_y = $y;
	}
	
	function get_x() {
		return $this->_x;
	}
	function set_x($value) {
		$this->_x = $value;
		return $this;
	}
	function get_y() {
		return $this->_y;
	}
	function set_y($value) {
		$this->_y = $value;
		return $this;
	}
	function get_width() {
		return $this->_x;
	}
	function set_width($value) {
		$this->_x = $value;
		return $this;
	}
	function get_height() {
		return $this->_y;
	}
	function set_height($value) {
		$this->_y = $value;
		return $this;
	}
	function div($divisor) {
		if (is_scalar($divisor)) {
			return new static($this->_x / $divisor, $this->_y / $divisor);
		} else if ($divisor instanceof Point) {
			return new static($this->_x / $divisor->x, $this->_y / $divisor->y);
		}
	}
	function mul($multiplier) {
		if (is_scalar($multiplier)) {
			return new static($this->_x * $multiplier, $this->_y * $multiplier);
		} else if ($multiplier instanceof Point) {
			return new static($this->_x * $multiplier->x, $this->_y * $multiplier->y);
		}
	}
	function min($other) {
		if (is_scalar($other)) {
			return new static(min($this->x, $other), min($this->y, $other));
		} else if ($other instanceof Point) {
			return new static(min($this->x, $other->x), min($this->y, $other->y));
		}
	}
	function max($other) {
		if (is_scalar($other)) {
			return new static(max($this->x, $other), max($this->y, $other));
		} else if ($other instanceof Point) {
			return new static(max($this->x, $other->x), max($this->y, $other->y));
		}
	}
	function moveTo($x, $y) {
		$this->x = $x;
		$this->y = $y;
		return $this;
	}
}
