<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class BlogAdmin extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("blogCategory");
    }

    public function index() {
        $this->post();
    }

    public function category() {
		$this->output->set_template('_admin');
        $this->data = $this->blogCategory->getAll($this->params);
        $this->load->view('admin/blog/category', $this->data);
    }

    public function editCategory() {
        $this->data["item"] = $this->blogCategory->get(@$this->params["id"]);
        $this->data["item"]["parents"] = $this->blogCategory->getParentKeyValue(@$this->params["id"]);
        $this->load->view('admin/blog/editCategory', $this->data);
    }
    
    public function saveCategory() {
        if($this->blogCategory->save($this->params)) {
			$this->output->jsonResponse("success", "Successfully Saved");
		} else {
			$this->output->jsonResponse("error", "Saved Failed");
		}
    }

    public function deleteCategory() {
		$this->blogCategory->delete($this->params["id"]);
		$this->output->jsonResponse("success", "Successfully Deleted!");
	}

    public function post() {
        $this->load->view('admin/blog/post');
    }

    public function comment() {
        $this->load->view('admin/blog/comment');
    }

}
