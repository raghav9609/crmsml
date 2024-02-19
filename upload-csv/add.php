<?php
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../config/config.php');
require_once(dirname(__FILE__) . '/../model/queryHelper.php');
require_once(dirname(__FILE__) . '/../include/helper.functions.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name  = $_POST['name'];
   $phone_no  = $_POST['phone_no'];
    $email_id = $_POST['email_id'];
    $pincode = $_POST['pincode'];
    $loan_amount = $_POST['loan_amount'];
    $dob = $_POST['dob'];
    $net_income = $_POST['net_income'];
        $count = count($phone_no);
    $rows = array();
    for ($i = 0; $i < $count; $i++) {
        if ($dob[$i] != "" && $dob[$i] != null && $dob[$i] != "null"){
            $dob_get = dateformatymd($dob[$i]);
            if ($dob_get == "") {
                $dob_get = "1000-01-01";
            }
        };
        $row = array(
            'name' => $name[$i],
            'phone_no' => $phone_no[$i],
            'email_id' => $email_id[$i],
            'pincode' => $pincode[$i],
            'loan_amount' => $loan_amount[$i],
            'dob' => $dob_get,
            'query_status' => 1,
            'tool_type'=>"Upload_CSV",
            'net_income' => $net_income[$i]
        );
            $insert_qry =  "INSERT INTO crm_raw_data set ";
            $comma ="";
            foreach ($row as $key => $val) {
                $insert_qry .= $comma . $key . " = '" . $val . "'";
                $comma = ", ";
                } 
            $insert_qry.= ";";            
            $insert_data = mysqli_query($Conn1,$insert_qry);
    }
   

    if ($insert_data != false) {
        $rows =array('status' => 'success', 'message' => 'Data Uploaded Successfully','insert_Data' => $insert_row);
    } else {
        $rows = array('status' => 'error', 'message' => $insert_data,'insert_Data' => $insert_row);
    }
}
header('Content-Type: application/json');
echo json_encode($rows);
?>