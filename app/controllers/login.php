<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends Controller {

	function Login(){
		parent::Controller();
	}

	function index(){
		$this->load->view('login');
	}

}
?>
