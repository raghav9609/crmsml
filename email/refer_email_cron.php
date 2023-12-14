<?php
require_once "../../include/config.php";
require_once "../../include/class.mailer.php";

$query = "SELECT a.query_id, a.ref_mobile, CONCAT(e.name,' ',e.mname,' ',e.lname) AS referar_name, e.email AS referar_email,e.phone_no AS referar_mobile, CONCAT(f.name,' ',f.mname,' ',f.lname) AS referee_name,f.email AS referee_email,f.phone_no AS referee_mobile,b.case_id,b.required_loan_amt AS loan_amount,c.app_id,c.first_disb_date_on FROM tbl_mint_query AS a INNER JOIN tbl_mint_case AS b ON a.query_id = b.query_id INNER JOIN tbl_mint_app AS c ON b.case_id = c.case_id INNER JOIN tbl_mint_customer_info AS e ON a.ref_mobile = e.id INNER JOIN tbl_mint_customer_info AS f ON a.cust_id = f.id WHERE a.ref_mobile > 0 AND e.phone_no > 0 AND c.app_status_on IN (7,1099) AND DATE(c.first_disb_date_on) = DATE_SUB(CURRENT_DATE(), INTERVAL 5 DAY)";

$exe_query = mysqli_query($Conn1, $query);
$row_count = mysqli_num_rows($exe_query);
if($row_count > 0){
	while($fetch_data = mysqli_fetch_object($exe_query)){
		$referee_name = $fetch_data->referee_name;
		$referee_mobile = $fetch_data->referee_mobile;
		$referee_email = $fetch_data->referee_email;
		$referar_name = $fetch_data->referar_name;
		$referar_mobile = $fetch_data->referar_mobile;
		$referar_email = $fetch_data->referar_email;
		$loan_amount = $fetch_data->loan_amount;
		$ref_name = $referee_name;
		$name = $referar_name;
		$salutn_name = "";
		$recep_mail = array($referar_email);		
		$replytomail = array("care@myloancare.in");
		$cctomail = "";
		include('template/cashbck_referral.php');
		$subject = "Claim your Cashback now";		
		mailSend($recep_mail,$cctomail,$replytomail,$subject,$template_body);
		$qrysenddet = "INSERT INTO tbl_mint_mail_detail set mail_id ='".$referar_email."',subject='".$subject."',description='".htmlentities($template_body)."',cc_mail='".$cctomail."',sender_mail='info@myloancaremail.in'";
		$resdet = mysqli_query($Conn1,$qrysenddet);
	}
}

?>