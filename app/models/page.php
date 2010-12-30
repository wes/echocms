<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Page extends Model {

	//php 5 constructor
	function __construct() {
		parent::Model();
	}
	
	function get_all() {
		
		$this->db->order_by('pages.name', 'asc');
		return $this->db->get('pages')->result();

	}

}