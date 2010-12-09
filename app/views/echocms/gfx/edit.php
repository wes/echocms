<div id='form_w'>500</div>
<div id='form_h'>350</div>

<h1>
	<a href='javascript: editWindow.close();' class='close'>Close</a>
	File Details
</h1>

<?=form_open('/admin/gfx/save/'.$id)?>

<div class='thumb'>
	<a href='<?=str_replace($_SERVER['DOCUMENT_ROOT'],'',$this->upload_path).$filename?>' target='new'><img src='<?=$thumb?>' border='0' /></a>
	<div><button class='sm' type='button' onclick='gfx.del(<?=$id?>);'>DELETE</button></div>
</div>

<div class='field'>
<?=form_label('Title / Caption','title')?>
<?=form_input(array('name'=>'title','value'=>$title))?>
</div>

<div class='field'>
<?=form_label('Filename','filename')?>
<?=form_input(array('name'=>'filename','readonly'=>true,'value'=>$filename))?>
</div>

<div class='field'>
<?=form_label('Width','width')?>
<?=form_input(array('name'=>'width','readonly'=>true,'value'=>$width))?>
</div>

<div class='field'>
<?=form_label('Height','height')?>
<?=form_input(array('name'=>'height','readonly'=>true,'value'=>$height))?>
</div>

<div class='field'>
	<button type='submit'>Save File Details</button>
</div>

<?=form_close()?>