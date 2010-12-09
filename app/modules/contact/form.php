<div class='generic_form'>
	<h2>Contact Form</h2>
	<form method='post'>
		<?=$this->f->input('name',array('label'=>'Name','size'=>35))?>
		<?=$this->f->input('address',array('label'=>'Address','size'=>35))?>
		<?=$this->f->input('phone',array('label'=>'Phone','size'=>15))?>
		<?=$this->f->input('email',array('label'=>'Email','size'=>30))?>
		<?=$this->f->textarea('comments',array('label'=>'Comments','style'=>'width: 300px;height: 80px;'))?>
		<?=$this->f->button('Submit',array('value'=>'Submit','type'=>'submit'))?>
	</form>
</div>