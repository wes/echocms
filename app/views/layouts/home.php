<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<title><?=!empty($meta_title) ? $meta_title : ''?></title>

	<meta name='description' content='<?=!empty($meta_description) ? $meta_description : ''?>' />
	<meta name='keywords' content='<?=!empty($meta_keywords) ? $meta_keywords : ''?>' />
	
	<link rel="stylesheet" href="/app/assets/css/frontend/home.css" type="text/css" media="screen" charset="utf-8" />
	<link rel="stylesheet" href="/app/assets/css/dropdown.css" type="text/css" media="screen" charset="utf-8" />
	<link rel="stylesheet" href="/app/assets/css/menu.css" type="text/css" media="screen" charset="utf-8" />
	<link rel="stylesheet" href="/app/assets/css/editWindow.css" type="text/css" media="screen" charset="utf-8" />
	
	<!--[if IE 6]>
	<link rel='stylesheet' href='/app/assets/css/ie6.css' type='text/css' media='screen' />
	<![endif]-->
	<!--[if IE 7]>
	<link rel='stylesheet' href='/app/assets/css/ie7.css' type='text/css' media='screen' />
	<![endif]-->

	<script type="text/javascript" src="/app/assets/js/lib/prototype.js"></script>
	<script type="text/javascript" src="/app/assets/js/lib/scriptaculous/scriptaculous.js"></script>
	<script type="text/javascript" src="/app/assets/js/lib/lightwindow.js"></script>
	<script type="text/javascript" src="/app/assets/js/edit_window.js"></script>
	<script type="text/javascript" src="/app/assets/js/general.js"></script>

	<link rel='shortcut icon' href='/favicon.ico' type='image/x-icon' />

</head>
<body>

	<div id='main'>

		<div id='top'>

			<div class='wrap'>
	
				<div class='logo'>
					<a href='/'><img src='/app/assets/gfx/logo.png' alt='' border='0' /></a>
				</div>

				<?=$this->load->view('menu/menu',array('menu'=>$menu))?>
	
			</div>

		</div>

		<div class='clear'></div>

		<div id='content'>
			<?=$content_for_layout?>
		</div>

		<div class='clear'></div>
		
		<div id='sub_footer'>
			<div class='inner'>
				<?=$this->load->view('menu/foot',array('menu',$menu))?>
				<p></p>
				<b>&copy; <?=date('Y')?> | All Rights Reserved.</b> 
			</div>
		</div>

		<div id='editWindow' style='display: none;'></div>
		<div id='editFrameClose' style='display: none;'></div>
		<div id='editWrap' style='display: none;'>
			<div id='editFrame'></div>
			<div id='editTmpFrame' style='display: none;'></div>
		</div>

	</div>
	
</body>
</html>