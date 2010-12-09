<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends Controller {

	function __construct(){
		parent::Controller();
	}

	function index(){
		$this->easyauth->logout();
		redirect("/login/");
	}

}
?>