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

}
