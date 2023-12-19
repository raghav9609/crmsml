<?php
error_reporting(0);
ini_set('memory_limit', '512M');
ini_set('max_execution_time', '180');

require_once "../../include/check-session.php";
require_once "../../include/config.php";
require_once "../../include/helper.functions.php";


if($user_role == '1'){
    $phoneReq = 1;
}

$bank_rec               = replace_special($_POST['bank_rec']);
$partner                = replace_special($_POST['partnersearch']);
$date_from              = $_POST['date_from'];
$date_to                = $_POST['date_to'];
$from_loan_amount       = replace_special($_POST['from_loan_amount']);
$to_loan_amount         = replace_special($_POST['to_loan_amount']);
$loan_type              = replace_special($_POST['loan_type']);
$app_status_pre         = replace_special($_POST['app_status_pre']);
$app_status_post        = replace_special($_POST['app_status_post']);
$u_assign               = replace_special($_POST['u_assign']);
$from_sanctioned_amount = replace_special($_POST['from_sanctioned_amount']);
$to_sanctioned_amount   = replace_special($_POST['to_sanctioned_amount']);
$mobile_verify          = replace_special($_POST['mobile_verify']);

$app_new_status         = replace_special($_REQUEST['app_new_status']);
$sub_status             = replace_special($_REQUEST['sub_status']);
$sub_sub_status         = replace_special($_REQUEST['sub_sub_status']);

$date_difference = (strtotime($date_to) - strtotime($date_from))/60/60/24;

if($loan_type == '' || $date_from == '' || $date_to == '' || $date_difference > '31' ){
	exit;
} 

$query = "SELECT
            CUST.comp_id As COMP_ID,
            CUST.comp_name_other As COMP_OTHER,
            CUST.name As NAME,
            CUST.phone As PHONE,
            CUST.net_incm As NET_INCM,
            CUST.email As EMAIL,
            CUST.city_id AS CITY_ID,
			CUST.id AS CUSTOMER_ID,
            APP.case_id As CASE_ID,
            APP.bank_app_no_on As BANK_APP_NO,
            APP.bank_crm_lead_on As BANK_CRM_LEAD,
            APP.la_st_up_date As LA_ST_UP_DATE,
            APP.app_id As APP_ID,
            APP.applied_amount_on As APPLIED_AMOUNT_ON,
            APP.sanctioned_amount_on As SANCTIONED_AMOUNT_ON,
            APP.disbursed_amount_on  As DISBURSED_AMOUNT_ON,
            APP.login_date_on As LOGIN_DATE_ON,
            APP.sanction_date_on As SANCTION_DATE_ON,
            APP.first_disb_date_on As FIRST_DISB_DATE_ON,
            APP.date_created As CREATED_DATE,
            APP.con_call As CON_CALL,
            APP.app_description As APP_DESCRIPTION,
            APP.source As SOURCE,
            APP.flag_for_los As FLAG_FOR_LOS,
            APP.partner_on AS PARTNER_ID,
            APP.pre_login_status AS PRE_LOGIN_STATUS,
            APP.app_bank_on AS BANK_APPLY,
            APP.app_status_on AS POST_LOGIN,
            USER.user_name As USER_NAME,
            CSE.query_id As QUERY_ID,
            CSE.cust_id As CUST_ID,
            CSE.required_loan_amt As REQUIRED_LOAN_AMT,
            CSE.loan_type AS LOAN_TYPE_ID,
            QUERY_STATUS.verify_phone As VERIFY_PHONE,
            QUERY.page_url AS PAGE_URL,
            BONANZA.sent_flag AS SENT_FLAG,
            COMPANY.comp_name as COMPANY_NAME,
            CUST.comp_name_other as COMPANY_NAME_ORTHER,
            CUST.comp_id as COMPANY_ID,
            COMPANY.hdfc_bank_cat as HDFC_BANK_CAT,
            CSE.loan_nature as loan_nature,
			CSE.fos_user_id as fos_user_id,
            CSE.user_id as CRM_USER_ID,
            CSE.ni_user as NI_USER_ID,
			cst_info.totl_wrk_exp AS totl_wrk_exp,
            cst_info.salary_pay_id as salary_pay_id,
            bank.bank_name as slry_acc_bank,
            CUST.account_no as account_no,
            APP.sub_sub_status as sub_sub_status,
            cst_info.saving_accounts_with as saving_accounts_with,
            APP.rate_of_in_on as rate_of_in_on,
            APP.app_created_by as APP_CREATED_BY,
            CUST.dob AS DOB,
            QUERY.tool_type as TOOL_TYPE
            FROM tbl_mint_app As APP
            INNER JOIN tbl_mint_case As CSE ON APP.case_id = CSE.case_id
            INNER join tbl_mint_customer_info As CUST on CSE.cust_id = CUST.id
            LEFT join tbl_user_assign As USER on CSE.user_id = USER.user_id
            INNER JOIN tbl_mint_query_status_detail As QUERY_STATUS ON  CSE.query_id=QUERY_STATUS.query_id
            INNER JOIN tbl_mint_query As QUERY ON  QUERY.query_id=QUERY_STATUS.query_id
            LEFT JOIN tbl_cash_bonanza AS BONANZA ON BONANZA.app_id = APP.app_id
            LEFT JOIN pl_company as COMPANY ON CUST.comp_id = COMPANY.comp_id
			LEFT JOIN tbl_mint_cust_info_intt as cst_info ON CUST.id = cst_info.cust_id
            LEFT JOIN tbl_bank as bank ON CUST.bank_id = bank.bank_id
            where  APP.id > 0 ";
            if(in_array($app_status_post,array(3)) || in_array($app_new_status,array(1016))){
                if($date_from != ""){$query .= " AND APP.login_date_on >= '".$date_from."'";}
                if($date_to != ""){$query .= " AND APP.login_date_on <='".$date_to."'";}
                if($from_loan_amount != ""){$query .= " AND APP.applied_amount_on >= '".$from_loan_amount."'";}
                if($to_loan_amount != ""){$query .= " AND APP.applied_amount_on <= '".$to_loan_amount."'";}
            }else if(in_array($app_status_post,array(5)) || in_array($app_new_status,array(1017)) || in_array($sub_status,array(1094,1095,1096,1097))){
                if($date_from != ""){$query .= " AND APP.sanction_date_on >= '".$date_from."'";}
                if($date_to != ""){$query .= " AND APP.sanction_date_on <='".$date_to."'";}
                if($from_loan_amount != ""){$query .= " AND APP.sanctioned_amount_on >= '".$from_loan_amount."'";}
                if($to_loan_amount != ""){$query .= " AND APP.sanctioned_amount_on <= '".$to_loan_amount."'";}
            }else if(in_array($app_status_post,array(6,7)) || in_array($app_new_status,array(1019)) || in_array($sub_status,array(1098,1099))){
                if($date_from != ""){$query .= " AND APP.first_disb_date_on >= '".$date_from."'";}
                if($date_to != ""){$query .= " AND APP.first_disb_date_on <='".$date_to."'";}
                if($from_loan_amount != ""){$query .= " AND APP.disbursed_amount_on >= '".$from_loan_amount."'";}
                if($to_loan_amount != ""){$query .= " AND APP.disbursed_amount_on <= '".$to_loan_amount."'";}
            }else{
                if($date_from != ""){$query .= " AND APP.date_created >= '".$date_from."'";}
                if($date_to != ""){$query .= " AND APP.date_created <='".$date_to."'";}
                if($from_loan_amount != "" && $app_status_post != 3){$query .= " AND CASE.required_loan_amt >= '".$from_loan_amount."'";}
                if($to_loan_amount != "" && $app_status_post != 3){$query .= " AND CASE.required_loan_amt <= '".$to_loan_amount."'";}
            }
if($bank_rec[0] != ""){
    $query .= " AND APP.app_bank_on IN (".implode(",",$bank_rec).")";
}
if($partner != ""){
    $query .= " AND APP.partner_on = '".$partner."'";
}
if($loan_type != ""){
    if(in_array($loan_type,array(51,52,54))){
        $query .= " AND CSE.loan_type IN (".$loan_type.",58)";
    }else{
        $query .= " AND CSE.loan_type = '".$loan_type."'";
    }
    
}
if($app_status_post != ""){
    $query .= " AND APP.app_status_on = '".$app_status_post."'";
}
if($app_status_pre != ""){
    $query .= " AND APP.pre_login_status = '".$app_status_pre."'";
}

if($app_new_status != "") {
    $default = 1;
    if($sub_sub_status > 0) {
        if(in_array($app_new_status, array(1013, 1014))) {
            $query .= " AND APP.pre_login_status = $app_new_status AND find_in_set('".$sub_sub_status."', APP.other_status) ";
        } else {
            $query .= " and APP.sub_sub_status = $sub_sub_status ";
        }
    } else if($sub_status > 0) {
        $query .= " AND APP.app_status_on = $sub_status ";
    } else {
        $query .= " AND APP.pre_login_status = $app_new_status ";
    }
}

if($u_assign != ""){
    $query .= " AND CSE.user_id = '".$u_assign."'";
}
if($from_sanctioned_amount!= ""){
    $query .= " AND APP.sanctioned_amount_on >= '".$from_sanctioned_amount."'";
}
if($to_sanctioned_amount!= ""){
    $query .= " AND APP.sanctioned_amount_on <= '".$to_sanctioned_amount."'";
}
if($mobile_verify != ""){
    $query .= " AND QUERY_STATUS.verify_phone = '".$mobile_verify."'";
}
$query .= " GROUP BY APP.app_id order by APP.app_id";


$insert_qry = mysqli_query($Conn1,"Insert into report_download_cron set query_to_download = '".base64_encode($query)."', level='3', loan_filter='".$loan_type."', date_filter='".$date_from." - ".$date_to."',user_id='".$user."',user_role='".$user_role."',cron_status = '0',date=NOW()");

header("location:report.php?msg=1&app_new_status=$app_new_status&sub_status=$sub_status&sub_sub_status=$sub_sub_status");
include("../../include/footer_close.php");
?>