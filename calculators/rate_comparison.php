<?php
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../include/header.php');
require_once(dirname(__FILE__) . '/../config/config.php');

if($_REQUEST['calculate']) {
    $loan_amount = replace_special($_REQUEST['loan_amount']);
    $cur_rate_emi = replace_special($_REQUEST['cur_rate_emi']);
    $cur_rate_emi_2 = replace_special($_REQUEST['cur_rate_emi_2']);
    $loan_tenure = replace_special($_REQUEST['loan_tenure']);
        
    if($_REQUEST['loan_amount'] != '' && $_REQUEST['cur_rate_emi'] != '' && $_REQUEST['loan_tenure'] != '') {
        $diff = 0;
        $total = 0;
        $emi = calculate_emi($loan_amount, $cur_rate_emi/1200, $loan_tenure);
        $emi_2 = calculate_emi($loan_amount, $cur_rate_emi_2/1200, $loan_tenure);
        $total_interest = ($emi * $_REQUEST['loan_tenure']) - $_REQUEST['loan_amount'];
        $total_interest_2 = ($emi_2 * $_REQUEST['loan_tenure']) - $_REQUEST['loan_amount'];
        $success = "<span>EMI for ".$cur_rate_emi."%  will be: </span><b>".custom_money_format($emi)."</b>";
        $success_2 = "<span>EMI for ".$cur_rate_emi_2."% will be: </span><b>".custom_money_format($emi_2)."</b>";
        if($emi > $emi_2) {
            $diff = $emi - $emi_2;
        } else if($emi_2 > $emi) {
            $diff = $emi_2 - $emi;
        }
        $additional_info = "<span>Difference in EMIs: </span><b>".custom_money_format($diff)."</b>";
        if($diff > 0) {
            $total = $diff * $loan_tenure;
        }
        $additional_info_2 = "<span>Total Difference in EMIS: </span><b>".custom_money_format($total)."</b>";

        $prin_cf = "0";
        for($i = 1; $i <= $loan_tenure; $i++) {
            if($prin_cf == 0){
                $prin_bf = $loan_amount;
            }else{
                $prin_bf = $prin_cf;
            }
            $int_payable = round($cur_rate_emi * $prin_bf / 1200);
            $int_payable_2 = round($cur_rate_emi_2 * $prin_bf / 1200);
            $principal_repaid = round($emi - $int_payable);
            $principal_repaid_2 = round($emi_2 - $int_payable_2);
            $prin_cf = round($prin_bf - $principal_repaid);
            $prin_cf_2 = round($prin_bf - $principal_repaid_2);
            $array[$i] = array($prin_bf,$emi,$int_payable,$principal_repaid,$prin_cf);
            $array_2[$i] = array($prin_bf, $emi_2, $int_payable_2, $principal_repaid_2, $prin_cf_2);
        }
    } else {
        $failed = "<span class='red'>Loan Amount, ROI 1 and Tenure fields are mandatory!*</span>";
    }
}         

?>
<html>
<head>
<title>Rate Comparison Calculator</title>
<link rel="stylesheet" type="text/css" href="../../include/style.css"> 
</head>
<body>
    <div style="margin-left: 25px; margin-top: 25px;"><a href="/sugar/calculators/"><input type="button" class="buttonsub cursor" value="Go To - Simple Calculator"></a></div>
    <fieldset class='mall_30' style="height: 100px;">
    <legend>Rate Comparison</legend>
        <form method="POST" action ="" autocomplete="off">
            <div class="f_16 center"><?php echo $failed; ?></div>
            <div class="center">
                <span class='f_14 orange fw_bold'>Enter Loan Amount:</span>
                <input type="tel" name="loan_amount" id="loan_amount" placeholder="Enter Loan Amount" maxlength='10' value="<?php echo $loan_amount; ?>">

                <span class='f_14 ml10 orange fw_bold'>ROI 1:</span>
                <input type="tel" name="cur_rate_emi" id="cur_rate_emi" class="cur_rate_emi" placeholder="Rate of Interest 1" onkeydown="isNumberKey(event, 1);" maxlength='5' value="<?php echo $cur_rate_emi; ?>">

                <span class='f_14 ml10 orange fw_bold'>ROI 2:</span>
                <input type="tel" name="cur_rate_emi_2" id="cur_rate_emi_2" class="cur_rate_emi_2" placeholder="Rate of Interest 2" onkeydown="isNumberKey(event, 2);" maxlength='5' value="<?php echo $cur_rate_emi_2; ?>">

                <span class='f_14 ml10 orange fw_bold'>Tennure (In Months):</span>
                <input type="tel" name="loan_tenure" id="loan_tenure" placeholder="Enter Tennure (In Months)" maxlength='3' value="<?php echo $loan_tenure; ?>">

                <input type="submit" class="buttonsub cursor" value="Calculate EMI" name ="calculate">
            </div> 
        </form>
    </fieldset>
    <!-- <center> -->
        <!-- <div> -->
            <?php //echo $success; ?>
        <!-- </div> -->
        <!-- <div> -->
            <?php //echo $success_2; ?>
        <!-- </div> -->
        <!-- <div> -->
            <?php //echo $additional_info; ?>
        <!-- </div> -->
        <!-- <div> -->
            <?php //echo $additional_info_2; ?>
        <!-- </div> -->
    <!-- </center><br> -->
    <?php if($cur_rate_emi != "" && $emi != "") { ?>
    <table class="gridtable ml50" width="90%">
        <tr>
            <th>EMI for <?php echo $cur_rate_emi; ?> %</th>
            <th>EMI for <?php echo $cur_rate_emi_2; ?> %</th>
            <th>Monthly Difference in EMIs</th>
            <th>Total Difference in EMIs in <?php echo ($loan_tenure != "" && is_numeric($loan_tenure) && $loan_tenure > 0) ? $loan_tenure : "--"; ?> months</th>
        </tr>
        <tr align="center">
            <td><?php echo custom_money_format($emi); ?></td>
            <td><?php echo  ($emi_2 != "" && is_numeric($emi_2) && $emi_2 > 0) ? custom_money_format($emi_2) : "--";  ?></td>
            <td><?php echo  ($diff != "" && is_numeric($diff) && $diff > 0) ? custom_money_format($diff) : "--";  ?></td>
            <td><?php echo  ($total != "" && is_numeric($total) && $total > 0) ? custom_money_format($total) : "--";  ?></td>
        </tr>
    </table>
    <?php } ?>
    <?php //if(!empty($array)) { ?>
    <!-- <table class="gridtable ml50" width="90%"> -->
        <!-- <tr> -->
            <!-- <th>Months</th> -->
            <!-- <th>Princ b/f</th> -->
            <!-- <th>EMI</th> -->
            <!-- <th>Intt payable</th> -->
            <!-- <th>Principal repaid</th> -->
            <!-- <th>Principal c/f</th> -->
        <!-- </tr> -->
        <?php
            //foreach($array as $arr_key => $arr_val) {
            //    echo "<tr><td>".$arr_key."</td>";
            //    foreach($arr_val as $val) {
            //        echo "<td>".number_format($val)."</td>";
            //   }
            //   echo "</tr>";
            //}
        ?>
    <!-- </table> -->
<?php //} ?>
<br><br>
</body>
</html>
<script>
function dots(identifier) {
    var dateBox = "";
    if(identifier == 1) {
        var dateBox = document.getElementsByClassName("cur_rate_emi")[0];
    } else {
        var dateBox = document.getElementsByClassName("cur_rate_emi_2")[0];
    }
    
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
function isNumberKey(evt, identifier) {
var charCode = (evt.which) ? evt.which : evt.keyCode;
if((charCode >= 48 && charCode <= 57) || (charCode >= 96 && charCode <= 105)) {
    dots(identifier);
  }
else if(charCode == 37 ||charCode == 39 || charCode == 46 || charCode == 8 || charCode == 9) {

}
else {
    evt.preventDefault();
    }
}
</script>
<?php require_once "../../include/footer_close.php"; ?>