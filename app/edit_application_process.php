<?php
require_once "../../include/check-session.php";
require_once "../../include/config.php";
require_once "../../include/helper.functions.php";
$spli_app_id = explode("_",$_POST['apply_app_num']);
if($_REQUEST['edit_bank']){
    $is_cashback_sent_email_sms = 0 ;
    $rw_id = $spli_app_id[0];
    //Changes - ApplicationEditNewDesign - Akash - Starts
    $case_id = replace_special($_POST['case_id_'.$rw_id.'']);
    $cust_id = replace_special($_POST['cust_id_'.$rw_id.'']);
    $loan_type = replace_special($_POST['loan_type_'.$rw_id.'']);
    //Changes - ApplicationEditNewDesign - Akash - Ends
    $main_application_id = $applic_id = $_REQUEST['apply_app_id_'.$rw_id.''];
    $property_status = $_REQUEST['property_status_'.$rw_id.''];
    $app_status_on = $_REQUEST['apply_app_status_on_'.$rw_id.''];
    $pre_login_status = $_REQUEST['apply_pre_login_status_'.$rw_id.''];
    $lead_view_id = $_REQUEST['lead_view_id_'.$rw_id.''];
    $click_to_call_id = $_REQUEST['click_to_call_id_'.$rw_id.''];
    $cashback_sms_new = replace_special($_REQUEST['cashback_sms_'.$rw_id.'']);
    $pre_status = replace_special($_REQUEST['pre_status_'.$rw_id.'']);
    $status = replace_special($_REQUEST['status_'.$rw_id.'']);
    $applied_amount = replace_special($_REQUEST['applied_amount_'.$rw_id.'']);
    $rate_type = replace_special($_REQUEST['rate_type_'.$rw_id.'']);
    $partner = replace_special($_REQUEST['partner_'.$rw_id.'']);
    $login_date = replace_special($_REQUEST['login_date_'.$rw_id.'']);
    $sanctioned_amount_new = replace_special($_REQUEST['sanctioned_amount_'.$rw_id.'']);
    $sanction_date_new = replace_special($_REQUEST['sanction_date_'.$rw_id.'']);
    $loan_tenure = replace_special($_REQUEST['loan_tenure_'.$rw_id.'']);
    $fixed_tenure = replace_special($_REQUEST['fixed_tenure_'.$rw_id.'']);
    $rate_of_in = replace_special($_REQUEST['rate_of_in_'.$rw_id.'']);
    $disbursed_amount_new = replace_special($_REQUEST['disbursed_amount_'.$rw_id.'']);
    $first_disb_date_new = replace_special($_REQUEST['first_disb_date_'.$rw_id.'']);
    $last_disb_date_new = replace_special($_REQUEST['last_disb_date_'.$rw_id.'']);
    $bank_crm_lead = replace_special($_REQUEST['bank_crm_lead_'.$rw_id.'']);
    $bank_app_num = replace_special($_REQUEST['bank_app_num_'.$rw_id.'']);
    $cash_offers =  replace_special($_REQUEST['cash_offers_'.$rw_id.'']);
    $follow_type = replace_special($_REQUEST['follow_type_'.$rw_id.'']);
    $follow_date  = $_REQUEST['follow_date_'.$rw_id.''];
    $app_description  = replace_special($_REQUEST['description_'.$rw_id.'']);
    $app_bank_applied  = replace_special($_REQUEST['app_bank_applied_'.$rw_id.'']);
    $los_radio  = replace_special($_REQUEST['los_radio_'.$rw_id.'']);
    $follow_up_time = $_REQUEST['follow_up_time_'.$rw_id.''];
    $fol_time_up = date('H:i:s', strtotime($follow_up_time));
    $legal_ok =  replace_special($_REQUEST['legal_ok_'.$rw_id.'']);
    $tech_ok =  replace_special($_REQUEST['tech_ok_'.$rw_id.'']);
    $bil_type =  replace_special($_REQUEST['bil_type_'.$rw_id.'']);

    $cibil_Score_num =  replace_special($_REQUEST['cibil_score_num_'.$rw_id.'']);

    $cashback_sms = '';
    if(in_array($status,array(2,3,4,5,6,7,9,10,11))){
        if($status == 6 || $status == 7){
            $m_app_id = $applic_id;
            $last_disb_date = $last_disb_date_new;
            $disbursed_amount = $disbursed_amount_new;
            $first_disb_date = $first_disb_date_new;
            $cashback_sms = $cashback_sms_new;
            if($status == 7){
                $check_qry = mysqli_query($Conn1,"select * from tbl_mint_app where app_id = ".$m_app_id." and disb_email_flag = 0");
                if(mysqli_num_rows($check_qry) > 0){
                    $check_qry_cashback = mysqli_query($Conn1,"select * from tbl_pat_loan_type_mapping where loan_type = ".$m_app_id." and bank_id = ".$app_bank_applied." and is_cashback_strip = 1");
                    if(mysqli_num_rows($check_qry_cashback) > 0){
                        $is_cashback_sent_email_sms = 1;
                    }
                }
            }
        }else {
            $last_disb_date ='';
            $disbursed_amount = '';
            $first_disb_date = '';
        }
        $sanctioned_amount = $sanctioned_amount_new;
        $sanction_date = $sanction_date_new;
    }else{
        if(in_array($status,array(2,3,4,9,10,11))){
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
    if($pre_status != $pre_login_status  || $status != $app_status_on){
        $qry_app_history = "insert into tbl_application_history set case_id = ".$case_id.",app_id= '".$applic_id."',pre_login= '".$pre_status ."',post_login='".$status."',date=CURDATE(),time=CURTIME(), user_id= '".$user."'";
        $insert_app_history = mysqli_query($Conn1,$qry_app_history);
    }

    if($follow_type != '' && $follow_type != 0 && $follow_date != '' && $follow_date != '0000-00-00'){
        $app_histry = mysqli_query($Conn1,"insert into tbl_mint_case_followup set click_to_call_id='".$click_to_call_id."',lead_view_id='".$lead_view_id."',follow_time='".$fol_time_up."',case_id = ".$case_id.",app_id = '".$applic_id."',app_flag =1,follow_date = '".$follow_date."',follow_status='".$follow_type."',follow_type = 1,description ='".$app_description."',date=CURDATE(),time= CURTIME(),mlc_user_id = '".$user."'");
    }

    $qry_fet = "update tbl_mint_app set pre_login_status ='".$pre_status."', loan_tenure_on='".$loan_tenure."', fixed_tenure_on ='".$fixed_tenure."',
 app_status_on ='".$status."', rate_type_on = '".$rate_type."', rate_of_in_on = '".$rate_of_in."', 
 sanction_date_on= '".$sanction_date."', partner_on = '".$partner."', applied_amount_on = '".$applied_amount."', sanctioned_amount_on ='".$sanctioned_amount."',
 follow_up_time='".$fol_time_up."', bank_app_no_on = '".$bank_app_num."', bank_crm_lead_on = '".$bank_crm_lead."',
 cash_offers_on = '".$cash_offers."',  login_date_on = '".$login_date."',app_description= '".mysqli_real_escape_string($Conn1,$app_description)."', cibil_score = '".$cibil_Score_num."', la_st_up_date = NOW()";

 //Changes - ApplicationEditNewDesign - Akash - Starts
 if($follow_date != "0000-00-00" && $follow_date != "" && $follow_date != "1970-01-01") {
    $qry_fet .= ", follow_up_date_on='".$follow_date."'";
}
if($follow_type != "") {
    $qry_fet .= ", follow_up_type_on='".$follow_type."'";
}
if($bil_type != "") {
    $qry_fet .= ", bil_type='".$bil_type."'";
}
if($cashback_sms != "") {
    $qry_fet .= ", cashback_sms_flag='".$cashback_sms."'";
}
if($tech_ok != "") {
    $qry_fet .= ", tech_ok='".$tech_ok."'";
}
if($legal_ok) {
    $qry_fet .= ", legal_ok='".$legal_ok."'";
}
if($los_radio != "") {
    $qry_fet .= ", los_flag='".$los_radio."'";
}
if($property_status != "") {
    $qry_fet .= ", property_status='".$property_status."'";
}
if($disbursed_amount != "") {
    $qry_fet .= ", disbursed_amount_on='".$disbursed_amount."'";
}
if($first_disb_date != "") {
    $qry_fet .= ", first_disb_date_on='".$first_disb_date."'";
}
if($last_disb_date != "") {
    $qry_fet .= ", last_disb_date_on='".$last_disb_date."'";
}
//Changes - ApplicationEditNewDesign - Akash - Ends

 if($user_role == 3){
    $qry_fet .= ",app_created_by = '".$user."'";
 }
 $qry_fet .= " where id = '".$rw_id."'";
    $update_app = mysqli_query($Conn1,$qry_fet);
}
if($_REQUEST['ad_bnk']){
    //Changes - ApplicationEditNewDesign - Akash - Starts
    $case_id = replace_special($_POST['case_id_tw']);
    $cust_id = replace_special($_POST['cust_id_tw']);
    $loan_type = replace_special($_POST['loan_type_tw']);
    //Changes - ApplicationEditNewDesign - Akash - Ends
    $query_id_tw = replace_special($_REQUEST['query_id_tw']);
    $app_bank_tw = replace_special($_REQUEST['app_bank_tw']);
    $pre_status_tw = replace_special($_REQUEST['pre_status_tw']);
    $status_tw = replace_special($_REQUEST['status_tw']);
    $applied_amount_tw = replace_special($_REQUEST['applied_amount_tw']);
    $rate_type_tw = replace_special($_REQUEST['rate_type_tw']);
    $partner_tw = replace_special($_REQUEST['partner_tw']);
    $login_date_tw = replace_special($_REQUEST['login_date_tw']);
    $sanctioned_amount_tw = replace_special($_REQUEST['sanctioned_amount_tw']);
    $sanction_date_tw = replace_special($_REQUEST['sanction_date_tw']);
    $loan_tenure_tw = replace_special($_REQUEST['loan_tenure_tw']);
    $fixed_tenure_tw = replace_special($_REQUEST['fixed_tenure_tw']);
    $rate_of_in_tw = replace_special($_REQUEST['rate_of_in_tw']);
    $disbursed_amount_tw = replace_special($_REQUEST['disbursed_amount_tw']);
    $first_disb_date_tw = replace_special($_REQUEST['first_disb_date_tw']);
    $last_disb_date_tw = replace_special($_REQUEST['last_disb_date_tw']);
    $bank_crm_lead_tw = replace_special($_REQUEST['bank_crm_lead_tw']);
    $bank_app_num_tw = replace_special($_REQUEST['bank_app_num_tw']);
    $cash_offers_tw =  replace_special($_REQUEST['cash_offers_tw']);
    $follow_type_tw = replace_special($_REQUEST['follow_type_tw']);
    $follow_date_tw  = replace_special($_REQUEST['follow_date_tw']);
    $app_desc_tw  = replace_special($_REQUEST['description_tw']);
    $follow_up_time_tw = $_REQUEST['follow_up_time_tw'];
    $fol_time_up_tw = date('H:i:s', strtotime($follow_up_time_tw));
    $property_status_tw =$_REQUEST['property_status_tw'];
    $legal_ok =  replace_special($_REQUEST['legal_ok']);
    $tech_ok =  replace_special($_REQUEST['tech_ok']);
    $bil_type =  replace_special($_REQUEST['bil_type']);

    $chk_exis = mysqli_query($Conn1,"select * from tbl_mint_app where case_id = ".$case_id." and app_bank_on = '".$app_bank_tw ."'");
    $result_chk_exis = mysqli_fetch_array($chk_exis);
    $exis_id = $result_chk_exis['id'];

    $mlc_product_id_qry = mysqli_query($Conn1,"select mlc_product_id from lms_loan_type where loan_type_id = '".$loan_type."'");
    $result_product_id = mysqli_fetch_array($mlc_product_id_qry);
    $mlc_product_id = $result_product_id['mlc_product_id'];

    if($mlc_product_id != '' && $mlc_product_id != 0 && $loan_type !=''&& $loan_type != 0){
        if(strlen($app_bank_tw) == 3){
            $app_bank_tw = $app_bank_tw;
        }else{
            $app_bank_tw = "0".$app_bank_tw;
        }
        $main_application_id = $appl_id_tw = $mlc_product_id.$loan_type.$app_bank_tw.$case_id;


        if(in_array($status_tw,array(2,3,4,5,6,7,9,10,11))){
            if($status_tw == 6 || $status_tw == 7){
                $m_app_id = $appl_id_tw;
                $last_disb_date_tw = $last_disb_date_tw;
                $disbursed_amount_tw = $disbursed_amount_tw;
                $first_disb_date_tw = $first_disb_date_tw;
            }else {
                $last_disb_date_tw = '';
                $disbursed_amount_tw = '';
                $first_disb_date_tw = '';
            }
            $sanctioned_amount_tw = $sanctioned_amount_tw;
            $sanction_date_tw = $sanction_date_tw;
        }else{
            if(in_array($status_tw,array(2,3,4,9,10,11))){
                $login_date_tw = $login_date_tw;
            }else{
                $login_date_tw = '';
            }
            $sanctioned_amount_tw = '';
            $first_disb_date_tw = '';
            $disbursed_amount_tw = '';
            $first_disb_date_tw = '';
            $last_disb_date_tw = '';
        }
        if($exis_id == 0 || $exis_id == ""){

            $qry_app_history = "insert into tbl_application_history set case_id = ".$case_id.",app_id= '".$appl_id_tw."',pre_login= '".$pre_status_tw."', post_login='".$status_tw."',date=CURDATE(),time=CURTIME(), user_id= '".$user."'";
            $insert_app_history = mysqli_query($Conn1,$qry_app_history);

            $qry_ins_fet = "insert into tbl_mint_app set query_id='".$query_id_tw."',app_created_by = '".$user."',property_status='".$property_status_tw."',case_id = ".$case_id.",app_id= '".$appl_id_tw."',app_bank_on = '".$app_bank_tw."',
		pre_login_status ='".$pre_status_tw."', loan_tenure_on='".$loan_tenure_tw."', fixed_tenure_on ='".$fixed_tenure_tw."', app_status_on ='".$status_tw."',
		follow_up_type_on ='".$follow_type_tw."', rate_type_on = '".$rate_type_tw."', rate_of_in_on = '".$rate_of_in_tw."', 
		sanction_date_on= '".$sanction_date_tw."', partner_on = '".$partner_tw."', applied_amount_on = '".$applied_amount_tw."', 
		sanctioned_amount_on ='".$sanctioned_amount_tw."', disbursed_amount_on = '".$disbursed_amount_tw."', follow_up_date_on = '".$follow_date_tw."', 
		first_disb_date_on = '".$first_disb_date_tw."', last_disb_date_on ='".$last_disb_date_tw."', bank_app_no_on = '".$bank_app_num_tw."',
		follow_up_time='".$fol_time_up_tw."', bank_crm_lead_on = '".$bank_crm_lead_tw."',source='2', cash_offers_on = '".$cash_offers_tw."',  
		login_date_on = '".$login_date_tw."',legal_ok = '".$legal_ok."',tech_ok = '".$tech_ok."',bil_type = '".$bil_type."',app_description= '".mysqli_real_escape_string($Conn1,$app_desc_tw)."',la_st_up_date = NOW(),date_created = CURDATE()";
            $insert_app = mysqli_query($Conn1,$qry_ins_fet) or die(mysqli_error($Conn1));
            if($status_tw == 7){
                $m_app_id = $appl_id_tw;
            }
        }
    }
}
include("../../include/footer_close.php");
print_r($_SESSION);
if($user == 173){
    $is_cashback_sent_email_sms = 1;
}
if($is_cashback_sent_email_sms == 1 && $status == 7){
    echo 'https://myloancrm.com/sugar/app/disbursement-email-sms.php?m_app='.$m_app_id.'&case_id='.$case_id;
    $data  = curl_get_helper('https://myloancrm.com/sugar/app/disbursement-email-sms.php?m_app='.$m_app_id.'&case_id='.$case_id);
    if($user == 173){
        print_r($data);
        die();
    }
}
$enc_cs = urlencode(base64_encode($case_id));
$enc_cust = urlencode(base64_encode($cust_id));
$enc_app_id = urlencode(base64_encode($main_application_id));
   echo "<script>window.location.href='edit_applicaton.php?case_id=$enc_cs&m_app=$m_app_id&cust_id=$enc_cust&loan_type=$loan_type&app_id=$enc_app_id&errmsg=edit sucessfully!&upated=1';</script>";
?>