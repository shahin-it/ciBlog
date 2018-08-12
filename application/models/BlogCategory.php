<?php

/**
 * Created by IntelliJ IDEA.
 * User: mbstu
 * Date: 10-Aug-18
 * Time: 10:45 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class BlogCategory extends CI_Model {

    public $id;
    public $name;
    public $parent;
    public $description;
    public $created;
    public $sort_order;
    private $query;

    function __construct() {
        $this->query = $this->db->get("blog_category");
        parent::__construct();
    }

    function get($id) {
        $this->db->where('id', $id);
        return $this->query->row();
    }

    function getAll($param = array()) {
        return $this->query->result();
    }
    
    function save($params) {
        $result;
        unset($params["ajax"]);
        if($params["id"]) {
            $result = $this->db->update("blog_category", $params, array("id" => $params["id"]));
        } else {
            $result = $this->db->insert("blog_category", $params);
        }
        return 0;
    }

}
