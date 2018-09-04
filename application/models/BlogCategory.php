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
    public $parent;
    public $description;
    public $created;
	public $updated;
    public $sort_index;

    function __construct() {
        $this->tableName = "blog_category";
        parent::__construct();
    }

	function getParentKeyValue($exclude = null) {
		$data = [""=>"None"];
		$this->db->select("id, name, parent")
			->from($this->tableName);
		if($exclude) {
			$this->db->where_not_in("id", [$exclude]);
		}
		$res = $this->db->get()->result_array();
		foreach ($res as $row) {
			if(!$exclude || $row["parent"] != $exclude) {
				$data[$row["id"]] = $row["name"];
			}
		}
		return $data;
	}

	function getCategoryTree($rootId = null, $where = []) {
    	$cats = $this->getAllBy([], $where);
		return AppUtil::buildTree($cats, $rootId);
	}

}
