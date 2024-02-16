<?php
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../config/config.php');
print_r($_POST);
if(!empty($_POST['mask'])){
	$db_handle = new DBController();
	foreach($_POST['mask'] as $value){
		$existing_user_value = $db_handle->runQuery("select lead_assign_to from crm_query where id = ".$value);
		$existing_user = $existing_user_value[0]['lead_assign_to'];
		$db_handle->updateRows("Update crm_query set lead_assign_to = ".$_POST['assigned'].",lead_assign_on =NOW() where id = ".$value);
		$db_handle->updateRows("Update crm_query_application set user_id = ".$_POST['assigned']." where crm_query_id = ".$value);
		$db_handle->insertRows("Insert INTO crm_lead_assignment_history set lead_id =".$value.",user_assign_from ='".$existing_user."',user_assign_to='".$_POST['assigned']."',assign_by=".$user_id);
	}
}
echo '<script>window.location.href = "'.$head_url.'/query/";</script>';
?>