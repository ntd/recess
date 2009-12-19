<?php

Library::import('recess.framework.forms.FormInput');
Library::import('recess.framework.helpers.Html');

class TextInput extends FormInput {
	function render() {
		$attrs = array(
			'type' => 'text',
			'name' => $this->name,
			'id' => $this->id,
			'class' => $this->class,
			'value' => $this->value
		);
		echo '<input', Html::attributes($attrs), ' />';
	}
}

?>
