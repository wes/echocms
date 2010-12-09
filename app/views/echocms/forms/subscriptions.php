<?php
$unsubscribed = isset($form->unsubscribed) ? $form->unsubscribed : false;
$created = isset($form->created) ? $form->created : false;
$f_name = isset($form->f_name) ? $form->f_name : '';
$l_name = isset($form->l_name) ? $form->l_name : '';
$email = isset($form->email) ? $form->email : '';
?>
<div id='form_w'>600</div>
<div id='form_h'>400</div>
<h1>
	<a href='javascript: editWindow.close();' class='close'>Close</a>
	Subscription Details
</h1>
<form enctype='multipart/form-data' method='post' action='/admin/users/save'>
	<?php if($created != false): ?>
	<div class='field input checkbox'>
		<?=form_label('Status')?>
		<input type='text' value='<?=$unsubscribed != null ? "<p><small>Unsubscribed on ".date('F jS Y g:i a',strtotime($unsubscribed))."</small></p>" : "Subscribed on ".date('F jS Y g:i a',strtotime($created))?>' size='45' readonly />
	</div>
	<?php endif; ?>
	<div class='clear'></div>
	<div class='field input'>
		<?=form_label('First Name','form[f_name]')?>
		<?=form_input(array('name'=>'form[f_name]','size'=>40,'value'=>$f_name))?>
	</div>
	<div class='field input'>
		<?=form_label('Last Name','form[l_name]')?>
		<?=form_input(array('name'=>'form[l_name]','size'=>40,'value'=>$l_name))?>
	</div>
	<div class='field input'>
		<?=form_label('Email','form[email]')?>
		<?=form_input(array('name'=>'form[email]','size'=>40,'value'=>$email))?>
	</div>
	<div class='field submit'>
		<?=form_submit('mysubmit','Save Subscription')?>
	</div>
	<?php if(!empty($id)): ?>
		<input type='hidden' name='id' value='<?=$id?>' />
	<?php endif; ?>
</form>
