<?php 
require_once "../../include/class.apihelper.php";
$param = $_REQUEST['req_val'];
  $url = "https://myloancrm.com/api/pre-approved-offers/icici-hl-pre-approved-offers.php";
  $header = array('Content-Type: application/json;','API-CLIENT:partner_pre_approved_offers','API-KEY:pRE_@approved_offer@31_july2020@', 'Content-Length: '.strlen($param));
  $curl_helper_array = array('content_type'=>'json','partner_name'=>'ICICI Pre Approved Offer','partner_id'=>16,'app_id'=>'','url'=>$url,'content'=>$param,'header'=>$header,'ssl_verify'=>'0','auth_token'=>'','loan_type'=>'','rule_id'=>'','last_id'=>'');
    $curl_obj = new api_helper();
    $resp = $curl_obj->curl_exe_new($curl_helper_array);
    $a = json_decode($resp,true);
?>