<?php 
require_once "../../include/check-session.php";
require_once "../../include/config.php";
unset($_SESSION['cibil_otp']);
$otp = rand('1234','9876');
$_SESSION['cibil_otp'] = $otp;
$case_id = replace_special($_REQUEST['case_id']);
$phone_no = replace_special($_REQUEST['phone']);
$loan_name = replace_special($_REQUEST['loan_name']);
$btn = replace_special($_REQUEST['btn']);
$name = replace_special($_REQUEST['name']);
$lname = replace_special($_REQUEST['lname']);
$dob = replace_special($_REQUEST['dob']);
$pan_card = replace_special($_REQUEST['pan_card']);

if(strlen($phone_no) == 10  && $phone_no != '' && $phone_no != 0){
$customer_qry = "update tbl_mint_customer_info set name = '".$name."',lname='".$lname."',dob='".$dob."',pan_card = '".$pan_card."' where phone = '".$phone_no."'";
    $update_qry = mysqli_query($Conn1,$customer_qry);
}
if($_REQUEST['pat_id'] == '42' && $btn == 1){
$bank_name = "IDFC Bank";
$msg = "".$otp." is your code for one time consent to MyLoanCare, ".$bank_name." to access your credit score re your ".$loan_name." application. Confirm this only online or to Loan Officer over phone.";
$insert_rec = mysqli_query($Conn1,"insert into tbl_cibil_verification_history set case_id =".$case_id.",partner_id = '42',cust_phone_no='".$phone_no."',mlc_user_id = '".$user."',date=NOW()");
echo mysqli_insert_id($Conn1);
include("../email/sms_process.php");
}?>