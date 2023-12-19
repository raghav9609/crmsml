<?php
require_once "../../include/config.php";
$app_id = $_REQUEST['app_id'];
$pat_id = $_REQUEST['pat_id'];
// $app_id = 1556018358704;
$return_html = "";
if(!empty($app_id)) {
    $api_helper_qry = mysqli_query($Conn1, "select partner_name, request_send, response_from_api, date from api_helper inner join tbl_mlc_partner on tbl_mlc_partner.partner_id = api_helper.partner_id where api_helper.application_id = '".$app_id."' and api_helper.partner_id = '".$pat_id."'");
    if(mysqli_num_rows($api_helper_qry) > 0) {
        $return_html = "<table width='' class='gridtable'><tbody>
        <tr>
        <th>Partner</th><th>API Request</th><th>API Response</th><th>Date</th>
        </tr>";
        while($api_helper_data = mysqli_fetch_array($api_helper_qry)) {
            $datetime = (date("Y-m-d", strtotime($api_helper_data['date'])) == "0000-00-00" || date("Y-m-d", strtotime($api_helper_data['date'])) == "1970-01-01" || date("Y-m-d", strtotime($api_helper_data['date'])) == "") ? "--" : date("d-m-Y h:i A", strtotime($api_helper_data['date']));
            $return_html .= "<tr>
                <td>".$api_helper_data['partner_name']."</td>
                <td style='word-break: break-all'>".$api_helper_data['request_send']."</td>
                <td style='word-break: break-all'>".$api_helper_data['response_from_api']."</td>
                <td style='word-break: break-all; width: 8%'>".$datetime."</td>
                </tr>
            ";
        }
    $return_html .= "</tbody></table><br>"; 
    }
}
echo $return_html;
?>