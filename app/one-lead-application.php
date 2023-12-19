<?php
$slave = 1;
require_once "../../include/crm-header.php";
require_once "../../include/dropdown.php";
require_once "../../include/display-name-functions.php";
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../../include/css/jquery-ui.css" />
 <script type="text/javascript" src="../../include/js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="../../include/js/jquery-ui.js"></script>
 <script>
$(function() {
jQuery('#date_from').datepicker({
changeMonth: true,
      changeYear: true,
      dateFormat: 'yy-mm-dd',
	    beforeShow : function(){
            jQuery( this ).datepicker('option','maxDate', jQuery('#date_to').val() );
        }
    });
    jQuery('#date_to').datepicker({
changeMonth: true,
      changeYear: true,
      dateFormat: 'yy-mm-dd',
        beforeShow : function(){
            jQuery( this ).datepicker('option','minDate',    jQuery('#date_from').val() );
        }
    });

  $("#assign_to").hide();
 $("#query_search").hide();
    $('#assign').click(function(){
           $('#assign_to').show();
           $("#query_search").hide();
});
$("#city_type").autocomplete({
		source: "../../include/city_name.php",
		minLength: 2
	});
    $("#bankers_name").autocomplete({
		source: "../../include/bankers_name.php",
		minLength: 2
	});
  $('#query').click(function(){
            $('#query_search').show();
            $("#assign_to").hide();

});
  });

function resetform() {
window.location.href = "one-lead-application.php";
}
function opn_subsource(){
var camp_val = $("#source_compign").val();
if(camp_val != '' ){
    var sub_src = '<?php echo $sub_source;?>';
    var ins = '<?php echo $insurance;?>';
    var promo = '<?php echo $promo;?>';
    var ref_phone = '<?php echo $ref_phone;?>';
    $.ajax({
    	data: "camp="+camp_val+"&sub_src="+sub_src+"&ins="+ins+"&promo="+promo+"&ref_phone="+ref_phone,
    	type:"POST",
    	url:"<?php echo $head_url;?>/include/sub_source.php",
    	success: function(data){
    		$("#sub").html(data);
    	}
    })
}
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
if($_SESSION['tl_loan_type'] != ''){
    $user_loan_type_array = explode(',',$_SESSION['tl_loan_type']);
}
if(isset($_REQUEST['case_no'])){
$case_no = replace_special($_REQUEST['case_no']);}
if(isset($_REQUEST['app_no'])){
$app_no = replace_special($_REQUEST['app_no']);}
if(isset($_REQUEST['app_statussearch'])){
$app_statussearch = replace_special($_REQUEST['app_statussearch']);}
if(isset($_REQUEST['loan_type'])){
$search = replace_special($_REQUEST['loan_type']);}
if(isset($_REQUEST['name_search'])){
$name_search = replace_special($_REQUEST['name_search']);}
if(isset($_REQUEST['phone'])){
$phone = replace_special($_REQUEST['phone']); }
if(isset($_REQUEST['banksearch'])){
$banksearch = replace_special($_REQUEST['banksearch']);}

if(isset($_REQUEST['bankers_name'])) {
    $bankers_name = replace_special($_REQUEST['bankers_name']);
}

if(isset($_REQUEST['pre_status'])){
$pre_statussearch = replace_special($_REQUEST['pre_status']);}

if(isset($_REQUEST['app_new_status'])) {
    $app_new_status = replace_special($_REQUEST['app_new_status']);
}
if(isset($_REQUEST['sub_status'])) {
    $sub_status = replace_special($_REQUEST['sub_status']);
}
if(isset($_REQUEST['sub_sub_status'])) {
    $sub_sub_status = replace_special($_REQUEST['sub_sub_status']);
}

if(isset($_REQUEST['crm_id_num'])){
	$crm_id_num = replace_special($_REQUEST['crm_id_num']);
}
if($_REQUEST['pre_status'] != ''){
    $pre_status = replace_special($_REQUEST['pre_status']);
}
if($_REQUEST['date_from'] != '' && $_REQUEST['date_from'] != '0000-00-00'){
    $date_from = replace_special($_REQUEST['date_from']);
}
if($_REQUEST['date_to'] != '' && $_REQUEST['date_to'] != '0000-00-00'){
    $date_to = replace_special($_REQUEST['date_to']);
}
$qry_ex = "select app.pre_login_status,app.sub_sub_status,fb.id as fb_id,app.bank_crm_lead_on as bank_crm_lead_on,city.city_name as city_name,cust.phone as phone,cust.name as name,c.auto_case_create as auto_case_create,app.case_id as case_id,app.app_id as app_id,bank.bank_name as bank_name,app.app_status_on as app_status_on,c.cust_id as cust_id,user.user_name as user_name,loan.loan_type_name as loan_type_name,c.loan_type as loan_type,c.required_loan_amt as required_loan_amt,partner.partner_name as partner_name,app.bank_app_no_on as bank_app_no_on,app.disb_email_flag as disb_email_flag,app.app_bank_on as app_bank_on,app.login_date_on as login_date_on,app.sanction_date_on as sanction_date_on,app.first_disb_date_on as first_disb_date_on from tbl_mint_app as app JOIN tbl_mint_case as c ON app.case_id = c.case_id JOIN tbl_mint_customer_info as cust ON c.cust_id = cust.id left join tbl_mlc_partner as partner on app.partner_on = partner.partner_id left join lms_loan_type as loan on c.loan_type = loan.loan_type_id left join tbl_user_assign as user on c.user_id = user.user_id left join tbl_bank as bank on app.app_bank_on = bank.bank_id left join lms_city as city on cust.city_id = city.city_id left join tbl_application_feed_back as fb on app.app_id = fb.app_id ";

if(trim($bankers_name) != "") {
    $qry_ex .= " INNER JOIN banker_email_history on banker_email_history.case_id = c.case_id INNER JOIN banker_sms_history on banker_sms_history.case_id = c.case_id ";
}
$qry_ex .= " where 1 ";

if(($user_role == 2 || $user_role == 4) && $search == ''){
$qry_ex .= " and c.loan_type IN ($tl_loan_type)";
}else if($user_role == 3){
$qry_ex .= " and c.user_id = '".$user."'";
}if($tl_member !='' && $user_role == 2){
    $qry_ex .= " and c.user_id IN ($tl_member)";
}
if($u_assign != "" && $user_role != 3){
    $default = 1;
    $qry_ex .= " and c.user_id = '".$u_assign."'";
}
if($case_no != ""){
    $default = 1;
    $qry_ex .= " and app.case_id = '".$case_no."'";
}
if($app_no != ""){$default = 1;
    $qry_ex .= " and app.app_id = '".$app_no."'";
}
if($app_statussearch != ""){$default = 1;
    $qry_ex .= " and app.app_status_on = '".$app_statussearch."'";
}

if($app_new_status != "") {
    $default = 1;
    if($sub_sub_status != "" && $sub_sub_status > 0) {
        if(in_array($app_new_status, array(1013, 1014))) {
            $qry_ex .= " AND app.pre_login_status = $app_new_status AND find_in_set('".$sub_sub_status."', app.other_status) ";
        } else {
            $qry_ex .= " and app.sub_sub_status = $sub_sub_status ";
        }
    } else if($sub_status != "" && $sub_status > 0) {
        $get_statuses = mysqli_query($Conn1, "SELECT GROUP_CONCAT(status_id) AS status_arr FROM status_master WHERE parent_id = $sub_status and level_id = 3 AND is_active_for_filter = 1 ");
        $get_status_result = mysqli_fetch_array($get_statuses)['status_arr'];
        if($get_status_result != "") {
            $status_arr = $get_status_result;
            if(in_array($app_new_status, array(1013, 1014))) {
                $new_status_arr = str_replace(",", "|", $status_arr);
                $qry_ex .= " AND app.pre_login_status = $app_new_status AND CONCAT(',', app.other_status, ',') REGEXP ',(".$new_status_arr."),'";
            } else {
                $qry_ex .= " AND app.sub_sub_status IN ($status_arr) ";
            }
        } else {
            if(in_array($app_new_status, array(1013, 1014))) {
                $qry_ex .= " AND app.pre_login_status = $app_new_status AND find_in_set(".$sub_status.", app.other_status)";
            } else {
                $qry_ex .= " AND app.app_status_on = $sub_status ";
            }
        }
    } else {
            $qry_ex .= " AND app.pre_login_status = $app_new_status ";      
    }
}

if($search != ""){$default = 1;
    $qry_ex .= " and c.loan_type = '".$search."'";
}if($from_loan_amount != "" && $to_loan_amount != ""){
    $default = 1;
    if($app_statussearch == 6 || $app_statussearch == 7 || in_array($app_new_status,array(1019)) || in_array($sub_status,array(1098,1099))){
        $qry_ex .= " and app.disbursed_amount_on between '".$from_loan_amount."' and '".$to_loan_amount."'";
    }else if($app_statussearch == 5 || in_array($app_new_status,array(1017)) || in_array($sub_status,array(1094,1095,1096,1097))){
        $qry_ex .= " and app.sanctioned_amount_on between '".$from_loan_amount."' and '".$to_loan_amount."'";
    }else if($app_statussearch == 3  || in_array($app_new_status,array(1016))){
        $qry_ex .= " and app.applied_amount_on between '".$from_loan_amount."' and '".$to_loan_amount."'";
    }else{
        $qry_ex .= " and c.required_loan_amt between '".$from_loan_amount."' and '".$to_loan_amount."'";
    }
}
if($name_search != ""){
    $default = 1;
    $qry_ex .= " and cust.name = '".$name_search."'";
}if($phone != ""){
    $default = 1;
    $qry_ex .= " and cust.phone = '".$phone."'";
}
if($banksearch != ""){$default = 1;
    $qry_ex .= " and app.app_bank_on = '".$banksearch."'";
}else if($user_role == 6 && $banksearch == ""){
	$qry_ex .= " and app.app_bank_on IN (".implode(',',array_filter($bank_rm_id)).")";
}if($search_city_id != "" && $search_city_id != 0){$default = 1;
    $qry_ex .= " and cust.city_id = '".$search_city_id."'";
}
if($crm_id_num != '' && $crm_id_num !='0'){ $default = 1;
	$qry_ex .= " and app.bank_crm_lead_on = '".$crm_id_num."'";
}
if($pre_status != '' && $pre_status != 0){ $default  = 1;
    $qry_ex .= " and app.pre_login_status = '".$pre_status."'";
}
if($app_statussearch == '' && $pre_status == '' && $app_new_status == '' && $sub_status == '' && $sub_sub_status == ''){
    $qry_ex .= " and ( app.app_status_on IN (3,5,6,7,1098,1099) or app.pre_login_status IN (2,1019,1017,1016,1092,1094,1096,1095,1097)) ";
}

if(trim($bankers_name) != "") {
    $qry_ex .= " and ( banker_email_history.banker_name = '".$bankers_name."' OR banker_sms_history.banker_name = '".$bankers_name."' ) ";
}

if($date_from != '' && $date_from != '0000-00-00' && $date_to != '' && $date_to != '0000-00-00'){
if($app_statussearch == 6 || $app_statussearch == 7 || in_array($app_new_status,array(1019)) || in_array($sub_status,array(1098,1099)) ){
        $qry_ex .= " and date(app.first_disb_date_on) between '".$date_from."' and '".$date_to."'";
    }else if($app_statussearch == 5 || in_array($app_new_status,array(1017)) || in_array($sub_status,array(1094,1095,1096,1097))){
     $qry_ex .= " and date(app.sanction_date_on) between '".$date_from."' and '".$date_to."'";
    }else if($app_statussearch == 3 || in_array($app_new_status,array(1016))){
        $qry_ex .= " and date(app.login_date_on) between '".$date_from."' and '".$date_to."'";
    }else{
            $qry_ex .= " and date(app.la_st_up_date) between '".$date_from."' and '".$date_to."'";
}}


    if($app_statussearch == 6 || $app_statussearch == 7  || in_array($app_new_status,array(1019)) || in_array($sub_status,array(1098,1099))){
        if(in_array(51,$user_loan_type_array) || in_array(54,$user_loan_type_array)){
         $qry_ex .= " and date(app.first_disb_date_on) between DATE_SUB(CURDATE(), INTERVAL 3 MONTH) and CURDATE()";
        }else{
            $qry_ex .= " and date(app.first_disb_date_on) between DATE_SUB(CURDATE(), INTERVAL 3 MONTH) and CURDATE()";
        }
    }else if($app_statussearch == 5 || in_array($app_new_status,array(1017)) || in_array($sub_status,array(1094,1095,1096,1097))){
        if(in_array(51,$user_loan_type_array) || in_array(54,$user_loan_type_array)){
         $qry_ex .= " and date(app.sanction_date_on) between DATE_SUB(CURDATE(), INTERVAL 3 MONTH) and CURDATE()";
        }else{
            $qry_ex .= " and date(app.sanction_date_on) between DATE_SUB(CURDATE(), INTERVAL 3 MONTH) and CURDATE()";
        }
    }else if($app_statussearch == 3 || in_array($app_new_status,array(1016))){
        if(in_array(51,$user_loan_type_array) || in_array(54,$user_loan_type_array)){
         $qry_ex .= " and date(app.login_date_on) between DATE_SUB(CURDATE(), INTERVAL 3 MONTH) and CURDATE()";
        }else{
            $qry_ex .= " and date(app.login_date_on) between DATE_SUB(CURDATE(), INTERVAL 3 MONTH) and CURDATE()";
        }
    }else{
        if(in_array(51,$user_loan_type_array) || in_array(54,$user_loan_type_array)){
         $qry_ex .= " and date(app.la_st_up_date) between DATE_SUB(CURDATE(), INTERVAL 92 DAY) and CURDATE() ";
        }else{
            $qry_ex .= " and date(app.la_st_up_date) between DATE_SUB(CURDATE(), INTERVAL 92 DAY) and CURDATE() ";
        }

}
 $qry_ex .= "  order by app.date_created desc limit ".$offset.",".$max_offset;
?>
<fieldset><legend>Application Filter</legend>
<form method="post" action="one-lead-application.php" name="searchfrm" autocomplete="off">
<input type="text" class="text-input" name="app_no" id="app_no" placeholder="Application No" value="<?php echo $app_no;?>" maxlength="15"/>
<input type="text" class="text-input" name="case_no" id="case_no" placeholder="Case No" value="<?php echo $case_no;?>" maxlength="15"/>
<input type="text" class="text-input" name="name_search" id="name_search" placeholder="Name" value="<?php echo name_title_case($name_search);?>" maxlength="30"/>
<input type="text" class="text-input" name="date_from" id="date_from" placeholder="Date From" value="<?php echo $date_from;?>" maxlength="10"/>
<input type="text" class="text-input" name="date_to" id="date_to" placeholder="Date To" value="<?php echo $date_to;?>" maxlength="10"/>
<?php if($user_role != 2){ ?><input type="text" class="text-input" name="phone" id="phone" placeholder="Phone No" value="<?php echo $phone;?>" maxlength="10"/><?php } ?>
<input type="text" class="text-input" name="crm_id_num" id="crm_id_num" placeholder="Bank CRM ID" value="<?php echo $crm_id_num;?>"/>
<?php echo get_dropdown('loan_type','loan_type',$search,'');
if($user_role != 3) {  echo get_dropdown('user_assign','u_assign',$u_assign,''); }
echo get_dropdown('app_pat_list','patnersearch',$patnersearch,'');
if($user_role != 6){
	echo get_dropdown('bank_name_','banksearch',$banksearch,'');
}else{ ?>
	<td><select name="banksearch" id="banksearch">
                    <option value="">Select Bank</option>
                <?php $bnk_cnt=0;foreach($bank_rm_id as $bnk){ ?>
                    <option value="<?php echo $bnk;?>"<?php if( $bnk == $banksearch){?>selected="selected"<?php }?>><?php echo  $bank_rm_name[$bnk_cnt];?></option>
                    <?php $bnk_cnt++; }?>
                  </select></td>
<?php } ?>
<!-- <select name="pre_status" id="pre_status">
    <option value="">Select Pre Login</option>
    <option value="2" <?php if($pre_status == 2){echo "selected";} ?> data-target="Full Docs Collected">Full Docs Collected</option>
</select> -->
<?php 
// if(in_array($user, $user_new_status) || in_array($loan_type,$loan_type_new_status) || new_staus_user_level == 1 || new_staus_loan_type_level == 1) {
// if($user == 173) {
    echo get_dropdown('pre_login','pre_status',$pre_status,'');
    echo get_dropdown('post_login','app_statussearch',$app_statussearch,'');

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
<?php //} else { 
    // echo get_dropdown('pre_login','pre_status',$pre_status,'');
    // echo get_dropdown('post_login','app_statussearch',$app_statussearch,''); 
// }
?>
<?php echo get_textbox('bankers_name', $bankers_name, 'placeholder ="Bankers Name (Enter few words)"'); ?>
<input type="submit" name="searchsubmit" value="Filter">
<input type="button" onclick="resetform()" value="Clear">
</td></tr>
<br><span class='red f_12'><b>Note:- Search applications of last 15 days</b></span></table>
</form>
</fieldset>
<table width="100%" class="gridtable">
<tr>
<th width="10%">Case Number & Application No<br> Bank App No.</th>
<th width="10%">Name & City</th>
<th width="10%">Loan amount & Loan Type</th>
<th width="10%">Bank Name</th>
<th width="10%">Pre/ Post Login Status</th>

</tr>
<?php
// if($user == 173) {
//     echo $qry_ex;
// }
$res = mysqli_query($Conn1,$qry_ex) or die("Error: ".mysqli_error($Conn1));
$recordcount = mysqli_num_rows($res);
if($recordcount > 0){
	$record = 0;
while($exe = mysqli_fetch_array($res)){
	$record++;
	if($record > 10){
		continue;
	}
$case_id = $exe['case_id'];
$app_id  = $exe['app_id'];
$app_status_on  = $exe['app_status_on'];
$pre_login_status  = $exe['pre_login_status'];
$sub_sub_status  = $exe['sub_sub_status'];
$cust_id = $exe['cust_id'];
$loan_type = $exe['loan_type'];
$loan_amount = ($exe['required_loan_amt'] > 0) ? custom_money_format($exe['required_loan_amt']) : "";
$bank_app_no_on  = $exe['bank_app_no_on'];
$disb_email_flag  = $exe['disb_email_flag'];
$name_bank_on = $exe['bank_name'];
$loan_name = (trim($exe['loan_type_name']) != "") ? "(".$exe['loan_type_name'].")" : "";
$assign = $exe['user_name'];
$partner_name = $exe['partner_name'];
$name_app_statuson = $exe['app_status'];
$name_pre_statuson = $exe['pre_status_name'];
$auto_case_create = $exe['auto_case_create'];
$name = $exe['name'];
$phone_no = $exe['phone'];

$name_app_statuson = get_display_name('post_login',$app_status_on);
if($name_app_statuson == ''){
  $name_app_statuson = get_display_name('snew_status_name',$app_status_on);  
}
$name_pre_statuson = get_display_name('pre_login',$pre_login_status);
if($name_pre_statuson == ''){
  $name_pre_statuson = get_display_name('snew_status_name',$pre_login_status);  
}
$sub_status_name = '';
if($sub_sub_status > 0){
  $sub_status_name = get_display_name('snew_status_name',$sub_sub_status);  
}

$final_pre_status_name = (trim($name_pre_statuson) == '') ?'' : $name_pre_statuson;
$final_app_status_name = (trim($name_app_statuson) == '') ?'' : "/ ".$name_app_statuson;
$final_sub_status_name = (trim($sub_status_name) == '') ?'' : "/ ".$sub_status_name;

if($user_role == '3'){
    // $echo_number = substr_replace($phone_no,'XXX',4,3);
    $echo_number = "";
} else {
   $echo_number =  $phone_no;
}

$city_name = (trim($exe['city_name']) != "") ? "(".$exe['city_name'].")" : "";
$bank_crm_lead_on  = $exe['bank_crm_lead_on'];
$app_bank_on  = $exe['app_bank_on'];
$app_st_date = $cashback_msg = "";
if($app_status_on == 3){
	$app_st_date = (($exe['login_date_on']) == "0000-00-00" || $exe['login_date_on'] == "" || $exe['login_date_on'] == "1970-01-01") ? '--' : date("d-m-Y", strtotime($exe['login_date_on']));
}else if($app_status_on == 5){
    $app_st_date = ($exe['sanction_date_on'] == '0000-00-00' || $exe['sanction_date_on'] == "" || $exe['sanction_date_on'] == "1970-01-01") ? '--' : date("d-m-Y", strtotime($exe['sanction_date_on']));
}else if($app_status_on == 6 || $app_status_on == 7){
    $app_st_date = ($exe['first_disb_date_on'] == '0000-00-00' || $exe['first_disb_date_on'] == "" || $exe['first_disb_date_on'] == "1970-01-01") ? '--' : date("d-m-Y", strtotime($exe['first_disb_date_on']));
	$cashback_qry = mysqli_query($Conn1,"select sent_flag,form_type from tbl_cash_bonanza where app_id = '".$app_id."' and sent_flag = 1");
    if(mysqli_num_rows($cashback_qry) > 0){
		$cashback_msg = "(Cashback <span class='green'>&#10003;</span>)";
    }
}
	if($app_status_on=='3' || $app_status_on=='5' || $app_status_on=='6' || $app_status_on=='7'){
		$post_color='style="color:#22610F"';
	}else if ($app_status_on=='4' ){
		$post_color='style="color: #DA0808;"';
    }else{
        $post_color='style="color: #4E4577;"';
    }

	if($bank_crm_lead_on != ''){
		$get_status = mysqli_query($Conn1,"select description,status from partner_lead_status where app_id = '".$app_id."' order by status_id desc limit 1");
		$count_status = mysqli_num_rows($get_status);
	}
?>
<tr>
<td>
<a href = "javascropt:void(0);" class="has_link"><?php echo $case_id;?></a><br/>
<a href = "javascropt:void(0);" class="has_link"><span><?php echo $app_id;?></span></a><br><?php echo $bank_app_no_on; ?></td>
<td><span><?php echo substr(ucwords(strtolower($name)), 0, 20)."</span><br/><span class='fs-12'>".$city_name;?></span></td>
<td><span><?php echo $loan_amount;?></span><br/><span class="fs-12"><?php echo $loan_name;?></span></td>
<td><?php echo $name_bank_on; if($count_status > 0){$result_status = mysqli_fetch_array($get_status); echo " <span class='green'>(".$result_status['status']." ".$result_status['description'].")</span>"; }?></td>
<td><?php echo "<span>".$final_pre_status_name.$final_app_status_name.$final_sub_status_name."</span>"; if($auto_case_create == 1){ echo "<br><span class='fs-12'> (Auto)</span>" ; } ?><br><?php echo $app_st_date;?><br><?php echo $cashback_msg; ?></td>

</tr>
<?php
} ?>
</table>
<?php if($_SESSION['assign_access_lead'] == 1){?>
<table width="10%" style="float:left">
<tr >
<td><input type="radio" id="assign" name="assign">Assigned to</td>
<td id = "assign_to"><?php echo get_dropdown('user_lead_assign','assigned','',''); ?></td>
</tr>
<tr>
<td>
<input type ="hidden" name="page" id ="page" value="<?php echo $page;?>"/>
<input type ="submit" name="edit" value ="Assign" id="edit"/></td>
</tr>
</form>
</table>
<?php } if ($recordcount > 0) { ?>
<table width="width:90%;margin-left:4%;" border="0" align="center" cellpadding="4" cellspacing="1" class="pagination">
            <tr class="sidemain">
                <td>
                    <?php
					if($page > 1){
            echo "<a class='page gradient' href='one-lead-application.php?page=1&u_assign=$u_assign&case_no=$case_no&app_no=$app_no&from_loan_amount=$from_loan_amount&to_loan_amount=$to_loan_amount&app_statussearch=$app_statussearch&loan_type=$search&name_search=$name_search&phone=$phone&banksearch=$banksearch&crm_id_num=$crm_id_num&pre_status=$pre_statussearch&date_from=$date_from&date_to=$date_to&bankers_name=$bankers_name&app_new_status=$app_new_status&sub_status=$sub_status&sub_sub_status=$sub_sub_status'>First</a>";
						echo "<a class='page gradient' href='one-lead-application.php?page=" . ($page - 1) . "&u_assign=$u_assign&case_no=$case_no&app_no=$app_no&from_loan_amount=$from_loan_amount&to_loan_amount=$to_loan_amount&app_statussearch=$app_statussearch&loan_type=$search&name_search=$name_search&phone=$phone&banksearch=$banksearch&crm_id_num=$crm_id_num&pre_status=$pre_statussearch&date_from=$date_from&date_to=$date_to&bankers_name=$bankers_name&app_new_status=$app_new_status&sub_status=$sub_status&sub_sub_status=$sub_sub_status'>Prev</a>";
					}
          echo "<a class='page gradient' href='javascript:void;'>".$page."</a>";
          if($recordcount > $display_count){
                    echo "<a class='page gradient' href='one-lead-application.php?page=".($page+1) ."&u_assign=$u_assign&case_no=$case_no&app_no=$app_no&from_loan_amount=$from_loan_amount&to_loan_amount=$to_loan_amount&app_statussearch=$app_statussearch&loan_type=$search&name_search=$name_search&phone=$phone&banksearch=$banksearch&crm_id_num=$crm_id_num&pre_status=$pre_statussearch&date_from=$date_from&date_to=$date_to&bankers_name=$bankers_name&app_new_status=$app_new_status&sub_status=$sub_status&sub_sub_status=$sub_sub_status'>Next</a>";
                  }
                    ?></td>
            </tr>
        </table>
      <?php echo implode($script); ?>  </div>
</body></html>
<script type="text/javascript">
    $('#selectAll').click(function(event) {
  if(this.checked) {
// Iterate each checkbox
      $(':checkbox').each(function() {
          this.checked = true;
         var id =$(this).attr("id");
      });
  }
  else {
    $(':checkbox').each(function() {
          this.checked = false;
      });
  }
});
</script>
<?php }
} include("../../include/footer_close.php");  ?>
<script>window.onload = opn_subsource();</script>
