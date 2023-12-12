<?php
require_once "../../include/check-session.php";
require_once "../../include/config.php";

$id = $_REQUEST['id'];
$src = $_REQUEST['src'];

if($src == 'query'){
    $qry_fetch = mysqli_query($Conn1, "SELECT cust.alt_phone as alt_phone FROM tbl_mint_query as query LEFT JOIN tbl_mint_customer_info as cust on query.cust_id = cust.id WHERE query_id = '".$id."'");

} else if($src == 'case'){
  $qry_fetch = mysqli_query($Conn1, "SELECT cust.alt_phone as alt_phone FROM tbl_mint_case as cse LEFT JOIN tbl_mint_customer_info as cust on cse.cust_id = cust.id WHERE case_id = '".$id."'");  
}

$res_fetch = mysqli_fetch_array($qry_fetch);
echo $alt_phone = $res_fetch['alt_phone'];

$qry_show_num = mysqli_query($Conn1, "INSERT INTO tbl_show_number_history SET id='".$id."',user_id='".$user."',source='".$src."',datetime=NOW(), phone_number_type = '2' ");
?>