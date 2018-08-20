<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends MY_Controller {

    function __construct() {
        parent::__construct();
		$this->output->set_template('_site');
    }

    public function details($id) {
		$this->data["post"] = $this->blogPost->getPostDetails(["id"=>$id]);
		$this->load->view('blog/postDetails', $this->data);
    }

    public function category($id) {
    	$this->params["orderBy"] = "sort_index";
    	$this->params["dir"] = "asc";
		$this->data = $this->blogPost->getTableData($this->params, ["user.name as _user", "user", "blog_post.created_by = user.id", "LEFT"], ["blog_post.category"=>$id]);
		$this->data["id"] = $id;
		$this->load->view('blog/postListing', $this->data);
    }

}
