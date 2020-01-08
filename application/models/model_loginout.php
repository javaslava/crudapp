<?php
class Model_LogInOut{
	
	private $buttonName;
	private $buttonUserName;
	private $_PIE = array();

	function __construct($_PIE){
		$this -> _PIE = $_PIE;
		$this -> buttonName = isset($this -> _PIE['logStatus']) ? 'Log_Out' : 'Log_In';	
		$this -> buttonUserName = !isset($this -> _PIE['userName']) ? null : ", {$this -> _PIE['userName']}";
	}

	public function get_LogInOutButton(){
		$result = !isset($this -> _PIE['logStatus']) ? 'Logged' : null;
		
			return "<form method='post' action=''>
					<button class='log_button' name='loginout' value='$result'>$this->buttonName{$this -> buttonUserName}</button>
					</form>";
	}
	
	public function get_LogInForm(){
		return 'application/views/login_form_view.php';
	}
}
?>