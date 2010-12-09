<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

include('_echo.php');

class Subscriptions extends Echo {

	function __construct(){
		
		parent::Echo();
		
		$this->tbl_name = 'subscriptions';
		$this->field_list = "
		id, 
		if(unsubscribed = NULL,'Enabled','Disabled') as Status, 
		concat(f_name, ' ', l_name) as Name, 
		email as Email,
		created as Created
		";
		$this->order_field = 'Name asc';
		$this->name = 'Ad';
		$this->hide_top = true;
		$this->fields = array(
			'status',
			'featured',
			'non_member',
			'name',
			'address',
			'address2',
			'city',
			'state',
			'zip',
			'phone',
			'fax',
			'email',
			'open',
			'hrsummer',
			'hrwinter',
			'description',
			'feat_text',
			'url',
			'password'
		);
		$this->top = 'Subscriptions';
		$this->layout->setLayout('admin');
	}
	
	function excel_export(){
		$this->load->plugin('to_excel');
		$this->db->select('*');
		$data = $this->db->get('subscriptions');
		to_excel($data,'Subscription-Export');
	}
	
	
}
?>