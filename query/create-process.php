<?php
session_start();
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../config/config.php');
require_once "../include/helper.functions.php";
require_once "../include/display-name-functions.php";

$partnerId = $_REQUEST['partner_id'];
$query_id = $_REQUEST['query_id'];
$explpat = explode(',',$partnerId);
$user_id = $_REQUEST['user_id'];
$loanAmount = $_REQUEST['loan_amount'];

foreach($explpat As $patners){
    $getAppDetails = mysqli_query($Conn1,"select * from crm_query_application where crm_query_id = '".$query_id."' and bank_id ='".$patners."'");
    $exisdetails = mysqli_num_rows($getAppDetails);
    if ($exisdetails == 0){
        $createApp = mysqli_query($Conn1,"Insert into crm_query_application set crm_query_id = '".$query_id."', bank_id ='".$patners."', applied_amount='".$loanAmount."',application_status=26,login_date=CURDATE(),user_id='".$user_id."'");
    } 
}
echo '1';
//print_r($_REQUEST);
?>
