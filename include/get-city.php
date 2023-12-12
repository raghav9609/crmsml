<?php 
$slave =1;
include('config.php');
$pincode = $_REQUEST['pincode'];

$qry_get_details = mysqli_query($Conn1,"select pin.city_id,ctty.city_name as city_name , ctty.state_id as state_id from crm_master_pincode as pin left JOIN crm_master_city as ctty ON pin.city_id = ctty.id where pin.pincode='".$_REQUEST['pincode']."'");

$res_get_details = mysqli_fetch_array($qry_get_details);
if($res_get_details['city_name'] != ''){
echo $city = $res_get_details['city_name'].'@#'.$res_get_details['state_id'];
}
?>