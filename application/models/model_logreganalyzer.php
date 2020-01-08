<?php
class Model_LogRegAnalyzer{
	private $DB;
	private $reg_userName;
	private $reg_email;
	private $reg_password;
	private $confirm_pass;
	private $log_email;
	private $log_password;
	private $userID;
	private $userName;

	function __construct($db_conn, $user_data){
		
		$this -> DB = $db_conn;
		$this -> reg_userName = $user_data['reg_userName'];
		$this -> reg_email = $user_data['reg_email'];
		$this -> reg_password = $user_data['reg_password'];
		$this -> confirm_pass = $user_data['confirm_pass'];
		$this -> log_email = $user_data['log_email'];
		$this -> log_password = $user_data['log_password'];
	}
	
	public function get_message(){
	
	if(!empty($this -> reg_userName) || !empty($this -> reg_email) || !empty($this -> reg_password) || !empty($this -> confirm_pass))
	{	
		if(!empty($this -> reg_userName)){$dataArray[] = $this -> reg_userName;}
		if(!empty($this -> reg_email)){$dataArray[] = $this -> reg_email;}
		if(!empty($this -> reg_password)){$dataArray[] = $this -> reg_password;}
		if(!empty($this -> confirm_pass)){$dataArray[] = $this -> confirm_pass;}
					
		if(count($dataArray)==4)
		{
			$password = ($this -> reg_password == $this -> confirm_pass)? $this -> reg_password : null;
			if(!empty($password))
			{	
				$checkUserQuery = "SELECT user_id FROM users_data WHERE user_email='{$this -> reg_email}'";
				$checkForUser = $this -> data($checkUserQuery);
				$rowAmount = mysqli_num_rows($checkForUser);
				if($rowAmount==0){
					$reg_userName = Syntax::syntaxToTitle($this -> reg_userName);
					$reg_email = Syntax::syntaxToLower($this -> reg_email);
					$reg_password = Syntax::syntaxToUpper($this -> reg_password);
					
					$insertUserQuery = "INSERT INTO users_data(user_name, user_email, user_password) 
										VALUES('{$reg_userName}', '{$reg_email}', '{$reg_password}')";
					$insertUser = $this -> data($insertUserQuery);
						if($insertUser)
						{
							return 'Registration successfull. Now you able to log In.';
						}
						else
						{
							return 'Registration error! Try again.';
						}
				}
				else
				{
					return 'A user with that email is already registered';
				}	
			}
			else
			{
				return 'Please, confirm your password correctly.';
			}	
		}
		else
		{
			return 'To register your profil, please, fill all fields.';
		}	
	}
	elseif(!empty($this -> log_email) || !empty($this -> log_password))
	{	
		if(!empty($this -> log_email)){$dataArray[] = $this -> log_email;}
		if(!empty($this -> log_password)){$dataArray[] = $this -> log_password;}
						
			if(count($dataArray)==2)
			{	$log_email = Syntax::syntaxToLower($this -> log_email);
				$log_password = Syntax::syntaxToUpper($this -> log_password);
				
				$checkByEmailQuery = "SELECT * FROM users_data WHERE user_email = '{$log_email}'";
				$checkDataByEmail = $this -> data($checkByEmailQuery);
				$checkedRow = mysqli_fetch_array($checkDataByEmail);
				if (empty($checkedRow['user_id']))
				{
					return 'Not registered such user. Try again or register new user.';
				}
				elseif(!empty($checkedRow['user_id']) && $checkedRow['user_password'] != $log_password)
				{
					return 'Password is not correct. Try again.';
				}
				else
				{	$this -> userID = $checkedRow['user_id'];
					$this -> userName = $checkedRow['user_name'];
					return '';
				}	
			}
			else
			{
				return 'To Log In enter your email and password.';
			}
	}
	else
	{
		return 'To register new user press "Register" button and fill all fields. </br>To Log In fill your e-mail and password.';
	}		
}

	private function data($query){
		if($result = $this-> DB-> getConnection()->query($query)){
			return $result;
		}else{
			echo("запрос не даёт результата\n");}
		$result->close();
		$connection->close();
	}
	
	public function get_userID(){
		return $this -> userID;
	}
	
	public function get_userName(){
		return $this -> userName;
	}
}