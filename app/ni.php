<?php
require_once "../../include/crm-header.php";
if(isset($_REQUEST['case_no'])){
$case_no = replace_special($_REQUEST['case_no']);
}if(isset($_REQUEST['app_no'])){
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
if(isset($_REQUEST['city_type'])){
$city_type  = replace_special($_REQUEST['city_type']);}
if(isset($_REQUEST['pre_statussearch'])){
$pre_statussearch = replace_special($_REQUEST['pre_statussearch']);}
if(isset($_REQUEST['app_statussearch'])){
$app_statussearch = replace_special($_REQUEST['app_statussearch']);}



require_once "../../include/dropdown.php";
include("../../include/display-name-functions.php");
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../../include/css/jquery-ui.css">
<script type="text/javascript" src="../../include/js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="../../include/js/jquery-ui.js"></script>
<script>

$(function() {
    $("#city_type").autocomplete({
		source: "../../include/city_name.php",
		minLength: 2
	});
});

function resetform() {
    window.location.href = "<?php echo $head_url; ?>/sugar/all_query/ni.php";
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
<fieldset><legend>Application Filter</legend>
<form method="post" action="ni.php" name= "searchfrm">
<input type="text" class="text-input" name="app_no" id="app_no" placeholder="Application No" value="<?php echo $app_no;?>" size="8"/>
<input type="text" class="text-input" name="case_no" id="case_no" placeholder="Case No" value="<?php echo $case_no;?>" size="8"/>
<input type="text" class="text-input" name="name_search" id="name_search" placeholder="Name" maxlength="30" value="<?php echo $name_search;?>"/>
    <input type="text" class="text-input" name="phone" id="phone" placeholder="Phone No" value="<?php echo $phone ;?>" maxlength="10"/>
    <?php echo get_textbox('city_type',$city_type,'placeholder ="City Name (Enter few words)"'); ?>
    <input type="text" class="text-input" name="from_loan_amount" id="from_loan_amount" placeholder="From Loan Amount" maxlength="10" value="<?php echo $from_loan_amount;?>"/>
    <input type="text" class="text-input" name="to_loan_amount" id="to_loan_amount" placeholder="To Loan Amount" maxlength="10" value="<?php echo $to_loan_amount;?>"/>
  <?php echo get_dropdown('pre_login','pre_statussearch',$pre_statussearch,'');
  echo get_dropdown('post_login','app_statussearch',$app_statussearch,'');  ?>
	<input type="submit" name="searchsubmit" value="Filter"><input type="button" onclick="resetform()" value="Clear">
</form>
</fieldset>
<?php
$qry_user_qr = mysqli_query($Conn1,"select ring.loan_type as loan_type, GROUP_CONCAT(ring.city_group_id SEPARATOR ',') as city_id from tbl_ringing_assign as ring where ring.not_interested = '".$user."' group by loan_type");
while($res_user_qr = mysqli_fetch_array($qry_user_qr)){
    $loan_type_arr[$res_user_qr['loan_type']] = $res_user_qr['city_id'];
}
?>
<form method = "POST" name="frmmain" action ="mask_assign.php">
<table width="100%" class="gridtable">
<tr>
<th width="7%">Application Date<br> Updated Date</th>
<th width="10%">Case Number & Application No<br> Bank App No.</th>
<th width="10%">Loan Amount & Type</th>
<th width="10%">Name & City</th>
<th width="10%">Mobile </th>
<th width="10%">Assign To</th>
<th width="10%">Partner / Applied Bank</th>
<th width="10%">Application Status</th>
<th width="10%">Action</th>
</tr>
<?php
foreach($loan_type_arr as $loan => $cityyy){
     $new_cityyy = rtrim($cityyy,',');

$qry = "select c.user_id as user_id,c.loan_type as loan_type,app.case_id as case_id,app.app_id as app_id,fb.id as fb_id,app.pre_login_status as pre_login_status,
app.date_created as date_created, app.la_st_up_date as la_st_up_date, post.app_status as app_status,pre.pre_status_name as pre_status_name,c.auto_case_create as auto_case_create,app.login_date_on as login_date_on,app.sanction_date_on as sanction_date_on,app.first_disb_date_on as first_disb_date_on,app.pre_login_status as pre_login_status,app.bank_app_no_on as bank_app_no_on,app.bank_crm_lead_on as bank_crm_lead_on,app.disb_email_flag as disb_email_flag,c.required_loan_amt as required_loan_amt,c.cust_id as cust_id,cust.name as name,cust.phone as phone,city.city_name as city_name,loan.loan_type_name as loan_type_name,user.user_name as user_name,bank.bank_name as bank_name,pat.partner_name as partner_name,app.app_bank_on as app_bank_on,app.app_status_on as app_status_on from tbl_mint_app as app JOIN tbl_mint_case as c ON app.case_id = c.case_id JOIN tbl_mint_customer_info as cust ON c.cust_id = cust.id left join lms_city as city on cust.city_id = city.city_id left join lms_loan_type as loan on c.loan_type = loan.loan_type_id left join tbl_user_assign as user on c.user_id = user.user_id left join tbl_bank as bank on app.app_bank_on = bank.bank_id left join tbl_mlc_partner as pat on app.partner_on = pat.partner_id left join tbl_app_status as post on app.app_status_on = post.app_status_id left join tbl_app_pre_login as pre on app.pre_login_status = pre.pre_status_id left join tbl_application_feed_back as fb on app.app_id = fb.app_id where city.city_sub_group_id IN ($new_cityyy)";

if($from_loan_amount != ""){ $default = 1;
$qry .= " and c.required_loan_amt = '".$from_loan_amount."'";
}
if($from_loan_amount != "" && $to_loan_amount != ""){ $default = 1;
$qry .= " and c.required_loan_amt between '".$from_loan_amount."' and '".$to_loan_amount."'";
}
if($name_search != ""){ $default = 1;
$qry .= " and cust.name = '".$name_search."'";
}
if($phone != ""){ $default = 1;
$qry .= " and cust.phone = '".$phone."'";
}
if($search_city_id != "" && $search_city_id != 0){ $default = 1;
$qry .= " and cust.city_id = '".$search_city_id."'";
}
if($case_no != ""){$default = 1;
$qry .= " and app.case_id = '".$case_no."'";
}
if($app_no != ""){$default = 1;
$qry .= " and app.app_id = '".$app_no."'";
}
if($loan != '' && $loan != '0'){
	$qry .= " and c.loan_type ='".$loan."'";
}
if($app_statussearch != ""){
	$default = 1;
    $qry .= " and app.app_status_on = '".$app_statussearch."'";
}
if($pre_statussearch != ""){
	$default = 1;
    $qry .= " and app.pre_login_status = '".$pre_statussearch."'";
}
if($default !='1'){
	$qry .= " and (app.app_status_on = 10 OR app.pre_login_status = 5) ";
}
$qry .= " order by app.date_created desc limit ".$offset.",".$max_offset;
$res = mysqli_query($Conn1,$qry) or die("Error: ".mysqli_error($Conn1));
$recordcount = mysqli_num_rows($res);

if($recordcount > 0){$record = 0;
while($exe = mysqli_fetch_array($res)){
$record++;
if($record > 10){
	continue;
}
//echo $exe['user_id'];
$case_id = $exe['case_id'];
$app_id  = $exe['app_id'];
$app_status_on  = $exe['app_status_on'];
$cust_id = $exe['cust_id'];
$loan_type = $exe['loan_type'];
$loan_amount = $exe['required_loan_amt'];
$partner_name = $exe['partner_name'];
$app_bank_on = $exe['app_bank_on'];
$bank_app_no_on  = $exe['bank_app_no_on'];
$bank_crm_lead_on  = $exe['bank_crm_lead_on'];
$disb_email_flag  = $exe['disb_email_flag'];
$pre_login_status  = $exe['pre_login_status'];
$name = $exe['name'];
$phone_no = $exe['phone'];
if($user_role == '3'){
    $echo_number = substr_replace($phone_no,'XXX',4,3);
} else {
   $echo_number =  $phone_no;
}

$city_name = $exe['city_name'];
$loan_name = $exe['loan_type_name'];
$assign = $exe['user_name'];
$name_bank_on = $exe['bank_name'];
$auto_case_create = $exe['auto_case_create'];
$name_pre_statuson = $exe['pre_status_name'];
$name_app_statuson = $exe['app_status'];

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
$date_created = $exe['date_created'];
$updated_date = $exe['la_st_up_date'];
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

$val = urlencode(base64_encode($case_id));

$link = "<a href='../app/edit_applicaton.php?case_id=".$val."&cust_id=".urlencode(base64_encode($cust_id))."&loan_type=".$loan_type."&page=".$page."'><span class='orange'>".number_format($loan_amt)."</span><br/>".$loantype_name."</a>";
$data[] = '<tr><td>'.$date_created.'<br><span class="orange">'.$updated_date.'</span></td>

<td><a href = "../cases/edit.php?case_id='.urlencode(base64_encode($case_id)).'">'.$case_id.'</a>
<br/><a href = "../app/edit_applicaton.php?case_id='.urlencode(base64_encode($case_id)).'&cust_id='.urlencode(base64_encode($cust_id)).'
&loan_type='.$loan_type.'&ut=2"><span class="orange">'.$app_id.'</span></a><br>'.$bank_app_no_on.'</td>
<td><span class="orange">'.$loan_amount.'</span><br/>'.$loan_name.'</td>
<td><span class="orange">'.$name.'</span><br/>'.$city_name.'</td>
<td><span class="orange">'.$echo_number.'</span></td>
<td><Span class="orange">'.$assign.'</span></td>
<td>'.$partner_name.' / '.$name_bank_on.'</td>
<td><span class="orange">'.$name_pre_statuson.'</span><br/>'.$name_app_statuson.'</td>
<td><a href="../email/send-email.php?case_id='.urlencode(base64_encode($case_id)).'" style="margin-left:20px;">Send Email</a>
<br><a href="feedback.php?app_id='.base64_encode($app_id).'" style="margin-left:20px;" target="_blank">Feedback</a></td></tr>';
  } }
  echo implode($data);?>
</table>
</form>
<?php if($recordcount > 0){ ?>
<table width="width:90%;margin-left:4%;" border="0" align="center" cellpadding="4" cellspacing="1" class="pagination">
            <tr class="sidemain">
                <td>
<?php
if($page > 1){
echo "<a class='page gradient' href='ni.php?page=1&pre_statussearch=$pre_statussearch&app_statussearch=$app_statussearch&from_loan_amount=$from_loan_amount&to_loan_amount=$to_loan_amount&loan_type=$search&case_no=$case_no&app_no=$app_no&name_search=$name_search&phone=$phone&city_type=$city_type'>First</a>";
echo "<a class='page gradient' href='ni.php?page=" . ($page - 1) . "&pre_statussearch=$pre_statussearch&app_statussearch=$app_statussearch&from_loan_amount=$from_loan_amount&to_loan_amount=$to_loan_amount&loan_type=$search&case_no=$case_no&app_no=$app_no&name_search=$name_search&phone=$phone&city_type=$city_type'>Prev</a>";
}
echo "<a class='page gradient' href='javascript:void;'>".$page."</a>";
if($recordcount > $display_count){
echo "<a class='page gradient' href='ni.php?page=" . ($page + 1) . "&pre_statussearch=$pre_statussearch&app_statussearch=$app_statussearch&from_loan_amount=$from_loan_amount&to_loan_amount=$to_loan_amount&loan_type=$search&case_no=$case_no&app_no=$app_no&name_search=$name_search&phone=$phone&city_type=$city_type'>Next</a>";
}
?></td>
            </tr>
        </table>
<?php }} ?>
</div>
 <?php include("../../include/footer_close.php"); ?>
</body></html>
