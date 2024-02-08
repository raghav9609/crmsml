$(document).ready(function () { 
    $("#ad_follow").click(function () {
        $("#ad_form").slideToggle();
        $("#ad_follow").remove();
    });

    $("#foll_type").change(function () {
        if($("#foll_type").val() == 1 || $("#foll_type").val( )== 5){
            $("label[for='foll_type']").removeClass('optional-tag');
            $("#fol_date,#fol_time,.fol_date,.fol_time").removeClass("hidden").attr('required',true).val('');
        }else{
            $("label[for='foll_type']").addClass("optional-tag");
            $("#fol_date,#fol_time,.fol_date,.fol_time").addClass("hidden").removeAttr('required').val('');
        }        
    });
});

function fetch_users_by_lang(e) {
    if(e.value == "") {
        $("#lang_users").hide();
    } else {
        $("#lang_users").show();
    }
    var lang_id = e.value;
    $.ajax({
        type:   "POST",
        cache:  false,
        url:    "../insert/fetch_users_by_lang.php",
        data:   "lang_id=" + lang_id,
        success: function (response) {
            $("#lang_users").html(response);
        }
    });
}
function cng_status(e){
    var ajax_run = 0;
    var field_id = e.id;
    var parent_id = e.value;
    var html_name,drop_name;
    var f_status_value = $("#f_stats option:selected").val();
    var f_sub_status_value = $("#f_sub_stats option:selected").val();
    
    if((f_sub_status_value == 1022 || f_sub_status_value == 1026) && f_status_value == 1001){
        var f_sub_sub_status_value = $("input[name='f_sub_sub_stats']:checked").val();
        if(f_sub_sub_status_value != 'undefined' && f_sub_sub_status_value != '' && f_sub_sub_status_value > 0){
            field_id = 'case_f_sub_sub_stats';    
        }
    }else{
        var f_sub_sub_status_value = $("#f_sub_sub_stats option:selected").val();
         $(".sub_status_div,.sub_sub_status_div").addClass("hidden");
        $("#sub_status_div,#sub_sub_status_div").html('');
    }
    var ringing_array = ['1400','1110','1111','1112','1120','1121','1122'];
    var future_prospect_array_15 = ['1181','1185','1189','1193','1197','1201','1205'];
    var future_prospect_array_1 = ['1182','1186','1190','1194','1198','1202','1206'];
    var future_prospect_array_2 = ['1183','1187','1191','1195','1199','1203','1207'];
    var future_prospect_array_3 = ['1184','1188','1192','1196','1200','1204','1208'];

    var ringing_datetime_array = ['1400','1110','1111','1112','1120','1121','1122'];
       
    
    if(field_id == 'f_stats'){
        var ajax_run = 1;
        var html_name = 'f_sub_stats';
        $("#f_sub_stats,#f_sub_sub_stats").html('').addClass('hidden').removeAttr('required');
        $(".f_sub_stats,.f_sub_sub_stats").addClass('hidden');
        var drop_name = 'Sub Status';
    }else if(field_id == 'f_sub_stats'){
        var ajax_run = 1;
        $("#f_sub_sub_stats").html('').addClass('hidden').removeAttr('required');
        $(".f_sub_sub_stats").addClass('hidden');
        var html_name = 'f_sub_sub_stats';
        var drop_name = 'Sub Sub Status';
    }
    //$("#folow_given").val('');
    $("#foll_type,#fol_date,#fol_time,#level_type,#level_reference_no,#languages,#lang_users,.foll_type,.fol_date,.fol_time,.level_type,.level_reference_no,.languages,.lang_users").addClass("hidden").val('').removeAttr('required');
    $("#fol_city_id,#fol_pin_code,.fol_city_id,.fol_pin_code,.fup_loan_amount,#fup_loan_amount,.fup_nth,#fup_nth,.fup_registration_type,#fup_registration_type,.fup_bank_account_type,#fup_bank_account_type").addClass("hidden").removeAttr('required');
    if(f_status_value == 1002){
        $("#level_type,#level_reference_no,.level_type,.level_reference_no").removeClass("hidden").attr('required',true);
        if(f_sub_status_value == 1440) {
            $("#level_reference_no, #level_type").attr("required", false);
        }
    }else if(f_sub_status_value == 1024){
        $("#languages,.languages,.lang_users").removeClass("hidden").attr('required',true);
        $("#lang_users").removeClass("hidden").attr("required", false);
    }else if(f_sub_status_value == 1034){
        $("#fol_city_id,#fol_pin_code,.fol_city_id,.fol_pin_code").removeClass("hidden").attr('required',true);
    }else if(f_sub_status_value == 1025 || f_sub_status_value == 1566 || f_sub_status_value == 1457 || ringing_array.includes(f_sub_sub_status_value)){
        $("#fol_date,#fol_time,.fol_date,.fol_time").removeClass("hidden").attr('required',true);
        $("#foll_type").val('1');
           if(f_sub_status_value == 1025 || f_sub_status_value == 1566){  
            $('#fol_date').datepicker('option', 'minDate', 0).datepicker('option', 'maxDate', 5);
           }if(f_sub_status_value == 1457){  
            $('#fol_date').datepicker('option', 'minDate', 0).datepicker('option', 'maxDate', 7);
           }
        //    else if(f_sub_sub_status_value == 1400){
        //     var query_date_time = $("#query_datetime").val();
        //     var d = new Date();
        //     var month = d.getMonth()+1;
        //     var finaldate = d.getFullYear()+"-"+month+"-"+d.getDate()+" 16:00";
        //     if(new Date(query_date_time) < new Date(finaldate)){ 
        //         $('#fol_date').datepicker('option', 'minDate', 0).datepicker('option', 'maxDate', 1);
        //     }else{
        //         $('#fol_date').datepicker('option', 'minDate', 0).datepicker('option', 'maxDate', 1);
        //     }
        //    }
        else if(($("#loan_type").val() == 60) && (f_sub_status_value == 1022)){
            var currentD = new Date();
            var endD = new Date();
            endD.setHours(16,00,0);
            
            $.ajax({
                type: "POST",
                dataType: "json",
                cache: false,
                url:  '../../include/check-call-record.php',
                data: "queryID="+$("#query_id").val()+"&level_id=1",
                success: function (response) {
                    console.log(response);
                    if($.trim(response) != ''){
                        if(response == 'call1,call2'){
                            var status = 2;
                        }else{
                            var status = 1;
                        }
                    }else{
                        status = 1;
                    }
                    console.log(status);
                    if(endD.getTime() > currentD.getTime()){
                        $('#fol_date').datepicker('option', 'minDate', 0).datepicker('option', 'maxDate', '+0D');
                    }else{
                        if(status ==2){
                            $('#fol_date').datepicker('option', 'minDate', 0).datepicker('option', 'maxDate', '+1D');
                        }else{
                            if(f_sub_sub_status_value == 1400){
                                $('#fol_date').datepicker('option', 'minDate', 0).datepicker('option', 'maxDate', '+0D');
                            }else{
                                $('#fol_date').datepicker('option', 'minDate', 0).datepicker('option', 'maxDate', '+1D');
                            }
                        }
                    }
                }
            });
            
           }else{
            $('#fol_date').datepicker('option', 'minDate', 0).datepicker('option', 'maxDate', 3);
           }

           if((ringing_datetime_array.includes(f_sub_sub_status_value) && f_status_value == "1001") || f_sub_status_value == 1025 || f_sub_status_value == 1566 || f_sub_status_value == 1457) {
                $('#fol_date').val($("#follow_up_date_t").val());
                $('#fol_time').val($("#follow_up_time_t").val());
            } else {
                $("#fol_date, #fol_time").val('');
            }

    }else if(f_status_value == 1005 || f_sub_status_value == 1044 || f_sub_status_value == 1046 || f_sub_status_value == 1041 || f_sub_status_value == 1047){
             $("#foll_type").children("option[value='1']").hide();
              $("#foll_type").children("option[value='4']").hide();
              $("#foll_type").children("option[value='2']").hide();
              $("#foll_type").children("option[value='3']").hide();
              $("#foll_type").children("option[value='5']").show();
              if(f_status_value == 1005){
                $("#foll_type,.foll_type").val('5').addClass("hidden").attr('required',true);
                $("#fol_date,#fol_time,.fol_date,.fol_time").removeClass("hidden").attr('required',true).val('');
                $("label[for='foll_type']").removeClass('optional-tag');
              }else{
                $("#foll_type,.foll_type").removeClass("hidden").val('');
                $("#fol_date,#fol_time,.fol_date,.fol_time").addClass("hidden").removeAttr('required').val('');
                $("label[for='foll_type']").addClass('optional-tag');
              } 
              var add_day = new Date();
              var tomorrow = new Date();
           if(future_prospect_array_15.includes(f_sub_sub_status_value)){  
            $('#fol_date').datepicker('option', 'minDate', 7).datepicker('option', 'maxDate', 22);
            tomorrow.setDate(add_day.getDate()+11);
            var month = tomorrow.getMonth()+1;
            var day = tomorrow.getDate();
            var output = tomorrow.getFullYear() + '-' +
                (month<10 ? '0' : '') + month + '-' +
                (day<10 ? '0' : '') + day;
            $('#fol_date').datepicker('setDate', output);
            datechange();
           }else if(future_prospect_array_1.includes(f_sub_sub_status_value)){  
            $('#fol_date').datepicker('option', 'minDate', 15).datepicker('option', 'maxDate', 45);
            tomorrow.setDate(add_day.getDate()+23);
            var month = tomorrow.getMonth()+1;
            var day = tomorrow.getDate();
            var output = tomorrow.getFullYear() + '-' +
                (month<10 ? '0' : '') + month + '-' +
                (day<10 ? '0' : '') + day;
            $('#fol_date').val(output);
           }else if(future_prospect_array_2.includes(f_sub_sub_status_value)){  
            $('#fol_date').datepicker('option', 'minDate', 30).datepicker('option', 'maxDate', 90);
            tomorrow.setDate(add_day.getDate()+50);
            var month = tomorrow.getMonth()+1;
            var day = tomorrow.getDate();
            var output = tomorrow.getFullYear() + '-' +
                (month<10 ? '0' : '') + month + '-' +
                (day<10 ? '0' : '') + day;
            $('#fol_date').val(output);
           }else if(future_prospect_array_3.includes(f_sub_sub_status_value)){  
            $('#fol_date').datepicker('option', 'minDate', 60).datepicker('option', 'maxDate', 210);
            tomorrow.setDate(add_day.getDate()+80);
            var month = tomorrow.getMonth()+1;
            var day = tomorrow.getDate();
            var output = tomorrow.getFullYear() + '-' +
                (month<10 ? '0' : '') + month + '-' +
                (day<10 ? '0' : '') + day;
            $('#fol_date').val(output);
           }else{
            $('#fol_date').datepicker('option', 'minDate', 7).datepicker('option', 'maxDate', 150);
           }
    }else if(f_sub_sub_status_value == 1380 || f_sub_sub_status_value == 1381 || f_sub_sub_status_value == 1383 || f_sub_sub_status_value == 1385 ){
        $(".fup_loan_amount,#fup_loan_amount,.fup_nth,#fup_nth").removeClass('hidden').attr('required',true);
        $(".fup_registration_type,.fup_weight,#fup_weight,#fup_registration_type,.fup_bank_account_type,#fup_bank_account_type").addClass('hidden').removeAttr('required');
    }else if(f_sub_sub_status_value == 1384){
        $(".fup_nth,#fup_nth,.fup_weight,#fup_weight").addClass('hidden').removeAttr('required');
        $(".fup_loan_amount,#fup_loan_amount,.fup_registration_type,#fup_registration_type,.fup_bank_account_type,#fup_bank_account_type").removeClass('hidden').attr('required',true);
    }else if(f_sub_sub_status_value == 1382 ){
        $(".fup_loan_amount,#fup_loan_amount,.fup_weight,#fup_weight").removeClass('hidden').attr('required',true);
        $(".fup_registration_type,.fup_nth,#fup_nth,#fup_registration_type,.fup_bank_account_type,#fup_bank_account_type").addClass('hidden').removeAttr('required');
    }
    if(ajax_run == 1 && (parent_id != '' && parent_id != 0)){
        if(f_status_value == 1003 || f_status_value == 1004 || ((f_sub_status_value == 1022 || f_sub_status_value == 1026 ) && f_status_value == 1001)){
            var data_url = '../../include/sub-sub-statuschecker.php';
        }else {
            var data_url = '../../include/statushelper.php';
        }
           $.ajax({
            type: "POST",
            cache: false,
            url: data_url,
            data: "parent_id="+parent_id+"&level_id=1&loan_type="+$("#loan_type").val()+"&drop_name="+drop_name,
            success: function (response) {
                if($.trim(response) != ''){
                    if(f_status_value == 1003 || f_status_value == 1004 || ((f_sub_status_value == 1022 || f_sub_status_value == 1026 ) && f_status_value == 1001)){
                        $(".sub_status_div").removeClass("hidden");
                        $("#sub_status_div").html(response);
                    }else{
                        $(".sub_status_div,.sub_sub_status_div").addClass("hidden");
                        $("#sub_status_div,#sub_sub_status_div").html('');
                        $("#"+html_name).html(response).removeClass("hidden").removeAttr('required');
                        $("."+html_name).removeClass("hidden");
                        $("label[for='f_sub_sub_stats']").addClass('optional-tag');
                        if(f_sub_status_value != 1048){
                            $("#"+html_name).attr('required',true);
                            $("label[for='f_sub_sub_stats']").removeClass('optional-tag');
                        }
                    }
                }
            }
        });
    }
}

function get_sub_sub_status_div(ev){
    var sub_status_array = [];
            $.each($("input[name='multiple_sub_status[]']:checked"), function(){
                sub_status_array.push($(this).val());
            });
            var sf_status_value = $("#f_stats option:selected").val();
    if(sub_status_array.indexOf("1034") > -1){
        $("#fol_city_id,#fol_pin_code,.fol_city_id,.fol_pin_code").removeClass("hidden").attr('required',true);
    }else{
        $("#fol_city_id,#fol_pin_code,.fol_city_id,.fol_pin_code").addClass("hidden").removeAttr('required');
    }
    if(sub_status_array.indexOf("1044") > -1 || sub_status_array.indexOf("1046") > -1 || sub_status_array.indexOf("1041") > -1 || sub_status_array.indexOf("1047") > -1){
              $("#foll_type").children("option[value='1']").hide();
              $("#foll_type").children("option[value='4']").hide();
              $("#foll_type").children("option[value='2']").hide();
              $("#foll_type").children("option[value='3']").hide();
              $("#foll_type").children("option[value='5']").show();
              $("#foll_type,.foll_type").removeClass("hidden").val('');
                $("#fol_date,#fol_time,.fol_date,.fol_time").addClass("hidden").removeAttr('required').val('');
                $("label[for='foll_type']").addClass('optional-tag');
                $('#fol_date').datepicker('option', 'minDate', 7).datepicker('option', 'maxDate', 150);
    }else{
        $("#foll_type,.foll_type,#fol_date,#fol_time,.fol_date,.fol_time").addClass("hidden").val('');
        $("label[for='foll_type']").removeClass('optional-tag');
    }
    if(ev.checked){
        var label_value = $("label[for='multiple_sub_status"+ev.value+"']").text();
        $.ajax({
            type: "POST",
            cache: false,
            url: '../../include/sub-sub-statuschecker.php',
            data: "parent_id="+ev.value+"&level_id=1&loan_type="+$("#loan_type").val(),
            success: function (response) {
                if($.trim(response) != ''){
                        $(".sub_sub_status_div").removeClass("hidden");
                        $("#sub_sub_status_div").append("<div id='sub_sub_status_div"+ev.value+"' class='row div-width ml4'><span class='orange f_13 bold'>"+label_value+"&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</span> "+response+"</div>");
                        if((sf_status_value == 1004 || sf_status_value == 1003) && ($("#loan_type").val() == 51 || $("#loan_type").val() == 54 || $("#loan_type").val() == 52)){
                            $("input[name='multiple_sub_sub_status[]']").removeAttr('required');
                        }
                    }else{
                    $("#sub_sub_status_div").append("<div id='sub_sub_status_div"+ev.value+"' class='row div-width ml4'><input type='hidden' name='multiple_sub_sub_status[]' value='"+ev.value+"'></div>");
                }
            }
        });
    }else if(sub_status_array.length == 0){
        $(".sub_sub_status_div").addClass("hidden");
        $("#sub_sub_status_div").text('');
    }else{
        $("#sub_sub_status_div"+ev.value).remove();
    }
}
function sub_sub_status_validation(event){
    var sub_sub_status_array = [];
    $.each($("input[name='multiple_sub_sub_status[]']:checked"), function(){
                sub_sub_status_array.push($(this).val());
            });
            if(sub_sub_status_array.indexOf("1380") > -1 || sub_sub_status_array.indexOf("1381") > -1 || sub_sub_status_array.indexOf("1383") > -1 || sub_sub_status_array.indexOf("1385") > -1){
                $(".fup_loan_amount,#fup_loan_amount,.fup_nth,#fup_nth").removeClass('hidden').attr('required',true);
                $(".fup_registration_type,#fup_registration_type,.fup_weight,#fup_weight,.fup_bank_account_type,#fup_bank_account_type").addClass('hidden').removeAttr('required').val("");
            }else if(sub_sub_status_array.indexOf("1384") > -1){
                $(".fup_nth,#fup_nth,.fup_weight,#fup_weight").addClass('hidden').removeAttr('required').val("");
                $(".fup_loan_amount,#fup_loan_amount,.fup_registration_type,#fup_registration_type,.fup_bank_account_type,#fup_bank_account_type").removeClass('hidden').attr('required',true);
            }else if(sub_sub_status_array.indexOf("1382") > -1){
                $(".fup_loan_amount,#fup_loan_amount,.fup_weight,#fup_weight").removeClass('hidden').attr('required',true);
                $(".fup_registration_type,.fup_nth,#fup_nth,#fup_registration_type,.fup_bank_account_type,#fup_bank_account_type").addClass('hidden').removeAttr('required').val("");
            }else{
                $(".fup_nth,#fup_nth,.fup_weight,#fup_weight,.fup_loan_amount,#fup_loan_amount,.fup_registration_type,#fup_registration_type,.fup_bank_account_type,#fup_bank_account_type").addClass('hidden').removeAttr('required').val("");
            }
}