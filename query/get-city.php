<?php
$no_head = 1;
$city_id = 0;
if($_POST['pincode'] != ''){
    require_once(dirname(__FILE__) . '/../config/session.php');
    require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
    require_once(dirname(__FILE__) . '/../config/config.php');
    $db_handle = new DBController();
    $searchTerm = $_REQUEST['pincode'];
    $res = search_city_pincode($searchTerm);
    echo json_encode($res);
}
?>