<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<title><?=$meta_title?></title>

	<meta name='description' content='<?=$meta_description?>' />
	<meta name='keywords' content='<?=$meta_keywords?>' />
	
	<link rel="stylesheet" href="/assets/app/css/home.css" type="text/css" media="screen" charset="utf-8" />
	<link rel="stylesheet" href="/assets/app/css/dropdown.css" type="text/css" media="screen" charset="utf-8" />
	<link rel="stylesheet" href="/assets/app/css/menu.css" type="text/css" media="screen" charset="utf-8" />
	<link rel="stylesheet" href="/assets/app/css/editWindow.css" type="text/css" media="screen" charset="utf-8" />
	
	<!--[if IE 6]>
	<link rel='stylesheet' href='/assets/app/css/ie6.css' type='text/css' media='screen' />
	<![endif]-->
	<!--[if IE 7]>
	<link rel='stylesheet' href='/assets/app/css/ie7.css' type='text/css' media='screen' />
	<![endif]-->

	<script type="text/javascript" src="/assets/app/js/lib/prototype.js"></script>
	<script type="text/javascript" src="/assets/app/js/lib/scriptaculous/scriptaculous.js"></script>
	<script type="text/javascript" src="/assets/app/js/lib/lightwindow.js"></script>
	<script type="text/javascript" src="/assets/app/js/edit_window.js"></script>
	<script type="text/javascript" src="/assets/app/js/general.js"></script>

	<link rel='shortcut icon' href='/favicon.ico' type='image/x-icon' />

</head>
<body>

	<div id='top'>

		<div class='wrap'>
	
			<div class='logo'>
				<a href='/'><img src='/app/gfx/logo.png' alt='' border='0' /></a>
			</div>

			<?=$this->load->view('menu/menu',array('menu'=>$menu))?>
	
		</div>

	</div>

	<div id='content'>
		<?=$content_for_layout?>
	</div>

	<div id='sub_footer'>
		<div class='inner'>
			<p><?=$welcomeText?></p>
			<?=$this->load->view('menu/foot',array('menu',$menu))?>
		</div>
	</div>

	<div id='footer'>
		<p></p>
		<b>&copy; <?=date('Y')?> | All Rights Reserved.</b> 
	</div>

	<div id='editWindow' style='display: none;'></div>
	<div id='editFrameClose' style='display: none;'></div>
	<div id='editWrap' style='display: none;'>
		<div id='editFrame'></div>
		<div id='editTmpFrame' style='display: none;'></div>
	</div>
	
</body>
</html>