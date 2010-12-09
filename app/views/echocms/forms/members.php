<?php
$status = isset($form->status) && $form->status == 'y' ? true : false;
$featured = isset($form->featured) && $form->featured == 'y' ? true : false;
$non_member = isset($form->non_member) && $form->non_member == 'y' ? true : false;
$name = isset($form->name) ? $form->name : '';
$address = isset($form->address) ? $form->address : '';
$address2 = isset($form->address2) ? $form->address2 : '';
$city = isset($form->city) ? $form->city : '';
$state = isset($form->state) ? $form->state : '';
$zip = isset($form->zip) ? $form->zip : '';
$phone = isset($form->phone) ? $form->phone : '';
$phone2 = isset($form->phone2) ? $form->phone2 : '';
$fax = isset($form->fax) ? $form->fax : '';
$email = isset($form->email) ? $form->email : '';
$open = isset($form->open) ? $form->open : '';
$hrsummer = isset($form->hrsummer) ? $form->hrsummer : '';
$hrwinter = isset($form->hrwinter) ? $form->hrwinter : '';
$description = isset($form->description) ? $form->description : '';
$feat_text = isset($form->feat_text) ? $form->feat_text : '';
$url = isset($form->url) ? $form->url : '';
$password = isset($form->password) ? $form->password : '';
?>
<h1>Member Details</h1>
<form enctype='multipart/form-data' method='post' action='/admin/members/save'>
	<div class='generic-form'>

	<fieldset>
		<legend>Member Images</legend>
		<div id='imgsSort'>
			<?php if(isset($images)): foreach($images as $image): ?>
				<img src='<?=$image->thumb?>' border='0' style='border: 1px solid #cccccc;' class='imgGals' id='im_<?=$image->id?>' alt='<?=$image->id?>' hspace='6' vspace='6' />
			<?php endforeach; endif; ?>
		</div>
		<div id='imageUpload'>
			
			<fieldset>
				<legend>Upload new images</legend>
				<div id='trash' style='float: right; margin: 5px;'><img id='trashCan' src='/app/gfx/admin/trash.gif' border='0' /></div>
				<p class='note'>
					Drag'n drop to set sorting preference.<br />
					Drag image to trash to remove
				</p>
				<div style='padding: 2px'><input type='file' name='image1' /></div>
				<div style='padding: 2px'><input type='file' name='image2' /></div>
				<div style='padding: 2px'><input type='file' name='image3' /></div>
			</fieldset>

		</div>
	</fieldset>

	<fieldset>
		<legend>Member Options</legend>
		
		<div class='right-col member-cats'>
			<?=form_label('Categories','form[categories]')?>
			<select name='form[categories][]' size='20' multiple>
				<?php foreach($categories as $c): ?>
					<option value='<?=$c->id?>'<?=isset($c->selected) && $c->selected == 'y' ? ' selected' : ''?>><?=$c->name?></option>
				<?php endforeach; ?>
			</select>
		</div>

		<div class='field checkbox left'>
			<?=form_label('Enabled','form[status]')?>
			<?=form_checkbox(array('name'=>'form[status]','value'=>'y','checked'=>$status))?>
		</div>
		<div class='field checkbox left'>
			<?=form_label('Featured','form[featured]')?>
			<?=form_checkbox(array('name'=>'form[featured]','value'=>'y','checked'=>$featured))?>
		</div>
		<div class='field checkbox left'>
			<?=form_label('Non-Member','form[non_member]')?>
			<?=form_checkbox(array('name'=>'form[non_member]','value'=>'y','checked'=>$non_member))?>
		</div>
		
		<div class='clear-left'></div>
		
		<div class='field head'>
			<?=form_label('Name','form[name]')?>
			<?=form_input(array('name'=>'form[name]','size'=>45,'value'=>$name))?>
		</div>
		<div class='field head'>
			<?=form_label('Address','form[address]')?>
			<?=form_input(array('name'=>'form[address]','size'=>45,'value'=>$address))?>
		</div>
		<div class='field head'>
			<?=form_label('Address 2','form[address2]')?>
			<?=form_input(array('name'=>'form[address2]','size'=>45,'value'=>$address2))?>
		</div>
		<div class='field head'>
			<?=form_label('City','form[city]')?>
			<?=form_input(array('name'=>'form[city]','size'=>45,'value'=>$city))?>
		</div>
		<div class='field head'>
			<?=form_label('State','form[state]')?>
			<?=form_input(array('name'=>'form[state]','size'=>45,'value'=>$state))?>
		</div>
		<div class='field head'>
			<?=form_label('Zip','form[zip]')?>
			<?=form_input(array('name'=>'form[zip]','size'=>45,'value'=>$zip))?>
		</div>
		<div class='field head'>
			<?=form_label('Phone','form[phone]')?>
			<?=form_input(array('name'=>'form[phone]','size'=>45,'value'=>$phone))?>
		</div>
		<div class='field head'>
			<?=form_label('Phone 2','form[phone2]')?>
			<?=form_input(array('name'=>'form[phone2]','size'=>45,'value'=>$phone2))?>
		</div>
		<div class='field head'>
			<?=form_label('Email','form[email]')?>
			<?=form_input(array('name'=>'form[email]','size'=>45,'value'=>$email))?>
		</div>
		<div class='field head'>
			<?=form_label('URL','form[url]')?>
			<?=form_input(array('name'=>'form[url]','size'=>45,'value'=>$url))?>
		</div>
		<div class='field head'>
			<?=form_label('Password','form[password]')?>
			<?=form_input(array('name'=>'form[password]','size'=>45))?>
		</div>

		<div class='field head'>
			<?=form_label('Featured Description','form[feat_text]')?>
			<?=form_textarea(array('name'=>'form[feat_text]','cols'=>70,'rows'=>4,'value'=>$feat_text,'class'=>'mceEditor'))?>
		</div>

		<div class='field head'>
			<?=form_label('Description','form[description]')?>
			<?=form_textarea(array('name'=>'form[description]','cols'=>70,'rows'=>5,'value'=>$description,'class'=>'mceEditor'))?>
		</div>

	</fieldset>

	<div class='field submit'>
		<?=form_submit('mysubmit','Save Member')?>
	</div>

	<?php if(!empty($id)): ?>
		<input type='hidden' name='id' value='<?=$id?>' />
	<?php endif; ?>

	</div>

</form>
