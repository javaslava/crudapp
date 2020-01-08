<?php
// Задаем константы:
define ('DS', DIRECTORY_SEPARATOR); 
$sitePath = realpath(dirname(__FILE__));
define ('SITE_PATH', $sitePath); 
define ('REQUEST_URI', $_SERVER['REQUEST_URI']);
define ('APP_DIR', 'application');
define ('RECORDS_PER_PAGE', 10);
define ('PIE_DIR', 'tmp/');
define ('PIE_PATH', PIE_DIR.session_id().".txt");
define ('PIE_EXP_TIME', 60*60*24*2);
define ('PIE_UNLINK_TIMER', PIE_EXP_TIME/2);

// для подключения к бд
define('DB_USER', '');
define('DB_PASS', '');
define('DB_HOST', 'localhost');
define('DB_NAME', 'crud_app');

if(file_exists(PIE_PATH) && filemtime(PIE_PATH) < time() - PIE_UNLINK_TIMER){	
Pie::launch_expired_pies();
}

$_PIE = Pie::get_pie_assoc_array(PIE_PATH);
$pie_array = array();

$user_data = array('reg_userName', 'reg_email', 'reg_password', 'confirm_pass', 'log_email', 'log_password');
foreach($user_data as $data){
	$user_data[$data] = isset($_POST[$data]) ? $_POST[$data] : null;
}

$db_conn = new ConnectionDB();
$analyzer = new Model_LogRegAnalyzer($db_conn, $user_data);

$logStatus = isset($_POST['loginout']) ? $_POST['loginout'] : (isset($_PIE['logStatus']) ? $_PIE['logStatus'] : "");

$login_message = !empty($logStatus) && isset($_POST['data_submit']) && $_POST['data_submit']=='Send' ? $analyzer -> get_message() : 
				(!empty($logStatus) && isset($_PIE['login_message']) ? $_PIE['login_message'] : 'Enter data for all fields.');

$userID = empty($login_message) && !empty($logStatus) && isset($_POST['data_submit']) && $_POST['data_submit']=='Send' ? $analyzer -> get_userID() : 
		(empty($logStatus) ? "" : (isset($_PIE['userID']) ? $_PIE['userID'] : ""));
		
$userName = empty($login_message) && !empty($logStatus) && isset($_POST['data_submit']) && $_POST['data_submit']=='Send' ? $analyzer -> get_userName() : 
		(empty($logStatus) ? "" : (isset($_PIE['userName']) ? $_PIE['userName'] : ""));

$page_number = isset($_POST['page_number']) ? $_POST['page_number'] : (!isset($_POST['reset']) && isset($_PIE['page_number']) && !isset($_POST['data_submit']) ? $_PIE['page_number'] : 1);
$limit_rule = " LIMIT ".($page_number - 1) * RECORDS_PER_PAGE.", ".RECORDS_PER_PAGE;
$order_factor = isset($_POST['order_factor']) ? $_POST['order_factor'] : 1;
$order_direction = $order_factor > 0 ? ' ASC' : ' DESC';
$order_by = isset($_POST['order_by']) ? $_POST['order_by'] : "";
$order_rule = !empty($order_by) ? $order_by.$order_direction : "";
			
$process_data = array('vin_nr', 'reg_nr', 'manufact_year', 'brand_name', 'model_name', 'owner_name', 'owner_surname', 'owner_number');
foreach($process_data as $value){
	$$value = isset($_POST[$value]) && !isset($_POST['reset']) ? Syntax::syntaxToUpper($_POST[$value]) : (isset($_PIE[$value]) && !isset($_POST['reset']) ? $_PIE[$value] : "");
}
	if(!empty($logStatus) && !isset($_POST['cancel'])) $pie_array['logStatus'] = $logStatus;
	$pie_array['login_message'] = $login_message;
	if(!empty($userID)) $pie_array['userID'] = $userID;
	if(!empty($userName)) $pie_array['userName'] = $userName;
	$pie_array['order_factor'] = $order_factor;
	$pie_array['limit_rule'] = $limit_rule;
	$pie_array['order_rule'] = $order_rule;
	if(isset($_PIE['userID']) && !isset($_POST['loginout'])){
		foreach($process_data as $value){
			if(!empty($$value)) $pie_array[$value] = $$value;
		}
		$pie_array['page_number'] = $page_number;
		if(isset($_PIE['filter_query']) && !isset($_POST['reset'])) $pie_array['filter_query'] = $_PIE['filter_query'];
	}
Pie::set_pie(PIE_PATH, $pie_array, "w");
















