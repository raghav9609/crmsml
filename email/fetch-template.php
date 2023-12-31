<?php
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../config/config.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../include/helper.functions.php');
require_once(dirname(__FILE__) . '/../model/queryHelper.php');
preArray($_SESSION);
$template = replace_special($_REQUEST['temp']);
$query_id = replace_special($_REQUEST['query_id']);

$queryModelExport = new queryModel();
$getQueryData = $db_handle->runQuery($queryModelExport->fetchQueryData($query_id));
preArray($getQueryData);
$getEmailData = $db_handle->runQuery("select * from crm_communication_template where id = ".$template." and is_active =1 and type = 1");
echo json_encode(array('html_temp'=>base64_encode($getEmailData[0]['description']),"subject"=>$getEmailData[0]['subject']));
?>

 


   
        