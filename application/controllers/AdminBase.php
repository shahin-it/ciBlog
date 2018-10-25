<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AdminBase extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    public function savePage() {
		if($this->params["content"]) {
			$this->params["content"] = $_REQUEST["content"];
		}
    	$save = $this->page->save($this->params);
		if($save) {
			$this->output->rest("success", "Successfully Saved");
		} else {
			$this->output->rest("error", "Saved Failed");
		}
	}

	public function uploadAsset() {
        $files = @$_FILES["file"];
        $dist = Constant::ASSET_DIR.$files["name"];
        if(AppUtil::uploadFile($files["tmp_name"], $dist)) {
            $this->output->rest("success", null, ["location" => base_url($dist)]);
        } else {
            $this->output->rest("Max size 2MB!");
        }
    }

}
