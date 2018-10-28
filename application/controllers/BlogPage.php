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
        $this->output->append_title(@$page["title"]);

        if (@$page["content"]) {
            $this->data["page"] = $page;
            $this->output->set_common_meta($page["title"], $page["heading"], @$page["meta"]);
            $this->load->view('public/pageView', $this->data);
        } elseif (@$page["post"]) {
            $postId = $page["post"];
            $post = $this->data["post"] = $this->blogPost->getPostDetails(["id"=>$postId, "is_active"=> "Y"]);
            if($page["heading"]) {
                $this->data["post"]["name"] = $page["heading"];
            }
			$this->blogPost->incrementView($postId);
            $this->output->set_common_meta($post["name"], $post["summary"], @$post["meta"]);
            $this->load->view('blog/postDetails', $this->data);
		} else {
			$this->data["heading"] = "Error 404";
			$this->data["message"] = "Post not found!";
			header("HTTP/1.1 404 Not Found");
			$this->load->view('errors/html/error_404', $this->data);
		}
    }

}
