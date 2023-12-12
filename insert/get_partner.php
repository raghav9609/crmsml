<?php
require_once "../../include/check-session.php";
require_once "../../include/config.php";

$loan_type_id = $_REQUEST['loan_type_id'];

$output_html = "";

$partner_query = "SELECT map_id, loan_type, pat_id, partner_name FROM tbl_pat_loan_type_mapping INNER JOIN tbl_mlc_partner on tbl_mlc_partner.partner_id = tbl_pat_loan_type_mapping.pat_id WHERE loan_type = $loan_type_id ORDER BY partner_name ";
$partner_execute = mysqli_query($Conn1, $partner_query);
if(mysqli_num_rows($partner_execute) > 0) {
        $output_html .= "<option value=''>Select Partner List</option>";
    while($partner_result = mysqli_fetch_array($partner_execute)) {
        $output_html .= "<option value='".$partner_result['pat_id']."'>".$partner_result['partner_name']."</option>";
    }
} else {
    $output_html = "<option value=''>Select Partner List</option>";
}

echo $output_html;

