<?php
require_once "../../include/crm-header.php";
require_once "../../include/dropdown.php";

if($_REQUEST['calculate']){
    $loan_amount = replace_special($_REQUEST['loan_amount']);
    $cur_rate_emi = replace_special($_REQUEST['cur_rate_emi']);
    $loan_tenure = replace_special($_REQUEST['loan_tenure']);
        
    if($_REQUEST['loan_amount'] != '' && $_REQUEST['cur_rate_emi'] != '' && $_REQUEST['loan_tenure'] != ''){
        $emi = calculate_emi($loan_amount,$cur_rate_emi/1200,$loan_tenure);
        $flat_rate = calculate_flat_from_reduce($cur_rate_emi, $emi, $loan_tenure);
        $total_interest = ($emi*$_REQUEST['loan_tenure']) - $_REQUEST['loan_amount'];
        $success = "<span class='orange'>EMI will be: </span>".number_format($emi)."<span  class='orange ml20'>Total Interest Paid: </span>".number_format($total_interest)." <span class='orange ml20'>Flat Rate: </span>".$flat_rate."%";
        $prin_cf = "0";
        for($i=1;$i<=$loan_tenure;$i++){
            if($prin_cf == 0){
                $prin_bf = $loan_amount;
            }else{
                $prin_bf = $prin_cf;
            }
            $int_payable = round($cur_rate_emi*$prin_bf/1200);
            $principal_repaid = round($emi - $int_payable);
            $prin_cf = round($prin_bf - $principal_repaid);
            $array[$i] = array($prin_bf,$emi,$int_payable,$principal_repaid,$prin_cf);
        }
    }else{
        $success = "<span class='red'>All fields are mandatory!*</span>";
    }
}         

?>
<html>
<head>
    <title>Calculate EMI</title>
<link rel="stylesheet" type="text/css" href="../../include/style.css"> 
</head><body>
<div style="margin-left: 25px; margin-top: 25px;"><a href="/sugar/calculators/rate_comparison.php"><input type="button" class="buttonsub" value="Go To - Rate Comparison Calculator"></a></div>
<fieldset class='mall_30' style="height:100px;">
<legend>Calculate EMI</legend>
<form method="POST" action ="">
    <div class="f_16 center"><?php echo $success; ?></div>
    <div class="center">
    <span class='f_14 orange fw_bold'>Enter Loan Amount:</span>
    <input type="tel" name="loan_amount" id="loan_amount" placeholder="Enter Loan Amount" maxlength='10' value="<?php echo $loan_amount; ?>">
    <span class='f_14 ml10 orange fw_bold'>ROI:</span>
    <input type="tel" name="cur_rate_emi" id="cur_rate_emi" class="cur_rate_emi" placeholder="Rate of Interest" onkeydown="isNumberKey(event);" maxlength='5' value="<?php echo $cur_rate_emi; ?>">
    <span class='f_14 ml10 orange fw_bold'>Tennure (In Months):</span>
    <input type="tel" name="loan_tenure" id="loan_tenure" placeholder="Enter Tennure (In Months)" maxlength='3' value="<?php echo $loan_tenure; ?>">
    <input type="submit" class="buttonsub" value="Calculate EMI" name ="calculate"> 
    </div> 
</form>
</fieldset>
<?php if(!empty($array)){ ?>
<table class="gridtable ml50" width="90%">
    <tr><th>Months</th><th>Princ b/f</th><th>EMI</th><th>Intt payable</th><th>Principal repaid</th><th>Principal c/f</th></tr>
    <?php 
       foreach($array as $arr_key => $arr_val){
           echo "<tr><td>".$arr_key."</td>";
           foreach($arr_val as $val){
                echo "<td>".number_format($val)."</td>";
           }
           echo "</tr>";
       }
    ?>
</table>
<?php } ?>
<br><br>
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
</script>
<?php require_once "../../include/footer_close.php"; ?>
