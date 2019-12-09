<?php

spl_autoload_register('AutoLoad::ClassLoader');

class AutoLoad{
	
	public static function ClassLoader($className){
		$str = "controllers|core|models|views";
		$array = explode('|', $str);
		
		foreach($array as $element){
			$aClassFilePath = $_SERVER['DOCUMENT_ROOT'].DS.APP_DIR.DS.$element.DS.$className.'.php';
				if(file_exists($aClassFilePath)){
					require_once $aClassFilePath;
					return true;
				}
		}
	return false;
	}
}
