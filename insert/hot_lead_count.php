<?php
require_once "../../include/check-session.php";
require_once "../../include/config.php";
require_once "../../include/helper.functions.php";
$return_result = array();
$query_id = $_REQUEST['query_id'];
$case_id = $_REQUEST['case_id'];
$type = $_REQUEST['type'];
$assigned_user_query = "";
if($type == "query") {
    $assigned_user_query = "select q_status_id, query_id, user_id from tbl_mint_query_status_detail where query_id = $query_id";
} else if($type == "case") {
    $assigned_user_query = "select case_id, user_id from tbl_mint_case where case_id = $case_id";
}

if($assigned_user_query != "") {
    $assigned_user_exe = mysqli_query($Conn1, $assigned_user_query);
    $assigned_user_id = "";
    if(count($assigned_user_exe) > 0) {
        $assigned_user_result = mysqli_fetch_array($assigned_user_exe);
        $assigned_user_id = $assigned_user_result['user_id'];
    }

    if($assigned_user_id == $user) {
        $hot_lead_count_qry = "select user_id, hot_lead_limit from tbl_user_assign where user_id = $assigned_user_id";
        $hot_lead_count_exe = mysqli_query($Conn1, $hot_lead_count_qry);
        $hot_lead_limit = 0;
        if(count($hot_lead_count_exe) > 0) {
            $hot_lead_count_result = mysqli_fetch_array($hot_lead_count_exe);
            $hot_lead_limit = $hot_lead_count_result['hot_lead_limit'];
        }

        $query_hot_lead = "select count(q_status_id) as hot_lead_count from tbl_mint_query_status_detail where user_id = $assigned_user_id and hot_case = 1;";
        $query_hot_lead_exe = mysqli_query($Conn1, $query_hot_lead);
        $total_query_hot_lead = 0;
        $query_hot_lead_res = mysqli_fetch_array($query_hot_lead_exe);
        $total_query_hot_lead = $query_hot_lead_res['hot_lead_count'];

        $case_hot_lead = "select count(case_id) as hot_lead_count from tbl_mint_case where user_id = $assigned_user_id and hot_case = 1;";
        $case_hot_lead_exe = mysqli_query($Conn1, $case_hot_lead);
        $total_case_hot_lead = 0;
        $case_hot_lead_res = mysqli_fetch_array($case_hot_lead_exe);
        $total_case_hot_lead = $case_hot_lead_res['hot_lead_count'];

        if($hot_lead_limit > ($total_query_hot_lead + $total_case_hot_lead)) {
            $return_result = array("status" => 1);
        } else {
            $return_result = array("status" => 0);
        }
    } else {
        $return_result = array("status" => 1);
    }
} else {
    $return_result = array("status" => 1);
}

echo json_encode($return_result);