<?php

/**
 * Created by IntelliJ IDEA.
 * User: mbstu
 * Date: 10-Aug-18
 * Time: 10:45 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends MY_Model {

	public $id;
	public $title;
	public $heading = null;
	public $url;
	public $post = null;
	public $content = null;
    public $meta = null;
	public $created;
	public $updated;
	public $sort_index = 0;

    function __construct() {
        $this->tableName = "page";
        parent::__construct();
    }



}
