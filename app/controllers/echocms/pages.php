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
			concat('/',pages.permalink) as Permalink,
			date_format(pages.updated,'%b %d, %Y %h:%i%p') as 'Last Update'
		from pages
		".(!empty($searchQ) ? " where lower(CONVERT(pages.name USING latin1)) like '%".$searchQ."%' " : "")."
		order by pages.name asc
		";
		
		$this->order_field = 'rank asc';
		$this->name = 'Page';
		$this->hide_top = true;
		$this->fields = array('status','meta_title','meta_keywords','meta_description','permalink','name','short_content','content','created','updated');
		$this->top = 'Pages';
		$this->noAjax = true;
		$get = $this->uri->uri_to_assoc(4);

	}

	function before_save(){
		$this->data['permalink'] = url_title($this->data['permalink']);
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