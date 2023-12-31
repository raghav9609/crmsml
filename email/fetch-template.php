<?php
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../include/helper.functions.php');
require_once(dirname(__FILE__) . '/../model/queryHelper.php');

$template = replace_special($_REQUEST['temp']);
$query_id = replace_special($_REQUEST['query_id']);

$queryModelExport = new queryModel();
echo $getQueryData = $queryModelExport->fetchDetails($query_id);

//echo json_encode(array('html_temp'=>base64_encode($template_body),"subject"=>$subject));
?>

 


   
        