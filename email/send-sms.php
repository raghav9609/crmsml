<?php
$dialog_pop_up_disabled_flag = 1;
require_once "../../include/crm-header.php";
require_once "../../include/class.sms_helper.php";
require_once "../../include/display-name-functions.php";

$case_id = urldecode(base64_decode($_REQUEST['case_id'])); 
$query_id = urldecode(base64_decode($_REQUEST['query_id'])); 
$partner_id = urldecode(base64_decode($_REQUEST['partner_id'])); 
$partner_type = urldecode(base64_decode($_REQUEST['partner_type'])); 
 
$user = $_SESSION['user_id']; 
$qry_case = 0;
if($case_id > 0 && is_numeric($case_id)){
	$qrycase = "select * from tbl_mint_case where case_id = '".$case_id."'";
	$qry_case = 1;
} else if($query_id > 0 && is_numeric($query_id)) {
	$qrycase = "select qry.cust_id as cust_id, qry.loan_type as loan_type, stats.user_id as user_id from tbl_mint_query as qry left JOIN tbl_mint_query_status_detail as stats ON qry.query_id = stats.query_id where qry.query_id = '".$query_id."'";
	$qry_case = 1;
}else if($partner_id > 0 && is_numeric($partner_id) && $partner_type ==1){
	$qry_case = 0;
	$cust_id = $partner_id;
}else if($partner_id > 0 && is_numeric($partner_id) && $partner_type == 2){
	$qrycust = "select * from tbl_mint_partner_info where partner_id = ".$partner_id."";
	$rescust = mysqli_query($Conn1,$qrycust);
	$execust = mysqli_fetch_array($rescust);
	$phone = $execust['phone'];
}
if($qry_case == 1){
	$rescase = mysqli_query($Conn1,$qrycase);
	$execase = mysqli_fetch_array($rescase); 
	$cust_id = $execase['cust_id'];
}

if($cust_id > 0 && is_numeric($cust_id)){
	$qrycust = "select * from tbl_mint_customer_info where id = ".$cust_id."";
	$rescust = mysqli_query($Conn1,$qrycust);
	$execust = mysqli_fetch_array($rescust);
	$phone = $execust['phone'];
}

if($user_role == '3'){
    $echo_number = substr_replace($phone,'XXX',4,3);
} else {
   $echo_number =  $phone;
}

$phone_encode = base64_encode($phone);
$dual_encode = base64_encode($phone_encode);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<div align="center">
<div class="wrapper">
<form name="sendemail" method="post" action="">
<table class="adminbox admintext" width="100%">
<input type = "hidden" name= "case_id" id="case_id" value="<?php echo $case_id;?>">
  <tr>
     
	 <!--<span class="bodytext">Recipient Phone_no  </span>--> 
      <td><input type="hidden"  name="recipient_phone" id="recipient_phone" value="<?php echo $dual_encode; ?>" /><span class="bodytext">Select Template:</span> </td>
         <td><select name="template" id="template" onchange="myMail_function(this.value);">
                    <option value="">Select template</option>
                    <?php if($case_id != ''){?> <option value="6">Customer- Cashback Amount</option>
                     <option value="1">Customer- Disbursed Loan</option>
                    <?php if($execase['loan_type'] == 56){ ?>
                    <option value="14">Customer- HDFC PL</option>
                <?php } ?>
					<option value="2">Customer- Tried Reaching You for Appointment</option>
					<option value="3">Customer- Tried Reaching You for documents</option>
					<option value="4">Banker- Urgent:Documents</option> 
					<option value="5">Banker- Urgent:Appointment</option> 
					<!-- <option value="11">Credit Card Disbursement</option> -->
					<option value="10">Cashe</option><?php }if($partner_id == ""){ ?>
					<!-- <option value="8">Credit Report</option> -->
					 <option value="13">Customer - Document Upload</option>
			    	<option value="9">Customer Follow up/ Ringing</option>
					<!-- <option value="12">Credit Card Document</option> -->
					<option value="15">Partner App Link</option>
					<?php }if($partner_id != '') { ?>
						<option value="16">Referral Partner - Update Profile</option>
					<?php } ?>
					<?php if($_REQUEST['case_id'] != "" && $execase['loan_type'] == '56' && in_array($user,array(173,16))) { ?>
						<option value="17">Yes Bank - Digital Consent</option>
					<?php } ?>
                  </select>       
		</td>		

</tr>
<tr>
<td>Description:- </td>
<td colspan="4">
<textarea name="description" id="email_query" cols="80" style="pointer-events:none;" rows="10"></textarea>
</td>    
</tr>
</tr>
<tr> <td><input type="submit" name="send" class="buttonsub cursor" id="send" value="Send SMS"/></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
  

        </table>
   </form>
 </div>   
</div>
</body>
</html>
<?php 
if($_REQUEST['send']){
   $temp = $_REQUEST['template'];
    $case_id = replace_special($_REQUEST['case_id']);
    $query_id = replace_special(base64_decode($_REQUEST['query_id']));
	 $phone = replace_special(base64_decode($_REQUEST['recipient_phone']));
	 $new_phone = base64_decode($phone);
     $phone_no = replace_special($new_phone);
	$msg = $_REQUEST['description'];
	$sender_id_acl = 'SHORTTSMSAPI';
	if($query_id > 0 && is_numeric($query_id)){
		$qry_flag = 1;
	}
    if($phone_no > 6000000000 && $msg != ''){
		if($case_id > 0 && is_numeric($case_id)){
			mysqli_query($Conn1,"update tbl_mint_case set sent_sms = 1 where case_id =".$case_id);
			callAPI($phone_no,$msg,'SHORTTSMSAPI',2,$case_id);

			if($case_id != '' && $user == 173 && $temp == 17) {
				$otp = rand(1234, 9999);

				$tbl_query_data_exec = mysqli_query($Conn1, "SELECT query.loan_type AS loan_type, query.uniq_id AS uniq_id, query.query_id AS query_id, query.bank_apply AS bank_apply FROM tbl_mint_case AS cases LEFT JOIN tbl_mint_query AS query ON query.query_id = cases.query_id WHERE cases.case_id = '".$case_id."' ORDER BY cases.case_id DESC LIMIT 0, 1");
				$tbl_query_data_res = mysqli_fetch_array($tbl_query_data_exec);
				$loan_type_result = get_display_name("loan_type", $tbl_query_data_res['loan_type']);

				$bank_consent_url = "https://www.myloancare.in/apply/otp-verification.php?uid=".base64_encode($tbl_query_data_res['query_id'])."&bank_apply_flag=".base64_encode(62)."&is_web=Mg==";

				#check if already exists in tbl_bank_otp_verification
				$if_otp_verification_exists = mysqli_query($Conn1, "SELECT id FROM tbl_bank_otp_verification WHERE source = 2 AND lead_id = '".$tbl_query_data_res['query_id']."' AND otp_flag = 0");
				if(mysqli_num_rows($if_otp_verification_exists) > 0) {
					mysqli_query($Conn1, "UPDATE tbl_bank_otp_verification SET otp_flag = 1 WHERE source = 2 AND lead_id = '".$tbl_query_data_res['query_id']."' AND otp_flag = 0 ");
				}

				$bank_otp_verification_query = "INSERT INTO tbl_bank_otp_verification SET otp = '".$otp."', date_time = NOW(), exp_date_time = NOW() + INTERVAL 24 HOUR, otp_flag = 0, level_type = 1, url = '".$bank_consent_url."', lead_id = '".$tbl_query_data_res['query_id']."', source = 2, partner_id = '62' ";
        		mysqli_query($Conn1, $bank_otp_verification_query);

				$custom_sms = $otp." is your MyLoanCare OTP for ".$loan_type_result." application with Yes Bank";
				callAPI($phone_no, $custom_sms, 'OTPAPI', 2, $case_id);
			}

		}else {
			if($temp == 16) {
				callAPI($phone_no, $msg, 'SHORTTSMSAPI', 5, base64_decode($_REQUEST['partner_id']));
			} else {
				callAPI($phone_no,$msg,'SHORTTSMSAPI',1,$query_id);
			}
		}
    }
	if($_REQUEST['rd_flag'] == 1) {
		header("location:../referral-system/index.php");
	} else if($case_id > 0 && is_numeric($case_id)){
		header("location:../cases/edit.php?case_id=".base64_encode($case_id));
	} else if($query_id > 0 && is_numeric($query_id)){
	header("location:../all_query/edit.php?id=".base64_encode($query_id));
	}
}
?>
<script src="<?php echo $head_url; ?>/include/js/jquery-1.10.2.js" type="text/javascript"></script>

<script language="javascript">
function myMail_function(temp_id){
 $.ajax({
			type: "POST",
			data: "temp=" + temp_id + "&case_id=<?php echo $case_id; ?>&query_id=<?php echo $query_id;?>&partner_type=<?php echo $partner_type; ?>&partner_id=<?php echo $partner_id; ?>",
			url: "sms_temp.php",
			success: function(response)
			{
                $( "#email_query" ).val(response.trim()) ;
			
			}
 });   		
  

 		  		  
}  
</script>