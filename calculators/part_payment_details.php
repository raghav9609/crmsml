<?php
require_once "../../include/check-session.php";
require_once "../../include/config.php";
require_once "../../include/dropdown.php";

$serial_number      = $_REQUEST['serial_number'];
$loan_amount        = $_REQUEST['loan_amount'];
$cur_rate_emi       = $_REQUEST['rate_of_interest'];
$loan_tenure        = $_REQUEST['loan_tenure'];
$part_payment_value = $_REQUEST['part_payment_val'];
$initial_int_paid   = $_REQUEST['initial_int_paid'];

$dynamic_values     = json_decode(stripslashes($_REQUEST['dynamic_values']));

$emi                = calculate_emi($loan_amount, $cur_rate_emi / 1200, $loan_tenure);
$array              = array();
$actual_emi         = $emi;

for($i = 1; $i <= $loan_tenure; $i++) {

    if($dynamic_values[$i] != "" && $dynamic_values[$i] != 0) {
        $emi += $dynamic_values[$i];
    } else {
        $emi = $actual_emi;
    }

    if($prin_cf == 0) {
        $prin_bf = $loan_amount;
    } else {
        $prin_bf = $prin_cf;
    }
    
    $int_payable        = round($cur_rate_emi*$prin_bf/1200);
    $principal_repaid   = round($emi - $int_payable);
    $prin_cf            = round($prin_bf - $principal_repaid);
    $array[$i]          = array($prin_bf,$emi,$int_payable,$principal_repaid,$prin_cf);
}

if(!empty($array)) {
?>

<?php
$main_output[] = '<table class="gridtable ml50" width="90%"><tr><th>Months</th><th>Princ b/f</th><th>EMI</th><th>Intt payable</th><th>Principal repaid</th><th>Principal c/f</th><th>P-P Amount</th></tr>';
?>
    <?php
        $actual_no_of_payments = 0;
        $total_interest_pay = 0;
        foreach($array as $arr_key => $arr_val) {
            $sr = 0;
            if($array[$arr_key][0] < 0) {
                $actual_no_of_payments = 1;
                break;
            }
            $main_output[] = "<tr><td>".$arr_key."</td>";
            foreach($arr_val as $val) {
                ++$sr;
                $input_type_hidden = "";
                if($sr == 1) {
                    $input_type_hidden = "<input type='hidden' id='princ_b_$arr_key' name='princ_b_$arr_key' class='princ_b_' value='".$val."'>";
                } else if($sr == 2) {
                    $input_type_hidden = "<input type='hidden' id='emi_$arr_key' name='emi_$arr_key' class='emi' value='".$val."'>";
                } else if($sr == 3) {
                    $total_interest_pay += $val;
                    $input_type_hidden = "<input type='hidden' id='intt_$arr_key' name='intt_$arr_key' class='intt' value='".$val."'>";
                } else if($sr == 4) {
                    $input_type_hidden = "<input type='hidden' id='princ_r_$arr_key' name='princ_r_$arr_key' class='princ_r' value='".$val."'>";
                } else if($sr == 5) {
                    $input_type_hidden = "<input type='hidden' id='princ_c_$arr_key' name='princ_c_$arr_key' class='princ_c' value='".$val."'>";
                }
                $main_output[] = "<td>".number_format($val)."".$input_type_hidden."</td>";
            }

            $part_pay_val = ($dynamic_values[$arr_key] != "" && $dynamic_values[$arr_key] != 0) ? $dynamic_values[$arr_key] : "";

            $main_output[] = "<td><input type='text' id='pp_amount_$arr_key' name='pp_amount_$arr_key' class='pp_amount' placeholder='Part Payment $arr_key' value='$part_pay_val'></td>";
            $main_output[] = "</tr>";
        }
    
        $main_output[] = "</table>";
        
        $total_savings = $initial_int_paid - $total_interest_pay;
        $summary_one[] = '<table class="gridtable ml50" width="90%"><tr><th colspan="6">LOAN SUMMARY</th></tr><tr><th>Scheduled payment</th><th>Scheduled number of payments</th><th>Actual number of payments</th><th>Total early payments</th><th>Total interest</th><th>Total Savings</th></tr><tr><td align="center">Rs. '.number_format($emi).'</td><td align="center">'.$loan_tenure.'</td><td>'.($arr_key - $actual_no_of_payments).'</td><td>Rs. '.array_sum($dynamic_values).'</td><td>Rs. '.number_format($total_interest_pay).'</td><td>Rs. '.$total_savings.'</td></tr></table><br><br>';

        echo implode($summary_one);
        echo implode($main_output);
    ?>
<?php
}
?>