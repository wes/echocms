<?php
class Google_analytics {

	function __construct(){
		
	}

	function get_data($id){
		$url = "".
		"https://www.google.com/analytics/feeds/data".
		"?ids=ga:".$id.
		"&dimensions=ga:source,ga:medium".
		"&metrics=ga:pageviews,ga:visits".
		"&sort=-ga:visits".
		"&filters=ga:medium%3D%3Dreferral".
		"&start-date=2009-10-01".
		"&end-date=2009-12-31".
		"&start-index=10".
		"&max-results=100";
		echo $url;
	}
	
}
?>