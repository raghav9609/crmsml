<?php

require_once "../../../include/check-session.php";
require_once "../../../include/config.php";
require_once "../../../include/helper.functions.php";

$bank_name_st = $_REQUEST['bank_name_st'];
$other_status_arr = array(1013, 1014);
$case_close_st_arr = array(1012, 1013, 1014, 1019);
$dg_case_id = $_REQUEST['dg_case_id'];
foreach($bank_name_st as $key => $value) {
    $get_app_id_qry = mysqli_query($Conn1,"select app_id,case_id from tbl_mint_app where id=".$value." LIMIT 1");
    $result_app_id = mysqli_fetch_assoc($get_app_id_qry);
    if(in_array($_REQUEST['dg_pre_'.$value], $other_status_arr)) {

        $other_status_csv = "";
        $other_status_csv = $_REQUEST['dg_post_'.$value].",".$_REQUEST['dg_sub_'.$value];

        $dialog_status_query = "UPDATE tbl_mint_app SET pre_login_status = '".$_REQUEST['dg_pre_'.$value]."',app_status_on=0,sub_sub_status=0, other_status = '".$other_status_csv."', app_description = '".$_REQUEST['dg_remarks_'.$value]."' WHERE id = '".$value."' ";
         $qry_app_history = "insert into tbl_application_history set case_id = ".$ $result_app_id['case_id'].",app_id= '".$ $result_app_id['app_id']."',pre_login= '".$_REQUEST['dg_pre_'.$value] ."',date=CURDATE(),time=CURTIME(), user_id= '".$user."'";
        $insert_app_history = mysqli_query($Conn1,$qry_app_history);
    } else {
        $dialog_status_query = "UPDATE tbl_mint_app SET pre_login_status = '".$_REQUEST['dg_pre_'.$value]."', app_status_on = '".$_REQUEST['dg_post_'.$value]."', sub_sub_status = '".$_REQUEST['dg_sub_'.$value]."', app_description = '".$_REQUEST['dg_remarks_'.$value]."' WHERE id = '".$value."' ";
         $qry_app_history = "insert into tbl_application_history set case_id = ".$result_app_id['case_id'].",app_id= '". $result_app_id['app_id']."',pre_login= '".$_REQUEST['dg_pre_'.$value] ."',post_login='".$_REQUEST['dg_post_'.$value]."',sub_sub_status = '".$_REQUEST['dg_sub_'.$value]."',date=CURDATE(),time=CURTIME(), user_id= '".$user."'";
        $insert_app_history = mysqli_query($Conn1,$qry_app_history);
    }

    mysqli_query($Conn1, $dialog_status_query);
}

if($dg_case_id > 0){
    mysqli_query($Conn1,"update tbl_mint_case set is_nstp=1 where case_id = ".$dg_case_id." LIMIT 1");
}

$total_no_of_app = mysqli_query($Conn1,"select * from tbl_mint_app where case_id=".$case_id." and pre_login_status NOT IN (1015,1012,1013,1014,1020,1021,1393,1019)");
if(mysqli_num_rows($total_no_of_app) == 0) {
    mysqli_query($Conn1, "UPDATE tbl_mint_case SET case_status = 1406, c_follow_date='0000-00-00',c_follow_time='00:00:00',c_follow_type = 0 WHERE case_id =".$dg_case_id." LIMIT 1");
    mysqli_query($Conn1, "INSERT INTO tbl_mint_case_followup SET follow_type = 1406, case_id = ".$dg_case_id.",description = 'Application status changed', mlc_user_id = ".$user.", date = CURDATE(), time = CURTIME()");
    echo 2;
    exit();
}

echo 1;