<?php
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../config/config.php');
require_once(dirname(__FILE__) . '/../include/class.mailer.php');
$email = array("raghav9609@gmail.com"); //explode(",",$_REQUEST['recipient_email']);
$cc_email = explode(",",$_REQUEST['cc_recipient_email']);
$sender_email = $_REQUEST['sender_email'];
$subject = $_REQUEST['subject'];									
$description = $_REQUEST['description'];
$temp_id = $_REQUEST['template'];											
$query_id = $_REQUEST['query_id']; 
if(!empty($email)){
$recep_mail = $email;
$replytomail = array();
$cctomail = $cc_email;
mailSend($recep_mail,$cctomail,$replytomail,$subject,htmlspecialchars_decode($description));
}
?>       
 <script>
window.location.href = head_url+"/query";

 </script>
        
                                         
	