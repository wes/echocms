<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

include('echocms.php');

class Pages extends Echocms {

	var $nav_id;
	var $excluded_id;
	
	function __construct(){

		parent::__construct();
		
		$searchQ = $this->input->post('searchQ');
		
		$this->tbl_name = 'pages';
		$this->sql_list = "
		select
			pages.id, 
			if(pages.status = 'y','Enabled','Disabled') as Published, 
			pages.name as Title, 
			if(pages.parent_id = 0, nav.name, concat(nav.name, '&#155;', (select p2.name from pages as p2 where p2.id = pages.parent_id))) as Nav,
			if(pages.parent_id = 0, pages.rank, concat((select rank from pages as p1 where p1.id = pages.parent_id), '-',pages.rank)) as Rank,
			if(pages.parent_id = 0, 'topLevel', 'secLevel') as row_class
		from pages
		left join nav on nav.id = pages.nav_id
		".(!empty($searchQ) ? " where lower(CONVERT(pages.name USING latin1)) like '%".$searchQ."%' or lower(CONVERT(nav.name USING latin1)) like '%".$searchQ."%' " : "")."
		order by nav.name asc, Rank asc
		";
		
		$this->order_field = 'rank asc';
		$this->name = 'Page';
		$this->hide_top = true;
		$this->fields = array('status','nav_id','parent_id','meta_title','meta_keywords','meta_description','permalink','name','short_content','content','created','updated','rank');
		$this->top = 'Pages';
		$this->noAjax = true;
		$get = $this->uri->uri_to_assoc(4);
		$this->nav_id = !empty($get['nav_id']) ? $get['nav_id'] : 10000000;
		$this->excluded_id = !empty($get['excluded_id']) ? $get['excluded_id'] : 10000000;
	}

	function before_save(){
		$this->data['permalink'] = url_title($this->data['permalink']);
	}

	function get_parents(){
		$get = $this->uri->uri_to_assoc(4);
		
		$parent = $this->db->query("
		select * from pages where parent_id = 0 and nav_id = ? and id != ? order by rank asc, name asc
		",array($this->nav_id,$this->excluded_id))->result();
		$parents = array(''=>'NONE - MAKE THIS A TOP LEVEL PAGE');
		foreach($parent as $k => $v):
			$parents[$v->id] = '- '.$v->name;
		endforeach;
		if(isset($get['ajax'])):
			echo form_dropdown('form[parent_id]',$parents);
		else:
			return $parents;
		endif;
	}

	function get_data($page_id=false){
		if(!empty($page_id)): 
			$page = $query = $this->db->get_where('pages', array('id'=>$page_id))->row();
			$this->nav_id = $page->nav_id;
			$this->excluded_id = $page->id;
			$parents = $this->get_parents();
		else: 
			$parents = array();
		endif;
		$nav = $this->db->query("select * from nav order by rank asc, name asc")->result();
		$navs = array();
		if($page_id == false):
			$navs[0] = 'Choose a Navigation -->';
		endif;
		foreach($nav as $k => $v):
			$navs[$v->id] = $v->name;
		endforeach;
		
		$data = array();
		$data['navs'] = $navs;
		$data['parents'] = $parents;
		$data['excluded_id'] = $this->excluded_id;

		return $data;
	}

	function auto_permalink(){
		$permalinkMe = $this->input->post('permalinkMe');
		echo url_title($permalinkMe);
	}

	function after_save($id){
		$page_file = $_FILES['page_file']['tmp_name'];
		
		$deletePageImage = $this->input->post('deletePageImage');
		if($deletePageImage == 'y'):
			$page = $this->db->get_where('pages',array('id'=>$id))->row();
			$fileToDelete = $_SERVER['DOCUMENT_ROOT'].'/uploads/pages/'.$page->id.'/'.$page->filename;
			if(file_exists($fileToDelete)): unlink($fileToDelete); endif;
			$this->db->update('pages', array('filename'=>null), array('id'=>$page->id));
		endif;
		
		if(!empty($page_file)):
			$dest_folder = $_SERVER['DOCUMENT_ROOT'].'/uploads/pages/'.$id;
			$dest_filename = $_FILES['page_file']['name'];
			if(!file_exists($dest_folder)):
				mkdir($dest_folder);
			endif;
			$dest_file = $dest_folder.'/'.$dest_filename;
			copy($page_file,$dest_file);
			list($w,$h) = getimagesize($page_file);
			$this->db->update('pages', array('filename'=>$dest_filename), array('id'=>$id));
			unlink($page_file);
		endif;

	}

}
?>