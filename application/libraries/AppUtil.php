<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of CI_UTIL
 *
 * @author khaled.sdd
 */

class AppUtil {
	private static $instance;

	function __construct() {

	}

	public static function newInstance() {
		if (!self::$instance instanceof self) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	public static function now($format = "Y-m-d H:i:s") {
		return date($format);
	}

	public static function localTime($strTime, $formate = "d-m-Y h:i a") {
		return date($formate, strtotime($strTime));
	}

	public static function strContains($source, $key, $caseSensitive = false) {
		if(!$caseSensitive) {
			$source = strtolower($source);
			$key = strtolower($key);
		}
		$res = @strpos($source, $key);
		if($res !== false) {
			return true;
		}
		return $res;
	}

	public static function arrayContains($array, $key, $caseSensitive = false) {
		if(!$caseSensitive) {
			$array = array_map("strtolower", $array);
			$key = strtolower($key);
		}
		foreach ($array as $v) {
			if(self::strContains($v, $key)) {
				return true;
			}
		}

		return false;
	}

	public static function isAssoc(array $arr)
	{
		if (array() === $arr) return false;
		return array_keys($arr) !== range(0, count($arr) - 1);
	}

}
