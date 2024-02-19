<?php
$slave =1;
require_once "../../include/check-session.php";
require_once "../../include/config.php";

$query_id = $_REQUEST['query_id'];
$case_id = $_REQUEST['case_id'];
$unique_query_id = 0;
$return_html = "";
if($case_id > 0) {
    $query = "select query_id from tbl_mint_case where case_id = ".$case_id;
    $query_result = mysqli_query($Conn1, $query);
    if(mysqli_num_rows($query_result) > 0) {
        $query_res = mysqli_fetch_array($query_result);
        $query_id = $query_res['query_id'];
    }
}

if($query_id > 0) {
    $actual_query = "select uniq_id from tbl_mint_query where query_id = ".$query_id;
    $actual_query_result = mysqli_query($Conn1, $actual_query);
    if(mysqli_num_rows($actual_query_result) > 0) {
        $actual_query_res = mysqli_fetch_array($actual_query_result);
        $unique_query_id = $actual_query_res['uniq_id'];
    }
}

if(!is_numeric($unique_query_id) || $unique_query_id == 0){
    header("LOCATION:../../logout.php");
}

if($unique_query_id > 0) {

    $select_qry = "SELECT $query_id AS original_query_id, query_id AS unique_id, loan_type_name , user_name, page_remark , bank_name, crm_display_name, click_date_time
    FROM tbl_user_form_journey
    LEFT JOIN tbl_user_page_journey_mapp ON tbl_user_page_journey_mapp.id = tbl_user_form_journey.page_id
    LEFT JOIN tbl_bank ON tbl_bank.bank_id = tbl_user_form_journey.bank_id
    LEFT JOIN tbl_cc_card_name ON tbl_cc_card_name.card_id = tbl_user_form_journey.card_id
    LEFT JOIN tbl_user_assign on tbl_user_assign.user_id = tbl_user_form_journey.user_id
    LEFT JOIN lms_loan_type ON lms_loan_type.loan_type_id = tbl_user_form_journey.loan_type_id
    WHERE query_id = ".$unique_query_id." ORDER BY tbl_user_form_journey.id DESC";

    $select_exe = mysqli_query($Conn1, $select_qry);

    if(mysqli_num_rows($select_exe) > 0) {
        $sr_no = 0;
        $return_html = "<table  class='gridtable' width='100%'>";
        $return_html .= "<tr class='font-weight-bold'> <th>Sr. No.</th> <th>Query Id</th> <th>Form Id</th> <th>Loan Type</th> <th>User</th> <th>Page Remark</th> <th>Bank</th> <th>Card Name</th> <th>Click Date-Time</th> </tr>";
        while($select_rs = mysqli_fetch_array($select_exe)) {
            ++$sr_no;
            $original_query_id = ($select_rs['original_query_id'] > 0) ? $select_rs['original_query_id'] : "--";
            $unique_id = ($select_rs['unique_id'] > 0) ? $select_rs['unique_id'] : "--";
            $loan_type = (trim($select_rs['loan_type_name']) != "") ? $select_rs['loan_type_name'] : "--";
            $user_name = (trim($select_rs['user_name']) != "") ? $select_rs['user_name'] : "--";
            $page_remark = (trim($select_rs['page_remark']) != "") ? $select_rs['page_remark'] : "--";
            $bank_name = (trim($select_rs['bank_name']) != "") ? $select_rs['bank_name'] : "--";
            $crm_display_name = (trim($select_rs['crm_display_name']) != "") ? $select_rs['crm_display_name'] : "--";
            $click_date_time = (date("d-m-Y", strtotime($select_rs['click_date_time'])) != "" && date("d-m-Y", strtotime($select_rs['click_date_time'])) != "00-00-0000" && date("d-m-Y", strtotime($select_rs['click_date_time'])) != "01-01-1970") ? date("d-m-Y H:i:s A", strtotime($select_rs['click_date_time'])) : "--";

            $return_html .= "<td align='center'>".$sr_no."</td><td align='center'>".$original_query_id."</td><td align='center'>".$unique_id."</td><td align='center'>".$loan_type."</td><td align='center'>".$user_name."</td><td align='center'>".$page_remark."</td><td align='center'>".$bank_name."</td><td align='center'>".$crm_display_name."</td><td align='center'>".$click_date_time."</td></tr>";        
        }
    }
}

echo $return_html;