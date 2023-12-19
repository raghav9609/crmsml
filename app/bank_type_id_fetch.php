<?php 
include('../../include/config.php');
$bank_id = mysqli_query($Conn1,"select bank_type_id from tbl_bank where bank_id = '".$_REQUEST['bank_id']."'");
$res_bank_id = mysqli_fetch_array($bank_id);
echo $bank_type_id = $res_bank_id['bank_type_id'];
mysqli_close($Conn1);
?>