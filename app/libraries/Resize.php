<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Resize {

	function size($imagePath,$opts=null){
	
		## this is the only thing that needs configuring.. 
		$cacheFolder = $_SERVER['DOCUMENT_ROOT'].'/cache/images/';
		$quality = 90;
		## you shouldn't need to configure anything else beyond this point
	
		if(file_exists($imagePath) == false){
			$imagePath = $_SERVER['DOCUMENT_ROOT'].$imagePath;
			if(file_exists($imagePath) == false){
				return 'image not found';
			}
		}

		if(isset($opts['w'])){ $w = $opts['w']; }
		if(isset($opts['h'])){ $h = $opts['h']; }
	
		$fileParts = explode('.',$imagePath);
		$count = count($fileParts) - 1;
		$ext = $fileParts[$count];
	
		$imgPath = str_replace('.'.$ext,'',$imagePath);
	
		$filename = md5_file($imagePath);
	
		if(!empty($w) and !empty($h)){
			$newPath = $cacheFolder.$filename.'_w'.$w.'_h'.$h.(isset($opts['scale']) && $opts['scale'] == true ? "_scaled" : "").'.'.$ext;
		}elseif(!empty($w)){
			$newPath = $cacheFolder.$filename.'_w'.$w.'.'.$ext;	
		}elseif(!empty($h)){
			$newPath = $cacheFolder.$filename.'_h'.$h.'.'.$ext;
		}else{
			return false;
		}

		$create = true;
	
		if(file_exists($newPath) == true){

			$create = false;

			$origFileTime = date("YmdHis",filemtime($imagePath));
			$newFileTime = date("YmdHis",filemtime($newPath));

			if($newFileTime < $origFileTime){
				$create = true;
			}

		}

		if($create == true){
			if(!empty($w) and !empty($h)){

				list($width,$height) = getimagesize($imagePath);
			
				$resize = $w;
			
				if($width > $height){
					$resize = $w;
					if(isset($opts['crop']) && $opts['crop'] == true){
						$resize = "x".$h;	
					}
				}else{
					$resize = "x".$h;
					if(isset($opts['crop']) && $opts['crop'] == true){
						$resize = $w;
					}
				}

				if(isset($opts['scale']) && $opts['scale'] == true){
					exec("convert ".$imagePath."  -resize ".$resize." -quality ".$quality." ".$newPath);				
				}else{
					exec("convert ".$imagePath."  -resize ".$resize." -size ".$w."x".$h." xc:".(isset($opts['canvas-color'])?$opts['canvas-color']:"transparent")." +swap -gravity center -composite -quality ".$quality." ".$newPath);
				}
							
			}elseif(!empty($w)){
				exec("convert ".$imagePath." -thumbnail ".$w."".(isset($opts['maxOnly']) && $opts['maxOnly'] == true ? "\>" : "")." -quality ".$quality." ".$newPath);
			}elseif(!empty($h)){
				exec("convert ".$imagePath." -thumbnail x".$h."".(isset($opts['maxOnly']) && $opts['maxOnly'] == true ? "\>" : "")." -quality ".$quality." ".$newPath);
			}
		}
	
		return str_replace($_SERVER['DOCUMENT_ROOT'],'',$newPath);
	}
}

?>