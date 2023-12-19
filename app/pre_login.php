<?php
header("location:".$head_url."/sugar/app/index.php");
$slave = 1;
require_once "../../include/crm-header.php";
require_once "../../include/dropdown.php";
if($_SESSION['one_lead_flag'] == 1  && $_SESSION['sme_flag'] != 1){
    header("/../../logout.php");
    die();
}
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
	window.location.href="pre_login.php";
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
$case_no = replace_special($_REQUEST['case_no']);
}if(isset($_REQUEST['app_no'])){
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
if(isset($_REQUEST['email_search'])) {
    $email_search = replace_special($_REQUEST['email_search']);
}

if(isset($_REQUEST['city_sub_group'])) {
    $city_sub_group = $_REQUEST['city_sub_group'];
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

$qry_e = "SELECT c.loan_type as loan_type,app.case_id as case_id,app.app_id as app_id,fb.id as fb_id,app.pre_login_status as pre_login_status,post.app_status as app_status,pre.pre_status_name as pre_status_name,c.auto_case_create as auto_case_create,app.login_date_on as login_date_on,app.sanction_date_on as sanction_date_on,app.first_disb_date_on as first_disb_date_on,app.pre_login_status as pre_login_status,app.bank_app_no_on as bank_app_no_on,app.bank_crm_lead_on as bank_crm_lead_on,app.disb_email_flag as disb_email_flag,c.required_loan_amt as required_loan_amt,c.cust_id as cust_id,cust.name as name,cust.phone as phone,city.city_name as city_name,loan.loan_type_name as loan_type_name,
user.user_name as user_name,bank.bank_name as bank_name,pat.partner_name as partner_name,app.app_bank_on as app_bank_on,app.app_status_on as app_status_on, app.date_created as date_created, app_user.user_name as app_user_name from tbl_mint_app as app JOIN tbl_mint_case as c ON app.case_id = c.case_id JOIN tbl_mint_customer_info as cust ON c.cust_id = cust.id left join lms_city as city on cust.city_id = city.city_id left join lms_loan_type as loan on c.loan_type = loan.loan_type_id left join tbl_user_assign as user on c.user_id = user.user_id left join tbl_bank as bank on app.app_bank_on = bank.bank_id left join tbl_mlc_partner as pat on app.partner_on = pat.partner_id left join tbl_app_status as post on app.app_status_on = post.app_status_id left join tbl_app_pre_login as pre on app.pre_login_status = pre.pre_status_id left join tbl_application_feed_back as fb on app.app_id = fb.app_id LEFT JOIN tbl_user_assign AS app_user ON app_user.user_id = app.app_created_by ";
if(trim($bankers_name) != "") {
    $qry_e .= " INNER JOIN banker_email_history on banker_email_history.case_id = c.case_id INNER JOIN banker_sms_history on banker_sms_history.case_id = c.case_id ";
}
$qry_e .= " where 1 ";
if($user_role == 2 || $user_role == 4 || $user_role == 9){
$qry_e .= " and c.loan_type IN ($tl_loan_type)";
}else if($user_role == 3){
$qry_e .= " and (c.user_id = '".$user."' OR app.refarming_user_id = '".$user."')";
}if($user_role == 2){
	if($sme_city_sub_group != ''){
		$qry_e .= " and (city.city_sub_group_id IN ($sme_city_sub_group) or c.user_id IN ($tl_member)) ";
	}else if($tl_member !=''){
		$qry_e .= " and c.user_id IN ($tl_member)";
	}
}
// if($u_assign != "" && $user_role != 3){$default = 1;
// $qry_e .= " and c.user_id = '".$u_assign."'";
// }
if($case_u_assign != "" && $user_role != 3) {
    $default = 1;
    $qry_e .= " and c.user_id = '".$case_u_assign."'";
}
if($app_u_assign != "" && $user_role != 3) {
    $default = 1;
    $qry_e .= " and app.app_created_by = '".$app_u_assign."'";
}
if($case_no != ""){$default = 1;
$qry_e .= " and app.case_id = '".$case_no."'";
}
if($app_no != ""){$default = 1;
$qry_e .= " and app.app_id = '".$app_no."'";
}if($search != "" && $user_role != 2){$default = 1;
$qry_e .= " and c.loan_type = '".$search."'";
}if($from_loan_amount != ""){$default = 1;
$qry_e .= " and c.required_loan_amt = '".$from_loan_amount."'";
}if($from_loan_amount != "" && $to_loan_amount != ""){$default = 1;
$qry_e .= " and c.required_loan_amt between '".$from_loan_amount."' and '".$to_loan_amount."'";
}if($name_search != ""){$default = 1;
$qry_e .= " and cust.name like '%".$name_search."%'";
}if($phone != ""){$default = 1;
$qry_e .= " and cust.phone = '".$phone."'";
}

if($loan_nature != "") {
    $qry_e .= " and c.loan_nature = '".$loan_nature."'";
}
if(trim($bankers_name) != "") {
    $default = 1;
    $qry_e .= " and ( banker_email_history.banker_name = '".$bankers_name."' OR banker_sms_history.banker_name = '".$bankers_name."' ) ";
}
if($customer_id_search != "") {
    $default = 1;
    $qry_e .= " and cust.id = $customer_id_search ";
}
if($masked_phone != "") {
    $default = 1;
    if(strpos($masked_phone, 'XXX') !== false) {
        $initial = explode("XXX", $masked_phone);
        if(strlen($initial[0]) == 4 && strlen($initial[1]) == 3) {
            $qry_e .= " and phone LIKE '".$initial[0]."___".$initial[1]."'";
        }
    }
}
if(trim($bank_app_no) != "") {
    $qry_e .= " AND app.bank_app_no_on = '".$bank_app_no."' ";
}
if(trim($email_search) != "") {
    $qry_e .= " AND cust.email = '".trim($email_search)."' ";
}
if($city_sub_group != '' && $city_sub_group != '0') {
    $default = 1;
    $qry_e .= " and city.city_sub_group_id = '" . $city_sub_group . "'";
}
if($banksearch != ""){$default = 1;
$qry_e .= " and app.app_bank_on = '".$banksearch."'";
}else if($user_role == 6 && $banksearch == ""){
	$qry_e .= " and app.app_bank_on IN (".implode(',',array_filter($bank_rm_id)).")";
}if($search_city_id != "" && $search_city_id != 0){$default = 1;
$qry_e .= " and cust.city_id = '".$search_city_id."'";
}
if($patnersearch != ""){$default = 1;
$qry_e .= " and app.partner_on = '".$patnersearch."'";
}if($pre_statussearch != ""){$default = 1;
$qry_e .= " and app.pre_login_status = '".$pre_statussearch."'";
}

if($crm_id_num != '' && $crm_id_num !='0'){
	$default = 1;
	$qry_e .= " and app.bank_crm_lead_on = '".$crm_id_num."'";
}

if($date_from != "" && $date_to != "" && $date_from != "0000-00-00" && $date_to != "0000-00-00"){$default = 1;
        $qry_e .= " and app.date_created between '".$date_from."' and '".$date_to."'";
} if($source_compign != "") {
    $qry_e_join .= " left JOIN tbl_mint_case_query_mapping as q_map ON c.case_id = q_map.case_id left JOIN tbl_mint_query as qry ON q_map.query_id = qry.query_id ";
     $default = 1;
if($source_compign == 'ref_campaign'){
 $qry_e .= " and qry.refer_form_type = '2'";
} else {
 $qry_e .= " and qry.page_url like '%".$source_used."%'";
} }
if ($sub_source != "") {
    $default = 1;
$qry_e .= " and qry.page_url like '%".$sub_source."%'";
}
if($insurance != ''){
    $default = 1;
	$qry_e .= " and qry.page_url like '%".$insurance."%'";
}
if($promo != '' || $ref_phone != ''){
     $default = 1;
     $qry_e_join .= " left JOIN tbl_mint_partner_info as pat ON qry.ref_mobile=pat.partner_id ";
     if($ref_phone != ''){
         $qry_e .= " and pat.phone = '".$ref_phone."'";
     } else {
	    $qry_e .= " and pat.promocode = '".$promo."'";
     }
} else if($default != '1'){
     $qry_e .= " and app.date_created between DATE_SUB(CURDATE(), INTERVAL 5 DAY) and CURDATE() ";
}
$qry_e .= " and app.app_status_on = 8 group by app.app_id order by app.date_created desc limit ".$offset.",".$max_offset;
?>
<fieldset><legend>Application Filter</legend>
<form method="post" action="pre_login.php" name="searchfrm" autocomplete="off">
<input type="text" class="text-input" name="app_no" id="app_no" maxlength="20" placeholder="Application No" value="<?php echo $app_no;?>"/>
<input type="text" class="text-input" name="case_no" id="case_no" placeholder="Case No" value="<?php echo $case_no;?>" size="8"/>
<input type="text" class="text-input" name="name_search" id="name_search" placeholder="Name" value="<?php echo name_title_case($name_search);?>" size="7"/>
<?php if($user_role != 2){ ?><input type="text" class="text-input" name="phone" id="phone" placeholder="Phone No" value="<?php echo $phone;?>" size="8"/> <?php } ?>
<input type="text" class="text-input" name="from_loan_amount" id="from_loan_amount" placeholder="From Loan Amount" value="<?php echo $from_loan_amount;?>" size="8"/>
<input type="text" class="text-input" name="to_loan_amount" id="to_loan_amount" placeholder="To Loan Amount" value="<?php echo $to_loan_amount;?>" size="8"/>
<?php echo get_textbox('city_type',$city_type,'placeholder ="City Name (Enter few words)"'); ?>
<?php echo get_dropdown('loan_type','loan_type',$search,''); ?>
<?php echo get_dropdown('app_pat_list','patnersearch',$patnersearch,''); ?>
<input type="text" class="text-input" name="crm_id_num" id="crm_id_num" placeholder="Bank CRM ID" value="<?php echo $crm_id_num;?>"/>
<input type="text" class="text-input" name="date_from" id="date_from" placeholder="Date From" value="<?php echo $date_from;?>" maxlength="10" readonly="readonly"/>
<input type="text" class="text-input" name="date_to" id="date_to" placeholder="Date To" value="<?php echo $date_to;?>" maxlength="10" readonly="readonly"/>
 <?php if($user_role != 6){
	echo get_dropdown('bank_name_','banksearch',$banksearch,'');
}else{ ?>
	<td><select name="banksearch" id="banksearch">
                    <option value="">Select Bank</option>
                <?php $bnk_cnt=0;foreach($bank_rm_id as $bnk){ ?>
                    <option value="<?php echo $bnk;?>"<?php if( $bnk == $banksearch){?>selected="selected"<?php }?>><?php echo  $bank_rm_name[$bnk_cnt];?></option>
                    <?php $bnk_cnt++; }?>
                  </select></td>
<?php } echo get_dropdown('pre_login','pre_status',$pre_statussearch,'');
if($user_role != 3) {
    // echo get_dropdown('user_assign','u_assign',$u_assign,'');
    echo get_dropdown('case_user', 'case_u_assign', $case_u_assign, '');
    echo get_dropdown('app_user', 'app_u_assign', $app_u_assign, '');
}
if($user_role == '1' || $user_role == '4'){?>
<select name="source_compign" id="source_compign" onchange="opn_subsource();"><option value="">Campaign Source</option>
<?php $qry_camp = mysqli_query($Conn1,"select * from campaign");
while($res_camp = mysqli_fetch_array($qry_camp)){?>
<option value="<?php echo $res_camp['campaign_val'];?>" <?php if($res_camp['campaign_val'] == $source_compign){?>selected <?php } ?>><?php echo $res_camp['campaign_name'];?></option>
<?php } ?>
</select>
<span id="sub"></span>	<?php } ?>

<?php
if($user_role == 6 || $user_role == 1) {
    echo get_dropdown('loan_nature', 'loan_nature', $loan_nature, '');
}
?>
<?php echo get_textbox('bankers_name', $bankers_name, 'placeholder ="Bankers Name (Enter few words)"'); ?>
<input type="text" class="text-input" name="customer_id_search" id="customer_id_search" placeholder="Customer ID" maxlength="30" value="<?php echo $customer_id_search;?>"/>
<input type="text" class="text-input" name="masked_phone" id="masked_phone" placeholder="Masked Phone No." value="<?php echo $masked_phone ;?>" maxlength="10"/>
<input type="text" class="text-input alpha-num-hyphen" name="bank_app_no" id="bank_app_no" placeholder="Bank Application No." value="<?php echo $bank_app_no; ?>" maxlength="20"/>
<input type="text" class="text-input" name="email_search" id="email_search" placeholder="Customer Email" value="<?php echo $email_search;?>" maxlength="100" autocomplete="null"/>
<?php echo get_dropdown('city_sub_group', 'city_sub_group', $city_sub_group, ''); ?>
<input type="submit" name="searchsubmit" value="Filter"><input type="button" onclick="resetform()" value="Clear">
</form>
</fieldset>
<table width="100%" class="gridtable">
<form method = "post" name="frmmain" action ="mask_assign.php">
<tr>
<?php if($_SESSION['assign_access_lead'] == 1){?><th width="5%"><div><input type ="checkbox" name ="selectAll[]" id="selectAll">Select</div></th><?php } ?>
<th width="10%">Case Number & Application No<br> Bank App No.</th>
<th width="10%">Name & Mobile & City</th>
<th width="10%">Loan amount & Loan Type</th>
<th width="10%">Partner</th>
<th width="10%">Bank Name</th>
<th width="10%">Pre Login /<br> Post Login Status</th>
<?php if($user_role != 3) { ?><th width="10%">Case User</th><?php } ?>
<?php if($user_role != 3) { ?><th width="10%">Application Created By</th><?php } ?>
<th width="10%">Action</th>
<th width="6%">View</th>
</tr>
<?php
$res = mysqli_query($Conn1,$qry_e) or die("Error: ".mysqli_error($Conn1));
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
$cust_id = $exe['cust_id'];
$loan_type = $exe['loan_type'];
$loan_amount = ($exe['required_loan_amt'] > 0) ? custom_money_format($exe['required_loan_amt']) : "";
$partner_name = $exe['partner_name'];
$app_bank_on = $exe['app_bank_on'];
$bank_app_no_on  = $exe['bank_app_no_on'];
$bank_crm_lead_on  = $exe['bank_crm_lead_on'];
$disb_email_flag  = $exe['disb_email_flag'];
$pre_login_status  = $exe['pre_login_status'];
$name = $exe['name'];
$phone_no = $exe['phone'];
if($user_role != '1'){
    $echo_number = substr_replace($phone_no,'XXX',4,3);
    // $echo_number = "";
} else {
   $echo_number =  $phone_no;
}

$city_name = ($exe['city_name'] != "") ? "(".$exe['city_name'].")" : "";
$loan_name = ($exe['loan_type_name'] != "") ? "(".$exe['loan_type_name'].")" : "";
$assign = $exe['user_name'];
$name_bank_on = $exe['bank_name'];
$auto_case_create = $exe['auto_case_create'];
$name_pre_statuson = $exe['pre_status_name'];
$name_app_statuson = $exe['app_status'];
$app_user_name        = $exe['app_user_name'];

$date_created = ($exe['date_created'] != '' && $exe['date_created'] != "1970-01-01" && $exe['date_created'] != "0000-00-00") ? "(".date("d-m-Y", strtotime($exe['date_created'])).")" : "--";

if($app_status_on == 3){
$app_st_date = $exe['login_date_on'];
}
else if($app_status_on == 5){
$app_st_date = $exe['sanction_date_on'];
}
else if($app_status_on == 6 || $app_status_on == 7){
$app_st_date = $exe['first_disb_date_on'];
}
else{
$app_st_date = "";
}
if($pre_login_status=='2' || $pre_login_status=='6' || $pre_login_status=='7'){
	$pre_color='style="color:#22610F"';
}else if ($pre_login_status=='10' || $pre_login_status=='1' ){
   $pre_color='style="color: #FFA500;"';
}else{
    $pre_color='style="color: #DA0808;"';
}

if($app_status_on=='3' || $app_status_on=='5' || $app_status_on=='6' || $app_status_on=='7'){
   $post_color='style="color:#22610F"';
 }else if ($app_status_on=='4' )
{
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
/* $qry_feedback_count = mysqli_query($Conn1,"select count(*) as count from tbl_application_feed_back where app_id = '".$app_id."'");
$res_feedback_count = mysqli_fetch_array($qry_feedback_count); */
?>
<tr>
<?php if($_SESSION['assign_access_lead'] == 1){?>
<td><input type='hidden' name='url' value='<?php echo 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/pre_login.php';?>'/>
<input type ="checkbox" name ="mask[]" id="<?php echo urlencode(base64_encode($case_id)); ?>" value ="<?php echo $case_id;?>"</td> <?php } ?>
<td><input type='hidden' name='applcation_id_<?php echo $case_id;?>' value='<?php echo base64_encode($app_id);?>'>
<a href = "../cases/edit.php?case_id=<?php echo urlencode(base64_encode($case_id)) ;?>" class="has_link"><?php echo $case_id;?></a><br/>
<a href = "edit_applicaton.php?case_id=<?php echo urlencode(base64_encode($case_id)) ;?>&app_id=<?php echo urlencode(base64_encode($app_id)); ?>&cust_id=<?php echo urlencode(base64_encode($cust_id));?>&loan_type=<?php echo $loan_type;?>" class="has_link"><span><?php echo $app_id;?></span></a><br><?php echo $bank_app_no_on; ?><br><?php echo $date_created; ?></td>
<td><span><?php echo substr(ucwords(strtolower($name)), 0, 20)."</span><br/>".$echo_number."<br/><span class='fs-12'>".$city_name;?></span></td>
<td><span><?php echo $loan_amount;?></span><br/><span class="fs-12"><?php echo $loan_name;?></span></td>
<td><?php echo $partner_name;?></td>
<td><?php echo $name_bank_on."<br>"; if($count_status > 0){$result_status = mysqli_fetch_array($get_status); echo " <span class='fs-12'>(".$result_status['status']." ".$result_status['description'].")</span>"; }?></td>
<td><?php echo "<span>".$name_pre_statuson."</span>/<br><span>".$name_app_statuson."</span>"; if($auto_case_create == 1){ echo "<br><span class='fs-12'> (Auto)</span>" ; } ?><br><?php echo $app_st_date;?></td>
<?php if($user_role != 3) { ?><td><input type='hidden' name='assign_from_user_<?php echo $case_id;?>' value='<?php echo $assign;?>'><?php echo $assign;?></td><?php } ?>
<?php if($user_role != 3) { ?><td><input type='hidden' name='app_created_by_<?php echo $app_id;?>' value='<?php echo $app_user_name; ?>'><?php echo $app_user_name; ?></td><?php } ?>
<td class="align-center"><a href="../email/send-email.php?case_id=<?php echo urlencode(base64_encode($case_id));?>" class="has_link">Send Email</a>
<br><a href="feedback.php?app_id=<?php echo base64_encode($app_id);?>" target='_blank' class="has_link">Feedback</a>
<?php if($exe['fb_id'] > 0){ ?><span class="green"><b> (&#10003;)</b></span><?php } ?>
<?php  if((($app_bank_on == 29 && $loan_type == 56) || ($app_bank_on == 40 && $loan_type == 71) || ($app_bank_on == 81 && $loan_type == 56) || $app_bank_on == 18)  && ($bank_crm_lead_on != '' || $bank_app_no_on != '')){?><br>
<a href="../lead/auto_insert/check-api-status.php?app_id=<?php echo base64_encode($app_id);?>&prospectno=<?php echo base64_encode($bank_crm_lead_on); ?>&case_id=<?php echo base64_encode($case_id);?>&bank_app_no=<?php echo base64_encode($bank_app_no_on);?>&bnk=<?php echo base64_encode($app_bank_on); ?>&loan_type=<?php echo base64_encode($loan_type); ?>" class="has_link">Check Status</a><br><?php } ?>
</br>
<?php if($disb_email_flag == 1){
    echo "<span class='fs-12'>(Disb. mail <span class='green'> &#10003;</span>)</span><br>";
} ?>
</td>
<td>
    <a href="edit_applicaton.php?case_id=<?php echo urlencode(base64_encode($case_id)) ;?>&app_id=<?php echo urlencode(base64_encode($app_id)); ?>&cust_id=<?php echo urlencode(base64_encode($cust_id));?>&loan_type=<?php echo $loan_type;?>" class="has_link"><input type="button" class = "pointer_n" value="View" style="border-radius: 5px; background-color: #18375f; font-weight: bold;"></a>
</td>
</tr>
<?php } ?>
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
              echo "<a class='page gradient' href='pre_login.php?page=1&u_assign=$u_assign&sub_source=$sub_source&insurance=$insurance&promocode=$promocode&source_compign=$source_compign&ref_phone=$ref_phone&case_no=$case_no&app_no=$app_no&from_loan_amount=$from_loan_amount&to_loan_amount=$to_loan_amount&app_statussearch=8&loan_type=$search&name_search=$name_search&phone=$phone&banksearch=$banksearch&pre_status=$pre_statussearch&patnersearch=$patnersearch&crm_id_num=$crm_id_num&city_type=$city_type&date_from=$date_from&date_to=$date_to&bankers_name=$bankers_name&customer_id_search=$customer_id_search&masked_phone=$masked_phone&bank_app_no=$bank_app_no&email_search=$email_search&city_sub_group=$city_sub_group&case_u_assign=$case_u_assign&app_u_assign=$app_u_assign'>First</a>";
						echo "<a class='page gradient' href='pre_login.php?page=" . ($page - 1) . "&u_assign=$u_assign&sub_source=$sub_source&insurance=$insurance&promocode=$promocode&source_compign=$source_compign&ref_phone=$ref_phone&case_no=$case_no&app_no=$app_no&from_loan_amount=$from_loan_amount&to_loan_amount=$to_loan_amount&app_statussearch=8&loan_type=$search&name_search=$name_search&phone=$phone&banksearch=$banksearch&pre_status=$pre_statussearch&patnersearch=$patnersearch&crm_id_num=$crm_id_num&city_type=$city_type&date_from=$date_from&date_to=$date_to&bankers_name=$bankers_name&customer_id_search=$customer_id_search&masked_phone=$masked_phone&bank_app_no=$bank_app_no&email_search=$email_search&city_sub_group=$city_sub_group&case_u_assign=$case_u_assign&app_u_assign=$app_u_assign'>Prev</a>";
					}

                    echo "<a class='page gradient' href='javascript:void;'>".$page."</a>";
                    if($recordcount > $display_count){
                        echo "<a class='page gradient' href='pre_login.php?page=" . ($page+ 1) . "&u_assign=$u_assign&sub_source=$sub_source&insurance=$insurance&promocode=$promocode&source_compign=$source_compign&ref_phone=$ref_phone&case_no=$case_no&app_no=$app_no&from_loan_amount=$from_loan_amount&to_loan_amount=$to_loan_amount&app_statussearch=8&loan_type=$search&name_search=$name_search&phone=$phone&banksearch=$banksearch&patnersearch=$patnersearch&crm_id_num=$crm_id_num&pre_status=$pre_statussearch&city_type=$city_type&date_from=$date_from&date_to=$date_to&bankers_name=$bankers_name&customer_id_search=$customer_id_search&masked_phone=$masked_phone&bank_app_no=$bank_app_no&email_search=$email_search&city_sub_group=$city_sub_group&case_u_assign=$case_u_assign&app_u_assign=$app_u_assign'>Next</a>";}
                    ?></td>
            </tr>
        </table>
       <?php echo implode($script); ?>   </div>
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
<?php  }} include("../../include/footer_close.php");   ?>
<script>window.onload = opn_subsource();</script>
<script>
$("#app_no, #case_no, #phone, #from_loan_amount, #to_loan_amount, #customer_id_search").bind('keypress', function(evt) {
    if (evt.which > 31 && (evt.which < 48 || evt.which > 57)) {
        evt.preventDefault();
    }
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