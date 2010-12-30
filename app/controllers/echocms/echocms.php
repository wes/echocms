<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Echocms extends Controller {

	var $data;
	var $list_tree;
	var $list;
	var $head;
	var $top;
	var $site_admin;
	
	function __construct(){

		parent::Controller();

		if($this->easyauth->connected == false):
			redirect("/login");
		endif;

		if(empty($this->top) && !empty($this->name)):
			$this->top = $this->name.'s';
		endif;
		
		$this->site_admin = $this->config->item('site_admin');
		
		$this->layout->setLayout('echocms');
		
	}
	
	function add(){
		# using the get_data initializer now.. -wes
		$data = $this->get_data();
		if(isset($this->noAjax)):
			$this->layout->view('echocms/forms/'.$this->tbl_name, $data);
		else:
			$this->load->view('echocms/forms/'.$this->tbl_name, $data);
		endif;
	}

	function edit($id){
		# adding some extra functionality to the controller.. -wes
		# init the data array..
		$data = $this->get_data($id);
		$data['form'] = $this->db->query("select * from ".$this->tbl_name." where id = ?",$id)->row();
		$data['id'] = $id;
		if(isset($this->noAjax)):
			$this->layout->view('echocms/forms/'.$this->tbl_name, $data);
		else:
			$this->load->view('echocms/forms/'.$this->tbl_name, $data);
		endif;
	}
	
	function get_data(){
		# this will be a handy function to extend extra data into the forms..
		# just return init array 
		return array();
	}
	
	function save(){
		
		$id = $this->uri->segment(4);

		$post_id = $this->input->post('id');
		
		if(!empty($post_id)): $id = $post_id; endif;

		$this->data = $this->input->post('form');

		$this->before_save();

		$f = $this->data;

		foreach($this->fields as $field):
			if($field == 'status' && empty($f[$field])): $f[$field] = 'n'; endif;
			if($field == 'featured' && empty($f[$field])): $f[$field] = 'n'; endif;
			if($field == 'non_member' && empty($f[$field])): $f[$field] = 'n'; endif;
			if($field == 'password' && !empty($f[$field])): $f[$field] = md5($f[$field]); endif;
			if(empty($f[$field])): $f[$field] = ''; endif;
			$fields[$field] = $f[$field];
			if($field == 'password' && empty($fields[$field])): unset($fields[$field]); endif;
		endforeach;

		if(empty($id)):
			$this->db->insert($this->tbl_name,$fields);
			$id = $this->db->insert_id();
			$this->session->set_flashdata('msg',array( 'title' => $this->name.' Added' ) );
		else:
			$where = 'id = '.$this->db->escape($id);
			$this->db->update($this->tbl_name,$fields,$where);
			$this->session->set_flashdata('msg',array( 'title' => $this->name.' Updated' ) );
		endif;

		$this->after_save($id);

		header('Location: /'.$this->site_admin.'/'.$this->tbl_name.'/');
		
	}
	
	public function save_order(){
		foreach($_POST['sortinglist'] as $k => $v):
			$this->db->set('rank', $k);
			$this->db->where('id', $v);
			$this->db->update($this->tbl_name);
		endforeach;
	}
	
	function before_save(){}
	
	function after_save($id){}
	function after_delete($id){}
	
	function del($id){
		if(!empty($id)):
			$this->db->delete($this->tbl_name, array('id'=>$id));
			$this->after_delete($id);
			echo $this->name.' Deleted';
		endif;
	}

	function __get_search_fields(){
		$searchQ = $this->input->post('searchQ');
		if(empty($searchQ)): return array(); endif;
		$result = mysql_query("select * from ".$this->tbl_name);
		$search_fields = array();
		for($i = 0; $i < mysql_num_fields($result); $i++):
			$field_name = mysql_field_name($result,$i);
			$field_type = mysql_field_type($result,$i);
			$field_len = mysql_field_len($result,$i);
			if($field_type == 'string' && $field_len > 5 && $field_name != 'password'):
				$search_fields[$field_name] = $searchQ;
			endif;
		endfor;
		return $search_fields;
	}
	
	function index(){

		$search_fields = $this->__get_search_fields();
		
		$searchQ = $this->input->post('searchQ');
		
		if(isset($this->list)):
			$list = $this->list;
		elseif(isset($this->sql_list)):
			$list = $this->db->query($this->sql_list)->result_array();
		else:
			$this->db->select($this->field_list,false);
			foreach($search_fields as $k=>$v):
				$this->db->or_where("lower(CONVERT(".$k." USING latin1)) like '%".$searchQ."%'");
			endforeach;
			$this->db->order_by($this->order_field);
			$list = $this->db->get($this->tbl_name)->result_array();
 		endif;

		$data = $this->get_data();
				
		$data['list'] = $list;
		
		if(isset($this->hide_del)):
			$data['hideDelete'] = true;
		endif;
		
		if(isset($this->view_only)):
			$data['viewOnly'] = true;
		endif;

		$list_file = 'echocms/listTbl';

		if(isset($this->listDiv)):
			$list_file = 'echocms/listDiv';
		endif;

		if($this->list_tree == true):
			$list_file = 'echocms/list_tree';
		endif;
		
		$data['head'] = $this->head;
		$data['orderField'] = $this->order_field;
		$data['top'] = $this->top;
		$data['searchQ'] = $this->input->post('searchQ');
		$data['totalRecords'] = count($list);
		if(isset($this->showSort)):
			$data['showSort'] = $this->showSort;
		endif;
		
		$this->layout->view($list_file,$data);
		
	}
	
}

?>