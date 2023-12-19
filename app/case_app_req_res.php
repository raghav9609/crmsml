<?php
$slave =1;
require_once "../../include/config.php";
require_once "../../include/check-session.php";
$case_id = $_REQUEST['case_id'];
$query_id = $_REQUEST['query_id'];
$return_html = "";
$api_return_html = "";
$app_has_response = 0;
if(!empty($case_id)) {
    $qry_app_on = "select * from tbl_mint_app where case_id = '" . $case_id . "' order by id desc";
    $res_app_on = mysqli_query($Conn1, $qry_app_on);
    if(mysqli_num_rows($res_app_on) > 0) {
        $return_html = "<table width='' class='gridtable' id='app_rq_rs'><tbody><tr class='font-weight-bold'><th>Sr. No.</th><th>Partner</th><th>Message</th><th>Partner Reference #</th><th>API Status</th>";
        if($user_role != 3) {
            $return_html .= "<th>Download</th>";
        }
        $return_html .= "<th>API Request</th><th>API Response</th><th>Date</th></tr>";
        $sr_no = 0;
        while($exe_app_on = mysqli_fetch_array($res_app_on)) {
            if(!empty($exe_app_on['app_id'])) {
                $api_helper_qry = mysqli_query($Conn1, "SELECT GROUP_CONCAT(helper_id) AS help_id FROM api_helper WHERE api_helper.application_id = '".$exe_app_on['app_id']."' ");

                if(mysqli_num_rows($api_helper_qry) > 0) {
                    $api_helper_result  = mysqli_fetch_array($api_helper_qry);
                    $api_helper_res     = $api_helper_result['help_id'];                   
                    if( !empty($api_helper_res) ){
                        $api_return_html = getApiHelperResponse($Conn1, $api_helper_res, $sr_no, $user_role);
                        $return_html .= $api_return_html;
                    }
                }
            }
        }
        $return_html .= "</tbody></table><br>";
        if( empty($api_return_html) ) {
            $return_html = "";
        }
    }
}
if(!empty($query_id)) {

    $api_helper_qry = mysqli_query($Conn1, "SELECT GROUP_CONCAT(helper_id) AS help_id FROM api_helper WHERE api_helper.application_id = '".$query_id."' ");
    if(mysqli_num_rows($api_helper_qry) > 0) {

        $return_html = "<table width='' class='gridtable' id='app_rq_rs'><tbody><tr class='font-weight-bold'><th>Sr. No.</th><th>Partner</th><th>Message</th><th>Partner Reference #</th><th>API Status</th>";
        if($user_role != 3) {
            $return_html .= "<th>Download</th>";
        }
        $return_html .= "<th>API Request</th><th>API Response</th><th>Date</th></tr>";
        $sr_no = 0;
        $api_helper_result  = mysqli_fetch_array($api_helper_qry);
        $api_helper_res     = $api_helper_result['help_id'];  
        if( !empty($api_helper_res) ){
            $api_return_html = getApiHelperResponse($Conn1, $api_helper_res, $sr_no, $user_role);
            $return_html .= $api_return_html;
        }
        $return_html .= "</tbody></table><br>";
        if( empty($api_return_html) ) {
            $return_html = "";
        }
    }

}
echo $return_html;


function getApiHelperResponse($Conn1, $api_helper_res, $sr_no, $user_role){
    $new_api_helper_qry = mysqli_query($Conn1, "SELECT helper_id, bank_id, partner_name, request_send, response_from_api, date, massage, external_id, tbl_bank_resp_code.respcode AS respcode FROM api_helper INNER JOIN tbl_mlc_partner ON tbl_mlc_partner.partner_id = api_helper.partner_id LEFT JOIN tbl_bank_resp_code ON tbl_bank_resp_code.id = api_helper.status_id WHERE api_helper.helper_id IN (".$api_helper_res.") ORDER BY helper_id DESC");

    $returnHtml = '';

    if(mysqli_num_rows($new_api_helper_qry) > 0) {
        $app_has_response = 1;
        while($api_helper_data = mysqli_fetch_array($new_api_helper_qry)) {
            ++$sr_no;
            $bank_name_qry = mysqli_query($Conn1, "select bank_name from tbl_bank where bank_id = ".$api_helper_data['bank_id']);
            $bank_name_rows = mysqli_num_rows($bank_name_qry);
            $bank_name = "";
            if($bank_name_rows > 0) {
                $bank_details = mysqli_fetch_array($bank_name_qry);
                $bank_name = (trim($bank_details['bank_name']) != "") ? "(".$bank_details['bank_name'].")" : "";
            }
            $datetime = (date("Y-m-d", strtotime($api_helper_data['date'])) == "0000-00-00" || date("Y-m-d", strtotime($api_helper_data['date'])) == "1970-01-01" || date("Y-m-d", strtotime($api_helper_data['date'])) == "") ? "--" : date("d-m-Y h:i A", strtotime($api_helper_data['date']));

            $message = (trim($api_helper_data['massage']) != "") ? $api_helper_data['massage'] : "--";
            $external_id = (trim($api_helper_data['external_id']) != "") ? $api_helper_data['external_id'] : "--";
            $respcode = (trim($api_helper_data['respcode']) != "") ? $api_helper_data['respcode'] : "--";

            $returnHtml .= "<tr class='center-align'>
                <td style='width: 5%'>".$sr_no."</td>
                <td style='width: 10%'>".$api_helper_data['partner_name']."<br>".$bank_name."</td><td style='    word-break: break-all;'>".$message."</td><td>".$external_id."</td><td>".$respcode."</td>";

            if($user_role != 3) {
                $returnHtml .="<td><a target='_blank' href='../app/download_txt.php?id=".$api_helper_data['helper_id']."&virtual_id=".$sr_no."'>Download</a></td>";
            }

            $returnHtml .= "<td class='request_send' style='word-break: break-all; width: 45%'>".$api_helper_data['request_send']."</td>
                <td class='response_recv' style='word-break: break-all; width: 31%'>".$api_helper_data['response_from_api']."</td>
                <td style='word-break: break-all; width: 10%'>".$datetime."</td>
                </tr>
            ";
        }
    }
    return $returnHtml;
}
?>