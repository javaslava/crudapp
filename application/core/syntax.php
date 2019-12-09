<?php
class Syntax{
	
	public static function syntaxToTitle($variable){
		$var = mb_convert_case($variable, MB_CASE_TITLE, 'UTF-8');
		return htmlspecialchars(trim($var));
	}
	
	public static function syntaxToUpper($variable){
		$var = mb_convert_case($variable, MB_CASE_UPPER, 'UTF-8');
		return htmlspecialchars(trim($var));
	}
	
	public static function syntaxToLower($variable){
		$var = mb_convert_case($variable, MB_CASE_LOWER, 'UTF-8');
		return htmlspecialchars(trim($var));
	}
}