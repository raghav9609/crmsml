<?php
require_once "../../../include/check-session.php";
require_once "../../../include/config.php";
$city_id = 0;
if($_REQUEST['city_name'] != ''){
	$get_city_id = mysqli_query($Conn1,"select city_id from lms_city where city_name = '".$_REQUEST['city_name']."' limit 1");
	if(mysqli_num_rows($get_city_id) > 0){
		$result_city = mysqli_fetch_array($get_city_id);
		$city_id = $result_city['city_id'];
	}
}
echo $city_id;
?>