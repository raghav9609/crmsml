<?php 
require_once "../../include/crm-header.php";
require_once "../../include/dropdown.php";
if(isset($_REQUEST['case_id'])){
		$case_id = replace_special(base64_decode($_REQUEST['case_id']));
	}if(isset($_REQUEST['cust_id'])){
	$cust_id = replace_special(base64_decode($_REQUEST['cust_id']));
	}if(isset($_REQUEST['loan_type'])){
	$loan_type = replace_special(base64_decode($_REQUEST['loan_type']));}	 
?>
<link rel="stylesheet" href="../../include/css/jquery-ui.css">
 <script type="text/javascript" src="../../include/js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="../../include/js/jquery-ui.js"></script>	
 <script type="text/javascript" src="../../include/js/jquery.timeentry.js"></script>  
 <script>
   $(function () {
  $('.fol_time').timeEntry();
});

function bank_type_id_fetch(id){
	var val = id;
	
	  $.ajax({
            type: "POST",
            cache: "false",
            data: "bank_id=" + val,
            url: "<?php echo $head_url;?>/sugar/app/bank_type_id_fetch.php",
            success: function (data) {
                $("#bank_type_id").val(data);
            }
        });
}

 function validation(){
   var pattern = (/^[0-9]{4}\-(0[1-9]|1[012])\-(0[1-9]|[12][0-9]|3[01])/);
	var status_on = $('#status_on option:selected').val();
	var pre_status_on = $('#pre_status_on option:selected').val();
	var rate_type_on = $('#rate_type_on option:selected').val();
	var partner_on = $('#partner_on option:selected').val();
	var loan_tenure_on = document.getElementById("loan_tenure_on").value;
	var fixed_tenure_on = document.getElementById("fixed_tenure_on").value;
	var rate_of_in_on = document.getElementById("rate_of_in_on").value;
  	var login_date_on = document.getElementById("login_date_on").value;
  	var applied_amount_on = document.getElementById("applied_amount_on").value;
  	var sanction_date_on = document.getElementById("sanction_date_on").value;
 	var sanctioned_amount_on = document.getElementById("sanctioned_amount_on").value;
 	var first_disb_date_on = document.getElementById("first_disb_date_on").value;
 	var last_disb_date_on = document.getElementById("last_disb_date_on").value;
  	var disbursed_amount_on = document.getElementById("disbursed_amount_on").value;
  	var cash_offers_on = document.getElementById("cash_offers_on").value;
	var bank_type_id_find = document.getElementById("bank_type_id").value;
  	
  	if(pre_status_on == ""){
  	alert( "Choose Pre Status Login" );
            document.getElementById("pre_status_on").focus();
            return false;
  	}
  	
  	if(pre_status_on == "6" && status_on == "8"){
  	alert( "Change either Pre Login Status or Post Login Status" );
            document.getElementById("pre_status_on").focus();
            return false;
  	}
  	
  	if(pre_status_on != "6" && status_on != "8"){
  	alert( "Change either Pre Login Status or Post Login Status" );
            document.getElementById("pre_status_on").focus();
            return false;
  	}
  	
  if(status_on == "3" || status_on == "5" || status_on == "6" || status_on == "7") {
  	
   if(applied_amount_on == "" || applied_amount_on == "0" || isNaN(applied_amount_on))
         {
            alert( "Enter Applied amount" );
            document.getElementById("applied_amount_on").focus();
            return false;
         }
   if(login_date_on == "" || login_date_on == "0000-00-00" || !pattern.test(login_date_on))
         {
            alert( "Enter Valid Login Date" );
            document.getElementById("login_date_on").focus();
            return false;
         } 
  }
  
   if(status_on  == "5" || status_on == "6" || status_on == "7") {
      if(sanctioned_amount_on == "" || sanctioned_amount_on == "0" || isNaN(sanctioned_amount_on) )
         {
            alert( "Enter Sanctioned Amount" );
            document.getElementById("sanctioned_amount_on").focus(); 
            return false;
         }
 
   if( sanction_date_on == "" || sanction_date_on == "0000-00-00" || !pattern.test(sanction_date_on) )
         {
            alert( "Please provide sanction date in valid format" );
            document.getElementById("sanction_date_on").focus();
            return false;
         }
         
    if((new Date(login_date_on).getTime() > new Date(sanction_date_on).getTime()))
         {
            alert( "Sanction date is not less than Login Date" );
            document.getElementById("sanction_date_on").focus();
            return false;
         }
    }
    
    if(status_on == "6" || status_on == "7") {
  if( disbursed_amount_on == "" || disbursed_amount_on == "0" || isNaN(disbursed_amount_on) )
         {
            alert( "Enter Disbursed Amount" );
            document.getElementById("disbursed_amount_on").focus(); 
            return false;
         }
   if(first_disb_date_on == "" || first_disb_date_on == "0000-00-00" || !pattern.test(first_disb_date_on))
         {
            alert( "Enter first Disbursed Date in Valid Format" );
            document.getElementById("first_disb_date_on").focus();
            return false;
         }
   if((new Date(login_date_on).getTime() > new Date(first_disb_date_on).getTime()) || (new Date(sanction_date_on).getTime() > new Date(first_disb_date_on).getTime()))
         {
            alert( "Disbursed Date is not less than Login Date & Sanctioned Date" );
            document.getElementById("first_disb_date_on").focus();
            return false;
         }
    if((cash_offers_on == "" || cash_offers_on == 0 ) && bank_type_id_find != 4){
  
        <?php if($loan_type == 56 || $loan_type == 57 || $loan_type == 51 || $loan_type == 52 || $loan_type == 54){ ?>
        alert("Enter Minimum Rs. 200 Cashback in First Application");
        document.getElementById("cash_offers_on").focus();
        return false;
        <?php }else{?>
        alert("Enter Minimum Rs. 100 Cashback in First Application");
        document.getElementById("cash_offers_on").focus();
        return false;
        <?php } ?>
         }
          if(cash_offers_on > 10000){
         alert("Enter Max Rs 10000 Casback in First Application");
        document.getElementById("cash_offers_on").focus();
        return false;
         }  } 
 }
 $(function() {
    $( ".dat" ).datepicker({
      changeMonth: true, 
      changeYear: true,
      dateFormat: 'yy-mm-dd',
      yearRange: "-2:+0",
      onClose: function( selectedDate ) {
      $("#date_from" ).datepicker( "option", "maxDate", selectedDate );
      }
    }).val();
  });
 </script>
<body onload = "status_on_disb();">
<div align="center">
<div class="wrapper">
<h3><span style="color:orange;">Application</span></h3>
<form name="add_bank" action = "add_bank_process.php" method="post" onsubmit = "return validation();">
<input style="float:right;" type="submit" name="add" id="add" value="add" /> 
<input type="hidden" name="case_id" id="case_id" value="<?php echo $case_id;?>"> 
<input type="hidden" name="cust_id" id="cust_id" value="<?php echo $cust_id;?>"> 
<input type="hidden" name="loan_type" id="loan_type" value="<?php echo $loan_type;?>"> 
<table class="adminbox admintext" width="100%" border="0" cellpadding ="8px" id="adminbox_on">
  
<tr>
<td>Banks Offered</td><td><?php echo get_dropdown('bank_name_','app_bank_one','','onchange="bank_type_id_fetch(this.value);" required'); ?>
<input type='hidden' name='bank_type_id' id='bank_type_id' value=''/>
</td><td>&nbsp;</td>
 <td width="21%"><span class="bodytext">Pre Login Status</span></td>
  <td width="15%"><?php echo get_dropdown('pre_login','pre_status_on','','required'); ?></td>
  <td>&nbsp;</td>
  <td width="21%"><span class="bodytext">Post Login Status</span></td>
  <td width="15%"><?php echo get_dropdown('post_login','status_on','','required onchange ="status_on_disb();"'); ?></td></tr>
 <tr> <td><span class="bodytext">Applied Amount</span></td>
     <td><input type="text" class="text-input" name="applied_amount_on" id="applied_amount_on" required/></td> <td>&nbsp;</td>
 <td><span class="bodytext">Rate Type </span></td>
    <td><?php echo get_dropdown('rate_type','rate_type_on','','required'); ?></td><td>&nbsp;</td>
    <td><span class="bodytext">Partner</span></td>
   <td><?php echo get_dropdown('app_pat_list','partner_on','','required'); ?></td></tr>
     
   <tr>  <td><span class="bodytext">Login Date</span></td>
     <td><input type="text" class="text-input dat" name="login_date_on" id="login_date_on" placeholder="yyyy-mm-dd"/></td> <td>&nbsp;</td>
     <td><span class="bodytext">Sanctioned Amount</span></td>
     <td><input type="text" class="text-input" name="sanctioned_amount_on" id="sanctioned_amount_on" /></td> 
                  
             <td>&nbsp;</td>
             <td><span class="bodytext">Sanction Date</span></td>
             <td><input type="text" class="text-input dat" name="sanction_date_on" id="sanction_date_on" placeholder="yyyy-mm-dd" /></td>
                
  </tr><tr><td><span class="bodytext">Loan Tenure in Months</span></td>
     	<td><input type="text" class="text-input" name="loan_tenure_on" id="loan_tenure_on" placeholder="Month" /></td>     <td>&nbsp;</td>
   	<td><span class="bodytext">If Fixed, Tenure for which rate is fixed</span></td>
   	<td><input type="text" class="text-input" name="fixed_tenure_on" id="fixed_tenure_on"/></td>
   	<td>&nbsp;</td>
	  	<td><span class="bodytext">Rate of Interest</span></td>
     	<td><input type="text" class="text-input" name="rate_of_in_on" id="rate_of_in_on" placeholder ="Rate of Interest"/></td>
   	  <td>&nbsp;</td></tr>

   <tr id = "disbursed" >
   	<td><span class="bodytext">Disbursed Amount</span></td>
     	<td><input type="text" class="text-input" name="disbursed_amount_on" id="disbursed_amount_on" placeholder="Disbursed Amount"/></td>	
   	   	<td>&nbsp;</td>
		<td><span class="bodytext">First Disb Date</span></td>
     	<td><input type="text" class="text-input dat" name="first_disb_date_on" id="first_disb_date_on" placeholder ="First Disb Date"/></td>
   <td>&nbsp;</td>
   	<td><span class="bodytext">Last Disb Date</span></td>
   	<td><input type="text" class="text-input dat" name="last_disb_date_on" id="last_disb_date_on" placeholder ="Last Disb Date"/></td>
   </tr>
   <tr>
   <td><span class="bodytext">Bank Application No.</span></td>
     	<td><input type="text" class="text-input" name="bank_app_num_on" id="bank_app_num_on" placeholder ="Bank Application No." /></td>
     	 <td>&nbsp;</td>
     	 <td><span class="bodytext">Bank CRM/ Lead Id</span></td>
     	<td><input type="text" class="text-input" name="bank_crm_lead_on" id="bank_crm_lead_on" placeholder ="Bank CRM/ Lead Id"  maxlength="30" /></td>
     	<td>&nbsp;</td> 
     	<td><span class="bodytext">Cashback Offers</span></td>
     	<td><input type="text" class="text-input" name="cash_offers_on" id="cash_offers_on" placeholder ="Cashback Amount" maxlength="30" /></td>
   </tr>
   <tr>
    <td><span class="bodytext">Follow Up Type</span></td>
     <td><?php echo get_dropdown('follow_up_type','follow_type_on','',''); ?></td>
          <td>&nbsp;</td>
     <td><span class="bodytext">Follow Up Date</span></td>
     <td><input type="text" class="text-input" name="follow_date_on" id="follow_date_on" placeholder="yyyy-mm-dd"/>     
     <td>&nbsp;</td>
     <td><span class="bodytext">Follow Up Time</span></td>
     <td><input type="text" class="text-input fol_time" name="follow_time_on" id="follow_time_on" placeholder="h:i:s"/> 
   </tr><tr>
    <td><span class="bodytext">Description</span></td>
  <td><textarea name="description_on" id="description_on" placeholder="Description"></textarea></td>      
 </tr>
    </table>
 </form>
<?php include('../cases/insert_case.php');?> 
</div>
</div>
</body>
<?php  include("../../include/footer_close.php"); ?> 