<?php 
include("../../include/check-session.php");
include("../../include/config.php");
include("../../include/dropdown.php");
if(is_numeric($_REQUEST['lead_id']) && $_REQUEST['lead_id'] > 0){
  $case_id = $_REQUEST['lead_id'];
  $level_id = 2;
  $get_case_detail = mysqli_query($Conn1,"select cse.required_loan_amt,cust.net_incm,cust.city_id,city.city_name,city.city_sub_group_id,cse.fos_fol_date,cse.fos_fol_time,cse.fos_user_id,cse.fos_address,innt.pincode,cse.loan_type from tbl_mint_case as cse INNER JOIN tbl_mint_customer_info as cust ON cse.cust_id = cust.id LEFT jOIN tbl_mint_cust_info_intt as innt ON cust.id = innt.cust_id LEFT JOIN lms_city as city ON cust.city_id = city.city_id where cse.case_id = ".$case_id." LIMIT 1") OR die(mysqli_error($Conn1));
  if(mysqli_num_rows($get_case_detail) > 0){
    $result_case_id = mysqli_fetch_assoc($get_case_detail);
    $net_incm =  $result_case_id['net_incm'];
    $loan_amt= $result_case_id['required_loan_amt'];
    $pin_code = $result_case_id['pincode'];
    $city_name = $result_case_id['city_name'];
    $fos_fol_date = $result_case_id['fos_fol_date'];
    $fos_fol_time = $result_case_id['fos_fol_time'];
    $fos_user_id = $result_case_id['fos_user_id'];
    $fos_address = $result_case_id['fos_address'];
    $loan_type = $result_case_id['loan_type'];
    $city_id = $result_case_id['city_id'];
    $city_sub_group_id = $result_case_id['city_sub_group_id'];
    $dialog = 1;
  }else{
    exit;
  }
}else{
  exit;
}
?>
<style>
#case_follow_up_form.form-control {
    margin: 0!important;
    width:70%!important;
}
</style>
<script>
var mindval=0;
var maxdval=90;
function cse_datechange(){
  var value = $('#case_fol_date').val();
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
           var user=  $('#case_folow_given').val(); 
           if(user=='1'){
               var int=15;
           }
           else 
           {
               var int=30;
           }
           if(datetoday==date)
            {
                $('#case_fol_time').timepicker({disableTextInput: true}).val("");
                var min=cse_formatTime(today);
                  if(min){
                      var minval=min;
                  }
                  else{
                    var minval="19:30:00";
                  }
                  $('#case_fol_time').timepicker('option', {minTime: minval, 
                        maxTime: '20:00:00',
                        step: int,
                        disableTextInput: true
                         });                
            }
            else{
                $('#case_fol_time').timepicker({disableTextInput: true}).val(""); 
                $('#case_fol_time').timepicker('option', {minTime: '09:30:00', 
                        maxTime: '20:00:00', 
                        step: int ,
                        disableTextInput: true     });
                }  
}

  $( "#case_fol_date" ).datepicker({
     minDate: mindval,
     maxDate: maxdval,
     changeMonth: true, 
     changeYear: true,
      dateFormat: 'yy-mm-dd',
      onSelect: function(value, ui)
      {
        cse_datechange();
        },
      onClose: function( selectedDate ) {
      }
    });
$("#case_folow_given").change(function () {
    cse_datechange();               
    });  
           

            $("#fos_fol_date").datepicker({
                minDate: '0',
                maxDate: '90',
                changeMonth: true, 
                changeYear: true,
                dateFormat: 'yy-mm-dd',
                onSelect: function(value, ui) {
                    var today = new Date();
                    var date = Date.parse(value);
                    var month = today.getMonth()+1;
                    var days = today.getDate();
                    if (days < 10) {
                        days = "0" + days;
                    }
                    if (month < 10) {
                        month = "0" + month;
                    }
                    var tday = today.getFullYear()+"-"+month+"-"+days;
                    var datetoday = Date.parse(tday);
                    var user =  $('#case_folow_given').val(); 
                    if(user == '1' || user == '3'){
                        var int=15;
                    } else {
                        var int=30;
                    }
                    if(datetoday == date) {
                        $('#fos_fol_time').timepicker({disableTextInput: true}).val("");
                        var min = cse_formatTime(today);
                        if(min) {
                            var minval = min;
                        } else {
                            var minval = "19:30:00";
                        }
                        $('#fos_fol_time').timepicker('option', {minTime: minval, 
                            maxTime: '20:00:00',
                            step: int,
                            disableTextInput: true
                        });                
                    } else {
                        $('#fos_fol_time').timepicker({disableTextInput: true}).val(""); 
                        $('#fos_fol_time').timepicker('option', {
                            minTime: '09:30:00', 
                            maxTime: '20:00:00', 
                            step: int,
                            disableTextInput: true      
                        });
                    }        
                },
                onClose: function( selectedDate ) {
                }
            });


      
      function cse_formatTime(dt) {
          var hour = dt.getHours();
          var hournext = dt.getHours()+1;
          var chhour = ((dt.getMinutes() >= 30) ? hournext : hour);
          if(19 > chhour) {
          return ((dt.getMinutes() >= 30) ? hournext : hour)  + ':' + ((dt.getMinutes() < 30) ? '30' : '00').slice(-2) + (chhour >= 12 ? 'pm' : 'am')
          } else {
              return false;
          }
      }

$(document).ready(function() {
   // $(".fa-icon").remove();
    $("#case_ad_form").slideToggle();
    $("#case_ad_follow").remove();
    $("#case_follow_up_form select,#case_follow_up_form input[type='text'],#case_follow_up_form input[type='tel'],textarea").addClass("form-control");
    $('#case_follow_up_form').each(function () {
              $(this).validate({
              errorPlacement: function(error, element) {
                   if ( element.is(":radio"))
                      {
                          error.appendTo( element.parent('.error_contain') );
                      }
                      else
                      { // This is the default behavior
                          error.insertAfter( element );
                      }   
              },
              focusInvalid: false,                
              rules: {
              },
              messages: {
              },
              submitHandler: function (form) {
                  return false;
              }
              });
          });
    $('input[type=button]').click(function(){  
    if(this.id=='ad_case_query' && $('#case_follow_up_form').valid()){
                      $('#loader').css("display","block");
                      var data_string = $("#case_follow_up_form").serializeArray();
                      $.ajax({      
                        type: "POST",
                        dataType: "text",
                        data: data_string,
                        cache: false,
                        timeout: 60000,
                        url: "/sugar/cases/update-case-status.php",
                        success: function(response){
                          $('#loader').css("display","none");
                          var data = jQuery.parseJSON(response);
                          if(data.status == 'error'){
                            swal({
                              title: data.message,
                              text: "",
                              type: "error"
                           });
                          }else{
                            swal({
                              title: "Your Follow Up Added Successfully",
                              text: "",
                              type: "success"
                           });
                            setTimeout(  function() {    
                              $("#popup1").removeClass("popup-overlay");
                              $("#dialog-step").html("");
                          }, 3000);
                          }
                      }                                                                                 
                      });
                    } 
                    }); 
})
    

</script>
<?php include("../cases/case-follow-up.php"); ?>
<script type="text/javascript" src="../../include/js/jquery.timeentry.js"></script>  
<script src="../../include/js/jquery.timepicker.js"></script>
<link href="../../include/css/jquery.timepicker.min.css" rel="stylesheet"/> 
