<?php
require_once "../config/session.php";
require_once "../config/config.php";
$query_id = $_REQUEST['query_id'];

    $api_helper_qry = mysqli_query($Conn1, "SELECT lead_id,user.name as user_name,history.created_on FROM crm_lead_summary_history as history INNER JOIN crm_master_user as user ON history.user_id = user.id  WHERE history.lead_id = '".$query_id."' and type = 1 order by history.id desc");
    if(mysqli_num_rows($api_helper_qry) > 0) {

        $return_html = "<table width='' class='gridtable' id='app_rq_rs'><tbody>
        <tr class='font-weight-bold'><th>Sr. No.</th><th>Lead Id</th><th>User Name</th><th>Lead View Date Time</th></tr>";
        $sr_no = 0;
        while($api_helper_result  = mysqli_fetch_array($api_helper_qry)){
            $sr_no++;
            $return_html .= "<tr><td>".$sr_no."</td><td>".$api_helper_result['lead_id']."</td><td>".$api_helper_result['user_name']."</td><td>".$api_helper_result['created_on']."</td></tr>";
        }
        $return_html .= "</tbody></table><br>";
    }
echo $return_html;
?>