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
		$attrs = array(
			'name' => $this->name,
			'id' => $this->id,
			'class' => $this->class
		);
		echo '<select', Html::attributes($attrs), '>', "\n";
		echo '<option value="">None</option>', "\n";

		foreach($this->options as $opt) {
			$value = $opt->{$this->optionsId};

			$attrs = array(
				'value' => $value,
				'selected' => $value == $this->value ? 'selected' : null
			);
			echo '<option', Html::attributes($attrs), '>';
			echo Html::specialchars((string) $opt), '</option>', "\n";
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
