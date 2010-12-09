function delete_rec(url,id){
	var whereto = confirm('Are you sure you want to delete this record?');
	if(whereto == true){
		new Ajax.Request(url,{
			method: 'get',
			onSuccess: function(t){
				$('rec_'+id).remove();
			}
		});
	}
}

function getPageParents(){
	$('pageParents').update("<div style='padding: 4px;font-size: 11px;color: #343434; font-weight: bold;'>Loading Pages...</div>");
	var nav_id = $F('nav_id');
	var excluded_id = $('excluded_id').value;
	new Ajax.Request('/admin/pages/get_parents/nav_id/'+nav_id+'/excluded_id/'+excluded_id+'/ajax',{ 
		onSuccess: function(t){ 
			$('pageParents').update(t.responseText);
		} 
	});
}

var runningPerma = false;

function autoPermalink(permaMe){
	if($('autoPermaBuilder').checked == true && runningPerma == false){
		runningPerma = true;
		if(permaMe){ var permalinkMe = escape(permaMe.strip()) }else { var permalinkMe = escape($('pageTitle').value.strip()); }
		new Ajax.Request('/admin/pages/auto_permalink',{
			method: 'post',
			parameters: 'permalinkMe='+permalinkMe,
			onSuccess: function(t){
				$('permaLink').value = t.responseText;
				runningPerma = false;
			}
		});
	}else{
		return false;
	}
}

function publishToggle(){
	if($('publishBtn').checked == true){
		$('publishBox').addClassName('on');
	}else{
		$('publishBox').removeClassName('on');
	}
}

function loadSortImages(){
	if($('imgsSort')){
		var dragDropImage1 = Sortable.create('imgsSort', { 
			tag: 'img', 
			overlap: 'horizontal',
			dropOnEmpty: false,
			containment: ['imgsSort'], 
			constraint: false,
			onUpdate: function(){
				new Ajax.Request('/admin/members/save_image_order', {
					method: 'post',
					parameters: Sortable.serialize('imgsSort')
				});
			}
		});
		var dropps1 = Droppables.add('trashCan',{
			accept: 'imgGals',
			onDrop: function(element) {
				whereto = confirm('Are you sure you want to delete this image? This cannot be undone.');
				if(whereto == true){
					new Ajax.Request('/admin/members/delete_image/'+element.alt, {
						onSuccess: function(t){
							Effect.Fade('im_'+element.alt);
						}
					});
				}
			}
		});
	}
}

function twitterUpdate(){
	var tweetUpdate = $('tweetUpdate').value;
	new Ajax.Request('/admin/twitter/send',{
		method: 'post',
		parameters: 'tweetUpdate='+tweetUpdate,
		onSuccess: function(t){
			$('tweetUpdateStatus').update(t.responseText);
			setTimeout(function(){
				$('tweetUpdateStatus').update('');
			},3000);
		}
	});
}

members = {
	add_link: function(){

		var setVal = $F('member_selector').split('|||');
		
		var member_id = setVal[0];
		var member_name = setVal[1];

		$('membersBlock').insert({bottom:"<div class='member' id='member_"+member_id+"'><input type='hidden' name='member_link[]' value='"+member_id+"' />"+member_name+"</div>"});
		
		this.loadSort();
		
	},
	remove_link: function(member_id){
		$('member_'+member_id).remove();
	},
	loadSort: function(){
		if($('membersBlock')){

			var dragDropImage2 = Sortable.create('membersBlock', { 
				tag: 'div',
				overlap: 'horizontal',
				only: 'member',
				containment: ['membersBlock'], 
				constraint: false,
			});
			var dropps2 = Droppables.add('memberTrash',{
				accept: 'member',
				hoverclass: 'on',
				onDrop: function(element) {
					element.remove();
				}
			});
		}
	}	
}

Event.observe(window, 'load', members.loadSort);
Event.observe(window, 'load', loadSortImages);
