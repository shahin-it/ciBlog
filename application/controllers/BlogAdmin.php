<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class BlogAdmin extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->post();
    }

    public function category() {
		$this->output->set_template('_admin');
        $this->data = $this->blogCategory->getTableData($this->params);
        $this->load->view('admin/blog/category', $this->data);
    }

    public function editCategory() {
        $this->data["item"] = $this->blogCategory->get(@$this->params["id"]);
        $this->data["item"]["parents"] = $this->blogCategory->getParentKeyValue(@$this->params["id"]);
        $this->load->view('admin/blog/editCategory', $this->data);
    }

    public function post() {
		$this->output->set_template('_admin');
		$this->params["_join"] = "blog_category";
		$this->params["_col"] = "category";
		$this->data = $this->blogPost->getTableData($this->params);
        $this->load->view('admin/blog/post', $this->data);
    }

	public function editPost() {
		$this->data["item"] = $this->blogPost->get(@$this->params["id"]);
		$this->data["category"] = $this->blogCategory->getKeyValue("id, name");
		$this->load->view('admin/blog/editPost', $this->data);
	}

    public function comment() {
		$this->output->set_template('_admin');
		$this->params["_join"] = "blog_post";
		$this->params["_col"] = "post";
		$this->data = $this->blogComment->getTableData($this->params);
        $this->load->view('admin/blog/comment', $this->data);
    }

	public function editComment() {
		$this->data["item"] = $this->blogComment->get(@$this->params["id"]);
		$this->data["blogPost"] = $this->blogPost->getKeyValue("id, name", false);
		$this->load->view('admin/blog/editComment', $this->data);
	}

}
