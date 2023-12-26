<?php
require_once "../config/session.php";
require_once "../config/config.php";
require_once "../include/helper.functions.php";
?>
<div style="margin:0 auto; width:90%; padding:10px; background-color:#fff; height:800px;">
<form method="POST" name="add_partner_form" action="submit.php">
<table class="gridtable" style='margin-left:2%;width:80%;'>
<tr><th colspan="2"><input type="submit" name="add" id = "add_app" class="buttonsub" style="margin-left:10%;" value="Add"> </th></tr>
<tr><th>City Group: </th><td><?php echo get_dropdown('crm_master_city_sub_group','city_sub_group',"","required");?></td></tr>
<tr><th>Loan Type: </th><td><?php echo get_dropdown(1,'loan_type',"","class='loan_type'");?></td></tr>
<tr><th>Salary Range</td><td><input type="tel" id = "salry_from" name="salry_from" >  <input type="tel" id = "salry_to" name="salry_to" ><span id="salry_error" class="error-message"></span></td></tr>
<tr><th>Loan Amount</th><td><input type="tel" id = "loan_frm"  name="loan_frm" >  <input type="tel" id = "loan_to" name="loan_to" ></td></tr>
<tr><th colspan="2"><input type="button" class="" name="use_frst" data-id="1" id="use_frst" style="margin-left:10%;" value="Add Users" onclick="user_fun('user_ist', this.id); user_fun('use_secnd', this.id);"></th></tr>
<tr><th>Ist Shift User</th><td class="user_ist"> </td></tr>
<tr><th>IInd Shift User</th><td class="use_secnd"> </td></tr>
	</table>
	</form></div>
	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>

document.addEventListener('DOMContentLoaded', function() {
    var salry_fromInput = document.getElementById('salry_from');
    var salry_toInput = document.getElementById('salry_to');
    var add_app = document.getElementById('add_app');
	alert(salry_fromInput);
    // Create the error message span
    var messageElement = document.createElement('span');
    messageElement.className = 'error-message';
    salry_fromInput.parentNode.appendChild(messageElement);

    function validatesalary() {
        var salry_from = parseFloat(salry_fromInput.value) || 0;
        var salry_to = parseFloat(salry_toInput.value) || 0;

        if (salry_from >= salry_to) {
            messageElement.textContent = 'Salary from should not be greater than or equal to salary to.';
            add_app.setAttribute('disabled', 'disabled');
        } else {
            messageElement.textContent = '';
            add_app.removeAttribute('disabled');
        }
    }

    salry_fromInput.addEventListener('input', function() {
        validatesalary();
    });

    salry_toInput.addEventListener('input', function() {
        validatesalary();
    });

    validatesalary();
});
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

