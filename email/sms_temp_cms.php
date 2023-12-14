<?php 
require_once "../../include/check-session.php";
require_once "../../include/config.php";

$temp = replace_special($_REQUEST['temp']);

if($temp == 1){
	echo $msg = "Hi, thank you for your recent inquiry. We will get back to you soon...";
}else if($temp == 2){
	echo $msg = "Hi, this is to confirm that your recent complaint has been resolved and closed. We thank you for your patience.”";
 }
?>