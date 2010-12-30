<ul id="nav" class="dropdown dropdown-horizontal">
	<li id="n-dashboard"><a href="/">HOME</a></li>
	<?php foreach($menu as $item): ?>
		<li id="n-<?=$item->permalink?>"><a href="/<?=$item->permalink != 'business-directory' ? 'pages/' : '' ?><?=$item->permalink?>"><?=htmlentities($item->name)?></a>	
		<?php if(count($item->subs) > 0): $first = true; ?>
			<ul>
			<?php if(isset($item->menuImage)): ?>
				<li class='image'><img src='<?=$item->menuImage?>' alt='<?=htmlentities($item->name)?>' border='0' /></li>
			<?php endif; ?>
			<?php foreach($item->subs as $sub): ?>
				<li class="<?=(isset($sub->sub_pages) && count($sub->sub_pages) > 0 ? "dir" : "")?><?=$first==true?" first":""?>">
					<a href="/<?=(isset($sub->prefix) ? $sub->prefix.'/' : '')?><?=(isset($sub->permalink) ? $sub->permalink.'/' : '')?><?=(isset($sub->permalink) ? $sub->permalink.'/' : '')?>"><?=htmlentities($sub->name)?></a>
				</li>
			<?php $first = false; endforeach; ?>
			</ul>
		<?php endif; ?>
		</li>
	<?php endforeach; ?>
</ul>
