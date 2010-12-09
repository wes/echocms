<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

include('echocms.php');

class Elements extends Echocms {

	function __construct(){
		parent::__construct();
		$this->tbl_name = 'elements';
		$this->field_list = "id, if(status = 'y','Enabled','Disabled') as Status, name as Title";
		$this->search_fields = array('name');
		$this->order_field = 'name asc';
		$this->name = 'Element';
		$this->hide_top = true;
		$this->fields = array('status','name','content','slug');
		$this->top = 'Elements';
		$this->noAjax = true;
	}
	
}
?>