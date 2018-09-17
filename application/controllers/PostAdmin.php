<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PostAdmin extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    public function save() {
    	$image = @$_FILES["image"];
    	$save = $this->blogPost->save($this->params);
		if($save) {
			if($image) {
				$id = $this->params["id"] ?: $this->db->insert_id();
				$url = AppUtil::BLOG_IMAGE_DIR.$id.".jpg";
				if(AppUtil::uploadFile($image["tmp_name"], $url)) {
					$this->blogPost->update($id, ["image"=>$url]);
				}
			}
			$this->output->rest("success", "Successfully Saved");
		} else {
			$this->output->rest("error", "Saved Failed");
		}
	}

}
