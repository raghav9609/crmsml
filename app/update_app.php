<?php 
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../config/config.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once "../include/helper.functions.php";
require_once "../include/display-name-functions.php";

$bank_name = $_REQUEST['bank_name'];
$bank_name_get = get_name('master_code_id',$bank_name);
// echo $bank_name_get['id'];
// exit();
$application_status = $_REQUEST['application_status'];
$application_status_get = get_name('status_id',$application_status);
print_r($application_status_get);
$applied_amount = $_REQUEST['applied_amount'];

$login_date = $_REQUEST['login_date'];

$sanction_amount = $_REQUEST['sanction_amount'];
$sanction_date = $_REQUEST['sanction_date'];
$disbursed_amount = $_REQUEST['disbursed_amount'];
$disburse_date = $_REQUEST['disburse_date'];
$remarks_by_user = $_REQUEST['remarks_by_user'];
$remarks_by_bank = $_REQUEST['remarks_by_bank'];
$bank_application_no = $_REQUEST['bank_application_no'];
$follow_up_date = $_REQUEST['follow_up_date'];
$follow_up_time = $_REQUEST['follow_up_time'];
$follow_up_given_by = $_REQUEST['follow_up_given_by'];
$tenure = $_REQUEST['tenure'];

$final_arr = array(
    'bank_id' => $bank_name_get['id'], 
    'email_cc' => trim($email_cc),
    'subject' => $subject,
    'updated_on' => currentDateTime24(),
);
$desig_up_qry = $query_model->updateQueryData('mlc_email_data_mis_report',$final_arr,array('id = "'.$value.'"'));
$res=$db_handle->updateRows($desig_up_qry);


$_SESSION['succ_msg'] = "Updated Sucessfully";
header("Location: index.php");



?>