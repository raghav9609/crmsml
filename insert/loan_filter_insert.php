<?php
$check_app_created_today = mysqli_query($Conn1,"select GROUP_CONCAT(pat_rec.pat_id SEPARATOR ',') as pat_id,cse.case_id as case_id from tbl_mint_case as cse left join tbl_mint_customer_info as cust on cse.cust_id =  cust.id join tbl_bank_cse_pat_rec as pat_rec on cse.case_id = pat_rec.case_id where pat_rec.dump_flag > 0 and pat_rec.date > DATE_SUB(CURDATE(), INTERVAL 15 DAY) and cust.phone = '".$result_cust_data['phone']."'");
	$total_case_check = mysqli_num_rows($check_app_created_today);
	$result_app_created_today = mysqli_fetch_array($check_app_created_today);
	$app_created_today =  explode(',',$result_app_created_today['pat_id']);
	
$loan_filter_qry = "select * from tbl_loan_filter where find_in_set($loan_type,loan_type_id) > 0 and net_incm <= '".$net_incm."' and loan_amount <= '".$loan_amt."' and status = 1 ";

$fetch_pat_list_qry = mysqli_query($Conn1,"select group_concat(pat_id SEPARATOR ',') as pat_id from tbl_pat_loan_type_mapping where disp_flag = 1 and loan_type = '".$loan_type."'");
$result_pat_list_qry = mysqli_fetch_array($fetch_pat_list_qry);
$bank_partner_arr = explode(',',$result_pat_list_qry['pat_id']);

foreach($bank_partner_arr as $bnk_fil){
	$qry_fet = $loan_filter_qry." and pat_id = '".$bnk_fil."'";
	/* if($bnk_fil == 21 || ($loan_type != 51 && $loan_type != 21 &&  $loan_type != 52 && $loan_type != 54  && $loan_type != 59 && $loan_type != 61 && $loan_type != 60)){
	$qry_fet .= " and occup_id = '".$occup."'";
	} */
	if($bnk_fil == 6 || $bnk_fil == 35 || $bnk_fil == 57){
	$qry_fet .= " and max_loan_amt >= '".$loan_amt."'";
	}if($bnk_fil != 4  && $bnk_fil != 41 && $bnk_fil != 50){
	$qry_fet .= " and city_id ='".$city_id."'";
	}
	$loan_filter_map = mysqli_query($Conn1,$qry_fet);  
	$result_loan_filter = mysqli_fetch_array($loan_filter_map);
	$filter_id = $result_loan_filter['filter_id'];
	if($filter_id != 0 && $filter_id != ""){
	$f_c = "green";
	}else{
	$f_c = "red";
	}
	if($filter_id != 0 && $filter_id != "" && $bnk_fil == 17 && ($loan_type == 51 || $loan_type == 54)){
	if($fil_sub_group_id != 15){
	$f_c = "green";
	}else{
	$f_c = "red";
	}}
	if(in_array($bnk_fil,$app_created_today)){
		$f_c = 'orange highlight';
	}else{
		$f_c = $f_c;
	}
	
	$partner_name_qry = mysqli_query($Conn1,"select * from tbl_mlc_partner where partner_id = '".$bnk_fil."'");
	$result_pat_name = mysqli_fetch_array($partner_name_qry);
	$mlc_pat_flag = $result_pat_name['filter_flag'];
	$mlc_pat_name = $result_pat_name['partner_name']; 
	$temp_flag = $result_pat_name['temp_flag'];
	
	?>
	<span class= "<?php echo $f_c; ?> f_14"><?php echo $mlc_pat_name." ".$ogl."&nbsp;|&nbsp;"; ?></span><?php
	}
	 ?>