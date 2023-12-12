<?php
require_once "../../include/config.php";
require_once "../../include/check-session.php";

$query_id = $_REQUEST['query_id'];
$return_status = array("status" => "0", "data" => "");
$latest_status_query = "select follow_id, follow_type  from tbl_mint_case_followup where query_id = '".$query_id."' order by follow_id desc limit 1";
$latest_status_exe = mysqli_query($Conn1, $latest_status_query);

if(mysqli_num_rows($latest_status_exe) > 0) {
    $latest_status_res = mysqli_fetch_array($latest_status_exe);
    $return_status = array("status" => "1", "data" => $latest_status_res['follow_type']);
}

echo json_encode($return_status);