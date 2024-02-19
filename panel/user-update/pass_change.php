<?php 
require_once "../../include/config.php";
	 $user_id = replace_special($_REQUEST['user']);
	 $pass= $_REQUEST['pass'];
	 $qry_ad = mysqli_fetch_array(mysqli_query($Conn1,"select email from tbl_user_assign where user_id = '".$user_id."'"));
  $qry_up = ("UPDATE tbl_admin set password = '".$pass."' where user_name = '".$qry_ad['email']."'");
       $res_qry = mysqli_query($Conn1,$qry_up);
	  ?>