<?php 
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
  $('#query').click(function(){
            $('#query_search').show(); 
            $("#assign_to").hide();
          
});
  });
  
function resetform() {
window.location.href = "customer-feedback.php";	
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
if(isset($_REQUEST['case_no'])){   
$case_no = replace_special($_REQUEST['case_no']);}
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
if(isset($_REQUEST['date_from'])){  
$date_from = replace_special($_REQUEST['date_from']);}
if(isset($_REQUEST['date_to'])){  
$date_to = replace_special($_REQUEST['date_to']);}
$qry = "select fb.user_id as user_id,feed_follow.follow_up_name as follow_up_name, fb.follow_up as follow_up, fb.follow_up_date as follow_up_date, fb.follow_up_time as follow_up_time,fb.follow_up_date_connector as follow_up_date_connector,fb.follow_up_time_connector as follow_up_time_connector,conattmt.connector_response as connector_response,fb.id as fb_id,city.city_name as city_name,cust.phone as phone,cust.name as name,cust.lname as lname,app.case_id as case_id,app.app_id as app_id,bank.bank_name as bank_name,app.app_status_on as app_status_on,c.cust_id as cust_id,user.user_name as user_name,loan.loan_type_name as loan_type_name,c.user_id as cuser_id,c.required_loan_amt as required_loan_amt,app.disb_email_flag as disb_email_flag,app.first_disb_date_on as first_disb_date_on,app_s.app_status as app_status from tbl_mint_app as app JOIN tbl_mint_case as c ON app.case_id = c.case_id JOIN tbl_mint_customer_info as cust ON c.cust_id = cust.id left join lms_loan_type as loan on c.loan_type = loan.loan_type_id left join tbl_bank as bank on app.app_bank_on = bank.bank_id left join tbl_app_status as app_s on app.app_status_on = app_s.app_status_id left join lms_city as city on cust.city_id = city.city_id left join tbl_application_feed_back as fb on app.app_id = fb.app_id left JOIN tbl_feedback_followup as feed_follow ON fb.follow_up = feed_follow.id left JOIN tbl_connector_attempts as conattmt ON fb.connector_attempt = conattmt.id left join tbl_user_assign as user on fb.user_id = user.user_id where 1";
if($u_assign != ""){
    $default = 1;
    $qry .= " and fb.user_id = '".$u_assign."'";
}
if($case_no != ""){
    $default = 1;
    $qry .= " and app.case_id = '".$case_no."'";
}
if($app_no != ""){$default = 1;
    $qry .= " and app.app_id = '".$app_no."'";
}if($search != ""){$default = 1;
    $qry .= " and c.loan_type = '".$search."'";
}if($from_loan_amount != "" && $to_loan_amount != ""){
    $default = 1;
        $qry .= " and app.disbursed_amount_on between '".$from_loan_amount."' and '".$to_loan_amount."'";
}
if($name_search != ""){
    $default = 1;
    $qry .= " and cust.name = '".$name_search."'";
}if($phone != ""){
    $default = 1;
    $qry .= " and cust.phone = '".$phone."'";
}
if($banksearch != ""){$default = 1;
    $qry .= " and app.app_bank_on = '".$banksearch."'";
}else if($user_role == 6 && $banksearch == ""){
	$qry .= " and app.app_bank_on IN (".implode(',',array_filter($bank_rm_id)).")";
}if($search_city_id != "" && $search_city_id != 0){$default = 1;
    $qry .= " and cust.city_id = '".$search_city_id."'";
}

$qry .= " and app.app_status_on IN (6,7)";

if($date_from != "" && $date_to != "" && $date_from != "0000-00-00" && $date_to != "0000-00-00"){
	$default = 1;
        $qry .= " and app.first_disb_date_on between '".$date_from."' and '".$date_to."'";
   
}
$qry .= " order by app.date_created desc limit ".$offset.",".$max_offset;
?>
<fieldset><legend>Application Filter</legend>
<form method="post" action="customer-feedback.php" name="searchfrm">
<input type="text" class="text-input" name="app_no" id="app_no" placeholder="Application No" value="<?php echo $app_no;?>" maxlength="15"/>
<input type="text" class="text-input" name="case_no" id="case_no" placeholder="Case No" value="<?php echo $case_no;?>" maxlength="15"/>
<input type="text" class="text-input" name="name_search" id="name_search" placeholder="Name" value="<?php echo $name_search;?>" maxlength="30"/>
<?php if($user_role != 2){ ?><input type="text" class="text-input" name="phone" id="phone" placeholder="Phone No" value="<?php echo $phone;?>" maxlength="10"/><?php } ?>
<input type="text" class="text-input" name="from_loan_amount" id="from_loan_amount" placeholder="From Loan Amount" value="<?php echo $from_loan_amount;?>" maxlength="10"/>
<input type="text" class="text-input" name="to_loan_amount" id="to_loan_amount" placeholder="To Loan Amount" value="<?php echo $to_loan_amount;?>" maxlength="10"/>
<?php echo get_textbox('city_type',$city_type,'placeholder ="City Name (Enter few words)"'); ?>
<input type="text" class="text-input" name="date_from" id="date_from" placeholder="Date From" value="<?php echo $date_from;?>" maxlength="10"/>
<input type="text" class="text-input" name="date_to" id="date_to" placeholder="Date To" value="<?php echo $date_to;?>" maxlength="10"/>
<?php echo get_dropdown('loan_type','loan_type',$search,''); 
if($user_role != 3) {  echo get_dropdown('user_assign','u_assign',$u_assign,''); }  
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
<input type="submit" name="searchsubmit" value="Filter">                                                 
<input type="submit" onclick="resetform()" value="Clear">
</td></tr></table>                                    
</form>
</fieldset>
<table width="100%" class="gridtable">
 <form method = "post" name="frmmain" action ="mask_assign.php"> 
<tr>
<?php if($_SESSION['assign_access_lead'] == 1){?><th width="5%"><div><input type ="checkbox" name ="selectAll[]" id="selectAll">Select</div></th><?php } ?>
<th width="10%">Case Number & Application No</th>
<th width="10%">Name & Mobile & City</th>
<th width="10%">Loan amount & Loan Type</th>
<th width="10%">Bank Name/ <br>Post Login Status</th>
<th width="10%">Connector FUP Date<br> Time</th>
<th width="10%">Follow Up Status</th>
<?php if($user_role != 3) { ?><th width="10%">Assigned</th><?php } ?>
<th width="10%">Follow Up User</th>
<th width="10%">Action</th>
</tr>
<?php
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
$cust_id = $exe['cust_id'];
$loan_type = $exe['loan_type'];
$loan_amount = $exe['required_loan_amt'];
$disb_email_flag  = $exe['disb_email_flag'];
$name_bank_on = $exe['bank_name'];
$loan_name = $exe['loan_type_name'];
$assign = $exe['user_name'];
$name_app_statuson = $exe['app_status'];
$name = $exe['name'];
$lname = $exe['lname'];
$phone_no = $exe['phone'];
$case_assign_to = get_display_name('mlc_user_name',$exe['cuser_id']);

if($user_role == '3'){
    $echo_number = substr_replace($phone_no,'XXX',4,3);
} else {
   $echo_number =  $phone_no;
}
$city_name = $exe['city_name'];
$app_bank_on  = $exe['app_bank_on'];
$app_st_date = $exe['first_disb_date_on'];
$post_color='style="color:#22610F"';
$script[]='<script type="text/javascript">
$("#'.urlencode(base64_encode($case_id)).'").change(function(){ 
if ($(this).not(":checked")) { 
            $("#selectAll").removeAttr("checked");
    }
});
</script>';
?>
<tr>
<?php if($_SESSION['assign_access_lead'] == 1){?><td><input type='hidden' name='url' value='<?php echo 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/customer-feedback.php';?>'/>
<input type ="checkbox" name ="mask[]" id="<?php echo urlencode(base64_encode($case_id)); ?>" value ="<?php echo $case_id;?>"</td><?php } ?>
<td><a href = "../cases/edit.php?case_id=<?php echo urlencode(base64_encode($case_id)) ;?>"><?php echo $case_id;?></a><br/><a href = "edit_applicaton.php?case_id=<?php echo urlencode(base64_encode($case_id)) ;?>&cust_id=<?php echo urlencode(base64_encode($cust_id));?>&loan_type=<?php echo $loan_type;?>"><span class="orange"><?php echo $app_id;?></span></a></td>
<td><span class="orange"><?php echo $name." ".$lname."</span><br/>".$echo_number."<br/><span class='orange'>".$city_name;?></span></td>
<td><span class="orange"><?php echo $loan_amount;?></span><br/><?php echo $loan_name;?></td>
<td><?php echo $name_bank_on."<br><span ".$post_color.">".$name_app_statuson."</span>";?><br><?php echo $app_st_date;?></td>
<td><?php echo $exe['follow_up_date_connector']."<br>".$exe['follow_up_time_connector'];?></td>
<td><?php echo $exe['follow_up_name'];?><br> 
<?php if($exe['follow_up'] != '' && $exe['follow_up'] != '0'){ echo date("d-m-Y", strtotime($exe['follow_up_date'])).' '.date("g:i a", strtotime($exe['follow_up_time'])); } ?></td>
<?php if($user_role != 3) { ?><td><?php echo $case_assign_to;?></td><?php } ?>
<td><?php echo $assign;?></td>
<td><a href="../email/send-email.php?case_id=<?php echo urlencode(base64_encode($case_id));?>" style="margin-left:20px;">Send Email</a></br>
<a href="feedback.php?app_id=<?php echo base64_encode($app_id);?>" style="margin-left:20px;" target='_blank'>Feedback</a>
<?php if($exe['fb_id'] > 0){ ?><span class="green"><b> (&#10003;)</b></span><?php } ?></br>
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
<?php } ?>
<?php if ($recordcount > $display_count) { ?>
<table width="width:90%;margin-left:4%;" border="0" align="center" cellpadding="4" cellspacing="1" class="pagination">
            <tr class="sidemain">
                <td>
                    <?php
echo "<a class='page gradient' href='customer-feedback.php?page=1&u_assign=$u_assign&case_no=$case_no&app_no=$app_no&from_loan_amount=$from_loan_amount&to_loan_amount=$to_loan_amount&loan_type=$search&name_search=$name_search&phone=$phone&banksearch=$banksearch&city_type=$city_type&date_from=$date_from&date_to=$date_to'>First</a>";
if($page > 1){							 
echo "<a class='page gradient' href='customer-feedback.php?page=" . ($page -1) . "&u_assign=$u_assign&case_no=$case_no&app_no=$app_no&from_loan_amount=$from_loan_amount&to_loan_amount=$to_loan_amount&loan_type=$search&name_search=$name_search&phone=$phone&banksearch=$banksearch&city_type=$city_type&date_from=$date_from&date_to=$date_to'>Prev</a>";
}
echo "<a class='page gradient' href='customer-feedback.php?page=" . ($page +1) . "&u_assign=$u_assign&case_no=$case_no&app_no=$app_no&from_loan_amount=$from_loan_amount&to_loan_amount=$to_loan_amount&loan_type=$search&name_search=$name_search&phone=$phone&banksearch=$banksearch&city_type=$city_type&date_from=$date_from&date_to=$date_to'>Next</a>";
                    
                    ?></td>
            </tr>
        </table>
<?php }echo implode($script); ?>  </div>
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
<?php }} include("../../include/footer_close.php");  ?>
<script>window.onload = opn_subsource();</script>