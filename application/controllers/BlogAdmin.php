<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class BlogAdmin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->output->set_template('_admin');
        $this->load->model("blogCategory");
    }

    public function index() {
        $this->post();
    }

    public function category() {
        $data = array();
        $data["category"] = $this->blogCategory->getAll();
        $this->load->view('admin/blog/category', $data);
    }

    public function editCategory() {
        $this->output->unset_template();
        $this->load->view('admin/blog/editCategory');
    }
    
    public function saveCategory() {
        $this->output->unset_template();
        $params = $this->input->post(NULL, TRUE);
        $this->blogCategory->save($params);
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
