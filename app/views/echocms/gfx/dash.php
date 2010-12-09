
<div id='fileBrowser'>

	<h1 class='top'>
		<div class='close'><button type='button' onclick='window.close();'>Close</button></div>
		<div class='upload'>
			<form id='uploadForm' method='post' enctype='multipart/form-data' action='/admin/gfx/send_files/'><label>Upload File</label>&nbsp;&nbsp;<input type='file' name='upload' onchange="gfx.upload();" /></form>
		</div>
		File Browser
	</h1>

	<div class='clear'></div>

	<div>

		<div>
			<form id='fileBrowserFilter' action='javascript: gfx.filter();'>
				<?=form_label('Show','fileExtension');?>
				<?=form_dropdown('fileExtension',$fileExtensions,$fileExtension,"id='fileExtension'")?>
				<?=form_label('Sort By','sortMethod');?>
				<?=form_dropdown('sortMethod',$sortMethods,$sortMethod,"id='sortMethod'")?>
				<?=form_label('Order By','sortOrder');?>
				<?=form_dropdown('sortOrder',$sortOrders,$sortOrder,"id='sortOrder'")?>
				<button class='sm' type='submit'>GO</button>
			</form>
		</div>
		
		<div id='files'>
			<?=$this->load->view('echocms/gfx/list',array('gfx'=>$gfx))?>
		</div>

		<div class='clear'></div>

	</div>

</div>