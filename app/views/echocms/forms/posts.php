<?php
$status_checked = isset($form->status) && $form->status == 'y' ? true : false;
$meta_title = isset($form->meta_title) ? $form->meta_title : '';
$meta_keywords = isset($form->meta_keywords) ? $form->meta_keywords : '';
$meta_description = isset($form->meta_description) ? $form->meta_description : '';
$permalink = isset($form->permalink) ? $form->permalink : '';
$title = isset($form->title) ? $form->title : '';
$body = isset($form->body) ? $form->body : '';
$short_body = isset($form->short_body) ? $form->short_body : '';
$created = isset($form->created) ? $form->created : date('Y-m-d H:i:s');
?>

<h1 class='top'>
	Editing Blog Post
</h1>

<form id='pageForm' class='validme' enctype='multipart/form-data' method='post' action='/<?=$this->site_admin?>/posts/save'>

	<input type='hidden' name='form[created]' value='<?=$created?>' />

	<div class='generic-form'>

		<fieldset>
		
			<legend>Post Options</legend>

			<div id='publishBox' class='published<?=$status_checked == true ? ' on' : ''?>'>
				<div class='field input checkbox'>
					<?=form_checkbox(array('name'=>'form[status]','id'=>'publishBtn'),'y',$status_checked,"onclick='publishToggle();'")?> Published
				</div>
				<div><button type='submit' class='button xs'>Save Post</button></div>
			</div>

			<div class='field head'>
				<?=form_label('Title','form[title]')?>
				<?=form_input(array('name'=>'form[title]','class'=>'required page_title','id'=>'pageTitle'),$title,"onkeyup='autoPermalink();'")?> <input type='checkbox' id='autoPermaBuilder' checked />
			</div>
	
			<div class='field head'>
				<?=form_label('Permalink','form[permalink]')?>
				<?=form_input(array('name'=>'form[permalink]','value'=>$permalink,'class'=>'required permalink','id'=>'permaLink','size'=>50))?> <button type='button' onclick="autoPermalink($('permaLink').value);">Convert</button>
			</div>

		</fieldset>

		<fieldset>
		
			<legend>Search Engine Optimization</legend>

			<div class='field meta'>
				<?=form_label('Meta Title','form[meta_title]')?>
				<?=form_input(array('name'=>'form[meta_title]','size'=>35,'value'=>$meta_title))?>
			</div>
			<div class='field meta'>
				<?=form_label('Meta Keywords','form[meta_keywords]')?>
				<?=form_textarea(array('name'=>'form[meta_keywords]','value'=>$meta_keywords))?>
			</div>
			<div class='field meta'>
				<?=form_label('Meta Description','form[meta_description]')?>
				<?=form_textarea(array('name'=>'form[meta_description]','value'=>$meta_description))?>
			</div>
		</fieldset>
		
		<fieldset>
			<legend>Content</legend>
			<div class='field head cms teaser'>
				<?=form_label('Summary','form[short_body]')?>
				<?=form_textarea(array('name'=>'form[short_body]','value'=>$short_body))?>
			</div>
			<div class='field head cms cke'>
				<?=form_label('Body','form[body]')?>
				<?=form_textarea(array('name'=>'form[body]','value'=>$body,'class'=>'CKEditor'))?>
			</div>
		</fieldset>
	
		<div class='field submit'>
			<button type='submit' class='button green'>Save Page</button>
		</div>

		<?php if(!empty($id)): ?>
			<input type='hidden' name='id' value='<?=$id?>' />
		<?php endif; ?>

	</div>

</form>
