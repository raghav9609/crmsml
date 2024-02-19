<?php
require_once "../../include/config.php";
require_once "../../include/helper.functions.php";
require_once "../../include/check-session.php";
// print_r($_POST);
$remarks=$_POST['remarks'];
$user_id=$_POST['user'];
$level_id=$_POST['level_id'];
$level_type=$_POST['level_type'];
mysqli_query($Conn1,'INSERT INTO sticky_note (user_id,remarks,level_id,level_type,created_date,created_time)
    VALUES ('.$user_id.',"'.$remarks.'","'.$level_id.'","'.$level_type.'",now(),now())');