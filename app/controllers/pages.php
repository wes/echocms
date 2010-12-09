<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends Controller {

	function __construct(){
		parent::Controller();
#		$this->output->enable_profiler(true);
		$this->load->model('module');
		$this->load->model('member');
#		$this->output->cache(5);
	}

	function index(){
		
		$nav = $this->uri->segment(2);
		$page1 = $this->uri->segment(3);
		$page2 = $this->uri->segment(4);

		$getSubPages = false;
		$square_settings = array('w'=>54,'h'=>54,'crop'=>true,'scale'=>false);
		
		$this->db->where('pages.status','y');
		
		if(!empty($page2)):
			$this->db->where('pages.permalink',$page2);
			$this->db->where('p1.permalink',$page1);
			$this->db->join('pages as p1','pages.parent_id = p1.id');
		elseif(!empty($page1)):
			$this->db->where('permalink',$page1);
			$getSubPages = true;
		elseif(!empty($nav)):
			redirect('/p/'.$nav);
			exit;
		else:
			redirect('/');
			exit;
		endif;
		
		$this->db->select('pages.id');
		$this->db->select('pages.parent_id');
		$this->db->select('pages.meta_title');
		$this->db->select('pages.filename');
		$this->db->select('pages.meta_keywords');
		$this->db->select('pages.meta_description');
		$this->db->select('pages.permalink');
		$this->db->select('pages.name');
		$this->db->select('pages.content');

#		$this->db->where('permalink',$permalink);
		$page = $this->db->get('pages', 1)->row_array();
		
		$data['page'] = $page;
		
		if($getSubPages == true):
			$this->db->select('id');
			$this->db->select('filename');
			$this->db->select('permalink');
			$this->db->select('name');
			$this->db->select('short_content');
			$this->db->select("concat('/pages/".$nav."/".$data['page']['permalink']."/',permalink) as link", false);
			$this->db->order_by('rank','asc');
			$subPages = $this->db->get_where('pages', array('status'=>'y','parent_id'=>$data['page']['id']))->result_array();
			foreach($subPages as $spKey => $spVal):
				$square_url = '/app/gfx/blank-page-image.jpg';
				if(!empty($spVal['filename'])):
					$sq_url = $this->resize->size('/uploads/pages/'.$spVal['id'].'/'.$spVal['filename'],$square_settings);
					if($sq_url != 'image not found'): $square_url = $sq_url; endif;
				endif;
				$subPages[$spKey]['square'] = $square_url;
			endforeach;
			$data['subPages'] = $subPages;
		endif;
		
		$data['members'] = $this->member->get_by_page($page['id']);
		
		$data['cal1'] = $this->hmt->getMonthView(time());
#		$data['cal2'] = $this->hmt->getMonthView(strtotime('+1 month'));
		
		$this->db->select('modules.name, modules.function');
		$this->db->join('modules','modules.id = module_page_link.module_id');
		$modules = $this->db->get_where('module_page_link',array('module_page_link.page_id'=>$data['page']['id']))->result();

		$this->module->page = $data['page'];
		
		foreach($modules as $module):
			
			$func = $module->function;
			$data['modules'][$func] = $this->module->$func();
			
		endforeach;
		
		$data['meta_title'] = !empty($data['page']['meta_title']) ? $data['page']['meta_title'] : 'Taos Ski Valley Chamber of Commerce';
		$data['meta_description'] = $data['page']['meta_description'];
		$data['meta_keywords'] = $data['page']['meta_keywords'];

		$data['ad'] = $this->ad->get_by_size(177,199);
		
		if(count($data['page']) == 0): 
			$this->layout->view('pages/not-found',$data);
		else:
			$this->layout->view('pages/page',$data);
		endif;
		
	}

}
?>