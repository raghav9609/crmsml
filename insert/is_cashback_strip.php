<?php
require_once "../../include/check-session.php";
require_once "../../include/config.php";

$bank_id = $_REQUEST['bank_id'];
$pat_id = $_REQUEST['pat_id'];
$loan_type = $_REQUEST['loan_type'];

$partner_cashback_strip = mysqli_query($Conn1, "SELECT map_id FROM tbl_pat_loan_type_mapping WHERE bank_id = '".$bank_id."' AND loan_type = '".$loan_type."' AND is_cashback_strip = 1 LIMIT 0, 1");
if(mysqli_num_rows($partner_cashback_strip) > 0) {
    echo 1;
} else {
    echo 0;
}