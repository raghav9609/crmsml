<?php
require_once "../../include/check-session.php";
require_once "../../include/config.php";
require_once "../../include/helper.functions.php";

$language_id    = $_REQUEST['language_id'];
$current_status = $_REQUEST['current_status'];

$new_status     = ($current_status == 0) ? 1 : 0;

$update_language_query = "UPDATE tbl_language SET status = $new_status, date_time = NOW() WHERE id = $language_id";
mysqli_query($Conn1, $update_language_query);
$return_val = "Y";
echo $return_val;