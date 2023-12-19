<?php
include("../../include/check-session.php");
include("../../include/config.php");

$app_id  = $_REQUEST['app_id'];
$case_id = $_REQUEST['case_id'];
$cust_id = $_REQUEST['cust_id'];

#select all required data (Customer - Main Details)
$customer_details_query = "SELECT id, salu_id, maritalstatus, name, mname, lname, email, phone, phone_no, net_incm, comp_id, occup_id, pan_card, city_id FROM tbl_mint_customer_info WHERE id = '".$cust_id."' ORDER BY id DESC LIMIT 0, 1 ";
$customer_details_exec = mysqli_query($Conn1, $customer_details_query);
$customer_details_result = mysqli_fetch_array($customer_details_exec);

#select all required data (Customer - Extra Details)
$customer_extra_details_query = "SELECT pincode, cur_comp_wrk_exp, totl_wrk_exp, salary_pay_id FROM tbl_mint_cust_info_intt WHERE cust_id = '".$cust_id."' ORDER BY intt_id DESC LIMIT 0, 1 ";
$customer_extra_details_exec = mysqli_query($Conn1, $customer_extra_details_query);
$customer_extra_details_result = mysqli_fetch_array($customer_extra_details_exec);

#select all required data (Customer - Case Details)
$case_details_query = "SELECT loan_type FROM tbl_mint_case WHERE case_id = '".$case_id."' ";
$case_details_exec = mysqli_query($Conn1, $case_details_query);
$case_details_result = mysqli_fetch_array($case_details_exec);

#select all required data (Customer - Application Details)
$application_details_query = "SELECT disbursed_amount_on FROM tbl_mint_app WHERE app_id = '".$app_id."' ORDER BY id DESC LIMIT 0, 1 ";
$application_details_exec = mysqli_query($Conn1, $application_details_query);
$application_details_result = mysqli_fetch_array($application_details_exec);

#generate new query
$generate_new_query = "INSERT INTO form_merge_data SET salu_id = '".$customer_details_result['salu_id']."', name = '".$customer_details_result['name']."', lname = '".$customer_details_result['lname']."', email = '".$customer_details_result['email']."', phone = '".$customer_details_result['phone']."', phone_no = '".$customer_details_result['phone_no']."', occup_id = '".$customer_details_result['occup_id']."', city_id = '".$customer_details_result['city_id']."', pin_code = '".$customer_details_result['pincode']."', net_incm = '".$customer_details_result['net_incm']."', comp_id = '".$customer_details_result['comp_id']."', ccwe = '".$customer_extra_details_result['cur_comp_wrk_exp']."', twe = '".$customer_extra_details_result['totl_wrk_exp']."', slry_paid = '".$customer_extra_details_result['salary_pay_id']."', loan_type = '".$case_details_result['loan_type']."', loan_amt = '".$application_details_result['disbursed_amount_on']."', tool_type = 'Reassign', sub_tool_type = 30, old_form_id = '".$app_id."', date = CURDATE(), time = CURTIME(), verify_phone = 1, query_status = 11, page_url = 'Disbursed Applications - ".$app_id."', assign_flag = 1, user_id = '".$user."' ";
mysqli_query($Conn1, $generate_new_query);

#update app table
$latest_query_id = mysqli_insert_id($Conn1);
$update_regenerate_query = "UPDATE tbl_mint_app SET regenerate_query = '".$latest_query_id."' WHERE app_id = '".$app_id."' ";
mysqli_query($Conn1, $update_regenerate_query);

header("location: /sugar/all_query/edit.php?ut=&id=".base64_encode($latest_query_id));