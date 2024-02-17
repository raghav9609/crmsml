<?php 
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../config/config.php');

require_once(dirname(__FILE__) . '/../include/helper.functions.php');
require_once(dirname(__FILE__) . '/../include/display-name-functions.php');

$filename = "crm-query-report.csv";

header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=$filename");
header("Pragma: no-cache");
header("Expires: 0");
ob_clean();


if (isset($_REQUEST['fetchdata'])) {
    $querytoexecute = base64_decode($_REQUEST['fetchdata']);
}

$content = array();
$title = array("Query Id", "Query Date Time", "Tool Type", "Customer Id", "Customer Name", "City", "Phone", "Loan Type", "Loan Amount", "Net Income", "User", "Query Status", "Device", "Verify Flag","IP", "Page Url","Assign Date Time");

$results = mysqli_query($Conn1,$querytoexecute);
while($rs = mysqli_fetch_array($results)) {
    $row = array();
    $get_loan_type_name = get_name('master_code_id',$res["loan_type_id"]);
    $get_user_name = get_name('user_name',$res["lead_assign_to"]);
    $qstatus_name = get_name('status_name',$res["query_status"]);
    $city_name = get_name('city_name',$res["city_id"]);
    $row[] = ($rs["id"]);
    $row[] = $rs["date"];
    $row[] = ($rs["tool_type"]);
    $row[] = ($rs["customer_id"]);
    $row[] = ($rs["name"]);
    $row[] = ($city_name["city_name"]);
    $row[] = ($res["phone"]);
    $row[] = ($get_loan_type_name["value"]);
    $row[] = ($rs["loan_amt"]);
    $row[] = ($rs["net_incm"]);
    $row[] = ($get_user_name["name"]);
    $row[] = ($qstatus_name["value"]);
    $row[] = ($rs["device_type"]);
    $row[] = ($rs["verify_phone"]);
    $row[] = ($rs["user_ip"]);
    $row[] = ($rs["page_url"]);
    $row[] = $rs["lead_assign_on"] ;
   
    
    $content[] = $row;
      
}

//print_r($content);

$output = fopen('php://output', 'w');

fputcsv($output, $title);
foreach ($content as $con) {
    fputcsv($output, $con);
}
fclose($output);
ob_get_clean();
//echo $querytoexecute;
?>
