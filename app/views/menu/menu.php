<ul id="nav" class="dropdown dropdown-horizontal">
	<li id="n-dashboard"><a href="/">HOME</a></li>
	<?php foreach($menu as $item): ?>
		<li id="n-<?=$item->slug?>"><a href="/<?=$item->slug != 'business-directory' ? 'pages/' : '' ?><?=$item->slug?>"><?=htmlentities($item->name)?></a>	
		<?php if(count($item->pages) > 0): $first = true; ?>
			<ul>
			<?php if(isset($item->menuImage)): ?>
				<li class='image'><img src='<?=$item->menuImage?>' alt='<?=htmlentities($item->name)?>' border='0' /></li>
			<?php endif; ?>
			<?php foreach($item->pages as $page): ?>
				<li class="<?=(isset($page->sub_pages) && count($page->sub_pages) > 0 ? "dir" : "")?><?=$first==true?" first":""?>">
					<a href="/<?=(isset($page->prefix) ? $page->prefix.'/' : '')?><?=(isset($item->slug) ? $item->slug.'/' : '')?><?=(isset($page->permalink) ? $page->permalink.'/' : '')?>"><?=htmlentities($page->name)?></a>
					<?php if(isset($page->sub_pages) && count($page->sub_pages) > 0): ?>
						<ul>
							<?php foreach ($page->sub_pages as $sub_page): ?>
								<li><a href='/<?=(isset($page->prefix) ? $page->prefix.'/' : '')?><?=(isset($item->slug) ? $item->slug.'/' : '')?><?=(isset($page->permalink) ? $page->permalink.'/' : '')?><?=(isset($sub_page->permalink) ? $sub_page->permalink.'/' : '')?>'><?=htmlentities($sub_page->name)?></a></li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				</li>
			<?php $first = false; endforeach; ?>
			</ul>
		<?php endif; ?>
		</li>
	<?php endforeach; ?>
</ul>
