<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class P extends Controller {

	function __construct(){
		parent::Controller();
#		$this->output->cache(5);
	}

	function index(){
		
		$nav_slug = $this->uri->segment(2);
		
		$square_settings = array('w'=>54,'h'=>54,'crop'=>true,'scale'=>false);
		
		$nav = $this->db->get_where('nav', array('slug'=>$nav_slug), 1)->row();
		
		$this->db->select('id');
		$this->db->select('filename');
		$this->db->select('permalink');
		$this->db->select('name');
		$this->db->select('short_content');
		$this->db->select("concat('/pages/".$nav->slug."/',permalink) as link", false);
		$this->db->order_by('rank','asc');

		$pages = $this->db->get_where('pages', array('status'=>'y','nav_id'=>$nav->id,'parent_id'=>0))->result();
		foreach($pages as $k => $v):
			$square_url = '/app/gfx/blank-page-image.jpg';
			if(!empty($v->filename)):
				$sq_url = $this->resize->size('/uploads/pages/'.$v->id.'/'.$v->filename,$square_settings);
				if($sq_url != 'image not found'): $square_url = $sq_url; endif;
			endif;
			$pages[$k]->square = $square_url;
		endforeach;

		$data['nav'] = $nav;
		$data['pages'] = $pages;
		$data['cal1'] = $this->hmt->getMonthView(time());
#		$data['cal2'] = $this->hmt->getMonthView(strtotime('+1 month'));

		$data['ad'] = $this->ad->get_by_size(177,199);

		$data['meta_title'] = !empty($nav->meta_title) ? $nav->meta_title : 'Taos Ski Valley Chamber of Commerce';
		$data['meta_description'] = $nav->meta_description;
		$data['meta_keywords'] = $nav->meta_keywords;

		$this->layout->view('pages/nav_list',$data);
		
	}

}
?>