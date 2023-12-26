<?php 
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
</head>
<body>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<a href="form_index_app.php"><input type="button" class="buttonsub cursor" value="Back"></a>
			<h3>Add APplication </h3>
			<form name="add_application" action="update.php" method="POST" autocomplete="OFF" enctype="multipart/form-data">
				<table class="table" id="maintable">
					<tbody>
						<tr>
							<th colspan="2" class="align-center">
							<input type="submit" class="cursor buttonsub" name="update" id="submit" value="Add">
								<a href="orm_index_app.php">
									<input class="cursor buttonsub" type="button" name="searchsubmit" value="List">
								</a>
							</th>
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
                                <input type = "text" class="" name="application_status" id="application_status" required>
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