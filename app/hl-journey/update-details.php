<?php  
require_once "../../../include/check-session.php";
require_once "../../../include/config.php";
require_once "../../../include/helper.functions.php";
$step = replace_special($_REQUEST["step_app"]);
$case_id = replace_special($_REQUEST['case_id']);
$loan_type = replace_special($_REQUEST['loan_type']);
$main_application_id = replace_special($_REQUEST['main_application_id']);
if(!in_array($step,array(1,2)) || !is_numeric($case_id) || !is_numeric($loan_type) || ($step == 1 && !is_numeric($main_application_id))){
	exit;
}
$cust_id = replace_special($_REQUEST['cust_id']);
$query_id = replace_special($_REQUEST['query_id']);
$rw_id = replace_special($_REQUEST['rw_id']);
$app_bank =  replace_special($_REQUEST['app_bank']);
$lead_view_id = replace_special($_REQUEST['lead_view_id']);
$click_to_call_id = replace_special($_REQUEST['click_to_call_id']);
$app_bank = replace_special($_REQUEST['app_bank']);
$partner = replace_special($_REQUEST['partner']);
$pre_status = replace_special($_REQUEST['pre_status']);
$post_login_status = replace_special($_REQUEST['post_login_status']);
$rate_type = replace_special($_REQUEST['rate_type']);
$applied_amount = replace_special($_REQUEST['applied_amount']);
$loan_tenure = replace_special($_REQUEST['loan_tenure']);
$fixed_tenure = replace_special($_REQUEST['fixed_tenure']);
$rate_of_in = $_REQUEST['rate_of_in'];
$login_date = $_REQUEST['login_date'];
$sanctioned_amount = replace_special($_REQUEST['sanctioned_amount']);
$sanction_date = $_REQUEST['sanction_date'];
$disbursed_amount = replace_special($_REQUEST['disbursed_amount']);
$first_disb_date = $_REQUEST['first_disb_date'];
$last_disb_date = $_REQUEST['last_disb_date'];
$bank_crm_lead = $_REQUEST['bank_crm_lead'];
$bank_app_num = $_REQUEST['bank_app_num'];
$cash_offers = replace_special($_REQUEST['cash_offers']);
$description = $_REQUEST['description'];
$cibil_score_num = replace_special($_REQUEST['cibil_score_num']);
$follow_type = replace_special($_REQUEST['follow_type']);
$follow_date = $_REQUEST['follow_date'];
$follow_up_time = $_REQUEST['follow_up_time'];
$bil_type = replace_special($_REQUEST['bil_type']);
$property_status = replace_special($_REQUEST['property_status']);
$cashback_sms_new = replace_special($_REQUEST['cashback_sms']);

$deposit_tenure = replace_special($_REQUEST['deposit_tenure']);

if($follow_type == '' || $follow_type == 4 || $follow_type == 0){
	$follow_date = $follow_up_time = '';
}else{
	$follow_date = date('Y-m-d',strtotime($follow_date));
	$follow_up_time = date('H:i:s',strtotime($follow_up_time));
}
$cashback_sms = '';
    if(in_array($post_login_status,array(2,3,4,5,6,7,9,10,11))){
        if($post_login_status == 6 || $post_login_status == 7){
            $last_disb_date = $last_disb_date;
            $disbursed_amount = $disbursed_amount;
            $first_disb_date = $first_disb_date;
            $cashback_sms = $cashback_sms_new;
        }else {
            $last_disb_date ='';
            $disbursed_amount = '';
            $first_disb_date = '';
        }
        $sanctioned_amount = $sanctioned_amount;
        $sanction_date = $sanction_date;
    }else{
        if(in_array($post_login_status,array(2,3,4,9,10,11))){
            $login_date= $login_date;
        }else{
            $login_date = '';
        }
        $sanctioned_amount = '';
        $sanction_date = '';
        $disbursed_amount = '';
        $first_disb_date= '';
        $last_disb_date = '';
    }
$qry_to_execute = '';
    if($step == 1){
    	$qry_to_execute = "update tbl_mint_app ";
    	$last_concat = " where id = ".$rw_id." limit 1";
    }else if($step == 2){
    	$chk_exis = mysqli_query($Conn1,"select * from tbl_mint_app where case_id = ".$case_id." and app_bank_on = '".$app_bank ."'");
    	if(mysqli_num_rows($chk_exis) == 0){
    		$mlc_product_id_qry = mysqli_query($Conn1,"select mlc_product_id from lms_loan_type where loan_type_id = '".$loan_type."'");
			    $result_product_id = mysqli_fetch_array($mlc_product_id_qry);
			    $mlc_product_id = $result_product_id['mlc_product_id'];
			    if($mlc_product_id != '' && $mlc_product_id != 0 && $loan_type !='' && $loan_type != 0){
			        if(strlen($app_bank) == 3){
			            $app_bank_tw = $app_bank;
			        }else{
			            $app_bank_tw = "0".$app_bank;
			        }
			        $main_application_id = $mlc_product_id.$loan_type.$app_bank_tw.$case_id;
			    $qry_to_execute = "INSERT INTO tbl_mint_app ";
			    $last_concat = ",query_id='".$query_id."',case_id=".$case_id.",app_id=".$main_application_id.",app_created_by=".$user.",app_bank_on=".$app_bank.",date_created = CURDATE()";
    	}
    }
}
if($qry_to_execute != ''){
	$final_qry  = $qry_to_execute." set property_status='".$property_status."',
	pre_login_status ='".$pre_status."',
	loan_tenure_on='".$loan_tenure."', 
	fixed_tenure_on ='".$fixed_tenure."',
	app_status_on ='".$post_login_status."', 
	follow_up_type_on ='".$follow_type."',
	rate_type_on = '".$rate_type."',
	rate_of_in_on = '".$rate_of_in."', 
	sanction_date_on= '".$sanction_date."',
	partner_on = '".$partner."', 
	applied_amount_on = '".$applied_amount."',
	sanctioned_amount_on ='".$sanctioned_amount."',
	disbursed_amount_on = '".$disbursed_amount."',
	follow_up_date_on = '".$follow_date."',
	first_disb_date_on = '".$first_disb_date."',
	follow_up_time='".$follow_up_time."',
	last_disb_date_on ='".$last_disb_date."',
	bank_app_no_on = '".$bank_app_num."', 
	bank_crm_lead_on = '".$bank_crm_lead."',
	cash_offers_on = '".$cash_offers."', 
	login_date_on = '".$login_date."',
	app_description= '".mysqli_real_escape_string($Conn1,$description)."',
	cashback_sms_flag='".$cashback_sms."',
	bil_type = '".$bil_type."', 
	cibil_score = '".$cibil_Score_num."',
	bank_wise_tennure = '".$deposit_tenure."', 
	la_st_up_date = NOW() ".$last_concat;
	mysqli_query($Conn1,$final_qry);
}
if($post_login_status == 6 || $post_login_status == 7){
	$m_app_id = $main_application_id;
}
$pre_login_status = replace_special($_REQUEST['apply_pre_login_status']);
$app_status_on = replace_special($_REQUEST['apply_app_status_on']);
if($pre_status != $pre_login_status  || $post_login_status != $app_status_on){
        $qry_app_history = "insert into tbl_application_history set case_id = ".$case_id.",app_id= '".$main_application_id."',pre_login= '".$pre_status ."',post_login='".$post_login_status."',date=CURDATE(),time=CURTIME(), user_id= '".$user."'";
        $insert_app_history = mysqli_query($Conn1,$qry_app_history);
    }

    if($follow_type != '' && $follow_type != 0 && $follow_date != '' && $follow_date != '0000-00-00'){
       $app_histry = mysqli_query($Conn1,"insert into tbl_mint_case_followup set click_to_call_id='".$click_to_call_id."',lead_view_id='".$lead_view_id."',follow_time='".$follow_up_time."',case_id = ".$case_id.",app_id = '".$main_application_id."',app_flag =1,follow_date = '".$follow_date."',follow_status='".$follow_type."',follow_type = 1,description ='".$app_description."',date=CURDATE(),time= CURTIME(),mlc_user_id = '".$user."'");
    }
    if($loan_type == 60){
        mysqli_query($Conn1,"update tbl_mint_case set is_nstp =1 where case_id = ".$case_id." LIMIT 1");
    }
    echo $head_url."/sugar/app/edit_applicaton.php?case_id=".base64_encode($case_id)."&m_app=$m_app_id&cust_id=".base64_encode($cust_id)."&loan_type=".$loan_type."&app_id=".base64_encode($main_application_id)."&errmsg=edit sucessfully!&upated=1";
?>