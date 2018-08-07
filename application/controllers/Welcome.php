<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    function __construct() {
        parent::__construct();
//        $this->load->helper('url');
        $this->output->set_template('_site');
    }

    public function index() {
        $this->load->view('index');
    }

    public function admin() {
        $this->output->set_template('_admin');
        $this->load->view('admin/controlPanel');
    }

}
