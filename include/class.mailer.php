<?php

$php_mailer_added = 1;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once(dirname(__FILE__) . '/PHPMailer/src/Exception.php');
require_once(dirname(__FILE__) . '/PHPMailer/src/PHPMailer.php');
require_once(dirname(__FILE__) . '/PHPMailer/src/SMTP.php');
function mailSend($recepitientMail,$ccMail,$replyMail,$subject,$body,$query_id=0){
	global $email_username,$email_password,$Conn1;
		$mail = new PHPMailer(true);

		$mail->IsSMTP();
		$mail->CharSet = "utf-8";// set charset to utf8
        $mail->SMTPDebug = 0; 
        $mail->SMTPAuth = true; // authentication enabled
        $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for GMail
		$mail->SMTPOptions = array(
			'ssl' => array(
			'verify_peer' => false,
			'verify_peer_name' => false,
			'allow_self_signed' => true
		)
	);	
		$mail->Host = 'smtp.gmail.com';
		//$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
		$mail->Port = 587;
		$mail->Username = $email_username;
		$mail->Password = $email_password;
		foreach($recepitientMail as $recptomail){
			$mail->AddAddress($recptomail);
		} 
		foreach($ccMail as $cctomail){
			$mail->AddCC($cctomail);
		}
		foreach($replyMail as $replytomail){
			$mail->AddReplyTO($replytomail);
		}
		$mail->SetFrom($email_username,$email_name);
        $mail->Subject =$subject;
        $mail->Body = $body;
        $mail->IsHTML(true);	
		if($mail->Send()){
			$message = "Message has been sent";
		}else{
			$message = "Not sent";
		}
		$recpemail = implode(',',$recepitientMail);
		 $qry = "INSERT INTO crm_communication_history SET query_id='".$query_id."',type = 1, communication_id = '".$recpemail."', cc_communication = '".implode(',',$ccMail)."', response='".$message."',subject = '".base64_encode($subject)."', description = '".base64_encode($body)."'";
		$insert_comm = mysqli_query($Conn1,$qry);
		return $message;
		
}

	
?>
