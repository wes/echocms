<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Help extends Controller {

	function __construct(){
		parent::Controller();
	}

	function index(){
		echo "Help info goes here.";
	}

}
?>