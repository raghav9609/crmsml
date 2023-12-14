<?php
/* coding for customer application history start */
require_once "../../include/check-session.php";
require_once "../../include/config.php";
$return_html = "";
$case_id = $_REQUEST['case_id'];

$app_history_query = "select app.app_id as app_id,app.partner_on as partner_on,app.app_bank_on as app_bank_on,app.app_status_on as app_status_on,app.date_created as date_created,user.user_name as user_name,app.login_date_on as login_date_on,app.sanction_date_on as sanction_date_on,app.first_disb_date_on as first_disb_date_on from tbl_mint_app as app left join tbl_mint_case as cse on app.case_id = cse.case_id left join tbl_user_assign as user on cse.user_id = user.user_id where app.case_id = $case_id group by app.app_id order by app.app_id desc";
$app_history_result= mysqli_query($Conn1,$app_history_query);
$app_history = mysqli_num_rows($app_history_result);
if($app_history > 0){
$return_html = '<table class="gridtable" width="100%"><tr><th colspan="5" align="center">Application</th></tr><tr><td>App Id</td><td>Partner</td><td>Status</td><td>Bank/ MLC USER</td><td>Date</td></tr>';
while($app_history_info = mysqli_fetch_array($app_history_result)){
$app_id = $app_history_info['app_id'];
$partner_on = $app_history_info['partner_on'];
$app_bank_on  = $app_history_info['app_bank_on'];
$app_status_on  = $app_history_info['app_status_on'];

if($app_status_on == 3){
$app_st_date = $app_history_info['login_date_on'];
}
else if($app_status_on == 5){
$app_st_date = $app_history_info['sanction_date_on'];
}
else if($app_status_on == 6 || $app_status_on == 7){
$app_st_date = $app_history_info['first_disb_date_on'];
}
else{
$app_st_date = "";
}

$q_app_statuson = "select * from tbl_app_status where app_status_id = '".$app_status_on."'";
$r_app_statuson = mysqli_query($Conn1,$q_app_statuson);
$e_app_statuson = mysqli_fetch_array($r_app_statuson);
$name_app_statuson = $e_app_statuson['app_status'];

$q_bank_on = "select * from tbl_bank where bank_id = '".$app_bank_on."'";
$r_bank_on = mysqli_query($Conn1,$q_bank_on);
$e_bank_on = mysqli_fetch_array($r_bank_on);
$name_bank_on = $e_bank_on['bank_name'];

$qrydesc_partner = "select * from tbl_mlc_partner where partner_id = '".$partner_on."'";
$resdesc_partner = mysqli_query($Conn1,$qrydesc_partner);
$exedesc_partner = mysqli_fetch_array($resdesc_partner);
$partner_name = $exedesc_partner['partner_name'];

$enc_cs = urlencode(base64_encode($case_id));
$enc_cust = urlencode(base64_encode($cust_id));
$return_html .= "<tr><td><a href='../app/edit_applicaton.php?case_id=$enc_cs&cust_id=$enc_cust&loan_type=$loan_type&ut=2' target ='_blank'>".$app_id."</a></td><td>".$partner_name."</td><td>".$name_app_statuson."<br>".$app_st_date."</td><td>".$name_bank_on."<br>".$app_history_info['user_name']."</td><td>".date('d-m-Y',strtotime($app_history_info['date_created']))."</td></tr>";
}
$return_html .= "</table><br>";
}
echo $return_html;

/* coding for customer application history ends*/
/* coding for customer Query history start */

/*$query_history_query = "select qry.query_id as id, qry.loan_amt as loan_amt, qry.loan_type as loan_type, stats.date as date,user.user_name as user_name from tbl_mint_case_query_mapping as map left join tbl_mint_query as qry on map.query_id = qry.query_id left JOIN tbl_mint_query_status_detail as stats ON stats.query_id = qry.query_id left join tbl_user_assign as user on stats.user_id = user.user_id where map.case_id = $case_id order by map.query_id desc";
$query_history_result= mysqli_query($Conn1,$query_history_query);
$query_history = mysqli_num_rows($query_history_result); 
if($query_history > 0){
//Changes - NewTabsInCases - Akash - Starts - changed width
	echo '<table  class="gridtable" width="100%"><tr><th colspan="4" align="center">Query</th></tr><tr><td>Query Id</td><td>Loan Type<br>Loan Amt</td><td>MLC User</td><td>Date</td></tr>';
//Changes - NewTabsInCases - Akash - Ends - changed width
while($query_history_info = mysqli_fetch_array($query_history_result)){
$id = $query_history_info['id'];
$loan_amt = custom_money_format($query_history_info['loan_amt']);
$loan_type = $query_history_info['loan_type'];
$date = $query_history_info['date'];

$query_loan_type= mysqli_query($Conn1,"select * from lms_loan_type where loan_type_id = $loan_type");
$result_loan_type = mysqli_fetch_array($query_loan_type);
$loan_name = $result_loan_type['loan_type_name'];

$enc_id = urlencode(base64_encode($id));
echo "<tr><td><a href='../query/edit.php?id=$enc_id&ut=2' target ='_blank'>".$id."</a></td><td>".$loan_name."<br>".$loan_amt."</td><td>".$query_history_info['user_name']."</td><td>".date('d-m-Y',strtotime($date))."</td></tr>";
}
echo "</table>";
}*/
/* coding for customer Query history ends*/
?>