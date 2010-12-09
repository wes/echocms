<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');
class F {
    
	var $data;
	var $errors;
	var $id;

	var $fck;

	function __construct(){

	}

	function set_data($data){
		$this->data = $data;
	}
	
	function set_errors($data){
		$this->errors = $data;
	}

	function formElementHeader($id,$opts=null){
		
		if(empty($opts['class'])):
			$opts['class'] = 'field';
		endif;
		
		if(empty($opts['noHtmlWrap'])){
			echo "<div";
			if(isset($opts['wrapper_id'])){
				echo " id='".$opts['wrapper_id']."'";
			}
			if(isset($opts['class'])){
				echo " class='".$opts['class']."'";
			}
			echo "><label>";
			if(isset($opts['label'])){
				echo $opts['label'];
			}else{
				echo "&nbsp;";
			}
			echo "</label>";
		}
		if(isset($opts['before'])){
			echo $opts['before'].' ';
		}
	}

	function formElementFooter($id,$opts=null){
		if(isset($opts['required'])){
			echo " <span class='req'>*</span><input type='hidden' name='requiredFields[".$id."]' value='".(!empty($opts['label']) ? $opts['label'] : $id)."' />";
		}
		if(isset($this->errors[$id])):
			echo "&nbsp;&nbsp;<span class='error-message'>".$this->errors[$id]."</span>";
		endif;
		if(isset($opts['after'])){
			echo ' '.$opts['after'];
		}
		if(empty($opts['noHtmlWrap'])){
			echo "</div>";
		}
	}
	
	function input($id, $opts=null){
		
		$this->formElementHeader($id,$opts);
		$type = 'text';
		$style = '';
		if(isset($opts['type'])){
			$type = $opts['type'];
		}
		if(isset($opts['style'])){
			$style = "style='".$opts['style']."' ";
		}
		if(isset($this->data[$id])):
			$this->data[$id] = str_replace("'","&#039;",$this->data[$id]);
		endif;
		if(isset($opts['value'])):
			$opts['value'] = str_replace("'","&#039;",$opts['value']);
		endif;
		if($type == 'checkbox'):
			echo "<input type='hidden' name='data[".$id."]' value='' />";
		endif;
		
		echo "<input type='".$type."' name='data[".$id."]".
		(isset($opts['multi']) && $opts['multi'] == true ? "[".
		(isset($opts['id']) && $opts['id']?'id_'.$opts['id']:"")."]":"")."' id='".$id."' value='".
		(isset($opts['value'])?$opts['value']:
		(isset($this->data[$id]) ? $this->data[$id] : '' ))."' ".$style."".
		(isset($opts['readonly'])==true?' readonly':'').
		(isset($opts['type']) && $opts['type'] == 'checkbox' && isset($this->data[$id]) && $this->data[$id] == 1 ? ' checked':'').
		(isset($opts['type']) && isset($opts['value']) && $opts['type'] == 'radio' && isset($this->data[$id]) && $this->data[$id] == $opts['value'] ? ' checked':'').
		(isset($opts['type']) && $opts['type'] == 'radio' && isset($opts['checked']) && $opts['checked'] == true ? ' checked':'').
		(isset($opts['size'])?" size='".$opts['size']."'":"")." />";
		
		$this->formElementFooter($id,$opts);
		
	}
	
	function textarea($id, $opts=null){
		$this->formElementHeader($id,$opts);

		$style = '';

		if(isset($opts['style'])):
			$style = "style='".$opts['style']."' ";
		endif;

		$value = '';
		
		if(!empty($this->data[$id])):
			$value = $this->data[$id];
		endif;
		
		if(isset($opts['fck'])):
			$this->CI =& get_instance();
			$this->CI->load->library('Fckeditor');
			$this->CI->fckeditor->InstanceName = 'data['.$id.']';
			$this->CI->fckeditor->Value = isset($this->data[$id]) ? $this->data[$id] : '';
			if(!empty($opts['height'])):
				$this->CI->fckeditor->Height = $opts['height'];
			endif;
			$this->CI->fckeditor->Create();
		else:
			echo "<textarea name='data[".$id."]' id='".$id."' ".$style.">".$value."</textarea>";
		endif;
		
		$this->formElementFooter($id,$opts);
	}
	
	function select($id, $opts=null){
		$this->formElementHeader($id,$opts);
		$style = '';
		if(isset($opts['style'])){
			$style = "style='".$opts['style']."' ";
		}

		$js = '';
		if(isset($opts['js'])):
			$js = " ".$opts['js'];
		endif;

		echo "<select name='".(isset($opts['noDataName']) && $opts['noDataName'] == true ? "$id" : "data[".$id."]")."' id='".$id."' ".$style.$js.">";
		
		if(isset($opts['initial'])){
			echo "<option value=''>".$opts['initial']."</option>";
		}
		
		if(!empty($opts['sql'])){
			$q = mysql_query($opts['sql']) or die( mysql_error() );
			while($r = mysql_fetch_assoc($q)):
				if(!empty($r['id'])){ $k = $r['id']; }
				if(!empty($r['key'])){ $k = $r['key']; }
				if(!empty($r['value'])){ $v = $r['value']; }else{ $v = $k; }
				$sel = '';
				if(isset($this->data[$id]) && $this->data[$id] == $k):
					$sel = ' selected'; 
				endif;
				if(isset($opts['value']) && $opts['value'] == $k):
					$sel = ' selected'; 
				endif;
				echo "<option value='".$k."'".$sel.">".$v."</option>\n";
			endwhile;
		}
		if(isset($opts['fields']) && is_array($opts['fields'])){
			foreach($opts['fields'] as $k=>$v){
				$sel = '';
				if(isset($this->data->$id) && $this->data->$id == $k):
					$sel = ' selected'; 
				endif;
				if(isset($opts['value']) && $opts['value'] == $k):
					$sel = ' selected'; 
				endif;
				echo "<option value='$k'".$sel.">$v</option>";
			}
		}
		echo "</select>";
		$this->formElementFooter($id,$opts);
	}

	function button($id, $opts=null){
		$this->formElementHeader($id,$opts);
		$type = 'submit';
		$style = '';
		$value = 'Submit';
		if(isset($opts['type'])){
			$type = $opts['type'];
		}
		if(isset($opts['value'])){
			$value = $opts['value'];
		}
		if(isset($opts['style'])){
			$style = "style='".$opts['style']."' ";
		}
		echo "<button type='".$type."' name='data[".$id."]' id='".$id."' ".$style.">".$value."</button>";
		$this->formElementFooter($id,$opts);
	}
	
	function datetime($id, $opts=null){
		$this->formElementHeader($id,$opts);
		
		$yyyy = '0000';
		$mm = '00';
		$dd = '00';
		$hh = '00';
		$min = '00';
		
		$sid = str_replace('][','',$id);
		$sid = str_replace('_','-',$sid);

		$vid = str_replace('][','',$id);
		
		if(isset($this->data[$id])):
			list($date,$time) = explode(" ",$this->data[$id]);
			list($yyyy,$mm,$dd) = explode("-",$date);
			list($hh,$min) = explode(":",$time);
		endif;
		
		echo "
		<div class='twrap'>
		<table cellpadding='0' cellspacing='0' border='0'>
		<tr>
			<td><input size='2' type='text' id='date-".$sid."-mm' name='data[".$id."][mm]' maxlength='2' value='".$mm."' /></td>
			<td>/</td>
			<td><input size='2' type='text' id='date-".$sid."-dd' name='data[".$id."][dd]' maxlength='2' value='".$dd."' /></td>
			<td>/</td>
			<td><input size='4' type='text' id='date-".$sid."-yyyy' name='data[".$id."][yyyy]' maxlength='4' value='".$yyyy."' /></td>
			<td><input size='2' type='text' id='date-".$sid."-hh' name='data[".$id."][hh]' maxlength='2' value='".($hh>12?($hh-12):($hh))."'".(isset($opts['time_disabled']) ? " disabled" : "")." /></td>
			<td>:</td>
			<td><input size='2' type='text' id='date-".$sid."-min' name='data[".$id."][min]' maxlength='2' value='".$min."'".(isset($opts['time_disabled']) ? " disabled" : "")." /></td>
			<td><select id='date-".$sid."-ampm' name='data[".$id."][ampm]'".(isset($opts['time_disabled']) ? " disabled" : "")."><option value='AM'".($hh < 13 ? ' selected':'').">AM</option><option value='PM'".($hh > 12 ? ' selected':'').">PM</select></td>
		</tr>
		<tr>
			<td>MM</td>
			<td></td>
			<td>DD</td>
			<td></td>
			<td>YYYY</td>
			<td>HH</td>
			<td></td>
			<td>MIN</td>
			<td></td>
		</tr>
		</table>
		</div>
		";
		
		$this->formElementFooter($id,$opts);
	}

	function datefield($id, $opts=null){
		$this->formElementHeader($id,$opts);
		
		$yyyy = '0000';
		$mm = '00';
		$dd = '00';
		
		$sid = str_replace('][','',$id);
		$sid = str_replace('_','-',$sid);

		$vid = str_replace('][','',$id);
		
		if(isset($this->data[$id])):
			list($yyyy,$mm,$dd) = explode("-",$this->data[$id]);
		endif;
		
		echo "
		<div class='twrap'>
		<table cellpadding='0' cellspacing='0' border='0'>
		<tr>
			<td><input size='2' type='text' id='date-".$sid."-mm' name='data[".$id."][mm]' maxlength='2' value='".$mm."' /></td>
			<td>/</td>
			<td><input size='2' type='text' id='date-".$sid."-dd' name='data[".$id."][dd]' maxlength='2' value='".$dd."' /></td>
			<td>/</td>
			<td><input size='4' type='text' id='date-".$sid."-yyyy' name='data[".$id."][yyyy]' maxlength='4' value='".$yyyy."' /></td>
		</tr>
		<tr>
			<td>MM</td>
			<td></td>
			<td>DD</td>
			<td></td>
			<td>YYYY</td>
		</tr>
		</table>
		</div>
		";
		
		$this->formElementFooter($id,$opts);
	}

}
?>