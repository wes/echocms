<?php
$status_checked = isset($form->status_checked) && $form->status_checked == 'y' ? true : false;
$parent_id = isset($form->parent_id) ? $form->parent_id : '';
$name = isset($form->name) ? $form->name : '';
$uri_type = isset($form->uri_type) ? $form->uri_type : '';
$url = isset($form->url) ? $form->url : '';
$page_id = isset($form->page_id) ? $form->page_id : '';
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
			<div><button type='submit' class='button xs'>Save Nav</button></div>
		</div>

		<div class='field head'>
			<?=form_label('Title','form[name]')?>
			<?=form_input(array('name'=>'form[name]','class'=>'required page_title','id'=>'pageTitle'),$name,"onkeyup='autoPermalink();'")?> <input type='hidden' id='autoPermaBuilder' checked />
		</div>

		<div class='field head'>
			<?=form_label('Parent','form[parent_id]')?>
			<select name='form[parent_id]'>
				<option value=''>-- Top Level --</option>
				<?php foreach($parents as $p): ?>
					<option value='<?=$p->id?>'<?=!empty($parent_id) && $p->id == $parent_id ? ' selected' : ''?>><?=$p->name?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<div class='field head'>
			<?=form_label('Link Type','form[uri_type]')?>
			<select name='form[uri_type]' id='uri_type_switch'>
			<?php foreach($uri_types as $v): ?>
				<option value='<?=$v?>'<?=!empty($uri_type) && $uri_type == $v ? ' selected' : ''?>><?=strtoupper($v)?></option>
			<?php endforeach; ?>
			</select>
		</div>		
		<div class='field head' id='url_field'>
			<?=form_label('URL','form[url]')?>
			<?=form_input(array('name'=>'form[url]','size'=>45,'value'=>$url))?> <small>Use full http:// if linking to external sites.</small>
		</div>		
		<div class='field head' id='page_field'>
			<?=form_label('Page','form[page_id]')?>
			<select name='form[page_id]'>
			<?php foreach($pages as $p): ?>
				<option value='<?=$p->id?>'<?=!empty($page_id) && $page_id == $p->id ? ' selected' : ''?>><?=$p->name?></option>
			<?php endforeach; ?>
			</select>
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

<script type='text/javascript'>
	function uri_type_switcher(){
		var uri_type = $F('uri_type_switch');
		if(uri_type == 'url'){
			$('url_field').setStyle('display: block');
			$('page_field').setStyle('display: none');
		}else{
			$('url_field').setStyle('display: none');
			$('page_field').setStyle('display: block');
		}
	}
	Event.observe(window,'load',function(){
		uri_type_switcher();
		$('uri_type_switch').observe('change',function(){
			uri_type_switcher();
		});
	});
</script>
