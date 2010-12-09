<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Gfx extends Controller {

	var $upload_path;

	function __construct(){
		parent::Controller();
		if($this->easyauth->connected == false):
			redirect("/login");
		endif;
		$this->layout->setLayout('admin_gfx');
		$this->upload_path = $_SERVER['DOCUMENT_ROOT'].'/uploads/gfx/';
		$this->sortMethod = 'created';
		$this->sortOrder = 'desc';
		$this->fileExtension = '';
		$this->load->library('upload');		
	}

	function index(){

		$sortMethods = array(
			'filename'=>'File Name',
			'ext'=>'File Type',
			'created'=>'Upload Date',
		);

		$sortOrders = array(
			'asc'=>'Ascending',
			'desc'=>'Descending',
		);
		
		$fileExtensions = array(
			''=>'All File Extensions',
			'jpg'=>'JPGS Only',
			'tif'=>'TIFS Only',
			'gif'=>'GIFS Only',
			'png'=>'PNGS Only',
			'pdf'=>'PDFS Only',
			'doc'=>'DOCS Only',
			'xls'=>'XLS Only',
		);

		$data['gfx'] = $this->getList();
		$data['sortMethods'] = $sortMethods;
		$data['sortOrders'] = $sortOrders;
		$data['fileExtensions'] = $fileExtensions;
		$data['sortMethod'] = $this->sortMethod;
		$data['sortOrder'] = $this->sortOrder;
		$data['fileExtension'] = $this->fileExtension;
		
		$this->layout->view('echocms/gfx/dash',$data);

	}

	function edit($id){
		if(empty($id)): exit; endif;
		$gfx = $this->db->get_where('gfx', array('id'=>$id))->row();
		$fileData = $this->getFileData($gfx);
		$gfx->thumb = $fileData['thumb'];
		$this->load->view('echocms/gfx/edit',$gfx);
	}

	function delete($id){
		if(empty($id)): exit; endif;
		$gfx = $this->db->get_where('gfx', array('id'=>$id))->row();
		$filePath = $this->upload_path.$gfx->filename;
		unlink($filePath);
		$this->db->delete('gfx', array('id'=> $id));
	}

	function getList($return = false){

		$uri = $this->uri->uri_to_assoc(4);

		if(isset($uri['sortOrder'])): $sortOrder = $uri['sortOrder']; endif;
		if(isset($uri['sortMethod'])): $sortMethod = $uri['sortMethod']; endif;

		if(!empty($uri['fileExtension'])):
			$this->db->where(array('ext'=>$uri['fileExtension']));
		endif;
		
		if(empty($sortMethod)):$sortMethod=$this->sortMethod;endif;
		if(empty($sortOrder)):$sortOrder=$this->sortOrder;endif;
		
		$this->db->order_by($sortMethod,$sortOrder);
		
		$gfx = $this->db->get('gfx')->result();
		
		$gfx = $this->attachThumbs($gfx);

		if($return == true):
			$this->load->view('echocms/gfx/list',array('gfx'=>$gfx));
		else:
			return $gfx;
		endif;

	}

	function attachThumbs($gfx){
		foreach($gfx as $k=>$v):
			$fileData = $this->getFileData($v);
			$gfx[$k]->link = $fileData['link'];
			$gfx[$k]->path = $fileData['path'];
			$gfx[$k]->thumb = $fileData['thumb'];
			$gfx[$k]->caption = $fileData['caption'];
		endforeach;
		return $gfx;
	}

	function getFileData($file){
		$thumbSettings = array('w'=>128,'h'=>128,'canvas-color'=>'#ffffff');
		switch($file->ext):
			case'xls':
			case'pdf':
			case'doc':
				$thumb = '/app/gfx/admin/icons/'.$file->ext.'.png';
				$path = $thumb;
				$link = str_replace($_SERVER['DOCUMENT_ROOT'],'',$this->upload_path).$file->filename;
				break;
			default: 
				$thumb = $this->resize->size($this->upload_path.$file->filename,$thumbSettings);
				$link = str_replace($_SERVER['DOCUMENT_ROOT'],'',$this->upload_path).$file->filename;
				$path = str_replace($_SERVER['DOCUMENT_ROOT'],'',$this->upload_path).$file->filename;
				break;
		endswitch;
		$caption = empty($file->title) ? $file->filename : $file->title;
		return array('thumb'=>$thumb,'path'=>$path,'caption'=>$caption,'link'=>$link);
	}

	function upload(){
		$this->load->view('admin/gfx/upload');
	}

	private function store_file($data){

		$fields = array(
			'filename'=>$data['file_name'],
			'ext'=>str_replace('.','',$data['file_ext']),
			'width'=>$data['image_width'],
			'height'=>$data['image_height'],
			'created'=>date('Y-m-d H:i:s'),
		);
		
		$this->db->insert('gfx',$fields);

	}

	function send_files(){

#		debug($_FILES);

#		echo $_FILES['upload']['type'];

#		$this->upload->file_type = str_replace('\"', '', $_FILES[$field]['type']);

		$this->config->set_item('enable_query_strings', true);

		$config['upload_path'] = $this->upload_path;
		$config['allowed_types'] = 'pdf|doc|xls|jpg|tif|gif|png';
		$config['max_size']	= 1024*10; # 10 mb

		$this->upload->initialize($config);
		
		$ret = $this->upload->do_upload('upload');

		if($ret == true): 
			$file = $this->upload->data();
			$this->store_file($file);
			redirect('/admin/gfx/');
		else:
			echo '<p>Error uploading file</p>';
			echo $this->upload->display_errors('<p>', '</p>');
			echo '<p><a href="/admin/gfx/">click here to continue</a></p>';
		endif;

	}

}
?>