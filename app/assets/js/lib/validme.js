validme = {
	
	init: function(){
		$$('form.validme').each(function(s){
			var origAction = s.action;
			s.onSubmit = 'return validme.vdate()';
		});
	},
	vdate: function(){
		var passed = true;
		$$('input.required').each(function(s){
			if(s.value == ''){
				if(s.up().hasClassName('error') == false){
					s.up().addClassName('error');
					s.insert({after:"<div style='display: none;' class='message error'>Missing Information</div>"});
					s.next().appear();
					passed = false;
				}
			}else{
				if(s.up().hasClassName('error') == true){
					s.up().removeClassName('error');
					s.next().remove();
				}
			}
		});
		$$('select.required').each(function(s){
			if(s.selectedIndex == 0){
				if(s.up().hasClassName('error') == false){
					s.up().addClassName('error');
					s.insert({after:"<div style='display: none;' class='message error'>Missing Information</div>"});
					s.next().appear();
					passed = false;
				}
			}else{
				if(s.up().hasClassName('error') == true){
					s.up().removeClassName('error');
					s.next().remove();
				}
			}
		});
		return passed;
	}
	
}

Event.observe(window, 'load', validme.init);
