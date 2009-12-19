<?php

Library::import('recess.framework.forms.Form');

class ModelForm extends Form {
	protected $model = null;

	function input($name, $class = '') {
		$this->inputs[$name]->setValue($this->model->$name);
		parent::input($name, $class);
	}

	function changeInput($name, $type) {
		$oldInput = $this->inputs[$name];
		$type .= 'Input';
		$newInput = new $type($this->name . '[' . $name . ']');
		$newInput->setId($oldInput->getId());
		$newInput->setValue($oldInput->getValue());
		$this->inputs[$name] = $newInput;
	}

	function __construct($name, $values, Model $model = null) {
		$this->name = $name;
		$this->model = $model;

		if($model != null) {
			if (!is_array($values))
				$values = array();

			$properties = Model::getProperties($model);
			$this->inputs = array();

			foreach($properties as $property) {
				$propertyName = $property->name;
				$inputName = $this->name . '[' . $propertyName . ']';

				unset($input);
				$this->inputs[$propertyName] = null;
				$input = &$this->inputs[$propertyName];

				if($property->isPrimaryKey) {
					$input = new HiddenInput($propertyName);
				} else {
					switch($property->type) {
						case RecessType::STRING:
						case RecessType::FLOAT:
						case RecessType::INTEGER:
							$input = new TextInput($inputName);
							break;
						case RecessType::BOOLEAN:
							$input = new BooleanInput($inputName);
							break;
						case RecessType::TEXT:
							$input = new TextAreaInput($inputName);
							break;
						case RecessType::BLOB:
							$input = new LabelInput($inputName);
							break;
						case RecessType::DATE:
							$input = new DateTimeInput($inputName);
							$input->showTime = false;
							break;
						case RecessType::DATETIME:
							$input = new DateTimeInput($inputName);
							$input->showTime = false;
							break;
						case RecessType::TIME:
							$input = new DateTimeInput($inputName);
							$input->showDate = false;
							break;
						case RecessType::TIMESTAMP:
							$input = new DateLabelInput($inputName);
							break;
						default:
							echo $property->type;
							continue;
					}
				}

				$input->setId($inputName);

				if(array_key_exists($propertyName, $values)) {
					$input->setValue($values[$propertyName]);
					$model->$propertyName = $input->getValue();
				}
			}
		}
	}

	function to($method, $action) {
		if($method == Methods::POST && isset($this->model)) {
			// New model: set the undefined inputs to
			// their default values
			$properties = Model::getProperties($this->model);
			foreach($properties as $property) {
				$propertyName = $property->name;
				if(!isset($this->inputs[$propertyName]))
					continue;

				unset($input);
				$input = &$this->inputs[$propertyName];
				if (isset($input->value) || !isset($property->defaultValue))
					continue;

				$input->setValue($property->defaultValue);
				$this->model->$propertyName = $input->getValue();
			}
		}

		parent::to($method, $action);
	}
}

?>
