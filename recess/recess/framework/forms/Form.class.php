<?php
Library::import('recess.framework.forms.FormInput');
Library::import('recess.framework.forms.TextAreaInput');
Library::import('recess.framework.forms.DateTimeInput');
Library::import('recess.framework.forms.TextInput');
Library::import('recess.framework.forms.LabelInput');
Library::import('recess.framework.forms.DateLabelInput');
Library::import('recess.framework.forms.BooleanInput');
Library::import('recess.framework.forms.HiddenInput');
Library::import('recess.framework.forms.SubmitInput');

class Form {
	protected $name;
	public $method;
	public $action;
	public $flash;

	function __construct($name) {
		$this->name = $name;
	}

	public $hasErrors = false;
	public $inputs = array();

	function __get($name) {
		if(isset($this->inputs[$name])) {
			return $this->inputs[$name];
		} else {
			return '';
		}
	}

//	function __set($name, $value) {
//		if(isset($this->inputs[$name])) {
//			$this->inputs[$name]->value = $value;
//		}
//	}

	function to($method, $action) {
		$this->method = $method;
		$this->action = $action;
	}

	function begin() {
		echo '<form method="post" action="' . $this->action . '">', "\n";;

		if($this->method == Methods::DELETE || $this->method == Methods::PUT)
			echo '<div class="hidden"><input type="hidden" name="_METHOD" value="' . $this->method . '" /></div>';
	}

	function input($name, $class = '') {
		if($class != '') {
			$this->inputs[$name]->class = $class;
		}
		$this->inputs[$name]->render();
	}

	function changeInput($name, $type) {
		$oldInput = $this->inputs[$name];
		$type .= 'Input';
		$newInput = new $type($name);
		$newInput->setId($oldInput->getId());
		$newInput->setValue($oldInput->getValue());
		$this->inputs[$name] = $newInput;
	}

	function fill(array $keyValues) {
		foreach($this->inputs as $key => $value) {
			if(isset($keyValues[$key])) {
				$this->inputs[$key]->setValue($keyValues[$key]);
			}
		}
	}

	public function getSubmitInputs() {
		if (empty($this->method)) {
			$inputs = array();
		} elseif (is_array($this->method)) {
			foreach($this->method as $method => $label) {
				$input = new SubmitInput('_METHOD[' . $method . ']');
				$input->setValue($label);
				$inputs[] = $input; 
			}
		} else {
			$input = new SubmitInput('post');
			$input->setValue('Submit');
			$inputs[] = $input; 
		}

		return $inputs;
	}

	function assertNotEmpty($inputName) {
		if(isset($this->inputs[$inputName]) && $this->inputs[$inputName]->getValue() != '') {
			return true;
		} else {
			$this->inputs[$inputName]->class = 'highlight';
			$this->inputs[$inputName]->flash = 'Required.';
			$this->hasErrors = true;
			return false;
		}
	}

	function hasErrors() {
		return $this->hasErrors;
	}

	function end() {
		echo '</form>';
	}
}
?>
