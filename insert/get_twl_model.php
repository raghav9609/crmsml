<?php
require_once "../../include/check-session.php";
require_once "../../include/config.php";

$twl_make   = $_REQUEST['twl_make'];
// $city_name  = base64_decode($_REQUEST['city_name']);
$city_id  = $_REQUEST['city_id'];
$pincode    = $_REQUEST['pincode'];

// $get_city_id    = mysqli_query($Conn1, "SELECT city_id FROM lms_city WHERE city_name = '".$city_name."' ");
// $city_id_res    = mysqli_fetch_array($get_city_id);
// $city_id        = $city_id_res['city_id'];

$return_options = "";
$twm_query = mysqli_query($Conn1, "SELECT DISTINCT(twm.id), twm.value FROM two_wheeler_partner_dealer_details AS twpdd LEFT JOIN two_wheeler_model AS twm ON twm.id = twpdd.moN WHERE twpdd.mN = '".$twl_make."' AND (twpdd.f1cId = '".$city_id."' OR twpdd.pinC = '".$pincode."') ");
if(mysqli_num_rows($twm_query) > 0) {
    while($twm_result = mysqli_fetch_array($twm_query)) {
        $return_options .= "<option value='".$twm_result['id']."'>".$twm_result['value']."</option>";
    }
}

echo $return_options;