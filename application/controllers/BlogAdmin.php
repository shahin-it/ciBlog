<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class BlogAdmin extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->output->set_template('_admin');
    }
    
    public function index() {
        $this->post();
    }

    public function category() {
        $this->load->view('admin/blog/category');
    }

	public function editCategory() {
		$this->output->unset_template();
		$this->load->view('admin/blog/editCategory');
	}
    
    public function post() {
        $this->load->view('admin/blog/post');
    }
    
    public function comment() {
        $this->load->view('admin/blog/comment');
    }

}
