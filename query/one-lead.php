<?php
$no_head = 1;
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../config/config.php');
$redirect_url = '';
$leadId = '';
$db_handle = new DBController();
$fetch_data = oneLead();
if($fetch_data[0]['query_id'] > 0 && $fetch_data[0]['priority'] > 0){
    $redirect_url = $head_url."/query/edit.php?id=".base64_encode($fetch_data[0]['query_id']);
    $leadId = $fetch_data[0]['query_id'];
}
echo json_encode(array("id"=>$leadId,"URL"=>$redirect_url,"priority"=>$fetch_data[0]['priority']));
?>