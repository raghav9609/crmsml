<?php
require_once "../../include/check-session.php";
require_once "../../include/config.php";

require_once "../../include/helper.functions.php";
$connection_fd = mysqli_connect(DB_HOST_MLC,DB_Username_MLC,DB_Password_MLC,DB_Name_MLC) or die(mysqli_connect_error());

$template = replace_special($_REQUEST['temp']);
$case_id = replace_special($_REQUEST['case_id']);
$query_id = replace_special($_REQUEST['query_id']);
$app_id =  replace_special($_REQUEST['app_id']);

if($query_id != '') {
$qry_qryid = mysqli_query($Conn1,"select qry.gold_type,qry.property_identified_sale_type_id as property_identified_sale_type_id,qry.property_location_id as property_location_id,qry.property_size as property_size,qry.bus_nature as bus_nature,qry.annual_turnover_num as annual_turnover_num,qry.business_existing_num as business_existing_num,qry.itr_available_num as itr_available_num,qry.cust_id as cust_id,qry.loan_type as loan_type,qry.loan_amt as loan_amt,qry.extng_amt as extng_amt,qry.loan_nature as loan_nature,stats.user_id as user_id,qry.asset_type as asset_type,qry.borrower_count as borrower_count,qry.weight_gold as weight_gold,qry.purity_gold as purity_gold,qry.cur_rate as cur_rate,qry.loan_emi as loan_emi,qry.property_city_id as property_city_id,qry.property_identified as property_identified from tbl_mint_query as qry left JOIN tbl_mint_query_status_detail as stats ON qry.query_id = stats.query_id where qry.query_id = ".$query_id."");
$info_qury = mysqli_fetch_array($qry_qryid);
$cust_id = $info_qury['cust_id'];
$user_id = $info_qury['user_id'];
$bank_id = $info_qury['bank_id'];
$gold_type = $info_qury['gold_type'];

$loan_type_id= $info_qury['loan_type'];
$prop_type = $info_qury['asset_type'];
$loan_amt = $info_qury['loan_amt'];
$extng_amt = $info_qury['extng_amt'];
$pur_loan = $info_qury['loan_nature'];
$borrower_count = $info_qury['borrower_count'];	
$weight_gold = $info_qury['weight_gold'];
$purity_gold = $info_qury['purity_gold'];
$cur_rate = $info_qury['cur_rate'];
$loan_emi = $info_qury['loan_emi'];
$bus_nature  =  $info_qury['bus_nature'];
$bus_anl_trnover =  $info_qury['annual_turnover_num'];
$bus_ext_year = $info_qury['business_existing_num'];
$bus_itr_aval = $info_qury['itr_available_num'];
$property_identified_sale_type_id =  $info_qury['property_identified_sale_type_id'];
$property_location_id = $info_qury['property_location_id'];
$property_size = $info_qury['property_size'];
$property_identified = $info_qury['property_identified'];
$property_city_id = $info_qury['property_city_id'];
if($borrower_count > 0){
$qry_qry_cob = mysqli_query($Conn1,"select occup_on,dob_on,net_incm_on,occup_tw,dob_tw,net_incm_tw,cur_emi_tw,cur_emi_on from tbl_mint_cust_coborrower where query_id = ".$query_id."");
$info_qury_cob = mysqli_fetch_array($qry_qry_cob);
$occup_on = $info_qury_cob['occup_on'];
$dob_on = $info_qury_cob['dob_on'];
$net_incm_on = $info_qury_cob['net_incm_on'];
$occup_tw = $info_qury_cob['occup_tw'];
$dob_tw = $info_qury_cob['dob_tw'];
$net_incm_tw = $info_qury_cob['net_incm_tw'];
$cur_emi_on = $info_qury_cob['cur_emi_on'];
$cur_emi_tw = $info_qury_cob['cur_emi_tw'];
}
}else{
$query_custid= "select gold_type,query_id,property_location_id,property_size,cust_id,required_loan_amt,loan_type,user_id,asset_type,ext_amt,loan_nature,weight_gold,purity_gold,cur_rate_intr,ext_emi,annual_turnover_num,bus_nature,	business_existing_num,itr_available_num,prop_city From tbl_mint_case where case_id = ".$case_id."";
$result_query = mysqli_query($Conn1,$query_custid);
$info_query = mysqli_fetch_array($result_query);
$query_id = $info_query ['query_id'];
$cust_id = $info_query ['cust_id'];
$loan_type_id = $info_query['loan_type'];
$gold_type = $info_query['gold_type'];
$prop_type = $info_query['asset_type'];
$user_id = $info_query['user_id'];
$loan_amt = $info_query['required_loan_amt'];
$extng_amt = $info_query['ext_amt'];
$pur_loan = $info_query['loan_nature'];
$weight_gold = $info_query['weight_gold'];
$purity_gold = $info_query['purity_gold'];
$cur_rate = $info_query['cur_rate_intr'];
$loan_emi = $info_query['ext_emi'];
$bus_nature  =  $info_query['bus_nature'];
$bus_anl_trnover =  $info_query['annual_turnover_num'];
$bus_ext_year = $info_query['business_existing_num'];
$bus_itr_aval = $info_query['itr_available_num'];
$property_location_id = $info_query['property_location_id'];
$property_size = $info_query['property_size'];
$property_city_id = $info_query['prop_city'];

$qry_mint = "select * from tbl_mint_case_detail where case_id = ".$case_id."";
$res_mint = mysqli_query($Conn1,$qry_mint) or die(mysqli_error($Conn1));
$fetch_mint = mysqli_fetch_array($res_mint);
$property_identified_sale_type_id = $fetch_mint['prop_sale_type_id'];
$property_identified = $fetch_mint['property_identified'];

}

$query_info = "select name,mname,lname,salu_id,city_id,email, occup_id, net_incm, comp_id,dob from tbl_mint_customer_info where id = ".$cust_id."";
$result_info = mysqli_query($Conn1,$query_info);
$info_query1 = mysqli_fetch_array($result_info);
$name = $info_query1['name']."".$info_query1['mname']." ".$info_query1['lname'];
$salu_id = $info_query1['salu_id'];
$city_id = $info_query1['city_id'];
$email_cust = $info_query1['email'];
$occup_id = $info_query1['occup_id'];
$comp_id_l = $info_query1['comp_id'];
$net_incm_long = $info_query1['net_incm'];
$dob = $info_query1['dob'];


$query_info1 = "select totl_wrk_exp,salary_pay_id,profession_id from tbl_mint_cust_info_intt where cust_id = ".$cust_id."";
$result_info1 = mysqli_query($Conn1,$query_info1);
$info_query2 = mysqli_fetch_array($result_info1);
$twe = $info_query2['totl_wrk_exp'];
$slry_paid = $info_query2['salary_pay_id'];
$profession_id = $info_query2['profession_id'];

$query_info2 = "select no_of_loan,no_of_credit_card from  tbl_mint_cust_loans where cust_id = ".$cust_id."";
$result_info2 = mysqli_query($Conn1,$query_info2);
$info_query3 = mysqli_fetch_array($result_info2);
$no_of_loan = $info_query3['no_of_loan'];
$no_of_credit_card = $info_query3['no_of_credit_card'];

$query_salu = "select salutn_name from tbl_saluation where salutn_id = '".$salu_id."'";
$result_salu =  mysqli_query($Conn1,$query_salu );
$salu_query = mysqli_fetch_array($result_salu );
$salutn_name = $salu_query['salutn_name'];

$query_bank = "select app_bank_on, cash_offers_on from tbl_mint_app ";
if($app_id != '' && $app_id != 0){
$query_bank .= " where app_id = '".$app_id."'";
}else{
$query_bank .= " where case_id = ".$case_id."";
}
$result_bank = mysqli_query($Conn1,$query_bank);
$bank_query1 = mysqli_fetch_array($result_bank);
$app_bank_on = $bank_query1['app_bank_on'];
$cash_offers_on = $bank_query1['cash_offers_on'];

$query_bank1 = "select bank_name from tbl_bank where bank_id = '".$app_bank_on."'";
$result_bank1 = mysqli_query($Conn1,$query_bank1);
$bank_query2 = mysqli_fetch_array($result_bank1);
$bank_name = $bank_query2['bank_name'];
$query_loan1 = "select loan_type_name from lms_loan_type where loan_type_id = '".$loan_type_id."'";
$result_loan1 = mysqli_query($Conn1,$query_loan1 );
$loan_query2 = mysqli_fetch_array($result_loan1);
$loan_type_name = $loan_query2['loan_type_name'];
$query_user = "select contact_no,user_name from tbl_user_assign where user_id = '".$user_id."'";
$result_user = mysqli_query($Conn1,$query_user);
$user_query2 = mysqli_fetch_array($result_user);
$user_name = $user_query2['user_name'];
$contact_no = $user_query2['contact_no'];
$query_cashback = "select max(voucher) as voucher from tbl_festive_offer where loan_type_id = '".$loan_type_id."'";
$result_cashback = mysqli_query($Conn1,$query_cashback );
$cashback_query2 = mysqli_fetch_array($result_cashback);
$voucher = $cashback_query2['voucher'];

$city_name = mysqli_query($Conn1,"select city_name, city_sub_group_offer_id from lms_city where city_id = '".$city_id."'");
$res_name = mysqli_fetch_array($city_name);
$city_name = $res_name['city_name'];
$city_sub_group_id = $res_name['city_sub_group_offer_id'];

$bajaj_finserv_bank_id 	= 75;
$pnb_hfc_bank_id 		= 31;
$icici_hfc_bank_id 		= 142;

$fd_bajaj_products_query = mysqli_query($connection_fd, "SELECT id, product_name FROM tbl_fd_product_name WHERE bank_id='" . $bajaj_finserv_bank_id . "' AND flag = 1 ");
while ($fd_bajaj_products_result = mysqli_fetch_array($fd_bajaj_products_query)) {
	$fd_bajaj_products_desc = mysqli_query($connection_fd, "SELECT * FROM tbl_fd_prod_desc WHERE product_id='".$fd_bajaj_products_result['id'] ."' AND type_id = 1");
	$feat = array();
	while($fd_bajaj_result_desc = mysqli_fetch_array($fd_bajaj_products_desc)) {
		$bajaj_key_features .= "<p style='line-height: 19px;'> &#8226; ".$fd_bajaj_result_desc['description']."</p>";
	}
}

$fd_pnb_products_query = mysqli_query($connection_fd, "SELECT id, product_name FROM tbl_fd_product_name WHERE bank_id='" . $pnb_hfc_bank_id . "' AND flag = 1");
while ($fd_pnb_products_result = mysqli_fetch_array($fd_pnb_products_query)) {
	$fd_pnb_products_desc = mysqli_query($connection_fd, "SELECT * FROM tbl_fd_prod_desc WHERE product_id='".$fd_pnb_products_result['id'] ."' AND type_id = 1");
	$feat = array();
	while($fd_pnb_result_desc = mysqli_fetch_array($fd_pnb_products_desc)) {
		$pnb_key_features .= "<p style='line-height: 19px;'> &#8226; ".$fd_pnb_result_desc['description']."</p>";
	}
}

$fd_icici_products_query = mysqli_query($connection_fd, "SELECT id, product_name FROM tbl_fd_product_name WHERE bank_id='" . $icici_hfc_bank_id . "' AND flag = 1");
while ($fd_icici_products_result = mysqli_fetch_array($fd_icici_products_query)) {
	$fd_icici_products_desc = mysqli_query($connection_fd, "SELECT * FROM tbl_fd_prod_desc WHERE product_id='".$fd_icici_products_result['id'] ."' AND type_id = 1");
	$feat = array();
	while($fd_icici_result_desc = mysqli_fetch_array($fd_icici_products_desc)) {
		$icici_key_features .= "<p style='line-height: 19px;'> &#8226; ".$fd_icici_result_desc['description']."</p>";
	}
}

$fd_bajaj_details = mysqli_fetch_array(mysqli_query($connection_fd, "SELECT max(rate) AS mx_rt FROM tbl_fd_rates WHERE bank_id = '" . $bajaj_finserv_bank_id . "'"));
$fd_bajaj_search_months = "SELECT f_year, f_month, f_day, t_year, t_month, t_day, rate, senr_citizen_rate FROM tbl_fd_rates WHERE bank_id ='" . $bajaj_finserv_bank_id . "' ORDER BY f_year, f_month, f_day";
$fd_bajaj_result_months = mysqli_query($connection_fd, $fd_bajaj_search_months);
$bfd_i = 0;
while($fetch = mysqli_fetch_array($fd_bajaj_result_months)) {
	$f_year 	= $fetch['f_year'];
	$f_month 	= $fetch['f_month'];
	$f_day 		= $fetch['f_day'];
	$t_year 	= $fetch['t_year'];
	$t_month 	= $fetch['t_month'];
	$t_day 		= $fetch['t_day'];
	$rate 		= $fetch['rate'];
	$senr_citizen_rate = $fetch['senr_citizen_rate'];

	$bajaj_general_cell .= '<p style="line-height: 19px;"> &#8226; ';
	if ($f_year != '0') {
		$bajaj_general_cell .= $f_year; 
	}
	if($f_year != '0' && $f_year == '1') { 
		$bajaj_general_cell .= " year";
	} elseif ($f_year != '0' && $f_year != '1') {
		$bajaj_general_cell .= " years";
	}
	if($f_month != '0') {
		$bajaj_general_cell .= $f_month;
	}
	if($f_month != '0' && $f_month == '1') {
		$bajaj_general_cell .= " month ";
	} elseif ($f_month != '0' && $f_month != '1') {
		$bajaj_general_cell .= " months ";
	}
	if($f_day != '0') {
		$bajaj_general_cell .= $f_day;
	}
	if($f_day != '0' && $f_day == '1') {
		$bajaj_general_cell .= " day";
	} elseif($f_day != '0' && $f_day != '1') {
		$bajaj_general_cell .= " days";
	} 
	if($t_year == '0' && $t_month == '0' && $t_day == '0') {

	} else {
		$bajaj_general_cell .= " <span class='orange'> to </span>";
	}
	if($t_year != '0') {
		$bajaj_general_cell .= $t_year;
	}
	if($t_year != '0' && $t_year == '1') { 
		$bajaj_general_cell .= " year";
	} elseif($t_year != '0' && $t_year != '1') {
			$bajaj_general_cell .= " years";
	}
	if($t_month != '0') {
		$bajaj_general_cell .= $t_month;
	}
	if ($t_month != '0' && $t_month == '1') {
		$bajaj_general_cell .= " month ";
	} elseif ($t_month != '0' && $t_month != '1') {
		$bajaj_general_cell .= " months ";
	}
	if($t_day != '0') {
		$bajaj_general_cell .= $t_day;
	}
	if ($t_day != '0' && $t_day == '1') { 
		$bajaj_general_cell .= " day";
	} elseif ($t_day != '0' && $t_day != '1') {
		$bajaj_general_cell .= " days";
	}
	$bajaj_general_cell .= " - ";
	$bajaj_general_cell .= " $rate % </p> ";
	
	if($bfd_i == 0) {
		$bajaj_senior_cell .= "<span>";
		if($senr_citizen_rate != '0') {
			$bajaj_senior_cell .=  $senr_citizen_rate - $rate . '%';
		} else {
			$bajaj_senior_cell .=  '-';
		}
		$bajaj_senior_cell .= "</span>";
	}
	++$bfd_i;
}

$fd_pnb_details = mysqli_fetch_array(mysqli_query($connection_fd, "SELECT max(rate) AS mx_rt FROM tbl_fd_rates WHERE bank_id = '" . $pnb_hfc_bank_id . "'"));
$fd_pnb_search_months = "SELECT f_year, f_month, f_day, t_year, t_month, t_day, rate, senr_citizen_rate FROM tbl_fd_rates WHERE bank_id ='" . $pnb_hfc_bank_id . "' ORDER BY f_year, f_month, f_day";
$fd_pnb_result_months = mysqli_query($connection_fd, $fd_pnb_search_months);
$pnb_i = 0;
while($fetch = mysqli_fetch_array($fd_pnb_result_months)) {
	$f_year 	= $fetch['f_year'];
	$f_month 	= $fetch['f_month'];
	$f_day 		= $fetch['f_day'];
	$t_year 	= $fetch['t_year'];
	$t_month 	= $fetch['t_month'];
	$t_day 		= $fetch['t_day'];
	$rate 		= $fetch['rate'];
	$senr_citizen_rate = $fetch['senr_citizen_rate'];

	$pnb_general_cell .= '<p style="line-height: 19px;"> &#8226; ';
	if ($f_year != '0') {
		$pnb_general_cell .= $f_year; 
	}
	if($f_year != '0' && $f_year == '1') { 
		$pnb_general_cell .= " year";
	} elseif ($f_year != '0' && $f_year != '1') {
		$pnb_general_cell .= " years";
	}
	if($f_month != '0') {
		$pnb_general_cell .= $f_month;
	}
	if($f_month != '0' && $f_month == '1') {
		$pnb_general_cell .= " month ";
	} elseif ($f_month != '0' && $f_month != '1') {
		$pnb_general_cell .= " months ";
	}
	if($f_day != '0') {
		$pnb_general_cell .= $f_day;
	}
	if($f_day != '0' && $f_day == '1') {
		$pnb_general_cell .= " day";
	} elseif($f_day != '0' && $f_day != '1') {
		$pnb_general_cell .= " days";
	} 
	if($t_year == '0' && $t_month == '0' && $t_day == '0') {

	} else {
		$pnb_general_cell .= " <span class='orange'> to </span>";
	}
	if($t_year != '0') {
		$pnb_general_cell .= $t_year;
	}
	if($t_year != '0' && $t_year == '1') { 
		$pnb_general_cell .= " year";
	} elseif($t_year != '0' && $t_year != '1') {
			$pnb_general_cell .= " years";
	}
	if($t_month != '0') {
		$pnb_general_cell .= $t_month;
	}
	if ($t_month != '0' && $t_month == '1') {
		$pnb_general_cell .= " month ";
	} elseif ($t_month != '0' && $t_month != '1') {
		$pnb_general_cell .= " months ";
	}
	if($t_day != '0') {
		$pnb_general_cell .= $t_day;
	}
	if ($t_day != '0' && $t_day == '1') { 
		$pnb_general_cell .= " day";
	} elseif ($t_day != '0' && $t_day != '1') {
		$pnb_general_cell .= " days";
	}
	$pnb_general_cell .= " - ";
	$pnb_general_cell .= " $rate % </p> ";
	
	if($pnb_i == 0) {
		$pnb_senior_cell .= "<span>";
		if($senr_citizen_rate != '0') {
			$pnb_senior_cell .=  $senr_citizen_rate - $rate . '%';
		} else {
			$pnb_senior_cell .=  '-';
		}
		$pnb_senior_cell .= "</span>";
	}
	++$pnb_i;
}

$fd_icici_details = mysqli_fetch_array(mysqli_query($connection_fd, "SELECT max(rate) AS mx_rt FROM tbl_fd_rates WHERE bank_id = '" . $icici_hfc_bank_id . "'"));
$fd_icici_search_months = "SELECT f_year, f_month, f_day, t_year, t_month, t_day, rate, senr_citizen_rate FROM tbl_fd_rates WHERE bank_id ='" . $icici_hfc_bank_id . "' ORDER BY f_year, f_month, f_day";
$fd_icici_result_months = mysqli_query($connection_fd, $fd_icici_search_months);
$icici_i = 0;
while($fetch = mysqli_fetch_array($fd_icici_result_months)) {
	$f_year 	= $fetch['f_year'];
	$f_month 	= $fetch['f_month'];
	$f_day 		= $fetch['f_day'];
	$t_year 	= $fetch['t_year'];
	$t_month 	= $fetch['t_month'];
	$t_day 		= $fetch['t_day'];
	$rate 		= $fetch['rate'];
	$senr_citizen_rate = $fetch['senr_citizen_rate'];

	$icici_general_cell .= '<p style="line-height: 19px;"> &#8226; ';
	if ($f_year != '0') {
		$icici_general_cell .= $f_year; 
	}
	if($f_year != '0' && $f_year == '1') { 
		$icici_general_cell .= " year";
	} elseif ($f_year != '0' && $f_year != '1') {
		$icici_general_cell .= " years";
	}
	if($f_month != '0') {
		$icici_general_cell .= $f_month;
	}
	if($f_month != '0' && $f_month == '1') {
		$icici_general_cell .= " month ";
	} elseif ($f_month != '0' && $f_month != '1') {
		$icici_general_cell .= " months ";
	}
	if($f_day != '0') {
		$icici_general_cell .= $f_day;
	}
	if($f_day != '0' && $f_day == '1') {
		$icici_general_cell .= " day";
	} elseif($f_day != '0' && $f_day != '1') {
		$icici_general_cell .= " days";
	} 
	if($t_year == '0' && $t_month == '0' && $t_day == '0') {

	} else {
		$icici_general_cell .= " <span class='orange'> to </span>";
	}
	if($t_year != '0') {
		$icici_general_cell .= $t_year;
	}
	if($t_year != '0' && $t_year == '1') { 
		$icici_general_cell .= " year";
	} elseif($t_year != '0' && $t_year != '1') {
			$icici_general_cell .= " years";
	}
	if($t_month != '0') {
		$icici_general_cell .= $t_month;
	}
	if ($t_month != '0' && $t_month == '1') {
		$icici_general_cell .= " month ";
	} elseif ($t_month != '0' && $t_month != '1') {
		$icici_general_cell .= " months ";
	}
	if($t_day != '0') {
		$icici_general_cell .= $t_day;
	}
	if ($t_day != '0' && $t_day == '1') { 
		$icici_general_cell .= " day";
	} elseif ($t_day != '0' && $t_day != '1') {
		$icici_general_cell .= " days";
	}
	$icici_general_cell .= " - ";
	$icici_general_cell .= " $rate % </p> ";
	
	if($icici_i == 0) {
		$icici_senior_cell .= "<span>";
		if($senr_citizen_rate != '0') {
			$icici_senior_cell .=  $senr_citizen_rate - $rate . '%';
		} else {
			$icici_senior_cell .=  '-';
		}
		$icici_senior_cell .= "</span>";
	}
	++$icici_i;
}

mysqli_close($connection_fd);


if($loan_type_id == '56'){
   		$url_doc = "https://myloancareindia.com/gbfhgnjhfijnedsfok/njhiunijhujksdfjlodh/go4pldoc.php";
   		}
   		else   		
   		if($loan_type_id == '51'){
   		$url_doc = "https://myloancareindia.com/gbfhgnjhfijnedsfok/njhiunijhujksdfjlodh/go4hldoc.php";
   		}
   		else
		if($loan_type_id == '52'){
		$url_doc = "https://myloancareindia.com/gbfhgnjhfijnedsfok/njhiunijhujksdfjlodh/go4cldoc.php";
		}
		else
		if($loan_type_id == '58'){
		$url_doc = "https://myloancareindia.com/gbfhgnjhfijnedsfok/njhiunijhujksdfjlodh/go4topupdoc.php";
		}
		else
		if($loan_type_id == '60'){
		$url_doc = "https://myloancareindia.com/gbfhgnjhfijnedsfok/njhiunijhujksdfjlodh/go4gldoc.php";
		}
		else
		if($loan_type_id == '54'){
		$url_doc = "https://myloancareindia.com/gbfhgnjhfijnedsfok/njhiunijhujksdfjlodh/go4lapdoc.php";
		}
		else
		if($loan_type_id == '57'){
		$url_doc = "https://myloancareindia.com/gbfhgnjhfijnedsfok/njhiunijhujksdfjlodh/go4bldoc.php";
		}

if($template == 16 || $template == 15 || $template == 14 || $template == 20){
include("get-rates.php");
$email_table = $final;
}
$e_query = "select temp_id,temp_file_name,subject from tbl_mint_mail_temp where temp_id = '$template'";
$e_result = mysqli_query($Conn1,$e_query);
$e_info = mysqli_fetch_array($e_result);
$temp_id = $e_info['temp_id'];
$subject = $e_info['subject'];
$temp_file_name = $e_info['temp_file_name'];
include("template/".$temp_file_name."");

$opt_bank_name = '<td>Select Bank</td><td colspan="5">';

foreach($get_bank_option as $bank_option){

    $opt_bank_name .= '<label><input type="checkbox" class = "bank_option" id="'.$bank_option['bank'].'_'.$bank_option['rate_type'].'" value="'.$bank_option['bank'].'_'.$bank_option['rate_type'].'" checked />'.$bank_option['bank'].' '.$bank_option['rate_type'].'</label>';

}
$opt_bank_name .='</td>';
echo json_encode(array('html_temp'=>base64_encode($template_body),'bank_opt'=>$opt_bank_name ));
?>

 


   
        