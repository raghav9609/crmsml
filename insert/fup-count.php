<?php
require_once "../../include/check-session.php";
require_once "../../include/config.php";

$level_id   = $_REQUEST['level_id'];
$level_type = $_REQUEST['level_type'];

if($level_type == "case") {
    $fup_count_query = mysqli_query($Conn1, "SELECT * FROM tbl_mint_case_followup WHERE case_id = $level_id");
    $fup_count_result = mysqli_num_rows($fup_count_query);
    echo $fup_count_result;
}