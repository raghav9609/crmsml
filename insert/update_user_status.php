<?php
require_once "../../include/check-session.php";
require_once "../../include/config.php";

$user_id = $_REQUEST['user_id'];
$status = $_REQUEST['status'];
$return = array();
$check_if_exists = mysqli_query($Conn1, "select user_id from tbl_user_assign where user_id = '".$user_id."' ");
if(mysqli_num_rows($check_if_exists) > 0) {
    if($status == 0) {
        $update_if_exists = mysqli_query($Conn1, "update tbl_user_assign set status = 1 where user_id = '".$user_id."' ");
    } else {
        $update_if_exists = mysqli_query($Conn1, "update tbl_user_assign set status = 0 where user_id = '".$user_id."' ");
    }
    $return = array("status" => "1", "msg" => "successfully updated");
} else {
    $return = array("status" => "0", "msg" => "record does not exist");
}

echo json_encode($return);