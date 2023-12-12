<?php
require_once "../../include/check-session.php";
require_once "../../include/config.php";
$querystatus   =$_REQUEST['querystatus'];
$levelid   =$_REQUEST['queryid'];
$clickbtn   =$_REQUEST['clickbtn'];
$leveltype   =$_REQUEST['leveltype'];
$dialer_uniq_id   =$_REQUEST['dialer_uniq_id'];
$phone = $_REQUEST['phone'];
$lead_view_id = $_REQUEST['lead_view_id'];
$get_customer_qry = mysqli_query($Conn1,"select id from tbl_mint_customer_info where phone = '".$phone."' and phone != '' and phone != 0");
$result_customer_info = mysqli_fetch_array($get_customer_qry);
//$user         =  173;
  $sql="insert into tbl_query_click_to_call_history set lead_view_id='".$lead_view_id."',dialer_crm_uniq_id='".$dialer_uniq_id."',status_id=$querystatus,level_id =$levelid,level_type=$leveltype,user_id=".$user.",call_button_type='".$clickbtn."'";
  if($leveltype == 5) {
    $sql .= " ,customer_id='".$levelid."' ";
  } else {
    $sql .= " ,customer_id='".$result_customer_info['id']."' ";
  }
 $query=mysqli_query($Conn1,$sql);
if($query){
    echo mysqli_insert_id($Conn1);
}
else {echo 0;}
?>