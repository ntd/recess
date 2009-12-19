<?php

Library::import('recess.framework.forms.FormInput');

class DateTimeInput extends FormInput {

	public $showDate = true;
	public $showTime = true;

	protected static $months = array('Jan',
									 'Feb',
									 'Mar',
									 'Apr',
									 'May',
									 'June',
									 'July',
									 'Aug',
									 'Sept',
									 'Oct',
									 'Nov',
									 'Dec');

	protected static $meridiems = array(
									 self::AM,
									 self::PM
										);
	const MONTH = 'month';
	const DAY = 'day';
	const YEAR = 'year';
	const HOUR = 'hour';
	const MINUTE = 'minute';
	const MERIDIEM = 'meridiem';
	const AM = 'am';
	const PM = 'pm';
	const PM_HOURS = 12;

	function getValue() {
		return $this->value;
	}

	function getValueOrZero($array, $key) {
		if(isset($array[$key]) && $array[$key] != '')
			return $array[$key];
		else
			return 0;
	}

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
		// The first rendered element will get the "id" attribute
		// of the whole group, making it the focusing candidate
		$this->firstElement = true;

		if($this->showDate) {
			$this->printMonthInput();
			$this->printDayInput();
			$this->printYearInput();
		}

		if($this->showTime) {
			$this->printHourInput();
			$this->printMinuteInput();
			$this->printmeridiemInput();
		}
	}

	function printMonthInput() {
		$this->printSelect($this->name . '[' . self::MONTH . ']', self::$months, date('n', $this->value));
	}

	function printDayInput() {
		$this->printSelect($this->name . '[' . self::DAY . ']', range(1,31), date('j', $this->value));
	}

	function printYearInput() {
		$this->printText($this->name . '[' . self::YEAR . ']', date('Y', $this->value));
	}

	function printHourInput() {
		$this->printSelect($this->name . '[' . self::HOUR . ']', range(1,12), date('g', $this->value));
	}

	function printMinuteInput() {
		$this->printSelect($this->name . '[' . self::MINUTE . ']', range(0,60,15), (int)date('i', $this->value));
	}

	function printMeridiemInput() {
		$this->printSelect($this->name . '[' . self::MERIDIEM . ']', self::$meridiems, date('a', $this->value));
	}

	function printSelect($name, $values, $selected) {
		$attrs['name'] = $name;

		if ($this->firstElement) {
			$attrs['id'] = $this->id;
			$this->firstElement = false;
		}

		echo '<select', Html::attributes($attrs), '>', "\n";

		foreach ($values as $key => $value) {
			$attrs = array(
				'value' => $key+1,
				'selected' => $key+1 == $selected ? 'selected' : null
			);
			echo '<option', Html::attributes($attrs), '>', $value, '</option>', "\n";
		}

		echo '</select>';
	}

	function printText($name, $value = '') {
		$attrs['type'] = 'text';
		$attrs['name'] = $name;

		if ($this->firstElement) {
			$attrs['id'] = $this->id;
			$this->firstElement = false;
		}

		$attrs['class'] = array('text', 'short');
		$attrs['value'] = $value;
		echo '<input', Html::attributes($attrs), ' />';
	}
}

?>
