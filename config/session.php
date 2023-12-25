<?php
session_start();
$user_id = $_SESSION['userDetails']['user_id'];
$user_role = $_SESSION['userDetails']['role_id'];
$show_external_api_data = 1;

// print_r($_SESSION);
if(!is_numeric($user_id) || $user_id == 0 || !in_array($user_role,array(1,2,3,4))){
  header("location:".$head_url."/logout.php");
    exit();
}
// print_r($_SESSION);
?>
