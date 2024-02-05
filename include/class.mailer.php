<?php
$php_mailer_added = 1;
require_once "PHPMailer/PHPMailerAutoload.php";
function mailSend($recepitientMail,$ccMail,$replyMail,$subject,$body){
	global $Conn1;
		$mail = new PHPMailer();
			$mail->SMTPOptions = array(
				'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
			)
		);
		$mail->IsSMTP();
        $mail->SMTPDebug = 0; 
        $mail->SMTPAuth = true; // authentication enabled
        $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for GMail
			$mail->Host = 'smtp.gmail.com';
			$mail->Port = 465;
			$mail->Username = 'care@switchmyloan.in';
			$mail->Password = 'SML2023@123';
		
		foreach($recepitientMail as $recptomail){
			$mail->AddAddress($recptomail);
		} 
		foreach($ccMail as $cctomail){
			$mail->AddCC($cctomail);
		}$mail->AddBCC("dump@myloancareindia.in");
		foreach($replyMail as $replytomail){
			$mail->AddReplyTO($replytomail);
		}
		//$mail->AddBCC("sumit@myloancareindia.in");
		$mail->SetFrom('info@myloancaremail.in', 'MyLoanCare');
        $mail->Subject =$subject;
        $mail->Body = $body;
        $mail->IsHTML(true);	
		if($mail->Send()){
			$message = "Message has been sent";
		}else{
			$message = "Not sent";
		}
		$insert = mysqli_query($Conn1,"insert into crm_mail_send_history set email_to = '".implode(',',$recepitientMail)."',cc_email='".implode(',',$ccMail)."',reply_email='".implode(',',$replyMail)."',subject='".base64_encode($subject)."',mail_body='".base64_encode($body)."',sender_email='info@myloancareindia.in',date=NOW(),status_from_mailer='".$message."'");
		return $message;
}
?>
