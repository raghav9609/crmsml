<?php
require_once "../../include/config.php";
require_once "../../include/check-session.php";

$query_id = $_REQUEST['query_id'];
$case_id = $_REQUEST['case_id'];
$phone_verified = $_REQUEST['phone_verified'];

$call_attempts = "select id, call_button_type from tbl_query_click_to_call_history";
if($query_id != "") {
    $call_attempts .= " where level_type = 1 and level_id = ".$query_id." and date(entered_date) = '".date("Y-m-d")."' and status_id = 11";
}
if($case_id != "") {
    $call_attempts .= " where level_type = 2 and level_id = ".$case_id." and date(entered_date) = '".date("Y-m-d")."'";
}
$call1 = 0;
$call2 = 0;
$response = array();
$call_attempts_exe = mysqli_query($Conn1, $call_attempts);
if(mysqli_num_rows($call_attempts_exe) > 0) {
    while($call_attempts_res = mysqli_fetch_array($call_attempts_exe)) {
        if($call_attempts_res['call_button_type'] == 'call1') {
            $call1 = 1;
        }
        if($call_attempts_res['call_button_type'] == 'call2') {
            $call2 = 1;
        }
    }
    if($phone_verified == "Y") {
        if($call1 == 1 && $call2 == 1) {
            $response = array("status" => "1", "msg" => "Success");
        } else {
            $response = array("status" => "0", "msg" => "Call 1 and Call 2 attempts required.");    
        }
    } else if($phone_verified == "N") {
        if($call2 == 1) {
            $response = array("status" => "1", "msg" => "Success");
        } else {
            $response = array("status" => "0", "msg" => "Call 2 attempt required.");
        }
    }

} else {
    if($phone_verified == "Y") {
        $response = array("status" => "0", "msg" => "Call 1 and Call 2 attempts required.");
    } else if($phone_verified == "N") {
        $response = array("status" => "0", "msg" => "Call 2 attempt required.");
    }
}

echo json_encode($response);