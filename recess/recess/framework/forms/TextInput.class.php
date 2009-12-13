<?php

Library::import('recess.framework.forms.FormInput');
Library::import('recess.framework.helpers.Html');

class TextInput extends FormInput {
	function render() {
		echo '<input type="text" name="', $this->name, '"', ' id="', $this->id;

		if($this->class != '')
			echo '" class="', $this->class;

		if($this->value != '')
			echo '" value="', Html::specialchars($this->value);

		echo '" />';
	}
}

?>
