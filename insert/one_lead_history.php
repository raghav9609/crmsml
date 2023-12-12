<?php
$slave = 1;
require_once "../../include/check-session.php";
require_once "../../include/config.php";

$type = $_REQUEST['type'];

$one_lead_qry = "";
if($type == "query") {
    $query_id = $_REQUEST['query_id'];
    if($query_id > 0) {
        $one_lead_qry = "select one_lead_history.id as id, one_lead_history.history_id as history_id, one_lead_history.level_id as level_id, tbl_user_assign.user_id as user_id, tbl_user_assign.user_name as user_name, one_lead_history.date as datetime, one_lead_history.search_type as search_type, one_lead_history.priority_id as priority_id from one_lead_history inner join tbl_user_assign on tbl_user_assign.user_id = one_lead_history.user_id where one_lead_history.level_id = 1 and one_lead_history.id = '".$query_id."' order by history_id desc";
    }
} else if($type == "case") {
    $query_id = $_REQUEST['query_id'];
    $case_id = $_REQUEST['case_id'];
    if($case_id > 0) {
        $one_lead_qry = "select one_lead_history.id as id, one_lead_history.history_id as history_id, one_lead_history.level_id as level_id, tbl_user_assign.user_id as user_id, tbl_user_assign.user_name as user_name, one_lead_history.date as datetime, one_lead_history.search_type as search_type, one_lead_history.priority_id as priority_id, 2 as roworder from one_lead_history inner join tbl_user_assign on tbl_user_assign.user_id = one_lead_history.user_id where one_lead_history.level_id = 2 and one_lead_history.id = '".$case_id."' UNION select one_lead_history.id as id, one_lead_history.history_id as history_id, one_lead_history.level_id as level_id, tbl_user_assign.user_id as user_id, tbl_user_assign.user_name as user_name, one_lead_history.date as datetime, one_lead_history.search_type as search_type, one_lead_history.priority_id as priority_id, 1 as roworder from one_lead_history inner join tbl_user_assign on tbl_user_assign.user_id = one_lead_history.user_id where one_lead_history.level_id = 1 and one_lead_history.id = '".$query_id."' order by roworder desc, history_id desc";
    }
} else if($type == "app") {
    $case_id = $_REQUEST['case_id'];
    if($case_id > 0) {
        $query_id = "";
        $query = "select query_id from tbl_mint_case where case_id = ".$case_id;
        $query_result = mysqli_query($Conn1, $query);
        if(mysqli_num_rows($query_result) > 0) {
            $query_res = mysqli_fetch_array($query_result);
            $query_id = $query_res['query_id'];
        }

        $one_lead_qry = "select one_lead_history.id as id, one_lead_history.history_id as history_id, one_lead_history.level_id as level_id, tbl_user_assign.user_id as user_id, tbl_user_assign.user_name as user_name, one_lead_history.date as datetime, one_lead_history.search_type as search_type, one_lead_history.priority_id as priority_id, 3 as roworder from one_lead_history inner join tbl_user_assign on tbl_user_assign.user_id = one_lead_history.user_id where one_lead_history.level_id = 3 and one_lead_history.id = '".$case_id."' UNION select one_lead_history.id as id, one_lead_history.history_id as history_id, one_lead_history.level_id as level_id, tbl_user_assign.user_id as user_id, tbl_user_assign.user_name as user_name, one_lead_history.date as datetime, one_lead_history.search_type as search_type, one_lead_history.priority_id as priority_id, 2 as roworder from one_lead_history inner join tbl_user_assign on tbl_user_assign.user_id = one_lead_history.user_id where one_lead_history.level_id = 2 and one_lead_history.id = '".$case_id."' UNION select one_lead_history.id as id, one_lead_history.history_id as history_id, one_lead_history.level_id as level_id, tbl_user_assign.user_id as user_id, tbl_user_assign.user_name as user_name, one_lead_history.date as datetime, one_lead_history.search_type as search_type, one_lead_history.priority_id as priority_id, 1 as roworder from one_lead_history inner join tbl_user_assign on tbl_user_assign.user_id = one_lead_history.user_id where one_lead_history.level_id = 1 and one_lead_history.id = '".$query_id."' order by roworder desc, history_id desc";

    }
}

if(!empty($one_lead_qry)) {
    $one_lead_exe = mysqli_query($Conn1, $one_lead_qry);
    if(mysqli_num_rows($one_lead_exe) > 0) {
        $sr_no = 0;
        $return_html = "<table  class='gridtable' width='100%'>";
        $return_html .= "<tr class='font-weight-bold'> <th>Sr. No.</th> <th>Lead Type</th> <th>Query / Case ID</th> <th>Lead Priority</th> <th>Display Type</th> <th>User</th> <th>Date-Time</th> </tr>";
        while($one_lead_res = mysqli_fetch_array($one_lead_exe)) {
            ++$sr_no;
            $lead_type = "--";
            if($one_lead_res['level_id'] == 1) {
                $lead_type = "Query";
            } else if($one_lead_res['level_id'] == 2) {
                $lead_type = "Case";
            } else if($one_lead_res['level_id'] == 3) {
                $lead_type = "Application";
            }

            $lead_id = $one_lead_res['id'];
            $user_name = (trim($one_lead_res['user_name']) != "") ? $one_lead_res['user_name'] : "--";
            $datetime = (date("Y-m-d", strtotime($one_lead_res['datetime'])) != "" && date("Y-m-d", strtotime($one_lead_res['datetime'])) != "1970-01-01" && date("Y-m-d", strtotime($one_lead_res['datetime'])) != "0000-00-00") ? date("d-m-Y H:i:s A", strtotime($one_lead_res['datetime'])) : "--";

            $priority_id = "--";
            if($one_lead_res['priority_id'] > 0) {
                $priority_id = "P".$one_lead_res['priority_id'];
            }

            $search_type = "--";
            if($one_lead_res['search_type'] != "" && $one_lead_res['search_type'] > 0) {
                if($one_lead_res['search_type'] == 1) {
                    $search_type = "One Lead";
                } else if($one_lead_res['search_type'] == 2) {
                    $search_type = "Search in One Lead";
                } else if($one_lead_res['search_type'] == 3) {
                    $search_type = "Normal";
                }
            }

            $return_html .= "<td align='center'>".$sr_no."</td><td align='center'>".$lead_type."</td><td align='center'>".$lead_id."</td><td align='center'>".$priority_id."</td><td align='center'>".$search_type."</td><td align='center'>".$user_name."</td><td align='center'>".$datetime."</td></tr>";
        }
    }
}

echo $return_html;