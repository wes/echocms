<?php
$f_name = isset($form->f_name) ? $form->f_name : '';
$l_name = isset($form->l_name) ? $form->l_name : '';
$address = isset($form->address) ? $form->address : '';
$city = isset($form->city) ? $form->city : '';
$state = isset($form->state) ? $form->state : '';
$zip = isset($form->zip) ? $form->zip : '';
$email = isset($form->email) ? $form->email : '';
?>
<div id='form_w'>500</div>
<div id='form_h'>500</div>
<h1>
<a href='javascript: editWindow.close();' class='close'>Close</a>
Vacation Guide Request
</h1>

<div class='field input'>
	<?=form_label('First Name','form[f_name]')?>
	<?=form_input(array('f_name'=>'form[f_name]','size'=>40,'value'=>$f_name))?>
</div>
<div class='field input'>
	<?=form_label('Last Name','form[l_name]')?>
	<?=form_input(array('l_name'=>'form[l_name]','size'=>40,'value'=>$l_name))?>
</div>
<div class='field input'>
	<?=form_label('Email','form[email]')?>
	<?=form_input(array('l_name'=>'form[email]','size'=>40,'value'=>$email))?>
</div>
<div class='field input'>
	<?=form_label('Address','form[address]')?>
	<?=form_input(array('name'=>'form[address]','size'=>40,'value'=>$address))?>
</div>
<div class='field input'>
	<?=form_label('City','form[city]')?>
	<?=form_input(array('name'=>'form[city]','size'=>40,'value'=>$city))?>
</div>
<div class='field input'>
	<?=form_label('State','form[state]')?>
	<?=form_input(array('name'=>'form[state]','size'=>40,'value'=>$state))?>
</div>
<div class='field input'>
	<?=form_label('Zip','form[zip]')?>
	<?=form_input(array('name'=>'form[zip]','size'=>40,'value'=>$zip))?>
</div>

