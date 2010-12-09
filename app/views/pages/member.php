
	<div class='page-group'>
	
		<div class='subImage'><?=!empty($url)?"<a href='".$url."' target='new'>":""?><img src='<?=$image?>' border='0' /><?=!empty($url)?"</a>":""?></div>
	
		<div class='subContent'>
			<h2><?=!empty($url)?"<a href='".$url."' target='new'>":""?><?=$name?><?=!empty($url)?"</a>":""?></h2>
			<p><?=$feat_text?></p>
			<p><a href='/member/<?=$id?>/<?=url_title($name)?>' class='more'>more &#155;&#155;</a></p>
		</div>

		<div class='clear'></div>
	
	</div>
