<?php
require_once "../../include/check-session.php";
require_once "../../include/config.php";

$cust_phone = $_REQUEST['cust_phone'];
$query_id = $_REQUEST['query_id'];
$case_id = $_REQUEST['case_id'];
$response_data = "";
if($query_id != "" || $case_id != "") {
    $dialer_sms_query = "SELECT tua.user_name AS mlc_user_name, dsh.extension_id AS extension_id, dsh.customer_phone_no AS customer_phone_no, dsh.sms_text AS sms_text, dsh.sms_date_time AS sms_date_time FROM dialer_sms_history AS dsh LEFT JOIN tbl_user_assign AS tua ON tua.user_id = dsh.user_id WHERE 1 ";
    if($query_id != "") {
        $dialer_sms_query .= " AND dsh.lead_id = '".$query_id."' ";
    } else if($case_id != "") {
        $dialer_sms_query .= " AND dsh.lead_id = '".$case_id."' ";
    }
    $dialer_sms_query .= " ORDER BY dsh.sms_date_time DESC ";
    $dialer_sms_exec = mysqli_query($Conn1, $dialer_sms_query);
    if(mysqli_num_rows($dialer_sms_exec) > 0) {
        $response_data .= "<table  class='gridtable' width='100%'>";
        $response_data .= "<tr class='font-weight-bold'> <th>Sr. No.</th> <th>User</th> <th>Extension</th> <th>SMS Text</th> <th>SMS Date-Time</th> </tr>";
        $sr_no = 0;
        while($dialer_sms_result = mysqli_fetch_array($dialer_sms_exec)) {
            ++$sr_no;
            $sms_text = base64_decode($dialer_sms_result['sms_text']);
            $sms_date_time = ($dialer_sms_result['sms_date_time'] != "" && $dialer_sms_result['sms_date_time'] != "0000-00-00 00:00:00") ? date("d-m-Y h:i:s A", strtotime($dialer_sms_result['sms_date_time'])) : "--";
            $response_data .= "<tr align='center'>";
            $response_data .= "<td style='text-align: center'>".$sr_no."</td>";
            $response_data .= "<td>".$dialer_sms_result['mlc_user_name']."</td>";
            $response_data .= "<td>".$dialer_sms_result['extension_id']."</td>";
            $response_data .= "<td>".replace_special($sms_text)."</td>";
            $response_data .= "<td>".$sms_date_time."</td>";
            $response_data .= "</tr>";
        }
    }
}
echo $response_data;