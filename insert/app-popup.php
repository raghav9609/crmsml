<?php 
	require_once "../../include/check-session.php";
	require_once "../../include/config.php";
	require_once "../../include/dropdown.php";
	require_once "../../include/display-name-functions.php";
	$dialog = 1;
	$level_id = 3;
	$case_id = replace_special(urldecode(base64_decode($_REQUEST['case_id'])));
	$cust_id = replace_special(urldecode(base64_decode($_REQUEST['cust_id'])));
	$app_id_dia = replace_special(urldecode(base64_decode($_REQUEST['app_id'])));
	$loan_type = replace_special($_REQUEST['loan_type']);
	$m_app = replace_special($_REQUEST['m_app']);

	include('../app/hl-journey-new-status/index.php');
?>
<link href = "../../assets/css/jquery-ui.css" rel = "stylesheet">
    <script src = "../../assets/js/jquery-1.10.2.js"></script>
    <script src = "../../assets/js/jquery-ui.js"></script>
    <script type="text/javascript" src="../../assets/js/jquery.timeentry.js"></script>
    <script src="../../assets/js/jquery.timepicker.js"></script>
<link href="../../assets/css/jquery.timepicker.min.css" rel="stylesheet"/> 
<script src="../../assets/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="../../assets/js/format_amount.js"></script>
<link href="/crmsml/assets/css/grid-form.css?v=1.1" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<script src="../../assets/js/application-journey-new.js?v=5"></script>
<script src="../../assets/js/common-function.js"></script>    
<script>
	 $(".fol_time").timeEntry();
    $(".form-step select,.form-step input[type='text'],.form-step input[type='tel'],textarea").addClass("form-control");
</script>