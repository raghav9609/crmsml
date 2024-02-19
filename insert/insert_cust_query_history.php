<?php
/* coding for customer application history start */
$app_history_query = "select app.app_id as app_id,app.partner_on as partner_on,app.app_bank_on as app_bank_on,app.app_status_on as app_status_on,app.date_created as date_created,user.user_name as user_name,app.login_date_on as login_date_on,app.sanction_date_on as sanction_date_on,app.first_disb_date_on as first_disb_date_on from tbl_mint_app as app join tbl_mint_case as cse on app.case_id = cse.case_id left join tbl_user_assign as user on cse.user_id = user.user_id where app.case_id = $case_id order by app.app_id desc";
$app_history_result= mysqli_query($Conn1,$app_history_query);
$app_history = mysqli_num_rows($app_history_result); 
if($app_history > 0){
	echo '<table class="gridtable" width="95%"><tr><th colspan="5" align="center">Application</th></tr><tr><td>App Id</td><td>Partner</td><td>Status</td><td>Bank/MLC USER</td><td>Date</td></tr>';
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
/*$q_app_statuson = "select app_status from tbl_app_status where app_status_id = '".$app_status_on."'";
$r_app_statuson = mysqli_query($Conn1,$q_app_statuson);
$e_app_statuson = mysqli_fetch_array($r_app_statuson);
$name_app_statuson = $e_app_statuson['app_status'];*/
$name_app_statuson = get_display_name('post_login',$app_status_on);
        if($name_app_statuson == ''){
            $name_app_statuson = get_display_name('new_status_name',$app_status_on);
        }

$q_bank_on = "select bank_name from tbl_bank where bank_id = '".$app_bank_on."'";
$r_bank_on = mysqli_query($Conn1,$q_bank_on);
$e_bank_on = mysqli_fetch_array($r_bank_on);
$name_bank_on = $e_bank_on['bank_name'];

$qrydesc_partner = "select partner_name from tbl_mlc_partner where partner_id = '".$partner_on."'";
$resdesc_partner = mysqli_query($Conn1,$qrydesc_partner);
$exedesc_partner = mysqli_fetch_array($resdesc_partner);
$partner_name = $exedesc_partner['partner_name'];
$enc_cs = urlencode(base64_encode($case_id));
$enc_cust = urlencode(base64_encode($cust_id));
echo "<tr><td><a href='../app/edit_applicaton.php?case_id=$enc_cs&cust_id=$enc_cust&loan_type=$loan_type&ut=2' target ='_blank'>".$app_id."</a></td><td>".$partner_name."</td><td>".$name_app_statuson."<br>".$app_st_date."</td><td>".$name_bank_on."<br>".$app_history_info['user_name']."</td><td>".date('d-m-Y',strtotime($app_history_info['date_created']))."</td></tr>";
}
echo "</table>";
}
/* coding for customer application history ends*/
?>
<br>