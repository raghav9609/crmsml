<?php
require_once "../../include/check-session.php";
require_once "../../include/config.php";

$mask = replace_special($_REQUEST['mask']);
 $assigned = replace_special($_POST['assigned']);


$page = replace_special($_POST['page']);
$url = ($_POST['url']);

foreach($mask as $key => $value){
	 $applcation_id = base64_decode($_POST['applcation_id_'.$value]);
	 $assign_from_user = ($_POST['assign_from_user_'.$value]);
	$qry_edit_up = mysqli_query($Conn1,"UPDATE tbl_mint_case set user_id = '".$assigned."' where case_id = '".$value."'");

	$get_user = mysqli_query($Conn1,"select user_id from tbl_user_assign where user_name='".$assign_from_user."'");
	$res_user_assign_from = mysqli_fetch_array($get_user);

	$assign_query = mysqli_query($Conn1,"insert into tbl_assign_process set case_id = '".$value."',assign_from='".$res_user_assign_from['user_id']."',assign_to='".$assigned."',app_id='".$applcation_id."',assign_by ='".$user."',assign_date =CURDATE(),assign_time=CURTIME()");

}

 include("../../include/footer_close.php");
if($user != 173) {
	header("location:".$url);
}


?>

         
        