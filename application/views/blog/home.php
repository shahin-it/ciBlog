<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$data = $this->blogPost->getPostTableData(["orderBy"=>"updated", "dir"=>"desc", "max"=>"5"]);
$data["uri"] = "latest";

$headingData = $this->blogPost->getPostTableData(["max"=>"5", "orderBy"=>"sort_index"], ["is_featured"=>"Y"]);
$data["heading"] = $this->load->view("blog/featuredPost", $headingData, true);
$this->load->view("blog/postListing", $data);
?>
