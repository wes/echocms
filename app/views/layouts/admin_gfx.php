<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<title>Taos Ski Valley Administration - Graphics Library</title>
	
	<link rel="stylesheet" href="/app/assets/css/backend/admin_gfx.css" type="text/css" media="screen" charset="utf-8" />
	<link rel="stylesheet" href="/app/assets/css/backend/adminEditWindow.css" type="text/css" media="screen" charset="utf-8" />
	
	<script type="text/javascript" src="/app/assets/js/lib/prototype.js"></script>
	<script type="text/javascript" src="/app/assets/js/lib/scriptaculous/scriptaculous.js"></script>
	<script type="text/javascript" src="/app/assets/js/admin/edit_window.js"></script>
	<script type="text/javascript" src="/app/assets/js/admin/gfx.js"></script>
	
	<script type="text/javascript">
	function insert_file(file_src){
		window.opener.CKEDITOR.tools.callFunction(1, file_src);
		window.close();
	}
	</script>

</head>
<body>

<div id='library'>
	<?=$content_for_layout?>
</div>

<div id='editWindow' style='display: none;'></div>
<div id='editWrap' style='display: none;'>
	<div id='editFrame'></div>
	<div id='editTmpFrame' style='display: none;'></div>
</div>

</body>
</html>