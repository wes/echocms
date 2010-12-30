<?php  

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Layout {

	var $obj;
	var $layout;

	function Layout($layout = "home"){
   		$this->obj =& get_instance();
		$this->layout = $layout;
		$this->obj->load->helper('url');
	}

	function setLayout($layout){
		$this->layout = $layout;
	}

	function view($view, $data=null, $return=false){

		if(is_object($data)):
			if(empty($data->meta_title)):
				$data->meta_title = '';
			endif;
		endif;
		if(is_array($data)):
			if(empty($data['meta_title'])):
				$data['meta_title'] = '';
			endif;
		endif;
		
		$loadedData['content_for_layout'] = $this->obj->load->view($view,$data,true);
		if(isset($this->obj->testimonials)):
			$loadedData['quote'] = $this->obj->testimonials->get_random();
		endif;

		$loadedData['current_url'] = current_url();
		
		$loadedData['menu'] = $this->obj->navigation->get_menu();
		
		if($return):
			$output = $this->obj->load->view('layouts/'.$this->layout, $loadedData, true);
			return $output;
		else:
			$this->obj->load->view('layouts/'.$this->layout, $loadedData, false);
		endif;
	}
	
}

?>