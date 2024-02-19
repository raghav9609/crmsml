<?php
/* Coding for user follow-ups start */
$past_follow_query  = mysqli_query($Conn1,"select count(*) as total_query from form_merge_data where q_follow_date < '$today' and user_id = $user and query_status IN ( 5, 6, 16, 17,15,19 )");
$info_past_follow_query = mysqli_fetch_array($past_follow_query);
$past_query = $info_past_follow_query['total_query'];

$past_follow_cases = mysqli_query($Conn1,"select count(*) as total_case from tbl_mint_case where case_status =1 and c_follow_date < '$today' and user_id = $user");
$info_past_follow_cases = mysqli_fetch_array($past_follow_cases);
$past_case =  $info_past_follow_cases['total_case'];

$today_follow_query = "select count(*) as total_assign from form_merge_data where q_follow_date = '$today' and user_id = $user and query_status IN ( 5, 6, 16, 17,15,19 )";
$total_follow_query  = mysqli_query($Conn1,$today_follow_query);
$info_today_follow_query = mysqli_fetch_array($total_follow_query);
$today_query = $info_today_follow_query['total_assign'];

$today_follow_cases = "select count(*) as total_case from tbl_mint_case where case_status =1 and c_follow_date = '$today' and ((user_id =  '".$user."' and fup_user_type != 2) or (secd_user_id =  '".$user."' and fup_user_type =2))";
$total_follow_cases  = mysqli_query($Conn1,$today_follow_cases);
$info_today_follow_cases = mysqli_fetch_array($total_follow_cases);
$today_case =$info_today_follow_cases['total_case'];

$next_follow_query = "select count(*) as total_assign from form_merge_data where q_follow_date > '$today' and user_id = $user and query_status IN (5, 6, 16, 17,15,19 )";
$total_next_follow_query  = mysqli_query($Conn1,$next_follow_query);
$info_next_follow_query = mysqli_fetch_array($total_next_follow_query);
$tmw_query =$info_next_follow_query['total_assign'];

$next_follow_cases = "select count(*) as total_case from tbl_mint_case where case_status =1 and c_follow_date > '$today' and ((user_id =  '".$user."' and fup_user_type != 2) or (secd_user_id =  '".$user."' and fup_user_type =2))";
$other_next_follow_cases  = mysqli_query($Conn1,$next_follow_cases);
$info_next_follow_cases = mysqli_fetch_array($other_next_follow_cases);
echo  $tmw_case = $info_next_follow_cases['total_case'];
/* Coding for user follow-ups End */
?>