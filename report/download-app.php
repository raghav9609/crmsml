<?php 
$downloadfile = 1;
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../config/config.php');

require_once(dirname(__FILE__) . '/../include/helper.functions.php');
require_once(dirname(__FILE__) . '/../include/display-name-functions.php');

$filename = "application-report-".date('d-m-Y').".csv";

header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=$filename");
header("Pragma: no-cache");
header("Expires: 0");
ob_clean();


if (isset($_REQUEST['fetchdata'])) {
    $querytoexecute = base64_decode($_REQUEST['fetchdata']);
}

$content = array();
$title = array("Application Id", "Application Date Time", "Customer Name", "City", "Phone", "Loan Type", "Loan Amount", "Bank", "User", "Application Status", "Follow up Date","Follow up Time","Login Date","Sanction Date","Disbursement date");

echo $querytoexecute;
die();
// $results = mysqli_query($Conn1,$querytoexecute);
// while($rs = mysqli_fetch_array($results)) {
//     if (!empty($rs)){
//         $row = array();
//         $get_loan_type_name = 'Personal Loan';
//         if($rs["loan_type_id"] > 0){
//             $get_loan_type_nameval = get_name('master_code_id',$rs["loan_type_id"]);
//             $get_loan_type_name = $get_loan_type_nameval["value"];
//         }
//         $get_user_name = 'UnAssigned';
//         if($rs["user_id"] > 0 ){
//             $get_user_nameval = get_name('user_id',$rs["user_id"]);
//             $get_user_name = $get_user_nameval["name"];
//         } 
//         $qstatus_name = 'Open';
//         if($rs["query_status"] > 0 ){
//             $qstatus_nameval = get_name('status_name',$rs["query_status"]);
//             $qstatus_name = $qstatus_nameval["value"];
//         }
//         $city_name = 'Other';
//         if($rs["city_id"] > 0 ){
//             $city_nameval = get_name('city_id',$rs["city_id"]);
//             $city_name = $city_nameval["city_name"];
//         }
//         $toolType = 'Direct';
//         if ($rs["tool_type"] != ''){
//             $toolType = $rs["tool_type"];
//         }
//         $customerId = 0;
//         if($rs["customer_id"] > 0){
//             $customerId = $rs["customer_id"];
//         }
//         $customername = '';
//         if($rs["name"] != ''){
//             $customername = $rs["name"];
//         }
//         $pageurl = '';
//         if($rs["page_url"] != ''){
//             $pageurl = $rs["page_url"];
//         }
//         $customerphone = 0;
//         if($rs["phone"] > 0){
//             $customerphone = $rs["phone"];
//         }
//         $loan_amt = 0;
//         if($rs["loan_amt"] > 0){
//             $loan_amt = $rs["loan_amt"];
//         }
//         $net_incom = 0;
//         if($rs["net_incm"] > 0){
//             $net_incom = $rs["net_incm"];
//         }
//         $leadassigndate = '';
//         if($rs["lead_assign_on"] != ''){
//             $leadassigndate = $rs["lead_assign_on"];
//         }
//         $row[] = ($rs["id"]);
//         $row[] = $rs["date"];
//         $row[] = ($toolType);
//         $row[] = ($customerId);
//         $row[] = ($customername);
//         $row[] = ($city_name);
//         $row[] = ($customerphone);
//         $row[] = ($get_loan_type_name);
//         $row[] = ($loan_amt);
//         $row[] = ($net_incom);
//         $row[] = ($get_user_name);
//         $row[] = ($qstatus_name);
//         $row[] = ($rs["verify_phone"]);
//         $row[] = ($pageurl);
//         $row[] = $leadassigndate ;
    
        
//         $content[] = $row;
//     }
      
// }

// //print_r($content);

// $output = fopen('php://output', 'w');

// fputcsv($output, $title);
// foreach ($content as $con) {
//     fputcsv($output, $con);
// }

//echo $querytoexecute;
?>
