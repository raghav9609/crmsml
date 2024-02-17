
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Form</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link href="<?php echo $head_url; ?>/assets/css/grid-form.css?v=1.1" rel="stylesheet">
    
    <style>
    .fa-icon { 
        font-size: 18px;
    }
    .fa-mobile {
        font-size: 25px !important;
    }
    #form_step4 b.caret{
        margin-left:215px!important;
        display: inline;
    }
    #form_step4 .border-class{
        font-size: 14px;
        margin-left: 6px!important;
        border-bottom: 1px solid #ced4da!important;
        width: 100%!important;
        }
        #form_step4 .dropdown-menu {
        left: -150px;
        width: 241px;
    }
    .error-message {
        color: red;
    }
    .application_status {
        margin-bottom: 10px;
        position: relative;
    }

    .application_status label {
        display: block;
        font-weight: 300;
        margin-bottom: -2px;
        
    }

    .application_status select {
        width: 100%;
        padding: 9px;
        font-size: 12px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    .application_status label.required:after {
        content: ' *';
        color: red; /* Adjust the color as needed */
    }

    .fa-icon {
        /* Add your FontAwesome styling here */
        margin-right: 10px; /* Adjust as needed */
    }
    </style>
</head>

<body>
    
    <!-- <main>  -->
        
    <div class="pl-md-3 pl-2 pr-md-3 pr-2 col-12">
    
    <div class="gen-box white-bg">
    <div class="blue-bg col-12 font-weight-nb pb-2 pt-2 white font-20 brdr-top-gray pe-none" data-toggle="step1" id="switch_step1">
        <span id="text_step1"></span> Application Details<div id="error-message" class="error-message"></div></div> 
        
        <form action="update_app.php" class="form-step col-12" autocomplete="off" id="form_step1">
                      
            <div class="row div-width">
            
            
                <div class="form-group col-xl-2 col-lg-4 col-md-6">
                    <span class="fa-icon fa-building"></span>
                    
                    <input type="text" id="bank_name" name="bank_name" value="<?php echo ($get_bank_name['value']) ;?>" placeholder="Enter Bank Name" class="form-control alphaonly valid" maxlength="20" <?php echo ($get_bank_name['value'] != '') ? 'disabled' : 'disabled'; ?>  required >
                    <label for="name" class="label-tag"> Bank Name</label>
                </div> 
                
                
                <div class="form-group col-xl-2 col-lg-4 col-md-6" style="position: relative;">
                    <span class="fa-icon fa-building"></span>
                        <label for="application_status" class="label-tag" style="position: absolute; top: -15; left: 16; ">Application Status</label>
                        <?php echo get_dropdown('application_status','application_status',$application_status,'class="form-control valid"'); ?>
                    </div>
            
                <div class="form-group col-xl-2 col-lg-4 col-md-6">
                    <span class="fa-icon fa-building"></span>
                    <input type="text" id="applied_amount" name="applied_amount" value="<?php echo $applied_amount;?>" placeholder="Enter Applied Amount" class="form-control numonly valid" maxlength="20" required>
                    <label for="applied_amount" class="label-tag"> Applied Amount</label>
                </div>
                    <div class="form-group col-xl-2 col-lg-4 col-md-6">
                         <span class="fa-icon fa-building"></span>
                        <input type="text" class="text form-control valid datepicker" name="login_date" id="login_date" maxlength="10" value="<?php echo $login_date != '0000-00-00'? $login_date:'';?>" placeholder="yyyy-mm-dd"  onchange="datevalidate()" required>
                        <label for="dob" class="label-tag ">Login Date</label>
                    </div> 

                    <div class="form-group col-xl-2 col-lg-4 col-md-6">
                        <span class="fa-icon fa-building"></span>
                        <input type="text" id="sanction_amount" name="sanction_amount" value="<?php echo $sanction_amount;?>" placeholder="Enter Sanction Amount" class="form-control numonly valid"  maxlength="20" required>
                        <label for="name" class="label-tag"> Sanction Amount</label>
                    </div>
                    

                    <div class="form-group col-xl-2 col-lg-4 col-md-6">
                        <span class="fa-icon fa-building"></span>
                        <input type="text" class="text form-control valid datepicker" name="sanction_date" id="sanction_date" maxlength="10" value="<?php echo $sanction_date; ?>" placeholder="yyyy-mm-dd" required  onchange="datevalidate()">
                        <label for="sanction_date" class="label-tag ">Sanction Date</label>
                    </div> 

                    <div class="form-group col-xl-2 col-lg-4 col-md-6">
<span class="fa-icon fa-building"></span>                        <input type="text" id="disbursed_amount" name="disbursed_amount" value="<?php echo $disbursed_amount;?>" placeholder="Enter Disbursement Amount" class="form-control numonly valid" maxlength="20"  required>
                        <label for="disbursed_amount" class="label-tag"> Disbursement Amount</label>
                    </div>
                    <div class="form-group col-xl-2 col-lg-4 col-md-6">
                        <span class="fa-icon fa-building"></span> 
                        <input type="text" class="text form-control valid datepicker" name="disburse_date" id="disburse_date" maxlength="10" value="<?php echo $disburse_date; ?>" placeholder="yyyy-mm-dd" required  onchange="datevalidate()">
                        <label for="disburse_date" class="label-tag ">Disbursement Date</label>
                    </div> 

                    <div class="form-group col-xl-2 col-lg-4 col-md-6">
                        <span class="fa-icon fa-building"></span>
                        <input type="text" id="remarks_by_user" name="remarks_by_user" value="<?php echo $remarks_by_user;?>" placeholder="Enter Remarks By User" class="form-control alphaonly valid" maxlength="20"  required>
                        <label for="remarks_by_user" class="label-tag"> Remarks By User</label>
                    </div>
                    <div class="form-group col-xl-2 col-lg-4 col-md-6">
                        <span class="fa-icon fa-building"></span>
                        <input type="text" id="remarks_by_bank" name="remarks_by_bank" value="<?php echo $remarks_by_bank;?>" placeholder="Enter Remarks By Bank" class="form-control alphaonly valid" maxlength="20"  required>
                        <label for="remarks_by_bank" class="label-tag">Remarks By Bank</label>
                    </div>
                    
                    <div class="form-group col-xl-2 col-lg-4 col-md-6">
                        <span class="fa-icon fa-building"></span>
                        <input type="text" id="bank_application_no" name="bank_application_no" value="<?php echo $bank_application_no;?>" placeholder="Enter Bank Application Number" class="form-control numonly valid" maxlength="20" required>
                        <label for="bank_application_no" class="label-tag">Bank Application Number</label>
                    </div>
                    <div class="form-group col-xl-2 col-lg-4 col-md-6">
                        <span class="fa-icon fa-building"></span>
                        <input type="text" class="text form-control valid datepicker" name="follow_up_date" id="follow_up_date" maxlength="10" value="<?php echo $follow_up_date; ?>" placeholder="yyyy-mm-dd" required>
                        <label for="follow_up_date" class="label-tag ">Follow Up Date</label>
                    </div> 
                    <div class="form-group col-xl-2 col-lg-4 col-md-6">
                        <span class="fa-icon fa-building"></span>
                        <input type="text" class="text form-control valid" name="follow_up_time" id="follow_up_time" maxlength="10" value="<?php echo $follow_up_time; ?>" placeholder="H:i:s" required >
                        <label for="follow_up_time" class="label-tag ">Follow Up Time</label>
                    </div> 
                    <div class="form-group col-xl-2 col-lg-4 col-md-6" style="position: relative;">
                        <span class="fa-icon fa-building"></span>
                        <label for="follow_up_given_by" class="label-tag" style="position: absolute; top: -15; left: 16; ">Follow Up Given By</label>
                        <select class="form-control valid" id="follow_up_given_by" name="follow_up_given_by"  style="position: relative;">
                            <option value="0">Select</option>
                            <option value="1" <?php if ($follow_up_given_by == "1"){echo "selected";} ?>>SML User</option>
                            <option value="2" <?php if ($follow_up_given_by == "2"){echo "selected";} ?>>Customer</option>
                        </select>
                    </div>
                    <div class="form-group col-xl-2 col-lg-4 col-md-6">
                        <span class="fa-icon fa-building"></span>
                        <input type="text" id="tenure" name="tenure" value="<?php echo $tennure;?>" placeholder="Enter Tenure / EMI" class="form-control numonly valid"  maxlength="20" required>
                        <label for="name" class="label-tag">Tenure</label>
                    </div>
                    <div class="form-group col-xl-2 col-lg-4 col-md-6">
                        <span class="fa-icon fa-building"></span>
                        <input type="text" id="roi" name="roi" value="<?php echo $roi ;?>" placeholder="Enter Roi" class="form-control numonly valid"  maxlength="20" required>
                        <label for="name" class="label-tag">ROI</label>
                    </div>
                </div>
                <input type="hidden" id="crm_query_id" name="crm_query_id" value="<?php echo $qryyy_id; ?>">
                <input type="button" class="btn btn-primary valid" name="submit_app" id="submit_app" value="SUBMIT">

            

                       
<script>
    document.addEventListener('DOMContentLoaded', function () {
        $(document).ready(function () {
            $('.datepicker').datepicker({
                dateFormat: 'yy-mm-dd', 
                changeMonth: true,
                changeYear: true,
                yearRange: 'c-100:2050'
            });

            flatpickr('.flatpickr', {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                time_24hr: true,
                minuteIncrement: 15
            });
        });
    });
    
    document.addEventListener('DOMContentLoaded', function() {
    //amount 
    var appliedAmountInput = document.getElementById('applied_amount');
    var sanctionAmountInput = document.getElementById('sanction_amount');
    var disbursementInput = document.getElementById('disbursed_amount');
    var submit_app = document.getElementById('submit_app');

    var messageElement = document.createElement('span');
    messageElement.className = 'error-message';
    disbursementInput.parentNode.appendChild(messageElement);

    function validateDisbursement() {
        var appliedAmount = parseFloat(appliedAmountInput.value) || 0;
        var sanctionAmount = parseFloat(sanctionAmountInput.value) || 0;
        var disbursementAmount = parseFloat(disbursementInput.value) || 0;

        if (appliedAmount >= disbursementAmount || sanctionAmount >= disbursementAmount) {
            messageElement.textContent = ' Disbursement Amount should not be smaller than Applied Amount and Sanction Amount.';
            submit_app.setAttribute('disabled', 'disabled');
        } else {
            messageElement.textContent = '';
            submit_app.removeAttribute('disabled');
        }
    }

    appliedAmountInput.addEventListener('input', function() {
        validateDisbursement();
    });

    sanctionAmountInput.addEventListener('input', function() {
        validateDisbursement();
    });

    disbursementInput.addEventListener('input', function() {
        validateDisbursement();
    });


});

// document.addEventListener('DOMContentLoaded', function () {
function datevalidate() {
  var logindateInput = document.getElementById('login_date');
  var sanctiondateInput = document.getElementById('sanction_date');
  var disbursementInputdate = document.getElementById('disburse_date');
  var submit_app = document.getElementById('submit_app');
  var errormessageElement = document.getElementById('error-message');

  var login_date = new Date(logindateInput.value);
  var sanction_date = new Date(sanctiondateInput.value);
  var disburse_date = new Date(disbursementInputdate.value);

  login_date.setHours(0, 0, 0, 0);
  sanction_date.setHours(0, 0, 0, 0);
  disburse_date.setHours(0, 0, 0, 0);

  if (disburse_date < login_date || disburse_date < sanction_date) {
    errormessageElement.textContent = 'Disbursement Date should not be smaller than Login Date and Sanction Date.';
    submit_app.setAttribute('disabled', 'disabled');
  } else {
    errormessageElement.textContent = '';
    submit_app.removeAttribute('disabled');
  }
}

    
</script>
</form>



</div>
</div>

<?php 
$recordcount= 0;
 $qryd = "select * from crm_lead_summary_history where lead_id = '".$qryyy_id."' and type = 2 order by id desc"; 
$res = mysqli_query($Conn1,$qryd) or die("Error: ".mysqli_error($Conn1));
$recordcount = mysqli_num_rows($res);
?>

<div class="pl-md-3 pl-2 pr-md-3 pr-2 col-12">
    
    <div class="gen-box white-bg">
        <div class="blue-bg col-12 font-weight-nb pb-2 pt-2 white font-20 brdr-top-gray pe-none" data-toggle="step1" id="switch_step1">
            <span id="text_step1"></span>Follow Up History<div id="error-message" class="error-message"></div></div>
            <table class="gridtable" style="width:100%;" id="maintable">
                <tr>
                    <th>S No.</th>
                    <th>User</th>
                    <th>Remarks By User</th>
                    <th>Remarks By Bank</th>
                    <th>Follow Up Date Time</th>
                    <th>Created On</th>
                </tr>
                <?php 
                if($recordcount > 0) {
                    $record = 0;
                    while($exe = mysqli_fetch_array($res)) {
                        $record++;
                        
                        $user_id_get = $exe['user_id'];
                        $user_name_get = get_name('user_id', $user_id_get);
                        $user_name = $user_name_get['name'];
                        $description_bank = $exe['description_by_bank'];
                        $description_by_user = $exe['description_by_user'];
                        $follow_up_date_get = $exe['follow_up_date'];
                        if($follow_up_date_get == "" || $follow_up_date_get == '0000-00-00' || $follow_up_date_get == "1970-01-01"){
                            $follow_up_date = '';
                        }else{
                            $follow_up_date = date("d-m-Y", strtotime($follow_up_date_get));
                        }
                        
                        if($exe['follow_up_time'] == "" || $exe['follow_up_time'] == '00:00:00'){
                            $follow_up_time = '';
                        }else{
                            $follow_up_time = date("H:i a", strtotime($exe['follow_up_time']));
                        }
                        
                        $created_on = date("d-m-Y H:i a",strtotime($exe['created_on']));
                ?>
                <tr>
                    <td><?php echo $record; ?></td>
                    <td><?php echo $user_name; ?></td>
                    <td><?php echo $description_bank; ?></td>
                    <td><?php echo $description_by_user; ?></td>
                    <td><?php echo $follow_up_date." ".$follow_up_time; ?></td>
                    <td><?php echo $created_on; ?></td>
                </tr>
                <?php 
                    }
                } 
                ?>
            </table>

        <?php if ($recordcount > 0) { ?>

        <table width="width:90%;margin-left:4%;" border="0" align="center" cellpadding="4" cellspacing="1" class="pagination">
            <tr class="sidemain">
            <td>
                <?php if($page > 1) {
                    echo "<a class='page gradient' href='/crmsml/app/edit.php?page=".($page - 1)."&app_id=" . urlencode(base64_encode($qryyy_id)) . "&cust_id=" . urlencode(base64_encode($cust_id)) . "&loan_type=" . urlencode(base64_encode($loan_type)) . "'>Prev</a>";
                }
                echo "<a class='page gradient' href='javascript:void;'>".$page."</a>";
                if($recordcount > $display_count) {
                    echo "<a class='page gradient' href='/crmsml/app/edit.php?page=".($page + 1)."&app_id=" . urlencode(base64_encode($qryyy_id)) . "&cust_id=" . urlencode(base64_encode($cust_id)) . "&loan_type=" . urlencode(base64_encode($loan_type)) ."'>Next</a>";
                }
                ?>
            </td>
            </tr>
        </table>
        <?php } ?>	
    </div>
</div>
</body>
</html>
   



