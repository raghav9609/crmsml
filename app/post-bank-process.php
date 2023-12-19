<?php 
//include('../../include/crm-header.php');
require_once "../../include/check-session.php";
require_once "../../include/config.php";
$case_id = urldecode(base64_decode($_REQUEST['case_id']));
$bnk = replace_special($_REQUEST['bnk']);
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
$comp_name_title = "@ ".$comp_name."&nbsp;".$comp_name_other;
}if($slry_paid_name != ""){
$slry_paid_tit = "Paid by ".$slry_paid_name;
}if($ccwe != "" && $ccwe != 0){
$ccwe_tit = "CWE ".$ccwe." months";
}if($twe != '' && $twe != 0){
$twe_tit = "TWE ".$twe." months";
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

$qry_app = "select app_id,bank_crm_lead_on,bank_app_no_on,rate_of_in_on from tbl_mint_app where case_id = ".$case_id." and app_bank_on = '".$bnk."'";
$res_app = mysqli_query($Conn1,$qry_app);
$exe_app = mysqli_fetch_array($res_app);
$bank_appli_no = $exe_app['bank_app_no_on'];
$bank_crm_lead_on = $exe_app['bank_crm_lead_on'];
$app_roi = $exe_app['rate_of_in_on'];
$application_id = $exe_app['app_id'];


$contact_info_qry = mysqli_query($Conn1,"select rm_email,rm_email_flag,sm_email,sm_email_flag from tbl_bank_contact_info_new where loan_type = '".$loan_type."' and partner_id = '38' and city_id = '".$cust_city_id."'");
$result_contact_info = mysqli_fetch_array($contact_info_qry);
$rm_email= $result_contact_info['rm_email'];
$rm_email_flag = $result_contact_info['rm_email_flag'];
$sm_email= $result_contact_info['sm_email'];
$sm_email_flag = $result_contact_info['sm_email_flag'];

//$rm_email = 'anu.chhikara@myloancareindia.in';
//$sm_email = 'sumit@myloancareindia.in';
?>
<link href="<?php echo $head_url; ?>/include/css/header.css" rel="stylesheet" type="text/css" />
<fieldset  style="width:90%;margin-left:2%;"><legend><span class='red'>Please complete this form to send lead to bajaj sales. In case you do not complete this, lead will not go to the bank</span></legend>
    <form method="POST" name='email_form' id='email_form'>
    <table width="90%;">
        <tr>
            <td colspan='6'><b><span class='orange'>Check Segment in SFDC for Application Id - <span class='blue'><?php echo $application_id;?></span> and LAN No. <span class='blue'><?php echo $bank_crm_lead_on;?></span></span></b></td>
        </tr>
        <tr>
    <td class='f_14' width='15%'>Segments in SFDC :</td><td><select name='segment' id='segment' required>
	<option value=''>Check Segment in SFDC</option>
	<option value='LR'>Low Risk </option>
	<option value='MR'>Medium Risk</option>
	<option value='HR'>High Risk</option>
	<option value='VHR'>Very High Risk</option>
</select> </td>
	<td class='f_14 vh_risk hidden'>Suggestion by RM/ TL : </td><td class='f_14 vh_risk hidden'> 
	<input type='radio' name='rm_suggestion' id='rm_suggestion1' value='1' onclick='suggestion();'/>Send
	<input type='radio' name='rm_suggestion' id='rm_suggestion2' value='2' onclick='suggestion();'/>Do Not Send
	</td>
	<td class='f_14 hidden cibil'>CIBIL Score :</td><td class='f_14 hidden cibil'>
	<input type='tel' name='cibil' value='' placeholder='Enter CIBIL Score' required/>
</td>
        </tr>
        <tr></tr>
    <tr>
	<td  class='f_14 em_temp hidden'>To :</td><td class='f_14 em_temp hidden'> 
	<input type="text" name="to_email" id="to_email" value="<?php if($rm_email_flag == 1){ echo $rm_email;}?>" placeholder="To"></td>
	<td  class='f_14 em_temp hidden'>CC :</td><td class='f_14 em_temp hidden'>
	<input type="text" name="cc_email" id="cc_email" value="<?php if($sm_email_flag == 1){ echo $sm_email;}?>" placeholder="To">
	</td><td  class='f_14 em_temp hidden'>Subject:</td><td class='f_14 em_temp hidden'>
	<input type="text" name="subject"  id="subject" value="<?php echo 'New Query Personal Loan - MLC - '.$city_name.' - '.$loan_amt;?>" placeholder="Subject">
	</td></tr>
	<tr>
<td><input type="submit" name="send_email" id= "send_email" value="Submit" class='hidden'></td></tr>
    </table> 
    </form>
  
  <div id='msg_template' class='hidden'>  
<?php
echo $message = "<table width='60%;' style='font-family: verdana,arial,sans-serif;font-size:11px;color:#333333;border-width: 1px;border-color: #666666;border-collapse: collapse;'>".$fs_code."<tr>
<td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>LAN No.</td><td  style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;'>".$bank_crm_lead_on."</td></tr>
<tr>
<td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>Customer</td><td  style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;'>".$name." ".$lname."<br>".$phone."<br>".$email."<br>".$city_name."</td></tr>
<tr>
<td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>Occupation</td><td  style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;'>".$occup." ".$comp_name." "." ".$sal_title." Rs. ".$net_incm."<br>".$slry_paid_tit." ".$bank_name."<br>".$ccwe_tit." ".$twe_tit."</td></tr>
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
    ?> </div>
</fieldset>
<?php 
if($_REQUEST['send_email']){
if($_REQUEST['rm_suggestion'] == '1'){
require("../../include/class.mailer.php");
$to_email = replace_special($_REQUEST['to_email']);
$subject = replace_special($_REQUEST['subject']);
$cc_email = replace_special($_REQUEST['cc_email']);

$recep_mail = array($to_email);
$replytomail = array_filter(array("rm6@myloancare.in","harshit.taneja@myloancareindia.in","kanchan@myloancare.in",$user_email_asign));
$cctomail = array_filter(array("rm6@myloancare.in","harshit.taneja@myloancareindia.in","kanchan@myloancare.in","info@myloancare.in",$user_email_asign,$cc_email));
mailSend($recep_mail,$cctomail,$replytomail,$subject,$message);



$qry_insert_records = mysqli_query($Conn1, "Insert into tbl_bajaj_segment_record set case_id=".$case_id.",application_id='".$application_id."',user_id='".$user."',
 check_segment='".$_REQUEST['segment']."',email_to='".$to_email."',ccemail_to='".$cc_email."',subject='".$subject."',suggestion_by_rmtl='".$_REQUEST['rm_suggestion']."',
 cibil_score='".$_REQUEST['cibil']."',email_status='".$status."',date=NOW()");
 
 } 
 else if($_REQUEST['rm_suggestion'] == '2'){
     $status = "Do Not Send";
     
      $qry_insert_records = mysqli_query($Conn1, "Insert into tbl_bajaj_segment_record set case_id=".$case_id.",application_id='".$application_id."',user_id='".$user."',
 check_segment='".$_REQUEST['segment']."',email_to='".$to_email."',ccemail_to='".$cc_email."',subject='".$subject."',suggestion_by_rmtl='".$_REQUEST['rm_suggestion']."',
 cibil_score='".$_REQUEST['cibil']."',email_status='".$status."',date=NOW()");
 }
 if($_REQUEST['cibil'] != '' && $_REQUEST['cibil'] != '0'){
 $qry_update = mysqli_query($Conn1,"UPDATE tbl_mint_customer_info set bank_cibil_score ='".$_REQUEST['cibil']."' where id=".$cust_id."");
 }
header("location:".$head_url."/sugar/cases/");
}
 include("../../include/footer_close.php"); ?>
<script type="text/javascript" src="../../include/js/jquery-1.10.2.js"></script>

 <script>
$("#segment").on("change", function(){
	var val = $("#segment").val();
	if(val == 'VHR'){
	    $("#rm_suggestion1").prop("checked",false);
		$(".vh_risk,.cibil").removeClass("hidden");
		$("#send_email").removeClass("hidden");
		$("#msg_template,.em_temp,#msg_template").addClass("hidden");
	} else if(val != ''){
	    $(".vh_risk").addClass("hidden");
	    $("#rm_suggestion1").prop("checked",true);
	    $("#send_email,.em_temp,.cibil,#msg_template").removeClass("hidden");
	} else {
	    $(".vh_risk,.em_temp,.cibil,#send_email,#msg_template").addClass("hidden");
	}
});

function suggestion(){
    var check_val = $("input[name='rm_suggestion']:checked").val();
    if(check_val == '1'){
        $("#send_email,.em_temp,#msg_template").removeClass("hidden");
    } else {
       $(".em_temp,#msg_template").addClass("hidden"); 
    }
}

function closeMe(){
var win=window.open("","_self");
win.close();
}
closeMe();


</script>