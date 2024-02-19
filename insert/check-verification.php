<?php
require_once "../../include/check-session.php";
require_once "../../include/config.php";
require_once "../../include/display-name-functions.php";
require_once "../../include/helper.functions.php";

$email_id = $_REQUEST['email_id'];
$pan_card = $_REQUEST['pan_card'];
$phone_no = $_REQUEST['phone_no'];
$cust_id = $_REQUEST['cust_id'];
$verify_flag = 0;                       //0 - show popup, 1 - do not show popup

$phone_verify = "0";
$email_verify = "0";
$pancard_verify = "0";

if($cust_id != '') {
    if($email_id != '') {
        $check_if_email = mysqli_query($Conn1, "SELECT id FROM data_verification_system WHERE cust_id = '".$cust_id."' AND doc_no = '".$email_id."'");
        if(mysqli_num_rows($check_if_email) > 0) {
            // $verify_flag = 1;
            $email_verify = 1;
        }
    }

    if($pan_card != '') {
        $check_if_pan = mysqli_query($Conn1, "SELECT id FROM data_verification_system WHERE cust_id = '".$cust_id."' AND doc_no = '".$pan_card."'");
        if(mysqli_num_rows($check_if_pan) > 0) {
            $pancard_verify = 1;
            // if($verify_flag == 0) {
            //     $verify_flag = 0;
            // } else {
            //     $verify_flag = 1;
            // }
        }
        //  else {
        //     $verify_flag = 0;
        // }
    }

    if($phone_no != '') {
        $check_if_phone = mysqli_query($Conn1, "SELECT id FROM data_verification_system WHERE cust_id = '".$cust_id."' AND doc_no = '".$phone_no."' AND verification_mode = 6");
        if(mysqli_num_rows($check_if_phone) > 0) {
            $phone_verify = 1;
            // if($verify_flag == 0) {
            //     $verify_flag = 0;
            // } else {
            //     $verify_flag = 1;
            // }
        }
        //  else {
        //     $verify_flag = 0;
        // }
    }
}

$generic_verify = 1;
if($email_verify == 0 || $pancard_verify == 0 || $phone_verify == 0) {
    $generic_verify = 0;
}

$return_arr = array("generic_verify" => $generic_verify, "email_verify" => $email_verify, "pancard_verify" => $pancard_verify, "phone_verify" => $phone_verify);

echo json_encode($return_arr);