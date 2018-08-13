<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class BlogAdmin extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->output->set_template('_admin');
        $this->load->model("blogCategory");
    }

    public function index() {
        $this->post();
    }

    public function category() {
        $this->data = $this->blogCategory->getAll($this->params);
        $this->load->view('admin/blog/category', $this->data);
    }

    public function editCategory() {
        $this->output->unset_template();
        $this->data["item"] = $this->blogCategory->get(@$this->params["id"]);
        $this->data["item"]["parents"] = $this->blogCategory->getKeyValue("id, name", [@$this->params["id"]]);
        $this->load->view('admin/blog/editCategory', $this->data);
    }
    
    public function saveCategory() {
        $this->output->unset_template();
        $this->blogCategory->save($this->params, "blog_category");
        $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array('status' => 'success', "message" => "Successfully Saved")));
    }

    public function post() {
        $this->load->view('admin/blog/post');
    }

    public function comment() {
        $this->load->view('admin/blog/comment');
    }

}
