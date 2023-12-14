<?php
require_once "../../include/crm-header.php";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script src="<?php echo $head_url; ?>/include/js/jquery-1.3.2.min.js" type="text/javascript" type="text/javascript"></script>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
</head>
<?php 
$user = $_SESSION['user_id']; 
$case_id = replace_special($_REQUEST['case_id']); 
$query_id = replace_special($_REQUEST['id']); 
$cust_id = replace_special($_REQUEST['cust_id']);
$mail_id = replace_special($_REQUEST['mail_id']);
if ($query_id != ""){
	$qrymail = "select * from tbl_mint_mail_new where mail_id = '".$mail_id."'";
}else{
	$qrymail = "select * from tbl_mint_mail_new where mail_id = '".$mail_id."'";
}
$resmail = mysqli_query($Conn1,$qrymail);
$exemail = mysqli_fetch_array($resmail); 
$temp_id = $exemail['temp_id'];
$date 	 = $exemail['date'];
$time 	 = $exemail['time'];
$timeindia = date('H:i:s', strtotime($time . ' + 5 hours 30 minute'));

$qrymail_detail = "select * from  tbl_mint_mail_detail where mail_id = '".$mail_id."'";
$resmail_detail = mysqli_query($Conn1,$qrymail_detail);
$exemail_detail = mysqli_fetch_array($resmail_detail); 
$sub = $exemail_detail['subject'];
$description = $exemail_detail['description'];
$cc_mail = $exemail_detail['cc_mail'];
$sender_mail = $exemail_detail['sender_mail'];
$sender_mail_name ='<care@myloancaremail.in>';
if ($case_id != "")
 {
	$qrycase = "select * from tbl_mint_case where case_id = ".$case_id."";
}
else
{
	$qrycase = "select * from form_merge_data where id = ".$query_id."";
}
$rescase = mysqli_query($Conn1,$qrycase);
$execase = mysqli_fetch_array($rescase); 
$loan_type = $execase['loan_type'];
$cust_id = $execase['cust_id'];
if ($query_id != "")
{ $required_loan_amt = $execase['loan_amt']; }
else{
$required_loan_amt = $execase['required_loan_amt'];
}
if ($case_id != "")
 {
$qrycust = "select * from tbl_mint_customer_info where id = ".$cust_id."";
$rescust = mysqli_query($Conn1,$qrycust);
$execust = mysqli_fetch_array($rescust);
$name = $execust['name'];
$email = $execust['email'];
$city_id = $execust['city_id'];
$salu_id = $execust['salu_id'];
}
else{
$name = $execase['name'];
$email = $execase['email'];
$city_id = $execase['city_id'];
$salu_id = $execase['salu_id'];
}
$qrycity = "select * from lms_city where city_id = '".$city_id."'";
$rescity = mysqli_query($Conn1,$qrycity);
$execity = mysqli_fetch_array($rescity);
$city_name = $execity['city_name']; 

$qryuser = "select * from tbl_user_assign where user_id = '".$user."'";
$resuser = mysqli_query($Conn1,$qryuser);
$exeuser = mysqli_fetch_array($resuser);
$username = $exeuser['user_name'];
$contact_no = $exeuser['contact_no'];

$qrysalu = "select * from tbl_saluation where salutn_id = '".$salu_id."'";
$ressalu = mysqli_query($Conn1,$qrysalu);
$exesalu = mysqli_fetch_array($ressalu);
$salutn_name = $exesalu['salutn_name'];

$qryloan = "select * from lms_loan_type where loan_type_id = '".$loan_type."'";
$resloan = mysqli_query($Conn1,$qryloan);
$exeloan = mysqli_fetch_array($resloan);
$loan_name = $exeloan['loan_type_name'];
?>
<body>
<div align="center">
<div class="wrapper">
<table width="100%">
  <tr>
    <td><span class="bodytext">Sender Email-id </span></td>
    <td><input type="text" readonly name="sender_email" id="sender_email" value="<?php echo $sender_mail_name ; ?>"/></td>
    <td>&nbsp;</td>
    <td><span class="bodytext">Recipient Email-id  </span> </td>
    <td> <input type="text" readonly name="recipient_email" id="recipient_email" value="<?php echo $email; ?>"/></td>
  </tr>
  <tr>
    <td><span class="bodytext">CC Email-id </span> </td>
    <td> <input type="text" name="cc_recipient_email" id="cc_recipient_email" value="<?php echo $cc_mail; ?>"/></td>
    <td>&nbsp;</td>
    <td><span class="bodytext"> Name </span> </td>
    <td> <input type="text" readonly name="name" id="name" value="<?php echo $name; ?>" /></td>
  </tr>
  <tr>
   	<td><span class="bodytext"> City  </span></td>
    <td> <input type="text" name="city_name" id="city_name" readonly value="<?php echo $city_name; ?>" /></td>
    <td>&nbsp;</td>
	<td><span class="bodytext"> Loan Type </span> </td>
    <td> <input type="text" readonly name="loan_type" id="loan_type" value="<?php echo $loan_name; ?>" /></td>
  </tr>
  <tr>
    <td><span class="bodytext">Loan Amount </span> </td>
    <td><input type = "text" readonly name= "loan_amount" id="loan_amount" value="<?php echo $required_loan_amt;?>"></td>
    <td>&nbsp;</td>
    <td><span class="bodytext">Subject:</span> </td>
    <td> <input type="text" size="50" readonly name="subject" id="subject" value="<?php echo $sub; ?>" /></td>		
  </tr>
  <tr>
    <td><span class="bodytext">Date </span> </td>
    <td><?php echo $date; ?></td>
    <td>&nbsp;</td>
    <td><span class="bodytext">Time:</span> </td>
    <td><?php echo $timeindia ; ?></td>		
  </tr>
  <table>
  <tr>
            <td> <span class="bodytext">Description :</span> </td>
         <td>
		 <textarea name="description" id="description" class="CKeditor" cols="80" rows="10">
		 <?php echo $description;?></textarea>
		 <?php include('../../include/ckeditor.php');?></td>
	       	<td>&nbsp;  </td>	
	<td>&nbsp;  </td>
	<td>&nbsp;  </td>
	</tr>	        	
</table>
</table>
 </div>   
</div>
</body>
</html>
<?php include("../../include/footer_close.php"); ?>