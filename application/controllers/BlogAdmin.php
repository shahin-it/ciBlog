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
		$this->data["category"] = "active";
        $this->load->view('admin/blog/category', $this->data);
    }

    public function editCategory() {
        $this->data["item"] = $this->blogCategory->get(@$this->params["id"]);
        $this->data["item"]["parents"] = $this->blogCategory->getParentKeyValue(@$this->params["id"]);
        $this->load->view('admin/blog/editCategory', $this->data);
    }

    public function post() {
		$this->output->set_template('_admin');
		$this->data = $this->blogPost->getTableData($this->params,
			[["blog_category.name as _category", "blog_category", "blog_post.category = blog_category.id", "LEFT"], ["user.email as _created_by", "user", "blog_post.created_by = user.id", "LEFT"]]);
		$this->data["post"] = "active";
        $this->load->view('admin/blog/post', $this->data);
    }

	public function editPost() {
		$this->data["item"] = $this->blogPost->get(@$this->params["id"]);
		$this->data["category"] = $this->blogCategory->getKeyValue("id, name");
		$this->load->view('admin/blog/editPost', $this->data);
	}

    public function comment() {
		$this->output->set_template('_admin');
		$this->data = $this->blogComment->getTableData($this->params,
			[["blog_post.name as _post", "blog_post", "blog_comment.post = blog_post.id", "LEFT"], ["user.email as _created_by", "user", "blog_comment.created_by = user.id", "LEFT"]]);
		$this->data["comment"] = "active";
        $this->load->view('admin/blog/comment', $this->data);
    }

	public function editComment() {
		$this->data["item"] = $this->blogComment->getBy(["user.email as _created_by", "user", "blog_comment.created_by = user.id", "LEFT"], ["blog_comment.id"=>@$this->params["id"]]);
		if(@!$this->data["item"]["id"]) {
			$this->data["item"]["_created_by"] = $this->session->userdata("loggedUser")["email"];
		}
		$this->data["blogPost"] = $this->blogPost->getKeyValue("id, name", false);
		$this->load->view('admin/blog/editComment', $this->data);
	}

	public function page() {
		$this->output->set_template('_admin');
		$this->data = $this->page->getTableData($this->params,
			[["blog_post.name as _post", "blog_post", "page.post = blog_post.id", "LEFT"], ["user.email as _created_by", "user", "page.created_by = user.id", "LEFT"]]);
		$this->data["page"] = "active";
		$this->load->view('admin/page', $this->data);
	}

	public function editPage() {
		$this->data["item"] = $this->page->getBy(["user.email as _created_by", "user", "page.created_by = user.id", "LEFT"], ["page.id"=>@$this->params["id"]]);
		if(@!$this->data["item"]["id"]) {
			$this->data["item"]["_created_by"] = $this->session->userdata("loggedUser")["email"];
		}
		$this->data["blogPost"] = $this->blogPost->getKeyValue("id, name", false);
		$this->load->view('admin/editPage', $this->data);
	}

	public function navigation() {
		$this->output->set_template('_admin');
		$this->data = $this->navigation->getTableData($this->params,
			[["blog_post.name as _post", "blog_post", "navigation.uri = blog_post.id", "LEFT"], ["page.title as _page", "page", "navigation.uri = page.id", "LEFT"], ["user.email as _created_by", "user", "page.created_by = user.id", "LEFT"]]);
		$this->data["navigation"] = "active";
		$this->load->view('admin/navigation', $this->data);
	}

	public function editNavigation() {
		$this->data["item"] = $this->navigation->getBy(["user.email as _created_by", "user", "navigation.created_by = user.id", "LEFT"], ["navigation.id"=>@$this->params["id"]]);
		if(@!$this->data["item"]["id"]) {
			$this->data["item"]["_created_by"] = $this->session->userdata("loggedUser")["email"];
		}
		$this->data["item"]["parents"] = $this->navigation->getParentKeyValue(@$this->params["id"], "type IS NOT NULL");
		$this->data["item"]["_page"] = $this->page->getKeyValue("uri, title", true);
		$this->data["item"]["_post"] = $this->blogPost->getKeyValue("id, name", true);
		$this->load->view('admin/editNavigation', $this->data);
	}

}
