<link href="<?php echo $head_url; ?>/assets/css/grid-form.css?v=1.1" rel="stylesheet">
<style>
.fa-icon { 
    font-size: 18px;
}
.fa-mobile {
    font-size: 25px !important;
}
#form_step4 b.caret{
    margin-left:215px!important;
    display: inline;
}
#form_step4 .border-class{
    font-size: 14px;
    margin-left: 6px!important;
    border-bottom: 1px solid #ced4da!important;
    width: 100%!important;
    }
    #form_step4 .dropdown-menu {
      left: -150px;
    width: 241px;
}
</style>
<div class="main-crmform col-12">
    <!-- <div class="popup-ctext up-list-box">
    <h2 class='f_14 fw_bold'>Query Detail</h2>
    <br> 
    <ul>
    <?php  
    

    // if ($employer_type == 0) {
    //     $comp_name = $result_cust_data['comp_name_other'];
    // }else if($loan_type == 11){
    //     $comp_name = $hospital_name;
    // }
    // if($dob !='0000-00-00' && $dob != '1970-01-01'){
    //     $dob1=$dob;
    //     $diff = (date('Y') - date('Y',strtotime($dob1)));
    //     $diff;
    // } else {
    //     $diff='';
    // } 
    // $fname=$name." ".$mname." " .$lname;
    
    // $amt = custom_money_format($loan_amt);
   
    // $nametext = trim($fname) != '' ? "<li><b class='fw_bold'>".ucfirst($fname)."</b> " : '<li><b class="fw_bold">Customer</b> '  ; 
    // $dobtext = ($diff != '') ? " and customer age is&nbsp;&nbsp;<b class='fw_bold'>".$diff."</b>&nbsp;&nbsp;years </li>" : "</li>"  ;
    // $citytext = (($city_name != '')? " and residing in <b class='fw_bold'> $city_name </b></li> " : "</li>") ;
    // $occcc = get_name('master_code_id',$occup);
    // $occuptext = (($occup != '' && $occup != 0) ? "<li>Customer is  <b class='fw_bold'>$occcc </b>" : "");
    // $mainbank = get_name('master_code_id',$main_account);
    // $accounttext = (($main_account !='' && $main_account !=0) ? "<li>Customer has account in  <b class='fw_bold'>$mainbank </b></li>" : "");
    // $loanamounttext = ($loan_amt != 0 && $loan_amt != '') ? " of <b class='fw_bold'> $amt </b>" : "";
    // echo  $nametext." looking for a <b class='fw_bold'>".$loantype_name."</b>".$loanamounttext. $citytext.$occuptext.$dobtext.$accounttext; ?>
</ul>
    </div> -->

    <!-- <br> -->
    <!-- <div class='popup-ctext up-list-box'>
        <?php if ($fin_opt_bank != '') { ?>        
            <h2 class="f_14 fw_bold" style='font-size: 15px'>Customer Applied Banks</h2>
            <br>
            <span class='green f_13'> <?php echo $apply_bnk_name; ?></span>
            <br><br> <?php } ?>
        <h2 class="f_14 fw_bold" style='font-size: 15px'>Agent Offered Banks</h2>
        <br>
        <?php 
            $fil_city_id = $city_id;
        
        // if(in_array($loan_type,array(32,56,60,51,52,54))){
            
            // if($loan_type == 32){
            //     $url = "https://www.myloancare.in/api_web/offers?is_offers_crm=1&loan_type_id=32&city=".$fil_city_id."&loan_amount=".$loan_amt."&occupation_id=1&crm_user_id=".$user."&crm_qryid=".$id;
            // } else if($loan_type == 60){
            //     $url = "https://www.myloancare.in/api_web/offers?is_offers_crm=1&loan_type_id=60&gold_type=".$gold_type_id."&city=".$fil_city."&gold_weight=".$gold_weight."&loan_amount=".$loan_amt."&crm_user_id=".$user."&cibil_score=".$result_cust_data['cibil_score']."&cibil_flag=".$check_cibil_val."&crm_qryid=".$id;
            // }else if(in_array($loan_type,array(54,51,52))){
            //     $url = "https://www.myloancare.in/api_web/offers?is_test=1&is_offers_crm=1&query_id=".$id."&loan_type_id=".$loan_type."&loan_amount=".$loan_amt."&occupation_id=".$occup."&loan_nature=".$loan_nature."&property_identified=".$prop_identified."&property_city_id=".$prop_city."&city=".$city_id."&property_size=".$property_size."&property_location_id=1&salary=".$net_incm."&property_type_id=".$asset_type."&existing_loan_amount=".($exe_form['top_loan_amt']+$exstning_loan_amt)."&roi=".$cur_rate."&loan_emi=".$main_loan_amount."&exist_loan_bank=".$exstn_bank."&is_eligibility=0&property_identified_sale_type_id=".$prop_sale_type."&loan_type=".$loan_type."&crm_user_id=".$user."&cibil_flag=".$check_cibil_val."&cibil_score=".$result_cust_data['cibil_score']."&crm_qryid=".$id;
            // }else if($loan_type == 56){
            //     $url = "https://www.myloancare.in/api_web/offers?is_offers_crm=1&query_id=".$id."&loan_type_id=56&loan_amount=".$loan_amt."&occupation_id=".$occup."&loan_nature=".$loan_nature."&city=".$fil_city."&salary=".$net_incm."&existing_loan_amount=".$exstning_loan_amt."&roi=".$cur_rate."&loan_emi=".$main_loan_amount."&exist_loan_bank=".$exstn_bank."&is_eligibility=0&company_id=".$comp_id."&loan_type=".$loan_type."&salary_paid=".$salary_pay_id."&sub_employer=".$sub_employer_type."&dob=".$dob."&total_work_exp=".$twe."&crm_user_id=".$user."&cibil_score=".$result_cust_data['cibil_score']."&cibil_flag=".$check_cibil_val."&main_comp_category=".$comp_category."&comp_sub_category=".$sub_comp_category."&comp_sub_sub_category=".$sub_sub_comp_category."&crm_qryid=".$id;
            // }
            // if($user == 173){
            //     echo $url;
            // }
                
        //     $offers_val = curl_get_helper($url,array("cache-control: no-cache","username:mlcgold","key:mlc-gold-loan"));
        //     $decoded_data = json_decode($offers_val,true); 
        //     $offers_partner_id_array = array();
        //     foreach($decoded_data['data'] as $data){
        //         $offers_partner_id_array[] = $data['partner_id'];
        //     }
        //     $loan_obj = new loan_filtering_new($phone, $loan_type, $occu_id, $net_incm, $main_loan_amount, $fil_city, $pin_code, $annual_turnover_num,$comp_id,$loan_in_past,$main_account,$loan_in_past,$company_name,$diff,$exe['cibil_score'],$offers_partner_id_array);                
        // }else{
        //     $loan_obj = new loan_filtering($phone, $loan_type, $occup, $net_incm, $loan_amt, $fil_city_id, $pin_code, $annual_turnover_num,$comp_id,$loan_in_past,$main_account,$loan_in_past,$comp_name,$diff,$cibil_score);
        // }
        
        ?>
    </div> -->


</div>
    <main> 
    <section class="d-flex flex-wrap">
    <div class="pl-md-3 pl-2 pr-md-3 pr-2 col-12">
        <!-- <div class="d-flex flex-wrap gen-box text-center white-bg pe-none">
            <div class="col-3 tab-click active-tab" data-toggle="step1">Personal Details</div>
            <div class="col-3 tab-click" data-toggle="step2"><?php if($loan_type != 71){ echo "Loan";}else{echo "Card";} ?> Details</div>
        </div> -->
    <div class="gen-box white-bg">
    <div class="blue-bg col-12 font-weight-nb pb-2 pt-2 white font-20 brdr-top-gray pe-none" data-toggle="step1" id="switch_step1">
        <span id="text_step1"></span> Application Details</div>    
        <form action="" class="form-step col-12" autocomplete="off" id="form_step1">
                        <input type="hidden" name="step" value="1">
                        <input type="hidden" id="journey_type" value="1">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="cust_id" value="<?php echo $cust_id; ?>">
                        <input type="hidden" id="cust_iddd" value="<?php echo base64_encode($cust_id); ?>">
                        <input type="hidden" name="filter_status" id="filter_status" value="<?php echo $filter; ?>">
                        <input type="hidden" name="loan_type" value="<?php echo $loan_type; ?>">
                        <input type="hidden" name="unm_phone_no" id="unm_phone_no" value="<?php echo $phone; ?>">

                        <?php //if($user == 173 || $user == 83 || $user == 162) { 
                            ?>
                            <input type="hidden" name="sf_flag" id="sf_flag" value="0">
                        <?php //} ?>
                        <input type="hidden" name="logged_in_user" id="logged_in_user" value="<?php echo $user; ?>">
                        <div class="row div-width">
                       
                            <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                <span class="fa-icon fa-building"></span>
                               
                                <input type="text" id="name" name="name" value="<?php echo ($get_bank_name['value']) ;?>" placeholder="Enter Bank Name" class="form-control alphaonly valid" maxlength="20" <?php echo ($get_bank_name['value'] != '') ? 'readonly' : ''; ?>  required="">
                                <label for="name" class="label-tag"> Bank Name</label>
                            </div>
     
            
                            <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                <span class="fa-icon fa-building"></span>
                                <input type="text" id="application_status" name="application_status" value="<?php echo ($application_status_get['value']) ;?>" placeholder="Enter Application Status" class="form-control alphaonly valid"  <?php echo ($application_status_get['value'] != '') ? 'readonly' : ''; ?> maxlength="20" required>
                                <label for="name" class="label-tag"> Application Status</label>
                            </div>
                            <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                <span class="fa-icon fa-building"></span>
                                <input type="text" id="applied_amount" name="applied_amount" value="<?php echo $applied_amount;?>" placeholder="Enter Applied Amount" class="form-control alphaonly valid" maxlength="20" <?php echo ($applied_amount != '') ? 'readonly' : ''; ?> required>
                                <label for="applied_amount" class="label-tag"> Applied Amount</label>
                            </div>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                    <input type="text" class="text form-control valid" name="login_date" id="login_date" maxlength="10" value="<?php echo $login_date != '0000-00-00'?$login_date:'';?>" placeholder="yyyy-mm-dd" <?php echo ($login_date != '') ? 'readonly' : ''; ?> required>
                                    <label for="dob" class="label-tag ">Login Date</label>
                                    <span class='green' id='age' style="position: absolute;top: 100%;background: transparent;color: green;left: 15px;"></span>
                                </div> 

                                <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                    <span class="fa-icon fa-building"></span>
                                    <input type="text" id="sanction_amount" name="sanction_amount" value="<?php echo $sanction_amount;?>" placeholder="Enter Sanction Amount" class="form-control alphaonly valid" <?php echo ($sanction_amount != '') ? 'readonly' : ''; ?> maxlength="20" required>
                                    <label for="name" class="label-tag"> Sanction Amount</label>
                                </div>
                              

                                <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                    
                                    <input type="text" class="text form-control hasDatepicker valid" name="sanction_date" id="sanction_date" maxlength="10" value="<?php echo $sanction_date; ?>" placeholder="yyyy-mm-dd" required <?php echo ($sanction_date != '') ? 'readonly' : '';  ?>>
                                    <label for="dob" class="label-tag ">Sanction Date</label>
                                    <span class='green' id='age' style="position: absolute;top: 100%;background: transparent;color: green;left: 15px;"></span>
                                </div> 

                                <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                    <span class="fa-icon fa-building"></span>
                                    <input type="text" id="disbursed_amount" name="disbursed_amount" value="<?php echo $disbursed_amount;?>" placeholder="Enter Disbursement Amount" class="form-control alphaonly valid" maxlength="20" <?php echo ($disbursed_amount != '') ? 'readonly' : ''; ?> required>
                                    <label for="name" class="label-tag"> Disbursement Amount</label>
                                </div>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                    <input type="text" class="text form-control hasDatepicker valid" name="disburse_date" id="disburse_date" maxlength="10" value="<?php echo $disburse_date; ?>" placeholder="yyyy-mm-dd" required <?php echo ($disburse_date != '') ? 'readonly' : '';  ?>>
                                    <label for="dob" class="label-tag ">Disbursement Date</label>
                                    <span class='green' id='age' style="position: absolute;top: 100%;background: transparent;color: green;left: 15px;"></span>
                                </div> 

                               <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                    <span class="fa-icon fa-building"></span>
                                    <input type="text" id="remarks_by_user" name="remarks_by_user" value="<?php echo $remarks_by_user;?>" placeholder="Enter Remarks By User" class="form-control alphaonly valid" maxlength="20" <?php echo ($remarks_by_user != '') ? 'readonly' : ''; ?> required>
                                    <label for="name" class="label-tag"> Remarks By User</label>
                                </div>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                    <span class="fa-icon fa-building"></span>
                                    <input type="text" id="remarks_by_bank" name="remarks_by_bank" value="<?php echo $remarks_by_bank;?>" placeholder="Enter Remarks By Bank" class="form-control alphaonly valid" maxlength="20" <?php echo ($remarks_by_bank != '') ? 'readonly' : ''; ?> required>
                                    <label for="name" class="label-tag">Remarks By Bank</label>
                                </div>
                                
                                <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                    <span class="fa-icon fa-building"></span>
                                    <input type="text" id="bank_application_no" name="bank_application_no" value="<?php echo $bank_application_no;?>" placeholder="Enter Bank Application Number" class="form-control alphaonly valid" maxlength="20" <?php echo ($bank_application_no != '') ? 'readonly' : ''; ?> required>
                                    <label for="name" class="label-tag">Bank Application Number</label>
                                </div>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                    <input type="text" class="text form-control hasDatepicker valid" name="follow_up_date" id="follow_up_date" maxlength="10" value="<?php echo $follow_up_date; ?>" placeholder="yyyy-mm-dd" required <?php echo ($follow_up_date != '') ? 'readonly' : '';  ?>>
                                    <label for="dob" class="label-tag ">Follow Up Date</label>
                                    <span class='green' id='age' style="position: absolute;top: 100%;background: transparent;color: green;left: 15px;"></span>
                                </div> 
                                <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                    <input type="text" class="text form-control hasDatepicker valid" name="follow_up_time" id="follow_up_time" maxlength="10" value="<?php echo $follow_up_time; ?>" placeholder="yyyy-mm-dd" required <?php echo ($follow_up_time != '') ? 'readonly' : '';  ?>>
                                    <label for="dob" class="label-tag ">Follow Up Time</label>
                                    <span class='green' id='age' style="position: absolute;top: 100%;background: transparent;color: green;left: 15px;"></span>
                                </div> 
                                <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                    <input type="text" id="follow_up_given_by" name="follow_up_given_by" value="<?php echo $follow_up_given_by;?>" placeholder="Enter Follow Up Given By" class="form-control alphaonly valid" maxlength="20" <?php echo ($follow_up_given_by != '') ? 'readonly' : ''; ?> required>
                                    <label for="dob" class="label-tag ">Follow Up Given BY</label>
                                    <span class='green' id='age' style="position: absolute;top: 100%;background: transparent;color: green;left: 15px;"></span>
                                </div> 
                                <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                    <span class="fa-icon fa-building"></span>
                                    <input type="text" id="tenure" name="tenure" value="<?php echo $tennure."/".$emi ;?>" placeholder="Enter Tenure / EMI" class="form-control alphaonly valid" <?php echo ($tennure != '' && $emi != '') ? 'readonly' : '';  ?> maxlength="20" required>
                                    <label for="name" class="label-tag">Tenure/ROI</label>
                                </div>
                            </div>
                       
    
    <?php
if (in_array($loan_type, $language_barrier_loan_type)) {?>
    <div class="form-group col-xl-2 col-lg-4 col-md-6 case_languages hidden">
        <span class="fa-icon fa-language"></span>
        <?php
    //echo get_dropdown("languages", "case_languages", $lang_id, "onchange='case_fetch_users_by_lang(this);' class='hidden valid'");?>
    <label for="case_languages" class="label-tag">Select Language</label>
        </div>
        <?php
// $language_users_query = "SELECT tbl_language_user_map.user_id AS user_id, tbl_user_assign.user_name AS user_name FROM tbl_language_user_map INNER JOIN tbl_user_assign ON tbl_user_assign.user_id = tbl_language_user_map.user_id WHERE tbl_language_user_map.status = 1 AND loan_type = $loan_type ";
//     $language_users_execute = mysqli_query($Conn1, $language_users_query);
    ?>
    <div class="form-group col-xl-2 col-lg-4 col-md-6 case_lang_users hidden">
        <span class="fa-icon fa-user"></span>
            <select name='case_lang_users' id='case_lang_users' class='case_lang_users hidden valid'>
                <option value=''>Select Users</option>
            <?php
// while ($language_users_result = mysqli_fetch_array($language_users_execute)) {
//         $selected_var = ($language_users_result['user_id'] == $lang_user_id) ? "selected" : "";
//         ?>
//                 <option value="<?php //echo $language_users_result['user_id']; ?>" <?php //echo $selected_var; ?>><?php //echo $language_users_result['user_name']; ?></option>
//                 <?php
// }
    ?>
            </select>
            <label for="case_lang_users" class="label-tag">Select Users</label>
        </div>
            <?php } ?>
    <div class="form-group col-xl-2 col-lg-4 col-md-6">
            <span class="fa-icon fa-user"></span>
        <select name='case_folow_given' id='case_folow_given' class="valid" required>
            <option value="">Feedback Given By</option>
            <?php if($_SESSION['support_desk_flag'] == 1){ ?>
            <option value='3'>Support Desk</option>
            <?php }else{ ?>
                <option value='1'>Customer</option>
                <option value='2' selected="selected">MLC User</option>
            <?php } ?>
        </select>
        <label for="case_folow_given" class="label-tag">Follow Up Given By</label>
        </div>
        <div class="form-group col-xl-2 col-lg-4 col-md-6 hidden case_level_type">
        <span class="fa-icon fa-sitemap"></span>
        <select name='case_level_type' id='case_level_type' class="hidden valid">
            <option value="">Level Type</option>
            <option value='3'>Application</option>
            <option value='2'>Case</option>
        </select>
        <label for="case_level_type" class="label-tag">Level Type</label>
        </div>
        <div class="form-group col-xl-2 col-lg-4 col-md-6 case_level_reference_no hidden">
        <span class="fa-icon fa-exclamation-circle"></span>
        <input type="text" name="case_level_reference_no" id="case_level_reference_no" class="hidden valid numonly" autocomplete="off" placeholder="Level Ref. No.">
        <label for="case_level_reference_no" class="label-tag">Level Reference No</label>
        </div>
        <div class="form-group col-xl-2 col-lg-4 col-md-6 case_fol_date hidden">
        <span class="fa-icon fa-calendar"></span>
        <input type="text" class='valid form-control onlybackspace' name="case_fol_date" id="case_fol_date" placeholder="yyyy-mm-dd" maxlength='10'>
        <label for="case_fol_date" class="label-tag">Follow Up Date</label>
        </div>
        <div class="form-group col-xl-2 col-lg-4 col-md-6 case_fol_time hidden">
        <span class="fa-icon fa-clock-o"></span>
        <input type="text" name="case_fol_time" id="case_fol_time" class="onlybackspace form-control" placeholder="h:i:s" maxlength="8">
        <label for="case_fol_time" class="label-tag">Follow Up Time</label>
        </div>
        <div class="form-group col-xl-2 col-lg-4 col-md-6 case_fol_pin_code hidden">
        <span class="fa-icon fa-map-marker"></span>
        <input type="text" class="valid numonly form-control" placeholder="Residenial Pincode"  name="case_fol_pin_code" id="case_fol_pin_code" maxlength="6" value="<?php echo $pin_code ;?>"/>
        <label for="case_fol_pin_code" class="label-tag">OGL PinCode</label>
        </div>
        <div class="form-group col-xl-2 col-lg-4 col-md-6 case_fol_city_id hidden">
        <span class="fa-icon fa-map-marker"></span>
        <input type="text" class="valid alpha-num city_search form-control" name="case_fol_city_id" placeholder="Customer City" maxlength="30" id="case_fol_city_id" value="<?php echo $city_name;?>"/>
        <label for="case_fol_city_id" class="label-tag">OGL City</label>
        </div>
        <?php
        if(in_array($loan_type, $fos_loan_type)) {
        ?>
        <div class="form-group col-xl-2 col-lg-4 col-md-6 fos_fol_date hidden">
        <span class="fa-icon fa-calendar"></span>
            <input type="text" class='form-control valid onlybackspace' name="fos_fol_date" id="fos_fol_date" value="<?php echo $fos_fol_date; ?>" maxlength="10" placeholder="Appointment Date (yyyy-mm-dd)">
            <label for="fos_fol_date" class="label-tag">Appointment Date</label>
        </div>
        <div class="form-group col-xl-2 col-lg-4 col-md-6 fos_fol_time hidden">
        <span class="fa-icon fa-clock-o"></span>
            <input type="text" class="form-control valid onlybackspace" name="fos_fol_time" id="fos_fol_time" value="<?php echo $fos_fol_time; ?>" placeholder="Appointment Time (h:i:s)" maxlength="8">
            <label for="fos_fol_time" class="label-tag">Appointment Time</label>
        </div>
            <?php
                $fos_users_query = "SELECT fos_assignment_slab.id as fos_id, fos_assignment_slab.fos_user_id as fos_user_id, tbl_user_assign.user_name as user_name  FROM fos_assignment_slab INNER JOIN tbl_user_assign ON fos_assignment_slab.fos_user_id = tbl_user_assign.user_id WHERE (fos_assignment_slab.min_loan_amount <= $loan_amt and fos_assignment_slab.max_loan_amount >= $loan_amt) and (fos_assignment_slab.min_net_incm <= $net_incm and fos_assignment_slab.max_net_incm >= $net_incm) and fos_assignment_slab.loan_type = $loan_type and fos_assignment_slab.city_id = $prop_city ";
                $fos_users_exe = mysqli_query($Conn1, $fos_users_query);
                if(mysqli_num_rows($fos_users_exe) > 0) {
                    ?>
                    <div class="form-group col-xl-2 col-lg-4 col-md-6 fos_users hidden">
                    <span class="fa-icon fa-user"></span>
                    <select name="fos_users" id="fos_users" class="fos_users valid">
                        <option value="">--Select FOS User--</option>
                        <?php
                        while($fos_users_res = mysqli_fetch_array($fos_users_exe)) {
                            ?>
                            <option value="<?php echo $fos_users_res['fos_user_id']; ?>" <?php if($fos_users_res['fos_user_id'] == $fos_user_id) { echo "selected"; } ?> ><?php echo $fos_users_res['user_name']; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <label for="fos_users" class="label-tag">FOS Users</label>
        </div>
                    <?php
                } else {
                    $is_fos_users_query = "SELECT user_id, user_name from tbl_user_assign where is_fos = 1 and status = 1";
                    $is_fos_users_exe = mysqli_query($Conn1, $is_fos_users_query);
                    if(mysqli_num_rows($is_fos_users_exe) > 0) {
                        ?>
                        <div class="form-group col-xl-2 col-lg-4 col-md-6 fos_users hidden">
                    <span class="fa-icon fa-user"></span>
                    <select name="fos_users" id="fos_users" class="fos_users valid">
                            <option value="">--Select FOS User--</option>
                        <?php
                         while($is_fos_users_res = mysqli_fetch_array($is_fos_users_exe)) {
                            ?>
                            <option value="<?php echo $is_fos_users_res['user_id']; ?>" <?php if($is_fos_users_res['user_id'] == $fos_user_id) { echo "selected"; } ?> ><?php echo $is_fos_users_res['user_name']; ?></option>
                            <?php
                        }
                        ?>
                        </select>
                        <label for="fos_users" class="label-tag">FOS Users</label>
                    </div>
                        <?php
                    }
                    ?>
                    <?php
                }
            ?>
            <div class="form-group col-xl-2 col-lg-4 col-md-6 fos_address hidden">
            <span class="fa-icon fa-home"></span>
            <textarea name="fos_address" id="fos_address" class="form-control valid" autocomplete="off" placeholder="Customer Address"><?php echo $fos_address; ?></textarea>
            <label for="fos_address" class="label-tag">Customer Address</label>
            </div>
        <?php
        }
        ?>
        <div class="form-group col-xl-2 col-lg-4 col-md-6">
            <span class="fa-icon fa-commenting"></span>
            <textarea name="case_remark" id="case_remark" placeholder="Remarks" class="form-control valid" autocomplete="off"></textarea>
                  <label for="case_remark" class="label-tag optional-tag">Remarks</label>
            </div>
            	<div class="text-center col-12 mb-2">
                    <input type="button" class="btn btn-primary" name="submit" id="step4" value="SUBMIT">
                </div>
             </form> 

                    <?php //} else{  ?>
                    <form action="" class="form-step" id="form_step4" style="display:none">
                        <input type="hidden" name="cust_id" value="<?php echo $cust_id; ?>">
                    <input type="hidden" name="case_id_follow" class="case_id_received" id="case_id_received" value="<?php echo $case_id ?>">
                     <input type="hidden" name="lead_view_id" value="<?php echo $lead_view_id; ?>">
                    <input type="hidden" name="click_to_call_id" id="click_to_call_id" value="">
                      
                        <div class="form-group col-xl-2 col-lg-4 col-md-6">
                            <span class="fa-icon fa-list-alt"></span>
                            <?php //echo get_dropdown('case_status', 'case_f_stats', '', 'onchange="cng_case_status(this.value);" style="width: 100% !important" required'); ?>
                            <label for="case_f_stats" class="label-tag">Case Status</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-4 col-md-6">
                            <span class="fa-icon fa-tty"></span>
                            <?php //get_dropdown('follow_up_type', 'case_foll_type', '', 'onchange="cng_followup_type(this.value);" style="width: 100% !important"'); ?>
                            <label for="case_foll_type" class="label-tag">Follow Up Type</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-4 col-md-6">
                            <span class="fa-icon fa-user"></span>
                            <select name="fup_user_type" id="case_fup_user_type">
                                        <option value=''>Follow Up User</option>
                                        <option value="1"><?php echo $pri_name; ?> (Primary)</option>
                                        <option value="2"><?php echo $sec_name; ?> (Secondary)</option>
                                    </select>
                            <label for="case_fup_user_type" class="label-tag optional-tag">Follow Up User</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-4 col-md-6">
                            <span class="fa-icon fa-user"></span>
                            <select name="folow_given" id="case_folow_given" style='width: 100% !important'>
                                        <option>Feedback Given By</option>
                                        <option value='1'>Customer</option>
                                        <option value='2'>MLC User</option>
                                    </select>
                            <label for="case_folow_given" class="label-tag optional-tag">Feedback Given By</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-4 col-md-6">
                            <span class="fa-icon fa-calendar"></span>
                            <input type="text" class="text form-control" name="fol_date" id="case_fol_date" maxlength="10" placeholder="yyyy-mm-dd" style='width: 100% !important'/>
                            <label for="case_fol_date" class="label-tag">Follow Up Date</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-4 col-md-6">
                            <span class="fa-icon fa-clock-o"></span>
                            <input type="text" class="text form-control" name="fol_time" id="case_fol_time" maxlength="10" placeholder="h:i:s" style='width: 100% !important'/>
                            <label for="case_fol_time" class="label-tag">Follow Up Time</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-4 col-md-6 residential_pincode">
                            <span class="fa-icon fa-map-marker"></span>
                            <input type="text" class="text form-control" name="fol_pin_code" id="case_fol_pin_code" maxlength="10" placeholder="Residenial Pincode" style='width: 100% !important' value="<?php echo $pin_code ;?>"/>
                            <label for="case_fol_pin_code" class="label-tag optional-tag">Residential Pincode</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-4 col-md-6 customer_city">
                            <span class="fa-icon fa-map-marker"></span>
                            <input type="text" class="text form-control city_search" name="fol_city_id" id="case_fol_city_id" maxlength="30" placeholder="Customer City" style='width: 100% !important' value="<?php echo $city_name;?>"/>
                            <label for="case_fol_city_id" class="label-tag optional-tag">Customer City</label>
                        </div>
                        <input type="hidden" id="is_fos" name="is_fos" value="<?php echo $is_fos; ?>" />
                        <?php
                       // if(in_array($loan_type, $fos_loan_type)) {
                        ?>
                        <!-- <div class="form-group col-xl-2 col-lg-4 col-md-6 fos_flag">
                            <input type="checkbox" name="fos_checked" class="fos_check" id="fos_check" value="1" <?php echo ($is_fos == 1) ? "checked" : ""; ?> >
                            <label for="fos_check" class="checkbox green f_14">FOS Flag</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-4 col-md-6 appointment_date">
                            <span class="fa-icon fa-calendar"></span>
                            <input type="text" class="text form-control" name="fos_fol_date" id="fos_fol_date" maxlength="10" placeholder="Appointment Date (yyyy-mm-dd)" style='width: 100% !important' value="<?php echo $fos_fol_date; ?>"/>
                            <label for="fol_date" class="label-tag">Appointment Date</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-4 col-md-6 appointment_time">
                            <span class="fa-icon fa-clock-o"></span>
                            <input type="text" class="time text form-control" name="fos_fol_time" id="fos_fol_time" maxlength="10" placeholder="Appointment Time (h:i:s)" style='width: 100% !important' value="<?php echo $fos_fol_time; ?>"/>
                            <label for="fos_fol_time" class="label-tag">Appointment Time</label>
                        </div>
                         <div class="form-group col-xl-2 col-lg-4 col-md-6 fos_user">
                            <span class="fa-icon fa-user"></span>
                            <select name="fos_user_id" id="fos_users" class="fos_users" style="100%!important">
                            </select>
                            <label for="fos_users" class="label-tag">FOS User</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-4 col-md-6 fos_add">
                            <span class="fa-icon fa-home"></span>
                            <textarea class="text valid form-control alpha-num removeSpecial" name="fos_address" id="fos_address" placeholder="Customer Address for FOS" autocomplete="off"><?php echo $fos_address; ?></textarea>
                            <label for="fos_address" class="label-tag">FOS Address</label>
                        </div> -->
                        <?php
                        // }
                        
                        $level_id =1;
                        ?>
                        <div class="form-group col-xl-2 col-lg-4 col-md-6">
                            <span class="fa-icon fa-commenting"></span>
                            <textarea name="remark" class="text valid form-control removeSpecial" id="case_remark" maxlength="200" placeholder="Remarks" style='width: 100% !important'></textarea>
                            <label for="remark" class="label-tag optional-tag">Remarks</label>
                        </div>
                        <div class="text-center col-12 mb-2">
                            <input type="button" class="btn btn-primary" name="submit" id="step4" value="SUBMIT">
                        </div>
                    </form> 
                <?php //} ?>
                </div>
            </div>

            <?php
            $tc_loan_type_arr = array('56', '51', '54', '52', '11', '63', '71', '60');
            ?>
            <?php if(in_array($loan_type, $tc_loan_type_arr)) { ?>
                <div id="slide-tc-script" class="fabs-telecaller" style="bottom: 66%; position: fixed; margin: 1em; right: 0;">
                    <a style='display: block; width: 50px; height: 50px; border-radius: 50%; text-align: center; color: white; margin: 0; box-shadow: 0px 5px 11px -2px rgba(0, 0, 0, 0.18), 0px 4px 12px -7px rgba(0, 0, 0, 0.15); cursor: pointer; -webkit-transition: all .1s ease-out; transition: all .1s ease-out; position: relative; background-color: #EB9B42' target="_blank" class="fab" tooltip="Share" title="Telecaller Script"><i style='position: inherit; color: #fff;' class="fa-icon fa-file"></i></a>
                </div>
                <?php //include("../insert/telecaller_script.php"); ?>
            <?php } ?>

        </section>
    </main>
    <?php
    //if($user == 173 || $user == 83 || $user == 162) {
        include("../insert/form-popup.php");
    //}
    ?>

    <?php include('../include/loader.php') ?>
    <script>
        var negative_ques_val = '<?php echo $property_negative_ques ?>';
        var industry_id = '<?php echo $industry_id; ?>';
        var user_role = "<?php echo $_SESSION['user_role']; ?>";
        var one_lead = "<?php echo $_SESSION['one_lead_flag']; ?>";
    </script>
<script src="../assets/js/common-function.js"></script> 
<?php if(in_array($user,$user_new_status) || in_array($loan_type,$loan_type_new_status) ){ ?>
<script src="../assets/js/query-journey-new-status.js?v=15"></script>
<script src="../assets/js/case-follow-up.js?v=4"></script>
<?php } else{ ?>
<script src="../assets/js/query-journey.js?v=4"></script>
<?php } ?>
<script>
// $(document).ready(function() {
//     $("#slide-tc-script").click(function() {
//         if(!$(".tc_div").hasClass("slider-extra-class")) {
//             $(".tc_div").animate({"right":"1%"}, "slow");   
//             $(".tc_div").addClass("slider-extra-class");
//             $("#slide-tc-script").addClass("hidden");
//         } else {
//             $(".tc_div").animate({"right":"-30%"}, "slow");
//             $(".tc_div").removeClass("slider-extra-class");
//         }
//     });

//     $("#close-tc-slider").click(function() {
//         $(".tc_div").animate({"right":"-30%"}, "slow");
//         $(".tc_div").removeClass("slider-extra-class");
//         $("#slide-tc-script").removeClass("hidden");
//     })
// });
</script>
<?php //if($user == 173 || $user == 83 || $user == 162) { ?>
    <script>
    // function verify_popup(btn_id) {

    //     var email_id_val = $("#email").val().trim();
    //     var pan_card_val = ($("#pan_card").length) ? $("#pan_card").val().trim() : "";
    //     var phone_no_val = $("#unm_phone_no").val().trim();

    //     $("#btn_type_id").val(btn_id);

    //     //check if already verified
    //     $.ajax({
    //         type: "POST",
    //         url: "/sugar/insert/check-verification.php",
    //         data: "phone_no="+phone_no_val+"&email_id="+email_id_val+"&pan_card="+pan_card_val+"&cust_id=<?php echo $cust_id; ?>",
    //         success: function(resp) {
    //         }
    //     }).then(function(resp) {
    //         console.log(resp);
    //         var json_resp_new = JSON.parse(resp);
    //         if(json_resp_new.generic_verify == "0") {
    //             if(email_id_val != '' || pan_card_val != '' || phone_no_val != '') {
    //                 $("#verify_phone, #verify_phone_mode").val("");
    //                 $("#verify_email, #verify_email_mode").val("");
    //                 $("#verify_pan_card, #verify_mode").val("");

    //                 $(".dark-box").show();
    //                 $("#verification_popup").show();
    //                 $(".email-popup, #verify_email_div").addClass("hidden");
    //                 $(".pancard-popup, #verify_pancard_div").addClass("hidden");
    //                 $(".phone-popup, #verify_phone_div").addClass("hidden");

    //                 if(phone_no_val != '' && json_resp_new.phone_verify == "0") {
    //                     $(".phone-popup").removeClass("hidden");
    //                 }

    //                 if(email_id_val != '' && json_resp_new.email_verify == "0") {
    //                     $(".email-popup").removeClass("hidden");
    //                 }

    //                 if(pan_card_val != '' && json_resp_new.pancard_verify == "0") {
    //                     $(".pancard-popup").removeClass("hidden");
    //                 }
    //             } else {
    //                 $("#sf_flag").val(1);    
    //             }
    //         } else {
    //             $("#sf_flag").val(1);
    //         }
    //     });
    // }

    // function mov_field(e) {
    //     if(e.id == "verify_phone") {
    //         if(e.value == 1) {
    //             $("#verify_phone_div").removeClass("hidden");
    //         } else {
    //             $("#verify_phone_div").addClass("hidden");
    //         }
    //     }
    //     if(e.id == "verify_email") {
    //         if(e.value == 1) {
    //             $("#verify_email_div").removeClass("hidden");
    //         } else {
    //             $("#verify_email_div").addClass("hidden");
    //         }
    //     } 
    //     if(e.id == "verify_pan_card") {
    //         if(e.value == 1) {
    //             $("#verify_pancard_div").removeClass("hidden");
    //         } else {
    //             $("#verify_pancard_div").addClass("hidden");
    //         }
    //     }
    // }
    </script>
<?php //} ?>