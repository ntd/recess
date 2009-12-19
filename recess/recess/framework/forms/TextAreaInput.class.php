<?php

Library::import('recess.framework.forms.FormInput');
Library::import('recess.framework.helpers.Html');

class TextAreaInput extends FormInput {
	function render() {
		$attrs = array(
			'name' => $this->name,
			'id' => $this->id,
			'class' => $this->class
		);
		echo '<textarea', Html::attributes($attrs), '>';
		echo Html::specialchars($this->value);
		echo '</textarea>';
	}
}

?>
