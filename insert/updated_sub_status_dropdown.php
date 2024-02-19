<?php
require_once "../../include/config.php";

$final_dropdown = "";

$level_id   = $_REQUEST['level_id'];
$parent_id  = $_REQUEST['parent_id'];
$sub_level  = $_REQUEST['sub_level'];

$select_name    = "";
$option_name    = "";
$on_change      = 'onchange="new_updated_qs_change(this, 2);"';
if($sub_level == 1) {
    $select_name    = "updated_sub_status";
    $option_name    = "Select Sub Status";
} else if($sub_level == 2) {
    $select_name    = "updated_sub_sub_status";
    $option_name    = "Select Sub Sub Status";
    $on_change      = "";
}

$get_status_query   = "SELECT status_id, description FROM status_master WHERE level_id = $level_id AND parent_id = $parent_id AND is_active_for_filter = 1 ";
$get_status_exe     = mysqli_query($Conn1, $get_status_query);

if(mysqli_num_rows($get_status_exe) > 0) {
    $final_dropdown = "<select name='".$select_name."' id='".$select_name."' $on_change>";
    $final_dropdown .= "<option value=''>$option_name</option>";
    while($get_status_res = mysqli_fetch_array($get_status_exe)) {
        $final_dropdown .= "<option value='".$get_status_res['status_id']."'>".$get_status_res['description']."</option>";
    }
    $final_dropdown .= "</select>";
}

echo $final_dropdown;