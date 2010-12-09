hmtCal = {
	mouseOn: false,
	slideOn: false,
	fading: false,
	load: function(){
		$$('.hmt_cal div.highlight').each(function(s){
			s.observe('mouseover',function(e){
				hmtCal.mouseOn = true;
				if(hmtCal.slideOn == false){
					hmtCal.slideOn = true;
					$('slide').morph('top: '+Event.pointerY(e)+'px;',{
						afterFinish: function(){
							hmtCal.slideOn = false;
						}
					});
				}
				$('slide').update(s.next().innerHTML);
				if($('slide').style.display == 'none'){
					$('slide').appear({duration: .1});
				}
			});
			s.observe('mouseout',function(){
				hmtCal.mouseOn = false;
				setTimeout(function(){
					if(hmtCal.mouseOn == false){
						if(hmtCal.fading == false){
							hmtCal.fading = true;
							$('slide').fade({
								duration: .1,
								afterFinish: function(){
									$('slide').update('');
									hmtCal.fading = false;
									hmtCal.mouseOn = false;
								}
							});
						}
					}
				},500);
			});
		});
	}
}

function backtotop(){
	new Effect.ScrollTo('nav');
}

enews = {
	show: function(){
		editWindow.load_url('/subscriptions/form');
	},
	reset_validation: function(){
		$('join_email_msg').update('');
		$('join_f_name_msg').update('');
		$('join_l_name_msg').update('');
		$('join_email_msg').setStyle('display: none;');
		$('join_f_name_msg').setStyle('display: none;');
		$('join_l_name_msg').setStyle('display: none;');
	},
	is_valid_email: function(str){
   		return (str.indexOf(".") > 2) && (str.indexOf("@") > 0);
	},
	validate: function(){

		this.reset_validation();
		
		var passed_tests = true;
	
		if(!$('join_email').value){
			$('join_email_msg').setStyle('display: block;');
			$('join_email_msg').update('Required');
			passed_tests = false;
		}else{
			if(this.is_valid_email($('join_email').value) == false){
				$('join_email_msg').setStyle('display: block;');
				$('join_email_msg').update('Invalid Email Address');
				passed_tests = false;
			}
		}
		if(!$('join_f_name').value){
			$('join_f_name_msg').setStyle('display: block;');
			$('join_f_name_msg').update('Required');
			passed_tests = false;
		}
		if(!$('join_l_name').value){
			$('join_l_name_msg').setStyle('display: block;');
			$('join_l_name_msg').update('Required');
			passed_tests = false;
		}

		return passed_tests;
		
	},
	join: function(){
		if(this.validate() == true){
			var email = $('join_email').value;
			var f_name = $('join_f_name').value;
			var l_name = $('join_l_name').value;
			$('join_form').update("<div style='font-size: 10px; color: #ffffff;'>Saving, Please Wait...</div>")
			new Ajax.Request('/subscriptions/join',{
				parameters:'email='+email+'&f_name='+f_name+'&l_name='+l_name,
				onSuccess: function(t){
					$('join_form').update(t.responseText);
				}
			});
		}
	}
}

request_vaca_guide = {
	show: function(){
		editWindow.load_url('/request_vaca_guide/form');
	},
	reset_validation: function(){
		$('rvg_f_name').removeClassName('req');
		$('rvg_l_name').removeClassName('req');
		$('rvg_address').removeClassName('req');
		$('rvg_city').removeClassName('req');
		$('rvg_state').removeClassName('req');
		$('rvg_zip').removeClassName('req');
		$('err_msg').update('');
	},
	is_valid_email: function(str){
   		return (str.indexOf(".") > 2) && (str.indexOf("@") > 0);
	},
	validate: function(){

		this.reset_validation();
		
		var passed_tests = true;
	
		if(!$('rvg_f_name').value){
			$('rvg_f_name').addClassName('req');
			passed_tests = false;
		}
		if(!$('rvg_l_name').value){
			$('rvg_l_name').addClassName('req');
			passed_tests = false;
		}
		if(!$('rvg_address').value){
			$('rvg_address').addClassName('req');
			passed_tests = false;
		}
		if(!$('rvg_city').value){
			$('rvg_city').addClassName('req');
			passed_tests = false;
		}
		if(!$('rvg_state').value){
			$('rvg_state').addClassName('req');
			passed_tests = false;
		}
		if(!$('rvg_zip').value){
			$('rvg_zip').addClassName('req');
			passed_tests = false;
		}

		if(passed_tests == false){
			$('err_msg').update('Please complete all fields');
		}

		return passed_tests;
		
	},
	send: function(){
		if(this.validate() == true){
			var f_name = $('rvg_f_name').value;
			var l_name = $('rvg_l_name').value;
			var address = $('rvg_address').value;
			var city = $('rvg_city').value;
			var state = $('rvg_state').value;
			var zip = $('rvg_zip').value;
			var email = $('rvg_email').value;
			$('rvg_form').update("<div>Saving, Please Wait...</div>");
			new Ajax.Request('/request_vaca_guide/send',{
				parameters:'address='+address+'&f_name='+f_name+'&l_name='+l_name+'&city='+city+'&state='+state+'&zip='+zip+'&email='+email,
				onSuccess: function(t){
					$('rvg_form').update(t.responseText);
				}
			});
		}
	}
}


function searchSite(){
	var q = $('searchQ').value;
	window.location = 'http://www.google.com/search?rls=en&q=site:taosskivalley.com+'+q;
}

Event.observe(window, 'load', function() {
	hmtCal.load();
});