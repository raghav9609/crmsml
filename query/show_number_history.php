<?php 
//$master_slave =1;
require_once "../config/config.php";
require_once "../config/session.php";
$id = $_REQUEST['id'];
$src = $_REQUEST['src'];

if($src == 'query'){
    $qry_fetch = mysqli_query($Conn1,"select cust.phone as phone from crm_query as query left JOIN crm_customer as cust on query.crm_customer_id = cust.id where query.id = '".$id."'");

} 

$res_fetch = mysqli_fetch_array($qry_fetch);
echo $phone = $res_fetch['phone'];

$qry_show_num = mysqli_query($Conn_master,"Insert into crm_show_number_history set id='".$id."',user_id='".$user."',source='".$src."',datetime=NOW()");
?>