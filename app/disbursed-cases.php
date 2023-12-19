<?php 
$slave = 1;
require_once "../../include/crm-header.php";
require_once "../../include/dropdown.php";
include ("../../include/paging_class.php");
require_once "../../include/display-name-functions.php";
$offset = '20';
	$display_range = '10';
	$page = '1';
       if(isset($_REQUEST['page'])){   
		$page = replace_special($_REQUEST['page']); 
	   }
$u_assign = replace_special($_REQUEST['u_assign']);
$app_no = replace_special($_REQUEST['app_no']);
$search = replace_special($_REQUEST['loan_type']);
$case_no = replace_special($_REQUEST['case_no']);
$from_loan_amount = replace_special($_REQUEST['from_loan_amount']);
$to_loan_amount = replace_special($_REQUEST['to_loan_amount']);
$disb_date_from = replace_special($_REQUEST['disb_date_from']);
$disb_date_to = replace_special($_REQUEST['disb_date_to']); 
$banksearch = replace_special($_REQUEST['banksearch']);
$city_type  = replace_special($_REQUEST['city_type']);
$pre_status = replace_special($_REQUEST['pre_status']);
$phone_no = replace_special($_REQUEST['phone_no']);
$cust_name = replace_special($_REQUEST['cust_name']);
$app_statussearch  = replace_special($_REQUEST['app_statussearch']);
$loan_nature = replace_special($_REQUEST['loan_nature']);
if(isset($_REQUEST['fos_filter'])) {
    $fos_filter = replace_special($_REQUEST['fos_filter']);
}
if(isset($_REQUEST['fos_follow_date'])) {
    $fos_follow_date = replace_special($_REQUEST['fos_follow_date']);
}

if(isset($_REQUEST['app_new_status'])) {
    $app_new_status = replace_special($_REQUEST['app_new_status']);
}
if(isset($_REQUEST['sub_status'])) {
    $sub_status = replace_special($_REQUEST['sub_status']);
}
if(isset($_REQUEST['sub_sub_status'])) {
    $sub_sub_status = replace_special($_REQUEST['sub_sub_status']);
}

if(isset($_REQUEST['refarming_user_id'])) {
    $refarming_user_id = replace_special($_REQUEST['refarming_user_id']);
}

$kotak_resp_array = array('1'=>'Follow Up','2'=>'Declined','3'=>'Login','4'=>'Hold','5'=>'Disbursed','6'=>'Sanctioned','7'=>'Approved','8'=>'Closed','9'=>'In Process');
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../../include/css/jquery-ui.css" />
 <script type="text/javascript" src="../../include/js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="../../include/js/jquery-ui.js"></script>	
<script>
$(function() {
jQuery('#disb_date_from').datepicker({
changeMonth: true, 
      changeYear: true,
      dateFormat: 'yy-mm-dd',
	    beforeShow : function(){
            jQuery( this ).datepicker('option','maxDate', jQuery('#disb_date_to').val() );
        }
    });
jQuery('#fos_follow_date').datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: 'yy-mm-dd',                
            });
    jQuery('.fup_date').datepicker({
changeMonth: true, 
      changeYear: true,
      dateFormat: 'yy-mm-dd',
    });
    jQuery('#disb_date_to').datepicker({
changeMonth: true, 
      changeYear: true,
      dateFormat: 'yy-mm-dd',
        beforeShow : function(){
            jQuery( this ).datepicker('option','minDate',    jQuery('#disb_date_from').val() );
        }
    });
  });
  
function resetform() {
	$('.disb_form input[type=text]').val("");
	$('.disb_form select').val("");
}

function new_qs_change(e, sub_lvl) {
    var level_id = 3;
    var parent_id = e.value;
    var sub_level = sub_lvl;
    var new_status_id = e.id;

    if(parent_id == "") {
        if(new_status_id == "sub_status") {
            $("#sub_sub_status").remove();
        } else if(new_status_id == "app_new_status") {
            $("#sub_status").remove();
            $("#sub_sub_status").remove();
        }
        return;
    }

    $.ajax({
        type: 'POST',
        url: "../insert/sub_status_dropdown.php",
        data: "level_id=" + level_id + "&parent_id=" + parent_id + "&sub_level=" + sub_level,
        async:false,
        success: function(data) {
            console.log(data);
            if(sub_level == 1) {
                $("#sub_status").remove();
                $("#sub_sub_status").remove();
                $("#app_new_status").after(data);
            } else if(sub_level == 2) {
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
    <div class="row"><!--Container row-->
 
    <!-- Title Header -->
        <div class="span9"><!--Begin page content column-->
<?php
$fetch_disb_cases = "select app.app_id,app.case_id,app.app_bank_on,app.app_status_on,app.disbursed_amount_on,app.first_disb_date_on,cse.loan_type,cust.name,cust.email,cust.phone,cust.city_id,cse.user_id,app.bank_app_no_on,app.app_description,fup_desc,follow_up_date_on,follow_up_type_on,cust.id,cse.loan_type,app.pre_login_status,app.date_created as date,app.bank_crm_lead_on as bank_crm_lead_on,app.sanctioned_amount_on,app.login_date_on,app.sanction_date_on,app.applied_amount_on,cust.pan_card as pan_card,cse.bus_anl_trnover as bus_anl_trnover,cse.annual_turnover_num as annual_turnover_num,app.bank_app_no_on as bnk_app_no,cse.profit_itr_amt as profit_itr_amt,cse.required_loan_amt as loan_amt,cust.net_incm as net_incm,cust.comp_id as comp_id,cust.comp_name_other as comp_other,cust.dob as dob,cust.res_address as address,app.disb_email_flag as disb_email_flag,app.source as source,app.bank_crm_lead_on as bank_crm_lead_on,app.con_call as con_call,app.flag_for_los as flag_for_los,cse.auto_case_create as auto_case_create,cse.fos_user_id as fos_user_id,cse.loan_nature as loan_nature,app.sub_sub_status from tbl_mint_app as app INNER join tbl_mint_case as cse on app.case_id = cse.case_id INNER join tbl_mint_customer_info as cust on cse.cust_id  = cust.id where app.app_id > 0  ";
$qry_count = "select count(*) as total_count from tbl_mint_app as app left join tbl_mint_case as cse on app.case_id = cse.case_id left join tbl_mint_customer_info as cust on cse.cust_id  = cust.id where app.app_id > 0 ";
if($banksearch != '' && $banksearch != 0){
  $date_filter = 1;
$fetch_disb_cases .= " and app.app_bank_on = '".$banksearch."' ";
$qry_count .= "  and app.app_bank_on = '".$banksearch."' ";
}else{      
$bank_display = implode(',',array_filter($bank_rm_id));
$fetch_disb_cases .= " and app.app_bank_on IN (".$bank_display.") ";
$qry_count .= "  and app.app_bank_on IN (".$bank_display.") ";
}
if($case_no != '' &&  $case_no != 0){
   $date_filter = 1;
   $fetch_disb_cases .= " and app.case_id = '".$case_no."' ";
   $qry_count .= " and app.case_id = '".$case_no."' ";
}
if($fos_filter == 1) {
    $date_filter = 1;
    $fetch_disb_cases .= " and cse.is_fos = '".$fos_filter."' ";
    $qry_count .= " and cse.is_fos = '".$fos_filter."' ";
} else if($fos_filter == 2) {
    $date_filter = 1;
    $fetch_disb_cases .= " and cse.is_fos = 0 ";
    $qry_count .= " and cse.is_fos = 0 ";
}

if($fos_follow_date != "" && $fos_follow_date != "0000-00-00") {
    $date_filter = 1;
    $fetch_disb_cases .= " and cse.fos_fol_date = '".$fos_follow_date."' and cse.is_fos = 1 ";
    $qry_count .= " and cse.fos_fol_date = '".$fos_follow_date."' and cse.is_fos = 1 ";
}
if($app_no != '' &&  $app_no != 0){
   $date_filter = 1;
   $fetch_disb_cases .= " and app.app_id = '".$app_no."' ";
   $qry_count .= " and app.app_id = '".$app_no."' ";
}
if($city_type != '' && $city_type != '0'){
     $date_filter = 1;
     $fetch_disb_cases .= " and cust.city_id = '".$city_type."' ";
     $qry_count .= " and cust.city_id = '".$city_type."' ";
}if($phone_no > 0 && $phone_no != ''){
     $date_filter = 1;
     $fetch_disb_cases .= " and cust.phone = '".$phone_no."' ";
     $qry_count .= " and cust.phone = '".$phone_no."' ";
}
if($from_loan_amount != '' && $from_loan_amount != '0' && $to_loan_amount != '' && $to_loan_amount != '0'){
     $date_filter = 1;
if($app_statussearch == 6 || $app_statussearch == 7 || in_array($app_new_status,array(1019)) || in_array($sub_status,array(1098,1099))){
    $fetch_disb_cases .= " and app.disbursed_amount_on between '".$from_loan_amount."' and '".$to_loan_amount."' ";
    $qry_count .= " and app.disbursed_amount_on between '".$from_loan_amount."' and '".$to_loan_amount."' ";
}else if($app_statussearch == 5 || in_array($app_new_status,array(1017)) || in_array($sub_status,array(1094,1095,1096,1097))){
    $fetch_disb_cases .= " and app.sanctioned_amount_on between '".$from_loan_amount."' and '".$to_loan_amount."' ";
    $qry_count .= " and app.sanctioned_amount_on between '".$from_loan_amount."' and '".$to_loan_amount."' ";
}else if($app_statussearch == 3 || in_array($app_new_status,array(1016))){
   $fetch_disb_cases .= " and app.applied_amount_on between '".$from_loan_amount."' and '".$to_loan_amount."' ";
    $qry_count .= " and app.applied_amount_on between '".$from_loan_amount."' and '".$to_loan_amount."' ";
}else{
    $fetch_disb_cases .= " and cse.required_loan_amt between '".$from_loan_amount."' and '".$to_loan_amount."' ";
    $qry_count .= " and cse.required_loan_amt between '".$from_loan_amount."' and '".$to_loan_amount."' ";
}}
if($u_assign != '' && $u_assign != 0){
     $date_filter = 1;
     $fetch_disb_cases .= " and cse.user_id = '".$u_assign."'";
     $qry_count .= " and cse.user_id = '".$u_assign."' ";
}

if($loan_nature != "" && $loan_nature != 0) {
    $fetch_disb_cases .= " and cse.loan_nature = '".$loan_nature."'";
    $qry_count .= " and cse.loan_nature = '".$loan_nature."'";
}

if($pre_status != '' && $pre_status != 0){
     $date_filter = 1;
$fetch_disb_cases .= " and app.pre_login_status = '".$pre_status."'";
$qry_count .= " and app.pre_login_status = '".$pre_status."' ";
}
if($app_statussearch != '' && $app_statussearch != 0){
	$date_filter = 1;
$fetch_disb_cases .= " and app.app_status_on = '".$app_statussearch."'";
$qry_count .= " and app.app_status_on = '".$app_statussearch."' ";
}

if($app_new_status != "") {
    $default = 1;
    if($sub_sub_status != "" && $sub_sub_status > 0) {
        if(in_array($app_new_status, array(1013, 1014))) {
            $fetch_disb_cases .= " AND app.pre_login_status = $app_new_status AND find_in_set('".$sub_sub_status."', app.other_status) ";
            $qry_count .= " AND app.pre_login_status = $app_new_status AND find_in_set('".$sub_sub_status."', app.other_status) ";
        } else {
            $fetch_disb_cases .= " and app.sub_sub_status = $sub_sub_status ";
            $qry_count .= " and app.sub_sub_status = $sub_sub_status ";
        }
    } else if($sub_status != "" && $sub_status > 0) {
        $get_statuses = mysqli_query($Conn1, "SELECT GROUP_CONCAT(status_id) AS status_arr FROM status_master WHERE parent_id = $sub_status and level_id = 3 AND is_active_for_filter = 1 ");
        $get_status_result = mysqli_fetch_array($get_statuses)['status_arr'];
        if($get_status_result != "") {
            $status_arr = $get_status_result;
            if(in_array($app_new_status, array(1013, 1014))) {
                $new_status_arr = str_replace(",", "|", $status_arr);
                $fetch_disb_cases .= " AND app.pre_login_status = $app_new_status AND CONCAT(',', app.other_status, ',') REGEXP ',(".$new_status_arr."),'";
                $qry_count .= " AND app.pre_login_status = $app_new_status AND CONCAT(',', app.other_status, ',') REGEXP ',(".$new_status_arr."),'";
            } else {
                $fetch_disb_cases .= " AND app.pre_login_status = $app_new_status AND app.app_status_on = $sub_status ";
                $qry_count .= " AND app.pre_login_status = $app_new_status AND app.app_status_on = $sub_status ";
            }
        } else {
            if(in_array($app_new_status, array(1013, 1014))) {
                $fetch_disb_cases .= " AND app.pre_login_status = $app_new_status AND find_in_set(".$sub_status.", app.other_status)";
                $qry_count .= " AND app.pre_login_status = $app_new_status AND find_in_set(".$sub_status.", app.other_status)";
            } else {
                $fetch_disb_cases .= " AND app.pre_login_status = $app_new_status AND app.app_status_on = $sub_status ";
                $qry_count .= " AND app.pre_login_status = $app_new_status AND app.app_status_on = $sub_status ";
            }
        }
    } else {
                $fetch_disb_cases .= " AND app.pre_login_status = $app_new_status ";
                $qry_count .= " AND app.pre_login_status = $app_new_status ";
    }
}

if($refarming_user_id != "") {
    $date_filter = 1;
    if($user == $refarming_user_id) {
        $fetch_disb_cases .= " AND app.app_created_by = '".$refarming_user_id."'";
        $qry_count .= " AND app.app_created_by = '".$refarming_user_id."'";
    } else {
        $fetch_disb_cases .= " AND app.refarming_user_id = '".$refarming_user_id."'";
        $qry_count .= " AND app.refarming_user_id = '".$refarming_user_id."'";
    }
}


if($search != '' && $search != 0 ){
	$date_filter = 1;
$fetch_disb_cases .= " and cse.loan_type = '".$search."' ";
$qry_count .= " and cse.loan_type = '".$search."' ";
}else{
$fetch_disb_cases .= " and cse.loan_type IN (".$tl_loan_type.") ";
$qry_count .= " and cse.loan_type IN (".$tl_loan_type.") ";
}
if($cust_name != ''){
     $date_filter = 1;
$fetch_disb_cases .= " and cust.name LIKE '%".$cust_name."%'";
$qry_count .= " and cust.name LIKE '%".$cust_name."%'";
}
if($disb_date_from != '' && $disb_date_from != '0000-00-00' && $disb_date_to != '' && $disb_date_to != '0000-00-00'){
   $date_filter = 1;
if($app_statussearch == 6 || $app_statussearch == 7 || in_array($app_new_status,array(1019)) || in_array($sub_status,array(1098,1099))){
    $fetch_disb_cases .= " and app.first_disb_date_on between '".$disb_date_from."' and '".$disb_date_to."' ";
    $qry_count .= " and app.first_disb_date_on between '".$disb_date_from."' and '".$disb_date_to."' ";
}else if($app_statussearch == 5 || in_array($app_new_status,array(1017)) || in_array($sub_status,array(1094,1095,1096,1097))){
    $fetch_disb_cases .= " and app.sanction_date_on between '".$disb_date_from."' and '".$disb_date_to."' ";
    $qry_count .= " and app.sanction_date_on between '".$disb_date_from."' and '".$disb_date_to."' ";
}else if($app_statussearch == 3 || in_array($app_new_status,array(1016))){
    $fetch_disb_cases .= " and app.login_date_on between '".$disb_date_from."' and '".$disb_date_to."' ";
    $qry_count .= " and app.login_date_on between '".$disb_date_from."' and '".$disb_date_to."' ";
}else if($pre_status == 7){
    $fetch_disb_cases .= " and app.follow_up_date_on between '".$disb_date_from."' and '".$disb_date_to."' ";
    $qry_count .= " and app.follow_up_date_on between '".$disb_date_from."' and '".$disb_date_to."' ";
}else{
    $fetch_disb_cases .= " and app.date_created between '".$disb_date_from."' and '".$disb_date_to."' ";
    $qry_count .= " and app.date_created between '".$disb_date_from."' and '".$disb_date_to."' ";
}
}else if($date_filter != 1){

if($app_statussearch == 6 || $app_statussearch == 7 || in_array($app_new_status,array(1019)) || in_array($sub_status,array(1098,1099))){
    $fetch_disb_cases .= " and app.first_disb_date_on between DATE_SUB(CURDATE(), INTERVAL 4 DAY) and CURDATE() ";
    $qry_count .= " and app.first_disb_date_on between DATE_SUB(CURDATE(), INTERVAL 4 DAY) and CURDATE() ";
}else if($app_statussearch == 5 || in_array($app_new_status,array(1017)) || in_array($sub_status,array(1094,1095,1096,1097))){
    $fetch_disb_cases .= " and app.sanction_date_on between DATE_SUB(CURDATE(), INTERVAL 4 DAY) and CURDATE() ";
    $qry_count .= " and app.sanction_date_on between DATE_SUB(CURDATE(), INTERVAL 4 DAY) and CURDATE() ";
}else if($app_statussearch == 3 || in_array($app_new_status,array(1016))){
    $fetch_disb_cases .= " and app.login_date_on between DATE_SUB(CURDATE(), INTERVAL 4 DAY) and CURDATE() ";
    $qry_count .= " and app.login_date_on between DATE_SUB(CURDATE(), INTERVAL 4 DAY) and CURDATE() ";
}else if($pre_status == 7){
    $fetch_disb_cases .= " and app.follow_up_date_on between DATE_SUB(CURDATE(), INTERVAL 4 DAY) and CURDATE() ";
    $qry_count .= " and app.follow_up_date_on between DATE_SUB(CURDATE(), INTERVAL 4 DAY) and CURDATE() ";
}else{
    $fetch_disb_cases .= " and app.date_created between DATE_SUB(CURDATE(), INTERVAL 4 DAY) and CURDATE() ";
    $qry_count .= " and app.date_created between DATE_SUB(CURDATE(), INTERVAL 4 DAY) and CURDATE() ";
}
}
$fetch_disb_cases .= " order by app.date_created desc";
$res_cnt = mysqli_query($Conn1,$qry_count) or die(mysqli_error($Conn1));
$total_count = mysqli_fetch_row($res_cnt);
$recordcount = $total_count[0];
$no_page = max(1, ceil($recordcount / $offset));
$pager = Pager::getPagerData($no_page, $display_range, $page, $offset); 
$qryyy = $fetch_disb_cases." limit $pager->offset, $offset";
/*if($user == 273) {
    echo $qryyy;
}*/
$res = mysqli_query($Conn1,$qryyy) or die("Error: ".mysqli_error($Conn1));

?>
<fieldset><legend>Case Filter</legend>
<form method="post" action="disbursed-cases.php" name="searchfrm" id='searchfrm' class = 'disb_form' autocomplete="off">
    <input type="hidden" name="loan_type_app" id="loan_type_app" value="<?php echo $loan_type_app;?>" />
    <input type="hidden" name="bank_display" id="bank_display" value="<?php echo $rm_pat_id_assign;?>" />
<tr>
  <td><input type="text" class="text-input" name="case_no" id="case_no" placeholder="Case No." value="<?php echo $case_no;?>" size="8"/></td>
<td><input type="text" class="text-input" name="cust_name" id="cust_name" placeholder="Customer Name" value="<?php echo $cust_name;?>" size="8"/></td>
<td><input type="tel" class="text-input" name="phone_no" id="phone_no" placeholder="Phone" maxlength="10" value="<?php echo $phone_no;?>" size="8"/></td>
   <td><input type="text" class="text-input" name="app_no" id="app_no" placeholder="Application No" value="<?php echo $app_no;?>" size="8"/></td>
    <td><input type="text" class="text-input" name="disb_date_from" id="disb_date_from" placeholder="Date From" value="<?php echo $disb_date_from;?>"/></td>
    <td><input type="text" class="text-input" name="disb_date_to" id="disb_date_to" placeholder="Date To" value="<?php echo $disb_date_to;?>"/></td>
    <td><?php echo get_dropdown('city','city_type',$city_type,''); ?></td>
<td><input type="text" class="text-input" name="from_loan_amount" id="from_loan_amount" placeholder="From Loan Amount" value="<?php echo $from_loan_amount;?>" size="8"/></td>
<td><input type="text" class="text-input" name="to_loan_amount" id="to_loan_amount" placeholder="To Loan Amount" value="<?php echo $to_loan_amount;?>" size="8"/></td>
<td><?php echo get_dropdown('loan_type','loan_type',$search,''); ?></td>
<td><select name="banksearch" id="banksearch">
                    <option value="">Select Bank</option>
                <?php $bnk_cnt=0;foreach($bank_rm_id as $bnk){ ?>
                    <option value="<?php echo $bnk;?>"<?php if( $bnk == $banksearch){?>selected="selected"<?php }?>><?php echo  $bank_rm_name[$bnk_cnt];?></option>
                    <?php $bnk_cnt++; }?>
                  </select></td>
                  <td><?php echo get_dropdown('user_assign','u_assign',$u_assign,''); ?></td>
                <?php //if(in_array($user, $user_new_status) || in_array($loan_type,$loan_type_new_status) || new_staus_user_level == 1 || new_staus_loan_type_level == 1) { ?>
                <?php //if($user == 121) { ?>
                    <td><?php echo get_dropdown('pre_login','pre_status',$pre_status,''); ?></td>
                    <td><?php echo get_dropdown('post_login','app_statussearch',$app_statussearch,''); ?></td>
                    <?php
                    echo get_dropdown('app_new_status', 'app_new_status', $app_new_status, 'onchange="new_qs_change(this, 1);"');
                    if($app_new_status != "") {
                        $get_status_query   = mysqli_query($Conn1, "SELECT status_id, description FROM status_master WHERE level_id = 3 AND parent_id = $app_new_status AND is_active_for_filter = 1 ");
                        if(mysqli_num_rows($get_status_query) > 0) {
                            ?>
                            <select name='sub_status' id='sub_status' onchange="new_qs_change(this, 2);">
                                <option value="">Select Sub Status</option>
                            <?php
                            while($get_status_res = mysqli_fetch_array($get_status_query)) {
                                $selected = ($get_status_res['status_id'] == $sub_status) ? "selected" : "";
                            ?>
                                <option value="<?php echo $get_status_res['status_id']; ?>" <?php echo $selected; ?> ><?php echo $get_status_res['description']; ?></option>    
                            <?php
                            }
                            ?>
                            </select>
                            <?php
                        }

                        if($sub_status != "") {
                            $get_status_query   = mysqli_query($Conn1, "SELECT status_id, description FROM status_master WHERE level_id = 3 AND parent_id = $sub_status AND is_active_for_filter = 1 ");
                            if(mysqli_num_rows($get_status_query) > 0) {
                                ?>
                                <select name='sub_sub_status' id='sub_sub_status'>
                                    <option value="">Select Sub Sub Status</option>
                                <?php
                                while($get_status_res = mysqli_fetch_array($get_status_query)) {
                                    $selected = ($get_status_res['status_id'] == $sub_sub_status) ? "selected" : "";
                                ?>
                                    <option value="<?php echo $get_status_res['status_id']; ?>" <?php echo $selected; ?> ><?php echo $get_status_res['description']; ?></option>    
                                <?php
                                }
                                ?>
                                </select>
                                <?php
                            }
                        } 
                    }
                    ?>

                <?php //} else { ?>
                    <!-- <td><?php //echo get_dropdown('pre_login','pre_status',$pre_status,''); ?></td> -->
                    <!-- <td><?php //echo get_dropdown('post_login','app_statussearch',$app_statussearch,''); ?></td> -->
                <?php //} ?>
                  <td><?php echo get_dropdown('loan_nature', 'loan_nature', $loan_nature, ''); ?></td>  
                  <td><select name="fos_filter" id="fos_filter" class="fos_filter">
            <option value="">--Select Is Fos--</option>
            <option value="1" <?php if($fos_filter == 1) { ?> selected <?php } ?> >Yes</option>
            <option value="2" <?php if($fos_filter == 2) { ?> selected <?php } ?> >No</option>
        </select></td>
        <td><input type="text" class="text-input" name="fos_follow_date" id="fos_follow_date" placeholder="FOS Follow Date" maxlength="10" value="<?php echo $fos_follow_date; ?>" size="8"/></td>

        <td><?php echo get_dropdown('refarming_user', 'refarming_user_id', $refarming_user_id, ''); ?></td>
<td>                  
<input type="submit" name="searchsubmit" value="Filter"></td>                                                 
<td> <input type="submit" onclick="resetform()" value="Clear"></td>
<td></td></tr>                                    
</form>
<form action="disbursed-download.php" method='POST'><input type="hidden" name="qry" value="<?php echo $fetch_disb_cases; ?>"> <input type="submit" value="Download"></form>
</fieldset>
<table width="100%" class="gridtable">
<tr>
<th width="10%">Case No.<br>& App No</th>
<th width="10%">Name<br> & city</th>
<th width="10%">Loan Type</th>
<th width="10%">Bank Name</th>
<th width="10%">Pre Login Status<br>Post Login Status</th>
<th width="10%">Assigned</th>
<th width="10%">Description</th>
<th width="10%">Action</th>
</tr>
<?php
while($exe = mysqli_fetch_array($res)){
$case_id = $exe[1];
$app_id  = $exe[0];
$app_bank_on  = $exe[2];
$app_status_on  = $exe[3];
$user_id = $exe[11];
$loan_type = $exe[6];
$app_st_date = $exe[5];
$disbursed_amount_on = $exe[4];
$name = $exe[7];
$email = $exe[8];
$phone = $exe[9];
$city_id = $exe[10];
$bank_app_no_on  = $exe[12];
$app_description = $exe[13];
$fup_desc = $exe[14];
$follow_up_date_on  = $exe[15];
$follow_up_type_on = $exe[16];
$cust_id  = $exe[17];
$loan_type = $exe[18];
$pre_login_id = $exe[19];
$loan_nature_get = $exe['loan_nature'];
$disb_email_flag  = $exe['disb_email_flag'];
$bank_crm_lead_on  = $exe['bank_crm_lead_on'];
$auto_case_create = $exe['auto_case_create'];
$sub_sub_status = $exe['sub_sub_status'];
$loan_nature_name = "New Loan";
if($loan_nature_get == 2){
  $loan_nature_name = "Balance Transfer";
}else if($loan_nature_get == 3){
  $loan_nature_name = "Top Up";
}
$qryloan = "select * from lms_loan_type where loan_type_id = '".$loan_type."'";
$resloan = mysqli_query($Conn1,$qryloan);
$exeloan = mysqli_fetch_array($resloan);
$loan_name = $exeloan['loan_type_name'];
$qryassign = "select * from tbl_user_assign where user_id = '".$user_id."'";
$resassign = mysqli_query($Conn1,$qryassign);
$exeassign = mysqli_fetch_array($resassign);
$assign = $exeassign['user_name'];

$q_bank_on = "select * from tbl_bank where bank_id = '".$app_bank_on."'";
$r_bank_on = mysqli_query($Conn1,$q_bank_on);
$e_bank_on = mysqli_fetch_array($r_bank_on);
$name_bank_on = $e_bank_on['bank_name'];

$name_app_statuson = get_display_name('post_login',$app_status_on);
if($name_app_statuson == ''){
  $name_app_statuson = get_display_name('snew_status_name',$app_status_on);  
}
$name_pre_statuson = get_display_name('pre_login',$pre_login_id);
if($name_pre_statuson == ''){
  $name_pre_statuson = get_display_name('snew_status_name',$pre_login_id);  
}
$sub_status_name = '';
if($sub_sub_status > 0){
  $sub_status_name = get_display_name('snew_status_name',$sub_sub_status);  
}

$final_pre_status_name = (trim($name_pre_statuson) == '') ?'' : $name_pre_statuson;
$final_app_status_name = (trim($name_app_statuson) == '') ?'' : "/ ".$name_app_statuson;
$final_sub_status_name = (trim($sub_status_name) == '') ?'' : "/ ".$sub_status_name;

/*$q_app_statuson = "select app_status from tbl_app_status where app_status_id = '".$app_status_on."'";
$r_app_statuson = mysqli_query($Conn1,$q_app_statuson);
$e_app_statuson = mysqli_fetch_array($r_app_statuson);
$name_app_statuson = $e_app_statuson['app_status'];

$q_papp_statuson = "select pre_status_name from tbl_app_pre_login where pre_status_id = '".$pre_login_id."'";
$r_papp_statuson = mysqli_query($Conn1,$q_papp_statuson);
$e_papp_statuson = mysqli_fetch_array($r_papp_statuson);
$name_papp_statuson = $e_papp_statuson['pre_status_name'];*/


$qry_city = "select * from lms_city where city_id = '".$city_id."'";
$res_city = mysqli_query($Conn1,$qry_city);
$exe_city = mysqli_fetch_array($res_city);
$city_name = $exe_city['city_name'];

$cashback_arr = array();$cashback_app = $cashback_msg= '';
if($app_status_on == 6 || $app_status_on == 7){
	$cashback_qry = mysqli_query($Conn1,"select sent_flag,form_type from tbl_cash_bonanza where app_id = '".$app_id."'");
		while($result_cashback_qry = mysqli_fetch_array($cashback_qry)){
			$cashback_sent = $result_cashback_qry['sent_flag'];
			if($result_cashback_qry['form_type'] == 1){
				$cashback_msg = "Refferal Sent";
			}else {
				 $cashback_msg = "Cashback Sent";
			} 
				$cashback_arr[] = $cashback_msg;
		}
		if(!empty($cashback_arr)){
			$cashback_app = "<span class='green'>".implode("<br>",$cashback_arr)."</span>";
		}
}
$get_parnter_id_qry = mysqli_query($Conn1,"select pat_id from tbl_pat_loan_type_mapping where loan_type ='".$loan_type."' and bank_id = '".$app_bank_on."'");
$result_map_qry = mysqli_fetch_array($get_parnter_id_qry);

if($bank_crm_lead_on != ''){
		$get_status = mysqli_query($Conn1,"select description,status from partner_lead_status where app_id = '".$app_id."' order by status_id desc limit 1");
		$count_status = mysqli_num_rows($get_status);
	}
$get_response_qry = mysqli_query($Conn1,"select CONCAT_WS(' ',response,res_desc) as response, response as resp, res_desc as res_desc from tbl_pat_retrn_respnse where case_id = ".$case_id." and partner_id = '".$result_map_qry['pat_id']."' order by resp_id desc");
$result_response_qry = mysqli_fetch_array($get_response_qry);


if($result_map_qry['pat_id'] == '24'){
	 $new_val = $result_response_qry['resp'];
$final_response = $kotak_resp_array[$new_val].' '.$result_response_qry['res_desc'];
} else {
	$final_response = $result_response_qry['response'];
}

$qry_feedback_count = mysqli_query($Conn1,"select count(*) as count from tbl_application_feed_back where app_id = '".$app_id."'");
$res_feedback_count = mysqli_fetch_array($qry_feedback_count);

?>

<tr>
<td><a href = "../cases/edit.php?case_id=<?php echo urlencode(base64_encode($case_id)).'&ut=2' ;?>"><?php echo $case_id;?></a><br/><a href = "edit_applicaton.php?case_id=<?php echo urlencode(base64_encode($case_id)) ;?>&cust_id=<?php echo urlencode(base64_encode($cust_id));?>&loan_type=<?php echo $loan_type;?>&ut=2"><span style="color:orange;"><?php echo $app_id;?></span></a></td>
<td><?php echo $name;?><br/><span style="color:orange;"><?php echo $city_name;?></span></td>
<td><?php echo $loan_name;?></td>
<td><?php echo $name_bank_on; if($count_status > 0){$result_status = mysqli_fetch_array($get_status); echo " <span class='green'>(".$result_status['status']." ".$result_status['description'].")</span>"; }?> <br>
<?php if($auto_case_create == 1){ echo "<span style='color:#0039FF'> Auto</span>" ; }?></td>
<td><?php echo $final_pre_status_name.$final_app_status_name.$final_sub_status_name; if($result_response_qry['response'] != '' && !(is_numeric($result_response_qry['response']))){ echo "<br><span class='green'>".$final_response."</span>";} ?></td>
<td><?php echo $assign;?></td>
<td><?php echo $app_description; ?></td>
<td><a href="feedback.php?app_id=<?php echo base64_encode($app_id);?>" style="margin-left:20px;" target='_blank'>Feedback </a>
<?php if((($app_bank_on == 29 && $loan_type == 56) || ($app_bank_on == 40 && $loan_type == 71) || ($app_bank_on == 81 && $loan_type == 56) || $app_bank_on == 18)  && ($bank_crm_lead_on != '' || $bank_app_no_on != '')){?><br>
<a href="../lead/auto_insert/check-api-status.php?app_id=<?php echo base64_encode($app_id);?>&prospectno=<?php echo base64_encode($bank_crm_lead_on); ?>&case_id=<?php echo base64_encode($case_id);?>&bank_app_no=<?php echo base64_encode($bank_app_no_on);?>&bnk=<?php echo base64_encode($app_bank_on); ?>&loan_type=<?php echo base64_encode($loan_type); ?>" style="margin-left:20px;">Check Status</a><br><?php } ?>
 <?php if($res_feedback_count['count'] > 0){ ?><span class="green"><b> (&#10003;)</b></span><?php }if($disb_email_flag == 1){
	echo "<br><span class='orange'>Disbursement Mail Sent</span><br>";
}echo "<br>".$cashback_app;?></td>
</tr>
<?php
} ?>
<div style="clear:both;padding:1%;"></div>
<?php if ($recordcount > $offset) { ?>
<table width="90%;margin-left:4%" border="0" align="center" cellpadding="4" cellspacing="1" class="pagingtable">
            <tr class="sidemain">
                <td>
                    <?php
                    echo "<a class='page gradient' href='disbursed-cases.php?page=1'&u_assign=$u_assign&phone_no=$phone_no&app_no=$app_no&loan_type=$search&from_loan_amount=$from_loan_amount&to_loan_amount=$to_loan_amount
&disb_date_from=$disb_date_from&disb_date_to=$disb_date_to&banksearch=$banksearch&city_type=$city_type&pre_status=$pre_status&app_statussearch=$app_statussearch&cust_name=$cust_name&case_no=$case_no&fos_follow_date=$fos_follow_date&fos_filter=$fos_filter&app_new_status=$app_new_status&sub_status=$sub_status&sub_sub_status=$sub_sub_status&refarming_user_id=$refarming_user_id'>First</a>";
                    if ($page == 1) // this is the first page - there is no previous page  
                        echo "";
                    else            // not the first page, link to the previous page  
                        echo "<a class='page gradient' href='disbursed-cases.php?page=" . ($page - 1) . "'&u_assign=$u_assign&phone_no=$phone_no&app_no=$app_no&loan_type=$search&from_loan_amount=$from_loan_amount&to_loan_amount=$to_loan_amount
&disb_date_from=$disb_date_from&disb_date_to=$disb_date_to&banksearch=$banksearch&city_type=$city_type&pre_status=$pre_status&app_statussearch=$app_statussearch&cust_name=$cust_name&case_no=$case_no&fos_follow_date=$fos_follow_date&fos_filter=$fos_filter&app_new_status=$app_new_status&sub_status=$sub_status&sub_sub_status=$sub_sub_status&refarming_user_id=$refarming_user_id'><<</a>";
                    for ($i = $pager->lrange; $i <= $pager->rrange; $i++) {
                        if ($page != 1)
                            echo "";
                        if ($i == $pager->page)
                            echo "<span class='bodytext page gradient'>$i</span>";
                        else
                            echo "<span class='bodytext'><a class='page gradient' href='disbursed-cases.php?page=$i&u_assign=$u_assign&app_no=$app_no&loan_type=$search&phone_no=$phone_no&from_loan_amount=$from_loan_amount&to_loan_amount=$to_loan_amount
&disb_date_from=$disb_date_from&disb_date_to=$disb_date_to&banksearch=$banksearch&city_type=$city_type&pre_status=$pre_status&app_statussearch=$app_statussearch&cust_name=$cust_name&case_no=$case_no&fos_follow_date=$fos_follow_date&fos_filter=$fos_filter&app_new_status=$app_new_status&sub_status=$sub_status&sub_sub_status=$sub_sub_status&refarming_user_id=$refarming_user_id'>$i</a></span>";
                    }
                    if ($page == $pager->np) // this is the last page - there is no next page  
                        echo "";
                    else            // not the last page, link to the next page  
                        echo "<a class='page gradient' href='disbursed-cases.php?page=" . ($page + 1) . "&u_assign=$u_assign&phone_no=$phone_no&app_no=$app_no&loan_type=$search&from_loan_amount=$from_loan_amount&to_loan_amount=$to_loan_amount
&disb_date_from=$disb_date_from&disb_date_to=$disb_date_to&banksearch=$banksearch&city_type=$city_type&pre_status=$pre_status&app_statussearch=$app_statussearch&cust_name=$cust_name&case_no=$case_no&fos_follow_date=$fos_follow_date&fos_filter=$fos_filter&app_new_status=$app_new_status&sub_status=$sub_status&sub_sub_status=$sub_sub_status&refarming_user_id=$refarming_user_id'> >></a>";
                    echo "<a class='page gradient' href='disbursed-cases.php?page=" .$no_page. "&u_assign=$u_assign&phone_no=$phone_no&app_no=$app_no&loan_type=$search&from_loan_amount=$from_loan_amount&to_loan_amount=$to_loan_amount
&disb_date_from=$disb_date_from&disb_date_to=$disb_date_to&banksearch=$banksearch&city_type=$city_type&pre_status=$pre_status&app_statussearch=$app_statussearch&cust_name=$cust_name&case_no=$case_no&fos_follow_date=$fos_follow_date&fos_filter=$fos_filter&app_new_status=$app_new_status&sub_status=$sub_status&sub_sub_status=$sub_sub_status&refarming_user_id=$refarming_user_id'>Last</a>";
                    ?></td>
            </tr>
        </table>
      <?php } ?>	            
   </div>
</html>
</body> 

<?php include("../../include/footer_close.php");  ?>