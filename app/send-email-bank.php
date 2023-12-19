<?php 
require_once "../../include/check-session.php";
require_once "../../include/config.php";
$case_id = urldecode(base64_decode($_REQUEST['case_id']));
$bnk = replace_special($_REQUEST['bnk']);
$loan_type = replace_special($_REQUEST['loan_type']);
$get_partner_id = mysqli_query($Conn1,"select pat_id from tbl_pat_loan_type_mapping where loan_type ='".$loan_type."' and bank_id = '".$bnk."'");
$result_partner_id = mysqli_fetch_array($get_partner_id);
$partner_id = $result_partner_id['pat_id'];
$qry_sugar = "select * from tbl_mint_case where case_id = ".$case_id."";
$res_sugar = mysqli_query($Conn1,$qry_sugar) or die(mysqli_error($Conn1));
$fetch_sugar	= mysqli_fetch_array($res_sugar);
$cust_id = $fetch_sugar['cust_id'];
$query_id = $fetch_sugar['query_id'];
$loan_type = $fetch_sugar['loan_type'];
$case_date_created = $fetch_sugar['date_created'];
$timeindia = date("H:i a", strtotime($case_time));
$assign_user_id = $fetch_sugar['user_id'];
$loan_amt = $fetch_sugar['required_loan_amt'];
$exstning_loan_amt = $fetch_sugar['ext_amt'];
$rented_id = $fetch_sugar['residential_id'];
$secd_user_id = $fetch_sugar['secd_user_id'];
$date_time  = date('Y/m/d h:i:s a');

$qry = "select * from tbl_mint_customer_info where id =".$cust_id."";
$res = mysqli_query($Conn1,$qry) or die(mysqli_error($Conn1));
$fetch	= mysqli_fetch_array($res);
$salu_id = $fetch['salu_id'];
$name = $fetch['name'];
$lname = $fetch['lname'];
$phone = $fetch['phone'];
$email = $fetch['email'];
$occup_id   = $fetch['occup_id'];
$net_incm = $fetch['net_incm'];
$comp_name_other = $fetch['comp_name_other'];
$comp_id = $fetch['comp_id'];
$cust_city_id = $fetch['city_id'];
$main_account = $fetch['bank_id'];	

$qrycomp = "select * from pl_company where comp_id = '".$comp_id."'";
$rescomp = mysqli_query($Conn1,$qrycomp);
$execomp = mysqli_fetch_array($rescomp);
$comp_name  = $execomp['comp_name'];

$qrybank = "select * from tbl_bank where bank_id = '".$main_account."'";
$resbank = mysqli_query($Conn1,$qrybank);
$exebank = mysqli_fetch_array($resbank);
$bank_name  = $exebank['bank_name'];

$qry_int = "select * from tbl_mint_cust_info_intt where cust_id =".$cust_id."";
$res_int = mysqli_query($Conn1,$qry_int) or die(mysqli_error($Conn1));
$fetch_int= mysqli_fetch_array($res_int);
$pin_code = $fetch_int['pincode'];
$ccwe = $fetch_int['cur_comp_wrk_exp'];
$twe = $fetch_int['totl_wrk_exp'];
$salary_pay_id =  $fetch_int['salary_pay_id'];

$city_sub_group = mysqli_query($Conn1,"select * from lms_city where city_id = '".$cust_city_id."'");
$result_sub_group  = mysqli_fetch_array($city_sub_group);
$city_name = $result_sub_group['city_name'];
$cst_sub_group_id = $result_sub_group['city_sub_group_id'];


$qry_mint = "select * from tbl_mint_case_detail where case_id = ".$case_id."";
$res_mint = mysqli_query($Conn1,$qry_mint) or die(mysqli_error($Conn1));
$fetch_mint = mysqli_fetch_array($res_mint);
$mlc_patner = $fetch_mint['mlc_partner'];
$mlc_partner_id = explode('/', $mlc_patner);
$descc = $fetch_mint['descc'];
$addrs_proof = explode("/",$fetch_mint['addrs_proof']);


$qry_loan_typ = mysqli_query($Conn1,"select * from lms_loan_type where loan_type_id = '".$loan_type."'");
$result_loan_qry = mysqli_fetch_array($qry_loan_typ);
$loan_name = $result_loan_qry['loan_type_name'];

$qry_occu = mysqli_query($Conn1,"SELECT * FROM lms_occupation where occupation_id = '".$occup_id ."'");
$result_occu_qry = mysqli_fetch_array($qry_occu);
$occu_name = $result_occu_qry['occupation_name'];
 
$qry_user = mysqli_query($Conn1,"SELECT * FROM tbl_user_assign where user_id = '".$assign_user_id."'");
$result_user_qry = mysqli_fetch_array($qry_user);
$user_name_asign = $result_user_qry['user_name'];
$user_email_asign = $result_user_qry['email'];
$user_mobile_asign = $result_user_qry['contact_no'];

$get_tl_email_user = mysqli_query($Conn1, "select GROUP_CONCAT(user.email SEPARATOR ',') as tl_email from tl_user_assignment as assign left join tbl_user_assign as user on assign.tl_id = user.user_id
left join tl_loan_type_assign as ltype on assign.tl_id = ltype.tl_id where user.status = 1 and assign.user_id = '" . $assign_user_id . "' and assign.tl_id <> 356  and ltype.loan_type = '" . $loan_type . "'");
$result_emaol_tl_user = mysqli_fetch_array($get_tl_email_user);
$tl_email_array = explode(",", $result_emaol_tl_user['tl_email']);

$sec_qry_loan = mysqli_query($Conn1,"SELECT loan_type_name FROM lms_loan_type where loan_type_id = '".$loan_type."'");
$result_sec_loan = mysqli_fetch_array($sec_qry_loan);
$loan_type_name = $result_sec_loan['loan_type_name'];

$sec_qry_user = mysqli_query($Conn1,"SELECT email FROM tbl_user_assign where user_id = '".$secd_user_id."'");
$result_sec_user= mysqli_fetch_array($sec_qry_user);
$sec_user_email = $result_sec_user['email'];

$qry_salutation = mysqli_query($Conn1,"SELECT * FROM tbl_saluation where salutn_id = '".$salu_id."'");
$result_salutation_qry = mysqli_fetch_array($qry_salutation);
$salutation_name = $result_salutation_qry['salutn_name'];

$qry_slry_paid= mysqli_query($Conn1,"SELECT * FROM tbl_salary_py_method where paid_id = '".$salary_pay_id."'");
$result_slry_paid = mysqli_fetch_array($qry_slry_paid);
$slry_paid_name = $result_slry_paid['paid_type'];

$qry_residential= mysqli_query($Conn1,"SELECT * FROM tbl_residential_type where rented_id = '".$rented_id."'");
$result_residential = mysqli_fetch_array($qry_residential);
$residential_name = $result_residential['residential_name'];

$qryext_bank = "select * from tbl_bank where bank_id = '".$exstn_bank."'";
$resext_bank = mysqli_query($Conn1,$qryext_bank);
$exeext_bank = mysqli_fetch_array($resext_bank);
$ext_bank_name  = $exeext_bank['bank_name'];


foreach($addrs_proof as $ad_key => $ad_proof){
$qry_addrs_proof = mysqli_query($Conn1,"SELECT * FROM tbl_address_proof where proof_id = '".$ad_proof."'");
$result_addrs_proof = mysqli_fetch_array($qry_addrs_proof);
$addrs_proof_name[] = $result_addrs_proof['proof_name'];
}

$adrs_pro = implode(', ',$addrs_proof_name);

if($occup_id != 1){
$sal_title = 'Net Monthly Income';
}else{
$sal_title = 'NTH';
}
if($comp_name != "" || $comp_name_other != ""){
$comp_name_title =  $comp_name."&nbsp;".$comp_name_other;
}if($slry_paid_name != ""){
$slry_paid_tit = "Paid by ".$slry_paid_name;
}if($ccwe != "" && $ccwe != 0){
$ccwe_tit = "CWE ".$ccwe."months";
}if($twe != '' && $twe != 0){
$twe_tit = "TWE ".$twe."months";
}if($asset_name != "" && $loan_type == 54){
$asset_tit = $asset_name;
}if($prop_identified == 'N' || $prop_identified == ""){
$iden_prop_tit = "(Property Not Identified)";
}if($prop_market_val !=0 && $prop_market_val != ''){
$prop_market_tit = "Market Value Rs. ".$prop_market_val;
}if($loan_nature == 2){
if($exstn_bank != "" && $cur_rate != "" && $cur_rate != '0.00'){
$ext_roi_tit = "@ ".$cur_rate."%";
}else{
$ext_roi_tit = $cur_rate."%";
}
}

$qry_cust_loans = "select * from tbl_mint_cust_loans where cust_id =".$cust_id."";
$res_cust_loans = mysqli_query($Conn1,$qry_cust_loans) or die(mysqli_error($Conn1));
$fetch_cust_loans = mysqli_fetch_array($res_cust_loans);
$exis_loans = $fetch_cust_loans['no_of_loan'];
$emi_of_loan	= $fetch_cust_loans['emi_of_loan'];
$emi_of_loan_all 	=(explode("/",$emi_of_loan ));
$bank		= $fetch_cust_loans['bank'];
$bank_all 	=(explode("/",$bank ));
$type_of_loan 	= $fetch_cust_loans['type_of_loan'];
$type_of_loan_all 	=(explode("/",$type_of_loan));
$credit_running  = $fetch_cust_loans['no_of_credit_card'];
$bank_card		= $fetch_cust_loans['bank_card'];
$bank_card_all = explode("/",$bank_card);
$sanction_amt_card 	= $fetch_cust_loans['sanction_amt_card'];
$sanction_amt_card_all 	=(explode("/",$sanction_amt_card ));
$cur_out_stan_card 	= $fetch_cust_loans['cur_out_stan_card'];
$cur_out_stan_card_all 	=(explode("/",$cur_out_stan_card ));

for($i = 0;$i<$exis_loans;$i++){
$exis_loan_bnk = mysqli_query($Conn1,"select * from tbl_bank where bank_id = '".$bank_all[$i]."'");
$result_exis_loan_bnk = mysqli_fetch_array($exis_loan_bnk);
$exis_bank_name = $result_exis_loan_bnk['bank_name'];

$exis_loan_type = mysqli_query($Conn1,"select * from lms_loan_type where loan_type_id = '".$type_of_loan_all[$i]."'");
$result_exis_loan_type = mysqli_fetch_array($exis_loan_type);
$exis_loan_type_name = $result_exis_loan_type['loan_type_name'];
$exis_loan_det[] = $exis_loan_type_name." of Rs. ".$emi_of_loan_all[$i]." from ".$exis_bank_name;
}
$exis_details_loan = implode("<br>",$exis_loan_det);
for($j = 0;$j<$credit_running;$j++){
$credit_loan_bnk = mysqli_query($Conn1,"select * from tbl_bank where bank_id = '".$bank_card_all[$j]."'");
$result_credit_loan_bnk = mysqli_fetch_array($credit_loan_bnk);
$credit_bank_name = $result_credit_loan_bnk['bank_name'];
$exis_credit_det[] = "Card from ".$credit_bank_name." credit limit of Rs. ".$sanction_amt_card_all[$j]." outstanding of Rs. ".$cur_out_stan_card_all[$j];
}
$exis_details_credit = implode("<br>",$exis_credit_det);

$qry_app = "select bank_crm_lead_on,bank_app_no_on,rate_of_in_on from tbl_mint_app where case_id = ".$case_id." and app_bank_on = '".$bnk."'";
$res_app = mysqli_query($Conn1,$qry_app);
$exe_app = mysqli_fetch_array($res_app);
$bank_appli_no = $exe_app['bank_app_no_on'];
$bank_crm_lead_on = $exe_app['bank_crm_lead_on'];
$app_roi = $exe_app['rate_of_in_on'];


$contact_info_qry = mysqli_query($Conn1,"select rm_email,rm_email_flag,sm_email,sm_email_flag from tbl_bank_contact_info_new where loan_type = '".$loan_type."' and partner_id = '".$partner_id."' and city_id = '".$cust_city_id."'");
$result_contact_info = mysqli_fetch_array($contact_info_qry);
$rm_email= $result_contact_info['rm_email'];
$rm_email_flag = $result_contact_info['rm_email_flag'];
$sm_email= $result_contact_info['sm_email'];
$sm_email_flag = $result_contact_info['sm_email_flag'];
?>

<fieldset  style="width:60%;margin-left:20%;"><legend>Email Form</legend>
    <form method="POST">
    <table width="90%;">
    <tr><td>To&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="to_email" id="to_email" value="<?php if($rm_email_flag == 1 || $partner_id == 38){ echo $rm_email;}?>" placeholder="To">&nbsp;&nbsp;&nbsp;CC :&nbsp;&nbsp;&nbsp;<input type="text" name="cc_email" id="cc_email" value="<?php if($sm_email_flag == 1 || $partner_id == 38){ echo $sm_email;}?>" placeholder="To">&nbsp;&nbsp;&nbsp;<br>Subject: &nbsp;&nbsp;&nbsp;<input type="text" name="subject" style="width:30%;" id="subject" value="<?php echo 'New Query '.$loan_type_name.' - MLC - '.$city_name.' - '.$loan_amt;?>" placeholder="Subject">&nbsp;&nbsp;&nbsp;<input type="submit" name="send_email" id= "send_email" value="Send Email">&nbsp;<input type="button" name="cancel" id= "cancel" value="Cancel" onclick="closeMe();">
	<input type='hidden' name='partner_id' value='<?php echo $partner_id;?>'/></td></tr>
    </table>
    </form>
    
<?php

echo $message = "<table width='60%;' style='font-family: verdana,arial,sans-serif;font-size:11px;color:#333333;border-width: 1px;border-color: #666666;border-collapse: collapse;'>".$fs_code."<tr>
<td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>LAN No.</td><td  style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;'>".$bank_crm_lead_on."</td></tr>
<tr>
<td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>Customer</td><td  style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;'>".$name." ".$lname."<br>".$phone."<br>".$email."<br>".$city_name."</td></tr>
<tr>
<td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>Occupation</td><td  style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;'>".$occup." ".$comp_name_title." "." ".$sal_title." Rs. ".$net_incm."<br>".$slry_paid_tit." ".$bank_name."<br>".$ccwe_tit." ".$twe_tit."</td></tr>
<tr>
<td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>Loan Amount/ Type</td><td  style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;'>Rs. ".$loan_amt." / ".$loan_name."</td></tr>
<tr>
<td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>Residential Type/ Address Proof</td><td  style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;'>".$residential_name."<br>".$adrs_pro."</td></tr>
<tr>
<td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>Existing Loans & Credit Cards</td><td  style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;'>".$exis_details_loan."<br>".$exis_details_credit."</td></tr>
<tr>
<td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>Remarks</td><td  style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;'></td></tr>
<tr>
<td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>MyLoanCare User</td><td  style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;'>".$user_name_asign."</td></tr>
</table>"; 
    ?>
</fieldset>
<?php 
if($_REQUEST['send_email']){
require("../../include/class.mailer.php");
$to_email = replace_special($_REQUEST['to_email']);
$subject = replace_special($_REQUEST['subject']);
$cc_email = replace_special($_REQUEST['cc_email']);
$pat_id = replace_special($_REQUEST['partner_id']);

$get_cc_user_email_lsit = mysqli_query($Conn1,"select * from user_info_mail_dump_mapping where partner_id = '".$pat_id."' and loan_type_id = '".$loan_type."'") or die(mysqli_error($Conn1));
	$result_cc_email_list = mysqli_fetch_array($get_cc_user_email_lsit);
	$cc_email_list = $result_cc_email_list['emails_in_info_mails'].','.$user_email_asign.','.$cc_email;
	/*if($user == 173){
	    echo "select * from user_info_mail_dump_mapping where partner_id = '".$pat_id."' and loan_type_id = '".$loan_type."'";
        print_r($cc_email_list);
    }*/

	$reply_to_list = $cc_email_list.',info@myloancare.in';
	$cctomail = array_filter(explode(',',$cc_email_list));
	if(!empty(array_filter($tl_email_array))){
		$cc_email = array_merge($tl_email_array,$cctomail);
	} else {
		$cc_email = $cctomail;
	} 
	$reply_to_email = array_filter(explode(',',$reply_to_list));
$recep_mail = array($to_email);
mailSend($recep_mail,$cc_email,$replytomail,$subject,$message);
$update = mysqli_query("update tbl_bank_cse_pat_rec set banker_flag =1 where case_id = ".$case_id." and pat_id = ".$pat_id );
?>
<script>
function closeMe()
{
var win=window.open("","_self");
win.close();
}
closeMe();
</script>
<?php 
} 
include("../../include/footer_close.php"); 
?>
