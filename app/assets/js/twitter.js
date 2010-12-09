tw = {
	tw_mouse_on: false,
	init: function(){
		if($('tweet')){
			getTwitters('tweet', { 
			  id: 'tsvchamber',
			  count: 1,
			  enableLinks: true,
			  ignoreReplies: true,
			  clearContents: true,
			  template: '"%text%" <a href="http://twitter.com/%user_screen_name%/statuses/%id%/">%time%</a>'
			});
			$('tweet').setStyle('display: block');
		}
		$('tweet').setOpacity(0.5);
		$('tweet').observe('mouseover',function(s){
			$('tweet').setOpacity(1);
		});
		$('tweet').observe('mouseout',function(s){
			$('tweet').setOpacity(0.5);
		});
	}
}

Event.observe(window, 'load', function() {
	tw.init();
});
