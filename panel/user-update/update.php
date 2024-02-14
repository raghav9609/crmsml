<?php 	
	require_once(dirname(__FILE__) . '/../../config/session.php');
	require_once(dirname(__FILE__) . '/../../helpers/common-helper.php');
    require_once "../../config/config.php";
	print_r($_REQUEST);

	 $name = $_REQUEST['name'];
	 $email = $_REQUEST['email'];
	 $mobile = ($_REQUEST['phone']);
	 
	 $tl = ($_REQUEST['tl']);
	 $loan_type =($_REQUEST['loan_type']);
	 $up_tl = implode(',', $tl);
	 $up_loan = implode(',',$loan_type);

	$password = "";
	if($user_role == 1) {
		echo 1;
		$user_password = $_REQUEST['password_flag'];
		if(trim($user_password) != "") {
			echo 2;
			$password = md5($user_password);

		}
	}

	// $show_number_flag = "";
	// if($user_role == 1 || $user == 241 || $user == 16 || $user == 83 || $user == 314) {
	// 	$show_number_flag = $_REQUEST['show_number_flag'];
	// }

	echo 3;
	$qry_ins = "UPDATE crm_master_user set name = '".$name."',role_id='".$_REQUEST['role_id']."',sms_flag='".$_REQUEST['sms_flag']."',is_active='".$_REQUEST['status']."'";
	if($_SESSION['user_role'] == 1 || $_SESSION['user_role'] == 4){
		$qry_ins .= " ,email_id = '".$email."'";
	}
	if($_SESSION['user_role'] == 1 || $_SESSION['user_role'] == 4 || $user == 83 || $user == 314) {
		$qry_ins .= " , mobile_no='".$mobile."'";
	}
	if($user_role == 1) {
		if(trim($password) != "") {
			$qry_ins .= " , password = '".$password."' ";
		}
		
	}
	if($user_role == 1 || $user == 241 || $user == 16 || $user == 83 || $user == 314) {
		$qry_ins .= " , show_number_flag = '".$show_number_flag."' ";
	}

	echo 4;

	$qry_ins .= " where id = '".$_REQUEST['user']."'";
	$result_query_updation = mysqli_query($Conn1,$qry_ins);

	echo $qry_ins;



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