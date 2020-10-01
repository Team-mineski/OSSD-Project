<?php
class  Validation {
	static $errors = true;

	static function check($arr, $on = false) {
		if ($on === false) {
			$on = $_REQUEST;
		}
		foreach ($arr as $value) {	
			if (empty($on[$value])) {
				self::throwError('Data is missing', 900);
			}
		}
	}

	static function int($val) {
		$val = filter_var(htmlentities($val), FILTER_VALIDATE_INT);
		if ($val === false) {
			self::throwError('Invalid Integer', 901);
		}
		return $val;
	}

	static function str($val) {
		if (!is_string($val)) {
			self::throwError('Invalid String', 902);
		}
		$val = trim(htmlspecialchars(htmlentities($val)));
		return $val;
	}

	static function bool($val) {
		$val = filter_var(htmlentities($val), FILTER_VALIDATE_BOOLEAN);
		return $val;
	}

	static function email($val) {
		$val = filter_var(htmlentities($val), FILTER_VALIDATE_EMAIL);
		if ($val === false) {
			self::throwError('Invalid Email', 903);
		}
		return $val;
	}

	static function url($val) {
		$val = filter_var(htmlentities($val), FILTER_VALIDATE_URL);
		if ($val === false) {
			self::throwError('Invalid URL', 904);
		}
		return $val;
	}

	static function phone($val){
		$valid_number = filter_var(htmlentities($val), FILTER_SANITIZE_NUMBER_INT);
		$valid_number = str_replace("-", "", $valid_number);
		if (strlen($valid_number) < 10 || strlen($valid_number) > 14) {
			self::throwError('Invalid Email', 905);
		} else {
			return $valid_number;
		}
	}

	static function throwError($error = 'Error In Processing', $errorCode = 0) {
		if (self::$errors === true) {
			throw new Exception($error, $errorCode);
		}
	}

	
}
?>