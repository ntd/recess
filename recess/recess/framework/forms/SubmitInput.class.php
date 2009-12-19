<?php

Library::import('recess.framework.forms.FormInput');
Library::import('recess.framework.helpers.Html');

class SubmitInput extends FormInput {
	function render() {
		$attrs = array(
			'type' => 'submit',
			'name' => $this->name,
			'id' => $this->id,
			'class' => $this->class,
			'value' => $this->value
		);
		echo '<input', Html::attributes($attrs), ' />';
	}
}

?>
