<?php
$no_head = 1;
$city_id = 0;
if($_REQUEST['term'] != ''){
    echo $searchTerm = $_REQUEST['term'];
    exit();
    require_once(dirname(__FILE__) . '/../config/config.php');
	require_once(dirname(__FILE__) . '/../model/queryHelper.php');
    echo $searchTerm = $_REQUEST['term'];
    $get_query   = new queryModel();
    $qry        = $get_query->getCityRecord($searchTerm);
    echo $qry;
    $db_handle  = new DBController();
    $data       = $db_handle->runQuery($qry);

	$return_data = [];
    foreach($data as $key => $value) {
        $return_data[] = $value['city_name'];
    }
    echo json_encode($return_data);
}
?>