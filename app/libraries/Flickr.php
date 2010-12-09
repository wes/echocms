<?php

class flickr {
	
	private $apikey;
	public $photoset_id;
	
	function __construct(){
		# set some default config
		# this needs to change, since this is wes's apikey, it should work when switching to theirs
		$this->apikey = '8e371fc362cdcf3037fcd1fd552baf67';
		$this->method = 'flickr.photos.search';
	}
	
	function do_request($params=array()){
	
		$params['api_key'] = $this->apikey;
	
		if(!isset($params['format'])):
			$params['format'] = 'php_serial';
		endif;

		if(!isset($params['method'])):
			$params['method'] = $this->method;
		endif;
	
		$encoded_params = array();
		
		foreach ($params as $k => $v){
	   	$encoded_params[] = urlencode($k).'='.urlencode($v);
		}
	
		$url = "http://api.flickr.com/services/rest/?".implode('&', $encoded_params);
		$rsp = file_get_contents($url);
		$rsp_obj = unserialize($rsp);

		return $rsp_obj;
		
	}

}

?>
