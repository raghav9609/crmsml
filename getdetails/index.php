<?php
header('Content-type: application/json;');
$headers = apache_request_headers();
$method = $_SERVER['REQUEST_METHOD'];
$json_data = file_get_contents('php://input');
$a = stripslashes(html_entity_decode($json_data));
$post = json_decode($a,true);

require_once(dirname(__FILE__) . '/../config/config.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../include/helper.functions.php');

$loan_type_id = 54;
$company_name = $post['company_name'];
echo "select * from crm_master_company where company_name='".$company_name."'";
$getcompId = mysqli_query($Conn1,"select * from crm_master_company where company_name='".$company_name."'");
$res =  mysqli_fetch_array($getcompId);
print_r($res);
die();

if ($post['name'] != '' && $post['mobile'] != '' && $post['mobile'] != 0 && $post['loan_amount'] != '' && $post['loan_amount'] != 0 && $post['email'] != ''){
    $dataIns = "Insert into crm_raw_data set name='".$post['name']."', phone_no=".$post['mobile'].", gender = '".$post['gender']."', dob = '".$post['dob']."', email_id = '".$post['email']."', marital_status_id = '".$post['marital_status']."', pan_no = '".$post['pancard']."', occupation_id = '".$post['occupation_id']."', company_name = '".$company_name."', net_income = '".$post['net_income']."', mode_of_salary = '".$post['mode_of_salary']."', salary_bank_id = '".$post['main_account']."', bank_account_no = '".$post['account_number']."', ifsc_code = '".$post['ifsc_code']."', office_email_id = '".$post['office_email']."', office_city_id = '".$office_city_id."', office_pincode = '".$post['office_pincode']."', company_id = '".$company_id."', current_work_exp = '".$post['current_work_exp']."', total_work_exp = '".$post['total_work_exp']."', city_id = '".$city_id."',pincode='".$post['pincode']."',address='".$post['res_address']."',loan_type_id = '".$loan_type_id."',loan_amount='".$post['loan_amount']."',query_status=11,tool_type='website',user_ip='".$post['user_ip']."',verify_phone=1,bank_acc_type='".$post['bank_acc_type']."',page_url='".$post['page_url']."'";
    $datareturn = "Data Insert Successfully";
    $statuscode = 1;
} else {
    $datareturn = "Name, Mobile, Loan Amount or Email Missing";
    $statuscode = 2;
}
$data = {"status":200,"message":$datareturn,"statuscode":$statuscode}
echo $data;

//print_r($post);
?>