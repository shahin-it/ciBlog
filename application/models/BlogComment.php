<?php

/**
 * Created by IntelliJ IDEA.
 * User: mbstu
 * Date: 10-Aug-18
 * Time: 10:45 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class BlogComment extends MY_Model {

    public $id;
    public $user;
    public $post;
    public $description;
    public $created;
    public $updated;

    function __construct() {
        $this->tableName = "blog_comment";
        parent::__construct();
    }

}
