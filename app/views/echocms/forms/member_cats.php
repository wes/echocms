<?php
$directory_listing = isset($form->directory_listing) && $form->directory_listing == 'y' ? true : false;
$meta_title = isset($form->meta_title) ? $form->meta_title : '';
$meta_keywords = isset($form->meta_keywords) ? $form->meta_keywords : '';
$meta_description = isset($form->meta_description) ? $form->meta_description : '';
$name = html_entity_decode(isset($form->name) ? $form->name : '');
$slug = isset($form->slug) ? $form->slug : '';
?>
<div id='form_w'>500</div>
<div id='form_h'>440</div>
<h1>
	<a href='javascript: editWindow.close();' class='close'>Close</a>
	Member Category Details
</h1>
<form enctype='multipart/form-data' method='post' action='/admin/member_cats/save'>
<div class='generic_form'>
	<div class='field checkbox'>
		<?=form_label('Directory Listing','form[directory_listing]')?>
		<?=form_checkbox(array('name'=>'form[directory_listing]','value'=>'y','checked'=>$directory_listing))?>
	</div>
	<div class='field input'>
		<?=form_label('Title','form[name]')?>
		<?=form_input(array('name'=>'form[name]','size'=>35,'value'=>$name,'class'=>'required'))?>
	</div>
	<div class='field input'>
		<?=form_label('Permalink','form[slug]')?>
		<?=form_input(array('name'=>'form[slug]','size'=>35,'value'=>$slug,'class'=>'required','after'=>'No spaces allowed'))?>
	</div>
	<div class='field input'>
		<?=form_label('Meta Title','form[meta_title]')?>
		<?=form_input(array('name'=>'form[meta_title]','size'=>40,'value'=>$meta_title))?>
	</div>
	<div class='field input'>
		<?=form_label('Meta Keywords','form[meta_keywords]')?>
		<?=form_input(array('name'=>'form[meta_keywords]','size'=>40,'value'=>$meta_keywords))?>
	</div>
	<div class='field input'>
		<?=form_label('Meta Description','form[meta_description]')?>
		<?=form_input(array('name'=>'form[meta_description]','size'=>40,'value'=>$meta_description))?>
	</div>

	<div class='field submit'>
		<?=form_submit('mysubmit','Save Category')?>
	</div>
	<?php if(!empty($id)): ?>
		<input type='hidden' name='id' value='<?=$id?>' />
	<?php endif; ?>
</div>
</form>
