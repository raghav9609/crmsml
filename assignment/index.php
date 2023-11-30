<?php
session_start();
print_r($_SESSION);
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../include/header.php');
require_once(dirname(__FILE__) . '/../include/helper.functions.php');
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../include/style.css">
    <style>
        .new_textbox {
            background: #E6E6E6 none repeat scroll 0% 0%;
            color: #000;
        }

        .onoffswitch-inner:before {
            content: "Ist" !important;
        }

        .onoffswitch-inner:after {
            content: "IInd" !important;
        }
    </style>

</head>
<body>
<div style="width:100%;">
    <fieldset style='width:90%;margin-left:5%;'>
        <legend style='color:#2E2EAB;font-weight: bold;'>Search Filter</legend>
        <?php echo get_dropdown('crm_master_city_sub_group', 'city_sub_grp', '', '');
        echo get_dropdown(1, 'loan_type', '', 'onchange="user_tab()"');
        echo get_dropdown('user', 'u_assign', '', '');
        //echo get_dropdown('employer_type','employer_type','','');
        ?>
         <select name="crasssell" id="crasssell"><option value="">Select Cross sell </option><option value="1">Yes</option><option value="0">No</option></select>
        <input class="cursor" type='button' value='Search' name='search_btn' id="search_btn" onclick='search_as();'>
        <input class="cursor" type='button' value='Clear' name='clear_btn' onclick='clear_fnc();'>
        <input class="cursor" type="button" name="add" value="Add" id="add" onclick="add_info();">
        <?php if ($user_role == 1 || $user_role == 4) { ?>
            <div class="onoffswitch" id='btn_text' style='float: right;margin: 10px 10% 0 0;'>
            <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox onoff" id="myonoffswitch"
                   onchange="halt()" onclick="halt()" <?php if ($result_halt['shift_id'] == 1) { ?> checked <?php } ?>
                   value="<?php echo $result_halt['shift_id'] ?>">
            <label class="onoffswitch-label" for="myonoffswitch">
                <span class="onoffswitch-inner"></span>
                <span class="onoffswitch-switch"></span>
            </label>
            </div><?php } ?>
    </fieldset>
</div>
<div id="loan"></div>
<?php
if (isset($_REQUEST["update"])) {
    $chech_id = replace_special($_REQUEST['ch_edit']);
    for ($i = 0; $i < count($chech_id); $i++) {
        $sal_ra = "salary_" . $chech_id[$i];
        $loan_ra = "loan_amt_" . $chech_id[$i];
        $user_id_prime = "user_id_" . $chech_id[$i];
        $user_id_second = "user_id1_" . $chech_id[$i];
        $flag_ac = "active_" . $chech_id[$i];
        $occupation = "occupation_" . $chech_id[$i];
        $hdfc = "hdfc_" . $chech_id[$i];
//$employer_type = "employer_type_".$chech_id[$i];

        $occupation_val = replace_special($_REQUEST[$occupation]);
        $sal_range = replace_special($_REQUEST[$sal_ra]);
        $loan_range_up = replace_special($_REQUEST[$loan_ra]);
//$employer = replace_special($_REQUEST[$employer_type]);
        $user_prime = $_REQUEST[$user_id_prime];
        $user_second = $_REQUEST[$user_id_second];
        $active_flag_up = replace_special($_REQUEST[$flag_ac]);
        $hdfc_auto = replace_special($_REQUEST[$hdfc]);

        $hdfc_cat_flag_up = implode(",", $_REQUEST["hdfc_cat_" . $chech_id[$i]]);
        $salary_range_up = explode("-", $sal_range);
        $loan_range_up = explode("-", $loan_range_up);
        $city_sub_grp_id = replace_special($_REQUEST[$city_id]);
        $loan_type_id = replace_special($_REQUEST[$loan_id]);
        $loan_id = replace_special($_REQUEST['loan_id']);
        $annutal_itr = "";
        if($loan_id == 56 && $hdfc_cat_flag_up == ''){
            $annutal_itr = "company_cat =0,";
        }else if ($loan_id == 57) {
            $itr_range = "itr_amt_" . $chech_id[$i];
            $itr_up = replace_special($_REQUEST[$itr_range]);
            $itr_up = explode("-", $itr_up);
            $annutal_itr = "min_itr_amt = '" . $itr_up[0] . "' , max_itr_amt = '" . $itr_up[1] . "',";
        }else if($loan_id == 56){
            $annutal_itr = "company_cat = '" . $hdfc_cat_flag_up. "' ,";
        }else if(in_array($loan_id,array(51,52,54))){
            $annutal_itr = "hdfc_auto_push='" . $hdfc_auto . "',";
        }

        foreach ($user_prime as $data_prime) {

            $user_id = explode(',', $data_prime);
            $user_p = $user_id[0];
            $assign_p = $user_id[1];
            $query_p = "update tbl_assign_user_query_filter set user_id = '" . $user_p . "' where assign_id =  '" . $assign_p . "'";
            $data_pri = mysqli_query($Conn1, $query_p);
        }

        foreach ($user_second as $data_second) {

            $user_id = explode(',', $data_second);
            $user_s = $user_id[0];
            $assign_s = $user_id[1];
            $query_s = "update tbl_assign_user_query_filter set user_id = '" . $user_s . "' where assign_id =  '" . $assign_s . "'";
            $data_second = mysqli_query($Conn1, $query_s);

            $query_s_history = mysqli_query($Conn1,"insert into tbl_assign_user_query_filter_history set user_id = '" . $user_s . "',assign_id =  '" . $assign_s . "',updated_by_user='".$user."',date=NOW()");
        }


        $query = "update crm_lead_assignment SET min_loan_amt = '" . $loan_range_up[0] . "', max_loan_amt= '" . $loan_range_up[1] . "', min_net_income = '" . $salary_range_up[0] . "', max_net_income = '" . $salary_range_up[1] . "' WHERE id = '" . $chech_id[$i] . "'";
        $update_auto_query = mysqli_query($Conn1, $query);

    }
}
mysqli_close($mlc);
include("../../include/footer_close.php");
?>
</body>
</html>
<script>
    function clear_fnc() {
        window.location.href = "<?php echo $head_url; ?>/sugar/assign-mlc/";
    }

    $(document).ready(function () {
        $("#add_data").click(function () {
            $("#abc").toggle();
        });
    });

    function search_as() {
        var loan_type = $("#loan_type").val();
        var city_sub_grp = $("#city_sub_grp").val();
        var user_mlc = $("#u_assign").val();
        var crasssell = $("#crasssell").val();
        if(city_sub_grp == '') {
            alert("Please Select City Sub Group!");
        } else if (loan_type == '') {
            alert("Please Select Loan Type!");
        } else if (loan_type == '56' && $("#employer_type").val() == '') {
            alert("Please Select Employer Type");
        } else {
            $("#search_btn").attr('value', 'Searching...');
            $("#search_btn").attr("disabled", true);
            $.ajax({
                type: "POST",
                cache: false,
                url: "search_assign.php",
                data: "loan_type=" + loan_type + "&mlc_user=" + user_mlc + "&city_sub_grp=" + city_sub_grp + "&employer_type=" + $("#employer_type").val()+"&crasssell="+ crasssell,
                success: function (html) {
                    $("#search_btn").attr('value', 'Search');
                    $("#search_btn").attr("disabled", false);
                    $("#loan").html(html);
                }
            });
        }
    }

    function halt() {
        var onoff = $("#myonoffswitch").val();
        $.ajax({
            type: "POST",
            cache: false,
            url: "halt.php",
            data: "on=" + onoff,
            success: function (html) {
                location.reload();
            }
        });
    }

    function add_info() {
        $("#msg").text("");
        $("#add").addClass("hidden");
        $.ajax({
            type: "POST",
            url: "add_partner.php",
            success: function (html) {
                $("#loan").html(html);
            }
        })
    }
</script> 