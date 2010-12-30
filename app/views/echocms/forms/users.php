<?php
$checked = isset($form->status) && $form->status == 'y' ? true : false;
$name = isset($form->name) ? $form->name : '';
$username = isset($form->username) ? $form->username : '';
$password = isset($form->password) ? $form->password : '';
$email = isset($form->email) ? $form->email : '';
?>
<h1 class='top'>
	Editing User
</h1>
<div class='generic-form'>
<fieldset>
	<legend>User Options</legend>
	<form enctype='multipart/form-data' method='post' action='/admin/users/save'>
		<div class='field'>
			<?=form_checkbox(array('name'=>'form[status]','value'=>'y','checked'=>$checked))?> <b><small>Enabled?</small></b>
		</div>
		<div class='field input'>
			<?=form_label('Full Name','form[name]')?>
			<?=form_input(array('name'=>'form[name]','size'=>40,'value'=>$name))?>
		</div>
		<div class='field input'>
			<?=form_label('Email','form[email]')?>
			<?=form_input(array('name'=>'form[email]','size'=>40,'value'=>$email))?>
		</div>
		<div class='field input'>
			<?=form_label('Username','form[username]')?>
			<?=form_input(array('name'=>'form[username]','size'=>30,'value'=>$username))?>
		</div>
		<div class='field input'>
			<?=form_label('Password','form[password]')?>
			<?=form_input(array('name'=>'form[password]','size'=>18,'type'=>'password'))?>&nbsp;<small>Leave password blank if you do not want to change it.</small>
		</div>
		<div class='field submit'>
			<button type='submit' class='button'>Save User</button>
		</div>
		<?php if(!empty($id)): ?>
			<input type='hidden' name='id' value='<?=$id?>' />
		<?php endif; ?>
	</form>
</fieldset>
</div>