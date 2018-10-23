<?php

/**
 * Created by IntelliJ IDEA.
 * User: mbstu
 * Date: 10-Aug-18
 * Time: 10:45 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Navigation extends MY_Model {

    public $id;
    public $name;
    public $type;//PO, PA
    public $parent = null;
    public $uri = null;
    public $is_active = false;
    public $created;
	public $updated;
    public $created_by = 0;

    function __construct() {
        $this->tableName = "navigation";
        parent::__construct();
    }

	function getNavigationTree($rootId = null, $where = []) {
    	$navs = $this->getAllBy([], $where);
    	foreach ($navs as &$nav) {
    		if($nav["type"] == "POST") {
    			$nav["uri"] = "post/".$nav["uri"];
			} else if($nav["type"] == "PAGE") {
				$nav["uri"] = "page/".$nav["uri"];
			}
		}
		return AppUtil::buildTree($navs, $rootId);
	}

}
