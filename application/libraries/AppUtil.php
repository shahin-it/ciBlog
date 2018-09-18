<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of CI_UTIL
 *
 * @author khaled.sdd
 */

class AppUtil {
	const BLOG_IMAGE_DIR = "asset/image/blog/";
	const NO_IMAGE_THUMB = "asset/image/default/no-image.jpg";

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

	public static function getFirstNLine($str, $n = 5) {
		$lines = explode(PHP_EOL, $str);
		if(count($lines) > $n) {
			return implode(PHP_EOL, array_slice($lines,0, $n)).PHP_EOL;
		}
		return $str;
	}

	public static function truncate($string, $length = 100, $append="&hellip;") {
		$string = trim($string);

		if(strlen($string) > $length) {
			$string = wordwrap($string, $length);
			$string = explode("\n", $string, 2);
			$string = $string[0] . $append;
		}

		return $string;
	}

	public static function buildTree($category, $parentId = null) {
		$tree = $category;
		$branch = array();

		foreach ($tree as $element) {
			if ($element['parent'] == $parentId) {
				$children = self::buildTree($tree, $element['id']);
				$element['child'] = $children;
				$branch[] = $element;
			}
		}

		return $branch;


		/*$return = array();
    	# Traverse the tree and search for direct children of the root
		foreach($tree as $k=>$child) {
			$key = array_search($child["parent"], array_column($tree, 'id'));
			if(!$key) {
				continue;
			}
			$parent = $tree[$key];
        	# A direct child is found
			if($parent["parent"] == $root) {
            	# Remove item from tree (we don't need to traverse this again)
				unset($tree[$k]);
				unset($tree[$key]);
            	# Append the child into result array and parse its children
				$parent["child"][] = $child;
				$return[] = $parent;
				self::parseCategory($tree, $child["parent"]);
			}
		}
		return $return;*/
	}

	public static function uploadFile($srcLocation, $deistLocation, $fileName = null) {
		if($fileName) {
			$deistLocation = $deistLocation . "/" . $fileName;
		}
		$dir = dirname($deistLocation);
		if (!file_exists($dir)) {
			mkdir($dir, 0777);
		}
		return move_uploaded_file($srcLocation, $deistLocation);
	}

	public static function resizeImage($CI_INST, $source, $width, $height = 0)
	{
		$path = dirname($source);
		$file = basename($source);

		$config['image_library'] = 'gd2';
		$config['source_image'] = $source;
		$config["new_image"] = $path."/thumb_".$file;
		$config['create_thumb'] = FALSE;
		$config['maintain_ratio'] = TRUE;
		$config["x_axis"] = $width;
		$config["y_axis"] = $height;
		$config['width'] = $width;
		$config['height'] = $height;

		$CI_INST->load->library('image_lib', $config);
		$CI_INST->image_lib->resize();

		return $config["new_image"];
	}

}
