<?php
require_once(dirname(__FILE__) . '/../config/config.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../include/helper.functions.php');

//echo "anu";
$jsonText = file_get_contents('php://input');
//print_r($post);
$decodedText = html_entity_decode($jsonText);
$post = json_decode($decodedText, true);
//$post = json_decode($post,TRUE);
print_r($post);
$dataIns = "Insert into crm_raw_data set name='".$post['name']."', phone_no=".$post['mobile'].", gender = '".$post['gender']."', dob = '".$post['dob']."', email_id = '".$post['email']."', marital_status_id = '".$post['marital_status']."', pan_no = '".$post['pancard']."', occupation_id = '".$post['occupation_id']."', company_name = '".$company_name."', net_income = '".$post['net_income']."', mode_of_salary = '".$post['mode_of_salary']."', salary_bank_id = '".$post['main_account']."', bank_account_no = '".$post['account_number']."', ifsc_code = '".$post['ifsc_code']."', office_email_id = '".$post['office_email']."', office_city_id = '".$office_city_id."', office_pincode = '".$post['office_pincode']."', company_id = '".$company_id."', current_work_exp = '".$post['current_work_exp']."', total_work_exp = '".$post['total_work_exp']."', city_id = '".$city_id."',pincode='".$post['pincode']."',address='".$post['res_address']."',loan_type_id = '".$loan_type_id."',loan_amount='".$post['loan_amount']."',query_status=11,tool_type='website',user_ip='".$post['user_ip']."',verify_phone=1,bank_acc_type='".$post['bank_acc_type']."',page_url='".$post['page_url']."'";
echo $dataIns;

//print_r($post);
?>