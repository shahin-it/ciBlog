<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends MY_Controller {

    function __construct() {
        parent::__construct();
		$this->output->set_template('_site');
    }

    public function details($id) {
		$this->data["post"] = $this->blogPost->getPostDetails(["id"=>$id, "is_active"=> "Y"]);
		$post = $this->data["post"];
		if($post) {
			$this->blogPost->incrementView($id);
			$this->output->append_title($post["name"]);
            $this->output->set_common_meta($post["name"], $post["summary"], @$post["meta"]);
            $this->load->view('blog/postDetails', $this->data);
		} else {
			$this->data["heading"] = "Error 404";
			$this->data["message"] = "Post not found!";
			header("HTTP/1.1 404 Not Found");
			$this->load->view('errors/html/error_404', $this->data);
		}
    }

    public function category($uri) {
        $category = false;
    	$where = ["blog_post.is_active"=> "Y"];
    	$view = "postListing";
    	$this->params["orderBy"] = "sort_index";
    	switch ($uri) {
			case "latest":
				$this->params["orderBy"] = "updated";
				$this->params["dir"] = "desc";
				break;
			case "featured":
				$where["is_featured"] = "Y";
				$view = "featuredPost";
				break;
			case "popular":
				$this->params["orderBy"] = "views";
				$this->params["dir"] = "desc";
				break;
			default:
				$where["blog_post.category"] = $uri;
				$category = true;
				break;
		}
		$this->data["uri"] = "category/".$uri;
		$this->data[$uri] = "active";
		$this->data = array_merge($this->data, $this->blogPost->getPostTableData($this->params, $where));
		$this->output->append_title(ucfirst($uri)." Post");
		if($category) {
		    $category = $this->category->get($uri);
		    if($category) {
                $this->output->set_common_meta($category["name"], $category["description"], @$category["meta"]);
            }
        }
        $this->load->view("blog/".$view, $this->data);
    }

    public function archive($year, $month) {
		$this->params["orderBy"] = "updated";
		$this->data["uri"] = "archive/".$year;
		$where = ["blog_post.is_active"=> "Y", "YEAR(blog_post.updated)"=>$year];
		if($month) {
			$this->data["uri"] = $this->data["uri"]."/".$month;
			$where["MONTH(blog_post.updated)"] = $month;
		}
		$this->data = array_merge($this->data, $this->blogPost->getPostTableData($this->params, $where));
		$this->output->append_title("Post from ".date("F", strtotime($year))." ".$year);
		$this->load->view("blog/postListing", $this->data);
	}

}
