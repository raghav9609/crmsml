<?php 
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../config/config.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../model/queryHelper.php');
require_once(dirname(__FILE__) . '/../include/helper.functions.php');
require_once "../include/display-name-functions.php";
$update = $_POST['submit_add'];
if ($update == 'Add'){
    $application_status = $_REQUEST['application_status'];
    $bank_name = $_REQUEST['bank_name'];
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
    $roi = $_REQUEST['roi'];

    $final_arr = array(
        'crm_query_id'=> $crm_query,
        'bank_id' =>$bank_name, 
        'application_status' => $application_status,
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
        'tennure' => $tenure,
        'roi '=> $roi
    );
    // print_r($final_arr);
    $insert_qry =  "INSERT INTO crm_query_application set ";
    foreach ($final_arr as $key => $val) {
        $insert_qry .= $comma . $key . " = '" . $val . "'";
        $comma = ", ";
        }
    $insert_qry.= ";";

    $res_qry = mysqli_query($Conn1,$insert_qry);
    echo '<script>window.location.href = "'.$head_url.'/app/";</script>';
    exit;

}else{
$app_id =$_REQUEST['crm_query_id'];
// $case_id = $_REQUEST['case_id'];
$cust_id = $_REQUEST['cust_id'];
$loan_type = $_REQUEST['loan_type'];

$application_status_num = $_REQUEST['application_status'];
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
$tenure = $_REQUEST['tennure'];
$roi = $_REQUEST['roi'];

$final_arr = array(
    // 'bank_id' => $bank_name_get['id'], 
    'application_status' => $application_status_num,
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
    'tennure' => $tenure,
    'roi '=> $roi
);
// print_r($final_arr);
$where_condition = 'crm_query_id = "' . $app_id . '"';
$update_query = "UPDATE crm_query_application SET ";

foreach ($final_arr as $key => $val) {
    $update_query .= $comma . $key . " = '" . $val . "'";
    $comma = ", ";
}
$update_query .= " WHERE " . $where_condition;
$res_qry = mysqli_query($Conn1,$update_query);

$current_date = date('Y-m-d');
$insert_qry1 =  "INSERT INTO crm_lead_summary_history set lead_id = '".$app_id."' and user_id = '".$_SESSION['userDetails']['user_id']."' and type = 2 and updated_on = '".$current_date."'";
$res_qry = mysqli_query($Conn1,$insert_qry1);


// if ($res_qry) {
//     $_SESSION['succ_msg'] = "Updated Sucessfully";
// } else {
//     echo "Update failed: " . mysqli_error($your_database_connection);
// }

// echo '<script>window.location.href = "'.$head_url.'/app/edit.php?case_id='.urlencode(base64_encode($case_id)).'%3D%3D&app_id='.urlencode(base64_encode($app_id)).'%3D%3D&cust_id='.urlencode(base64_encode($cust_id)).'%3D%3D&loan_type='.urlencode(base64_encode($loan_type)).'";</script>';
    
    echo '<script>window.location.href = "'.$head_url.'/app/edit.php"</script>';
    exit;
}
echo '<script>window.location.href = "'.$head_url.'/app/edit.php"</script>';
    exit;
?>