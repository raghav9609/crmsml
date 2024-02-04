<?php
require_once "../../include/check-session.php";
require_once "../../include/config.php";
require_once "../../include/class.mailer.php";
//require_once("../mailer/class.phpmailer.php");

$email = $_REQUEST['recipient_email'];
$cc_email = $_REQUEST['cc_recipient_email'];
$sender_email = $_REQUEST['sender_email'];
$subject = $_REQUEST['subject'];									
$description = $_REQUEST['description'];
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
	

$recep_mail = array($email);
$replytomail = array("care@myloancare.in");
$cctomail = array($cc_email);
mailSend($recep_mail,$cctomail,$replytomail,$subject,htmlspecialchars_decode($description));
}


// $qrysenddet = "INSERT INTO tbl_mint_mail_detail set mail_id ='".$mail_id."',subject='".$subject."',description='".htmlspecialchars_decode($description)."',cc_mail='".$cc_email."',sender_mail='info@myloancareindia.in'";
// $resdet = mysqli_query($Conn1,$qrysenddet);
// header("Location:index.php");
?>       
 
        
                                         
	