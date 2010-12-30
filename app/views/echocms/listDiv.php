<?php 
#debug($this->uri);
#$urlBase = 'admin'.isset($this->uri->segment(2)) ? '/'.$this->uri->segment(2) : '');
#$urlBase = implode($this->uri->segment

$urlBase = implode('/',$this->uri->segments);
$colCount = 0;
$smallGrid = 10;

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

if(count((array) $list) == 0):
	echo "<div class='no-records'>No records found...</div>";
endif;

$l = $list;

if(isset($list[0])):

	$firstRecord = $list[0]; 

	if(is_object($firstRecord)):
		$is_object = true;
	endif;

	$colsLeft = 100;
	$deductions = 0;
	
	if(isset($is_object)):
		if(isset($firstRecord->id)):		$deductions++;	endif;
		if(isset($firstRecord->row_class)):	$deductions++;	endif;
		if(isset($firstRecord->subs)):		$deductions++;	endif;
		if(isset($firstRecord->Published)):	$colsLeft = $colsLeft - $smallGrid;		endif;
	else:
		if(isset($firstRecord['id'])):			$deductions++;		endif;
		if(isset($firstRecord['row_class'])):	$deductions++;		endif;
		if(isset($firstRecord['subs'])):		$deductions++;		endif;
		if(isset($firstRecord['Published'])):	$colsLeft = $colsLeft - $smallGrid;			endif;
	endif;

	if(!empty($this->showSort)):
		$colsLeft -= $smallGrid;
	endif;

	$colCount = (count((array) $firstRecord) - $deductions);
	$gridCount = round(($colsLeft / $colCount),0) - 1;

#	debug($gridCount);

endif;

$list = $l;

if(count($list) > 0):
?>

<div id='sortinglist' class='divTable container_100'>
	
	<div class='head'>
		<?php
		if(!empty($showSort)):
			echo "<div class='grid_".$smallGrid."'>&nbsp;</div>";
		endif;
		if(isset($firstRecord)):
			foreach($firstRecord as $k=>$v):
				$gridMax = 0;
				if($k == 'Published'):
					$gridMax = $smallGrid;
				endif;
				if($k != 'id' && $k != 'subs'):
					echo "<div class='grid_".($gridMax > 0 ? $gridMax : $gridCount)."'>".$k."</div>";
				endif;
			endforeach; 
		endif;
		?>
		<div class='clear'></div>
	</div>
	
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

	<div id='list_<?=$item_id?>' class='<?=$row_class?> dragdrop'>

		<div class='row'>

			<?php if(!empty($showSort)): ?>
				<div class='grid_<?=$smallGrid?>'>
					<div class='move_icon draghandle'></div>
				</div>
			<?php endif; 
	
			$i = $item;
			if(isset($is_object)):
				if(isset($i->row_class)): unset($i->row_class); endif;	
				if(isset($i->id)): unset($i->id); endif;
			else:
				if(isset($i['row_class'])): unset($i['row_class']); endif;	
				if(isset($i['id'])): unset($i['id']); endif;
			endif;

			foreach($i as $k => $row):
			
				$gridMax = 0;
			
				if($k != 'subs'):
					
					if($row == 'Enabled' || $row == 'Disabled'):
						$gridMax = $smallGrid;
						$row = "<input type='checkbox'".($row == 'Enabled' ? ' checked' : '')." disabled/>";
					endif;
				
					$colCount++;
				
					?>
			
					<div class='grid_<?=$gridMax > 0 ? $gridMax : $gridCount?>'><?=$row?>&nbsp;</div>
			
				<?php
				endif;
			endforeach;
			?>
			
			<div class='grid_<?=$gridCount?> actions'><?=isset($viewOnly) ? "<a href='/".$urlBase."/view/".$item_id."'>View</a>" : "<a href='/".$urlBase."/edit/".$item_id."'>Edit</a>" ?> <?=(isset($hideDelete) ? "" : " <a href=\"javascript: delete_rec('/".$urlBase."/del/".$item_id."',".$item_id.");\">Del</a>")?></div>

			<div class='clear'></div>
		
		</div>
		
		<div class='clear'></div>
		
		<?php 
		if(isset($is_object)):
			$subs = isset($item->subs) ? $item->subs : ''; 
		else:
			$subs = isset($item['subs']) ? $item['subs'] : '';
		endif;

		if(!empty($subs)):
		?>
			
		<div class='subs' id='sortinglist_<?=$item_id?>'>

			<?php
			foreach($subs as $sub): 

				if(is_object($sub)):
					$sub_item_id = isset($sub->id) ? $sub->id : '';
					$row_class = isset($sub->row_class) ? $sub->row_class : '';
					if(isset($sub->row_class)): unset($sub->row_class); endif;	
					if(isset($sub->id)): unset($sub->id); endif;
				else:
					$sub_item_id = isset($sub['id']) ? $sub['id'] : '';
					$row_class = isset($sub['row_class']) ? $sub['row_class'] : '';
					if(isset($sub['row_class'])): unset($sub['row_class']); endif;	
					if(isset($sub['id'])): unset($sub['id']); endif;
				endif;
				?>

				<div id='list_<?=$sub_item_id?>' class='row sub dragdrop_<?=$item_id?>'>

					<?php if(!empty($showSort)): ?>
						<div class='grid_<?=$smallGrid?>'><div class='move_icon draghandle_<?=$item_id?>'></div></div>
					<?php endif; ?>

					<?php
					foreach($sub as $row):
						$gridMax = 0;
						$width = 'auto';
						if($row == 'Enabled' || $row == 'Disabled'):
							$gridMax = $smallGrid;
							$row = "<input type='checkbox'".($row == 'Enabled' ? ' checked' : '')." disabled />";
						endif;
						?>
						<div class='grid_<?=$gridMax > 0 ? $gridMax : $gridCount?>'><?=$row?>&nbsp;</div>
					<?php endforeach; ?>
	
					<div class='grid_<?=$gridCount?> actions'><?=isset($viewOnly) ? "<a href='/".$urlBase."/view/".$sub_item_id."'>View</a>" : "<a href='/".$urlBase."/edit/".$sub_item_id."'>Edit</a>" ?> <?=(isset($hideDelete) ? "" : " <a href=\"javascript: delete_rec('/".$urlBase."/del/".$sub_item_id."',".$sub_item_id.");\">Del</a>")?></div>

					<div class='clear'></div>
					
				</div>

				<div class='clear'></div>

			<?php 
				$sortinglists[$item_id] = $item_id;
			endforeach;
			?>
			</div>
			
			<div class='clear'></div>
			
			<?php
		endif;
		?>

	</div>

	<div class='clear'></div>

	<?php
		endforeach;
	endif;
endif; 
?>
</div>

<?php if(!empty($showSort)): ?>

<script>
Sortable.create('sortinglist',{
	tag: 'div',
	only: 'dragdrop',
	handle: 'draghandle',
	onUpdate: function(){
		new Ajax.Request('/admin/nav/save_order',{
			method: 'post',
			parameters: Sortable.serialize('sortinglist'),
			onSuccess: function(t){
				$('debug2').update(t.responseText);
			}
		});
	}
});

<?php 

foreach($sortinglists as $sortingListId): ?>
Sortable.create('sortinglist_<?=$sortingListId?>',{
	tag: 'div',
	only: 'dragdrop_<?=$sortingListId?>',
	handle: 'draghandle_<?=$sortingListId?>',
	onUpdate: function(){
		alert('got here');
		new Ajax.Request('/admin/nav/save_order',{
			method: 'post',
			parameters: Sortable.serialize('sortinglist_<?=$sortingListId?>'),
			onSuccess: function(t){
				$('debug2').update(t.responseText);
			}
		});
	}
});
<?php endforeach; ?>

</script>

<div id='debug2'></div>

<?php endif; ?>
