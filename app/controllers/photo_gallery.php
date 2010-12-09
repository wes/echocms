<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Photo_gallery extends Controller {

	function classname(){
		parent::Controller();
	}

	function Index(){
		
		$this->load->library('flickr');
		
#		$cur_page = $this->uri->segment(1);
#		debug($cur_page);
		
		$data['items'] = $this->flickr->do_request(array(
			'text'=>'taos ski valley',
			'safe_search'=>1,
			'lat'=>36.591549,
			'lon'=>-105.462227,
			'safe_search'=>1,
			'accuracy'=>5,
			'content_type'=>1
		));
		
#		debug($data);
		
		$this->layout->view('photo_gallery',$data);
		
	}

}
?>