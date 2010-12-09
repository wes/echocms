<?php
$status_checked = isset($form->status) && $form->status == 'y' ? true : false;
$hot_deals = isset($form->hot_deals) && $form->hot_deals == 'y' ? true : false;
$name = isset($form->name) ? $form->name : '';
$description = isset($form->description) ? $form->description : '';
$member_id = isset($form->member_id) ? $form->member_id : '';
$created = isset($form->created) ? $form->created : date('Y-m-d H:i:s');
$updated = date('Y-m-d H:i:s');
?>

<div id='form_w'>550</div>
<div id='form_h'>500</div>
<h1>
	<a href='javascript: editWindow.close();' class='close'>Close</a>
	Member Special
</h1>
<form enctype='multipart/form-data' method='post' action='/admin/member_specials/save'>

	<input type='hidden' name='form[created]' value='<?=$created?>' />
	<input type='hidden' name='form[updated]' value='<?=$updated?>' />

	<div class='generic-form'>

		<div class='field input checkbox'>
			<?=form_checkbox(array('name'=>'form[status]'),'y',$status_checked)?> Published
		</div>
		<div class='field input checkbox'>
			<?=form_checkbox(array('name'=>'form[hot_deals]'),'y',$hot_deals)?> Hot Deals
		</div>
		<div class='field head'>
			<?=form_label('Title','form[name]')?>
			<?=form_input(array('name'=>'form[name]','class'=>'required page_title'),$name)?>
		</div>
		<div class='field head'>
			<?=form_label('Member','form[member_id]')?>
			<?php #debug($members); ?>
			<?=form_dropdown('form[member_id]',$members,$member_id)?>
		</div>
		<div class='field'>
			<?=form_label('Description','form[description]')?>
			<?=form_textarea(array('name'=>'form[description]','value'=>$description,'style'=>'height: 80px;'))?>
		</div>

		<div class='field submit'>
			<?=form_submit('mysubmit','Save Member Special')?>
		</div>

		<?php if(!empty($id)): ?>
			<input type='hidden' name='id' value='<?=$id?>' />
		<?php endif; ?>

	</div>

</form>
