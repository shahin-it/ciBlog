<?php
/**
 * Created by IntelliJ IDEA.
 * User: mbstu
 * Date: 10-Aug-18
 * Time: 10:45 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog_category extends CI_Model
{
	public $id;
	public $name;
	public $parent;

	function __construct() {
		parent::__construct();
	}

	function get($id) {
		$query = $this->db->get_where('blog_category', array('id' => $id));
		return $query->result();
	}
}
