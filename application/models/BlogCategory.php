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
    public $sort_index;

    function __construct() {
        $this->tableName = "blog_category";
        parent::__construct();
    }

}
