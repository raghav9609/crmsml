<?php
require_once "../../include/check-session.php";
require_once "../../include/config.php";
	 $name = replace_special($_REQUEST['name']);
	 $email = replace_special($_REQUEST['email']);
	 $mobile = replace_special($_REQUEST['phone']);
	 $tl = replace_special($_REQUEST['tl']);
	 $loan_type = replace_special($_REQUEST['loan_type']);
	 $gateway = replace_special($_REQUEST['gateway']);

	$lead_view_flag = ($_REQUEST['role_id'] == 3 || $_REQUEST['role_id'] == 2) ? $_REQUEST['lead_view'] : "0";
	$support_desk_flag = 0;
	$total_lead_limit = 0;
	$open_lead_limit = 0;
	$is_fos_flag = 0;
	if($_REQUEST['role_id'] == 3) {
		$support_desk_flag = ($_REQUEST['support_desk_flag'] == 1) ?  $_REQUEST['support_desk_flag'] : "0";
		$total_lead_limit = (trim($_REQUEST['total_lead_limit']) != "") ? $_REQUEST['total_lead_limit'] : "0";
		$open_lead_limit = (trim($_REQUEST['open_lead_limit']) != "") ? $_REQUEST['open_lead_limit'] : "0";
	}
	if($_REQUEST['role_id'] == 3 || $_REQUEST['role_id'] == 2) {
		$is_fos_flag = (trim($_REQUEST['is_fos_flag']) == 1) ? $_REQUEST['is_fos_flag'] : "0";
	}

	$password = "";
	if($user_role == 1 || $user == 241 || $user == 16 || $user == 83 || $user == 314) {
		$user_password = $_REQUEST['password_flag'];		
		if(trim($user_password) != "") {
			if(strlen($user_password) == 8) {
				$password = md5(base64_encode($user_password));
			} else {
				header("Location: ".$head_url."/panel/user-update/joinee_form.php?msg=3");		//Password length not valid
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

	// $super_a_flag = 0;
	// if($_REQUEST['role_id'] == 2) {
	$super_a_flag = ($_REQUEST['super_a_flag'] == 1) ? $_REQUEST['super_a_flag'] : "0";
	// }
	$mobile_recording_flag = ($_REQUEST['mobile_recording_flag'] == 1) ? $_REQUEST['mobile_recording_flag'] : "0";

	$is_new_dialer = $_REQUEST['is_dialer'];
	$no_of_ringing_slots = $_REQUEST['no_of_ringing_slots'];
	$fos_tl = $_REQUEST['fos_tl'];

	$qry_check = mysqli_query($Conn1,"SELECT user_id from tbl_user_assign where email='".$email."'");
	if(mysqli_num_rows($qry_check) == 0){
	
	$user_insert_query = "INSERT into tbl_user_assign set user_name='".$name."',email='".$email."',contact_no='".$mobile."',role_id='".$_REQUEST['role_id']."',sms_flag='".$_REQUEST['sms_flag']."',status='".$_REQUEST['status']."',port_id='".$_REQUEST['port_id']."',extension='".$_REQUEST['extension']."',gateway_id='".$gateway."', case_secd_user='".$_REQUEST['user_ids']."', one_lead_flag='".$lead_view_flag."', support_desk_flag = '".$support_desk_flag."', mobile_recording_flag = '".$mobile_recording_flag."', total_lead_limit = '".$total_lead_limit."', open_lead_limit = '".$open_lead_limit."', super_a_flag = '".$super_a_flag."', is_fos = '".$is_fos_flag."', password = '".$password."', user_employee_code = '".$user_employee_code."', fos_tl_user = '".$fos_tl."' ";

	if($user_role == 1 || $user == 241 || $user == 16 || $user == 83 || $user == 314) {
		$user_insert_query .= " , show_number_flag = '".$show_number_flag."' ";
	}

	if($is_new_dialer != "" && ($user_role == 1 || $user == 83 || $user == 314)) {
		$user_insert_query .= " , is_new_dialer = '".$is_new_dialer."' ";
	}
	if($no_of_ringing_slots != "") {
		$user_insert_query .= ", no_of_ringing_slots = '".$no_of_ringing_slots."' " ;
	}

	$qry_ins = mysqli_query($Conn1, $user_insert_query);

	$query_execute = base64_encode($user_insert_query);
	$user_history_insert = "INSERT into tbl_user_assign_history set user_name='".$name."', email='".$email."', contact_no='".$mobile."', role_id='".$_REQUEST['role_id']."', sms_flag='".$_REQUEST['sms_flag']."', status='".$_REQUEST['status']."',port_id='".$_REQUEST['port_id']."', extension='".$_REQUEST['extension']."',gateway_id='".$gateway."', case_secd_user='".$_REQUEST['user_ids']."', one_lead_flag='".$lead_view_flag."', support_desk_flag = '".$support_desk_flag."', mobile_recording_flag = '".$mobile_recording_flag."', total_lead_limit = '".$total_lead_limit."', open_lead_limit = '".$open_lead_limit."', super_a_flag = '".$super_a_flag."', is_fos = '".$is_fos_flag."', password = '".$password."', user_employee_code = '".$user_employee_code."', query_execute = '".$query_execute."', updated_by = '".$user."', date=NOW() ";

	if($user_role == 1 || $user == 241 || $user == 16 || $user == 83 || $user == 314) {
		$user_history_insert .= " , show_number_flag = '".$show_number_flag."' ";
	}

	if($is_new_dialer != "" && ($user_role == 1 || $user == 83 || $user == 314)) {
		$user_history_insert .= " , is_new_dialer = '".$is_new_dialer."' ";
	}

	$qry_his_ins = mysqli_query($Conn1, $user_history_insert);

    $ID = mysqli_query($Conn1,"SELECT user_id from tbl_user_assign order by user_id DESC limit 1");
    $last = mysqli_fetch_array($ID);
   
   foreach($tl as $team_lead){
  $qry_ins_tl = mysqli_query($Conn1,"INSERT into tl_user_assignment set tl_id = '".$team_lead."', user_id = '".$last['user_id']."'");
   }

	if($_REQUEST['role_id'] == 2) {
		$c_s_group = replace_special($_REQUEST['c_s_group']);
		if(!empty($c_s_group)) {
			foreach($c_s_group as $sub_group) {
				$c_s_group_insert = mysqli_query($Conn1,"insert into tl_city_subgroup_assign set city_sub_group_id = '".$sub_group."', tl_id = '".$last['user_id']."', status = 1");
			}
		}
	}
  
     foreach($loan_type as $loan){
  $qry_lt = mysqli_query($Conn1,"Insert into tl_loan_type_assign set tl_id = '".$last['user_id']."', loan_type = '".$loan."'");
	 }
	  header("location:".$head_url."/panel/user-update/joinee_form.php?msg=1");
	} else {
		 header("location:".$head_url."/panel/user-update/joinee_form.php?msg=2");
	}
	 
?>