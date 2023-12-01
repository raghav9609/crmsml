<?php
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../include/header.php');
require_once(dirname(__FILE__) . '/../include/helper.functions.php');
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../assets/css/style-assignment.css">
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
        ?>
        <input class="cursor" type='button' value='Search' name='search_btn' id="search_btn" onclick='search_as();'>
        <input class="cursor" type='button' value='Clear' name='clear_btn' onclick='clear_fnc();'>
        <input class="cursor" type="button" name="add" value="Add" id="add" onclick="add_info();">
    </fieldset>
</div>
<div id="loan"></div>
<?php
if (isset($_REQUEST["update"])) {
    $chech_id = replace_special($_REQUEST['ch_edit']);
    print_r($_REQUEST);
}
?>
</body>
</html>
<script src="<?php echo $head_url; ?>/assets/js/jquery-1.10.2.js"></script>
<script src="<?php echo $head_url; ?>/assets/js/jquery-ui.js"></script>
<script>
    function clear_fnc() {
        window.location.href = "<?php echo $head_url; ?>/assignment/";
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
        if(city_sub_grp == '') {
            alert("Please Select City Sub Group!");
        } else if (loan_type == '') {
            alert("Please Select Loan Type!");
        } else {
            $("#search_btn").attr('value', 'Searching...');
            $("#search_btn").attr("disabled", true);
            $.ajax({
                type: "POST",
                cache: false,
                url: "search_assign.php",
                data: "loan_type=" + loan_type + "&sml_user=" + user_mlc + "&city_sub_grp=" + city_sub_grp,
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
            url: "add-partner.php",
            success: function (html) {
                $("#loan").html(html);
            }
        })
    }
</script> 