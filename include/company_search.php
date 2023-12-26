<?php
if (isset($_GET['term'])){
	$slave =1;
        include("../config/config.php");
	    $stmt = mysqli_query($Conn1,"SELECT * FROM crm_master_company WHERE company_name LIKE '%".$_GET['term']."%' and is_active = 1 ORDER BY company_name ASC LIMIT 0, 10");
	    while($row = mysqli_fetch_array($stmt)) {
	        $return_arr[] =  $row['company_name'];
	    }

    echo json_encode($return_arr);
    mysqli_close($Conn1);
   
}
 $conn=null;

?>