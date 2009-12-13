<?php
Library::import('recess.framework.forms.FormInput');
class BooleanInput extends FormInput {

	function setValue($value) {
		if (is_numeric($value)) {
			$this->value = $value == 1;
		} else {
			$this->value = $value;
		}
	}

	protected function renderChoice($value, $label, $attributes) {
		echo '<input type="radio" name="', $this->name, '"', $attributes;
		echo ' value="', $value, '" />', $label, '</input>', "\n";
	}

	function render() {
		$attributes = ' id="' . $this->id . '"';
		$attributes .= $this->value ? ' checked="checked"' : '';
		$this->renderChoice(1, 'Yes', $attributes);

		$attributes = $this->value ? '' : ' checked="checked"';
		$this->renderChoice(0, 'No', $attributes);
	}
}
?>
