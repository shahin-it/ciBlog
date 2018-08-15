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

}
