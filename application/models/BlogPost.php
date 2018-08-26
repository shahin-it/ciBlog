<?php

/**
 * Created by IntelliJ IDEA.
 * User: mbstu
 * Date: 10-Aug-18
 * Time: 10:45 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class BlogPost extends MY_Model {

    public $id;
    public $name;
    public $category;
    public $description;
    public $created;
	public $updated;
    public $sort_index;

    function __construct() {
        $this->tableName = "blog_post";
        parent::__construct();
    }

    public function getPostDetails($where = []) {
    	$_where = [];
    	foreach ($where as $k=>$v) {
    		$_where[$this->tableName.".".$k] = $v;
		}
    	return $this->getBy([["blog_category.name as _category", "blog_category", "blog_post.category = blog_category.id", "LEFT"], ["user.name as _user", "user", "blog_post.created_by = user.id", "LEFT"]], $_where);
	}

}
