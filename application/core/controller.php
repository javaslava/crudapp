<?php

 abstract class Controller {
	
	protected $model;
	protected $view;
	protected $message;
	protected $login;
	protected $data = array(); 
	
	function __construct(){
		
		$this -> view = new View();
		$atributes = new Model_Atributes();
		$this -> set_data('atributes', $atributes -> get_data());
		$this -> login = new Model_LogInOut();
		$this -> set_data('loginout', $this -> login -> get_LogInOutButton());
	}
	
	protected function set_data($key, $value){
		$this -> data[$key] = $value;
		return true;
	}
	
	 abstract function action_index();
}
