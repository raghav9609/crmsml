<?php 
session_start();
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . "/../config/config.php");
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');

//require_once(dirname(__FILE__) . "/../../../include/class.memcache.php");
require_once(dirname(__FILE__) . "/../include/display-name-functions.php");
require_once "../include/helper.functions.php";

	if($_REQUEST['step'] == 1){
		
		$comp_name_other = $comp_id = $hospital_name = $main_comp_category = $sub_comp_category = $sub_sub_comp_category = $state_comp_category = '';

		$get_company_name = $_REQUEST['comp_name'];

		$get_city_id = data_search('city');
		$city = searchValue($_REQUEST['city_name'],'city_name', $get_city_id);
		$final_city_id = $get_city_id[$city]['id'];
	
		if($_REQUEST['work_city'] != ''){
			$work_city = searchValue($_REQUEST['work_city'],'city_name', $get_city_id);
		}

		
		
	// $comp_id_qry = mysqli_query($Conn1,"select comp_id,group_id,main_company_id from pl_company where comp_name = '".mysqli_real_escape_string($Conn1,$get_company_name)."'  and is_removed = 0");
    // if(mysqli_num_rows($comp_id_qry) > 0){
	// 	$result_comp_id = mysqli_fetch_assoc($comp_id_qry);
    //     $comp_id = $result_comp_id['comp_id'];
	// 	$main_company_id = $result_comp_id['main_company_id'];
	// 	if($main_company_id > 0 && is_numeric($main_company_id)){
	// 		$comp_id = $main_company_id;
	// 	}
	// }else{
	// 	$comp_name_other = $get_company_name;
	// }  

	// if($_REQUEST['main_comp_category'] > 0 && is_numeric($_REQUEST['main_comp_category'])){
	// 	$comp_category = $_REQUEST['main_comp_category'];
	// 	if(in_array($comp_category,array(2,3,5,6))){
	// 		if(in_array($_REQUEST['company_sub_cat'],array(1,4))){
	// 			$sub_comp_category = $_REQUEST['company_sub_cat'];
	// 			$comp_id = 0;
	// 			if($comp_category == 2){
	// 				$comp_name_other = 'Indian Army';
	// 			}else if($comp_category == 3){
	// 				$comp_name_other = 'Indian Railway';
	// 			}else if($comp_category == 5){
	// 				$comp_name_other = 'Indian Navy';
	// 			}else if($comp_category == 6){
	// 				$comp_name_other = 'Indian Airforce';
	// 			}
	// 		}else{
	// 			$comp_category = '';
	// 		}
	// 	}else{
	// 		$comp_id = 0;
	// 		$comp_name_other = '';
	// 		$sub_comp_category = $_REQUEST['company_sub_cat'];
	// 		$sub_sub_comp_category = $_REQUEST['company_sub_sub_cat'];
	// 		$state_comp_category = $_REQUEST['comp_cat_state'];
	// 		 if($state_comp_category > 0 && is_numeric($state_comp_category) && $sub_comp_category == 2){
	// 			$comp_name_other = get_display_name("state",$state_comp_category);
	// 		 }else if($state_comp_category > 0 && is_numeric($state_comp_category) && $sub_comp_category == 1 && $comp_category == 1){
	// 			$comp_name_other = get_display_name("central_police",$state_comp_category);
	// 		 }
	// 		$comp_name_other .= " ".$get_company_name;
	// 	}
	// }

    	$net_income = $_REQUEST['net_month_inc'];
		$curexp = $_REQUEST['ccwe'];
		$ttlexp = "-".$_REQUEST['twe']." Months";
		$detcur = "-".$curexp." Months";
		$curwrkexp = date("Y-m-d",strtotime($detcur));
		$ttlwrkexp = date("Y-m-d",strtotime($ttlexp));
        $fieds_array = array(
            'salutation_id' => $_REQUEST['salutation'],
            'name' => $_REQUEST['name'],
            'dob' => $_REQUEST['dob'],
            'bank_account_no' =>  $_REQUEST['account_no'],
            'email_id' => $_REQUEST['email'],
            'marital_status_id' => $_REQUEST['maritalstatus'],
            'occupation_id' => $_REQUEST['occupation_id'],
            'company_id' => $comp_id,
            'company_name' => $get_company_name,
            'net_income' => $net_income,
            'salary_bank_id' => $_REQUEST['main_acc'],
            'city_id' => $final_city_id,
            'address' => trim($_REQUEST['address']),
            'office_pincode' => trim($_REQUEST['ofc_pincode']),
            'office_city_id' => $get_city_id[$work_city]['id'],
            'office_address' => trim($_REQUEST['offce_address']),
            'office_email_id' => trim($_REQUEST['ofc_email']),
			'mode_of_salary' => $_REQUEST['slry_paid'],
			'pincode' => $_REQUEST['pin_code'],
			'current_work_exp'=> $curwrkexp,
			'total_work_exp'=> $ttlwrkexp,
			"address" => $_REQUEST['address']
	    );

		echo "<br>asnu";
		$count = count($fieds_array);
		//$count_intt = count($fieds_array_intt);
		$main_array = $intt_array = 0;
		$query_to_update = "update crm_customer set ";
		foreach($fieds_array as $key => $value){
			++$main_array;
			$query_to_update .= $key ." = '".replace_special($value)."'";
			if($main_array != $count){
				$query_to_update .= ",";
			}
		}
		$query_to_update .= ",updated_on=CURDATE(),pan_no='".replace_special(trim($_REQUEST['pan_card']))."'";
		if(is_numeric($_REQUEST['alt_phone_no'])){
			$query_to_update .= ",alternate_phone_no=".$_REQUEST['alt_phone_no'];
		}

		echo $query_to_update .= " where id ='".replace_special($_REQUEST['cust_id'])."'";
		$update_qry = mysqli_query($Conn1,$query_to_update) or die(mysqli_error($Conn1));
		die();
	
	
	
	if($_REQUEST['loan_type'] == 11 && $_REQUEST['occupation_id'] == 1){
		$hospital_name = $get_company_name;
	}

		// $addrs_proof = implode('/', $_REQUEST['address_proof']);
		// $update_query_data = mysqli_query($Conn1,"update tbl_mint_query set score_flag=0,gross_annual_receipt = '".$_REQUEST['gross_annual_receipt']."',addrs_proof= '".$addrs_proof."',residential_type='".$_REQUEST['residential_type']."',hospital_name='".$hospital_name."',firm_name='".$_REQUEST['firm_name']."' where query_id = 
		// '".replace_special($_REQUEST['id'])."'");
	
		// $update_query_data = mysqli_query($Conn1,"update tbl_mint_query_status_detail set is_nstp = 1 where query_id = 
		// '".replace_special($_REQUEST['id'])."'");
    	
} else if($_REQUEST['step'] == 2){
    // $property_identified = $_REQUEST['prop_identified'];

	// $fieds_array = array(
		// 'score_flag' => 0,
		// 'loan_nature' => $_REQUEST['nature_loan'],
		// 'emi_moritorium' => $_REQUEST['emi_moritorium'],
		// 'property_location_id' => $prop_location_id,
		// 'loan_amt' => $_REQUEST['loan_amount'],
		// 'property_city_id' => $final_city_id,
		// 'asset_type' => $_REQUEST['asset_type'],
		// 'bank_id' => $_REQUEST['exs_bank_id'],
		// 'cur_rate' => $_REQUEST['cur_rate'],
		// 'top_up_neded' => $top_up_needed,
		// 'current_loan_start_month' => $_REQUEST['cur_lo_s_m'],
		// 'loan_emi' => $_REQUEST['ex_emi'],
		// 'extng_amt' => $_REQUEST['ex_amt'],
		// 'top_loan_amt' => $_REQUEST['top_loan_amt'],
		// 'agreement_value' => $_REQUEST['agreement_value'],
		// 'property_identified' => $property_identified,
		// 'budget_id' => $_REQUEST['u_budget'],
		// 'saving_account_no' => $_REQUEST['saving_account_no'],
		// 'relation_with_bank_id' => $_REQUEST['relation_with_bank_id'],
		// 'address_proof_no' => $_REQUEST['address_proof_no'],
		// 'property_identified_sale_type_id' => $_REQUEST['prop_identified_sale_type'],
		// 'type_of_construction' => $_REQUEST['udconst'],
		// 'builder_name' => $_REQUEST['buildername'],
		// 'project_name' => $_REQUEST['project_name'],
		// 'property_size' => $_REQUEST['property_size'],
		// 'loan_purpose' => $_REQUEST['purpose_of_loan'],
		// 'total_obligations' => $_REQUEST['total_obligations'],
		// 'property_identified_market_value' => $_REQUEST['prop_iden_mar_value'],
		// 'property_negative_ques' => $_REQUEST['negative_ques'],
		// 'property_ready_to_move_type' => $_REQUEST['srtm'],
		// 'weight_gold' => $_REQUEST['gold_weight'],
		// 'purity_gold' => $_REQUEST['gold_purity'],
		// 'gold_type' => $_REQUEST['gold_type'],
		// 'appointment_date'=>$_REQUEST['apptmnt_date'], 
		// 'appointment_time'=>$_REQUEST['apptmnt_time'], 
		// 'appointment_place'=>$_REQUEST['app_place'], 
		// 'card_sourcing'=>$_REQUEST['card_tocard'], 
		// 'res_same_work'=>$_REQUEST['res_same_work'], 
		// 'credit_limit'=>$_REQUEST['credit_limit'], 
		// 'loan_in_past' => $_REQUEST['loan_in_past'],
		// 'pref_loan_tenure' => $_REQUEST['pref_ln_ten'],
		// 'cc_since'=>$_REQUEST['cc_since'],
		// 'paramilitary_profile'=>$_REQUEST['commisioned'],
		// 'dl_degree_specialization' => $_REQUEST['degree_specialization'],
		// 'educational_degree_dl' =>$_REQUEST['educational_degree'],
		// 'place_of_business'=>$_REQUEST['place_of_business'],
		// 'bus_itr_aval'=>$_REQUEST['ITR_available'],
		// 'work_in_hospital'=>$_REQUEST['work_in_hospital'],
		// 'bus_reg_type' => $_REQUEST['type_of_registration'],
		// 'bank_acc_type' => $_REQUEST['bank_account_type'],
		// 'business_type' => $_REQUEST['business_type'],
		// 'bus_nature' => $_REQUEST['nature_of_business'],
		// 'industry' => $_REQUEST['industry_type'],
		// 'annual_turnover_num' => $_REQUEST['annual_turnover'],
		// 'business_existing_num' => $_REQUEST['years_in_business'],
		// 'profit_itr_amt' => $_REQUEST['annual_profit'],
		// 'degree_reg_year' => $_REQUEST['degree_reg_year'],
		// 'own_house_in_india' => $_REQUEST['own_house_in_india'],
		// 'bus_anl_trnover' => $annual_turnover_num,
		// 'bus_ext_year' => $business_existing_num,
		// 'gst_reg' => $gst_reg,
		// 'avg_month_balance' => $_REQUEST['avg_month_balance'],
		// 'bank_acc_type' => $_REQUEST['cust_bank_account_type'],
		// 'gstin_number' => $_REQUEST['gstin_number'],
		// 'prev_sess_revenue' => $_REQUEST['gross_turnover_prev_sess'],
		// 'cur_sess_revenue' => $_REQUEST['gross_turnover_curr_sess']
	// );
	$fieds_array = array(
		'query_id' => $_REQUEST['id'],
		'No_of_loans' => $_REQUEST['exis_loans'],
		'loan_type_1' => $_REQUEST['loan_type_on'],
		'bank_name_1' => $_REQUEST['bank_name_exi'],
		'emi_1' => $_REQUEST['emi_loan_on'],
		'no_of_emi_1' => $_REQUEST['no_of_emis_paid_on'],
		'outstanding_amount_1' => $_REQUEST['cur_out_stand_on'],
	);
	print_r($fieds_array);
	exit();
	$count = count($fieds_array);
	$main_array = 0;
	$query_to_update = "Insert into crm_customer_existing_loan_details set ";
	foreach($fieds_array as $key => $value){
		++$main_array;
		$query_to_update .= $key ." = '".replace_special($value)."'";
		if($main_array != $count){
			$query_to_update .= ",";
		}
	} 
	// if($_REQUEST['residential_type'] > 0 && is_numeric($_REQUEST['residential_type'])){
	// 	$query_to_update .= ",residential_type = '".$_REQUEST['residential_type']."'";
	// }
	// if($_REQUEST['proof_of_address'] != '' && $_REQUEST['proof_of_address'] > 0 && is_numeric($_REQUEST['proof_of_address'])){
	// 	$query_to_update .= ",addrs_proof = '".$_REQUEST['proof_of_address']."'";
	// }
	// $query_to_update .= "where query_id ='".replace_special($_REQUEST['id'])."'";
	$update_qry = mysqli_query($Conn1,$query_to_update) or die(mysqli_error($Conn1));

	// $update_mint_status = mysqli_query($Conn1,"update tbl_mint_query_status_detail set 
	// 	date_modified = NOW(),is_nstp = 1 where query_id = ".replace_special($_REQUEST['id'])) or die(mysqli_error($Conn1));	

	// if(($_REQUEST['credit_running'] > 0 || $_REQUEST['exis_loans'] > 0) && $_REQUEST['customer_id'] > 0){
	// 	$check_loans = mysqli_query($Conn1,"select * from tbl_mint_cust_loans where cust_id =".$_REQUEST['customer_id']);
	// 	$bank_cards = array_filter(array($_REQUEST['credit_bank_id'],$_REQUEST['credit_bank_id_tw'],$_REQUEST['credit_bank_id_th'],$_REQUEST['credit_bank_id_fr'],$_REQUEST['credit_bank_id_fv']));
	// 	$cards_outstanding = array_filter(array($_REQUEST['current_out_stan_on'],$_REQUEST['current_out_stan_tw'],$_REQUEST['current_out_stan_th'],$_REQUEST['current_out_stan_fr'],$_REQUEST['current_out_stan_fv']));
	// 	$cards_credit_limit = array_filter(array($_REQUEST['credit_sanction_amt_on'],$_REQUEST['credit_sanction_amt_tw'],$_REQUEST['credit_sanction_amt_th'],$_REQUEST['credit_sanction_amt_fr'],$_REQUEST['credit_sanction_amt_fv']));

	// 	$exist_loans_outstanding = array_filter(array($_REQUEST['cur_out_stand_on'],$_REQUEST['cur_out_stand_tw'],$_REQUEST['cur_out_stand_th'],$_REQUEST['cur_out_stand_fr'],$_REQUEST['cur_out_stand_fv']));

	// 	$type_of_loan = array_filter(array($_REQUEST['loan_type_on'],$_REQUEST['loan_type_tw'],$_REQUEST['loan_type_th'],$_REQUEST['loan_type_fr'],$_REQUEST['loan_type_fv']));
	// 	$exsit_loan_emi = array_filter(array($_REQUEST['emi_loan_on'],$_REQUEST['emi_loan_tw'],$_REQUEST['emi_loan_th'],$_REQUEST['emi_loan_fr'],$_REQUEST['emi_loan_fv']));
	// 	$exist_bank_is = array_filter(array($_REQUEST['ex_bank_id'],$_REQUEST['ex_bank_id_tw'],$_REQUEST['ex_bank_id_th'],$_REQUEST['ex_bank_id_fr'],$_REQUEST['ex_bank_id_fv']));

	// 	$no_of_emis_paid = array_filter(array($_REQUEST['no_of_emis_paid_on'], $_REQUEST['no_of_emis_paid_tw'], $_REQUEST['no_of_emis_paid_th'], $_REQUEST['no_of_emis_paid_fr'], $_REQUEST['no_of_emis_paid_fv']));
	// 	$credit_card_vintage = array_filter(array($_REQUEST['credit_card_vintage_on'], $_REQUEST['credit_card_vintage_tw'], $_REQUEST['credit_card_vintage_th'], $_REQUEST['credit_card_vintage_fr'], $_REQUEST['credit_card_vintage_fv']));

	// 	if(mysqli_num_rows($check_loans) > 0){
	// 		$update_query = mysqli_query($Conn1,"update tbl_mint_cust_loans set no_of_credit_card = '".$_REQUEST['credit_running']."',
	// 			bank_card='".implode('/',$bank_cards)."',sanction_amt_card='".implode('/',$cards_credit_limit)."',cur_out_stan_card='".implode('/',$cards_outstanding)."',no_of_loan ='".$_REQUEST['exis_loans']."',type_of_loan='".implode('/',$type_of_loan)."',bank='".implode('/',$exist_bank_is)."',emi_of_loan='".implode('/',$exsit_loan_emi)."', no_of_emis_paid = '".implode('/', $no_of_emis_paid)."', credit_card_vintage = '".implode('/', $credit_card_vintage)."', cur_out_standing_amt = '".implode('/', $exist_loans_outstanding)."' where cust_id =".$_REQUEST['customer_id']);
	// 	}else{
	// 		$update_query = mysqli_query($Conn1,"insert into tbl_mint_cust_loans set no_of_credit_card = '".$_REQUEST['credit_running']."',
	// 			bank_card='".$bank_cards."',sanction_amt_card='".$cards_credit_limit."',cur_out_stan_card='".$cards_outstanding."', cur_out_standing_amt = '".implode('/', $exist_loans_outstanding)."' ,cust_id =".$_REQUEST['customer_id']);
	// 	}
	// }else{
	// 	$update_query = mysqli_query($Conn1,"update tbl_mint_cust_loans set no_of_loan=0,no_of_credit_card = '0',
	// 			bank_card='',sanction_amt_card='',cur_out_stan_card='' where cust_id =".$_REQUEST['customer_id']);
	// }

}
?>