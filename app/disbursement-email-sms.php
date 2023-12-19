<?php
require_once "../../include/check-session.php";
require_once "../../include/config.php";
require_once "../../include/class.sms_helper.php";
require_once "../../include/helper.functions.php";
require("../../include/class.mailer.php");
?>
<?php
$m_app = replace_special($_REQUEST['m_app']);
$case_id = replace_special($_REQUEST['case_id']);

$qry_app = mysqli_query($Conn1,"select * from tbl_mint_app where app_id = '".$m_app."' and case_id =".$case_id."");
$result_app_qry = mysqli_fetch_array($qry_app);
$app_bank = $result_app_qry['app_bank_on'];
$cash_offers_on = $result_app_qry['cash_offers_on'];
$bank_app_no_on = $result_app_qry['bank_app_no_on'];

$case_qry = mysqli_query($Conn1,"select * from tbl_mint_case where case_id =".$case_id."");
$result_case_qry = mysqli_fetch_array($case_qry);
$loan_type = $result_case_qry['loan_type'];
$mlc_user_id = $result_case_qry['user_id'];
$cust_id = $result_case_qry['cust_id'];

$cust_qry = mysqli_query($Conn1,"select salu_id,CONCAT_WS(' ',name,lname) as name,email,phone from tbl_mint_customer_info where id =".$cust_id."");
$result_cust_qry = mysqli_fetch_array($cust_qry);
$name = $result_cust_qry['name'];
$email = $result_cust_qry['email'];
$phone = $result_cust_qry['phone'];
$salu_id = $result_cust_qry['salu_id'];

$loan_qry = mysqli_query($Conn1,"select * from lms_loan_type where loan_type_id ='".$loan_type."'");
$result_loan_qry = mysqli_fetch_array($loan_qry);
$loan_type_name = $result_loan_qry['loan_type_name'];

$bank_qry = mysqli_query($Conn1,"select * from tbl_bank where bank_id ='".$app_bank."'");
$result_bank_qry = mysqli_fetch_array($bank_qry);
$bank_name = $result_bank_qry['bank_name'];


$user_qry = mysqli_query($Conn1,"select * from tbl_user_assign where user_id ='".$mlc_user_id."'");
$result_user_qry = mysqli_fetch_array($user_qry);
$user_name = $result_user_qry['user_name'];
$contact_no = $result_user_qry['contact_no'];

$salu_qry = mysqli_query($Conn1,"select * from tbl_saluation where salutn_id ='".$salu_id."'");
$result_salu_qry = mysqli_fetch_array($salu_qry);
$salu_name = $result_salu_qry['salutn_name'];

$query_cashback = "select max(voucher) as voucher from tbl_festive_offer where loan_type_id = '".$loan_type."'";
$result_cashback = mysqli_query($Conn1,$query_cashback );
$cashback_query2 = mysqli_fetch_array($result_cashback);
$voucher = $cashback_query2['voucher'];

if($bank_app_no_on != 0 && $bank_app_no_on != ""){
$bnk_app_no = "<td  valign='top' style='font-family:calibri;padding:10px 10px 5px 10px;line-height:22px;'><strong>Loan account number: <span style='color:#ff6600;'>".$bank_app_no_on." </span> of <span style='color:#ff6600;'>".$bank_name."</span></strong></span></td>";
}

include("../email/template/crm-insert.php");
include("../email/template/disbrused-header-insert.php");
echo $message = '<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Your Cashback on Disbursement</title>
</head>
<body style="margin: auto;background: #fff8f3;font-family: Calibri, Helvetica, sans-serif;line-height: 25px;">
	<table align="center" width="100%" cellpadding="2" cellspacing="0" style="max-width: 690px; margin: 0 auto;line-height: 25px;">
		<tr>
			<td style="padding:20px 0px;font-family:Calibri, Helvetica, sans-serif; font-size:12px; color:#080808;" align="center"><td style="padding:20px 0px;font-family:Calibri, Helvetica, sans-serif; font-size:12px; color:#080808;" align="center">Your Cashback on Disbursement</td>	</td>		</tr>
	</table>
	<table cellpadding="0" cellspacing="0" style="border: 1px solid #000000;max-width: 690px;min-width:320px;text-align: center;margin: auto;background: #ffffff;border-spacing: 0px;line-height: 25px">
	'.$h_ins.'
		<tr>
                                  <td align="left" colspan="2" style="font-family:Calibri, Helvetica, sans-serif; font-size:19px; color:#002856;  padding: 0px 45px">
				<p><b>Dear '.ucwords(strtolower($salutn_name.' '.$name)).',</b></p>
				<p style="font-size: 18px">Congratulations! Your '.$loan_type_name.' has been disbursed through MyLoanCare.in. Kindly share your feedback about your experience with us at <a href="http://www.myloanmail.co.in/gbfhgnjhfijnedsfok/go4-link/login/cashback-login.php" target="_blank" style="color: #008db1;">here</a> and claim your assured cashback of Rs.'.$cash_offers_on.'.
				</p>
				<p style="font-size: 18px">We will keep you posted with news related to your loan rate changes, repo rates, MCLR rates and others and will be happy to serve you again in the future.
				</p>
				<p style="font-size: 18px">We also invite you to our Loyalty Benefits Programme - <i style="text-decoration: underline;">Refer to earn handsome referral bonus</i></p>
			</td>
		</tr>
		<tr>
			<td style="text-align: left;padding: 5px 40px; font-size: 18px" colspan="2">
				<p><b style="color: #ec6c03">How to refer your friends looking for loans to MyLoanCare.in?</b></p>
				<ul>
					<li>All existing customers of MyLoanCare.in can refer their friends and colleagues seeking a loan.</li>
				</ul>
				<p><b style="color: #ec6c03">What rewards will you get for referring leads?</b></p>
				<ul>
					<li>You would be eligible to receive referral bonus from MyLoanCare.in for each disbursed loan as per slabs applicable from time to time.</li>
				</ul>
				<p><b style="color: #ec6c03">Who can refer leads to MyLoanCare.in?</b></p>
				<ul>
					<li>Customers who would like to help their friends and colleagues looking for home loan, personal loan, gold loan, business loan, loan against property and credit card.</li>
				</ul>
				<p>To be eligible, the person must be a resident Indian citizen of at least 18 years of age and hold a valid PAN and address proof.</p>
			</td>
		</tr>
		<tr>
            <td colspan="3" style="line-height: 0; border-top:1px solid #d8d8d8; font-size: 0;" bgcolor="#ffffff" height="1">&nbsp;</td>
          </tr><tr>
            <td colspan="3" style="line-height: 0; border-top:1px solid #d8d8d8; font-size: 0;" bgcolor="#ffffff" height="1">&nbsp;</td>
          </tr>
		'.$f_ins_team_contact.$f_ins_mailer_compaign.'
      </tbody></table>
</body>
</html>';
if($message != ''){
$subject = 'Your cashback on disbursement';

if ($phone > 6000000000 && strlen($phone) == 10 && is_numeric($phone)){
$msg = "Congratulations! Your ".$loan_type_name." has been disbursed through MyLoanCare.in. Claim your cashback of Rs. ".$cash_offers_on." at https://www.myloancare.in/login/?login_as=1&sorce=cashback&utm_source=sms&utm_medium=engagement&utm_campaign=toolengagecashback";
callAPI($phone,$msg,"SHORTTSMSAPI",3,$m_app);
}
if ($email != ''){
	$recep_mail = $replytomail = array($email);
	$cctomail = array();
	mailSend($recep_mail,$cctomail,$replytomail,$subject,$message);
$update_qry = mysqli_query($Conn1,"update tbl_mint_app set disb_email_flag = 1 where app_id = '".$m_app."' and case_id =".$case_id."");
}
}
include("../../include/footer_close.php");
?>
