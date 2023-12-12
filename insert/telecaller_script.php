<br>
<?php
$final_script = "";

$lang_type      = "";
$agent_name     = "";
$agent_emp_code = "";

$result_hindi   = "";
$result_english = "";

$tc_loan_nature_id = 0;
$tc_tool_type_id = 0;

if($loan_type == 54 || $loan_type == 52) {
    $loan_type_script = 51;
} else if($loan_type == 11) {
    $loan_type_script = 63;
} else {
    $loan_type_script = $loan_type;
}

$agent_name_exe = mysqli_query($Conn1, "SELECT user_name, user_employee_code FROM tbl_user_assign WHERE user_id = $user limit 0, 1 ");
if(mysqli_num_rows($agent_name_exe) > 0) {
    $agent_name_res     = mysqli_fetch_array($agent_name_exe);
    $agent_name         = $agent_name_res['user_name'];
    $agent_emp_code     = $agent_name_res['user_employee_code']; 
}

$occupation_name = "";
$occupation_name_exe = mysqli_query($Conn1, "SELECT occupation_name FROM lms_occupation WHERE occupation_id = $occup");
if(mysqli_num_rows($occupation_name_exe) > 0) {
    $occupation_name_res = mysqli_fetch_array($occupation_name_exe);
    $occupation_name = $occupation_name_res['occupation_name'];
}

$existing_bank = "";
if(!empty($exstn_bank)) {
    $exstn_bank_name    = mysqli_query($Conn1, "SELECT bank_id, bank_name FROM tbl_bank WHERE bank_id = '".$exstn_bank."' ");
    $existing_bank      = mysqli_fetch_array($exstn_bank_name)['bank_name'];
}
$business_type_name = "";
if(!empty($business_type)) {
    $business_type_exe  = mysqli_query($Conn1, "SELECT bus_type_id, bus_type_name FROM tbl_bussiness_type WHERE bus_type_id = '".$business_type."' ");
    $business_type_name = mysqli_fetch_array($business_type_exe)['bus_type_name'];
}
$professional_type_name = "";
if(!empty($prof_id)) {
    $professional_type_exe  = mysqli_query($Conn1, "SELECT profession_id, profession_name FROM lms_profession WHERE profession_id = '".$prof_id."' ");
    $professional_type_name = mysqli_fetch_array($professional_type_exe)['profession_name'];
}
$property_type = "";
if(!empty($prop_sale_type)) {
    $property_type_exe  = mysqli_query($Conn1, "SELECT property_type_id, property_type_name FROM lms_property_type WHERE property_type_id = '".$prop_sale_type."' ");
    $property_type      = mysqli_fetch_array($property_type_exe)['property_type_name'];
}
$annual_turnover = "";
if(!empty($bs_anl_turn)) {
    $annual_turnover_exe    = mysqli_query($Conn1, "SELECT bus_anl_id,bus_anl_name FROM tbl_bussiness_anl_trunover WHERE bus_anl_id = '".$bs_anl_turn."' ");
    $annual_turnover        = mysqli_fetch_array($annual_turnover_exe)['bus_anl_name'];
}
$business_existing = "";
if(!empty($bs_ext_yr)) {
    $business_existing_exe  = mysqli_query($Conn1, "SELECT bus_ext_year_id, bus_ext_year_name FROM tbl_bussiness_extng_year WHERE bus_ext_year_id = '".$bs_ext_yr."' ");
    $business_existing      = mysqli_fetch_array($business_existing_exe)['bus_ext_year_name'];
}

if($user_role != '') {

    $telecallers_script = "";
    if($tool_type == "Cross Sell - Auto"){
        $telecallers_script_query = "SELECT crosssell.id";
        if($occup == 2 || $occup ==3){
            $telecallers_script_query .= ",crosssell.tc_sep_script_english as description";
        }else{
            $telecallers_script_query .= ",crosssell.tc_salaried_script_english as description";
        }
        $telecallers_script_query .= ",qry.level_id,qry.lead_id from query_lead_upload as qry INNER JOIN cross_sell_criteria as crosssell ON qry.cross_sell_criteria_id = crosssell.id where 
        qry.new_lead_id ='".$id."' order by qry.id DESC limit 1";
    }else{
        $telecallers_script_query = "SELECT id, description FROM loan_type_telecaller_file_upload WHERE loan_type = '".$loan_type_script."' AND lang_id = 2  ";
        if($loan_type_script != '60' && $loan_type_script != '51' && $loan_type_script != '57' && $loan_type_script != '56') {
            $telecallers_script_query .= " AND occup_id = '".$occup."'";
        }
        if($loan_type_script == 56 && $tool_type == "Eligibility Form") {
            $telecallers_script_query .= " AND tool_type_id = 5 ";
        } else if($loan_type_script == 56 && $tool_type == "Referral Form") {
            $telecallers_script_query .= " AND tool_type_id = 11 ";
        } else if($loan_type_script == 56 && $loan_nature == "2") {
            $telecallers_script_query .= " AND loan_nature_id = 2 ";
        } else if($loan_type_script == 56) {
            $telecallers_script_query .= " AND loan_nature_id != 2 AND tool_type_id NOT IN (5, 11) ";
        }

        if($loan_type_script == 51 && $tool_type == "Eligibility Form" && $occup == 1) {
            $telecallers_script_query .= " AND tool_type_id = 5 AND occup_id = 1 ";
        } else if($loan_type_script == 51 && $tool_type == "Eligibility Form" && ($occup == 2 || $occup == 3)) {
            $telecallers_script_query .= " AND tool_type_id = 5 AND (occup_id = 2 OR occup_id = 3) ";
        } else if($loan_type_script == 51 && $loan_nature == "2" && $occup == "1") {
            $telecallers_script_query .= " AND loan_nature_id = 2 AND occup_id = 1 ";
        } else if($loan_type_script == 51 && $loan_nature == "2" && ($occup == "2" || $occup == "3")) {
            $telecallers_script_query .= " AND loan_nature_id = 2 AND (occup_id = 2 OR occup_id = 3) ";
        } else if($loan_type_script == 51 && $tool_type == "Referral Form") {
            $telecallers_script_query .= " AND tool_type_id = 11 ";
        } else if($loan_type_script == 51 &&  $tool_type == "Eligibility Form") {
            $telecallers_script_query .= " AND tool_type_id = 5 ";
        } else if($loan_type_script == 51 && $occup == 1) {
            $telecallers_script_query .= " AND loan_nature_id != 2 AND tool_type_id NOT IN (5, 11) AND occup_id = 1 ";
        } else if($loan_type_script == 51 && ($occup == 2 || $occup == 3)) {
            $telecallers_script_query .= " AND loan_nature_id != 2 AND tool_type_id NOT IN (5, 11) AND (occup_id = 2 OR occup_id = 3) ";
        } else if($loan_type_script == 51) {
            $telecallers_script_query .= " AND loan_nature_id != 2 AND tool_type_id NOT IN (5, 11) ";
        }

        if($loan_type_script == 71 && $occup == 1) {
            $telecallers_script_query .= " AND occup_id = 1 ";
        } else if($loan_type_script == 71 && $occup == 2) {
            $telecallers_script_query .= " AND occup_id = 2 ";
        } else if($loan_type_script == 71 && $occup == 3) {
            $telecallers_script_query .= " AND occup_id = 3 ";
        }

        // if($loan_type_script == 57 && $tool_type == "Referral Form") {
        //     $telecallers_script_query .= " AND tool_type_id = 11 ";
        // } else if($loan_type_script == 57 && $occup == 2) {
        //     $telecallers_script_query .= " AND occup_id = 2 ";
        // } else if($loan_type_script == 57 && $occup == 3) {
        //     $telecallers_script_query .= " AND occup_id = 3 ";
        // }
        if($loan_type_script == 57 && $tool_type == "Referral Form" && $occup == 3) {
            $telecallers_script_query .= " AND tool_type_id = 11 AND occup_id = 3 ";
        } else if($loan_type_script == 57 && $occup == 3) {
            $telecallers_script_query .= " AND occup_id = 3 AND tool_type_id != 11 ";
        }

        if($loan_type_script == 63 && $tool_type == "Referral Form" && $occup == 2) {
            $telecallers_script_query .= " AND tool_type_id = 11 AND occup_id = 2 ";
        } else if($loan_type_script == 63 && $occup == 2) {
            $telecallers_script_query .= " AND occup_id = 2 AND tool_type_id != 11 ";
        }

        if($loan_type_script == 60 && $tool_type == "Eligibility Form") {
            $telecallers_script_query .= " AND tool_type_id = 5 ";
        } else if($loan_type_script == 60 && $tool_type == "Referral Form") {
            $telecallers_script_query .= " AND tool_type_id = 11 ";
        } else if($loan_type_script == 60) {
            $telecallers_script_query .= " AND tool_type_id NOT IN (5, 11) ";
        }

        $telecallers_script_query .= " ORDER BY id DESC LIMIT 0, 1 ";
}

    $telecallers_script_exe = mysqli_query($Conn1, $telecallers_script_query);
    if(mysqli_num_rows($telecallers_script_exe) > 0) {
        $telecallers_script_res = mysqli_fetch_array($telecallers_script_exe);
        if($tool_type == 'Cross Sell - Auto'){
            $telecallers_script     = htmlentities(urldecode($telecallers_script_res['description']));
            if($telecallers_script_res['level_id'] == 3 && $telecallers_script_res['lead_id'] > 0){
                $get_bank_name_qry = mysqli_query($Conn1,"select bank_name from tbl_mint_app as ap INNER JOIN tbl_bank as bank ON ap.app_bank_on = bank.bank_id where ap.app_id = '".$telecallers_script_res['lead_id']."' limit 1");
                if(mysqli_num_rows($get_bank_name_qry) > 0){
                    $result_app_bank_name = mysqli_fetch_assoc($get_bank_name_qry);
                    $application_bank_english = $result_app_bank_name['bank_name'];
                }
            }
        }else{
            $telecallers_script     = htmlentities(urldecode(base64_decode($telecallers_script_res['description'])));
        }
        
        $lang_type              = "Hindi";                 //English
    }
    $final_telecallers_script = "";

    $greeting = "";
    $time = date("H");
    if($time < "12") {
        $greeting = "Morning";
    } else if($time >= "12" && $time < "16") {
        $greeting = "Afternoon";
    } else if($time >= "16" && $time < "20") {
        $greeting = "Evening";
    }
    
    //follow_up_time
    $customer_company = ($comp_name != "") ? $comp_name : $comp_name_other;

    $salu_label = "Mr./Ms.";
    $salu_label_other = "Sir/Ma'am";
    if($salu_id == 1) {
        $salu_label = "Mr.";
        $salu_label_other = "Sir";
    } else if($salu_id == 2) {
        $salu_label = "Ms.";
        $salu_label_other = "Ma'am";
    }

    $referral_cust_name = ($ref_mobile != "" && $ref_mobile != 0 ? $ref_mobile : "Other Customer");
    $referral_salutation = "Mr./Ms.";
    $referral_salutation_other = "he/she";

    $referral_loan_type = "Loan";

    if($ref_mobile != '' && $ref_mobile != 0) {
        $query_refer_name = "SELECT id, name, lname, phone, salu_id FROM tbl_mint_customer_info WHERE id='".$ref_mobile."' ORDER BY id DESC LIMIT 0, 1 ";
        $get_refer_cust_name    = mysqli_query($Conn1, $query_refer_name);
        if(mysqli_num_rows($get_refer_cust_name) > 0) {
            $result_refer_cust_name = mysqli_fetch_array($get_refer_cust_name);
            $referral_cust_name     = $result_refer_cust_name['name'] . " " . $result_refer_cust_name['lname'];
            $referral_salu          = $result_refer_cust_name['salu_id'];
            $referral_cust_id       = $result_refer_cust_name['id'];
            if($referral_salu == 1) {
                $referral_salutation = "Mr.";
                $referral_salutation_other = "he";
            } else if($referral_salu == 2) {
                $referral_salutation = "Ms.";
                $referral_salutation_other = "she";
            }

            $referral_loan_query = mysqli_query($Conn1, "SELECT tbl_mint_query.query_id AS query_id, lms_loan_type.loan_type_name AS loan_type_name FROM tbl_mint_query INNER JOIN lms_loan_type ON lms_loan_type.loan_type_id = tbl_mint_query.loan_type WHERE cust_id = '".$referral_cust_id."' ORDER BY id DESC LIMIT 0, 1 ");
            if(mysqli_num_rows($referral_loan_query) > 0) {
                $referral_loan_result = mysqli_fetch_array($referral_loan_query);
                $referral_loan_type = $referral_loan_result['loan_type_name'];
            }
        }
    }


    $final_telecallers_script = replace($telecallers_script, ['greeting' => $greeting, 'loan_amount' => "<label class='fw_bold'>".custom_money_format($loan_amt)."</label>", 'loan_type' => "<label class='fw_bold'>".$loantype_name."</label>", 'cust_first_name' => "<label class='fw_bold'>".$name."</label>", "agent_name" => "<label class='fw_bold'>".$agent_name."</label>", 'salutation' => $salu_label, 'salutation_other' => $salu_label_other, 'occupation' => "<label class='fw_bold'>".$occupation_name."</label>", 'referral_cust_name' => "<label class='fw_bold'>".$referral_cust_name."</label>", 'referral_salutation' => $referral_salutation, 'referral_salutation_other' => $referral_salutation_other, 'referral_loan_type' => "<label class='fw_bold'>".$referral_loan_type."</label>", 'monthly_income' => "<label class='fw_bold'>".$net_incm."</label>", 'company' => "<label class='fw_bold'>".$customer_company."</label>", 'existing_loan_amount' => "<label class='fw_bold'>".$top_loan_amt."</label>", 'rate_of_interest' => "<label class='fw_bold'>".$cur_rate."</label>",'disbursed_bank_name'=>$application_bank_english,'sanctioned_bank_name'=>$application_bank_english, 'existing_bank_name' => "<label class='fw_bold'>".$existing_bank."</label>", 'profit_amount' => "<label class='fw_bold'>".$profit_itr_amt."</label>", 'business_type' => "<label class='fw_bold'>".$business_type_name."</label>", "gross_amount" => "<label class='fw_bold'>".$gross_annual_receipt."</label>", 'professional_type' => "<label class='fw_bold'>".$professional_type_name."</label>", 'property_type' => "<label class='fw_bold'>".$property_type."</label>", 'annual_turnover' => "<label class='fw_bold'>".$annual_turnover."</label>", 'business_tenure' => "<label class='fw_bold'>".$business_existing."</label>", "emp_id" => "<label class='fw_bold'>".$agent_emp_code."</label>"]);
    
    if(trim($final_telecallers_script) != "") {
        $result_english .= "<table><tr><td><pre style='white-space: pre-wrap; word-wrap: break-word; '>$final_telecallers_script</pre></td></tr></table>";
    }

    //Hindi Script
    if($tool_type == "Cross Sell - Auto"){
        $hin_telecallers_script_query = "SELECT crosssell.id";
        if($occup == 2 || $occup == 3){
            $hin_telecallers_script_query .= ",tc_sep_script_hindi as description";
        }else{
            $hin_telecallers_script_query .= ",crosssell.tc_salaried_script_hindi as description";
        }
        $hin_telecallers_script_query .= ",qry.level_id,qry.lead_id from query_lead_upload as qry INNER JOIN cross_sell_criteria as crosssell ON qry.cross_sell_criteria_id = crosssell.id where 
        qry.new_lead_id ='".$id."' order by qry.id DESC limit 1";
    }else{
    $hin_telecallers_script_query = "SELECT id, description FROM loan_type_telecaller_file_upload WHERE loan_type = '".$loan_type_script."'  and lang_id = 1 ";
    if($loan_type_script != '60' && $loan_type_script != '51' && $loan_type_script != '57' && $loan_type_script != '56') {
        $hin_telecallers_script_query .= " and occup_id = '".$occup."'";
    }
    if($loan_type_script == 56 && $tool_type == "Eligibility Form") {
        $hin_telecallers_script_query .= " AND tool_type_id = 5 ";
    } else if($loan_type_script == 56 && $tool_type == "Referral Form") {
        $hin_telecallers_script_query .= " AND tool_type_id = 11 ";
    } else if($loan_type_script == 56 && $loan_nature == "2") {
        $hin_telecallers_script_query .= " AND loan_nature_id = 2 ";
    } else if($loan_type_script == 56) {
        $hin_telecallers_script_query .= " AND loan_nature_id != 2 AND tool_type_id NOT IN (5, 11) ";
    }

    if($loan_type_script == 51 && $tool_type == "Eligibility Form" && $occup == 1) {
        $hin_telecallers_script_query .= " AND tool_type_id = 5 AND occup_id = 1 ";
    } else if($loan_type_script == 51 && $tool_type == "Eligibility Form" && ($occup == 2 || $occup == 3)) {
        $hin_telecallers_script_query .= " AND tool_type_id = 5 AND (occup_id = 2 OR occup_id = 3) ";
    } else if($loan_type_script == 51 && $loan_nature == "2" && $occup == "1") {
        $hin_telecallers_script_query .= " AND loan_nature_id = 2 AND occup_id = 1 ";
    } else if($loan_type_script == 51 && $loan_nature == "2" && ($occup == "2" || $occup == "3")) {
        $hin_telecallers_script_query .= " AND loan_nature_id = 2 AND (occup_id = 2 OR occup_id = 3) ";
    } else if($loan_type_script == 51 && $tool_type == "Referral Form") {
        $hin_telecallers_script_query .= " AND tool_type_id = 11 ";
    } else if($loan_type_script == 51 &&  $tool_type == "Eligibility Form") {
        $hin_telecallers_script_query .= " AND tool_type_id = 5 ";
    } else if($loan_type_script == 51 && $occup == 1) {
        $hin_telecallers_script_query .= " AND loan_nature_id != 2 AND tool_type_id NOT IN (5, 11) AND occup_id = 1 ";
    } else if($loan_type_script == 51 && ($occup == 2 || $occup == 3)) {
        $hin_telecallers_script_query .= " AND loan_nature_id != 2 AND tool_type_id NOT IN (5, 11) AND (occup_id = 2 OR occup_id = 3) ";
    } else if($loan_type_script == 51) {
        $hin_telecallers_script_query .= " AND loan_nature_id != 2 AND tool_type_id NOT IN (5, 11) ";
    }

    if($loan_type_script == 71 && $occup == 1) {
        $hin_telecallers_script_query .= " AND occup_id = 1 ";
    } else if($loan_type_script == 71 && $occup == 2) {
        $hin_telecallers_script_query .= " AND occup_id = 2 ";
    } else if($loan_type_script == 71 && $occup == 3) {
        $hin_telecallers_script_query .= " AND occup_id = 3 ";
    }

    // if($loan_type_script == 57 && $tool_type == "Referral Form") {
    //     $hin_telecallers_script_query .= " AND tool_type_id = 11 ";
    // } else if($loan_type_script == 57 && $occup == 2) {
    //     $hin_telecallers_script_query .= " AND occup_id = 2 ";
    // } else if($loan_type_script == 57 && $occup == 3) {
    //     $hin_telecallers_script_query .= " AND occup_id = 3 ";
    // }
    if($loan_type_script == 57 && $tool_type == "Referral Form" && $occup == 3) {
        $hin_telecallers_script_query .= " AND tool_type_id = 11 AND occup_id = 3 ";
    } else if($loan_type_script == 57 && $occup == 3) {
        $hin_telecallers_script_query .= " AND occup_id = 3 AND tool_type_id != 11 ";
    }

    if($loan_type_script == 63 && $tool_type == "Referral Form" && $occup == 2) {
        $hin_telecallers_script_query .= " AND tool_type_id = 11 AND occup_id = 2 ";
    } else if($loan_type_script == 63 && $occup == 2) {
        $hin_telecallers_script_query .= " AND occup_id = 2 AND tool_type_id != 11 ";
    }

    if($loan_type_script == 60 && $tool_type == "Eligibility Form") {
        $hin_telecallers_script_query .= " AND tool_type_id = 5 ";
    } else if($loan_type_script == 60 && $tool_type == "Referral Form") {
        $hin_telecallers_script_query .= " AND tool_type_id = 11 ";
    } else if($loan_type_script == 60) {
        $hin_telecallers_script_query .= " AND tool_type_id NOT IN (5, 11) ";
    }

    $hin_telecallers_script_query .= " ORDER BY id DESC limit 0, 1 ";
}

    $hin_telecallers_script_exe = mysqli_query($Conn1, $hin_telecallers_script_query);
    $hin_telecallers_script = "";
    if(mysqli_num_rows($hin_telecallers_script_exe) > 0) {
        $hin_telecallers_script_res = mysqli_fetch_array($hin_telecallers_script_exe);
        if($tool_type == 'Cross Sell - Auto'){
            $hin_telecallers_script     = htmlentities(urldecode($hin_telecallers_script_res['description']));
            if($hin_telecallers_script_res['level_id'] == 3 && $hin_telecallers_script_res['lead_id'] > 0){
                $get_bank_name_qry = mysqli_query($Conn1,"select bank_name from tbl_mint_app as ap INNER JOIN tbl_bank as bank ON ap.app_bank_on = bank.bank_id where ap.app_id = '".$hin_telecallers_script_res['lead_id']."' limit 1");
                if(mysqli_num_rows($get_bank_name_qry) > 0){
                    $result_app_bank_name = mysqli_fetch_assoc($get_bank_name_qry);
                    $application_bank_hindi = $result_app_bank_name['bank_name'];
                }
            }
        }else{
            $hin_telecallers_script     = htmlentities(urldecode(base64_decode($hin_telecallers_script_res['description'])));
        
        }
        $lang_type                  = "English";             //Hindi
    }
    $hin_final_telecallers_script   = "";

    $hin_final_telecallers_script = replace($hin_telecallers_script, ['greeting' => $greeting, 'loan_amount' => "<label class='fw_bold'>".custom_money_format($loan_amt)."</label>", 'loan_type' => "<label class='fw_bold'>".$loantype_name."</label>", 'cust_first_name' => "<label class='fw_bold'>".$name."</label>", "agent_name" => "<label class='fw_bold'>".$agent_name."</label>", 'salutation' => $salu_label, 'salutation_other' => $salu_label_other, 'occupation' => "<label class='fw_bold'>".$occupation_name."</label>", 'referral_cust_name' => "<label class='fw_bold'>".$referral_cust_name."</label>", 'referral_salutation' => $referral_salutation, 'referral_salutation_other' => $referral_salutation_other, 'referral_loan_type' => "<label class='fw_bold'>".$referral_loan_type."</label>", 'monthly_income' => "<label class='fw_bold'>".$net_incm."</label>", 'company' => "<label class='fw_bold'>".$customer_company."</label>", 'existing_loan_amount' => "<label class='fw_bold'>".$top_loan_amt."</label>", 'rate_of_interest' => "<label class='fw_bold'>".$cur_rate."</label>",'disbursed_bank_name'=>$application_bank_hindi,'sanctioned_bank_name'=>$application_bank_hindi, 'existing_bank_name' => "<label class='fw_bold'>".$existing_bank."</label>", 'profit_amount' => "<label class='fw_bold'>".$profit_itr_amt."</label>", 'business_type' => "<label class='fw_bold'>".$business_type_name."</label>", "gross_amount" => "<label class='fw_bold'>".$gross_annual_receipt."</label>", 'professional_type' => "<label class='fw_bold'>".$professional_type_name."</label>", 'property_type' => "<label class='fw_bold'>".$property_type."</label>", 'annual_turnover' => "<label class='fw_bold'>".$annual_turnover."</label>", 'business_tenure' => "<label class='fw_bold'>".$business_existing."</label>", "emp_id" => "<label class='fw_bold'>".$agent_emp_code."</label>"]);

    if(trim($hin_final_telecallers_script) != "") {
        $result_hindi .= "<table><tr><td><pre style='white-space: pre-wrap; word-wrap: break-word; '>$hin_final_telecallers_script</pre></td></tr></table>";
    }
}

$hin_display_none = "";
$hin_class = "";
$hin_label = "";
$eng_display_none = "";
$eng_class = "";
$eng_label = "";
if(trim($result_english) != "") {
    $hin_display_none = "style='display: none'";
    $eng_class = "script-active";
    $hin_label = "Convert to Hindi";
} else {
    $eng_display_none = "style='display: none'";
    $hin_class = "script-active";
    $eng_label = "Convert to English";
}

if(trim($result_english) != "" || trim($result_hindi) != "") {
    $final_script .= "<div class='tc_div' style='width: 350px; position: fixed; right: -30%; background-color: #fff; z-index: 1; bottom: 20%;'><table class='gridtable table_set tc_sticky' border='1' style=''><tr><th colspan='1' class='fw_bold tc_th' style='position: relative;'><span class='cursor' id='close-tc-slider' style='color: #fff; font-weight: bold; color: #fff; font-weight: bold; position: absolute; left: 0; top: -7px; background-color: #da6f13; padding: 5px 7px 0px 4px; border-radius: 2px 0px 30px 0px;'>X</span> TELECALLERS SCRIPT <input style='margin: 0px' class='fRight buttonsub cursor' type='button' value='".$eng_label.$hin_label."' id='toggle-btn' /> </th></tr></table>";
    $final_script .= '<div id="english" class="language" '.$eng_display_none.'>'.(trim($result_english) != "" ? $result_english : "Script not available").'</div><div id="hindi" class="language" '.$hin_display_none.'>'.(trim($result_hindi) != "" ? $result_hindi : "Script not available").'</div>';
    $final_script .= "</div>";

    echo $final_script;
}
?>
<script>
$("#toggle-btn").click(function() {
    var toggle_btn_val = $(this).val();
    if(toggle_btn_val == "Convert to Hindi") {
        $(this).val("Convert to English");
        $("#english").css("display", "none");
        $("#hindi").css("display", "block");
    } else {
        $(this).val("Convert to Hindi");
        $("#english").css("display", "block");
        $("#hindi").css("display", "none");
    }
})
</script>