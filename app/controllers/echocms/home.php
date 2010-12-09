<?php

#include('_echo.php');

class Home extends Controller {

	function __construct(){
		parent::Controller();
		if($this->easyauth->connected == false):
			redirect("/login");
		endif;
		$this->easyauth->checkBrowser();
		$this->layout->setLayout('echocms');
	}
	
	function index(){
		$this->layout->view('echocms/home');
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */