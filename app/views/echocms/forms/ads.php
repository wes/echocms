<?php
$checked = isset($form->status) && $form->status == 'y' ? true : false;
$feat_event = isset($form->feat_event) && $form->feat_event == 'y' ? true : false;
$name = isset($form->name) ? $form->name : '';
$url = isset($form->url) ? $form->url : '';
$filename = isset($form->filename) ? $form->filename : '';
?>
<div id='form_w'>550</div>
<div id='form_h'>400</div>
<h1>
	<a href='javascript: editWindow.close();' class='close'>Close</a>
	Ad Details
</h1>
<form enctype='multipart/form-data' method='post' action='/admin/ads/save'>
	<div class='field input checkbox'>
		<?=form_label('Enabled','form[status]')?>
		<?=form_checkbox(array('name'=>'form[status]','value'=>'y','checked'=>$checked,'class'=>'required'))?>
	</div>
	<div class='field input checkbox'>
		<?=form_label('Featured Event','form[feat_event]')?>
		<?=form_checkbox(array('name'=>'form[feat_event]','value'=>'y','checked'=>$feat_event))?>
	</div>
	<div class='field input'>
		<?=form_label('Title','form[name]')?>
		<?=form_input(array('name'=>'form[name]','size'=>40,'value'=>$name,'class'=>'required'))?>
	</div>
	<div class='field input'>
		<?=form_label('Link','form[url]')?>
		<?=form_input(array('name'=>'form[url]','size'=>40,'value'=>$url,'class'=>'required'))?>
	</div>
	<div class='field input'>
		<?=form_label('File','ad_file')?>
		<?=form_upload(array('name'=>'ad_file'))?>
		<?php
		if(!empty($filename)):
			echo "<div style='padding: 4px 0 0 100px;font-size: 12px; font-weight: bold;'><a target='new' href='/uploads/ads/".$id."/".$filename."' />View Ad File</a></div>";
		endif;
		?>
	</div>
	<div class='field submit'>
		<?=form_submit('mysubmit','Save Ad')?>
	</div>
	<?php if(!empty($id)): ?>
		<input type='hidden' name='id' value='<?=$id?>' />
	<?php endif; ?>
</form>
