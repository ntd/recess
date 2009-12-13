<?php
abstract class FormInput {
	protected $name;
	protected $id;
	public $class;
	public $value;

	function __construct($name) {
		$this->name = $name;
		// The dash (-) is an allowed character and it is seldomly used,
		// making it a good candidate
		$tokens = str_word_count($name, 1);
		$this->id = implode('-', $tokens);
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

	abstract function render();
}
?>
