<?php
$number_of_days = array(1,2,3,4,5,6,7);
$number_of_peoples = array(1,2,3,4,5,6,7);
$number_of_rooms = array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5+'=>'5+');
$age_groups = array('All-Ages'=>'All Ages');
$price_ranges = array('$-$$'=>'$-$$','$$-$$$'=>'$$-$$$','$$$-$$$$'=>'$$$-$$$$');
?>

<div class='generic_form'>
	<form method='post'>

		<?=$this->f->input('first_name',array('label'=>'First Name','size'=>40))?>
		<?=$this->f->input('last_name',array('label'=>'Last Name','size'=>40))?>
		<?=$this->f->input('address',array('label'=>'Address','size'=>50))?>
		<?=$this->f->input('city',array('label'=>'City','size'=>30))?>
		<?=$this->f->input('state',array('label'=>'State','size'=>2))?>
		<?=$this->f->input('zip',array('label'=>'Zip','size'=>6))?>
		<?=$this->f->input('phone',array('label'=>'Phone','size'=>15))?>
		<?=$this->f->input('email',array('label'=>'Email','size'=>30))?>
		<?=$this->f->datefield('date_of_arrival',array('label'=>'Date of Arrival'))?>
		<?=$this->f->datefield('date_of_departure',array('label'=>'Date of Departure'))?>
		<?=$this->f->input('number_of_days',array('label'=>'Number of Days','size'=>15))?>
		<?=$this->f->input('number_of_adults',array('label'=>'Number of Adults','size'=>15))?>
		<?=$this->f->input('number_of_children',array('label'=>'Number of Children','size'=>15))?>		
		<?=$this->f->select('number_of_rooms',array('label'=>'Number of Rooms','fields'=>$number_of_rooms))?>
		<?=$this->f->select('price_range',array('label'=>'Price Range','fields'=>$price_ranges))?>
		<?=$this->f->textarea('special_requests',array('label'=>'Special Requests','style'=>'width: 300px;height: 80px;'))?>

		<p>How did you find the Taos Ski Valley Chamber of Commerce website?</p>
		<p>Please check all that apply:</p>

		<div>
		<?php $founds = array('Google','Yahoo','Other Search Engines','New Mexico Vacation Guide','New Mexico Magazine','Taos Vacation Guide','Other Printed Material'); ?>
		<?php foreach($founds as $found): ?>
			<?=$this->f->input('found_us][',array('class'=>'checkbox','type'=>'checkbox','value'=>$found,'label'=>$found))?>
		<?php endforeach; ?>
		</div>
		
		<div class='field'>
			<div><p>Is this a first time visit to Taos Ski Valley?</p></div>
			<div><input style='display: inline;padding: 0;margin: 0;' type='checkbox' name='data[first_time_visit]' value='Yes' /> <b>Yes</b> &nbsp;&nbsp;&nbsp; <input type='checkbox' name='data[first_time_visit]' value='No' /> <b>No</b></div>
		</div>

		<div class='field'>
			<div><p>Would you like to receive a vacation guide?</p></div>
			<div><input style='display: inline;padding: 0;margin: 0;' type='checkbox' name='data[vacation_planning_pack]' value='Yes' /> <b>Yes</b> &nbsp;&nbsp;&nbsp; <input type='checkbox' name='data[vacation_planning_pack]' value='No' /> <b>No</b></div>
		</div>

		<?=$this->f->button('Send_Reservation_Request',array('value'=>'Send Reservation Request','type'=>'submit'))?>

	</form>
</div>