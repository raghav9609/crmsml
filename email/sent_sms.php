<?php
require_once "../../include/check-session.php";
require_once "../../include/config.php";
require_once "../../include/class.sms_helper.php";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
</head>
<?php 
$user = $_SESSION['user_id']; 
$query_id = urldecode(base64_decode($_REQUEST['query_id'])); 
$page = replace_special($_REQUEST['page']);  

$qrycase = "select cust.name as name, cust.phone as phone, qry.loan_type as loan_type from tbl_mint_query as qry left JOIN tbl_mint_customer_info as cust ON cust.id = qry.cust_id where qry.query_id = ".$query_id."";
$rescase = mysqli_query($Conn1,$qrycase);
$execase = mysqli_fetch_array($rescase); 
$cust_name = $execase['name'];
$phone_no = $execase['phone'];
$loan_type= $execase['loan_type'];

$qry_loan = "select * from lms_loan_type where loan_type_id = '".$loan_type."'";
$res_loan = mysqli_query($Conn1,$qry_loan);
$exe_loan = mysqli_fetch_array($res_loan); 
$loan = $exe_loan['loan_type_name'];	

$qry_user = "select * from tbl_user_assign where user_id = '".$user."'";
$res_user = mysqli_query($Conn1,$qry_user);
$exe_user = mysqli_fetch_array($res_user); 
$user_name = $exe_user['user_name'];	
$contact_no = $exe_user['contact_no'];	
/*$msg = $cust_name." , we tried reaching you re your ".$loan." query. When can we call you? ".$user_name." ".$contact_no." / www.MyLoanCare.in/ care@myloancare.in"; */
 $src_id = "https://www.myloancare.in/followup/index.php?sorce=query&get_id=".base64_encode($query_id);
    //include("../../include/short-url.php"); 
    	 $msg = "We tried to reach you for fixing an appointment for ".$loan." . Please suggest a good time to call or call at ".$contact_no." . ".$src_id.". MyLoanCare";
$qry_flag = 1; 
callAPI($phone_no,$msg,"SHORTTSMSAPI",1,$query_id);
//include("sms_process.php");
if($_SESSION['one_lead_flag'] == 1){
    	header("location:../all_query/user.php");
    }
    else if($user_role == 3){
	echo "<script>window.location.href='../all_query/user.php';</script>";
}else{
		echo "<script>window.location.href='../all_query/index.php?page=$page';</script>";
	}


?>