<?php
require_once "../../include/check-session.php";
require_once "../../include/config.php";
require_once "../../include/display-name-functions.php";

$page = replace_special($_POST['page']);
$cust_id = replace_special($_POST['cust_id']);
$app_bank_one = replace_special($_POST['app_bank_one']);
$status_on = replace_special($_POST['status_on']);
$ltcr_on = replace_special($_POST['ltcr_on']);
$follow_date_on = replace_special($_POST['follow_date_on']);
$follow_type_on = replace_special($_POST['follow_type_on']);
$partner_on = replace_special($_POST['partner_on']);
$applied_amount_on = replace_special($_POST['applied_amount_on']);
$login_date_on = replace_special($_POST['login_date_on']);
$sanction_date_on = replace_special($_POST['sanction_date_on']);
$sanctioned_amount_on = replace_special($_POST['sanctioned_amount_on']);
$loan_tenure_on = replace_special($_POST['loan_tenure_on']);
$rate_type_on = replace_special($_POST['rate_type_on']);
$fixed_tenure_on = replace_special($_POST['fixed_tenure_on']);
$disbursed_amount_on = replace_special($_POST['disbursed_amount_on']);
$first_disb_date_on = replace_special($_POST['first_disb_date_on']);
$last_disb_date_on = replace_special($_POST['last_disb_date_on']);
$rate_of_in_on = replace_special($_POST['rate_of_in_on']);
$builder_name = replace_special($_POST['builder_name']);
$other_builder_name = replace_special($_POST['other_builder_name']);
$project_name = replace_special($_POST['prjct_name']);
$other_prjct_name = replace_special($_POST['other_prjct_name']);
$existing_emi = replace_special($_POST['existing_emi']);
$patnername = replace_special($_POST['patnername']);
$pincode = replace_special($_POST['pincode']);
$partner_id = implode('/',$patnername);
$case_id = replace_special($_POST['case_id']);
$loan_type = replace_special($_POST['loan_type']);
$bank_app_num_on = replace_special($_POST['bank_app_num_on']);
$cash_offers_on = replace_special($_POST['cash_offers_on']);
$bank_crm_lead_on = replace_special($_POST['bank_crm_lead_on']);
$pre_status_on = replace_special($_POST['pre_status_on']);
$description_on = replace_special($_POST['description_on']);
$follow_time_on = replace_special($_POST['follow_time_on']);
$fol_time_up = date('H:i:s', strtotime($follow_time_on)); 
$mlc_product_id = get_display_name("mlc_product_id",$loan_type);
if($mlc_product_id != '' && $mlc_product_id != 0 && $loan_type !=''&& $loan_type != 0){    
     if(strlen($app_bank_one) == 3){
            $app_bank_one = $app_bank_one;
    }else{
            $app_bank_one = "0".$app_bank_one;
    }
    $app_id_on = $mlc_product_id.$loan_type.$app_bank_one.$case_id;

$chk_exis = mysqli_query($Conn1,"select * from tbl_mint_app where case_id = ".$case_id." and app_bank_on = '".$app_bank_one ."'");
$result_chk_exis = mysqli_fetch_array($chk_exis);
$exis_id = $result_chk_exis['id'];
if($exis_id == 0 || $exis_id == "") {
    $qry_app_history = "insert into tbl_application_history set case_id = '" . $case_id . "',app_id= '" . $app_id_on . "',pre_login= '" . $pre_status_on . "',post_login='" . $status_on . "',date=CURDATE(),time=CURTIME(), user_id= '" . $user . "'";
    $insert_app_history = mysqli_query($Conn1,$qry_app_history);

  $qry_app_on = "INSERT INTO tbl_mint_app(`app_id`,`case_id`,`app_bank_on`,`app_status_on`,`follow_up_date_on`,`follow_up_type_on`,`partner_on`,`applied_amount_on`,`login_date_on`,`sanctioned_amount_on`,`sanction_date_on`,`loan_tenure_on`,`rate_type_on`,`fixed_tenure_on`,`disbursed_amount_on`,`first_disb_date_on`,`last_disb_date_on`,`rate_of_in_on`,`bank_app_no_on`,`bank_crm_lead_on`,`cash_offers_on`,`la_st_up_date`,`date_created`,`pre_login_status`,`app_description`,`source`,`follow_up_time`,app_created_by) 
VALUES ('" . $app_id_on . "','" . $case_id . "','" . $app_bank_one . "','" . $status_on . "','" . $follow_date_on . "','" . $follow_type_on . "','" . $partner_on . "','" . $applied_amount_on . "','" . $login_date_on . "','" . $sanctioned_amount_on . "','" . $sanction_date_on . "','" . $loan_tenure_on . "','" . $rate_type_on . "','" . $fixed_tenure_on . "','" . $disbursed_amount_on . "','" . $first_disb_date_on . "','" . $last_disb_date_on . "','" . $rate_of_in_on . "','" . $bank_app_num_on . "','" . $bank_crm_lead_on . "','" . $cash_offers_on . "', NOW(), NOW(),'" . $pre_status_on . "','" . $description_on . "','2','".$fol_time_up."','".$user."')";
    $res_app_on = mysqli_query($Conn1,$qry_app_on);

    $select_app_qry = mysqli_query($Conn1,"select * from tbl_mint_app where case_id = '" . $case_id . "'");
    $result_app_qry = mysqli_fetch_array($select_app_qry);
    $m_app_id = $result_app_qry['app_id'];

    if ($status_on == 6 || $status_on == 7) { 
        $m_app_id = $m_app_id;
    } else {
        $m_app_id = "";
    }
}
}
include("../../include/footer_close.php"); 
$enc_cs = urlencode(base64_encode($case_id));
$enc_cust = urlencode(base64_encode($cust_id));
header("Location:edit_applicaton.php?case_id=$enc_cs&m_app=$m_app_id&cust_id=$enc_cust&loan_type=$loan_type&errmsg=Created sucessfully!");
?>