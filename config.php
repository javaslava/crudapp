<?php
session_unset();
// Задаем константы:
define ('DS', DIRECTORY_SEPARATOR); 
$sitePath = realpath(dirname(__FILE__));
define ('SITE_PATH', $sitePath); 
define ('REQUEST_URI', $_SERVER['REQUEST_URI']);
define ('APP_DIR', 'application');
define ('RECORDS_PER_PAGE', 20);

// для подключения к бд
define('DB_USER', 'slava');
define('DB_PASS', 'fstorm');
define('DB_HOST', 'localhost');
define('DB_NAME', 'crud_app');

$_SESSION['user']['loginout'] = isset($_POST['loginout']) && !empty($_POST['loginout']) ? $_POST['loginout'] : null;
$_SESSION['user']['userID'] = isset($_POST['userID']) ? $_POST['userID'] : null;
$_SESSION['user']['userName'] = isset($_POST['userName']) ? $_POST['userName'] : null;

$_SESSION['filter_data']['filter_query'] = isset($_POST['filter_query']) ? $_POST['filter_query'] : null;
$_SESSION['order_factor'] = isset($_POST['order_factor']) ? $_POST['order_factor'] : 1;
$_SESSION['page_number'] = isset($_POST['page_number']) ? $_POST['page_number'] : 1;

$_SESSION['order_by'] = isset($_POST['order_by']) ? $_POST['order_by'] : null;
$order_direction = $_SESSION['order_factor'] < 0 ? ' ASC' : ' DESC';
$_SESSION['order_rule'] = !empty($_SESSION['order_by']) ? $_SESSION['order_by'].$order_direction : null;

$reg_userName= isset($_POST['reg_userName']) ? $_POST['reg_userName'] : null;
$reg_email= isset($_POST['reg_email']) ? $_POST['reg_email'] : null;
$reg_password= isset($_POST['reg_password']) ? $_POST['reg_password'] : null;
$confirm_pass= isset($_POST['confirm_pass']) ? $_POST['confirm_pass'] : null;
$log_email= isset($_POST['log_email']) ? $_POST['log_email'] : null;
$log_password= isset($_POST['log_password']) ? $_POST['log_password'] : null;

$auto_data = ['vin_nr' => isset($_POST['vin_nr']) && !isset($_POST['reset']) ? $_POST['vin_nr'] : null,
					'reg_nr' => isset($_POST['reg_nr']) && !isset($_POST['reset']) ? $_POST['reg_nr'] : null,
					'manufact_year' => isset($_POST['manufact_year']) && !isset($_POST['reset']) ? $_POST['manufact_year'] : null,
					'brand_name' => isset($_POST['brand_name']) && !isset($_POST['reset']) ? $_POST['brand_name'] : null,
					'model_name' => isset($_POST['model_name']) && !isset($_POST['reset']) ? $_POST['model_name'] : null
				];
$owner_data = ['owner_name' => isset($_POST['owner_name']) && !isset($_POST['reset']) ? $_POST['owner_name'] : null,
					'owner_surname' => isset($_POST['owner_surname']) && !isset($_POST['reset']) ? $_POST['owner_surname'] : null,
					'owner_number' => isset($_POST['owner_number']) && !isset($_POST['reset']) ? $_POST['owner_number'] : null
				];
	foreach($auto_data as $key=>$value){
		$_SESSION['auto_data'][$key] = !empty($value) ? Syntax::syntaxToUpper($value) : null;		
	}
	foreach($owner_data as $key=>$value){
		$_SESSION['owner_data'][$key] = !empty($value) ? Syntax::syntaxToUpper($value) : null;		
	}

$db_conn = new ConnectionDB();
$analyzer = new Model_LogRegAnalyzer($db_conn, $reg_userName, $reg_email, $reg_password, $confirm_pass, $log_email, $log_password);

$_SESSION['login_message'] = isset($_POST['data_submit']) && $_POST['data_submit']=='Send' ? $analyzer -> get_message() : 'Enter data for all fields.';




