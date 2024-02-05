<?php
require_once(dirname(__FILE__) . '/../config/session.php');
echo "Hellllloooooooo";      

require_once(dirname(__FILE__) . '/../config/config.php');
echo "Hellllloooooooo";      

require_once(dirname(__FILE__) . '/../include/class.mailer.php');

echo "Hellllloooooooo";      

$email = array("raghav9609@gmail.com"); //explode(",",$_REQUEST['recipient_email']);
$cc_email = explode(",",$_REQUEST['cc_recipient_email']);
$sender_email = $_REQUEST['sender_email'];
$subject = $_REQUEST['subject'];									
$description = $_REQUEST['description'];
$temp_id = $_REQUEST['template'];											
$query_id = $_REQUEST['query_id']; 
if($email != ''){

    
$recep_mail = $email;
$replytomail = array();
$cctomail = $cc_email;
mailSend($recep_mail,$cctomail,$replytomail,$subject,htmlspecialchars_decode($description));
}


// $qrysenddet = "INSERT INTO tbl_mint_mail_detail set mail_id ='".$mail_id."',subject='".$subject."',description='".htmlspecialchars_decode($description)."',cc_mail='".$cc_email."',sender_mail='info@myloancareindia.in'";
// $resdet = mysqli_query($Conn1,$qrysenddet);
// header("Location:index.php");
?>       
 
        
                                         
	