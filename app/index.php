<?php
echo "as";
//require_once(dirname(__FILE__) . "/../config/session.php");
require_once(dirname(__FILE__) . "/../config/config.php");
echo "as 1";
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../include/header.php');
echo "as 2";
require_once "../include/helper.functions.php";
require_once "../include/display-name-functions.php";

if($_SESSION['one_lead_flag'] == 1  && $_SESSION['sme_flag'] != 1){
    header("/../../logout.php");
    die();
} 
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../assets/css/jquery-ui.css" />
 <script type="text/javascript" src="../assets/js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="../assets/js/jquery-ui.js"></script>
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

    jQuery('#fup_date_from').datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd',
	    beforeShow: function() {
            jQuery(this).datepicker('option', 'maxDate', jQuery('#fup_date_to').val());
        }
    });

    jQuery('#fup_date_to').datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd',
        beforeShow: function() {
            jQuery(this).datepicker('option', 'minDate', jQuery('#fup_date_from').val());
        }
    });

  $("#assign_to").hide();
 $("#query_search").hide();
    $('#assign').click(function(){
           $('#assign_to').show();
           $("#query_search").hide();
});
$("#city_type").autocomplete({
		source: "../include/city_name.php",
		minLength: 2
	});

    $("#bankers_name").autocomplete({
		source: "../include/bankers_name.php",
		minLength: 2
	});

  $('#query').click(function(){
            $('#query_search').show();
            $("#assign_to").hide();

});
  });

function resetform() {
window.location.href = "index.php";
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
if(isset($_REQUEST['u_assign'])){
$u_assign = replace_special($_REQUEST['u_assign']);}
if(isset($_REQUEST['case_u_assign'])) {
    $case_u_assign = replace_special($_REQUEST['case_u_assign']);
}
if(isset($_REQUEST['app_u_assign'])) {
    $app_u_assign = replace_special($_REQUEST['app_u_assign']);
}
if(isset($_REQUEST['case_no'])){
$case_no = replace_special($_REQUEST['case_no']);}
if(isset($_REQUEST['app_no'])){
$app_no = replace_special($_REQUEST['app_no']);}
if(isset($_REQUEST['app_statussearch'])){
$app_statussearch = replace_special($_REQUEST['app_statussearch']);}
if(isset($_REQUEST['loan_type'])){
$search = replace_special($_REQUEST['loan_type']);}
if(isset($_REQUEST['from_loan_amount'])){
$from_loan_amount = replace_special($_REQUEST['from_loan_amount']);}
if(isset($_REQUEST['to_loan_amount'])){
$to_loan_amount = replace_special($_REQUEST['to_loan_amount']);}
if(isset($_REQUEST['name_search'])){
$name_search = replace_special($_REQUEST['name_search']);}
if(isset($_REQUEST['phone'])){
$phone = replace_special($_REQUEST['phone']); }
if(isset($_REQUEST['banksearch'])){
$banksearch = replace_special($_REQUEST['banksearch']);}
if(isset($_REQUEST['city_type'])){
$city_type  = replace_special($_REQUEST['city_type']);}

if(isset($_REQUEST['bankers_name'])) {
    $bankers_name = replace_special($_REQUEST['bankers_name']);
}
if(isset($_REQUEST['customer_id_search'])){
    $customer_id_search = $_REQUEST['customer_id_search'];
}
if(isset($_REQUEST['masked_phone'])) {
    $masked_phone = replace_special($_REQUEST['masked_phone']);
}
if(isset($_REQUEST['bank_app_no'])) {
    $bank_app_no = replace_special($_REQUEST['bank_app_no']);
}
if(isset($_REQUEST['patnersearch'])){
$patnersearch = replace_special($_REQUEST['patnersearch']);}
if(isset($_REQUEST['pre_status'])){
$pre_statussearch = replace_special($_REQUEST['pre_status']);}
if(isset($_REQUEST['date_from'])){
$date_from = replace_special($_REQUEST['date_from']);}
if(isset($_REQUEST['date_to'])){
$date_to = replace_special($_REQUEST['date_to']);}
if(isset($_REQUEST['crm_id_num'])){
	$crm_id_num = replace_special($_REQUEST['crm_id_num']);
}
if(isset($_REQUEST['source_compign'])){
$source_compign = replace_special($_REQUEST['source_compign']);
}
if(isset($_REQUEST['loan_nature'])) {
    $loan_nature = replace_special($_REQUEST['loan_nature']);
}
if(isset($_REQUEST['email_search'])) {
    $email_search = $_REQUEST['email_search'];
}

if(isset($_REQUEST['city_sub_group'])) {
    $city_sub_group = $_REQUEST['city_sub_group'];
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

if(isset($_REQUEST['fup_date_from'])) {
    $fup_date_from = replace_special($_REQUEST['fup_date_from']);
}
if(isset($_REQUEST['fup_date_to'])) {
    $fup_date_to = replace_special($_REQUEST['fup_date_to']);
}

if(isset($_REQUEST['fup_user_type'])) {
    $fup_user_type = replace_special($_REQUEST['fup_user_type']);
}

if($source_compign == 'gcl_id'){
	$source_used = "gclid=";
} else if($source_compign == 'source_campaign'){
	$source_used = "utm_source=svg";
} else if($source_compign == 'ref_campaign'){
	$source_used = "refer";
}else if($source_compign == 'mit'){
    $source_used = "lp-mit.php";
}else if($source_compign == 'utm_source'){
    $source_used = "utm_source=wunder_cab";;
}
$sub_source = replace_special($_REQUEST['sub_source']);
$insurance = replace_special($_REQUEST['insurance']);
$promo = replace_special($_REQUEST['promocode']);
$ref_phone = replace_special($_REQUEST['ref_phone']);

$qry_ex = "SELECT app.application_status as pre_login_status, cust.phone_no as phone, cust.name as name, app.id as app_id, cust.id as cust_id, cust.city_id as city_id,loan.value as loan_name,qry.crm_raw_data_id,app.crm_query_id,app.bank_id ,app.bank_application_no,qry.loan_type_id as loan_type,qry.loan_amount as required_loan_amt, app.login_date as login_date_on, app.sanction_date as sanction_date_on, app.disburse_date as first_disb_date_on, app.follow_up_date AS fup_date_on from crm_query_application as app JOIN crm_query as qry ON app.crm_query_id = qry.id Inner JOIN crm_customer as cust ON qry.crm_customer_id = cust.id INNER JOIN crm_masters as loan ON loan.id =  qry.loan_type_id ";

// if(trim($bankers_name) != "") {
//     $qry_ex .= " INNER JOIN banker_email_history on banker_email_history.case_id = c.case_id INNER JOIN banker_sms_history on banker_sms_history.case_id = c.case_id ";
// }
$qry_ex .= " where 1 ";
echo $qry_ex;
//and qry.lead_assign_to = '".$user."'";

// if($customer_id_search != "") {
//     $default = 1;
//     $qry_ex .= " and cust.id = $customer_id_search ";
// }
// if($masked_phone != "") {
//     $default = 1;
//     if(strpos($masked_phone, 'XXX') !== false) {
//         $initial = explode("XXX", $masked_phone);
//         if(strlen($initial[0]) == 4 && strlen($initial[1]) == 3) {
//             $qry_ex .= " and phone LIKE '".$initial[0]."___".$initial[1]."'";
//         }
//     }
// }
// if(trim($email_search) != "") {
//     $default = 1;
//     $qry_ex .= " AND cust.email = '".trim($email_search)."' ";
// }
// if($city_sub_group != '' && $city_sub_group != '0') {
//     $default = 1;
//     $qry_ex .= " and city.city_sub_group_id = '" . $city_sub_group . "'";
// }
// if($app_no != ""){$default = 1;
//     $qry_ex .= " and app.app_id = '".$app_no."'";
// }

// if($app_statussearch != ""){$default = 1;
//     $qry_ex .= " and app.app_status_on = '".$app_statussearch."'";
// }


// if($user_role == 2){
// 	if($sme_city_sub_group != ''){
// 		$qry_e .= " and (city.city_sub_group_id IN ($sme_city_sub_group) or qry.lead_assign_to IN ($tl_member)) ";
// 	}else if($tl_member !=''){
// 		$qry_e .= " and qry.lead_assign_to IN ($tl_member)";
// 	}
// }

// if($fup_date_from != "") {
//     $default = 1;
//     if($fup_user_type != "") {
//             $qry_ex .= " AND app.follow_up_date_on >= '".$fup_date_from."' ";
//     } else {
//         $qry_ex .= " AND (app.follow_up_date_on >= '".$fup_date_from."') ";
//     }
// }
// if($fup_date_to != "") {
//     $default = 1;
//     if($fup_user_type != "") {
//         $qry_ex .= " AND app.follow_up_date_on <= '".$fup_date_to."' ";
//     } else {
//         $qry_ex .= " AND (app.follow_up_date_on <= '".$fup_date_to."' )  ";
//     }
// }

// if($fup_user_type != "" && $fup_date_to == "" && $fup_date_from == "") {
//     $default = 1;
//     $qry_ex .= " AND (app.follow_up_date is not null AND app.follow_up_date != '' AND app.follow_up_date != '0000-00-00')  ";
// }

// if($search != ""){$default = 1;
//     $qry_ex .= " and qry.loan_type_id = '".$search."'";
// }if($from_loan_amount != "" && $to_loan_amount != ""){
//     $default = 1;
//     if($app_statussearch == 28 ){
//         $qry_ex .= " and app.disbursed_amount between '".$from_loan_amount."' and '".$to_loan_amount."'";
//     } else if($app_statussearch == 27){
//         $qry_ex .= " and app.sanction_amount between '".$from_loan_amount."' and '".$to_loan_amount."'";
//     } else {
//         $qry_ex .= " and app.applied_amount between '".$from_loan_amount."' and '".$to_loan_amount."'";
//     } 
// }


// if($pre_statussearch != ""){$default = 1;
// 	$qry_ex .= " and app.application_status = '".$pre_statussearch."'";
// }

// if($name_search != ""){
//     $default = 1;
//     $qry_ex .= " and cust.name like '%".$name_search."%'";
// }
// if($phone != ""){
//     $default = 1;
//     $qry_ex .= " and cust.phone_no = '".$phone."'";
// }
// if($search_city_id != "" && $search_city_id != 0){$default = 1;
//     $qry_ex .= " and cust.city_id = '".$search_city_id."'";
// }


// // if(trim($bankers_name) != "") {
// // 	$default = 1;
// //     $qry_ex .= " and ( banker_email_history.banker_name = '".$bankers_name."' OR banker_sms_history.banker_name = '".$bankers_name."' ) ";
// // }
// if(trim($bank_app_no) != "") {
// 	$default = 1;
//     $qry_ex .= " AND app.bank_application_no = '".$bank_app_no."' ";
// }

// if($date_from != "" && $date_to != "" && $date_from != "0000-00-00" && $date_to != "0000-00-00"){
// 	$default = 1;
//     if($app_statussearch == 28 ){$default = 1;
//         $qry_ex .= " and app.disburse_date between '".$date_from."' and '".$date_to."'";
//     }else if($app_statussearch == 27 ){$default = 1;
//      $qry_ex .= " and app.sanction_date between '".$date_from."' and '".$date_to."'";
//     }else if($app_statussearch == 26){$default = 1;
//         $qry_ex .= " and app.login_date between '".$date_from."' and '".$date_to."'";
//     }else{
//         if($date_from != "" && $date_to != "" && $date_from != "0000-00-00" && $date_to != "0000-00-00"){$default = 1;
//             $qry_ex .= " and app.created_on between '".$date_from."' and '".$date_to."'";
//     }
// }
// }
// if($default != '1'){
//             $qry_ex .= " and app.created_on between DATE_SUB(CURDATE(), INTERVAL 5 DAY) and CURDATE() ";
//     }
// $qry_ex .= " group by app.id order by app.created_on desc limit ".$offset.",".$max_offset;
// //echo $user == 173?$qry_ex:'';
// echo $qry_ex;

?>
<fieldset><legend>Application Filter</legend>
<form method="post" action="index.php" name="searchfrm" autocomplete="off">
<input type="text" class="text-input" name="app_no" id="app_no" placeholder="Application No" value="<?php echo $app_no;?>" maxlength="20"/>
<input type="text" class="text-input" name="name_search" id="name_search" placeholder="Name" value="<?php echo ($name_search);?>" maxlength="30"/>
<?php if($user_role != 2){ ?><input type="text" class="text-input" name="phone" id="phone" placeholder="Phone No" value="<?php echo $phone;?>" maxlength="10"/><?php } ?>
<input type="text" class="text-input" name="from_loan_amount" id="from_loan_amount" placeholder="From Loan Amount" value="<?php echo $from_loan_amount;?>" maxlength="10"/>
<input type="text" class="text-input" name="to_loan_amount" id="to_loan_amount" placeholder="To Loan Amount" value="<?php echo $to_loan_amount;?>" maxlength="10"/>
<?php echo get_textbox('city_type',$city_type,'placeholder ="City Name (Enter few words)"'); ?>
<!-- <input type="text" class="text-input" name="crm_id_num" id="crm_id_num" placeholder="Bank CRM ID" value="<?php echo $crm_id_num;?>"/> -->
<input type="text" class="text-input" name="date_from" id="date_from" placeholder="Date From" value="<?php echo $date_from;?>" maxlength="10" readonly="readonly"/>
<input type="text" class="text-input" name="date_to" id="date_to" placeholder="Date To" value="<?php echo $date_to;?>" maxlength="10" readonly="readonly"/>
<?php echo get_dropdown(1,'loan_type',$search,'');
 echo get_dropdown('user', 'app_u_assign', $app_u_assign, '');

	echo get_dropdown(13,'banksearch',$banksearch,'');

    //echo get_dropdown('pre_login', 'pre_status', $pre_statussearch, ''); ?>
<input type="text" class="text-input" name="customer_id_search" id="customer_id_search" placeholder="Customer ID" maxlength="30" value="<?php echo $customer_id_search;?>"/>
<input type="text" class="text-input" name="masked_phone" id="masked_phone" placeholder="Masked Phone No." value="<?php echo $masked_phone ;?>" maxlength="10"/>
<input type="text" class="text-input alpha-num-hyphen" name="bank_app_no" id="bank_app_no" placeholder="Bank Application No." value="<?php echo $bank_app_no; ?>" maxlength="20"/>
<input type="text" class="text-input" name="email_search" id="email_search" placeholder="Customer Email" value="<?php echo $email_search;?>" maxlength="100" autocomplete="null"/>
<?php echo get_dropdown('crm_master_city_sub_group', 'city_sub_group', $city_sub_group, ''); ?>

    <input type="text" class="text-input" name="fup_date_from" id="fup_date_from" placeholder="FUP Date From" value="<?php echo $fup_date_from; ?>" maxlength="10" readonly="readonly"/>
    <input type="text" class="text-input" name="fup_date_to" id="fup_date_to" placeholder="FUP Date To" value="<?php echo $fup_date_to; ?>" maxlength="10" readonly="readonly"/>

<input class="cursor" type="submit" name="searchsubmit" value="Filter">
<input class="cursor" type="button" onclick="resetform()" value="Clear">
</td></tr></table>
</form>
</fieldset>
<table width="100%" class="gridtable">
 <form method = "post" name="frmmain" action ="mask_assign.php">
<tr>
<?php if($_SESSION['assign_access_lead'] == 1){?><th width="5%"><div><input type ="checkbox" name ="selectAll[]" id="selectAll">Select</div></th><?php } ?>
<th width="10%">Application No<br> Bank App No.</th>
<th width="10%">Name & Mobile & City</th>
<th width="10%">Loan amount & Loan Type</th>
<th width="10%">Partner</th>
<th width="10%">Bank Name</th>
<th width="10%">Application Status</th>
<th width="10%">Application Created By</th>
<!-- <th width="10%">Action</th> -->
<th width="6%">View</th>
</tr>
<?php
// echo $qry_ex;
$res = mysqli_query($Conn1,$qry_ex) or die("Error: ".mysqli_error($Conn1));
$recordcount = mysqli_num_rows($res);
if($recordcount > 0){
	$record = 0;
while($exe = mysqli_fetch_array($res)){
	$record++;
	if($record > 10){
		continue;
	}

$cust_name  = $exe['name'];
$phone  = $exe['phone'];
// $pre_login_status  = $exe['pre_login_status'];
// $sub_sub_status  = $exe['sub_sub_status'];
// $cust_id = $exe['cust_id'];
$loan_type = $exe['loan_type'];
$loan_amount = ($exe['required_loan_amt'] > 0) ? custom_money_format($exe['required_loan_amt']) : "";
$bank_app_no_on  = $exe['bank_app_no_on'];

$name_bank = $exe['bank_id'];
$loan_name = (trim($exe['loan_name']) != "") ? "(".$exe['loan_name'].")" : "";
$assign = $exe['user_name'];
$partner_name = $exe['partner_name'];
$crm_query_id = $exe['crm_query_id'];
$bank_application_no = $exe['bank_application_no'];
$case_id = $exe['crm_raw_data_id'];
$cust_id = $exe['cust_id'];
$city_id = $exe['city_id'];
$city_name_get = get_name("city_id",$city_id);
$city_name = $city_name_get['city_name'];
$get_name_bank = get_name("",$name_bank);
echo $get_name_bank;
// $name_app_statuson = get_display_name('post_login',$app_status_on);
// if($name_app_statuson == ''){
//   $name_app_statuson = get_display_name('snew_status_name',$app_status_on);  
// }
// $name_pre_statuson = get_display_name('pre_login',$pre_login_status);
// if($name_pre_statuson == ''){
//   $name_pre_statuson = get_display_name('snew_status_name',$pre_login_status);  
// }
// if($sub_sub_status > 0){
//   $sub_status_name = get_display_name('snew_status_name',$sub_sub_status);  
// }

// $final_pre_status_name = (trim($name_pre_statuson) == '') ?'' : $name_pre_statuson;
// $final_app_status_name = (trim($name_app_statuson) == '') ?'' : "/ ".$name_app_statuson;
// $final_sub_status_name = (trim($sub_status_name) == '') ?'' : "/ ".$sub_status_name;

// $app_other_status = trim($exe['other_status'], ',');
// if(in_array($app_new_status, array(1013, 1014))) {
//     if($sub_status != "") {
//         $other_status_query = " SELECT group_concat(' ', description) AS new_status FROM status_master WHERE status_id IN ($app_other_status) AND is_active_for_filter = 1 ";
//         $other_status_exe       = mysqli_query($Conn1, $other_status_query);
//         $other_status_res       = mysqli_fetch_array($other_status_exe);
//         $final_pre_status_name  = $final_pre_status_name.", ".$other_status_res['new_status'];
//     }
// }

// $auto_case_create = $exe['auto_case_create'];
// $name = $exe['name'];
// $phone_no = $exe['phone'];
// $app_user_name        = $exe['app_user_name'];

// $fup_date_on = "";
// $rm_fup_date_on = "";
// if($exe['fup_date_on'] != "" && $exe['fup_date_on'] != "1970-01-01" && $exe['fup_date_on'] != "0000-00-00") {
//     $fup_date_on = date("d-m-Y", strtotime($exe['fup_date_on']));
// }

// if($exe['rm_fup_date_on'] != "" && $exe['rm_fup_date_on'] != "1970-01-01" && $exe['rm_fup_date_on'] != "0000-00-00") {
//     $rm_fup_date_on = date("d-m-Y", strtotime($exe['rm_fup_date_on']))." <b>(FUP - RM)</b><br>";
// }

// if($user_role != '1'){
//     $echo_number = substr_replace($phone_no,'XXX',4,3);
//     // $echo_number = "";
// } else {
//    $echo_number =  $phone_no;
// }

// $city_name = (trim($exe['city_name']) != "") ? "(".$exe['city_name'].")" : "";
// $bank_crm_lead_on  = $exe['bank_crm_lead_on'];
// $app_bank_on  = $exe['app_bank_on'];
//$partner_on  = $exe['partner_on'];
//$user_id = $exe['user_id'];

$app_partner_on = $exe['partner_on'];
$digital_verification = "";
// if($app_bank_on == 18 && $loan_type == 56) {
//     $digital_otp_verification = "";
//     $dov_query = "SELECT cases.query_id FROM tbl_mint_case AS cases LEFT JOIN tbl_bank_otp_verification AS verification ON verification.lead_id = cases.query_id WHERE cases.case_id = '".$case_id."' AND otp_flag = 1 ORDER BY case_id DESC";
//     $dov_exec = mysqli_query($Conn1, $dov_query);
//     if(mysqli_num_rows($dov_exec) > 0) {
//         $digital_verification = "<span class='fs-12'> (OTP <span class='green'>&#10003;</span> by customer)</span>";
//     }
// }

$cashback_arr = array(); $app_st_date = $cashback_app = "";
if($app_status_on == 3 || $pre_login_status == 1016){
	$app_st_date = (($exe['login_date_on']) == "0000-00-00" || $exe['login_date_on'] == "" || $exe['login_date_on'] == "1970-01-01") ? '--' : date("d-m-Y", strtotime($exe['login_date_on']));
}else if($app_status_on == 5 || $pre_login_status == 1017){
    $app_st_date = ($exe['sanction_date_on'] == '0000-00-00' || $exe['sanction_date_on'] == "" || $exe['sanction_date_on'] == "1970-01-01") ? '--' : date("d-m-Y", strtotime($exe['sanction_date_on']));
}else if($app_status_on == 6 || $app_status_on == 7 || $pre_login_status == 1019){
    $app_st_date = ($exe['first_disb_date_on'] == '0000-00-00' || $exe['first_disb_date_on'] == "" || $exe['first_disb_date_on'] == "1970-01-01") ? '--' : date("d-m-Y", strtotime($exe['first_disb_date_on']));
	$cashback_qry = mysqli_query($Conn1,"select sent_flag,form_type, voucher_type from tbl_cash_bonanza where app_id = '".$app_id."' and sent_flag =1");
	while($result_cashback_qry = mysqli_fetch_array($cashback_qry)){
		$cashback_sent = $result_cashback_qry['sent_flag'];
		if($result_cashback_qry['form_type'] == 1){
			$cashback_msg = "(Refferal <span class='green'>&#10003;</span>)";
		}else {
            if($result_cashback_qry['voucher_type'] == 1) {
                $cashback_msg = "(Flipkart <span class='green'>&#10003;</span>)";
            } else if($result_cashback_qry['voucher_type'] == 2) {
                $cashback_msg = "(Transfer to Bank <span class='green'>&#10003;</span>)";
            } else if($result_cashback_qry['voucher_type'] == 3) {
                $cashback_msg = "(Corona HI <span class='green'>&#10003;</span>)";
            } else if($result_cashback_qry['voucher_type'] == 4) {
                $cashback_msg = "(PA Insurance <span class='green'>&#10003;</span>)";
            }
		}
			$cashback_arr[] = $cashback_msg;
	}
	if(!empty($cashback_arr)){
		$cashback_app = "<span class='fs-12'>".implode("<br>",$cashback_arr)."</span>";
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

$script[]='<script type="text/javascript">
$("#'.urlencode(base64_encode($case_id)).'").change(function(){
if ($(this).not(":checked")) {
            $("#selectAll").removeAttr("checked");
    }
});
</script>';
?>
<tr>
<?php //if($_SESSION['assign_access_lead'] == 1){?>
    <!-- <td><input type='hidden' name='url' value='<?php //echo 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';?>'/> -->
<!-- <input type ="checkbox" name ="mask[]" id="<?php echo urlencode(base64_encode($case_id)); ?>" value ="<?php echo $case_id;?>"</td><?php //} ?> -->
<td>
    <!-- <input type='' name='applcation_id_<?php echo $case_id;?>' value='<?php echo base64_encode($app_id);?>'> -->
<!-- <a href = "../cases/edit.php?case_id=<?php echo urlencode(base64_encode($case_id)) ;?>" class="has_link"><?php echo $case_id;?></a> -->
<!-- <br/> -->
<a href = "edit.php?case_id=<?php echo urlencode(base64_encode($case_id)) ;?>&app_id=<?php echo urlencode(base64_encode($crm_query_id)); ?>&cust_id=<?php echo urlencode(base64_encode($cust_id));?>&loan_type=<?php echo $loan_type;?>" class="has_link">
<span><?php echo $crm_query_id;?></span></a>
<br><?php echo $bank_application_no; ?>
</td>
<td>
    <span><?php echo substr(ucwords(strtolower($cust_name)), 0, 20)."</span><br/><span class='fs-12'>".$phone."</span><br/><span class='fs-12'>".$city_name;?></span>
</td>
<td>
    <span><?php echo $loan_amount;?></span><br/><span class="fs-12"><?php echo $loan_name;?></span>
</td>
<td>
    <?php echo $partner_name;?>
</td>
<td>
    <?php echo $name_bank_on; if($count_status > 0){$result_status = mysqli_fetch_array($get_status); echo " <span class='green'>(".$result_status['status']." ".$result_status['description'].")</span>"; }?>
</td>

<td>
    <?php

    echo "<span>".$final_pre_status_name.$final_app_status_name.$final_sub_status_name."</span>";
    if($auto_case_create == 1) {
        echo "<br><span class='fs-12'> (Auto)</span>" ; 
    }
    ?>
    <br>
    <?php echo $app_st_date; ?>
</td>

<?php if($user_role != 3) { ?>
    <!-- <td><input type='hidden' name='assign_from_user_<?php echo $case_id;?>' value='<?php echo $assign;?>'><?php echo $assign;?></td><?php } ?> -->


<?php if($user_role != 3) { ?><td><input type='hidden' name='app_created_by_<?php echo $app_id;?>' value='<?php echo $app_user_name; ?>'><?php echo $app_user_name; ?></td><?php } ?>



<!-- <td class="align-center">
    <a href="../email/send-email.php?case_id=<?php echo urlencode(base64_encode($case_id));?>"  class="has_link">Send Email</a></br>
<a href="feedback.php?app_id=<?php echo base64_encode($app_id);?>" target='_blank' class="has_link">Feedback</a>
<?php if($exe['fb_id'] > 0){ ?><span class="green"><b> (&#10003;)</b></span><?php } ?></br>
<?php if((($app_bank_on == 29 && $loan_type == 56) || ($app_bank_on == 40 && $loan_type == 71) || ($app_bank_on == 81 && $loan_type == 56) || $app_bank_on == 18)  && ($bank_crm_lead_on != '' || $bank_app_no_on != '')){?><br>
<a href="../lead/auto_insert/check-api-status.php?app_id=<?php echo base64_encode($app_id);?>&prospectno=<?php echo base64_encode($bank_crm_lead_on); ?>&case_id=<?php echo base64_encode($case_id);?>&bank_app_no=<?php echo base64_encode($bank_app_no_on);?>&bnk=<?php echo base64_encode($app_bank_on); ?>&loan_type=<?php echo base64_encode($loan_type); ?>"  class="has_link">Check Status</a><br><?php } ?>
<?php if($disb_email_flag == 1){
	echo "<span class='fs-12'>(Disb. mail <span class='green'> &#10003;</span>)</span><br>";
}echo $cashback_app; ?>
<?php if($digital_verification != "") { echo $digital_verification; } ?>
</td> -->



<td>
    <a href="edit.php?case_id=<?php echo urlencode(base64_encode($case_id)) ;?>&app_id=<?php echo urlencode(base64_encode($crm_query_id)); ?>&cust_id=<?php echo urlencode(base64_encode($cust_id));?>&loan_type=<?php echo $loan_type;?>" class="has_link"><input type="button" class = "pointer_n" value="View" style="border-radius: 5px; background-color: #18375f; font-weight: bold;"></a>
</td>
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
            echo "<a class='page gradient' href='index.php?page=1&u_assign=$u_assign&sub_source=$sub_source&insurance=$insurance&promocode=$promocode&source_compign=$source_compign&ref_phone=$ref_phone&case_no=$case_no&app_no=$app_no&from_loan_amount=$from_loan_amount&to_loan_amount=$to_loan_amount&app_statussearch=$app_statussearch&loan_type=$search&name_search=$name_search&phone=$phone&banksearch=$banksearch&pre_status=$pre_statussearch&patnersearch=$patnersearch&crm_id_num=$crm_id_num&city_type=$city_type&date_from=$date_from&date_to=$date_to&bankers_name=$bankers_name&customer_id_search=$customer_id_search&masked_phone=$masked_phone&bank_app_no=$bank_app_no&email_search=$email_search&city_sub_group=$city_sub_group&case_u_assign=$case_u_assign&app_u_assign=$app_u_assign&app_new_status=$app_new_status&sub_status=$sub_status&sub_sub_status=$sub_sub_status&refarming_user_id=$refarming_user_id&fup_date_from=$fup_date_from&fup_date_to=$fup_date_to&fup_user_type=$fup_user_type'>First</a>";
						echo "<a class='page gradient' href='index.php?page=" . ($page - 1) . "&u_assign=$u_assign&sub_source=$sub_source&insurance=$insurance&promocode=$promocode&source_compign=$source_compign&ref_phone=$ref_phone&case_no=$case_no&app_no=$app_no&from_loan_amount=$from_loan_amount&to_loan_amount=$to_loan_amount&app_statussearch=$app_statussearch&loan_type=$search&name_search=$name_search&phone=$phone&banksearch=$banksearch&pre_status=$pre_statussearch&patnersearch=$patnersearch&crm_id_num=$crm_id_num&city_type=$city_type&date_from=$date_from&date_to=$date_to&bankers_name=$bankers_name&customer_id_search=$customer_id_search&masked_phone=$masked_phone&bank_app_no=$bank_app_no&email_search=$email_search&city_sub_group=$city_sub_group&case_u_assign=$case_u_assign&app_u_assign=$app_u_assign&app_new_status=$app_new_status&sub_status=$sub_status&sub_sub_status=$sub_sub_status&refarming_user_id=$refarming_user_id&fup_date_from=$fup_date_from&fup_date_to=$fup_date_to&fup_user_type=$fup_user_type'>Prev</a>";
					}
          echo "<a class='page gradient' href='javascript:void;'>".$page."</a>";
          if($recordcount > $display_count){
                    echo "<a class='page gradient' href='index.php?page=".($page+1) ."&u_assign=$u_assign&sub_source=$sub_source&insurance=$insurance&promocode=$promocode&source_compign=$source_compign&ref_phone=$ref_phone&case_no=$case_no&app_no=$app_no&from_loan_amount=$from_loan_amount&to_loan_amount=$to_loan_amount&app_statussearch=$app_statussearch&loan_type=$search&name_search=$name_search&phone=$phone&banksearch=$banksearch&patnersearch=$patnersearch&crm_id_num=$crm_id_num&pre_status=$pre_statussearch&city_type=$city_type&date_from=$date_from&date_to=$date_to&bankers_name=$bankers_name&customer_id_search=$customer_id_search&masked_phone=$masked_phone&bank_app_no=$bank_app_no&email_search=$email_search&city_sub_group=$city_sub_group&case_u_assign=$case_u_assign&app_u_assign=$app_u_assign&app_new_status=$app_new_status&sub_status=$sub_status&sub_sub_status=$sub_sub_status&refarming_user_id=$refarming_user_id&fup_date_from=$fup_date_from&fup_date_to=$fup_date_to&fup_user_type=$fup_user_type'>Next</a>";
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
<script>
$("#app_no, #case_no, #phone, #from_loan_amount, #to_loan_amount, #customer_id_search").bind('keypress', function(evt) {
    if (evt.which > 31 && (evt.which < 48 || evt.which > 57)) {
        evt.preventDefault();
    }
});

$('#city_type').bind('keypress', function(evt) {
    var input = evt.target;
    var val = $('#city_type').val();
    var end = $('#city_type').prop('selectionEnd');

    if(evt.which === 32 &&  evt.target.selectionStart === 0)
        return false;
    if(evt.which >= 48 && evt.which <= 57)
        return true;
    if(evt.which >= 65 && evt.which <= 90 || (evt.which > 96 && evt.which < 123))
        return true;
    if(evt.which == 32 && (val[end - 1] == " " || val[end] == " "))
        evt.preventDefault();
    if(evt.which > 31 && evt.which < 33)
        return true;
    else
        evt.preventDefault();
});

$('#bankers_name').bind('keypress', function(evt) {
    var input = evt.target;
    var val = $('#bankers_name').val();
    var end = $('#bankers_name').prop('selectionEnd');

    if(evt.which === 32 &&  evt.target.selectionStart === 0)
        return false;
    if(evt.which >= 65 && evt.which <= 90 || (evt.which > 96 && evt.which < 123))
        return true;
    if(evt.which == 32 && (val[end - 1] == " " || val[end] == " "))
        evt.preventDefault();
    if(evt.which > 31 && evt.which < 33)
        return true;
    else
        evt.preventDefault();
});

$('#name_search').bind('keypress', function(evt) {
  if((evt.which > 64 && evt.which < 91) || (evt.which > 96 && evt.which < 123)) {
    return true;
  } else {
    evt.preventDefault();
  }
});

$('#masked_phone').bind('keypress', function(evt) {
    if(evt.which >= 48 && evt.which <= 57)
        return true;
    if(evt.which >= 65 && evt.which <= 90 || (evt.which > 96 && evt.which < 123))
        return true;
    else
        evt.preventDefault();
});

$('.alpha-num-hyphen').bind('keypress', function(evt) {
    if (evt.which >= 48 && evt.which <= 57)
        return true;
    if (evt.which >= 65 && evt.which <= 90 || (evt.which > 96 && evt.which < 123))
        return true;
    if(evt.which == 45)
        return true;
    else
      evt.preventDefault();
});
</script>