<?php
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../config/config.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../include/helper.functions.php');
require_once(dirname(__FILE__) . '/../model/queryHelper.php');

$template = replace_special($_REQUEST['temp']);
$query_id = replace_special($_REQUEST['query_id']);

$queryModelExport = new queryModel();
echo $getQueryData = $db_handle->runQuery($queryModelExport->fetchQueryData($query_id));
$getEmailData = $db_handle->runQuery("select * from crm_communication_template where id = ".$template." and is_active =1 ");
echo json_encode(array('html_temp'=>base64_encode($getEmailData[0]['template_name']),"subject"=>$getEmailData[0]['subject']));
?>

 


   
        