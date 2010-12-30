<?php 
#debug($this->uri);
#$urlBase = 'admin'.isset($this->uri->segment(2)) ? '/'.$this->uri->segment(2) : '');
#$urlBase = implode($this->uri->segment

$urlBase = implode('/',$this->uri->segments);
$colCount = 0;

if(isset($top)):
	echo "
	<h1 class='top'>
		<div class='search'>
			<form method='post' action='/admin/".$this->tbl_name."'>
				<input type='text' name='searchQ' size='25' value='".$searchQ."' /> <button type='submit' class='button'>Search</button>
			</form>
		</div>
		".$top." <small>".$totalRecords." record(s) found</small>
	</h1>
	";
endif;

if(count($list) == 0):
	echo "<div class='no-records'>No records found...</div>";
endif;

if(isset($list[0])):
	$firstRecord = $list[0]; 
endif;

if(is_object($firstRecord)):
	$is_object = true;
endif;

if(count($list) > 0):
?>

<div>

	<table class='sortable listTable' border='0'>
	<tbody id='sortinglist'>
	<tr>
		<?php
		if(isset($is_object)):
			if(!empty($firstRecord->id)):
#				unset($firstRecord->id);
			endif;
			if(isset($firstRecord->row_class)):
#				unset($firstRecord->row_class);
			endif;
		else:
			if(!empty($firstRecord['id'])):
#				unset($firstRecord['id']);
			endif;
			if(isset($firstRecord['row_class'])):
#				unset($firstRecord['row_class']);
			endif;
		endif;

		if(isset($firstRecord) && is_array($firstRecord)):
			foreach($firstRecord as $k=>$v):
				if($k != 'id'):
					echo "<th nowrap".(isset($orderField[0]) && $orderField[0] == $k ? " class='".(isset($orderField[1]) && strtolower($orderField[1]) == "asc" ? "sortfirstasc":"sortfirstdesc")."'":"").">".$k."</th>";
				endif;
			endforeach; 
		endif;
		?>
		<th class='nosort'></th>
	</tr>
	<?php 
	if(isset($list)):
		foreach($list as $item):
			if(isset($is_object)):
				$item_id = isset($item->id) ? $item->id : '';
				$row_class = isset($item->row_class) ? $item->row_class : '';
			else:
				$item_id = isset($item['id']) ? $item['id'] : '';
				$row_class = isset($item['row_class']) ? $item['row_class'] : '';
			endif;
	?>

	<tr id='list_<?=$item_id?>' class='<?=$row_class?> dragdrop'>
		<?php 
	
		if(!empty($showSort)):
			echo "<td style='width:30px'><div class='move_icon draghandle'></div></td>";
		endif;
	
		$i = $item;
		if(isset($is_object)):
			if(isset($i->row_class)): unset($i->row_class); endif;	
			if(isset($i->id)): unset($i->id); endif;
		else:
			if(isset($i['row_class'])): unset($i['row_class']); endif;	
			if(isset($i['id'])): unset($i['id']); endif;
		endif;

		foreach($i as $k => $row):
			if($k != 'subs'):
			$width = 'auto';
			if($row == 'Enabled' || $row == 'Disabled'):
				$w = 30;
				$row = "<input type='checkbox'".($row == 'Enabled' ? ' checked' : '')." disabled/>";
			endif;
			$colCount++;
		?>
		<td<?=!empty($width) && $width != 'auto' ? "style='width: ".$width."px'" : ""?>><?=$row?></td>
		<?php endif; endforeach; ?>
		<td class='actions' nowrap><?=isset($viewOnly) ? "<a href='/".$urlBase."/view/".$item_id."'>View</a>" : "<a href='/".$urlBase."/edit/".$item_id."'>Edit</a>" ?> <?=(isset($hideDelete) ? "" : " <a href=\"javascript: delete_rec('/".$urlBase."/del/".$item_id."',".$item_id.");\">Del</a>")?></td>
	</tr>

		<?php 
		if(isset($is_object)):
			$subs = isset($item->subs) ? $item->subs : ''; 
		else:
			$subs = isset($item['subs']) ? $item['subs'] : '';
		endif;
	
		if(!empty($subs)):
	
			foreach($subs as $sub): 
	
				if(is_object($sub)):
					$item_id = isset($sub->id) ? $sub->id : '';
					$row_class = isset($sub->row_class) ? $sub->row_class : '';
					if(isset($sub->row_class)): unset($sub->row_class); endif;	
					if(isset($sub->id)): unset($sub->id); endif;
				else:
					$item_id = isset($sub['id']) ? $sub['id'] : '';
					$row_class = isset($sub['row_class']) ? $sub['row_class'] : '';
					if(isset($sub['row_class'])): unset($sub['row_class']); endif;	
					if(isset($sub['id'])): unset($sub['id']); endif;
				endif;
			?>
	
			<tr id='list_<?=$item_id?>' class='dragdrop_<?=$item_id?>'>
		
				<td colspan='<?=$colCount?>' class='subs-td'>
				
					<div class='subs' id='sortinglist_<?=$item_id?>'>
				
						<table cellpadding='0' cellspacing='0' border='0' class='sortable listTable'>

							<tr>

								<?php
								if(!empty($showSort)):
									echo "<td style='width:30px'><div class='move_icon draghandle_".$item_id."'></div></td>";
								endif;
		
								foreach($sub as $row):
									$width = 'auto';
									if($row == 'Enabled' || $row == 'Disabled'):
										$w = 30;
										$row = "<input type='checkbox'".($row == 'Enabled' ? ' checked' : '')."disabled/>";
									endif;
									?>
									<td<?=!empty($width) && $width != 'auto' ? "style='width: ".$width."px'" : ""?>><?=$row?></td>
								<?php endforeach; ?>
							
								<td class='actions' nowrap><?=isset($viewOnly) ? "<a href='/".$urlBase."/view/".$item_id."'>View</a>" : "<a href='/".$urlBase."/edit/".$item_id."'>Edit</a>" ?> <?=(isset($hideDelete) ? "" : " <a href=\"javascript: delete_rec('/".$urlBase."/del/".$item_id."',".$item_id.");\">Del</a>")?></td>
					
							</tr>
					
						</table>
				
					</div>
			
				</td>
			
			</tr>
	
			<?php 
				$sortinglists[] = $item_id;
			endforeach;
		endif;
		endforeach;
	endif;
	?>
	</tbody>
	</table>
	<?php endif; ?>
</div>

<?php if(!empty($showSort)): ?>

<script>
Sortable.create('sortinglist',{
	tag: 'tr',
	ghosting: true,
	only: 'dragdrop',
	overlap: 'vertical',
	constraint: 'vertical',
	handle: 'draghandle',
	onUpdate: function(){
	}
});	
</script>

<div id='debug'></div>

<?php endif; ?>
