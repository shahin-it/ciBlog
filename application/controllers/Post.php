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

    public function category($uri) {
    	$where = [];
    	$view = "postListing";
    	$this->params["orderBy"] = "sort_index";
    	switch ($uri) {
			case "latest":
				$this->params["orderBy"] = "updated";
				$this->params["dir"] = "desc";
				break;
			case "featured":
				$where = ["is_featured"=>"Y"];
				$view = "featuredPost";
				break;
			default:
				$where = ["blog_post.category"=>$uri];
				break;
		}
		$this->data["uri"] = $uri;
		$this->data[$uri] = "active";
		$this->data = array_merge($this->data, $this->blogPost->getPostTableData($this->params, $where));
		$this->load->view("blog/".$view, $this->data);
    }

}
