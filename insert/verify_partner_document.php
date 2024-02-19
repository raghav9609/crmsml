<?php
$slave =1;
require_once "../../include/check-session.php";
require_once "../../include/config.php";

$cust_id = base64_decode($_REQUEST['cust_id']);

$return_arr = array();
$tata_bank_id = "79";
$tata_pat_id = "49";
$hdfc_pat_id = "27";
$case_id = $_REQUEST['case_id'];
$kotak_pat_id = "24";

$api_version = "";
$api_version_query = mysqli_query($Conn1, "SELECT id, app_id, app_bank_on, api_version FROM tbl_mint_app WHERE case_id = '".$case_id."' AND app_bank_on = '".$tata_bank_id."' ORDER BY id DESC LIMIT 0, 1 ");
if(mysqli_num_rows($api_version_query) > 0) {
    $api_version_res    = mysqli_fetch_array($api_version_query);
    $app_id             = $api_version_res['app_id'];
    $tata_status_query  = "SELECT status_id FROM api_helper WHERE application_id ='".$app_id."' AND rule_id = 55 ORDER BY helper_id DESC LIMIT 0, 1";
    $tata_status_exe    = mysqli_query($Conn1, $tata_status_query);
    if(mysqli_num_rows($tata_status_exe) > 0) {
        $tata_status_res = mysqli_fetch_array($tata_status_exe);
        if($tata_status_res['status_id'] == 7) {
            $api_version = $api_version_res['api_version'];
        }
    }
}

if($api_version == 2) {
    $return_arr['tata_status'] = 2;             //do not show file upload url
} else if($api_version == 3) {
    $get_tata_docs = mysqli_query($Conn1, "SELECT cust_doc_id FROM customer_document WHERE cust_id = '".$cust_id."' AND partner_id = '".$tata_pat_id."' ");
    if(mysqli_num_rows($get_tata_docs) > 0) {
        $return_arr['tata_status'] = 1;        //found      - docs for tata
    } else {
        $return_arr['tata_status'] = 3;        //missing    - docs for tata
    }
}

$hdfc_doc_check_query = "SELECT cust_doc_id FROM customer_document WHERE cust_id = '".$cust_id."' AND partner_id = '".$hdfc_pat_id."' ";
$hdfc_doc_check_exe = mysqli_query($Conn1, $hdfc_doc_check_query);
if(mysqli_num_rows($hdfc_doc_check_exe) > 0) {
    $return_arr['hdfc_status'] = 1;             //found     - docs for hdfc
} else {
    $return_arr['hdfc_status'] = 3;             //missing   - docs for hdfc
}

$kotak_doc_check_query = "SELECT id, app_id, app_bank_on, api_version, bank_crm_lead_on, doc_upload_ref_code FROM tbl_mint_app WHERE case_id = '".$case_id."' AND app_bank_on = '16' AND bank_crm_lead_on != '' AND doc_upload_ref_code != '' AND api_version != 3 ORDER BY id DESC LIMIT 0, 1";
$kotak_doc_check_exe = mysqli_query($Conn1, $kotak_doc_check_query);
if(mysqli_num_rows($kotak_doc_check_exe) > 0) {
    $kotak_cust_doc_query = "SELECT cust_doc_id FROM customer_document WHERE cust_id = '".$cust_id."' AND partner_id = '".$kotak_pat_id."' ";
    $kotak_cust_doc_exe = mysqli_query($Conn1, $kotak_cust_doc_query);
    $kotak_cust_doc_res = mysqli_fetch_array($kotak_doc_check_exe);
    if(mysqli_num_rows($kotak_cust_doc_exe) > 0) {
        $return_arr['kotak_status'] = 1;            //found - docs for kotak
    } else {
        $return_arr['kotak_status'] = 3;            //missing - docs for kotak
        $return_arr['kotak_app_id'] = base64_encode($kotak_cust_doc_res['bank_crm_lead_on']);
        $return_arr['kotak_ref_code'] = base64_encode($kotak_cust_doc_res['doc_upload_ref_code']);
    }
}

echo json_encode($return_arr);
