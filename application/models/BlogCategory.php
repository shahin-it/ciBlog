<?php

/**
 * Created by IntelliJ IDEA.
 * User: mbstu
 * Date: 10-Aug-18
 * Time: 10:45 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class BlogCategory extends MY_Model {

    public $id;
    public $name;
    public $parent = null;
    public $description = null;
    public $meta = null;
    public $created;
	public $updated;
    public $sort_index = 0;

    function __construct() {
        $this->tableName = "blog_category";
        parent::__construct();
    }

	function getCategoryTree($rootId = null, $where = []) {
    	$cats = $this->getAllBy([], $where);
		return AppUtil::buildTree($cats, $rootId);
	}

}
