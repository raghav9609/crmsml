<?php
session_start();
// echo "as";
print_r($_SESSION);
// exit;
$user_id = $_SESSION['userDetails']['user_id'];
$user_role = $_SESSION['userDetails']['role_id'];
$show_external_api_data = 1;
//echo "hellooooo";
if(!is_numeric($user_id) || $user_id == 0 || !in_array($user_role,array(1,2,3,4,5,6,7,9,8,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26))){
  header("location:".$head_url."/logout.php");
    exit;
}
?>
