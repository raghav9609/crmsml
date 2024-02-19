<?php 
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../config/config.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../model/queryHelper.php');
require_once(dirname(__FILE__) . '/../include/helper.functions.php');
require_once "../include/display-name-functions.php";
$comma = '';
 
    $app_id = base64_decode($_REQUEST['app_id']);
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
    $where_condition = 'id = "' . $app_id . '"';
    $update_query = "UPDATE crm_query_application SET ";

    foreach ($final_arr as $key => $val) {
        $update_query .= $comma . $key . " = '" . $val . "'";
        $comma = ", ";
    }
    $update_query .= " WHERE " . $where_condition;
    echo $update_query;
    $res_qry = mysqli_query($Conn1,$update_query);

    if(trim($remarks_by_bank) != "" || trim($remarks_by_user) != "" || ($follow_up_date != "0000-00-00" && $follow_up_date != "" && $follow_up_date != "1970-01-01")){
       echo $insert_qry1 =  "INSERT INTO crm_lead_summary_history set lead_id = '".$app_id."' , user_id = '".$_SESSION['userDetails']['user_id']."' , type = 2 , description_by_bank = '".trim($remarks_by_bank)."' , description_by_user = '".trim($remarks_by_user)."' , follow_up_date = '".trim($follow_up_date)."' , follow_up_time = '".trim($follow_up_time)."'";

        $res_qry = mysqli_query($Conn1,$insert_qry1);  
    }


?>