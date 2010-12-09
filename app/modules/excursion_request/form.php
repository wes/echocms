<div class='generic_form'>
	<form method="post" action='#excursion-form'>
		<?=$this->f->input('name',array('label'=>'Name','size'=>35))?>
		<?=$this->f->input('address',array('label'=>'Address','size'=>35))?>
		<?=$this->f->input('phone',array('label'=>'Phone','size'=>15))?>
		<?=$this->f->input('email',array('label'=>'Email','size'=>30))?>
		<?=$this->f->select('excursion_choice',array('label'=>'Excursion Choice:','size'=>30,'initial'=>'Select One -->','fields'=>array('Hot-Springs-Excursion'=>'Hot Springs Excursion','Cooking-Classes'=>'Cooking Classes')))?>
		<?=$this->f->input('date_of_arrival',array('label'=>'Dave of Arrival','size'=>30))?>
		<?=$this->f->input('referred_by',array('label'=>'Referred by','size'=>30))?>
		<?=$this->f->button('Submit',array('value'=>'Submit','type'=>'submit'))?>
	</form>
</div>