<?php
$checked = isset($form->status) && $form->status == 'y' ? true : false;
$name = isset($form->name) ? $form->name : '';
$content = isset($form->content) ? $form->content : '';
$slug = isset($form->slug) ? $form->slug : '';
?>
<div id='form_w'>750</div>
<div id='form_h'>500</div>
<h1 class='top'>
	Editing Element Details
</h1>
<form enctype='multipart/form-data' method='post' action='/admin/elements/save'>

	<div class='generic-form'>

	<fieldset>
		<legend>Element Options</legend>
		<div class='field'>
			<?=form_checkbox(array('name'=>'form[status]','value'=>'y','checked'=>$checked))?> <b><small>Enabled?</small></b>
		</div>
		<div class='field head'>
			<?=form_label('Title','form[name]')?>
			<?=form_input(array('name'=>'form[name]','size'=>45,'value'=>$name))?>
		</div>
		<div class='field head'>
			<?=form_label('Element Key','form[slug]')?>
			<?=form_input(array('name'=>'form[slug]','size'=>45,'value'=>$slug))?>
		</div>
		<div class='field head'>
			<?=form_label('Content','form[content]')?>
			<?=form_textarea(array('name'=>'form[content]','cols'=>45,'rows'=>5,'value'=>$content))?>
		</div>
	</fieldset>

	<div class='field submit'>
		<button type='submit' class='button'>Save Element</button>
	</div>

	<?php if(!empty($id)): ?>
		<input type='hidden' name='id' value='<?=$id?>' />
	<?php endif; ?>

	</div>

</form>
