<?php
require_once "../../include/config.php";
require_once "../../include/display-name-functions.php";
$case_id = $_REQUEST['case_id'];

$sec_name = "";
$query_id_qry = mysqli_query($Conn1, "SELECT query_id, tbl_user_assign.user_name as user_name FROM tbl_mint_case LEFT JOIN tbl_user_assign on tbl_user_assign.user_id = tbl_mint_case.secd_user_id WHERE case_id = '".$case_id."' ");
if(mysqli_num_rows($query_id_qry) > 0) {
    $query_id_res = mysqli_fetch_array($query_id_qry);
    $query_id = $query_id_res['query_id'];
    $sec_name = $query_id_res['user_name'];
}

$return_html = "";

$data_array = array();

$follow_up_history_qry = "select app_id,follow_given_by,follow_date,follow_time,follow_type,description,date,time,follow_status,mlc_user_id,follow_id, ogl_pincode, lms_city.city_name as city_name, fos_fol_date, fos_fol_time, fos_address, is_rm from tbl_mint_case_followup left join lms_city on lms_city.city_id = tbl_mint_case_followup.ogl_city_id where case_id = '".$case_id."' order by follow_id desc";

if($follow_up_history_qry != "") {
    $query_follow_up = mysqli_query($Conn1, $follow_up_history_qry);
    $number_of_followups = mysqli_num_rows($query_follow_up);
    $sr_no = 0;
    if($number_of_followups > 0) {
        while($result_query = mysqli_fetch_array($query_follow_up)) {
            ++$sr_no;
            $f_date = ($result_query['follow_date'] == '0000-00-00' || $result_query['follow_date'] == "" || $result_query['follow_date'] == "1970-01-01") ? '--' : date("d-m-Y", strtotime($result_query['follow_date']));
            $f_time = $result_query['follow_time'];
            $f_type = $result_query['follow_type'];
            $follow_given_by_c = $result_query['follow_given_by'];
            $case_desc = $result_query['description'];
            $f_modified = ($result_query['date'] == '0000-00-00') ? '--' : date("d-m-Y", strtotime($result_query['date']));
            $follow_time = $result_query['time'];
            $follow_status = $result_query['follow_status'];

            $fos_fol_date = ($result_query['fos_fol_date'] == '0000-00-00' || $result_query['fos_fol_date'] == "" || $result_query['fos_fol_date'] == "1970-01-01") ? '--' : date("d-m-Y", strtotime($result_query['fos_fol_date']));
            $fos_fol_time = "";
            if($fos_fol_date != "--" && $result_query['fos_fol_time'] != "" && $result_query['fos_fol_time'] != "00:00:00") {
                $fos_fol_time = date("H:i:s A", strtotime($result_query['fos_fol_time']));
            } else {
                $fos_fol_time = "--";
            }
            $fos_fol_address = (trim($result_query['fos_address']) != "") ? $result_query['fos_address'] : "--";

            $ogl_pincode = (trim($result_query['ogl_pincode']) != "" && $result_query['ogl_pincode'] > 0) ? $result_query['ogl_pincode']: "--";
            $city_name = (trim($result_query['city_name']) != "") ? $result_query['city_name'] : "--";

            $mlc_user = $result_query['mlc_user_id'];
            if ($f_date == "--" || $f_time == '' || $f_time == '00:00:00') {
                $fol_time = $follow_status = "--";
            } else {
                $fol_time = (date('H:i a', strtotime($f_time)) == '00:00 am') ? '--' : date('H:i a', strtotime($f_time));
            }
            $status = $follow_up_status_array[$follow_status];
            $time_update = date('H:i:s a', strtotime($follow_time));
            $given_by_c = "MLC User";
            if ($follow_given_by_c == '1') {
                $given_by_c = "Customer";
            }else if($follow_given_by_c == '3'){
                $given_by_c = "Support Desk";
            }else if($follow_given_by_c == '4'){
                $given_by_c = "Missed Call";
            }
            $user_query = mysqli_query($Conn1, "select user_name from tbl_user_assign where user_id = '" . $mlc_user . "'");
            $result_user_query = mysqli_fetch_array($user_query);
            $user_name = $result_user_query['user_name'];

            $level_type = $result_query['app_id'] > 0 ? 'Application' : 'Case';
            /*$query_follow_up_type = mysqli_query($Conn1, "select case_status from tbl_case_status where cse_status_id = $f_type");
            $result_query_follow_type = mysqli_fetch_array($query_follow_up_type);
            $follow_up_name = $result_query_follow_type['case_status'];*/
            $follow_up_name = get_display_name('case_status',$f_type);
            if($follow_up_name == ''){
                $follow_up_name = get_display_name('new_status_name',$f_type);
            }
            $update_date_array[] = $f_modified;
            $is_rm = ($result_query['is_rm'] == 1) ? "<span class='fw_bold orange'>FUP for RM</span>" : "";
            $data_array[] = array($level_type, $follow_up_name, $given_by_c, $f_modified, $time_update, $case_desc, $user_name, $f_date, $f_time, $status, $ogl_pincode, $city_name, $fos_fol_date, $fos_fol_time, $fos_fol_address, $is_rm);
        }
    }
}

$follow_up_history_qry = "select follow_given_by,follow_date,follow_time,follow_type,description,mlc_user_id,date,time,follow_status, ogl_pincode, lms_city.city_name as city_name, fos_fol_date, fos_fol_time, fos_address from tbl_mint_case_followup where query_id = $query_id and query_flag = 1 order by follow_id desc";
$query_follow_up = mysqli_query($Conn1, $follow_up_history_qry);
while ($result_query = mysqli_fetch_array($query_follow_up)) {
    $f_date = ($result_query['follow_date'] == '0000-00-00' || $result_query['follow_date'] == "" || $result_query['follow_date'] == "1970-01-01") ? '--' : date('d-m-Y', strtotime($result_query['follow_date']));
    $f_time = $result_query['follow_time'];
    $f_type = $result_query['follow_type'];
    $follow_given_by = $result_query['follow_given_by'];
    $desc = $result_query['description'];
    $mlc_user_id = $result_query['mlc_user_id'];
    $f_modified = ($result_query['date'] == '0000-00-00' || $result_query['date'] == "") ? '--' : date("d-m-Y", strtotime($result_query['date']));
    $follow_time = $result_query['time'];
    $follow_status = $result_query['follow_status'];

    $fos_fol_date = ($result_query['fos_fol_date'] == '0000-00-00' || $result_query['fos_fol_date'] == "" || $result_query['fos_fol_date'] == "1970-01-01") ? '--' : date("d-m-Y", strtotime($result_query['fos_fol_date']));
    $fos_fol_time = "";
    if($fos_fol_date != "--" && $result_query['fos_fol_time'] != "" && $result_query['fos_fol_time'] != "00:00:00") {
        $fos_fol_time = date("H:i:s A", strtotime($result_query['fos_fol_time']));
    } else {
        $fos_fol_time = "--";
    }
    $fos_fol_address = (trim($result_query['fos_address']) != "") ? $result_query['fos_address'] : "--";

    $ogl_pincode = (trim($result_query['ogl_pincode']) != "" && $result_query['ogl_pincode'] > 0) ? $result_query['ogl_pincode'] : "--";
    $city_name = (trim($result_query['city_name']) != "") ? $result_query['city_name'] : "--";

    if ($f_date == "--" || $f_time == '') {
        $fol_time = $follow_status = "";
    } else {
        $fol_time = (date('H:i a', strtotime($f_time)) == '00:00 am') ? '--' : date('H:i a', strtotime($f_time));
    }
    $time_update = date('H:i:s a', strtotime($follow_time));
   /* $query_follow_up_type = mysqli_query($Conn1, "select qy_status from tbl_query_status where qy_status_id = $f_type");
    $result_query_follow_type = mysqli_fetch_array($query_follow_up_type);
    $follow_up_name = $result_query_follow_type['qy_status'];*/

    $follow_up_name = get_display_name('query_status',$f_type);
            if($follow_up_name == ''){
                $follow_up_name = get_display_name('new_status_name',$f_type);
            }


    $user_query = mysqli_query($Conn1, "select user_name from tbl_user_assign where user_id = '" . $mlc_user_id . "'");
    $result_user_query = mysqli_fetch_array($user_query);
    $user_name = $result_user_query['user_name'];
    $given_by = "MLC User";
    if ($follow_given_by == 1) {
        $given_by = "Customer";
    }
    if ($f_type == 3) {
        $follow_up_name = "Case Created";
    } else {
        $follow_up_name = $follow_up_name;
    }
    $status = $follow_up_status_array[$follow_status];
    $update_date_array[] = $f_modified;
    $data_array[] = array('Query', $follow_up_name, $given_by, $f_modified, $time_update, $desc, $user_name, $f_date, $f_time, $status, $ogl_pincode, $city_name, $fos_fol_date, $fos_fol_time, $fos_fol_address, '');
}
$current_date = date('d-m-Y');
if (!empty($data_array)) {
    $today_data = $other_date_data = '';
    $sr_no = 0;
    foreach ($data_array as $data_val) {
        $secondary_user = "--";
        ++$sr_no;
        $final_fdate = ($data_val[7] == '0000-00-00' ||  $data_val[7] == '--' || $data_val[7] == '' || $data_val[7] == '1970-01-01') ? '--' : $data_val[7];
        $final_time = ($final_fdate == '--' || $data_val[8] == '00:00:00' || $data_val[8] == '') ? '--': date('H:i A',strtotime($data_val[8]));

        if($data_val[12] != "--" && $data_val[13] != "--") {
            $secondary_user = (trim($sec_name) != "") ? "(".$sec_name.")" : "--";
        }

        if ($current_date == $data_val[7] && (!in_array($current_date,$update_date_array))) {
            $today_data .= "<tr class='center-align'>
            <td>".$sr_no."</td>
            <td>".$data_val[0]."</td>
            <td>".$data_val[1]."<br>(By: ".$data_val[6]." - ".$data_val[2].")<br>".$data_val[15]."</td>
            <td>".$final_fdate."<br>".$final_time."<br>".$data_val[9]."</td>
            <td>".$data_val[12]."<br>".$data_val[13]."<br>".$secondary_user."</td>
            <td>".$data_val[14]."</td>
            <td>".$data_val[6]."</td>
            <td>".$data_val[10]."</td>
            <td>".$data_val[11]."</td>
            <td>".$data_val[3]." ".$data_val[4]."</td>
            <td>".$data_val[5]."</td>
        </tr>";
        } else {
            $other_date_data .= "<tr class='center-align'>
            <td>".$sr_no."</td>
            <td>".$data_val[0]."</td>
            <td>".$data_val[1]."<br>(By: ".$data_val[6]." - ".$data_val[2].")<br>".$data_val[15]."</td>
            <td>".$final_fdate."<br>".$final_time."<br>".$data_val[9]."</td>
            <td>".$data_val[12]."<br>".$data_val[13]."<br>".$secondary_user."</td>
            <td>".$data_val[14]."</td>
            <td>".$data_val[6]."</td>
            <td>".$data_val[10]."</td>
            <td>".$data_val[11]."</td>
            <td>".$data_val[3]." ".$data_val[4]."</td>
            <td>".$data_val[5]."</td>
        </tr>";
        }
    }?>
    <table class="gridtable " style="width:100%;" border="1">
        <tr class="font-weight-bold">
            <th style="width: 6%">Sr. No.</th>
            <th style="width: 10%">Level Type</th>
            <th style="width: 10%">Follow Up Status & Type</th>
            <th style="width: 10%">Follow Date & Time</th>
            <th style="width: 10%">FOS Date & Time</th>
            <th style="width: 10%">FOS Address</th>
            <th style="width: 10%">User</th>
            <th style="width: 10%">Pincode</th>
            <th style="width: 10%">City</th>
            <th style="width: 10%">Update Date & Time</th>
            <th style="width: 44%">Remarks</th>
        </tr>
        <?php echo $today_data.$other_date_data; ?>
        <div id="up_desc"></div>
    </table>
<?php 
} else {
    echo "";    
}
?>