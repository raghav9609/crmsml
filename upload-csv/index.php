<?php
$no_head=1;

require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../config/config.php');
require_once(dirname(__FILE__) . '/../include/constant.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../include/header.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Upload File</title>
	<link rel="stylesheet" href="<?php echo $head_url; ?>/assets/css/multiselect.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $head_url; ?>/assets/css/style.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $head_url; ?>/assets/css/jquery-ui.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $head_url; ?>/assets/css/cms.style.css" />
    <body>

	<div class="pl-md-3 pl-2 pr-md-3 pr-2 col-12">
    
    <div class="gen-box white-bg">
    <div class="blue-bg col-12 font-weight-nb pb-2 pt-2 white font-20 brdr-top-gray pe-none" data-toggle="step1" id="switch_step1">
			<!-- <h2><?php //if($message){echo "<span class='".$class."'>".$message ."</span>";} else { echo "";}?></h2> -->
		<!-- </div> -->
			<div class="color-bar-2 color-bg"></div>
			<h3 style = "background-color: #18375f;color:#ffffff;text-align:center;">Upload File</h3>
				<div class="boxview">
					<div class="tablebox">
						<div class="tablecolum">
							<label>Upload File:</label>
							<input type="file" name="upload_files" id="upload_files" accept=".csv" required/>
						</div>
						

						<div class="tablecolum text-center padding-fixbox trigger-varibale-new">	
								
							<input type="submit" class="cursor buttonsub" name="upload_sms" id="upload_sms" value="upload">		
							
							<input class="cursor buttonsub" type="button" onclick="resetform('<?php echo $head_url; ?>/upload-csv/')" value="Clear">
						
							<input type='button' name='download_format' value='Download Format' id='download_format' class='buttonsub ml10 cursor'  onclick="download_csv_format_sms_trigger()"/>
							<!-- <a href="trigger-variable.php"><input type="button" class="cursor buttonsub " name="Variables" id="Variable" value="variable"></a> -->
						</div>
					</div>							
				</div>
			<h3 id="heading" style="display: none;">List of Data</h3>
			<div class="addon" style="display: none;" id="csv_file_data"></div>
		</div>
	</div>
	</div>
	<?php include("../../include/footer.php");?>
	</body>
</html>
<?php include('../main-js-css-insert.php');?>	


<script>
function download_csv_format_sms_trigger() {
    var csv = 'Name,Email_id,Phone_no,Pincode,Loan_Amount,Dob,Net_Income' ;
    var hiddenElement = document.createElement('a');
    hiddenElement.href = 'data:text/csv;charset=utf-8,' + encodeURI(csv);
    hiddenElement.target = '_blank';
    hiddenElement.download = 'upload-sms-trigger.csv';
    hiddenElement.click();
}

function resetform(path){
    window.location.href = path;
}

</script>