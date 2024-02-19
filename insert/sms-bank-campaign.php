<?php
require_once "../../include/check-session.php";
require_once "../../include/config.php";
$bnk_campaing = 1;
$qry_fetch = mysqli_query($Conn1,"select * from bank_sms_campaign where sms_flag = 0");
while($result_qry = mysqli_fetch_array($qry_fetch)){
    $get_customer_id = mysqli_query($Conn1,"select id,name,mname,lname from tbl_mint_customer_info where phone ='".$result_qry['phone_no']."'");
    $result_customer_qry = mysqli_fetch_array($get_customer_id);
    if($result_customer_qry['id'] != '' && $result_customer_qry['id'] != 0){
    $src_id = $result_qry['url']."?source=bank_campaign&src_id=".base64_encode(base64_encode($result_customer_qry['id']))."&src_offer=".base64_encode(base64_encode($result_qry['bank_id']));
     include "../../include/short-url.php";
    }
}

?>