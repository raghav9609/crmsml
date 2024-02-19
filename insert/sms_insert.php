<?php
$phone_no=$pat_user_contact; 
if($bk_pat_id == 28){
	$dsa_code_bnk = '324637LGR';
}else if($bk_pat_id == 29){
	$dsa_code_bnk = 'DSAGLGUR0040';
}else if($bk_pat_id == 60){
	$dsa_code_bnk = 'DSASBLNCR179';
}else{
	$dsa_code_bnk = '';
}
$sms_ext_msg = $user_name_asign.", MyLoanCare";
if($comp_name == ''){
	$sms_comp_name = 'N/A';
}else{
	$sms_comp_name = $comp_name;
}
if($bk_pat_id != 28 && $bk_pat_id != 29 && $bk_pat_id != 60){
	$msg = "Case ".$case_id." Cust ".$name.", Mob ".$phone." City ".$city." NTH ".$net_incm." ".$loantypename." Rs. ".$req_loan_amt.", ".$user_name_asign.", My Loan Care";
	//$msg="Case ".$case_id." Customer ".$name.", ".$phone." ".$city." ".$occup." @ ".substr($sms_comp_name,0,15)." NTH ".$net_incm." ".$loantypename." Rs. ".$req_loan_amt.", ".$sms_ext_msg."";
}else if($bk_pat_id == 28 && $bank_crm_id_app != ''){
	$msg="MyLoanCare ".$loantypename." Case ".$case_id." Cust - ".$name." , ".$phone." ".$city."  Rs ".$req_loan_amt." . - Bank CRM ID - ".$bank_crm_id_app." ,Capture DSA Code ".$dsa_code_bnk." in Finnone LOS ";
}else{
	$msg="MyLoanCare ".$loantypename." Case ".$case_id." Cust - ".$name." , ".$phone." ".$city."  Rs ".$req_loan_amt." . Capture DSA Code ".$dsa_code_bnk." in Finnone LOS ";  
}
?>