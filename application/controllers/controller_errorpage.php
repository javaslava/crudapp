<?php

class Controller_errorPage extends Controller{
	
	function __construct($message){
		$this -> message = $message;
		$this -> view = new View();
		
	}
	function action_index(){
		$this -> view -> generate($this -> message, '404.php');
	}
}