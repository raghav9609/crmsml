<?php
require_once "../../include/check-session.php";
require_once "../../include/config.php";
   
$template = replace_special($_REQUEST['temp']);
$case_id = replace_special($_REQUEST['case_id']);
$query_id = replace_special($_REQUEST['query_id']);
$app_id =  replace_special($_REQUEST['app_id']);
if($template == 16){
if($query_id != '') {
$qry_qryid = mysqli_query($Conn1,"select qry.cust_id as cust_id,qry.loan_type as loan_type,qry.loan_amt as loan_amt,qry.extng_amt as extng_amt,qry.loan_nature as loan_nature,stats.user_id as user_id,qry.asset_type as asset_type,qry.borrower_count as borrower_count,qry.weight_gold as weight_gold,qry.purity_gold as purity_gold,qry.cur_rate as cur_rate,qry.loan_emi as loan_emi from tbl_mint_query as qry left JOIN tbl_mint_query_status_detail as stats ON qry.query_id = stats.query_id where qry.query_id = ".$query_id."");
$info_qury = mysqli_fetch_array($qry_qryid);
$cust_id = $info_qury['cust_id'];
$user_id = $info_qury['user_id'];
$bank_id = $info_qury['bank_id'];
$loan_type_id= $info_qury['loan_type'];
$prop_type = $info_qury['asset_type'];
$loan_amt = $info_qury['loan_amt'];
$extng_amt = $info_qury['extng_amt'];
$pur_loan = $info_qury['loan_nature'];
$borrower_count = $info_qury['borrower_count'];	
$weight_gold = $info_qury['weight_gold'];
$purity_gold = $info_qury['purity_gold'];
$cur_rate = $info_qury['cur_rate'];
$loan_emi = $info_qury['loan_emi'];
if($borrower_count > 0){
$qry_qry_cob = mysqli_query($Conn1,"select occup_on,dob_on,net_incm_on,occup_tw,dob_tw,net_incm_tw,cur_emi_tw,cur_emi_on from tbl_mint_cust_coborrower where query_id = ".$query_id."");
$info_qury_cob = mysqli_fetch_array($qry_qry_cob);
$occup_on = $info_qury_cob['occup_on'];
$dob_on = $info_qury_cob['dob_on'];
$net_incm_on = $info_qury_cob['net_incm_on'];
$occup_tw = $info_qury_cob['occup_tw'];
$dob_tw = $info_qury_cob['dob_tw'];
$net_incm_tw = $info_qury_cob['net_incm_tw'];
$cur_emi_on = $info_qury_cob['cur_emi_on'];
$cur_emi_tw = $info_qury_cob['cur_emi_tw'];
}
}else{
$query_custid= "select cust_id,required_loan_amt,loan_type,user_id,asset_type,ext_amt,loan_nature,weight_gold,purity_gold,cur_rate_intr,ext_emi From tbl_mint_case where case_id = ".$case_id."";
$result_query = mysqli_query($Conn1,$query_custid);
$info_query = mysqli_fetch_array($result_query);
$cust_id = $info_query ['cust_id'];
$loan_type_id = $info_query['loan_type'];
$prop_type = $info_query['asset_type'];
$user_id = $info_query['user_id'];
$loan_amt = $info_query['required_loan_amt'];
$extng_amt = $info_query['ext_amt'];
$pur_loan = $info_query['loan_nature'];
$weight_gold = $info_query['weight_gold'];
$purity_gold = $info_query['purity_gold'];
$cur_rate = $info_qury['cur_rate_intr'];
$loan_emi = $info_qury['ext_emi'];
}



$query_info = "select name,salu_id,city_id,email, occup_id, net_incm, comp_id,dob from tbl_mint_customer_info where id = ".$cust_id."";
$result_info = mysqli_query($Conn1,$query_info);
$info_query1 = mysqli_fetch_array($result_info );
$name = $info_query1['name'];
$salu_id = $info_query1['salu_id'];
$city_id = $info_query1['city_id'];
$email_cust = $info_query1['email'];
$occup_id = $info_query1['occup_id'];
$comp_id_l = $info_query1['comp_id'];
$net_incm_long = $info_query1['net_incm'];
$dob = $info_query1['dob'];
include("get-rates.php");
if(!empty($get_bank_option)){ ?>
<td>Select Bank</td><td colspan="5"><?php 
$i = 0;
foreach($get_bank_option as $bank_option){
    $i++;
?>
<label><input type="checkbox" class ="bank_option" id="<?php echo $i; ?>" value="<?php echo $i; ?>" checked /><?php echo $bank_option['bank']." ".$bank_option['rate_type']; ?></label>

<?php }}} ?></td>
