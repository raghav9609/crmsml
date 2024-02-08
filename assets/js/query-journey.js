$(document).ready(function(){
    $('[name="city_name"]').focusout(function (){
      $.ajax({      
                  method:'GET',
                  data:"city_name="+this.value,
                  url: "check-city.php",
                  cache:false,
                  success: function(response){   
                    if(response == 0 || response == 26){
                      $('[name="city_name"]').val('');
                    }
                  }                                                                             
                });
    }); 
    $('[name="prop_city_id"]').on('focusout',function (){
      $.ajax({      
                  method:'GET',
                  data:"city_name="+this.value,
                  url: "check-city.php",
                  cache:false,
                  success: function(response){   
                    if(response == 0 || response == 26){
                      $('[name="prop_city_id"]').val('');
                    }
                  }                                                                                 
                });
    });

    //Changes - FDFieldsOnCRM - Akash - Starts
    $('#exis_relation').on('change',function () {
      if($("#exis_relation").val() == 2) {
        $(".sav_acc_no").removeClass("hidden");
        $("#sav_account_no").attr("required", true);
      } else {
        $(".sav_acc_no").addClass("hidden");
        $("#sav_account_no").attr("required", false);
      }
    });

    $("#proof_of_address").on('change',function () {
      $("#address_proof_no").prop('maxLength', 100);
      $("#address_proof_no").val("");
      var proof_of_add = $("#proof_of_address").val();
      if(proof_of_add == 1) {              //aadhar
          $("#address_proof_no").removeClass("alpha-num-fa alpha-num-fta alpha-num");
          $("#address_proof_no").addClass("numonly");
          $("#address_proof_no").prop('minLength', 12).prop('maxLength', 12);
      } else if(proof_of_add == 8) {       //passport
          $("#address_proof_no").removeClass("alpha-num alpha-num-fta numonly");
          $("#address_proof_no").addClass("alpha-num-fa");
          $("#address_proof_no").prop('minLength', 8).prop('maxLength', 8);
      } else if(proof_of_add == 4) {       //DL
          $("#address_proof_no").removeClass("alpha-num-fa alpha-num numonly");
          $("#address_proof_no").addClass("alpha-num-fta");
          $("#address_proof_no").prop('minLength', 13).prop('maxLength', 13);
      } else {
        $("#address_proof_no").removeClass("alpha-num-fa alpha-num-fta numonly");
        $("#address_proof_no").addClass("alpha-num");
        $("#address_proof_no").prop('minLength', 10).prop('maxLength', 25);
      }
    });

    $("#deposit_tenure").on('change',function () {
      var tenure_val = $("#deposit_tenure").val();
      var bnk_val = $("#banks_applied").val();
      if(tenure_val) {
          $.ajax({
              type: "POST",
              url: "/sugar/insert/rate-on-tenure.php",
              data: "tenure_val=" + tenure_val + "&bank_val=" + bnk_val,
              success: function(response) {
                  $("#deposit_interest").val(response);
              }
          });
      } else {
          $("#deposit_interest").val("");
      }
    });
    //Changes - FDFieldsOnCRM - Akash - Ends

    // function dl(){
    //     var occup_id = $('[name="occupation_id"] option:selected').val();
    //     if(occup_id == 1){
    //       $(".dl_salaried").removeClass('hidden').attr('required',true);
    //       $(".dl_senp").addClass('hidden').removeAttr('required').val('');
    //       $("input[name='place_of_business']").addClass('hidden').removeAttr('required').val('');
    //       $("#dl_work_on").text("Private Clinic");
    //     }else if(occup_id == 2){
    //       $(".dl_senp").removeClass('hidden').attr('required',true);
    //       $("input[name='place_of_business']").removeClass('hidden').attr('required',true);
    //       $(".dl_salaried").addClass('hidden').removeAttr('required').val('');
    //       $("#dl_work_on").text("Hospital");
    //     }else{
    //        $(".dl_senp,.dl_salaried,input[name='place_of_business']").addClass('hidden').removeAttr('required').val('');
    //        $("#dl_work_on").text("Private Clinic");
    //     }
    // }

    // function professional_loan(){
    //     var occup_id = $('[name="occupation_id"] option:selected').val();
    //     if(occup_id == 2){
    //       $(".dl_senp,.pl_senp,.gar").removeClass('hidden').attr('required',true);
    //       $("input[name='place_of_business']").removeClass('hidden').attr('required',true);
    //       $(".bl_sep").addClass('hidden').removeAttr('required').val('');
    //       $(".annual_turnover_value_formt,.annual_profit_value_formt").text('');

    //     }else if(occup_id == 3){
    //       $(".dl_senp,.bl_sep").removeClass('hidden').attr('required',true);
    //       $("input[name='place_of_business']").removeClass('hidden').attr('required',true);
    //       $(".pl_senp,.gar").addClass('hidden').removeAttr('required').val('');
    //       industry_type();
    //       type_of_registration();
    //     }else{
    //       $(".dl_senp,.pl_senp,.bl_sep,.gar").addClass('hidden').removeAttr('required').val('');
    //       $("input[name='place_of_business']").addClass('hidden').removeAttr('required').val('');
    //       $(".annual_turnover_value_formt,.annual_profit_value_formt").text('');
    //     }
    // }
    // function type_of_registration(){
    //   var val = $("#type_of_registration option:selected").val();
    //   if(val == 6 || val == 7 || val == 8){
    //     $("#bank_account_type").children("option[value='4']").hide();
    //   }else{
    //     $("#bank_account_type").children("option[value='4']").show();
    //   }
    // }
    
    function occupation(){
      var occupation = $('[name="occupation_id"] option:selected').val();
      var loan_type = $("#loan_type").val();
      if(occupation == 47 || occupation == 48){
        $(".self_emp").removeClass('hidden').attr('required','true');
        $(".salaried").addClass('hidden').val('').removeAttr('required');
        $(".net_month_inc_value_formt").text('');
        slry_paid();
      } else if(occupation == 46){
        $(".salaried").removeClass('hidden').attr('required','true');
        $(".self_emp").addClass('hidden').val('').removeAttr('required');
        $(".gross_annual_receipt_value_formt").text('');
      }else{
        $(".salaried,.self_emp").addClass('hidden').val('').removeAttr('required');
        slry_paid();
        $(".net_month_inc_value_formt,.gross_annual_receipt_value_formt").text('');
      }
    }
    function loan_type(){
      var loan_type_id = $("#loan_type").val();
      if(loan_type_id == 54){
        $("#occupation_id").children("option[value='2']").hide();
        $("#occupation_id").children("option[value='3']").hide();
        if( $("#occupation_id").val() == 2 || $("#occupation_id").val() == 3){
            $("#occupation_id").val('1');
            occupation();
        }
      }
    }
    function slry_paid(){
      var slry_paid = $('[name="slry_paid"] option:selected').val();
      if(slry_paid == 6){
        $(".main_acc").removeClass('hidden').attr('required',true);
      }else{
        $(".main_acc").addClass('hidden').removeAttr('required').val('');
      }
    }
    function loan_nature(){
        var nature_loan = $('[name="nature_loan"] option:selected').val();
        if(nature_loan == 2 || nature_loan == 3){
          $('.bt_case').removeClass('hidden').attr('required',true);
          $('.new_loan').addClass('hidden').removeAttr('required',true).val('');
          $('[name="prop_identified"]').prop('checked',false).removeAttr('required');
          $('[name="topup"]').attr('required',true);
          prop_identified();
          prop_sale();
          construction_type();
        }else{
          $('.bt_case').addClass('hidden').removeAttr('required').val('');
          $('.new_loan').removeClass('hidden').attr('required',true);
          $('[name="topup"]').prop('checked',false).removeAttr('required');
          $('[name="prop_identified"]').attr('required',true);
          $('.ex_emi_value_formt,.ex_amt_value_formt').text('');
          topup();
        }
    }
    function topup(){
      var topup = $('[name="topup"]:checked').val();
      if(topup == 1){
        $(".topup_yes").removeClass('hidden').attr('required',true);
      }else{
        $(".topup_yes").addClass('hidden').removeAttr('required').val('');
      }
    }
    function prop_identified(){
      var prop_identified = $('[name="prop_identified"]:checked').val();
      if(prop_identified == 'Y'){
        $(".prop_iden_yes").removeClass('hidden').attr('required',true);
        $(".prop_iden_no").addClass('hidden').removeAttr('required').val('');
      }else if(prop_identified == 'N'){
        $(".prop_iden_yes").addClass('hidden').removeAttr('required').val('');
        $(".prop_iden_no").removeClass('hidden').attr('required',true);
  prop_sale();
 construction_type();
      }else{
  prop_sale();
  construction_type();
         $(".prop_iden_yes,.prop_iden_no").addClass('hidden').removeAttr('required').val('');
      }
    }

function card_tocard(){
      var card_tocard = $('[name="card_tocard"]:checked').val();
      if(card_tocard == '1'){
        $(".card_to_card").removeClass('hidden').attr('required',true);
      }else{
        $(".credit_limit_value_formt").text('');
         $(".card_to_card").addClass('hidden').removeAttr('required').val('');
      }
    }

    function asset_type(){
      var prop_sale = $('[name="prop_identified_sale_type"] option:selected').val();
      var loan_type = $('[name="loan_type"]').val();
      var asset_type = $('[name="asset_type"] option:selected').val();
      if((asset_type == 2 || asset_type == 3) && (loan_type == 54 || loan_type == 52) && (prop_sale == 2 || prop_sale == 3)){
        $("#udconst").children("option[value='1']").hide();
        $("#udconst").children("option[value='4']").hide();
      }else{
        $("#udconst").children("option[value='1']").show();
        $("#udconst").children("option[value='4']").show();
      }
    }
    function prop_sale(){
      var prop_sale = $('[name="prop_identified_sale_type"] option:selected').val();
      var loan_type = $('[name="loan_type"]').val();
      var asset_type = $('[name="asset_type"] option:selected').val();
      if(prop_sale == 1){
        $('[name="srtm"]').attr('required',true);
        $('.srtm,.property_size,.prop_iden_mar_value').removeClass('hidden').attr('required',true);
        $('.udconst').addClass('hidden').removeAttr('required').val('');
        $("#udconst").children("option[value='1']").show();
        $("#udconst").children("option[value='4']").show();
          construction_type();
      }else if(prop_sale == 2 || prop_sale == 3){
         $('[name="srtm"]').removeAttr('required').prop('checked',false);
        $('.udconst,.property_size,.prop_iden_mar_value').removeClass('hidden').attr('required',true);
        $('.srtm').addClass('hidden').removeAttr('required').val('');
        if((asset_type == 2 || asset_type == 3) && (loan_type == 54 || loan_type == 52)){
          $("#udconst").children("option[value='1']").hide();
        $("#udconst").children("option[value='4']").hide();
        }
      }else{
        construction_type();
        $('[name="srtm"]').removeAttr('required').prop('checked',false);
        $('.srtm,.udconst,.property_size,.prop_iden_mar_value').addClass('hidden').removeAttr('required').val('');
        $("#udconst").children("option[value='1']").show();
        $("#udconst").children("option[value='4']").show();
      }
    }
    function construction_type(){
      var udconst = $('[name="udconst"] option:selected').val();
      if(udconst == 1){
        $(".buildername").removeClass('hidden').attr('required',true);
        $(".negative_ques").addClass('hidden').removeAttr('required').val('');
      }else if(udconst == 3){
        $(".buildername").addClass('hidden').removeAttr('required').val('');
        $(".negative_ques").removeClass('hidden').attr('required',true);
        var neg_ques_city = $("#prop_city_id").val();
        if(neg_ques_city != ''){
          $.ajax({      
            method:'POST',
            data:'city='+neg_ques_city+'&val='+negative_ques_val,
              url: "../home_loan_filter/negativequs.php",
              success: function(response) {                                          
                        $("#negative_ques").html(response)
              }                                                                                 
            });
        }
        
      }else{
        $(".buildername,.negative_ques").addClass('hidden').removeAttr('required').val('');
      }
    }
    function credit_running(){
      var credit_running_val = $('[name="credit_running"] option:selected').val();
      if(credit_running_val == 1){
        $(".ext_card_1").removeClass('hidden').attr('required',true);
        $(".ext_card_2,.ext_card_3,.ext_card_4,.ext_card_5").addClass('hidden').removeAttr('required').val('');
        $('.credit_sanction_amt_tw_value_formt,.current_out_stan_tw_value_formt,.credit_sanction_amt_th_value_formt,.current_out_stan_th_value_formt,.credit_sanction_amt_fr_value_formt,.current_out_stan_fr_value_formt,.credit_sanction_amt_fv,.current_out_stan_fr_value_formt').text('');
      }else if(credit_running_val == 2){
        $(".ext_card_1,.ext_card_2").removeClass('hidden').attr('required',true);
        $(".ext_card_3,.ext_card_4,.ext_card_5").addClass('hidden').removeAttr('required').val('');
      $('.credit_sanction_amt_th_value_formt,.current_out_stan_th_value_formt,.credit_sanction_amt_fr_value_formt,.current_out_stan_fr_value_formt,.credit_sanction_amt_fv,.current_out_stan_fr_value_formt').text('');
      }else if(credit_running_val == 3){
        $(".ext_card_1,.ext_card_2,.ext_card_3").removeClass('hidden').attr('required',true);
        $(".ext_card_4,.ext_card_5").addClass('hidden').removeAttr('required').val('');
      $('.credit_sanction_amt_fr_value_formt,.current_out_stan_fr_value_formt,.credit_sanction_amt_fv,.current_out_stan_fr_value_formt').text('');
      }else if(credit_running_val == 4){
        $(".ext_card_1,.ext_card_2,.ext_card_3,.ext_card_4").removeClass('hidden').attr('required',true);
        $(".ext_card_5").addClass('hidden').removeAttr('required').val('');
        $('.credit_sanction_amt_fv,.current_out_stan_fr_value_formt').text('');
      }else if(credit_running_val == 5){
        $(".ext_card_1,.ext_card_2,.ext_card_3,.ext_card_4,.ext_card_5").removeClass('hidden').attr('required',true);
      }else{
        $(".ext_card_1,.ext_card_2,.ext_card_3,.ext_card_4,.ext_card_5").addClass('hidden').removeAttr('required').val('');
      $('.credit_sanction_amt_on_value_formt,.current_out_stan_on_value_formt,.credit_sanction_amt_tw_value_formt,.current_out_stan_tw_value_formt,.credit_sanction_amt_th_value_formt,.current_out_stan_th_value_formt,.credit_sanction_amt_fr_value_formt,.current_out_stan_fr_value_formt,.credit_sanction_amt_fv,.current_out_stan_fr_value_formt').text('');
      }
    }
    function existing_loan(){
      var exis_loans = $('[name="exis_loans"] option:selected').val();
      if(exis_loans == 1){
        $(".ext_loan_1").removeClass('hidden').attr('required',true);
        $(".ext_loan_2,.ext_loan_3,.ext_loan_4,.ext_loan_5").addClass('hidden').removeAttr('required').val('');
      }else if(exis_loans == 2){
        $(".ext_loan_1,.ext_loan_2").removeClass('hidden').attr('required',true);
        $(".ext_loan_3,.ext_loan_4,.ext_loan_5").addClass('hidden').removeAttr('required').val('');
      }else if(exis_loans == 3){
        $(".ext_loan_1,.ext_loan_2,.ext_loan_3").removeClass('hidden').attr('required',true);
        $(".ext_loan_4,.ext_loan_5").addClass('hidden').removeAttr('required').val('');
      }else if(exis_loans == 4){
        $(".ext_loan_1,.ext_loan_2,.ext_loan_3,.ext_loan_4").removeClass('hidden').attr('required',true);
        $(".ext_loan_5").addClass('hidden').removeAttr('required').val('');
      }else if(exis_loans == 5){
        $(".ext_loan_1,.ext_loan_2,.ext_loan_3,.ext_loan_4,.ext_loan_5").removeClass('hidden').attr('required',true);
      }else{
        $(".ext_loan_1,.ext_loan_2,.ext_loan_3,.ext_loan_4,.ext_loan_5").addClass('hidden').removeAttr('required').val('');
      }
    }
    $('[name="nature_loan"]').on('change',function (){
      loan_nature();
    });
    $('[name="occupation_id"]').on('change',function (){
      occupation();
    });
    $('[name="topup"]').on('change',function (){
      topup();
    });
    $('[name="prop_identified"]').on('change',function (){
      prop_identified();
    });
    $('[name="prop_identified_sale_type"]').on('change',function (){
      prop_sale();
    });
    $('[name="udconst"]').on('change',function (){
      construction_type();
    });
    $('[name="slry_paid"]').on('change',function (){
      slry_paid();
    });
    $('[name="asset_type"]').on('change',function (){
      asset_type();
    });
    $('[name="card_tocard"]').on('change',function (){
      card_tocard();
    });
    $('[name="credit_running"]').on('change',function (){
      credit_running();
    });
     $('[name="exis_loans"]').on('change',function (){
      existing_loan();
    });
    // $('[name="nature_of_business"]').on('change',function (){
    //   industry_type();
    // });
    // $('[name="type_of_registration"]').on('change',function (){
    //   type_of_registration();
    // });
    // function bank_process_insert(){
    //   if($("#case_id").val() != '' && $("#case_id").val() != '0' && $('#form_step3').valid()){
    //     $.ajax({      
    //               method:'POST',
    //               data:$("#form_step3").serialize(),
    //               url: "/sugar/cases/sent-to-bank-new.php",
    //               success: function(data){
    //                 if($.trim(data) != ''){
    //                   window.open(data,'BAJAJ',config='height=1200,width=1200,toolbar=no,menubar=no,scrollbars=no,resizable=no,location=no,directories=no,status=no');
    //                 }
    //                 console.log("success from step 3");                                    
    //               }                                                                                 
    //             });
    //   }
    // }
    // function industry_type(){
    //   var nature_of_business = $("#nature_of_business option:selected").val();
    //   if(nature_of_business != ''){
    //       $.ajax({      
    //         method:'POST',
    //         data:'nature_of_business='+nature_of_business+'&val='+industry_id,
    //           url: "/../include/get-industry-id.php",
    //           success: function(response) {                                          
    //                     $("#industry_type").html(response)
    //           }                                                                                 
    //         });
    //     }
    // }
    
    loan_type();
    occupation();
    loan_nature();
    topup();
    prop_identified();
    prop_sale();
    construction_type();
    slry_paid();
    asset_type();
    card_tocard();
    credit_running();
    existing_loan();
    // industry_type();
    // type_of_registration();

    function verticalToggle(btnid){
      $('#form_'+btnid).prev('.brdr-top-gray').addClass('step-green').removeClass('blue-bg');
      $('#form_'+btnid).next('.blue-bg').addClass('white').removeClass('gray');
      $('#form_'+btnid).next('.brdr-top-gray').next('form').slideDown(300);
      $('#form_'+btnid).slideUp(300);
    }

    $("input").addClass('valid');
      $(".form-step .form-group select").addClass('valid form-control');
      $("#dob").datepicker({
          changeMonth: true,
          changeYear: true,
          dateFormat: 'yy-mm-dd',
          yearRange: "-65:-18",
          defaultDate: '-21yr',
      });
      $("#cur_lo_s_m1").datepicker({
          changeMonth: true,
          changeYear: true,
          dateFormat: 'yy-mm-dd',
      });

      $.validator.addMethod("mobile", function (value, element) {
        var lastseven = value.substr(value.length - 7);
        var num_charstring_number = value.substr(4,4);
        var last_digit = value.slice(0, 2);
        var cr_str = Array(6).join(last_digit);
  
        var result = false;
        if (/^[6789]\d{9}$/i.test(value)) {
            result = true;
        }
        if (value === '9876543210') {
            result = false;
        }
        if (/^(\d)\1+$/.test(lastseven)) {
            result = false;
        }
        if (value === cr_str) {
            result = false;
        }
    if(num_charstring_number == 'XXXX'){
      result = true;
    }
        return result;
  }, "Enter Valid Mobile number");
      jQuery.validator.addMethod("validDate", function (value, element) {
      var Reg_Expression = /^\d{4}\-\d{1,2}\-\d{1,2}$/;
      if(value == ''){
        result = true;
      }else if (Reg_Expression.test(value)) {
          var result = true;
          var dob = new Date(value);
          var today = new Date();
          var sum = today.getFullYear() - dob.getFullYear();
          if ((dob.getFullYear() + 21 <= today.getFullYear()) && (dob.getFullYear() + 65 >= today.getFullYear())) // calculate selected date is greater 18 or not
          {
               result = true;
          }
          else {
               result = false;
          }
      }
      return result;
  }, "Min 21years & max 65 yrs");

      $.validator.addMethod("pan", function (value, element) {
       return this.optional(element) || /^[A-Za-z]{3}[Pp]{1}[A-Za-z]{1}\d{4}[A-Za-z]{1}$/.test(value);
  }, "Invalid Pan Number");
      /*$.validator.addMethod("validCity", function (value, element) {
       check_valid_city(value);
  }, "Enter Valid City");*/
      $.validator.addMethod("lessThan",
      function (value, element, param) {
          var $otherElement = $(param);
          return parseInt(value, 10) <= parseInt($otherElement.val(), 10);
      });


      $('#form_step1').each(function () {
          $(this).validate({
          errorPlacement: function(error, element) {
               if ( element.is(":radio"))
                  {
                      error.appendTo( element.parent('.error_contain') );
                  }else if(element.attr("type") == "checkbox"){
                    error.insertAfter($(element).parents('div').prev($('.error_contain')));
                  }
                  else
                  { // This is the default behavior
                      error.insertAfter( element );
                  }   
          },
          focusInvalid: false,                
          rules: {
            pan_card:{
              pan:true
            },
            agreement_value: {
                  lessThan: "#prop_iden_mar_value",
              },
            dob:{
              validDate:true
            }
          },
          messages: {
            agreement_value:{
              lessThan:"Agreement Value Can't be more than Market Value",
            },
          },
          submitHandler: function (form) {
              return false;
          }
          });
      });

      $('#form_step2').each(function () {
          $(this).validate({
          errorPlacement: function(error, element) {
               if ( element.is(":radio") )
                  {
                      error.appendTo( element.parent('.error_contain') );
                  }else if(element.attr("type") == "checkbox"){
                    error.insertAfter($(element).parents('div').prev($('.error_contain')));
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
      $('#form_step3').each(function () {
          $(this).validate({
          errorPlacement: function(error, element) {
               if ( element.is(":radio") )
                  {
                      error.appendTo( element.parent('.error_contain') );
                  }else if(element.attr("type") == "checkbox"){
                    error.insertAfter($(element).parents('div').prev($('.error_contain')));
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
      $('#form_step4').each(function () {
          $(this).validate({
          errorPlacement: function(error, element) {
               if ( element.is(":radio") )
                  {
                      error.appendTo( element.parent('.error_contain') );
                  }else if(element.attr("type") == "checkbox"){
                    error.insertAfter($(element).parents('div').prev($('.error_contain')));
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
    // console.log("hiiiiiiii");
              if((this.id=='step1' && $('#form_step1').valid()) || this.id=='step1-temp'){
                $('#loader').css("display","block");
                $.ajax({      
                  method:'POST',
                  data:$("#form_step1").serialize(),
                  url: "update-details.php",
                  cache: false,
                  timeout: 60000,
                  success: function(response){ 
                    // console.log(response);
                    setTimeout(  function() {  
                      if($("#occupation_id option:selected").val() == 2 || $("#occupation_id option:selected").val() == 3){
                        $("#net_month_inc").val(($("#gross_annual_receipt").val()/12));
                      }          
                      console.log("success from step 1");
                      $('#loader').css("display","none");
                      verticalToggle('step1');
                    }, 2000);                        
                  },
                  error: function (xhr, status, error) {
                    console.error("AJAX Error:", status, error);
                  }                                                                           
                }); 
      }else if((this.id=='step2' && $('#form_step2').valid()) || this.id=='step2-temp'){
        $('#loader').css("display","block");
                $.ajax({      
                  method:'POST',
                  data:$("#form_step2").serialize(),
                  url: "update-details.php",
                  cache: false,
                  timeout: 60000,
                  success: function(response){
                    suggestion_box('2');
                    setTimeout(  function() {  
                      console.log("success from step 2");
                      $('#loader').css("display","none");
                      verticalToggle('step2');
                    }, 2000);                                    
                  }                                                                                 
                }); 
              } else if(this.id=='step3' && $('#form_step3').valid() && $('#form_step1').valid() && $('#form_step2').valid()){
                $('#loader').css("display","block");
                var patIds = [];
                $(".check_bank:checked").each(function() {
                  patIds.push($(this).val());
                });

                $.ajax({      
                  method:'POST',
                  data:"query_id="+$("[name='id']").val()+"&partner_id="+patIds+"&loan_amount="+$("[name='loan_amount']").val()+"&user_id="+$("[name='user_id']").val(),
                  url: "/crmsml/query/create-process.php",
                  cache: false,
                  timeout: 60000,
                  success: function(response){
                    console.log("Application Created successfully");
                    alert("Application Created successfully");
                    //window.location.href = 'https://astechnos.com/crmsml/query/index.php';
                    $('#loader').css("display","none");
                    verticalToggle('step1');
                  }                                                                                 
                });
              } else if(this.id=='step4' && $('#form_step4').valid()){
                $('#loader').css("display","block");
                var data_string = $("#form_step4").serializeArray();
                $.ajax({      
                  type: "POST",
                  dataType: "text",
                  data: data_string,
                  cache: false,
                  timeout: 60000,
                  url: "/sugar/cases/add_follow_up_ajax.php",
                  success: function(response){
                    setTimeout(  function() {  
                      console.log("Follow Up Added Successfully");  
                    alert("Follow Up Added Successfully");
                    if(user_role == 3){
                      window.location.href = 'https://astechnos.com/crmsml/query/user.php';
                    }else{
                      window.location.href = 'https://astechnos.com/crmsml/query/index.php';
                    }
                    $('#loader').css("display","none");
                    verticalToggle('step4');
                    }, 3000);  
                }                                                                                 
                });
              }   
      });
      $('.tab-click').click(function(){
        $('.form-step').slideUp(300);
        $('.tab-click').removeClass('active-tab');
        $('#form_'+$(this).attr("data-toggle")).slideDown(300);
        $(this).addClass('active-tab');
        // console.log($(this).attr("data-toggle"));
        if($(this).attr("data-toggle") == 'step2') {
          $('#form_step2').after($('#switch_step1'));
          $('#switch_step1').after($('#form_step1')).removeClass('white').addClass('gray');
          $('#switch_step2').removeClass('gray').addClass('white')
          $('#text_step2').text('STEP 1');
          $('#text_step1').text('STEP 2');
        } else {
          $('#form_step1').after($('#switch_step2'));
          $('#switch_step2').after($('#form_step2')).removeClass('white').addClass('gray'); 
          $('#switch_step1').removeClass('gray').addClass('white')
          $('#text_step2').text('STEP 2');
          $('#text_step1').text('STEP 1');
        }
      });
      $('.white-bg').on('click', '.step-green' ,function(){
         // $('#form_'+$(this).attr("data-toggle")).slideToggle(300);
         $('.form-step').slideUp(300);
          $('#form_'+$(this).attr("data-toggle")).slideDown(300);
      });

      $(".residential_pincode").hide();
      $(".customer_city").hide();
      $(".appointment_time").hide();
      $(".appointment_date").hide();
      $(".fos_flag").hide();
      $(".fos_user").hide();
      $(".fos_add").hide();

      $("#fos_check").change(function() {
          if(!this.checked) {
              $("#fos_fol_date").val("");
              $("#fos_fol_time").val("");
              $("#fos_address").val("");
              $("#fos_users").val("");
          }
      });

      $("#fos_check").change(function() {
          if(this.checked) {
              $(".appointment_time").show();
              $(".appointment_date").show();;
              $(".fos_add").show();
              $(".fos_user").show();
              $("#fos_fol_date").prop('required', true);
              $("#fos_fol_time").prop('required', true);
              $("#fos_address").prop('required', true);
              $("#fos_users").prop('required', true);
          } else {
              $(".appointment_time").hide();
              $(".appointment_date").hide();
              $(".fos_add").hide();
              $(".fos_user").hide();
              $("#fos_fol_date").prop('required', false);
              $("#fos_fol_time").prop('required', false);
              $("#fos_address").prop('required', false);
              $("#fos_users").prop('required', false);
          }
      });

      $("#case_folow_given").change(function () {
          $("#case_fol_date").datepicker({});
          $('#case_fol_time').timepicker({disableTextInput: true});
          var today = new Date();
          var month = today.getMonth() + 1;
          var days = today.getDate();
          if (days < 10) {
              days = "0" + days;
          }
          if (month < 10) {
              month = "0" + month;
          }
          var min = formatTime(today);
          if(min) {
              var minval = min;
          }
          else {
          var minval = "19:30:00";
          }

          $('#case_fol_time').timepicker('option', {
              minTime: minval, 
              maxTime: '20:00:00',
              step: 30,
              disableTextInput: true
          });
      });

      var mindval=0;
      var maxdval=90;

      $("#case_f_stats").change(function(){
        $("#case_fol_date").datepicker({}).val('');
        $('#case_fol_time').timepicker({disableTextInput: true}).val("");
        var selected_values = $("#case_f_stats").val();
        if(selected_values == "9") {
          var loan_type=$("#loan_type").val()
          if(loan_type==54) {
            mindval=7;
            maxdval=90;  
          }
      } else if( selected_values == "1") {
        var loan_type=$("#loan_type").val()
        if(loan_type==54){
            mindval=0;
            maxdval=7;  
        }
      }
          else {
            mindval=0;
            maxdval=90;
          }
      });


      $("#case_fol_date").datepicker({
        minDate: mindval,
        maxDate: maxdval,
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
            //ChangesID - Starts
            var user =  $('#case_folow_given').val(); 
            //ChangesID - Ends
            if(user == '1' || user == '3'){
                var int=15;
            } else {
                var int=30;
            }
            if(datetoday == date) {
                $('#case_fol_time').timepicker({disableTextInput: true}).val("");
                var min = formatTime(today);
                if(min) {
                    var minval = min;
                } else {
                    var minval = "19:30:00";
                }
                $('#case_fol_time').timepicker('option', {minTime: minval, 
                    maxTime: '20:00:00',
                    step: int,
                    disableTextInput: true
                });                
            } else {
                $('#case_fol_time').timepicker({disableTextInput: true}).val(""); 
                $('#case_fol_time').timepicker('option', {
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

      $("#case_folow_given").change(function () {
          $("#fos_fol_date" ).datepicker({});
          $('#fos_fol_date').timepicker({disableTextInput: true});
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
                  var min = formatTime(today);
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

  });

  function cng_case_status(e) {

    var is_fos = $("#is_fos").val();
    if(is_fos == 0) {
        if(e == 2 || e == 1 || e == 8) {
            $(".fos_flag").show();
        } else {
            $(".fos_flag").hide();
            $(".appointment_time").hide();
            $(".appointment_date").hide();
            $(".fos_add").hide();
            $(".fos_user").hide();
            $("#fos_check").prop("checked", false);
            $("#fos_fol_date").prop('required', false);
            $("#fos_fol_time").prop('required', false);
            $("#fos_address").prop('required', false);
            $("#fos_users").prop('required', false);
        }
    } else if(is_fos == 1) {
        var if_checked = document.getElementById("fos_check").checked;
        if(if_checked == true) {
            $(".fos_flag").show();
            $(".appointment_time").show();
            $(".appointment_date").show();
            $(".fos_add").show();
            $(".fos_user").show();
        } else {
            $(".fos_flag").hide();
            $(".appointment_time").hide();
            $(".appointment_date").hide();
            $(".fos_add").hide();
            $(".fos_user").hide();
        }
    }

    var selected_value = e;
    if(selected_value == "10") {
        $(".customer_city").show();
        $("#residential_pincode").show();
        $("#case_fol_city_id").prop("required", true);
        $("#case_fol_pin_code").prop("required", true);
    } else {
        $("#customer_city").hide();
        $("#residential_pincode").hide();
        $("#case_fol_city_id").prop("required", false);
        $("#case_fol_pin_code").prop("required", false);
    }

    if(e == 1 || e == 9 || e == 8) {
      $("#case_foll_type option[value='4']").remove();
    } else {
        if($("#case_foll_type option[value='4']").length == 0) {
            $("#case_foll_type").append('<option value="4" data-target="Closed">Closed</option>');
        }
    }
    
    if(selected_value == 2 && $("#foll_type").val() != 4) {
      $("#case_foll_type").prop("required", true);
      $("#case_fol_date").prop("required", true);
      $("#case_fol_time").prop("required", true);
    } else if(selected_value == 1 || selected_value == 9) {
      $("#case_foll_type").prop("required", true);
      $("#case_fol_date").prop("required", true);
      $("#case_fol_time").prop("required", true);
    } else {
      $("#case_foll_type").prop("required", false);
      $("#case_fol_date").prop("required", false);
      $("#case_fol_time").prop("required", false);
    }
}

function cng_followup_type(e) {
  console.log(e);
  if(e == 4) {
      $("#case_fol_date").prop("required", false);
      $("#case_fol_time").prop("required", false);
  } else {
      $("#case_fol_date").prop("required", true);
      $("#case_fol_time").prop("required", true);
  }
}

function formatTime(dt) {
    var hour = dt.getHours();
    var hournext = dt.getHours()+1;
    var chhour = ((dt.getMinutes() >= 30) ? hournext : hour);
    if(18 > chhour) {
    return ((dt.getMinutes() >= 30) ? hournext : hour)  + ':' + ((dt.getMinutes() < 30) ? '30' : '00').slice(-2) + (chhour >= 12 ? 'pm' : 'am')
    } else {
        return false;
    }
}