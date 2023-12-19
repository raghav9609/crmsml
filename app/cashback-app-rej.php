<?php
require_once "../../include/check-session.php";
require_once "../../include/config.php";

$app_id = $_REQUEST['app_id'];
$co_id  = $_REQUEST['co_id'];
$submit = $_REQUEST['submit'];
$app_amt = $_REQUEST['app_amt'];
$grid_amt = $_REQUEST['grid_amt'];

$flag   = "";
if($submit == "Approve") {
    $flag = 1;
} else if($submit == "Reject") {
    $flag = 2;
}

$update_app_details = "UPDATE tbl_mint_app SET is_approved = $flag, approved_by = $user ";
if($submit == "Approve") {
    $update_app_details .= ", cash_offers_on = '".$app_amt."' ";
} else if($submit == "Reject") {
    $update_app_details .= ", cash_offers_on = '".$grid_amt."' ";
}
$update_app_details .= " WHERE app_id = $app_id ";
mysqli_query($Conn1, $update_app_details);

mysqli_query($Conn1, "UPDATE tbl_cashback_offered SET is_approved = $flag, approved_by = $user WHERE id = $co_id ");

header("location: approve.php?msg=1");