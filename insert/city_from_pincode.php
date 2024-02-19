<?php
require_once "../../include/check-session.php";
require_once "../../include/config.php";

$pincode = $_REQUEST['pincode_value'];
if(!empty($pincode)) {
    $city_qry = mysqli_query($Conn1, "select city_id from lms_pincode where pin_code = ". $pincode);
    if(mysqli_num_rows($city_qry) > 0) {
        $city_res = mysqli_fetch_array($city_qry);
        if(!empty($city_res['city_id'])) {
            $city_name_qry = mysqli_query($Conn1, "select city_name from lms_city where city_id = ". $city_res['city_id']);
            if(mysqli_num_rows($city_name_qry) > 0) {
                $city_name_res = mysqli_fetch_array($city_name_qry);
                echo $city_name_res['city_name'];
                exit;
            } else {
                echo "2";
                exit;
            }
        } else {
            echo "2";
            exit;
        }
    } else {
        echo "2";
        exit;
    }
} else {
    echo "1";
    exit;
}