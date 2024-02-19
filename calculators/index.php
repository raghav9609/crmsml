<?php
$dialog_pop_up_disabled_flag = 1;
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../include/header.php');
require_once(dirname(__FILE__) . '/../config/config.php');
?>
<?php
if($_REQUEST['calculate']) {
    $loan_amount    = replace_special($_REQUEST['loan_amount']);
    $cur_rate_emi   = replace_special($_REQUEST['cur_rate_emi']);
    $loan_tenure    = replace_special($_REQUEST['loan_tenure']);
        
    if($_REQUEST['loan_amount'] != '' && $_REQUEST['cur_rate_emi'] != '' && $_REQUEST['loan_tenure'] != '') {
        $emi = calculate_emi($loan_amount, $cur_rate_emi/1200, $loan_tenure);
        $flat_rate = calculate_flat_from_reduce($cur_rate_emi, $emi, $loan_tenure);
        $total_interest = ($emi * $_REQUEST['loan_tenure']) - $_REQUEST['loan_amount'];
        $success = "<span class='orange'>EMI will be: </span>".number_format($emi)."<span  class='orange ml20'>Total Interest Paid: </span>".number_format($total_interest)."<input type='hidden' id='initial_interest_paid' name='initial_interest_paid' value='$total_interest'> <span class='orange ml20'>Flat Rate: </span>".$flat_rate."%";
        $prin_cf = "0";
        for($i = 1; $i <= $loan_tenure; $i++) {
            if($prin_cf == 0){
                $prin_bf = $loan_amount;
            }else{
                $prin_bf = $prin_cf;
            }
            $int_payable        = round($cur_rate_emi*$prin_bf/1200);
            $principal_repaid   = round($emi - $int_payable);
            $prin_cf            = round($prin_bf - $principal_repaid);
            $array[$i]          = array($prin_bf,$emi,$int_payable,$principal_repaid,$prin_cf);
        }
    }else{
        $success = "<span class='red'>All fields are mandatory!*</span>";
    }
}         

?>
<html>
<head>
    <title>Calculate Part-Payment EMI</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $head_url; ?>/assets/css/style.css">
    <script type="text/javascript" src="<?php echo $head_url; ?>/assets/js/jquery-1.10.2.js"></script>
</head>
<body>
    <div style="margin-left: 25px; margin-top: 25px;"><a href="<?php echo $head_url; ?>/calculators/rate-comparison.php"><input type="button" class="buttonsub cursor" value="Go To - Rate Comparison Calculator"></a></div>
    <fieldset class='mall_30' style="height:100px;">
        <legend>Calculate Part-Payment EMI</legend>
        <form method="POST" action ="" autocomplete="off">
            <div class="f_16 center"><?php echo $success; ?></div>
            <div class="center">
                <span class='f_14 orange fw_bold'>Enter Loan Amount:</span>
                <input type="tel" name="loan_amount" id="loan_amount" placeholder="Enter Loan Amount" maxlength='10' value="<?php echo $loan_amount; ?>">
                <span class='f_14 ml10 orange fw_bold'>ROI:</span>
                <input type="tel" name="cur_rate_emi" id="cur_rate_emi" class="cur_rate_emi" placeholder="Rate of Interest" onkeydown="isNumberKey(event);" maxlength='5' value="<?php echo $cur_rate_emi; ?>">
                <span class='f_14 ml10 orange fw_bold'>Tennure (In Months):</span>
                <input type="tel" name="loan_tenure" id="loan_tenure" placeholder="Enter Tennure (In Months)" maxlength='3' value="<?php echo $loan_tenure; ?>">
                <input type="submit" class="buttonsub cursor" value="Calculate EMI" name ="calculate">
            </div> 
        </form>
    </fieldset>
<?php if(!empty($array)) { ?>
<div id="emi_details" style='text-align: center'>
    <table class="gridtable ml50" width="90%">
        <tr>
            <th colspan="5">LOAN SUMMARY</th>
        </tr>
        <tr>
            <th>Scheduled payment</th><th>Scheduled number of payments</th><th>Actual number of payments</th><th>Total early payments</th><th>Total interest</th>
        </tr>
        <tr>
            <td align="center"><?php echo "Rs. ".number_format($emi); ?></td><td align="center"><?php echo $loan_tenure; ?></td><td><?php echo $loan_tenure; ?></td><td><?php echo "0"; ?></td><td><?php echo "Rs. ".number_format($total_interest); ?></td>
        </tr>
    </table>
    <br>
    <br>
    <table class="gridtable ml50" width="90%">
        <tr><th>Months</th><th>Princ b/f</th><th>EMI</th><th>Intt payable</th><th>Principal repaid</th><th>Principal c/f</th><th>P-P Amount</th></tr>
        <?php

            foreach($array as $arr_key => $arr_val) {
                $sr = 0;
                echo "<tr><td>".$arr_key."</td>";
                foreach($arr_val as $val) {
                    ++$sr;
                    $input_type_hidden = "";
                    if($sr == 1) {
                        $input_type_hidden = "<input type='hidden' id='princ_b_$arr_key' name='princ_b_$arr_key' class='princ_b_' value='".$val."'>";
                    } else if($sr == 2) {
                        $input_type_hidden = "<input type='hidden' id='emi_$arr_key' name='emi_$arr_key' class='emi' value='".$val."'>";
                    } else if($sr == 3) {
                        $input_type_hidden = "<input type='hidden' id='intt_$arr_key' name='intt_$arr_key' class='intt' value='".$val."'>";
                    } else if($sr == 4) {
                        $input_type_hidden = "<input type='hidden' id='princ_r_$arr_key' name='princ_r_$arr_key' class='princ_r' value='".$val."'>";
                    } else if($sr == 5) {
                        $input_type_hidden = "<input type='hidden' id='princ_c_$arr_key' name='princ_c_$arr_key' class='princ_c' value='".$val."'>";
                    }
                    echo "<td>".number_format($val)."".$input_type_hidden."</td>";
                }
                echo "<td><input type='text' id='pp_amount_$arr_key' name='pp_amount_$arr_key' class='pp_amount' placeholder='Part Payment $arr_key'></td>";
                echo "</tr>";
            }
        ?>
    </table>
</div>
<?php } ?>
<br><br>
<script>
function get_flat_rates() {
    var r = $("#cur_rate_emi").val();
    var m = $("#loan_tenure").val();
    if(r == "") {
        alert("Rate Of Interest is required");
        return false;
    }
    if(m == "") {
        alert("Tenure is required");
        return false;
    }
    var n = m/12;
    $("#flatDiv").css("display", "block");
    $('#flatDiv').html("<span class='orange'>Flat Rate: </span>" + ((-(PMT(parseInt(r) / 1200, n * 12, 100, 0, 0.1) * n * 12) - 100) / n / 100 * 100).toFixed(2));
}
</script>
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
function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if((charCode >=48 && charCode<=57) || (charCode>=96 && charCode<=105)) {
        dots();
    } else if(charCode==37 ||charCode==39 || charCode==46 || charCode==8 || charCode==9) {

    } else {
        evt.preventDefault();
    }
}


$('#emi_details').on("blur", '.pp_amount', function() {

    var pp_amount_arr = [];
    $(".pp_amount").each(function() {
        var pp_id = $(this).attr('id');
        var s_str = "pp_amount_";
        var sr_no = pp_id.substring(pp_id.indexOf(s_str) + s_str.length);

        if($(this).val() != "" && $(this).val() != 0) {
            pp_amount_arr[sr_no] = $(this).val();
        }

    });

    var dynamic_values = JSON.stringify(pp_amount_arr);

    var part_payment_val    = $(this).val();
    var part_payment_id     = $(this).attr('id');
    var substring           = "pp_amount_";
    var serial_number       = part_payment_id.substring(part_payment_id.indexOf(substring) + substring.length);
    var loan_amount         = parseInt($("#loan_amount").val());
    var rate_of_interest    = $("#cur_rate_emi").val();
    var loan_tenure         = parseInt($("#loan_tenure").val());
    var initial_int_paid    = parseInt($("#initial_interest_paid").val());

    console.log(initial_int_paid);
    if(typeof pp_amount_arr != "undefined" && pp_amount_arr != null && pp_amount_arr.length != null && pp_amount_arr.length > 0) {
        $.ajax({
            type: "POST",
            url: "part_payment_details.php",
            data: "serial_number=" + serial_number + "&loan_amount=" + loan_amount + "&rate_of_interest=" + rate_of_interest + "&loan_tenure=" + loan_tenure + "&part_payment_val=" + part_payment_val + "&dynamic_values=" + dynamic_values + "&initial_int_paid=" + initial_int_paid,
            beforeSend: function () {
                $("#emi_details").html('<div class="img">Please wait while we are fetching the details...</div><div class="img"><img style="width: 10%" src="<?php echo $head_url;?>/include/img/common-loader.gif" /></div>');
            },
            success: function(msg) {
                $("#emi_details").html("").html(msg);
                
            }
        });
    }
});

$('.pp_amount').bind('keypress', function(evt) {
    if(evt.which > 31 && (evt.which < 48 || evt.which > 57)) {
        evt.preventDefault();
    }
});
</script>
