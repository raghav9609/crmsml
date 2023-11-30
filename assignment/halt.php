<?php
require_once "../../include/check-session.php";
require_once "../../include/config.php";

$loan_type = replace_special($_POST['loan_type']);
$switch_on = replace_special($_POST['on']);

if($switch_on == 1){
$update_flag = 2 ;
}
else{
$update_flag = 1;
}
$update_query = "UPDATE crm_lead_assignment SET shift_flag = $update_flag where shift_flag = $switch_on";
$result_flag = mysqli_query($Conn1,$update_query);
require_once "../../include/footer_close.php";
?>