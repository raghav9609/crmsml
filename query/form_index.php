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
<div class="main-crmform col-12" style="margin-top:10px;">
    <div class="popup-ctext up-list-box">
        <h2 class='f_14 fw_bold'>Query Detail</h2>
        <br> 
        <ul>
            <?php 
                if ($employer_type == 0) {
                    $comp_name = $result_cust_data['comp_name_other'];
                } else if($loan_type == 11){
                    $comp_name = $hospital_name;
                }
                if($dob !='0000-00-00' && $dob != '1970-01-01'){
                    $dob1=$dob;
                    $diff = (date('Y') - date('Y',strtotime($dob1)));
                    $diff;
                } else {
                    $diff='';
                } 
                $fname = $name." ".$mname." " .$lname;
                $amt = custom_money_format($loan_amt);
   
                $nametext = trim($fname) != '' ? "<li><b class='fw_bold'>".ucfirst($fname)."</b> " : '<li><b class="fw_bold">Customer</b> '; 
                $dobtext = ($diff != '') ? " and customer age is&nbsp;&nbsp;<b class='fw_bold'>".$diff."</b>&nbsp;&nbsp;years </li>" : "</li>"  ;
                $citytext = (($city_name != '')? " and residing in <b class='fw_bold'> $city_name </b></li> " : "</li>") ;
                $occcc = get_name('master_code_id',$occup);
    
                $occuptext = (($occup != '' && $occup != 0) ? "<li>Customer is  <b class='fw_bold'>".$occcc['value']." </b>" : "");
                $loanamounttext = ($loan_amt != 0 && $loan_amt != '') ? " of <b class='fw_bold'> $amt </b>" : "";
                echo  $nametext." looking for a <b class='fw_bold'>".$loantype_name."</b>".$loanamounttext. $citytext.$occuptext.$dobtext.$accounttext; 
                $qry = "select ext.No_of_loans,ext.loan_type_1,ext.bank_name_1,ext.emi_1,ext.no_of_emi_1,ext.outstanding_amount_1,ext.loan_type_2,ext.bank_name_2,ext.emi_2,ext.no_of_emi_2,ext.outstanding_amount_2,ext.loan_type_3,ext.bank_name_3,ext.emi_3,ext.no_of_emi_3,ext.outstanding_amount_3,ext.loan_type_4,ext.bank_name_4,ext.emi_4,ext.no_of_emi_4,ext.outstanding_amount_4,ext.loan_type_5,ext.bank_name_5,ext.emi_5,ext.no_of_emi_5,ext.outstanding_amount_5,ext.no_of_cards,ext.credit_card_bank_name_exi_1,ext.credit_sanction_amt_1,ext.current_out_stan_1,ext.credit_card_vintage_1,ext.credit_card_bank_name_exi_2,ext.credit_sanction_amt_2,ext.current_out_stan_2,ext.credit_card_vintage_2,ext.credit_card_bank_name_exi_3,ext.credit_sanction_amt_3,ext.current_out_stan_3,ext.credit_card_vintage_3,ext.credit_card_bank_name_exi_4,ext.credit_sanction_amt_4,ext.current_out_stan_4,ext.credit_card_vintage_4,ext.credit_card_bank_name_exi_5,ext.credit_sanction_amt_5,ext.current_out_stan_5,ext.credit_card_vintage_5,ext.loan_in_past from  crm_customer_existing_loan_details as ext where ext.query_id = '".$ol_query_id."'";

                $res = mysqli_query($Conn1, $qry) or die("Error: " . mysqli_error($Conn1));
                $exe_form = mysqli_fetch_array($res);
            
                $exis_loans = $exe_form['No_of_loans']; 
                $loan_type_on1 = $exe_form['loan_type_1'];
                $bank_name_selected1 = $exe_form['bank_name_1'];
                $emi_loan_on_1 = $exe_form['emi_1'];
                $no_of_emis_paid_on_1 = $exe_form['no_of_emi_1'];
                $cur_out_stand_on_1 = $exe_form['outstanding_amount_1'];
                $loan_type_on2 = $exe_form['loan_type_1'];
                $bank_name_selected2 = $exe_form['bank_name_2'];
                $emi_loan_on_2 = $exe_form['emi_2'];
                $no_of_emis_paid_on_2 = $exe_form['no_of_emi_2'];
                $cur_out_stand_on_2 = $exe_form['outstanding_amount_2'];
                $loan_type_on3 = $exe_form['loan_type_3'];
                $bank_name_selected3 = $exe_form['bank_name_3'];
                $emi_loan_on_3 = $exe_form['emi_3'];
                $no_of_emis_paid_on_3 = $exe_form['no_of_emi_3'];
                $cur_out_stand_on_3 = $exe_form['outstanding_amount_3'];
                $loan_type_on4 = $exe_form['loan_type_4'];
                $bank_name_selected4 = $exe_form['bank_name_4'];
                $emi_loan_on_4 = $exe_form['emi_4'];
                $no_of_emis_paid_on_4 = $exe_form['no_of_emi_4'];
                $cur_out_stand_on_4 = $exe_form['outstanding_amount_4'];
                $loan_type_on5 = $exe_form['loan_type_5'];
                $bank_name_selected5 = $exe_form['bank_name_5'];
                $emi_loan_on_5 = $exe_form['emi_5'];
                $no_of_emis_paid_on_5 = $exe_form['no_of_emi_5'];
                $cur_out_stand_on_5 = $exe_form['outstanding_amount_5'];
                $credit_running = $exe_form['no_of_cards'];
                $credit_card_bank_name_exi_1 = $exe_form['credit_card_bank_name_exi_1'];
                $credit_sanction_amt_1 = $exe_form['credit_sanction_amt_1'];
                $current_out_stan_1 = $exe_form['current_out_stan_1'];
                $credit_card_vintage_1 = $exe_form['credit_card_vintage_1'];
                $credit_card_bank_name_exi_2 = $exe_form['credit_card_bank_name_exi_2'];
                $credit_sanction_amt_2 = $exe_form['credit_sanction_amt_2'];
                $current_out_stan_2 = $exe_form['current_out_stan_2'];
                $credit_card_vintage_2 = $exe_form['credit_card_vintage_2'];
                $credit_card_bank_name_exi_3 = $exe_form['credit_card_bank_name_exi_3'];
                $credit_sanction_amt_3 = $exe_form['credit_sanction_amt_3'];
                $current_out_stan_3 = $exe_form['current_out_stan_3'];
                $credit_card_vintage_3 = $exe_form['credit_card_vintage_3'];
                $credit_card_bank_name_exi_4 = $exe_form['credit_card_bank_name_exi_4'];
                $credit_sanction_amt_4 = $exe_form['credit_sanction_amt_4'];
                $current_out_stan_4 = $exe_form['current_out_stan_4'];
                $credit_card_vintage_4 = $exe_form['credit_card_vintage_4'];
                $credit_card_bank_name_exi_5 = $exe_form['credit_card_vintage_5'];
                $credit_sanction_amt_5 = $exe_form['credit_card_vintage_5'];
                $current_out_stan_5 = $exe_form['credit_card_vintage_5'];
                $credit_card_vintage_5 = $exe_form['credit_card_vintage_5'];
                $loan_in_past = $exe_form['loan_in_past'];

                if($user_role != 1){
                    $phone_number =  substr_replace($phone,'XXX',4,3);
                } else {
                    $phone_number =  $phone;
                }

                $alternate_phone = "";
                if(trim($alt_phone) != "") {
                    if($user_role != 1){
                        $alternate_phone = substr_replace($alt_phone, 'XXX', 4, 3);
                    } else {
                        $alternate_phone = $alt_phone;
                    }
                }
            ?>
        </ul>
    </div>
    <br>
</div>
<main> 
    <section class="d-flex flex-wrap">
        <div class="pl-md-3 pl-2 pr-md-3 pr-2 col-12">
            <div class="d-flex flex-wrap gen-box text-center white-bg pe-none">
                <div class="col-3 tab-click active-tab" data-toggle="step1">Personal Details</div>
                <div class="col-3 tab-click" data-toggle="step2"><?php if($loan_type != 71){ echo "Loan";}else{echo "Card";} ?> Details</div>
                <div class="col-3 tab-click active-tab hidden" data-toggle="step3">Offer Details</div>
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
                    <input type="hidden" name="sf_flag" id="sf_flag" value="0">
                    <input type="hidden" name="logged_in_user" id="logged_in_user" value="<?php echo $user; ?>">
                    <div class="row div-width">
                        <div class="form-group col-xl-2 col-lg-4 col-md-6">
                            <!-- <label for="salutation" class="radio-tag label-tag">Salutation</label> -->
                            <div class="radio-button error_contain">
                                <input type="radio" name="salutation" id="salutation1"  value="1" <?php if($salu_id == 1){ ?>checked <?php } ?> required>
                                <label for="salutation1">Mr.</label>
                                <input type="radio" name="salutation" id="salutation2" value="2" <?php if($salu_id == 2){ ?>checked <?php } ?> required>
                                <label for="salutation2">Ms.</label> 
                            </div>
                        </div>
                        <div class="form-group col-xl-2 col-lg-4 col-md-6">
                            <span class="fa-icon fa-user"></span>
                            <input type="text" id="name" name="name" value="<?php echo ($name) ;?>" placeholder="Enter Your First Name" class="form-control alphaonly" maxlength="20" required>
                            <label for="name" class="label-tag"> Name</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-4 col-md-6">
                            <span class="fa-icon fa-calendar"></span>
                            <input type="text" class="text form-control" name="dob" id="dob" maxlength="10" value="<?php echo $dob != '0000-00-00'?$dob:'';?>" placeholder="yyyy-mm-dd" <?php if(in_array($loan_type,array(71,11,57,63,56))){?> required <?php }?>/>
                            <label for="dob" class="label-tag <?php if(!in_array($loan_type,array(71,11,57,63,56))){ ?> optional-tag <?php } ?>">Date of Birth</label>
                            <span class='green' id='age' style="position: absolute;top: 100%;background: transparent;color: green;left: 15px;"></span>
                        </div>
                        <div class="form-group col-xl-2 col-lg-4 col-md-6">
                            <span class="fa-icon fa-mobile"></span>
                            <input type="tel" class="text form-control" name="phone_no" id="phone_no" maxlength="10" value="<?php echo $phone_number; ?>" <?php if($phone_ver_result['phone_ver_date'] != '' && $phone_ver_result['phone_ver_date'] != '1970-01-01' && $phone_ver_result['phone_ver_date'] != '0000-00-00') { ?> title="Verified @ : <?php echo date("d-m-Y", strtotime($phone_ver_result['phone_ver_date']))." ".$phone_ver_result['source']; ?>" <?php } ?> required/>

                            <?php if($phone_ver_result['phone_ver_date'] != '' && $phone_ver_result['phone_ver_date'] != '1970-01-01' && $phone_ver_result['phone_ver_date'] != '0000-00-00') { ?>
                                <label class="pointer_n" style="font-weight: bold;width: 25px;height: 18px;text-align: center;color: #1b8c1b;border-radius: 50%;right: 16px;left: auto;">✔</label>
                            <?php } ?>
                            <label for="phone_no" class="label-tag">Mobile</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-4 col-md-6">
                            <span class="fa-icon fa-mobile"></span>
                            <input type="tel" class="text form-control numonly" name="alt_phone_no" id="alt_phone_no" maxlength="10" value="<?php echo $alternate_phone;?>" />
                            <label for="alt_phone_no" class="label-tag optional-tag">Alternate Mob No.</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-4 col-md-6">
                            <span class="fa-icon fa-envelope"></span>
                            <input type="email" class="form-control" name="email" maxlength="50" id="email"  value="<?php echo ($email) ;?>"  required <?php if($email_ver_result['email_ver_date'] != '' && $email_ver_result['email_ver_date'] != '1970-01-01' && $email_ver_result['email_ver_date'] != '0000-00-00') { ?> title="Verified @ : <?php echo date("d-m-Y", strtotime($email_ver_result['email_ver_date']))." ".$email_ver_result['source']; ?>" <?php }  ?> />
                            <?php if($email_ver_result['email_ver_date'] != '' && $email_ver_result['email_ver_date'] != '1970-01-01' && $email_ver_result['email_ver_date'] != '0000-00-00' && trim($email) != '') { ?>
                                <label class="pointer_n" style="font-weight: bold;width: 25px;height: 18px;text-align: center;color: #1b8c1b;border-radius: 50%;right: 16px;left: auto;">✔</label>
                            <?php }  ?>
                            <label for="email" class="label-tag optional-tag ">Email</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-4 col-md-6">
                            <label for="maritalstatus" class="radio-tag label-tag optional-tag">Marital Status</label>
                            <div class="radio-button">
                                <input type="radio" name="maritalstatus" id="maritalstatus1"  value="1" <?php if($maritalstatus == "1"){ ?>checked <?php } ?>>
                                <label for="maritalstatus1">Married</label>
                                <input type="radio" name="maritalstatus" id="maritalstatus2" value="0" <?php if($maritalstatus == "0"){ ?>checked <?php } ?>>
                                <label for="maritalstatus2">UnMarried</label> 
                            </div>
                        </div>
                        <div class="form-group col-xl-2 col-lg-4 col-md-6">
                            <span class="fa-icon fa-pan"></span>
                            <input type="text" class="form-control" id="pan_card" name="pan_card" maxlength="10" placeholder="Pan Card" value="<?php echo ($pan_card); ?>"
                            <?php if($pan_card_ver_result['pan_ver_date'] != '' && $pan_card_ver_result['pan_ver_date'] != '1970-01-01' && $pan_card_ver_result['pan_ver_date'] != '0000-00-00') { ?> title="Verified @ : <?php echo date("d-m-Y", strtotime($pan_card_ver_result['pan_ver_date']))." ".$pan_card_ver_result['source']; ?>" <?php }  ?> >
                            <?php if($pan_card_ver_result['pan_ver_date'] != '' && $pan_card_ver_result['pan_ver_date'] != '1970-01-01' && $pan_card_ver_result['pan_ver_date'] != '0000-00-00' && trim($pan_card) != '') { ?>
                                <label class="pointer_n" style="font-weight: bold;width: 25px;height: 18px;text-align: center;color: #1b8c1b;border-radius: 50%;right: 16px;left: auto;">✔</label>
                            <?php }  ?>
                            <label for="pan_card" class="label-tag optional-tag ">Pan Card No.<span class='blue f_12'>(Take cibil consent)</span></label>
                        </div>
                        <div class="heading-offers">
                            <div class="exclamatry-text">Occupation Details</div>
                        </div>
                        <div class="form-group col-xl-2 col-lg-4 col-md-6">
                            <span class="fa-icon fa-briefcase"></span>
                            <?php echo get_dropdown('7','occupation_id',$occup,'required'); ?>
                            <label for="occupation" class="label-tag">Employment Type</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-4 col-md-6 salaried company_name_input">
                            <span class="fa-icon fa-industry"></span>
                            <input type="text" class="form-control alpha-num salaried" name="comp_name" id="comp_name" onfocusout="check_comp_name(this.value);" Placeholder="Company Name" maxlength="100" autocomplete="off" value="<?php echo $comp_name;?>" />
                            <label for="comp_name" class="label-tag">Company Name</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-4 col-md-6 salaried">
                            <span class="fa-icon fa-inr"></span>
                            <input type="tel" class="text form-control loan_net_incm numonly salaried" name="net_month_inc" id="net_month_inc" maxlength="9" value="<?php echo $net_incm ;?>" data-rule-min="10000" required/>
                            <?php 
                                $raw_details_nmi = mysqli_query($Conn1, "SELECT cust.net_income as r_nmi, qry.net_income AS lan_incm FROM crm_query As qry Inner JOIN crm_customer As cust ON qry.crm_customer_id = cust.id WHERE qry.id = '".$q_id."' order by cust.id ");
                                if(mysqli_num_rows($raw_details_nmi) > 0)  {
                                    $raw_details_result = mysqli_fetch_array($raw_details_nmi);
                                    $raw_details_nmi_val = custom_money_format($raw_details_result['r_nmi']);
                                    $raw_details_la_nmi  = ($raw_details_result['lan_incm'] != 0 && $raw_details_result['lan_incm'] != "") ? custom_money_format($raw_details_result['lan_incm']) : "";
                                }
                            ?>
                            <div class="bold blue clear f_9"><?php echo ($raw_details_la_nmi != "") ? "Assign on - ".$raw_details_la_nmi." /" : ""; ?> <?php echo ($raw_details_nmi_val != "") ? "NTH in Query - ".$raw_details_nmi_val : ""; ?></div>
                            <div class='word_below orange'><b class='money_format net_month_inc_value_formt'></b></div>
                            <label for="net_month_inc" class="label-tag">Net Monthly Income</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-4 col-md-6 salaried">
                            <span class="fa-icon fa-money"></span>
                            <?php echo get_dropdown('4','slry_paid',$salary_pay_id,'class="salaried"'); ?>
                            <label for="slry_paid" class="label-tag">Salary Paid By</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-4 col-md-6 main_acc hidden">
                            <span class="fa-icon fa-bank"></span>
                            <?php echo get_dropdown('2','main_acc',$main_account,'class="main_acc"'); ?>
                            <label for="main_acc" class="label-tag">Main Account</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-4 col-md-6 main_acc hidden">
                            <span class="fa-icon fa-bank"></span>
                            <input type="text" id="account_no" name="account_no" value="<?php echo $account_no ;?>" placeholder="Account Number" class="form-control alpha-num valid" maxlength="15">
                            <label for="account_no" class="label-tag optional-tag">Account Number</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-4 col-md-6 gar self_emp hidden">
                            <span class="fa-icon fa-inr"></span>
                            <input type="tel" class="form-control self_emp loan_net_incm numonly gar" maxlength="10" name="gross_annual_receipt" id="gross_annual_receipt" value="<?php echo $gross_annual_receipt == 0 ? '' : $gross_annual_receipt ;?>" />
                            <div class='word_below orange'><b class='money_format gross_annual_receipt_value_formt'></b></div>
                            <label for="gross_annual_receipt" class="label-tag">Gross Annual Receipt</label>
                        </div>
                        <div class="heading-offers">
                            <div class="exclamatry-text">Office Details</div>
                        </div>
                        <div class="form-group col-xl-2 col-lg-4 col-md-6">
                            <span class="fa-icon fa-envelope"></span>
                            <input type="email" class="form-control" name="ofc_email" maxlength="50" id="ofc_email" value="<?php echo ($ofc_email) ;?>"/>
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
                        </div>
                        <div class="form-group col-xl-2 col-lg-4 col-md-6">
                            <span class="fa-icon fa-briefcase"></span>
                            <input type="tel" class="text form-control numonly" name="ccwe" id="ccwe"  maxlength="4" required value="<?php echo (trim($ccwe) == 0) ? "" : $ccweget; ?>" />
                            <label for="ccwe" class="label-tag">Current Work Exp (In months)</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-4 col-md-6">
                            <span class="fa-icon fa-briefcase"></span>
                            <input type="tel" class="text form-control numonly" name="twe" id="twe" maxlength="4" required value="<?php echo (trim($twe) == 0) ? "" : $tweget; ?>" />
                            <label for="twe" class="label-tag">Total Work Exp (In months)</label>
                        </div>
                        <div class="heading-offers">
                            <div class="exclamatry-text">Residence Details</div>  
                        </div>
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
                        <div class="form-group col-xl-2 col-lg-4 col-md-6">
                            <span class="fa-icon fa-building"></span>
                            <textarea name="address" class="text valid form-control" id="address" maxlength="200" <?php if(in_array($loan_type,array(71,11,57,63))){echo "required";} ?>><?php echo $res_addrs ;?></textarea>
                            <label for="address" class="label-tag <?php if(!in_array($loan_type,array(71,11,57,63))){echo "optional-tag";} ?>">Residence Address</label>
                        </div>
                    </div>
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
                        <input type="hidden" name="user_id" id="user_id"  value="<?php echo $user;?>">
                        <input type="hidden" name="if_hot_case" id="if_hot_case" class="if_hot_case"  value="<?php echo $hotcase;?>">
                        <div class="row div-width">
                            <div class="form-group col-xl-2 col-lg-4 col-md-6 ">
                                <span class="fa-icon fa-amnt"></span>
                                <?php echo get_dropdown(1,'loan_type',$loan_type,'required'); ?>
                                <label for="loan_type" class="label-tag">Loan Type</label>
                            </div>
                              
                            <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                <span class="fa-icon fa-user"></span>
                                <input type="text" id="loan_amount" name="loan_amount" value="<?php echo ($loan_amt) ;?>" placeholder="Enter Required Loan Amount" class="form-control numonly" maxlength="20" required>
                                <label for="name" class="label-tag"> Loan Amount</label>
                            </div>
                            <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                <label for="loan_in_past" class="radio-tag label-tag">Any loan or credit card in past?</label>
                                <div class="boolean-button error_contain">
                                    <input type="radio" id="loan_in_past_yes" name="loan_in_past" required <?php if($loan_in_past == 1){echo "checked";} ?> value="1" >
                                    <label for="loan_in_past_yes" class="yes">Yes</label>
                                    <input type="radio" id="loan_in_past_no" name="loan_in_past" required <?php if($loan_in_past == 2){echo "checked";} ?> value="2" >
                                    <label for="loan_in_past_no" class="no">No</label> 
                                </div>
                            </div>
                            <div class="heading-offers bt_case">
                                <div class="exclamatry-text">Existing Loan Details</div>
                            </div>
                            <div class="form-group col-xl-2 col-lg-4 col-md-6 bt_case">
                                <span class="fa-icon fa-bank"></span>
                                <?php echo get_dropdown(13,'exs_bank_id',$exstn_bank,'class="bt_case"'); ?>
                                <label for="exs_bank_id" class="label-tag">Existing Bank</label>
                            </div>
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
                            <div class="form-group col-xl-2 col-lg-4 col-md-6 exis_tl bt_case">
                                <span class="fa-icon fa-inr"></span>
                                <input type="tel" class="text form-control loan_net_incm bt_case" name="ex_amt" maxlength="10" id="ex_amt" value="<?php echo $exstning_loan_amt ;?>" />
                                <div class='word_below orange'><b class='ex_amt_value_formt money_format'></b></div>
                                <label for="ex_amt" class="label-tag">Current Outstanding Amount </label>
                            </div>
                        </div>
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
                            <?php echo get_dropdown('1','loan_type_on_1',$loan_type_on1,'class="ext_loan_1"'); ?>
                            <label for="loan_type_on_1" class="label-tag">Loan Type</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_loan_1">
                            <span class="fa-icon fa-bank"></span>
                            <?php echo get_dropdown('2','bank_name_exi_1',$bank_name_selected1); ?>
                            <label for="bank_name_exi_1" class="label-tag">Bank</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_loan_1">
                            <span class="fa-icon fa-inr"></span>
                            <input type="tel" class="text form-control numonly ext_loan_1" name="emi_loan_on_1" maxlength="10" id="emi_loan_on_1" value="<?php echo $emi_loan_on_1 == 0 ?'': $emi_loan_on_1 ;?>"/>
                            <label for="emi_loan_on_1" class="label-tag optional-tag">EMI</label>
                        </div>

                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_loan_1">
                            <span class="fa-icon fa-sort-numeric-asc"></span>
                            <input type="tel" class="text form-control numonly ext_loan_1" name="no_of_emis_paid_on_1" maxlength="5" id="no_of_emis_paid_on_1" value="<?php echo ($no_of_emis_paid_on_1 == 0) ? "" : $no_of_emis_paid_on_1; ?>"/>
                            <label for="no_of_emis_paid_on_1" class="label-tag">No. of EMIs Paid</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_loan_1">
                            <span class="fa-icon fa-inr"></span>
                            <input type="tel" class="text form-control numonly ext_loan_1" name="cur_out_stand_on_1" maxlength="10" id="cur_out_stand_on_1" value="<?php echo $cur_out_stand_on_1 == 0?'': $cur_out_stand_on_1 ;?>"/>
                            <label for="cur_out_stand_on_1" class="label-tag optional-tag">Current OutStanding Amt.</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_loan_1"></div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_loan_2">
                            <span class="fa-icon fa-amnt"></span>
                            <?php echo get_dropdown('1','loan_type_on_2',$loan_type_on2,'class="ext_loan_2"'); ?>
                            <label for="loan_type_on_2" class="label-tag">Loan Type</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_loan_2">
                            <span class="fa-icon fa-bank"></span>
                            <!-- 'class="ext_loan_2"' -->
                            <?php echo get_dropdown('2','bank_name_exi_2',$bank_name_selected2); ?>
                            <label for="bank_name_exi_2" class="label-tag">Bank</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_loan_2">
                            <span class="fa-icon fa-inr"></span>
                            <input type="tel" class="text form-control numonly ext_loan_2" name="emi_loan_on_2" maxlength="10" id="emi_loan_on_2" value="<?php echo $emi_loan_on_2 == 0?'': $emi_loan_on_2 ;?>" />
                            <label for="emi_loan_on_2" class="label-tag optional-tag">EMI</label>
                        </div>

                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_loan_2">
                            <span class="fa-icon fa-sort-numeric-asc"></span>
                            <input type="tel" class="text form-control numonly ext_loan_2" name="no_of_emis_paid_on_2" maxlength="5" id="no_of_emis_paid_on_2" value="<?php echo ($no_of_emis_paid_on_2 == 0) ? "" : $no_of_emis_paid_on_2; ?>"/>
                            <label for="no_of_emis_paid_on_2" class="label-tag">No. of EMIs Paid</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_loan_2">
                            <span class="fa-icon fa-inr"></span>
                            <input type="tel" class="text form-control numonly ext_loan_2" name="cur_out_stand_on_2" maxlength="10" id="cur_out_stand_on_2" value="<?php echo $cur_out_stand_on_2 == 0?'': $cur_out_stand_on_2 ;?>"/>
                            <label for="cur_out_stand_on_2" class="label-tag optional-tag">Current OutStanding Amt.</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_loan_2"></div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_loan_3">
                            <span class="fa-icon fa-amnt"></span>
                            <?php echo get_dropdown('1','loan_type_on_3',$loan_type_on3,'class="ext_loan_3"'); ?>
                            <label for="loan_type_on_3" class="label-tag">Loan Type</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_loan_3">
                            <span class="fa-icon fa-bank"></span>
                            <?php echo get_dropdown('2','bank_name_exi_3',$bank_name_selected3); ?>
                            <label for="bank_name_exi_3" class="label-tag">Bank</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_loan_3">
                            <span class="fa-icon fa-inr"></span>
                            <input type="tel" class="text form-control numonly ext_loan_3" name="emi_loan_on_3" maxlength="10" id="emi_loan_on_3" value="<?php echo $emi_loan_on_3 == 0?'': $emi_loan_on_3 ;?>"/>
                            <label for="emi_loan_on_3" class="label-tag optional-tag">EMI</label>
                        </div>

                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_loan_3">
                            <span class="fa-icon fa-sort-numeric-asc"></span>
                            <input type="tel" class="text form-control numonly ext_loan_3" name="no_of_emis_paid_on_3" maxlength="5" id="no_of_emis_paid_on_3" value="<?php echo ($no_of_emis_paid_on_3 == 0) ? "" : $no_of_emis_paid_on_3; ?>"/>
                            <label for="no_of_emis_paid_on_3" class="label-tag">No. of EMIs Paid</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_loan_3">
                            <span class="fa-icon fa-inr"></span>
                            <input type="tel" class="text form-control numonly ext_loan_3" name="cur_out_stand_on_3" maxlength="10" id="cur_out_stand_on_3" value="<?php echo $cur_out_stand_on_3 == 0?'': $cur_out_stand_on_3 ;?>"/>
                            <label for="cur_out_stand_on_3" class="label-tag optional-tag">Current OutStanding Amt.</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_loan_3"></div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_loan_4">
                            <span class="fa-icon fa-amnt"></span>
                            <?php echo get_dropdown('1','loan_type_on_4',$loan_type_on_4,'class="ext_loan_4"'); ?>
                            <label for="loan_type_on_4" class="label-tag">Loan Type</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_loan_4">
                            <span class="fa-icon fa-bank"></span>
                            <?php echo get_dropdown('2','bank_name_exi_4',$bank_name_selected4); ?>
                            <label for="bank_name_exi_4" class="label-tag">Bank</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_loan_4">
                            <span class="fa-icon fa-inr"></span>
                            <input type="tel" class="text form-control numonly ext_loan_4" name="emi_loan_on_4" maxlength="10" id="emi_loan_on_4" value="<?php echo $emi_loan_on_4 == 0?'': $emi_loan_on_4 ;?>"/>
                            <label for="emi_loan_on_4" class="label-tag optional-tag">EMI</label>
                        </div>
                        
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_loan_4">
                            <span class="fa-icon fa-sort-numeric-asc"></span>
                            <input type="tel" class="text form-control numonly ext_loan_4" name="no_of_emis_paid_on_4" maxlength="5" id="no_of_emis_paid_on_4" value="<?php echo ($no_of_emis_paid_on_4 == 0) ? "" : $no_of_emis_paid_on_4; ?>"/>
                            <label for="no_of_emis_paid_on_4" class="label-tag">No. of EMIs Paid</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_loan_4">
                            <span class="fa-icon fa-inr"></span>
                            <input type="tel" class="text form-control numonly ext_loan_4" name="cur_out_stand_on_4" maxlength="10" id="cur_out_stand_on_4" value="<?php echo $cur_out_stand_on_4 == 0?'': $cur_out_stand_fr ;?>"/>
                            <label for="cur_out_stand_on_4" class="label-tag optional-tag">Current OutStanding Amt.</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_loan_4"></div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_loan_5">
                            <span class="fa-icon fa-amnt"></span>
                            <?php echo get_dropdown('1','loan_type_on_5',$loan_type_on_5,'class="ext_loan_5"'); ?>
                            <label for="loan_type_on_5" class="label-tag">Loan Type</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_loan_5">
                            <span class="fa-icon fa-bank"></span>
                            <?php echo get_dropdown('2','bank_name_exi_5',$bank_name_selected5);?>
                            <label for="bank_name_exi_5" class="label-tag">Bank</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_loan_5">
                            <span class="fa-icon fa-inr"></span>
                            <input type="tel" class="text form-control numonly ext_loan_5" name="emi_loan_on_5" maxlength="10" id="emi_loan_on_5" value="<?php echo $emi_loan_on_5 == 0?'': $emi_loan_on_5 ;?>"/>
                            <label for="emi_loan_on_5" class="label-tag optional-tag">EMI</label>
                        </div>
                        
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_loan_5">
                            <span class="fa-icon fa-sort-numeric-asc"></span>
                            <input type="tel" class="text form-control numonly ext_loan_5" name="no_of_emis_paid_on_5" maxlength="5" id="no_of_emis_paid_on_5" value="<?php echo ($no_of_emis_paid_on_5 == 0) ? "" : $no_of_emis_paid_on_5; ?>"/>
                            <label for="no_of_emis_paid_on_5" class="label-tag">No. of EMIs Paid</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_loan_5">
                            <span class="fa-icon fa-inr"></span>
                            <input type="tel" class="text form-control numonly ext_loan_5" name="cur_out_stand_on_5" maxlength="10" id="cur_out_stand_on_5" value="<?php echo $cur_out_stand_on_5 == 0?'': $cur_out_stand_on_5 ;?>"/>
                            <label for="cur_out_stand_on_5" class="label-tag optional-tag">Current OutStanding Amt.</label>
                        </div>
                        <!-- cardd -->
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_loan_5"></div>
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
                            <?php echo get_dropdown('2','credit_card_bank_name_exi_1',$credit_card_bank_name_exi_1); ?>
                            <label for="credit_card_bank_name_exi_1" class="label-tag">Bank</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_card_1">
                            <span class="fa-icon fa-inr"></span>
                            <input type="tel" class="text form-control numonly ext_card_1 loan_net_incm" name="credit_sanction_amt_1" min='1000' maxlength="10" id="credit_sanction_amt_1" value="<?php echo $credit_sanction_amt_1 == 0?'': $credit_sanction_amt_1 ;?>"/>
                            <div class='word_below orange'><b class='money_format credit_sanction_amt_on_value_formt'></b></div>
                            <label for="credit_sanction_amt_1" class="label-tag">Credit Limit</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_card_1">
                            <span class="fa-icon fa-inr"></span>
                            <input type="tel" class="text form-control numonly ext_card_1 loan_net_incm" name="current_out_stan_1" maxlength="10" id="current_out_stan_1" value="<?php echo $current_out_stan_1 ;?>"/>
                            <div class='word_below orange'><b class='money_format current_out_stan_on_value_formt'></b></div>
                            <label for="current_out_stan_1" class="label-tag optional-tag">Outstanding Amount</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_card_1">
                            <span class="fa-icon fa-sort-numeric-asc"></span>
                            <input type="tel" class="text form-control numonly ext_card_1" name="credit_card_vintage_1" maxlength="6" id="credit_card_vintage_1" value="<?php echo ($credit_card_vintage_1 == 0) ? '' : $credit_card_vintage_1 ;?>"/>
                            <label for="credit_card_vintage_1" class="label-tag">Credit Card Vintage</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_card_1"></div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_card_1"></div>
                        <!-- Existing Card 2 -->
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_card_2">
                            <span class="fa-icon fa-bank"></span>
                            <?php echo get_dropdown('2','credit_card_bank_name_exi_2',$credit_card_bank_name_exi_2); ?>
                            <label for="credit_bank_id_tw" class="label-tag">Bank</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_card_2">
                            <span class="fa-icon fa-inr"></span>
                            <input type="tel" class="text form-control numonly ext_card_2 loan_net_incm" name="credit_sanction_amt_2" min='1000' maxlength="10" id="credit_sanction_amt_2" value="<?php echo $credit_sanction_amt_2 == 0?'': $credit_sanction_amt_2 ;?>"/>
                            <div class='word_below orange'><b class='money_format credit_sanction_amt_tw_value_formt'></b></div>
                            <label for="credit_sanction_amt_2" class="label-tag">Credit Limit</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_card_2">
                            <span class="fa-icon fa-inr"></span>
                            <input type="tel" class="text form-control numonly ext_card_2 loan_net_incm" name="current_out_stan_2" maxlength="10" id="current_out_stan_2" value="<?php echo $current_out_stan_2 ;?>"/>
                            <div class='word_below orange'><b class='money_format current_out_stan_tw_value_formt'></b></div>
                            <label for="current_out_stan_2" class="label-tag optional-tag">Outstanding Amount</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_card_2">
                            <span class="fa-icon fa-sort-numeric-asc"></span>
                            <input type="tel" class="text form-control numonly ext_card_2" name="credit_card_vintage_2" maxlength="6" id="credit_card_vintage_2" value="<?php echo ($credit_card_vintage_2 == 0) ? '' : $credit_card_vintage_2 ;?>"/>
                            <label for="credit_card_vintage_2" class="label-tag">Credit Card Vintage</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_card_2"></div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_card_2"></div>

                        <!-- Existing Card 3 -->
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_card_3">
                            <span class="fa-icon fa-bank"></span>
                            <?php echo get_dropdown('2','credit_card_bank_name_exi_3',$credit_card_bank_name_exi_3) ?>
                            <label for="credit_card_bank_name_exi_3" class="label-tag">Bank</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_card_3">
                            <span class="fa-icon fa-inr"></span>
                            <input type="tel" class="text form-control numonly ext_card_3 loan_net_incm" name="credit_sanction_amt_3" maxlength="10" id="credit_sanction_amt_3" min='1000' value="<?php echo $credit_sanction_amt_3 == 0?'': $credit_sanction_amt_3 ;?>"/>
                            <div class='word_below orange'><b class='money_format credit_sanction_amt_th_value_formt'></b></div>
                            <label for="credit_sanction_amt_3" class="label-tag">Credit Limit</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_card_3">
                            <span class="fa-icon fa-inr"></span>
                            <input type="tel" class="text form-control numonly ext_card_3 loan_net_incm" name="current_out_stan_3" maxlength="10" id="current_out_stan_3" value="<?php echo $current_out_stan_3 ;?>"/>
                            <div class='word_below orange'><b class='money_format current_out_stan_th_value_formt'></b></div>
                            <label for="current_out_stan_3" class="label-tag optional-tag">Outstanding Amount</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_card_3">
                            <span class="fa-icon fa-sort-numeric-asc"></span>
                            <input type="tel" class="text form-control numonly ext_card_3" name="credit_card_vintage_3" maxlength="6" id="credit_card_vintage_3" value="<?php echo ($credit_card_vintage_3 == 0) ? '' : $credit_card_vintage_3 ;?>"/>
                            <label for="credit_card_vintage_3" class="label-tag">Credit Card Vintage</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_card_3"></div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_card_3"></div>

                        <!-- Existing Card 4 -->
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_card_4">
                            <span class="fa-icon fa-bank"></span>
                            <?php echo get_dropdown('2','credit_card_bank_name_exi_4',$credit_card_bank_name_exi_4)?>
                            <label for="credit_card_bank_name_exi_4" class="label-tag">Bank</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_card_4">
                            <span class="fa-icon fa-inr"></span>
                            <input type="tel" class="text form-control numonly ext_card_4 loan_net_incm" name="credit_sanction_amt_4" min='1000' maxlength="10" id="credit_sanction_amt_4" value="<?php echo $credit_sanction_amt_4 == 0?'': $credit_sanction_amt_4 ;?>"/>
                            <div class='word_below orange'><b class='money_format credit_sanction_amt_fr_value_formt'></b></div>
                            <label for="credit_sanction_amt_4" class="label-tag">Credit Limit</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_card_4">
                            <span class="fa-icon fa-inr"></span>
                            <input type="tel" class="text form-control numonly ext_card_4 loan_net_incm" name="current_out_stan_4" maxlength="10" id="current_out_stan_4" value="<?php echo $current_out_stan_4 ;?>"/>
                            <div class='word_below orange'><b class='money_format current_out_stan_fr_value_formt'></b></div>
                            <label for="current_out_stan_4" class="label-tag optional-tag">Outstanding Amount</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_card_4">
                            <span class="fa-icon fa-sort-numeric-asc"></span>
                            <input type="tel" class="text form-control numonly ext_card_4" name="credit_card_vintage_4" maxlength="6" id="credit_card_vintage_4" value="<?php echo ($credit_card_vintage_4 == 0) ? '' : $credit_card_vintage_4 ;?>"/>
                            <label for="credit_card_vintage_4" class="label-tag">Credit Card Vintage</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_card_4"></div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_card_4"></div>

                        <!-- Existing Card 5 -->
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_card_5">
                            <span class="fa-icon fa-bank"></span>
                            <?php echo get_dropdown('2','credit_card_bank_name_exi_5',$credit_card_bank_name_exi_5)?>
                            <label for="credit_bank_id_fv" class="label-tag">Bank</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_card_5">
                            <span class="fa-icon fa-inr"></span>
                            <input type="tel" class="text form-control numonly ext_card_5 loan_net_incm" name="credit_sanction_amt_fv" maxlength="10" id="credit_sanction_amt_5" min='1000' value="<?php echo $credit_sanction_amt_5 == 0?'': $credit_sanction_amt_5 ;?>"/>
                            <div class='word_below orange'><b class='money_format current_out_stan_fr_value_formt'></b></div>
                            <label for="credit_sanction_amt_5" class="label-tag">Credit Limit</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_card_5">
                            <span class="fa-icon fa-inr"></span>
                            <input type="tel" class="text form-control numonly ext_card_5 loan_net_incm" name="current_out_stan_5" maxlength="10" id="current_out_stan_5" value="<?php echo $current_out_stan_5 ;?>"/>
                            <div class='word_below orange'><b class='money_format current_out_stan_fv_value_formt'></b></div>
                            <label for="current_out_stan_5" class="label-tag optional-tag">Outstanding Amount</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_card_5">
                            <span class="fa-icon fa-sort-numeric-asc"></span>
                            <input type="tel" class="text form-control numonly ext_card_5" name="credit_card_vintage_5" maxlength="6" id="credit_card_vintage_5" value="<?php echo ($credit_card_vintage_5 == 0) ? '' : $credit_card_vintage_5 ;?>"/>
                            <label for="credit_card_vintage_4" class="label-tag">Credit Card Vintage</label>
                        </div>
                        <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_card_5 hidden">
                            <span class="fa-icon fa-sort-numeric-asc"></span>
                            <input type="tel" class="text form-control numonly " name="query_id" maxlength="6" id="query_id" value="<?php echo $query_id;?>"/>
                        </div>
                        <div class="text-center col-12 mb-2">
                            <input type="button" class="btn btn-primary" name="edit_temp" id="step2-temp" value="Edit">&nbsp;&nbsp;&nbsp;
                            <input type="button" class="btn btn-primary" name="submit" id="step2" value="SUBMIT">
                        </div>                        
                    </form> 
                    <div class="gray col-12 font-weight-nb pb-2 pt-2 blue-bg font-20 brdr-top-gray pe-none" data-toggle="step3">STEP 3 : Offers Details</div>   
                   <form action="" class="form-step" id="form_step3" style="display:none">
                    <input type="hidden" name="cust_id" value="<?php echo $cust_id; ?>">
                    <input type="hidden" name="case_id" class="case_id_received" id="case_id" value="<?php echo $case_id ?>">
                    <!-- <input type="text" name="loan_type" value="<?php echo $loan_type ?>"> -->
                    <?php //include('../offers/index.php'); ?>
                        <div class="col-12 pt-2 pb-3" id="new_offers_journey"></div>
                        <?php if($pan_card != '' && strlen($pan_card) == 10){ 
                                $check_pan_card_duplicacy_qry = mysqli_query($Conn1,"select * from crm_customer where pan_no = '".$pan_card."' and pan_no != '' and pan_no IS NOT NULL ORDER BY id DESC");
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
                </div>
            </div>
        </section>
    </main>
    <?php
        include("../insert/form-popup.php");
        include('../include/loader.php');
    ?>

<script src="../assets/js/common-function-call.js"></script> 
<script src="../assets/js/query-journey.js?v=5"></script>