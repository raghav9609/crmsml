<?php
require_once "../../include/check-session.php";
require_once "../../include/config.php";

$id = $_REQUEST['id'];
$src = $_REQUEST['src'];

  $qry_fetch = mysqli_query($Conn1, "SELECT cust.alternate_phone_no as alt_phone FROM crm_query as query LEFT JOIN crm_customer as cust on query.crm_customer_id = cust.id WHERE qry.id = '".$id."'");



$res_fetch = mysqli_fetch_array($qry_fetch);
echo $alt_phone = $res_fetch['alt_phone'];

$qry_show_num = mysqli_query($Conn1, "INSERT INTO crm_show_number_history SET query_id='".$id."',user_id='".$user_id."',datetime=NOW(), phone_number_type = '2' ");
?>