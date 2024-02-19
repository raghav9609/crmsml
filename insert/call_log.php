<?php
$slave = 1;
require_once "../../include/check-session.php";
require_once "../../include/config.php";
require_once "../../include/display-name-functions.php";
require_once "../../include/helper.functions.php";
$type = $_REQUEST['type'];
$return_html = "";
$number_history_qry = "";
$leveltype = $_REQUEST['level_type'];

if($type == "query") {
    $qry_id = $_REQUEST['query_id'];
    $leveltype = $_REQUEST['level_type'];
    if($qry_id > 0) {
        if($leveltype !=''){ $level = $leveltype;}else{ $level = 1;}
        $number_history_qry = "select tbl_query_click_to_call_history.status_id as status_id,tbl_query_click_to_call_history.id, tbl_query_click_to_call_history.level_id, tbl_query_click_to_call_history.level_type, user_name, call_button_type, entered_date, cdr.calldate AS call_start_time, cdr.hangupdate AS hang_up_time, cdr.duration AS total_talk_time, cdr.billsec AS actual_talk_time, cdr.disposition AS disposition, cdr.call_recording_name AS call_rec_name, date(cdr.call_click_date) AS call_click_date from tbl_query_click_to_call_history 
        inner join tbl_user_assign on tbl_user_assign.user_id = tbl_query_click_to_call_history.user_id
        LEFT JOIN cdr ON tbl_query_click_to_call_history.dialer_crm_uniq_id = cdr.crmuniq_id
        where tbl_query_click_to_call_history.level_type = '".$level."' and tbl_query_click_to_call_history.level_id = ".$qry_id." order by id desc";
       
    }
} else if($type == "case") {
    $qry_id = $_REQUEST['query_id'];
    $case_id = $_REQUEST['case_id'];
    if($case_id > 0) {
        $number_history_qry = "select tbl_query_click_to_call_history.id, tbl_query_click_to_call_history.level_id, tbl_query_click_to_call_history.level_type, user_name, call_button_type, entered_date, tbl_query_click_to_call_history.status_id, 2 as roworder, cdr.calldate AS call_start_time, cdr.hangupdate AS hang_up_time, cdr.duration AS total_talk_time, cdr.billsec AS actual_talk_time, cdr.disposition AS disposition, cdr.call_recording_name AS call_rec_name, date(cdr.call_click_date) AS call_click_date from tbl_query_click_to_call_history 
        inner join tbl_user_assign on tbl_user_assign.user_id = tbl_query_click_to_call_history.user_id LEFT JOIN cdr ON cdr.crmuniq_id = tbl_query_click_to_call_history.dialer_crm_uniq_id
        where tbl_query_click_to_call_history.level_type = 2 and tbl_query_click_to_call_history.level_id = ".$case_id." 
        UNION select tbl_query_click_to_call_history.id, tbl_query_click_to_call_history.level_id, tbl_query_click_to_call_history.level_type, user_name, call_button_type, entered_date, tbl_query_click_to_call_history.status_id, 1 as roworder, cdr.calldate AS call_start_time, cdr.hangupdate AS hang_up_time, cdr.duration AS total_talk_time, cdr.billsec AS actual_talk_time, cdr.disposition AS disposition, cdr.call_recording_name AS call_rec_name, date(cdr.call_click_date) AS call_click_date from tbl_query_click_to_call_history inner join tbl_user_assign on tbl_user_assign.user_id = tbl_query_click_to_call_history.user_id LEFT JOIN cdr ON cdr.crmuniq_id = tbl_query_click_to_call_history.dialer_crm_uniq_id where tbl_query_click_to_call_history.level_type = 1 and tbl_query_click_to_call_history.level_id = ".$qry_id." order by roworder desc, id desc";
    }
} else if($type == "app") {
    $case_id = $_REQUEST['case_id'];
    if($case_id > 0) {
        $qry_id = "";
        $query = "select query_id from tbl_mint_case where case_id = ".$case_id;
        $query_result = mysqli_query($Conn1, $query);
        if(mysqli_num_rows($query_result) > 0) {
            $query_res = mysqli_fetch_array($query_result);
            $qry_id = $query_res['query_id'];
        }

        $number_history_qry = "select tbl_query_click_to_call_history.id, tbl_query_click_to_call_history.level_id, tbl_query_click_to_call_history.level_type, user_name, call_button_type, entered_date, tbl_query_click_to_call_history.status_id, 3 as roworder, cdr.calldate AS call_start_time, cdr.hangupdate AS hang_up_time, cdr.duration AS total_talk_time, cdr.billsec AS actual_talk_time, cdr.disposition AS disposition, cdr.call_recording_name AS call_rec_name, date(cdr.call_click_date) AS call_click_date from tbl_query_click_to_call_history inner join tbl_user_assign on tbl_user_assign.user_id = tbl_query_click_to_call_history.user_id LEFT JOIN cdr ON cdr.crmuniq_id = tbl_query_click_to_call_history.dialer_crm_uniq_id where tbl_query_click_to_call_history.level_type = 3 and tbl_query_click_to_call_history.level_id = ".$case_id." UNION select tbl_query_click_to_call_history.id, tbl_query_click_to_call_history.level_id, tbl_query_click_to_call_history.level_type, user_name, call_button_type, entered_date, 
               tbl_query_click_to_call_history.status_id, 2 as roworder, cdr.calldate AS call_start_time, cdr.hangupdate AS hang_up_time, cdr.duration AS total_talk_time, cdr.billsec AS actual_talk_time, cdr.disposition AS disposition, cdr.call_recording_name AS call_rec_name, date(cdr.call_click_date) AS call_click_date from tbl_query_click_to_call_history inner join tbl_user_assign on tbl_user_assign.user_id = tbl_query_click_to_call_history.user_id LEFT JOIN cdr ON cdr.crmuniq_id = tbl_query_click_to_call_history.dialer_crm_uniq_id where tbl_query_click_to_call_history.level_type = 2 and tbl_query_click_to_call_history.level_id = ".$case_id." UNION select tbl_query_click_to_call_history.id, tbl_query_click_to_call_history.level_id, tbl_query_click_to_call_history.level_type, user_name, call_button_type, entered_date, tbl_query_click_to_call_history.status_id, 1 as roworder, cdr.calldate AS call_start_time, cdr.hangupdate AS hang_up_time, cdr.duration AS total_talk_time, cdr.billsec AS actual_talk_time, cdr.disposition AS disposition, cdr.call_recording_name AS call_rec_name, date(cdr.call_click_date) AS call_click_date from tbl_query_click_to_call_history 
               inner join tbl_user_assign on tbl_user_assign.user_id = tbl_query_click_to_call_history.user_id LEFT JOIN cdr ON cdr.crmuniq_id = tbl_query_click_to_call_history.dialer_crm_uniq_id
               where tbl_query_click_to_call_history.level_type = 1 and tbl_query_click_to_call_history.level_id = ".$qry_id." order by roworder desc, tbl_query_click_to_call_history.id desc";
    }
}

if($number_history_qry != "") {
    $number_history_res = mysqli_query($Conn1, $number_history_qry);
    $number_result = mysqli_num_rows($number_history_res);
    $sr_no = 0;
    $return_html .= "<table  class='gridtable' width='100%'><tr><th>Sr. No.</th>";
         if($leveltype != 5) {
            $return_html .="<th>Level Type</th><th>Status</th>";
         }
        $return_html .="<th>ID</th><th>Button Type</th><th>User</th>";
        $return_html .= "<th>Call Start Time</th><th>Hang Up Time</th><th>Total TT (h:m:s)</th><th>Actual TT (h:m:s)</th><th>Disposition</th>";
        if($user_role == 1) {
            $return_html .= "<th>Recording File</th>";
        }
        $return_html .= "<th>Date-Time</th></tr>";
        while($num_his_results = mysqli_fetch_array($number_history_res)) {
            ++$sr_no;
            $query_id = ($num_his_results['level_id'] > 0) ? $num_his_results['level_id'] : "--";
            $call_btn_type = (trim($num_his_results['call_button_type'])) ? ucfirst(strtolower($num_his_results['call_button_type'])) : "--";
            $datetime = (date("Y-m-d", strtotime($num_his_results['entered_date'])) != "0000-00-00" || date("Y-m-d", strtotime($num_his_results['entered_date'])) != "1970-01-01" || date("Y-m-d", strtotime($num_his_results['entered_date'])) != "") ? date('d-m-Y H:i:s A', strtotime($num_his_results['entered_date'])) : "--";
            $level_type = "--";
            if($num_his_results['level_type'] == 1) {
                $level_type = "Query";
                $status_name = get_display_name('query_status',$num_his_results['status_id']);
                if($status_name == ''){
                    $status_name = get_display_name('new_status_name',$num_his_results['status_id']);
                }
            } else if($num_his_results['level_type'] == 2) {
                $level_type = "Case";
                $status_name = get_display_name('case_status',$num_his_results['status_id']);
                if($status_name == ''){
                    $status_name = get_display_name('new_status_name',$num_his_results['status_id']);
                }
            } else if($num_his_results['level_type'] == 3) {
                $level_type = "Application";
                $status_name = get_display_name('post_login',$num_his_results['status_id']);
                if($status_name == ''){
                    $status_name = get_display_name('new_status_name',$num_his_results['status_id']);
                }
            }

            $user_name = ($num_his_results['user_name'] != "") ? $num_his_results['user_name'] : "--";
            // if($type == "query" || $type == "case") {
                $query_status = ($status_name != "") ? $status_name : "--";
            // }

            $call_start_time    = ($num_his_results['call_start_time'] != "" && $num_his_results['call_start_time'] != "0000-00-00 00:00:00") ? date("d-m-Y h:i:s A", strtotime($num_his_results['call_start_time'])) : "--";
            $hang_up_time       = ($num_his_results['hang_up_time'] != "" && $num_his_results['hang_up_time'] != "0000-00-00 00:00:00") ? date("d-m-Y h:i:s A", strtotime($num_his_results['hang_up_time'])) : "--";
            $total_talk_time    = ($num_his_results['total_talk_time'] > 0) ? gmdate("H:i:s", $num_his_results['total_talk_time']) : "--";  //duration
            $actual_talk_time   = ($num_his_results['actual_talk_time'] > 0) ? gmdate("H:i:s", $num_his_results['actual_talk_time']) : "--"; //billsec
            $disposition        = (trim($num_his_results['disposition']) != "") ? $num_his_results['disposition'] : "--";
            $call_click_date    = $num_his_results['call_click_date'];

            $call_recording_name = "";
            if($num_his_results['call_rec_name'] == "") {
                $call_recording_name = "--";
            } else {
                // if($call_click_date != date("Y-m-d")) {

                    // ../assets/Dialer/recording/Recording_asterisk_dialer/2020-11-18/2020-05-20 16:35:26_8130325108_102_1605683150.5712_outgoing.wav

                    // http://192.168.1.5/km/dialer/record.php?data=Li4vYXNzZXRzL0RpYWxlci9yZWNvcmRpbmcvUmVjb3JkaW5nX2FzdGVyaXNrX2RpYWxlci8yMDIwLTExLTE4LzIwMjAtMDUtMjAgMTY6MzU6MjZfODEzMDMyNTEwOF8xMDJfMTYwNTY4MzE1MC41NzEyX291dGdvaW5nLndhdg==

                    $encoded_call_url = base64_encode("../assets/Dialer/recording/Recording_asterisk_dialer/".$call_click_date."/".$num_his_results['call_rec_name']);
                    // $encoded_call_url
                    $call_recording_name = "<a target='_blank' href='http://192.168.1.5/km/dialer/record.php?data=".$encoded_call_url."'><input type='button' name='submit' value='Play' class='buttonsub ml10 cursor'></a>";

                    // $call_recording_name = "<a target='_blank' href='http://192.168.1.5/km/dialer/recording/Recording_asterisk_dialer/".$call_click_date."/".$num_his_results['call_rec_name']."'><input type='button' name='submit' value='Download' class='buttonsub ml10 cursor'></a>";
                // } else {
                //     $call_recording_name = "--";
                // }
            }

            $return_html .= "<tr class='center-align'><td>".$sr_no."</td>";
            if($leveltype != 5 ) {
                $return_html .= "<td>".$level_type."</td><td>".$query_status."</td>";
            }
            $return_html .= "<td>".$query_id."</td><td>".$call_btn_type."</td><td>".$user_name."</td>";
            $return_html .= "<td>".$call_start_time."</td><td>".$hang_up_time."</td><td>".$total_talk_time."</td><td>".$actual_talk_time."</td><td>".$disposition."</td>";
            if(!in_array($user_role,array(3))) {
                $return_html .= "<td>".$call_recording_name."</td>";
            }
            $return_html .= "<td>".$datetime."</td></tr>";
        }
        $return_html .= "</table>";
    }
echo $return_html;
// if($_REQUEST['abc'] == 1){
//     echo $url = "http://192.168.1.11/dialer_api/levelid_data.php?query_id=".$_REQUEST['query_id']."&case_id=".$_REQUEST['case_id']."&app_id=";
//     echo $data = curl_get_helper($url);
//     $json_data = json_decode($data,true);
//     echo "<pre>";
//     print_r($json_data);
//     echo "</pre>";
// }