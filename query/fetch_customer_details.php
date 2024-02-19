<?php
 require_once(dirname(__FILE__) . '/../config/session.php');
 require_once(dirname(__FILE__) . '/../config/config.php');
 require_once(dirname(__FILE__) . '/../include/helper.functions.php');
$customer_phone = $_REQUEST['customer_phone'];
$response_data = array();

$customer_details_query = mysqli_query($Conn1, "SELECT crm_customer.id as id, name, phone_no, lms_city.city_name AS city_name, crm_customer.pincode AS pincode, crm_customer.net_income AS net_incm, crm_customer.occupation_id AS occup_id, crm_customer.mode_of_salary AS salary_pay_id, crm_customer.company_name as comp_name_other, crm_master_company.company_name AS comp_name, crm_customer.dob AS date_of_birth, crm_customer.salary_bank_id AS bank_id FROM crm_customer LEFT JOIN crm_master_city As lms_city ON lms_city.id = crm_customer.city_id LEFT JOIN crm_master_company ON crm_master_company.id = crm_customer.company_id WHERE phone_no = '".$customer_phone."' ");

if(mysqli_num_rows($customer_details_query) > 0) {
    $customer_details = mysqli_fetch_array($customer_details_query);
    $customer_name = $customer_details['name'];
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
?>