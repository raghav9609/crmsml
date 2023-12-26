<?php
require_once "../config/session.php";
require_once "../config/config.php";
require_once "../include/helper.functions.php";
?>
<style>
    .error-message {
      color: red;
    }
  </style>
<div style="margin:0 auto; width:90%; padding:10px; background-color:#fff; height:800px;">
<form method="POST" name="add_partner_form" action="submit.php">
<table class="gridtable" style='margin-left:2%;width:80%;'>
<tr><th colspan="2"><input type="submit" name="add" id = "add_app" class="buttonsub" style="margin-left:10%;" value="Add"  > </th></tr>
<tr><th>City Group: </th><td><?php echo get_dropdown('crm_master_city_sub_group','city_sub_group',"","required");?></td></tr>
<tr><th>Loan Type: </th><td><?php echo get_dropdown(1,'loan_type',"","class='loan_type'");?></td></tr>
<div id="error-message" class="error-message"></div>
<tr><th>Salary Range</td><td><input type="tel" id = "salry_from" name="salry_from" oninput="validateSalaryRange()">  <input type="tel" id = "salry_to" name="salry_to" oninput="validateSalaryRange()"></td></tr>
<tr><th>Loan Amount</th><td><input type="tel" id = "loan_frm"  name="loan_frm" oninput="validateSalaryRange()">  <input type="tel" id = "loan_to" name="loan_to" oninput="validateSalaryRange()"></td></tr>
<tr><th colspan="2"><input type="button" class="" name="use_frst" data-id="1" id="use_frst" style="margin-left:10%;" value="Add Users" onclick="user_fun('user_ist', this.id); user_fun('use_secnd', this.id);"></th></tr>
<tr><th>Ist Shift User</th><td class="user_ist"> </td></tr>
<tr><th>IInd Shift User</th><td class="use_secnd"> </td></tr>
	</table>
	</form></div>
	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>

function validateSalaryRange() {
      var salaryFrom = parseFloat(document.getElementById('salry_from').value);
      var salaryTo = parseFloat(document.getElementById('salry_to').value);
      var errorMessage = document.getElementById('error-message');
	  var add_app = document.getElementById('add_app');

      if (isNaN(salaryFrom) || isNaN(salaryTo) || salaryFrom >= salaryTo) {
        errorMessage.textContent = 'Error: Salary from must be less than Salary to';
		add_app.setAttribute('disabled', 'disabled');
      } else {
        errorMessage.textContent = '';
		add_app.removeAttribute('disabled');
     
      }
    }

function validateLoanRange() {
      var loan_frm = parseFloat(document.getElementById('loan_frm').value);
      var loan_to = parseFloat(document.getElementById('loan_to').value);
      var errorMessage = document.getElementById('error-message');
	  var add_app = document.getElementById('add_app');

      if (isNaN(loan_frm) || isNaN(loan_to) || loan_frm >= loan_to) {
        errorMessage.textContent = 'Error: Loan from must be less than Loan to';
		add_app.setAttribute('disabled', 'disabled');
      } else {
        errorMessage.textContent = '';
		add_app.removeAttribute('disabled');
     
      }
    }
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


</script>

