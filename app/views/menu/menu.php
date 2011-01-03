<div id='nav-wrap'>
	<ul id="nav" class="dropdown dropdown-horizontal">
		<li id="n-dashboard"><a href="/">HOME</a></li>
		<?php foreach($menu as $item): ?>
			<li id="n-<?=$item->permalink?>"><a href="/pages/<?=$item->permalink?>"><?=htmlentities($item->name)?></a>	
			<?php if(count($item->subs) > 0): $first = true; ?>
				<?php if(!empty($item->subs) && count($item->subs) > 0): ?>
					<ul class='subs'>
						<?php foreach($item->subs as $sub): ?>
							<li class="sub-item">
								<a href="/pages/<?=$sub->permalink?>"><?=htmlentities($sub->name)?></a>
							</li>
						<?php $first = false; endforeach; ?>
					</ul>
				<?php endif; ?>
			<?php endif; ?>
			</li>
		<?php endforeach; ?>
	</ul>
	<div class='clear'></div>
</div>