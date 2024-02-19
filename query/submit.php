<?php
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../config/config.php');
require_once(dirname(__FILE__) . '/../model/queryHelper.php');
$db_handle = new DBController();
$get_qry = new queryModel();

$cust_name            = $_POST['cust_name'];
$mobile_no            = $_POST['mobile_no'];
$email_id        = $_POST['email_id'];
$city_name    = $_POST['city_name'];
$plan_id                  = $_POST['plan'];
$product_id                  = 1;

$cityIDQry = $get_qry->getCityRecord($city_name);
$cityIDRes = $db_handle->runQuery($cityIDQry);
$city_id = $cityIDRes[0]['city_id'];

$checkPhoneExist = $get_qry->getPhoneAvail($mobile_no);
$checkPhoneExistRes = $db_handle->numRows($checkPhoneExist);
$checkPhoneExistArr = $db_handle->runQuery($checkPhoneExist);
$cust_exit_id = $checkPhoneExistArr[0][0];

if($checkPhoneExistRes > 0){
    $cust_upd_arr = array(
        'customer_name' =>$cust_name,
        'email_id' =>$email_id,
        'phone_no'=>$mobile_no,
        'city_id'=>$city_id,
        'updated_on'   => currentDateTime24()
    );
    $cust_ins_qry = $get_qry->updateQueryData('customer_info',$cust_upd_arr,array('id = "'.$cust_exit_id.'"'));
    $db_handle->updateRows($cust_ins_qry);
    $cust_id = $cust_exit_id;

}else{
    $cust_arr = array(
        'customer_name' =>$cust_name,
        'email_id' =>$email_id,
        'phone_no'=>$mobile_no,
        'city_id'=>$city_id,
        'created_on'   => currentDateTime24()
    );
    $cust_ins_qry = $get_qry->insertQueryData('customer_info',$cust_arr);
    $cust_id = $db_handle->insertRows($cust_ins_qry);
}

$qry_arr= array(
    'customer_id'=>$cust_id,
    'product_id'=>$product_id,
    'plan_id'=>$plan_id,
    'source'=>6,
    'created_on'   => currentDateTime24(),
    'query_status'=>4,
);

$qry_ins_qry = $get_qry->insertQueryData('query_details',$qry_arr);
$qry_id_res = $db_handle->insertRows($qry_ins_qry);
$leadAssignTo = $user_id;
if($user_role != 3){
    $content = '{
        "product_id":1,
        "plan_id":'.$plan_id.',
        "city_id":'.$city_id.',
        "source_id":6,
        "lead_id":'.$qry_id_res.',
        "level_id":1
    }';
    $header = array('content-type:application/json','api_key:AN7Grgl94akFKsDPCOXZ12ZO','source:livepure','api_client:lead_assignment','Content-Length: '.strlen($content));
    $response = curl_helper('http://demo.policy4india.in/api/lead-assignment.php',$header,$content);
    $decode_data = json_decode($response,true);
    $leadAssignTo = $decode_data['leadAssignTo'];
}
$db_handle->updateRows("UPDATE query_details set assign_user = ".$leadAssignTo." where query_id = ".$qry_id_res." LIMIT 1");
header("Location: index.php?msg=1");