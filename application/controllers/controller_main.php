<?php

class Controller_Main extends Controller
{
	function __construct()
	{	
		parent::__construct();
	}

	function action_index()
	{
		if(empty($_SESSION['user']['loginout']))
	{
		$this -> model = new Model_Main();
		$this -> set_data('slider', $this->model->get_data());
		$this -> view -> generate($this -> model -> get_slider(), 'general_view.php', $this -> data);
	}
	elseif(!empty($_SESSION['user']['loginout']) && !empty($_SESSION['login_message']) && empty($_SESSION['user']['userID']))
	{
		$this -> view -> generate($this -> login -> get_LogInForm(), 'general_view.php', $this -> data);
	}
	elseif(!empty($_SESSION['user']['loginout']) && !empty($_SESSION['user']['userID']))
	{
		$this -> model = new Model_Data_Processing();
			$this -> model -> set_limit_rules();
			$default_data_message = 'Filter information by fields above. Or insert new data.';
			$insert_data_message = isset($_POST['data_submit']) && $_POST['data_submit']=='Insert' ? $this -> model -> get_insert_action() : null;
			
			$_SESSION['filter_data']['filter_data_message'] = isset($_POST['data_submit']) && $_POST['data_submit']=='Filter' || !empty($_POST['filter_data_message']) ? 
												$this -> model -> get_filter_action() : 
												$default_data_message;
												
			$delete_data_message = isset($_POST['data_submit']) && $_POST['data_submit']=='Delete' ? $this -> model -> get_delete_action() : null;
			$update_data_message = !empty($insert_data_message) && empty($delete_data_message) ? $insert_data_message : $delete_data_message;
			
			$_SESSION['data_processing_message'] = !empty($update_data_message) ? $update_data_message : $_SESSION['filter_data']['filter_data_message'];
		
		$this-> model -> set_searchResult();
		$this -> set_data('searchResult', $this->model->get_searchResult());
		$this -> set_data('pageCounter', $this->model->get_page_counter());
		$this -> set_data('totalRecords', $this->model->get_total_records());
		
		$this -> view -> generate($this -> model -> get_data_processing_form(), 'general_view.php', $this -> data);
	}
	}	
}