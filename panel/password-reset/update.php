<?php
// require_once "../../include/check-session.php";
// require_once "../../include/config.php";
require_once(dirname(__FILE__) . '/../../config/session.php');
require_once(dirname(__FILE__) . '/../../config/config.php');
require_once(dirname(__FILE__) . '/../../helpers/common-helper.php');
require_once "../../include/header.php";
include("../../include/helper.functions.php");

$old_password           = $_POST['old_password'];
$new_password           = $_POST['new_password'];
$confirm_new_password   = $_POST['confirm_new_password'];

$return_val = 0;
global $Conn1;
if(!empty($old_password) && !empty($new_password) && !empty($confirm_new_password)) {
    // $enc_old_password           = md5(base64_encode($old_password));
    // $enc_new_password           = md5(base64_encode($new_password));
    // $enc_confirm_new_password   = md5(base64_encode($confirm_new_password));
    $enc_old_password           = md5($old_password);
    $enc_new_password           = md5($new_password);
    $enc_confirm_new_password   = md5($confirm_new_password);
    $select_password_query = "SELECT id, password FROM crm_master_user WHERE id = '".$user_id."' ";
    echo $select_password_query;
    $select_password_exe = mysqli_query($Conn1, $select_password_query);
    if(mysqli_num_rows($select_password_exe) > 0) {
        $select_password_res = mysqli_fetch_array($select_password_exe);
        echo $enc_old_password."----------".$select_password_res['password'];
        if($enc_old_password == $select_password_res['password']) {
            echo $enc_new_password."---------new".$enc_confirm_new_password;
            if($enc_new_password == $enc_confirm_new_password) {
                $update_password_query = "UPDATE crm_master_user SET password = '".$enc_new_password."' WHERE user_id = '".$user."'";
                echo $update_password_query;
                $update_password_exe = mysqli_query($Conn1, $update_password_query);
                $datetime = date("Y-m-d h:i:s");
                $insert_logs_query = "INSERT INTO password_reset_logs SET user_id = '".$user."', old_password = '".$enc_old_password."', new_password = '".$enc_new_password."', reset_date = '".$datetime."' ";
                mysqli_query($Conn1, $insert_logs_query);
                $return_val = 5;        //successful
            } else {
                $return_val = 4;    //New and confirm password does not match
            }
        } else {
            $return_val = 3;        //old password does not match
        }
    } else {
        $return_val = 2;            //user does not exist
    }
} else {
    $return_val = 1;                //passwords empty
}

// header("Location: index.php?msg=".$return_val);
echo "<script>window.location.href = '$head_url';</script>";