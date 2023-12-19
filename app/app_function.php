<script>
function bank_type_id_fetch(id){
	var val = id;
	  $.ajax({
            type: "POST",
            cache: "false",
            data: "bank_id=" + val,
            url: "<?php echo $head_url;?>/sugar/app/bank_type_id_fetch.php",
            success: function (data) {
                $("#bank_type_id_tw").val(data);
            }
        });
}
function validation()
{
     rad_val = $('input[name="apply_app_num"]').filter(':checked').val();
     stringArray = rad_val.split('_');
     selected_app = stringArray[0];
     app_id = stringArray[1];
     
     pattern = (/^[0-9]{4}\-(0[1-9]|1[012])\-(0[1-9]|[12][0-9]|3[01])/);
   status = $('#status_'+selected_app+' option:selected').val();
   pre_status = $('#pre_status_'+selected_app+' option:selected').val();
   rate_type = $('#rate_type_'+selected_app+' option:selected').val();
   partner = $('#partner_'+selected_app+' option:selected').val();
   loan_tenure = document.getElementById("loan_tenure_"+selected_app).value;
   fixed_tenure = document.getElementById("fixed_tenure_"+selected_app).value;
   rate_of_in = document.getElementById("rate_of_in_"+selected_app).value;
     login_date = document.getElementById("login_date_"+selected_app).value;
     applied_amount = document.getElementById("applied_amount_"+selected_app).value;
     sanction_date = document.getElementById("sanction_date_"+selected_app).value;
   sanctioned_amount = document.getElementById("sanctioned_amount_"+selected_app).value;
   first_disb_date = document.getElementById("first_disb_date_"+selected_app).value;
   last_disb_date = document.getElementById("last_disb_date_"+selected_app).value;
     disbursed_amount = document.getElementById("disbursed_amount_"+selected_app).value;
     cash_offers = document.getElementById("cash_offers_"+selected_app).value;
     rate_of_in = document.getElementById("rate_of_in_"+selected_app).value;
      follow_type = document.getElementById("follow_type_"+selected_app).value;
     follow_date = document.getElementById("follow_date_"+selected_app).value;
     follow_up_time = document.getElementById("follow_up_time_"+selected_app).value;
	 bank_type_id_get = document.getElementById("bank_type_id_get_"+selected_app).value;
    property_status_get = $('#property_status_'+selected_app+' option:selected').val();
    description_get = document.getElementById("description_"+selected_app).value;
    loan_type = "<?php echo $loan_type; ?>";
    if(status == ""){
    alert( "Choose Pre Status Login in Application "+app_id );
            document.getElementById("pre_status_"+selected_app).focus();
            return false;
    }

    if(rate_type.trim() == "") {
        alert("Rate Type for selected Partner is required");
        return false;
    }
    if(partner.trim() == "") {
        alert("Partner for selected Partner is required");
        return false;
    }
    if(applied_amount.trim() == "" || applied_amount.trim() == 0) {
        alert("Valid Applied amount is required for the selected Partner");
        return false;
    }
    
    if(pre_status == "6" && status == "8"){
    alert( "Change either Pre Login Status or Post Login Status in Application "+app_id );
            document.getElementById("pre_status_"+selected_app).focus();
            return false;
    }
    if(follow_type != '' && follow_type != '4' && (follow_date == '0000-00-00' || follow_up_time == '00:00:00' || follow_date == '' || follow_up_time == '')){
            alert( "FUP Date & Time Mandatory in Application "+app_id );
            document.getElementById("follow_date_"+selected_app).focus();
            return false;
    }
if((pre_status == '7' || pre_status == '13' || pre_status == '2' || status == '3' || status == '5') && follow_type == ''){
      alert( "FUP Mandatory if Pre login Status = Appointment, Docs Collected/ Post Login = Login, Sanctioned  Application"+app_id );
            document.getElementById("follow_type_"+selected_app).focus();
            return false;
    }
    if(pre_status != "6" && status != "8"){
    alert( "Change either Pre Login Status or Post Login Status in Application "+app_id );
            document.getElementById("pre_status_"+selected_app).focus();
            return false;
    }
    if(disbursed_amount != "" && disbursed_amount != "0" && (status == "2")){
    alert( "Change disbursement Amount to zero" );
    return false;
    } 
    if(status == "3" || status == "4" || status == "2" ||  status == "10" ||  status == "5" || status == "6" || status == "7" || status == "9" || status == "11") {
         if(applied_amount == "" || applied_amount == "0" || isNaN(applied_amount))
                 {
                    alert( "Enter Applied amount in Application "+app_id );
                    document.getElementById("applied_amount_"+selected_app).focus();
                    return false;
                 }
           if(login_date == "" || login_date == "0000-00-00" || !pattern.test(login_date))
                 {
                    alert( "Enter Valid Login Date in Application "+app_id );
                    document.getElementById("login_date_"+selected_app).focus();
                    return false;
                 } 
    }

   if(status  == "5" || status == "6" || status == "7"  || status == '10') {
        if(sanctioned_amount == "" || sanctioned_amount == "0" || isNaN(sanctioned_amount) )
         {
            alert( "Enter Sanctioned Amount in Application "+app_id );
            document.getElementById("sanctioned_amount_"+selected_app).focus(); 
            return false;
         } 
 
        if(sanction_date == "" || sanction_date == "0000-00-00" || !pattern.test(sanction_date) )
         {
            alert( "Please provide sanction date in valid format in Application "+app_id );
            document.getElementById("sanction_date_"+selected_app).focus();
            return false;
         }
         
        if((new Date(login_date).getTime() > new Date(sanction_date).getTime()))
         {
            alert( "Sanction date is not less than Login Date in Application "+app_id );
            document.getElementById("sanction_date_"+selected_app).focus();
            return false;
         }
        if(rate_of_in == "" || rate_of_in == "0" || rate_of_in == "0.00"){
        alert( "Enter Rate of Interest in Application "+app_id );
            document.getElementById("rate_of_in_"+selected_app).focus();
            return false;
        }if(loan_tenure == "" || loan_tenure == "0"){
        alert( "Enter Loan Tennure in Application "+app_id );
            document.getElementById("loan_tenure_"+selected_app).focus();
            return false;
        }
    }
    if(status == "6" || status == "7") {
        if(rate_of_in == "" || rate_of_in == "0" || rate_of_in == "0.00"){
        alert( "Enter Rate of Interest in Application "+app_id );
            document.getElementById("rate_of_in_"+selected_app).focus();
            return false;
            }
          if( disbursed_amount== "" || disbursed_amount == "0" || isNaN(disbursed_amount) )
                 {
                    alert( "Enter Disbursed Amount in Application "+app_id );
                    document.getElementById("disbursed_amount_"+selected_app).focus(); 
                    return false;
                 }
           if(first_disb_date == "" || first_disb_date == "0000-00-00" || !pattern.test(first_disb_date))
                 {
                    alert( "Enter first Disbursed Date in Valid Format in Application "+app_id );
                    document.getElementById("first_disb_date_"+selected_app).focus();
                    return false;
                 }
           if((new Date(login_date).getTime() > new Date(first_disb_date).getTime()) || (new Date(sanction_date).getTime() > new Date(first_disb_date).getTime()))
                 {
                    alert( "Disbursed Date is not less than Login Date & Sanctioned Date in Application "+app_id );
                    document.getElementById("first_disb_date_"+selected_app).focus();
                    return false;
                 }
            if((cash_offers== "" || cash_offers == 0) && bank_type_id_get != '4' ){
          
                <?php if($loan_type == 56 || $loan_type == 57 || $loan_type == 51 || $loan_type == 52 || $loan_type == 54){ ?>
                alert("Enter Minimum Rs. 200 Cashback in First Application in Application "+app_id);
                document.getElementById("cash_offers_"+selected_app).focus();
                return false;
                <?php }else{?>
                alert("Enter Minimum Rs. 100 Cashback in First Application in Application "+app_id);
                document.getElementById("cash_offers_"+selected_app).focus();
                return false;
                <?php } ?>
                 }
                  //Changes - ApplicationEditNewDesign - Akash - Starts
                  if(cash_offers > 10000){
                //Changes - ApplicationEditNewDesign - Akash - Ends
                 alert("Enter Max Rs 10000 Casback in First Application in Application "+app_id);
                document.getElementById("cash_offers_"+selected_app).focus();
                return false;
                 }  
                 if(loan_tenure == "" || loan_tenure == "0"){
        alert( "Enter Loan Tennure in Application "+app_id );
            document.getElementById("loan_tenure_"+selected_app).focus();
            return false;
        }
    }
    if((loan_type == 51 || loan_type == 54 || loan_type == 52) && (status == 5 || status == 6 || status == 7 || status == 10)){
        if(property_status_get == '' || property_status_get == '0'){
            alert("Select Property Status in Application "+app_id);
            document.getElementById("property_status_"+selected_app).focus();
            return false;
        }else if(property_status_get == 6 && trim(description_get) == ''){
            alert("Description is mandatory if property satus = Others in Application "+app_id);
            document.getElementById("description_"+selected_app).focus();
            return false;
        }
    }

}
  
  function status_on_disb(check=0){
 <?php foreach($f_id  as $bnk_app => $ac ){ ?>
 ////Confirmbox
 var apply_app_status_on_<?php echo $ac; ?>=$('#apply_app_status_on_<?php echo $ac; ?>').val();
   
    var sts=apply_app_status_on_<?php echo $ac; ?>;
  
    var status_<?php echo $ac; ?> = $('#status_<?php echo $ac; ?> option:selected').val();
    var status_val=status_<?php echo $ac; ?>;
    var loan_type=$('#loan_type').val();
    var app_id=$('#apply_app_id1_<?php echo $ac; ?>').val();

    var pls_status_id = $('#pre_status_<?php echo $ac; ?>').val();
    var post_login_status_id = status_val;
    var pls_arr = ["5", "3", "8"];
    var prels_arr = ["4", "13", "2", "7", "14", "16", "1", "10"];
    if(pls_arr.includes(post_login_status_id)) {
        $("#follow_type_<?php echo $ac; ?> option[value='4']").remove();
    } else {
        if(prels_arr.includes(pls_status_id)) {
            $("#follow_type_<?php echo $ac; ?> option[value='4']").remove();
        } else {
            if($("#follow_type_<?php echo $ac; ?> option[value='4']").length == 0) {
                $("#follow_type_<?php echo $ac; ?>").append('<option value="4" data-target="Closed">Closed</option>');
            }
        }
    }

    if(check==1){
   if(loan_type==56 && status_val==9)
   {
        
          if (confirm("Have you check offers of Fullerton/ HDB?")) 
          {
            $.ajax({
                        type: "POST",
                        cache: false,
                        url: "../insert/followupnoteligible.php",
                        data: "status="+sts+"&levelid="+app_id+"&statusnew="+status_val+"&level_type=3&button=Yes",
                        success: function (response) {
                            console.log(response)           
                        }
                    });
                } 
                else {
                    $.ajax({
                            type: "POST",
                            cache: false,
                            url: "../insert/followupnoteligible.php",
                            data: "status="+sts+"&levelid="+app_id+"&statusnew="+status_val+"&level_type=3&button=No",
                            success: function (response) {
                                console.log(response)
                            
                            }
                        });
                    $('#status_<?php echo $ac; ?>').val(sts);
                }
                   
                }
            }

 //confirmbox

 var status_<?php echo $ac; ?> = $('#status_<?php echo $ac; ?> option:selected').val();
	$('#disbursed<?php echo $ac; ?>').hide(); 
	  if(status_<?php echo  $ac; ?> == "6" || status_<?php echo  $ac; ?> == "7") {
           $('#disbursed<?php echo $ac; ?>').show(); 
           $('.cashback_sms_<?php echo $ac; ?>').show();
        }     
         else{$('#disbursed<?php echo $ac; ?>').hide();$('.cashback_sms_<?php echo $ac; ?>').hide(); }     
         <?php } ?>
 }
 
 function new_validation(){
	var pattern = (/^[0-9]{4}\-(0[1-9]|1[012])\-(0[1-9]|[12][0-9]|3[01])/);
	var status_tw = $('#status_tw option:selected').val();
	var pre_status_tw = $('#pre_status_tw option:selected').val();
	var rate_type_tw = $('#rate_type_tw option:selected').val();
	var partner_tw = $('#partner_tw option:selected').val();
	var loan_tenure_tw = document.getElementById("loan_tenure_tw").value;
	var fixed_tenure_tw = document.getElementById("fixed_tenure_tw").value;
	var rate_of_in_tw = document.getElementById("rate_of_in_tw").value;
  	var login_date_tw = document.getElementById("login_date_tw").value;
  	var applied_amount_tw = document.getElementById("applied_amount_tw").value;
  	var sanction_date_tw = document.getElementById("sanction_date_tw").value;
 	var sanctioned_amount_tw = document.getElementById("sanctioned_amount_tw").value;
 	var first_disb_date_tw = document.getElementById("first_disb_date_tw").value;
 	var last_disb_date_tw = document.getElementById("last_disb_date_tw").value;
  	var disbursed_amount_tw = document.getElementById("disbursed_amount_tw").value;
  	var cash_offers_tw = document.getElementById("cash_offers_tw").value;
    var follow_type_tw = document.getElementById("follow_type_tw").value;
    var follow_date_tw = document.getElementById("follow_date_tw").value;
    var follow_up_time_tw = document.getElementById("follow_up_time_tw").value;
	var bank_type_id_find = document.getElementById("bank_type_id_tw").value;
	//Changes - ApplicationEditNewDesign - Akash - Starts
	var property_status_tw = (document.getElementById("myElement")) ? document.getElementById("property_status_tw").value : "";
    //Changes - ApplicationEditNewDesign - Akash - Ends
	var description_tw = document.getElementById("description_tw").value;
	var loan_type = "<?php echo $loan_type; ?>";
    
  	if(pre_status_tw == ""){
  	alert( "Choose Pre Status Login" );
            document.getElementById("pre_status_tw").focus();
            return false;
  	}
  	
  	if(pre_status_tw == "6" && status_tw == "8"){
  	alert( "Change either Pre Login Status or Post Login Status" );
            document.getElementById("pre_status_tw").focus();
            return false;
  	}
  	
  	if(pre_status_tw != "6" && status_tw != "8"){
  	alert( "Change either Pre Login Status or Post Login Status" );
            document.getElementById("pre_status_tw").focus();
            return false;
  	}
    if(follow_type_tw != '' && follow_type_tw != '4' && (follow_date_tw == '0000-00-00' || follow_up_time_tw == '00:00:00' || follow_date_tw == '' || follow_up_time_tw == '')){
            alert( "FUP Date & Time Mandatory in Application" );
            document.getElementById("follow_date_tw").focus();
            return false;
    }
    if((pre_status_tw == '7' || pre_status_tw == '13' || pre_status_tw == '2' || status_tw == '3' || status_tw == '5') && follow_type_tw == ''){
      alert( "FUP Mandatory if Pre login Status = Appointment, Docs Collected/ Post Login = Login, Sanctioned" );
            document.getElementById("follow_type_tw").focus();
            return false;
    }
    
  if(status_tw == "3" || status_tw == "4" || status_tw == "2" || status_tw == "5" || status_tw == "6" || status_tw == "7" || status_tw == "10"  || status_tw == "11"  || status_tw == "9") {
  	
   if(applied_amount_tw == "" || applied_amount_tw == "0" || isNaN(applied_amount_tw))
         {
            alert( "Enter Applied amount" );
            document.getElementById("applied_amount_tw").focus();
            return false;
         }
   if(login_date_tw == "" || login_date_tw == "0000-00-00" || !pattern.test(login_date_tw))
         {
            alert( "Enter Valid Login Date" );
            document.getElementById("login_date_tw").focus();
            return false;
         } 
         if(loan_tenure_tw == "" || loan_tenure_tw == "0"){
        alert( "Enter Loan Tennure in Application " );
            document.getElementById("loan_tenure_tw").focus();
            return false;
        }
  }
  
   if(status_tw  == "5" || status_tw == "6" || status_tw == "7" || status_tw == "10") {
      if(sanctioned_amount_tw == "" || sanctioned_amount_tw == "0" || isNaN(sanctioned_amount_tw) )
         {
            alert( "Enter Sanctioned Amount" );
            document.getElementById("sanctioned_amount_tw").focus(); 
            return false;
         }
 
   if( sanction_date_tw == "" || sanction_date_tw == "0000-00-00" || !pattern.test(sanction_date_tw) )
         {
            alert( "Please provide sanction date in valid format" );
            document.getElementById("sanction_date_tw").focus();
            return false;
         }
         
    if((new Date(login_date_tw).getTime() > new Date(sanction_date_tw).getTime()))
         {
            alert( "Sanction date is not less than Login Date" );
            document.getElementById("sanction_date_tw").focus();
            return false;
         }
          if(loan_tenure_tw == "" || loan_tenure_tw == "0"){
        alert( "Enter Loan Tennure in Application" );
            document.getElementById("loan_tenure_tw").focus();
            return false;
        }
    }
    
    if(status_tw == "6" || status_tw == "7") {
  if( disbursed_amount_tw == "" || disbursed_amount_tw == "0" || isNaN(disbursed_amount_tw) )
         {
            alert( "Enter Disbursed Amount" );
            document.getElementById("disbursed_amount_tw").focus(); 
            return false;
         }
   if(first_disb_date_tw == "" || first_disb_date_tw == "0000-00-00" || !pattern.test(first_disb_date_tw))
         {
            alert( "Enter first Disbursed Date in Valid Format" );
            document.getElementById("first_disb_date_tw").focus();
            return false;
         }
   if((new Date(login_date_tw).getTime() > new Date(first_disb_date_tw).getTime()) || (new Date(sanction_date_tw).getTime() > new Date(first_disb_date_tw).getTime()))
         {
            alert( "Disbursed Date is not less than Login Date & Sanctioned Date" );
            document.getElementById("first_disb_date_tw").focus();
            return false;
         }
		 
    if((cash_offers_tw == "" || cash_offers_tw == 0) && bank_type_id_find != 4){
        <?php if($loan_type == 56 || $loan_type == 57 || $loan_type == 51 || $loan_type == 52 || $loan_type == 54){ ?>
        alert("Enter Minimum Rs. 200 Cashback in First Application");
        document.getElementById("cash_offers_tw").focus();
        return false;
        <?php }else{?>
        alert("Enter Minimum Rs. 100 Cashback in First Application");
        document.getElementById("cash_offers_tw").focus();
        return false;
        <?php } ?>
         }
          if(cash_offers_tw > 10000){
         alert("Enter Max Rs 10000 Casback in First Application");
        document.getElementById("cash_offers_tw").focus();
        return false;
         }  }
    if((loan_type == 51 || loan_type == 54 || loan_type == 52) && (status_tw == 5 || status_tw == 6 || status_tw == 7 || status_tw == 10)){
        if(property_status_tw == '' || property_status_tw == 0){
            alert("Select Property Status");
            document.getElementById("property_status_tw").focus();
            return false;
        }else if(trim(description_tw) == '' && property_status_tw == 6){
            alert("Description is mandatory if property status = others");
            document.getElementById("description_tw").focus();
            return false;
        }
    }
 }

$(function() {
  $('a[href*=#]:not([href=#])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html,body').animate({
          scrollTop: target.offset().top-75
        }, 1000);
        return false;
      }
    }
  });
});

function add_bnk(){
$("#another_bank").show();
}

$(function() {
    $( ".dat" ).datepicker({
      changeMonth: true, 
      changeYear: true,
      dateFormat: 'yy-mm-dd',
      yearRange: "-3:+1",
      onClose: function( selectedDate ) {
      $("#date_from" ).datepicker( "option", "maxDate", selectedDate );
      }
    }).val();
  });
  $(function () {
                $('.fol_time').timepicker(
                    {                       
                        minTime: '09:30:00', 
                        maxTime: '20:00:00',
                        step: 30 

                });
            });

 function show_egidetal(app_id){ 
		$("#elig_detail_"+app_id).toggleClass("hidden");
		 $('html,body').animate({
        scrollTop: $("#elig_detail_"+app_id).offset().top},
        'slow');
		}
		
function status_on_login(id){
    var id1=id.split('_')[2];
    var status_val=$("#"+id).val();
    var sts =$('#apply_pre_login_status_'+id1).val();  
    var loan_type=$('#loan_type').val();
    var app_id=$('#apply_app_id1_<?php echo $ac; ?>').val();

    var pls_status_id = $("#status_"+id1).val();
    var pre_login_status_id = $("#"+id).val();
    var pls_arr = ["4", "13", "2", "7", "14", "16", "1", "10"];
    var pols_arr = ["5", "3", "8"];
    if(pls_arr.includes(pre_login_status_id)) {
        $("#follow_type_" + id1 + " option[value='4']").remove();
    } else {
        if(pols_arr.includes(pls_status_id)) {
            $("#follow_type_" + id1 + " option[value='4']").remove();
        } else {
            if($("#follow_type_" + id1 + " option[value='4']").length == 0) {
                $("#follow_type_" + id1).append('<option value="4" data-target="Closed">Closed</option>');
            }
        }
    }

    if (loan_type==56 && (status_val==12 || status_val==3))
          {
                if (confirm("Have you check offers of Fullerton/ HDB?")) 
                {
                    $.ajax({
                        type: "POST",
                        cache: false,
                        url: "../insert/followupnoteligible.php",
                        data: "status="+sts+"&levelid="+app_id+"&statusnew="+status_val+"&level_type=3&button=Yes",
                        success: function (response) {
                            console.log(response)           
                        }
                    });
                } 
                else 
                {
                    $.ajax({
                            type: "POST",
                            cache: false,
                            url: "../insert/followupnoteligible.php",
                            data: "status="+sts+"&levelid="+app_id+"&statusnew="+status_val+"&level_type=3&button=No",
                            success: function (response) {
                                console.log(response)
                            
                            }
                        });
                    $("#"+id).val(sts);
                }
                    
            }

    if($("#"+id).val() == 6){
    $(".log_details").removeClass("hidden");
    } else {
        $(".log_details").addClass("hidden");
    }
}

</script>