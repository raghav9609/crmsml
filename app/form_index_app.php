
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
                <div class="application_status col-xl-2 col-lg-4 col-md-6 main_acc ">
                    <span class="fa-icon fa-bank"></span>
                    <label for="name" class="label-tag required" >Application Status</label>
                    <?php echo get_dropdown('application_status','application_status',$application_status,'disabled'); ?>
                    
                </div>
<!-- 
                <div class="form-group col-xl-2 col-lg-4 col-md-6">
                    <span class="fa-icon fa-building"></span> -->
                    
                    <!-- <input type="text" id="application_status" name="application_status" value="<?php echo ($application_status_get['value']) ;?>" placeholder="Enter Application Status" class="form-control alphaonly valid"  <?php echo ($application_status_get['value'] != '') ? 'readonly' : ''; ?> maxlength="20" required> -->
                   
                    <!-- <label for="name" class="label-tag"> Application Status</label>
                </div> -->
                <div class="form-group col-xl-2 col-lg-4 col-md-6">
                    <span class="fa-icon fa-money"></span>
                    <input type="text" id="applied_amount" name="applied_amount" value="<?php echo $applied_amount;?>" placeholder="Enter Applied Amount" class="form-control numonly valid" maxlength="20" <?php echo ($applied_amount != '') ? 'readonly' : ''; ?> required>
                    <label for="applied_amount" class="label-tag"> Applied Amount</label>
                </div>
                    <div class="form-group col-xl-2 col-lg-4 col-md-6">
                        <input type="text" class="text form-control valid datepicker" name="login_date" id="login_date" maxlength="10" value="<?php echo $login_date != '0000-00-00'?$login_date:'';?>" placeholder="yyyy-mm-dd" <?php echo ($login_date != '') ? 'readonly' : ''; ?> onchange="datevalidate()" required>
                        <label for="dob" class="label-tag ">Login Date</label>
                        <span class='green' id='age' style="position: absolute;top: 100%;background: transparent;color: green;left: 15px;"></span>
                    </div> 

                    <div class="form-group col-xl-2 col-lg-4 col-md-6">
                        <span class="fa-icon fa-building"></span>
                        <input type="text" id="sanction_amount" name="sanction_amount" value="<?php echo $sanction_amount;?>" placeholder="Enter Sanction Amount" class="form-control numonly valid" <?php echo ($sanction_amount != '') ? 'readonly' : ''; ?> maxlength="20" required>
                        <label for="name" class="label-tag"> Sanction Amount</label>
                    </div>
                    

                    <div class="form-group col-xl-2 col-lg-4 col-md-6">
                        
                        <input type="text" class="text form-control valid datepicker" name="sanction_date" id="sanction_date" maxlength="10" value="<?php echo $sanction_date; ?>" placeholder="yyyy-mm-dd" required <?php echo ($sanction_date != '') ? 'readonly' : '';  ?> onchange="datevalidate()">
                        <label for="dob" class="label-tag ">Sanction Date</label>
                        <span class='green' id='age' style="position: absolute;top: 100%;background: transparent;color: green;left: 15px;"></span>
                    </div> 

                    <div class="form-group col-xl-2 col-lg-4 col-md-6">
                        <span class="fa-icon fa-money"></span>
                        <input type="text" id="disbursed_amount" name="disbursed_amount" value="<?php echo $disbursed_amount;?>" placeholder="Enter Disbursement Amount" class="form-control numonly valid" maxlength="20" <?php echo ($disbursed_amount != '') ? 'readonly' : ''; ?> required>
                        <label for="name" class="label-tag"> Disbursement Amount</label>
                    </div>
                    <div class="form-group col-xl-2 col-lg-4 col-md-6">
                        <input type="text" class="text form-control valid datepicker" name="disburse_date" id="disburse_date" maxlength="10" value="<?php echo $disburse_date; ?>" placeholder="yyyy-mm-dd" required <?php echo ($disburse_date != '') ? 'readonly' : '';  ?> onchange="datevalidate()">
                        <label for="dob" class="label-tag ">Disbursement Date</label>
                        <span class='green' id='age' style="position: absolute;top: 100%;background: transparent;color: green;left: 15px;"></span>
                    </div> 

                    <div class="form-group col-xl-2 col-lg-4 col-md-6">
                        <span class="fa-icon fa-building"></span>
                        <input type="text" id="remarks_by_user" name="remarks_by_user" value="<?php echo $remarks_by_user;?>" placeholder="Enter Remarks By User" class="form-control alphaonly valid" maxlength="20" <?php echo ($remarks_by_user != '') ? 'readonly' : ''; ?> required>
                        <label for="name" class="label-tag"> Remarks By User</label>
                    </div>
                    <div class="form-group col-xl-2 col-lg-4 col-md-6">
                        <span class="fa-icon fa-building"></span>
                        <input type="text" id="remarks_by_bank" name="remarks_by_bank" value="<?php echo $remarks_by_bank;?>" placeholder="Enter Remarks By Bank" class="form-control alphaonly valid" maxlength="20" <?php echo ($remarks_by_bank != '') ? 'readonly' : ''; ?> required>
                        <label for="name" class="label-tag">Remarks By Bank</label>
                    </div>
                    
                    <div class="form-group col-xl-2 col-lg-4 col-md-6">
                        <span class="fa-icon fa-building"></span>
                        <input type="text" id="bank_application_no" name="bank_application_no" value="<?php echo $bank_application_no;?>" placeholder="Enter Bank Application Number" class="form-control numonly valid" maxlength="20" <?php echo ($bank_application_no != '') ? 'readonly' : ''; ?> required>
                        <label for="name" class="label-tag">Bank Application Number</label>
                    </div>
                    <div class="form-group col-xl-2 col-lg-4 col-md-6">
                        <input type="text" class="text form-control valid datepicker" name="follow_up_date" id="follow_up_date" maxlength="10" value="<?php echo $follow_up_date; ?>" placeholder="yyyy-mm-dd" required <?php echo ($follow_up_date != '') ? 'readonly' : '';  ?>>
                        <label for="dob" class="label-tag ">Follow Up Date</label>
                        <span class='green' id='age' style="position: absolute;top: 100%;background: transparent;color: green;left: 15px;"></span>
                    </div> 
                    <div class="form-group col-xl-2 col-lg-4 col-md-6">
                        <input type="text" class="text form-control valid flatpickr" name="follow_up_time" id="follow_up_time" maxlength="10" value="<?php echo $follow_up_time; ?>" placeholder="yyyy-mm-dd" required <?php echo ($follow_up_time != '') ? 'readonly' : '';  ?>>
                        <label for="dob" class="label-tag ">Follow Up Time</label>
                        <span class='green' id='age' style="position: absolute;top: 100%;background: transparent;color: green;left: 15px;"></span>
                    </div> 
                    <div class="form-group col-xl-2 col-lg-4 col-md-6">
                        <input type="text" id="follow_up_given_by" name="follow_up_given_by" value="<?php echo $follow_up_given_by;?>" placeholder="Enter Follow Up Given By" class="form-control  valid" maxlength="20" <?php echo ($follow_up_given_by != '') ? 'readonly' : ''; ?> required>
                        <label for="dob" class="label-tag ">Follow Up Given BY</label>
                        <span class='green' id='age' style="position: absolute;top: 100%;background: transparent;color: green;left: 15px;"></span>
                    </div> 
                    <div class="form-group col-xl-2 col-lg-4 col-md-6">
                        <span class="fa-icon fa-building"></span>
                        <input type="text" id="tenure" name="tenure" value="<?php echo $tennure."/".$emi ;?>" placeholder="Enter Tenure / EMI" class="form-control numonly valid" <?php echo ($tennure != '' && $emi != '') ? 'readonly' : '';  ?> maxlength="20" required>
                        <label for="name" class="label-tag">Tenure/ROI</label>
                    </div>
                    <div class="app_u_assign application_status col-xl-2 col-lg-4 col-md-6 main_acc " >
                        <span class="fa-icon fa-bank"></span>
                        <label for="name" class="label-tag required" >User</label>
                        <?php echo get_dropdown('user','app_u_assign',$app_u_assign,'disabled'); ?>
                        
                    </div>
                </div>
                <input type="hidden" id="crm_query_id" name="crm_query_id" value="<?php echo $qryyy_id; ?>">
                <input type="hidden" id="case_id" name="case_id" value="<?php echo $case_id; ?>">
                <input type="hidden" id="" name="cust_id" value="<?php echo $cust_id; ?>">
                <input type="hidden" id="loan_type" name="loan_type" value="<?php echo $loan_type; ?>">
                <input type="button" class="btn btn-primary valid" name="edit_app" id="edit_app" value="Edit">
                <input type="button" class="btn btn-primary valid" name="submit_app" id="submit_app" value="SUBMIT">
                <!-- <input type="button" class="btn btn-primary valid" name="add_app" id="add_app" value="Add"> -->
                       
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('submit_app').style.display = 'none';

        document.getElementById('edit_app').addEventListener('click', function () {
            enableEditing();
        });

        document.getElementById('submit_app').addEventListener('click', function () {
            document.getElementById('form_step1').submit();
        });

        function enableEditing() {
            var fields = document.querySelectorAll('.form-control[readonly]');
            fields.forEach(function (field) {
                field.removeAttribute('readonly');
            });
            var applicationStatusField = document.getElementById('application_status');
            if (applicationStatusField) {
                applicationStatusField.removeAttribute('disabled');
            }
            var user_idField = document.getElementById('app_u_assign');
            if (user_idField) {
                user_idField.removeAttribute('disabled');
            }
            document.getElementById('submit_app').style.display = 'block';
            document.getElementById('edit_app').style.display = 'none';
        }

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
    document.getElementById('add_app').addEventListener('click', function() {
        // Create a form element
        var form = document.createElement('form');
        form.action = 'add_app.php'; 
        form.method = 'post'; 

        var crmQueryIdInput = document.createElement('input');
        crmQueryIdInput.type = 'hidden';
        crmQueryIdInput.name = 'crm_query_id';
        crmQueryIdInput.value = '<?php echo $qryyy_id; ?>';
        form.appendChild(crmQueryIdInput);

        var caseIdInput = document.createElement('input');
        caseIdInput.type = 'hidden';
        caseIdInput.name = 'case_id';
        caseIdInput.value = '<?php echo $case_id; ?>';
        form.appendChild(caseIdInput);

        var custIdInput = document.createElement('input');
        custIdInput.type = 'hidden';
        custIdInput.name = 'cust_id';
        custIdInput.value = '<?php echo $cust_id; ?>';
        form.appendChild(custIdInput);

        var loanTypeInput = document.createElement('input');
        loanTypeInput.type = 'hidden';
        loanTypeInput.name = 'loan_type';
        loanTypeInput.value = '<?php echo $loan_type; ?>';
        form.appendChild(loanTypeInput);

        document.body.appendChild(form);
        form.submit();
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


});//////

// document.addEventListener('DOMContentLoaded', function () {
function datevalidate() {
  var logindateInput = document.getElementById('login_date');
  var sanctiondateInput = document.getElementById('sanction_date');
  var disbursementInputdate = document.getElementById('disburse_date');
  var submit_app = document.getElementById('submit_app');
  var errormessageElement = document.getElementById('error-message');

  // Validate Disbursement Date
  var login_date = new Date(logindateInput.value);
  var sanction_date = new Date(sanctiondateInput.value);
  var disburse_date = new Date(disbursementInputdate.value);
// alert(login_date)
  // Set hours, minutes, seconds, and milliseconds to 0 for date-only comparison
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


</body>
</html>
   



