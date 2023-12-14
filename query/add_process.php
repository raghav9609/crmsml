<?php
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../config/config.php');

require_once(dirname(__FILE__) . '/../include/display-name-functions.php');
$loan_type = replace_special($_REQUEST['loan_type']);
$loan_amount = replace_special($_REQUEST['loan_amount']);
$amt_deposit = replace_special($_REQUEST['amt_deposit']);
$saluation = replace_special($_REQUEST['saluation']);
$name = replace_special($_REQUEST['name']);
$city_id = replace_special($_REQUEST['city_id']);
$net_incm = replace_special($_REQUEST['net_month_inc']);
$date_of_birth = $_REQUEST['date_of_birth'];

$bank_account_type = $_REQUEST['bank_account_type'];
if($amt_deposit > 0){
    $loan_amount = $amt_deposit;
}
if(preg_match('/^[1-9][0-9]{5}$/',$_REQUEST['city_name'])){
    
  
$qry = mysqli_query($Conn1,"SELECT pin.city_id as city_id FROM crm_master_pincode as pin WHERE pin.pincode = '".$_REQUEST['city_name']."'");
$result_qry = mysqli_fetch_array($qry);
$pin_code_id = $_REQUEST['city_name'];
$city_id = $result_qry['city_id'];

if($city_id != '' && $city_id != '0'){
$city_id = $city_id;
}else{
$city_id = '26';
}

}else if(preg_match('/^[a-zA-Z0-9]/',$_REQUEST['city_name'])){
    
$qry = mysqli_query($Conn1,"SELECT id FROM crm_master_city WHERE city_name = '".$_REQUEST['city_name']."'");
$result_qry = mysqli_fetch_array($qry);
$city_id_oth = $result_qry['id'];

if($city_id_oth != '' && $city_id_oth != '0'){
$city_id = $city_id_oth;
}else{
$city_id = '26';
}
}


$phone = replace_special($_REQUEST['phone_no']); 
$email = replace_special($_REQUEST['email']);
$occup_id = replace_special($_REQUEST['occupation_id']);

$company_name = replace_special($_REQUEST['comp_name']);
$acq_id = replace_special($_REQUEST['acq_id']);
$ref_type = replace_special($_REQUEST['ref_type']);

if($_REQUEST['assign_to'] == '1'){
    $user_id = $user;
} else if($_REQUEST['assign_to'] == '2'){
    $user_id = 0;
} else {
    $user_id = $_REQUEST['u_assign'];
} 


if($loan_type == 56 && $_REQUEST['salary_method'] == 3){
    $user_id = 13;
}

if($loan_type == 32){
    $user_id = 83;
}

// if($acq_id == 3 && $reffrl_mob > 6000000000 && $ref_type=='1'){
// 	$ref_idm = get_display_name('customer_id',$reffrl_mob);
// 	if($ref_idm == '' || $ref_idm == 0){
// 		$insert_customer_qry = mysqli_query($Conn1,"insert into crm_customer set phone = '".$reffrl_mob."',date=CURDATE(),time=CURTIME()");
// }
// 	$ref_id = get_display_name('customer_id',$reffrl_mob);
// } else if($acq_id == 3 && $reffrl_mob > 6000000000 && $ref_type=='2'){
// 	$ref_idm = get_display_name('referer_partner_id',$reffrl_mob);
// 	if($ref_idm == '' || $ref_idm == 0){
// 		$insert_customer_qry = mysqli_query($Conn1,"insert into tbl_mint_partner_info set phone = '".$reffrl_mob."',phone_no = '".$reffrl_mob."',date=NOW()");
// }
// 	$ref_id = get_display_name('referer_partner_id',$reffrl_mob);
// }


$comp_id = get_display_name('comp_id',$company_name);
//$refer_amt = get_display_name('cashback',$loan_type);
$cust_id = get_display_name('customer_id',$phone);
if($comp_id == '' || $comp_id == '0'){
    $comp_id_n = '';
    $comp_name_other = $company_name;
}else{
    $comp_id_n = $comp_id;$comp_name_other = '';
}


            
if($loan_type == 56){
if($_REQUEST['salary_method'] == '2' || $_REQUEST['salary_method'] == '3'){
    $salary_paid = $_REQUEST['salary_method'];
    $main_account = '';
} else if($_REQUEST['salary_method'] == 'other'){
      $salary_paid = '1';
    $main_account = '';
} else {
    $salary_paid = '1';
    $main_account = $_REQUEST['salary_method'];
}
}

if($loan_type == 57 || $loan_type == 63){
    $net_income = $_REQUEST['anl_prof']/12;
} else {
   $net_income =  $net_incm;
}

$position = strpos($name, " ");
$first_name = "";
$last_name = "";
if($position != "" && $position > 0) {
    $first_name = substr($name, 0, $position);
    $lname = substr($name, $position + 1);
    $last_name = str_replace(" ", "", $lname);
} else {
    $first_name = $name;
}

$qry_edit = "insert into crm_raw_data set salutation_id='".$saluation."',name='".$first_name."', email_id ='".$email."',phone_no = '".$phone."', alternate_phone_no = '".$phone."', city_id = '".$city_id."', pincode = '".$pin_code_id."', occupation_id = '".$occup_id."', loan_type_id = '".$loan_type."', loan_amount = '".$loan_amount."', company_id = '".$comp_id_n."', company_name = '".$comp_name_other."', net_income = '".$net_income."',bank_account_no = '".$main_account."', query_status='1',tool_type='Direct',mode_of_salary='".$salary_paid."', created_on=CURDATE(),user_ip='".$_SERVER['REMOTE_ADDR']."',lead_assign_to='".$user_id."',description='".$desc."',ref_mobile='".$ref_id."', refer_form_type='".$ref_type."', verify_phone='1'";

if($date_of_birth != "") {
    $qry_edit .= " , dob = '".$date_of_birth."' ";
}

if($bank_account_type != "") {
    $qry_edit .= ", bank_acc_type = '".$bank_account_type."' ";
}

//echo $qry_edit;

$res_qry = mysqli_query($Conn1,$qry_edit);
 
    header("Location:add_query.php");
    // echo '<script>window.location.href = "' . $head_url . '/add_query.php";</script>';
    include("../include/footer_close.php");
?>