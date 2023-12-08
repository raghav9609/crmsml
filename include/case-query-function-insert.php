<script src="<?php echo $head_url; ?>/include/js/jquery-1.3.2.min.js" type="text/javascript"></script>
<script>
$(function() {  
  $('#new_pan_card').on('focusout', function () {
    	    if($('#new_pan_card').val() != ''){
					    $("#pan_ver_clck").removeClass("hidden");
    	    }
    });
    
$("#pin_code").on("focusout",function(){ 
    var pincode = $("#pin_code").val();
      $.ajax({
            data: "pincode="+pincode,
            type: "POST",
            url: "<?php echo $head_url;?>/include/get-city.php",
            success:function(data){
                if(data != ''){
                    var element = data.split("@#");
                 $("#city_id").val(element[0]);
                 $("#state").val(element[1]);
                }
            }
        });
        
});

    $("#ofc_pincode").on("focusout",function(){
        var ofc_pincode = $("#ofc_pincode").val();
        $.ajax({
            data: "pincode="+ofc_pincode,
            type: "POST",
            url: "<?php echo $head_url;?>/include/get-city.php",
            success:function(data) {
                if(data != '') {
                    var element = data.split("@#");
                    $("#work_city").val(element[0]);
                }
            }
        });    
    });

});

function suggestion_box(get_val,offers_level_type=0){
    var query_id = $("input[name='final_query_id']").val();
	var cust_iddd = $("#cust_iddd").val();
    var journey_type = $("#journey_type").val();
	var loan_amt = $("#loan_amount").val();
	var comp_name = $("#comp_name").val();
    var bank_account_type = $("#bank_account_type option:selected").val();
	var comp_name_other = $("#comp_name_other").val();
	var net_incm = $("#net_month_inc").val();
	var pin_code = $("#pin_code").val();
	var twe = $("#twe").val();
	var dob = $("#dob").val();
	var main_acc = $("#main_acc").val();
	var city_name = $("#city_id").val();
	var occup_id = $("#occupation_id").val();
	var name = $("#name").val();
	var loan_type = $("#loan_type").val();
	var twe = $("#twe").val();
	var loan_emi = $("#ex_emi").val();
	var extng_amt = $("#ex_amt").val();
	var slry_mode = $("#slry_paid").val();
	var nature_loan = $("#nature_loan").val();
	var rented_id = $("#rented_id").val();
	var cur_rate = $("#cur_rate").val();
	var asset_type = $("#asset_type").val();
	var weight_gold = $("#gold_weight").val();
	var purity_gold = $("#gold_purity").val();
	var exis_loans = $("#exis_loans").val();
	var credit_running =  $("#credit_running option:selected").val();
	var profession_id = $("#profession option:selected").val();
	var bus_nature = $("#nature_of_business option:selected").val();
    var industry_type =  $("#industry_type option:selected").val();
    var registration_type = $("#type_of_registration option:selected").val();
    var type_of_business = $("#business_type option:selected").val();
	var annual_turnover_num = $("#annual_turnover").val();
	var business_existing_num = $("#years_in_business").val();
	var itr_available_num = $("#ITR_available option:selected").val();
    var degree_reg_year = $("#degree_reg_year option:selected").val();
	var property_identified_sale_type_id = $("#prop_identified_sale_type option:selected").val();
	var property_location_id = $("#prop_loc").val();
	var property_size = $("#property_size").val();
	var property_city_id =  $("#prop_city_id").val();
	var property_identified = $("input[name='prop_identified']:checked").val();
    var loan_in_past = $("input[name='loan_in_past']:checked").val();
    var gold_type  = $("#gold_type option:selected").val();
    var top_loan_amt  = $("#top_loan_amt").val();
    var case_id = $('input[name="case_id"]').val();
	if(get_val == 1){
		var url = "<?php echo $head_url; ?>/sugar/all_query/dss.php";	 
    }else{
    	var url = "<?php echo $head_url; ?>/sugar/offers/index.php";
    }
	$.ajax({
        method:'GET',
        cache:'false',  
        url: url,
        data: "top_loan_amt="+top_loan_amt+"&loan_in_past="+loan_in_past+"&industry_type="+industry_type+"&registration_type="+registration_type+"&type_of_business="+type_of_business+"&bank_account_type="+bank_account_type+"&degree_reg_year="+degree_reg_year+"&loan_amt="+loan_amt+"&pin_code="+pin_code+"&comp_name="+comp_name+"&cust_iddd="+cust_iddd+"&net_incm="+net_incm+"&twe="+twe+"&dob="+dob+"&main_acc="+main_acc+"&loan_type="+loan_type+"&occup_id="+occup_id+"&city_name="+city_name+"&name="+name+"&loan_emi="+loan_emi+"&extng_amt="+extng_amt+"&slry_paid="+slry_mode+"&loan_nature="+nature_loan+"&rented_id="+rented_id+"&cur_rate="+cur_rate+"&asset_type="+asset_type+"&weight_gold="+weight_gold+"&purity_gold="+purity_gold+"&exis_loans="+exis_loans+"&credit_running="+credit_running+"&profession_id="+profession_id+"&bus_nature="+bus_nature+"&annual_turnover_num="+annual_turnover_num+"&business_existing_num="+business_existing_num+"&itr_available_num="+itr_available_num+"&property_identified_sale_type_id="+property_identified_sale_type_id+"&journey_type="+journey_type+"&property_size="+property_size+"&property_city_id="+property_city_id+"&property_identified="+property_identified+"&run_ch=1&query_id="+query_id+"&gold_type="+gold_type+"&case_id="+case_id+"&offers_level_type="+offers_level_type,
		success: function(response) {
            if(offers_level_type == 1){
                $(".id01").html(response);
                lead_popup();
            }else if(journey_type == 1){
                $("#new_offers_journey").html(response);
            }
			
		}
	});
    //Changes - GoldLoanApi - Akash - Ends
}
function cibil_summary(cibil,destId){
    $.ajax({      
	method:'POST',
	cache:'false',  
	beforeSend: function () {
                    $("#experian_buttn").attr('value', 'Processing...').prop('disabled', true);
                },
    url: "<?php echo $head_url; ?>/sugar/report/credit-report-summary.php",
	data: "destId="+btoa(destId)+"&cibil="+btoa(cibil),
		success: function(response) {                                           
			$(".id01").html("").html(response);
			lead_popup();
			$("#experian_buttn").attr('value', 'Experian').prop('disabled', false);
		}                                                                                 
	});
}


function cibil_epf_summary(epf_id,destId){
    $.ajax({      
	method:'POST',
	cache:'false',  
	beforeSend: function () {
                    $("#epf_buttn").attr('value', 'Processing...').prop('disabled', true);
                },
    url: "<?php echo $head_url; ?>/sugar/insert/epf-summary.php",
	data: "destId="+btoa(destId)+"&epf_id="+btoa(epf_id),
		success: function(response) {                                           
			$(".id01").html("").html(response);
			lead_popup();
			$("#epf_buttn").attr('value', 'EPF').prop('disabled', false);
		}                                                                                 
	});
}


   function validatePAN(pan){ 
    var regex = /[A-Za-z]{5}[0-9]{4}[A-Za-z]{1}$/; 
    return regex.test(pan); 
    }    
    function validatePAN(pan){ 
        var regex = /[A-Za-z]{5}[0-9]{4}[A-Za-z]{1}$/; 
        return regex.test(pan); 
    }

    function p1(){
      $('#see').hide();
    }
    function p2(){
      $('#see').show();
    }
function number_show(id,src){
    var id = id;
    var src = src;
    $.ajax({
        data: "id="+id+'&src='+src,
            type: "POST",
            beforeSend: function () {
                    $("#show_btn").attr('onclick', '');
                },
            url: "/sugar/all_query/show_number_history.php",
            success:function(data){
                $("#phone_no").val(data);
                $('html, body').animate({
                scrollTop: $("#phone_no").offset().top - 160
            }, 1000);
            }
    });
}

function report_pos(pos_val){
	if(pos_val == 'Credit Summary'){
		$('.main_div').animate({
            scrollTop: $("#summary_table").offset().top-180
        }, 1000);
		  	
	} else if(pos_val == 'Credit Enquiry'){
		$('.main_div').animate({
            scrollTop: $("#enquiry_table").offset().top-105
        }, 1000);	
	}
	
}

function like_dislike_save(pat_id, contact_id, level_type, mgr_type, like_dislike_flag, loan_type, level_id, city_id) {
    if(pat_id && contact_id && level_type && mgr_type && like_dislike_flag && city_id) {
        if(like_dislike_flag == 1) {            
            $("#"+contact_id+"_"+mgr_type+"_"+like_dislike_flag+"_"+city_id).addClass("like-shadow-effect");
            $("#"+contact_id+"_"+mgr_type+"_"+like_dislike_flag+"_"+city_id).removeClass("dislike-shadow-effect");            
        } else {            
            $("#"+contact_id+"_"+mgr_type+"_"+like_dislike_flag+"_"+city_id).addClass("dislike-shadow-effect");
            $("#"+contact_id+"_"+mgr_type+"_"+like_dislike_flag+"_"+city_id).removeClass("like-shadow-effect");            
        }
        this_val = $(this);
        console.log(this_val);
        $.ajax({
            type: "POST",
            url: "../insert/valid_rm_sm_insert.php",
            data: "pat_id="+pat_id+"&contact_id="+contact_id+"&level_type="+level_type+"&mgr_type="+mgr_type+"&like_dislike_flag="+like_dislike_flag+"&loan_type="+loan_type+"&level_id="+level_id+"&city_id="+city_id,
            success: function(response) {
                res = JSON.parse(response);
                if(res.status == 0) {
                    alert("Action not performed. Data missing.");
                } else {
                    alert("Successfully saved");
                }
            }
        });        
    } else {
        alert("Action not performed. Data missing");
    }
}

function show_hide_con(class_name) {
    var maxLength = 100;
    $(class_name).each(function() {
        var myStr = $(this).text();
        if($.trim(myStr).length > maxLength) {
            var newStr = myStr.substring(0, maxLength);
            var removedStr = myStr.substring(maxLength, $.trim(myStr).length);
            $(this).empty().html(newStr);
            $(this).append(' <a href="javascript:void(0);" class="read-more"> Read more... </a>');
            $(this).append('<span class="more-text hidden">' + removedStr + '<a href="javascript:void(0);" class="read-less"> Read less... </a> </span>');
        }
    });

    $(".read-more").click(function() {
        $(this).siblings(".more-text").removeClass("hidden");
        $(this).addClass("hidden");
    });

    $(".read-less").click(function() {
        $(this).parent().addClass("hidden");
        $(this).parent().prev().removeClass("hidden");
    });
}

function alt_number_show(id, src) {
    var id = id;
    var src = src;
    $.ajax({
        data: "id="+id+'&src='+src,
        type: "POST",
        beforeSend: function () {
            $("#show_alt_btn").attr('onclick', '');
        },
        url: "../insert/show_alternate_number.php",
        success:function(data) {
            $("#alt_phone_no").val(data);
        }
    });
}
</script>