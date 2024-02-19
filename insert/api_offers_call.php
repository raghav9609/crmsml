<?php
require_once "../../include/check-session.php";
require_once "../../include/config.php";
require_once "../../include/helper.functions.php";

$loan_type = $_REQUEST['loan_type'];
$query_id = $_REQUEST['query_id'];
$case_id = $_REQUEST['case_id'];
$type = $_REQUEST['type'];

$cust_pin_code  = $_REQUEST['cust_pin_code'];
$gold_type      = $_REQUEST['gold_type'];
$city_name      = $_REQUEST['city_id'];
$gold_weight    = $_REQUEST['gold_weight'];
$loan_amt       = $_REQUEST['loan_amt'];
$city_id = "";
if(trim($city_name) != "") {
    $city_name_exe = mysqli_query($Conn1, "SELECT city_id FROM lms_city WHERE city_name = '".$city_name."' LIMIT 0, 1 ");
    if(mysqli_num_rows($city_name_exe) > 0) {
        $city_id_res    = mysqli_fetch_array($city_name_exe);
        $city_id        = $city_id_res['city_id'];
    }
}

// $loan_type = 71;
// $query_id = 3902364;

//Temporary Changes - To be removed after query_id implementation - Starts
// if($type == "case") {
//     $customer_info_query = "SELECT tbl_mint_customer_info.city_id as city_id, tbl_mint_customer_info.id AS id, tbl_mint_customer_info.dob AS dob, tbl_mint_customer_info.occup_id AS occup_id, tbl_mint_cust_info_intt.pincode AS pincode, tbl_mint_case.bus_anl_trnover AS bus_anl_trnover, tbl_mint_case.annual_turnover_num AS annual_turnover_num, tbl_mint_cust_info_intt.totl_wrk_exp AS twe, tbl_mint_customer_info.net_incm AS net_incm, tbl_mint_case.required_loan_amt AS loan_amt, tbl_mint_case.gold_type as gold_type, tbl_mint_case.weight_gold as weight_gold FROM tbl_mint_case INNER JOIN tbl_mint_customer_info ON tbl_mint_customer_info.id = tbl_mint_case.cust_id INNER JOIN tbl_mint_cust_info_intt ON tbl_mint_cust_info_intt.cust_id = tbl_mint_customer_info.id WHERE tbl_mint_case.case_id = $case_id LIMIT 0, 1 ";
// } else {
//     $customer_info_query = "SELECT tbl_mint_customer_info.city_id as city_id, tbl_mint_customer_info.id AS id, tbl_mint_customer_info.dob AS dob, tbl_mint_customer_info.occup_id AS occup_id, tbl_mint_cust_info_intt.pincode AS pincode, tbl_mint_query.bus_anl_trnover AS bus_anl_trnover, tbl_mint_query.annual_turnover_num AS annual_turnover_num, tbl_mint_cust_info_intt.totl_wrk_exp AS twe, tbl_mint_customer_info.net_incm AS net_incm, tbl_mint_query.loan_amt AS loan_amt, tbl_mint_query.gold_type as gold_type, tbl_mint_query.weight_gold as weight_gold FROM tbl_mint_query INNER JOIN tbl_mint_customer_info ON tbl_mint_customer_info.id = tbl_mint_query.cust_id INNER JOIN tbl_mint_cust_info_intt ON tbl_mint_cust_info_intt.cust_id = tbl_mint_customer_info.id WHERE query_id = $query_id LIMIT 0, 1 ";
// }

// $customer_info_exe = mysqli_query($Conn1, $customer_info_query);
// $cust_dob = "";
// $cust_occup_id = "";
// $cust_pincode = "";
// if(mysqli_num_rows($customer_info_exe) > 0) {
//     $customer_info_res = mysqli_fetch_array($customer_info_exe);
//     $cust_dob = $customer_info_res['dob'];
//     $cust_occup_id = $customer_info_res['occup_id'];
//     $cust_pincode = $customer_info_res['pincode'];
//     $cust_anl_turnover = $customer_info_res['bus_anl_trnover'];
//     $cust_turnover = $customer_info_res['annual_turnover_num'];
//     $twe = $customer_info_res['twe'];
//     $loan_amt = $customer_info_res['loan_amt'];
//     $net_incm = $customer_info_res['net_incm'];
//     $city_id = $customer_info_res['city_id'];
//     $gold_weight = $customer_info_res['weight_gold'];
//     $gold_type = $customer_info_res['gold_type'];
// }
//Temporary Changes - To be removed after query_id implementation - Ends

$curl = curl_init();
$url = "";
// if($loan_type == 56) {
//     $url = $api_head_url."api_web/offers?loan_type_id=$loan_type&total_work_exp=$twe&occupation_id=$cust_occup_id&net_income=$net_incm&loan_amount=$loan_amt&pincode=$cust_pincode";
// } else if($loan_type == 57) {
//     $url = $api_head_url."api_web/offers?loan_type_id=$loan_type&occupation_id=$cust_occup_id&pincode=$cust_pincode&anl_turnover=$cust_anl_turnover&turnover=$cust_turnover";
// } else if($loan_type == 71) {
//     $url = $api_head_url."api_web/offers?loan_type_id=$loan_type&occupation_id=$cust_occup_id&dob=$cust_dob";
// } else if($loan_type == 60) {
$url = "https://www.myloancare.in/api_web/offers?loan_type_id=$loan_type&gold_type=$gold_type&city=$city_id&gold_weight=$gold_weight&loan_amount=$loan_amt&pincode=$cust_pin_code";
// } else {
//     $url = $api_head_url."api_web/offers?loan_type_id=$loan_type&gold_type=1&city=2&gold_weight=35&loan_amount=70000&pincode=110074";
// }

// curl_setopt_array($curl, array(
//     CURLOPT_URL => $url,
//     CURLOPT_RETURNTRANSFER => true,
//     CURLOPT_ENCODING => "",
//     CURLOPT_MAXREDIRS => 10,
//     CURLOPT_TIMEOUT => 30,
//     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//     CURLOPT_CUSTOMREQUEST => "GET",
//     CURLOPT_HTTPHEADER => array(
//         "cache-control: no-cache",
//         "key: mlc-gold-loan",
//         "postman-token: 78a779d9-01c2-c5f7-0f8c-eb70b7be9b38",
//         "username: mlcgold"
//     ),
// ));

curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('username:mlcgold','key:mlc-gold-loan'));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

$result = "";
if ($err) {
  $result = "";
} else {
  $result = $response;
}

$id01 = "id01";
$none_val = "none";

$sr_no = 0;
$return_html = "";
if(trim($result) != "") {
    $json_offers = json_decode($result, true);
    if($json_offers['status'] == 1) {
        if(count($json_offers['data']) > 0) {
            $return_html .= "<div class='modal-content animate' style='width: 84% !important'>";
            $return_html .= '<div class="submenu_padding" style="padding-top:45px">';
            $return_html .= '<span class="close_button" onclick="document.getElementById(\''.$id01.'\').style.display=\''.$none.'\' ">X</span>';
            $return_html .= "<table width='100%' class='gridtable table_set' border='1' style=''><tr class='font-weight-bold'><th>Sr. No.</th><th>Bank Name</th>";
            if($loan_type == 71) {
                $return_html .= "<th>Card Name</th><th>Joining Fees <br> IR Finance Charges p.m.</th><th>FY Annual Fees / Message</th><th>Card Category</th><th>Benefits</th><th>Features</th><th>Spl Offers</th>";
            } else if($loan_type == 60 || $loan_type == 57 || $loan_type == 56) {
                $return_html .= "<th>Interest Rate</th><th>Processing Fees</th><th>EMI</th><th>Tennure</th><th>Pre-Payment Charges</th><th>Loan Amount</th><th>Calculated Eligibility</th><th>Cashback</th>";
            }

            $return_html .= "<th>User</th><th>Created Date</th></tr>";            
            foreach($json_offers['data'] as $final_res) {
                ++$sr_no;
                //Credit Card Values fetching
                $card_name = (trim($final_res['card_display_name_crm']) != "") ? $final_res['card_display_name_crm'] : "--";
                $joining_fees = (trim($final_res['joining_fees']) != "" && $final_res['joining_fees'] > 0) ? custom_money_format($final_res['joining_fees']) : "--";
                $ir_finance_charges = (trim($final_res['interest_rate_finance_charges_per_month']) != "" && $final_res['interest_rate_finance_charges_per_month'] > 0) ? $final_res['interest_rate_finance_charges_per_month']." %" : "--";
                $first_year_ann_fees = (trim($final_res['first_year_annual_fees']) != "" && $final_res['first_year_annual_fees'] > 0) ? custom_money_format($final_res['first_year_annual_fees']) : "--";
                $message = (trim($final_res['special_message']) != "") ? $final_res['special_message'] : "--";
                $card_category = (count($final_res['card_category_name']) > 0) ? implode(", ", $final_res['card_category_name']) : "--";
                $benefits = (count($final_res['benefits']) > 0) ? implode(",<br>", $final_res['benefits']) : "--";
                $features = (count($final_res['features']) > 0) ? implode(",<br>", $final_res['features']) : "--";
                $special_offers = (count($final_res['special_offer']) > 0) ? implode(",<br>", $final_res['special_offer']) : "--";

                if(trim($special_offers) == "") {
                    $special_offers = "--";
                }
                if(trim($card_category) == "") {
                    $card_category = "--";
                }
                if(trim($benefits) == "") {
                    $benefits = "--";
                }
                if(trim($features) == "") {
                    $features = "--";
                }

                //Rest of Values fetching
                $bank_name = (trim($final_res['bank_name']) != "") ? $final_res['bank_name'] : "--";
                $interest_rate = (trim($final_res['interest_rate_display']) != "") ? $final_res['interest_rate_display'] : "--";
                $processing_fees = (trim($final_res['processing_fees']) != "") ? $final_res['processing_fees'] : "--";
                $emi = ($final_res['emi'] > 0) ? custom_money_format($final_res['emi']) : "--";
                $tennure = (trim($final_res['tennure']) != "") ? $final_res['tennure'] : "--";
                $pre_payment = (trim($final_res['pre_payment_charges']) != "") ? $final_res['pre_payment_charges'] : "--";
                $loan_amount = ($final_res['loan_amount'] > 0) ? custom_money_format($final_res['loan_amount']) : "--";
                $eligibility = ($final_res['calculated_eligibility'] > 0) ? custom_money_format($final_res['calculated_eligibility']) : "--";
                $cashback = ($final_res['cashback'] > 0) ? custom_money_format($final_res['cashback']) : "--";

                $offers_user_id = ($offers_res['offers_user_id'] > 0 && $offers_res['offers_user_id'] != "") ? $offers_res['offers_user_id'] : "--";
                $offers_user_name = "--";
                if($offers_user_id != "--") {
                    $user_name_qry = "select user_name from tbl_user_assign where user_id = '".$offers_user_id."'";
                    $user_name_exe = mysqli_query($Conn1, $user_name_qry);
                    if(mysqli_num_rows($user_name_exe) > 0) {
                        $user_name_res = mysqli_fetch_array($user_name_exe);
                        $offers_user_name = $user_name_res['user_name'];
                    }
                }
                $created_date = (trim($offers_res['created_at']) != "" && date("d-m-Y", strtotime($offers_res['created_at'])) != "01-01-1970" && date("d-m-Y", strtotime($offers_res['created_at'])) != "00-00-0000" ) ? date("d-m-Y H:i:s A", strtotime($offers_res['created_at'])) : "--";

                //Tabular View generation
                $return_html .= "<tr class='center-align'>";
                $return_html .= "<td>".$sr_no."</td><td>".$bank_name."</td>";

                if($loan_type == 71) {
                    $return_html .= "<td>".$card_name."</td><td>".$joining_fees."<br>".$ir_finance_charges."</td><td>".$first_year_ann_fees."<br>".$message."</td><td>".$card_category."</td><td class='benefits' style='word-break: break-all; width: 22%'>".$benefits."</td><td class='features' style='word-break: break-all; width: 22%'>".$features."</td><td class='special_offers' style='word-break: break-all; width: 22%'>".$special_offers."</td>";
                } else if($loan_type == 60 || $loan_type == 57 || $loan_type == 56) {
                    $return_html .= "<td>".$interest_rate."</td><td>".$processing_fees."</td><td style='width: 8%'>".$emi."</td><td>".$tennure."</td><td>".$pre_payment."</td><td style='width: 8%'>".$loan_amount."</td><td>".$eligibility."</td><td>".$cashback."</td>";
                }

                $return_html .= "<td style='width: 7%'>".$offers_user_name."</td><td style='width: 8%'>".$created_date."</td></tr>";                
            }
            $return_html .= "</table>";
            $return_html .= '<div style="text-align: center"><button type="button" onclick="document.getElementById(\''.$id01.'\').style.display=\''.$none_val.'\'" class="cancelbtn" style="width:140px">Cancel</button></div>';
            $return_html .= "</div></div>";
        }
    }
}

if(trim($return_html) == "") {
    echo '<div class="modal-content animate" style="width: 84% !important"><div class="submenu_padding" style="padding-top:45px"><span class="close_button" onclick="document.getElementById(\''.$id01.'\').style.display=\''.$none.'\' ">X</span><h3 style="text-align: center; font-weight: bold">No Offers Available</h3><div style="text-align: center"><button type="button" onclick="document.getElementById(\''.$id01.'\').style.display=\''.$none_val.'\'" class="cancelbtn" style="width:140px">Cancel</button></div></div></div>';
} else {
    echo $return_html;
}