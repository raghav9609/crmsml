<?php
require_once "../config/session.php";
require_once "../config/config.php";
$type = $_REQUEST['type'];
$return_html = "";

    $qry_id = $_REQUEST['query_id'];

    $number_history_qry = "select query_id, tbl_user_assign.name, datetime, phone_number_type from crm_show_number_history 
    inner join crm_master_user as tbl_user_assign on tbl_user_assign.id = crm_show_number_history.user_id
    where crm_show_number_history.query_id = ".$qry_id." order by crm_show_number_history.id desc";
    $number_history_res = mysqli_query($Conn1, $number_history_qry);
    $number_result = mysqli_num_rows($number_history_res);
    $sr_no = 0;
    if($number_result > 0) {
        $return_html .= "<table  class='gridtable' width='100%'><tr><th>Sr. No.</th><th>Query Id</th><th>Type</th><th>Phone Type</th><th>User</th><th>Date-Time</th></tr>";
        while($num_his_results = mysqli_fetch_array($number_history_res)) {
            ++$sr_no;
            $query_id = ($num_his_results['query_id'] > 0) ? $num_his_results['query_id'] : "--";
            $user_name = (trim($num_his_results['user_name']) != "") ? $num_his_results['user_name'] : "--";
            $source = (trim($num_his_results['source'])) ? ucfirst(strtolower($num_his_results['source'])) : "--";
            $datetime = (date("Y-m-d", strtotime($num_his_results['datetime'])) != "0000-00-00" || date("Y-m-d", strtotime($num_his_results['datetime'])) != "1970-01-01" || date("Y-m-d", strtotime($num_his_results['datetime'])) != "") ? date('d-m-Y H:i:s A', strtotime($num_his_results['datetime'])) : "--";
            $phone_type = ($num_his_results['phone_number_type'] == 1) ? "Primary Mobile" : "Alternate Mobile";

            $return_html .= "<tr class='center-align'><td>".$sr_no."</td><td>".$query_id."</td><td>".$source."</td><td>".$phone_type."</td><td>".$user_name."</td><td>".$datetime."</td></tr>";
        }
        $return_html .= "</table>";
    }

echo $return_html;