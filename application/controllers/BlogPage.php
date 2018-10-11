<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class BlogPage extends MY_Controller {

    function __construct() {
		parent::__construct();
		$this->output->set_template('_site');
	}

    public function index() {
    	$this->data["home"] = "active";
        $this->load->view("index", $this->data);
    }

}
