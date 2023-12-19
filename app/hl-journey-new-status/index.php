<script src="../../include/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="../../include/js/format_amount.js"></script>
<link href="/sugar/all_query/hl-journey/assets/css/grid.css?v=1.1" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<style>
.set_amt_frmt {
    position: absolute;
    top: 2.5rem;
    font-size: 13px;
    width: 100%;
    text-align: right;
    right: 15px;
    color: green!important;
}
.money_format{
    font-size:10px!important;
}
.{
    display: flex !important;
}
.main-app-form {
    padding-left: 3.5rem!important; 
    padding-right: 3.5rem!important;
}
.open>.dropdown-menu {
    display: block;
}


.multiselect-container {
    position: absolute!important;
    list-style-type: none!important;;
    margin: 0!important;
    padding: 0!important;
}
.dropdown-menu {
    z-index: 1000;
    display: none;
    float: left;
    padding: 5px 0;
    margin: 2px 0 0;
    font-size: 14px;
    text-align: left;
    list-style: none;
    background-color: #fff;
    border: 1px solid #ccc;
      left: -208px;
    width: 256px;
}

.dropdown-menu>li>a {
    display: block;
    padding: 3px 20px;
    clear: both;
    font-weight: 400;
    line-height: 1.42857143;
    color: #333;
    white-space: nowrap;
}
.multiselect{margin-top: 11px;border-radius: 0px!important;box-shadow: none!important;}

.multiselect-container>li>a {
    padding: 0;
}
b.caret{
    margin-left:228px!important;
    display: inline;
}

.dropdown-menu>li>a:focus, .dropdown-menu>li>a:hover {
    color: #262626;
    text-decoration: none;
    background-color: #f5f5f5;
}

.checkbox, .radio {
    position: relative;
    display: block;
    margin-top: 10px;
    margin-bottom: 10px;
}

.multiselect-container>li>a>label {
    margin: 0;
    height: 100%;
    cursor: pointer;
    font-weight: 400;
}


.multiselect-container>li>a>label.checkbox, .multiselect-container>li>a>label.radio {
    margin: 0;
}

.dropdown-menu>li>a {
    display: block;
    padding: 3px 20px;
    clear: both;
    font-weight: 400;
    line-height: 1.42857143;
    color: #333;
    white-space: nowrap;
}
.form-group label {
    font-size: 13px;
    font-weight: 500;
    width: 100px;
    color: #636363;
    display: block;
    background: #ffffff;
    padding: 3px 0px!important 0px 0px;
    cursor: text;
    -webkit-transition: all .3s ease 0ms;
    -moz-transition: all .3s ease 0ms;
    -ms-transition: all .3s ease 0ms;
    -o-transition: all .3s ease 0ms;
    transition: all .3s ease 0ms;
}
.add_checkbox{
    position: unset!important;
}
.border-class, .register textarea{
    width: 85%;
    outline: medium none;
    background: transparent none repeat scroll 0% 0%;
    border: none;
    border-bottom: 1px solid #ced4da;
    height: 25px;
    font-family: roboto;
    color: #000;
    text-decoration: none;
    line-height: 1;
    text-align: left;
    }
    .multiple-sub-status-label{
        width: calc(100% - 30px);
        top: -18px;
        background: 0 0;
        color: #18375f;
        font-size: 12px;
        left: 15px;
    }

.copy-to-clip {
    font-size: 15px;
    color: orange;
    display: flex;
    left: 97%;
    width: auto;
    padding: 2px;
    border: 1px solid orange;
    border-radius: 5px;
}
.copy-to-clip:hover {
    background-color: orange;
    color: white;
}

.form-group .fa-icon { top: 19px !important; }
.validate-mobile, .form-group label.error { position: static !important; }

</style>
<div class="main-app-form">
<?php
    $qry_app_on_new = "SELECT * FROM tbl_mint_app WHERE case_id = " . $case_id;
    if($dialog == 1){
                        $qry_app_on_new .= " and app_id = ".$app_id_dia;
                    }
    $res_app_on = mysqli_query($Conn1, $qry_app_on_new) or die(mysqli_error($Conn1));
    $app_count = 0;
    $f_id = array();
    ?>
    <main>
        <section class="d-flex flex-wrap">
            <div class="pl-md-3 pl-2 pr-md-3 pr-2 col-12">
                <div class="d-flex flex-wrap gen-box text-center white-bg">
                    <?php
                    $qry_to_exec = "SELECT id, app_bank_on, app_id FROM tbl_mint_app WHERE case_id = $case_id";
                    if($dialog == 1){
                        $qry_to_exec .= " and app_id = ".$app_id_dia;
                    }
                    $new_tabs_query = mysqli_query($Conn1,$qry_to_exec); 
                    $actual_banks_count = mysqli_num_rows($new_tabs_query);
                    $col_class = "col-3";
                    ?>
                    <?php while($new_tabs_result = mysqli_fetch_array($new_tabs_query)) {
                        $new_rw_id  = $new_tabs_result['id'];
                        if($actual_banks_count <= 3) {
                            $col_class = "col-3";
                        } else {
                            $col_class = "col-2";
                        }
                        ?>
                        <div style='font-size: 15px !important' id="cmn_tab_<?php echo $new_rw_id; ?>" class="<?php echo $col_class; ?> tab-click <?php echo (base64_decode($_REQUEST['app_id']) == $new_tabs_result['app_id']) ? "active-tab" : ""; ?> bank-tab-click" data-toggle="step<?php echo $new_rw_id; ?>"><?php echo get_display_name('bank_name',$new_tabs_result['app_bank_on']); ?></div>
                        <?php
                    } if($dialog != 1){?>
                    <div style='font-size: 15px !important' id="cmn_tab_99" class="<?php echo $col_class; ?> tab-click bank-tab-click" data-toggle="step99">Add Another Bank</div>
                <?php } ?>
                </div>
                <div class="gen-box white-bg">
    <?php
    while($exe_app_on = mysqli_fetch_array($res_app_on)) {
        $app_count++;
        $rw_id  = $exe_app_on['id'];
        $f_id[] = $exe_app_on['id'];

        $get_bnk_typ    = mysqli_query($Conn1, "SELECT bank_type_id FROM tbl_bank WHERE bank_id = " . $exe_app_on['app_bank_on']);
        $res_bank_typ   = mysqli_fetch_array($get_bnk_typ);
                                                    
        $partner_data = "";
        if($user_role == 1) {
            $get_partner = mysqli_query($Conn1, "SELECT pat_id FROM tbl_pat_loan_type_mapping WHERE bank_id = '".$exe_app_on['app_bank_on']."' AND loan_type = '".$loan_type."'");
            $res_partner = mysqli_fetch_array($get_partner);
            if(!empty($exe_app_on['app_id']) && !empty($res_partner['pat_id'])) {
                $parnter_reqres = mysqli_query($Conn1, "SELECT partner_name, request_send, response_from_api FROM api_helper INNER JOIN tbl_mlc_partner ON tbl_mlc_partner.partner_id = api_helper.partner_id WHERE api_helper.application_id = '".$exe_app_on['app_id']."' AND api_helper.partner_id = '".$res_partner['pat_id']."'");
                if(mysqli_num_rows($parnter_reqres) > 0) {
                    $partner_data = mysqli_fetch_array($parnter_reqres);  
                } else {
                    $partner_data = "";
                }
            }
        }
        $bank_type_id_fetch = $res_bank_typ['bank_type_id'];
        $api_radio_to_be_checkd = base64_decode($_REQUEST['app_id']);
        $partner_desc = '';
        if($exe_app_on['bank_crm_lead_on'] != '' ) {
            $get_status = mysqli_query($Conn1,"SELECT description, status from partner_lead_status where app_id = '".$exe_app_on['app_id']."' order by status_id desc limit 1");
            $count_status = mysqli_num_rows($get_status);
            $partner_desc= '';
            if($count_status > 0) {
                $result_status = mysqli_fetch_array($get_status); 
                $partner_desc = " <span class='green'>(".$result_status['status']." ".$result_status['description'].")</span>";
            }
        }
        $cashback_msg = '';
        $cashback_qry = mysqli_query($Conn1,"SELECT count(*) as total FROM tbl_cash_bonanza WHERE app_id = '".$exe_app_on['app_id']."' and sent_flag = 1");
        $result_qry = mysqli_fetch_assoc($cashback_qry);
        if($result_qry['total'] > 0) {
            $cashback_msg = "(Cashback <span class='green'>&#10003;</span>)";
        }
        $card_id = $exe_app_on['credit_card_id'];
        $card_name = get_display_name('credit_card_list',$card_id);
        $banker_name_qry = mysqli_query($Conn1,"SELECT assign_id,sales_name,sales_mobile FROM tbl_app_assign_banker WHERE app_id = '".$exe_app_on['app_id']."'");
        $result_banker_qry = mysqli_fetch_array($banker_name_qry);

        $qry_count_api_elig = mysqli_query($Conn1,"SELECT * FROM tbl_customer_application_api_elig WHERE app_id = '".$exe_app_on['app_id']."'");
        $res_count_elig_check = mysqli_num_rows($qry_count_api_elig);

        $app_partner_on = $exe_app_on['partner_on'];
        $digital_verification = "";
        if($exe_app_on['app_bank_on'] == 18 && $loan_type == 56) {
            $dov_query = "SELECT cases.query_id FROM tbl_mint_case AS cases LEFT JOIN tbl_bank_otp_verification AS verification ON verification.lead_id = cases.query_id WHERE cases.case_id = '".$case_id."' AND otp_flag = 1 ORDER BY case_id DESC";
            $dov_exec = mysqli_query($Conn1, $dov_query);
            if(mysqli_num_rows($dov_exec) > 0) {
                $digital_verification = "<span class='fs-12'> (OTP <span class='green'>&#10003;</span> by customer)</span>";
            }
        }
        ?>
    <div style="cursor: pointer;display: flex; justify-content: space-between; font-size: 15px !important; font-weight: bold !important" class="blue-bg col-12 font-weight-nb pb-2 pt-2 white font-20 brdr-top-gray bank-tab-click" data-toggle="step<?php echo $rw_id; ?>" id="switch_step<?php echo $rw_id; ?>"><span id="text_step<?php echo $rw_id; ?>"><?php echo get_display_name('bank_name',$exe_app_on['app_bank_on']); ?> <?php echo "<small style='font-size: 15px'>( ".$exe_app_on['app_id']." )</small>"; ?> <?php echo ($exe_app_on['src'] == 'CRM Auto') ? " - Application created by MLC in Auto Mode" : ""; ?> <?php if($digital_verification != "") { echo " ".$digital_verification; } ?> </span>
                        <label style='float: right; font-size: 13px'>Last Updated Date: <?php echo (date("Y-m-d", strtotime($exe_app_on['la_st_up_date'])) == '0000-00-00' || date("Y-m-d", strtotime($exe_app_on['la_st_up_date'])) == '' || date("Y-m-d", strtotime($exe_app_on['la_st_up_date'])) == '1970-01-01') ? '--' : date("d-m-Y H:i", strtotime($exe_app_on['la_st_up_date'])) ;?></label>
                    </div>
                    <form method="POST" class="form-step col-12" id="form_step<?php echo $rw_id; ?>" <?php echo $api_radio_to_be_checkd != $exe_app_on['app_id'] ? "style='display: none'" : ""; ?>>
                        <div class="form-group col-xl-12"> <?php echo $partner_desc; ?>  <span class='blue'><?php if($loan_type == '71'){  echo '( '.$card_name.' )'; }?></span> &nbsp;&nbsp; &nbsp;&nbsp;<?php if((($exe_app_on['app_bank_on'] == 75 || $exe_app_on['app_bank_on'] == 127  || $exe_app_on['app_bank_on'] == 129 || $exe_app_on['app_bank_on'] == 16) && $loan_type == 56 && $exe_app_on['bank_crm_lead_on'] != '') || $exe_app_on['app_bank_on'] == 75 && $loan_type == 11){ ?>
                                        <a href="send-email-bank.php?case_id=<?php echo urlencode(base64_encode($case_id));?>&loan_type=<?php echo $loan_type;?>&bnk=<?php echo $exe_app_on['app_bank_on'];?>" target="blank" class="has_link">Banker Email</a><?php } echo $cashback_msg; ?>
                            </div>
                        <input type='hidden' name='step_app' value = "1">
                        <input type='hidden' name='rw_id' value = "<?php echo $rw_id; ?>">
                        <input type="hidden" name="case_id" value="<?php echo $case_id; ?>" >
                        <input type="hidden" name="loan_type" value="<?php echo $loan_type; ?>" >
                        <input type="hidden" name="app_bank_applied" value="<?php echo $exe_app_on['app_bank_on']; ?>" >
                        <input type="hidden" name="cust_id" value="<?php echo $cust_id; ?>" >
                        <input type='hidden' name='main_application_id' value = "<?php echo $exe_app_on['app_id']; ?>">
                        <input type='hidden' name='other_status' value = "<?php echo $exe_app_on['other_status']; ?>">
                        <input type='hidden' name='apply_app_status_on' id='apply_app_status_on' value = "<?php echo $exe_app_on['app_status_on']; ?>">
                        <input type='hidden' name='lead_view_id' value = "<?php echo $last_view_id; ?>">
                        <input type='hidden' name='click_to_call_id' id='click_to_call_id'  value = "">
                        <input type='hidden' name='apply_pre_login_status' id='apply_pre_login_status' value = "<?php echo $exe_app_on['pre_login_status']; ?>">
                        <input type='hidden' name='apply_sub_sub_status' id='apply_sub_sub_status' value = "<?php echo $exe_app_on['sub_sub_status']; ?>">                        
                        <div class="form-group col-xl-3 col-lg-4 col-md-6 hidden">
                            <span class="fa-icon fa-bank"></span>
                            <?php $finl_val = "'".$rw_id."'";?>
                            <?php echo get_dropdown('bank_name_','app_bank',$exe_app_on['app_bank_on'],'disabled'); ?>
                            <label for="app_bank" class="label-tag">Banks Offered</label>
                        </div>

                        <div class="form-group col-xl-3 col-lg-4 col-md-6">
                            <span class="fa-icon fa-users"></span>
                            <?php echo get_dropdown('app_pat_list', 'partner', $exe_app_on['partner_on'], 'required');?>
                            <label for="partner" class="label-tag">Partner</label>
                        </div>
                        <div class="form-group col-xl-3 col-lg-4 col-md-6">
                            <span class="fa-icon fa-list-alt"></span>
                            <!-- Changes - AppEditStatusDialog - Akash - Starts -->
                            <?php echo get_dropdown('status_','pre_status',$exe_app_on['pre_login_status'],'class="pre_status" required onchange="pre_post_status_change('.$rw_id.');status_change('.$rw_id.',this); date_to_sanc_disb('.$rw_id.', this); " '); ?>
                            <!-- Changes - AppEditStatusDialog - Akash - Ends -->
                            <label for="pre_status" class="label-tag">Select Status</label>
                        </div>
                        <?php $sub_status_query = mysqli_query($Conn1,"select status_id,description,fup_mandate_flag from status_master where level_id = 3 and (FIND_IN_SET('" . $loan_type . "',required_for_loan_type)  or required_for_loan_type = '0') and is_active=1 and parent_id = ".$exe_app_on['pre_login_status']." and parent_id > 0  order by description"); ?>

                        <div class="form-group col-xl-3 col-lg-4 col-md-6 post_login_status <?php if(mysqli_num_rows($sub_status_query) == 0){echo 'hidden';}?>">
                            <span class="fa-icon fa-list-alt"></span>
                            <!-- Changes - AppEditStatusDialog - Akash - Starts -->
                            <select name="post_login_status" id="post_login_status" onchange="status_change('<?php echo $rw_id; ?>',this); " class="valid" <?php if(mysqli_num_rows($sub_status_query) > 0){echo 'required';}?>>
                            <!-- Changes - AppEditStatusDialog - Akash - Ends -->
                                <option value=>Select Sub Status</option>
                                <?php while($result_status_qry = mysqli_fetch_assoc($sub_status_query)){ ?>
                                    <option value="<?php echo $result_status_qry['status_id']; ?>" <?php if($result_status_qry['status_id'] == $exe_app_on['app_status_on']){ echo 'selected';}?>><?php echo $result_status_qry['description']; ?></option>
                                <?php } ?>
                                
                            </select>
                            <label for="post_login_status" class="label-tag">Select Sub Status</label>
                        </div>
                        <?php $sub_sub_status_query = mysqli_query($Conn1,"select status_id,description,fup_mandate_flag from status_master where level_id = 3 and (FIND_IN_SET('" . $loan_type . "',required_for_loan_type)  or required_for_loan_type = '0') and is_active=1 and parent_id = ".$exe_app_on['app_status_on']." and parent_id > 0 order by description"); ?>

                        <div class="form-group col-xl-3 col-lg-4 col-md-6 sub_sub_status <?php if(mysqli_num_rows($sub_sub_status_query) == 0){echo 'hidden';}?>">
                            <span class="fa-icon fa-list-alt"></span>
                            <!-- Changes - AppEditStatusDialog - Akash - Starts -->
                            <select name="sub_sub_status" id="sub_sub_status" class="valid" onchange="" <?php if(mysqli_num_rows($sub_sub_status_query) > 0){echo 'required';}?>>
                            <!-- Changes - AppEditStatusDialog - Akash - Ends -->
                                <option value=>Select Sub Status</option>
                                <?php while($result_sub_status_qry = mysqli_fetch_assoc($sub_sub_status_query)){ ?>
                                    <option value="<?php echo $result_sub_status_qry['status_id']; ?>" <?php if($result_sub_status_qry['status_id'] == $exe_app_on['sub_sub_status']){ echo 'selected';}?>><?php echo $result_sub_status_qry['description']; ?></option>
                                <?php } ?>
                                
                            </select>
                            <label for="sub_sub_status" class="label-tag">Select Sub Sub Status</label>
                        </div>
                        
                        <!--Checkbox New Statuses Div Start -->
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
                         <!--Checkbox New Statuses Div End --> 

                        <div class="form-group col-xl-3 col-lg-4 col-md-6">
                            <span class="fa-icon">%</span>
                            <?php echo get_dropdown('rate_type', 'rate_type', $exe_app_on['rate_type_on'], 'required onchange="rate_type_change('.$rw_id.')";');?>
                            <label for="rate_type" class="label-tag">Rate Type</label>
                        </div>
                         <?php if($loan_type == 32) { ?>
                            <?php
                                $deposit_tenure_query = mysqli_query($Conn1, "SELECT id, tenure FROM tbl_fd_bank_tenure_rate WHERE bank_id = '".$exe_app_on['app_bank_on']."' ORDER BY tenure ASC");
                                if(mysqli_num_rows($deposit_tenure_query) > 0) {
                            ?>
                                <div class="form-group col-xl-3 col-lg-4 col-md-6">
                                    <span class="fa-icon fa-clock-o"></span>
                                    <select id="deposit_tenure" name="deposit_tenure" class="form-control">
                                        <option value="">Select Deposit Tenure</option>
                                        <?php
                                            while($deposit_tenure_res = mysqli_fetch_array($deposit_tenure_query)) {
                                                ?>
                                                <option value="<?php echo $deposit_tenure_res['id']; ?>" <?php echo ($exe_app_on['bank_wise_tennure'] == $deposit_tenure_res['id']) ? "selected" : ""; ?> ><?php echo $deposit_tenure_res['tenure']; ?></option>
                                                <?php
                                            }
                                        ?>
                                    </select>
                                    <label for="deposit_tenure" class="label-tag optional-tag">Deposit Tenure</label>
                                </div>
                            <?php } ?>
                        <?php } ?>
                        <div class="form-group col-xl-3 col-lg-4 col-md-6">
                            <span class="fa-icon fa-inr"></span>
                            <input type="tel" class="form-control loan_net_incm numonly" name="applied_amount" id="applied_amount_<?php echo $rw_id; ?>" value="<?php echo $exe_app_on['applied_amount_on'] == 0 ? '': $exe_app_on['applied_amount_on'];?>" maxlength='15' min='1' required/>
                            <label for="applied_amount_<?php echo $rw_id; ?>" class="label-tag">Applied Amount</label>
                            <div class='word_below orange'><b class='money_format  applied_amount_<?php echo $rw_id; ?>_value_formt'></b></div>
                        </div>
                        <div class="form-group col-xl-3 col-lg-4 col-md-6 login_applied hidden">
                            <span class="fa-icon fa-clock-o"></span>
                            <input type="tel" placeholder="Loan Tenure in Months" class="form-control numonly login_applied" name="loan_tenure" id="loan_tenure" value="<?php echo $exe_app_on['loan_tenure_on'] == 0 ? '' : $exe_app_on['loan_tenure_on'];?>" maxlength='4'/>
                            <label for="loan_tenure" class="label-tag loan_tenure_label">Loan Tenure in Months</label>
                        </div>

                        <!-- <div class="form-group col-xl-3 col-lg-4 col-md-6 login_applied hidden">
                            <span class="fa-icon">%</span>
                            <input type="tel" class="form-control numonly" name="fixed_tenure" id="fixed_tenure" value="<?php echo $exe_app_on['fixed_tenure_on'] == 0 ? '' : $exe_app_on['fixed_tenure_on'];?>" maxlength='10'/>
                            <label for="fixed_tenure" class="label-tag">If Fixed, Tenure for which rate is fixed</label>
                        </div> -->

                        <div class="form-group col-xl-3 col-lg-4 col-md-6 hidden login_applied">
                            <span class="fa-icon">%</span>
                            <input type="text" class="form-control login_applied" name="rate_of_in" id="rate_of_in" value="<?php echo $exe_app_on['rate_of_in_on'] == '0.00' ? '' : $exe_app_on['rate_of_in_on']; ?>" maxlength='5'/>
                            <label for="rate_of_in" class="label-tag rate_of_interest_label">Rate of Interest</label>
                        </div>
                        <div class="form-group col-xl-3 col-lg-4 col-md-6 hidden login_applied">
                            <span class="fa-icon fa-calendar"></span>
                            <input type="text" class="form-control dat login_applied onlybackspace" name="login_date" id="login_date<?php echo $rw_id; ?>" placeholder="yyyy-mm-dd" value="<?php echo ($exe_app_on['login_date_on'] == '0000-00-00' || $exe_app_on['login_date_on'] == '1970-01-01') ? '' : $exe_app_on['login_date_on'];?>" maxlength='10'/>
                            <label for="login_date<?php echo $rw_id; ?>" class="label-tag">Login Date</label>
                        </div>

                        <div class="form-group col-xl-3 col-lg-4 col-md-6 hidden sanctioned_applied">
                            <span class="fa-icon fa-inr"></span>
                            <input type="tel" class="form-control loan_net_incm numonly sanctioned_applied" name="sanctioned_amount" id="sanctioned_amount_<?php echo $rw_id; ?>" value="<?php echo $exe_app_on['sanctioned_amount_on'] == 0 ? '' : $exe_app_on['sanctioned_amount_on'] ;?>" maxlength='15' min='1'/>
                            <label for="sanctioned_amount_<?php echo $rw_id; ?>" class="label-tag">Sanctioned Amount</label>
                            <div class='word_below orange'><b class='money_format sanctioned_amount_<?php echo $rw_id; ?>_value_formt'></b></div>
                        </div>

                        <div class="form-group col-xl-3 col-lg-4 col-md-6 hidden sanctioned_applied">
                            <span class="fa-icon fa-calendar"></span>
                            <input type="text" class="form-control dat sanctioned_applied onlybackspace" name="sanction_date" id="sanction_date<?php echo $rw_id; ?>" placeholder="yyyy-mm-dd" value="<?php echo ($exe_app_on['sanction_date_on'] == '0000-00-00' || $exe_app_on['sanction_date_on'] == '1970-01-01') ? '' : $exe_app_on['sanction_date_on'];?>" maxlength='10'/>
                            <label for="sanction_date<?php echo $rw_id; ?>" class="label-tag">Sanction Date</label>
                        </div>
                        
                        <div class="form-group col-xl-3 col-lg-4 col-md-6 hidden disbursed_applied">
                            <span class="fa-icon fa-inr"></span>
                            <input type="tel" placeholder="Disbursed Amount" class="form-control loan_net_incm numonly disbursed_applied" name="disbursed_amount" id="disbursed_amount_<?php echo $rw_id; ?>" value="<?php echo $exe_app_on['disbursed_amount_on'] == 0 ? '' : $exe_app_on['disbursed_amount_on'];?>" maxlength='15' min='1' />
                            <label for="disbursed_amount_<?php echo $rw_id; ?>" class="label-tag">Disbursed Amount</label>
                            <div class='word_below orange'><b class='money_format disbursed_amount_<?php echo $rw_id; ?>_value_formt'></b></div>
                        </div>

                        <div class="form-group col-xl-3 col-lg-4 col-md-6 hidden disbursed_applied">
                            <span class="fa-icon fa-calendar"></span>
                            <input type="text" class="form-control dat disbursed_applied onlybackspace" name="first_disb_date" id="first_disb_date<?php echo $rw_id; ?>" placeholder="yyyy-mm-dd" value="<?php echo ($exe_app_on['first_disb_date_on'] == '0000-00-00' || $exe_app_on['first_disb_date_on'] == '1970-01-01') ? '' : $exe_app_on['first_disb_date_on']; ?>" maxlength='10'/>
                            <label for="first_disb_date<?php echo $rw_id; ?>" class="label-tag">First Disb Date</label>
                        </div>

                        <div class="form-group col-xl-3 col-lg-4 col-md-6 hidden disbursed_applied">
                            <span class="fa-icon fa-calendar"></span>
                            <input type="text" class="form-control dat onlybackspace" name="last_disb_date" id="last_disb_date<?php echo $rw_id; ?>" placeholder="yyyy-mm-dd" value="<?php echo ($exe_app_on['last_disb_date_on'] == '0000-00-00' || $exe_app_on['last_disb_date_on'] == '1970-01-01') ? '' : $exe_app_on['last_disb_date_on'];?>" maxlength='10'/>
                            <label for="last_disb_date<?php echo $rw_id; ?>" class="label-tag optional-tag">Last Disb Date</label>
                        </div>

                        <div class="form-group col-xl-3 col-lg-4 col-md-6">
                            <span class="fa-icon fa-bank"></span>
                            <input type="text" placeholder="Bank CRM/ Lead Id" class="form-control alpha-num-hash" name="bank_crm_lead" id="bank_crm_lead" value="<?php echo $exe_app_on['bank_crm_lead_on'];?>" maxlength="60"/>
                            <label for="bank_crm_lead" class="label-tag optional-tag">Bank CRM/ Lead Id</label>
                        </div>

                        <div class="form-group col-xl-3 col-lg-4 col-md-6">
                            <span class="fa-icon fa-bank"></span>
                            <input type="text" placeholder="Bank Application No." class="form-control alpha-num-hyphen" name="bank_app_num" id="bank_app_num" value="<?php echo $exe_app_on['bank_app_no_on'];?>" maxlength="60"/>
                            <label for="bank_app_num" class="label-tag optional-tag">Bank Application No. Id</label>
                        </div>

                        <div class="form-group col-xl-3 col-lg-4 col-md-6 hidden disbursed_applied full_disb">
                            <span class="fa-icon fa-inr"></span>
                            <input type="number" placeholder="Cashback Offered" class="form-control numonly" name="cash_offers" id="cash_offers" value="<?php echo $exe_app_on['cash_offers_on'] == 0 ? '' : $exe_app_on['cash_offers_on'];?>" maxlength="5" />
                            <label for="cash_offers" class="label-tag optional-tag">Cashback Offered</label>
                        </div>

                        <input type="hidden" id="cash_offers_hid" name="cash_offers_hid" value="<?php echo $exe_app_on['cash_offers_on'] ?>">
                        <input type="hidden" id="cashback_limit" name="cashback_limit">

                        <div class="form-group col-xl-3 col-lg-4 col-md-6 ">
                            <span class="fa-icon fa-commenting"></span>
                            <textarea name="description" class="text valid form-control" rows='5' id="description" placeholder="Description" ><?php echo $exe_app_on['app_description']; ?></textarea>
                            <label for="description" class="label-tag optional-tag">Description</label>
                        </div>

                        <?php if($loan_type == 60) { ?>
                            <div class="form-group col-xl-3 col-lg-4 col-md-6 ">
                                <span class="fa-icon fa-commenting"></span>
                                <textarea name="bnk_description" class="text valid form-control" rows='5' id="bnk_description" placeholder="Banker Description" ><?php echo $exe_app_on['bnk_description']; ?></textarea>
                                <label for="bnk_description" class="label-tag optional-tag">Banker Description</label>
                                <span id="<?php echo $rw_id; ?>" class="fa-icon fa-clipboard copy-to-clip cursor" title="Copy to Clipboard" ></span>
                            </div>
                        <?php } ?>

                        <div class="form-group col-xl-3 col-lg-4 col-md-6 ">
                            <span class="fa-icon fa-tachometer"></span>
                            <input type="text" class="form-control num-hyphen" name="cibil_score_num" id="cibil_score_num" placeholder="Cibil Score" value="<?php echo $exe_app_on['cibil_score'];?>" />
                            <label for="cibil_score_num" class="label-tag optional-tag">Cibil Score</label>
                        </div>

                        <?php if($user_role == 6 && $loan_type == 60) { ?>
                            <div class="form-group col-xl-3 col-lg-4 col-md-6 d-flex">
                                <div class='f_12 ml15'>
                                    <input type='checkbox' name='rm_fup' id='rm_fup' value='1'>
                                    <label for='rm_fup' class='checkbox pointer'>Follow Up Type - RM</label>
                                </div>
                            </div>
                        <?php } ?>
                        
                        <div class="form-group col-xl-3 col-lg-4 col-md-6">
                            <span class="fa-icon fa-list-alt"></span>
                            <?php echo get_dropdown('follow_up_type', 'follow_type', $exe_app_on['follow_up_type_on'], 'onchange="follow_up_change('.$rw_id.');"');?>
                            <label for="follow_type" class="label-tag">Follow Up Type</label>
                        </div>

                        <div class="form-group col-xl-3 col-lg-4 col-md-6 ">
                            <span class="fa-icon fa-calendar"></span>
                            <input type="text" class="form-control dat onlybackspace" name="follow_date" id="follow_date<?php echo $rw_id; ?>" placeholder="yyyy-mm-dd" value="<?php echo ($exe_app_on['follow_up_date_on'] == '0000-00-00' || $exe_app_on['follow_up_date_on'] == '1970-01-01') ? '' : $exe_app_on['follow_up_date_on']; ?>" maxlength='10'/>
                            <label for="follow_date<?php echo $rw_id; ?>" class="label-tag">Follow Up Date</label>
                        </div>

                        <div class="form-group col-xl-3 col-lg-4 col-md-6 ">
                            <?php
                                if($exe_app_on['follow_up_time'] == '00:00:00' || $exe_app_on['follow_up_date_on'] == "0000-00-00" || $exe_app_on['follow_up_date_on'] == "1970-01-01" || $exe_app_on['follow_up_date_on'] == "" || $exe_app_on['follow_up_type_on'] == "" || $exe_app_on['follow_up_type_on'] == 0) {
                                    $follow_time =  "";
                                } else {
                                    $follow_time = $exe_app_on['follow_up_time'];
                                }
                            ?>
                            <span class="fa-icon fa-clock-o"></span>
                            <input type="text" class="form-control fol_time" name="follow_up_time" id="follow_up_time" placeholder="h:i:s" value="<?php echo $follow_time; ?>" maxlength='8'/>
                            <label for="follow_up_time" class="label-tag">Follow Up Time</label>
                        </div>

                        <?php if($loan_type == 58) { ?>
                            <div class="form-group col-xl-3 col-lg-4 col-md-6 ">
                                <span class="fa-icon fa-list-alt"></span>
                                <input type="text" class="form-control num-hyphen" name="main_app_id" id="main_app_id" placeholder="Main Application ID" required value="<?php echo $exe_app_on['main_app_id']; ?>"/>
                                <label for="main_app_id" class="label-tag">Main Application ID</label>
                            </div>
                        <?php } ?>

                        <?php if($user_role == 6 && ($loan_type == 51 || $loan_type == 52 || $loan_type == 54)) { ?>
                            <div class="form-group col-xl-3 col-lg-4 col-md-6 hidden" id="<?php echo $rw_id; ?>_follow_up_for_div">
                                <span class="fa-icon fa-list-alt"></span>
                                <select name="follow_up_for" id="follow_up_for" class="valid">
                                    <option value="">Select Followup For</option>
                                    <option value="1" selected>Followup for Self</option>
                                    <option value="2">Followup for User</option>
                                </select>
                                <label for="follow_up_for" class="label-tag">Follow Up For</label>
                            </div>
                        <?php } ?>

                        <?php if($loan_type == 57) { ?>
                            <div class="form-group col-xl-3 col-lg-4 col-md-6">
                                <span class="fa-icon fa-file-text"></span>
                                <?php echo get_dropdown('bil_type', 'bil_type', $exe_app_on['bil_type'], ''); ?>
                                <label for="bil_type" class="label-tag">Bill Type</label>
                            </div>
                        <?php } else if(in_array($loan_type, array('51','54','52'))) { ?>
                            <div class="form-group col-xl-3 col-lg-4 col-md-6">
                                <span class="fa-icon fa-home"></span>
                                <?php echo get_dropdown('app_property_status', 'property_status', $exe_app_on['property_status'], 'class="app_property_status"');?>
                                <label for="property_status" class="label-tag optional-tag">Property Status</label>
                            </div>
                        <?php } ?>

                        <!-- <div class="row div-width disbursed_applied hidden">
                            <div class="form-group col-xl-3 col-lg-4 col-md-6 cashback_sms">
                                <label for="cashback_sms_<?php echo $rw_id; ?>" class="radio-tag label-tag">Do you want to send Cashback SMS?</label>
                                <div class="radio-button error_contain">
                                    <input type="radio" name="cashback_sms" id="cashback_sms_y"  value="1" <?php if($exe_app_on['cashback_sms_flag'] == '1'){ ?> checked <?php } ?> >
                                    <label for="cashback_sms_y" style="width: 31px;">Yes</label>
                                    <input type="radio" name="cashback_sms" id="cashback_sms_n" value="2" <?php if($exe_app_on['cashback_sms_flag'] != '1'){ ?>checked <?php } ?> >
                                    <label for="cashback_sms_n" style="width: 31px;">No</label> 
                                </div>
                            </div>
                        </div> -->
                        <div class="row div-width hidden case_closed_array">
                            <div class="form-group col-xl-3 col-lg-4 col-md-6 cashback_sms">
                                <label for="cashback_sms_<?php echo $rw_id; ?>" class="radio-tag label-tag">Do you want to close this case?</label>
                                <div class="radio-button error_contain">
                                    <input type="radio" name="case_closed_val" id="case_closed_val_y<?php echo $rw_id; ?>" class="case_closed_array_radio"  value="1" >
                                    <label for="case_closed_val_y<?php echo $rw_id; ?>" style="width: 31px;">Yes</label>
                                    <input type="radio" name="case_closed_val" id="case_closed_val_n<?php echo $rw_id; ?>" class="case_closed_array_radio" value="2" >
                                    <label for="case_closed_val_n<?php echo $rw_id; ?>" style="width: 31px;">No</label> 
                                </div>
                            </div>
                        </div>

                        <div class="row div-width">
                            <?php if($exe_app_on['bank_rm_name'] != ''){ ?>
                            <div class="form-group col-xl-3 col-lg-4 col-md-6">
                            <span class="fa-icon fa-user"></span>
                            <input type="text" class="form-control" id="rm_name" value="<?php echo $exe_app_on['bank_rm_name'];?>" readonly/>
                            <label for="rm_name" class="label-tag optional-tag">RM Name</label>
                        </div>
                    <?php }if($exe_app_on['bank_rm_contact_no'] != ''){ ?>
                        <div class="form-group col-xl-3 col-lg-4 col-md-6">
                            <span class="fa-icon fa-mobile"></span>
                            <input type="text" class="form-control" id="rm_contact_no" value="<?php echo $exe_app_on['bank_rm_contact_no'];?>" readonly/>
                            <label for="rm_contact_no" class="label-tag optional-tag">RM Contact No</label>
                        </div>
                    <?php }if($result_banker_qry['assign_id'] != '' && $result_banker_qry['assign_id'] != 0){ ?>

                        <div class="form-group col-xl-3 col-lg-4 col-md-6">
                            <span class="fa-icon fa-user"></span>
                            <input type="text" class="form-control" id="assign_to" value="<?php echo $result_banker_qry['sales_name']." (".$result_banker_qry['sales_mobile'].")" ;?>" readonly/>
                            <label for="assign_to" class="label-tag optional-tag">Assign To</label>
                        </div>
                    <?php } ?>
                        </div>


                        <div class="row div-width">
                            <div class="form-group col-xl-5 col-lg-4">
                            </div>
                            <div class="form-group col-xl-12 col-lg-4">
                                <input type="button" class="btn btn-primary" name="edit_bank" id='<?php echo $rw_id; ?>' value="Edit Bank Detail">
                                <?php if($dialog != 1){?>
                                &nbsp;&nbsp;<input type="button" class="btn btn-primary" name="send_documents" onclick="open_iframe('<?php echo base64_encode($exe_app_on['app_id']); ?>');"  value="Send Document List">

                                &nbsp;&nbsp;<a target="_blank" href="<?php echo $head_url; ?>/sugar/customer-document/email-documents.php?cust_id=<?php echo base64_encode($cust_id); ?>&app_id=<?php echo base64_encode($exe_app_on['app_id']); ?>"><input type="button" class="btn btn-primary" value="Docs Send to Banker"></a>

                                <?php }if($exe_app_on['app_bank_on'] == 12 && $loan_type == 56) { ?>
                                    <a target="_blank" href="<?php echo $head_url; ?>/sugar/app/details.php?case_id=<?php echo base64_encode($case_id); ?>&loan_type=<?php echo base64_encode($loan_type); ?>&bank_id=<?php echo base64_encode($exe_app_on['app_bank_on']); ?>"><input type="button" class="btn btn-primary" value="MCAS Detail"></a>
                                <?php } ?>
                                
                                <?php if($user == 173) { ?>
                                    <a href="/pdf-vendor/pdf-converter/download_pdf.php?case_id=<?php echo base64_encode($case_id); ?>&cust_id=<?php echo base64_encode($cust_id); ?>" target="_blank"><input type="button" class="btn btn-primary" name="download_cust_data" id='<?php echo $case_id; ?>' value="Download Custmer Data"></a>
                                <?php } ?>



                            </div>
                        </div>
                    </form>
    <?php
    $app_array[] = $rw_id;
    }if($dialog != 1){
    ?>
                    <!-- Add New Bank Div - Starts -->
                    <div style="font-size: 15px !important; font-weight: bold !important" class="blue-bg col-12 font-weight-nb pb-2 pt-2 white font-20 brdr-top-gray bank-tab-click" data-toggle="step99" id="switch_step99"><span id="text_step99"></span>Add Another Bank</div>
                    <?php $rw_id = 99; 
                    $app_array[] = $rw_id; ?>
                        <form method="POST" class="form-step col-12" id="form_step<?php echo $rw_id; ?>" style="display: none">
                        <input type="hidden" name="case_id" value="<?php echo $case_id; ?>" >
                        <input type="hidden" name="loan_type" value="<?php echo $loan_type; ?>" >
                        <input type="hidden" name="cust_id" value="<?php echo $cust_id; ?>" >
                        <input type='hidden' name='lead_view_id' value = "<?php echo $last_view_id; ?>">
                        <input type='hidden' name='query_id' value = "<?php echo $query_id; ?>">
                        <input type='hidden' name='click_to_call_id' id='click_to_call_id'  value = "">
                        <input type='hidden' name='step_app' value = "2">
                        <div class="form-group col-xl-3 col-lg-4 col-md-6">
                            <span class="fa-icon fa-bank"></span>
                            <?php echo get_dropdown('bank_name_','app_bank','','required'); ?>
                            <label for="app_bank" class="label-tag">Banks Offered</label>
                        </div>

                        <div class="form-group col-xl-3 col-lg-4 col-md-6">
                            <span class="fa-icon fa-users"></span>
                            <?php echo get_dropdown('app_pat_list', 'partner', '', 'required');?>
                            <label for="partner" class="label-tag">Partner</label>
                        </div>

                        <div class="form-group col-xl-3 col-lg-4 col-md-6">
                            <span class="fa-icon fa-list-alt"></span>
                            <?php echo get_dropdown('status_','pre_status','','class="pre_status" required onchange="pre_post_status_change('.$rw_id.');status_change('.$rw_id.',this);"'); ?>
                            <label for="pre_status" class="label-tag">Pre Login Status</label>
                        </div>
                        <div class="form-group col-xl-3 col-lg-4 col-md-6 post_login_status hidden">
                            <span class="fa-icon fa-list-alt"></span>
                            <select name="post_login_status" id="post_login_status" class="valid" onchange="status_change('<?php echo $rw_id; ?>',this);">
                            </select>
                            <label for="post_login_status" class="label-tag">Select Sub Status</label>
                        </div>
                        <div class="form-group col-xl-3 col-lg-4 col-md-6 sub_sub_status hidden">
                            <span class="fa-icon fa-list-alt"></span>
                            <select name="sub_sub_status" id="sub_sub_status" class="valid">
                            </select>
                            <label for="sub_sub_status" class="label-tag">Select Sub Sub Status</label>
                        </div>

                       <!--Checkbox New Statuses Div Start -->
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
                         <!--Checkbox New Statuses Div End --> 

                        <div class="form-group col-xl-3 col-lg-4 col-md-6">
                            <span class="fa-icon">%</span>
                            <?php echo get_dropdown('rate_type', 'rate_type', '', 'required onchange="rate_type_change('.$rw_id.')";');?>
                            <label for="rate_type" class="label-tag">Rate Type</label>
                        </div>
                        <div class="form-group col-xl-3 col-lg-4 col-md-6">
                            <span class="fa-icon fa-inr"></span>
                            <input type="tel" class="form-control loan_net_incm numonly" name="applied_amount" id="applied_amount_<?php echo $rw_id; ?>"  maxlength='15' min='1' required/>
                            <label for="applied_amount_<?php echo $rw_id; ?>" class="label-tag">Applied Amount</label>
                            <div class='word_below orange'><b class='money_format  applied_amount_<?php echo $rw_id; ?>_value_formt'></b></div>
                        </div>
                        <div class="form-group col-xl-3 col-lg-4 col-md-6 login_applied hidden">
                            <span class="fa-icon fa-clock-o"></span>
                            <input type="tel" placeholder="Loan Tenure in Months" class="form-control numonly login_applied" name="loan_tenure" id="loan_tenure" maxlength='4'/>
                            <label for="loan_tenure" class="label-tag loan_tenure_label">Loan Tenure in Months</label>
                        </div>

                        <!-- <div class="form-group col-xl-3 col-lg-4 col-md-6 login_applied hidden">
                            <span class="fa-icon">%</span>
                            <input type="tel" class="form-control numonly" name="fixed_tenure" id="fixed_tenure" maxlength='10'/>
                            <label for="fixed_tenure" class="label-tag">If Fixed, Tenure for which rate is fixed</label>
                        </div> -->

                        <div class="form-group col-xl-3 col-lg-4 col-md-6 hidden login_applied">
                            <span class="fa-icon">%</span>
                            <input type="text" class="form-control login_applied" name="rate_of_in" id="rate_of_in" maxlength='5'/>
                            <label for="rate_of_in" class="label-tag rate_of_interest_label">Rate of Interest</label>
                        </div>
                        <div class="form-group col-xl-3 col-lg-4 col-md-6 hidden login_applied">
                            <span class="fa-icon fa-calendar"></span>
                            <input type="text" class="form-control dat login_applied onlybackspace" name="login_date" id="login_date<?php echo $rw_id; ?>" placeholder="yyyy-mm-dd"  maxlength='10'/>
                            <label for="login_date<?php echo $rw_id; ?>" class="label-tag">Login Date</label>
                        </div>

                        <div class="form-group col-xl-3 col-lg-4 col-md-6 hidden sanctioned_applied">
                            <span class="fa-icon fa-inr"></span>
                            <input type="tel" class="form-control loan_net_incm numonly sanctioned_applied" name="sanctioned_amount" id="sanctioned_amount_<?php echo $rw_id; ?>"  maxlength='15' min='1'/>
                            <label for="sanctioned_amount_<?php echo $rw_id; ?>" class="label-tag">Sanctioned Amount</label>
                            <div class='word_below orange'><b class='money_format sanctioned_amount_<?php echo $rw_id; ?>_value_formt'></b></div>
                        </div>

                        <div class="form-group col-xl-3 col-lg-4 col-md-6 hidden sanctioned_applied">
                            <span class="fa-icon fa-calendar"></span>
                            <input type="text" class="form-control dat sanctioned_applied onlybackspace" name="sanction_date" id="sanction_date<?php echo $rw_id; ?>" placeholder="yyyy-mm-dd"  maxlength='10'/>
                            <label for="sanction_date<?php echo $rw_id; ?>" class="label-tag">Sanction Date</label>
                        </div>
                        
                        <div class="form-group col-xl-3 col-lg-4 col-md-6 hidden disbursed_applied">
                            <span class="fa-icon fa-inr"></span>
                            <input type="tel" placeholder="Disbursed Amount" class="form-control loan_net_incm numonly disbursed_applied" name="disbursed_amount" id="disbursed_amount_<?php echo $rw_id; ?>"   maxlength='15' min='1' />
                            <label for="disbursed_amount_<?php echo $rw_id; ?>" class="label-tag">Disbursed Amount</label>
                            <div class='word_below orange'><b class='money_format disbursed_amount_<?php echo $rw_id; ?>_value_formt'></b></div>
                        </div>

                        <div class="form-group col-xl-3 col-lg-4 col-md-6 hidden disbursed_applied">
                            <span class="fa-icon fa-calendar"></span>
                            <input type="text" class="form-control dat disbursed_applied onlybackspace" name="first_disb_date" id="first_disb_date<?php echo $rw_id; ?>" placeholder="yyyy-mm-dd" maxlength='10'/>
                            <label for="first_disb_date<?php echo $rw_id; ?>" class="label-tag">First Disb Date</label>
                        </div>

                        <div class="form-group col-xl-3 col-lg-4 col-md-6 hidden disbursed_applied">
                            <span class="fa-icon fa-calendar"></span>
                            <input type="text" class="form-control dat onlybackspace" name="last_disb_date" id="last_disb_date<?php echo $rw_id; ?>" placeholder="yyyy-mm-dd"  maxlength='10'/>
                            <label for="last_disb_date<?php echo $rw_id; ?>" class="label-tag optional-tag">Last Disb Date</label>
                        </div>

                        <div class="form-group col-xl-3 col-lg-4 col-md-6">
                            <span class="fa-icon fa-bank"></span>
                            <input type="text" placeholder="Bank CRM/ Lead Id" class="form-control alpha-num-hash" name="bank_crm_lead" id="bank_crm_lead" maxlength="30"/>
                            <label for="bank_crm_lead" class="label-tag optional-tag">Bank CRM/ Lead Id</label>
                        </div>

                        <div class="form-group col-xl-3 col-lg-4 col-md-6">
                            <span class="fa-icon fa-bank"></span>
                            <input type="text" placeholder="Bank Application No." class="form-control alpha-num-hyphen" name="bank_app_num" id="bank_app_num" maxlength="30"/>
                            <label for="bank_app_num" class="label-tag optional-tag">Bank Application No. Id</label>
                        </div>

                        <div class="form-group col-xl-3 col-lg-4 col-md-6 hidden disbursed_applied full_disb">
                            <span class="fa-icon fa-inr"></span>
                            <input type="number" placeholder="Cashback Offered" class="form-control numonly" name="cash_offers" id="cash_offers" maxlength="5" />
                            <label for="cash_offers" class="label-tag optional-tag">Cashback Offered</label>
                        </div>

                        <input type="hidden" id="cashback_limit" name="cashback_limit">

                        <div class="form-group col-xl-3 col-lg-4 col-md-6 ">
                            <span class="fa-icon fa-commenting"></span>
                            <textarea name="description" class="text valid form-control" id="description" placeholder="Description" ></textarea>
                            <label for="description" class="label-tag optional-tag">Description</label>
                        </div>
                        <div class="form-group col-xl-3 col-lg-4 col-md-6 ">
                            <span class="fa-icon fa-tachometer"></span>
                            <input type="text" class="form-control num-hyphen" name="cibil_score_num" id="cibil_score_num" placeholder="Cibil Score" />
                            <label for="cibil_score_num" class="label-tag optional-tag">Cibil Score</label>
                        </div>
                        
                        <div class="form-group col-xl-3 col-lg-4 col-md-6">
                            <span class="fa-icon fa-list-alt"></span>
                            <?php echo get_dropdown('follow_up_type', 'follow_type', '', 'onchange="follow_up_change('.$rw_id.');"');?>
                            <label for="follow_type" class="label-tag">Follow Up Type</label>
                        </div>

                        <div class="form-group col-xl-3 col-lg-4 col-md-6 ">
                            <span class="fa-icon fa-calendar"></span>
                            <input type="text" class="form-control dat onlybackspace" name="follow_date" id="follow_date<?php echo $rw_id; ?>" placeholder="yyyy-mm-dd" maxlength='10'/>
                            <label for="follow_date<?php echo $rw_id; ?>" class="label-tag">Follow Up Date</label>
                        </div>

                        <div class="form-group col-xl-3 col-lg-4 col-md-6 ">
                   
                            <span class="fa-icon fa-clock-o"></span>
                            <input type="text" class="form-control fol_time" name="follow_up_time" id="follow_up_time" placeholder="h:i:s"  maxlength='8'/>
                            <label for="follow_up_time" class="label-tag">Follow Up Time</label>
                        </div>
                        <?php if($loan_type == 58) { ?>
                            <div class="form-group col-xl-3 col-lg-4 col-md-6 ">
                                <span class="fa-icon fa-list-alt"></span>
                                <input type="text" class="form-control num-hyphen" name="main_app_id" id="main_app_id" placeholder="Main Application ID" required value="<?php echo $exe_app_on['main_app_id']; ?>"/>
                                <label for="main_app_id" class="label-tag">Main Application ID</label>
                            </div>
                        <?php } ?>
                        <?php if($loan_type == 57) { ?>
                            <div class="form-group col-xl-3 col-lg-4 col-md-6">
                                <span class="fa-icon fa-file-text"></span>
                                <?php echo get_dropdown('bil_type', 'bil_type', '', ''); ?>
                                <label for="bil_type" class="label-tag">Bill Type</label>
                            </div>
                        <?php } else if(in_array($loan_type, array('51','54','52'))) { ?>
                            <div class="form-group col-xl-3 col-lg-4 col-md-6">
                                <span class="fa-icon fa-home"></span>
                                <?php echo get_dropdown('app_property_status', 'property_status', '', 'class="app_property_status"');?>
                                <label for="property_status" class="label-tag optional-tag">Property Status</label>
                            </div>
                        <?php } ?>

                        <!-- <div class="row div-width hidden disbursed_applied">
                            <div class="form-group col-xl-3 col-lg-4 col-md-6 cashback_sms">
                                <label for="cashback_sms_<?php echo $rw_id; ?>" class="radio-tag label-tag">Do you want to send Cashback SMS?</label>
                                <div class="radio-button error_contain">
                                    <input type="radio" name="cashback_sms" id="cashback_sms_y"  value="1" >
                                    <label for="cashback_sms_y" style="width: 31px;">Yes</label>
                                    <input type="radio" name="cashback_sms" id="cashback_sms_n" value="2" >
                                    <label for="cashback_sms_n" style="width: 31px;">No</label> 
                                </div>
                            </div>
                        </div> -->
                        <div class="row div-width hidden case_closed_array">
                            <div class="form-group col-xl-3 col-lg-4 col-md-6 cashback_sms">
                                <label for="cashback_sms_<?php echo $rw_id; ?>" class="radio-tag label-tag">Do you want to close this case?</label>
                                <div class="radio-button error_contain">
                                    <input type="radio" name="case_closed_val" id="case_closed_val_y<?php echo $rw_id; ?>" class="case_closed_array_radio"  value="1" >
                                    <label for="case_closed_val_y<?php echo $rw_id; ?>" style="width: 31px;">Yes</label>
                                    <input type="radio" name="case_closed_val" id="case_closed_val_n<?php echo $rw_id; ?>" class="case_closed_array_radio" value="2" >
                                    <label for="case_closed_val_n<?php echo $rw_id; ?>" style="width: 31px;">No</label> 
                                </div>
                            </div>
                        </div>
                        <div class="row div-width">
                            <div class="form-group col-xl-5 col-lg-4">
                            </div>
                            <div class="form-group col-xl-2 col-lg-4">
                                <input type="button" class="btn btn-primary" name="edit_bank" id='<?php echo $rw_id; ?>' value="Add Bank">
                            </div>
                        </div>
                    </form>
                    <?php } ?>
                    
                    <!-- Add New Bank Div - Close -->
                </div>

            </div>
        </section>
    </main>
</div>
<?php include('../../include/loader.php') ?>
<script>
    var user_role = "<?php echo $_SESSION['user_role']; ?>";
    var one_lead = "<?php echo $_SESSION['one_lead_flag']; ?>";
    var app_ids = [<?php echo implode(',',$app_array); ?>];
</script>
<script>
$(document).ready(function() {
    $(".bank-tab-click").on("click", function() {
        var id      = $(this).attr("data-toggle");
        var form_id = "form_" + id;             // to be display block and rest hidden
        var num_val = id.split("step")[1];
        $("input[name='apply_app_num']").prop('checked', false);
        $(".form-step").css("display", "none");

        $("#" + form_id).css("display", "flex");
        $("#apply_app_num_" + num_val).prop('checked', true);

        $(".tab-click").removeClass("active-tab");
        $("#cmn_tab_" + num_val).addClass("active-tab");
    });

});
<?php if($dialog == 1){ ?>
    var dialog = 1;
<?php }else{ ?>
    var dialog = 0;
<?php } ?>
</script>
<script src="../../include/js/application-journey-new.js?v=20"></script>
<script src="../../include/js/common-function.js"></script>