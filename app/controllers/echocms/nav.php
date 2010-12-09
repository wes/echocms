<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

include('echocms.php');

class Nav extends Echocms {

	function __construct(){
		parent::__construct();
		$this->tbl_name = 'nav';
		$this->field_list = "id, if(status = 'y','Enabled','Disabled') as Status, name as Title, rank as Rank";
		$this->order_field = 'rank asc, name asc';
		$this->name = 'Nav';
		$this->hide_top = true;
		$this->fields = array('status','name','slug','rank','meta_title','meta_keywords','meta_description');
		$this->top = 'Nav Items';
		$this->noAjax = true;
	}
	
	function after_save($id){
		
		$delete_file = $this->input->post('delete_file');
		
		if($delete_file == 'y'):
			$nav = $this->db->get_where('nav', array('id'=>$id))->row();
			$filename = $_SERVER['DOCUMENT_ROOT'].'/uploads/nav/'.$id.'/'.$nav->filename;
			if(file_exists($filename)):
				unlink($filename);
				$this->db->update('nav',array('filename'=>''), array('id'=>$id));
			endif;
		endif;
		
		$nav_file = $_FILES['nav_file']['tmp_name'];
		
		if(!empty($nav_file)):
			$dest_folder = $_SERVER['DOCUMENT_ROOT'].'/uploads/nav/'.$id;
			$dest_filename = $_FILES['nav_file']['name'];
			if(!file_exists($dest_folder)):
				mkdir($dest_folder);
			endif;
			$dest_file = $dest_folder.'/'.$dest_filename;
			copy($nav_file,$dest_file);
			$this->db->update('nav', array('filename'=>$dest_filename), array('id'=>$id));
			unlink($nav_file);
		endif;
		
	}
	
}
?>