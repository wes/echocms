<div class='cms'>
<h1><?=$nav->name?></h1>

<?php 
if(isset($pages)): 
	foreach($pages as $page):
?>

	<div class='page-group'>

	<div class='subImage'><a href='<?=$page->link?>'><img src='<?=$page->square?>' border='0' /></a></div>
	
	<div class='subContent'>
		<h2><?=$page->name?></h2>
		<p><?=$page->short_content?> <a href='<?=$page->link?>' class='more'>more &#155;&#155;</a></p>
	</div>
	
	<div class='clear'></div>
	
	</div>
	
	<div class='clear'></div>

<?php
	endforeach;
endif;

# loop thru the modules

if(isset($modules) && is_array($modules)):
	foreach($modules as $module):
		echo $module;
	endforeach;
endif;

?>

</div>
