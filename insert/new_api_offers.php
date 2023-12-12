<?php
require_once "../../include/check-session.php";
require_once "../../include/config.php";
require_once "../../include/helper.functions.php";

$loan_type      = $_REQUEST['loan_type'];
$query_id       = $_REQUEST['query_id'];
$case_id        = $_REQUEST['case_id'];
$type           = $_REQUEST['type'];

$cust_pin_code  = $_REQUEST['cust_pin_code'];
$city_name      = $_REQUEST['city_id'];
$loan_amt       = $_REQUEST['loan_amt'];
$occupation_id  = $_REQUEST['occupation_id'];

$city_id        = "";
if(trim($city_name) != "") {
    $city_name_exe = mysqli_query($Conn1, "SELECT city_id FROM lms_city WHERE city_name = '".$city_name."' LIMIT 0, 1 ");
    if(mysqli_num_rows($city_name_exe) > 0) {
        $city_id_res    = mysqli_fetch_array($city_name_exe);
        $city_id        = $city_id_res['city_id'];
    }
}

$curl = curl_init();
$url = "";

$url = "https://myfinancecare.co.in/api_web/offers?loan_type_id=$loan_type&loan_amount=$loan_amt&occupation_id=$occupation_id";


curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('username:mlcgold','key:mlc-gold-loan'));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

$result = "";
if ($err) {
  $result = "";
} else {
  $result = $response;
}

print_r($result);