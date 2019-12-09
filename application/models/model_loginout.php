<?php
class Model_LogInOut{
	
	private $buttonName;
	private $buttonUserName;

	function __construct(){
		$this -> buttonName = !empty($_SESSION['user']['loginout']) ? 'Log_Out' : 'Log_In';	
		$this -> buttonUserName = empty($_SESSION['user']['userName']) ? null : ", {$_SESSION['user']['userName']}";
	}

	public function get_LogInOutButton(){
		$result = $_SESSION['user']['loginout']==null ? 'Logged' : null;
		
			return "<form method='post' action=''>
					<button class='log_button' name='loginout' value='$result'>$this->buttonName{$this -> buttonUserName}</button>
					</form>";
	}
	
	public function get_LogInForm(){
		return 'application/views/login_form_view.php';
	}
}
?>