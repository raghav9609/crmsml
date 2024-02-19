<?php
require_once "../../include/check-session.php";
require_once "../../include/config.php";

$query_id = $_REQUEST['query_id'];
$return_html = "";
$sr_no = 0;
$hl_filter_query = "SELECT tbl_user_assign.user_name AS user_name, hl_filtering.entered_date AS entered_date, hl_filtering.final_status AS final_status, hl_filtering.level_type as level_type, hl_filtering.level_id as level_id FROM hl_filtering LEFT JOIN tbl_user_assign on tbl_user_assign.user_id = hl_filtering.user_id WHERE hl_filtering.level_id = $query_id AND hl_filtering.level_type = 1 ORDER BY hl_filtering.entered_date DESC ";

$hl_filter_exe = mysqli_query($Conn1, $hl_filter_query);
if(mysqli_num_rows($hl_filter_exe) > 0) {
    $return_html .= "<table class='gridtable' style='width: 100%'> <tr class='font-weight-bold'> <th>Sr. No.</th> <th>Level Type</th> <th>Level ID</th> <th>Result</th> <th>User</th> <th>Date</th> </tr>";
    while($hl_filter_res = mysqli_fetch_array($hl_filter_exe)) {
        ++$sr_no;
        $user_name = $hl_filter_res['user_name'];
        $entered_date = ($hl_filter_res['entered_date'] != "0000-00-00 00:00:00" && $hl_filter_res['entered_date'] != "") ? date("d-m-Y H:i:s A", strtotime($hl_filter_res['entered_date'])) : "--";
        $final_status = $hl_filter_res['final_status'];
        $level_type = $hl_filter_res['level_type'];
        $level_name = "";
        if($level_type == 1) {
            $level_name = "Query";
        } else if($level_type == 2) {
            $level_name = "Case";
        } else if($level_type == 3) {
            $level_name = "Application";
        }
        $level_id = $hl_filter_res['level_id'];
        $return_html .= "<tr>";
            $return_html .= "<td style='text-align: center'>".$sr_no."</td>";
            $return_html .= "<td style='text-align: center'>".$level_name."</td>";
            $return_html .= "<td style='text-align: center'>".$level_id."</td>";
            $return_html .= "<td style='text-align: center'>".$final_status."</td>";
            $return_html .= "<td style='text-align: center'>".$user_name."</td>";
            $return_html .= "<td style='text-align: center'>".$entered_date."</td>";
        $return_html .= "</tr>";
    }
    $return_html .= "</table>";
}

echo $return_html;