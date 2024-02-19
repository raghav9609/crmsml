$(document).ready(function() {
    
    $("input").addClass('valid');
    $(".form-step .form-group select").addClass('valid form-control');

    $("#comp_name").autocomplete({
        source: "../include/company_search.php",
        minLength: 1,
    });	
    
    $(".city_pin_search").autocomplete({
        source: "../include/city_pin_name.php",
        minLength: 1
    });

    var cust_phn = $("#cust_phn").val();
    if(cust_phn.trim() != "") {
        var customer_mobile = cust_phn.trim();
        $("#phone_no").val(customer_mobile);

        $.ajax({
            type: "POST",
            url: "/crmsml/query/fetch_customer_details.php",
            data: "customer_phone="+customer_mobile,
            success: function(response) {
                var customer_details = JSON.parse(response);
                console.log(customer_details);
                if(customer_details.length != 0) {
                    $("#name").val(customer_details.customer_name);
                    if(customer_details.city_name.trim() == "") {
                        $("#city_name").val(customer_details.pincode);
                    } else {
                        $("#city_name").val(customer_details.city_name);
                    }
                    $("#phone_no").val(customer_mobile);
                    $(".phone_no").addClass("hidden");
                    $("#net_month_inc").val(customer_details.net_income);
                    $("#comp_name").val(customer_details.company);
                    $("#salary_method").val(customer_details.salary_pay_id);
                    $('input:radio[name=occupation_id]').val(customer_details.occupation_id);
                    if(customer_details.date_of_birth != "" && customer_details.date_of_birth != "0000-00-00") {
                        $("#pl_dob").val(customer_details.date_of_birth);
                    }
                    $("#banks_list").val(customer_details.cust_bank_id);
                } else {
                    $(".phone_no").addClass("hidden");
                    $('#add_query_form').find("input[type=text], textarea, input[type=tel]").val("");
                    $('#add_query_form').find("input[name='phone_no']").val(customer_mobile);
                }
            }
        });
    }

    var url_missed_id = $("#missed_id").val();
    if(url_missed_id.trim() != "") {
        $("input").attr("required", false);
        $("select").attr("required", false);
        $("#phone_no").attr("required", true);
        $("label.label-tag").not(".missed-id-tag").addClass('optional-tag');
    }


    $( "#pl_dob" ).datepicker({
        changeMonth: true, 
        changeYear: true,
        dateFormat: 'yy-mm-dd',
        yearRange: "-65:-20",
        onClose: function( selectedDate) {
            $("#pl_dob" ).datepicker( "option", "", selectedDate );
        },onSelect: function(value, ui) {
            console.log(ui.selectedYear)
        }
    }).val(); 

    $("input[name='occupation_id']").on("change", function() {
        var occup_val = $(this).val();
        if(occup_val == '2' && $("#loan_type").val() == 57) {
            $("#loan_type").val('63');
            loan_type_chng();
            occup_id_ni();
        } else if(occup_val == '3' && $("#loan_type").val() == 63) {
            $("#loan_type").val('57');
            loan_type_chng();
            occup_id_ni();
        } else if(occup_val == '2' && $("#loan_type").val() == 32) {
            $(".profession").removeClass("hidden");
            occup_id_ni();
        } else if(occup_val == '3' && $("#loan_type").val() == 32) {
            $(".profession").addClass("hidden");
            $(".anl_profit").removeClass("hidden");
            occup_id_ni();
        } else if(occup_val == '1') {
            occup_id_ni();
        } else if(occup_val == '2' || occup_val == '3') {
            $("#net_month_inc").attr("required", false);
            $("#nmi_label").addClass("optional-tag");
            occup_id_ni();
        }
        fun_missed_id();
    });

    $("#fetch_details").on("click", function() {
        console.log("clicked");
        var customer_phone = $("#customer_phone").val();
        if(customer_phone.length == 10) {
            if(parseInt(customer_phone) > 6000000000 && parseInt(customer_phone) <= 9999999999) {
                $("#customer_phone-error").addClass("hidden");
                $.ajax({
                    type: "POST",
                    url: "/crmsml/query/fetch_customer_details.php",
                    data: "customer_phone="+customer_phone,
                    beforeSend: function () {
                        $("#fetch_details").attr('value', 'Fetching...').prop('disabled', true);
                    },
                    success: function(response) {
                        $("#fetch_details").attr('value', 'Fetch Details').prop('disabled', false);
                        var customer_details = JSON.parse(response);
                        console.log(customer_details);
                        if(customer_details.length != 0) {
                            $("#name").val(customer_details.customer_name);
                            if(customer_details.city_name.trim() == "") {
                                $("#city_name").val(customer_details.pincode);
                            } else {
                                $("#city_name").val(customer_details.city_name);
                            }
                            $("#phone_no").val(customer_phone);
                            $(".phone_no").addClass("hidden");
                            $("#net_month_inc").val(customer_details.net_income);
                            $("#comp_name").val(customer_details.company);
                            $("#salary_method").val(customer_details.salary_pay_id);
                            $('input:radio[name=occupation_id]').val(customer_details.occupation_id);
                            if(customer_details.date_of_birth != "" && customer_details.date_of_birth != "0000-00-00") {
                                $("#pl_dob").val(customer_details.date_of_birth);
                            }
                            $("#banks_list").val(customer_details.cust_bank_id);
                        } else {
                            $(".phone_no").removeClass("hidden");
                            $('#add_query_form').find("input[type=text], textarea, input[type=tel]").val("");
                            $("#customer_phone").val(customer_phone);
                            $("#customer_phone-error").removeClass("hidden").css("display", "block");
                            $("#customer_phone-error").html("No data found");
                            $('#add_query_form').find("input[name='phone_no']").val(customer_phone);
                        }
                    }
                });
            } else {
                $("#customer_phone-error").html("Please enter valid mobile number");
                $("#customer_phone-error").css("display", "block");
                $("#customer_phone-error").removeClass("hidden");
            }
        } else {
            $("#customer_phone-error").html("This field is required");
            $("#customer_phone-error").css("display", "block");
            $("#customer_phone-error").removeClass("hidden");
        }
    });

    $("input[name='assign_to']").on("change",function() {
        if($(this).val() == 3) {
            $(".user_assign").removeClass("hidden");
            $("#u_assign").attr("required", true);
            $("#u_assign_label").removeClass("optional-tag");
        } else {
             $(".user_assign").addClass("hidden");
             $("#u_assign").attr("required", false);
             $("#u_assign_label").addClass("optional-tag");
        }
        fun_missed_id();
    });
    
    jQuery.validator.addMethod("mobile", function (value, element) {
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

    $('#add_query_form').each(function () {
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
                name: "required",
                phone_no: {required: true, minlength: 10, maxlength: 10, min: 6000000000, max: 9999999999},
                city_name: "required",
                loan_type: "required"
            },
            messages: {
                name: "This field is required",
                phone_no: {required: "This field is required", minlength: "Please enter valid mobile number (10) ", maxlength: "Please enter valid mobile number (10) ", min: "Please enter valid mobile number", max: "Please enter valid mobile number"},
                city_name: "This field is required",
                loan_type: "This field is required"
            },
            submitHandler: function (form) {
                return false;
                // form.submit();
            }
        });
    });

    $('input[type=submit]').click(function(){ 
        var data_target = this.id;
            //alert(data_target);
        if($("#add_query_form").valid()) {
            $.ajax({      
                method:'POST',
                data:$('#add_query_form').serialize(),
                url: "hl-journey/add-query-details.php",
                cache:false,
                success: function(response){   
                    window.location.href=response;
                }                                                                                 
            });
        }
    });
   
});

function loan_type_chng() {
    $(".acq_mod, .user_ass").removeClass("hidden");
    var loan_type = $("#loan_type").val();

      $("#occupation_id1").prop('checked','true');
     $(".net_inc,.occupation1").removeClass("hidden");
     $(".anl_profit,.amt_deposit").addClass("hidden");
     $("#amt_deposit").attr('required', false);
    if(loan_type == 56) {
        $(".loan_amount,.salary_method,.company").removeClass("hidden");
        $(".gl_fields,.business,.profession,.occupation_id,.amt_deposit").addClass("hidden");
        $("#amt_deposit").attr('required', false);
        $(".mandatory-mark").removeClass("hidden");
        $("#pl_dob, #loan_amount, #net_month_inc, #comp_name, #salary_method").attr('required', true);
        $(".bank_account_type, .bus_reg_with").addClass("hidden");
        $("#bank_account_type, #bus_reg_with").attr('required', false);
        $("#label-for-dob, #salary_method_label, #nmi_label, #comp_name_label").removeClass("optional-tag");
        occup_id_ni();
        spb_change();
    }else if(loan_type == 51) {
        $("#label-for-dob, #salary_method_label, #nmi_label, #comp_name_label").addClass("optional-tag");
        $(".loan_amount,.occupation_id").removeClass("hidden");
        $(".salary_method,.company,.gl_fields,.business,.profession,.amt_deposit").addClass("hidden");
        $("#amt_deposit").attr('required', false);
        $(".mandatory-mark").addClass("hidden");
        $("#pl_dob").attr('required', false);
        $(".bank_account_type, .bus_reg_with").addClass("hidden");
        $("#bank_account_type, #bus_reg_with, #net_month_inc, #comp_name, #salary_method").attr('required', false);
        $("#loan_amount").attr("required", true);
        occup_id_ni();
        spb_change();
    }else if(loan_type == 57) {
        $("#label-for-dob, #salary_method_label, #nmi_label, #comp_name_label").addClass("optional-tag");
        $(".loan_amount,.business,.occupation_id,.anl_profit").removeClass("hidden");
        $(".gl_fields,.company,.profession,.salary_method,.net_inc,.occupation1,.amt_deposit").addClass("hidden");
        $("#occupation_id3").prop('checked','true');
        $("#amt_deposit").attr('required', false);
        $(".mandatory-mark").addClass("hidden");
        $("#pl_dob, #net_month_inc, #comp_name, #salary_method").attr('required', false);
        $(".bank_account_type, .bus_reg_with").removeClass("hidden");
        $("#bank_account_type, #bus_reg_with, #loan_amount").attr('required', true);
        spb_change();
        occup_id_ni();
    }else if(loan_type == 54 || loan_type == 52) {
        $("#label-for-dob, #salary_method_label, #nmi_label, #comp_name_label").addClass("optional-tag");
        $(".loan_amount,.occupation_id").removeClass("hidden");
        $(".salary_method,.gl_fields,.company,.business,.profession,.amt_deposit").addClass("hidden");
        $("#amt_deposit").attr('required', false);
        $(".mandatory-mark").addClass("hidden");
        $("#pl_dob, #net_month_inc, #comp_name, #salary_method").attr('required', false);
        $(".bank_account_type, .bus_reg_with").addClass("hidden");
        $("#bank_account_type, #bus_reg_with").attr('required', false);
        $("#loan_amount").attr("required", true);
        spb_change();
        occup_id_ni();
    }else if(loan_type == 71) {
        $("#label-for-dob, #salary_method_label, #nmi_label, #comp_name_label").addClass("optional-tag");
        $(".loan_amount,.gl_fields,.business,.profession,.amt_deposit").addClass("hidden");
        $(".salary_method,.company,.occupation_id").removeClass("hidden");
        $("#amt_deposit").attr('required', false);
        $(".mandatory-mark").addClass("hidden");
        $("#pl_dob, #net_month_inc, #comp_name, #salary_method").attr('required', false);
        $(".bank_account_type, .bus_reg_with").addClass("hidden");
        $("#bank_account_type, #bus_reg_with, #loan_amount").attr('required', false);
        spb_change();
        occup_id_ni();
    }else if(loan_type == 60) {
        $("#label-for-dob, #salary_method_label, #nmi_label, #comp_name_label").addClass("optional-tag");
        $(".loan_amount,.gl_fields").removeClass("hidden");
        $(".salary_method,.company,.business,.occupation_id,.profession,.net_inc,.amt_deposit").addClass("hidden");
        $("#amt_deposit").attr('required', false);
        $(".mandatory-mark").addClass("hidden");
        $("#pl_dob, #net_month_inc, #comp_name, #salary_method").attr('required', false);
        $(".bank_account_type, .bus_reg_with").addClass("hidden");
        $("#bank_account_type, #bus_reg_with").attr('required', false);
        $("#loan_amount").attr("required", true);
        spb_change();
        occup_id_ni();
    } else if(loan_type == 63) {
        $("#label-for-dob, #salary_method_label, #nmi_label, #comp_name_label").addClass("optional-tag");
        $(".loan_amount,.profession,.occupation_id").removeClass("hidden");
        $(".gl_fields,.business,.company,.net_inc,.salary_method,.occupation1,.amt_deposit").addClass("hidden");
        $("#occupation_id2").prop('checked','true');
        $("#amt_deposit").attr('required', false);
        $(".mandatory-mark").addClass("hidden");
        $("#pl_dob, #net_month_inc, #comp_name, #salary_method").attr('required', false);
        $(".bank_account_type, .bus_reg_with").addClass("hidden");
        $("#bank_account_type, #bus_reg_with").attr('required', false);
        $("#loan_amount").attr("required", true);
        spb_change();
        occup_id_ni();
    }else if(loan_type == 32) {
        $("#label-for-dob, #salary_method_label, #nmi_label, #comp_name_label").addClass("optional-tag");
        $(".occupation_id,.amt_deposit").removeClass("hidden");
        $("#amt_deposit").attr('required', true);
        $(".salary_method,.company,.gl_fields,.business,.profession,.loan_amount,.net_inc").addClass("hidden");
        $(".mandatory-mark").addClass("hidden");
        $("#pl_dob, #net_month_inc, #comp_name, #salary_method").attr('required', false);
        $(".bank_account_type, .bus_reg_with").addClass("hidden");
        $("#bank_account_type, #bus_reg_with").attr('required', false);
        $("#loan_amount").attr("required", true);
        spb_change();
        occup_id_ni();
    } else {
        $("#label-for-dob, #salary_method_label, #nmi_label, #comp_name_label").addClass("optional-tag");
        $(".loan_amount,.salary_method,.gl_fields,.business,.company,.profession,.amt_deposit").addClass("hidden");
        $("#amt_deposit").attr('required', false);
        $(".mandatory-mark").addClass("hidden");
        $("#pl_dob, #net_month_inc, #comp_name, #salary_method").attr('required', false);
        $(".bank_account_type, .bus_reg_with").addClass("hidden");
        $("#bank_account_type, #bus_reg_with").attr('required', false);
        $("#loan_amount").attr("required", true);
        spb_change();
        occup_id_ni();
    }
    fun_missed_id();
}

function acqtype(){
    if($('#acq_id').val() == '3') {
        $(".ref_type,.ref_mob").show();
        $('#ref_type,#ref_mob').attr('required', 'required');
    } else { 
        $(".ref_mob,.ref_type").hide();
        $("#ref_mob,#ref_type").val('');
        $('#ref_mob,#ref_type').removeAttr('required');
    }
    fun_missed_id();
}

function spb_change() {
    if($(".salary_method").hasClass("hidden")) {
        $(".banks_list").addClass("hidden");
        $("#banks_list").attr("required", false);
    } else {
        if($("#salary_method").val() == 1) {
            $(".banks_list").removeClass("hidden");
            $("#banks_list").attr("required", true);
        } else {
            $(".banks_list").addClass("hidden");
            $("#banks_list").attr("required", false);
        }
    }
}

function occup_id_ni() {
    if(!$(".net_inc").hasClass("hidden")) {
        if($('input[name="occupation_id"]:checked').val() == 1) {
            $("#net_month_inc").attr("required", true);
            $("#nmi_label").removeClass("optional-tag");

            $(".gross_anl_recpt").addClass("hidden");
            $("#gar_label").addClass("optional-tag");
            $("#gross_annual_receipt").attr("required", false);

            $(".anl_profit").addClass("hidden");
        } else {
            $(".net_inc").addClass("hidden");
            $("#net_month_inc").attr("required", false);
            $("#nmi_label").addClass("optional-tag");

            if($('input[name="occupation_id"]:checked').val() == 2) {
                $(".gross_anl_recpt").removeClass("hidden");
                $("#gar_label").removeClass("optional-tag");
                $("#gross_annual_receipt").attr("required", true);

                $(".anl_profit").addClass("hidden");

            } else {
                $(".gross_anl_recpt").addClass("hidden");
                $("#gar_label").addClass("optional-tag");
                $("#gross_annual_receipt").attr("required", false);

                $(".anl_profit").removeClass("hidden");
            }
        }
    } else {
        if($('input[name="occupation_id"]:checked').val() == 1) {

            $(".anl_profit").addClass("hidden");
            
            $(".gross_anl_recpt").addClass("hidden");
            $("#gar_label").addClass("optional-tag");
            $("#gross_annual_receipt").attr("required", false);

            $(".net_inc").removeClass("hidden");
            $("#net_month_inc").attr("required", true);
            $("#nmi_label").removeClass("optional-tag");

            
        } else {
            $(".net_inc").addClass("hidden");
            $("#net_month_inc").attr("required", false);
            $("#nmi_label").addClass("optional-tag");

            if($('input[name="occupation_id"]:checked').val() == 2) {
                $(".gross_anl_recpt").removeClass("hidden");
                $("#gar_label").removeClass("optional-tag");
                $("#gross_annual_receipt").attr("required", true);

                $(".anl_profit").addClass("hidden");

            } else {
                $(".gross_anl_recpt").addClass("hidden");
                $("#gar_label").addClass("optional-tag");
                $("#gross_annual_receipt").attr("required", false);

                $(".anl_profit").removeClass("hidden");
            }
        }
    }
}

function fun_missed_id() {
    var missed_id = $("#missed_id").val();
    if(missed_id.trim() != "") {
        $("input").attr("required", false);
        $("select").attr("required", false);
        $("#phone_no").attr("required", true);
        $("label.label-tag").not(".missed-id-tag").addClass('optional-tag');
    }
}