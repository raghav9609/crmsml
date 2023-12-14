<?php
require_once "../../include/crm-header.php";
require_once "../../include/dropdown.php";
require_once "../../include/helper.functions.php";

if($_REQUEST['calculate']) {
    $prin   = replace_special($_REQUEST['prin']);
    $intr   = $_REQUEST['intr'];
    $peri   = replace_special($_REQUEST['peri']);
    $cifr   = replace_special($_REQUEST['cifr']);
    $sepe   = replace_special($_REQUEST['sepe']);
    //$email  = $_REQUEST['cifr'];

    if($peri <= 90 && $sepe == 365) {
        $cifr = 0;
    }
    $maturity_val = "";
    if ($cifr == 0) {
        $maturity_val = $prin * (1 + (($intr * $peri) / ($sepe * 100)));
    } else {
        $val1 = 1 + $intr / (100 * $cifr);
        $val2 = ($peri * $cifr / $sepe);
        $val3 = pow($val1, $val2);
        $maturity_val = ($prin * $val3);
    }

    $maturity_value = round($maturity_val, 2);
    $diff = $maturity_value - $prin;
    $new_num = custom_money_format($maturity_value);
    $new_diff = custom_money_format($diff);

    $p_type = "";
    $c_type = "";
    if($sepe == "365") {
        $p_type = "Days";
    } else if($sepe == "12") {
        $p_type = "Months";
    } else if($sepe == "1") {
        $p_type = "Years";
    }

    if($cifr == "0") {
        $c_type = "(Simple Interest)";
        $tie_val = $new_diff;
    } else if($cifr == "12") {
        $c_type = "(Monthly)";
        $tie_val = custom_money_format($diff / 12);
    } else if($cifr == "4") {
        $c_type = "(Quarterly)";
        $tie_val = custom_money_format($diff / 4);
    } else if($cifr == "2") {
        $c_type = "(Half Yearly)";
        $tie_val = custom_money_format($diff / 2);
    } else if($cifr == "1") {
        $c_type = "(Annually)";
        $tie_val = $new_diff;
    }

    $output = array();
    $output = array("da_value" => custom_money_format($prin), "roi_label" => $c_type, "pod_label" => $p_type, "roi_value" => $intr." %", "pod_value" => $peri, "tma" => $new_num, "tie" => $new_diff, "tie_val" => $tie_val);
}         

?>
<html>
<head>
<title>FD MATURITY CALCULATOR</title>
<link rel="stylesheet" type="text/css" href="../../include/style.css"> 
<style>
span.required::after {
    content: " *";
    color: red;
}
.pod_join_itt {
    height: unset !important;
    margin: 8px 0px 2px 2px !important;
}
.pod_join_its {
    margin: 9px 2px 2px -6px !important;
}
</style>
</head>
<body>
    <!-- <div style="margin-left: 25px; margin-top: 25px;"><a href="/sugar/calculators/"><input type="button" class="buttonsub" value="Go To - Simple Calculator"></a> <a href="/sugar/calculators/rate_comparison.php"><input type="button" class="buttonsub" value="Go To - Rate Comparison Calculator"></a></div> -->
    <fieldset class='mall_30' style="height: 100px;">
    <legend>FD Maturity Calculator</legend>
        <form method="POST" action ="" autocomplete="off">
            <div class="f_16 center"><?php echo $failed; ?></div>
            <div class="center">
                <span class='f_14 orange fw_bold required'>Deposit Amount:</span>
                <input type="tel" name="prin" id="prin" placeholder="xxxxxxxx" maxlength='10' value="<?php echo $prin; ?>" min="1000" maxlength="10" required>

                <span class='f_14 ml10 orange fw_bold required'>Rate of Interest (%):</span>
                <input type="tel" name="intr" id="intr" class="cur_rate_emi" placeholder="xx.xx" onkeydown="isNumberKey(event, 1);" maxlength='5' value="<?php echo $intr; ?>" required>

                <span class='f_14 ml10 orange fw_bold required'>Period of Deposit:</span>
                <input type="tel" name="peri" id="peri" class="cur_rate_emi_2 pod_join_itt" placeholder="xxx" value="<?php echo $peri; ?>" maxlength="3">
                <select name="sepe" id="sepe" class="pod_join_its">
                    <option value="365" <?php echo ($sepe == 365) ? "selected" : ""; ?> >Day(s)</option>
                    <option value="12"  <?php echo ($sepe == 12) ? "selected" : ""; ?> >Month(s)</option>
                    <option value="1"   <?php echo ($sepe == 1) ? "selected" : ""; ?> >Year(s)</option>
                </select>
                <br />
                <span class='f_14 ml10 orange fw_bold required'>Interest Compounding Frequency:</span>
                <select id="cifr" name="cifr" class="">
                    <option value="0" <?php echo ($cifr == 0) ? "selected" : ""; ?> >Simple Interest</option>
                    <option value="12" <?php echo ($cifr == 12) ? "selected" : ""; ?> >Monthly</option>
                    <option value="4" <?php echo ($cifr == 4 || $cifr == "") ? "selected" : ""; ?> >Quarterly</option>
                    <option value="2" <?php echo ($cifr == 2) ? "selected" : ""; ?> >Half Yearly</option>
                    <option value="1" <?php echo ($cifr == 1) ? "selected" : ""; ?> >Annually</option>
                </select>

                <!-- <span class='f_14 ml10 orange fw_bold'>Email ID:</span>
                <input type="tel" name="email" id="email" placeholder="Your Email ID" maxlength='3' value=""> -->

                <input type="submit" class="buttonsub" value="Calculate" name="calculate">
            </div> 
        </form>
    </fieldset>

    <?php
    if(!empty($output)) {
    ?>
    <table class="gridtable ml50" width="90%">
        <tr>
            <th colspan="2">Interest Earned <?php echo $output['roi_label']; ?> - <?php echo $output['tie_val']; ?> </th>
        </tr>
        <tr>
            <th>Total Maturity Amount - <?php echo $output['tma']; ?></th>
            <th>Total Interest Earned - <?php echo $output['tie']; ?></th>
        </tr>
        <tr>
            <td><b>Deposit Amount</b></td>
            <td><?php echo $output['da_value']; ?></td>
        </tr>
        <tr>
            <td><b>Rate of Interest</b></td>
            <td><?php echo $output['roi_value']; ?> <?php echo $output['roi_label']; ?></td>
        </tr>
        <tr>
            <td><b>Period of Deposit</b></td>
            <td><?php echo $output['pod_value']; ?> <?php echo $output['pod_label']; ?></td>
        </tr>
    </table>
    <?php
    }
    ?>
    
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

function chngeval() {
    console.log("chngeval");
}
</script>
<?php require_once "../../include/footer_close.php"; ?>