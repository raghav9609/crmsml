<?php
if (isset($_GET['term'])){
        include("../config/config.php");
        $searchTerm = $_REQUEST['term'];
      
	    $stmt = mysqli_query($Conn1,"SELECT name as data FROM crm_master_user WHERE name LIKE '".$searchTerm."%' ORDER BY name ASC limit 0, 10");
	    while($row = mysqli_fetch_array($stmt)) {
	        $return_arr[] =  $row['data'];
	    }

    echo json_encode($return_arr);
    mysqli_close($Conn1);
   
}
 $conn=null;

?>