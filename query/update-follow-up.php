<?php
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../config/config.php');
$query_id = $_REQUEST['query_id'];
$f_stats = $_REQUEST['f_stats'];
$folow_given = $_REQUEST['folow_given'];
$fol_date = $_REQUEST['fol_date'];
$fol_time = $_REQUEST['fol_time'];
$remark = $_REQUEST['remark'];

if($query_id > 0 && $f_stats > 0){
    echo "update crm_query set query_status=".$f_stats.",follow_date='".$fol_date."',follow_time='".$fol_time."',follow_given_by='".$folow_given."',query_status_desc='".$remark."' where id =".$query_id;
    $update_follow_up = mysqli_query($Conn1,"update crm_query set query_status=".$f_stats.",follow_date='".$fol_date."',follow_time='".$fol_time."',follow_given_by='".$folow_given."',query_status_desc='".$remark."' where id =".$query_id);
    echo "INSERT INTO crm_follow_up_history set status_id=".$f_stats.",follow_up_date='".$fol_date."',follow_up_time='".$fol_time."',follow_up_given_by='".$folow_given."',status_type=1,user_id='".$user_id."',query_status_desc='".$remark."',lead_id ='".$query_id."'";
    $insert_follow_up = mysqli_query($Conn1,"INSERT INTO crm_follow_up_history set status_id=".$f_stats.",follow_up_date='".$fol_date."',follow_up_time='".$fol_time."',follow_up_given_by='".$folow_given."',status_type=1,user_id='".$user_id."',query_status_desc='".$remark."',lead_id ='".$query_id."'");
}
?>