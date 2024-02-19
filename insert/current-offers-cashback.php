<?php
require_once "../../include/check-session.php";
require_once "../../include/config.php";
require_once "../../include/helper.functions.php";

$loan_type  = $_REQUEST['loan_type'];
$disb_amt   = $_REQUEST['disb_amt'];

$current_offers_query = "SELECT voucher FROM tbl_festive_offer WHERE loan_type_id = $loan_type AND $disb_amt < max_loan_amt ORDER BY max_loan_amt ASC LIMIT 0, 1 ";
$current_offers_execute = mysqli_query($Conn1, $current_offers_query);

if(mysqli_num_rows($current_offers_execute) > 0) {
    $current_offers_results = mysqli_fetch_array($current_offers_execute);
    echo $current_offers_results['voucher'];
} else {
    echo 0;
}

include("../../include/footer_close.php");
?>