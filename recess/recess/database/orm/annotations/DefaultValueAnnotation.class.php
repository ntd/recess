<?php
Library::import('recess.lang.Annotation');
Library::import('recess.database.pdo.RecessType');

/**
 * An annotation used on Model properties which specifies the
 * default value of a column.
 *
 * @author Nicola Fontana <ntd@entidi.it>
 * @copyright 2008, 2009 Kris Jordan
 * @package Recess PHP Framework
 * @license MIT
 * @link http://www.recessframework.org/
 */
class DefaultValueAnnotation extends Annotation {
	public function usage() {
		return '!DefaultValue value';
	}
	
	public function isFor() {
		return Annotation::FOR_PROPERTY;
	}

	protected function validate($class) {
		$this->acceptsNoKeyedValues();
		$this->exactParameterCount(1);
	}
	
	protected function expand($class, $reflection, $descriptor) {
		$propertyName = $reflection->getName();
		if(isset($descriptor->properties[$propertyName])) {
			$property = &$descriptor->properties[$propertyName];
            $defaultValue = $this->values[0];

            if (strcasecmp($defaultValue, 'now') == 0) {
                switch ($property->type) {
                case RecessType::DATE:
                case RecessType::TIME:
                case RecessType::DATETIME:
                case RecessType::TIMESTAMP:
                    $defaultValue = time();
                    break;
                }
            }

            $property->defaultValue = $defaultValue;
		}
	}
}
?>
