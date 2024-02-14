<?php 	
	require_once(dirname(__FILE__) . '/../../config/session.php');
	require_once(dirname(__FILE__) . '/../../helpers/common-helper.php');
    require_once "../../config/config.php";
	 $name = replace_special($_REQUEST['name']);
	 $email = replace_special($_REQUEST['email']);
	 $mobile = replace_special($_REQUEST['phone']);
	 
	 $tl = replace_special($_REQUEST['tl']);
	 $loan_type =replace_special($_REQUEST['loan_type']);
	 $up_tl = implode(',', $tl);
	 $up_loan = implode(',',$loan_type);


	$password = "";
	if($user_role == 1) {
		$user_password = $_REQUEST['password_flag'];
		if(trim($user_password) != "") {
			if(strlen($user_password) == 8) {
				$password = md5($user_password);
			} else {
				header("Location: ".$head_url."/panel/user-update/index.php?msg=3");		//Password length not valid
				exit;
			}
		}
	}

	// $show_number_flag = "";
	// if($user_role == 1 || $user == 241 || $user == 16 || $user == 83 || $user == 314) {
	// 	$show_number_flag = $_REQUEST['show_number_flag'];
	// }


	$qry_ins = "UPDATE crm_master_user set name = '".$name."',role_id='".$_REQUEST['role_id']."',sms_flag='".$_REQUEST['sms_flag']."',is_active='".$_REQUEST['status']."'";
	if($_SESSION['user_role'] == 1 || $_SESSION['user_role'] == 4){
		$qry_ins .= " ,email_id = '".$email."'";
	}
	if($_SESSION['user_role'] == 1 || $_SESSION['user_role'] == 4 || $user == 83 || $user == 314) {
		$qry_ins .= " , mobile_no='".$mobile."'";
	}
	if($user_role == 1 || $user == 241 || $user == 83 || $user == 16 || $user == 314) {
		if(trim($password) != "") {
			$qry_ins .= " , password = '".$password."' ";
		}
		
	}
	if($user_role == 1 || $user == 241 || $user == 16 || $user == 83 || $user == 314) {
		$qry_ins .= " , show_number_flag = '".$show_number_flag."' ";
	}

	

	$qry_ins .= " where id = '".$_REQUEST['user']."'";
	$result_query_updation = mysqli_query($Conn1,$qry_ins);

	// if($_REQUEST['user_ids'] > 0 && $_REQUEST['user_ids'] != ''){
	//      $update_cases = mysqli_query($Conn1,"UPDATE tbl_mint_case set secd_user_id = '".$_REQUEST['user_ids']."' where user_id = '".$_REQUEST['user']."' and date_created >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) and date_created <= CURDATE()");
	// }
	
	// $query_execute = base64_encode($qry_ins);
	 
	// $qry_ins_his = "Insert into tbl_user_assign_history set user_name='".$name."',email='".$email."',contact_no='".$smobile."',scontact_no='".$mobile."',role_id='".$_REQUEST['role_id']."',sms_flag='".$_REQUEST['sms_flag']."', status='".$_REQUEST['status']."',port_id='".$_REQUEST['port_id']."',extension='".$_REQUEST['extension']."', user_update = '".$_REQUEST['user_updated']."', tl_ids='".$up_tl."', loan_name='".$up_loan."',date=NOW(), one_lead_flag = '".$lead_view_flag."', support_desk_flag = '".$support_desk_flag."', mobile_recording_flag = '".$mobile_recording_flag."', super_a_flag = '".$super_a_flag."',hot_lead_limit=".$hot_lead_limit.",sme_flag=".$sme_flag.", query_execute = '".$query_execute."', updated_by = '".$user."', is_fos='".$is_fos_flag."', case_secd_user='".$_REQUEST['user_ids']."', gateway_id='".$gateway."', total_lead_limit = '".$total_lead_limit."', open_lead_limit = '".$open_lead_limit."' ";
	// if($user_role == 1 || $user == 241 || $user == 16 || $user == 83 || $user == 314) {
	// 	if(trim($password) != "") {
	// 		$qry_ins_his .= " , password = '".$password."' ";
	// 	}
	// 	$qry_ins_his .= " , show_number_flag = '".$show_number_flag."' ";
	// }
	// if($user_role == 1 || $user == 241) {
	// 	if(trim($user_employee_code) != "") {
	// 		$qry_ins_his .= " , user_employee_code = '".$user_employee_code."' ";
	// 	}
	// }

	// if($is_new_dialer != "") {
	// 	$qry_ins_his .= " , is_new_dialer = '".$is_new_dialer."' ";
	// }

	// $res_qry_ins_his = mysqli_query($Conn1,$qry_ins_his);



   $qry_dlt_ass = mysqli_query($Conn1,"update crm_tl_user_mapping set user_id = 0 where user_id = '".$_REQUEST['user']."'");
   foreach($tl as $team_lead){
   		$qry_ins_tl = mysqli_query($Conn1,"Insert into crm_tl_user_mapping set tl_user_id = '".$team_lead."', user_id = '".$_REQUEST['user']."'");
   }
  if($_SESSION['user_role'] == 1 || $user == 83 || $user == 241 || $user == 314){
      $qry_dlt_l_type = mysqli_query($Conn1,"update crm_user_loan_type_mapping set user_id = 0 where user_id = '".$_REQUEST['user']."'");
     foreach($loan_type as $loan){
		$qry_lt = mysqli_query($Conn1,"Insert into crm_user_loan_type_mapping set user_id = '".$_REQUEST['user']."', loan_type = '".$loan."'");
	 }
  }
	 header("location:".$head_url."/panel/user-update/index.php?msg=2");
?>