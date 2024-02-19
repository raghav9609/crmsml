<?php
if($phone=='9811108804' || $phone=='9990653971' || $phone=='9958790040'){
    $global_hl_filter=1;
}
?>
<link href="../assets/css/tab_style.css" rel='stylesheet' type='text/css' />
<link href = "../assets/css/jquery-ui.css" rel = "stylesheet">
<script src = "../assets/js/jquery-1.10.2.js"></script>
<script src = "../assets/js/jquery-ui.js"></script>
<script type="text/javascript" src="../assets/js/jquery.timeentry.js"></script>
<script src="../assets/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="../assets/js/format_amount.js"></script>
<script src="../assets/js/jquery.timepicker.js"></script>
<link href="../assets/css/jquery.timepicker.min.css" rel="stylesheet"/> 
<script>					
$(function() {
  $(".time").timeEntry(); 
  var loan_type=$("#loan_type").val();

$("#comp_name").autocomplete({
	source: "../include/company_search.php",
	minLength: 1,
});		
$(".city_search").autocomplete({
	source: "../include/city_name.php",
	minLength: 1
});

// $("#institute_name").autocomplete({
// 	source: "../include/institute_name.php",
// 	minLength: 1
// });

// $("#buildername").autocomplete({
// 	source: "../include/builder_search.php",
// 	minLength: 1
// });	
// $("#project_name").autocomplete({
// 	source: "../include/project_search.php",
// 	minLength: 1
// });			

$("#folow_given").change(function () {
  datechange();
});
$( "#dob" ).datepicker({
    changeMonth: true, 
    changeYear: true,
    dateFormat: 'yy-mm-dd',
    yearRange: "-65:-20",
    onClose: function( selectedDate ) {
		$("#dob" ).datepicker( "option", "", selectedDate );
    },onSelect: function(value, ui) {
        var seldob = new Date($("#dob").val());
        var today = new Date(), 
         age = Math.floor((today- seldob) / (365.25 * 24 * 60 * 60 * 1000));
        $('#age').text(age+" years");
    }
}).val(); 
$( "#cur_lo_s_m" ).datepicker({
    maxDate: '0',
    changeMonth: true, 
    changeYear: true,
    dateFormat: 'yy-mm-dd',
    yearRange: "-65:+0",
    onClose: function( selectedDate ) {
		$("#cur_lo_s_m" ).datepicker( "option", "maxDate", selectedDate );
    }
}).val();
$( "#c_folow_up_date,#apptmnt_date" ).datepicker({
     minDate: '0',
      changeMonth: true, 
      changeYear: true,
      dateFormat: 'yy-mm-dd',
      onClose: function( selectedDate ) {
      $("#c_folow_up_date" ).datepicker( "option", "maxDate", selectedDate );
      }
    }).val();
    var minimum_days = 0;
    var maximum_days = 30;
    $( "#fol_date" ).datepicker({
     minDate: minimum_days,
     maxDate: maximum_days,
     changeMonth: true, 
     changeYear: true,
     dateFormat: 'yy-mm-dd',
      onSelect: function(value, ui)
      {
        datechange();
    },
      onClose: function( selectedDate ) {
        $("#follow_up_date_t").val(selectedDate);
      }
    });
function datechange(){
  var value = $("#fol_date").val();
  var fslot_flag=$( "#slot_flag" ).val();
          if(fslot_flag=='1')
          {
            $.ajax({
            data: "followupdate="+value,
            type: "POST",
            url: "<?php echo $head_url;?>/sugar/insert/checkfollowupslot.php",          
            success:function(data){


              $.ajax({
                  data: "followupdate="+value,
                  type: "POST",
                  url: "<?php echo $head_url; ?>/sugar/insert/check-follow-up-on-date.php",
                  success:function(response_data) {

                    console.log(JSON.parse(response_data));

            var disbleslot=JSON.parse(response_data);
            var today = new Date();
            var date=Date.parse(value);
            var month=today.getMonth()+1;
            var days=today.getDate();
        if (days < 10) 
        {
            days = "0" + days;
        }
    if (month < 10) 
    {
        month = "0" + month;
    }
        var tday=today.getFullYear()+"-"+month+"-"+days;
        var datetoday=Date.parse(tday);
        var user=  $('#folow_given option:selected').val(); 
           if(user =='1'  || user =='3'){
               var int1=15;
           }
           else 
           {
               var int1=15;
           }
           if(datetoday==date)
            {
                $('#fol_time').timepicker({disableTextInput: true}).val("");
                var min=formatTime(today);
                  if(min){
                      var minval=min;
                  }
                  else{
                    var minval="19:30:00";
                  }
                  $('#fol_time').timepicker('option', {minTime: minval, 
                        maxTime: '20:00:00',
                        step: int1,
                        disableTextInput: true,
                        disableTimeRanges: disbleslot
                         });                
            }
            else {
                $('#fol_time').timepicker({disableTextInput: true}).val(""); 
                $('#fol_time').timepicker('option', {minTime: '09:30:00', 
                        maxTime: '20:00:00', 
                        step: int1,
                        disableTextInput: true ,
                        disableTimeRanges: disbleslot     });
                }

                }
              });

            }
        });

          }
          else {
        var today = new Date();
        var date=Date.parse(value);
        var month=today.getMonth()+1;
        var days=today.getDate();
        if (days < 10) 
        {
            days = "0" + days;
        }
    if (month < 10) 
    {
        month = "0" + month;
    }
        var tday=today.getFullYear()+"-"+month+"-"+days;
        var datetoday=Date.parse(tday);
        var user=  $('#folow_given option:selected').val(); 
           if(user =='1'  || user =='3'){
               var int1=15;
           }
           else 
           {
               var int1=30;
           }
           if(datetoday==date)
            {
                $('#fol_time').timepicker({disableTextInput: true}).val("");
                var min=formatTime(today);
                  if(min){
                      var minval=min;
                  }
                  else{
                    var minval="19:30:00";
                  }
                  $('#fol_time').timepicker('option', {minTime: minval, 
                        maxTime: '20:00:00',
                        step: int1,
                        disableTextInput: true
                         });                
            }
            else{
                $('#fol_time').timepicker({disableTextInput: true}).val(""); 
                $('#fol_time').timepicker('option', {minTime: '09:30:00', 
                        maxTime: '20:00:00', 
                        step: int1,
                        disableTextInput: true      });
                }
          }
}

     function formatTime(dt) {
      var hour=dt.getHours();
      var hournext=dt.getHours()+1;
      var chhour=((dt.getMinutes()>=30)?hournext:hour);
      if(19>chhour){
      return ((dt.getMinutes()>=30)?hournext:hour)  + ':' + ((dt.getMinutes()<30)?'30':'00').slice(-2) + (chhour >= 12 ? 'pm' : 'am')
    }
    else{
        return false;
    }
}
     $( "#follup_date" ).datepicker({
     minDate: '0',
      changeMonth: true, 
      changeYear: true,
      dateFormat: 'yy-mm-dd',
      onClose: function( selectedDate ) {
      $("#follup_date" ).datepicker( "option", "maxDate", selectedDate );
      }
    }).val();

    $("#current_residence_since").datepicker({
        maxDate: '0',
        changeMonth: true, 
        changeYear: true,
        dateFormat: 'yy-mm-dd',
        yearRange: "-65:+0",
        onClose: function(selectedDate) {
        $("#current_residence_since").datepicker("option", "maxDate", selectedDate);
        }
    }).val();

    $("#degree_reg_year").datepicker({
        maxDate: '0',
        changeMonth: true, 
        changeYear: true,
        dateFormat: 'yy-mm-dd',
        yearRange: "-65:+0",
        onClose: function(selectedDate) {
            $("#degree_reg_year").val(selectedDate);
        }
    }).val();
    
     $("#ring_auto").on("click", function(){
         if($('#ring_auto').is(':checked')){
             $("#ring_pop").css("display", "block");
         }
    });

$("#ad_fol_query").on("click", function(){

    var fol_type = $("#foll_type_pop").val();
    var fol_given = $("#folow_given_pop").val();
    var fol_date = $("#fol_date_pop").val();
    var fol_time = $("#fol_time_pop").val();
    var remark = $("#remark_pop").val();
    
    if(fol_type == '' && fol_given == '' && fol_date == '' && fol_time == '' ){
        alert("Please Fill All Details");
    } else if(fol_type == ''){
        alert("Please select Follow up Type");
    } else if(fol_given == ''){
        alert("Please select Follow up Given By");
    } else if(fol_date == ''){
        alert("Please select Follow up Date");
    } else if(fol_time == ''){
        alert("Please select Follow up Time");
    } else {
        $("#ring_pop").css("display", "none");
    }
});

$("#ad_new_query").on("click", function(){
     var data_string = $("#form_details,#generate_pop_up_form").serializeArray();
     var loan = $("#loan_ty_pop").val();
     var user_role = '<?php echo $user_role;?>';
     if(loan != '' && $("#occup_id_pop").val() != ''){
         if( loan == '57' && $("#type_of_registration_pop").val() == ''){
           alert("Business Registration Type Required");  
         }else if( loan == '57' && $("#bank_account_type_pop").val() == ''){
           alert("Type of Bank A/C Required");  
         } else {
     $.ajax({
         type: "POST",
            dataType: "text",
            data: data_string,
            cache: false,
            beforeSend: function () {
                $("#ad_new_query").attr('value', 'Processing...');
    			$("#ad_new_query").prop('disabled', true);
    			
            },                         
            url: "generate_query.php",
        success: function (data) {
            $("#ln_type_pop").css("display","none");
            if(user_role != '3'){
            window.location.href='https://astechnos.com/crmsml/query/';
            } else {
              window.location.href='https://astechnos.com/crmsml/query/user.php';  
            } 
        }
     });
     } 
     } else {
         alert("please select Loan Type and Occupation");
     }
});

$("#show_pan_related_phone").on("click",function(){
    var pan = $("#pan_card").val();
     $.ajax({
            data: "pancard="+pan,
            type: "POST",
            url: "<?php echo $head_url;?>/include/check-pancard.php",
            success:function(data){
            $("#show_pan_related_phone").addClass("hidden");
                $("#all_pan_details").html(data);   
            }
        });
});

});

function req_fields(){
    var loan_type_val = $("#loan_ty_pop").val();
    
    if(loan_type_val == 57){
        $(".loan57").removeClass("hidden");
        $(".net_incm_pop").addClass("hidden");
    } else {
        $(".loan57").addClass("hidden");  
         $(".net_incm_pop").removeClass("hidden");
    }
}

$(document).ready(function() {
  $("#city_id").focusout(function() {
    var case_id = "<?php echo $case_id; ?>";
    var query_id = "<?php echo $qryyy_id; ?>";
    var loan_type = "<?php echo $loan_type; ?>";
    var new_city = $("#city_id").val();
    if(new_city.trim() == "") {
      new_city = "";
    }
    if(case_id) {
    $.ajax({
      type: "POST",
      url: "../insert/bankers_mapping.php",
      data: "case_id="+case_id+"&query_id="+query_id+"&new_city="+new_city+"&loan_type="+loan_type+"&type=case",
      success: function(msg) {
          console.log(msg);
          if(msg.trim() == "") {
              $(".tab-11 > .facts > .register > .table_set").html("<h3>No Data Found</h3>");
          } else {                            
              $(".tab-11 > .facts > .register > .table_set").html(msg);
          }
      }
    });
    } else {
      $(".tab-11 > .facts > .register > .table_set").html('');
    }
  });
});

</script> 