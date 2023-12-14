<?php
require_once "../../include/config.php";
$type = $_REQUEST['type'];
$return_html = "";

if($type == "query") {
    $qry_id = $_REQUEST['query_id'];

    $number_history_qry = "select id as query_id, user_name, source, datetime, phone_number_type from crm_show_number_history 
    inner join tbl_user_assign on tbl_user_assign.user_id = crm_show_number_history.user_id
    where source = 'query' and crm_show_number_history.id = ".$qry_id." order by h_id desc";
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
} else if($type == "case") {
    $qry_id = $_REQUEST['query_id'];
    $case_id = $_REQUEST['case_id'];

    $number_history_qry = "select id as query_id, user_name, source, datetime, phone_number_type, 1 as roworder,h_id from crm_show_number_history 
    inner join tbl_user_assign on tbl_user_assign.user_id = crm_show_number_history.user_id
    where source = 'query' and crm_show_number_history.id = ".$qry_id." UNION select id as query_id, user_name, source, datetime, phone_number_type, 2 as roworder,h_id from crm_show_number_history 
    inner join tbl_user_assign on tbl_user_assign.user_id = crm_show_number_history.user_id
    where source = 'case' and crm_show_number_history.id = ".$case_id." order by roworder desc, h_id desc";
    
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
} else if($type == "app") {
    $case_id = $_REQUEST['case_id'];
    $qry_id = "";
    $query = "select query_id from tbl_mint_case where case_id = ".$case_id;
    $query_result = mysqli_query($Conn1, $query);
    if(mysqli_num_rows($query_result) > 0) {
        $query_res = mysqli_fetch_array($query_result);
        $qry_id = $query_res['query_id'];
    }

    $number_history_qry = "select h_id, id as query_id, user_name, source, datetime, phone_number_type, 1 as roworder from crm_show_number_history 
    inner join tbl_user_assign on tbl_user_assign.user_id = crm_show_number_history.user_id
    where source = 'query' and crm_show_number_history.id = ".$qry_id." UNION select h_id, id as query_id, user_name, source, datetime, phone_number_type, 2 as roworder from crm_show_number_history 
    inner join tbl_user_assign on tbl_user_assign.user_id = crm_show_number_history.user_id
    where source = 'case' and crm_show_number_history.id = ".$case_id." order by roworder desc, h_id desc";

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
    
}else if($type == "partner") {
    $qry_id = $_REQUEST['query_id'];

    $number_history_qry = "select id as query_id, user_name, source, datetime, phone_number_type from crm_show_number_history 
    inner join tbl_user_assign on tbl_user_assign.user_id = crm_show_number_history.user_id
    where source = 'partner' and crm_show_number_history.id = ".$qry_id." order by h_id desc";
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
} 
echo $return_html;