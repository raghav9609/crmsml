<?php
require_once "../../include/config.php";

$loan_type = replace_special($_REQUEST['loan_type']);
$partner_id = replace_special($_REQUEST['partner_id']);
$mlc_crm_offers_arr = array("51", "54", "60");

$download_query = "SELECT * FROM bre_stp_decision AS bre WHERE bre.loan_type = " . $loan_type;

$download_query .= " ORDER BY bre.bank_name ";
$execute_query = mysqli_query($Conn1, $download_query) or die(mysqli_error($Conn1));

$download_data = [];

$filename = "BRE_Data_".date("YmdHis").".csv";
$fileop = fopen('php://output', 'a');
header('Content-type: application/csv');
header("Pragma: public");
header('Content-Disposition: attachment; filename='.$filename);

if(in_array($loan_type, $mlc_crm_offers_arr)) {
    $csv_title = array("Bank Name", "MLC Offers", "CRM Offers");
} else {
    $csv_title = array("Bank Name", "No Of Applications", "Disb. Applications Count", "Min Lead Score", "Max Lead Score", "Mean Lead Score", "Median Lead Score", "Cut of Score Top Decile", "Cut of Score Top Quatrile", "Cut of Score Top 50", "Cut of Score Top 80", "A2D Ratio (%)", "MLC Offers", "CRM Offers", "STP", "Offers on Site (Min)", "Offers on Site (Max)", "Offers on CRM (Min)", "Offers on CRM (Max)", "Score Slab 1 (From)", "Score Slab 1 (To)", "Score Slab 2 (From)", "Score Slab 2 (To)", "Score Slab 3 (From)", "Score Slab 3 (To)", "Approval Chance Slab 1 (From) %", "Approval Chance Slab 1 (To) %", "Approval Chance Slab 2 (From) %", "Approval Chance Slab 2 (To) %", "Approval Chance Slab 3 (From) %", "Approval Chance Slab 3 (To) %");
}

fputcsv($fileop, $csv_title);

while($result_query = mysqli_fetch_array($execute_query)) {
    $mlc_offers = "";
    if($result_query['is_offers_website'] == 0) {
        $mlc_offers = "No Apply Button";
    } else if($result_query['is_offers_website'] == 1) {
        $mlc_offers = "Apply Button with STP";
    }
    else if($result_query['is_offers_website'] == 2) {
        $mlc_offers = "Apply Button With pop Up";
    }
    else if($result_query['is_offers_website'] == 4) {
        $mlc_offers = "No offer Display";
    }
   
    $crm_offers = "";
    if($result_query['is_offers_crm'] == 1) {
        $crm_offers = "Apply Button with STP";
    } else if($result_query['is_offers_crm'] == 2) {
        $crm_offers = "Apply Button With pop Up";
    }else if($result_query['is_offers_crm'] == 0) {
        $crm_offers = "No Apply Button";
    }else if($result_query['is_offers_crm'] == 4) {
        $crm_offers = "No offer Display";
    }
    $bank_name_f = $result_query['bank_name'];
    if($result_query['bank_id'] == 23) {
        $bank_name_f = 'SCB';
    }

    $download_data = array();

    $download_data[] = $bank_name_f;
    if(!in_array($loan_type, $mlc_crm_offers_arr)) {
        $download_data[] = $result_query['no_of_applications'];
        $download_data[] = $result_query['no_of_disbursed_cases'];
        $download_data[] = $result_query['min_lead_score'];
        $download_data[] = $result_query['max_lead_score'];
        $download_data[] = $result_query['mean_score'];
        $download_data[] = $result_query['median_score'];
        $download_data[] = $result_query['cut_of_score_top_decile'];
        $download_data[] = $result_query['cut_of_score_top_quatrile'];
        $download_data[] = $result_query['cut_of_score_of_top_50'];
        $download_data[] = $result_query['cut_of_score_of_top_80'];
        $download_data[] = $result_query['a2d_ratio'];
    }
    
    $download_data[] = $mlc_offers;
    $download_data[] = $crm_offers;

    if(!in_array($loan_type, $mlc_crm_offers_arr)) {
        $download_data[] = $result_query['min_score_for_offer_on_site'];
        $download_data[] = $result_query['max_score_for_offer_on_site'];
        $download_data[] = $result_query['min_score_for_offer_on_crm'];
        $download_data[] = $result_query['max_score_for_offer_on_crm'];

        $download_data[] = $result_query['score_slab1_from'];
        $download_data[] = $result_query['score_slab1_to'];
        $download_data[] = $result_query['score_slab2_from'];
        $download_data[] = $result_query['score_slab2_to'];
        $download_data[] = $result_query['score_slab3_from'];
        $download_data[] = $result_query['score_slab3_to'];

        $download_data[] = $result_query['approval_chance_slab1'];
        $download_data[] = $result_query['approval_chance_slab1_to'];
        $download_data[] = $result_query['approval_chance_slab2'];
        $download_data[] = $result_query['approval_chance_slab2_to'];
        $download_data[] = $result_query['approval_chance_slab3'];
        $download_data[] = $result_query['approval_chance_slab3_to'];
    }

    fputcsv($fileop, $download_data);
}