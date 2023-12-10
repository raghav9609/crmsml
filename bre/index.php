<?php
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../include/header.php');
require_once(dirname(__FILE__) . '/../include/helper.functions.php');
require_once(dirname(__FILE__) . '/../model/breModel.php');

$filter_data = [];
if($_REQUEST['partner'] > 0){
    $filter_data['partner_id'] = $_REQUEST['partner']; 
}
$data_to_display = $db_handle->runQuery($breDetailsExport->searchFilter($filter_data));
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../assets/css/style-assignment.css">
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'></link>  
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
    <form>
        <?php echo get_dropdown(10, 'partner', '', '');
        ?>
        <input class="cursor" type='submit' value='Search' name='search_btn'>
        <a href="<?php echo $head_url; ?>/bre/"><input class="cursor" type='button' value='Clear'></a>
    </form>
        <!-- <input class="cursor" type="button" name="add" value="Add" id="add" onclick="add_info();"> -->
    </fieldset>
</div>
<div style="margin:0 auto; width:90%; padding:10px; background-color:#fff; height:800px;">
        <form action="" method="POST">
            <table class="gridtable" width="95%;">
                <tr>
                    <th colspan="12"><input type="submit" name="update" class="buttonsub ml10 cursor" value="Update"/></th>
                </tr>
                <tr>
                    <th><input type="checkbox" name="selectAll[]" id="selectAll" onchange="selectallDisabled(this);">Select All</th>
                    <th>Partner Name</th>
                    <th>Loan Amount</th>
                    <th>Net Income</th>
                    <th>Age</th>
                    <th>Credit Score</th>
                    <th>DPD</th>
                    <th>Enquiries</th>
                    <th>Overdue</th>
                    <th>Foir</th>
                    <th>Tennure</th>
                    <th>Status</th>                    
                </tr>
                <?php
                    foreach($data_to_display as $key=>$value){
                        $id = $value['id'];
                        $partner_id = $value['partner_id'];
                        $min_loan_amount = $value['min_loan_amount'];
                        $max_loan_amount = $value['max_loan_amount'];
                        $min_net_income = $value['min_net_income'];
                        $max_net_income = $value['max_net_income'];
                        $min_dpd = $value['min_dpd'];
                        $max_dpd = $value['max_dpd'];
                        $min_age = $value['min_age'];
                        $max_age = $value['max_age'];
                        $min_enquiries = $value['min_enquiries'];
                        $max_enquiries = $value['max_enquiries'];
                        $min_overdue = $value['min_overdue'];
                        $max_overdue = $value['max_overdue'];
                        $min_tennure = $value['min_tennure'];
                        $max_tennure = $value['max_tennure'];
                        $min_foir = $value['min_tennure'];
                        $max_foir = $value['max_tennure'];
                        $min_credit_score = $value['min_credit_score'];
                        $max_credit_score = $value['max_credit_score'];
                        $is_active = $value['is_active'];
                        ?>
                <tr>
                <td><input type="checkbox" name="ch_edit[]" value="<?php echo $id; ?>" id="<?php echo $id; ?>" class ="all allchecked" onchange="disbaledFields(this);"/>
                </td>
                <td >
                <?php $partner_name  = get_name($partner_id,$partner_id);
                echo $partner_name['value']; ?>
                </td>
                    <td>
                        <input name="min_loan_amount<?php echo $id; ?>" value="<?php echo $min_loan_amount; ?>" class="<?php echo $id; ?>_chng all" disabled="" type="text" maxlength="10"/>
                        <input name="max_loan_amount<?php echo $id; ?>" value="<?php echo $max_loan_amount; ?>" class="<?php echo $id; ?>_chng all" disabled="" type="text" maxlength="10"/>
                    </td>
                    <td>
                    <input name="min_net_income<?php echo $id; ?>" value="<?php echo $min_net_income; ?>" class="<?php echo $id; ?>_chng all" disabled="" type="text" maxlength="10"/>
                        <input name="max_net_income<?php echo $id; ?>" value="<?php echo $max_net_income; ?>" class="<?php echo $id; ?>_chng all" disabled="" type="text" maxlength="10"/>
                    </td>
                    <td>
                    <input name="min_age<?php echo $id; ?>" value="<?php echo $min_age; ?>" class="<?php echo $id; ?>_chng all" disabled="" type="text" maxlength="2"/>
                        <input name="max_age<?php echo $id; ?>" value="<?php echo $max_age; ?>" class="<?php echo $id; ?>_chng all" disabled="" type="text" maxlength="2"/>
                    </td>
                    <td>
                    <input name="min_credit_score<?php echo $id; ?>" value="<?php echo $min_credit_score; ?>" class="<?php echo $id; ?>_chng all" disabled="" type="text" maxlength="3"/>
                        <input name="max_credit_score<?php echo $id; ?>" value="<?php echo $max_credit_score; ?>" class="<?php echo $id; ?>_chng all" disabled="" type="text" maxlength="3"/>
                    </td>
                    <td>
                    <input name="min_dpd<?php echo $id; ?>" value="<?php echo $min_dpd; ?>" class="<?php echo $id; ?>_chng all" disabled="" type="text" maxlength="4"/>
                        <input name="max_dpd<?php echo $id; ?>" value="<?php echo $max_dpd; ?>" class="<?php echo $id; ?>_chng all" disabled="" type="text" maxlength="4"/>
                    </td>
                    <td>
                    <input name="min_enquiries<?php echo $id; ?>" value="<?php echo $min_enquiries; ?>" class="<?php echo $id; ?>_chng all" disabled="" type="text" maxlength="5"/>
                        <input name="max_enquiries<?php echo $id; ?>" value="<?php echo $max_enquiries; ?>" class="<?php echo $id; ?>_chng all" disabled="" type="text" maxlength="5"/>
                    </td>
                    <td>
                    <input name="min_overdue<?php echo $id; ?>" value="<?php echo $min_overdue; ?>" class="<?php echo $id; ?>_chng all" disabled="" type="text" maxlength="10"/>
                        <input name="max_overdue<?php echo $id; ?>" value="<?php echo $max_overdue; ?>" class="<?php echo $id; ?>_chng all" disabled="" type="text" maxlength="10"/>
                    </td>
                    <td>
                    <input name="min_foir<?php echo $id; ?>" value="<?php echo $min_foir; ?>" class="<?php echo $id; ?>_chng all" disabled="" type="text" maxlength="3"/>
                        <input name="max_foir<?php echo $id; ?>" value="<?php echo $max_foir; ?>" class="<?php echo $id; ?>_chng all" disabled="" type="text" maxlength="3"/>
                    </td>
                    <td>
                    <input name="min_tennure<?php echo $id; ?>" value="<?php echo $min_tennure; ?>" class="<?php echo $id; ?>_chng all" disabled="" type="text" maxlength="3"/>
                        <input name="max_tennure<?php echo $id; ?>" value="<?php echo $max_tennure; ?>" class="<?php echo $id; ?>_chng all" disabled="" type="text" maxlength="3"/>
                    </td>
                    <td>
                        <input type="checkbox" name="is_active<?php echo $id; ?>" <?php if($is_active == 1){echo "checked";} ?> value="1" class="<?php echo $id; ?>_chng all" disabled=""/>
                    </td>
                </tr>
                    <?php } ?>
            </table>
        </form>
    </div>
</body>
</html>
<script src="<?php echo $head_url; ?>/assets/js/jquery-1.10.2.js"></script>
<script src="<?php echo $head_url; ?>/assets/js/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>  
<script>
    function disbaledFields(e){
        if(e.checked){
            $("."+e.id+"_chng").removeAttr("disabled");
            
        }else{
            $("."+e.id+"_chng").attr('disabled', 'disabled');
            $("#selectAll").prop("checked",false);
        }
    }
    function selectallDisabled(e){
        if(e.checked){
            $(".all").removeAttr("disabled");
            $(".allchecked").prop("checked",true);
        }else{
            $(".all").attr('disabled', 'disabled');
            $(".allchecked").removeAttr('disabled').prop("checked",false);
        }
    }
</script>
<?php
if (isset($_REQUEST["update"])) {
    $chech_id = replace_special($_REQUEST['ch_edit']);
    foreach($chech_id as $key=>$value){
        $min_loan_amount = $_REQUEST['min_loan_amount'.$value];
        $max_loan_amount = $_REQUEST['max_loan_amount'.$value];
        $min_net_income = $_REQUEST['min_net_income'.$value];
        $max_net_income = $_REQUEST['max_net_income'.$value];
        $min_age = $_REQUEST['min_age'.$value];
        $max_age = $_REQUEST['max_age'.$value];
        $min_credit_score = $_REQUEST['min_credit_score'.$value];
        $max_credit_score = $_REQUEST['max_credit_score'.$value];
        $min_dpd = $_REQUEST['min_dpd'.$value];
        $max_dpd = $_REQUEST['max_dpd'.$value];
        $min_enquiries = $_REQUEST['min_enquiries'.$value];
        $max_enquiries = $_REQUEST['max_enquiries'.$value];
        $min_overdue = $_REQUEST['min_overdue'.$value];
        $max_overdue = $_REQUEST['max_overdue'.$value];
        $min_foir = $_REQUEST['min_foir'.$value];
        $max_foir = $_REQUEST['max_foir'.$value];
        $min_tennure = $_REQUEST['min_tennure'.$value];
        $max_tennure = $_REQUEST['max_tennure'.$value];
        $is_active = $_REQUEST['is_active'.$value];
       mysqli_query($Conn1,"update crm_offer_eligibilty set min_loan_amount ='".$min_loan_amount."',max_loan_amount ='".$max_loan_amount."',min_net_income ='".$min_net_income."',max_net_income ='".$max_net_income."',min_age ='".$min_age."',max_age ='".$max_age."',min_credit_score ='".$min_credit_score."',max_credit_score ='".$max_credit_score."',min_dpd ='".$min_dpd."',max_dpd ='".$max_dpd."',min_enquiries ='".$min_enquiries."',max_enquiries ='".$max_enquiries."',min_overdue ='".$min_overdue."',max_overdue ='".$max_overdue."',min_foir ='".$min_foir."',max_foir ='".$max_foir."',min_tennure ='".$min_tennure."',max_tennure ='".$max_tennure."',is_active ='".$is_active."' where id = '".$value."'");       
    } 
    ?>
    <script>
       swal("Data Updated Successfully!");
       window.location.href = "<?php echo $head_url; ?>/bre/";  
    </script>
<?php } ?>