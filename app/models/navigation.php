<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Navigation extends Model {

	//php 5 constructor
	function __construct() {
		parent::Model();
	}
	
	function get_top_level(){

		$this->db->where('nav.parent_id', 0);
		$this->db->order_by('nav.rank', 'asc');
		return $this->db->get('nav')->result();

	}
	
	function get_all() {
		
		$this->db->select("nav.id, if(nav.status = 'y','Enabled','Disabled') as Published, nav.name as Title", false);
		$this->db->where('nav.parent_id', 0);
		$this->db->order_by('nav.rank', 'asc');
		$this->db->order_by('nav.name', 'asc');
		$navs = $this->db->get('nav')->result();

		foreach($navs as $k => $nav):

			$this->db->select("nav.id, if(nav.status = 'y','Enabled','Disabled') as Published, nav.name as Title", false);			$this->db->where('nav.parent_id', $nav->id);
			$this->db->order_by('nav.rank', 'asc');
			$this->db->order_by('nav.name', 'asc');
			
			$navs[$k]->subs = $this->db->get('nav')->result();
			
		endforeach;
		
		return $navs;
		
	}

	function get_menu(){
		
		$this->db->select("nav.id, nav.name, nav.uri_type, nav.url, nav.page_id, nav.rank, pages.permalink, pages.name as page_title", false);
		$this->db->where('nav.status','y');
		$this->db->where('nav.parent_id', 0);
		$this->db->join('pages', 'pages.id = nav.page_id','left');
		$this->db->order_by('nav.name', 'asc');
		$navs = $this->db->get('nav')->result();

		foreach($navs as $k => $nav):

			$this->db->select("nav.id, nav.name, nav.uri_type, nav.url, nav.page_id, nav.rank, pages.permalink, pages.name as page_title", false);
			$this->db->where('nav.status','y');
			$this->db->where('nav.parent_id', $nav->id);
			$this->db->join('pages', 'pages.id = nav.page_id','left');
			$this->db->order_by('nav.name', 'asc');

			$navs[$k]->subs = $this->db->get('nav')->result();
			
		endforeach;
		
		return $navs;
		
	}

}