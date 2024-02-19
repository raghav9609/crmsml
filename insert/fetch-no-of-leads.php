<?php
include("../../include/check-session.php");
include("../../include/config.php");

$level_type = $_REQUEST['level_type'];
$date_from = $_REQUEST['date_from'];
$date_to = $_REQUEST['date_to'];
$period_date_from = $_REQUEST['period_date_from'];
$period_date_to = $_REQUEST['period_date_to'];
$loan_type_val = $_REQUEST['loan_type_val'];
if($loan_type_val != "") {
    $loan_type_id = implode(",", $loan_type_val);
}
$min_net_income = $_REQUEST['min_net_income'];
$max_net_income = $_REQUEST['max_net_income'];
$min_loan_amount = $_REQUEST['min_loan_amount'];
$max_loan_amount = $_REQUEST['max_loan_amount'];
$input_city_strp = $_REQUEST['input_city_strp'];            //city id
$user_assign = $_REQUEST['user_assign'];
$city_sub_group_arr = $_REQUEST['city_sub_group'];
$city_sub_group = implode(",", $city_sub_group_arr);
$status = $_REQUEST['status'];
$sub_status = $_REQUEST['sub_status'];
$sub_sub_status = $_REQUEST['sub_sub_status'];

$fil_status = "";
$status_array = [];
if(!empty($sub_sub_status)) {
    $fil_status = implode(",", $status).",".implode(",", $sub_status).",".implode(",", $sub_sub_status);
}else if(!empty($sub_status) && empty($sub_sub_status)) {
    $fil_status = implode(",", $status).",".implode(",", $sub_status);
    $status_master_query = "SELECT * FROM status_master WHERE parent_id IN ($fil_status) AND is_active_for_filter = 1 ";
    $status_exec = mysqli_query($Conn1, $status_master_query);
    if(mysqli_num_rows($status_exec) > 0) {
        while($status_result = mysqli_fetch_array($status_exec)) {
            $status_array[] = $status_result['status_id'];
        }
        $fil_status .= ",".implode(",", $status_array);
    }
}else if(empty($sub_status) && empty($sub_sub_status) && !empty($status)){
    $fil_status = implode(",", $status);
    $status_master_query = "SELECT * FROM status_master WHERE parent_id IN ($fil_status) AND is_active_for_filter = 1 ";
    $status_exec = mysqli_query($Conn1, $status_master_query);
    if(mysqli_num_rows($status_exec) > 0) {
        while($status_result = mysqli_fetch_array($status_exec)) {
            $status_array[] = $status_result['status_id'];
        }
        $fil_status .= ",".implode(",", $status_array);
    }

    $status_master_query = "SELECT * FROM status_master WHERE parent_id IN ($fil_status) AND is_active_for_filter = 1 ";
    $status_exec = mysqli_query($Conn1, $status_master_query);
    if(mysqli_num_rows($status_exec) > 0) {
        while($status_result = mysqli_fetch_array($status_exec)) {
            $status_array[] = $status_result['status_id'];
        }
        $fil_status .= ",".implode(",", $status_array);
    }
}

if($input_city_strp != "") {
    $city_name_arr = explode(",", $input_city_strp);
    $new_city_arr = [];
    foreach($city_name_arr as $key => $value) {
        $new_city_arr[] = "'".$value."'";
    }
    $city_name_str = implode(",", $new_city_arr);
    $city_list_query = mysqli_query($Conn1, "SELECT city_id FROM lms_city WHERE city_name IN ($city_name_str)");
    $city_arr = [];
    while($city_list_result = mysqli_fetch_array($city_list_query)) {
        $city_arr[] = $city_list_result['city_id'];
    }
    $city_list_ids_csv = implode(",", $city_arr);
}

$lead_query = "";
if($level_type == 1) {          #Query No. of Leads
    $lead_query = "SELECT count(query.id) AS no_of_leads FROM tbl_mint_query AS query INNER JOIN tbl_mint_query_status_detail AS stats ON stats.query_id = query.query_id INNER JOIN tbl_mint_customer_info AS customer ON customer.id = query.cust_id INNER JOIN lms_city AS city ON city.city_id = customer.city_id WHERE 1";
    if($date_from != "") {
        $lead_query .= " AND stats.date >= '".$date_from."' ";
    }
    if($date_to != "") {
        $lead_query .= " AND stats.date <= '".$date_to."' ";
    }
    if($loan_type_id != "") {
        $lead_query .= " AND query.loan_type IN ($loan_type_id) ";
    }
    if($min_net_income != "") {
        $lead_query .= " AND customer.net_incm >= '".$min_net_income."' ";
    }
    if($max_net_income != "") {
        $lead_query .= " AND customer.net_incm <= '".$max_net_income."' ";
    }
    if($min_loan_amount != "") {
        $lead_query .= " AND query.loan_amt >= '".$min_loan_amount."' ";
    }
    if($max_loan_amount != "") {
        $lead_query .= " AND query.loan_amt <= '".$max_loan_amount."' ";
    }
    if($city_list_ids_csv != "") {
        $lead_query .= " AND customer.city_id IN ($city_list_ids_csv) ";
    } else if($city_sub_group != "") {
        $lead_query .= " AND city.city_sub_group_id IN ($city_sub_group) ";
    }
    if(!empty($status)) {
        if(count(array_intersect(array(1003, 1004), $status)) === 0) {
            $lead_query .= " AND stats.query_status IN ($fil_status) ";
        } else {
            $lead_query .= " AND (stats.query_status IN ($fil_status) OR CONCAT(',', stats.other_status, ',') REGEXP ',(".$fil_status."),' ) ";
        }
    }
} else if($level_type == 2) {   #Case No. of Leads
    $lead_query = "SELECT count(cases.case_id) AS no_of_leads FROM tbl_mint_case AS cases INNER JOIN tbl_mint_customer_info AS customer ON customer.id = cases.cust_id INNER JOIN lms_city AS city ON city.city_id = customer.city_id WHERE 1 ";
    if($date_from != "") {
        $lead_query .= " AND cases.date_created >= '".$date_from."' ";
    }
    if($date_to != "") {
        $lead_query .= " AND cases.date_created <= '".$date_to."' ";
    }
    if($loan_type_id != "") {
        $lead_query .= " AND cases.loan_type IN ($loan_type_id) ";
    }
    if($min_net_income != "") {
        $lead_query .= " AND customer.net_incm >= '".$min_net_income."' ";
    }
    if($max_net_income != "") {
        $lead_query .= " AND customer.net_incm <= '".$max_net_income."' ";
    }
    if($min_loan_amount != "") {
        $lead_query .= " AND cases.required_loan_amt >= '".$min_loan_amount."' ";
    }
    if($max_loan_amount != "") {
        $lead_query .= " AND cases.required_loan_amt <= '".$max_loan_amount."' ";
    }
    if($city_list_ids_csv != "") {
        $lead_query .= " AND customer.city_id IN ($city_list_ids_csv) ";
    } else if($city_sub_group != "") {
        $lead_query .= " AND city.city_sub_group_id IN ($city_sub_group) ";
    }
    if(!empty($status)) {
        if(count(array_intersect(array(1003, 1004), $status)) === 0) {
            $lead_query .= " AND cases.case_status IN ($fil_status) ";
        } else {
            $lead_query .= " AND (cases.case_status IN ($fil_status) OR CONCAT(',', cases.other_status, ',') REGEXP ',(".$fil_status."),' ) ";
        }
    }
} else if($level_type == 3) {   #Application No. of Leads
    $lead_query = "SELECT count(app.id) AS no_of_leads FROM tbl_mint_app AS app INNER JOIN tbl_mint_case AS cases ON cases.case_id = app.case_id INNER JOIN tbl_mint_customer_info AS customer ON customer.id = cases.cust_id INNER JOIN lms_city AS city ON city.city_id = customer.city_id  WHERE 1";
    if($date_from != "") {
        $lead_query .= " AND app.date_created >= '".$date_from."' ";
    }
    if($date_to != "") {
        $lead_query .= " AND app.date_created <= '".$date_to."' ";
    }
    if($loan_type_id != "") {
        $lead_query .= " AND cases.loan_type IN ($loan_type_id) ";
    }
    if($min_net_income != "") {
        $lead_query .= " AND customer.net_incm >= '".$min_net_income."' ";
    }
    if($max_net_income != "") {
        $lead_query .= " AND customer.net_incm <= '".$max_net_income."' ";
    }
    if($min_loan_amount != "") {
        $lead_query .= " AND cases.required_loan_amt >= '".$min_loan_amount."' ";
    }
    if($max_loan_amount != "") {
        $lead_query .= " AND cases.required_loan_amt <= '".$max_loan_amount."' ";
    }
    if($city_list_ids_csv != "") {
        $lead_query .= " AND customer.city_id IN ($city_list_ids_csv) ";
    } else if($city_sub_group != "") {
        $lead_query .= " AND city.city_sub_group_id IN ($city_sub_group) ";
    }
    if(!empty($status)) {
        $lead_query .= " AND app.pre_login_status IN ($fil_status) ";
    }
    if(!empty($sub_status)) {
        $lead_query .= " AND app.app_status_on IN ($fil_status) ";
    }
    if(!empty($sub_sub_status)) {
        $lead_query .= " AND app.sub_sub_status IN ($fil_status) ";
    }
    if(count(array_intersect(array(1003, 1004), $status)) != 0) {
        $lead_query .= " AND (stats.query_status IN ($fil_status) OR CONCAT(',', stats.other_status, ',') REGEXP ',(".$fil_status."),' ) ";
    }
}

if($lead_query != "") {
    // if($user == 173) {
    //     echo $lead_query;
    // }
    $lead_query_result_obj = mysqli_query($Conn1, $lead_query);
    $lead_query_count_obj = mysqli_fetch_array($lead_query_result_obj);
    $lead_count = ($lead_query_count_obj['no_of_leads'] != "") ? $lead_query_count_obj['no_of_leads'] : 0;
    echo $lead_count;
}