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

	public function save() {
    	$model = $this->params["_model"];
    	unset($this->params["_model"]);
		$this->load->model($model);

		if($this->{$model}->save($this->params)) {
			$this->output->jsonResponse("success", "Successfully Saved");
		} else {
			$this->output->jsonResponse("error", "Saved Failed");
		}
	}

	public function delete() {
		$model = $this->params["_model"];
		$this->load->model($model);

		if($this->{$model}->delete($this->params["id"])) {
			$this->output->jsonResponse("success", "Successfully Deleted!");
		} else {
			$this->output->jsonResponse("error", "Deleted Failed!");
		}
	}

}
