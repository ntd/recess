<?php
Library::import('recess.framework.forms.FormInput');
class DateLabelInput extends FormInput {

	function setValue($value) {
		if(is_array($value)) {
			$month = $this->getValueOrZero($value, self::MONTH);
			$day = $this->getValueOrZero($value, self::DAY);
			$year = $this->getValueOrZero($value, self::YEAR);
			$hour = $this->getValueOrZero($value, self::HOUR);
			$minute = $this->getValueOrZero($value, self::MINUTE);
			$meridiem = $this->getValueOrZero($value, self::MERIDIEM);

			if($meridiem == self::PM) {
				$hour += self::PM_HOURS;
			}

			$this->value = mktime($hour,$minute,1,$month,$day,$year);
		} elseif(is_numeric($value)) {
			$this->value = $value;
		} else {
			$this->value = strtotime((string) $value);
		}
	}

	function render() {
		echo date(DATE_RFC822, $this->value);
	}
}
?>
