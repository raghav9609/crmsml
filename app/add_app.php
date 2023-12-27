<?php
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../include/header.php');
require_once(dirname(__FILE__) . '/../config/config.php');
require_once "../include/helper.functions.php"; 

echo $_REQUEST['qryyy_id'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Application</title>
    <link rel="stylesheet" href="<?php echo $head_url; ?>/assets/css/multiselect.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $head_url; ?>/assets/css/style.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $head_url; ?>/assets/css/jquery-ui.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
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
    </style>
</head>
<body>
<div class="pl-md-3 pl-2 pr-md-3 pr-2 col-12">
    
    <div class="gen-box white-bg">
    <div class="blue-bg col-12 font-weight-nb pb-2 pt-2 white font-20 brdr-top-gray pe-none" data-toggle="step1" id="switch_step1">
			<!-- <a href="form_index_app.php"><input type="button" class="buttonsub cursor" value="Back"></a> -->
			<h2 style = "background-color: #18375f;color:#ffffff;text-align:center;">Add Application </h2>
			<form name="add_application" action="update_app.php" method="POST" autocomplete="OFF" enctype="multipart/form-data">
            <input type="submit" class="btn btn-primary valid" name="submit_add" id="submit_add" value="Add">
				<table class="gridtable" style="margin-left:2%;width:80%;"aid="maintable">
					<tbody>
						<tr>
							<td>Bank Name:</td>
							<td>
                            <div class="form-group col-xl-2 col-lg-4 col-md-6 main_acc">
                                    <span class="fa-icon fa-bank"></span>
                                    <?php echo get_dropdown('2','bank_name'); ?>
                                </div>
                            </td>
						</tr> 
						<tr>
							<td>Application Status</td>
							<td>
                            <div class="dropdown-container">
                                <span class="fa-icon fa-bank"></span>
                                <?php echo get_dropdown('application_status', 'application_status'); ?>
                            </div>
                            </td>
						</tr> 						
						<tr>
							<td>Applied Amount:</td>
							<td>
                                <input type = "text" class="" name="applied_amount" id="applied_amount" oninput="validateNumberInput(this)" required>
                            </td>
						</tr> 
                        <tr>
							<td>Login Date:</td>
							<td>
                                <input type = "text" class="datepicker" name="login_date" id="login_date" required>
                            </td>
						</tr> 
                        <tr>
							<td>Sanction Amount:</td>
							<td>
                                <input type = "text" class="" name="sanction_amount" id="sanction_amount" oninput="validateNumberInput(this)" required>
                            </td>
						</tr> 
                        <tr>
							<td>Sanction Date:</td>
							<td>
                                <input type = "text" class="datepicker" name="sanction_date" id="sanction_date" required>
                            </td>
						</tr> 
                        <tr>
							<td>Disbursement Amount:</td>
							<td>
                                <input type = "text" class="" name="disbursement_amount" id="disbursement_amount" oninput="validateNumberInput(this)" required>
                            </td>
						</tr> 
                        <tr>
							<td>Disbursement Date:</td>
							<td>
                                <input type = "text" class="datepicker" name="disbursement_date" id="disbursement_date" required>
                            </td>
						</tr> 
                        <tr>
							<td>Remarks By User:</td>
							<td>
                                <input type = "text" class="" name="description_by_user" id="description_by_user" required>
                            </td>
						</tr> 
                        <tr>
							<td>Remarks By Bank:</td>
							<td>
                                <input type = "text" class="" name="description_by_bank" id="description_by_bank" required>
                            </td>
						</tr> 
                        <tr>
							<td>Bank Application Number:</td>
							<td>
                                <input type = "text" class="" name="bank_application_no" id="bank_application_no" required>
                            </td>
						</tr> 
                        <tr>
							<td>Follow Up Date:</td>
							<td>
                                <input type = "text" class="datepicker" name="follow_up_date" id="follow_up_date" required>
                            </td>
						</tr> 
                        <tr>
							<td>Follow Up Time:</td>
							<td>
                                <input type = "text" class="flatpickr" name="follow_up_time" id="follow_up_time" required>
                            </td>
						</tr> 
                        <tr>
							<td>Follow Up Given By:</td>
							<td>
                                <input type = "text" class="" name="follow_up_given_by" id="follow_up_given_by" required>
                            </td>
						</tr> 
                        <tr>
							<td>Tenure:</td>
							<td>
                                <input type = "text" class="" name="tenure" id="tenure" oninput="validateNumberInput(this)" required>
                            </td>
						</tr> 

                        <tr>
                            <td>ROI:</td>
							<td>
                                <input type = "text" class="" name="roi" id="roi" oninput="validateNumberInput(this)" required>
                            </td>
                        </tr>

                        <input type = "hidden" class="" name="login_date" id="login_date" required>
                        
					</tbody>
				</table>
			</form>
		</div>
	</div>
</div>
<script>
        function validateNumberInput(input) {
            input.value = input.value.replace(/[^0-9]/g, '');
        }

        $(document).ready(function () {
            $('.datepicker').datepicker({
                dateFormat: 'yy-mm-dd',
                changeMonth: true,
                changeYear: true,
                yearRange: 'c-100:2050',
                // maxDate: '0' // Restrict to today and the past
            });
        });
        $(document).ready(function () {
            flatpickr('.flatpickr', {
                    enableTime: true,
                    noCalendar: true,
                    dateFormat: "H:i",
                    time_24hr: true,
                    minuteIncrement: 15
                });
        });
    </script>
    
</body>
</html>