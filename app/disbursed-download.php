<?php
$slave =1;
require_once "../../include/check-session.php";
require_once "../../include/config.php";
require_once "../../include/display-name-functions.php";
$filename = "Disbursed_Cases_".date('d-m-Y').".csv";
$fp = fopen('php://output', 'a');
header('Content-type: application/csv');
header('Content-Disposition: attachment; filename='.$filename);


$kotak_resp_array = array('1'=>'Follow Up','2'=>'Declined','3'=>'Login','4'=>'Hold','5'=>'Disbursed','6'=>'Sanctioned','7'=>'Approved','8'=>'Closed','9'=>'In Process');

$header = array("Date","Case No","CRM Lead ID","LOS No.", "Name","City","City Sub Group","Phone","Loan Type","Bank Name","Pre Login Status", "Post Login Status","Login Date","Login Amount","Sanctioned Date","Sanctioned Amount","Disbursed Date","Disbursed Amount","Assigned", "Description","Pan Card","Lead Source","API Response","Annual Turnover","ITR Amount","Loan Amount","Net Income","Company","DOB","Pincode","Address","Cibil","ASM Name","ZSM Name","Source","Con Call","Mail Sent","LOS","Auto Cases","Partner","Loan Amount Range","FOS User","Loan Nature","Sub Sub Status");
fputcsv($fp, $header);
$query = $_REQUEST['qry'];
for(1==1;0<1;){
  $query_to_execute = $query." limit ".$start_limit.','.$max_download_limit;
  $results = mysqli_query($Conn1,$query_to_execute);
  if(mysqli_num_rows($results) > 0){
	while($exe = mysqli_fetch_array($results)) {
$app_date = $exe['date'];
$bank_crm_lead_on = $exe['bank_crm_lead_on'];
$case_id = $exe['case_id'];
$app_id  = $exe['app_id'];
$app_bank_on  = $exe['app_bank_on'];
$bnk_app_no  = $exe['bnk_app_no'];
$app_status_on  = $exe['app_status_on'];
$user_id = $exe['user_id'];
$loan_type = $exe['loan_type'];
$name = $exe['name'];
$email = $exe['email'];
$phone = $exe['phone'];
$city_id = $exe['city_id'];
$bank_app_no_on  = $exe['bank_app_no_on'];
$app_description = $exe['app_description'];
$fup_desc = $exe['fup_desc'];
$cust_id  = $exe['id'];
$loan_type = $exe['loan_type'];
$pre_login_id = $exe['pre_login_status'];
$disbursed_date  = $exe['first_disb_date_on'];
$disbursed_amount  = $exe['disbursed_amount_on'];
$sanctioned_date  = $exe['sanction_date_on'];
$sanctioned_amount  = $exe['sanctioned_amount_on'];
$login_date  = $exe['login_date_on'];
$login_amount  = $exe['applied_amount_on'];
$date_created  = $exe['date_created'];
$source = $exe['source'] == '1' ? "MLC":"CRM";
$anual_turnover =  $exe['annual_turnover_num'];
$bus_anl_trnover =  $exe['bus_anl_trnover'];
$con_call = $exe['con_call'];
$auto_case_create = $exe['auto_case_create'];
$fos_user_id = $exe['fos_user_id'];
$sub_sub_status = $exe['sub_sub_status'];
$acase_cr = 'No';
$loan_nature_get = $exe['loan_nature'];
$loan_nature_name = "New Loan";
if($loan_nature_get == 2){
  $loan_nature_name = "Balance Transfer";
}else if($loan_nature_get == 3){
  $loan_nature_name = "Top Up";
}
if($auto_case_create == '1'){
	$acase_cr = 'Yes';
}
if($con_call == '0'){
	$con = 'No';
} else {
	$con = 'yes';
}
$assign_fos = '';
if($fos_user_id > 0){
  $qryassign_fos = "select * from tbl_user_assign where user_id = '".$fos_user_id."'";
$resassign_fos = mysqli_query($Conn1,$qryassign_fos);
$exeassign_fos = mysqli_fetch_array($resassign_fos);
$assign_fos = $exeassign_fos['user_name'];
}

if($exe['loan_amt'] <= '2500000'){
	$loan_amt_filter = 'Loan Amount Till 25 Lakh';
} else if($exe['loan_amt'] > '2500000' && $exe['loan_amt'] < '4000000'){
	$loan_amt_filter = 'Loan Amount > 25 Lakh & < 40 Lakh';
} else {
	$loan_amt_filter = 'Loan Amount >= 40 Lakh';
}
if( $anual_turnover == 0){
    $get_turnover_qry = mysqli_query($Conn1,"select turnover_num from tbl_bussiness_anl_trunover where bus_anl_id = '".$bus_anl_trnover."'");
    $result_turnover_qry = mysqli_fetch_array($get_turnover_qry);
    $anual_turnover = $result_turnover_qry['turnover_num'];
}else{
    $anual_turnover =  $anual_turnover;
}
$query_part_id = mysqli_query($Conn1,"select partner_name from tbl_bank_cse_pat_rec as pt_rec left JOIN tbl_mlc_partner as ml_pt ON pt_rec.pat_id=ml_pt.partner_id where pt_rec.case_id=".$case_id." and ml_pt.bank_id = '".$app_bank_on."'");
$res_part_id = mysqli_fetch_array($query_part_id);
$get_parnter_id_qry = mysqli_query($Conn1,"select pat_id from tbl_pat_loan_type_mapping where loan_type ='".$loan_type."' and bank_id = '".$app_bank_on."'");
$result_map_qry = mysqli_fetch_array($get_parnter_id_qry);
$get_response_qry = mysqli_query($Conn1,"select response,res_desc from tbl_pat_retrn_respnse where case_id = ".$case_id." and partner_id = '".$result_map_qry['pat_id']."' order by resp_id desc");
$result_response_qry = mysqli_fetch_array($get_response_qry);




$cibil_flag = 'N';
$get_responsec_qry = mysqli_query($Conn1,"select cibil_flag from tbl_bank_cse_pat_rec where case_id = ".$case_id." and pat_id = '".$result_map_qry['pat_id']."'");
$result_responsec_qry = mysqli_fetch_array($get_responsec_qry);
if($result_responsec_qry['cibil_flag'] == 1){
    $cibil_flag = 'Y';
}
$get_contact_name = mysqli_query($Conn1,"select rm_name,sm_name from tbl_bank_contact_info_new where partner_id ='".$result_map_qry['pat_id']."' and city_id = '".$city_id."'");
$result_contact_name_qry = mysqli_fetch_array($get_contact_name);
$get_pincode_name = mysqli_query($Conn1,"select pincode from tbl_mint_cust_info_intt where cust_id =".$cust_id."");
$result_pincode_name_qry = mysqli_fetch_array($get_pincode_name);
$mail_sent = 'N';
$mint_qry_email = mysqli_query($Conn1,"select count(*) as total from banker_email_history where case_id =".$case_id." and partner_id = '38'");
$result_mint_qry_email = mysqli_fetch_array($mint_qry_email);
if($result_mint_qry_email['total'] > 0){$mail_sent = 'Y';}
if($exe['comp_id'] > 0){
    $get_comp_name = mysqli_query($Conn1,"select comp_name from pl_company where comp_id ='".$exe['comp_id']."'");
    $result_comp_name_qry = mysqli_fetch_array($get_comp_name);
	$company_name_get = $result_comp_name_qry['comp_name'];
} else {
	$company_name_get = $exe['comp_other'];
}
$partner_name = $res_part_id['partner_name'];
$loan_name = get_display_name("loan_type",$loan_type);
$assign = get_display_name("mlc_user_name",$user_id);
$name_bank_on = get_display_name("bank_name",$app_bank_on);

$name_app_statuson = get_display_name('post_login',$app_status_on);
if($name_app_statuson == ''){
  $name_app_statuson = get_display_name('snew_status_name',$app_status_on);  
}
$name_papp_statuson = get_display_name('pre_login',$pre_login_id);
if($name_papp_statuson == ''){
  $name_papp_statuson = get_display_name('snew_status_name',$pre_login_id);  
}
$sub_status_name = '';
if($sub_sub_status > 0){
  $sub_status_name = get_display_name('snew_status_name',$sub_sub_status);  
}

$name_papp_statuson = (trim($name_papp_statuson) == '') ?'' : $name_papp_statuson;
$name_app_statuson = (trim($name_app_statuson) == '') ?'' : $name_app_statuson;
$sub_status_name = (trim($sub_status_name) == '') ?'' : $sub_status_name;



$city_name = get_display_name("city_name",$city_id);
$city_sub_group_name = get_display_name("city_sub_group_name",$city_id);
if($app_bank_on == '17'){
    if($result_response_qry['response'] == "4") {
                                $aip_response = "AIP Refer ".$result_response_qry['res_desc'];
    }else if($result_response_qry['response'] == "0"){
                                $aip_response = "FAILURE/ERROR ".$result_response_qry['res_desc'];
    }else if($result_response_qry['response'] == "3"){
                                $aip_response = "AIP Rejected ".$result_response_qry['res_desc'];
    }else if($result_response_qry['response'] == "1"){
                                $aip_response = "AIP Approve ".$result_response_qry['res_desc'];
} } else {
	if($result_map_qry['pat_id'] == '24'){
	 $new_val = $result_response_qry['response'];
	$aip_response = $kotak_resp_array[$new_val].' '.$result_response_qry['res_desc'];
} else {
	$aip_response = $result_response_qry['response'].' '.$result_response_qry['res_desc'];
}
 
}
if($exe['flag_for_los'] == '1'){
    $los_flag = 'Yes';
} else {
    $los_flag = 'No';
}

$row =array();
 $row[] = $app_date;
    $row[] = stripslashes($case_id);
    $row[] = stripslashes($bank_crm_lead_on);
    $row[] = stripslashes($bnk_app_no);
    $row[] = stripslashes($name);
    $row[] = stripslashes($city_name);
	  $row[] = stripslashes($city_sub_group_name);
    $row[] = substr($phone,0,2)."XXXXX".substr($phone,-3);
    $row[] = stripslashes($loan_name);
    $row[] = stripslashes($name_bank_on);
    $row[] = stripslashes($name_papp_statuson);
    $row[] = stripslashes($name_app_statuson);
    $row[] = stripslashes($login_date);
    $row[] = stripslashes($login_amount);
    $row[] = stripslashes($sanctioned_date);
    $row[] = stripslashes($sanctioned_amount);
    $row[] = stripslashes($disbursed_date);
    $row[] = stripslashes($disbursed_amount);
    $row[] = stripslashes($assign);
    $row[] = stripslashes($app_description);
    $row[] = stripslashes($exe['pan_card']);
    $row[] = "MyLoanCare";
    $row[] = $aip_response;
    $row[] = $anual_turnover;
    $row[] = $exe['profit_itr_amt'];
    $row[] = $exe['loan_amt'];
    $row[] = $exe['net_incm'];
    $row[] = $company_name_get;
    $row[] = $exe['dob'];
    $row[] =  $result_pincode_name_qry['pincode'];
		$row[] =  $exe['address'];
		$row[] =  $cibil_flag;
		$row[] = stripslashes($result_contact_name_qry['sm_name']);$row[] = stripslashes($result_contact_name_qry['rm_name']);
		$row[] = stripslashes($source);
		$row[] = stripslashes($con);
		$row[] = $mail_sent;
		$row[] = $los_flag;
		$row[] = $acase_cr;
		$row[] = $partner_name;
		$row[] = $loan_amt_filter;
        $row[] = $assign_fos;
        $row[] = $loan_nature_name;
        $row[] = $sub_status_name;
		fputcsv($fp, $row);
		}
	}else{
		break;
	}
	$start_limit += $max_download_limit;
}
include("../../include/footer_close.php");
//header("location::".$head_url."/sugar/app/disbursed-cases.php");
?>
