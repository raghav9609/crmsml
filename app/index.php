<?php
session_start();
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../include/header.php');
require_once(dirname(__FILE__) . '/../config/config.php');
require_once "../include/helper.functions.php";


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

if(isset($_REQUEST['app_no'])){
$app_no = replace_special($_REQUEST['app_no']);}

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
// if(isset($_REQUEST['customer_id_search'])){
//     $customer_id_search = $_REQUEST['customer_id_search'];
// }
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

if(isset($_REQUEST['application_status'])) {
    $application_status = replace_special($_REQUEST['application_status']);
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

$qry_ex = "SELECT app.created_on, app.application_status, cust.phone_no as phone, cust.name as name, app.id as app_i,app.user_id, cust.id as cust_id, cust.city_id as city_id,loan.value as loan_name,qry.crm_raw_data_id,app.crm_query_id,app.bank_id ,app.bank_application_no,qry.loan_type_id as loan_type,qry.loan_amount as required_loan_amt, app.login_date as login_date_on, app.sanction_date as sanction_date_on, app.disburse_date as first_disb_date_on, app.follow_up_date AS follow_up_date,app.follow_up_time as follow_up_time from crm_query_application as app JOIN crm_query as qry ON app.crm_query_id = qry.id Inner JOIN crm_customer as cust ON qry.crm_customer_id = cust.id INNER JOIN crm_masters as loan ON loan.id =  qry.loan_type_id INNER JOIN crm_master_city AS city ON cust.city_id = city.id where 1 " ;

if($user_role == 3 || ($user_role == 2 && $_SESSION['userDetails']['tluserlist'] == "")){
    $qry_ex .= " and app.user_id = '" . $user_id . "'";
}else if($user_role == 2 && $_SESSION['userDetails']['tluserlist'] != ""){
    $qry_ex .= " and app.user_id IN (" . $_SESSION['userDetails']['tluserlist'] . ") and app.user_id <> 0";
}

if($user_role == 4){
    $qry_ex .= " and app.bank_id <> 0 and app.bank_id IN (" . $_SESSION['userDetails']['rmpartnerlist'] . ")";
}
if(trim($email_search) != "") {
    $default = 1;
    $qry_ex .= " AND cust.email_id = '".trim($email_search)."' ";
}
if($city_sub_group != '' && $city_sub_group != '0') {
    $default = 1;
    $qry_ex .= " and city.city_sub_group_id = '" . $city_sub_group . "'";
}
if($app_no != ""){$default = 1;
    $qry_ex .= " and app.id = '".$app_no."'";
}

if($fup_date_from != "") {
    $default = 1;
    if($fup_user_type != "") {
            $qry_ex .= " AND app.follow_up_date >= '".$fup_date_from."' ";
    } else {
        $qry_ex .= " AND (app.follow_up_date >= '".$fup_date_from."') ";
    }
}
if($fup_date_to != "") {
    $default = 1;
    if($fup_user_type != "") {
        $qry_ex .= " AND app.follow_up_date <= '".$fup_date_to."' ";
    } else {
        $qry_ex .= " AND (app.follow_up_date <= '".$fup_date_to."' )  ";
    }
}

if($search != ""){$default = 1;
    $qry_ex .= " and qry.loan_type_id = '".$search."'";
}if($from_loan_amount != "" && $to_loan_amount != ""){
    $default = 1;
    if($application_status == 28 ){
        $qry_ex .= " and app.disbursed_amount between '".$from_loan_amount."' and '".$to_loan_amount."'";
    } else if($application_status == 27){
        $qry_ex .= " and app.sanction_amount between '".$from_loan_amount."' and '".$to_loan_amount."'";
    } else {
        $qry_ex .= " and app.applied_amount between '".$from_loan_amount."' and '".$to_loan_amount."'";
    } 
}

if($name_search != ""){
    $default = 1;
    $qry_ex .= " and cust.name like '%".$name_search."%'";
}
if($phone != ""){
    $default = 1;
    $qry_ex .= " and cust.phone_no = '".$phone."'";
}
if($search_city_id != "" && $search_city_id != 0){$default = 1;
    $qry_ex .= " and cust.city_id = '".$search_city_id."'";
}
if(trim($bank_app_no) != "") {
	$default = 1;
    $qry_ex .= " AND app.bank_application_no = '".$bank_app_no."' ";
}
if($app_u_assign != ""){
    $qry_ex .= " and app.user_id = '".$app_u_assign."' ";
}

if($application_status != ""){
    $qry_ex .= " and app.application_status = '".$application_status."' ";
}



if($date_from != "" && $date_to != "" && $date_from != "0000-00-00" && $date_to != "0000-00-00"){
	$default = 1;
    if($application_status == 28 ){$default = 1;
        $qry_ex .= " and app.disburse_date between '".$date_from."' and '".$date_to."'";
    }else if($application_status == 27 ){$default = 1;
     $qry_ex .= " and app.sanction_date between '".$date_from."' and '".$date_to."'";
    }else if($application_status == 26){$default = 1;
        $qry_ex .= " and app.login_date between '".$date_from."' and '".$date_to."'";
    }else{
        if($date_from != "" && $date_to != "" && $date_from != "0000-00-00" && $date_to != "0000-00-00"){$default = 1;
            $qry_ex .= " and app.created_on between '".$date_from."' and '".$date_to."'";
    }
}
}

$qry_ex .= " group by app.id order by app.created_on desc ";

$downloadreportapp = $qry_ex;

$qry_execute = $qry_ex." limit ".$offset.",".$max_offset;

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
<input type="text" class="text-input" name="date_from" id="date_from" placeholder="Date From" value="<?php echo $date_from;?>" maxlength="10" readonly="readonly"/>
<input type="text" class="text-input" name="date_to" id="date_to" placeholder="Date To" value="<?php echo $date_to;?>" maxlength="10" readonly="readonly"/>
<?php echo get_dropdown('application_status','application_status',$application_status); ?>
<?php echo get_dropdown(1,'loan_type',$search,'');
 echo get_dropdown('user', 'app_u_assign', $app_u_assign, '');

	echo get_dropdown(13,'banksearch',$banksearch,'');

    //echo get_dropdown('pre_login', 'pre_status', $pre_statussearch, ''); ?>
<!-- <input type="text" class="text-input" name="customer_id_search" id="customer_id_search" placeholder="Customer ID" maxlength="30" value="<?php // echo $customer_id_search;?>"/> -->
<input type="text" class="text-input" name="masked_phone" id="masked_phone" placeholder="Masked Phone No." value="<?php echo $masked_phone ;?>" maxlength="10"/>
<input type="text" class="text-input alpha-num-hyphen" name="bank_app_no" id="bank_app_no" placeholder="Bank Application No." value="<?php echo $bank_app_no; ?>" maxlength="20"/>
<input type="text" class="text-input" name="email_search" id="email_search" placeholder="Customer Email" value="<?php echo $email_search;?>" maxlength="100" autocomplete="null"/>
<?php echo get_dropdown('crm_master_city_sub_group', 'city_sub_group', $city_sub_group, ''); ?>

    <input type="text" class="text-input" name="fup_date_from" id="fup_date_from" placeholder="FUP Date From" value="<?php echo $fup_date_from; ?>" maxlength="10" readonly="readonly"/>
    <input type="text" class="text-input" name="fup_date_to" id="fup_date_to" placeholder="FUP Date To" value="<?php echo $fup_date_to; ?>" maxlength="10" readonly="readonly"/>

<input class="cursor" type="submit" name="searchsubmit" value="Filter">
<input class="cursor" type="button" onclick="resetform()" value="Clear">
<a href="https://astechnos.com/crmsml/report/download-app.php?page=1&fetchdata=<?php echo base64_encode($downloadreportapp);?>" target="_blank"><input class="cursor" type="button" value="Download"></a>
</td></tr></table>
</form>
</fieldset>
<table width="100%" class="gridtable">
 <form method = "post" name="frmmain" action ="mask_assign.php">
<tr>
<th width="10%">Application No<br> Created On</th>
<th width="10%">Name<br> Mobile<br> City</th>
<th width="10%">Loan amount<br>Type</th>
<th width="10%">Bank</th>
<th width="10%">Status</th>
<th width="10%">Follow Up Date Time</th>
<th width="10%">Assign to</th>
<th width="6%">Action</th>
</tr>
<?php
$res = mysqli_query($Conn1,$qry_execute) or die("Error: ".mysqli_error($Conn1));
$recordcount = mysqli_num_rows($res);
if($recordcount > 0){
	$record = 0;
while($exe = mysqli_fetch_array($res)){
	$record++;
	if($record > 10){
		continue;
	}
$app_i = $exe['app_i'];
$cust_name  = $exe['name'];
$phone  = $exe['phone'];
$follow_up_date  = $exe['follow_up_date'];
$follow_up_time  = $exe['follow_up_time'];
$created_on = date("d-m-Y",strtotime($exe['created_on']));
if($follow_up_date == '' || $follow_up_date == '0000-00-00' || $follow_up_date == "1970-01-01"){
 $final_follow_up_date = "-";   
}else{
 $final_follow_up_date = date("d-m-Y",strtotime($follow_up_date));   
}
if($follow_up_time == '' || $follow_up_time == '00:00:00' ){
 $final_follow_up_time = "-";   
}else{
     $final_follow_up_time = date("H:i a",strtotime($follow_up_time));
}

$application_status_get  = $exe['application_status'];
$get_application_status = get_name('status_name',$application_status_get);

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
$name_bank_on = $get_name_bank['value'];
$app_user = $exe['user_id'];
$get_user_name = get_name("user_id",$app_user);


$app_partner_on = $exe['partner_on'];

$script[]='<script type="text/javascript">
$("#'.urlencode(base64_encode($case_id)).'").change(function(){
if ($(this).not(":checked")) {
            $("#selectAll").removeAttr("checked");
    }
});
</script>';
?>
<tr>
<td>
    <!-- <input type='' name='applcation_id_<?php echo $case_id;?>' value='<?php echo base64_encode($app_id);?>'> -->
<!-- <a href = "../cases/edit.php?case_id=<?php echo urlencode(base64_encode($case_id)) ;?>" class="has_link"><?php echo $case_id;?></a> -->
<!-- <br/> -->
<a href = "edit.php?app_id=<?php echo urlencode(base64_encode($app_i)); ?>" class="has_link">
<span><?php echo $app_i;?></span></a>
<br>
<?php echo $created_on; ?>
</td>
<td>
<span>
    <?php echo substr(ucwords(strtolower($cust_name)), 0, 20); ?>
</span><br/>
<span class='fs-12'>
    <?php 
    if($user_role != 1) {
        $phone = substr_replace($phone, 'XXX', 4, 3);
        echo $phone;
    } else {
        echo $phone;
    }
    ?>
</span><br/>
<span class='fs-12'>
    <?php echo $city_name; ?>
</span>
</td>
<td>
    <span><?php echo $loan_amount;?></span><br/><span class="fs-12"><?php echo $loan_name;?></span>
</td>

<td>
    <?php echo $name_bank_on;?>
</td>

<td>
    <?php echo  $get_application_status['value'];?>

</td>

<td>
    <?php echo $final_follow_up_date." ".$final_follow_up_time;?>
</td>
<td>
    <?php echo $get_user_name['name'];?>
</td>
<td>
    <a href="edit.php?app_id=<?php echo urlencode(base64_encode($app_i)); ?>" class="has_link"><input type="button" class = "pointer_n" value="View" style="border-radius: 5px; background-color: #18375f; font-weight: bold;"></a>
</td>
</tr>
<?php
} ?>
</table>

<?php  if ($recordcount > 0) { ?>
<table width="width:90%;margin-left:4%;" border="0" align="right" cellpadding="4" cellspacing="1" class="pagination">
            <tr class="sidemain">
                <td>
                    <?php
					if($page > 1){
            echo "<a class='page gradient' href='index.php?page=1&u_assign=$u_assign&sub_source=$sub_source&insurance=$insurance&promocode=$promocode&source_compign=$source_compign&ref_phone=$ref_phone&case_no=$case_no&app_no=$app_no&from_loan_amount=$from_loan_amount&to_loan_amount=$to_loan_amount&application_status=$application_status&loan_type=$search&name_search=$name_search&phone=$phone&banksearch=$banksearch&pre_status=$pre_statussearch&patnersearch=$patnersearch&crm_id_num=$crm_id_num&city_type=$city_type&date_from=$date_from&date_to=$date_to&bankers_name=$bankers_name&customer_id_search=$customer_id_search&masked_phone=$masked_phone&bank_app_no=$bank_app_no&email_search=$email_search&city_sub_group=$city_sub_group&case_u_assign=$case_u_assign&app_u_assign=$app_u_assign&app_new_status=$app_new_status&sub_status=$sub_status&sub_sub_status=$sub_sub_status&refarming_user_id=$refarming_user_id&fup_date_from=$fup_date_from&fup_date_to=$fup_date_to&fup_user_type=$fup_user_type'>First</a>";
						echo "<a class='page gradient' href='index.php?page=" . ($page - 1) . "&u_assign=$u_assign&sub_source=$sub_source&insurance=$insurance&promocode=$promocode&source_compign=$source_compign&ref_phone=$ref_phone&case_no=$case_no&app_no=$app_no&from_loan_amount=$from_loan_amount&to_loan_amount=$to_loan_amount&application_status=$application_status&loan_type=$search&name_search=$name_search&phone=$phone&banksearch=$banksearch&pre_status=$pre_statussearch&patnersearch=$patnersearch&crm_id_num=$crm_id_num&city_type=$city_type&date_from=$date_from&date_to=$date_to&bankers_name=$bankers_name&customer_id_search=$customer_id_search&masked_phone=$masked_phone&bank_app_no=$bank_app_no&email_search=$email_search&city_sub_group=$city_sub_group&case_u_assign=$case_u_assign&app_u_assign=$app_u_assign&app_new_status=$app_new_status&sub_status=$sub_status&sub_sub_status=$sub_sub_status&refarming_user_id=$refarming_user_id&fup_date_from=$fup_date_from&fup_date_to=$fup_date_to&fup_user_type=$fup_user_type'>Prev</a>";
					}
          echo "<a class='page gradient' href='javascript:void;'>".$page."</a>";
          if($recordcount > $display_count){
                    echo "<a class='page gradient' href='index.php?page=".($page+1) ."&u_assign=$u_assign&sub_source=$sub_source&insurance=$insurance&promocode=$promocode&source_compign=$source_compign&ref_phone=$ref_phone&case_no=$case_no&app_no=$app_no&from_loan_amount=$from_loan_amount&to_loan_amount=$to_loan_amount&application_status=$application_status&loan_type=$search&name_search=$name_search&phone=$phone&banksearch=$banksearch&patnersearch=$patnersearch&crm_id_num=$crm_id_num&pre_status=$pre_statussearch&city_type=$city_type&date_from=$date_from&date_to=$date_to&bankers_name=$bankers_name&customer_id_search=$customer_id_search&masked_phone=$masked_phone&bank_app_no=$bank_app_no&email_search=$email_search&city_sub_group=$city_sub_group&case_u_assign=$case_u_assign&app_u_assign=$app_u_assign&app_new_status=$app_new_status&sub_status=$sub_status&sub_sub_status=$sub_sub_status&refarming_user_id=$refarming_user_id&fup_date_from=$fup_date_from&fup_date_to=$fup_date_to&fup_user_type=$fup_user_type'>Next</a>";
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
<!-- <script>window.onload = opn_subsource();</script> -->
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