<div class='cms'>
<h1><?=$page['name']?></h1>

<?=$page['content']?>

<?php 
if(isset($subPages)): 
	foreach($subPages as $subPage):
?>

	<div class='page-group'>
	
		<div class='subImage'><a href='<?=$subPage['link']?>'><img src='<?=$subPage['square']?>' border='0' /></a></div>
	
		<div class='subContent'>
			<h2><?=$subPage['name']?></h2>
			<p><?=$subPage['short_content']?> <a href='<?=$subPage['link']?>' class='more'>more &#155;&#155;</a></p>
		</div>

		<div class='clear'></div>
	
	</div>

<?php
	endforeach;
endif;

if(isset($members) && count($members) > 0):?>
	<div class='members-col'>
<?php
	foreach($members as $member):
		$this->load->view('pages/member',$member);
	endforeach;
?>
	</div>
<?php 
endif;

# loop thru the modules

if(isset($modules) && is_array($modules)):
	foreach($modules as $module):
		echo $module;
	endforeach;
endif;

?>

</div>
