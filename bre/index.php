<?php
require_once "../../include/crm-header.php";
require_once "../../include/con-config.php";
require_once "../../include/dropdown.php";
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../../include/style.css">
    <script type="text/javascript" src="../../include/js/jquery-1.10.2.js"></script> <!--Js For Testing-->
    <script type="text/javascript" src="../../include/js/common-function.js"></script>

    <script>
    function form_valid() {
        var max_val_err = "";
        var max_val_1000_err = "";
        
        $('.max_val').each(function(i, obj) {
            console.log($(this).val());
            if(parseInt($(this).val().replace(/,/g, '')) > 100) {
                max_val_err = 1;
            }
        });

        $('.max_val_1000').each(function(i, obj) {
            console.log($(this).val());
            if(parseInt($(this).val().replace(/,/g, '')) > 1000) {
                max_val_1000_err = 1;
            }
        });

        if(max_val_1000_err == 1) {
            alert("Offer values on CRM /MLC cannot be greater than 1000");
            return false;
        }
        
        if(max_val_err == 1) {
            alert("Approval values cannot be greater than 100");
            return false;
        }
    }
    </script>

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
<div style="width:90%; margin:auto;">
    <fieldset>
        <legend style='color:#2E2EAB;font-weight: bold;'>Search Filter</legend>
        <select name="loan_type" id="loan_type" onchange="fetch_partner_id();">
            <option value="">Select Loan Type</option>
            <option value="56" <?php echo ($_REQUEST['loan_type'] == 56) ? "selected" : ""; ?> >Personal Loan</option>
            <option value="51" <?php echo ($_REQUEST['loan_type'] == 51) ? "selected" : ""; ?> >Home Loan</option>
            <option value="54" <?php echo ($_REQUEST['loan_type'] == 54) ? "selected" : ""; ?> >Loan Against Property</option>
            <option value="60" <?php echo ($_REQUEST['loan_type'] == 60) ? "selected" : ""; ?> >Gold Loan</option>
            <option value="57" <?php echo ($_REQUEST['loan_type'] == 57) ? "selected" : ""; ?> >Business Loan</option>
            <option value="11" <?php echo ($_REQUEST['loan_type'] == 11) ? "selected" : ""; ?> >Doctor Loan</option>
            <option value="63" <?php echo ($_REQUEST['loan_type'] == 63) ? "selected" : ""; ?> >Professional Loan</option>
        </select>
        <?php
        //echo get_dropdown('loan_type', 'loan_type', $_REQUEST['loan_type'], 'onchange="fetch_partner_id();"');
        //echo get_dropdown('partner_list', 'partner_id', $_REQUEST['partner_id'], '');
        ?>
        <select name="partner_id" id="partner_id">
            <option value=''>Select Partner List</option>          
        </select>
        <input class="cursor" type='button' value='Search' name='search_btn' id="search_btn" onclick='search_as();'>
        <input class="cursor" type='button' value='Clear' name='clear_btn' onclick='clear_fnc();'>
    </fieldset>
</div>
<div id="loan"></div>
<?php
if (isset($_REQUEST["update"]) && !empty($_REQUEST['ch_edit'])) {
    $chech_id = replace_special($_REQUEST['ch_edit']);
    for ($i = 0; $i < count($chech_id); $i++) {
        $crm_offers_on = $_REQUEST['is_offers_crm_'.$chech_id[$i]];
        $website_offers_on = $_REQUEST['is_offers_website_'.$chech_id[$i]];
        $city_flag = $_REQUEST['city_flag_'.$chech_id[$i]];
        $cashback_strip = $_REQUEST['cashback_strip_'.$chech_id[$i]];
        $bank_id_select = $_REQUEST['bank_id_select_'.$chech_id[$i]];
        $loan_id_select = $_REQUEST['loan_id_select_'.$chech_id[$i]];
        mysqli_query($Conn1,"update bre_stp_decision set 
             is_offers_website = '".$website_offers_on."',
             is_offers_crm = '".$crm_offers_on."',
             is_cashback_strip  = '".$cashback_strip."',
             city_flag  = '".$city_flag."',
             is_stp = '".$_REQUEST['stp_'.$chech_id[$i]]."',
             min_score_for_offer_on_site= '".str_replace(',', '', $_REQUEST['min_score_for_offer_on_site_'.$chech_id[$i]])."',
             max_score_for_offer_on_site = '".str_replace(',', '',$_REQUEST['max_score_for_offer_on_site_'.$chech_id[$i]])."',
             min_score_for_offer_on_crm = '".str_replace(',', '',$_REQUEST['min_score_for_offer_on_crm_'.$chech_id[$i]])."',
             max_score_for_offer_on_crm = '".str_replace(',', '',$_REQUEST['max_score_for_offer_on_crm_'.$chech_id[$i]])."',
             score_slab1_from = '".str_replace(',', '',$_REQUEST['score_slab1_from_'.$chech_id[$i]])."',
             score_slab1_to= '".str_replace(',', '',$_REQUEST['score_slab1_to_'.$chech_id[$i]])."',
             score_slab2_from= '".str_replace(',', '',$_REQUEST['score_slab2_from_'.$chech_id[$i]])."',
             score_slab2_to= '".str_replace(',', '',$_REQUEST['score_slab2_to_'.$chech_id[$i]])."',
             score_slab3_from= '".str_replace(',', '',$_REQUEST['score_slab3_from_'.$chech_id[$i]])."',
             score_slab3_to= '".str_replace(',', '',$_REQUEST['score_slab3_to_'.$chech_id[$i]])."',
             approval_chance_slab1 = '".str_replace(',', '',$_REQUEST['approval_chance_slab1_'.$chech_id[$i]])."',
             approval_chance_slab1_to= '".str_replace(',', '',$_REQUEST['approval_chance_slab1_to_'.$chech_id[$i]])."',
             approval_chance_slab2= '".str_replace(',', '',$_REQUEST['approval_chance_slab2_'.$chech_id[$i]])."',
             approval_chance_slab2_to= '".str_replace(',', '',$_REQUEST['approval_chance_slab2_to_'.$chech_id[$i]])."',
             approval_chance_slab3= '".str_replace(',', '',$_REQUEST['approval_chance_slab3_'.$chech_id[$i]])."',
             approval_chance_slab3_to= '".str_replace(',', '',$_REQUEST['approval_chance_slab3_to_'.$chech_id[$i]])."'
            where id = ".$chech_id[$i]) or die(mysqli_error($Conn1));
            if($website_offers_on == 11){
                mysqli_query($mlc,"update tbl_pat_loan_type_mapping set is_cashback_strip='".$cashback_strip."',city_flag='".$city_flag."',disp_flag=0,mlc_disp=0,apply_flag=0 where loan_type= ".$loan_id_select." and bank_id = ".$bank_id_select);
                mysqli_query($Conn1,"update tbl_pat_loan_type_mapping set is_cashback_strip='".$cashback_strip."',city_flag='".$city_flag."',mlc_disp= 0,apply_flag=0 where loan_type= ".$loan_id_select." and bank_id = ".$bank_id_select);
            }else{
                mysqli_query($mlc,"update tbl_pat_loan_type_mapping set is_cashback_strip='".$cashback_strip."',city_flag='".$city_flag."',mlc_disp=1,apply_flag='".$website_offers_on."' where loan_type= ".$loan_id_select." and bank_id = ".$bank_id_select) or die("Error 1".mysqli_error($mlc));
                mysqli_query($Conn1,"update tbl_pat_loan_type_mapping set is_cashback_strip='".$cashback_strip."',city_flag='".$city_flag."',mlc_disp=1,apply_flag='".$website_offers_on."' where loan_type= ".$loan_id_select." and bank_id = ".$bank_id_select) or die("Error 2".mysqli_error($Conn1));
            }
            mysqli_query($Conn1,"update tbl_pat_loan_type_mapping set is_cashback_strip='".$cashback_strip."',city_flag='".$city_flag."',disp_flag=".$crm_offers_on." where loan_type= ".$loan_id_select." and bank_id = ".$bank_id_select);
    }
   header("location:index.php?loan_type=".$_REQUEST['search_loan_type']."&partner_id=".$_REQUEST['search_partner_id']);
}
mysqli_close($mlc);
include("../../include/footer_close.php");
?>
</body>
</html>
<script>
    function clear_fnc() {
        //window.location.href = "<?php echo $head_url; ?>/sugar/assign-mlc/";
        location.reload();
    }
      function fetch_partner_id() {
        var loan_type = $("#loan_type").val();
         if (loan_type == '') {
            alert("Please Select Loan Type!");
        } else {
            $("#search_btn").attr("disabled", true);
            $.ajax({
                type: "POST",
                cache: false,
                url: "../insert/get_partner.php",
                data: "loan_type_id=" + loan_type,
                success: function (html) {
                    $("#search_btn").attr('value', 'Search');
                    $("#search_btn").attr("disabled", false);
                    $("#partner_id").html(html).val(<?php echo $_REQUEST['partner_id']; ?>);
                }
            });
        }
    }
    function search_as() {
            var loan_type = $("#loan_type").val();
            var partner_id = $("#partner_id").val();
         if (loan_type == '') {
            alert("Please Select Loan Type!");
        } else {
            $("#search_btn").attr('value', 'Searching...');
            $("#search_btn").attr("disabled", true);
            $.ajax({
                type: "POST",
                cache: false,
                url: "search_assign.php",
                data: "loan_type=" + loan_type + "&partner_id=" + partner_id,
                success: function (html) {
                    $("#search_btn").attr('value', 'Search');
                    $("#search_btn").attr("disabled", false);
                    $("#loan").html(html);
                }
            });
        }
    }

    function download_csv(pat, loan) {
        console.log(pat + " > " + loan);
        $.ajax({
            type: "POST",
            cache: false,
            url: "download.php",
            data: "loan_type=" + loan + "&partner_id=" + pat,
            success: function (data) {
                
                var downloadLink = document.createElement("a");
                var fileData = ['\ufeff'+data];

                var blobObject = new Blob(fileData,{
                    type: "text/csv;charset=utf-8;"
                });

                var url = URL.createObjectURL(blobObject);
                downloadLink.href = url;
                downloadLink.download = "BRE_Data.csv";

                document.body.appendChild(downloadLink);
                downloadLink.click();
                document.body.removeChild(downloadLink);


            }
        });
    }
  
<?php if($_REQUEST['loan_type'] > 0 ){ ?>
    search_as();
<?php } ?>
</script> 