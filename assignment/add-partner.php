<?php
require_once "../config/session.php";
require_once "../config/config.php";
require_once "../include/helper.functions.php";
?>
<div style="margin:0 auto; width:90%; padding:10px; background-color:#fff; height:800px;">
<form method="POST" name="add_partner_form" action="submit.php">
<table class="gridtable" style='margin-left:2%;width:80%;'>
<tr><th colspan="2"><input type="submit" name="add" class="buttonsub" style="margin-left:10%;" value="Add" onclick="return validateForm()"> </th></tr>
<tr><th>City Group: </th><td><?php echo get_dropdown('crm_master_city_sub_group','city_sub_group',"","required");?></td></tr>
<tr><th>Loan Type: </th><td><?php echo get_dropdown(1,'loan_type',"","class='loan_type'");?></td></tr>
<tr><th>Salary Range</td><td><input type="tel" name="salry_from" >  <input type="tel" name="salry_to" ></td></tr>
<tr><th>Loan Amount</th><td><input type="tel" name="loan_frm" >  <input type="tel" name="loan_to" ></td></tr>
<tr><th colspan="2"><input type="button" class="" name="use_frst" data-id="1" id="use_frst" style="margin-left:10%;" value="Add Users" onclick="user_fun('user_ist', this.id); user_fun('use_secnd', this.id);"></th></tr>
<tr><th>Ist Shift User</th><td class="user_ist"> </td></tr>
<tr><th>IInd Shift User</th><td class="use_secnd"> </td></tr>
	</table>
	</form></div>
<script>
var counter =0;

function user_fun(type,id){
	var d = $("#"+id).attr("data-id");
  var loan_type = $(".loan_type").val(); 
  if(loan_type == ''){
    alert("Please Select Loan Type !!");
	  } else { 
	  		if(d > 4){
	  			alert("Only 4 Users Can Add in One Shift");
	  		}else{
	  			$.ajax({
			  type: "GET",
			  data: "loan_type="+loan_type+"&type="+type,
			  url: "user_assign.php",
			  success:function(data){
			  	d++;
			      $("."+type).append(data);  
			     	$("#"+id).attr("data-id",d);
			  }
			});
			
	  		}
	  }  
}

function validateForm() {
    var salry_from = parseFloat(document.getElementById('salry_from').value) || 0;
    var salry_to = parseFloat(document.getElementById('salry_to').value) || 0;
    var loan_frm = parseFloat(document.getElementById('loan_frm').value) || 0;
    var loan_to = parseFloat(document.getElementById('loan_to').value) || 0;

    // Remove existing error messages
    removeErrorMessage('salry_from');
    removeErrorMessage('loan_frm');

    // Create and append error messages
    if (salry_from >= salry_to) {
        appendErrorMessage('salry_from', 'Salary From should be less than Salary To');
    }

    if (loan_frm >= loan_to) {
        appendErrorMessage('loan_frm', 'Loan From should be less than Loan To');
    }

    // Determine whether the form should be submitted based on the conditions
    return salry_from < salry_to && loan_frm < loan_to;
}

function appendErrorMessage(elementId, message) {
    var messageElement = document.createElement('span');
    messageElement.className = 'error-message';
    messageElement.textContent = message;
    document.getElementById(elementId).parentNode.appendChild(messageElement);
}

function removeErrorMessage(elementId) {
    var parentElement = document.getElementById(elementId).parentNode;
    var existingMessage = parentElement.querySelector('.error-message');
    if (existingMessage) {
        parentElement.removeChild(existingMessage);
    }
}

</script>

