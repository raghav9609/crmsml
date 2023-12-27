<?php
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../include/header.php');
require_once(dirname(__FILE__) . '/../config/config.php');
require_once "../include/helper.functions.php"; 
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
			<a href="form_index_app.php"><input type="button" class="buttonsub cursor" value="Back"></a>
			<h3>Add Application </h3>
			<form name="add_application" action="update.php" method="POST" autocomplete="OFF" enctype="multipart/form-data">
				<table class="table" id="maintable">
					<tbody>
						<tr>
							<!-- <th colspan="2" class="align-center">
							<input type="submit" class="cursor buttonsub" name="update" id="submit" value="Add">
								<a href="orm_index_app.php">
									<input class="cursor buttonsub" type="button" name="searchsubmit" value="List">
								</a>
							</th> -->
						</tr>
						
						<tr>
							<td>Bank Name:</td>
							<td>
                                <input type = "text" class="" name="bank_name" id="bank_name" required>
                            </td>
						</tr> 
						<tr>
							<td>Application Status</td>
							<td>
                            <select class="" name="application_status" id="application_status" required>
                                <?php echo get_dropdown('application_status', ''); ?>
                            </select>
                            </td>
						</tr> 						
						<tr>
							<td>Applied Amount:</td>
							<td>
                                <input type = "text" class="" name="applied_amount" id="applied_amount" required>
                            </td>
						</tr> 
                        <tr>
							<td>Login Date:</td>
							<td>
                                <input type = "text" class="" name="login_date" id="login_date" required>
                            </td>
						</tr> 
					</tbody>
				</table>
			</form>
		</div>
	</div>
</div>
    
</body>
</html>