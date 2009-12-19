<?php

abstract class FormInput {
	protected $name;
	protected $id;
	public $class;
	public $value;

	function __construct($name) {
		$this->name = $name;
	}

	function getValue() {
		return $this->value;
	}

	function setValue($value) {
		$this->value = $value;
	}

	function getName() {
		return $this->name;
	}

	function getId() {
		return $this->id;
	}

	function setId($id) {
		// The dash (-) is an allowed character and it is seldomly used,
		// making it a good candidate invalid id chars, mainly the []
		// square brackets used in FormInput::$name
		$tokens = str_word_count($id, 1);
		$this->id = implode('-', $tokens);
		return $this->id;
	}

	abstract function render();
}

?>
