<?php
$slave = 1;
require_once "../../include/check-session.php";
require_once "../../include/config.php";
require_once "../../include/display-name-functions.php";
require_once "../../include/helper.functions.php";
$type = $_REQUEST['type'];
$return_html = "";
$number_history_qry = "";
$cust_phone = $_REQUEST['cust_phone'];
if($cust_phone > 0) {
    $number_history_qry = "(SELECT uniqueid, agent_id, agent_name, level_type, level_id, loan_id, loan_type, call_type, src, dst, dst AS customized_extension_number, calldate, answerdate, hangupdate, duration, billsec, disposition, call_recording_name, tbl_user_assign.user_name AS agent_user_name FROM cdr LEFT JOIN tbl_user_assign ON cdr.dst = tbl_user_assign.extension AND tbl_user_assign.status = 1 AND tbl_user_assign.role_id = 3 WHERE src LIKE '%$cust_phone' AND DATE(calldate) >= DATE_SUB(CURRENT_DATE(), INTERVAL 30 DAY)) UNION (SELECT uniqueid, agent_id, agent_name, level_type, level_id, loan_id, loan_type, call_type, src, dst, src AS customized_extension_number, calldate, answerdate, hangupdate, duration, billsec, disposition, call_recording_name, tbl_user_assign.user_name AS agent_user_name  FROM cdr  LEFT JOIN tbl_user_assign ON cdr.src = tbl_user_assign.extension AND tbl_user_assign.status = 1 AND tbl_user_assign.role_id = 3  WHERE dst LIKE '%$cust_phone' AND (level_id = '' OR level_id = 0 OR level_id IS NULL) AND DATE(calldate) >= DATE_SUB(CURRENT_DATE(), INTERVAL 30 DAY)) ORDER BY calldate DESC";
}

if($number_history_qry != "") {
    $number_history_res = mysqli_query($Conn1, $number_history_qry);
    $number_result = mysqli_num_rows($number_history_res);
    $sr_no = 0;
    if($number_result > 0) {
        $return_html .= "<table  class='gridtable' width='100%'><tr><th>Sr. No.</th><th>Type</th><th>Agent Name</th><th>Extension No</th>";
        $return_html .="<th>Call Date</th><th>Answer Date</th><th>Hang-up Date</th><th>Total Duration (h:m:s)</th><th>Actual Talktime (h:m:s)</th><th>Disposition</th>";
        if($user_role == 1) {
            $return_html .= "<th>Recording File</th>";
        }
        $return_html .= "</tr>";
        while($num_his_results = mysqli_fetch_array($number_history_res)) {
            ++$sr_no;

            if($num_his_results['agent_name'] == "") {
                $agent_name = $num_his_results['agent_user_name'];
            } else {
                $agent_name = "--";
            }
            $calldate = ($num_his_results['calldate'] != "" && $num_his_results['calldate'] != "0000-00-00 00:00:00") ? date("d-m-Y h:i:s A", strtotime($num_his_results['calldate'])) : "--";
            $answer_date = ($num_his_results['answerdate'] != "" && $num_his_results['answerdate'] != "0000-00-00 00:00:00") ? date("d-m-Y h:i:s A", strtotime($num_his_results['answerdate'])) : "--";
            $hang_up_date = ($num_his_results['hangupdate'] != "" && $num_his_results['hangupdate'] != "0000-00-00 00:00:00") ? date("d-m-Y h:i:s A", strtotime($num_his_results['hangupdate'])) : "--";
            $total_talk_time = ($num_his_results['duration'] > 0) ? gmdate("H:i:s", $num_his_results['duration']) : "--";
            $actual_talk_time = ($num_his_results['billsec'] > 0) ? gmdate("H:i:s", $num_his_results['billsec']) : "--";
            $disposition = (trim($num_his_results['disposition']) != "") ? $num_his_results['disposition'] : "--";
            $call_recording_name = "";
            if($num_his_results['call_recording_name'] == "") {
                $call_recording_name = "--";
            } else {
                $encoded_call_url = base64_encode("../assets/Dialer/recording/Recording_asterisk_dialer/".$call_click_date."/".$num_his_results['call_recording_name']);
                $call_recording_name = "<a target='_blank' href='http://192.168.1.5/km/dialer/record.php?data=".$encoded_call_url."'><input type='button' name='submit' value='Play' class='buttonsub ml10 cursor'></a>";
            }

            $dst_no = $num_his_results['dst'];
            $src_no = $num_his_results['src'];

            $calls_type = "";
            if(strlen($dst_no) > 9) {
                $calls_type = "Direct Call";
            } else if(strlen($dst_no) < 9 && $num_his_results['duration'] > 0) {
                $calls_type = "Incoming Call";
            } else if(strlen($dst_no) < 9 && $num_his_results['duration'] == 0) {
                $calls_type = "Missed Call";
            } else {
                $calls_type = "--";
            }

            $customized_extn_no = $num_his_results['customized_extension_number'];
            
            $return_html .= "<tr class='center-align'><td>".$sr_no."</td><td>".$calls_type."</td><td>".$agent_name."</td><td>".$customized_extn_no."</td>";
            $return_html .= "<td>".$calldate."</td><td>".$answer_date."</td><td>".$hang_up_date."</td>";
            $return_html .= "<td>".$total_talk_time."</td><td>".$actual_talk_time."</td><td>".$disposition."</td>";
            if($user_role == 1) {
                $return_html .= "<td>".$call_recording_name."</td>";
            }
            $return_html .= "</tr>";
        }
        $return_html .= "</table>";
    }
}
echo $return_html;