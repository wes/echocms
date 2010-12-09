<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>SlickMap CSS Demo</title>
	<link rel="stylesheet" type="text/css" media="screen, print" href="/app/css/slickmap.css" />
	<!--[if lte IE 7]> <link rel="stylesheet" type="text/css" media="screen,print" href="/app/css/slickmap-ie.css" /> <![endif]-->
	<style>
	body { background: #fafafa; margin: 0; padding: 0;  }
	#top { background: #333366; padding: 25px 0 15px 25px; }
	h1 { color: #ffffff; }
	ul, ul ul, ul ul ul { background: none; }
	#main { margin: 40px; }
	</style>
</head>

<body>

	<div id='top'>
	<h1>Taos Ski Valley - Chamber of Commerce - Site Map</h1>
	</div>

	<div id='main'>

	<div class="sitemap">
		
		<ul id="utilityNav">
			<li><a href="/register">Register</a></li>
			<li><a href="/login">Log In</a></li>
			<li><a href="/smap">Site Map</a></li>
		</ul>

		<ul id="primaryNav">
			<li id='home'><a href='/'>Home</a></li>
		<?php foreach($nav as $n): ?>
			<li id="<?=url_title($n->slug)?>"><a href="/p/<?=$n->slug?>"><?=$n->name?></a>
		<?php if(isset($n->pages) && count($n->pages) > 0): ?>
			<ul>
		<?php foreach($n->pages as $page): ?>
				<li><a href='<?=isset($page->prefix) ? '/'.$page->prefix : ''?>/<?=$n->slug?>/<?=isset($page->permalink) ? $page->permalink : ''?>'><?=isset($page->name) ? $page->name : ''?></a>
		<?php if(isset($page->sub_pages) && count($page->sub_pages) > 0): ?>
				<ul>
		<?php foreach($page->sub_pages as $sub_page): ?>
					<li><a href='<?=isset($sub_page->prefix) ? '/'.$sub_page->prefix : ''?>/<?=$page->permalink?>/<?=$sub_page->permalink?>'><?=isset($sub_page->name) ? $sub_page->name : ''?></a></li>
		<?php endforeach; ?>
				</ul>
		<?php endif; ?>
				</li>
		<?php endforeach; ?>
			</ul>
		<?php endif; ?>
			</li>
		<?php endforeach; ?>
		</ul>

	</div>
	
	<div class="notes">
		
		<p>The above sitemap was created from an HTML unordered list with <a href="http://astuteo.com/slickmap">SlickMap CSS.</a></p>
		
	</div>
	
	</div>
	
</body>

</html>