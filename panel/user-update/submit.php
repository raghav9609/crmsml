<?php
require_once(dirname(__FILE__) . '/../../config/session.php');
require_once(dirname(__FILE__) . '/../../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../../config/config.php');
// print_r($_REQUEST);
// echo "<br>".$user_role;

	 $name = replace_special($_REQUEST['name']);
	 $email = replace_special($_REQUEST['email']);
	 $mobile = replace_special($_REQUEST['mobile']);
	 $tl = replace_special($_REQUEST['tl']);
	 $loan_type = replace_special($_REQUEST['loan_type']);

	$password = "";
	if($user_role == 1 ) {
		$user_password = $_REQUEST['password_flag'];		
		if(trim($user_password) != "") {
			if(strlen($user_password) >= 8) {
				$password = md5(base64_encode($user_password));
			} else {
				echo '<script>window.location.href = "'.$head_url.'/panel/user-update/joinee_form.php?msg=3";</script>';
				//header("Location: ".$head_url."/panel/user-update/joinee_form.php?msg=3");		//Password length not valid
				exit;
			}
		}
	}

	// $show_number_flag = "";
	// if($user_role == 1 || $user == 241 || $user == 16 || $user == 83 || $user == 314) {
	// 	$show_number_flag = $_REQUEST['show_number_flag'];
	// }

	//echo "SELECT id as user_id from crm_master_user where email_id = '".$email."'";
	$qry_check = mysqli_query($Conn1,"SELECT id as user_id from crm_master_user where email_id = '".$email."'");
	if(mysqli_num_rows($qry_check) == 0){
	
	$user_insert_query = "INSERT into crm_master_user set name = '".$name."', email_id = '".$email."', mobile_no = '".$mobile."', role_id = '".$_REQUEST['role_id']."', sms_flag = '".$_REQUEST['sms_flag']."', is_active = '".$_REQUEST['status']."',  password = '".$password."' ";

	if($user_role == 1) {
		$user_insert_query .= " , show_number_flag = '".$show_number_flag."' ";
	}

	//echo $user_insert_query;
	$qry_ins = mysqli_query($Conn1, $user_insert_query);

	$query_execute = base64_encode($user_insert_query);

    $ID = mysqli_query($Conn1,"SELECT id as user_id from crm_master_user order by id DESC limit 1");
    $last = mysqli_fetch_array($ID);
   
   foreach($tl as $team_lead){
  		$qry_ins_tl = mysqli_query($Conn1,"INSERT into crm_tl_user_mapping set tl_user_id = '".$team_lead."', user_id = '".$last['user_id']."'");
   }

  
     foreach($loan_type as $loan){
  		$qry_lt = mysqli_query($Conn1,"Insert into crm_user_loan_type_mapping set user_id = '".$last['user_id']."', loan_type = '".$loan."'");
	 }
	 echo '<script>window.location.href = "'.$head_url.'/panel/user-update/joinee_form.php?msg=1";</script>';
	 // header("location:".$head_url."/panel/user-update/joinee_form.php?msg=1");
	} else {
		echo '<script>window.location.href = "'.$head_url.'/panel/user-update/joinee_form.php?msg=2";</script>';

		//header("location:".$head_url."/panel/user-update/joinee_form.php?msg=2");
	}
	 
?>