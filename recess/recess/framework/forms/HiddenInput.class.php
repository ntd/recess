<?php

Library::import('recess.framework.forms.FormInput');
Library::import('recess.framework.helpers.Html');

class HiddenInput extends FormInput {
	function render() {
		$attrs = array(
			'type' => 'hidden',
			'name' => $this->name,
			'value' => $this->value
		);
		echo '<input', Html::attributes($attrs), ' />';
	}
}

?>
