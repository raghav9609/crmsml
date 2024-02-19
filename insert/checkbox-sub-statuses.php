<?php
require_once "../../include/config.php";

$final_checkbox = "";

$level_id   = $_REQUEST['level_id'];            //query/case/application
$parent_id  = json_decode($_REQUEST['parent_id']);           //json stringified (status/substatus selected status values)
$sub_level  = $_REQUEST['sub_level'];           //1 (status) or 2 (substatus)

$pre_select = $_REQUEST['select'];
$prefill_status = [];
if(!empty($pre_select)) {
    $pre_selected_status = base64_decode($pre_select);
    $prefill_status = explode(",", $pre_selected_status);
}

$checkbox_name = "";
if($sub_level == 1) {
    $checkbox_name = "sub_status[]";
} else if($sub_level == 2) {
    $checkbox_name = "sub_sub_status[]";
}

$parent_status_id = implode(",", $parent_id);

$get_status_query   = "SELECT status_id, description FROM status_master WHERE level_id = $level_id AND parent_id IN ($parent_status_id) AND is_active_for_filter = 1 ";
$get_status_exe     = mysqli_query($Conn1, $get_status_query);

if(mysqli_num_rows($get_status_exe) > 0) {
    while($get_status_res = mysqli_fetch_array($get_status_exe)) {
        $final_checkbox .= "
            <input value=".$get_status_res['status_id']." type='checkbox' name='".$checkbox_name."' id='status_".$get_status_res['status_id']."' ".(in_array($get_status_res['status_id'], $prefill_status) ? 'checked' : '').">
            <label for='status_".$get_status_res['status_id']."'>".$get_status_res['description']."</label> &nbsp; &nbsp;";
    }
}

echo $final_checkbox;