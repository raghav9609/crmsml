<?php 
require_once "../../include/check-session.php";
require_once "../../include/config.php";

 $destId = base64_decode($_REQUEST['destId']);

//echo "select GROUP_CONCAT( CONCAT_WS('@@',id,doj_epf,est_name) SEPARATOR '@#') as id, request_id from epf_company_detail where cust_id='".$destId."' GROUP by request_id order by date desc limit 1";
$qry_get_info = mysqli_query($Conn1, "select GROUP_CONCAT( CONCAT_WS('@@',id,doj_epf,est_name) SEPARATOR '@#') as id, request_id from epf_company_detail where cust_id='".$destId."' GROUP by request_id order by date desc limit 1");
$res_get_info = mysqli_fetch_array($qry_get_info);
	$id[$res_get_info['request_id']] = $res_get_info['id'];
	
	foreach($id as $key => $val){
	    	 $info = explode('@#',$val);
	    	  $ttl_comp = count($info);
	    	 foreach($info as $info_val){
	    	     $expld_info = explode('@@',$info_val);
	    	     $new_arr[strtotime($expld_info[1])] = $expld_info;
	    	     $idsss[] = $expld_info[0];
	    	     $date_epf[$expld_info[0]] = $expld_info[1];
	    	 }
	}
	
	$array_doj_epf = array_filter($date_epf);

	if(count($array_doj_epf) > 1){
	    $last = end($array_doj_epf);
	} else {
	    $last = reset($array_doj_epf);
	}  
	
	$get_mnth_yr = explode('-',$last);
	$strt_day =  $get_mnth_yr[0];
	$mnth_strt = $get_mnth_yr[1];
    $yr_strt = $get_mnth_yr[2];


 $max = max(array_keys($new_arr));
$get_max_comp = $new_arr[$max];
$last_employer = $get_max_comp[2];
$last_emp_id = $get_max_comp[0];


//echo "select * from epf_passbook_detail where passbook_id IN (".implode(',',$idsss).")";

//echo "select * from epf_passbook_detail where epf_office_id ='".$last_emp_id."'";
$qry_get_pass = mysqli_query($Conn1, "select * from epf_passbook_detail where epf_office_id ='".$last_emp_id."'");
while($res_get_pass = mysqli_fetch_array($qry_get_pass)){
    $getmnth_yr = $res_get_pass['month_year'];
      $number = sprintf('%06d',$getmnth_yr);
    $cr_ee[substr( $number, -4 ).substr( $number, 0,2 )] = $res_get_pass['cr_ee_share'];
}


 $max_year = max(array_keys($cr_ee));
$end_yr = substr( $max_year, 0,4 );
$end_mnth = substr( $max_year, -2 );

$strt_date = strtotime($yr_strt.'-'.$mnth_strt.'-01');
$end_dateee = strtotime($end_yr.'-'.$end_mnth.'-01');
	
$diff = abs($end_dateee - $strt_date);  
$years = floor($diff / (365*60*60*24));  
$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));  
$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24)); 
  
 $max_mnth_yer = $cr_ee[$max_year];
 $cr_ee_share = $max_mnth_yer;
 $est_mnthly_slry = ($cr_ee_share * 100)/6;


$ttl_exp = $years.' years '.$months.' months '.$days.' days';
?>

<div class='modal-content animate' style='width:60%!important'>  
<div class='submenu_padding' style='padding-top:45px;'>
<span class='close_button ' onclick='document.getElementById("id01").style.display="none";'>X</span>
    <table style='width:100%;text-align: left;'><tr><th colspan='2' class='dstr-td' style='background:#b8d1f3;text-align:center'>EPF Summary</th></tr>
     <tr><th class='dstr-td' style='background:#b8d1f3;width:50%'>Last employer:</th><td class='dstr-td'><?php echo $last_employer; ?></td></tr>
    <tr><th class='dstr-td' style='background:#b8d1f3'>Total work experience:</th><td class='dstr-td'><?php echo $ttl_exp;?></td></tr>
   <!-- <tr><th class='dstr-td' style='background:#b8d1f3'>Estimated monthly salary: </th><td class='dstr-td'><?php //echo number_format($est_mnthly_slry); ?></td></tr> -->
    </table>
    </div></div>
    

?>