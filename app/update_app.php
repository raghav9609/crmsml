<?php 
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../config/config.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../model/queryHelper.php');

require_once "../include/helper.functions.php";
require_once "../include/display-name-functions.php";

$query_id =$_REQUEST['crm_query_id'];
$bank_name = $_REQUEST['bank_name'];
$bank_name_get = get_name('master_code_id',$bank_name);
// echo $bank_name_get['id'];
// exit();
$application_status = $_REQUEST['application_status'];
$application_status_get = get_name('status_id',$application_status);
// print_r($application_status_get['id']);
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
$values = explode('/',$_REQUEST['tenure']);
$tenure = isset($values[0]) ? $values[0] : '';
$emi = isset($values[1]) ? $values[1] : '';

$final_arr = array(
    'bank_id' => $bank_name_get['id'], 
    'application_status' => $application_status_get['id'],
    'applied_amount' => trim($applied_amount),
    'login_date' => trim($login_date),
    'sanction_amount' => trim($sanction_amount),
    'sanction_date' => trim($sanction_date),
    'disbursed_amount' => trim($disbursed_amount),
    'disburse_date' => trim($disburse_date),
    'description_by_user' => trim($remarks_by_user),
    'description_by_bank' => trim($remarks_by_bank),
    'bank_application_no' => trim($bank_application_no),
    'follow_up_date' => trim($follow_up_date),
    'follow_up_time' => trim($follow_up_time),
    'follow_up_given_by' => trim($follow_up_given_by),
    'tenure' => $tenure,
    'emi '=> $emi
);
print_r($final_arr);
// $query = $query_model->updateQueryData('crm_query_application', $final_arr, array('crm_query_id = "' . $query_id . '"'));
// echo $query;
// print_r($query);
// // $res=$db_handle->updateRows($desig_up_qry);

$where_condition = 'crm_query_id = "' . $query_id . '"';
$update_query = "UPDATE crm_query_application SET ";
// echo $update_query;
// $set_values = array();

foreach ($final_arr as $key => $val) {
    $update_query .= $comma . $key . " = '" . $val . "'";
    $comma = ", ";
}
// $update_query .= implode(', ', $set_values);
$update_query .= " WHERE " . $where_condition;
echo $update_query;
$res_qry = mysqli_query($Conn1,$update_query);
// echo $res_qry;
if ($res_qry) {
    $_SESSION['succ_msg'] = "Updated Sucessfully";
} else {
    echo "Update failed: " . mysqli_error($your_database_connection);
}


// $_SESSION['succ_msg'] = "Updated Sucessfully";
// header("Location: index.php");

echo '<script>window.location.href = "'.$head_url.'/app/form_index_app.php";</script>';
    // include("../include/footer_close.php");
    exit;


?>