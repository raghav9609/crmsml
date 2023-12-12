<?php
require_once "../../include/check-session.php";
require_once "../../include/config.php";

$city_id = $_REQUEST['city_id'];

if($city_id != "") {
    $nearest_branch_address_exec = mysqli_query($Conn1, "SELECT branch.partner_branch_address, bank.bank_name FROM partner_branch_data AS branch LEFT JOIN tbl_bank AS bank ON bank.bank_id = branch.bank_id WHERE mlc_city_id = '".$city_id."' AND is_active = 1 GROUP BY mlc_city_id ");
    $response_data .= "<table class='gridtable' width='100%'>";
    $response_data .= "<tr class='font-weight-bold'> <th>Sr. No.</th><th>Bank Name</th><th>Branch Address</th></tr>";
    $sr_no = 0;
    while($nearest_branch_address_result = mysqli_fetch_array($nearest_branch_address_exec)) {
        ++$sr_no;
        $branch_address = $nearest_branch_address_result['partner_branch_address'];
        $bank_name      = $nearest_branch_address_result['bank_name'];
        $response_data .= "<tr align='center'>";
        $response_data .= "<td>".$sr_no."</td>";
        $response_data .= "<td>".$bank_name."</td>";
        $response_data .= "<td>".$branch_address."</td>";
        $response_data .= "</tr>";
    }
    $response_data .= "</table>";
}

echo $response_data;

// if(mysqli_num_rows($dialer_sms_exec) > 0) {
//     $response_data .= "<table  class='gridtable' width='100%'>";
//     $response_data .= "<tr class='font-weight-bold'> <th>Sr. No.</th> <th>User</th> <th>Extension</th> <th>SMS Text</th> <th>SMS Date-Time</th> </tr>";
//     $sr_no = 0;
//     while($dialer_sms_result = mysqli_fetch_array($dialer_sms_exec)) {
//         ++$sr_no;
//         $sms_text = base64_decode($dialer_sms_result['sms_text']);
//         $sms_date_time = ($dialer_sms_result['sms_date_time'] != "" && $dialer_sms_result['sms_date_time'] != "0000-00-00 00:00:00") ? date("d-m-Y h:i:s A", strtotime($dialer_sms_result['sms_date_time'])) : "--";
//         $response_data .= "<tr align='center'>";
//         $response_data .= "<td style='text-align: center'>".$sr_no."</td>";
//         $response_data .= "<td>".$dialer_sms_result['mlc_user_name']."</td>";
//         $response_data .= "<td>".$dialer_sms_result['extension_id']."</td>";
//         $response_data .= "<td>".replace_special($sms_text)."</td>";
//         $response_data .= "<td>".$sms_date_time."</td>";
//         $response_data .= "</tr>";
//     }
// }