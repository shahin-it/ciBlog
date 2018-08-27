<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$data = $this->blogPost->getPostTableData(["orderBy"=>"updated", "dir"=>"desc", "max"=>"5"]);
$data["uri"] = "latest";

$featureData = $this->blogPost->getPostTableData(["max"=>"5", "orderBy"=>"sort_index"], ["is_featured"=>"Y"]);
$data["featured"] = $this->load->view("blog/featuredPost", $featureData, true);
$this->load->view("blog/postListing", $data);
?>
