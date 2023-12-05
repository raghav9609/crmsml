<?php
session_start();
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../include/header.php');
require_once(dirname(__FILE__) . '/../config/config.php');

if ($_SESSION['one_lead_flag'] != 1) {
    
    $ut = '';
    if (isset($_REQUEST['u_assign'])) {
        $u_assign = replace_special($_REQUEST['u_assign']);
    }
    if (isset($_REQUEST['loan_type'])) {
        $search = replace_special($_REQUEST['loan_type']);
    }
    if (isset($_REQUEST['loan_amount'])) {
        $loan_amount = replace_special($_REQUEST['loan_amount']);
    }
    if (isset($_REQUEST['phone'])) {
        $phone_search = replace_special($_REQUEST['phone']);
    }
    if (isset($_REQUEST['query_statussearch'])) {
        $query_statussearch = replace_special($_REQUEST['query_statussearch']);
    }
    if (isset($_REQUEST['to_loan_amount'])) {
        $to_loan_amount = replace_special($_REQUEST['to_loan_amount']);
    }
    if (isset($_REQUEST['city_type'])) {
        $city_type = replace_special($_REQUEST['city_type']);
    }
    if (isset($_REQUEST['city_sub_group'])) {
        $city_sub_group = $_REQUEST['city_sub_group'];
    }
    if (isset($_REQUEST['customer_id_search'])) {
        $customer_id_search = $_REQUEST['customer_id_search'];
    }
    if (isset($_REQUEST['masked_phone'])) {
        $masked_phone = replace_special($_REQUEST['masked_phone']);
    }
    if (isset($_REQUEST['email_search'])) {
        $email_search = $_REQUEST['email_search'];
    }

    if (isset($_REQUEST['ni_user'])) {
        $ni_user = $_REQUEST['ni_user'];
    }

    if (isset($_REQUEST['fup_given_by'])) {
        $fup_given_by = $_REQUEST['fup_given_by'];
    }

    if (isset($_REQUEST['name_search'])) {
        $name_search = replace_special($_REQUEST['name_search']);
    }
    if (isset($_REQUEST['qry_search'])) {
        $qry_search = replace_special($_REQUEST['qry_search']);
    }
    if (isset($_REQUEST['tool'])) {
        $tool = replace_special($_REQUEST['tool']);
    }
    if (isset($_REQUEST['date_from'])) {
        $date_from = replace_special($_REQUEST['date_from']);
    }
    if (isset($_REQUEST['date_to'])) {
        $date_to = replace_special($_REQUEST['date_to']);
    }
    if (isset($_REQUEST['follow_date_from'])) {
        $follow_date_from = replace_special($_REQUEST['follow_date_from']);
    }
    if (isset($_REQUEST['follow_date_to'])) {
        $follow_date_to = replace_special($_REQUEST['follow_date_to']);
    }
    if (isset($_REQUEST['anl_trn'])) {
        $bs_anl_turn = replace_special($_REQUEST['anl_trn']);
    }
    if (isset($_REQUEST['annual_trn_to'])) {
        $annual_trn_to = replace_special($_REQUEST['annual_trn_to']);
    }
    if (isset($_REQUEST['net_incm_to'])) {
        $net_incm_to = replace_special($_REQUEST['net_incm_to']);
    }
    if (isset($_REQUEST['net_incm_from'])) {
        $net_incm_from = replace_special($_REQUEST['net_incm_from']);
    }
    if (isset($_REQUEST['auto_case_create'])) {
        $auto_case_create = replace_special($_REQUEST['auto_case_create']);
    }
    if (isset($_REQUEST['mlc_product'])) {
        $mlc_product = replace_special($_REQUEST['mlc_product']);
    }
    if (isset($_REQUEST['source_compign'])) {
        $source_compign = replace_special($_REQUEST['source_compign']);
    }

    if (isset($_REQUEST['query_new_status'])) {
        $query_new_status = replace_special($_REQUEST['query_new_status']);
    }
    if (isset($_REQUEST['sub_status'])) {
        $sub_status = replace_special($_REQUEST['sub_status']);
    }
    if (isset($_REQUEST['sub_sub_status'])) {
        $sub_sub_status = replace_special($_REQUEST['sub_sub_status']);
    }
    if (isset($_REQUEST['hot_lead_query'])) {
        $hot_lead_query = replace_special($_REQUEST['hot_lead_query']);
    }

    if (isset($_REQUEST['type_of_registration'])) {
        $type_of_registration = replace_special($_REQUEST['type_of_registration']);
    }
    if (isset($_REQUEST['referee_phone'])) {
        $referee_phone = replace_special($_REQUEST['referee_phone']);
    }


    if ($source_compign == 'gcl_id') {
        $source_used = "gclid=";
    } else if ($source_compign == 'source_campaign') {
        $source_used = "utm_source=svg";
    } else if ($source_compign == 'ref_campaign') {
        $source_used = "refer";
    } else if ($source_compign == 'mit') {
        $source_used = "lp-mit.php";
    } else if ($source_compign == 'utm_source') {
        $source_used = "utm_source=wunder_cab";
    }
    $sub_source = replace_special($_REQUEST['sub_source']);
    $insurance = replace_special($_REQUEST['insurance']);
    $promo = replace_special($_REQUEST['promocode']);
    $ref_phone = replace_special($_REQUEST['ref_phone']);
require_once(dirname(__FILE__) . '/../include/helper.functions.php');
require_once(dirname(__FILE__) . '/../include/display-name-functions.php');


    // include "../../include/dropdown.php";
    // include "../../include/display-name-functions.php";
    ?>
    <!DOCTYPE html>
    <html>

    <head>
        <link rel="stylesheet" href="../assets/css/jquery-ui.css">
        <script type="text/javascript" src="../assets/js/jquery-1.10.2.js"></script>
        <script type="text/javascript" src="../assets/js/jquery-ui.js"></script>
        <script>
            function selectAll(source) {
                checkboxes = document.getElementsByName('mask[]');
                for (var i in checkboxes)
                    checkboxes[i].checked = source.checked;
            }

            $(function() {
                jQuery('#date_from').datepicker({
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: 'yy-mm-dd',
                    beforeShow: function() {
                        jQuery(this).datepicker('option', 'maxDate', jQuery('#date_to').val());
                    }
                });
                jQuery('#date_to').datepicker({
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: 'yy-mm-dd',
                    beforeShow: function() {
                        jQuery(this).datepicker('option', 'minDate', jQuery('#date_from').val());
                    }
                });

                jQuery('#follow_date_from').datepicker({
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: 'yy-mm-dd',
                    beforeShow: function() {
                        jQuery(this).datepicker('option', 'maxDate', jQuery('#follow_date_to').val());
                    }
                });
                jQuery('#follow_date_to').datepicker({
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: 'yy-mm-dd',
                    beforeShow: function() {
                        jQuery(this).datepicker('option', 'minDate', jQuery('#follow_date_from').val());
                    }
                });

                $("#assign_to").hide();
                $("#query_search").hide();
                $('#assign').click(function() {
                    $('#assign_to').show();
                    $("#query_search").hide();
                });
                $("#city_type").autocomplete({
                    source: "../../include/city_name.php",
                    minLength: 2
                });
                $('#query').click(function() {
                    $('#query_search').show();
                    $("#assign_to").hide();

                });
            });

            function resetform() {
                window.location.href = "<?php echo $head_url; ?>/query/";
            }

            function opn_subsource() {
                var camp_val = $("#source_compign").val();
                if (camp_val != '') {
                    var sub_src = '<?php echo $sub_source; ?>';
                    var ins = '<?php echo $insurance; ?>';
                    var promo = '<?php echo $promo; ?>';
                    var ref_phone = '<?php echo $ref_phone; ?>';
                    $.ajax({
                        data: "camp=" + camp_val + "&sub_src=" + sub_src + "&ins=" + ins + "&promo=" + promo + "&ref_phone=" + ref_phone,
                        type: "POST",
                        url: "<?php echo $head_url; ?>/include/sub_source.php",
                        success: function(data) {
                            $("#sub").html(data);
                        }
                    })
                }
            }

            function filter_validation() {
                if ($("#email_search").val().trim() != "") {
                    var email_regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
                    if (!email_regex.test($("#email_search").val())) {
                        alert("Customer Email not valid")
                        return false;
                    }
                }
            }

            function new_qs_change(e, sub_lvl) {
                var level_id = 1;
                var parent_id = e.value;
                var sub_level = sub_lvl;
                var new_status_id = e.id;

                if (parent_id == "") {
                    if (new_status_id == "sub_status") {
                        $("#sub_sub_status").remove();
                    } else if (new_status_id == "query_new_status") {
                        $("#sub_status").remove();
                        $("#sub_sub_status").remove();
                    }
                    return;
                }

                $.ajax({
                    type: 'POST',
                    url: "../insert/sub_status_dropdown.php",
                    data: "level_id=" + level_id + "&parent_id=" + parent_id + "&sub_level=" + sub_level,
                    async: false,
                    success: function(data) {
                        console.log(data);
                        if (sub_level == 1) {
                            $("#sub_status").remove();
                            $("#sub_sub_status").remove();
                            $("#query_new_status").after(data);
                        } else if (sub_level == 2) {
                            $("#sub_sub_status").remove();
                            $("#sub_status").after(data);
                        }
                    }
                });
            }
        </script>
    </head>

    <body>
        <div class="color-bar-1"></div>
        <div class="color-bar-2 color-bg"></div>

        <div class="container main-container">
            <!-- End Header -->

            <!-- Page Content
    ================================================== -->
            <div class="row">
                <!--Container row-->
                <!-- Title Header -->
                <div class="span9">
                    <!--Begin page content column-->
                    <?php
                    $qry = "select qry.query_status as query_status,qry.junk_reason as junk_reason,cust.id as customer_id, cust.name as name,cust.email_id as email, cust.phone_no as phone,cust.cibil_score as cibil_score, cust.occupation_id as occup_id,city.city_name as city_name,cust.city_id as city_id, cust.net_income as net_incm, qry.verify_phone as verify_phone, qry.follow_status as follow_status,qry.follow_date as q_follow_date, qry.follow_time AS q_follow_time, user.name as user_name, qry.id as id,qry.created_on as date,qry.query_status_desc as query_status_desc, qry.tool_type as tool_type, qry.lead_assign_to as user_id, qry.loan_type_id as loan_type_id, qry.loan_amount as loan_amt,qry.page_url as page_url from crm_query as qry INNER join crm_customer as cust on qry.crm_customer_id = cust.id left join crm_master_city as city on cust.city_id = city.id left join crm_master_user as user on qry.lead_assign_to = user.id where 1 ";
                    if ($user_role != 1) {
                        $qry .= " and cust.phone_no NOT IN (0) ";
                    }
                    if ($u_assign != '') {
                        $default = 1;
                        if ($u_assign == 6) {
                            $qry .= " and qry.user_id IN (0,6)";
                        } else {
                            $qry .= " and qry.user_id = '" . $u_assign . "'";
                        }
                    }
                    if ($tl_member != '' && $user_role == 2 && $u_assign == '') {
                        $qry .= " and (qry.user_id IN ($tl_member,0))";
                    }
                    if ($search != '') {
                        $default = 1;
                        $qry .= " and qry.loan_type = '" . $search . "'";
                        $qry .= " and date(qry.created_on) between DATE_SUB(CURDATE(), INTERVAL 3 Month) and CURDATE() ";
                    }
                    if ($follow_date_from != '' && $follow_date_to != '') {
                        $default = 1;
                        $qry .= " and qry.follow_date between '" . $follow_date_from . "' and '" . $follow_date_to . "' ";
                    }
                    if ($customer_id_search != "") {
                        $default = 1;
                        $qry .= " and cust.id = $customer_id_search ";
                    }
                    if ($masked_phone != "") {
                        $default = 1;
                        if (strpos($masked_phone, 'XXX') !== false) {
                            $initial = explode("XXX", $masked_phone);
                            if (strlen($initial[0]) == 4 && strlen($initial[1]) == 3) {
                                $qry .= " and phone_no LIKE '" . $initial[0] . "___" . $initial[1] . "'";
                            }
                        }
                    }
                    if ($loan_amount != '' && $to_loan_amount == '') {
                        $default = 1;
                        $qry .= " and qry.loan_amount = '" . $loan_amount . "'";
                    }
                    if ($net_incm_from != '' && $net_incm_to != '') {
                        $default = 1;
                        $qry .= " and cust.net_income between '" . $net_incm_from . "' and '" . $net_incm_to . "'";
                    }
                    if ($loan_amount != '' && $to_loan_amount != '') {
                        $default = 1;
                        $qry .= " and qry.loan_amount between '" . $loan_amount . "' and '" . $to_loan_amount . "'";
                    }
                    if ($tool != '') {
                        $default = 1;
                        $qry .= " and qry.tool_type = '" . $tool . "'";
                    }
                    if ($phone_search != '') {
                        $default = 1;
                        $qry .= " and cust.phone_no = '" . $phone_search . "'";
                    }
                    if ($search_city_id != '' && $search_city_id != 0) {
                        $default = 1;
                        $qry .= " and cust.city_id = '" . $search_city_id . "'";
                    }
                    if ($city_sub_group != '' && $city_sub_group != '0') {
                        $default = 1;
                        $qry .= " and city.city_sub_group_id = '" . $city_sub_group . "'";
                    }

                    if ($name_search != '') {
                        $default = 1;
                        $qry .= " and cust.name like '%" . $name_search . "%'";
                    }
                    if ($qry_search != '') {
                        $default = 1;
                        $qry .= " and qry.id = '" . $qry_search . "'";
                    }

                    if ($query_statussearch != '') {
                        $default = 1;
                        if ($query_statussearch == 11) {
                            $qry .= " and qry.query_status IN (11,18)";
                        }
                        if ($query_statussearch == 5) {
                            $qry .= " and qry.query_status IN (5,19)";
                        } else {
                            $qry .= " and qry.query_status = '" . $query_statussearch . "'";
                        }
                    }

                    if ($query_new_status != "") {
                        $default = 1;
                        $qry .= " AND stats.query_status = $query_new_status ";
                    }

                    if (($user_role == 2 || $user_role == 4 || $user_role == 9) && $search == '') {
                        $qry .= " and qry.loan_type IN ($tl_loan_type)";
                    }

                    if ($date_from != '' && $date_to != '') {
                        $default = 1;
                        $qry .= " and date(qry.created_on) between '" . $date_from . "' and '" . $date_to . "' ";
                    }
                    
                    if (trim($email_search) != "") {
                        $default = 1;
                        $qry .= " AND cust.email_id = '" . $email_search . "' ";
                    }

                    if ($fup_given_by != "" && $fup_given_by > 0) {
                        $default = 1;
                        if ($fup_given_by == 1) {
                            $qry .= " AND qry.follow_given_by = 1 ";
                        } else if ($fup_given_by == 5) {
                            $qry .= " AND qry.follow_given_by = 5";
                        } else {
                            $qry .= " AND qry.follow_given_by != 1 ";
                        }
                    }

                    // if (is_numeric($referee_phone) && strlen($referee_phone) == 10 && $referee_phone > 0) {
                    //     $default = 1;
                    //     $check_partner_id = mysqli_query($Conn1, "SELECT partner_id FROM tbl_mint_partner_info WHERE phone = '" . $referee_phone . "' ORDER BY partner_id DESC LIMIT 0, 1 ");
                    //     $referee_pat_id =  mysqli_fetch_array($check_partner_id)['partner_id'];

                    //     if ($referee_pat_id != "") {
                    //         $qry .= " AND qry.ref_mobile = '" . $referee_pat_id . "' ";
                    //     }
                    // }

                    if ($source_compign != "") {
                        $default = 1;
                        if ($source_compign == 'ref_campaign') {
                            $qry .= " and qry.refer_form_type = '2'";
                        } else {
                            $qry .= " and qry.page_url like '%" . $source_used . "%'";
                        }
                    }
                    if ($sub_source != "") {
                        $default = 1;
                        $qry .= " and qry.page_url like '%" . $sub_source . "%'";
                    }
                    if ($insurance != '') {
                        $default = 1;
                        $qry .= " and qry.page_url like '%" . $insurance . "%'";
                    }
                    // if ($promo != '' || $ref_phone != '') {
                    //     $default = 1;
                    //     $qry_join .= " left JOIN tbl_mint_partner_info as pat ON qry.ref_mobile=pat.partner_id ";
                    //     if ($ref_phone != '') {
                    //         $qry .= " and pat.phone = '" . $ref_phone . "'";
                    //     } else {
                    //         $qry .= " and pat.promocode = '" . $promo . "'";
                    //     }
                    // } else
                     if ($default != 1) {
                        $qry .= " and date(qry.created_on) between DATE_SUB(CURDATE(), INTERVAL 5 DAY) and CURDATE() ";
                    }
                    $qry .= " order by qry.id desc limit " . $offset . "," . $max_offset;
                
                    ?>
                    <fieldset>
                        <legend>Query Filter</legend>
                        <form method="post" action="index.php" name="searchfrm" autocomplete="off" onsubmit="return filter_validation()">
                            <input type="text" class="text-input alpha-wo-space" name="name_search" id="name_search" placeholder="Name" maxlength="30" value="<?php echo $name_search; ?>" />
                            <input type="text" class="text-input numonly" name="qry_search" id="qry_search" placeholder="Query Id" maxlength="30" value="<?php echo $qry_search; ?>" />
                            <input type="text" class="text-input numonly" name="phone" id="phone" placeholder="Phone No" value="<?php echo $phone_search; ?>" maxlength="10" />
                            <?php echo get_textbox('city_type', $city_type, 'placeholder ="City Name (Enter few words)" class="alpha-num-space" maxlength="25"'); ?>

                            <?php echo get_dropdown('crm_master_city_sub_group', 'city_sub_group', $city_sub_group, ''); ?>

                            <input type="text" class="text-input numonly" name="loan_amount" id="loan_amount" placeholder="From Loan Amount" maxlength="10" value="<?php echo $loan_amount; ?>" />
                            <input type="text" class="text-input numonly" name="to_loan_amount" id="to_loan_amount" placeholder="To Loan Amount" maxlength="10" value="<?php echo $to_loan_amount; ?>" />
                            <input type="text" class="text-input numonly" name="net_incm_from" id="net_incm_from" placeholder="Net Incm From" maxlength="10" value="<?php echo $net_incm_from; ?>" />
                            <input type="text" class="text-input numonly" name="net_incm_to" id="net_incm_to" placeholder="Net Incm To" maxlength="10" value="<?php echo $net_incm_to; ?>" />
                            <input type="text" class="text-input" name="date_from" id="date_from" placeholder="Date From" maxlength="10" value="<?php echo $date_from; ?>" readonly="readonly" />
                            <input type="text" class="text-input" name="date_to" id="date_to" placeholder="Date To" maxlength="10" value="<?php echo $date_to; ?>" readonly="readonly" />
                            <?php // echo get_dropdown('annual_turnover', 'anl_trn', $bs_anl_turn, ''); ?>
                        </td>

               

                            <?php if ($user_role == 1 || $user_role == 4 || $user_role == 2 || $user_role == 5 || $user_role == 9) { ?>
                                <?php echo get_dropdown(1, 'loan_type', $search, ''); ?>
                            <?php }
                            if ($user_role != 3) { ?>
                                <?php echo get_dropdown('user', 'u_assign', $u_assign, ''); ?>
                            <?php } ?>
                            <?php // echo get_dropdown('tool_type', 'tool', $tool, ''); ?>
                            
                         
                            <input type="text" class="text-input" name="follow_date_from" id="follow_date_from" placeholder="Follow Date From" maxlength="10" value="<?php echo $follow_date_from; ?>" readonly="readonly" />
                            <input type="text" class="text-input" name="follow_date_to" id="follow_date_to" placeholder="Follow Date To" maxlength="10" value="<?php echo $follow_date_to; ?>" readonly="readonly" />

                            <select name="fup_given_by" id="fup_given_by">
                                <option value="">Followup Given By</option>
                                <option value="1" <?php echo ($fup_given_by == 1) ? "selected" : ""; ?>>Customer</option>
                                <option value="5" <?php echo ($fup_given_by == 5) ? "selected" : ""; ?>>Auto FUP by Customer</option>
                                <option value="2" <?php echo ($fup_given_by == 2) ? "selected" : ""; ?>>SML User</option>
                            </select>

                            <input type="text" class="text-input numonly" name="customer_id_search" id="customer_id_search" placeholder="Customer ID" maxlength="30" value="<?php echo $customer_id_search; ?>" />
                            <input type="text" class="text-input alnum-wo-space" name="masked_phone" id="masked_phone" placeholder="Masked Phone No." value="<?php echo $masked_phone; ?>" maxlength="10" />
                            <input type="text" class="text-input no-space" name="email_search" id="email_search" placeholder="Customer Email" value="<?php echo $email_search; ?>" maxlength="100" autocomplete="null" />
                            <?php // get_dropdown("ni_user", "ni_user", $ni_user, ""); ?>

                            <?php // get_dropdown("type_of_registration", "type_of_registration", $type_of_registration, ""); ?>

                            <input class="cursor" type="submit" name="searchsubmit" value="Filter"><input class="cursor" type="button" onclick="resetform()" value="Clear">
                        </form>
                    </fieldset>
                    <?php //if($recordcount > 0){ 
                    ?>
                    <form method="POST" name="frmmain" action="mask_assign.php">
                        <table width="100%" class="gridtable">
                            <tr>
                                <?php if ($_SESSION['assign_access_lead'] == 1) { ?>
                                    <th width="5%">
                                        <div><input type="checkbox" name="selectall" id="selectall" onClick="selectAll(this)">Select</div>
                                        </td><?php } ?>
                                    <th width="10%">Query id / <br> Date & Time</th>
                                    <th width="10%">Tool Type</th>
                                    <th width="10%">Loan Amount & Type</th>
                                    <th width="10%">Name & City</th>
                                    <th width="10%">Mobile
                                        <!-- & Email -->
                                    </th>
                                    <th width="10%">Net Income & Occupation</th>
                                    <th width="10%">Query Status & Desc</th>
                                    <th width="10%">Follow up date & Type</th>
                                    <th width="10%">Assign To</th>
                                    <th width="10%">Action</th>
                                    <?php if ($user_role == 1) { ?><th width="10%">Query Status Update</th><?php } ?>
                                    <th width="10%">View</th>
                            </tr>
                            <?php
                            $res = mysqli_query($Conn1, $qry) or die("Error: " . mysqli_error($Conn1));
                             $recordcount = mysqli_num_rows($res); // 11
                            if ($recordcount > 0) {
                                $record = 0;
                                while ($exe_form = mysqli_fetch_array($res)) {
                                    $record++;
                                    if ($record > 10) {
                                        continue;
                                    }
                                    $id = $exe_form['id'];
                                    $loan_amt = $exe_form['loan_amt'];
                                    $query_status = $exe_form['query_status'];
                                   // $mobile_status = $exe_form['mobile_status'];
                                   // $extng_amt = $exe_form['extng_amt'];
                                    $date = ($exe_form['date'] == '0000-00-00' || $exe_form['date'] == '' || $exe_form['date'] == '1970-01-01') ? '--' : date("d-m-Y", strtotime($exe_form['date']));
                                  //  $time = $exe_form['time'];
                                    $tool_type = $exe_form['tool_type'];

                                    $tool_type_ybl = '';
                                    if (strpos($exe_form['page_url'], 'YBL_Bluesky') !== false) {
                                        $tool_type_ybl = "( <span class='green'>YBL Bluesky Lead</span> )";
                                    }
                                    $query_status_desc = $exe_form['query_status_desc'];
                                    $query_follow_date = ($exe_form['q_follow_date'] == '0000-00-00' || $exe_form['q_follow_date'] == '' || $exe_form['q_follow_date'] == '1970-01-01') ? '--' : date("d-m-Y", strtotime($exe_form['q_follow_date']));

                                    $query_follow_time = ($exe_form['q_follow_time'] != "" && $exe_form['q_follow_time'] != "00:00:00") ? date("H:i:s A", strtotime($exe_form['q_follow_time'])) : "--";
                                echo "dfgdgf";
                                    if ($query_follow_date != "--") {
                                        if (strtotime($query_follow_date) == strtotime(date("d-m-Y"))) {
                                            $query_follow_date = "<span class='orange badge-success badge-pill badge'>" . $query_follow_date . " " . $query_follow_time . "</span>";
                                        } else if (strtotime($query_follow_date) < strtotime(date("d-m-Y"))) {
                                            $query_follow_date = "<span class='orange badge-failure badge-pill badge'>" . $query_follow_date . " " . $query_follow_time . "</span>";
                                        } else {
                                            $query_follow_date = $query_follow_date . " " . $query_follow_time;
                                        }
                                    }
                                   // $query_follow_type = $exe_form['q_follow_type'];
                                    $verify_phone = $exe_form['verify_phone'];
                                    //$timeindia = $time;
                                    //$timeindia = date('H:i:s', strtotime($time)+19800);
                                    $name = $exe_form['name'];
                                    $email = ($exe_form['email'] != "") ? "(" . $exe_form['email'] . ")" : "";
                                    $phone_no = $exe_form['phone'];

                                    if ($user_role != '1') {
                                        $echo_number = substr_replace($phone_no, 'XXX', 4, 3);
                                    } else {
                                        $echo_number = $phone_no;
                                    }
                                  
                                    // $net_incm = custom_money_format($exe_form['net_incm']);
                                    $net_incm = ($exe_form['net_incm'] > 0) ? custom_money_format($exe_form['net_incm']) : "";
                                  //  $auto_case_create_v = $exe_form['auto_case_create'];
                                   // $lform_flag = $exe_form['lform_flag'];
                                   // $description = $exe_form['description'];
                                   $get_loan_name = mysqli_query($Conn1,"select value from crm_masters where crm_masters_code_id = 1 and id = ".$exe_form['loan_type_id']);
                                   $res_loan_name = mysqli_fetch_array($get_loan_name);
                                //print_r($res_loan_name);
                                   $get_occup_name = mysqli_query($Conn1,"select value as occup_name from crm_masters where crm_masters_code_id = 7 and id = ".$exe_form['occup_id']);
                                   $res_occup_name = mysqli_fetch_array($get_occup_name);
                                
                                //    $get_city_name = mysqli_query($Conn1,"select city_name from crm_master_city where id = ".$exe_form['city_id']);
                                //    $res_city_name = mysqli_fetch_array($get_city_name);
                                //    print_r($res_city_name);
                                    $loantype_name = ($res_loan_name['value'] != "") ? "(" . $res_loan_name['value'] . ")" : "";
                                    $city_name = ($exe_form['city_name'] != "") ? "(" . $exe_form['city_name'] . ")" : "";
                                    $occupation_name = ($res_occup_name['occup_name']) ? "(" . $res_occup_name['occup_name'] . ")" : "";
                                    //$qy_status = $exe_form['qy_status'];
                                    $user_name = $exe_form['user_name'];
                                   // $extension = $exe_form['extension'];
                                    $follow_name = $exe_form['follow_status'];
                                    $qy_status = 'open';
                                    // $qy_status = get_display_name('query_status', $query_status);
                                    // if ($qy_status == '') {
                                    //     $qy_status = get_display_name('new_status_name', $query_status);;
                                    // }
                                    echo "dfgdgf s";
                                    //$stats_other_status = trim($exe_form['other_status'], ',');
                                

                                    if (in_array($query_status, array(20, 3))) {
                                        $follow_name = $query_follow_date = '';
                                    }

                                    $customer_id = $exe_form['customer_id'];
                                    // $qry_get_experian_rec = mysqli_query($Conn1, "select history_id from experian_report_pull_history where cust_id = '" . $customer_id . "' order by history_id DESC limit 1");
                                    // $res_get_expeerian_rec = mysqli_fetch_array($qry_get_experian_rec);
                                    // $ttl_experian_record = $res_get_expeerian_rec['history_id'];
                                    // $cibil_score = (trim($exe_form['cibil_score']) != "" && $exe_form['cibil_score'] > 0 && is_numeric($exe_form['cibil_score'])) ? "(CR: <span>" . (($user_role == 1) ? "<a target='_blank' href='../report/free-credit-report.php?uid=" . base64_encode($ttl_experian_record) . "&action=view'>" . $exe_form['cibil_score'] . "</a>" : $exe_form['cibil_score']) . "</span>)" : "";
                                    $junk_reason = '';
                                    if ($query_status == 2) {
                                        $junk_reason = trim($exe_form['junk_reason']) != '' ? "(" . $exe_form['junk_reason'] . ")" : '';
                                    }


                                    // $qry_get_epf_rec = mysqli_query($Conn1, "select count(*) as ttl_epf from epf_company_detail where cust_id = '" . $customer_id . "'");
                                    // $res_get_epf_rec = mysqli_fetch_array($qry_get_epf_rec);
                                    // $ttl_epf_record = $res_get_epf_rec['ttl_epf'];

                                    if ($tool_type == "Bt Form") {
                                        $loan_amt = $extng_amt;
                                    } else {
                                        $loan_amt = $loan_amt;
                                    }

                                    $loan_amt = ($loan_amt > 0) ? custom_money_format($loan_amt) : "";

                                    
                                    parse_str($exe_form['page_url'], $get_array);
                                    $utm_campain_name = ucfirst($get_array['utm_campaign']);
                       echo "sdsdsdsd";
                                    // $obj = new queries($id);
                                    // $obj->email_count();
                                    // $resulr_case_mail_count = $obj->execute();
                                    // $obj->sms_count();
                                    // $resulr_qry_sms_count = $obj->execute();
                            ?>
                                    <tr>
                                        <?php if ($_SESSION['assign_access_lead'] == 1) { ?>
                                            <td>
                                                <input type="checkbox" name="mask[]" value="<?php echo $id; ?>">
                                            </td>
                                        <?php } ?>
                                        <td><span><?php echo $id; ?> </span> <br> <span class="fs-13"><?php echo $date; ?> <?php echo common_time_filter($timeindia, "am_pm"); ?></span></td>
                                        <td><?php echo $tool_type . "<br> " . $tool_type_ybl . " " . $sub_tool_type_name . " " . $utm_campain_name . "<br><span class='fs-12'>(" . $form_type . ")</span>";
                                            if ($auto_case_create_v > 0) {
                                                echo "<br><span class='fs-12'>(Auto)</span>";
                                            } ?></span></td>
                                        <td><a href="../all_query/edit.php?ut=<?php echo $ut; ?>&id=<?php echo urlencode(base64_encode($id)); ?>&page=<?php echo $page; ?>" class="has_link"><span><?php echo $loan_amt; ?></span>
                                                <?php if ($tool == 'CREPF_ScoreBased' || $tool == 'CR_ScoreBased') { ?><span> ? </span><?php } ?></span><br /><span class="fs-12"><?php echo $loantype_name; ?></span></a>
                                            <br><?php if ($ttl_experian_record > 0) {
                                                    echo "<span class='fs-12'>$cibil_score</span>";
                                                } ?>

                                            <?php if ($ttl_epf_record > 0) {
                                                echo "<br><span class='fs-12'>(EPF <span class='green'><b> &#10003 </b></span>) </span>";
                                            } ?>
                                        </td>
                                        <td><span><?php echo substr(ucwords(strtolower($name)), 0, 20); ?></span><br /><span class="fs-12"><?php echo $city_name; ?></span></td>
                                        <td><span><?php echo $echo_number; //$phone_no;  
                                                    ?></span> <span class='green fs-12 valign-mid'><b><?php if ($verify_phone == "1") {
                                                                                                            echo " &#10003; ";
                                                                                                        } ?></b></span> <?php if ($verify_phone != '1') { ?> <span class='red fs-11 valign-mid'> <b>X</b></span> <?php } ?><br /><?php if ($alt_phone != '0' && $alt_phone != '') {
                                                                                                                                                                                                                                        echo $alt_phone; ?><br /><?php } ?><?php //echo $email;
                                                                                                                                                                                                                                                                            ?></td>
                                        <td><span><?php echo $net_incm; ?></span><br /><span class="fs-12"><?php echo $occupation_name; ?></span></td>
                                        <td><?php echo $qy_status; ?><br /><?php echo $query_status_desc . "<br><span class = 'red fs-10'>" . $junk_reason . "</span><br>" . $description; ?></td>
                                        <td><span><?php echo $query_follow_date; ?></span><br /><?php echo $follow_name; ?></td>
                                        <td><?php if ($user_name == '') { ?> -- <?php } else {
                                                                                echo $user_name;
                                                                                if ($extension > 0) {
                                                                                    echo "<br><span class='fs-12'>(" . $extension . ")</span>";
                                                                                } ?><?php } ?></td>
                                        <td>Email<?php if ($resulr_case_mail_count['total_mail_count'] > 0) {
                                                        echo '<span class="orange"> (&#10003;)</span>';
                                                    } ?>
                                            <br>
                                            <?php if ($mobile_status == 0) { ?>
                                                <a href='../email/send-sms.php?query_id=<?php echo urlencode(base64_encode($id)); ?>' target='_blank' class='has_link'><span>SMS</span></a>
                                            <?php } ?>
                                            <?php if ($resulr_qry_sms_count['total_sms_count'] > 0) { ?><span class="orange"> (&#10003;)</span><?php } ?>
                                        </td>
                                        <?php if ($user_role == 1) { ?>
                                            <td><a href="query_status_form.php?query_id=<?php echo urlencode(base64_encode($id)); ?>" class="has_link">Update Status</a></td>
                                        <?php } ?>
                                        <td><a href="../all_query/edit.php?ut=<?php echo $ut; ?>&id=<?php echo urlencode(base64_encode($id)); ?>&page=<?php echo $page; ?>" class="has_link"><input type="button" class="pointer_n" value="View" style="border-radius: 5px; background-color: #18375f; font-weight: bold;"></a></td>
                                    </tr>
                                <?php  } ?>
                        </table>
                        <?php if ($_SESSION['assign_access_lead']) { ?>
                            <div class="clear ml10 pdT10" style="margin-top: 1%;">
                                <input type="radio" id="assign" name="assign">Assigned to
                                <span id="assign_to"><?php echo get_dropdown('user_lead_assign', 'assigned', '', ''); ?>
                                    <input type="hidden" name="request_builder" value="<?php echo http_build_query($_REQUEST); ?>">
                                    <input type="submit" name="edit" value="Assign" />
                            </div>
                        <?php } ?>
                    </form>
                    <?php if ($recordcount > 0) { ?>
                        <table width="85%" style="float:left" border="0" align="center" cellpadding="4" cellspacing="1" class="pagination">
                            <tr class="sidemain">
                                <td>
                                    <?php
                                    if ($page > 1) {
                                        echo "<a class='page gradient' href='index.php?page=1&phone=$phone_search&sub_source=$sub_source&insurance=$insurance&promocode=$promocode&source_compign=$source_compign&ref_phone=$ref_phone&tool=$tool&loan_type=$search&u_assign=$u_assign&loan_amount=$loan_amount&to_loan_amount=$to_loan_amount&name_search=$name_search&query_statussearch=$query_statussearch&city_type=$city_type&city_sub_group=$city_sub_group&date_from=$date_from&date_to=$date_to&anl_trn=$bs_anl_turn&mlc_product=$mlc_product&net_incm_from=$net_incm_from&net_incm_to=$net_incm_to&follow_date_from=$follow_date_from&follow_date_to=$follow_date_to&customer_id_search=$customer_id_search&masked_phone=$masked_phone&email_search=$email_search&auto_case_create=$auto_case_create&query_new_status=$query_new_status&sub_status=$sub_status&sub_sub_status=$sub_sub_status&type_of_registration=$type_of_registration&ni_user=$ni_user&fup_given_by=$fup_given_by&referee_phone=$referee_phone&hot_lead_query=$hot_lead_query'>First</a>";
                                        echo "<a class='page gradient' href='index.php?page=" . ($page - 1) . "&phone=$phone_search&sub_source=$sub_source&insurance=$insurance&promocode=$promocode&source_compign=$source_compign&ref_phone=$ref_phone&tool=$tool&loan_type=$search&u_assign=$u_assign&loan_amount=$loan_amount&to_loan_amount=$to_loan_amount&name_search=$name_search&query_statussearch=$query_statussearch&city_type=$city_type&city_sub_group=$city_sub_group&date_from=$date_from&date_to=$date_to&anl_trn=$bs_anl_turn&mlc_product=$mlc_product&net_incm_from=$net_incm_from&net_incm_to=$net_incm_to&follow_date_from=$follow_date_from&follow_date_to=$follow_date_to&customer_id_search=$customer_id_search&masked_phone=$masked_phone&email_search=$email_search&auto_case_create=$auto_case_create&query_new_status=$query_new_status&sub_status=$sub_status&sub_sub_status=$sub_sub_status&type_of_registration=$type_of_registration&ni_user=$ni_user&fup_given_by=$fup_given_by&referee_phone=$referee_phone&hot_lead_query=$hot_lead_query'>Prev</a>";
                                    }
                                    echo "<a class='page gradient' href='javascript:void;'>" . $page . "</a>";
                                    if ($recordcount > $display_count) {
                                        echo "<a class='page gradient' href='index.php?page=" . ($page + 1) . "&phone=$phone_search&sub_source=$sub_source&insurance=$insurance&promocode=$promocode&source_compign=$source_compign&ref_phone=$ref_phone&tool=$tool&loan_type=$search&u_assign=$u_assign&loan_amount=$loan_amount&to_loan_amount=$to_loan_amount&name_search=$name_search&query_statussearch=$query_statussearch&city_type=$city_type&city_sub_group=$city_sub_group&date_from=$date_from&date_to=$date_to&anl_trn=$bs_anl_turn&mlc_product=$mlc_product&net_incm_from=$net_incm_from&net_incm_to=$net_incm_to&follow_date_from=$follow_date_from&follow_date_to=$follow_date_to&customer_id_search=$customer_id_search&masked_phone=$masked_phone&email_search=$email_search&auto_case_create=$auto_case_create&query_new_status=$query_new_status&sub_status=$sub_status&sub_sub_status=$sub_sub_status&type_of_registration=$type_of_registration&ni_user=$ni_user&fup_given_by=$fup_given_by&referee_phone=$referee_phone&hot_lead_query=$hot_lead_query'>Next</a>";
                                    }
                                    ?>
                                </td>
                            </tr>
                        </table>
                <?php }
                            } ?>
                </div>
            <?php include "../include/footer_close.php";
            echo "<script>window.onload = opn_subsource();</script>";
        } else {
            /* if($_SESSION['tl_loan_type'] != ''){
    $new_lead_flag = 0;
    $loan_type_user_assign = explode(',',$_SESSION['tl_loan_type']);
    if(in_array(56,$loan_type_user_assign) || in_array(60,$loan_type_user_assign) || in_array(71,$loan_type_user_assign)){
    $new_lead_flag = 1;
    }
    }*/
            include "../include/loader.php";
            ?>
                <div id="data_not_found" class="main-text-position"></div>
                <script>
                    $(document).ready(function() {
                        //var new_lead_flag = '<?php echo $new_lead_flag; ?>';
                        //if(new_lead_flag == 1){
                        var url = 'one-lead-new.php';
                        /*}else{
                         var url = 'one-lead.php';
                        }*/
                        $.ajax({
                            type: 'POST',
                            url: url,
                            async: false,
                            success: function(data) {
                                var jsonparse = JSON.parse(data);
                                $("#loader").css("display", "none");
                                if (jsonparse.id != '' && jsonparse.id > 0) {
                                    window.location.href = jsonparse.URL;
                                } else {
                                    $("#data_not_found").html("Dear User, you do not have any query/case/application.<br><br>Please contact your Team Leader for more queries.");
                                }
                            }

                        });
                    });
                    setTimeout(function() {
                        location.reload();
                    }, 30000);
                </script>
            <?php } ?>
            <script type="text/javascript" src="../../include/js/common-function.js"></script>
    </body>

    </html>