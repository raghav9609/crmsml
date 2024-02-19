<?php
$no_head = 1;
if(isset($_POST)) {
    require_once(dirname(__FILE__) . '/../config/session.php');
    require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
    require_once(dirname(__FILE__) . '/../config/config.php');
    require_once(dirname(__FILE__) . '/../model/queryHelper.php');
    $db_handle = new DBController();
    $get_qry = new queryModel();
    
    $qry_id = base64_decode($_POST['query_id']);
    $cust_id = base64_decode($_POST['cust_id']);
    $city_idss= $_POST['city_idss'];
    if(!empty($city_idss)){
        $city_id = $city_idss;
    }else if(!empty($_POST['city_name'])){
        $cityIDQry = $get_qry->getCityRecord($_POST['city_name']);
        $cityIDRes = $db_handle->runQuery($cityIDQry);
        $city_id = $cityIDRes[0]['city_id'];
    }

    $cust_arr = array(
        'customer_name'      => $_POST['name'],
        'email_id'     => $_POST['email'],
        'pincode'   => $_POST['pin_code'], 
        'city_id' => $city_id,
        'address'   => $_POST['address'],
    );
    $update_cust_query = $get_qry->updateQueryData('customer_info',$cust_arr,array("id = '".$cust_id."'"));
    echo $update_cust_res = $db_handle->updateRows($update_cust_query);
            
}else{
    exit;
}