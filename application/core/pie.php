<?php
class Pie{

	public static function set_pie($filePath, $pie_array, $method){
		if(!is_dir("tmp"))mkdir("tmp");
		$fp = fopen($filePath, $method);
		foreach($pie_array as $key => $value)
		{
		$pieRow = $key."|".$value."\n";
		fwrite($fp, $pieRow);
		}
		fclose($fp);
	}
	
	public static function get_pie_assoc_array($filePath){
		$array = array();
		if(file_exists($filePath)){
		$lines = file($filePath);
		foreach($lines as $line){
			$temp_array = explode("|", trim($line));
			$array[$temp_array[0]] = $temp_array[1];
		}
		}
		return $array;	
	}
	
	public static function launch_expired_pies(){
		foreach(glob(PIE_DIR."*") as $file){
			if(is_file($file)){
			if(filemtime($file) < time() - PIE_EXP_TIME) unlink($file);
			}
		}
	}
}