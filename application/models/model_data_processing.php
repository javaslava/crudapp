<?php
class Model_Data_Processing extends Model{
	
	private $records_amount;
	private $data_request;
	private $search_result = array();
	private $limit_rule;
	private $general_sql = "SELECT vin_nr, reg_nr, manufact_year, brand_name, model_name, owner_name, owner_surname, owner_number
							FROM auto_data, owner_data 
							WHERE auto_data.owner_id = owner_data.owner_id";
							
	public function set_limit_rules(){
		$skip = ($_SESSION['page_number'] - 1) * RECORDS_PER_PAGE;
		$this -> limit_rule = " LIMIT ".$skip.", ".RECORDS_PER_PAGE;
	}

	public function set_searchResult(){
		
		$this -> data_request = !empty($_SESSION['filter_data']['filter_query']) ? $_SESSION['filter_data']['filter_query'] : $this -> general_sql;
		$data_output_sql = $this -> data_request.$_SESSION['order_rule'].$this -> limit_rule;
		$this -> search_result = parent::get_sql_array_result($data_output_sql);
	}
		
	public function get_page_counter(){
		$this -> records_amount = count(parent::get_sql_array_result($this -> data_request));
		$pages_amount = ceil($this -> records_amount / RECORDS_PER_PAGE);
		$pages_array = array();
		for($x=1; $x <= $pages_amount; $x++){
			$pages_array[] = $x;
		}
		return $pages_array;
	}
	public function get_total_records(){
		return $this -> records_amount;
	}	
			
	public function get_insert_action(){
		
		if(!empty($_SESSION['auto_data']['vin_nr']) && 
			!empty($_SESSION['auto_data']['reg_nr']) && 
			!empty($_SESSION['auto_data']['manufact_year']) && 
			!empty($_SESSION['auto_data']['model_name']) && 
			!empty($_SESSION['auto_data']['brand_name']) &&
			!empty($_SESSION['owner_data']['owner_name']) &&
			!empty($_SESSION['owner_data']['owner_surname']) &&
			!empty($_SESSION['owner_data']['owner_number']))	
		{
			$check_vin_sql = "SELECT auto_id FROM auto_data WHERE vin_nr='{$_SESSION['auto_data']['vin_nr']}'";
			$vin_array = parent::get_sql_array_result($check_vin_sql);
			if(count($vin_array) == 0)
			{
				$check_owner_nr_sql = "SELECT owner_id FROM owner_data WHERE owner_number = '{$_SESSION['owner_data']['owner_number']}' LIMIT 1" ;
				$owner_id_array = parent::get_sql_array_result($check_owner_nr_sql);
				if(count($owner_id_array) == 0)
				{
					$insert_owner_sql = "INSERT INTO owner_data(owner_name, owner_surname, owner_number) 
										VALUES('{$_SESSION['owner_data']['owner_name']}', 
										'{$_SESSION['owner_data']['owner_surname']}', 
										'{$_SESSION['owner_data']['owner_number']}')";
					$createNewOwner = parent::requestResult($insert_owner_sql);
					$owner_id_array = parent::get_sql_array_result($check_owner_nr_sql);
					if(!$createNewOwner)
					{
						return 'Was some problem to create new auto owner.';
					}
				}
					
				$owner_id = $owner_id_array[0]['owner_id'];
				
				$insert_new_auto_sql = "INSERT INTO auto_data(vin_nr, reg_nr, manufact_year, brand_name, model_name, owner_id)
				VALUES ('{$_SESSION['auto_data']['vin_nr']}', 
						'{$_SESSION['auto_data']['reg_nr']}', 
						'{$_SESSION['auto_data']['manufact_year']}', 
						'{$_SESSION['auto_data']['brand_name']}', 
						'{$_SESSION['auto_data']['model_name']}', 
						'{$owner_id}')";
					
				$insertNewAuto = parent::requestResult($insert_new_auto_sql);
				if($insertNewAuto)
				{
					return 'New auto was successfully added.';
				}
				else
				{
					return 'Problem to add new auto.';
				}
			}
			else
			{
				return 'Auto with specified VIN_NR already exists.';
			}	
		}
		else
		{
			return 'To add new auto data be sure to fill all the fields.';
		}
	}
	
	public function get_filter_action(){
		
		$owner_data_sql = $this -> get_owner_data_sql();
		$owner_sql_array_result = parent::get_sql_array_result($owner_data_sql);
		if(count($owner_sql_array_result) > 0)
		{
			$ownerIdList = $this -> get_ownerIdList($owner_data_sql);
		}
		else
		{	
			return 'No such owner. Please, enter correct data.';
		}
			
		$auto_data_sql = $this -> general_sql." AND auto_data.owner_id IN (".$ownerIdList.")";
									
		if(!empty($this -> get_auto_data_array()))
		{
			$this -> get_sql($this -> get_auto_data_array(), $auto_data_sql, ' AND ');
		}
		
		$auto_sql_array_result = parent::get_sql_array_result($auto_data_sql);
		
		if((count($auto_sql_array_result) == 0) && (count($this -> get_auto_data_array()) == 0))
		{
			return 'This person has no any auto.';
		}
		elseif((count($auto_sql_array_result) == 0) && (count($this -> get_auto_data_array()) > 0))
		{
			return 'Auto by your search filter model not exists.';
		}
		else
		{
			$_SESSION['filter_data']['filter_query'] = $auto_data_sql;
			return 'The result of your request is below. To continue the search try again.';
		}
	}
	
	public function get_delete_action(){
		
		$owner_data_sql = $this -> get_owner_data_sql();
		$owner_sql_array_result = parent::get_sql_array_result($owner_data_sql);
		if(count($owner_sql_array_result) > 0)
		{
			$ownerIdList = $this -> get_ownerIdList($owner_data_sql);
		}
		else
		{	
			return 'No such owner. Please, enter correct data.';
		}
		
		if(!empty($this -> get_owner_data_array()) && empty($this -> get_auto_data_array()))
		{
			$delete_sql = "DELETE FROM owner_data WHERE owner_id IN ({$ownerIdList})";
			$delete_result = parent::requestResult($delete_sql);
			
			if($delete_result)
			{
				return 'Specified owner and all his auto was successfully deleted.';
			}
			else
			{
				return 'There was some problem to delete specified owner and his auto.';
			}
		}
		elseif(!empty($this -> get_auto_data_array()))
		{
			$check_auto_sql = $this -> general_sql." AND auto_data.owner_id IN ({$ownerIdList})";
			$this -> get_sql($this -> get_auto_data_array(), $check_auto_sql, ' AND ');
			$check_auto_array_result = parent::get_sql_array_result($check_auto_sql);
			if(count($check_auto_array_result) == 0)
			{
				return 'Auto by your search filter model not exists.';
			}
			else
			{
				$delete_sql = "DELETE FROM auto_data WHERE owner_id IN ({$ownerIdList})";
				$this -> get_sql($this -> get_auto_data_array(), $delete_sql, ' AND ');
				$delete_result = parent::requestResult($delete_sql);
				if($delete_result)
				{
					return 'Specified auto was successfully deleted.';
				}
				else
				{
					return 'There was some problem to delete specified auto.';
				}
			}	
		}
		else
		{
			return 'What do you want to delete? Fill at least one field.';
		}
		
	}
	
	private function get_owner_data_sql(){
		$owner_data_sql = "SELECT owner_id FROM owner_data";
		$owner_data_array = $this -> get_owner_data_array();	
		if(count($owner_data_array) > 0)
		{
			$this -> get_sql($owner_data_array, $owner_data_sql, ' WHERE ');
		}
		return $owner_data_sql;
	}
	
	private function get_auto_data_array(){
		$auto_data_array = array();
			foreach($_SESSION['auto_data'] as $key=>$value)
			{
				if(!empty($_SESSION['auto_data'][$key])){$auto_data_array[$key] = $value;}
			}
		return $auto_data_array;
	}
	
	private function get_owner_data_array(){
		$owner_data_array = array();
			foreach($_SESSION['owner_data'] as $key=>$value){
				if(!empty($_SESSION['owner_data'][$key])){$owner_data_array[$key] = $value;}
			}
		return 	$owner_data_array;
	}
	
	private function get_ownerIdList($sql){
		
		$rows = parent::get_sql_array_result($sql);
		$owner_id_array = array();
		foreach ($rows as $row) 
		{
			$owner_id_array[] = $row['owner_id'];
		}
		return implode(", ", $owner_id_array);
	}
	
	private function get_sql($array, &$requestStr, $glue){
	
		$arr = array();
		foreach($array as $key=>$value)
		{
			$arr[] = $key."='".$value."'";
		}
		$ownerIDlist = implode(' AND ', $arr);	
		$requestStr.= $glue.$ownerIDlist;
	}
	
	public function get_searchResult(){
		return $this -> search_result;
	}

	public function get_data_processing_form(){
		return 'application/views/data_processing_form.php';
	}
}