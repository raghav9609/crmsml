<?php
require_once "../../include/check-session.php";
require_once "../../include/config.php";
require_once "../../include/class.sms_helper.php";

$case_id = urldecode(base64_decode($_REQUEST['case_id']));
$bnk = replace_special($_REQUEST['bnk']);

$min_case_qry = "select * from tbl_mint_case where case_id = ".$case_id."";
$rescase_qry = mysqli_query($Conn1,$min_case_qry);
$execase_qry = mysqli_fetch_array($rescase_qry);
$cust_id = $execase_qry['cust_id'];
$loan_type = $execase_qry['loan_type'];
$req_loan_amt  = $execase_qry['required_loan_amt'];

$qryloan = "select * from lms_loan_type where loan_type_id = '".$loan_type."'";
$resloan = mysqli_query($Conn1,$qryloan);
$exeloan = mysqli_fetch_array($resloan);
$loan_name = $exeloan['loan_type_name'];

$qry_app = "select bank_crm_lead_on,bank_app_no_on from tbl_mint_app where case_id = ".$case_id." and app_bank_on = '".$bnk."'";
$res_app = mysqli_query($Conn1,$qry_app);
$exe_app = mysqli_fetch_array($res_app);
$bank_appli_no = $exe_app['bank_app_no_on'];
$bank_crm_lead_on = $exe_app['bank_crm_lead_on'];

$qrycustt = "select * from tbl_mint_customer_info where id = ".$cust_id."";
$rescustt = mysqli_query($Conn1,$qrycustt);
$execustt = mysqli_fetch_array($rescustt);
$name = $execustt['name'];
$occup_id = $execustt['occup_id'];
$phone_no = $execustt['phone'];
$city_id = $execustt['city_id'];
$comp_id = $execustt['comp_id'];
$net_incm = $execustt['net_incm'];
$comp_name_other = $execustt['comp_name_other'];


$contact_info_qry = mysqli_query($Conn1,"select rm_mobile,rm_sms_flag from tbl_bank_contact_info_new where loan_type = '".$loan_type."' and partner_id = 47 and city_id = '".$city_id."'");
$result_contact_info = mysqli_fetch_array($contact_info_qry);
$rm_mobile = $result_contact_info['rm_mobile'];
$rm_sms_flag = $result_contact_info['rm_sms_flag'];


$qry_city = "select city_name from lms_city where city_id = '".$city_id."'";
$res_city = mysqli_query($Conn1,$qry_city);
$exe_city = mysqli_fetch_array($res_city);
$city_name = $exe_city['city_name'];

$qryoccup = "select occupation_name from lms_occupation where occupation_id = '".$occup_id."'";
$resoccup = mysqli_query($Conn1,$qryoccup);
$exeoccup = mysqli_fetch_array($resoccup);
$occup = $exeoccup['occupation_name'];

$qrycomp = "select * from pl_company where comp_id = '".$comp_id."'";
$rescomp = mysqli_query($Conn1,$qrycomp);
$execomp = mysqli_fetch_array($rescomp);
$comp_name = $execomp['comp_name'];

if($rm_sms_flag == 1){
//$phone_no = $rm_mobile; 
$msg="MyLoanCare Case ".$bank_crm_lead_on." Cust - ".$name.", ".$phone." ".$city." ".$occup." @ ".$comp_name.$comp_name_other." NTH ".$net_incm." ".$loantypename." Rs. ".$req_loan_amt." ".$ext_msg."";
callAPI($rm_mobile,$msg,"SHORTTSMSAPI",2,$case_id);
//include("../email/sms_process.php");
}
include("../../include/footer_close.php"); 
?>
<script>
function closeMe()
{
var win=window.open("","_self");
win.close();
}
closeMe();
</script>