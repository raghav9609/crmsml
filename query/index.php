<?php
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../include/header.php');
require_once(dirname(__FILE__) . '/../config/config.php');
if($user_role == 4){
    echo "<script>window.location.href='".$head_url."/app/';</script>";
    exit;
}    
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

    if (isset($_REQUEST['net_incm_to'])) {
        $net_incm_to = replace_special($_REQUEST['net_incm_to']);
    }
    if (isset($_REQUEST['net_incm_from'])) {
        $net_incm_from = replace_special($_REQUEST['net_incm_from']);
    }

    if (isset($_REQUEST['mlc_product'])) {
        $mlc_product = replace_special($_REQUEST['mlc_product']);
    }

    if (isset($_REQUEST['query_status'])) {
        $query_status = replace_special($_REQUEST['query_status']);
    }

    if (isset($_REQUEST['application_status'])) {
        $application_status = replace_special($_REQUEST['application_status']);
    }


    if (isset($_REQUEST['query_new_status'])) {
        $query_new_status = replace_special($_REQUEST['query_new_status']);
    }
require_once(dirname(__FILE__) . '/../include/helper.functions.php');
require_once(dirname(__FILE__) . '/../include/display-name-functions.php');

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

            function filter_validation() {
                if ($("#email_search").val().trim() != "") {
                    var email_regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
                    if (!email_regex.test($("#email_search").val())) {
                        alert("Customer Email not valid")
                        return false;
                    }
                }
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
                    $qry = "select qry.query_status as query_status,qry.junk_reason as junk_reason,cust.id as customer_id, cust.name as name,cust.email_id as email, cust.phone_no as phone,cust.cibil_score as cibil_score, cust.occupation_id as occup_id,city.city_name as city_name,cust.city_id as city_id, cust.net_income as net_incm, qry.verify_phone as verify_phone, qry.follow_status as follow_status,qry.follow_date as q_follow_date, qry.follow_time AS q_follow_time, user.name as user_name, qry.id as id,qry.created_on as date,qry.query_status_desc as query_status_desc, qry.tool_type as tool_type, qry.lead_assign_to as user_id, qry.loan_type_id as loan_type_id, qry.loan_amount as loan_amt,qry.page_url as page_url from crm_query as qry INNER join crm_customer as cust on qry.crm_customer_id = cust.id left join crm_master_city as city on cust.city_id = city.id left join crm_master_user as user on qry.lead_assign_to = user.id  where 1 ";
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
                            <input type="text" class="text-input" name="query_statussearch" id="query_statussearch" placeholder="Query Status" maxlength="10" value="<?php echo $query_statussearch; ?>" />

                            <input type="text" class="text-input" name="application_status" id="application_status" placeholder="Application Status" maxlength="10" value="<?php echo $application_status; ?>"  />

                        </td>

                            <?php if ($user_role == 1 || $user_role == 4 || $user_role == 2 || $user_role == 5 || $user_role == 9) { ?>
                                <?php echo get_dropdown(1, 'loan_type', $search, ''); ?>
                            <?php }
                            if ($user_role != 3) { ?>
                                <?php echo get_dropdown('user_id_3', 'u_assign', $u_assign, ''); ?>
                            <?php } ?>
                            
                         
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
                            <input class="cursor" type="submit" name="searchsubmit" value="Filter"><input class="cursor" type="button" onclick="resetform()" value="Clear">
                        </form>
                    </fieldset>
                    <?php //if($recordcount > 0){ 
                    ?>
                    <form method="POST" name="frmmain" action="mask_assign.php">
                        <table width="100%" class="gridtable">
                            <tr>
                                <?php if (in_array($user_role,array(1,2))) { ?>
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
                                    // print_r($exe_form);
                                    $id = $exe_form['id'];
                                    $loan_amt = $exe_form['loan_amt'];
                                    $query_status = $exe_form['query_status'];
                                    $date = ($exe_form['date'] == '0000-00-00' || $exe_form['date'] == '' || $exe_form['date'] == '1970-01-01') ? '--' : date("d-m-Y", strtotime($exe_form['date']));
                                    $tool_type = $exe_form['tool_type'];

                    
                                    $query_status_desc = $exe_form['query_status_desc'];
                                    $query_follow_date = ($exe_form['q_follow_date'] == '0000-00-00' || $exe_form['q_follow_date'] == '' || $exe_form['q_follow_date'] == '1970-01-01') ? '--' : date("d-m-Y", strtotime($exe_form['q_follow_date']));

                                    $query_follow_time = ($exe_form['q_follow_time'] != "" && $exe_form['q_follow_time'] != "00:00:00") ? date("H:i:s A", strtotime($exe_form['q_follow_time'])) : "--";

                                    if ($query_follow_date != "--") {
                                        if (strtotime($query_follow_date) == strtotime(date("d-m-Y"))) {
                                            $query_follow_date = "<span class='orange badge-success badge-pill badge'>" . $query_follow_date . " " . $query_follow_time . "</span>";
                                        } else if (strtotime($query_follow_date) < strtotime(date("d-m-Y"))) {
                                            $query_follow_date = "<span class='orange badge-failure badge-pill badge'>" . $query_follow_date . " " . $query_follow_time . "</span>";
                                        } else {
                                            $query_follow_date = $query_follow_date . " " . $query_follow_time;
                                        }
                                    }
                                    $verify_phone = $exe_form['verify_phone'];
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
                                   $get_loan_name = mysqli_query($Conn1,"select value from crm_masters where crm_masters_code_id = 1 and id = ".$exe_form['loan_type_id']);
                                   $res_loan_name = mysqli_fetch_array($get_loan_name);
                                   $get_occup_name = mysqli_query($Conn1,"select value as occup_name from crm_masters where crm_masters_code_id = 7 and id = ".$exe_form['occup_id']);
                                   $res_occup_name = mysqli_fetch_array($get_occup_name);
                                
                                    $loantype_name = ($res_loan_name['value'] != "") ? "(" . $res_loan_name['value'] . ")" : "";
                                    $city_name = ($exe_form['city_name'] != "") ? "(" . $exe_form['city_name'] . ")" : "";
                                    $occupation_name = ($res_occup_name['occup_name']) ? "(" . $res_occup_name['occup_name'] . ")" : "";
                                    $user_name = $exe_form['user_name'];
                                    $follow_name = $exe_form['follow_status'];
                                    $qy_status = 'open';
                        
                                    if (in_array($query_status, array(20, 3))) {
                                        $follow_name = $query_follow_date = '';
                                    }

                                    $customer_id = $exe_form['customer_id'];
                                    
                                    $junk_reason = '';
                                    if ($query_status == 2) {
                                        $junk_reason = trim($exe_form['junk_reason']) != '' ? "(" . $exe_form['junk_reason'] . ")" : '';
                                    }
                                    if ($tool_type == "Bt Form") {
                                        $loan_amt = $extng_amt;
                                    } else {
                                        $loan_amt = $loan_amt;
                                    }

                                    $loan_amt = ($loan_amt > 0) ? custom_money_format($loan_amt) : "";
                                    parse_str($exe_form['page_url'], $get_array);
                                    $utm_campain_name = ucfirst($get_array['utm_campaign']);
                            ?>
                                    <tr>
                                        <?php if (in_array($user_role,array(1,2))) { ?>
                                            <td>
                                                <input type="checkbox" name="mask[]" value="<?php echo $id; ?>">
                                            </td>
                                        <?php } ?>
                                        <td><span><?php echo $id; ?> </span> <br> <span class="fs-13"><?php echo $date; ?></span></td>
                                        <td><?php echo $tool_type ;?></span></td>
                                        <td><a href="../query/edit.php?ut=<?php echo $ut; ?>&id=<?php echo urlencode(base64_encode($id)); ?>&page=<?php echo $page; ?>" class="has_link"><span><?php echo $loan_amt; ?></span><br/>
                                                <span class="fs-12"><?php echo $loantype_name; ?></span></a>
                            
                                        </td>
                                        <td><span><?php echo substr(ucwords(strtolower($name)), 0, 20); ?></span><br /><span class="fs-12"><?php echo $city_name; ?></span></td>
                                        <td><span><?php echo $echo_number; //$phone_no;  
                                                    ?></span> <span class='green fs-12 valign-mid'><b><?php if ($verify_phone == "1") {
                                                                                                            echo " &#10003; ";
                                                                                                        } ?></b></span> <?php if ($verify_phone != '1') { ?> <span class='red fs-11 valign-mid'> <b>X</b></span> <?php } ?><br /><?php if ($alt_phone != '0' && $alt_phone != '') {
                                                                                                                                                                                                                                        echo $alt_phone; ?><br /><?php } ?><?php //echo $email;
                                                                                                                                                                                                                                                                            ?></td>
                                        <td><span><?php echo $net_incm; ?></span></td>
                                        <td><?php if($qy_status > 0){echo $qy_status;}else{echo "-";} ?><br /><?php echo $query_status_desc . "<br><span class = 'red fs-10'>" . $junk_reason . "</span><br>" . $description; ?></td>
                                        <td><span><?php echo $query_follow_date; ?></span><br /><?php if($follow_name != '' && $follow_name != 0){echo $follow_name;}else{echo "-";} ?></td>
                                        <td><?php if ($user_name == '') { ?> -- <?php } else {
                                                                                echo $user_name;
                                                                                 ?><?php } ?></td>
                                        <td><a href="../query/edit.php?ut=<?php echo $ut; ?>&id=<?php echo urlencode(base64_encode($id)); ?>&page=<?php echo $page; ?>" class="has_link"><input type="button" class="pointer_n" value="View" style="border-radius: 5px; background-color: #18375f; font-weight: bold;"></a></td>
                                    </tr>
                                <?php  } ?>
                        </table>
                        <?php if (in_array($user_role,array(1,2))) { ?>
                            <div class="clear ml10 pdT10" style="margin-top: 1%;">
                                <input type="radio" id="assign" name="assign">Assigned to
                                <span id="assign_to"><?php echo get_dropdown('user_id_3', 'assigned', '', ''); ?>
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
            <?php include "../include/footer_close.php"; ?>
            <script type="text/javascript" src="/crmsml/assets/js/common-function.js"></script>
    </body>

    </html>