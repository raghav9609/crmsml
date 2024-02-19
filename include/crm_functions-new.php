<script>
function loantype(da){
    var val = $("#loan_type option:selected").val();

    $(".prop_iden_munc").hide();
    if(val == '11'){
	    $(".dl_fields").removeClass("hidden");
	    $(".hl").hide();
	    $(".cl").hide();
	    $(".gl").hide();
	    $(".el").hide();	
	    $(".prop_iden").hide();
	    $(".exis_tl").hide();
	    $(".exis_pl").hide();
	    $(".ln_nature").hide();	
	    $(".pl").hide();
	    $(".exis").hide();
	    $(".credit_details").addClass("hidden");
	    $(".occudetails_h,.comp_head,.addrs_proof").removeClass("hidden");
        $(".pl_crs").hide();
        $(".el-fields").hide();
        //Changes - HDFCFields - Akash - Starts
        $(".el-pl").hide();
        //Changes - HDFCFields - Akash - Ends
    occup_sal();
    } else if(val == '71'){
        $(".credit_details").removeClass("hidden");
        $(".occudetails_h,.comp_head").removeClass("hidden");
        $(".addrs_proof").removeClass("hidden");
	    $(".dl_fields").addClass("hidden");
        $(".pl,.hl,.cl,.gl,.el,.prop_iden,.exis_tl,.exis_pl,.ln_nature,.empl,#employed_in_cur_org_since,#cbl_loan_amt,.exis,.subjct,.bl,.senp").hide();
        $(".pl_crs").hide();
        $(".el-fields").hide();
        //Changes - HDFCFields - Akash - Starts
        $(".el-pl").hide();
        //Changes - HDFCFields - Akash - Ends
    occup_sal();
    } else if(val == 56){
        $(".pl").show();
        $(".hl").hide();
        $(".cl").hide();
        $(".gl").hide();
        $(".el").hide();
        //$(".exis").hide();
        $(".prop_iden").hide();
        $(".exis_tl").hide();
        $(".exis_pl").show();
        $(".ln_nature").show();
        $(".credit_details,.dl_fields").addClass("hidden");
        $(".occudetails_h,.comp_head").removeClass("hidden");
        $(".addrs_proof").removeClass("hidden");
        $(".el-fields").hide();
        //Changes - HDFCFields - Akash - Starts
        $(".el-pl").show();
        //Changes - HDFCFields - Akash - Ends
        occup_sal(1);
        $(".pl_crs").show();
    }else if(val == 51 || val == 54){
        if(val == 51){
            $('#asset_type option').eq(2).remove();
            $('#asset_type option').eq(1).remove();
        }
        $(".hl").show();
        $(".pl").show();
        $(".ln_nature").show();
        $(".empl").show();
        $("#employed_in_cur_org_since").show();
        $("#cbl_loan_amt").show();
        $(".gl").hide();
        $(".el").hide();
        $(".cl").hide();
        $(".credit_details,.dl_fields").addClass("hidden");
        $(".occudetails_h,.comp_head").removeClass("hidden");
        $(".addrs_proof").addClass("hidden");
        $(".pl_crs").hide();
        $(".el-fields").hide();
        //Changes - HDFCFields - Akash - Starts
        $(".el-pl").hide();
        //Changes - HDFCFields - Akash - Ends
        occup_sal();
    } else if(val == 52){
        $(".hl").hide();
        $(".cpl").show();
        $(".ln_nature").hide();
        $(".gl").hide();
        $(".el").hide();
        $(".cl").hide();
        $(".exis").hide();
        $(".pl").hide();
        $(".prop_iden").hide();
        $(".exis_tl").hide();
        $(".exis_pl").hide();
        $(".credit_details,.dl_fields").addClass("hidden");
        $(".occudetails_h,.comp_head").removeClass("hidden");
        $(".addrs_proof").removeClass("hidden");
        $(".pl_crs").hide();
        $(".el-fields").hide();
        //Changes - HDFCFields - Akash - Starts
        $(".el-pl").hide();
        //Changes - HDFCFields - Akash - Ends
        occup_sal();
    } else if(val == 57){
        $(".hl").hide();
        $(".gl").hide();
        $(".pl").hide();
        $(".el").hide();
        $(".cl").hide();
        $(".exis").hide();
        $(".prop_iden").hide();
        $(".exis_tl").hide();
        $(".exis_pl").hide();
        $(".ln_nature").hide();
        $(".credit_details,.dl_fields").addClass("hidden");
        $(".occudetails_h,.comp_head,.senp_itr").removeClass("hidden");
        $(".addrs_proof").removeClass("hidden");
        $(".el-fields").hide();
        //Changes - HDFCFields - Akash - Starts
        $(".el-pl").hide();
        //Changes - HDFCFields - Akash - Ends
        occup_sal(3);
        $(".pl_crs").hide();
    } else if(val == 63){
        $(".senp_itr").removeClass("hidden");
        $(".dl_fields").addClass("hidden");
        $(".hl").hide();
        $(".cl").hide();
        $(".gl").hide();
        $(".el").hide();	
        $(".prop_iden").hide();
        $(".exis_tl").hide();
        $(".exis_pl").hide();
        $(".ln_nature").hide();	
        $(".pl").hide();
        $(".exis").hide();
        $(".credit_details").addClass("hidden");    
        $(".el-fields").hide();    
        occup_sal(2);
        $(".pl_crs").hide();
        //Changes - HDFCFields - Akash - Starts
        $(".el-pl").hide();
        //Changes - HDFCFields - Akash - Ends
    } else if(val == 60){
        $(".hl").hide();
        $(".gl").show();
        $(".el").hide();
        $(".cl").hide();
        $(".pl").hide();
        $(".exis").hide();
        $(".prop_iden").hide();
        $(".exis_tl").hide();
        $(".exis_pl").hide();
        $(".ln_nature").hide();
        $(".credit_details,.dl_fields").addClass("hidden");
        $(".occudetails_h,.comp_head").addClass("hidden");
        $(".addrs_proof").removeClass("hidden");
        $("#occupation_id").val("");
        $(".sal").hide();
        $(".senp").hide();
        $(".cc_sepb").hide();
        $(".senp_itr").addClass("hidden");
        $(".senp_itr").hide();
        $(".senp_cc").hide();
        $(".pl_crs").hide();
        $(".el-fields").hide();
        //Changes - HDFCFields - Akash - Starts
        $(".el-pl").hide();
        //Changes - HDFCFields - Akash - Ends
    } else if(val == 59){
        $(".hl").hide();
        $(".gl").hide();
        $(".cl").hide();
        $(".el").show();
        $(".pl").hide();
        $(".exis").hide();
        $(".prop_iden").hide();
        $(".exis_tl").hide();
        $(".exis_pl").hide();
        $(".ln_nature").hide();
        $(".credit_details,.dl_fields").addClass("hidden");
        $(".comp_head").addClass("hidden");
        $(".occudetails_h").removeClass("hidden");
        $(".el-at").show();
        $(".el-fields").show();
        $(".addrs_proof").removeClass("hidden");
        $(".pl_crs").hide();
        //Changes - HDFCFields - Akash - Starts
        $(".el-pl").show();
        //Changes - HDFCFields - Akash - Ends
        occup_sal();
    } else if(val == 58){
        $(".hl").hide();
        $(".tl").show();
        $(".empl").hide();
        $(".cl").hide();
        $(".gl").hide();
        $(".el").hide();
        $(".pl").hide();
        $(".exis").hide();
        $(".prop_iden").hide();
        $("#employed_in_cur_org_since").hide();
        $("#cbl_loan_amt").hide();
        $(".exis_pl").hide();
        $(".exis_tl").show();
        $(".ln_nature").hide();
        $(".credit_details,.dl_fields").addClass("hidden");
        $(".occudetails_h,.comp_head").removeClass("hidden");
        $(".addrs_proof").removeClass("hidden");
        $(".pl_crs").hide();
        $(".el-fields").hide();
        //Changes - HDFCFields - Akash - Starts
        $(".el-pl").hide();
        //Changes - HDFCFields - Akash - Ends
        occup_sal();
    } else if(val == 61){
        $(".cl").show();
        $(".hl").hide();
        $(".gl").hide();
        $(".el").hide();
        $(".pl").hide();
        $(".exis").hide();
        $(".prop_iden").hide();
        $(".exis_tl").hide();
        $(".exis_pl").hide();
        $(".ln_nature").hide();
        $(".credit_details,.dl_fields").addClass("hidden");
        $(".occudetails_h,.comp_head").removeClass("hidden");
        $(".addrs_proof").removeClass("hidden");
        $(".pl_crs").hide();
        $(".el-fields").hide();
        //Changes - HDFCFields - Akash - Starts
        $(".el-pl").hide();
        //Changes - HDFCFields - Akash - Ends
        occup_sal();
    } else {
        $(".cl").hide();
        $(".hl").hide();
        $(".gl").hide();
        $(".el").hide();
        $(".pl").hide();
        $(".exis").hide();
        $(".prop_iden").hide();
        $(".exis_tl").hide();
        $(".exis_pl").hide();
        $(".ln_nature").hide();   
        $(".credit_details,.dl_fields").addClass("hidden");
        $(".occudetails_h,.comp_head").removeClass("hidden");
        $(".addrs_proof").removeClass("hidden");
        $(".pl_crs").hide();
        $(".el-fields").hide();
        //Changes - HDFCFields - Akash - Starts
        $(".el-pl").hide();
        //Changes - HDFCFields - Akash - Ends
        occup_sal();
    }
}
function property_identify(){
    if($("#prop_identified").val() == 'Y'){
        $(".prop_iden").show();
        $(".prop_iden_munc").hide();
    } else if($("#prop_identified").val() == 'N'){
        $(".prop_iden").hide();
        $(".prop_iden_munc").show();
    } else {
        $(".prop_iden").hide();
        $(".prop_iden_munc").hide();
    }
}
function acqtype(){
    var value = $("#acq_mode").val();
    if(value == '3'){ 
        $(".ref_mob").show();
    } else { 
        $(".ref_mob").hide();
        $("#ref_mob").val('');
    }
}
function loannature(){
    var nat = $('#nature_loan').val();
    if(nat != "2"){
        $(".exis").hide();
        $(".exis_tl").hide();
        $(".exis_pl").hide();
    } else if(nat == "2"){
        $(".exis").show();
        $(".exis_tl").show();
        $(".exis_pl").show();
    }
}
function existing_loans(){
    if($('#exis_loans').val() == "0" || $('#exis_loans').val() == "" ){
        $(".loan_on,.loan_tw,.loan_th,.loan_fr,.loan_fv").hide();
   }
    if($('#exis_loans').val() == "1" ) {
        $(".loan_on").show();
        $(".loan_tw,.loan_th,.loan_fr,.loan_fv").hide();
    }
    if($('#exis_loans').val() == "2" ){	  
        $(".loan_on").show();
	    $(".loan_tw").show();
	    $(".loan_th,.loan_fr,.loan_fv").hide();
    }
    if($('#exis_loans').val() == "3" ){
  	    $(".loan_on,.loan_tw,.loan_th").show();
	    $(".loan_fr,.loan_fv").hide();
    }
    if($('#exis_loans').val() == "4" ){
  	    $(".loan_on,.loan_tw,.loan_th,.loan_fr").show();
	    $(".loan_fv").hide();
    }
    if($('#exis_loans').val() == "5" ){
  	    $(".loan_on,.loan_tw,.loan_th,.loan_fr,.loan_fv").show();
    }
}

function credit_cards(){
if($('#credit_running').val() == "0" || $('#credit_running').val() == ""){
 $(".credit_on,.credit_tw,.credit_th,.credit_fr,.credit_fv").hide();
   }
if($('#credit_running').val() == "1" )
  {
  	  $(".credit_on").show();
	$(".credit_tw,.credit_th,.credit_fr,.credit_fv").hide();
  }
if($('#credit_running').val() == "2" )
  {	  $(".credit_on,.credit_tw").show();
	  $(".credit_th,.credit_fr,.credit_fv").hide();
  }
if($('#credit_running').val() == "3" ){
  	  $(".credit_on,.credit_tw,.credit_th").show();
	  $(".credit_fr,.credit_fv").hide();
   }
   if($('#credit_running').val() == "4" ){
  	  $(".credit_on,.credit_tw,.credit_th,.credit_fr").show();
	  $(".credit_fv").hide();
   }
   if($('#credit_running').val() == "5" ){
  	  $(".credit_on,.credit_tw,.credit_th,.credit_fr,.credit_fv").show();
   }

}


function case_st(){
var status = document.getElementById('case_status').value;
var loan_val = $("#loan_type option:selected").val();
if(status == "1" || status == "8" || status == "9"){
  	  $(".follow_ups").show();
  	   $(".stp").hide();
  	   $(".pat_msg").hide();
  	  if(status == "8"){
  	  $(".stp").show();
  	  if(loan_val == 56 || loan_val == 57){
  	  $(".pat_msg").show();
  	  }
  	  }
   }
else{
    $(".follow_ups").hide();
  	  $(".stp").hide();
  	   $(".pat_msg").hide();
   }

}
function form_validation(id){
    var if_hot_case = $("#if_hot_case").val();
    var if_hot_case_check = $('input[name="hot_case"]').is(':checked');    
    var logged_in_role = "<?php echo $user_role; ?>";
    var current_query_id = $("#query_id").val();
    var current_case_id = $('input[name="case_id"]').val();
    var type = "";
    if(id == "case_create") {
        type = "case";
    } else if(id == "edit_cust") {
        type = "query";
    }
    if(logged_in_role == 3) {
        if(if_hot_case == 0 && if_hot_case_check == true) {
            var return_count = $.ajax({
                type: "POST",
                cache: false,
                url: "../insert/hot_lead_count.php",
                data: "query_id="+current_query_id+"&case_id="+current_case_id+"&type="+type,
                async: false,
                complete: function (response) {
                    return response;
                }
            });
            if(return_count != "") {
                var ajax_response = JSON.parse(return_count.responseText);
                console.log(ajax_response);
                if(ajax_response.status == 0) {
                    alert("Enough Lead count not available");
                    return false;
                }
            }
        }
    }

    var button_id = id;
    var saluation  = $("#saluation option:selected").val();
    var lname = $("#lname").val();
    var name = $("#name").val();
    var email = $("#email").val();
     var pan_card = $("#pan_card").val();
    var exis_loan  = $("#exis_loans option:selected").val();
    var loan_type_on  = $("#loan_type_on option:selected").val();
    var loan_type_tw  = $("#loan_type_tw option:selected").val();
    var loan_type_th  = $("#loan_type_th option:selected").val();
    var loan_type_fr  = $("#loan_type_fr option:selected").val();
    var loan_type_fv  = $("#loan_type_fv option:selected").val();
    var ex_bank_id  = $("#ex_bank_id option:selected").val();
    var ex_bank_id_tw  = $("#ex_bank_id_tw option:selected").val();
    var ex_bank_id_th  = $("#ex_bank_id_th option:selected").val();
    var ex_bank_id_fr  = $("#ex_bank_id_fr option:selected").val();
    var ex_bank_id_fv  = $("#ex_bank_id_fv option:selected").val();
    var emi_loan_on = $("#emi_loan_on").val();
    var emi_loan_tw  = $("#emi_loan_tw").val();
    var emi_loan_th  = $("#emi_loan_th").val();
    var emi_loan_fr  = $("#emi_loan_fr").val();
    var emi_loan_fv  = $("#emi_loan_fv").val();
    var credit_running  = $("#credit_running option:selected").val();
    var credit_bank_id  = $("#credit_bank_id option:selected").val();
    var credit_bank_id_tw  = $("#credit_bank_id_tw option:selected").val();
    var credit_bank_id_th  = $("#credit_bank_id_th option:selected").val();
    var credit_bank_id_fr  = $("#credit_bank_id_fr option:selected").val();
    var credit_bank_id_fv  = $("#credit_bank_id_fv option:selected").val();
    var credit_sanction_amt_on = $("#credit_sanction_amt_on").val();
    var credit_sanction_amt_tw = $("#credit_sanction_amt_tw").val();
    var credit_sanction_amt_th = $("#credit_sanction_amt_th").val();
    var credit_sanction_amt_fr = $("#credit_sanction_amt_fr").val();
    var credit_sanction_amt_fv = $("#credit_sanction_amt_fv").val();
    var current_out_stan_on = $("#current_out_stan_on").val();
    var current_out_stan_tw = $("#current_out_stan_tw").val();
    var current_out_stan_th = $("#current_out_stan_th").val();
    var current_out_stan_fr = $("#current_out_stan_fr").val();
    var current_out_stan_fv = $("#current_out_stan_fv").val();
    var occupation_id  = $("#occupation_id option:selected").val();
    var loan_type  = $("#loan_type option:selected").val();
    var main_acc =  $("#main_acc option:selected").val();
    var net_month_inc = $("#net_month_inc").val();
    var slry_paid = $("#slry_paid option:selected").val();
    var comp_name = $("#comp_name").val();
    var ccwe = $("#ccwe").val(); 
    var twe = $("#twe").val();
    var asset_type = $("#asset_type option:selected").val();
    var nature_loan = $("#nature_loan option:selected").val();
    var prop_city_id = $("#prop_city_id").val();
    var phone_no = $("#phone_no").val();
    var case_status = $("#case_status option:selected").val();
    var c_follow_type = $("#c_follow_type option:selected").val();
    var c_folow_up_date = $("#c_folow_up_date").val();
    var c_follow_up_time = $("#c_follow_up_time").val();
    var rented_id = $("#rented_id option:selected").val();
    var comp_name_other = $("#comp_name_other").val();
    var check_value = document.getElementById('no_verify');
    var adrs_proof = document.getElementById('adres_proof');
    var city = $("#city_id").val();
    var gold_weight = $("#gold_weight").val();
    var gold_purity = $("#gold_purity").val();
    var loan_amount = $("#loan_amount").val();
    var acq_mode = $("#acq_mode").val();
    var ref_mob = $("#ref_mob").val();
    var prop_identified = $("#prop_identified option:selected").val();
    var prop_identified_sale_type = $("#prop_identified_sale_type option:selected").val();
    var prop_loc = $("#prop_loc option:selected").val();
    var prop_iden_mar_value = $("#prop_iden_mar_value").val();
    var property_size = $("#property_size option:selected").val();
    var u_budget = $("#u_budget option:selected").val();
    var regexname=/^([a-zA-Z ]{1,16})$/;
    var regpan_card = /[a-zA-z]{5}\d{4}[a-zA-Z]{1}/; 
    var adrs_prf = []
    $("input[name='adres_proof[]']:checked").each(function ()
    {
        adrs_prf.push(($(this).val()));
    });
    
    var single_err_msg = "";

    var email_regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if($("#email").is(':visible')) {
        if($("#email").val().trim() != "") {
            if(!email_regex.test($("#email").val())) {
                single_err_msg += "Email not valid\n";
                $("#email").css("border", "1px solid red");
            } else {
                $("#email").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
            }
        }
    }

    if($("#ofc_email").is(':visible')) {
        if($("#ofc_email").val().trim() != "") {
            if(!email_regex.test($("#ofc_email").val())) {
                single_err_msg += "Office Email not valid\n";
                $("#ofc_email").css("border", "1px solid red");
            } else {
                $("#ofc_email").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
            }
        }
    }

    if($("#ofc_pincode").is(':visible')) {
        if($("#ofc_pincode").val().trim() != "" && $("#ofc_pincode").val().trim() != "0") {
            if(parseInt($("#ofc_pincode").val().charAt(0)) < 1) {
                single_err_msg += "Not a valid Office Pincode\n";
                $("#ofc_pincode").css("border", "1px solid red");
            } else if($("#ofc_pincode").val().trim().length != "6") {
                single_err_msg += "Not a valid Office Pincode\n";
                $("#ofc_pincode").css("border", "1px solid red");
            } else {
                $("#ofc_pincode").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
            }
        }
    }

    if($("#pin_code").is(':visible')) {
        if($("#pin_code").val().trim() != "" && $("#pin_code").val().trim() != "0") {
            if(parseInt($("#pin_code").val().charAt(0)) < 1) {
                single_err_msg += "Not a valid Pincode\n";
                $("#pin_code").css("border", "1px solid red");
            } else if($("#pin_code").val().trim().length != "6") {
                single_err_msg += "Not a valid Pincode\n";
                $("#pin_code").css("border", "1px solid red");
            } else {
                $("#pin_code").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
            }
        }
    }

    if($("#dob").is(':visible') && $("#current_residence_since").is(':visible')) {
        if($("#dob").val() != "0000-00-00" || $("#dob").val() != "" || $("#current_residence_since").val() != "0000-00-00" || $("#current_residence_since").val() != "") {
            var dob_y = new Date($("#dob").val());
            var crs_y = new Date($("#current_residence_since").val());
            var dob_year = parseInt(dob_y.getFullYear());
            var crs_year = parseInt(crs_y.getFullYear());
            if(crs_year < dob_year) {
                single_err_msg += "Current Residence Since cannot be less than DOB\n";
                $("#dob").css("border", "1px solid red");
                $("#current_residence_since").css("border", "1px solid red");
            } else {
                $("#dob, #current_residence_since").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
            }
        }
    }
    if(button_id != 'case_create') {
        if($("#pan_card").is(':visible')) {
            if($("#pan_card").val().trim() != "") {
                if(!$("#pan_card").val().match(regpan_card)) {
                    single_err_msg += "Not a valid PAN number\n";
                    $("#pan_card").css("border", "1px solid red");
                } else if($("#pan_card").val().length != "10") {
                    single_err_msg += "Not a valid PAN number\n";
                    $("#pan_card").css("border", "1px solid red");
                } else {
                    $("#pan_card").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
                }
            }
        }
    
        if($("#ccwe").is(':visible') && $("#twe").is(':visible')) {
            if(parseInt($("#ccwe").val()) > parseInt($("#twe").val())) {
                single_err_msg += "CWE cannot be greater than TWE \n";
                $("#ccwe, #twe").css("border", "1px solid red");
            } else {
                $("#ccwe, #twe").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
            }
        }
    }

    if(name == "") {
        // $("#cst_inf").trigger('click');
        // alert("Enter Valid First Name");
        // $("#name").focus();
        // return false;
        single_err_msg += "Enter Valid First Name \n ";
        $("#name").css("border", "1px solid red");
    } else if(!regexname.test(name)) {
        single_err_msg += "Special Characters Are Not Allowed in First Name \n ";
        $("#name").css("border", "1px solid red");
    } else {
        $("#name").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
    }
    if(lname == "") {
        single_err_msg += "Enter Valid Last Name \n ";
        $("#lname").css("border", "1px solid red");
    } else if(!regexname.test(lname)) {
        // $("#cst_inf").trigger('click');
        // alert("Special Characters Are Not Allowed in Last Name");
        // $("#lname").focus();
        // return false; 
        single_err_msg += "Special Characters Are Not Allowed in Last Name \n ";
        $("#lname").css("border", "1px solid red");
    } else {
        $("#lname").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
    }
    if(phone_no == ""|| phone_no == 0 || phone_no == 9999999999 || phone_no == 9876543210 || phone_no <= 6000000000 || phone_no > 9999999999 ){
        // $("#cst_inf").trigger('click');
        // alert("Enter Valid Phone No");
        // $("#phone_no").val("");
        // $("#phone_no").focus();
        // return false;
        single_err_msg += "Enter Valid Phone No \n ";
        $("#phone_no").css("border", "1px solid red");
    } else {
        $("#phone_no").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
    }
   
    if(loan_type !=60) {
        if(occupation_id == ""){
            // $("#cst_inf").trigger('click');
            // alert("Select Occupation");
            // $("#occupation_id").focus();
            // return false;
            single_err_msg += "Select Occupation \n ";
            $("#occupation_id").css("border", "1px solid red");
        } else {
            $("#occupation_id").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
        }
    } else if(loan_type == '56' && occupation_id != '1') {
        // $("#cst_inf").trigger('click');
        // alert("Select Salaried for PL");
        // $("#occupation_id").focus();
        // return false;
        single_err_msg += "Select Salaried for PL \n ";
        $("#occupation_id").css("border", "1px solid red");
    } else if(loan_type == '57' && occupation_id != '2' && occupation_id != '3') {
        // $("#cst_inf").trigger('click');
        // alert("Select Self Employed for BL");
        // $("#occupation_id").focus();
        // return false;
        single_err_msg += "Select Self Employed for BL \n ";
        $("#occupation_id").css("border", "1px solid red");
    } else {
        $("#occupation_id").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
    }
    if(occupation_id == 1) {
        if(net_month_inc == "" || net_month_inc == 0) {
            // $("#cst_inf").trigger('click');
            // alert("Enter Net Monthly Income");
            // $("#net_month_inc").focus();
            // return false;
            single_err_msg += "Enter Net Monthly Income \n ";
            $("#net_month_inc").css("border", "1px solid red");
        } else {
            $("#net_month_inc").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
        }
    }
    if(city == "" || city == 'Others' || city == 'Other') {
        // $("#cst_inf").trigger('click');
        // alert("Enter Valid City Name");
        // $("#city_id").val('');
        // $("#city_id").focus();
        // return false;
        single_err_msg += "Enter Valid City Name \n ";
        $("#city_id").css("border", "1px solid red");
    } else {
        $("#city_id").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
    }

if(button_id == 'case_create'){
    if(loan_type == 56) {
        if($("#ccwe").val().trim() == "" || $("#ccwe").val().trim() == 0) {
            single_err_msg += "CWE cannot be zero or blank \n";
            $("#ccwe").css("border", "1px solid red");
        }
        if($("#twe").val().trim() == "" || $("#twe").val().trim() == 0) {
            single_err_msg += "TWE cannot be zero or blank \n";
            $("#twe").css("border", "1px solid red");
        }
        var numeric_regex = /^[0-9]*$/;
        if(!$("#ccwe").val().match(numeric_regex)) {
            single_err_msg += "Only numeric characters in CWE \n";
            $("#ccwe").css("border", "1px solid red");
        }

        if(!$("#twe").val().match(numeric_regex)) {
            single_err_msg += "Only numeric characters in TWE \n";
            $("#twe").css("border", "1px solid red");
        }

        if(parseInt($("#ccwe").val()) > parseInt($("#twe").val())) {
            single_err_msg += "CWE cannot be greater than TWE \n";
            $("#twe").css("border", "1px solid red");
            $("#ccwe").css("border", "1px solid red");
        }
    }

    if($("#ccwe").is(':visible') && $("#twe").is(':visible')) {
        if(parseInt($("#ccwe").val()) > parseInt($("#twe").val())) {
            single_err_msg += "CWE cannot be greater than TWE \n";
            $("#ccwe, #twe").css("border", "1px solid red");
        } else {
            $("#ccwe, #twe").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
        }
    }

    if(loan_type == 71){
        if($("#address").val() == ""){
            // $("#cst_inf").trigger('click');
            // alert("Enter Residential Address");
            // $("#address").focus();
            // return false;
            single_err_msg += "Enter Residential Address \n ";
            $("#address").css("border", "1px solid red");
        } else {
            $("#address").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
        }

        if($("#offce_address").val() == ""){
            // $("#cst_inf").trigger('click');
            // alert("Enter Company Address");
            // $("#offce_address").focus();
            // return false;
            single_err_msg += "Enter Company Address \n ";
            $("#offce_address").css("border", "1px solid red");
        } else {
            $("#offce_address").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
        }
        
        if($("#ofc_pincode").val() == "" || $("#ofc_pincode").val() == "0"){
            // $("#cst_inf").trigger('click');
            // alert("Enter Company PinCode");
            // $("#ofc_pincode").focus();
            // return false;
            single_err_msg += "Enter Company PinCode \n ";
            $("#ofc_pincode").css("border", "1px solid red");
        } else {
            $("#ofc_pincode").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
        }
        
        if($("#pin_code").val() == "" || $("#pin_code").val() == "0"){
            // $("#cst_inf").trigger('click');
            // alert("Enter Residential PinCode");
            // $("#pin_code").focus();
            // return false;
            single_err_msg += "Enter Residential PinCode \n ";
            $("#pin_code").css("border", "1px solid red");
        } else {
            $("#pin_code").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
        }
        
        if($("#ofc_email").val() == ""){
            // $("#cst_inf").trigger('click');
            // alert("Enter Company Email Id");
            // $("#ofc_email").focus();
            // return false;
            single_err_msg += "Enter Company Email Id \n ";
            $("#ofc_email").css("border", "1px solid red");
        } else {
            $("#ofc_email").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
        }
       
        if(!($('#adres_proof').is(":checked"))){
            // $("#cst_inf").trigger('click');
            // alert("Select Residential Address Proof");
            // $("#adres_proof").focus();
            // return false;
            single_err_msg += "Select Residential Address Proof \n ";
            $("#adres_proof").css("border", "1px solid red");
        } else {
            $("#adres_proof").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
        }
       
        if($("#apptmnt_date").val() == ""){
            // $("#qry_dtl").trigger('click');
            // alert("Enter Appointment Date");
            // $("#apptmnt_date").focus();
            // return false;
            single_err_msg += "Enter Appointment Date \n ";
            $("#apptmnt_date").css("border", "1px solid red");
        } else {
            $("#apptmnt_date").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
        }
         
        if($("#apptmnt_time").val() == ""){
            // $("#qry_dtl").trigger('click');
            // alert("Enter Appointment Time");
            // $("#apptmnt_time").focus();
            // return false;
            single_err_msg += "Enter Appointment Time \n ";
            $("#apptmnt_time").css("border", "1px solid red");
        } else {
            $("#apptmnt_time").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
        }

        if($("input[name='app_place']:checked").val() != "1" && $("input[name='app_place']:checked").val() != "2"){
            // $("#qry_dtl").trigger('click');
            // alert("Select Appointment Place");
            // $(".app_place").focus();
            // return false;
            single_err_msg += "Select Appointment Place \n ";
            $(".app_place").css("border", "1px solid red");
        } else {
            $("#app_place").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
        }
    }  
    
    if(saluation == ""){
        // $("#cst_inf").trigger('click');
        // alert("Select Salutation");
        // $("#saluation").focus();
        // return false;
        single_err_msg += "Select Salutation \n ";
        $("#saluation").css("border", "1px solid red");
    } else {
        $("#saluation").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
    }
  
    if(email == '' && (loan_type == 56 || loan_type == 57)){
        // $("#cst_inf").trigger('click');
        // alert("Enter Email ID");
        // $("#email").focus();
        // return false;
        single_err_msg += "Enter Email ID \n ";
        $("#email").css("border", "1px solid red");
    } else {
        $("#email").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
    }
    
    
    if(occupation_id == 1){
        if(loan_type == 56){
            if(comp_name == "" && comp_name_other == ""){
                // $("#cst_inf").trigger('click');
                // alert("Enter Company Name");
                // $("#comp_name").focus();
                // return false;
                single_err_msg += "Enter Company Name \n ";
                $("#comp_name").css("border", "1px solid red");
            } else {
                $("#comp_name").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
            }
        }
        if(slry_paid == "" && loan_type == 56){
            // $("#cst_inf").trigger('click');
            // alert("Choose Salary Paid By");
            // $("#slry_paid").focus();
            // return false;
            single_err_msg += "Choose Salary Paid By \n ";
            $("#slry_paid").css("border", "1px solid red");
        } else {
            $("#slry_paid").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
        }
    }
    if(pan_card != ''){
      if(!(pan_card.match(regpan_card))){
            // $("#cst_inf").trigger('click');
            // alert("Not a valid PAN number");
            // $("#pan_card").focus();
            // return false;
            single_err_msg += "Not a valid PAN number \n ";
            $("#pan_card").css("border", "1px solid red");
        } else {
            $("#pan_card").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
        }
    }

    if(loan_type == 56 || loan_type == 57){
        if(main_acc == ""){
            // $("#cst_inf").trigger('click');
            // alert("Choose Bank Account");
            // $("#main_acc").focus();
            // return false;
            single_err_msg += "Choose Bank Account \n ";
            $("#main_acc").css("border", "1px solid red");
        } else {
            $("#main_acc").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
        }
        if(rented_id == ""){
            // $("#cst_inf").trigger('click');
            // alert("Choose Residential Type");
            // $("#rented_id").focus();
            // return false;
            single_err_msg += "Choose Residential Type \n ";
            $("#rented_id").css("border", "1px solid red");
        } else {
            $("#rented_id").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
        }
        if(adrs_prf == ""){
            // alert("Select Address Proof");
            // $("#cst_inf").trigger('click');
            // $("#adres_proof").focus();
            // return false;
            single_err_msg += "Select Address Proof \n ";
        }
    }
    if((loan_amount == "" || loan_amount == 0) && loan_type != 21 && loan_type != 71){
        // $("#qry_dtl").trigger('click');
        // alert("Enter Loan Amount");
        // $("#loan_amount").val("");
        // $("#loan_amount").focus();
        // return false;
        single_err_msg += "Enter Loan Amount \n ";
        $("#loan_amount").css("border", "1px solid red");
    } else {
        $("#loan_amount").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
    }
    if(loan_type == 51 || loan_type == 54  || loan_type == 56){
        if(loan_type != 56){
            if(prop_city_id == "" || prop_city_id == "Others"){
                // $("#qry_dtl").trigger('click');
                // alert("Enter Property City");
                // $("#prop_city_id").val("");
                // $("#prop_city_id").focus();
                // return false;
                single_err_msg += "Enter Property City \n ";
                $("#prop_city_id").css("border", "1px solid red");
            } else {
                $("#prop_city_id").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
            }
            if(asset_type == ""){
                // $("#qry_dtl").trigger('click');
                // alert("Select Asset Type");
                // $("#asset_type").focus();
                // return false;
                single_err_msg += "Select Asset Type \n ";
                $("#asset_type").css("border", "1px solid red");
            } else {
                $("#asset_type").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
            }
        }
        if(nature_loan == ""){
            // $("#qry_dtl").trigger('click');
            // alert("Select Loan Nature");
            // $("#nature_loan").focus();
            // return false;
            single_err_msg += "Select Loan Nature \n ";
            $("#nature_loan").css("border", "1px solid red");
        } else {
            $("#nature_loan").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
        }
        if(nature_loan == "2"){
            if($("#cur_rate").val() =='' || $("#cur_rate").val() == 0){
                // $("#qry_dtl").trigger('click');
                // alert("Enter Currrent ROI");
                // $("#cur_rate").focus();
                // return false;
                single_err_msg += "Enter Currrent ROI \n ";
                $("#cur_rate").css("border", "1px solid red");
            } else {
                $("#cur_rate").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
            }
            if($("#ex_emi").val() =='' || $("#ex_emi").val() == 0){
                // $("#qry_dtl").trigger('click');
                // alert("Enter Existing EMI");
                // $("#ex_emi").focus();
                // return false;
                single_err_msg += "Enter Existing EMI \n ";
                $("#ex_emi").css("border", "1px solid red");
            } else {
                $("#ex_emi").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
            }
        }
        
        if(loan_type == 51 || loan_type == 52 || loan_type == 54){
            if(prop_identified == ""){
                // $("#qry_dtl").trigger('click');
                // alert("Select Property Identified");
                // $("#prop_identified").focus();
                // return false;
                single_err_msg += "Select Property Identified \n ";
                $("#prop_identified").css("border", "1px solid red");
            } else {
                $("#prop_identified").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
            }
            
            if(prop_identified == "Y") {
                if(prop_loc == ""){
                    // $("#qry_dtl").trigger('click');
                    // alert("Select Property Location");
                    // $("#prop_loc").focus();
                    // return false;
                    single_err_msg += "Select Property Location \n ";
                    $("#prop_loc").css("border", "1px solid red");
                } else {
                    $("#prop_loc").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
                }
                if(prop_identified_sale_type == ""){
                        // $("#qry_dtl").trigger('click');
                        // alert("Select Property Sale Type");
                        // $("#prop_identified_sale_type").focus();
                        // return false;
                        single_err_msg += "Select Property Sale Type \n ";
                        $("#prop_identified_sale_type").css("border", "1px solid red");
                } else {
                    $("#prop_identified_sale_type").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
                }
                if(property_size == "" && prop_loc == '1'){
                    // $("#qry_dtl").trigger('click');
                    // alert("Select Property Area");
                    // $("#property_size").focus();
                    // return false;
                    single_err_msg += "Select Property Area \n ";
                    $("#property_size").css("border", "1px solid red");
                } else {
                    $("#property_size").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
                }
                if(prop_iden_mar_value == "0" || prop_iden_mar_value == ""){
                    // $("#qry_dtl").trigger('click');
                    // alert("Enter Market Value");
                    // $("#prop_iden_mar_value").focus();
                    // return false;
                    single_err_msg += "Enter Market Value \n ";
                    $("#prop_iden_mar_value").css("border", "1px solid red");
                } else {
                    $("#prop_iden_mar_value").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
                }
        
            } 
            if(prop_identified == "N" && u_budget == ''){
                // $("#qry_dtl").trigger('click');
                // alert("Enter Budget");
                // $("#u_budget").focus();
                // return false;
                single_err_msg += "Enter Budget \n ";
                $("#u_budget").css("border", "1px solid red");
            } else {
                $("#u_budget").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
            }
        }
        
        if(loan_type == 60){
            if(gold_weight == "" || gold_weight == 0){
                // $("#qry_dtl").trigger('click');
                // alert("Enter Weight of Gold");
                // $("#gold_weight").focus();
                // return false;
                single_err_msg += "Enter Weight of Gold \n ";
                $("#gold_weight").css("border", "1px solid red");
            } else {
                $("#gold_weight").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
            }
            if(gold_purity == "" || gold_purity == 0){
                // $("#qry_dtl").trigger('click');
                // alert("Enter Purity of Gold");
                // $("#gold_purity").focus();
                // return false;
                single_err_msg += "Enter Purity of Gold \n ";
                $("#gold_purity").css("border", "1px solid red");
            } else {
                $("#gold_purity").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
            }
        }
        
        if(loan_type == 52){
            if(prop_city_id == "" || prop_city_id == "Others"){
                // $("#qry_dtl").trigger('click');
                // alert("Enter Property City");
                // $("#prop_city_id").val("");
                // $("#prop_city_id").focus();
                // return false;
                single_err_msg += "Enter Property City \n ";
                $("#prop_city_id").css("border", "1px solid red");
            } else {
                $("#prop_city_id").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
            }
            if(asset_type == ""){
                // $("#qry_dtl").trigger('click');
                // alert("Select Asset Type");
                // $("#asset_type").focus();
                // return false;
                single_err_msg += "Enter Asset Type \n ";
                $("#asset_type").css("border", "1px solid red");
            } else {
                $("#asset_type").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
            }
        } 
        if(acq_mode == 3){
            if($('#refer_form_type').val() == ''){
                // $("#qry_dtl").trigger('click');
                // alert("Select Type of Referer");
                // $("#ref_mob").focus();
                // return false;
                single_err_msg += "Select Type of Referrer \n ";
                $("#ref_mob").css("border", "1px solid red");
            }
            else if(ref_mob == '' || ref_mob == 0 || ref_mob == 9999999999 || ref_mob == 9888888888 || ref_mob == 7777777777 || ref_mob <= 6000000000 || ref_mob == 8888888888){
                // $("#qry_dtl").trigger('click');
                // alert("Enter Valid Referral Mobile No.");
                // $("#ref_mob").focus();
                // return false;
                single_err_msg += "Enter Valid Referral Mobile No. \n ";
                $("#ref_mob").css("border", "1px solid red");
            } else {
                $("#ref_mob").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
            }
        }
        if(case_status == 1){
            if(c_follow_type == ""){
                // $("#qry_dtl").trigger('click');
                // alert("Select Follow Up Type");
                // $("#c_follow_type").focus();
                // return false;
                single_err_msg += "Select Follow Up Type \n ";
                $("#c_follow_type").css("border", "1px solid red");
            } else {
                $("#c_follow_type").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
            }
            if(c_folow_up_date == ""){
                // $("#qry_dtl").trigger('click');
                // alert("Enter Follow Up Date");
                // $("#c_folow_up_date").focus();
                // return false;
                single_err_msg += "Enter Follow Up Date \n ";
                $("#c_folow_up_date").css("border", "1px solid red");
            } else {
                $("#c_folow_up_date").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
            }
            if(c_follow_up_time == ""){
                // $("#qry_dtl").trigger('click');
                // alert("Enter Follow Up Time");
                // $("#c_follow_up_time").focus();
                // return false;
                single_err_msg += "Enter Follow Up Time \n ";
                $("#c_follow_up_time").css("border", "1px solid red");
            } else {
                $("#c_follow_up_time").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
            }
        }
		
        if($('#no_verify').is(":visible") == true) {
            if(!check_value.checked){
                // alert("Verify Mobile Number First");
                // $("#no_verify").focus();
                // return false;
                single_err_msg += "Verify Mobile Number First \n ";
                $("#no_verify").css("border", "1px solid red");
            } else {
                $("#no_verify").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
            }
        }
    }
}

    if(exis_loan == 1 || exis_loan == 2 || exis_loan == 3 || exis_loan == 4 || exis_loan == 5){
        if(loan_type_on == ""){
            // $("#ext_crds").trigger('click');
            // alert("Choose Loan Type on First Existing Loan");
            // $("#loan_type_on").focus();
            // return false;
            single_err_msg += "Choose Loan Type on First Existing Loan \n ";
            $("#loan_type_on").css("border", "1px solid red");
        } else {
            $("#loan_type_on").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
        }
        if(ex_bank_id == ""){
            // $("#ext_crds").trigger('click');
            // alert("Choose Bank on First Existing Loan");
            // $("#ex_bank_id").focus();
            // return false;
            single_err_msg += "Choose Bank on First Existing Loan \n ";
            $("#ex_bank_id").css("border", "1px solid red");
        } else {
            $("#ex_bank_id").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
        }
        if(emi_loan_on == ""){
            // $("#ext_crds").trigger('click');
            // alert("Enter Emi on First Existing Loan");
            // $("#emi_loan_on").focus();
            // return false;
            single_err_msg += "Enter Emi on First Existing Loan \n ";
            $("#emi_loan_on").css("border", "1px solid red");
        } else {
            $("#emi_loan_on").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
        }
    }
    if(exis_loan == 2 || exis_loan == 3 || exis_loan == 4 || exis_loan == 5 ){
        if(loan_type_tw == ""){
            // $("#ext_crds").trigger('click');
            // alert("Choose Loan Type on Second Existing Loan");
            // $("#loan_type_tw").focus();
            single_err_msg += "Choose Loan Type on Second Existing Loan \n ";
            $("#loan_type_tw").css("border", "1px solid red");
        } else {
            $("#loan_type_tw").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
        }
        if(ex_bank_id_tw == ""){
            // $("#ext_crds").trigger('click');
            // alert("Choose Bank on Second Existing Loan");
            // $("#ex_bank_id_tw").focus();
            // return false;
            single_err_msg += "Choose Bank on Second Existing Loan \n ";
            $("#ex_bank_id_tw").css("border", "1px solid red");
        } else {
            $("#ex_bank_id_tw").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
        }
        if(emi_loan_tw == ""){
            // $("#ext_crds").trigger('click');
            // alert("Enter Emi on Second Existing Loan");
            // $("#emi_loan_tw").focus();
            // return false;
            single_err_msg += "Enter Emi on Second Existing Loan \n ";
            $("#emi_loan_tw").css("border", "1px solid red");
        } else {
            $("#emi_loan_tw").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
        }
    }
	if( exis_loan == 3 || exis_loan == 4 || exis_loan == 5 ){
        if(loan_type_th == ""){
            // $("#ext_crds").trigger('click');
            // alert("Choose Loan Type on Third Existing Loan");
            // $("#loan_type_th").focus();
            single_err_msg += "Choose Loan Type on Third Existing Loan \n ";
            $("#loan_type_th").css("border", "1px solid red");
        } else {
            $("#loan_type_th").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
        }
        if(ex_bank_id_th == ""){
            // $("#ext_crds").trigger('click');
            // alert("Choose Bank on Third Existing Loan");
            // $("#ex_bank_id_th").focus();
            // return false;
            single_err_msg += "Choose Bank on Third Existing Loan \n ";
            $("#ex_bank_id_th").css("border", "1px solid red");
        } else {
            $("#ex_bank_id_th").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
        }
        if(emi_loan_th == ""){
            // $("#ext_crds").trigger('click');
            // alert("Enter Emi on Third Existing Loan");
            // $("#emi_loan_th").focus();
            // return false;
            single_err_msg += "Enter Emi on Third Existing Loan \n ";
            $("#emi_loan_th").css("border", "1px solid red");
        } else {
            $("#emi_loan_th").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
        }
    }
	if(exis_loan == 4 || exis_loan == 5 ){
        if(loan_type_fr == ""){
            // $("#ext_crds").trigger('click');
            // alert("Choose Loan Type on Fourth Existing Loan");
            // $("#loan_type_fr").focus();
            single_err_msg += "Choose Loan Type on Fourth Existing Loan \n ";
            $("#loan_type_fr").css("border", "1px solid red");
        } else {
            $("#loan_type_fr").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
        }
        if(ex_bank_id_fr == ""){
            // $("#ext_crds").trigger('click');
            // alert("Choose Bank on Fourth Existing Loan");
            // $("#ex_bank_id_fr").focus();
            // return false;
            single_err_msg +="Choose Bank on Fourth Existing Loan \n ";
            $("#ex_bank_id_fr").css("border", "1px solid red");
        } else {
            $("#ex_bank_id_fr").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
        }
        if(emi_loan_fr == ""){
            // $("#ext_crds").trigger('click');
            // alert("Enter Emi on Fourth Existing Loan");
            // $("#emi_loan_fr").focus();
            // return false;
            single_err_msg += "Enter Emi on Fourth Existing Loan \n ";
            $("#emi_loan_fr").css("border", "1px solid red");
        } else {
            $("#emi_loan_fr").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
        }
    }
    if(exis_loan == 5){
        if(loan_type_fv == ""){
            // $("#ext_crds").trigger('click');
            // alert("Choose Loan Type on Fifth Existing Loan");
            // $("#loan_type_fv").focus();
            // return false;
            single_err_msg += "Choose Loan Type on Fifth Existing Loan \n ";
            $("#loan_type_fv").css("border", "1px solid red");
        } else {
            $("#loan_type_fv").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
        }
        if(ex_bank_id_fv == ""){
            // $("#ext_crds").trigger('click');
            // alert("Choose Bank on Fifth Existing Loan");
            // $("#ex_bank_id_fv").focus();
            // return false;
            single_err_msg += "Choose Bank on Fifth Existing Loan \n ";
            $("#ex_bank_id_fv").css("border", "1px solid red");
        } else {
            $("#ex_bank_id_fv").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
        }
        if(emi_loan_fv == ""){
            // $("#ext_crds").trigger('click');
            // alert("Enter Emi on Fifth Existing Loan");
            // $("#emi_loan_fv").focus();
            // return false;
            single_err_msg += "Enter Emi on Fifth Existing Loan \n ";
            $("#emi_loan_fv").css("border", "1px solid red");
        } else {
            $("#emi_loan_fv").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
        }
    }
    if(credit_running == 1 || credit_running == 2 || credit_running == 3 || credit_running == 4 || credit_running == 5){
        if(credit_bank_id == ""){
            // $("#ext_crds").trigger('click');
            // alert("Choose Bank for First Credit Card ");
            // $("#credit_bank_id").focus();
            // return false;
            single_err_msg += "Choose Bank for First Credit Card \n ";
            $("#credit_bank_id").css("border", "1px solid red");
        } else {
            $("#credit_bank_id").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
        }
        if(credit_sanction_amt_on == "" || credit_sanction_amt_on == 0){
            // $("#ext_crds").trigger('click');
            // alert("Enter Sanctioned Amount for First Credit Card");
            // $("#credit_sanction_amt_on").focus();
            // return false;
            single_err_msg += "Enter Sanctioned Amount for First Credit Card \n ";
            $("#credit_sanction_amt_on").css("border", "1px solid red");
        } else {
            $("#credit_sanction_amt_on").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
        }
        if(current_out_stan_on == ""){
            // $("#ext_crds").trigger('click');
            // alert("Enter Outstanding Amount for First Credit Card");
            // $("#current_out_stan_on").focus();
            // return false;
            single_err_msg += "Enter Outstanding Amount for First Credit Card \n ";
            $("#current_out_stan_on").css("border", "1px solid red");
        } else {
            $("#current_out_stan_on").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
        }
    }
    if(credit_running == 2 || credit_running == 3 || credit_running == 4 || credit_running == 5){
        if(credit_bank_id_tw == ""){
            // $("#ext_crds").trigger('click');
            // alert("Choose Bank for Second Credit Card ");
            // $("#credit_bank_id_tw").focus();
            // return false;
            single_err_msg += "Choose Bank for Second Credit Card \n ";
            $("#credit_bank_id_tw").css("border", "1px solid red");
        } else {
            $("#credit_bank_id_tw").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
        }
        if(credit_sanction_amt_tw == "" || credit_sanction_amt_tw == 0){
            // $("#ext_crds").trigger('click');
            // alert("Enter Sanctioned Amount for Second Credit Card");
            // $("#credit_sanction_amt_tw").focus();
            // return false;
            single_err_msg += "Enter Sanctioned Amount for Second Credit Card \n ";
            $("#credit_sanction_amt_tw").css("border", "1px solid red");
        } else {
            $("#credit_sanction_amt_tw").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
        }
        if(current_out_stan_tw == ""){
            // $("#ext_crds").trigger('click');
            // alert("Enter Outstanding Amount for Second Credit Card");
            // $("#current_out_stan_tw").focus();
            // return false;
            single_err_msg += "Enter Outstanding Amount for Second Credit Card \n ";
            $("#current_out_stan_tw").css("border", "1px solid red");
        } else {
            $("#current_out_stan_tw").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
        }
    }
	if(credit_running == 3 || credit_running == 4 || credit_running == 5){
        if(credit_bank_id_th == ""){
            // $("#ext_crds").trigger('click');
            // alert("Choose Bank for Third Credit Card ");
            // $("#credit_bank_id_th").focus();
            // return false;
            single_err_msg += "Choose Bank for Third Credit Card \n ";
            $("#credit_bank_id_th").css("border", "1px solid red");
        } else {
            $("#credit_bank_id_th").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
        }
        if(credit_sanction_amt_th == "" || credit_sanction_amt_th == 0){
            // $("#ext_crds").trigger('click');
            // alert("Enter Sanctioned Amount for Third Credit Card");
            // $("#credit_sanction_amt_th").focus();
            // return false;
            single_err_msg += "Enter Sanctioned Amount for Third Credit Card \n ";
            $("#credit_sanction_amt_th").css("border", "1px solid red");
        } else {
            $("#credit_sanction_amt_th").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
        }
        if(current_out_stan_th == ""){
            // $("#ext_crds").trigger('click');
            // alert("Enter Outstanding Amount for Third Credit Card");
            // $("#current_out_stan_th").focus();
            // return false;
            single_err_msg += "Enter Outstanding Amount for Third Credit Card \n ";
            $("#current_out_stan_th").css("border", "1px solid red");
        } else {
            $("#current_out_stan_th").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
        }
    }
    if(credit_running == 4 || credit_running == 5){
        if(credit_bank_id_fr == ""){
            // $("#ext_crds").trigger('click');
            // alert("Choose Bank for Fourth Credit Card ");
            // $("#credit_bank_id_fr").focus();
            // return false;
            single_err_msg += "Choose Bank for Fourth Credit Card \n ";
            $("#credit_bank_id_fr").css("border", "1px solid red");
        } else {
            $("#credit_bank_id_fr").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
        }
        if(credit_sanction_amt_fr == "" || credit_sanction_amt_fr == 0){
            // $("#ext_crds").trigger('click');
            // alert("Enter Sanctioned Amount for Fourth Credit Card");
            // $("#credit_sanction_amt_fr").focus();
            // return false;
            single_err_msg += "Enter Sanctioned Amount for Fourth Credit Card \n ";
            $("#credit_sanction_amt_fr").css("border", "1px solid red");
        } else {
            $("#credit_sanction_amt_fr").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
        }
        if(current_out_stan_fr == ""){
            // $("#ext_crds").trigger('click');
            // alert("Enter Outstanding Amount for Fourth Credit Card");
            // $("#current_out_stan_fr").focus();
            // return false;
            single_err_msg += "Enter Outstanding Amount for Fourth Credit Card \n ";
            $("#current_out_stan_fr").css("border", "1px solid red");
        } else {
            $("#current_out_stan_fr").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
        }
    }
    if(credit_running == 5){
        if(credit_bank_id_fv == ""){
            // $("#ext_crds").trigger('click');
            // alert("Choose Bank for Fifth Credit Card ");
            // $("#credit_bank_id_fv").focus();
            // return false;
            single_err_msg += "Choose Bank for Fifth Credit Card \n ";
            $("#credit_bank_id_fv").css("border", "1px solid red");
        } else {
            $("#credit_bank_id_fv").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
        }
        if(credit_sanction_amt_fv == "" || credit_sanction_amt_fv == 0){
            // $("#ext_crds").trigger('click');
            // alert("Enter Sanctioned Amount for Fifth Credit Card");
            // $("#credit_sanction_amt_fv").focus();
            // return false;
            single_err_msg += "Enter Sanctioned Amount for Fifth Credit Card \n ";
            $("#credit_sanction_amt_fv").css("border", "1px solid red");
        } else {
            $("#credit_sanction_amt_fv").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
        }
        if(current_out_stan_fv == ""){
            // $("#ext_crds").trigger('click');
            // alert("Enter Outstanding Amount for Fifth Credit Card");
            // $("#current_out_stan_fv").focus();
            // return false;
            single_err_msg += "Enter Outstanding Amount for Fifth Credit Card \n ";
            $("#current_out_stan_fv").css("border", "1px solid red");
        } else {
            $("#current_out_stan_fv").css({"border": "none", "border-bottom": "1px solid #eb9b42"});
        }
    }
    var combined_error = single_err_msg.trim();
    combined_error_final = combined_error.replace(/,\s*$/, "");
    if(combined_error_final != "") {
        alert(combined_error_final);
        return false;
    } else {
        var is_city_valid = $.ajax({
            data: "city_name=" + city,
            type: "POST",
            url: "../insert/check_valid_city.php",
            async: false,
            success:function(data) {
                return data;
            }
        });
        console.log(is_city_valid);
        var city_valid_response = JSON.parse(is_city_valid.responseText);
        if(city_valid_response == 1) {
            alert("Entered City is not valid");
            return false;
        }
    }
}

//Changes - AlternatePhone - Akash - Ends

</script>