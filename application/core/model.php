<?php
abstract class Model
{
	private $DB;
	
	function __construct(){
		$this -> DB = new ConnectionDB();
	}
	
	protected function requestResult($query){
		if($result = $this-> DB-> getConnection()->query($query)){
			return $result;
		}
		else
		{
			return null;
		}
	}
	
	protected function get_sql_array_result($sql){
		$sql_obj_result = $this -> requestResult($sql);
		return mysqli_fetch_all($sql_obj_result, MYSQLI_ASSOC);
	}
}