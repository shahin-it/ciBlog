<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of MY_Controller
 *
 * @author khaled.sdd
 */
class MY_Controller extends CI_Controller {
    
    public $params = [];
    public $data = [];

    function __construct() {
        parent::__construct();
        $this->params = array_merge($this->input->get_post(NULL, TRUE), $this->input->post_get(NULL, TRUE));
		$this->_before();
    }

	private function _before() {
    	$isAdminUrl = AppUtil::strContains($this->uri->segment(1), "admin");
    	$isUserUrl = AppUtil::strContains($this->uri->segment(1), "user");
		if($isAdminUrl || $isUserUrl) {
			if(AppUtil::arrayContains(["user/login", "user/doLogin"], $this->uri->uri_string())) {
				return;
			}
			if($this->session->has_userdata("user")) {
				$isUser = $this->session->userdata("role") === "U";
				$isUser && $isAdminUrl && redirect("/");
			} else {
				redirect("user/login");
			}
		}
	}

	public function save() {
    	$model = $this->params["_model"];
    	unset($this->params["_model"]);
		$this->load->model($model);

		if($this->{$model}->save($this->params)) {
			$this->output->rest("success", "Successfully Saved");
		} else {
			$this->output->rest("error", "Saved Failed");
		}
	}

	public function delete() {
		$model = $this->params["_model"];
		$this->load->model($model);

		if($this->{$model}->delete($this->params["id"])) {
			$this->output->rest("success", "Successfully Deleted!");
		} else {
			$this->output->jsonResponse("error", "Deleted Failed!");
		}
	}

}
