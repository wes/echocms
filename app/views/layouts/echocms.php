<?php
$url = $this->uri->segment_array();
if(empty($url[2])):$url[2] = '';endif;
$site_admin = $this->config->item('site_admin');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<title>Content Management System</title>
	<meta name='description' content=''>
	<meta name='keywords' content=''>
	
	<link rel="stylesheet" href="/app/assets/css/backend/admin.css" type="text/css" media="screen" charset="utf-8" />
	<link rel="stylesheet" href="/app/assets/css/backend/adminEditWindow.css" type="text/css" media="screen" charset="utf-8" />
	<link rel="stylesheet" href="/app/assets/css/dropdown.css" type="text/css" media="screen" charset="utf-8" />
	<link rel="stylesheet" href="/app/assets/css/backend/default.advanced.css" type="text/css" media="screen" charset="utf-8" />

	<script type="text/javascript" src="/app/assets/js/lib/prototype.js"></script>
	<script type="text/javascript" src="/app/assets/js/lib/scriptaculous/scriptaculous.js"></script>
	<script type="text/javascript" src="/app/plugins/ckeditor/ckeditor.js"></script>

	<script type="text/javascript" src="/app/assets/js/lib/fastinit.js"></script>
	<script type="text/javascript" src="/app/assets/js/lib/tablesort.js"></script>
	
	<script type="text/javascript" src="/app/assets/js/lib/protochart.js"></script>
	<script type="text/javascript" src="/app/assets/js/lib/excanvas.js"></script>

	<script type="text/javascript" src="/app/assets/js/admin/edit_window.js"></script>
	<script type="text/javascript" src="/app/assets/js/admin/general.js"></script>

	<script type="text/javascript" src="/app/assets/js/lib/validme.js"></script>
	
	<link rel='shortcut icon' href='/favicon.ico' type='image/x-icon' />

	<script type='text/javascript'>
		function ckeditorLoad(){
			setTimeout(function(){
				$$('.CKEditor').each(function(s){
					CKEDITOR.replace( s.name ,{
						filebrowserBrowseUrl : '/admin/gfx/',
						filebrowserUploadUrl : '/admin/gfx/send_files/',
						filebrowserWindowWidth : '850',
        				filebrowserWindowHeight : '500',
						height: 500,
						toolbar : [
        					['Styles','Format','Cut','Copy','Paste','PasteText','PasteFromWord','Link','Unlink','Anchor','Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat','Source','-','SpellChecker'],
        					'/',
							['Bold','Italic','Strike','NumberedList','BulletedList','-','Outdent','Indent','Blockquote','Image','Table','HorizontalRule','SpecialChar','PageBreak'],
        				]
					});
				});
			},800);
		}
	</script>

</head>

<body onload='ckeditorLoad();'>

<?php $msg = $this->session->flashdata('msg'); ?>

<?php if(!empty($msg['title'])): ?>
	<div class='msg <?=isset($msg['class'])?$msg['class']:'good'?>'><h1><?=$msg['title']?></h1><?=isset($msg['desc'])?'<p>'.$msg['desc'].'</p>':''?></div>
<?php endif; ?>

<div id='top'>

	<div id='login_info'>
		<span class='welcome'>Welcome</span> <b><?=$_SESSION['login']['user_full_name']?></b> <span class='divider'>|</span> <a href='/<?=$site_admin?>/logout'>Logout</a> <span class='divider'>|</span> <a href="javascript: editWindow.load_url('/<?=$site_admin?>/help');">Help!</a>
	</div>

	<ul id="nav" class="dropdown dropdown-horizontal">
		<li id="n-dashboard"><a href="/<?=$site_admin?>/">Dashboard</a></li>
		<li id="n-pages"><a href="/<?=$site_admin?>/pages">Content</a>
			<ul>
				<li><a href="/<?=$site_admin?>/nav">Navigation</a>
					<ul>
						<li class="first"><a href="/<?=$site_admin?>/nav/add">Create New Navigation</a></li>
						<li><a href="/<?=$site_admin?>/nav">Browse Navigation</a></li>
					</ul>
				</li>
				<li class="first"><a href="/<?=$site_admin?>/pages/">Pages</a>
					<ul>
						<li class="first"><a href="/<?=$site_admin?>/pages/add/">Create New Page</a></li>
						<li><a href="/<?=$site_admin?>/pages">Browse Pages</a></li>
					</ul>
				</li>
				<li class="first"><a href="/<?=$site_admin?>/posts/">Blog Posts</a>
					<ul>
						<li class="first"><a href="/<?=$site_admin?>/posts/add/">Create New Post</a></li>
						<li><a href="/<?=$site_admin?>/posts">Browse Posts</a></li>
					</ul>
				</li>
				<li><a href="/<?=$site_admin?>/elements">Elements</a>
					<ul>
						<li class="first"><a href="/<?=$site_admin?>/elements/add">Create New Element</a></li>
						<li><a href="/<?=$site_admin?>/elements/">Browse Elements</a></li>
					</ul>
				</li>
			</ul>
		</li>
		<li id="n-file-browser"><a href='#' onclick='window.open("/<?=$site_admin?>/gfx/","Taos Ski Valley File Browser","menubar=1,resizable=1,width=850,height=500,scrollbars=1");'>Graphics Library</a>
			<ul>
				<li class='first'><a href='#' onclick='window.open("/<?=$site_admin?>/gfx/","File Browser","menubar=1,resizable=1,width=850,height=500,scrollbars=1");'>Browse Files</a></li>
			</ul>
		</li>
		<li id="n-settings"><a href="/<?=$site_admin?>/users">Users</a>
			<ul>
				<li class="first"><a href="/<?=$site_admin?>/users">Browse Users</a>
					<ul>
						<li class='first'><a href="/<?=$site_admin?>/users/add">Create New User</a></li>
					</ul>
				</li>
			</ul>
		</li>
	</ul>

	<div class='clear'></div>

</div>

<div id='main'>
	<div class='page'>
		<?=$content_for_layout?>
	</div>
</div>

<div id='footer'>
	<b>EchoCMS</b> Content Management System
</div>

<div id='editWindow' style='display: none;'></div>
<div id='editWrap' style='display: none;'>
	<div id='editFrame'></div>
	<div id='editTmpFrame' style='display: none;'></div>
</div>

</body>
</html>