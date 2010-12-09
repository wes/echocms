<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

include('echocms.php');

class Users extends Echocms {

	function Users(){
		parent::__construct();
		$this->tbl_name = 'users';
		$this->field_list = "id, if(status = 'y','Enabled','Disabled') as Status, name as Name, username as Username, email as Email";
		$this->order_field = 'username asc';
		$this->name = 'User';
		$this->hide_top = true;
		$this->fields = array('status','username','password','name','email');
		$this->top = 'Users';
		$this->noAjax = true;
#		$this->layout->setLayout('admin');
	}
	
}
?>