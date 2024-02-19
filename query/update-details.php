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

    	
} else if($_REQUEST['step'] == 2){
   
	$currentDateTime = date("Y-m-d H:i:s");
	$fieds_array = array(
		'query_id' => $_REQUEST['id'],
		'No_of_loans' => $_REQUEST['exis_loans'],
		'loan_type_1' => $_REQUEST['loan_type_on_1'],
		'bank_name_1' => $_REQUEST['bank_name_exi_1'],
		'emi_1' => $_REQUEST['emi_loan_on_1'],
		'no_of_emi_1' => $_REQUEST['no_of_emis_paid_on_1'],
		'outstanding_amount_1' => $_REQUEST['cur_out_stand_on_1'],
		'loan_type_2' => $_REQUEST['loan_type_on_2'],
		'bank_name_2' => $_REQUEST['bank_name_exi_2'],
		'emi_2' => $_REQUEST['emi_loan_on_2'],
		'no_of_emi_2' => $_REQUEST['no_of_emis_paid_on_2'],
		'outstanding_amount_2' => $_REQUEST['cur_out_stand_on_2'],
		'loan_type_3' => $_REQUEST['loan_type_on_3'],
		'bank_name_3' => $_REQUEST['bank_name_exi_3'],
		'emi_3' => $_REQUEST['emi_loan_on_3'],
		'no_of_emi_3' => $_REQUEST['no_of_emis_paid_on_3'],
		'outstanding_amount_3' => $_REQUEST['cur_out_stand_on_3'],
		'loan_type_4' => $_REQUEST['loan_type_on_4'],
		'bank_name_4' => $_REQUEST['bank_name_exi_4'],
		'emi_4' => $_REQUEST['emi_loan_on_4'],
		'no_of_emi_4' => $_REQUEST['no_of_emis_paid_on_4'],
		'outstanding_amount_4' => $_REQUEST['cur_out_stand_on_4'],
		'loan_type_5' => $_REQUEST['loan_type_on_5'],
		'bank_name_5' => $_REQUEST['bank_name_exi_5'],
		'emi_5' => $_REQUEST['emi_loan_on_5'],
		'no_of_emi_5' => $_REQUEST['no_of_emis_paid_on_5'],
		'outstanding_amount_5' => $_REQUEST['cur_out_stand_on_5'],
		'no_of_cards' => $_REQUEST['credit_running'],
		'credit_card_bank_name_exi_1' => $_REQUEST['credit_card_bank_name_exi_1'],
		'credit_sanction_amt_1' => $_REQUEST['credit_sanction_amt_1'],
		'current_out_stan_1' => $_REQUEST['current_out_stan_1'],
		'credit_card_vintage_1' => $_REQUEST['credit_card_vintage_1'],
		'credit_card_bank_name_exi_2' => $_REQUEST['credit_card_bank_name_exi_2'],
		'credit_sanction_amt_2' => $_REQUEST['credit_sanction_amt_2'],
		'current_out_stan_2' => $_REQUEST['current_out_stan_2'],
		'credit_card_vintage_2' => $_REQUEST['credit_card_vintage_2'],
		'credit_card_bank_name_exi_3' => $_REQUEST['credit_card_bank_name_exi_3'],
		'credit_sanction_amt_3' => $_REQUEST['credit_sanction_amt_3'],
		'current_out_stan_3' => $_REQUEST['current_out_stan_3'],
		'credit_card_vintage_3' => $_REQUEST['credit_card_vintage_3'],
		'credit_card_bank_name_exi_4' => $_REQUEST['credit_card_bank_name_exi_4'],
		'credit_sanction_amt_4' => $_REQUEST['credit_sanction_amt_4'],
		'current_out_stan_4' => $_REQUEST['current_out_stan_4'],
		'credit_card_vintage_4' => $_REQUEST['credit_card_vintage_4'],
		'loan_in_past' => $_REQUEST['loan_in_past'],
		'created_on' => $currentDateTime 
		
	);
	
	$count = count($fieds_array);
	$main_array = 0;
	$chek_data = "select id from crm_customer_existing_loan_details where query_id ='".$_REQUEST['id']."'";
	$data_get = mysqli_query($Conn1,$chek_data);
	$data_get1 = mysqli_num_rows($data_get);
	
	if(empty($data_get1)){
	$query_to_insert = "Insert into crm_customer_existing_loan_details set ";
	foreach($fieds_array as $key => $value){
		++$main_array;
		$query_to_insert .= $key ." = '".replace_special($value)."'";
		if($main_array != $count){
			$query_to_insert .= ",";
		}
	} 

	$update_qry = mysqli_query($Conn1,$query_to_insert) or die(mysqli_error($Conn1));
	}else{
		$query_to_update = "update crm_customer_existing_loan_details set ";
		foreach($fieds_array as $key => $value){
			++$main_array;
			$query_to_update .= $key ." = '".replace_special($value)."'";
			if($main_array != $count){
				$query_to_update .= ",";
			}
		} 
		$query_to_update .= "where query_id ='".replace_special($_REQUEST['id'])."'";
		$update_qry = mysqli_query($Conn1,$query_to_update);
	}
	

}

?>