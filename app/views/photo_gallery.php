<h1>Photo Gallery</h1>
<p>These are the photos found on flickr for the location search on Taos Ski Valley.</p>
<?php
foreach($items['photos']['photo'] as $c):
	print "<a href='http://farm".$c['farm'].".static.flickr.com/".$c['server']."/".$c['id']."_".$c['secret'].".jpg?v=0' class='flickr-box editWindow' title='".$c['title']."'><img class='flickr_imgs corners iradius10' src='http://farm".$c['farm'].".static.flickr.com/".$c['server']."/".$c['id']."_".$c['secret']."_s.jpg?v=0' vspace='5' hspace='5' border='0' /></a>";
endforeach;
?>
<br /><br />