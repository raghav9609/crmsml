<?php
$no_head = 1;
$city_id = 0;
if($_REQUEST['city_name'] != ''){
    require_once(dirname(__FILE__) . '/../config/config.php');
    require_once(dirname(__FILE__) . '/../model/loginHelper.php');
	require_once(dirname(__FILE__) . '/../model/queryHelper.php');
    $searchTerm = $_REQUEST['term'];
    $get_query   = new queryModel();
    $qry        = $get_query->getCityID($_REQUEST['city_name']);
    $db_handle  = new DBController();
    $data       = $db_handle->runQuery($qry);
    echo $data[0]['city_id'];
}
?>