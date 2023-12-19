<?php
require_once "../../include/check-session.php";
require_once "../../include/config.php";
$filename = "LOSApp_".date("d-m-Y").".csv";
header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=$filename");
header("Pragma: no-cache");
header("Expires: 0");
$qry = "select app.app_id as app_id,post.app_status as app_status,app.date_created as date_created,app.los_flag,app.bank_crm_lead_on
 as bank_crm_lead_on, pre.pre_status_name as pre_status_name, cust.name as name,cust.phone as phone,city.city_name as city_name,c.case_id as 
 case_id,user.user_name as user_name,c.required_loan_amt as required_loan_amt from tbl_mint_app as app JOIN tbl_mint_case
 as c ON app.case_id = c.case_id JOIN tbl_mint_customer_info as cust ON c.cust_id = cust.id
left join lms_city as city on cust.city_id = city.city_id left join tbl_user_assign as user on c.user_id = user.user_id
 left join tbl_app_pre_login as pre on app.pre_login_status = pre.pre_status_id left join tbl_app_status as post on app.app_status_on = post.app_status_id where app.app_bank_on = '42' and c.loan_type IN
 (56,57) and (app.pre_login_status = '2' OR app.app_status_on IN (3,5,6,7)) and los_flag = 0 group by app.app_id order by c.case_id";
$results = mysqli_query($Conn1,$qry);
$content = array();
$title = array("Application No","Name","Contact No.","Loan Amount","City", "Date of App Created","CRM ID","Pre Login Status","Post Login Status","Assign To","LOS");
while($exe = mysqli_fetch_array($results)){
$app_id  = $exe['app_id'];
$name_app_statuson = $exe['app_status'];
$name = $exe['name'];
$name_pre_statuson = $exe['pre_status_name'];
$phone = $exe['phone'];
$assign = $exe['user_name'];
$loan_amount = $exe['required_loan_amt'];
$city_name = $exe['city_name'];
$bank_crm_lead_on  = $exe['bank_crm_lead_on'];
$date_created  = $exe['date_created'];
$los_flag  = $exe['los_flag'];
if($los_flag == '1'){	
	$los_flag ='YES';
}else {
	$los_flag ='No';
}
   $row = array();
    $row[] = stripslashes($app_id);
    $row[] = stripslashes($name);
    $row[] = stripslashes($phone);
    $row[] = stripslashes($loan_amount);
    $row[] = stripslashes($city_name);
    $row[] = stripslashes($date_created);
    $row[] = stripslashes($bank_crm_lead_on);	
    $row[] = stripslashes($name_pre_statuson);
    $row[] = stripslashes($name_app_statuson);  
    $row[] = stripslashes($assign);
    $row[] = stripslashes($los_flag); 	
	
    $content[] = $row;



}

$output = fopen('php://output', 'w');

fputcsv($output, $title);
foreach ($content as $con) {
    fputcsv($output, $con);
}

?>


