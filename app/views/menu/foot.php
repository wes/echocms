<div id='footer_nav'>

	<ul id="nav" class="dropdown dropdown-horizontal">
		<li id="n-dashboard"><a href="/">HOME</a></li>
		<?php foreach($menu as $item): ?>
			<li id="n-<?=$item->permalink?>"><a href="/pages/<?=$item->permalink?>"><?=htmlentities($item->name)?></a></li>
		<?php endforeach; ?>
	</ul>
	
	<div class='clear'></div>

</div>