<?php 	
	require_once "../../include/check-session.php";
     require_once "../../include/config.php";
	 $name = replace_special($_REQUEST['name']);
	 $email = replace_special($_REQUEST['email']);
	 $mobile = replace_special($_REQUEST['phone']);
	 $smobile = replace_special($_REQUEST['sphone']);
	 $tl = replace_special($_REQUEST['tl']);
	 $loan_type =replace_special($_REQUEST['loan_type']);
	 $gateway = replace_special($_REQUEST['gateway']);
	 $hot_lead_limit = replace_special($_REQUEST['hot_lead_limit']);
	 $sme_flag = replace_special($_REQUEST['sme_flag']);
	 $up_tl = implode(',', $tl);
	 $up_loan = implode(',',$loan_type);

	$lead_view_flag = $_REQUEST['lead_view'];
	$support_desk_flag = 0;
	$total_lead_limit = 0;
	$open_lead_limit = 0;
	$is_fos_flag = 0;
	if($_REQUEST['role_id'] == 3 || $_REQUEST['role_id'] == 5) {
		$support_desk_flag = ($_REQUEST['support_desk_flag'] == 1) ?  $_REQUEST['support_desk_flag'] : "0";
	}

	if($_REQUEST['role_id'] == 3 || $_REQUEST['role_id'] == 5) {
		$total_lead_limit = trim($_REQUEST['total_lead_limit'] != "") ? $_REQUEST['total_lead_limit'] : "0";
		$open_lead_limit = (trim($_REQUEST['open_lead_limit']) != "") ? $_REQUEST['open_lead_limit'] : "0";
	}

	if($_REQUEST['role_id'] == 3 || $_REQUEST['role_id'] == 2) {
		$is_fos_flag = (trim($_REQUEST['is_fos_flag']) == 1) ? $_REQUEST['is_fos_flag'] : "0";
	}

	$password = "";
	if($user_role == 1 || $user == 241 || $user == 16 || $user == 83 || $user == 150 || $user == 318 || $user == 314) {
		$user_password = $_REQUEST['password_flag'];
		if(trim($user_password) != "") {
			if(strlen($user_password) == 8) {
				$password = md5(base64_encode($user_password));
			} else {
				header("Location: ".$head_url."/panel/user-update/index.php?msg=3");		//Password length not valid
				exit;
			}
		}
	}

	$show_number_flag = "";
	if($user_role == 1 || $user == 241 || $user == 16 || $user == 83 || $user == 314) {
		$show_number_flag = $_REQUEST['show_number_flag'];
	}

	$user_employee_code = "";
	if($user_role == 1 || $user == 241) {
		$user_employee_code = trim($_REQUEST['user_employee_code']);
	}

	$super_a_flag = ($_REQUEST['super_a_flag'] == 1) ? $_REQUEST['super_a_flag'] : "0";
	$mobile_recording_flag = ($_REQUEST['mobile_recording_flag'] == 1) ? "1" : "0";

	$is_new_dialer = $_REQUEST['is_dialer'];
	$no_of_ringing_slots = $_REQUEST['no_of_ringing_slots'];
	$fos_tl = $_REQUEST['fos_tl'];

	$qry_ins = "UPDATE tbl_user_assign set user_name='".$name."',scontact_no='".$mobile."',role_id='".$_REQUEST['role_id']."',sms_flag='".$_REQUEST['sms_flag']."',status='".$_REQUEST['status']."',port_id='".$_REQUEST['port_id']."',extension='".$_REQUEST['extension']."',gateway_id='".$gateway."',case_secd_user='".$_REQUEST['user_ids']."', one_lead_flag='".$lead_view_flag."', support_desk_flag = '".$support_desk_flag."', mobile_recording_flag = ".$mobile_recording_flag.", super_a_flag = ".$super_a_flag.",hot_lead_limit=".$hot_lead_limit.",sme_flag=".$sme_flag.", is_fos=".$is_fos_flag.", fos_tl_user = '".$fos_tl."', total_lead_limit = '".$total_lead_limit."', open_lead_limit = '".$open_lead_limit."'";
	if($_SESSION['user_role'] == 1 || $_SESSION['user_role'] == 4){
		$qry_ins .= " ,email='".$email."'";
	}
	if($_SESSION['user_role'] == 1 || $_SESSION['user_role'] == 4 || $user == 83 || $user == 314) {
		$qry_ins .= " , contact_no='".$smobile."'";
	}
	if($user_role == 1 || $user == 241 || $user == 83 || $user == 16 || $user == 314) {
		if(trim($password) != "") {
			$qry_ins .= " , password = '".$password."' ";
		}
		if(trim($user_employee_code) != "") {
			$qry_ins .= " , user_employee_code = '".$user_employee_code."' ";
		}
	}
	if($user_role == 1 || $user == 241 || $user == 16 || $user == 83 || $user == 314) {
		$qry_ins .= " , show_number_flag = '".$show_number_flag."' ";
	}

	if($is_new_dialer != "" && ($user_role == 1 || $user == 83 || $user == 314)) {
		$qry_ins .= " , is_new_dialer = '".$is_new_dialer."' ";
	}
	if($no_of_ringing_slots != "") {
		$qry_ins .= ", no_of_ringing_slots = '".$no_of_ringing_slots."' " ;
	}

	$qry_ins .= " where user_id='".$_REQUEST['user']."'";
	$result_query_updation = mysqli_query($Conn1,$qry_ins);

	if($_REQUEST['user_ids'] > 0 && $_REQUEST['user_ids'] != ''){
	     $update_cases = mysqli_query($Conn1,"UPDATE tbl_mint_case set secd_user_id = '".$_REQUEST['user_ids']."' where user_id = '".$_REQUEST['user']."' and date_created >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) and date_created <= CURDATE()");
	}
	
	$query_execute = base64_encode($qry_ins);
	 
	$qry_ins_his = "Insert into tbl_user_assign_history set user_name='".$name."',email='".$email."',contact_no='".$smobile."',scontact_no='".$mobile."',role_id='".$_REQUEST['role_id']."',sms_flag='".$_REQUEST['sms_flag']."', status='".$_REQUEST['status']."',port_id='".$_REQUEST['port_id']."',extension='".$_REQUEST['extension']."', user_update = '".$_REQUEST['user_updated']."', tl_ids='".$up_tl."', loan_name='".$up_loan."',date=NOW(), one_lead_flag = '".$lead_view_flag."', support_desk_flag = '".$support_desk_flag."', mobile_recording_flag = '".$mobile_recording_flag."', super_a_flag = '".$super_a_flag."',hot_lead_limit=".$hot_lead_limit.",sme_flag=".$sme_flag.", query_execute = '".$query_execute."', updated_by = '".$user."', is_fos='".$is_fos_flag."', case_secd_user='".$_REQUEST['user_ids']."', gateway_id='".$gateway."', total_lead_limit = '".$total_lead_limit."', open_lead_limit = '".$open_lead_limit."' ";
	if($user_role == 1 || $user == 241 || $user == 16 || $user == 83 || $user == 314) {
		if(trim($password) != "") {
			$qry_ins_his .= " , password = '".$password."' ";
		}
		$qry_ins_his .= " , show_number_flag = '".$show_number_flag."' ";
	}
	if($user_role == 1 || $user == 241) {
		if(trim($user_employee_code) != "") {
			$qry_ins_his .= " , user_employee_code = '".$user_employee_code."' ";
		}
	}

	if($is_new_dialer != "") {
		$qry_ins_his .= " , is_new_dialer = '".$is_new_dialer."' ";
	}

	$res_qry_ins_his = mysqli_query($Conn1,$qry_ins_his);

	$c_s_group = replace_special($_REQUEST['c_s_group']);
	$qry_dlt_ass = mysqli_query($Conn1, "update tl_city_subgroup_assign set status = 0 where tl_id = '".$_REQUEST['user']."'");
	if($_REQUEST['role_id'] == 2) {	
		foreach($c_s_group as $city_subgroup) {
			$qry_ins_tl = mysqli_query($Conn1,"Insert into tl_city_subgroup_assign set city_sub_group_id = '".$city_subgroup."', tl_id = '".$_REQUEST['user']."'");
		}
	}

   $qry_dlt_ass = mysqli_query($Conn1,"update tl_user_assignment set user_id = 0 where user_id = '".$_REQUEST['user']."'");
   foreach($tl as $team_lead){
   $qry_ins_tl = mysqli_query($Conn1,"Insert into tl_user_assignment set tl_id = '".$team_lead."', user_id = '".$_REQUEST['user']."'");
   }
  if($_SESSION['user_role'] == 1 || $user == 83 || $user == 241 || $user == 314){
      $qry_dlt_l_type = mysqli_query($Conn1,"update tl_loan_type_assign set tl_id = 0 where tl_id = '".$_REQUEST['user']."'");
     foreach($loan_type as $loan){
		$qry_lt = mysqli_query($Conn1,"Insert into tl_loan_type_assign set tl_id = '".$_REQUEST['user']."', loan_type = '".$loan."'");
	 }
  }
	 header("location:".$head_url."/panel/user-update/index.php?msg=2");
?>