<?php
if (isset($_GET['term'])){
    include(dirname(__FILE__) . '/../config/config.php');
	$searchTerm = $_REQUEST['term'];
if(preg_match('/^[1-9][0-9]{1,6}$/',$searchTerm)){
	$qry = "SELECT pincode as data FROM crm_master_pincode WHERE pincode LIKE '".$searchTerm."%' ORDER BY pincode ASC limit 5";
}else if(preg_match('/^[a-zA-Z0-9]/',$searchTerm)){
	$qry = "SELECT city_name as data FROM crm_master_city WHERE city_name LIKE '".$searchTerm."%' and city_name != 'others'  ORDER BY city_name ASC limit 5";
}
$query = $db_handle->runQuery($qry);
foreach($query As $row){
    $data[] = $row['data'];
}

echo json_encode($data);
     mysqli_close($Conn1);
}


?>