<?php
$dialog_pop_up_disabled_flag = 1;
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../include/header.php');
require_once(dirname(__FILE__) . '/../config/config.php');


if($_REQUEST['calculate']){
    $loan_type = replace_special($_REQUEST['loan_type']);
    $net_incm = replace_special($_REQUEST['net_incm']);
    $foir = replace_special($_REQUEST['foir'])/100;
    $loan_emi = replace_special($_REQUEST['ext_emi']);
    $cur_rate_emi = replace_special($_REQUEST['cur_rate_emi']);
    $rate = replace_special($cur_rate_emi)/1200;
    $nth_pl = replace_special($_REQUEST['nth_multiplier']);
    $elig_msg = array();
    if($loan_type == 54){
        $tennure_get = array('2','3','4','5');
        foreach($tennure_get as $tennure){
            $calculation_gen = ($net_incm  * $foir) - $loan_emi;
            if($calculation_gen < '0') {$calculation_gen = '0'; }	
                $cal_gen = 1 - pow(1 + $rate, - ($tennure*12));	
                $cal_gen_pre_final = round($calculation_gen * ($cal_gen / $rate));
            if($nth_pl != '0' && $nth_pl != ''){	
                $cal_gen_prenth_final = $net_incm * $nth_pl;
                $cal_gen_final = min($cal_gen_pre_final,$cal_gen_prenth_final);
            } else {
                $cal_gen_final  = $cal_gen_pre_final;
            }
                $elig_msg[] = $cal_gen_final;
        }
    }else if($loan_type == 55){
        $net_incm_on = replace_special($_REQUEST['cob_nth_1']);
        $net_incm_tw = replace_special($_REQUEST['cob_nth_2']);
        $cur_emi_on = replace_special($_REQUEST['cob_emi_1']);
        $cur_emi_tw = replace_special($_REQUEST['cob_emi_2']);
        $tennure_get = array('15','20','25');
        foreach($tennure_get as $tennure){
        $calculation_gen = ($net_incm  * $foir) - $loan_emi;
        if($calculation_gen < '0'){$calculation_gen = '0';}
            $calculation_gen_double = ($net_incm_on  * $foir) - $cur_emi_on;
            $calculation_gen_three = ($net_incm_tw  * $foir) - $cur_emi_tw;
			$cal_gen = 1 - pow(1 + $rate, - ($tennure*12));
        if($coborrower =='1'){   
            $cal_gen_final_pre = round(($calculation_gen + $calculation_gen_double) * ($cal_gen / $rate));
            $cal_gen_final_pre1 = round($calculation_gen_double * ($cal_gen / $rate));
        }else if($coborrower =='2'){
            $cal_gen_final_pre = round(($calculation_gen + $calculation_gen_double + $calculation_gen_three) * ($cal_gen / $rate));
            $cal_gen_final_pre2 = round(($calculation_gen + $calculation_gen_three) * ($cal_gen / $rate));
            $cal_gen_final_pre1 = round($calculation_gen_three * ($cal_gen / $rate));
            $cal_gen_final_pre3 = round(($calculation_gen_three + $calculation_gen_double) * ($cal_gen / $rate));
        }else{
            $cal_gen_final_pre = round($calculation_gen * ($cal_gen / $rate));
        }
            $head_elig_calc = max($cal_gen_final_pre,$cal_gen_final_pre1,$cal_gen_final_pre2,$cal_gen_final_pre3);
            $elig_msg[] = $head_elig_calc;
        }    
        $msg = '';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
     <title>Calculate Eligibility</title>
     <link rel="stylesheet" type="text/css" href="<?php echo $head_url; ?>/assets/css/style.css?v=2.2">
     <script type="text/javascript" src="<?php echo $head_url; ?>/assets/js/jquery-1.10.2.js"></script>
</head>
<body>
<fieldset class='mall_30' style="height:200px;">
<legend>Calculate Eligibility</legend>
<div class="f_14 center red error hidden">All fields are mandatory!</div>
<div class="f_14 center green"><?php echo $msg; ?></div>
<form action="calculate-eligibility.php" name="eligibility_form" id="eligibility_form" method="POST" >
    
        <span class='f_14 orange fw_bold'>Loan Type:</span>
        <select name="loan_type" id="loan_type" class='' onchange="loan_type_func(this.value)" required>
            <option value="">Select Loan Type</option>
    <option value="51" <?php if($loan_type == 55){echo "selected";} ?>>Home Loan</option>
    <option value="56" <?php if($loan_type == 54){echo "selected";} ?>>Personal Loan</option>
    </select>
     <span class='f_14 ml20 orange fw_bold 51_loan'>No of Co-borrowers:</span>
    <select name="no_cob" id="no_cob" class="51_loan " onchange="cob_func(this.value);"><option value="">No of Co-Borrowers</option><option value="0" selected>0</option><option value="1">1</option><option value="2">2</option></select>
    <span class='f_14 ml20 orange fw_bold 60_loan'>Check Eligibility for:</span>
    <select name="gl_elig_for" id="gl_elig_for" class='60_loan ' onchange="gl_func(this.value)"><option value="">Check Eligibility for</option>
    <option value="1" <?php if($_REQUEST['gl_elig_for'] == 1){echo "selected";} ?>>Check Loan Eligibility for your gold</option>
    <option value="2" <?php if($_REQUEST['gl_elig_for'] == 2){echo "selected";} ?>>Gold Needed to avail loan amount</option></select>
    <span class='f_14 orange fw_bold loan_amt'>Desired Loan Amount:</span>
    <input type="tel" name="loan_amt" id="loan_amt" class="loan_amt" placeholder="Loan Amount" maxlength='10' value="<?php echo $loan_amt; ?>">
    <span class='f_14 ml20 orange fw_bold weight_gold'>Weight of Gold (In Grams):</span>
    <input type="tel" name="weight_gold" class="weight_gold" id="weight_gold" placeholder="Weight of Gold (In Grams)" maxlength='10' value="<?php echo $gl_weight; ?>">
     <span class='f_14 orange fw_bold 60_loan'>Purity of Gold:</span>
    <input type="tel" name="purity_gold" id="purity_gold" class="60_loan " placeholder="Purity of Gold" maxlength='3' value="<?php echo $gl_purity; ?>">

    <span class='f_14 orange fw_bold hl_pl_loan'>Net Income:</span>
    <input type="tel" name="net_incm" id="net_incm" placeholder="Net Income" class='hl_pl_loan ' maxlength='10' value="<?php echo $net_incm; ?>">
    <span class='f_14 ml20 orange fw_bold hl_pl_loan'>Existing EMI:</span>
    <input type="tel" name="ext_emi" id="ext_emi" placeholder="Existing EMI" class='hl_pl_loan ' maxlength='10' value="<?php echo $loan_emi; ?>">
    <!-- <span class='f_14 orange fw_bold hl_pl_loan'>Tennure(Months):</span>
    <input type="tel" name="loan_tenure" id="loan_tenure" placeholder="Tennure (In Months)" class='hl_pl_loan ' maxlength='3' value="<?php echo $tennure; ?>">-->
    <span class='f_14 orange fw_bold hl_pl_loan'>Foir:</span>
    <input type="tel" name="foir" id="foir" placeholder="Foir" maxlength='5' class='hl_pl_loan ' value="<?php echo $foir*100; ?>">
    <span class='f_14 ml20 orange fw_bold hl_pl_loan'>ROI:</span>
    <input type="tel" name="cur_rate_emi" id="cur_rate_emi" class="cur_rate_emi hl_pl_loan " placeholder="Rate of Interest" onkeydown="isNumberKey(event);" maxlength='5' value="<?php echo $cur_rate_emi; ?>">
   
    <span class='f_14 orange fw_bold 56_loan'>NTH Multiplier:</span>
    <input type="tel" name="nth_multiplier" id="nth_multiplier" placeholder="NTH Multiplier" maxlength='3' class="56_loan " value="<?php echo $nth_pl; ?>">
    <br>

    <span class='f_14 orange fw_bold cob_1'>Co-borrower1 Net Income:</span>
    <input type="tel" name="cob_nth_1" id="cob_nth_1" placeholder="Net Income" maxlength='10' class="cob_1 " value="<?php echo $net_incm_on; ?>">
    <span class='f_14 ml20 orange fw_bold cob_1'>Co-borrower1 Existing EMI:</span>
    <input type="tel" name="cob_emi_1" id="cob_emi_1" placeholder="Existing EMI" maxlength='10' class="cob_1 " value="<?php echo $cur_emi_on; ?>">
     <br>
    <span class='f_14 orange fw_bold cob_2'>Co-borrower2 Net Income:</span>
    <input type="tel" name="cob_nth_2" id="cob_nth_2" placeholder="Net Income" maxlength='10' class="cob_2 " value="<?php echo $net_incm_tw; ?>">
    <span class='f_14 ml20 orange fw_bold cob_2'>Co-borrower2 Existing EMI:</span>
    <input type="tel" name="cob_emi_2" id="cob_emi_2" placeholder="Existing EMI" maxlength='10' class="cob_2 " value="<?php echo $cur_emi_tw; ?>">
    <br>
     
    <input type="submit" class="buttonsub cursor" value="Calculate Eligibility" name ="calculate" id ="calculate"> 

</form>
</fieldset>
<?php if(!empty($elig_msg)){ ?>
<table class="gridtable ml50" width="70%">
    <tr><th>Tennure</th><?php foreach($tennure_get as $get_tennure){?><th><?php echo $get_tennure." years"; ?></th><?php } ?></tr>
    <tr><th>Eligible Amount</th><?php foreach($elig_msg as $elig){?><td><?php echo number_format($elig); ?></td><?php } ?></tr>
</table>
<?php } ?>
</body></html>
<script>

function dots(){
var dateBox = document.getElementsByClassName("cur_rate_emi")[0];
    var chars = dateBox.value.length;
    var roi = dateBox.value;

    if (chars == 2) {
        dateBox.value = roi + ".";
    }
    else if (chars == 6) {
        dateBox.value = roi + ".";
    }
	else if (chars == 1 && roi > '4') {
        dateBox.value = "0" + roi + ".";
    }       
}
function isNumberKey(evt){
var charCode = (evt.which) ? evt.which : evt.keyCode;
if((charCode >=48 && charCode<=57) || (charCode>=96 && charCode<=105)){
    dots();
  }
else if(charCode==37 ||charCode==39 || charCode==46 || charCode==8 || charCode==9){
}
else{
    evt.preventDefault();
    }
}

function loan_type_func(loan){
    alert(loan);
        if(loan == 54){
            $(".hl_pl_loan,.56_loan").removeClass("hidden").attr("required","required");
            $(".51_loan,.60_loan,.cob_1,.cob_2,.weight_gold,.loan_amt").val("").addClass("hidden").removeAttr("required");
        }else if(loan == 55){
            $(".hl_pl_loan,.51_loan").removeClass("hidden").attr("required","required");
            $(".56_loan,.cob_2,.cob_1,.60_loan,.weight_gold,.loan_amt").val("").addClass("hidden").removeAttr("required");
            $("#no_cob").val("0");
        }else{
            $(".hl_pl_loan,.51_loan,.56_loan,.60_loan,.cob_2,.cob_1,.weight_gold,.loan_amt").val("").addClass("hidden").removeAttr("required");
        }
}
function cob_func(cob){
        if(cob == 1){
            $(".cob_1").removeClass("hidden").attr("required","required");
            $(".cob_2").addClass("hidden").removeAttr("required");
        }else if(cob == 2){
            $(".cob_1,.cob_2").removeClass("hidden").attr("required","required");
        }else{
             $(".cob_2").addClass("hidden").removeAttr("required");
            $(".cob_1").addClass("hidden").removeAttr("required");
        }
}
$( document ).ready(function() {
    $(".51_loan,.hl_pl_loan,.56_loan,.60_loan,.cob_2,.cob_1,.weight_gold,.loan_amt").addClass("hidden");
    loan_type_func('<?php echo $loan_type; ?>');

});
</script>




