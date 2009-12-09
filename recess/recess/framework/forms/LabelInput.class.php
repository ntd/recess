<?php

Library::import('recess.framework.forms.FormInput');
Library::import('recess.framework.helpers.Html');

class LabelInput extends FormInput {
	function render() {
		echo Html::specialchars($this->value);
	}
}

?>
