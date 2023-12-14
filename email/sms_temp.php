<?php 
require_once "../../include/check-session.php";
require_once "../../include/config.php";

$temp = replace_special($_REQUEST['temp']);
$case_id = replace_special($_REQUEST['case_id']);
$query_id = replace_special($_REQUEST['query_id']);
$partner_id = replace_special($_REQUEST['partner_id']);
$partner_type = replace_special($_REQUEST['partner_type']);
$qry_case = 0;
if($case_id > 0 && is_numeric($case_id)){
	$qry_case = 1;
	$qrycase = "select * from tbl_mint_case where case_id = ".$case_id;
}else if($query_id > 0 && is_numeric($query_id)){
	$qry_case = 1;
	$qrycase = "select qry.cust_id as cust_id, qry.loan_type as loan_type, stats.user_id as user_id from tbl_mint_query as qry left JOIN tbl_mint_query_status_detail as stats ON qry.query_id = stats.query_id where qry.query_id = ".$query_id;
}else if($partner_id > 0 && is_numeric($partner_id) && $partner_type == 1){
	$qry_case = 0;
	$cust_id = $partner_id;
}else if($partner_id > 0 && is_numeric($partner_id) && $partner_type == 2){
	$qrycust = "select * from tbl_mint_partner_info where partner_id = ".$partner_id."";
	$rescust = mysqli_query($Conn1,$qrycust);
	$execust = mysqli_fetch_array($rescust);
	$phone = $execust['phone'];
	$cust_name = ucwords(strtolower($execust['name']));
}
if($qry_case == 1){
	$rescase = mysqli_query($Conn1,$qrycase);
	$execase = mysqli_fetch_array($rescase); 
	$cust_id = $execase['cust_id'];
	$loan_type = $execase['loan_type'];
	$asuser_id = $execase['user_id'];

	$qryapp = mysqli_query($Conn1,"select app_bank_on,cash_offers_on from tbl_mint_app where case_id = ".$case_id." and app_status_on IN (6,7)");
	$resapp = mysqli_fetch_array($qryapp);
	$bank_apply = $resapp['app_bank_on'];
	$cashback_amt = $resapp['cash_offers_on'];

	$qrybnk = mysqli_query($Conn1,"select bank_name from tbl_bank where bank_id = '".$bank_apply."'");
	$resbnk = mysqli_fetch_array($qrybnk);
	$bank_name = $resbnk['bank_name'];

	$qry_loan = "select * from lms_loan_type where loan_type_id = '".$loan_type."'";
	$res_loan = mysqli_query($Conn1,$qry_loan);
	$exe_loan = mysqli_fetch_array($res_loan); 
	$loan = $exe_loan['loan_type_name'];	

	$qry_user = "select * from tbl_user_assign where user_id = '".$asuser_id."'";
	$res_user = mysqli_query($Conn1,$qry_user);
	$exe_user = mysqli_fetch_array($res_user); 
	$user_name = $exe_user['user_name'];	
	$contact_no = $exe_user['contact_no'];	
	$user_email = $exe_user['email']; 
	if($contact_no == 0 || strlen($contact_no) != 10 || !is_numeric($contact_no)){
	$contact_no = $exe_user['scontact_no'];
	}
}
if($cust_id > 0 && is_numeric($cust_id)){
	$qrycust = "select * from tbl_mint_customer_info where id = ".$cust_id;
	$rescust = mysqli_query($Conn1,$qrycust) or die(mysqli_error($Conn1));
	$execust = mysqli_fetch_array($rescust);
	$cust_name = ucwords(strtolower($execust['name']));
	$cust_mobile = $execust['phone'];
	$cust_city = $execust['city_id'];
	$cust_incm = $execust['net_incm'];
	$cust_occup = $execust['occup_id'];
	$cust_comp_id = $execust['comp_id'];
	$cust_comp_name = $execust['comp_name_other'];

	$qrycomp = mysqli_query($Conn1,"select comp_name from pl_company where comp_id = '".$cust_comp_id."'");
	$rescomp = mysqli_fetch_array($qrycomp);
	$comp_name = $rescomp['comp_name'];

	if($cust_comp_id != ''){
		$company_name = $comp_name;
	}
	else {
		$company_name = $cust_comp_name;
	}

	$qrycity = mysqli_query($Conn1,"select city_name from lms_city where city_id = '".$cust_city."'");
	$rescity = mysqli_fetch_array($qrycity);
	$city_name = $rescity['city_name'];

	$qryoccup = mysqli_query($Conn1,"select occupation_name from lms_occupation where occupation_id = '".$cust_occup."'"); 
	$resoccup = mysqli_fetch_array($qryoccup);
	$occup_name = $resoccup['occupation_name'];
}

if($case_id != "") {
	$tbl_query_data_exec = mysqli_query($Conn1, "SELECT uniq_id, query_id, bank_apply FROM tbl_mint_query WHERE query_id = '".$execase['query_id']."' ORDER BY query_id DESC LIMIT 0, 1");
	$tbl_query_data_res = mysqli_fetch_array($tbl_query_data_exec);
}

if($temp == 1){
echo $msg = "Claim cashback for ".$bank_name." ".$loan.". disbursed through MyLoanCare at https://goo.gl/y04AYy. For query call ".$user_name." on ".$contact_no;
/* echo $msg = "".$bank_name.",".$loan.", disbursed through MyLoanCare.Claim cashback using link. https://goo.gl/y04AYy . For queries, call 8448389600 or contact ".$user_name." on ".$contact_no."" */;
}else if($temp == 2){
	if($case_id > 0 && $case_id != ''){
		$link_to_send = "https://www.myloancare.in/followup/index.php?sorce=case&get_id=".base64_encode($case_id)."&cust_id=".base64_encode($cust_id)."&utm_source=campaign_marketing&utm_medium=sms&utm_campaign=followupPLNI&utm_title=PLNIday2&utm_keyword=followupPLNIday2";
	}else{
		$link_to_send = $link_to_send = "https://www.myloancare.in/followup/index.php?sorce=query&get_id=".base64_encode($query_id)."&cust_id=".base64_encode($cust_id)."&utm_source=campaign_marketing&utm_medium=sms&utm_campaign=followupPLNI&utm_title=PLNIday2&utm_keyword=followupPLNIday2";
	}
	echo $msg = "".$cust_name.", We tried to reach you for your ".$loan." query. Set up preferred time for call at ".$link_to_send.". MyLoanCare";
 }else if($temp == 13){
	if($case_id > 0 && $case_id != ''){
		$link_to_send = "https://www.myloancare.in/login/?login_as=1&sorce=uploadDocs&level_id=".base64_encode($case_id)."&level_type=".base64_encode('2');
	}else{
		$link_to_send = "https://www.myloancare.in/login/?login_as=1&sorce=uploadDocs&level_id=".base64_encode($query_id)."&level_type=".base64_encode('1');
	}
	echo $msg = "Dear ".$cust_name.", Kindly find your link ".$link_to_send." to upload documents against ".$loan." application. ".$user_name." ".$contact_no." Team MyLoancare";
 }else if($temp == 14 && $case_id > 0 && $case_id != ''){
	//echo $msg = "Dear ".$cust_name.", Greetings from MyLoanCare, Avail HDFC Bank ".$loan." online while you stay at home. To begin, tap here. For Android- https://play.google.com/store/apps/details?id=com.indigo.hdfcloans   For iOS - https://apps.apple.com/in/app/hdfc-bank-loan-assist/id1190804856 Note:- Please ensure to capture Agent code as '62461' in bank official details for us to help get your loan processed at backend.";
 }else if($temp == 3){
echo $msg = "".$cust_name." , we tried reaching you to get your documents collected for ".$loan." . Let us know when can we send our representative? Call at ".$contact_no;
}else if($temp == 4){
echo $msg = "Are your ".$loan." documents ready? MyLoanCare.in case ".$case_id."  ".$cust_name.", ".$cust_mobile.", ".$city_name.", ".$occup_name.", ".$company_name.", NTH ".$cust_incm;
}else if($temp == 5){
echo $msg = "Urgent: Appointment-MyLoancare case ".$case_id." ".$cust_name."/ ".$cust_mobile."/ ".$city_name."/ ".$occup_name.", ".$company_name."/ NTH ".$cust_incm."";
}else if($temp == 6){
echo $msg = "".$loan." disbursed from ".$bank_name." through MyLoanCare. Claim your Rs. ".$cashback_amt." cashback online at https://goo.gl/y04AYy .";
}else if($temp == 7){
echo $msg = "Thank you for applying for Digi Account by DBS Bank at MyLoanCare. Click https://goo.gl/8AsYXM to download app to open account. Refer step by step guide at https://goo.gl/tHvgSv";
}else if($temp == 10){
echo $msg = "Cashe personal loan upto Rs. 200,000 instant approval and online process. Apply now at http://smarturl.it/ MyLoanCare";
}else if($temp == 11){
echo $msg = "Congratulations! Your ".$loan." has been disbursed through MyLoanCare. Claim your cashback of Rs. ".$cashback_amt." at https://bit.ly/2vl1POd ";
}else if($temp == 12){
echo $msg = $cust_name.", We need a few documents for your credit card application. Please arrange till we fix an appointment. Check document list at https://bit.ly/2RLipkJ";
}else if($temp == 15){
echo $msg = "Join MyLoanCare Partner Club, refer friends who need loan and earn upto 10K for each successful booking. Get Welcome Gifts. Download app https://play.google.com/store/apps/details?id=com.e.mlcpartnerapp&referrer=".base64_encode($user."@1");
}else if($temp == 8){
	if($case_id != ''){
    $src_id = "https://www.myloancare.in/free-credit-report/index.php?getID=".base64_encode($cust_id)."&sorce=crm&cTo=".base64_encode('Case No@#'.$case_id.'@#'.$user_email);
	} else {
		$src_id = "https://www.myloancare.in/free-credit-report/index.php?getID=".base64_encode($cust_id)."&sorce=crm&cTo=".base64_encode('Query No@#'.$query_id.'@#'.$user_email);
	}
   include("../../include/short-url.php"); 
echo $msg = "Dear ".$cust_name." , kindly extract your free Experian credit report by clicking ".$short_url." . ".$user_name." ".$contact_no." . MyLoancare";
}else if($temp == 9){
	if($case_id != ''){
		$src_id = "https://www.myloancare.in/followup/index.php?sorce=case&get_id=".base64_encode($case_id);
	} else {
		$src_id = "https://www.myloancare.in/followup/index.php?sorce=query&get_id=".base64_encode($query_id);
	}
    include("../../include/short-url.php"); 
    echo $msg = "We tried to reach you for fixing an appointment for ".$loan." . Please suggest a good time to call or call at ".$contact_no." . ".$short_url.". MyLoanCare ";
} else if($temp == 16) {
	$src_id = "https://www.myloancare.in/login/?sorce=dXBkYXRlX3Byb2ZpbGU=";
	echo $msg = "Hi ".$cust_name.",\nCongratulations on 1st successful referral. To process your payment, please provide complete details ".$src_id.".\nTeam MyLoanCare";
} else if($temp == 17) {
	$src_id = "https://www.myloancare.in/apply/otp-verification.php?uid=".base64_encode($tbl_query_data_res['query_id'])."&bank_apply_flag=".base64_encode(62)."&is_web=Mg==";
	// $src_id = "https://www.myloancare.in/apply/otp-verification.php?uid=NjEyMDMzNw==&bank_apply_flag=NjI=&is_web=MQ==";
	include("../../include/short-url.php");
	echo $msg = "To consent for digital login of your Yes Bank Personal Loan Application at MyLoanCare, pls enter OTP received on separate SMS at ".$short_url;
}
?>
