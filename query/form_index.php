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
    <div class="popup-ctext up-list-box">
    <h2 class='f_14 fw_bold'>Query Detail</h2>
    <br> 
    <ul>
    <?php 

    if ($employer_type == 0) {
        $comp_name = $result_cust_data['comp_name_other'];
    }else if($loan_type == 11){
        $comp_name = $hospital_name;
    }
    if($dob !='0000-00-00' && $dob != '1970-01-01'){
        $dob1=$dob;
        $diff = (date('Y') - date('Y',strtotime($dob1)));
        $diff;
    } else {
        $diff='';
    } 
    $fname=$name." ".$mname." " .$lname;
    
    $amt = custom_money_format($loan_amt);
   
    $nametext = trim($fname) != '' ? "<li><b class='fw_bold'>".ucfirst($fname)."</b> " : '<li><b class="fw_bold">Customer</b> '  ; 
    $dobtext = ($diff != '') ? " and customer age is&nbsp;&nbsp;<b class='fw_bold'>".$diff."</b>&nbsp;&nbsp;years </li>" : "</li>"  ;
    $citytext = (($city_name != '')? " and residing in <b class='fw_bold'> $city_name </b></li> " : "</li>") ;
    $occcc = get_name('master_code_id',$occup);
    $occuptext = (($occup != '' && $occup != 0) ? "<li>Customer is  <b class='fw_bold'>$occcc </b>" : "");
    $mainbank = get_name('master_code_id',$main_account);
    $accounttext = (($main_account !='' && $main_account !=0) ? "<li>Customer has account in  <b class='fw_bold'>$mainbank </b></li>" : "");
    $loanamounttext = ($loan_amt != 0 && $loan_amt != '') ? " of <b class='fw_bold'> $amt </b>" : "";
    echo  $nametext." looking for a <b class='fw_bold'>".$loantype_name."</b>".$loanamounttext. $citytext.$occuptext.$dobtext.$accounttext; ?>
</ul>
    </div>

    <br>
    <div class='popup-ctext up-list-box'>
        <?php if ($fin_opt_bank != '') { ?>        
            <h2 class="f_14 fw_bold" style='font-size: 15px'>Customer Applied Banks</h2>
            <br>
            <span class='green f_13'> <?php echo $apply_bnk_name; ?></span>
            <br><br> <?php } ?>
        <h2 class="f_14 fw_bold" style='font-size: 15px'>Agent Offered Banks</h2>
        <br>
        <?php echo "hello 10";
        if (($loan_type == 51 || $loan_type == 52 || $loan_type == 54) && $prop_city != 0) {
            $fil_city_id = $prop_city;
        } else {
            $fil_city_id = $city_id;
        }
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
    </div>


</div>
    <main> 
    <section class="d-flex flex-wrap">
    <div class="pl-md-3 pl-2 pr-md-3 pr-2 col-12">
        <div class="d-flex flex-wrap gen-box text-center white-bg pe-none">
            <div class="col-3 tab-click active-tab" data-toggle="step1">Personal Details</div>
            <div class="col-3 tab-click" data-toggle="step2"><?php if($loan_type != 71){ echo "Loan";}else{echo "Card";} ?> Details</div>
        </div>
    <div class="gen-box white-bg">
    <div class="blue-bg col-12 font-weight-nb pb-2 pt-2 white font-20 brdr-top-gray pe-none" data-toggle="step1" id="switch_step1"><span id="text_step1">STEP 1</span> : Personal Details</div>    
        <form action="" class="form-step col-12" autocomplete="off" id="form_step1">
                        <input type="hidden" name="step" value="1">
                        <input type="hidden" id="journey_type" value="1">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="cust_id" value="<?php echo $cust_id; ?>">
                        <input type="hidden" id="cust_iddd" value="<?php echo base64_encode($cust_id); ?>">
                        <input type="hidden" name="filter_status" id="filter_status" value="<?php echo $filter; ?>">
                        <input type="hidden" name="loan_type" value="<?php echo $loan_type; ?>">
                        <input type="hidden" name="unm_phone_no" id="unm_phone_no" value="<?php echo $phone; ?>">

                        <?php //if($user == 173 || $user == 83 || $user == 162) { ?>
                            <input type="hidden" name="sf_flag" id="sf_flag" value="0">
                        <?php //} ?>
                        <input type="hidden" name="logged_in_user" id="logged_in_user" value="<?php echo $user; ?>">
                        <div class="row div-width">
                        <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                <label for="salutation" class="radio-tag label-tag">Salutation</label>
                                <div class="radio-button error_contain">
                                    <input type="radio" name="salutation" id="salutation1"  value="1" <?php if($salu_id == 1){ ?>checked <?php } ?> required>
                                    <label for="salutation1">Mr.</label>
                                    <input type="radio" name="salutation" id="salutation2" value="2" <?php if($salu_id == 2){ ?>checked <?php } ?> required>
                                    <label for="salutation2">Ms.</label> 
                                </div>
                            </div>
                            <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                <span class="fa-icon fa-user"></span>
                                <input type="text" id="name" name="name" value="<?php echo name_title_case($name) ;?>" placeholder="Enter Your First Name" class="form-control alphaonly" maxlength="20" required>
                                <label for="name" class="label-tag">First Name</label>
                            </div>
                            <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                <span class="fa-icon fa-user"></span>
                                <input type="text" id="mname" name="mname" value="<?php echo name_title_case($mname) ;?>" placeholder="Enter Your Middle Name" class="form-control alphaonly" maxlength="20">
                                <label for="mname" class="label-tag optional-tag">Middle Name</label>
                            </div>         
                            <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                <span class="fa-icon fa-user"></span>
                                <input type="text" id="lname" name="lname" value="<?php echo name_title_case($lname) ;?>" placeholder="Enter Your Last Name" class="form-control alphaonly" maxlength="20" required>
                                <label for="lname" class="label-tag">Last Name</label>
                            </div>
                            <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                <span class="fa-icon fa-calendar"></span>
                                <input type="text" class="text form-control" name="dob" id="dob" maxlength="10" value="<?php echo $dob != '0000-00-00'?$dob:'';?>" placeholder="yyyy-mm-dd" <?php if(in_array($loan_type,array(71,11,57,63,56))){?> required <?php }?>/>
                                <label for="dob" class="label-tag <?php if(!in_array($loan_type,array(71,11,57,63,56))){ ?> optional-tag <?php } ?>">Date of Birth</label>
                                <span class='green' id='age' style="position: absolute;top: 100%;background: transparent;color: green;left: 15px;"></span>
                            </div>
                                <?php 
                                if($_SESSION['show_number_flag'] == 2 || $_SESSION['show_number_flag'] == 3) {
                                $phone_number =  substr_replace($phone,'XXX',4,3);
                                } else {
                                $phone_number =  $phone;
                                }
                                ?>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                    <span class="fa-icon fa-mobile"></span>
                                    <input type="tel" class="text form-control" name="phone_no" id="phone_no" maxlength="10" value="<?php echo $phone_number; ?>" <?php if($phone_ver_result['phone_ver_date'] != '' && $phone_ver_result['phone_ver_date'] != '1970-01-01' && $phone_ver_result['phone_ver_date'] != '0000-00-00') { ?> title="Verified @ : <?php echo date("d-m-Y", strtotime($phone_ver_result['phone_ver_date']))." ".$phone_ver_result['source']; ?>" <?php } ?> required/>

                                    <?php if($phone_ver_result['phone_ver_date'] != '' && $phone_ver_result['phone_ver_date'] != '1970-01-01' && $phone_ver_result['phone_ver_date'] != '0000-00-00') { ?>
                                        <label class="pointer_n" style="font-weight: bold;width: 25px;height: 18px;text-align: center;color: #1b8c1b;border-radius: 50%;right: 16px;left: auto;">✔</label>
                                    <?php } ?>

                                    <label for="phone_no" class="label-tag">Mobile</label>
                                </div>
                                <?php 
                                    $alternate_phone = "";
                                    if(trim($alt_phone) != "") {
                                    if($_SESSION['show_number_flag'] == 2 || $_SESSION['show_number_flag'] == 3) {
                                        $alternate_phone = substr_replace($alt_phone, 'XXX', 4, 3);
                                      } else {
                                        $alternate_phone = $alt_phone;
                                      }
                                    }
                                ?>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                    <span class="fa-icon fa-mobile"></span>
                                    <input type="tel" class="text form-control numonly" name="alt_phone_no" id="alt_phone_no" maxlength="10" value="<?php echo $alternate_phone;?>" />
                                    <label for="alt_phone_no" class="label-tag optional-tag">Alternate Mob No.</label>
                                </div> 
                                <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                    <span class="fa-icon fa-envelope"></span>
                                    <input type="email" class="form-control" name="email" maxlength="50" id="email"  value="<?php echo lower_case($email) ;?>" <?php if(in_array($loan_type,array(71,11,57,63,56))){?> required <?php }?> <?php if($email_ver_result['email_ver_date'] != '' && $email_ver_result['email_ver_date'] != '1970-01-01' && $email_ver_result['email_ver_date'] != '0000-00-00') { ?> title="Verified @ : <?php echo date("d-m-Y", strtotime($email_ver_result['email_ver_date']))." ".$email_ver_result['source']; ?>" <?php }  ?> />

                                    <?php if($email_ver_result['email_ver_date'] != '' && $email_ver_result['email_ver_date'] != '1970-01-01' && $email_ver_result['email_ver_date'] != '0000-00-00' && trim($email) != '') { ?>
                                        <label class="pointer_n" style="font-weight: bold;width: 25px;height: 18px;text-align: center;color: #1b8c1b;border-radius: 50%;right: 16px;left: auto;">✔</label>
                                    <?php }  ?>

                                    <label for="email" class="label-tag <?php if(!in_array($loan_type,array(71,11,57,63,56))){ ?> optional-tag <?php } ?>">Email</label>
                                </div>
                                <?php if(!in_array($loan_type,array(60,32))){ ?>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                <label for="maritalstatus" class="radio-tag label-tag optional-tag">Marital Status</label>
                                <div class="radio-button">
                                    <input type="radio" name="maritalstatus" id="maritalstatus1"  value="Y" <?php if($maritalstatus == "Y"){ ?>checked <?php } ?>>
                                    <label for="maritalstatus1">Married</label>
                                    <input type="radio" name="maritalstatus" id="maritalstatus2" value="N" <?php if($maritalstatus == "N"){ ?>checked <?php } ?>>
                                    <label for="maritalstatus2">UnMarried</label> 
                                </div>
                            </div>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                    <span class="fa-icon fa-pan"></span>
                                    <input type="text" class="form-control" id="pan_card" name="pan_card" maxlength="10" placeholder="Pan Card" value="<?php echo upper_case($pan_card); ?>"
                                    <?php if(in_array($loan_type,array(71))){?> required <?php }?> <?php  if($pan_card_ver_result['pan_ver_date'] != '' && $pan_card_ver_result['pan_ver_date'] != '1970-01-01' && $pan_card_ver_result['pan_ver_date'] != '0000-00-00') { ?> title="Verified @ : <?php echo date("d-m-Y", strtotime($pan_card_ver_result['pan_ver_date']))." ".$pan_card_ver_result['source']; ?>" <?php }  ?> >

                                    <?php  if($pan_card_ver_result['pan_ver_date'] != '' && $pan_card_ver_result['pan_ver_date'] != '1970-01-01' && $pan_card_ver_result['pan_ver_date'] != '0000-00-00' && trim($pan_card) != '') { ?>
                                        <label class="pointer_n" style="font-weight: bold;width: 25px;height: 18px;text-align: center;color: #1b8c1b;border-radius: 50%;right: 16px;left: auto;">✔</label>
                                    <?php }  ?>

                                    <label for="pan_card" class="label-tag <?php if(!in_array($loan_type,array(71))){ ?> optional-tag <?php } ?>">Pan Card No.<span class='blue f_12'>(Take cibil consent)</span></label>
                                </div>
                                <div class="heading-offers">
                                    <div class="exclamatry-text">Occupation Details</div>
                                </div>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                    <span class="fa-icon fa-briefcase"></span>
                                    <?php echo get_dropdown('occupation','occupation_id',$occup,'required'); ?>
                                    <label for="occupation" class="label-tag">Employment Type</label>
                                </div>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6 salaried company_name_input">
                                    <span class="fa-icon <?php echo $loan_type == 11 ? 'fa-hospital-o' : 'fa-industry'; ?>"></span>
                                    <input type="text" class="form-control alpha-num salaried" name="comp_name" id="comp_name" <?php if($loan_type != 11){?>  onfocusout="check_comp_name(this.value);" <?php } ?> Placeholder="<?php echo $loan_type == 11 ?'Hospital':'Company';?> Name" maxlength="100" autocomplete="off" value="<?php echo $comp_name;?>" />
                                    <label for="comp_name" class="label-tag"><?php echo $loan_type == 11 ?'Hospital':'Company';?> Name</label>
                                </div>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6 salaried">
                                    <span class="fa-icon fa-inr"></span>
                                    <input type="tel" class="text form-control loan_net_incm numonly salaried" name="net_month_inc" id="net_month_inc" maxlength="9" value="<?php echo $net_incm ;?>" data-rule-min="10000" required/>
                                    <?php
                                    $raw_details_nmi = mysqli_query($Conn1, "SELECT net_incm as r_nmi, lead_assign_net_incm AS lan_incm FROM tbl_updated_query_details WHERE query_id = '".$q_id."' ");
                                    if(mysqli_num_rows($raw_details_nmi) > 0)  {
                                        $raw_details_result = mysqli_fetch_array($raw_details_nmi);
                                        
                                        $raw_details_nmi_val = custom_money_format($raw_details_result['r_nmi']);
                                        $raw_details_la_nmi  = ($raw_details_result['lan_incm'] != 0 && $raw_details_result['lan_incm'] != "") ? custom_money_format($raw_details_result['lan_incm']) : "";
                                    }
                                    ?>
                                    <div class="bold blue clear f_9"><?php echo ($raw_details_la_nmi != "") ? "Assign on - ".$raw_details_la_nmi." /" : ""; ?> <?php echo ($raw_details_nmi_val != "") ? "NTH in Query - ".$raw_details_nmi_val : ""; ?></div>
                                    <!-- <small style="font-size: 10px"><?php //echo ($raw_details_nmi_val != "") ? "NTH in current Query - ".$raw_details_nmi_val : ""; ?></small> -->
                                    <!-- <br /> -->
                                    <!-- <small style="font-size: 10px"><?php //echo ($raw_details_la_nmi != "") ? "Lead Assign on NTH - ".$raw_details_la_nmi : ""; ?></small> -->
                                    <div class='word_below orange'><b class='money_format net_month_inc_value_formt'></b></div>
                                    <label for="net_month_inc" class="label-tag">Net Monthly Income</label>
                                </div>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6 salaried">
                                    <span class="fa-icon fa-money"></span>
                                    <?php echo get_dropdown('salary_method','slry_paid',$salary_pay_id,'class="salaried"'); ?>
                                    <label for="slry_paid" class="label-tag">Salary Paid By</label>
                                </div>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6 main_acc hidden">
                                    <span class="fa-icon fa-bank"></span>
                                    <?php echo get_dropdown('banks_type','main_acc',$main_account,'class="main_acc"'); ?>
                                    <label for="main_acc" class="label-tag">Main Account</label>
                                </div>
                                <?php if($loan_type == 56){ ?>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6 main_acc hidden">
                                    <span class="fa-icon fa-bank"></span>
                                    <input type="text" id="account_no" name="account_no" value="<?php echo $account_no ;?>" placeholder="Account Number" class="form-control alpha-num valid" maxlength="15">
                                    <label for="account_no" class="label-tag optional-tag">Account Number</label>
                                </div>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                    <span class="fa-icon fa-bank"></span>
                                    <select name="commisioned" id="commisioned">
                                        <option value="">Select</option>
                                        <option value="1" <?php if($paramilitary_profile == 1){?> selected <?php } ?>>Long commission</option>
                                        <option value="2" <?php if($paramilitary_profile == 2){?> selected <?php } ?>>Short commission</option>
                                        <option value="3" <?php if($paramilitary_profile == 3){?> selected <?php } ?>>Non commission</option>
                                    </select>
                                    <label for="commisioned" class="label-tag optional-tag">Type of Commision</label>
                                </div>
                            <?php } ?>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6 gar self_emp hidden">
                                    <span class="fa-icon fa-inr"></span>
                                    <input type="tel" class="form-control self_emp loan_net_incm numonly gar" maxlength="10" name="gross_annual_receipt" id="gross_annual_receipt" value="<?php echo $gross_annual_receipt == 0 ? '' : $gross_annual_receipt ;?>" />
                                    <div class='word_below orange'><b class='money_format gross_annual_receipt_value_formt'></b></div>
                                    <label for="gross_annual_receipt" class="label-tag">Gross Annual Receipt</label>
                                </div>
                                <?php if($loan_type == 56 || $loan_type == 57) { ?>

                                    <div class="col-12 mb-2">
                                        <h4>Saving Accounts WIth</h4>
                                        <span><input type="checkbox" class="bank_offers_checkbox" name="saving_acc_with_banks[]" id="saving_acc_with_banks11" value="11"
                                                <?php
                                                    if(in_array(11,$saving_accounts_with)){
                                                        echo "checked";
                                                    }
                                                 ?> >
                                    <label for="saving_acc_with_banks11" class="checkbox">Axis Bank</label></span>
                                            <span><input type="checkbox" class="bank_offers_checkbox" name="saving_acc_with_banks[]" id="saving_acc_with_banks12" value="12"
                                                <?php
                                                    if(in_array(12,$saving_accounts_with)){
                                                        echo "checked";
                                                    }
                                                 ?> >
                                    <label for="saving_acc_with_banks12" class="checkbox">ICICI Bank</label></span>
                                        <span><input type="checkbox" class="bank_offers_checkbox" name="saving_acc_with_banks[]" id="saving_acc_with_banks16" value="16"
                                                <?php
                                                    if(in_array(16,$saving_accounts_with)){
                                                        echo "checked";
                                                    }
                                                 ?> >
                                    <label for="saving_acc_with_banks16" class="checkbox">Kotak Bank</label></span>
                                        <span><input type="checkbox" class="bank_offers_checkbox" name="saving_acc_with_banks[]" id="saving_acc_with_banks42" value="42"
                                                <?php
                                                    if(in_array(42,$saving_accounts_with)){
                                                        echo "checked";
                                                    }
                                                 ?> >
                                    <label for="saving_acc_with_banks42" class="checkbox">HDFC Bank</label></span>
                                        <span><input type="checkbox" class="bank_offers_checkbox" name="saving_acc_with_banks[]" id="saving_acc_with_banks127" value="127"
                                                <?php
                                                    if(in_array(127,$saving_accounts_with)){
                                                        echo "checked";
                                                    }
                                                 ?> >
                                    <label for="saving_acc_with_banks127" class="checkbox">IDFC First Bank</label></span>
                                        <span><input type="checkbox" class="bank_offers_checkbox" name="saving_acc_with_banks[]" id="saving_acc_with_banks78" value="78"
                                                <?php
                                                    if(in_array(78,$saving_accounts_with)){
                                                        echo "checked";
                                                    }
                                                 ?> >
                                    <label for="saving_acc_with_banks78" class="checkbox">DBS Bank</label></span>
                            </div>

                                <?php }if(in_array($loan_type,array(63,57))){?>
                                    <div class="form-group col-xl-2 col-lg-4 col-md-6 pl_senp">
                                    <span class="fa-icon fa-briefcase"></span>
                                    <?php echo get_dropdown('profession', 'profession', $prof_id, 'class="pl_senp" required'); ?>
                                    <label for="profession" class="label-tag">Select Your Profession</label>
                                </div>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6 bl_sep">
                                <span class="fa-icon fa-industry"></span>
                                <input type="text" id="firm_name" name="firm_name" value="<?php echo name_title_case($firm_name) ;?>" placeholder="Enter Firm Name" class="form-control alpha-num bl_sep" maxlength="20">
                                <label for="firm_name" class="label-tag optional-tag">Firm Name</label>
                            </div>
                            <?php }} if(in_array($loan_type,array(71,11,57,63,56))){ ?>

                            <div class="heading-offers">
                                    <div class="exclamatry-text">Office Details</div>
                                </div>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                    <span class="fa-icon fa-envelope"></span>
                                    <input type="email" class="form-control" name="ofc_email" maxlength="50" id="ofc_email" value="<?php echo lower_case($ofc_email) ;?>"/>
                                    <label for="ofc_email" class="label-tag optional-tag">Office Email Id</label>
                                </div>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                    <span class="fa-icon fa-map-marker"></span>
                                    <input type="tel" class="text form-control numonly" name="ofc_pincode" id="ofc_pincode" minlength="6" maxlength="6" required value="<?php echo (trim($ofc_pincode) == 0) ? "" : $ofc_pincode; ?>" />
                                    <label for="ofc_pincode" class="label-tag">Office Pin Code</label>
                                </div>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                    <span class="fa-icon fa-map-marker"></span>
                                    <input type="text" class="text city_search form-control alpha-num" name="work_city" maxlength="30" id="work_city" value="<?php echo $ofc_city_name;?>" required/>
                                    <label for="work_city" class="label-tag">Office City </label>
                                </div>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                    <span class="fa-icon fa-building"></span>
                                    <textarea name="offce_address" class="text valid form-control" id="offce_address" maxlength="200" <?php if(in_array($loan_type,array(71,11,57,63))){echo "required";} ?>><?php echo $offce_address ;?></textarea>
                                    <label for="offce_address" class="label-tag <?php if(!in_array($loan_type,array(71,11,57,63))){echo "optional-tag";} ?>">Office Address</label>
                                </div><?php if($loan_type == 56){ ?>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                    <span class="fa-icon fa-briefcase"></span>
                                    <input type="tel" class="text form-control numonly" name="ccwe" id="ccwe"  maxlength="4" required value="<?php echo (trim($ccwe) == 0) ? "" : $ccwe; ?>" />
                                    <label for="ccwe" class="label-tag">Current Work Exp (In months)</label>
                                </div>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                    <span class="fa-icon fa-briefcase"></span>
                                    <input type="tel" class="text form-control numonly" name="twe" id="twe" maxlength="4" required value="<?php echo (trim($twe) == 0) ? "" : $twe; ?>" />
                                    <label for="twe" class="label-tag">Total Work Exp (In months))</label>
                                </div>
                            <?php } } ?>
                                <div class="heading-offers">
                                    <div class="exclamatry-text">Residence Details</div>   
                                </div>
                                <?php if($loan_type == 56){ ?>
                                    <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                    <span class="fa-icon fa-home"></span>
                                    <?php echo get_dropdown('residential_type', 'residential_type', $rented_id, 'required'); ?>
                                    <label for="residential_type" class="label-tag">Type of Residence</label>
                                </div>
                              <?php  } ?>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                    <span class="fa-icon fa-map-marker"></span>
                                    <input type="tel" class="text form-control numonly" name="pin_code" id="pin_code" minlength="6" maxlength="6" required value="<?php echo (trim($pin_code) == 0) ? "" : $pin_code; ?>" />
                                    <label for="pin_code" class="label-tag">Pin Code</label>
                                </div>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                    <span class="fa-icon fa-map-marker"></span>
                                    <input type="text" class="text city_search form-control alpha-num" name="city_name" maxlength="30" id="city_id" value="<?php echo $city_name;?>" required/>
                                    <label for="city_id" class="label-tag">Residential City </label>
                                </div>
                                <?php if(!in_array($loan_type,array(60))){ ?>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                    <span class="fa-icon fa-home"></span>
                                    <textarea name="address" class="text valid form-control" id="address" maxlength="200" <?php if(in_array($loan_type,array(71,11,57,63))){echo "required";} ?>><?php echo $res_addrs ;?></textarea>
                                    <label for="address" class="label-tag <?php if(!in_array($loan_type,array(71,11,57,63))){ ?> optional-tag <?php } ?>">Residence Address</label>
                                </div>
                            <?php } ?>
                            </div>
                            <?php if(in_array($loan_type,array(56,71))){ ?>
                                <div class="heading-offers">
                                    <div class="exclamatry-text">Address Proof</div>   
                                </div>
                                <div class="text-center col-12 mb-2 error_contain">
                                    <?php $address_proof_qry = mysqli_query($Conn1,"select proof_id,proof_name from tbl_address_proof where proof_type > 0 and (display_flag = 1 OR proof_id = 1)");
                                    while($result_address_proof_qry = mysqli_fetch_assoc($address_proof_qry)){ ?>
                                            <span><input type="checkbox" class="bank_offers_checkbox" name="address_proof[]" id="<?php echo "address_proof_".$result_address_proof_qry['proof_id']; ?>" value="<?php echo $result_address_proof_qry['proof_id'] ?>"

                                                <?php
                                                    if(in_array($result_address_proof_qry['proof_id'],$addrs_proof)){
                                                        echo "checked";
                                                    }
                                                 ?> required
                                                >
                                    <label for="<?php echo "address_proof_".$result_address_proof_qry['proof_id']; ?>" class="checkbox"><?php echo $result_address_proof_qry['proof_name'] ?></label><span>
                                      <?php  }
                                ?>
                            </div>
                            <?php } ?>
                        <div class="text-center col-12 mb-2">
                            <input type="button" class="btn btn-primary" name="edit_temp" id="step1-temp" value="Edit">&nbsp;&nbsp;&nbsp;
                            <input type="button" class="btn btn-primary" name="submit" id="step1" value="SUBMIT">
                        </div>                        
                    </form> 
                    <div class="gray col-12 font-weight-nb pb-2 pt-2 blue-bg font-20 brdr-top-gray pe-none" data-toggle="step2" id="switch_step2"><span id="text_step2">STEP 2</span> : <?php if($loan_type != 71){ echo "Loan";}else{echo "Card";} ?> Details</div>    
                    <form action="" class="col-12 form-step" id="form_step2" style="display:none">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="customer_id" value="<?php echo $cust_id; ?>">
                        <input type="hidden" name="step" value="2">
                        <input type="hidden" name="mlc_product_id"  value="<?php echo $mlc_product_id;?>">
                        <input type="hidden" name="if_hot_case" id="if_hot_case" class="if_hot_case"  value="<?php echo $hotcase;?>">
                        <div class="row div-width">
                                <div class="form-group col-xl-2 col-lg-4 col-md-6 hidden">
                                    <span class="fa-icon fa-amnt"></span>
                                    <?php echo get_dropdown('loan_type','loan_type',$loan_type,'required'); ?>
                                    <label for="loan_type" class="label-tag">Loan Type</label>
                                </div>
                                <?php if(!in_array($loan_type,array(32,71,11,57,63))){ ?>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6 ln_nature">
                                    <span class="fa-icon fa-amnt"></span>
                                    <?php echo get_dropdown('loan_nature','nature_loan',$loan_nature,'required'); ?>
                                    <label for="nature_loan" class="label-tag">Loan Nature</label>

                                </div>
                            <?php }if(!in_array($loan_type,array(71))){ ?>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                    <span class="fa-icon fa-inr"></span>
                                    <input type="tel" class="form-control loan_net_incm numonly" data-rule-min="10000" name="loan_amount" id="loan_amount" maxlength="15" value="<?php echo $loan_amt ;?>" required/>
                                    <div class='word_below orange'><b class='loan_amount_value_formt money_format'></b></div>
                                    <label for="loan_amount" class="label-tag">
                                        <?php if($loan_type == 32){
                                                echo "FD ";
                                            }else { 
                                                echo "Loan ";
                                            } ?>Amount</label>                   
                                </div>
                                <?php } if(in_array($loan_type,array(51,52,54,56,60))){
                                    if($loan_type == 51){
                                        $asset_type = 1;
                                    } if($loan_type == 56){?>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                    <span class="fa-icon fa-search"></span>
                                    <?php echo get_dropdown('purpose_of_loan', 'purpose_of_loan', $purpose_of_loan, 'required'); ?>
                                    <label for="purpose_of_loan" class="label-tag">Purpose of Loan</label>
                                </div>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                    <label for="loan_in_past" class="radio-tag label-tag">Any loan or credit card in past?</label>
                                    <div class="boolean-button error_contain">
                                        <input type="radio" id="loan_in_past1" name="loan_in_past" required <?php if($loan_in_past == 1){echo "checked";} ?> value="1" >
                                        <label for="loan_in_past1" class="yes">Yes</label>
                                        <input type="radio" id="loan_in_past2" name="loan_in_past" required <?php if($loan_in_past == 2){echo "checked";} ?> value="2" >
                                        <label for="loan_in_past2" class="no">No</label> 
                                    </div>
                                </div>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                    <label for="loan_in_past" class="radio-tag label-tag">Availed EMI moratorium?</label>
                                    <div class="boolean-button error_contain">
                                        <input type="radio" id="emi_moritorium1" name="emi_moritorium" required <?php if($emi_moritorium == 1){echo "checked";} ?> value="1" >
                                        <label for="emi_moritorium1" class="yes">Yes</label>
                                        <input type="radio" id="emi_moritorium2" name="emi_moritorium" required <?php if($emi_moritorium == 2){echo "checked";} ?> value="2" >
                                        <label for="emi_moritorium2" class="no">No</label> 
                                    </div>
                                </div>
                                <?php } if(!in_array($loan_type,array(56,60))){
                                 ?>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6 hl cpl">
                                    <span class="fa-icon fa-map-marker"></span>
                                    <input type="text" class="text city_search form-control" maxlength="30" name="prop_city_id" id="prop_city_id" value="<?php echo $prop_city_name;?>" required/>
                                    <label for="prop_city_id" class="label-tag">Property City</label>
                                </div>
                                    <div class="form-group col-xl-2 col-lg-4 col-md-6 hl cpl el-at<?php if($loan_type == 51){echo ' hidden'; } ?>">
                                    <span class="fa-icon fa-amnt"></span>
                                    <?php echo get_dropdown('asset_type', 'asset_type', $asset_type, 'required'); ?>
                                    <label for="asset_type" class="label-tag">Asset Type</label>
                                </div>
                            <?php } ?>
                                <div class="heading-offers bt_case">
                                    <div class="exclamatry-text">Existing Loan Details</div>
                                </div>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6 bt_case">
                                    <span class="fa-icon fa-bank"></span>
                                    <?php echo get_dropdown('bank_name_','exs_bank_id',$exstn_bank,'class="bt_case"'); ?>
                                    <label for="exs_bank_id" class="label-tag">Existing Bank</label>
                                </div>
                                <?php if(!in_array($loan_type, array(60))) { ?>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6 bt_case">
                                    <span class="fa-icon">%</span>
                                    <input type="text" class="text form-control bt_case" maxlength="5" name="cur_rate" id="cur_rate" value="<?php echo $cur_rate ;?>" />
                                    <label for="cur_rate" class="label-tag">Current Rate of Interest</label>
                                </div>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6 bt_case">
                                    <span class="fa-icon fa-calendar"></span>
                                    <input type="text" class="text form-control bt_case" maxlength="15" name="cur_lo_s_m" id="cur_lo_s_m" value="<?php echo $current_loan ;?>" />
                                    <label for="cur_lo_s_m" class="label-tag">Current Loan Start Month</label>
                                </div>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6 bt_case">
                                    <span class="fa-icon fa-inr"></span>
                                    <input type="tel" class="text form-control loan_net_incm bt_case" maxlength="9" name="ex_emi" id="ex_emi" value="<?php echo $loan_emi;?>" />
                                    <div class='word_below orange'><b class='ex_emi_value_formt money_format'></b></div>
                                    <label for="ex_emi" class="label-tag">Existing EMI </label>
                                </div>
                                <?php } ?>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6 exis_tl bt_case">
                                    <span class="fa-icon fa-inr"></span>
                                    <input type="tel" class="text form-control loan_net_incm bt_case" name="ex_amt" maxlength="10" id="ex_amt" value="<?php echo $exstning_loan_amt ;?>" />
                                    <div class='word_below orange'><b class='ex_amt_value_formt money_format'></b></div>
                                    <label for="ex_amt" class="label-tag">Current Outstanding Amount </label>
                                </div>
                                <?php if(!in_array($loan_type,array(56,60))){ ?>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6 bt_case">
                                    <label for="topup" class="radio-tag label-tag">Top Up</label>
                                    <div class="boolean-button error_contain">
                                        <input type="radio" id="topup1" name="topup" <?php if($top_up_neded == 1){echo "checked";} ?> value="1" >
                                        <label for="topup1" class="yes">Yes</label>
                                        <input type="radio" id="topup2" name="topup" <?php if($top_up_neded == 1){echo "checked";} ?> value="0" >
                                        <label for="topup2" class="no">No</label> 
                                    </div>
                                </div>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6 topup_yes">
                                    <span class="fa-icon fa-inr"></span>
                                    <input type="tel" class="text form-control loan_net_incm topup_yes numonly" placeholder="Top-up Loan Amount (in Rs.)" min='1' maxlength="10" id="top_loan_amt" name="top_loan_amt" value="<?php echo $exe_form['top_loan_amt'] ?>">
                                    <div class='word_below orange'><b class='top_loan_amt_value_formt money_format'></b></div>
                                    <label for="top_loan_amt" class="label-tag">Top-Up Loan Amount </label>
                                </div> 
                                <div class="heading-offers new_loan">
                                    <div class="exclamatry-text">Loan Details</div>
                                </div>
                                <?php if($loan_type == 54 || $loan_type == 52){
                                    $prop_identified_class = 'hidden'; 
                                    $prop_identified ="Y";}else{
                                        $prop_identified_class = 'new_loan';
                                    } 
                                ?>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6  <?php echo  $prop_identified_class; ?>">
                                    <label for="prop_identified" class="radio-tag label-tag">Property Identified</label>
                                    <div class="boolean-button error_contain">
                                        <input type="radio" name="prop_identified" id="prop_identified1" value="Y" <?php if ($prop_identified=="Y" ){?>checked
                                                    <?php }?>>
                                        <label for="prop_identified1" class="yes">Yes</label>
                                        <input type="radio" name="prop_identified" id="prop_identified2" value="N" <?php if ($prop_identified=="N" ){?>checked
                                                    <?php }?>>
                                        <label for="prop_identified2" class="no">No</label> 
                                    </div>
                                </div>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6 prop_iden_no">
                                    <span class="fa-icon fa-inr"></span>
                                    <?php echo get_dropdown('budget','u_budget',$budget_id,'class = "prop_iden_no"'); ?>
                                    <label for="u_budget" class="label-tag">Budget</label>
                                </div>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6 prop_iden_yes">
                                    <span class="fa-icon fa-property-identified"></span>
                                    <?php echo get_dropdown('prop_sale_type','prop_identified_sale_type',$prop_sale_type,'class="prop_iden_yes"'); ?>
                                    <label for="prop_identified_sale_type" class="label-tag">Property Identified (Sale Type)</label>
                                </div>


                                <div class="form-group col-xl-2 col-lg-4 col-md-6 srtm">
                                    <label for="prop_identified" class="radio-tag label-tag">Property Value</label>
                                    <div class="boolean-button error_contain">
                                        <input type="radio" name="srtm" id="srtm1" value="1" <?php if ($property_ready_to_move_type == 1){?>checked
                                                    <?php }?>>
                                        <label for="srtm1" class="yes">Fresh</label>
                                        <input type="radio" name="srtm" id="srtm2" value="2" <?php if ($property_ready_to_move_type == 2){?>checked
                                                    <?php }?>>
                                        <label for="srtm2" class="yes">Re-sale</label> 
                                    </div>
                                </div>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6 udconst">
                                    <span class="fa-icon fa-plot-construction"></span>
                                        <?php echo get_dropdown('property_approved_from','udconst',$type_of_construction,'class="form-control udconst"'); ?>
                                    </select>
                                    <label for="udconst" class="label-tag">Property Approved From</label>
                                </div>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6 negative_ques">
                                    <span class="fa-icon fa-property-identified"></span>
                                    <select id="negative_ques" name="negative_ques" class="form-control negative_ques">
                                    </select>
                                    <label for="udconst" class="label-tag">Property Type</label>
                                </div>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6 buildername">
                                    <span class="fa-icon fa-builder"></span>
                                    <input type="text" placeholder="Builder Name" name="buildername" id="buildername" class="form-control buildername" value="<?php echo $builder_name; ?>">
                                    <label for="buildername" class="label-tag">Builder Name</label>
                                </div>
                                
                                <div class="form-group col-xl-2 col-lg-4 col-md-6 buildername">
                                    <span class="fa-icon fa-building"></span>
                                    <input type="text" placeholder="Project Name" name="project_name" id="project_name" class="form-control buildername"
                                    value="<?php echo $project_name; ?>">
                                    <label for="project_name" class="label-tag">Project Name</label>
                                </div>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6 property_size">
                                    <span class="fa-icon fa-select-property-size"></span>
                                    <?php echo get_dropdown('property_size','property_size',$property_size,'class="property_size"'); ?>
                                    <label for="property_size" class="label-tag">Area of property</label>
                                </div>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6 prop_iden_mar_value">
                                    <span class="fa-icon fa-inr"></span>
                                    <input type="tel" class="prop_iden_mar_value text loan_net_incm form-control numonly" name="prop_iden_mar_value" maxlength="10" id="prop_iden_mar_value" value="<?php echo $prop_market_val ;?>" />
                                    <div class='word_below orange'><b class='prop_iden_mar_value_value_formt money_format'></b></div>
                                    <label for="prop_iden_mar_value" class="label-tag">Market Value/Construction Cost</label>
                                </div>
                                 <div class="form-group col-xl-2 col-lg-4 col-md-6 prop_iden_mar_value">
                                    <span class="fa-icon fa-inr"></span>
                                    <input type="tel" class="agreement_value text loan_net_incm form-control numonly" name="agreement_value" maxlength="10" id="agreement_value" value="<?php echo $agreement_value == 0?'': $agreement_value ;?>" />
                                    <div class='word_below orange'><b class='agreement_value_value_formt money_format'></b></div>
                                    <label for="agreement_value" class="label-tag optional-tag">Agreement Value</label>
                                </div>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6 prop_iden_mar_value">
                                    <span class="fa-icon fa-inr"></span>
                                    <input type="tel" class="total_obligations text loan_net_incm form-control numonly" name="total_obligations" maxlength="10" id="total_obligations" value="<?php echo $total_obligations == 0?'': $total_obligations ;?>" />
                                    <div class='word_below orange'><b class='total_obligations_value_formt money_format'></b></div>
                                    <label for="total_obligations" class="label-tag optional-tag">Total Obligations</label>
                                </div>
                            <?php }}
                            if(in_array($loan_type,array(60))){ ?>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                    <span class="fa-icon fa-gold-loan"></span>
                                    <?php echo get_dropdown('gold_type','gold_type',$gold_type_id,'required'); ?>
                                    <label for="gold_type" class="label-tag">Type of Gold</label>
                                </div>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                    <span class="fa-icon fa-balance-scale"></span>
                                    <input type="tel" class="text form-control numonly" name="gold_weight" maxlength="5" id="gold_weight" value="<?php echo $gold_weight == 0?'': $gold_weight ;?>" required/>
                                    <label for="gold_weight" class="label-tag">Weight of Gold</label>
                                </div>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                    <span class="fa-icon fa-gold-loan"></span>
                                    <input type="tel" class="text form-control numonly" name="gold_purity" maxlength="5" id="gold_purity" value="<?php echo $purity_gold == 0?'': $purity_gold ;?>" required/>
                                    <label for="gold_purity" class="label-tag">Purity of Gold</label>
                                </div>
                                <!-- <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                    <span class="fa-icon fa-question"></span>
                                    <select id="gl_in_past" name="gl_in_past" class="form-control" required>
                                        <option value="">Gold Loan in Past</option>
                                        <option value="1" <?php echo ($exe_form['gold_in_past'] > 0) ? "selected" : ""; ?>>Yes</option>
                                        <option value="0" <?php echo ($exe_form['gold_in_past'] == 0) ? "selected" : ""; ?>>No</option>
                                    </select>
                                    <label for="gl_in_past" class="label-tag">Taken Gold Loan in Past</label>
                                </div> -->
                                <?php
                                $gl_banks = mysqli_query($Conn1, "SELECT bank_id, bank_name FROM tbl_bank WHERE gl_flag = 1 ORDER BY bank_name");
                                ?>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6 <?php if($exe_form['gold_in_past'] == 0 || $exe_form['gold_in_past'] == '') { ?> hidden <?php } ?>" id="gl_institution">
                                    <span class="fa-icon fa-bank"></span>
                                    <select id="gl_inst" name="gl_inst" class="form-control" required>
                                        <option value="">Select Institutions Name</option>
                                        <?php
                                        while($gl_banks_res = mysqli_fetch_array($gl_banks)) {
                                        ?>
                                            <option value="<?php echo $gl_banks_res['bank_id']; ?>" <?php echo ($exe_form['gold_in_past'] == $gl_banks_res['bank_id']) ? "selected" : ""; ?> ><?php echo $gl_banks_res['bank_name']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <label for="gl_in_past" class="label-tag">Institutions Name</label>
                                </div>
                                <?php
                                $est_loan_opt = mysqli_query($Conn1, "SELECT id, when_plan FROM car_plan WHERE loan_type = 60 ORDER BY id");
                                ?>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6" id="when-loan">
                                    <span class="fa-icon fa-clock-o"></span>
                                    <select id="when_loan" name="when_loan" class="form-control" required>
                                        <option value="">When to take loan</option>
                                        <?php
                                        while($est_loan_res = mysqli_fetch_array($est_loan_opt)) {
                                            ?>
                                            <option value="<?php echo $est_loan_res['id']; ?>" <?php echo ($car_booked == $est_loan_res['id']) ? "selected" : ""; ?> ><?php echo $est_loan_res['when_plan']; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    <label for="when_loan" class="label-tag">When to take loan</label>
                                </div>
                           <?php } else if(in_array($loan_type,array(71,32))){ if($loan_type == 71){?>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                    <label for="app_place" class="radio-tag label-tag">Place of Appointment</label>
                                    <div class="boolean-button error_contain">
                                        <input type="radio" name="app_place" id="app_place1" value="1" <?php if ($app_place == 1){?>checked
                                                    <?php }?> required>
                                        <label for="app_place1" class="yes">Residence</label>
                                        <input type="radio" name="app_place" id="app_place2" value="2" <?php if ($app_place == 2){?>checked
                                                    <?php }?> required>
                                        <label for="app_place2" class="yes">Office</label> 
                                    </div>
                                </div>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                    <label for="res_same_work" class="radio-tag label-tag optional-tag">Res & Office Located in the same Premises?</label>
                                    <div class="boolean-button error_contain">
                                        <input type="radio" name="res_same_work" id="res_same_work1" value="1" <?php if ($exe_form['res_same_work'] == 1){?>checked
                                                    <?php }?>>
                                        <label for="res_same_work1" class="yes">Yes</label>
                                        <input type="radio" name="res_same_work" id="res_same_work2" value="0" <?php if ($exe_form['res_same_work'] == 0 ){?>checked
                                                    <?php }?>>
                                        <label for="res_same_work2" class="no">No</label> 
                                    </div>
                                </div>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                    <label for="prop_identified" class="radio-tag label-tag">Card to Card</label>
                                    <div class="boolean-button error_contain">
                                        <input type="radio" name="card_tocard" id="card_tocard1" value="1" <?php if($card_tocard == '1'){?> checked <?php } ?>>
                                        <label for="card_tocard1" class="yes">Yes</label>
                                        <input type="radio" name="card_tocard" id="card_tocard2" value="0" <?php if($card_tocard == '0'){?> checked <?php } ?>>
                                        <label for="card_tocard2" class="no">No</label> 
                                    </div>
                                </div>
                                 <div class="form-group col-xl-2 col-lg-4 col-md-6 card_to_card">
                                    <span class="fa-icon fa-clock-o"></span>
                                    <?php echo get_dropdown('cc_since', 'cc_since', $credit_since, 'class="card_to_card"'); ?>
                                    <label for="cc_since" class="label-tag">Holding Credit Card Since When?</label>
                                </div> 
                                <div class="form-group col-xl-2 col-lg-4 col-md-6 card_to_card">
                                    <span class="fa-icon fa-inr"></span>
                                    <input type="tel" class="text form-control numonly card_to_card loan_net_incm" name="credit_limit" maxlength="10" id="credit_limit" value="<?php echo $credit_limit == 0?'': $credit_limit ;?>"/>
                                    <div class='word_below orange'><b class='money_format credit_limit_value_formt'></b></div>
                                    <label for="credit_limit" class="label-tag">Credit Limit</label>
                                </div>
                            <?php } ?>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                    <span class="fa-icon fa-calendar"></span>
                                    <input type="tel" class="text form-control numonly" name="apptmnt_date" maxlength="10" id="apptmnt_date" value="<?php echo $apptmnt_date != '0000-00-00'? $apptmnt_date: '' ;?>" required/>
                                    <label for="apptmnt_date" class="label-tag">Appointment Date</label>
                                </div>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                    <span class="fa-icon fa-clock-o"></span>
                                    <input type="tel" class="time text form-control" name="apptmnt_time" maxlength="10" id="apptmnt_time" value="<?php echo $apptmnt_time != '00:00:00'?$apptmnt_time:'' ;?>" required/>
                                    <label for="apptmnt_date" class="label-tag">Appointment Time</label>
                                </div>

                                <?php if($loan_type == 32) { ?>
                                    <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                        <span class="fa-icon fa-pan"></span>
                                        <input type="text" class="form-control" id="pan_card" name="pan_card" maxlength="10" placeholder="Pan Card" maxlength='10' value="<?php echo upper_case($pan_card); ?>">
                                        <label for="pan_card" class="label-tag optional-tag">Pan Card No.<span class='blue f_12'>(Take cibil consent)</span></label>
                                    </div>

                                    <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                        <span class="fa-icon fa-bank"></span>
                                        <select id="exis_relation" name="exis_relation" class="form-control" required>
                                            <option value=''>Select</option>
                                            <option value='1' <?php echo ($relation_with_bank_id == 1) ? "selected" : ""; ?> >No Relation</option>
                                            <option value='2' <?php echo ($relation_with_bank_id == 2) ? "selected" : ""; ?> >Savings Account</option>
                                            <option value='3' <?php echo ($relation_with_bank_id == 3) ? "selected" : ""; ?> >Current Account</option>
                                            <option value='4' <?php echo ($relation_with_bank_id == 4) ? "selected" : ""; ?> >Loan Account</option>
                                            <option value='5' <?php echo ($relation_with_bank_id == 5) ? "selected" : ""; ?> >Fixed Deposit Account</option>
                                        </select>
                                        <label for="exis_relation" class="label-tag">Your Existing Relation with ICICI Group</label>
                                    </div>
                                    
                                    <div class="form-group col-xl-2 col-lg-4 col-md-6 sav_acc_no <?php echo ($relation_with_bank_id == 2) ? "" : "hidden"; ?> ">
                                        <span class="fa-icon fa-bank"></span>
                                        <input type="text" name="sav_account_no" id="sav_account_no" class="form-control valid numonly" autocomplete="off" placeholder="Savings Account Number" value="<?php echo $saving_account_no; ?>" >
                                        <label for="sav_account_no" class="label-tag">Savings Account No</label>
                                    </div>

                                    <?php
                                        $address_proof_query  = mysqli_query($Conn1, "SELECT proof_id, proof_name FROM tbl_address_proof WHERE icici_display_flag = 1 ORDER BY proof_name ASC");
                                    ?>
                                    <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                        <span class="fa-icon fa-home"></span>
                                        <select id="proof_of_address" name="proof_of_address" class="form-control" >
                                            <option value="">Select Proof of Address</option>
                                        <?php
                                            while($address_proof_res = mysqli_fetch_array($address_proof_query)) {
                                                ?>
                                                <option value="<?php echo $address_proof_res['proof_id']; ?>" <?php echo (in_array($address_proof_res['proof_id'], $addrs_proof)) ? "selected" : ""; ?> ><?php echo $address_proof_res['proof_name']; ?></option>
                                                <?php
                                            }
                                        ?>
                                        </select>
                                        <label for="proof_of_address" class="label-tag optional-tag">Proof of Address</label>
                                    </div>

                                    <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                        <span class="fa-icon fa-bank"></span>
                                        <input type="text" name="address_proof_no" id="address_proof_no" class="form-control valid alpha-num" autocomplete="off" placeholder="Address Proof Number" maxlength="25" value="<?php echo $address_proof_no; ?>">
                                        <label for="address_proof_no" class="label-tag optional-tag">Address Proof Number</label>
                                    </div>

                                    <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                        <span class="fa-icon fa-clock-o"></span>
                                        <select id="pref_ln_ten" name="pref_ln_ten" class="form-control" required>
                                            <option value="">Select Tenure</option>
                                            <option value="1" <?php echo ($pref_loan_tennure == 1) ? "selected" : ""; ?> >6 months</option>
                                        <?php
                                        $ten_val = 1;
                                        for($i = 1; $i <= 10; $i++) {
                                            ++$ten_val;
                                            $selected = ($pref_loan_tennure == $ten_val) ? "selected" : "";
                                            echo "<option value='".$ten_val."' ".$selected.">".$i." Year</option>";
                                        }
                                        ?>
                                        </select>
                                        <label for="pref_ln_ten" class="label-tag">Tennure</label>
                                    </div>

                                    <?php

                                        $bank_apply_temp    = explode(",", $bank_apply);
                                        $bank_apply_temp_2  = array_diff($bank_apply_temp, ['undefined']);
                                        $bank_apply_new     = implode(",", $bank_apply_temp_2);

                                        $bank_from_pat = mysqli_query($Conn1, "SELECT group_concat(bank_id) AS bank_id FROM tbl_mlc_partner WHERE partner_id IN ($bank_apply_new) ");
                                        $bank_from_pat_res = mysqli_fetch_array($bank_from_pat);
                                        $bank_from_pat_result = $bank_from_pat_res['bank_id'];

                                        $deposit_tenure_query = mysqli_query($Conn1, "SELECT id, tenure FROM tbl_fd_bank_tenure_rate WHERE bank_id in ($bank_from_pat_result) ORDER BY tenure ASC");
                                        if(mysqli_num_rows($deposit_tenure_query) > 0) {
                                        ?>
                                            <input type="hidden" id="banks_applied" value="<?php echo $bank_from_pat_result; ?>">
                                            <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                                <span class="fa-icon fa-clock-o"></span>
                                                <select id="deposit_tenure" name="deposit_tenure" class="form-control" required>
                                                    <option value="">Select Deposit Tenure</option>
                                                <?php
                                                    while($deposit_tenure_res = mysqli_fetch_array($deposit_tenure_query)) {
                                                        ?>
                                                        <option value="<?php echo $deposit_tenure_res['id']; ?>" <?php echo ($pref_loan_tennure == $deposit_tenure_res['id']) ? "selected" : ""; ?> ><?php echo $deposit_tenure_res['tenure']; ?></option>
                                                        <?php
                                                    }
                                                ?>
                                                </select>
                                                <label for="deposit_tenure" class="label-tag">Deposit Tenure</label>
                                            </div>

                                            <?php
                                            $deposit_tenure_rate = "";
                                            if($pref_loan_tennure != "") {
                                                $pref_intr_rate_query = "SELECT generic_rate FROM tbl_fd_bank_tenure_rate WHERE id = $pref_loan_tennure ";
                                                $pref_intr_rate_exe = mysqli_query($Conn1, $pref_intr_rate_query);
                                                if(mysqli_num_rows($pref_intr_rate_exe) > 0) {
                                                    $pref_intr_rate_res = mysqli_fetch_array($pref_intr_rate_exe);
                                                    $deposit_tenure_rate = $pref_intr_rate_res['generic_rate'];
                                                }
                                            }
                                            ?>
                                            <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                                <span class="fa-icon">%</span>
                                                <input type="text" name="deposit_interest" id="deposit_interest" class="form-control valid numonly" autocomplete="off" placeholder="Interest Rate" value="<?php echo $deposit_tenure_rate; ?>">
                                                <label for="deposit_interest" class="label-tag">Interest Rate</label>
                                            </div>
                                    <?php } ?>
                                <?php } ?>

                           <?php }else if(in_array($loan_type,array(57,11,63))){ if($loan_type == 11){ ?>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                    <span class="fa-icon fa-graduation-cap"></span>
                                    <?php echo get_dropdown('degree_specialization', 'degree_specialization', $dl_degree_specialization, 'required'); ?>
                                    <label for="degree_specialization" class="label-tag">Degree Specialization</label>
                                </div>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                    <span class="fa-icon fa-graduation-cap"></span>
                                    <?php echo get_dropdown('educational_degree', 'educational_degree', $educational_degree_dl, 'required'); ?>
                                    <label for="cc_since" class="label-tag">Educational Degree</label>
                                </div>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6 dl_salaried">
                                    <span class="fa-icon fa-home"></span>
                                    <?php echo get_dropdown('residential_type', 'residential_type', $rented_id, 'class="dl_salaried"'); ?>
                                    <label for="residential_type" class="label-tag">Type of Residence</label>
                                </div>
                            <?php }if(in_array($loan_type,array(57,63))){ ?>

                            <?php if(in_array($loan_type,array(63))) { ?>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6 bl_sep">
                                    <span class="fa-icon fa-registered"></span>
                                    <?php echo get_dropdown('type_of_registration', 'type_of_registration', $bs_reg_type, 'class="bl_sep" required'); ?>
                                    <label for="type_of_registration" class="label-tag">Business Registered With</label>
                                </div>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6 bl_sep">
                                    <span class="fa-icon fa-bank"></span>
                                    <?php echo get_dropdown('bank_account_type', 'bank_account_type', $bank_acc_type, 'class="bl_sep" required'); ?>
                                    <label for="bank_account_type" class="label-tag">Type of Bank Account you have</label>
                                </div>
                            <?php } ?>
                            
                                <div class="form-group col-xl-2 col-lg-4 col-md-6 bl_sep">
                                    <span class="fa-icon fa-gavel"></span>
                                    <?php echo get_dropdown('business_type', 'business_type', $business_type, 'class="bl_sep" required'); ?>
                                    <label for="business_type" class="label-tag">Type of Incorporation</label>
                                </div>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6 bl_sep">
                                    <span class="fa-icon fa-briefcase"></span>
                                    <?php echo get_dropdown('nature_of_business', 'nature_of_business', $bs_nature_id, 'class="bl_sep" required'); ?>
                                    <label for="nature_of_business" class="label-tag">Type of Business</label>
                                </div>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6 bl_sep">
                                    <span class="fa-icon fa-industry"></span>
                                    <select id="industry_type" name="industry_type" class="form-control" required>
                                    </select>
                                    <label for="industry_type" class="label-tag">Industry Type</label>
                                </div>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6 bl_sep">
                                    <span class="fa-icon fa-inr"></span>
                                    <input type="tel" class="text form-control numonly bl_sep loan_net_incm" name="annual_turnover" maxlength="10" id="annual_turnover" value="<?php echo $annual_turnover_num == 0?'': $annual_turnover_num ;?>"/>
                                    <div class='word_below orange'><b class='money_format annual_turnover_value_formt'></b></div>
                                    <label for="annual_turnover" class="label-tag">Annual Turnover</label>
                                </div>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6 bl_sep">
                                    <span class="fa-icon fa-clock-o"></span>
                                    <input type="tel" class="text form-control numonly bl_sep" maxlength="3" name="years_in_business" maxlength="10" id="years_in_business" value="<?php echo $business_existing_num ;?>"/>
                                    <label for="years_in_business" class="label-tag">Years in Business</label>
                                </div>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6 bl_sep">
                                    <span class="fa-icon fa-inr"></span>
                                    <input type="tel" class="text form-control numonly bl_sep loan_net_incm" name="annual_profit" maxlength="10" id="annual_profit" value="<?php echo $profit_itr_amt == 0?'': $profit_itr_amt ;?>"/>
                                    <div class='word_below orange'><b class='money_format annual_profit_value_formt'></b></div>
                                    <label for="annual_profit" class="label-tag">Annual Profit</label>
                                </div>
                                
                                 <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                    <label for="own_house_in_india" class="radio-tag label-tag">Is your residence owned or rented?</label>
                                    <div class="boolean-button error_contain">
                                        <input type="radio" name="own_house_in_india" id="own_house_in_india1" value="1" <?php if ($rented_id == 1){?>checked
                                                    <?php }?> required>
                                        <label for="own_house_in_india1" class="yes">Owned</label>
                                        <input type="radio" name="own_house_in_india" id="own_house_in_india2" value="3" <?php if ($rented_id == 3){?>checked
                                                    <?php }?> required>
                                        <label for="own_house_in_india2" class="yes">Rented</label> 
                                    </div>
                                </div>
                            <?php } ?>
                                
                                <div class="form-group col-xl-2 col-lg-4 col-md-6 dl_senp">
                                    <label for="place_of_business" class="radio-tag label-tag">Is your place of work owned or rented?</label>
                                    <div class="boolean-button error_contain">
                                        <input type="radio" name="place_of_business" id="place_of_business1" value="1" <?php if ($place_of_business == 1){?>checked
                                                    <?php }?> required>
                                        <label for="place_of_business1" class="yes">Owned</label>
                                        <input type="radio" name="place_of_business" id="place_of_business2" value="3" <?php if ($place_of_business == 3){?>checked
                                                    <?php }?> required>
                                        <label for="place_of_business2" class="yes">Rented</label> 
                                    </div>
                                </div>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6 dl_senp">
                                    <span class="fa-icon fa-file"></span>
                                    <?php echo get_dropdown('ITR_available', 'ITR_available', $itr_avl, 'class="dl_senp"'); ?>
                                    <label for="ITR_available" class="label-tag">No. of Years of ITR Available</label>
                                </div>

                                <div class="form-group col-xl-2 col-lg-4 col-md-6 bl_sep" id="is_gst_field">
                                    <span class="fa-icon fa-amnt"></span>
                                    <select name="is_gst_yn" id="is_gst_yn" required>
                                        <option value=''>File GST Return?</option>
                                        <option value="1" <?php if(1 == $gst_reg) { ?>selected<?php } ?>>Yes</option>
                                        <option value="2" <?php if(0 == $gst_reg) { ?>selected<?php } ?>>No</option>
                                    </select>
                                    <label for="is_gst_yn" class="label-tag">File GST Return?</label>
                                </div>
                                
                                <div class="form-group col-xl-2 col-lg-4 col-md-6 <?php echo ($gst_reg == 1) ? "" : "hidden" ?> " id="gstin_number_field">
                                    <span class="fa-icon fa-inr"></span>
                                    <input type="tel" class="text form-control" name="gstin_number" maxlength="20" id="gstin_number" value="<?php echo $gstin_number == '' ? '': $gstin_number; ?>"/>
                                    <label for="gstin_number" class="label-tag optional-tag">GSTIn Number</label>
                                </div>

                                <div class="form-group col-xl-2 col-lg-3 col-md-6 bl_sep" id="type_of_bank_acc_field">
                                    <span class="fa-icon fa-amnt"></span>
                                    <?php echo get_dropdown('cust_bank_account_type','cust_bank_account_type', $bank_acc_type, 'required'); ?>
                                    <label for="cust_bank_account_type" class="label-tag">Type of Bank Account</label>
                                </div>

                                <div class="form-group col-xl-2 col-lg-3 col-md-6 bl_sep" id="account_balance_field">
                                    <span class="fa-icon fa-amnt"></span>
                                    <?php echo get_dropdown('account_balance','avg_month_balance', $avg_month_balance, 'required'); ?>
                                    <label for="avg_month_balance" class="label-tag">Avergae Monthly Balance</label>
                                </div>

                                <?php
                                $fy_current_sess = "FY".date("y", strtotime("-1 year"))."-".date("y");
                                $fy_previous_sess = "FY".date("y", strtotime("-2 year"))."-".date("y", strtotime("-1 year"));
                                ?>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6 bl_sep" id="gt_prev_sess_field">
                                    <span class="fa-icon fa-inr"></span>
                                    <input type="tel" class="text form-control loan_net_incm numonly" name="gross_turnover_prev_sess" maxlength="10" id="gross_turnover_prev_sess" value="<?php echo $prev_sess_revenue; ?>"/>
                                    <div class='word_below orange'><b class='gross_turnover_prev_sess_value_formt money_format'></b></div>
                                    <label for="gross_turnover_prev_sess" class="label-tag optional-tag">Turnover/Gross Revenue <?php echo $fy_previous_sess; ?></label>
                                </div>

                                <div class="form-group col-xl-2 col-lg-4 col-md-6 bl_sep" id="gt_curr_sess_field">
                                    <span class="fa-icon fa-inr"></span>
                                    <input type="tel" class="text form-control loan_net_incm numonly" name="gross_turnover_curr_sess" maxlength="10" id="gross_turnover_curr_sess" value="<?php echo $cur_sess_revenue; ?>"/>
                                    <div class='word_below orange'><b class='gross_turnover_curr_sess_value_formt money_format'></b></div>
                                    <label for="gross_turnover_curr_sess" class="label-tag optional-tag">Turnover/Gross Revenue <?php echo $fy_current_sess; ?></label>
                                </div>

                                <div class="form-group col-xl-2 col-lg-4 col-md-6 pl_senp">
                                    <span class="fa-icon fa-clock-o"></span>
                                    <select id='degree_reg_year' class="pl_senp" name ='degree_reg_year' required>
                                        <option value=''>Select</option>
                                        <?php for($i=date("Y",strtotime("-60 year"));$i<=date("Y");$i++){ ?>
                                            <option value="<?php echo $i;?>" <?php if($degree_reg_year == $i){ ?> selected <?php } ?>><?php echo $i;?></option>
                                        <?php } ?>
                                    </select>
                                    <label for="degree_reg_year" class="label-tag">Degree Registration Year</label>
                                </div>
                                
                                <?php if($loan_type == 11){?>
                                <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                    <label for="work_in_hospital" class="radio-tag label-tag">Do you also work in a <span id='dl_work_on'>Private Clinic</span></label>
                                    <div class="boolean-button error_contain">
                                        <input type="radio" id="work_in_hospital1" name="work_in_hospital" <?php if($work_in_hospital == 1){echo "checked";} ?> value="1" >
                                        <label for="work_in_hospital1" class="yes">Yes</label>
                                        <input type="radio" id="work_in_hospital2" name="work_in_hospital" <?php if($work_in_hospital == 0){echo "checked";} ?> value="0" >
                                        <label for="work_in_hospital2" class="no">No</label> 
                                    </div>
                                </div>
                           <?php }?>

                           <?php } ?>
                            </div>
                            <?php if(in_array($loan_type,array(71,56))){ if(in_array($loan_type,array(56))){?>
                            <div class="heading-offers">
                                    <div class="exclamatry-text">Existing Loans</div>
                                </div>
                                <div class="text-center col-12 mb-2">
                                <div class="form-group col-xl-2 col-lg-4 col-md-6">
                            <span class="fa-icon fa-amnt"></span>
                            <select name="exis_loans" id="exis_loans">
                                        <option value=''>No. of Loans Running</option>
                                        <option value="1"<?php if(1 == $exis_loans){?>selected="selected"<?php }?>>1</option>
                                         <option value="2"<?php if(2 == $exis_loans){?>selected="selected"<?php }?>>2</option>
                                          <option value="3"<?php if(3 == $exis_loans){?>selected="selected"<?php }?>>3</option>
                                           <option value="4"<?php if(4 == $exis_loans){?>selected="selected"<?php }?>>4</option>
                                            <option value="5"<?php if(5 == $exis_loans){?>selected="selected"<?php }?>>5</option>
                                    </select>
                            <label for="exis_loans" class="label-tag optional-tag">No. of Loans Running</label>
                        </div>
                    </div>
                    <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_loan_1">
                            <span class="fa-icon fa-amnt"></span>
                            <?php echo get_dropdown('loan_type_','loan_type_on',$loan_type_on,'class="ext_loan_1"'); ?>
                            <label for="loan_type_on" class="label-tag">Loan Type</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_loan_1">
                            <span class="fa-icon fa-bank"></span>
                            <?php echo get_dropdown('bank_name_','ex_bank_id',$ex_bank_id,'class="ext_loan_1"'); ?>
                            <label for="ex_bank_id_fr" class="label-tag">Bank</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_loan_1">
                                    <span class="fa-icon fa-inr"></span>
                                    <input type="tel" class="text form-control numonly ext_loan_1" name="emi_loan_on" maxlength="10" id="emi_loan_on" value="<?php echo $emi_loan_on == 0?'': $emi_loan_on ;?>"/>
                                    <label for="emi_loan_on" class="label-tag optional-tag">EMI</label>
                                </div>

                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_loan_1">
                            <span class="fa-icon fa-sort-numeric-asc"></span>
                            <input type="tel" class="text form-control numonly ext_loan_1" name="no_of_emis_paid_on" maxlength="5" id="no_of_emis_paid_on" value="<?php echo ($no_of_emis_paid_on == 0) ? "" : $no_of_emis_paid_on; ?>"/>
                            <label for="no_of_emis_paid_on" class="label-tag">No. of EMIs Paid</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_loan_1">
                            <span class="fa-icon fa-inr"></span>
                            <input type="tel" class="text form-control numonly ext_loan_1" name="cur_out_stand_on" maxlength="10" id="cur_out_stand_on" value="<?php echo $cur_out_stand_on == 0?'': $cur_out_stand_on ;?>"/>
                            <label for="cur_out_stand_on" class="label-tag optional-tag">Current OutStanding Amt.</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_loan_1"></div>
                    <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_loan_2">
                            <span class="fa-icon fa-amnt"></span>
                            <?php echo get_dropdown('loan_type_','loan_type_tw',$loan_type_tw,'class="ext_loan_2"'); ?>
                            <label for="loan_type_tw" class="label-tag">Loan Type</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_loan_2">
                            <span class="fa-icon fa-bank"></span>
                            <?php echo get_dropdown('bank_name_','ex_bank_id_tw',$ex_bank_id_tw,'class="ext_loan_2"'); ?>
                            <label for="ex_bank_id_tw" class="label-tag">Bank</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_loan_2">
                                    <span class="fa-icon fa-inr"></span>
                                    <input type="tel" class="text form-control numonly ext_loan_2" name="emi_loan_tw" maxlength="10" id="emi_loan_tw" value="<?php echo $emi_loan_tw == 0?'': $emi_loan_tw ;?>" />
                                    <label for="emi_loan_tw" class="label-tag optional-tag">EMI</label>
                                </div>

                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_loan_2">
                            <span class="fa-icon fa-sort-numeric-asc"></span>
                            <input type="tel" class="text form-control numonly ext_loan_2" name="no_of_emis_paid_tw" maxlength="5" id="no_of_emis_paid_tw" value="<?php echo ($no_of_emis_paid_tw == 0) ? "" : $no_of_emis_paid_tw; ?>"/>
                            <label for="no_of_emis_paid_tw" class="label-tag">No. of EMIs Paid</label>
                        </div>
                    <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_loan_2">
                        <span class="fa-icon fa-inr"></span>
                        <input type="tel" class="text form-control numonly ext_loan_2" name="cur_out_stand_tw" maxlength="10" id="cur_out_stand_tw" value="<?php echo $cur_out_stand_tw == 0?'': $cur_out_stand_tw ;?>"/>
                        <label for="cur_out_stand_tw" class="label-tag optional-tag">Current OutStanding Amt.</label>
                    </div>
                    <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_loan_2"></div>
                    <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_loan_3">
                            <span class="fa-icon fa-amnt"></span>
                            <?php echo get_dropdown('loan_type_','loan_type_th',$loan_type_th,'class="ext_loan_3"'); ?>
                            <label for="loan_type_th" class="label-tag">Loan Type</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_loan_3">
                            <span class="fa-icon fa-bank"></span>
                            <?php echo get_dropdown('bank_name_','ex_bank_id_th',$ex_bank_id_th,'class="ext_loan_3"'); ?>
                            <label for="ex_bank_id_th" class="label-tag">Bank</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_loan_3">
                                    <span class="fa-icon fa-inr"></span>
                                    <input type="tel" class="text form-control numonly ext_loan_3" name="emi_loan_th" maxlength="10" id="emi_loan_th" value="<?php echo $emi_loan_th == 0?'': $emi_loan_th ;?>"/>
                                    <label for="emi_loan_th" class="label-tag optional-tag">EMI</label>
                                </div>

                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_loan_3">
                            <span class="fa-icon fa-sort-numeric-asc"></span>
                            <input type="tel" class="text form-control numonly ext_loan_3" name="no_of_emis_paid_th" maxlength="5" id="no_of_emis_paid_th" value="<?php echo ($no_of_emis_paid_th == 0) ? "" : $no_of_emis_paid_th; ?>"/>
                            <label for="no_of_emis_paid_th" class="label-tag">No. of EMIs Paid</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_loan_3">
                            <span class="fa-icon fa-inr"></span>
                            <input type="tel" class="text form-control numonly ext_loan_3" name="cur_out_stand_th" maxlength="10" id="cur_out_stand_th" value="<?php echo $cur_out_stand_th == 0?'': $cur_out_stand_th ;?>"/>
                            <label for="cur_out_stand_th" class="label-tag optional-tag">Current OutStanding Amt.</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_loan_3"></div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_loan_4">
                            <span class="fa-icon fa-amnt"></span>
                            <?php echo get_dropdown('loan_type_','loan_type_fr',$loan_type_fr,'class="ext_loan_4"'); ?>
                            <label for="loan_type_fr" class="label-tag">Loan Type</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_loan_4">
                            <span class="fa-icon fa-bank"></span>
                            <?php echo get_dropdown('bank_name_','ex_bank_id_fr',$ex_bank_id_fr,'class="ext_loan_4"'); ?>
                            <label for="ex_bank_id_fr" class="label-tag">Bank</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_loan_4">
                                    <span class="fa-icon fa-inr"></span>
                                    <input type="tel" class="text form-control numonly ext_loan_4" name="emi_loan_fr" maxlength="10" id="emi_loan_fr" value="<?php echo $emi_loan_fr == 0?'': $emi_loan_fr ;?>"/>
                                    <label for="emi_loan_fr" class="label-tag optional-tag">EMI</label>
                                </div>
                        
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_loan_4">
                            <span class="fa-icon fa-sort-numeric-asc"></span>
                            <input type="tel" class="text form-control numonly ext_loan_4" name="no_of_emis_paid_fr" maxlength="5" id="no_of_emis_paid_fr" value="<?php echo ($no_of_emis_paid_fr == 0) ? "" : $no_of_emis_paid_fr; ?>"/>
                            <label for="no_of_emis_paid_fr" class="label-tag">No. of EMIs Paid</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_loan_4">
                            <span class="fa-icon fa-inr"></span>
                            <input type="tel" class="text form-control numonly ext_loan_4" name="cur_out_stand_fr" maxlength="10" id="cur_out_stand_fr" value="<?php echo $cur_out_stand_fr == 0?'': $cur_out_stand_fr ;?>"/>
                            <label for="cur_out_stand_fr" class="label-tag optional-tag">Current OutStanding Amt.</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_loan_4"></div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_loan_5">
                            <span class="fa-icon fa-amnt"></span>
                            <?php echo get_dropdown('loan_type_','loan_type_fv',$loan_type_fv,'class="ext_loan_5"'); ?>
                            <label for="loan_type_fv" class="label-tag">Loan Type</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_loan_5">
                            <span class="fa-icon fa-bank"></span>
                            <?php echo get_dropdown('bank_name_','ex_bank_id_fv',$ex_bank_id_fv,'class="ext_loan_5"'); ?>
                            <label for="ex_bank_id_fv" class="label-tag">Bank</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_loan_5">
                                    <span class="fa-icon fa-inr"></span>
                                    <input type="tel" class="text form-control numonly ext_loan_5" name="emi_loan_fv" maxlength="10" id="emi_loan_fv" value="<?php echo $emi_loan_fv == 0?'': $emi_loan_fv ;?>"/>
                                    <label for="emi_loan_fv" class="label-tag optional-tag">EMI</label>
                                </div>
                        
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_loan_5">
                            <span class="fa-icon fa-sort-numeric-asc"></span>
                            <input type="tel" class="text form-control numonly ext_loan_5" name="no_of_emis_paid_fv" maxlength="5" id="no_of_emis_paid_fv" value="<?php echo ($no_of_emis_paid_fv == 0) ? "" : $no_of_emis_paid_fv; ?>"/>
                            <label for="no_of_emis_paid_fv" class="label-tag">No. of EMIs Paid</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_loan_5">
                            <span class="fa-icon fa-inr"></span>
                            <input type="tel" class="text form-control numonly ext_loan_5" name="cur_out_stand_fv" maxlength="10" id="cur_out_stand_fv" value="<?php echo $cur_out_stand_fv == 0?'': $cur_out_stand_fv ;?>"/>
                            <label for="cur_out_stand_fv" class="label-tag optional-tag">Current OutStanding Amt.</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_loan_5"></div>

                            <?php } ?>
                        <div class="heading-offers">
                                    <div class="exclamatry-text">Existing Cards</div>
                                </div>
                                <div class="text-center col-12 mb-2">
                                <div class="form-group col-xl-2 col-lg-4 col-md-6">
                            <span class="fa-icon fa-credit-card"></span>
                            <select name="credit_running" id="credit_running">
                                        <option value=''>No. of Cards Running</option>
                                        <option value="1"<?php if(1 == $credit_running){?>selected="selected"<?php }?>>1</option>
                                         <option value="2"<?php if(2 == $credit_running){?>selected="selected"<?php }?>>2</option>
                                          <option value="3"<?php if(3 == $credit_running){?>selected="selected"<?php }?>>3</option>
                                           <option value="4"<?php if(4 == $credit_running){?>selected="selected"<?php }?>>4</option>
                                            <option value="5"<?php if(5 == $credit_running){?>selected="selected"<?php }?>>5</option>
                                    </select>
                            <label for="credit_running" class="label-tag optional-tag">No. of Cards Running</label>
                        </div>
                    </div>
                    <!-- Existing Card 1 -->
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_card_1">
                            <span class="fa-icon fa-bank"></span>
                            <?php echo get_dropdown('bank_name_','credit_bank_id',$credit_bank_id,'class="ext_card_1"'); ?>
                            <label for="credit_bank_id" class="label-tag">Bank</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_card_1">
                                    <span class="fa-icon fa-inr"></span>
                                    <input type="tel" class="text form-control numonly ext_card_1 loan_net_incm" name="credit_sanction_amt_on" min='1000' maxlength="10" id="credit_sanction_amt_on" value="<?php echo $credit_sanction_amt_on == 0?'': $credit_sanction_amt_on ;?>"/>
                                    <div class='word_below orange'><b class='money_format credit_sanction_amt_on_value_formt'></b></div>
                                    <label for="credit_sanction_amt_on" class="label-tag">Credit Limit</label>
                                </div>
                                <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_card_1">
                                    <span class="fa-icon fa-inr"></span>
                                    <input type="tel" class="text form-control numonly ext_card_1 loan_net_incm" name="current_out_stan_on" maxlength="10" id="current_out_stan_on" value="<?php echo $current_out_stan_on ;?>"/>
                                    <div class='word_below orange'><b class='money_format current_out_stan_on_value_formt'></b></div>
                                    <label for="current_out_stan_on" class="label-tag optional-tag">Outstanding Amount</label>
                                </div>

                                <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_card_1">
                                    <span class="fa-icon fa-sort-numeric-asc"></span>
                                    <input type="tel" class="text form-control numonly ext_card_1" name="credit_card_vintage_on" maxlength="6" id="credit_card_vintage_on" value="<?php echo ($credit_card_vintage_on == 0) ? '' : $credit_card_vintage_on ;?>"/>
                                    <label for="credit_card_vintage_on" class="label-tag">Credit Card Vintage</label>
                                </div>
                                <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_card_1"></div>
                                <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_card_1"></div>
                    <!-- Existing Card 2 -->
                    <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_card_2">
                            <span class="fa-icon fa-bank"></span>
                            <?php echo get_dropdown('bank_name_','credit_bank_id_tw',$credit_bank_id_tw,'class="ext_card_2"'); ?>
                            <label for="credit_bank_id_tw" class="label-tag">Bank</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_card_2">
                                    <span class="fa-icon fa-inr"></span>
                                    <input type="tel" class="text form-control numonly ext_card_2 loan_net_incm" name="credit_sanction_amt_tw" min='1000' maxlength="10" id="credit_sanction_amt_tw" value="<?php echo $credit_sanction_amt_tw == 0?'': $credit_sanction_amt_tw ;?>"/>
                                    <div class='word_below orange'><b class='money_format credit_sanction_amt_tw_value_formt'></b></div>
                                    <label for="credit_sanction_amt_tw" class="label-tag">Credit Limit</label>
                                </div>
                                <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_card_2">
                                    <span class="fa-icon fa-inr"></span>
                                    <input type="tel" class="text form-control numonly ext_card_2 loan_net_incm" name="current_out_stan_tw" maxlength="10" id="current_out_stan_tw" value="<?php echo $current_out_stan_tw ;?>"/>
                                    <div class='word_below orange'><b class='money_format current_out_stan_tw_value_formt'></b></div>
                                    <label for="current_out_stan_tw" class="label-tag optional-tag">Outstanding Amount</label>
                                </div>

                                <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_card_2">
                                    <span class="fa-icon fa-sort-numeric-asc"></span>
                                    <input type="tel" class="text form-control numonly ext_card_2" name="credit_card_vintage_tw" maxlength="6" id="credit_card_vintage_tw" value="<?php echo ($credit_card_vintage_tw == 0) ? '' : $credit_card_vintage_tw ;?>"/>
                                    <label for="credit_card_vintage_tw" class="label-tag">Credit Card Vintage</label>
                                </div>
                                <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_card_2"></div>
                                <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_card_2"></div>

                    <!-- Existing Card 3 -->
                    <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_card_3">
                            <span class="fa-icon fa-bank"></span>
                            <?php echo get_dropdown('bank_name_','credit_bank_id_th',$credit_bank_id_th,'class="ext_card_3"'); ?>
                            <label for="credit_bank_id_th" class="label-tag">Bank</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_card_3">
                                    <span class="fa-icon fa-inr"></span>
                                    <input type="tel" class="text form-control numonly ext_card_3 loan_net_incm" name="credit_sanction_amt_th" maxlength="10" id="credit_sanction_amt_th" min='1000' value="<?php echo $credit_sanction_amt_th == 0?'': $credit_sanction_amt_th ;?>"/>
                                    <div class='word_below orange'><b class='money_format credit_sanction_amt_th_value_formt'></b></div>
                                    <label for="credit_sanction_amt_th" class="label-tag">Credit Limit</label>
                                </div>
                                <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_card_3">
                                    <span class="fa-icon fa-inr"></span>
                                    <input type="tel" class="text form-control numonly ext_card_3 loan_net_incm" name="current_out_stan_th" maxlength="10" id="current_out_stan_th" value="<?php echo $current_out_stan_th ;?>"/>
                                    <div class='word_below orange'><b class='money_format current_out_stan_th_value_formt'></b></div>
                                    <label for="current_out_stan_th" class="label-tag optional-tag">Outstanding Amount</label>
                                </div>

                                <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_card_3">
                                    <span class="fa-icon fa-sort-numeric-asc"></span>
                                    <input type="tel" class="text form-control numonly ext_card_3" name="credit_card_vintage_th" maxlength="6" id="credit_card_vintage_th" value="<?php echo ($credit_card_vintage_th == 0) ? '' : $credit_card_vintage_th ;?>"/>
                                    <label for="credit_card_vintage_th" class="label-tag">Credit Card Vintage</label>
                                </div>
                                <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_card_3"></div>
                                <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_card_3"></div>

                    <!-- Existing Card 4 -->
                    <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_card_4">
                            <span class="fa-icon fa-bank"></span>
                            <?php echo get_dropdown('bank_name_','credit_bank_id_fr',$credit_bank_id_fr,'class="ext_card_4"'); ?>
                            <label for="credit_bank_id_fr" class="label-tag">Bank</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_card_4">
                                    <span class="fa-icon fa-inr"></span>
                                    <input type="tel" class="text form-control numonly ext_card_4 loan_net_incm" name="credit_sanction_amt_fr" min='1000' maxlength="10" id="credit_sanction_amt_fr" value="<?php echo $credit_sanction_amt_fr == 0?'': $credit_sanction_amt_fr ;?>"/>
                                    <div class='word_below orange'><b class='money_format credit_sanction_amt_fr_value_formt'></b></div>
                                    <label for="credit_sanction_amt_fr" class="label-tag">Credit Limit</label>
                                </div>
                                <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_card_4">
                                    <span class="fa-icon fa-inr"></span>
                                    <input type="tel" class="text form-control numonly ext_card_4 loan_net_incm" name="current_out_stan_fr" maxlength="10" id="current_out_stan_fr" value="<?php echo $current_out_stan_fr ;?>"/>
                                    <div class='word_below orange'><b class='money_format current_out_stan_fr_value_formt'></b></div>
                                    <label for="current_out_stan_fr" class="label-tag optional-tag">Outstanding Amount</label>
                                </div>

                                <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_card_4">
                                    <span class="fa-icon fa-sort-numeric-asc"></span>
                                    <input type="tel" class="text form-control numonly ext_card_4" name="credit_card_vintage_fr" maxlength="6" id="credit_card_vintage_fr" value="<?php echo ($credit_card_vintage_fr == 0) ? '' : $credit_card_vintage_fr ;?>"/>
                                    <label for="credit_card_vintage_fr" class="label-tag">Credit Card Vintage</label>
                                </div>
                                <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_card_4"></div>
                                <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_card_4"></div>

                        <!-- Existing Card 5 -->
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_card_5">
                            <span class="fa-icon fa-bank"></span>
                            <?php echo get_dropdown('bank_name_','credit_bank_id_fv',$credit_bank_id_fr,'class="ext_card_5"'); ?>
                            <label for="credit_bank_id_fv" class="label-tag">Bank</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_card_5">
                                    <span class="fa-icon fa-inr"></span>
                                    <!-- <input type="tel" class="text form-control numonly ext_card_5" name="credit_sanction_amt_fv" maxlength="10" id="credit_sanction_amt_fv" min='1000' value="<?php //echo $credit_sanction_amt_fv == 0?'': $credit_sanction_amt_fv ;?>"/> -->
                                    <input type="tel" class="text form-control numonly ext_card_5 loan_net_incm" name="credit_sanction_amt_fv" maxlength="10" id="credit_sanction_amt_fv" min='1000' value="<?php echo $credit_sanction_amt_fv == 0?'': $credit_sanction_amt_fv ;?>"/>
                                    <div class='word_below orange'><b class='money_format current_out_stan_fr_value_formt'></b></div>
                                    <label for="credit_sanction_amt_fv" class="label-tag">Credit Limit</label>
                                </div>
                                <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_card_5">
                                    <span class="fa-icon fa-inr"></span>
                                    <input type="tel" class="text form-control numonly ext_card_5 loan_net_incm" name="current_out_stan_fv" maxlength="10" id="current_out_stan_fv" value="<?php echo $current_out_stan_fv ;?>"/>
                                    <div class='word_below orange'><b class='money_format current_out_stan_fv_value_formt'></b></div>
                                    <label for="current_out_stan_fv" class="label-tag optional-tag">Outstanding Amount</label>
                                </div>

                                <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_card_5">
                                    <span class="fa-icon fa-sort-numeric-asc"></span>
                                    <input type="tel" class="text form-control numonly ext_card_5" name="credit_card_vintage_fv" maxlength="6" id="credit_card_vintage_fv" value="<?php echo ($credit_card_vintage_fv == 0) ? '' : $credit_card_vintage_fv ;?>"/>
                                    <label for="credit_card_vintage_fv" class="label-tag">Credit Card Vintage</label>
                                </div>

                            <?php } ?>
                            <div class="text-center col-12 mb-2"><input type="button" class="btn btn-primary" name="edit_temp" id="step2-temp" value="Edit">&nbsp;&nbsp;&nbsp;
                                <input type="button" class="btn btn-primary" name="submit" id="step2" value="SUBMIT">
                            </div>                        
                    </form> 
                    <div class="gray col-12 font-weight-nb pb-2 pt-2 blue-bg font-20 brdr-top-gray pe-none" data-toggle="step3">STEP 3 : Offers Details</div>   
                   <form action="" class="form-step" id="form_step3" style="display:none">
                    <input type="hidden" name="cust_id" value="<?php echo $cust_id; ?>">
                    <input type="hidden" name="case_id" class="case_id_received" id="case_id" value="<?php echo $case_id ?>">
                    <input type="hidden" name="loan_type" value="<?php echo $loan_type ?>">
                        <div class="col-12 pt-2 pb-3" id="new_offers_journey"></div>
                        <?php if($pan_card != '' && strlen($pan_card) == 10){ 
                                $check_pan_card_duplicacy_qry = mysqli_query($Conn1,"select * from tbl_mint_customer_info where pan_card = '".$pan_card."' and pan_card != '' and pan_card IS NOT NULL ORDER BY id DESC");
                                $total_phone_no_mapped = mysqli_num_rows($check_pan_card_duplicacy_qry);
                            }
                            if($pan_card == '' || strlen($pan_card) != 10 || $total_phone_no_mapped < 2){
                        ?>
                        <div class="text-center col-12 mb-2">
                            <input type="button" class="btn btn-primary" name="submit" id="step3" value="SUBMIT">
                        </div>
                    <?php }else{
                        echo "<span class='red'>Either city marked as others or pan no already mapped with other customer. Either change pan no or city to continue!</span>";
                    } ?>
                    </form>
                    <div class="gray col-12 font-weight-nb pb-2 pt-2 blue-bg font-20 brdr-top-gray" data-toggle="step4">STEP 4 : Add Follow Up</div>   
                    <?php if(in_array($user,$user_new_status) || in_array($loan_type,$loan_type_new_status) || new_staus_user_level == 1 ||  new_staus_loan_type_level == 1){ $level_id =2; ?>
                        <form action="" class="form-step" id="form_step4" style="display:none">
                        <input type="hidden" name="cust_id" value="<?php echo $cust_id; ?>">
                    <input type="hidden" name="case_id_follow" class="case_id_received" id="case_id_received" value="<?php echo $case_id ?>">
                     <input type="hidden" name="lead_view_id" value="<?php echo $lead_view_id; ?>">
                    <input type="hidden" name="click_to_call_id" id="click_to_call_id" class="click_to_call_id" value="">
                        <div class="form-group col-xl-2" style="margin-left: -45px;">
                            <input type="checkbox" name="case_hot_case" class="hot_case" id="case_hot_case" value="1" <?php echo ($hotcase == 1) ? "checked" : ""; ?> >
                            <label for="case_hot_case" class="checkbox green f_14">Hot Case</label>
                        </div>
                        <?php
                        if(in_array($loan_type, $fos_loan_type)) { ?>
                        <div class="form-group col-xl-2" style="margin-left: -85px;margin-right: -55px;">
                            <input type="checkbox" name="fos_check" class="fos_check" id="fos_check" value="1" <?php echo ($is_fos == 1) ? "checked" : ""; ?> >
                            <label for="fos_check" class="checkbox green f_14">FOS</label>
                        </div>
                    <?php } ?>
                        <div class="form-group col-xl-2 col-lg-4 col-md-6">
        <span class="fa-icon fa-list-alt"></span>
        <?php $level_id = 2;echo get_dropdown('status_', 'case_f_stats', '', 'class="required valid" onchange = "case_cng_status(this);" required'); 
        $level_id = 1;?>
        <label for="case_f_stats" class="label-tag">Select Status</label>
        </div>
        <div class="form-group col-xl-2 col-lg-4 col-md-6 case_f_sub_stats hidden">
        <span class="fa-icon fa-list-alt"></span>
        <select name="case_f_sub_stats" id = "case_f_sub_stats" class="hidden valid" onchange = "case_cng_status(this);"></select>
        <label for="case_f_sub_stats" class="label-tag">Select Sub Status</label>
        </div>
        <div class="form-group col-xl-2 col-lg-4 col-md-6 case_f_sub_sub_stats hidden">
        <span class="fa-icon fa-list-alt"></span>
        <select name="case_f_sub_sub_stats" id = "case_f_sub_sub_stats" class="hidden valid" onchange = "case_cng_status(this);"></select>
        <label for="case_f_sub_sub_stats" class="label-tag">Select Sub Sub Status</label>
        </div>

        <!-- Check Box New statuses starts -->
        <div class="new-heading-offers case_sub_status_div hidden">
            <div class="new-exclamatry-text">Sub Status</div>
        </div>
        <div class="row div-width hidden case_sub_status_div ml4" id="case_sub_status_div"></div>
        <div class="new-heading-offers case_sub_sub_status_div hidden">
            <div class="new-exclamatry-text">Sub Sub Status</div>
        </div>
        <div class="row div-width hidden case_sub_sub_status_div ml4 error_contain" id="case_sub_sub_status_div">
        </div>
        <div class="new-heading-offers case_sub_status_div hidden"></div>
        <!-- Checkbox new statuses ends -->

        <div class="form-group col-xl-2 col-lg-4 col-md-6 hidden case_foll_type">
        <span class="fa-icon fa-tty"></span>
        <?php echo get_dropdown('follow_up_type', 'case_foll_type', '', 'class="valid"'); ?>
        <label for="case_foll_type" class="label-tag">Select Follow Up Type</label>
        </div>
    <?php
if (in_array($loan_type, $language_barrier_loan_type)) {?>
    <div class="form-group col-xl-2 col-lg-4 col-md-6 case_languages hidden">
        <span class="fa-icon fa-language"></span>
        <?php
    echo get_dropdown("languages", "case_languages", $lang_id, "onchange='case_fetch_users_by_lang(this);' class='hidden valid'");?>
    <label for="case_languages" class="label-tag">Select Language</label>
        </div>
        <?php
$language_users_query = "SELECT tbl_language_user_map.user_id AS user_id, tbl_user_assign.user_name AS user_name FROM tbl_language_user_map INNER JOIN tbl_user_assign ON tbl_user_assign.user_id = tbl_language_user_map.user_id WHERE tbl_language_user_map.status = 1 AND loan_type = $loan_type ";
    $language_users_execute = mysqli_query($Conn1, $language_users_query);
    ?>
    <div class="form-group col-xl-2 col-lg-4 col-md-6 case_lang_users hidden">
        <span class="fa-icon fa-user"></span>
            <select name='case_lang_users' id='case_lang_users' class='case_lang_users hidden valid'>
                <option value=''>Select Users</option>
            <?php
while ($language_users_result = mysqli_fetch_array($language_users_execute)) {
        $selected_var = ($language_users_result['user_id'] == $lang_user_id) ? "selected" : "";
        ?>
                <option value="<?php echo $language_users_result['user_id']; ?>" <?php echo $selected_var; ?>><?php echo $language_users_result['user_name']; ?></option>
                <?php
}
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

                    <?php } else{ ?>
                    <form action="" class="form-step" id="form_step4" style="display:none">
                        <input type="hidden" name="cust_id" value="<?php echo $cust_id; ?>">
                    <input type="hidden" name="case_id_follow" class="case_id_received" id="case_id_received" value="<?php echo $case_id ?>">
                     <input type="hidden" name="lead_view_id" value="<?php echo $lead_view_id; ?>">
                    <input type="hidden" name="click_to_call_id" id="click_to_call_id" value="">
                        <div class="form-group col-xl-2 col-lg-4 col-md-6">
                            <input type="checkbox" name="hot_lead" class="hot_case" id="hot_case_fup" value="1" <?php echo ($hotcase == 1) ? "checked" : ""; ?> >
                            <label for="hot_case_fup" class="checkbox green f_14">Hot Case</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-4 col-md-6">
                            <span class="fa-icon fa-list-alt"></span>
                            <?php echo get_dropdown('case_status', 'case_f_stats', '', 'onchange="cng_case_status(this.value);" style="width: 100% !important" required'); ?>
                            <label for="case_f_stats" class="label-tag">Case Status</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-4 col-md-6">
                            <span class="fa-icon fa-tty"></span>
                            <?php get_dropdown('follow_up_type', 'case_foll_type', '', 'onchange="cng_followup_type(this.value);" style="width: 100% !important"'); ?>
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
                        if(in_array($loan_type, $fos_loan_type)) {
                        ?>
                        <div class="form-group col-xl-2 col-lg-4 col-md-6 fos_flag">
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
                            <select name="fos_user_id" id="fos_users" class="fos_users" style='100% !important'>
                            </select>
                            <label for="fos_users" class="label-tag">FOS User</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-4 col-md-6 fos_add">
                            <span class="fa-icon fa-home"></span>
                            <textarea class="text valid form-control alpha-num removeSpecial" name="fos_address" id="fos_address" placeholder="Customer Address for FOS" autocomplete="off"><?php echo $fos_address; ?></textarea>
                            <label for="fos_address" class="label-tag">FOS Address</label>
                        </div>
                        <?php
                        }$level_id =1;
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
                <?php } ?>
                </div>
            </div>

            <?php
            $tc_loan_type_arr = array('56', '51', '54', '52', '11', '63', '71', '60');
            ?>
            <?php if(in_array($loan_type, $tc_loan_type_arr)) { ?>
                <div id="slide-tc-script" class="fabs-telecaller" style="bottom: 66%; position: fixed; margin: 1em; right: 0;">
                    <a style='display: block; width: 50px; height: 50px; border-radius: 50%; text-align: center; color: white; margin: 0; box-shadow: 0px 5px 11px -2px rgba(0, 0, 0, 0.18), 0px 4px 12px -7px rgba(0, 0, 0, 0.15); cursor: pointer; -webkit-transition: all .1s ease-out; transition: all .1s ease-out; position: relative; background-color: #EB9B42' target="_blank" class="fab" tooltip="Share" title="Telecaller Script"><i style='position: inherit; color: #fff;' class="fa-icon fa-file"></i></a>
                </div>
                <?php include("../insert/telecaller_script.php"); ?>
            <?php } ?>
            <!-- <div class="col-3 pl-0 pr-0">
                <?php //include("../insert/telecaller_script.php"); ?>
                <div class='mt-4'>
                        <?php //if ($fin_opt_bank != '') { ?><p class='orange center'>Customer Applied Banks</p>
                            <hr><br>
                            <span class='green f_13'> <?php //echo $apply_bnk_name; ?></span>
                            <hr><br> <?php //} ?>
                        <p class='orange center'>Agent Offered Banks</p><br>
                        <hr><br>
                        <?php
                        // if (($loan_type == 51 || $loan_type == 52 || $loan_type == 54) && $prop_city != 0) {
                        //     $fil_city_id = $prop_city;
                        // } else {
                        //     $fil_city_id = $city_id;
                        // }
                        // $loan_obj = new loan_filtering($phone, $loan_type, $occup, $net_incm, $loan_amt, $fil_city_id, $pin_code, $annual_turnover_num,$comp_id,$loan_in_past,$main_account,$loan_in_past,$comp_name,$diff,$cibil_score);
                        ?>
                    </div>
            </div> -->
        </section>
    </main>
    <?php
    //if($user == 173 || $user == 83 || $user == 162) {
        include("../insert/form-popup.php");
    //}
    ?>

    <?php include('../../include/loader.php') ?>
    <script>
        var negative_ques_val = '<?php echo $property_negative_ques ?>';
        var industry_id = '<?php echo $industry_id; ?>';
        var user_role = "<?php echo $_SESSION['user_role']; ?>";
        var one_lead = "<?php echo $_SESSION['one_lead_flag']; ?>";
    </script>
<script src="../../include/js/common-function.js"></script> 
<?php if(in_array($user,$user_new_status) || in_array($loan_type,$loan_type_new_status) || new_staus_user_level == 1 ||  new_staus_loan_type_level == 1){ ?>
<script src="../../include/js/query-journey-new-status.js?v=15"></script>
<script src="../../include/js/case-follow-up.js?v=4"></script>
<?php } else{ ?>
<script src="../../include/js/query-journey.js?v=4"></script>
<?php } ?>
<script>
$(document).ready(function() {
    $("#slide-tc-script").click(function() {
        if(!$(".tc_div").hasClass("slider-extra-class")) {
            $(".tc_div").animate({"right":"1%"}, "slow");   
            $(".tc_div").addClass("slider-extra-class");
            $("#slide-tc-script").addClass("hidden");
        } else {
            $(".tc_div").animate({"right":"-30%"}, "slow");
            $(".tc_div").removeClass("slider-extra-class");
        }
    });

    $("#close-tc-slider").click(function() {
        $(".tc_div").animate({"right":"-30%"}, "slow");
        $(".tc_div").removeClass("slider-extra-class");
        $("#slide-tc-script").removeClass("hidden");
    })
});
</script>
<?php //if($user == 173 || $user == 83 || $user == 162) { ?>
    <script>
    function verify_popup(btn_id) {

        var email_id_val = $("#email").val().trim();
        var pan_card_val = ($("#pan_card").length) ? $("#pan_card").val().trim() : "";
        var phone_no_val = $("#unm_phone_no").val().trim();

        $("#btn_type_id").val(btn_id);

        //check if already verified
        $.ajax({
            type: "POST",
            url: "/sugar/insert/check-verification.php",
            data: "phone_no="+phone_no_val+"&email_id="+email_id_val+"&pan_card="+pan_card_val+"&cust_id=<?php echo $cust_id; ?>",
            success: function(resp) {
            }
        }).then(function(resp) {
            console.log(resp);
            var json_resp_new = JSON.parse(resp);
            if(json_resp_new.generic_verify == "0") {
                if(email_id_val != '' || pan_card_val != '' || phone_no_val != '') {
                    $("#verify_phone, #verify_phone_mode").val("");
                    $("#verify_email, #verify_email_mode").val("");
                    $("#verify_pan_card, #verify_mode").val("");

                    $(".dark-box").show();
                    $("#verification_popup").show();
                    $(".email-popup, #verify_email_div").addClass("hidden");
                    $(".pancard-popup, #verify_pancard_div").addClass("hidden");
                    $(".phone-popup, #verify_phone_div").addClass("hidden");

                    if(phone_no_val != '' && json_resp_new.phone_verify == "0") {
                        $(".phone-popup").removeClass("hidden");
                    }

                    if(email_id_val != '' && json_resp_new.email_verify == "0") {
                        $(".email-popup").removeClass("hidden");
                    }

                    if(pan_card_val != '' && json_resp_new.pancard_verify == "0") {
                        $(".pancard-popup").removeClass("hidden");
                    }
                } else {
                    $("#sf_flag").val(1);    
                }
            } else {
                $("#sf_flag").val(1);
            }
        });
    }

    function mov_field(e) {
        if(e.id == "verify_phone") {
            if(e.value == 1) {
                $("#verify_phone_div").removeClass("hidden");
            } else {
                $("#verify_phone_div").addClass("hidden");
            }
        }
        if(e.id == "verify_email") {
            if(e.value == 1) {
                $("#verify_email_div").removeClass("hidden");
            } else {
                $("#verify_email_div").addClass("hidden");
            }
        } 
        if(e.id == "verify_pan_card") {
            if(e.value == 1) {
                $("#verify_pancard_div").removeClass("hidden");
            } else {
                $("#verify_pancard_div").addClass("hidden");
            }
        }
    }
    </script>
<?php //} ?>