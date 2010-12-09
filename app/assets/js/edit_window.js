editWindow = {
	init: function(){
		$$('a.editWindow').each(function(s){
			var image_url = s.href;
			s.href = "javascript: editWindow.load_image('"+image_url+"');";
		});
		$('editFrameClose').observe('click',function(){editWindow.close();});
	},
	load_image: function(url){

		this.show_loader();
		
		var new_img = new Image();
   		new_img.src = url;
		new_img.onload = function(){
			var w = this.width;
			var h = this.height;
			if(w > 800){  h = (800 / w) * h; w = 800; }
			editWindow.setSize(w,h);
			setTimeout(function(){
				$('editFrame').setStyle('overflow: visible;');
				$('editFrame').update("<img id='bigImageInEditWindow' src='"+url+"' width='"+w+"' border='0' />");
			},1000);
		}

	},
	load_url: function(url){
		this.show_loader();
		setTimeout(function(){
			new Ajax.Request(url,{
				method: 'get',
				onFailure: function(){
					alert('Error loading URL.')
				},
				onSuccess: function(t){
					$('editTmpFrame').update(t.responseText);
					editWindow.open();
					setTimeout(function(){
						$('editFrame').setStyle('overflow: auto;');
						$('editTmpFrame').update('');
						$('editFrame').update(t.responseText);
					},500);
				}
			});
		},800);
	},
	load_data: function(str){
		$('editFrame').update(str);
		this.open();
	},
	show_loader: function(){
		$('editFrame').update("<div class='loading'><img src='/app/gfx/admin/loader-white.gif' width='48' height='48' /></div>");
		this.setSize(120,120);
		this.fadeIn();
	},
	fadeIn: function(){
		if($('editWindow').style.display == 'none'){
			$('editWindow').setOpacity(0);
			$('editWindow').style.display = 'block';
			new Effect.Opacity('editWindow', { from: 0, to: 0.9, duration: 0.3, delay: .3 });	
		}
		if($('editWrap').style.display == 'none'){		
			$('editWrap').setOpacity(0);
			$('editWrap').style.display = 'block';
			new Effect.Opacity('editWrap', { from: 0, to: 1, duration: 0.3, delay: .3 });	
		}
		if($('editFrameClose').style.display == 'none'){
			$('editFrameClose').setOpacity(0);
			$('editFrameClose').style.display = 'block';
			new Effect.Opacity('editFrameClose', { from: 0, to: 1, duration: 0.3, delay: 2 });	
		}

	},
	open: function(){
		this.setSize();
		this.fadeIn();
	},
	setSize: function(w,h){
		var dur = .4;
		if(w > 0 && h > 0){
			dur = .0;
		}
		if(!w){ w = 500; }
		if(!h){ h = 300; }		
		if($('form_w')){ w = $('form_w').innerHTML; }
		if($('form_h')){ h = $('form_h').innerHTML; }
		var dims = document.viewport.getDimensions();
		var offs = document.viewport.getScrollOffsets();
		var new_top = ((dims.height-h) / 3) + offs.top;
		var new_left = (dims.width-w) / 2;
		$('editWindow').setStyle('top: '+offs.top+'px;left: 0;width: '+dims.width+'px;height: '+dims.height+'px;');
		$('editFrameClose').morph('top:'+(new_top-40)+'px;left:'+((w - 80) + new_left)+'px;',{ duration: dur });
		$('editWrap').morph('width:'+w+'px;height:'+h+'px;top:'+new_top+'px;left:'+new_left+'px;',{ duration: dur });
		$('editFrame').morph('height:'+(h-15)+'px;',{ duration: dur });
	},
	close: function(){
		new Effect.Opacity('editFrameClose', { from: 0.9, to: 0, duration: 0.3, 
			afterFinish: function(){
				$('editFrameClose').style.display = 'none';
			}
		});
		$('editWrap').blindUp({duration: .4,afterFinish: function(){
			new Effect.Opacity('editWindow', { from: 0.9, to: 0, delay: .3, duration: 0.3, 
				afterFinish: function(){
					$('editWindow').style.display = 'none';
				}
			});
			new Effect.Opacity('editWrap', { from: 0.9, to: 0, duration: 0.3, 
				afterFinish: function(){
					$('editWrap').style.display = 'none';
				}
			});
		}});
	}
}

Event.observe(window,'load',function(){
	editWindow.init();
	Event.observe('editWindow','click',function(){
		editWindow.close();
	});
});
Event.observe(window,'resize',function(){
	editWindow.setSize();
});	
Event.observe(window,'scroll',function(){
	editWindow.setSize();
});	
