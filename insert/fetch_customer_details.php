<?php
require_once "../../include/check-session.php";
require_once "../../include/config.php";
require_once "../../include/helper.functions.php";
$customer_phone = $_REQUEST['customer_phone'];
$response_data = array();
$customer_details_query = mysqli_query($Conn1, "SELECT tbl_mint_customer_info.id as id, name, lname, phone, lms_city.city_name AS city_name, tbl_mint_cust_info_intt.pincode AS pincode, tbl_mint_customer_info.net_incm AS net_incm, tbl_mint_customer_info.occup_id AS occup_id, tbl_mint_cust_info_intt.salary_pay_id AS salary_pay_id, tbl_mint_customer_info.comp_name_other as comp_name_other, pl_company.comp_name AS comp_name, tbl_mint_customer_info.dob AS date_of_birth, tbl_mint_customer_info.bank_id AS bank_id FROM tbl_mint_customer_info LEFT JOIN lms_city ON lms_city.city_id = tbl_mint_customer_info.city_id LEFT JOIN tbl_mint_cust_info_intt ON tbl_mint_cust_info_intt.cust_id = tbl_mint_customer_info.id LEFT JOIN pl_company ON pl_company.comp_id = tbl_mint_customer_info.comp_id WHERE phone = '".$customer_phone."' ");

if(mysqli_num_rows($customer_details_query) > 0) {
    $customer_details = mysqli_fetch_array($customer_details_query);
    $customer_name = $customer_details['name']." ".$customer_details['lname'];
    $city_name = $customer_details['city_name'];
    $pincode = $customer_details['pincode'];
    $net_income = $customer_details['net_incm'];
    $occupation_id = $customer_details['occup_id'];
    $salary_pay_id = $customer_details['salary_pay_id'];
    $company = $customer_details['comp_name'].$customer_details['comp_name_other'];
    $dob = $customer_details['date_of_birth'];
    $bank_id = $customer_details['bank_id'];

    $response_data = array("customer_name" => $customer_name, "city_name" => $city_name, "pincode" => $pincode, "net_income" => $net_income, "occupation_id" => $occupation_id, "salary_pay_id" => $salary_pay_id, "company" => $company, "date_of_birth" => $dob, "cust_bank_id" => $bank_id);
}

echo json_encode($response_data);