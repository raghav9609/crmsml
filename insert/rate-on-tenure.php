<?php
require_once "../../include/config.php";

$rate_on_tenure = "";

if(isset($_REQUEST)) {
    $tenure_val = $_REQUEST['tenure_val'];
    $bank_val   = $_REQUEST['bank_val'];
    $rate_on_tenure_query = mysqli_query($Conn1, "SELECT generic_rate FROM tbl_fd_bank_tenure_rate WHERE id = '".$tenure_val."' AND bank_id IN ($bank_val) ORDER BY id DESC LIMIT 0, 1 ");
    if(mysqli_num_rows($rate_on_tenure_query) > 0) {
        $rate_on_tenure_res = mysqli_fetch_array($rate_on_tenure_query);
        $rate_on_tenure =  $rate_on_tenure_res['generic_rate'];
    }
}

echo $rate_on_tenure;

include("../../include/footer_close.php");