
<?php if(isset($hot_deals) && count($hot_deals) > 0): ?>
<div class='specials hot_deal'>
	<?php foreach($hot_deals as $s): ?>
		<?php
			$image = !empty($s->images[0]) ? $s->images[0] : '';
		?>
		<div class='special-wrap'>
			
			<div class='title'><a href='/member/<?=$s->member_id?>/<?=url_title($s->name)?>'><?=$s->name?></a></div>

			<div class='description'>
				<?=!empty($image->path) ? "<div class='hot-deal-image'><a href='/member/".$s->member_id."/".url_title($s->name)."'><img src='".$this->resize->size($image->path,array('w'=>180,'h'=>180,'scale'=>true))."' border='0' /></a></div>" : ""?>
				<?=nl2br($s->description)?><br /><br />
				<a href='/member/<?=$s->member_id?>/<?=url_title($s->name)?>'><img src='/app/gfx/readmore.gif' onmouseover="this.src='/app/gfx/readmore-on.gif'" onmouseout="this.src='/app/gfx/readmore.gif'" border='0' /></a>
			</div>
			
		</div>
	<?php endforeach; ?>
</div>
<?php endif; ?>
