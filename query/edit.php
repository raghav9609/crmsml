<?php
session_start();
$dialog_pop_up_disabled_flag = 1;
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../include/header.php');
require_once(dirname(__FILE__) . '/../model/queryHelper.php');
require_once(dirname(__FILE__) . '/../include/loader.php');
require_once(dirname(__FILE__) . '/../config/config.php');
require_once "../include/helper.functions.php";
require_once "../include/display-name-functions.php";
require_once "../include/case-query-function-insert.php";
$user = $user;

$notepadflag=0;
$level_id = 1;
if (isset($_REQUEST['page'])) {
    $page = replace_special($_REQUEST['page']);
}
if (isset($_REQUEST['id'])) {
    $id = replace_special(urldecode(base64_decode($_REQUEST['id'])));
    $ut = replace_special($_REQUEST['ut']);
}
$q_id = $id;
$ch_pcity = replace_special($_REQUEST['ch_pcity']);
if ($ch_pcity == 1) {
    echo "<script>alert('Enter Valid City');</script>";
}

$qryyy_id = $id;
$qry = "SELECT qry.purpose_of_loan as purpose_of_loan,qry.query_status as query_status,qry.follow_date as fup_date,qry.follow_time as fup_time,qry.query_status_desc as query_status_desc,qry.lead_assign_on as assign_time,qry.old_form_id as old_form_id,qry.page_url as page_url,qry.device_type as device_type,qry.created_on as date,qry.user_ip as user_ip,qry.id as id,qry.crm_customer_id as cust_id,qry.lead_assign_to as user_id,qry.tool_type as tool_type, qry.verify_phone as verify_phone, qry.loan_type_id as loan_type, qry.loan_amount as loan_amt, qry.query_status_desc as description, user.name as user_name, user.mobile_no as contact_no from crm_query as qry left join crm_master_user as user on qry.lead_assign_to = user.id where qry.id  = '" . $id . "' order by qry.id desc";

$res = mysqli_query($Conn1, $qry) or die(mysqli_error($Conn1));
$exe_form = mysqli_fetch_array($res);

if ($exe_form['id'] == '' || $exe_form['id'] == 0) {
  header("location:index.php");
} else {
    $cust_id = $exe_form['cust_id'];
    $tool_type = $exe_form['tool_type'];
    $call_button_display = 1;
    $ver_phone = $exe_form['verify_phone'];
    $loan_type = $exe_form['loan_type'];
    $loan_amt = $exe_form['loan_amt'];
    $purpose_of_loan = $exe_form['purpose_of_loan'];
    $query_status = $exe_form['query_status'];
    $description = $exe_form['description'];
    $user_name = $exe_form['user_name'];
    $contact_no = $exe_form['contact_no'];
    $loantype_name = $exe_form['loan_type_name'];
    $lead_date_time = $exe_form['date'];
    $new_src = str_replace('', '', $exe_form['page_url']);
    $src_exp = explode("/", $new_src);
    $count = count($src_exp);
    for ($i = 0; $i < $count; $i++) {
        $src[] = str_replace(array('-', '/', '*', '.php'), ' ', $src_exp[$i]);
    }
    $final_src = ucwords(implode(" ", $src)) . " (" . $exe_form['tool_type'] . ")";

    $cust_data = mysqli_query($Conn1, "select cust.cibil_score as cibil_score,cust.company_id as comp_id,cust.name as mname,city.city_name as city_name,city.city_sub_group_id as city_sub_group_id, comp.company_name as comp_name,cust.salary_bank_id as bank_id,cust.salutation_id as salu_id,cust.name as name,cust.dob as dob,cust.phone_no as phone, cust.email_id as email,cust.address as res_address,cust.occupation_id as occup_id,cust.net_income as net_incm, cust.company_name as comp_name_other,cust.pan_no as pan_card,cust.city_id city_id,cust.alternate_phone_no as alt_phone, cust.bank_account_no as account_no,cust.ofc_contact as ofc_contact,cust.office_address as offce_address,cust.office_pincode as ofc_pincode, cust.office_email_id as ofc_email,cust.office_city_id as work_city,cust.marital_status_id as maritalstatus,cust.current_work_exp as cur_comp_wrk_exp, cust.total_work_exp as totl_wrk_exp,cust.mode_of_salary AS salary_pay_id,cust.pincode as pincode from crm_customer as cust left join crm_master_city as city on cust.city_id = city.id left join crm_master_company as comp on cust.company_id = comp.id where cust.id = " . $cust_id . "");
   
    $result_cust_data = mysqli_fetch_array($cust_data);

    $city_sub_group_id = $result_cust_data['city_sub_group_id'];
    $city_name = $result_cust_data['city_name'];
    $employer_type = $comp_id = $result_cust_data['comp_id'];
    $saving_accounts_with = $main_account = $result_cust_data['bank_id'];
    $salu_id = $result_cust_data['salu_id'];
    $name = $result_cust_data['name'];
    $mname = $result_cust_data['mname'];
    $dob = $result_cust_data['dob'];
    $comp_name = $result_cust_data['comp_name'];

    $phone = $mobile = $result_cust_data['phone'];
    $email = $result_cust_data['email'];
    $res_addrs = $result_cust_data['res_address'];
    $occup = $result_cust_data['occup_id'];
    $net_incm = $result_cust_data['net_incm'];
    $cibil_score = $result_cust_data['cibil_score'];
    if ($employer_type == 0) {
        $comp_name_other = $result_cust_data['comp_name_other'];
    }
    $pan_card = $result_cust_data['pan_card'];
    $city_id = $result_cust_data['city_id'];
    $alt_phone = $result_cust_data['alt_phone'];
    $account_no = $result_cust_data['account_no'];
    $office_landline = $result_cust_data['ofc_contact'];
    $offce_address = $result_cust_data['offce_address'];
    $ofc_pincode = $result_cust_data['ofc_pincode'];
    $ofc_email = $result_cust_data['ofc_email'];
    $work_city = $result_cust_data['work_city'];
    $maritalstatus = $result_cust_data['maritalstatus'];
    $ofc_city_name = get_display_name("city_name", $work_city);
    $curDate = currentDate();
    $result_cust_data['cur_comp_wrk_exp'];
    $ccweget = dateDiff($curDate,$result_cust_data['cur_comp_wrk_exp'],1);
    $ccwe = $result_cust_data['cur_comp_wrk_exp'];
    $twe = $result_cust_data['totl_wrk_exp'];
    $tweget = dateDiff($curDate,$result_cust_data['totl_wrk_exp'],1);
    $salary_pay_id = $result_cust_data['salary_pay_id'];
    $pin_code = $result_cust_data['pincode'];

    $ol_level_id = 1;
    $ol_query_id = $q_id;
    $ol_priority_id = str_replace(array('P','p'),'',$_REQUEST['priority']);
    $ol_user_id = $user;
    $ol_date = date("Y-m-d h:i:s");

    if($_REQUEST['search_type'] == '' || $_REQUEST['search_type'] == 0){
        $search_type = 3;
    }else{
        $search_type = $_REQUEST['search_type'];
    }
    if (trim($pan_card) != '') {
        $pan_customer_qry = mysqli_query($Conn1, "select min(id) as cust_pan_id,count(*) as total_count_pan from crm_customer where id > 0 and pan_no = '" . trim($pan_card) . "' order by pan_no");
        $result_customer_qry = mysqli_fetch_array($pan_customer_qry);
        $count_pan = $result_customer_qry['total_count_pan'];
        $cust_pan_id = $result_customer_qry['cust_pan_id'];
    }
    $currentDateTime = date("Y-m-d H:i:s");
    $insert_query = "INSERT into crm_lead_summary_history (lead_id,user_id,type,created_on)values($id,$user_id,1,'$currentDateTime')";
    $res_qry = mysqli_query($Conn1,$insert_query);
    ?>
    <html>
    <head>
    </head>
    <body>
        <input type="hidden" name="final_query_id" value="<?php echo urlencode(base64_encode($id));?>">
        <div class="color-bar-1"></div>
        <div class="color-bar-2 color-bg"></div>
        <div style="width:100%;"><div style="padding-left: 1%;padding-right: 1%;margin-top:10px;">
            <div id="fixed_tab">
                <span style="font-weight:bold;font-size:14px;">
                    <a href="../email/?query_id=<?php echo urlencode(base64_encode($id)); ?>" target='_blank'><input type="button" class="buttonsub cursor" value="Email"></a>
                    <a href="../sms/?query_id=<?php echo urlencode(base64_encode($id)); ?>" target='_blank'> <input type="button" class="buttonsub cursor" value="SMS"></a>
                    <a href="<?php echo $head_url; ?>/calculators/" target="_blank"><input type="button" class="buttonsub cursor" value="EMI"></a>
                    <a href="<?php echo $head_url; ?>/calculators/eligibility.php" target="_blank">
                    <input type="button" class="buttonsub cursor" value="Eligibility"></a>
                    <a href="javascript:void(0);" onclick="suggestion_box('2','1');"><input type="button" class="buttonsub cursor" value="Offers"></a>
                    <a href='<?php echo $src_id; ?>' target="_blank"><input type="button" style='background: #1b8c1b;' class="buttonsub cursor" id='shrt_url' value="Fetch Experian"></a> 
                    <?php if($user_role != 1) { ?>
                        <a href="javascript:void(0);" id='show_btn' onclick="number_show('<?php echo $id; ?>','query');"> <input type="button" style='background: #18375f;' class="buttonsub cursor" value="Show Number"> </a>
                        <a href="javascript:void(0);" id='show_alt_btn' onclick="alt_number_show('<?php echo $id; ?>','query');"> <input type="button" style='background: #18375f;' class="buttonsub cursor" value="Show Alt. Number"> </a>
                    <?php } ?>
                </span>
            </div>
        </div>
    <div class="container-fluid main-container">
        <div class="d-block row">
            <div class="span9">
                <div style="width:100%;float:left;margin-top:10px;">
                    <div align="center">
                        <div class="wrapper">
                            <span class='orange f_13' style="font-weight:bold;">
                                <?php echo "<span class='ml10 fs-13' style='font-weight: normal; color: #000'>Query ID: </span>"; echo "<span style='font-weight: 600; color: #000;'>".$qryyy_id."</span>"; echo "<span class='ml10 fs-13' style='font-weight: normal; color: #000'>Query Date: </span>"; echo "<span style='font-weight: 600; color: #000;'>".date("d-m-Y", strtotime($exe_form['date']))." ".$timeindia."</span> <span class='ml10 fs-13' style='font-weight: normal; color: #000'>Tool Type:</span><span style='font-weight: 600; color: #000;'> ".$tool_type." </span>"; ?> 
                            </span>
                            <?php 
                                $filter=0;
                                if($filterstatus != ""){
                                    $filter=1;
                                }
                                if($filterstatus != ""){
                                    if($filterstatus == "Green"){
                                        $class="np-greenbtn";
                                    } else if($filterstatus == "Red"){
                                        $class="np-redbtn";
                                    } else {
                                        $class="np-amberbtn";
                                    }
                                } else {
                                    $style="visibility: hidden;";
                                }
                            ?>
                            <div class='clear'></div>
                            <?php
                               // require_once "../include/crm_functions-new.php";
                                include("js-insert.php");
                                include("form_index.php");
                            ?>
                            <br>
                            <div style="clear:both;padding:2%;"></div>
                            <div id="follow_history" class="follow_history">
                            <br><br>
                        </div>
                    </div>
                </div>
            </div>
            <script src="../assets/js/easyResponsiveTabs.js" type="text/javascript"></script>
            <script type="text/javascript">
                $(document).ready(function () {
                    $('#horizontal_details_tab').easyResponsiveTabs({
                        type: 'default', //Types: default, vertical, accordion
                        width: 'auto', //auto or any width like 600px
                        fit: true   // 100% fit in a container
                    });
                });

                var loaded_qry_tab = false;
                var loaded_cases_tab = false;
                var loaded_app_tab = false;
                var loaded_lead_alloc = false;
                var loaded_raw_details = false;
                var loaded_api_res = false;
                var loaded_other_details = false;
                var loaded_show_number = false;
                var loaded_call_log = false;
                var loaded_bnk_mapp = false;
                var loaded_one_lead = false;
                var loaded_page_summary = false;
                var loaded_cross_sell = false;
                var loaded_document = false;
                var loaded_hl_filter = false;
                var loaded_getdailer=false;
                var loaded_pre_approved_offers=false;
                var loaded_whatsapp_msg = false;
                var loaded_missed_call = false;
                var loaded_dialer_sms = false;
                var loaded_nearest_pat = false;
                function callAjaxData(e) {
                    if(e.id == "raw_details") {
                        var query_id = "<?php echo $qryyy_id; ?>";
                        if(loaded_raw_details) return;
                        if(query_id) {
                            $.ajax({
                                type: "POST",
                                url: "../insert/ajax_insert_updated_query_details.php",
                                data: "query_id="+query_id,
                                beforeSend: function () {
                                    $(".tab-2 > .facts > .register > .table_set").html('<div class="img">Please wait while we are fetching the details...</div><div class="img"><img style="width: 10%" src="<?php echo $head_url;?>/include/img/common-loader.gif" /></div>');
                                },
                                success: function(msg) {
                                    console.log(msg);
                                    if(msg.trim() == "") {
                                        $(".tab-2 > .facts > .register > .table_set").html("<h3>No Data Found</h3>");
                                    } else {
                                        $(".tab-2 > .facts > .register > .table_set").html(msg);
                                    }
                                }
                    
                            });
                        } else {
                            $(".tab-2 > .facts > .register > .table_set").html("<h3>No Data Found</h3>");
                        }
                        loaded_raw_details = true;
                    } else if(e.id == "cases_tab") {
                        var case_id = "<?php echo $qryyy_id; ?>";
                        if(loaded_cases_tab) return;
                        if(case_id) {
                            $.ajax({
                                type: "POST",
                                url: "../insert/ajax_insert_cust_query_history.php",
                                data: "case_id="+case_id+"&type=case",
                                beforeSend: function () {
                                    $(".tab-3 > .facts > .register > .table_set").html('<div class="img">Please wait while we are fetching the details...</div><div class="img"><img style="width: 10%" src="<?php echo $head_url;?>/include/img/common-loader.gif" /></div>');
                                },
                                success: function(msg) {
                                    console.log(msg);
                                    if(msg.trim() == "") {
                                        $(".tab-3 > .facts > .register > .table_set").html("<h3>No Data Found</h3>");
                                    } else {
                                        $(".tab-3 > .facts > .register > .table_set").html(msg);
                                    }
                                }
                            });
                        } else {
                            $(".tab-3 > .facts > .register > .table_set").html("<h3>No Data Found</h3>");
                        }
                        loaded_cases_tab = true;
                    } else if(e.id == "app_tab") {
                        var case_id = "<?php echo $qryyy_id; ?>";
                        var loan_type = "<?php echo $loan_type; ?>";
                        var cust_id = "<?php echo $cust_id; ?>";
                        if(loaded_app_tab) return;
                        if(case_id) {
                            $.ajax({
                                type: "POST",
                                url: "../insert/ajax_insert_cust_query_history.php",
                                data: "case_id="+case_id+"&loan_type="+loan_type+"&cust_id="+cust_id+"&type=app",
                                beforeSend: function () {
                                    $(".tab-4 > .facts > .register > .table_set").html('<div class="img">Please wait while we are fetching the details...</div><div class="img"><img style="width: 10%" src="<?php echo $head_url;?>/include/img/common-loader.gif" /></div>');
                                },
                                success: function(msg) {
                                    if(msg.trim() == "") {
                                        $(".tab-4 > .facts > .register > .table_set").html("<h3>No Data Found</h3>");
                                    } else {
                                        $(".tab-4 > .facts > .register > .table_set").html(msg);
                                    }
                                }
                         });
                        } else {
                            $(".tab-4 > .facts > .register > .table_set").html("<h3>No Data Found</h3>");
                        }
                        loaded_app_tab = true;
                    } else if(e.id == "other_details") {
                        var query_id = "<?php echo $qryyy_id; ?>";
                        if(loaded_other_details) return;
                        if(query_id) {
                            $.ajax({
                                type: "POST",
                                url: "../insert/show_number_history.php",
                                data: "query_id="+query_id,
                                beforeSend: function () {
                                    $(".tab-5 > .facts > .register > .table_set").html('<div class="img">Please wait while we are fetching the details...</div><div class="img"><img style="width: 10%" src="<?php echo $head_url;?>/include/img/common-loader.gif" /></div>');
                                },
                                success: function(msg) {
                                    if(msg.trim() == "") {
                                        $(".tab-5 > .facts > .register > .table_set").html("<h3>No Data Found</h3>");
                                    } else {
                                        $(".tab-5 > .facts > .register > .table_set").html(msg);
                                    }
                                }
                            });
                        } else {
                            $(".tab-5 > .facts > .register > .table_set").html("<h3>No Data Found</h3>");
                        }
                        loaded_other_details = true;
                    } else if(e.id == "app_rq_rs") {
                        var case_id = "<?php echo $case_id; ?>";
                        var query_id = "<?php echo $qryyy_id; ?>";
                        if(loaded_api_res) return;
                        if(case_id || query_id) {
                            $.ajax({
                                type: "POST",
                                url: "../app/case_app_req_res.php",
                                data: "case_id="+case_id+"&query_id="+query_id,
                                beforeSend: function () {
                                    $(".tab-6 > .facts > .register > .table_set").html('<div class="img">Please wait while we are fetching the details...</div><div class="img"><img style="width: 10%" src="<?php echo $head_url;?>/include/img/common-loader.gif" /></div>');
                                },
                                success: function(msg) {
                                    if(msg.trim() == "") {
                                        $(".tab-6 > .facts > .register > .table_set").html("<h3>No Data Found</h3>");
                                    } else {
                                        $(".tab-6 > .facts > .register > .table_set").html(msg);
                                        show_hide(".request_send");
                                        show_hide(".response_recv");
                                    }
                                }
                            });
                        } else {
                            $(".tab-6 > .facts > .register > .table_set").html("<h3>No Data Found</h3>");
                        }
                        loaded_api_res = true;
                    } else if(e.id == "experian") {
                        var case_id = "<?php echo $case_id; ?>";
                        var query_id = "<?php echo $qryyy_id; ?>";
                        if(loaded_api_res) return;
                        if(case_id || query_id) {
                            $.ajax({
                                type: "POST",
                                url: "../insert/ajax_insert_cust_query_history.php",
                                data: "case_id="+case_id+"&query_id="+query_id+"&type=experian",
                                beforeSend: function () {
                                    $(".tab-7 > .facts > .register > .table_set").html('<div class="img">Please wait while we are fetching the details...</div><div class="img"><img style="width: 10%" src="<?php echo $head_url;?>/include/img/common-loader.gif" /></div>');
                                },
                                success: function(msg) {
                                    if(msg.trim() == "") {
                                        $(".tab-7 > .facts > .register > .table_set").html("<h3>No Data Found</h3>");
                                    } else {
                                        $(".tab-7 > .facts > .register > .table_set").html(msg);
                                        show_hide(".request_send");
                                        show_hide(".response_recv");
                                    }
                                }
                            });
                        } else {
                            $(".tab-7 > .facts > .register > .table_set").html("<h3>No Data Found</h3>");
                        }
                        loaded_api_res = true;
                    }
                }
            </script>
            <br>
            <div style="width: 90%; clear: both; margin: 0 auto;">
                <div class="main">
                    <div class="sap_tabs" style="width: 100%">
                        <div id="horizontal_details_tab" style="display: block; width: 100%; margin: 0px;">
                            <ul class="resp-tabs-list">
                                <li class="resp-tab-item tab-view" aria-controls="details_tab_1" id="fup_his" role="tab">
                                    <span>Follow Up</span>
                                </li>
                                <li class="resp-tab-item lost tab-view" aria-controls="details_tab_2"  id="raw_details"  role="tab" onclick="callAjaxData(this)">
                                    <span>Raw Details</span>
                                </li>
                                <li class="resp-tab-item lost tab-view" aria-controls="details_tab_3"  id="cases_tab" role="tab" onclick="callAjaxData(this)">
                                    <span>Allocation</span>
                                </li>
                                <li class="resp-tab-item lost tab-view" aria-controls="details_tab_4"  id="app_tab"  role="tab" onclick="callAjaxData(this)">
                                    <span>Application</span>
                                </li>
                                <li class="resp-tab-item lost tab-view" aria-controls="details_tab_5"  id="other_details"  role="tab" onclick="callAjaxData(this)">
                                    <span>Show Number</span>
                                </li>
                                <li class="resp-tab-item lost tab-view" aria-controls="details_tab_6"  id="app_rq_rs"  role="tab" onclick="callAjaxData(this)">
                                    <span>Lead Display</span>
                                </li>
                                <li class="resp-tab-item lost tab-view" aria-controls="details_tab_7"  id="experian"  role="tab" onclick="callAjaxData(this)">
                                    <span>Experian</span>
                                </li>
                                <div class="clear"></div>
                            </ul>
                            <div class="resp-tabs-container">
                                <div class="tab-1 resp-tab-content" aria-labelledby="details_tab_1">
                                    <div class="facts">
                                        <div class="register">
                                            <div class="table_set">
                                                <?php include("query-follow-up.php"); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <div class="tab-2 resp-tab-content" aria-labelledby="details_tab_2">
                                <div class="facts">
                                    <div class="register">
                                        <div class="table_set">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-3 resp-tab-content" aria-labelledby="details_tab_3">
                                <div class="facts">
                                    <div class="register">
                                        <div class="table_set">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-4 resp-tab-content" aria-labelledby="details_tab_4">
                                <div class="facts">
                                    <div class="register">
                                        <div class="table_set">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-5 resp-tab-content" aria-labelledby="details_tab_5">
                                <div class="facts">
                                    <div class="register">
                                        <div class="table_set">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-6 resp-tab-content" aria-labelledby="details_tab_6">
                                <div class="facts">
                                    <div class="register">
                                        <div class="table_set">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-7 resp-tab-content" aria-labelledby="details_tab_7">
                                <div class="facts">
                                    <div class="register">
                                        <div class="table_set">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="clear:both; padding:2%;"></div>
    </div>
</body>
</html>
<?php } ?>

