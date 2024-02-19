<?php 


$filename = "https://astechnos.com/crmsml/report/crm-query-report3.csv";

header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=$filename");
header("Pragma: no-cache");
header("Expires: 0");
ob_clean();



$content = array();
$title = array("Query Id", "Query Date Time", "Tool Type", "Customer Id", "Customer Name", "City", "Phone", "Loan Type", "Loan Amount", "Net Income", "User", "Query Status", "Verify Flag","Page Url","Assign Date Time");



//print_r($content);

$output = fopen('php://output', 'w');

fputcsv($output, $title);
foreach ($content as $con) {
    fputcsv($output, $con);
}

//echo $querytoexecute;
?>
