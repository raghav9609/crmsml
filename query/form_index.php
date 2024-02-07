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
    // echo $exe_form['loan_type_1'];

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
    
    $occuptext = (($occup != '' && $occup != 0) ? "<li>Customer is  <b class='fw_bold'>".$occcc['value']." </b>" : "");
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
        $qry = "select ext.No_of_loans,ext.loan_type_1,ext.bank_name_1,ext.emi_1,ext.no_of_emi_1,ext.outstanding_amount_1,ext.loan_type_2,ext.bank_name_2,ext.emi_2,ext.no_of_emi_2,ext.outstanding_amount_2,ext.loan_type_3,ext.bank_name_3,ext.emi_3,ext.no_of_emi_3,ext.outstanding_amount_3,ext.loan_type_4,ext.bank_name_4,ext.emi_4,ext.no_of_emi_4,ext.outstanding_amount_4,ext.loan_type_5,ext.bank_name_5,ext.emi_5,ext.no_of_emi_5,ext.outstanding_amount_5,ext.no_of_cards,ext.credit_card_bank_name_exi_1,ext.credit_sanction_amt_1,ext.current_out_stan_1,ext.credit_card_vintage_1,ext.credit_card_bank_name_exi_2,ext.credit_sanction_amt_2,ext.current_out_stan_2,ext.credit_card_vintage_2,ext.credit_card_bank_name_exi_3,ext.credit_sanction_amt_3,ext.current_out_stan_3,ext.credit_card_vintage_3,ext.credit_card_bank_name_exi_4,ext.credit_sanction_amt_4,ext.current_out_stan_4,ext.credit_card_vintage_4,ext.credit_card_bank_name_exi_5,ext.credit_sanction_amt_5,ext.current_out_stan_5,ext.credit_card_vintage_5 from  crm_customer_existing_loan_details as ext where ext.query_id = '".$ol_query_id."'";

        $res = mysqli_query($Conn1, $qry) or die("Error: " . mysqli_error($Conn1));
        $exe_form = mysqli_fetch_array($res);
        // print_r($exe_form);
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

        
        
        ?>
    </div>


</div>
    <main> 
    <section class="d-flex flex-wrap">
    <div class="pl-md-3 pl-2 pr-md-3 pr-2 col-12">
        <div class="d-flex flex-wrap gen-box text-center white-bg pe-none">
            <div class="col-3 tab-click active-tab" data-toggle="step1">Personal Details</div>
            <div class="col-3 tab-click" data-toggle="step2"><?php if($loan_type != 71){ echo "Loan";}else{echo "Card";} ?> Details</div>
            <div class="col-3 tab-click active-tab" data-toggle="step3">Offer Details</div>
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
                                <input type="text" id="name" name="name" value="<?php echo ($name) ;?>" placeholder="Enter Your First Name" class="form-control alphaonly" maxlength="20" required>
                                <label for="name" class="label-tag"> Name</label>
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
                                    <?php $raw_details_nmi = mysqli_query($Conn1, "SELECT cust.net_income as r_nmi, qry.net_income AS lan_incm FROM crm_query As qry Inner JOIN crm_customer As cust ON qry.crm_customer_id = cust.id WHERE qry.id = '".$q_id."' order by cust.id ");
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
                          
                                    <!-- <div class="col-12 mb-2">
                                        <h4>Saving Accounts WIth</h4>
                                        <span>
                                        <input type="checkbox" class="bank_offers_checkbox" name="saving_acc_with_banks[]" id="saving_acc_with_banks25" value="25" <?php // if(in_array(25,$saving_accounts_with)){ echo "checked"; } ?> >
                                        <label for="saving_acc_with_banks25" class="checkbox">Axis Bank</label></span>
                                        
                                        <span><input type="checkbox" class="bank_offers_checkbox" name="saving_acc_with_banks[]" id="saving_acc_with_banks33" value="33" <?php //if(in_array(33,$saving_accounts_with)){ echo "checked"; } ?> >
                                        <label for="saving_acc_with_banks33" class="checkbox">ICICI Bank</label></span>
                                        
                                        <span><input type="checkbox" class="bank_offers_checkbox" name="saving_acc_with_banks[]" id="saving_acc_with_banks40" value="40" <?php //if(in_array(40,$saving_accounts_with)){ echo "checked"; } ?> >
                                        <label for="saving_acc_with_banks40" class="checkbox">Kotak Bank</label></span>
                                        
                                        <span><input type="checkbox" class="bank_offers_checkbox" name="saving_acc_with_banks[]" id="saving_acc_with_banks32" value="32" <?php //if(in_array(32,$saving_accounts_with)){ echo "checked"; } ?> >
                                        <label for="saving_acc_with_banks32" class="checkbox">HDFC Bank</label></span>
                                        
                                        <span><input type="checkbox" class="bank_offers_checkbox" name="saving_acc_with_banks[]" id="saving_acc_with_banks35" value="35" <?php //if(in_array(35,$saving_accounts_with)){ echo "checked"; } ?> >
                                        <label for="saving_acc_with_banks35" class="checkbox">IDFC First Bank</label></span>
                                        
                                        <span><input type="checkbox" class="bank_offers_checkbox" name="saving_acc_with_banks[]" id="saving_acc_with_banks29" value="29" <?php //if(in_array(29,$saving_accounts_with)){ echo "checked"; } ?> >
                                        <label for="saving_acc_with_banks29" class="checkbox">DCB Bank</label></span>
                                    </div> -->

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
                                    <label for="twe" class="label-tag">Total Work Exp (In months))</label>
                                </div>
                          
                                <div class="heading-offers">
                                    <div class="exclamatry-text">Residence Details</div>   
                                </div>
                        
                                    <!-- <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                    <span class="fa-icon fa-home"></span>
                                    <?php //echo get_dropdown('residential_type', 'residential_type', $rented_id, 'required'); ?>
                                    <label for="residential_type" class="label-tag">Type of Residence</label>
                                </div> -->
                            
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
                        <input type="hidden" name="if_hot_case" id="if_hot_case" class="if_hot_case"  value="<?php echo $hotcase;?>">
                            <div class="row div-width">
                                <div class="form-group col-xl-2 col-lg-4 col-md-6 hidden">
                                    <span class="fa-icon fa-amnt"></span>
                                    <?php echo get_dropdown(1,'loan_type',$loan_type,'required'); ?>
                                    <label for="loan_type" class="label-tag">Loan Type</label>
                                </div>
                              
                                <!-- <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                    <span class="fa-icon fa-search"></span>
                                    <?php // echo get_dropdown('purpose_of_loan', 'purpose_of_loan', $purpose_of_loan, 'required'); ?>
                                    <label for="purpose_of_loan" class="label-tag">Purpose of Loan</label>
                                </div> -->
                                <div class="form-group col-xl-2 col-lg-4 col-md-6">
                                    <label for="loan_in_past" class="radio-tag label-tag">Any loan or credit card in past?</label>
                                    <div class="boolean-button error_contain">
                                        <input type="radio" id="loan_in_past1" name="loan_in_past" required <?php if($loan_in_past == 1){echo "checked";} ?> value="1" >
                                        <label for="loan_in_past1" class="yes">Yes</label>
                                        <input type="radio" id="loan_in_past2" name="loan_in_past" required <?php if($loan_in_past == 2){echo "checked";} ?> value="2" >
                                        <label for="loan_in_past2" class="no">No</label> 
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
                                    <option value="2"<?php  if(2 == $credit_running){?>selected="selected"<?php }?>>2</option>
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
                                    <!-- <input type="tel" class="text form-control numonly ext_card_5" name="credit_sanction_amt_fv" maxlength="10" id="credit_sanction_amt_fv" min='1000' value="<?php //echo $credit_sanction_amt_fv == 0?'': $credit_sanction_amt_fv ;?>"/> -->
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
                                    <input type="tel" class="text form-control numonly ext_card_5" name="credit_card_vintage_4" maxlength="6" id="credit_card_vintage_4" value="<?php echo ($credit_card_vintage_4 == 0) ? '' : $credit_card_vintage_4 ;?>"/>
                                    <label for="credit_card_vintage_4" class="label-tag">Credit Card Vintage</label>
                                </div>

                            <div class="form-group col-xl-2 col-lg-3 col-md-6 ext_card_5 hidden">
                                <span class="fa-icon fa-sort-numeric-asc"></span>
                                <input type="tel" class="text form-control numonly " name="query_id" maxlength="6" id="query_id" value="<?php echo $query_id;?>"/>
                            </div>
                            <div class="text-center col-12 mb-2"><input type="button" class="btn btn-primary" name="edit_temp" id="step2-temp" value="Edit">&nbsp;&nbsp;&nbsp;
                                <input type="button" class="btn btn-primary" name="submit" id="step2" value="SUBMIT">
                            </div>                        
                    </form> 
                    <div class="gray col-12 font-weight-nb pb-2 pt-2 blue-bg font-20 brdr-top-gray pe-none" data-toggle="step3">STEP 3 : Offers Details</div>   
                   <form action="" class="form-step" id="form_step3" style="display:none">
                    <input type="hidden" name="cust_id" value="<?php echo $cust_id; ?>">
                    <input type="hidden" name="case_id" class="case_id_received" id="case_id" value="<?php echo $case_id ?>">
                    <input type="text" name="loan_type" value="<?php echo $loan_type ?>">
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
                    <div class="gray col-12 font-weight-nb pb-2 pt-2 blue-bg font-20 brdr-top-gray" data-toggle="step4">STEP 4 : Add Follow Up</div>   
                    <?php
                    $user_new_status = [];
                    $loan_type_new_status = [];
                     if(in_array($user,$user_new_status) || in_array($loan_type,$loan_type_new_status)){ 
                         $level_id =2; ?>
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
                            <?php $level_id = 2;
                                //echo get_dropdown('status_', 'case_f_stats', '', 'class="required valid" onchange = "case_cng_status(this);" required'); 
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
        <?php //echo get_dropdown('follow_up_type', 'case_foll_type', '', 'class="valid"'); ?>
        <label for="case_foll_type" class="label-tag">Select Follow Up Type</label>
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

                    <?php } else{  ?>
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
<script src="../assets/js/query-journey-new-status.js?v=16"></script>
<script src="../assets/js/case-follow-up.js?v=4"></script>
<?php } else{ ?>
<script src="../assets/js/query-journey.js?v=5"></script>
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