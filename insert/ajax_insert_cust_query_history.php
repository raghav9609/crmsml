<?php
$slave = 1;
require_once "../config/config.php";
require_once "../include/helper.functions.php";
require_once "../include/display-name-functions.php";
$type = $_REQUEST['type'];
$return_html = "";
/* coding for customer Query history start */
if($type == "query") {
    $cust_id = $_REQUEST['cust_id'];
    $query_history_query = "select stats.query_status,qry.query_id as id,qry.loan_amt as loan_amt,loan.loan_type_name as loan_type_name,stats.date as date,user.user_name as user_name from tbl_mint_query as qry left JOIN tbl_mint_query_status_detail as stats ON qry.query_id = stats.query_id left join lms_loan_type as loan on qry.loan_type = loan.loan_type_id left join tbl_user_assign as user on stats.user_id = user.user_id where qry.cust_id = ".$cust_id." order by qry.query_id desc limit 10";
    $query_history_result= mysqli_query($Conn1,$query_history_query);
    $query_history = mysqli_num_rows($query_history_result);
    $sr_no = 0;
    if($query_history > 0) {
        $return_html .= "<table  class='gridtable' width='100%'><tr><th>Sr. No.</th><th>Query Id</th><th>Loan Type & Amount </th><th>Status & User</th><th>Date</th></tr>";
        while($query_history_info = mysqli_fetch_array($query_history_result)) {
            ++$sr_no;
            $id = $query_history_info['id'];
            $loan_amt = $query_history_info['loan_amt'];
            $date = $query_history_info['date'];
            $loan_name = $query_history_info['loan_type_name'];
            $user_name = $query_history_info['user_name'];
            $query_status = $query_history_info['query_status'];
            $query_status_name = get_display_name('query_status',$query_status);
            if($query_status_name == ''){
                $query_status_name = get_display_name('new_status_name',$query_status);
            }
            $enc_id = urlencode(base64_encode($query_history_info['id']));
            $user_by = (trim($query_history_info['user_name']) != "") ? "(By: ".$query_history_info['user_name'].")" : "";
            $loan_amount = (($query_history_info['loan_amt'] > 0) && is_numeric($query_history_info['loan_amt'])) ? "(".custom_money_format($query_history_info['loan_amt']).")" : "";
            $return_html .= "<tr class='center-align'><td>".$sr_no."</td><td><a href='../query/edit.php?id=$enc_id&ut=2' target ='_blank'>".$query_history_info['id']."</a></td><td>".$query_history_info['loan_type_name']."<br><span class='fs-12'>".$loan_amount."</span></td><td>".$query_history_info['qy_status']."<br><span class='fs-12'>".$user_by."</span></td><td>".date('d-m-Y',strtotime($query_history_info['date']))."</td></tr>";
        }
        $return_html .= "</table><br>";
    /*}*/
    } else {
        $return_html = "";
    }
}

if($type == "app") {
   
    $case_id = $_REQUEST['case_id'];

$qry = "select * from crm_query_application where crm_query_id = ".$case_id."";
$res = mysqli_query($Conn1,$qry) or die(mysqli_error($Conn1));
$res_num = mysqli_num_rows($res);
if($res_num > 0) {
    $sr_no = 0;
?>
   <?php $return_html = '<table width="100%" class="gridtable"><tr class="font-weight-bold"><th>Sr. No.</th><th>Application Id</th><th>Bank Name</th><th>Status</th><th>Created On</th><th>Action</th></tr>'; ?>

    <?php while($exe_app_history = mysqli_fetch_array($res)){
    ++$sr_no;
    $get_bank_name_get = get_name('master_code_id',$exe_app_history['bank_id']);
    $get_bank_name = $get_bank_name_get['value'];
    $get_app_status_get = get_name('status_name',$exe_app_history['application_status']);
    $get_app_status = $get_app_status_get['value'];
   
    ?>
    <?php 
    $return_html .= '<tr class="center-align"><td>'.$sr_no.'</td><td><span class="fs-12"><a href="../app/edit.php?app_id='.urlencode(base64_encode($exe_app_history['id'])).'">'.$exe_app_history['id'].'</a></span></td><td>'.$get_bank_name.'</td><td>'.$get_app_status.'</td><td>'.date("d-m-Y H:i a",strtotime($exe_app_history['created_on'])).'</td><td><br><span class="fs-12"><a href="../app/edit.php?app_id='.urlencode(base64_encode($exe_app_history['id'])).'">View</a></span></td></tr>'; 
    ?>
    <?php } ?>
    <?php $return_html .= '</table>';
    }
}

echo $return_html;
?>