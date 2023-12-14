<?php
require_once "../../include/check-session.php";
require_once "../../include/config.php";
require_once "../../include/class.mailer.php";
//require_once("../mailer/class.phpmailer.php");

$name = $_REQUEST['name'];
$email = $_REQUEST['recipient_email'];
$cc_email = $_REQUEST['cc_recipient_email'];
$sender_email = $_REQUEST['sender_email'];
$subject = $_REQUEST['subject'];									
$description = $_REQUEST['description'];
$case_id = $_REQUEST['case_id'];
$temp_id = $_REQUEST['template'];											
$query_id = $_REQUEST['query_id'];       
$querysend = "INSERT INTO `tbl_mint_mail_new` (`temp_id`,`query_id`,`case_id`,`date`,`time`) VALUES ('".$temp_id."', '".$query_id."','".$case_id."',CURDATE(),CURTIME())";
$resfrm = mysqli_query($Conn1,$querysend);
if($case_id != "")
{
$query_mail = "select * from tbl_mint_mail_new where case_id = '".$case_id."' order by mail_id desc";
}
else if($query_id != ""){
$query_mail = "select * from tbl_mint_mail_new where query_id = '".$query_id."' order by mail_id desc";
}
$exe_mail   = mysqli_query($Conn1,$query_mail);
$res_mail   =  mysqli_fetch_array($exe_mail); 
$mail_id = $res_mail['mail_id'];
if($email != ''){
	
	if($case_id != ''){		$cc_id = $case_id;	} else if($query_id != ''){		$cc_id = $query_id;	} else {		$cc_id = '';	}
	/* $qry_email = mysqli_query($Conn1,"Insert into tbl_case_email_send set case_id='".$cc_id."', email='".$email."',
cc_email='".$cc_email."',pat_id='',replace_email='care@myloancare.in',
email_from='info@myloancareindia.in',subject='".$subject."', html='".base64_encode(html_entity_decode($description))."'"); */

if($temp_id == 23) {
    if(is_numeric($case_id) && $case_id > 0) {
        $case_query_level = 2;
    } else if(is_numeric($query_id) && $query_id > 0) {
        $case_query_level = 1;
    }

    $url_shared = $api_head_url."apply/customer-details.php?type_id=".base64_encode($case_query_level)."&src_id=".base64_encode($cc_id);
    mysqli_query($Conn1, "INSERT INTO lead_details_updation SET level_id = '".$case_query_level."', lead_id = '".$cc_id."', url_shared = '".$url_shared."', is_updated = 0, mlc_user_id = $user, created_on = NOW()");
}

$recep_mail = array($email);
$replytomail = array("care@myloancare.in");
$cctomail = array($cc_email);
mailSend($recep_mail,$cctomail,$replytomail,$subject,htmlspecialchars_decode($description));

   /*  $mail = new PHPMailer(true);
    $mail->AddAddress($email);
    if($cc_email != ''){
    $mail->AddCC($cc_email);}
	$mail->IsHTML(true);
    $mail->SetFrom("info@myloancareindia.in","MyLoanCare");
    $mail->AddReplyTo("care@myloancare.in","MyLoanCare");
    //$mail->AddBCC("corporate@myloancare.in");
    $mail->Subject = $subject;
    $mail->Body = html_entity_decode($description);
    try{
       $mail->Send();
    }catch(Exception $e){
        echo $e;
    } */
}


$qrysenddet = "INSERT INTO tbl_mint_mail_detail set mail_id ='".$mail_id."',subject='".$subject."',description='".htmlspecialchars_decode($description)."',cc_mail='".$cc_email."',sender_mail='info@myloancareindia.in'";
$resdet = mysqli_query($Conn1,$qrysenddet);
if($_SESSION['one_lead_flag'] == 1){
        header("location:../all_query/user.php");
    }else if($user !='' && $case_id !=''){
 header("Location:index.php");
} else if($query_id !='' && $user_role !='3') {
 header("Location:../all_query/");
}else if($query_id !='' && $user_role =='3') {
 header("Location:../all_query/user.php");
}
else {
 header("Location:index.php");
}

 ?>       
 
        
                                         
	