<?php
$a = '{
    "name":"Anu chhikara",
"dob":"08-10-1992",
"pincode":110046,
"city":"Delhi",
"res_address":"sdfdsfd dfsdf sfds",
"mobile":9958619609,
"email":"anu@gmail.com",
"marital_status":"married",
"pan_no":"BMYPA9792E",
"employment_type":1,
"company_name":"Google",
"net_income":45000,
"salary_paid_by":1,
"main_account":"sbi",
"account_number":244002342,
"office_email":"test@gmail.com",
"office_pincode":122001,
"office_city":"gurgaon", 
"office_address":"testr sdsds",
"current_work_exp":26,
"toal_work_exp":36
}';
header('Content-type: application/json;');
$headers = apache_request_headers();
$method = $_SERVER['REQUEST_METHOD'];
$json_data = file_get_contents('php://input');
$a = stripslashes(html_entity_decode($json_data));
$post = json_decode($a,true);

var_dump($a);
var_dump(json_decode($a));
var_dump(json_last_error());
var_dump(json_last_error_msg());
print_r($post);
die();
require_once(dirname(__FILE__) . '/../config/config.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../include/helper.functions.php');
//print_r($post);
//$decodedText = html_entity_decode($jsonText);
//$post = json_decode($jsonText, TRUE);
//$post = json_decode($post,TRUE);
print_r($post);
$dataIns = "Insert into crm_raw_data set name='".$post['name']."', phone_no=".$post['mobile'].", gender = '".$post['gender']."', dob = '".$post['dob']."', email_id = '".$post['email']."', marital_status_id = '".$post['marital_status']."', pan_no = '".$post['pancard']."', occupation_id = '".$post['occupation_id']."', company_name = '".$company_name."', net_income = '".$post['net_income']."', mode_of_salary = '".$post['mode_of_salary']."', salary_bank_id = '".$post['main_account']."', bank_account_no = '".$post['account_number']."', ifsc_code = '".$post['ifsc_code']."', office_email_id = '".$post['office_email']."', office_city_id = '".$office_city_id."', office_pincode = '".$post['office_pincode']."', company_id = '".$company_id."', current_work_exp = '".$post['current_work_exp']."', total_work_exp = '".$post['total_work_exp']."', city_id = '".$city_id."',pincode='".$post['pincode']."',address='".$post['res_address']."',loan_type_id = '".$loan_type_id."',loan_amount='".$post['loan_amount']."',query_status=11,tool_type='website',user_ip='".$post['user_ip']."',verify_phone=1,bank_acc_type='".$post['bank_acc_type']."',page_url='".$post['page_url']."'";
echo $dataIns;

//print_r($post);
?>