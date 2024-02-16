<?php 
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../config/config.php');

require_once(dirname(__FILE__) . '/../include/helper.functions.php');
require_once(dirname(__FILE__) . '/../include/display-name-functions.php');

if (isset($_REQUEST['fetchdata'])) {
    $querytoexecute = base64_decode($_REQUEST['fetchdata']);
}

$content = array();
$title = array("Query Id", "Query Date Time", "Tool Type", "Customer Id", "Customer Name", "City", "Phone", "Loan Type", "Loan Amount", "Net Income", "User", "Query Status", "Device", "Verify Flag","IP", "Page Url","Assign Date Time");

$results = mysqli_query($Conn1,$qry);
while($rs = mysqli_fetch_array($results)) {
    $row = array();
    $get_loan_type_name = get_name('master_code_id',$res["loan_type_id"]);
    $get_user_name = get_name('user_name',$res["lead_assign_to"]);
    $qstatus_name = get_name('status_name',$res["query_status"]);
    $city_name = get_name('city_name',$res["city_id"]);
    $row[] = ($rs["id"]);
    $row[] = $rs["date"];
    $row[] = stripslashes($rs["tool_type"]);
    $row[] = stripslashes($rs["customer_id"]);
    $row[] = stripslashes($rs["name"]);
    $row[] = stripslashes($city_name["city_name"]);
    $row[] = stripslashes($res["phone"]);
    $row[] = stripslashes($get_loan_type_name["value"]);
    $row[] = stripslashes($rs["loan_amt"]);
    $row[] = stripslashes($rs["net_incm"]);
    $row[] = stripslashes($get_user_name["name"]);
    $row[] = stripslashes($qstatus_name["value"]);
    $row[] = stripslashes($rs["device_type"]);
    $row[] = stripslashes($rs["verify_phone"]);
    $row[] = stripslashes($rs["user_ip"]);
    $row[] = stripslashes($rs["page_url"]);
    $row[] = $rs["lead_assign_on"] ;
   
    
    $content[] = $row;
      
}

print_r($content);

$output = fopen('php://output', 'w');

fputcsv($output, $title);
foreach ($content as $con) {
    fputcsv($output, $con);
}

echo $querytoexecute;
?>
