<?php

Library::import('recess.framework.forms.FormInput');
Library::import('recess.framework.helpers.Html');

class ModelSelectInput extends FormInput {
	protected $options;
	protected $optionsId;

	function __construct($name,$options=null,$optionsId=null) {
		$this->options = $options;
		$this->optionsId = $optionsId;
		return parent::__construct($name);
	}

	function render() {
		echo '<select name="', $this->name, '" id="', $this->id;

		if($this->class)
			echo '" class="', $this->class;

		echo '">', "\n", '<option value="">None</option>', "\n";

		foreach($this->options as $opt) {
			$value = $opt->{$this->optionsId};

			echo '<option value="', $value;

			if($value == $this->value)
				echo '" selected="selected';

			echo '">', Html::specialchars((string) $opt), '</option>', "\n";
		}

		echo '</select>';
	}

	function setOptions($options,$optionsId) {
		$this->options = $options;
		$this->optionsId = $optionsId;
		return $this;
	}
}

?>
