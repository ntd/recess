<?php

Library::import('recess.framework.forms.FormInput');
Library::import('recess.framework.helpers.Html');

class HiddenInput extends FormInput {	
	function render() {
		echo '<input type="hidden" name="', $this->name, '"';
		if($this->value != '') {
			echo ' value="', Html::specialchars($this->value), '"';
		}
		echo ' />';
	}
}

?>
