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
    }
    
}
