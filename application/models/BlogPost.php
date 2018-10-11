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
	public $sort_index = 0;
	public $category = null;
	public $summary;
	public $description;
	public $created_by = null;
	public $is_active = "N";
	public $is_featured = "N";
	public $views = 0;
	public $image = null;
	public $thumb = null;
	public $created;
	public $updated;

    function __construct() {
        $this->tableName = "blog_post";
        parent::__construct();
    }

    public function getPostDetails($where = []) {
    	$_where = ["$this->tableName.is_active"=>"Y"];
    	foreach ($where as $k=>$v) {
    		$_where[$this->tableName.".".$k] = $v;
		}
    	return $this->getBy([["blog_category.name as _category", "blog_category", "blog_post.category = blog_category.id", "LEFT"], ["user.name as _user", "user", "blog_post.created_by = user.id", "LEFT"]], $_where);
	}

	public function getPostTableData($params, $where = []) {
    	return $this->blogPost->getTableData($params, [["blog_category.name as _category", "blog_category", "blog_post.category = blog_category.id", "LEFT"], ["user.name as _user", "user", "blog_post.created_by = user.id", "LEFT"]], $where);
	}

	public function getPostByMonth() {
    	return $this->db->query("SELECT MONTH(updated) month, YEAR(updated) AS year, count(*) as count from blog_post where is_active='Y' group by Month(updated)")->result_array();
	}

	public function incrementView($id) {
		return $this->db->where("id", $id)->set("views", "views+1", false)->update($this->tableName);
	}

}
