<?php

class ConnectionDB{

private $connection;
	
	public function __construct(){
		$this -> connection = @new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		if (mysqli_connect_errno()) { 
				echo("Подключение к серверу MySQL невозможно. Код ошибки: '". mysqli_connect_error()."'"); 
		exit; 
		}
	}
	
	public function getConnection(){
		return $this -> connection;
	}
}
