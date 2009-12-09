<?php

Library::import('recess.framework.forms.FormInput');
Library::import('recess.framework.helpers.Html');

class TextAreaInput extends FormInput {
	function render() {
		echo '<textarea name="', $this->name, '"', ' id="' . $this->name . '"';
		if($this->class != '') {
			echo ' class="', $this->class, '"';
		}
		echo '>';

		if($this->value != '') {
			echo Html::specialchars($this->value);
		}

		echo '</textarea>';
	}
}

?>
