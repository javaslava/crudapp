<?php
class Model_Atributes extends Model{
	
	private function createQuery(){
		$query = "SELECT name, value FROM config";
		return $query;		
	}
	
	public function get_data(){
		$result = $this -> requestResult($this -> createQuery());
		$array = array();
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$array[$row['name']] = $row['value'];
		}
		return $array;
	}
}