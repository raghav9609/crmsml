<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once "../../include/config.php";
require_once "../../include/class.apihelper.php";
require_once "../../include/env.conf.php";
require_once "../../include/ValidatorFactory.php";
require_once "../../integration/personal-loan/axis/Eligibility.php";

$param = $_REQUEST['req_val'];
$param_data = json_decode(base64_decode($param));
$mobile = base64_decode($param_data->mobile);
$dob = base64_decode($param_data->dob);
$loan_nature = base64_decode($param_data->loan_nature);
$websiteFormMergeId = base64_decode($param_data->web_fmd_id);
$main_account = base64_decode($param_data->main_account);
$queryId = base64_decode($param_data->qry_id);
$saving_accounts_with = base64_decode($param_data->saving_accounts_with);
$saving_accounts_with = explode(',',$saving_accounts_with);
if( (in_array(11,$saving_accounts_with) || $main_account == 11 ) && $loan_nature == 1 ){
    $axis = new Eligibility( $Conn1 );   //CRM Connection
    $requestData = [
        "action" => "axisPLEligibility",
        "mobile" => $mobile,
        "dob" => $dob,
        "mlcId" => ($websiteFormMergeId),
        "source" => 2,
    ];
    $response = $axis->checkEligibility( $requestData );
    var_dump($response);
}
else{
    $updateOffer = mysqli_query($Conn1,"UPDATE banks_pre_approved_offers SET is_offers = '0' where lead_id='".$queryId."'");
}