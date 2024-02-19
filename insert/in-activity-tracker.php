<?php 
require_once(dirname(__FILE__) . "/../../include/check-session.php");
require_once(dirname(__FILE__) . "/../../include/config.php");
require_once(dirname(__FILE__) . "/../../include/class.mailer.php");
if($user == '' || $user == 0){
	session_destroy();
	exit;
}
$check_user_activity_qry = mysqli_query($Conn1,"select * from user_inactivity_log where user_id = ".$user." and date >= DATE_SUB(NOW(), INTERVAL 10 MINUTE)");
if(mysqli_num_rows($check_user_activity_qry) > 0){
	exit;
}
$type = $_REQUEST['type'];
$url = $_REQUEST['url'];
$time_dif =  (time() - $_SESSION['login_time']);
if($type == 2){
	$_SESSION['login_time'] = time();
	mysqli_query($Conn1,"insert into user_inactivity_log set login_time_dmy='".$_SESSION['login_time_dmy']."',active_flag=4,user_id= ".$user.",login_time='".$_SESSION['login_time']."',page_url='".$url."'");
}else if($type == 1 && ($time_dif/60) > 10 && ($time_dif/60) < 20){
	// $get_tl_email_id = mysqli_query($Conn1,"select GROUP_CONCAT(user.email SEPARATOR ',') as recep_mail,assign.user_name from tl_user_assignment as tl INNER JOIN tbl_user_assign as user ON tl.tl_id = user.user_id INNER JOIN tbl_user_assign as assign ON tl.user_id = assign.user_id where tl.user_id > 0 and tl.user_id = ".$user." and user.status = 1 ");
	// $result_get_mail_id = mysqli_fetch_assoc($get_tl_email_id);
	// $email_recep = explode(',',$result_get_mail_id['recep_mail']);
	// $get_loan_type_query = mysqli_query($Conn1,"select GROUP_CONCAT(loan_type SEPARATOR ',') as loan_type_assign from tl_loan_type_assign where tl_id = ".$user);
	// $result_loan_type_query = mysqli_fetch_assoc($get_loan_type_query);
	// $loan_type_array = explode(',',$result_loan_type_query['loan_type_assign']);
	// if(in_array(51,$loan_type_array) || in_array(52,$loan_type_array) || in_array(54,$loan_type_array)){
	// 	$cc_mail = array('sanjay.kumar@myloancare.in');
	// }else if(in_array(60,$loan_type_array)){
	// 	$cc_mail = array('tl1@myloancare.in');
	// }else{
	// 	$cc_mail = array('kanchan@myloancare.in','siddhartha.singh@myloancareindia.in','shashi.kumar@myloancareindia.in','mohd.asif@myloancareindia.in');
	// }
	// if(empty(array_filter($email_recep))){
	// 	$recep_mail = $cc_mail; 
	// 	$final_cc_mail = array('');
	// }else{
	// 	$recep_mail = $email_recep;
	// 	$final_cc_mail = $cc_mail;
	// }
	// $subject = "There is no activity in ".$result_get_mail_id['user_name']." CRM in last ".round($time_dif/60)." minutes.";
	// $mailbody = "There is no activity in ".$result_get_mail_id['user_name']." CRM in last ".round($time_dif/60)." minutes.<br><br> Mail triggered at ".date('h:i a');
	// $mail = mailSend($recep_mail,$final_cc_mail,$final_cc_mail,$subject,$mailbody,1);
	mysqli_query($Conn1,"insert into user_inactivity_log set active_flag=3,login_time_dmy='".$_SESSION['login_time_dmy']."',user_id= ".$user.",login_time='".$_SESSION['login_time']."',system_logout_at=".time().",page_url='".$url."',email_triggered_to='".json_encode($recep_mail)."'");
}else if($type == 1 && ($time_dif/60) > 20 && ($time_dif/60) < 30){
	// $get_tl_email_id = mysqli_query($Conn1,"select GROUP_CONCAT(user.email SEPARATOR ',') as recep_mail,assign.user_name from tl_user_assignment as tl INNER JOIN tbl_user_assign as user ON tl.tl_id = user.user_id INNER JOIN tbl_user_assign as assign ON tl.user_id = assign.user_id where tl.user_id > 0 and tl.user_id = ".$user." and user.status = 1 ");
	// $result_get_mail_id = mysqli_fetch_assoc($get_tl_email_id);
	// $email_recep = explode(',',$result_get_mail_id['recep_mail']);
	// $get_loan_type_query = mysqli_query($Conn1,"select GROUP_CONCAT(loan_type SEPARATOR ',') as loan_type_assign from tl_loan_type_assign where tl_id = ".$user);
	// $result_loan_type_query = mysqli_fetch_assoc($get_loan_type_query);
	// $loan_type_array = explode(',',$result_loan_type_query['loan_type_assign']);
	// // if(in_array(51,$loan_type_array) || in_array(52,$loan_type_array) || in_array(54,$loan_type_array)){
	// // 	$cc_mail = array('sanjay.kumar@myloancare.in');
	// // }else if(in_array(60,$loan_type_array)){
	// // 	$cc_mail = array('tl1@myloancare.in');
	// // }else{
	// // 	$cc_mail = array('kanchan@myloancare.in','siddhartha.singh@myloancareindia.in','shashi.kumar@myloancareindia.in','mohd.asif@myloancareindia.in');
	// // }
	// if(empty(array_filter($email_recep))){
	// 	$recep_mail = $cc_mail; 
	// 	$final_cc_mail = array('');
	// }else{
	// 	$recep_mail = $email_recep;
	// 	$final_cc_mail = $cc_mail;
	// }
	// $subject = "There is no activity in ".$result_get_mail_id['user_name']." CRM in last ".round($time_dif/60)." minutes.";
	// $mailbody = "There is no activity in ".$result_get_mail_id['user_name']." CRM in last ".round($time_dif/60)." minutes.<br><br> Mail triggered at ".date('h:i a');
	// $mail = mailSend($recep_mail,$final_cc_mail,$final_cc_mail,$subject,$mailbody,1);
	mysqli_query($Conn1,"insert into user_inactivity_log set active_flag=2,login_time_dmy='".$_SESSION['login_time_dmy']."',user_id= ".$user.",login_time='".$_SESSION['login_time']."',system_logout_at=".time().",page_url='".$url."',email_triggered_to='".json_encode($recep_mail)."'");
}else if($type == 1 && ($time_dif/60) > 30){
	// $get_tl_email_id = mysqli_query($Conn1,"select GROUP_CONCAT(user.email SEPARATOR ',') as recep_mail,assign.user_name from tl_user_assignment as tl INNER JOIN tbl_user_assign as user ON tl.tl_id = user.user_id INNER JOIN tbl_user_assign as assign ON tl.user_id = assign.user_id where tl.user_id > 0 and tl.user_id = ".$user." and user.status = 1 ");
	// $result_get_mail_id = mysqli_fetch_assoc($get_tl_email_id);
	// $email_recep = explode(',',$result_get_mail_id['recep_mail']);
	// $get_loan_type_query = mysqli_query($Conn1,"select GROUP_CONCAT(loan_type SEPARATOR ',') as loan_type_assign from tl_loan_type_assign where tl_id = ".$user);
	// $result_loan_type_query = mysqli_fetch_assoc($get_loan_type_query);
	// $loan_type_array = explode(',',$result_loan_type_query['loan_type_assign']);
	// if(in_array(51,$loan_type_array) || in_array(52,$loan_type_array) || in_array(54,$loan_type_array)){
	// 	$cc_mail = array('sanjay.kumar@myloancare.in');
	// }else if(in_array(60,$loan_type_array)){
	// 	$cc_mail = array('tl1@myloancare.in');
	// }else{
	// 	$cc_mail = array('kanchan@myloancare.in','siddhartha.singh@myloancareindia.in','shashi.kumar@myloancareindia.in','mohd.asif@myloancareindia.in');
	// }
	// if(empty(array_filter($email_recep))){
	// 	$recep_mail = $cc_mail; 
	// 	$final_cc_mail = array('');
	// }else{
	// 	$recep_mail = $email_recep;
	// 	$final_cc_mail = $cc_mail;
	// }
	// $subject = "There is no activity in ".$result_get_mail_id['user_name']." CRM in last ".round($time_dif/60)." minutes.";
	// $mailbody = "There is no activity in ".$result_get_mail_id['user_name']." CRM in last ".round($time_dif/60)." minutes.<br><br> Mail triggered at ".date('h:i a');
	// $mail = mailSend($recep_mail,$final_cc_mail,$final_cc_mail,$subject,$mailbody,1);
	mysqli_query($Conn1,"insert into user_inactivity_log set login_time_dmy='".$_SESSION['login_time_dmy']."',active_flag=1,user_id= ".$user.",login_time='".$_SESSION['login_time']."',system_logout_at=".time().",page_url='".$url."',email_triggered_to='".json_encode($recep_mail)."'");
}
?>