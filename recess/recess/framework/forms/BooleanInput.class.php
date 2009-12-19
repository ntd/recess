<?php

Library::import('recess.framework.forms.FormInput');

class BooleanInput extends FormInput {

	function setValue($value) {
        $this->value = is_numeric($value) ? $value == 1 : $value;
	}

	function render() {
		$attrs = array(
			'type' => 'radio',
			'name' => $this->name,
			'id' => $this->id,
			'value' => 1,
			'checked' => (boolean) $this->value
		);
		echo '<input', Html::attributes($attrs), '>Yes</input>', "\n";

		$attrs['id'] = null;
		$attrs['value'] = 0;
		$attrs['checked'] = !$attrs['checked'];
		echo '<input', Html::attributes($attrs), '>No</input>';
	}
}

?>
