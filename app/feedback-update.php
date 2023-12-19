<?php 
require_once "../../include/check-session.php";
require_once "../../include/config.php";
$banker_experience_arr = $_REQUEST['issue_bank'];
$banker_experience = implode(",",$banker_experience_arr);

$mlc_experience_arr = $_REQUEST['issue'];
$mlc_experience = implode(",",$mlc_experience_arr);

if($_REQUEST['fol_time_connector'] == ''){
		$connector_follow_up_time = '';
	}else{
		$connector_follow_up_time = date("H:i", strtotime($_REQUEST['fol_time_connector']));
	}
	if($_REQUEST['fol_time'] == ''){
		$cust_follow_up_time = '';
	}else{
		$cust_follow_up_time = date("H:i", strtotime($_REQUEST['fol_time']));
	}
if($_REQUEST['update'] != ''){
	
	if($_REQUEST['follow'] == '' || $_REQUEST['follow'] == '0'){ $fol_time = '' ;	$fol_date = '';	} else {$fol_time = $_REQUEST['fol_time'];	$fol_date = $_REQUEST['fol_date'];	}
	if($_REQUEST['conn_attmpt'] == '' || $_REQUEST['conn_attmpt'] == '0'){ $fol_date_connector = $fol_time_connector = '';	} else {$fol_date_connector = $_REQUEST['fol_date_connector'];	$fol_time_connector = $_REQUEST['fol_time_connector'];	}
    $qry_insert = mysqli_query($Conn1,"Update tbl_application_feed_back set rating='".$_REQUEST['rating']."',bank_rating='".$_REQUEST['bank_rating']."', rating_made_by='".$_REQUEST['feed_given']."',
    cashback_made='".$_REQUEST['cshbck']."',mlc_experience ='".$mlc_experience."',banker_experience='".$banker_experience."',
    feedback='".$_REQUEST['feed_desc']."',priority_cust = '".$_REQUEST['pri_cust']."',follow_up = '".$_REQUEST['follow']."', follow_up_date = '".$fol_date."',
    follow_up_time = '".$cust_follow_up_time."', connector_attempt='".$_REQUEST['conn_attmpt']."', 
    follow_up_date_connector='".$fol_date_connector."', user_id ='".$user."',follow_up_time_connector='".date("H:i", strtotime($fol_time_connector))."', date=NOW() where app_id='".$_REQUEST['application_id']."'");
} else {
$qry_insert = mysqli_query($Conn1,"Insert into tbl_application_feed_back set app_id='".$_REQUEST['application_id']."',rating='".$_REQUEST['rating']."', bank_rating='".$_REQUEST['bank_rating']."',
rating_made_by='".$_REQUEST['feed_given']."',user_id ='".$user."',cashback_made='".$_REQUEST['cshbck']."',mlc_experience ='".$mlc_experience."',banker_experience='".$banker_experience."',
feedback='".$_REQUEST['feed_desc']."',priority_cust = '".$_REQUEST['pri_cust']."',follow_up = '".$_REQUEST['follow']."', follow_up_date = '".$_REQUEST['fol_date']."', 
follow_up_time = '".$cust_follow_up_time."', connector_attempt='".$_REQUEST['conn_attmpt']."', follow_up_date_connector='".$_REQUEST['fol_date_connector']."', 
follow_up_time_connector='".$connector_follow_up_time."',date=NOW()");
}

if($_REQUEST['conn_attmpt'] == '1'){
    $qry_get_phone = mysqli_query($Conn1,"select cust.phone as phone,cust.name as name,cust.lname as lname, cust.email as email, cust.alt_phone as alt_phone, 
    cust.pan_card as pan_card, cust.offce_address as offce_address, cust.work_city as work_city, cust.ofc_pincode as ofc_pincode,cust.bank_id as bank_id,
    cust.account_type as account_type, cust.account_no as account_no, cust.ifsc_code as ifsc_code from tbl_mint_app as ap left JOIN tbl_mint_case as cse ON 
    ap.case_id = cse.case_id left JOIN tbl_mint_customer_info as cust ON cse.cust_id = cust.id where ap.app_id = '".$_REQUEST['application_id']."'");
    $res_get_phone = mysqli_fetch_array($qry_get_phone);
$phone_get = $res_get_phone['phone'];
$qry_search = mysqli_query($Conn1,"select count(*) as ttl from tbl_mint_partner_info where phone='".$phone_get."'");
$res_serch = mysqli_fetch_array($qry_search);
if($res_serch['ttl'] == 0){
    $qryr_insert = mysqli_query($Conn1,"Insert into tbl_mint_partner_info set name='".$res_get_phone['name']."', lname='".$res_get_phone['lname']."', phone='".$phone_get."',
    phone_no='".$phone_get."', alt_phone='".$res_get_phone['alt_phone']."',email='".$res_get_phone['email']."', pan_card='".$res_get_phone['pan_card']."',
    offce_address='".$res_get_phone['offce_address']."',work_city='".$res_get_phone['work_city']."',ofc_pincode='".$res_get_phone['ofc_pincode']."', 
    bank_id='".$res_get_phone['bank_id']."', account_type='".$res_get_phone['account_type']."',account_no='".$res_get_phone['account_no']."', ifsc_code='".$res_get_phone['ifsc_code']."'");
}
}
$qry_insert = mysqli_query($Conn1,"Insert into tbl_application_feed_back_history set app_id='".$_REQUEST['application_id']."',rating='".$_REQUEST['rating']."',bank_rating='".$_REQUEST['bank_rating']."', rating_made_by='".$_REQUEST['feed_given']."',cashback_made='".$_REQUEST['cshbck']."',mlc_experience ='".$mlc_experience."',banker_experience='".$banker_experience."',feedback='".$_REQUEST['feed_desc']."',priority_cust = '".$_REQUEST['pri_cust']."',follow_up = '".$_REQUEST['follow']."', follow_up_date = '".$_REQUEST['fol_date']."', follow_up_time = '".date("H:i", strtotime($_REQUEST['fol_time']))."',
connector_attempt='".$_REQUEST['conn_attmpt']."',follow_up_date_connector='".$_REQUEST['fol_date_connector']."', follow_up_time_connector='".date("H:i", strtotime($_REQUEST['fol_time_connector']))."',user_id='".$user."',date=NOW()");

if($_REQUEST['send_mail'] == 'Y'){
 foreach($mlc_experience_arr as $issues_mlc){
$qry_issue_mlc = mysqli_query($Conn1,"select issue_face from tbl_feed_back_issue where id='".$issues_mlc."'");
$res_issue_mlc = mysqli_fetch_array($qry_issue_mlc);
$mlc_issues_get[] = $res_issue_mlc['issue_face'];
}
foreach($banker_experience_arr as $issues_bank){
$qry_issue_bank = mysqli_query($Conn1,"select issue_face from tbl_feed_back_issue where id='".$issues_bank."'");
$res_issue_bank = mysqli_fetch_array($qry_issue_bank);
$bank_issues_get[] = $res_issue_bank['issue_face'];
}
$qry_user = mysqli_query($Conn1,"select follow_up_name from tbl_feedback_followup where id='".$_REQUEST['follow']."'");
$res_user = mysqli_fetch_array($qry_user);

$qry_user_name = mysqli_query($Conn1,"select user.email as email from tbl_application_feed_back as ap_feed left JOIN tbl_mint_app as ap ON ap_feed.app_id = ap.app_id left JOIN tbl_mint_case as cse ON ap.case_id = cse.case_id left JOIN tbl_user_assign as user ON cse.user_id = user.user_id where ap_feed.app_id='".$_REQUEST['application_id']."'");
$res_user_name = mysqli_fetch_array($qry_user_name);
$tomail = $res_user_name['email'];

$connector = mysqli_query($Conn1,"select connector_response from tbl_connector_attempts where id ='".$_REQUEST['conn_attmpt']."'");
$res_connector = mysqli_fetch_array($connector);

$message = '<table border="1" style="font-family: Roboto;font-size: 12px;color: #333333;border-width: 1px;border-color: #666666;border-collapse: collapse;">
<tr><td>MyLoanCare Service</td><td>'.$_REQUEST['rating'].'</td></tr><tr><td>Bank Service</td><td>'.$_REQUEST['bank_rating'].'</td></tr>
<tr><td>FeedBack Made By</td><td>'.$_REQUEST['feed_given'].'</td></tr>
<tr><td>Referral Provided By Customer</td><td>'.$_REQUEST['pri_cust'].'</td></tr><tr><td>Cashback Made</td><td>'.$_REQUEST['cshbck'].'</td></tr>
<tr><td>Customer Experience with MLC</td><td>'.implode(", ",$mlc_issues_get).'</td></tr><tr><td>Customer Experience with Bank</td><td>'.implode(", ",$bank_issues_get).'</td></tr>
<tr><td>FeedBack</td><td>'.$_REQUEST['feed_desc'].'</td></tr><tr><td>Follow Up</td><td>'.$res_user['follow_up_name'].'</td></tr>
<tr><td>Follow Up Date</td><td>'.$_REQUEST['fol_date'].'</td></tr><tr><td>Follow Up Time</td><td>'.$_REQUEST['fol_time'].'</td></tr>
<tr><td>Connector Attempt Response</td><td>'.$res_connector['connector_response'].'</td></tr><tr><td>Connector Follow Date</td><td>'.$_REQUEST['fol_date_connector'].'</td></tr>
<tr><td>Connector Follow Time</td><td>'.$_REQUEST['fol_time_connector'].'</td></tr>';

   $ToSubject = 'Customer FeedBack';
   $headers  = "From:info@myloancareindia.in \r\n"; 
   $headers .= "Content-type: text/html\r\n";
mail($tomail,$ToSubject,$message,$headers); }
echo "Feedback submitted successfully!!";
require_once "../../include/footer_close.php"; 
header('location:customer-feedback.php');?>