<?php
require_once "../../include/config.php";
session_start();
$status    =$_REQUEST['status'];
$statusn   =$_REQUEST['statusnew'];
$levelid   =$_REQUEST['levelid'];
$btn       =$_REQUEST['button'];
$leveltype =$_REQUEST['level_type'];
$user      =  $_SESSION['user_id']; 
  $sql="insert into followup_noteligible_select_history set status_id=$status,new_status_id=$statusn,level_id =$levelid,level_type=$leveltype,user_id=".$user.",button_type='".$btn."'";
 $query=mysqli_query($Conn1,$sql);
if($query){
    echo 1;
}
else {echo 0;}

include("../../include/footer_close.php");
?>