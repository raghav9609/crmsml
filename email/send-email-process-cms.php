<?php
require_once "../../include/check-session.php";
require_once "../../include/config.php";
require_once "../../include/class.mailer.php";

$comp_no = $_REQUEST['comp_no'];
$name = $_REQUEST['name'];
$email = $_REQUEST['recipient_email'];
$phone = $_REQUEST['contact_no'];
$cc_email = $_REQUEST['cc_recipient_email'];
$sender_email = $_REQUEST['sender_email'];
$subject = $_REQUEST['subject'];									
$description = $_REQUEST['description'];

$recep_mail = array($email);
$replytomail = array("care@myloancare.in");
$cctomail = array($cc_email);


$qrysenddet = "INSERT INTO tbl_cms_mail_detail_history set complaintNumber ='".$comp_no."',cust_name ='".$name."',cust_email ='".$email."',cust_phone ='".$phone."',subject='".$subject."',description='".htmlspecialchars_decode($description)."',cc_mail='".$cc_email."',sender_mail='info@myloancareindia.in'";
$resdet = mysqli_query($Conn1,$qrysenddet);

if(mailSend($recep_mail,$cctomail,$replytomail,$subject,htmlspecialchars_decode($description))){
    header("Location:../cms/email/index.php");
}
?>	