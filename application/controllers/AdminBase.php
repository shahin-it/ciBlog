<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AdminBase extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    public function savePage() {
        $this->params["content"] = @$_REQUEST["content"];
    	$save = $this->page->save($this->params);
		if($save) {
			$this->output->rest("success", "Successfully Saved");
		} else {
			$this->output->rest("error", "Saved Failed");
		}
	}

}
