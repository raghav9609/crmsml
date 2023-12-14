<?php 
require_once "../../include/check-session.php";
require_once "../../include/config.php";
   
$template = replace_special($_POST['temp']);
$e_query = "select * from tbl_mint_mail_temp where temp_id = '$template'";
$e_result = mysqli_query($Conn1,$e_query);
$e_info = mysqli_fetch_array($e_result);

echo $e_info ['subject'];
include("../../include/footer_close.php");
?>    