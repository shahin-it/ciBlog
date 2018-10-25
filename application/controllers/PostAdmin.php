<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PostAdmin extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    public function save() {
    	$image = @$_FILES["image"];
    	if(!$image) {
    		unset($this->params["image"]);
		}
		if($this->params["description"]) {
			$this->params["description"] = $_REQUEST["description"];
		}
    	$save = $this->blogPost->save($this->params);
		if($save) {
			if($image) {
				$id = $this->params["id"] ?: $this->db->insert_id();
				$url = Constant::BLOG_IMAGE_DIR.$id.".jpg";
				if(AppUtil::uploadAndResizeImage($this, $image["tmp_name"], $url, null, 1600, 1000)) {
					$thumb = Constant::BLOG_IMAGE_DIR."thumb_".$id.".jpg";
					AppUtil::resizeImage($this, $url, $thumb, 300, 180);// ratio w:h = 5:3
					$this->blogPost->update($id, ["image"=>$url, "thumb"=>$thumb]);
				}
			}
			$this->output->rest("success", "Successfully Saved");
		} else {
			$this->output->rest("error", "Saved Failed");
		}
	}

}
