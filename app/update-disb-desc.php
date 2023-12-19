<?php 
require_once "../../include/check-session.php";
require_once "../../include/config.php";

$remarks =  replace_special($_REQUEST['description']);
$follow_date =  replace_special($_REQUEST['follow_date']);
$disb_user =  replace_special($_REQUEST['disb_user']);
$follow_type =  replace_special($_REQUEST['follow_type']);
$app_id = replace_special($_REQUEST['app_id']);
$case_id = replace_special($_REQUEST['case_id']);

if($follow_type != '' && $follow_type != 0 && $follow_date != '' && $follow_date != '0000-00-00'){
$update_app = mysqli_query($Conn1,"update tbl_mint_app set fup_desc = '".$remarks."',follow_up_date_on='".$follow_date."',follow_up_type_on ='".$follow_type."',disb_user ='".$disb_user."' where app_id = '".$app_id."'");

$app_histry =  mysqli_query($Conn1,"insert into tbl_mint_case_followup set case_id = ".$case_id.",app_id = '".$app_id."',app_flag =1,follow_date = '".$follow_date."',follow_type = '".$follow_type."',description ='".$remarks."',date=CURDATE(),time= CURTIME(),mlc_user_id = '".$disb_user."'");
}

header('location:disbursed-cases.php');
include("../../include/footer_close.php");
?>