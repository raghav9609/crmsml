<?php
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../include/header.php');
require_once(dirname(__FILE__) . '/../include/helper.functions.php');
require_once(dirname(__FILE__) . '/../model/partnerDetailsModel.php');

$filter_data = [];
if($_REQUEST['partner'] > 0){
    $filter_data['partner_id'] = $_REQUEST['partner']; 
}
if($_REQUEST['city'] > 0){
    $filter_data['partner_id'] = $_REQUEST['city']; 
}
if($_REQUEST['agent_type'] > 0){
    $filter_data['partner_id'] = $_REQUEST['agent_type']; 
}
if($_REQUEST['sm_name']!= ""){
    $filter_data['sm_name'] = $_REQUEST['sm_name']; 
}
if($_REQUEST['sm_email_id'] !=""){
    $filter_data['sm_email_id'] = $_REQUEST['sm_email_id']; 
}
if($_REQUEST['phoneno'] > 0){
    $filter_data['phoneno'] = $_REQUEST['phoneno']; 
}
$data_to_display = $db_handle->runQuery($partnerDetailsExport->searchFilter($filter_data));
preArray($data_to_display);
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
    </form>
        <!-- <input class="cursor" type="button" name="add" value="Add" id="add" onclick="add_info();"> -->
    </fieldset>
</div>
<div id="loan"></div>
</body>
</html>
<script src="<?php echo $head_url; ?>/assets/js/jquery-1.10.2.js"></script>
<script src="<?php echo $head_url; ?>/assets/js/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>  
