<div id='form_w'>500</div>
<div id='form_h'>340</div>
<h1>
	<a href='javascript: editWindow.close();' class='close'>Close</a>
	Upload Files
</h1>
<div style='margin: 20px;background: url(/app/gfx/admin/upload-files.gif) top right no-repeat;'>
<?=form_open_multipart('/admin/gfx/send_files');?>
	<?php for($i=1;$i<7;$i++): ?>
		<div>
			<?=form_upload(array('name'=>'uploads_'.$i))?>
		</div>
	<?php endfor; ?>
	<div class='field submit'>
		<?=form_submit('mysubmit','Upload Files')?>
	</div>
<?=form_close()?>
</div>