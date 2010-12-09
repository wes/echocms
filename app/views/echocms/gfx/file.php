<div class='file' id='file_<?=$id?>'>
	<div><img src='<?=$thumb?>' border='0' onclick="editWindow.load_url('/admin/gfx/edit/<?=$id?>');" /></div>
	<div class='caption'><?=$caption?></div>
	<div class='tools'><button onclick="insert_file('<?=$path?>');">+file</button> <button onclick="insert_file('<?=$link?>');">+link</button> <button onclick="editWindow.load_url('/admin/gfx/edit/<?=$id?>');">edit</button> <button onclick="gfx.del(<?=$id?>);">del</button></div>
</div>