<?php 
#debug($this->uri);
#$urlBase = 'admin'.isset($this->uri->segment(2)) ? '/'.$this->uri->segment(2) : '');
#$urlBase = implode($this->uri->segment

$urlBase = implode('/',$this->uri->segments);

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

if(count($list) > 0):
?>

<table class='sortable listTable' border='0'>
<tr>
	<?php
	if(isset($firstRecord['id'])):
		unset($firstRecord['id']);
	endif;
	if(isset($firstRecord['row_class'])):
		unset($firstRecord['row_class']);
	endif;

	if(isset($firstRecord) && is_array($firstRecord)):
		foreach($firstRecord as $k=>$v):
			echo "<th nowrap".(isset($orderField[0]) && $orderField[0] == $k ? " class='".(isset($orderField[1]) && strtolower($orderField[1]) == "asc" ? "sortfirstasc":"sortfirstdesc")."'":"").">".$k."</th>";
		endforeach; 
	endif;
	?>
	<th class='nosort'></th>
</tr>
<?php 
if(isset($list)):
	foreach($list as $item): ?>

<tr id='rec_<?=$item['id']?>' class='<?=isset($item['row_class']) ? $item['row_class'] : ''?>'>
	<?php 
	$i = $item;
	if(isset($i['row_class'])): unset($i['row_class']); endif;	
	if(isset($i['id'])): unset($i['id']); endif;

	foreach($i as $row): 
		if($row == 'Enabled'):
			$row = "<input type='checkbox' checked disabled/>";
		elseif($row == 'Disabled'):
			$row = "<input type='checkbox' disabled />";
		endif;
	?>
	<td><?=$row?></td>
	<?php endforeach; ?>
	<td class='actions' nowrap><?=isset($viewOnly) ? "<a href='/".$urlBase."/view/".$item['id']."'>View</a>" : "<a href=\"".(isset($this->noAjax) ? "/".$urlBase."/edit/".$item['id'] : "javascript: editWindow.load_url('/".$urlBase."/edit/".$item['id']."');")."\">Edit</a>" ?> <?=(isset($hideDelete) ? "" : " <a href=\"javascript: delete_rec('/".$urlBase."/del/".$item['id']."',".$item['id'].");\">Del</a>")?></td>
</tr>
<?php 
	endforeach;
endif;
?>
</table>
<?php endif; ?>