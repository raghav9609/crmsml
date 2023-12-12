<?php
require_once "../../include/check-session.php";
require_once "../../include/config.php";

$city_name = $_REQUEST["city_name"];
$valid = 1;     //Does not exists
$is_city_valid_qry = mysqli_query($Conn1, "select city_id from lms_city where city_name = '".$city_name."' ");
if(mysqli_num_rows($is_city_valid_qry) > 0) {
    $city_id_res = mysqli_fetch_array($is_city_valid_qry);
    if($city_id_res['city_id'] > 0) {
        $valid = 2;     //Does exists
    }
}

echo $valid;
?>