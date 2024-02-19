<?php 
require_once "../../include/check-session.php";
require_once "../../include/config.php";
$code = replace_special($_REQUEST['code']);
$phone = replace_special($_REQUEST['phone']);
$ver_id = replace_special($_REQUEST['ver']);

if($_SESSION['cibil_otp'] != $code ){
    echo '0';
}else{
    $update_qry = mysqli_query($Conn1,"update tbl_cibil_verification_history set verify_no = 1 where rec_id = '".$ver_id."'");
    echo '1';
    unset($_SESSION['cibil_otp']);
}
require_once "../../include/footer_close.php";
?>
