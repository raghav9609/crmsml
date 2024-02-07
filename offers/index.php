<?php
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
//require_once(dirname(__FILE__) . '/../include/header.php');
require_once(dirname(__FILE__) . '/../config/config.php');
require_once(dirname(__FILE__) . '/../include/helper.functions.php');
require_once(dirname(__FILE__) . '/../include/display-name-functions.php');
 
$qry1 = "select * from crm_masters where crm_masters_code_id = 10 and is_active = 1 ";

$res = mysqli_query($Conn1, $qry1) or die("Error: " . mysqli_error($Conn1));
$recordcount = mysqli_num_rows($res); 
if ($recordcount > 0) {
    $record = 0;
    while ($exe_form = mysqli_fetch_array($res)) {
        $record++;
        // if ($record > 10) {
        //      continue;
        // }
        $data_bnk[] = '<input type ="checkbox"  name = "check_bank[]" id = "check_bank_'.$exe_form['id'].'" value ="'.$exe_form['id'].'">'.$exe_form['value'];
    }
    echo implode($data_bnk);
}
    



?>
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offers details</title>
    <link rel="stylesheet" href="../assets/css/jquery-ui.css">
    <script type="text/javascript" src="../assets/js/jquery-1.10.2.js"></script>
    <script type="text/javascript" src="../assets/js/jquery-ui.js"></script>
</head>
<body>
<div class="color-bar-1"></div>
        <div class="color-bar-2 color-bg"></div>
            <div class="container main-container">
                <div class="row">
                    <div class="span9">
                        <table width="100%" class="gridtable">
                        <tr>
                            <th>Bank Name</th>
                            <th>Check</th>
                        </tr>
                        <?php
                            $res = mysqli_query($Conn1, $qry1) or die("Error: " . mysqli_error($Conn1));
                             $recordcount = mysqli_num_rows($res); 
                            if ($recordcount > 0) {
                                $record = 0;
                                while ($exe_form = mysqli_fetch_array($res)) {
                                    // print_r($exe_form);
                                    $record++;
                                    if ($record > 10) {
                                        continue;
                                    }
                                   
                            ?>
                                <tr>
                                    <td><?php echo $exe_form['value']; ?></td>
                                    <td>
                                        <input type ="checkbox" name = "check_bank"  id = "checkbox" value ="">
                                    </td>
                                </tr>
                                <?php  } ?>
                        </table>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
    
</body>
</html> -->













<!-- <?php
// require_once "../config/session.php";
// if($_REQUEST['run_ch'] != 1){
//     $result_fertch_data = json_decode(file_get_contents('php://input'), true);
//     $compare_select = $result_fertch_data['compare_select'];
// }
// require_once "../config/config.php";
// require_once "../include/helper.functions.php";
// require_once "../include/display-name-functions.php";

// if ($_REQUEST['run_ch'] == 1) {
//     $result_fertch_data = $_REQUEST;
//     $comp_id = get_display_name('comp_id', $result_fertch_data["comp_name"]);
//     $city_id = get_display_name('city', $result_fertch_data["city_name"]);
//     $property_city_id = get_display_name('city', $result_fertch_data["property_city_id"]);

//     $case_id = replace_special($result_fertch_data["case_id"]);
//     $offers_level_type = replace_special($result_fertch_data["offers_level_type"]);
// } else {
//     $city_id = $result_fertch_data['city_id'];
//      $user = $result_fertch_data['user_id'];
//     $property_city_id = $result_fertch_data['property_city_id'];
//     $comp_id = $result_fertch_data['comp_id'];
// }
// $qryyy_iddd = replace_special($result_fertch_data["query_id"]);
// $cust_iddd = base64_decode($result_fertch_data['cust_iddd']);
// $occup_id = $result_fertch_data['occup_id'];
// $cc_since = $result_fertch_data['cc_since'];
// $loan_type_id = $result_fertch_data['loan_type'];
// $loan_amt = (!is_numeric($result_fertch_data['loan_amt'])) ? '0':$result_fertch_data['loan_amt'];
// $pin_code = $result_fertch_data['pin_code'];
// $extng_amt = $result_fertch_data['extng_amt'] + $result_fertch_data['top_loan_amt'];
// $net_incm = (!is_numeric($result_fertch_data['net_incm']))?'0':round($result_fertch_data['net_incm']) ;
// $loan_emi = $result_fertch_data['loan_emi'];
// $prop_typee = $result_fertch_data['asset_type'] == 0? '1': $result_fertch_data['asset_type'];
// $roi_rate = $result_fertch_data['cur_rate'];
// $roi = $result_fertch_data['cur_rate'] / 1200;

// $tool_type = $result_fertch_data['tool_type'];
// $coborrower = $result_fertch_data['borrower_count'];
// $gross_annual_receipt = ($result_fertch_data['gross_annual_receipt'] == 0 || $result_fertch_data['gross_annual_receipt'] == '') ? ($net_incm * 12) : $result_fertch_data['gross_annual_receipt'];
// $profit_amt = ($result_fertch_data['profit_amt'] == 0 || $result_fertch_data['profit_amt'] == '') ? ($net_incm * 12) : $result_fertch_data['profit_amt'];
// $dob = $result_fertch_data['dob'];
// $twe = $result_fertch_data['twe'];
// $ccwe = $result_fertch_data['ccwe'];
// $loan_in_past = $result_fertch_data['loan_in_past'];
// $bank_id = 2000;
// $exis_loans = $result_fertch_data['exis_loans'];
// $credit_running = $result_fertch_data['credit_running'];
// $check_cibil_val = 1;
// $has_existing_loan = 1;
// if(($exis_loans == 0 || $exis_loans == '') && ($credit_running == 0 || $credit_running == '') && $loan_in_past == 2){
//     $check_cibil_val = 0;
// }
// if(($exis_loans == 0 || $exis_loans == '') && $loan_in_past == 2){
//     $has_existing_loan = 0;
// }
// $experiance_hosp = 0;
// if($degree_reg_year > 0 && is_numeric($degree_reg_year)){
//     $current_year = date("Y");
//     $experiance_hosp = $current_year - $degree_reg_year;
// }

// $slry_paid = $result_fertch_data['slry_paid'];
// if($slry_paid == 0){
//     $slry_paid = 1;
// }
// $main_acc = $result_fertch_data['main_acc'];
// $template_id = $result_fertch_data['template_id'];
// $age = 0;
// if($dob != '1970-01-01' && $dob != '' && $dob != '0000-00-00'){
//     $age = (date('Y') - date('Y', strtotime($dob)));
// }

// if (($exis_loans + $credit_running) > 0 || $loan_nature == 2) {
//     $cibil_flag = 1;
// } else {
//     $cibil_flag = 0;
// }
// if ($city_id != '' && $city_id != 0) {
//     $city_id = $city_id;
// } else {
//     $city_id = '26';
// }
// if (($loan_type_id == '51' || $loan_type_id == '52' || $loan_type_id == '54') && $loan_nature != 2 && $property_city_id > 0) {
//     $filter_city = $property_city_id;
// } else {
//     $filter_city = $city_id;
// }
// if ($filter_city == '0') {
//     $filter_city = 26;
// }
// if ($loan_type_id != '60') {
//     if ($loan_nature != '' && $loan_nature != 0) {
//         $pur_loan_l = $loan_nature;
//     } else {
//         $pur_loan_l = '1';
//     }
//     if ($extng_amt != '' && $extng_amt != 0) {
//         $extng_amt = $extng_amt;
//     } else {
//         $extng_amt = $loan_amt;
//     }

//     if ($prop_typee == '' || $prop_typee == '0' || $loan_type_id == '51') {
//         $prop_typee = '1';
//     } else {
//         $prop_typee = $prop_typee;
//     }

// $get_mobile = mysqli_query($Conn1,"select phone_no,cibil_score,occupation_id As occup_id from crm_customer where id = ".$cust_iddd);
// $result_mobile = mysqli_fetch_assoc($get_mobile);
// // user condtiiton startssss -----------------------

// $city_name_qry = mysqli_query($Conn1, "select city_name,city_sub_group_id from cm_master_city where id = '" . $city_id . "'");
// $result_city_qry = mysqli_fetch_array($city_name_qry);
// $city_sub_group = $result_city_qry['city_sub_group_id'];
//             // $qry_rate = "select rate,nth_pl,retr_age,foir from lms_rates where loan_type_id = '" . $loan_type_id . "' and occupation_id = '" . $occup_id . "'";
//             // $res_rate = mysqli_query($Conn1, $qry_rate);
//             // $exe_rate = mysqli_fetch_array($res_rate);
//             // $rate_tbl = $exe_rate['rate'] / 1200;
//             // $rate_tbldisplay = $exe_rate['rate'];
//             // $foir_gen = $exe_rate['foir'];
//             // $retr_age_gen = $exe_rate['retr_age'];
//             // $nth_pl = $exe_rate['nth_pl'];

//             // $qry_ten_gen = "select max_tenure, min_tenure from lms_tenure_range where loan_type_id = '" . $loan_type_id . "'";
//             // $res_ten_gen = mysqli_query($Conn1, $qry_ten_gen);
//             // $exe_ten_gen = mysqli_fetch_array($res_ten_gen);
//             // $ten_gen = $exe_ten_gen['max_tenure'];
//             // $min_tenure_gen = $exe_ten_gen['min_tenure'];
            
//                 function calculate_elig($foir, $rate, $tennure, $nth_pl)
//                 {
//                     global $net_incm, $loan_emi;
//                     $calculation_gen = ($net_incm * $foir) - $loan_emi;
//                     if ($calculation_gen < '0') {
//                         $calculation_gen = '0';
//                     }
//                     $cal_gen = 1 - pow(1 + $rate, -($tennure));
//                     $cal_gen_pre_final = round($calculation_gen * ($cal_gen / $rate));
//                     if ($nth_pl != '0') {
//                         $cal_gen_prenth_final = $net_incm * $nth_pl;
//                         $cal_gen_final = min($cal_gen_pre_final, $cal_gen_prenth_final);
//                     } else {
//                         $cal_gen_final = $cal_gen_pre_final;
//                     }
//                     return $cal_gen_final;
//                 }

//                 $head_elig_calc = calculate_elig($foir_gen, $rate_tbl, $ten_gen * 12, $nth_pl);
        

//         if(!function_exists('calculate_emi')){
//             function calculate_emi($loan_amt, $intt, $ten_max)
//                 {
//                     $emi_sem = ($loan_amt * $intt * pow((1 + $intt), $ten_max)) / (pow((1 + $intt), $ten_max) - 1);
//                     $emi_final = number_format(round(($emi_sem * 100) / 100));
//                     return $emi_final;
//                 }
//         }

//         function voucher_amt($loan_amt)
//         {
//             global $loan_type_id, $Conn1;
//             $qry_mlc_cash = mysqli_query($Conn1, "select voucher from tbl_festive_offer where max_loan_amt >= '" . $loan_amt . "' and loan_type_id = '" . $loan_type_id . "' order by max_loan_amt");
//             $res_mlc_cash = mysqli_fetch_array($qry_mlc_cash);
//             return $res_mlc_cash['voucher'];
//         }
//             $fetch_part_id_qry = "select map.pat_id as pat_id,pat.bank_id as bank_id,map.city_flag as city_flag from tbl_pat_loan_type_mapping as map left join tbl_mlc_partner as pat on map.pat_id = pat.partner_id where map.loan_type = '" . $loan_type_id . "' and map.disp_flag = 1";
//             if($loan_type_id == 56 && $comp_id == 56473){
//                 $fetch_part_id_qry .= " and map.prop_partnership_flag = 1";
//             }
//         $fetch_partner_id_qry = mysqli_query($Conn1, $fetch_part_id_qry);
//         while ($result_partner_qry = mysqli_fetch_array($fetch_partner_id_qry)) {
//             if ($loan_type_id != 71) {
//                 $check_pat_criteria = "select count(*) as total from tbl_loan_filter where 1";
//                 if ($result_partner_qry['city_flag'] == 0) {
//                     $check_pat_criteria .= " and city_id = " . $filter_city;
//                 }
//             } else {
//                 $check_pat_criteria = "select count(*) as total from tbl_loan_filter_pincode where pincode =" . $pin_code;
//             }
//             $check_pat_criteria .= " and find_in_set('$loan_type_id',loan_type_id) > 0 and status = 1 and loan_amount <= " . $loan_amt . " and
//             max_loan_amt >= " . $loan_amt . " and pat_id = " . $result_partner_qry['pat_id'];
//             if ($tool_type != 'BT Form' && $loan_type_id != 57) {
//                 $check_pat_criteria .= " and  net_incm <= " . $net_incm;
//             }
//             if ($loan_type_id == 57) {
//                 $check_pat_criteria .= " and  turnover <= " . $bus_anl_trnover;
//             }

//                 $result_check_pat_criteria = mysqli_query($Conn1, $check_pat_criteria);
//             $fetch_result_pat_criteria = mysqli_fetch_array($result_check_pat_criteria);
//             $count_total = $fetch_result_pat_criteria['total'];
//             if ($count_total > 0) {
//                 if (($loan_type_id == 51 || $loan_type_id == 52 || $loan_type_id == 54) && $pur_loan_l == 1 && $property_identified == 'Y' && $template_id != '14') {
//                     $res_propres_prop_type = $prop_typee . $property_identified_sale_type_id;
//                     $search_qry = "SELECT * FROM `hl_filter_offer` where loan_type = '" . $loan_type_id . "' and bank_id='" . $result_partner_qry['bank_id'] . "'
//                     AND ('$loan_amt' < `min_loan_amnt`";
//                     if ($occup_id == 1) {
//                         $search_qry .= " OR find_in_set('$slry_paid',`salary_paid`) > 0 ";
//                     }
//                     $search_qry .= " OR
//                     find_in_set('$occup_id',`occup_id`) > 0 OR find_in_set('$pur_loan_l',`loan_nature`) > 0 OR find_in_set('$property_identified_sale_type_id',`prop_type`) > 0 OR
//                     find_in_set('$property_location_id',`property_location_id`) > 0 OR find_in_set('$property_size',`property_size`) > 0";
//                     if ($loan_type_id == 54) {
//                         $search_qry .= " OR find_in_set('$prop_typee',`asset_type`) > 0 OR find_in_set('$res_prop_type',`res_prop_type`) > 0 ";
//                     }
//                     $search_qry .= ")";
//                     $result_qry_filter_a = mysqli_query($Conn1, $search_qry);
//                     $count_filter = mysqli_num_rows($result_qry_filter_a);
//                     if ($count_filter == 0) {
//                         $bank_id_arr[] = $result_partner_qry['bank_id']."@#".$result_partner_qry['pat_id'];
//                     }
//                 } else {
//                     $bank_id_arr[] = $result_partner_qry['bank_id']."@#".$result_partner_qry['pat_id'];
//                 }
//             }
//         }
// }
// if ($loan_type_id == 57 && $bus_anl_trnover >= 3000000 && $bus_anl_trnover <= 5000000 && $bus_ext_year < 4) {
//     $bank_id_arr = array('123@#50');
// }
//  if (in_array($loan_type_id,array(51,52,54,32,60,56))) {
//             include("pl-php-output-insert.php");
//             if(!is_numeric($qryyy_iddd)){
//                 $final_qry_to_sent  = base64_decode($qryyy_iddd);
//             }else{
//                 $final_qry_to_sent  = $qryyy_iddd;
//             }
//             if(!in_array($comp_id,array(38665,56470,56473))){
//                 $sub_employer_type = 1;
//             }else{
//                  $sub_employer_type = $comp_id;
//             }
//            // if(in_array($user,array,40))){
//              $url = "https://www.myloancare.in/api_web/offers?is_offers_crm=1&query_id=".$final_qry_to_sent."&loan_type_id=56&loan_amount=".$loan_amt."&occupation_id=".$occup_id."&loan_nature=".$pur_loan_l."&city=".$city_id."&salary=".$net_incm."&existing_loan_amount=".$extng_amt."&roi=".$roi_rate."&loan_emi=".$loan_amt."&exist_loan_bank=".$bank_id."&is_eligibility=0&company_id=".$comp_id."&loan_type=".$loan_type_id."&salary_paid=".$slry_paid."&sub_employer=".$sub_employer_type."&dob=".$dob."&total_work_exp=".$twe."&crm_user_id=".$user."&cibil_score=".$result_mobile['cibil_score']."&cibil_flag=".$check_cibil_val."&main_comp_category=".$result_mobile['comp_category']."&comp_sub_category=".$result_mobile['sub_comp_category']."&comp_sub_sub_category=".$result_mobile['sub_sub_comp_category']."&crm_qryid=".$final_qry_to_sent; 
//         }
//         if($user == 173){
//            echo $url; 
//         }
//             $offers_val = curl_get_helper($url,array("cache-control: no-cache","username:mlcgold","key:mlc-gold-loan"));
//             $decoded_data = json_decode($offers_val,true); 
//             $get_outupt_ns = array();
//             if($decoded_data['status'] == 1 && $decoded_data['total_offers'] > 0){

//                 foreach($decoded_data['data'] as $value){
//                         $processing_fees_display = $value['processing_fees'];
//                         $cashback_display = $value['cashback'];
//                         if(in_array($loan_type_id,array(51,52,54)) ){
//                             $tennure_d = $value['tennure']." Years";
//                         }else if(!in_array($loan_type_id,array(60))){
//                             $tennure_d = $value['tennure']." Months";
//                         }else{
//                             $tennure_d = $value['tennure'];
//                         }

                    
//                 $get_outupt_ns[] = array('bank_id'=>$value['bank_id'],'bank_name'=>$value['bank_name'],'partner_id'=>$value['partner_id'],'rate'=>$value['interest_rate_display'],'rate_high'=>'','fees'=>$processing_fees_display,'emi'=>'Rs.'.$value['emi'],'tennure'=>$tennure_d,'ppp'=>'','fpp'=>'','spofr'=>'','fix_flo'=>$value['rate_type'],'eligibility'=>$value['loan_amount'],'cashback'=>'Rs.'.$cashback_display,'mlc_offer'=>$value['mlc_offer'],'approval_change_range_percentage'=>$value['approval_change_range_percentage']);
//                 }
//             }

//    // }
// } /*else if ($loan_type_id == '60') {
//     include("gl-php-output-insert.php");
// }*/else if ($loan_type_id == '11') {
//     include("dl-php-output-insert.php");
// }
// else if(in_array($loan_type_id,array(57,63))) {
//         $new_ofrs = 1;
//         include("bl-php-output-insert-new.php");
// }
// if($new_ofrs != 1){
//     include("sorting.php");
// }
// $extra_cashback = 0;
// $get_page_url = mysqli_query($Conn1,"select page_url from tbl_mint_query where query_id = ".$final_qry_to_sent." and page_url IN ('https://www.myloancare.in/lp/personal-loan-vantage.php?utm_source=web&utm_medium=affiliate&utm_campaign=VantageCirclePL','https://www.myloancare.in/lp/home-loan-vantage.php?utm_source=web&utm_medium=affiliate&utm_campaign=VantageCircleHL','https://www.myloancare.in/lp/home-loan-vantage.php','https://www.myloancare.in/lp/personal-loan-vantage.php','https://www.myloancare.in/lp/home-loan-vantage.php??utm_source=web&utm_medium=affiliate&utm_campaign=VantageCircleHL')");
// if(mysqli_num_rows($get_page_url) > 0){
//     $extra_cashback = 1;
// }

// if ($_REQUEST['run_ch'] == 1) {
//     if($offers_level_type == 1){
//         include("old-journey-offers.php");
        
//     }else if($_REQUEST['journey_type'] == 1){
//         if(in_array($loan_type_id,array(57,63))){
//             include("new-journey-offers-bl.php");
//         }else{
//             include("new-journey-offers.php");
//         }
        
//         if($user == 173){
//             echo $url;
//     }
        
//         ?>

//          <br><br>
//             <div class="text-center col-12 mb-2">
//                         <?php
//                         if(in_array($loan_type_id,array(32,60,56,51,52,54))){
//                             $loan_obj = new loan_filtering_new($result_mobile['phone'], $loan_type_id, $occup_id, $net_incm, $loan_amt, $filter_city, $pin_code, $bus_anl_trnover,$comp_id,$check_cibil_val,$main_acc,$has_existing_loan,$result_fertch_data["comp_name"],$age,$result_mobile['cibil_score'],$offers_partner_id_array);
//                         }else{
//                             $loan_obj = new loan_filtering($result_mobile['phone'], $loan_type_id, $occup_id, $net_incm, $loan_amt, $filter_city, $pin_code, $bus_anl_trnover,$comp_id,$check_cibil_val,$main_acc,$has_existing_loan,$result_fertch_data["comp_name"],$age,$result_mobile['cibil_score'],$offers_partner_id_array);
//                         }
//                         ?>
//                         </div>
//                         <div class="col-12" id="prtner_details">

//                         </div><br><br>
//                         <div class="col-12" id="extra_fields_details">

//                         </div>
//                         <script>
//                             <?php
//                                     if(in_array($loan_type_id,array(56,71,60,62,51,54))){ ?>
//                                         function getExtrafields(){
//                                             $("#step3").prop('disabled',true);
//                                             var val = [];
//                                                 $(':checkbox:checked').each(function(i){
//                                                   val[i] = $(this).val();
//                                                 });
//                                                 var bank_slect = [];
//                                                 $('input[name="bank_slect[]"]:checked').each(function(i){
//                                                     bank_slect[i] = this.id;
//                                                 });

//                                                 if(val && val.length > 0){
//                                                     $.ajax({
//                                                       method:'POST',
//                                                       data:'pat_ids='+val+'&id='+btoa($("#case_id").val())+'&bank_slect='+bank_slect+'&hdfc_api_type='+$("#hdfc_pl_los option:selected").val()+'&cust_id='+$("input[name='cust_id']").val()+'&bajaj_twl_api_type='+$("#bajaj_twl_api_type option:selected").val()+'&kotak_pl_api_type='+$("#kotak_pl_los option:selected").val(),
//                                                         url: "<?php echo $head_url;?>/sugar/insert/banks-extra-fields.php",
//                                                         success: function(response) {
//                                                             $("#extra_fields_details").html(response);
//                                                             select_card_type();
//                                                             $("#step3").prop('disabled',false);
//                                                         }
//                                                       });
//                                                 }
//                                         }
//                                         function select_card_type(){
//                                             var bank_slect = [];
//                                                 $('input[name="bank_slect[]"]:checked').each(function(i){
//                                                     bank_slect[i] = this.id;
//                                                 });
//                                         }
//                                  <?php //}else{?>
//                                     function getExtrafields(){
//                                         return '';
//                                     }
//                                  <?php //} ?>
//                                 function bank_option(id,target,mlc_bank_name){
//                                     var loan_type = '<?php echo $loan_type_id; ?>';
//                                     if(loan_type == 71){
//                                         $("."+mlc_bank_name).not("#"+id).prop('checked',false);
//                                         if($('#'+id).is(':checked')){
//                                             $("#push_bank_"+target).prop('checked',true);
//                                             getpartnerdetails(target);
//                                             getExtrafields();
//                                         }else{
//                                             $("#push_bank_"+target).prop('checked',false);
//                                             $(".remove_sm_rm_"+target).remove();
//                                             getExtrafields();
//                                         }
//                                     }else{
//                                             if($('#'+id).is(':checked')){
//                                             $("#push_bank_"+id).prop('checked',true);
//                                             getpartnerdetails(id);
//                                             getExtrafields();
//                                         }else{
//                                             $("#push_bank_"+id).prop('checked',false);
//                                             $(".remove_sm_rm_"+id).remove();
//                                             getExtrafields();
//                                         }
//                                     }
//                                 }
//                                 function bank_option_sm(id,val,already_applied=0){
//                                     if($('#'+id).is(':checked')){
//                                         $("#"+val).prop('checked',true);
//                                         if(already_applied != 1){
//                                            getExtrafields();
//                                         }
//                                          getpartnerdetails(val);

//                                     }else{
//                                         $("#"+val).prop('checked',false);
//                                         $(".remove_sm_rm_"+val).remove();
//                                         if(already_applied != 1){
//                                            getExtrafields();
//                                         }
//                                     }
//                                 }
//                                 function getpartnerdetails(pat_id){
//                                     var get_loan_type = $("#loan_type").val();
//                                     if(pat_id == 103){
//                                         window.open('https://www.indifi.com/associate/myloancare', '_blank');
//                                         }else if(pat_id == 81){
//                                             window.open('https://capitalfirst.force.com/loans/login', '_blank');
//                                         }else if(pat_id == 66 && (get_loan_type == 11 || (get_loan_type == 63 && $("#profession").val() == 4))){
//                                             window.open('https://www.bajajfinserv.in/doctor-loan-form?utm_source=myloancare&utm_medium=partner&utm_campaign=DL_myloancare', '_blank');
//                                         }else if(pat_id == 66 && get_loan_type == 63 && $("#profession").val() == 3){
//                                             window.open('https://www.bajajfinserv.in/charted-accountant-loan-form?utm_source=myloancare&utm_medium=partner&utm_campaign=CA_myloancare', '_blank');
//                                         }else if(pat_id == 66 && get_loan_type != '11'){
//                                             window.open('https://www.bajajfinserv.in/business-loan-form?utm_source=MyLoanCare&utm_medium=referral&utm_campaign=Unsecured', '_blank');
//                                         }
//                                         // else if(pat_id == 24 && get_loan_type == '56'){
//                                         //     window.open('https://rcasprod.kotak.com/personal-loan-new?ntb=y&se=MLC&cp=Myloancare&ag=158802', '_blank');
//                                         // }
//                                     $.ajax({
//                                       method:'POST',
//                                       data:'pat_ids='+pat_id+'&query_id=<?php echo $qryyy_iddd; ?>&case_id=<?php echo $case_id; ?>',
//                                         url: "<?php echo $head_url;?>/include/get-partner-details.php",
//                                         success: function(response) {
//                                                   $("#prtner_details").append(response);
//                                         }
//                                       });
//                                 }

//                         </script>


// <?php// }
//  } else {
//     echo json_encode(array('resp' => $get_outupt));
// }


?> -->
