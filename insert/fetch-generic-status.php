<?php
require_once "../../include/check-session.php";
require_once "../../include/config.php";

$level = $_REQUEST['level'];
$checkboxes = "";
$qca_query = "";
$level_name = "";

$pre_select = $_REQUEST['select'];
$prefill_status = [];
if(!empty($pre_select)) {
    $pre_selected_status = base64_decode($pre_select);
    $prefill_status = explode(",", $pre_selected_status);
}

if($level == 1) {
    $level_name = "Query";
    $qca_query = "SELECT status_id, description FROM status_master WHERE level_id = 1 AND parent_id = 0 AND is_active_for_filter = 1 ";
    if(!in_array($user_role, array(1, 4, 5))) {
        $qca_query .= " AND status_id NOT IN (2) ";
    } 
    $qca_query .= " ORDER BY sort_order";
} else if($level == 2) {
    $level_name = "Case";
    $qca_query = "SELECT status_id, description FROM status_master WHERE level_id = 2 AND parent_id = 0 AND is_active_for_filter = 1";
    if (!in_array($user_role, array(1, 4, 5))) {
        $qca_query .= " AND status_id NOT IN (2) ";
    } 
    $qca_query .= " ORDER BY sort_order";
} else if($level == 3) {
    $level_name = "App";
    $qca_query = "SELECT status_id, description FROM status_master WHERE level_id = 3 AND parent_id = 0 AND is_active_for_filter = 1 ORDER BY sort_order";
}

if(trim($qca_query) != "") {
    $qca_execute = mysqli_query($Conn1, $qca_query);
    while($qca_results = mysqli_fetch_array($qca_execute)) {
        $checkboxes .= "
                <input value=".$qca_results['status_id']." type='checkbox' name='status[]' id='status_".$qca_results['status_id']."' ".(in_array($qca_results['status_id'], $prefill_status) ? 'checked' : '').">
                
                <label for='status_".$qca_results['status_id']."'>".$qca_results['description']."</label> &nbsp; &nbsp;";
    }
}

echo $checkboxes;