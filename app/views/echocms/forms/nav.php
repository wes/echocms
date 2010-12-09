<?php
$status_checked = isset($form->status_checked) && $form->status_checked == 'y' ? true : false;
$name = isset($form->name) ? $form->name : '';
$meta_title = isset($form->meta_title) ? $form->meta_title : '';
$meta_keywords = isset($form->meta_keywords) ? $form->meta_keywords : '';
$meta_description = isset($form->meta_description) ? $form->meta_description : '';
$slug = isset($form->slug) ? $form->slug : '';
$rank = isset($form->rank) ? $form->rank : '';
$filename = isset($form->filename) ? $form->filename : '';
?>
<div id='form_w'>650</div>
<div id='form_h'>400</div>
<h1 class='top'>
	Editing Nav Item
</h1>
<form enctype='multipart/form-data' method='post' action='/admin/nav/save'>

	<div class='generic-form'>

	<fieldset>

		<legend>Navigation Options</legend>

		<div id='publishBox' class='published<?=$status_checked == true ? ' on' : ''?>'>
			<div class='field input checkbox'>
				<?=form_checkbox(array('name'=>'form[status]','id'=>'publishBtn'),'y',$status_checked,"onclick='publishToggle();'")?> Published
			</div>
			<div><button type='submit' class='button xs'>Save Page</button></div>
		</div>

		<div class='field head'>
			<?=form_label('Title','form[name]')?>
			<?=form_input(array('name'=>'form[name]','class'=>'required page_title','id'=>'pageTitle'),$name,"onkeyup='autoPermalink();'")?> <input type='checkbox' id='autoPermaBuilder' checked />
		</div>

		<div class='field head'>
			<?=form_label('Permalink','form[slug]')?>
			<?=form_input(array('name'=>'form[slug]','value'=>$slug,'class'=>'required permalink','id'=>'permaLink','size'=>50))?> <button type='button' onclick="autoPermalink($('permaLink').value);">Convert</button>
		</div>

	</fieldset>

	<fieldset>
		<legend>Meta Tags</legend>
		<div class='field head'>
			<?=form_label('Meta Title','form[meta_title]')?>
			<?=form_input(array('name'=>'form[meta_title]','size'=>45,'value'=>$meta_title))?>
		</div>		
		<div class='field head'>
			<?=form_label('Meta Keywords','form[meta_keywords]')?>
			<?=form_input(array('name'=>'form[meta_keywords]','size'=>45,'value'=>$meta_keywords))?>
		</div>		
		<div class='field head'>
			<?=form_label('Meta Description','form[meta_description]')?>
			<?=form_input(array('name'=>'form[meta_description]','size'=>45,'value'=>$meta_description))?>
		</div>		
	</fieldset>

	<fieldset>
		<legend>Nav Image</legend>
		<div class='field input'>
			<?=form_label('File','nav_file')?>
			<?=form_upload(array('name'=>'nav_file'))?>
			<?php
			if(!empty($filename)):
				echo "
				<div style='padding: 4px;font-size: 12px; font-weight: bold;'><a target='new' href='/uploads/nav/".$id."/".$filename."' />View Image</a></div>
				<div style='padding: 4px;' class='delete_image'><input type='checkbox' name='delete_file' value='y' /> Delete Image?</div>
				";
			endif;
			?>
		</div>
	</fieldset>

	<div class='field submit'>
		<button type='submit' class='button'>Save Navigation</button>
	</div>

	<?php if(!empty($id)): ?>
		<input type='hidden' name='id' value='<?=$id?>' />
	<?php endif; ?>

	</div>

</form>
