<?php

class Controller_Main extends Controller
{
	function __construct()
	{	
		parent::__construct();
	}

	function action_index()
	{
	if(!isset($this -> _PIE['logStatus']))
	{
		$this -> model = new Model_Main();
		$this -> set_data('slider', $this -> model -> get_data());
		$this -> view -> generate($this -> model -> get_slider(), 'general_view.php', $this -> data);
	}
	elseif(isset($this -> _PIE['logStatus']) && !isset($this -> _PIE['userID']))
	{
		$this -> set_data('login_message', $this -> _PIE['login_message']);
		$this -> view -> generate($this -> login -> get_LogInForm(), 'general_view.php', $this -> data);
	}
	elseif(isset($this -> _PIE['logStatus']) && isset($this -> _PIE['userID']))
	{
		$this -> model = new Model_Data_Processing();
		$this -> model -> set_PIE($this -> _PIE);
		
		$message = 'Insert, delete or filter information by fields above.';
		if(isset($_POST['data_submit'])){
			switch($_POST['data_submit']){
				case 'Insert':
					$message = $this -> model -> get_insert_action();
					break;
				case 'Delete':
					$message = $this -> model -> get_delete_action();
					break;
				case 'Filter':
					$message = $this -> model -> get_filter_action();
					break;
				default:
					'\'data_submit\' variable problem';
			}
		}
	
		$this -> model -> set_searchResult();
		$this -> set_data('action_message', $message);
		$this -> set_data('_PIE', $this -> _PIE);
		$this -> set_data('searchResult', $this->model->get_searchResult());
		$this -> set_data('pageCounter', $this->model->get_page_counter());
		$this -> set_data('totalRecords', $this->model->get_total_records());
		
		$this -> view -> generate($this -> model -> get_data_processing_form(), 'general_view.php', $this -> data);
	}
	}	
}