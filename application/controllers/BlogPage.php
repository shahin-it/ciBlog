<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class BlogPage extends MY_Controller {

    function __construct() {
		parent::__construct();
		$this->output->set_template('_site');
	}

    public function index($uri) {
    	$this->data[$uri] = "active";
    	$page = $this->page->getBy([], ["uri"=>$uri]);
    	$postId = $page["post"];
		$this->data["post"] = $this->blogPost->getPostDetails(["id"=>$postId, "is_active"=> "Y"]);
		if($this->data["post"]) {
			$this->blogPost->incrementView($postId);
			$this->load->view('blog/postDetails', $this->data);
		} else {
			$this->data["heading"] = "Error 404";
			$this->data["message"] = "Post not found!";
			header("HTTP/1.1 404 Not Found");
			$this->load->view('errors/html/error_404', $this->data);
		}
    }

}
