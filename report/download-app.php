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

//echo $querytoexecute;

$results = mysqli_query($Conn1,$querytoexecute);
while($rs = mysqli_fetch_array($results)) {
    if (!empty($rs)){
        $row = array();
        $get_loan_type_name = 'Personal Loan';
        if($rs["loan_name"] != ''){
            $get_loan_type_name = $rs["loan_name"];
        }
        $get_user_name = 'UnAssigned';
        if($rs["user_id"] > 0 ){
            $get_user_nameval = get_name('user_id',$rs["user_id"]);
            $get_user_name = $get_user_nameval["name"];
        } 
        $qstatus_name = '';
        if($rs["application_status"] > 0 ){
            $qstatus_nameval = get_name('status_name',$rs["application_status"]);
            $qstatus_name = $qstatus_nameval["value"];
        }
        $city_name = 'Other';
        if($rs["city_id"] > 0 ){
            $city_nameval = get_name('city_id',$rs["city_id"]);
            $city_name = $city_nameval["city_name"];
        }
        $bank_name = '';
        if($rs["bank_id"] > 0 ){
            $bank_nameval = get_name('master_code_id',$rs["bank_id"]);
            $bank_name = $bank_nameval["value"];
        }
        $customername = '';
        if($rs["name"] != ''){
            $customername = $rs["name"];
        }
        $customerphone = 0;
        if($rs["phone"] > 0){
            $customerphone = $rs["phone"];
        }
        $loan_amt = 0;
        if($rs["required_loan_amt"] > 0){
            $loan_amt = $rs["required_loan_amt"];
        }
        $followupdate = '';
        if($rs["follow_up_date"] != ''){
            $followupdate = $rs["follow_up_date"];
        }
        $sanctiondate = '';
        if($rs["sanction_date_on"] != ''){
            $sanctiondate = $rs["sanction_date_on"];
        }
        $logindate = '';
        if($rs["login_date_on"] != ''){
            $logindate = $rs["login_date_on"];
        }
        $disbdate = '';
        if($rs["first_disb_date_on"] != ''){
            $disbdate = $rs["first_disb_date_on"];
        }
        $followuptime = '';
        if($rs["follow_up_time"] != ''){
            $followuptime = $rs["follow_up_time"];
        }
        $row[] = ($rs["app_i"]);
        $row[] = $rs["created_on"];
        $row[] = ($customername);
        $row[] = ($city_name);
        $row[] = ($customerphone);
        $row[] = ($get_loan_type_name);
        $row[] = ($loan_amt);
        $row[] = ($bank_name);
        $row[] = ($get_user_name);
        $row[] = ($qstatus_name);
        $row[] = ($followupdate);
        $row[] = ($followuptime);
        $row[] = $logindate ;
        $row[] = $sanctiondate ;
        $row[] = $disbdate ;
    
        
        $content[] = $row;
    }
      
}

//print_r($content);

$output = fopen('php://output', 'w');

fputcsv($output, $title);
foreach ($content as $con) {
    fputcsv($output, $con);
}
fclose($output);
//echo $querytoexecute;
?>
