<?php
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../config/config.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../include/class.mailer.php');

$subject = $_REQUEST['subject'];									
$description = $_REQUEST['description'];
$temp_id = $_REQUEST['template'];											
$query_id = $_REQUEST['query_id']; 
$url= 'https://bulkpush.mytoday.com/BulkSms/SingleMsgApi?feedid=385302&username=9920706289&password=SML2021@123&senderid=SML&To=91'.$subject.'&Text='.$description;
$response = curl_get_helper($url);
$qry = "INSERT INTO crm_communication_history SET type = 2, communication_id = '".$subject."',response='".base64_encode($response)."',description = '".base64_encode($description)."'";
		$insert_comm = mysqli_query($Conn1,$qry);
        echo '<script>window.location.href = "'.$head_url.'/query/";</script>';
        ?>       
 
        
                                         
	