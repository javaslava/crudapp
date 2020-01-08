<?php
class Model_Data_Processing extends Model{
	
	private $_PIE = array();
	private $records_amount;
	private $filter_query;
	private $data_request;
	private $search_result = array();
	private $general_sql = "SELECT vin_nr, reg_nr, manufact_year, brand_name, model_name, owner_name, owner_surname, owner_number FROM auto_data, owner_data WHERE auto_data.owner_id = owner_data.owner_id";

	public function set_PIE($pie_array){
		$this -> _PIE = $pie_array;
	}

	public function set_searchResult(){
		
		$this -> data_request = !empty($this -> filter_query) ? $this -> filter_query : (isset($this -> _PIE['filter_query']) ? $this -> _PIE['filter_query'] : $this -> general_sql);
		$data_output_sql = $this -> data_request.$this -> _PIE['order_rule'].$this -> _PIE['limit_rule'];
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
		
		if(isset($this -> _PIE['vin_nr']) && 
			isset($this -> _PIE['reg_nr']) && 
			isset($this -> _PIE['manufact_year']) && 
			isset($this -> _PIE['model_name']) && 
			isset($this -> _PIE['brand_name']) &&
			isset($this -> _PIE['owner_name']) &&
			isset($this -> _PIE['owner_surname']) &&
			isset($this -> _PIE['owner_number']))	
		{
			$check_vin_sql = "SELECT auto_id FROM auto_data WHERE vin_nr='".$this -> _PIE['vin_nr']."'";
			$vin_array = parent::get_sql_array_result($check_vin_sql);
			if(count($vin_array) == 0)
			{
				$check_owner_nr_sql = "SELECT owner_id FROM owner_data WHERE owner_number = '".$this -> _PIE['owner_number']."' LIMIT 1" ;
				$owner_id_array = parent::get_sql_array_result($check_owner_nr_sql);
				if(count($owner_id_array) == 0)
				{
					$insert_owner_sql = "INSERT INTO owner_data(owner_name, owner_surname, owner_number) 
										VALUES('{$this -> _PIE['owner_name']}', 
										'{$this -> _PIE['owner_surname']}', 
										'{$this -> _PIE['owner_number']}')";
					$createNewOwner = parent::requestResult($insert_owner_sql);
					$owner_id_array = parent::get_sql_array_result($check_owner_nr_sql);
					if(!$createNewOwner)
					{
						return 'Was some problem to create new auto owner.';
					}
				}
					
				$owner_id = $owner_id_array[0]['owner_id'];
				
				$insert_new_auto_sql = "INSERT INTO auto_data(vin_nr, reg_nr, manufact_year, brand_name, model_name, owner_id)
				VALUES ('{$this -> _PIE['vin_nr']}', 
						'{$this -> _PIE['reg_nr']}', 
						'{$this -> _PIE['manufact_year']}', 
						'{$this -> _PIE['brand_name']}', 
						'{$this -> _PIE['model_name']}', 
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
			$pie_array['filter_query'] = $auto_data_sql;
			$this -> filter_query = $auto_data_sql;
			Pie::set_pie(PIE_PATH, $pie_array, "a");
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
		if(isset($this -> _PIE['vin_nr']))$auto_data_array['vin_nr'] = $this -> _PIE['vin_nr'];
		if(isset($this -> _PIE['reg_nr']))$auto_data_array['reg_nr'] = $this -> _PIE['reg_nr'];
		if(isset($this -> _PIE['manufact_year']))$auto_data_array['manufact_year'] = $this -> _PIE['manufact_year'];
		if(isset($this -> _PIE['brand_name']))$auto_data_array['brand_name'] = $this -> _PIE['brand_name'];
		if(isset($this -> _PIE['model_name']))$auto_data_array['model_name'] = $this -> _PIE['model_name'];
		return $auto_data_array;
	}
	
	private function get_owner_data_array(){
		$owner_data_array = array();
		if(isset($this -> _PIE['owner_name']))$owner_data_array['owner_name'] = $this -> _PIE['owner_name'];
		if(isset($this -> _PIE['owner_surname']))$owner_data_array['owner_surname'] = $this -> _PIE['owner_surname'];
		if(isset($this -> _PIE['owner_number']))$owner_data_array['owner_number'] = $this -> _PIE['owner_number'];
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