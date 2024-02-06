<?php
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../config/config.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../include/helper.functions.php');
require_once(dirname(__FILE__) . '/../model/queryHelper.php');
$template = replace_special($_REQUEST['temp']);
$query_id = replace_special($_REQUEST['query_id']);
$queryModelExport = new queryModel();
$getQueryData = $db_handle->runQuery($queryModelExport->fetchQueryData($query_id));
$getEmailData = $db_handle->runQuery("select * from crm_communication_template where id = ".$template." and is_active =1 and type = 2");
$cc_email_id = $getQueryData[0]['cc_email_id'];
$customer_email_id = $getQueryData[0]['customer_phone_no'];
$final_template = str_replace(array("{customer_name}","{agent_name}","{agent_number}","{loan_amount}","{application_id}"),array(ucfirst($getQueryData[0]['customer_name']),ucfirst($getQueryData[0]['user_name']),'+91-'.$getQueryData[0]['agent_no'],$getQueryData[0]['loan_amount'],$query_id),$getEmailData[0]['description']);
echo json_encode(array('html_temp'=>base64_encode($final_template),"subject"=>$customer_email_id));
?>

 


   
        