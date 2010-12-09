Event.observe(window, 'load', function() {
	$$(".dropdown li").each( function(li) {
		li.observe("mouseover", function(e) {
			li.addClassName("hover");
			li.addClassName("open");
			if(li.down("ul") != undefined) {
				li.down("ul").setStyle( {
					visibility: "visible"
				});
			}
		});
		li.observe("mouseout", function(e) {
			if(li.down("ul") != undefined) {
				li.down("ul").setStyle( {
					visibility: "hidden"
				});
			}
		});
	});
});
