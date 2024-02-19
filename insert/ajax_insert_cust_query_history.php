<?php
$slave = 1;
require_once "../config/config.php";
require_once "../include/helper.functions.php";
require_once "../include/display-name-functions.php";
$type = $_REQUEST['type'];
$return_html = "";
/* coding for customer Query history start */


if($type == "app") {
   
    $case_id = $_REQUEST['case_id'];

$qry = "select * from crm_query_application where crm_query_id = ".$case_id."";
$res = mysqli_query($Conn1,$qry) or die(mysqli_error($Conn1));
$res_num = mysqli_num_rows($res);
if($res_num > 0) {
    $sr_no = 0;
?>
   <?php $return_html = '<table width="100%" class="gridtable"><tr class="font-weight-bold"><th>Sr. No.</th><th>Application Id</th><th>Bank Name</th><th>Status</th><th>Created On</th><th>Action</th></tr>'; ?>

    <?php while($exe_app_history = mysqli_fetch_array($res)){
    ++$sr_no;
    $get_bank_name_get = get_name('master_code_id',$exe_app_history['bank_id']);
    $get_bank_name = $get_bank_name_get['value'];
    $get_app_status_get = get_name('status_name',$exe_app_history['application_status']);
    $get_app_status = $get_app_status_get['value'];
   
    ?>
    <?php 
    $return_html .= '<tr class="center-align"><td>'.$sr_no.'</td><td><span class="fs-12"><a href="../app/edit.php?app_id='.urlencode(base64_encode($exe_app_history['id'])).'">'.$exe_app_history['id'].'</a></span></td><td>'.$get_bank_name.'</td><td>'.$get_app_status.'</td><td>'.date("d-m-Y H:i a",strtotime($exe_app_history['created_on'])).'</td><td><br><span class="fs-12"><a href="../app/edit.php?app_id='.urlencode(base64_encode($exe_app_history['id'])).'">View</a></span></td></tr>'; 
    ?>
    <?php } ?>
    <?php $return_html .= '</table>';
    }
}

echo $return_html;
?>