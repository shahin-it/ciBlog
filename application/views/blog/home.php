<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	//feature post
	$headingData = $this->blogPost->getPostTableData(["max"=>"5", "orderBy"=>"sort_index"], ["is_featured"=>"Y"]);
	$headingHtml = $this->load->view("blog/featuredPost", $headingData, true);

	//latest post
	$data = $this->blogPost->getPostTableData(["orderBy"=>"updated", "dir"=>"desc", "max"=>"10"]);
	$data["uri"] = "category/latest";
	$data["afterHeader"] = $headingHtml;
	$data["title"] = "Latest Article";

	$this->load->view("blog/postListing", $data);
?>
