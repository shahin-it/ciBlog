<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends MY_Controller {

    function __construct() {
        parent::__construct();
		$this->load->model('user');
    }

    public function index() {
        $this->load->view('index');
    }

	public function login() {
		if($this->session->has_userdata("user")) {
			redirect(base_url());
		} else {
			$this->output->set_template("_public");
			$this->load->view('public/login');
		}
	}

	public function doLogin() {
    	$email = $this->params["email"];
    	$pass = md5($this->params["pass"]);
    	$user = $this->user->getBy(["email"=>$email, "password"=>$pass]);
    	if($user) {
			$this->session->set_userdata("user", $user["id"]);
			$this->session->set_userdata("role", $user["role"]);

			if($user["role"] === "A" || $user["role"] === "M") {
				$this->output->rest("success", "Login success, Please wait to redirect", ["redirect"=>base_url("admin")]);
			} else {
				$this->output->rest("success", "Login success, please wait to redirect", ["redirect"=>base_url()]);
			}

		} else {
			$this->output->rest("error", "Login error");
		}
	}

	public function logout() {
		$this->session->unset_userdata('user');
		$this->session->unset_userdata('role');
		$this->session->sess_destroy();
		redirect('user/login');
	}


}
