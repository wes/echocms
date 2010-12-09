<?php

class Home extends Controller {

	function __construct(){
		parent::Controller();	
	}
	
	function index(){
		
		$this->layout->view('home');
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */