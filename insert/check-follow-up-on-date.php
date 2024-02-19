<?php
require_once "../../include/check-session.php";
require_once "../../include/config.php";

$followupdate 	= $_POST['followupdate'];
$return_arr 	= [];

$fup_q = "SELECT COUNT(follow_id) AS total_fup_count, follow_time FROM tbl_mint_case_followup WHERE mlc_user_id = '".$user."' AND follow_date = '".$followupdate."' GROUP BY follow_time having count(follow_id) > 3";
$fup_e = mysqli_query($Conn1, $fup_q);

#Time format
// date("g:ia", strtotime($abc));

while($fup_r = mysqli_fetch_array($fup_e)) {
	$range_0 = date("g:ia", strtotime($fup_r['follow_time']));
	$range_1 = date("g:ia", strtotime("+1 minutes", strtotime($fup_r['follow_time'])));
	$return_arr[] = [
		$range_0,
		$range_1
	];
}


#Return Format Array
// $return_arr = array(
// 	array(
// 		"4pm", "4:01pm"
// 	),
// 	array(
// 		"5:15pm", "5:16pm"
// 	)
// );

echo json_encode($return_arr);
