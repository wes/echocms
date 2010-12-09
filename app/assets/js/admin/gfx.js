gfx = {
	showLoader: function(){
		$('files').update("<div class='loading'><img src='/app/gfx/admin/loader-white.gif' width='48' height='48' border='0' /></div>");
	},
	filter: function(){
		this.showLoader();
		var fileExtension = $F('fileExtension');
		var sortMethod = $F('sortMethod');
		var sortOrder = $F('sortOrder');
		var url = '/admin/gfx/getList/sortMethod/'+sortMethod+'/sortOrder/'+sortOrder+'/fileExtension/'+fileExtension;
		new Ajax.Request(url,{
			onSuccess: function(t){
				$('files').update(t.responseText);
			}
		});
	},
	upload: function(){
		this.showLoader();
		$('uploadForm').submit();
	},
	del: function(id){
		var whereto = confirm('Are you sure you want to delete this image?');
		if(whereto == true){
			new Ajax.Request('/admin/gfx/delete/'+id,{
				method: 'get',
				onSuccess: function(t){
					editWindow.close();
					$('file_'+id).shrink({afterFinish: function(){ $('file_'+id).remove(); }});
				}
			});
		}
	}
}
