<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

include('echocms.php');

class Nav extends Echocms {

	function __construct(){

		parent::__construct();

		$this->load->model('page');
		$this->load->model('navigation');

		$this->tbl_name = 'nav';
		$this->field_list = "id, if(status = 'y','Enabled','Disabled') as Status, name as Title, rank as Rank";
		$this->order_field = 'rank asc, name asc';
		$this->name = 'Nav';
		$this->hide_top = true;
		$this->fields = array('parent_id','status','name','uri_type','url','page_id','rank');
		$this->top = 'Nav Items';
		$this->noAjax = true;
		
		$this->showSort = 'yes';
		$this->listDiv = true;
		
		$this->list = $this->navigation->get_all();
		
	}
	
	function get_data(){

		$d['parents'] = $this->navigation->get_top_level();
		
		$d['uri_types'] = array('page','url');
		
		$d['pages'] = $this->page->get_all();

		return $d;

	}

	function save_order(){

		$sortinglist = !empty($_POST['sortinglist']) ? $_POST['sortinglist'] : '';

		if(empty($sortinglist)):
			foreach($_POST as $k => $v):
				$parts = explode('_',$k);
				if(!empty($parts[0]) && $parts[0] == 'sortinglist'):
					$sortinglist = $v;
					break;
				endif;
			endforeach;
		endif;

		if(!empty($sortinglist)):
			foreach($sortinglist as $k => $v):
				mysql_query("update nav set rank = '".$k."' where id = '".$v."'") or die( mysql_error() );
			endforeach;
		endif;

	}

	function after_save($id){

/*
		
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
*/
		
	}
	
}
?>