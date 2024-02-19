<?php 
// if(!function_exists('get_display_name')){
function get_display_name($type,$selected_val){
	global $Conn1;
    switch ($type) {
    	case "occupation":
    	    $qry = "select occupation_name from crm_master where id = '".$selected_val."'";
        break;
        case "city_name":
            $qry = "select city_name from crm_master_city where id = '".$selected_val."'";
        break;
        case "comp_id":
           $qry = "select id as comp_id from crm_master_company where company_name = '".$selected_val."'";
        break;
    	case "comp_name":
           $qry = "select company_name from crm_master_company where id = '".$selected_val."'";
        break;
    	case "salary_method":
            $qry = "Select value from crm_masters where crm_masters_code_id = 4 and id = '".$selected_val."'";
        break;
    }
	$result_qry = mysqli_query($Conn1,$qry);
	$row = mysqli_fetch_row($result_qry);
	return $row[0];
}
// }
?>