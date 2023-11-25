<?php
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../config/config.php');
print_r($_POST);
if(!empty($_POST['mask'])){
	$db_handle = new DBController();
	foreach($_POST['mask'] as $value){
		$existing_user_value = $db_handle->runQuery("select assign_user from query_details where query_id = ".$value);
		$existing_user = $existing_user_value[0]['assign_user'];
		$db_handle->updateRows("Update query_details set assign_user = ".$_POST['assigned'].",assign_date_time =NOW() where query_id = ".$value);
		$db_handle->insertRows("Insert INTO lead_assign_history set level_id=1,lead_id =".$value.",assign_from ='".$existing_user."',assign_to='".$_POST['assigned']."',assign_by=".$user_id);
	}
}
header("location:index.php");
?>