<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

    function __construct() {
		parent::__construct();
		$this->output->set_template('_site');
	}

    public function index() {
		$this->data["post"] = $this->blogPost->getPostDetails(["is_default"=>"Y"]);
        $this->load->view("index", $this->data);
    }

    public function admin() {
        $this->output->set_template('_admin');
        $this->load->view('admin/controlPanel');
    }

}
