<?php
$status_checked = isset($form->status) && $form->status == 'y' ? true : false;
$meta_title = isset($form->meta_title) ? $form->meta_title : '';
$meta_keywords = isset($form->meta_keywords) ? $form->meta_keywords : '';
$meta_description = isset($form->meta_description) ? $form->meta_description : '';
$permalink = isset($form->permalink) ? $form->permalink : '';
$nav_id = isset($form->nav_id) ? $form->nav_id : '';
$parent_id = isset($form->parent_id) ? $form->parent_id : '';
$name = isset($form->name) ? $form->name : '';
$short_content = isset($form->short_content) ? $form->short_content : '';
$content = isset($form->content) ? $form->content : '';
$rank = isset($form->rank) ? $form->rank : '';
$filename = isset($form->filename) ? $form->filename : '';
$urlPart1 = isset($form->urlPart1) ? $form->urlPart1 : '';
$urlPart2 = isset($form->urlPart2) ? $form->urlPart2 : '';
$created = isset($form->created) ? $form->created : date('Y-m-d H:i:s');
$updated = date('Y-m-d H:i:s');
?>

<h1 class='top'>
	Editing Page
</h1>

<form id='pageForm' class='validme' enctype='multipart/form-data' method='post' action='/<?=$this->site_admin?>/pages/save'>

	<input type='hidden' id='excluded_id' value='<?=$excluded_id?>' />
	<input type='hidden' name='form[created]' value='<?=$created?>' />
	<input type='hidden' name='form[updated]' value='<?=$updated?>' />

	<div class='generic-form'>

		<fieldset>
			<legend>Page Options</legend>

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
			<legend>Attributes</legend>
			<div class='field input'>
				<?=form_label('Image File','page_file')?>
				<?=form_upload(array('name'=>'page_file'))?>
				<?php
				if(!empty($filename)):
					echo "
					<div style='padding: 4px;font-size: 12px; font-weight: bold;'>
						<input type='checkbox' name='deletePageImage' value='y' /> Delete Existing Image? &nbsp;&nbsp;&nbsp; <a target='new' href='/uploads/pages/".$id."/".$filename."' />View Image</a>
					</div>
					";
				endif;
				?>
			</div>
		</fieldset>

		<fieldset>
			<legend>Content</legend>
			<div class='field head cms teaser'>
				<?=form_label('Summary','form[short_content]')?>
				<?=form_textarea(array('name'=>'form[short_content]','value'=>$short_content))?>
			</div>
			<div class='field head cms cke'>
				<?=form_label('Full Page Content','form[content]')?>
				<?=form_textarea(array('name'=>'form[content]','value'=>$content,'class'=>'CKEditor'))?>
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
