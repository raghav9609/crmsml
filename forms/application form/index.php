<?php

require_once(dirname(__FILE__) . '/../../config/session.php');
require_once(dirname(__FILE__) . '/../../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../../include/header.php');
require_once(dirname(__FILE__) . '/../../include/helper.functions.php');

$filter_data = [];

$data_to_display = $db_handle->runQuery($formmodelExport->applicationdatafetch($id,$query_id));
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../assets/css/style-assignment.css">
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'></link>  
    <!-- <style>
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
    </style> -->

</head>
<body>
<!-- <div style="width:100%;"> -->
    <!-- <fieldset style='width:90%;margin-left:5%;'>
        <legend style='color:#2E2EAB;font-weight: bold;'>Search Filter</legend> -->
    <!-- <form>
        <?php echo get_dropdown(10, 'partner', '', '');
        echo get_dropdown('city', 'city', '', '');
        ?>
        <select name="agent_type" id = "agent_type">
            <option value="0">Select Agent Type</option>
            <option value="1">RM</option>
            <option value="2">SM</option>
        </select>
        <input type='text' name="sm_name" placeholder= "RM/ SM Name" maxlength="100">
        <input type='text' name="sm_email_id" placeholder= "RM/ SM Email ID" maxlength="100">
        <input type='text' name="phoneno" placeholder= "RM/ SM Phone No" maxlength="10">
        <input class="cursor" type='submit' value='Search' name='search_btn'>
        <a href="<?php echo $head_url; ?>/partner-details/"><input class="cursor" type='button' value='Clear'></a>
    </form> -->
        <!-- <input class="cursor" type="button" name="add" value="Add" id="add" onclick="add_info();"> -->
    <!-- </fieldset> -->
<!-- </div> -->
<div style="margin:0 auto; width:100%; padding:10px; background-color:#fff; height:800px;">
        <form action="" method="POST">
            <table class="gridtable" width="100%;">
                <tr>
                    <th colspan="17"><input type="submit" name="update" class="buttonsub ml10 cursor" value="Edit"/></th>
                </tr>
                <tr>
                    <th><input type="checkbox" name="selectAll[]" id="selectAll" onchange="selectallDisabled(this);">Select All</th>
                    <th>Bank Name</th>
                    <th>Application Status</th>
                    <th>Applied Amount</th>
                    <th>Login Date</th>
                    <th>Sanction Amount</th>
                    <th>Sanction Date</th>
                    <th>Disbursement Amount</th>
                    <th>Disbursement Date</th>
                    <th>Remarks By User</th>
                    <th>Remarks By Bank</th>
                    <th>Bank Application Number</th>
                    <th>Follow Up Date</th>
                    <th>Follow Up Time</th>
                    <th>Follow Up Given By</th>
                    <th>Tenure / ROI</th>
                </tr>
                <?php
                    foreach($data_to_display as $key=>$value){
                        $id = $value['id'];
                        $bank_name = $value['bank_id'];
                        $application_status = $value['application_status'];
                        $applied_amount = $value['applied_amount'];
                        $sanction_amount = $value['sanction_amount'];
                        $sanction_date = $value['sanction_date'];
                        $disbursed_amount = $value['disbursed_amount'];
                        $disburse_date = $value['disburse_date'];
                        $login_date = $value['login_date'];

                        $bank_application_no = $value['bank_application_no'];
                        $tennure = $value['tennure'];
                        $follow_up_date = $value['follow_up_date'];
                        $follow_up_time = $value['follow_up_time'];
                        $follow_up_given_by = $value['follow_up_given_by'];
                        $description_by_user = $value['description_by_user'];
                        $description_by_bank = $value['description_by_bank'];
                        
                        ?>
                <tr>
                <td><input type="checkbox" name="ch_edit[]" value="<?php echo $id; ?>" id="<?php echo $id; ?>" class ="all allchecked" onchange="disbaledFields(this);"/>
                </td>
                <!-- <td > -->
                <?php 
                // $partner_name  = get_name($partner_id,$partner_id);
                // $city_name  = get_name('city_id',$city_id); 
                // echo $partner_name['value']. "<br><span class='orange'>" .$city_name['city_name']."</span><br>"; 
                ?>
                <!-- </td> -->
                    <td>
                        <input name="bankname_<?php echo $id; ?>" value="<?php echo $bank_name; ?>" class="<?php echo $id; ?>_chng all" disabled="" type="text" maxlength="50"/>
                    </td>
                    <td>
                        <input name="application_status_<?php echo $id; ?>" value="<?php echo $application_status; ?>" class="<?php echo $id; ?>_chng all" disabled="" type="text" maxlength="10"/>
                    </td>
                    <td>
                        <input name="applied_amount_<?php echo $id; ?>" value="<?php echo $applied_amount; ?>" class="<?php echo $id; ?>_chng all" disabled="" type="text" maxlength="100"/>
                    </td>
                    <td>
                        <input name="sanction_amount_<?php echo $id; ?>" value="<?php echo $sanction_amount; ?>" class="<?php echo $id; ?>_chng all" disabled="" type="text" maxlength="100"/>
                    </td>
                    <td>
                        <input name="sanction_date_<?php echo $id; ?>" value="<?php echo $sanction_date; ?>" class="<?php echo $id; ?>_chng all" disabled="" type="text" maxlength="100"/>
                    </td>
                    <td>
                        <input name="disbursed_amount_<?php echo $id; ?>" value="<?php echo $disbursed_amount; ?>" class="<?php echo $id; ?>_chng all" disabled="" type="text" maxlength="100"/>
                    </td>
                    <td>
                        <input name="disburse_date_<?php echo $id; ?>" value="<?php echo $disburse_date; ?>" class="<?php echo $id; ?>_chng all" disabled="" type="text" maxlength="100"/>
                    </td>
                    <td>
                        <input name="login_date<?php echo $id; ?>" value="<?php echo $login_date; ?>" class="<?php echo $id; ?>_chng all" disabled="" type="text" maxlength="100"/>
                    </td>
                    <td>
                        <input name="bank_application_no_<?php echo $id; ?>" value="<?php echo $bank_application_no; ?>" class="<?php echo $id; ?>_chng all" disabled="" type="text" maxlength="100"/>
                    </td>
                    <td>
                        <input name="tennure<?php echo $id; ?>" value="<?php echo $tennure; ?>" class="<?php echo $id; ?>_chng all" disabled="" type="text" maxlength="100"/>
                    </td>
                    <td>
                        <input name="follow_up_date<?php echo $id; ?>" value="<?php echo $follow_up_date; ?>" class="<?php echo $id; ?>_chng all" disabled="" type="text" maxlength="100"/>
                    </td>
                    <td>
                        <input name="follow_up_time_<?php echo $id; ?>" value="<?php echo $follow_up_time; ?>" class="<?php echo $id; ?>_chng all" disabled="" type="text" maxlength="100"/>
                    </td>
                    <td>
                        <input name="follow_up_given_by_<?php echo $id; ?>" value="<?php echo $follow_up_given_by_; ?>" class="<?php echo $id; ?>_chng all" disabled="" type="text" maxlength="100"/>
                    </td>
                    <td>
                        <input name="description_by_user<?php echo $id; ?>" value="<?php echo $description_by_user; ?>" class="<?php echo $id; ?>_chng all" disabled="" type="text" maxlength="100"/>
                    </td>
                    <td>
                        <input name="description_by_bank<?php echo $id; ?>" value="<?php echo $description_by_bank; ?>" class="<?php echo $id; ?>_chng all" disabled="" type="text" maxlength="100"/>
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
        $name = $_REQUEST['name_'.$value];
        $mobile_no = $_REQUEST['mobile_no_'.$value];
        $sms_flag = $_REQUEST['sms_flag'.$value];
        $email_id = $_REQUEST['email_id_'.$value];
        $email_flag = $_REQUEST['email_flag'.$value];
        mysqli_query($Conn1,"update crm_partner_rm_sm_details set name ='".$name."',email_id ='".$email_id."',mobile_no ='".$mobile_no."',is_email_flag_active ='".$email_flag."',is_sms_flag_active ='".$sms_flag."' where id = '".$value."'");       
    } 
    ?>
    <script>
       swal("Data Updated Successfully!");
       window.location.href = "<?php echo $head_url; ?>/partner-details/";  
    </script>
<?php } ?>