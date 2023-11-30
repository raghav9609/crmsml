<?php 
require_once "../../include/crm-header.php";
require_once "../../include/dropdown.php";
include ("../../include/paging_class.php");
$offset = '20';
$display_range = '20';
$page = '1';
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
function selectAll(source) {
		checkboxes = document.getElementsByName('mask[]');
		for(var i in checkboxes)
			checkboxes[i].checked = source.checked;
	}

$(function() {
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
  $('#query').click(function(){
            $('#query_search').show(); 
            $("#assign_to").hide();
          
});
});
function resetform() {
    window.location.href = "https://myloancrm.com/sugar/assign-mlc/lead-assign.php";
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
if($_POST['searchsubmit']){
$user_assign = replace_special($_REQUEST['user_assign']);
$loan_type = replace_special($_REQUEST['loan_type']);
$qry_leads = mysqli_query($Conn1,"select qry.query_id as qry_id, qry.loan_type as loan_type,qry.loan_amt as loan_amt, qry.extng_amt as extng_amt, cust.net_incm as net_incm,cust.city_id as city_id, ctty.city_sub_group_id from tbl_mint_query as qry left JOIN tbl_mint_query_status_detail as sts ON qry.query_id = sts.query_id left JOIN tbl_mint_customer_info as cust ON qry.cust_id = cust.id left JOIN lms_city as ctty ON cust.city_id = ctty.city_id left JOIN lms_city_sub_group as sbgrp ON ctty.city_sub_group_id = sbgrp.city_sub_group_id where qry.loan_type = '".$loan_type."' sts.user_id = '".$user_assign."' and sts.query_status = '11'"); 
while($res = mysqli_fetch_array($qry_leads)){
	$query_id = $res['qry_id'];
	$loan_type = $res['loan_type'];
	$loan_amt = $res['loan_amt'];
	$extng_amt = $res['extng_amt'];
	$net_incm = $res['net_incm'];
	$city_id = $res['city_id'];
	$city_sub_group_id = $res['city_sub_group_id'];

$qry_filtr = "select filter_id,shift_flag from tbl_assign_lead_filter where loan_type = '".$loan_type."' and city_sub_group_id = '".$city_sub_group_id."'";
if($loan_amt != ''){
	$qry_filtr .= " and min_loan_amt <= '".$loan_amt."' and max_loan_amt >= '".$loan_amt."'";
}
if($net_incm != ''){
	$qry_filtr .=  " and min_salary <= '".$net_incm."' and max_salary >= '".$net_incm."'";	
}
 $qry_filtr;
$res_filter = mysqli_query($Conn1,$qry_filtr);
$result_filter = mysqli_fetch_array($res_filter);
$qry_use = mysqli_query($Conn1,"select user_id,assign_id from tbl_assign_user_query_filter where filter_id='".$result_filter['filter_id']."' and avail_flag <> 0 and shift_flag = '".$result_filter['shift_flag']."' and user_id NOT IN (0,".$_REQUEST['user_assign'].") order by update_assign limit 1");
$res_use = mysqli_fetch_array($qry_use);
$user_id = $res_use['user_id'];
if($user_id > 0){
	$qry_up = mysqli_query($Conn1,"Update tbl_mint_query_status_detail set user_id='".$user_id."' where query_id=".$query_id."");	
	$qry_aup = mysqli_query($Conn1,"Update tbl_assign_user_query_filter set update_assign = NOW() where assign_id='".$res_use['assign_id']."'");	
	$message = '<span class="green">Assign Successfully</span>';
} else {
	$message = '<span class="red">No User Available</span>';
}
}
}
?>
<fieldset><legend>Assign Filter</legend>
<?php echo $message;?>
<form method="post" action="index.php" name= "searchfrm">
<tr>
<td><?php echo get_dropdown('user_assign','user_assign',$user_assign,'required');?></td>
<td><?php echo get_dropdown('loan_type','loan_type',$loan_type,'required');?></td>
 <td>                  
<input type="submit" name="searchsubmit" value="SUBMIT">   </td>                                                 
<td> <input type="button" onclick="resetform()" value="Clear">
</td></tr>                                    
</form>
</fieldset>
<table width="100%" class="gridtable">
<form method = "post" name="frmmain" action ="mask_assign.php"> 
</form>
</table>
                         
</div>
 <?php include("../../include/footer_close.php"); 
?>	
</body></html>
         
        