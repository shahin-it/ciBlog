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
		$featured = "";
    	$this->params["orderBy"] = "sort_index";
    	$this->params["dir"] = "asc";
    	switch ($uri) {
			case "latest":
				$this->params["orderBy"] = "updated";
				$this->params["dir"] = "desc";
				$this->params["max"] = "5";
				break;
			case "featured":
				$this->params["max"] = "5";
				$where = ["is_featured"=>"Y"];
				$view = "featuredPost";
				$featured = $this->load->view('category/featured', '', true);
				break;
			default:
				$where = ["blog_post.category"=>$uri];
				break;
		}
		$this->data = $this->blogPost->getTableData($this->params, [["blog_category.name as _category", "blog_category", "blog_post.category = blog_category.id", "LEFT"], ["user.name as _user", "user", "blog_post.created_by = user.id", "LEFT"]], $where);
		$this->data["uri"] = $uri;
		$this->data["featured"] = $featured;
		$this->load->view('blog/'.$view, $this->data);
    }

}
