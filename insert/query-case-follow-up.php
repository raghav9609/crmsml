<?php
$slave = 1;
require_once "../../include/check-session.php";
require_once "../../include/config.php";
//query_all_fup_15
//case_all_fup_15
$url = 'javascript:void(0);';
    $count_case_fup = mysqli_query($Conn1,"CALL case_all_fup_15(".$user.",2,@query_id)") or die(mysqli_error($Conn1));
    $result_count_case_fup = mysqli_fetch_assoc($count_case_fup);
    $no_case_fup = $result_count_case_fup['qry_id'];
    mysqli_free_result($result_count_case_fup);
    mysqli_next_result($Conn1); 
    if($no_case_fup > 0){
    	$case_id_fup = mysqli_query($Conn1,"CALL case_all_fup_15(".$user.",1,@query_id)") or die(mysqli_error($Conn1));
    	$result_case_id = mysqli_fetch_assoc($case_id_fup);
    	$lead_id= $result_case_id['qry_id'];
    	$type = 2; 
    	$url = "../cases/edit.php?case_id=".base64_encode($lead_id)."&ut=2";
    	mysqli_free_result($result_case_id);
    	mysqli_next_result($Conn1);
    }
     
    $count_query_fup = mysqli_query($Conn1,"CALL query_all_fup_15(".$user.",2,@query_id)") or die(mysqli_error($Conn1));
    $result_count_query_fup = mysqli_fetch_assoc($count_query_fup);
    $no_queyr_fup = $result_count_query_fup['qry_id'];
    mysqli_free_result($result_count_query_fup);
    mysqli_next_result($Conn1); 
    $total_fup = $no_case_fup + $no_queyr_fup;
    if($no_case_fup == 0 && $no_queyr_fup > 0){
    	$query_id_fup = mysqli_query($Conn1,"CALL query_all_fup_15(".$user.",1,@query_id)") or die(mysqli_error($Conn1));
    	$result_query_id = mysqli_fetch_assoc($query_id_fup);
    	$lead_id= $result_query_id['qry_id'];
    	$type = 1; 
    	$url = "../query/edit.php?id=".base64_encode($lead_id)."&ut=2";
    	mysqli_free_result($result_query_id);
    	mysqli_next_result($Conn1);
    }
	

echo json_encode(array("type" => $type,"url" => $url, "notf_read" => $total_fup));