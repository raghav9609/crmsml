<?php
require_once "../../include/check-session.php";
require_once "../../include/config.php";

$pat_id = $_REQUEST['pat_id'];
$contact_id = $_REQUEST['contact_id'];
$level_type = $_REQUEST['level_type'];
$mgr_type = $_REQUEST['mgr_type'];
$level_id = $_REQUEST['level_id'];
$product_type = $_REQUEST['loan_type'];
$like_dislike_flag = $_REQUEST['like_dislike_flag'];
$city_id = $_REQUEST['city_id'];

$return = array();
if(!empty($pat_id) && !empty($contact_id) && !empty($level_type) && !empty($mgr_type) && !empty($like_dislike_flag)) {

    $bank_id_qry = mysqli_query($Conn1, "select partner_id, bank_id from tbl_mlc_partner where partner_id = ".$pat_id);
    $bank_id = 0;
    if(mysqli_num_rows($bank_id_qry) > 0) {
        $bank_id_res = mysqli_fetch_array($bank_id_qry);
        $bank_id = $bank_id_res['bank_id'];
    }
    
    $contact_info_qry = "";
    if($mgr_type == 1) {            //RM
        $contact_info_qry = "select rm_name as name, rm_email as email, rm_mobile as mobile from tbl_bank_contact_info_new where contact_id = ".$contact_id;
    } else if($mgr_type == 2) {     //SM
        $contact_info_qry = "select sm_name as name, sm_email as email, sm_mobile as mobile from tbl_bank_contact_info_new where contact_id = ".$contact_id;
    }
    
    $name = "";
    $email = "";
    $mobile = "";
    if($contact_info_qry != "") {
        $contact_info_exe = mysqli_query($Conn1, $contact_info_qry);
        if(mysqli_num_rows($contact_info_exe) > 0) {
            $contact_info_res = mysqli_fetch_array($contact_info_exe);
            $name = $contact_info_res['name'];
            $email = $contact_info_res['email'];
            $mobile = $contact_info_res['mobile'];
        }
    }

    
    $valid_insert = mysqli_query($Conn1, "insert into valid_rm_sm(level_type, level_id, product_type, bank_id, partner_id, manager_type, name, email, mobile, user_id, like_dislike_flag, last_updated_datetime, city_id) values('".$level_type."','".$level_id."', '".$product_type."', '".$bank_id."', '".$pat_id."', '".$mgr_type."', '".$name."', '".$email."', '".$mobile."', '".$user."', '".$like_dislike_flag."', '".date('Y-m-d h:i:s')."', '".$city_id."') ");
    $inserted_id = mysqli_insert_id($Conn1);

    if($inserted_id > 0) {
        $return = array("status" => "1", "data" => "success", "inserted_id" => $inserted_id);
    } else {
        $return = array("status" => "0", "data" => "something went wrong", "inserted_id" => "");    
    }
} else {
    $return = array("status" => "0", "data" => "failed", "inserted_id" => "");
}

echo json_encode($return);
?>