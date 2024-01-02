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
    $dob = $_POST['dob'];
    $net_income = $_POST['net_income'];
    
    // print_r( $phone_no);
    $count = count($phone_no);
    $rows = array();
    
    // $get_data  = 'select count(id) as total_count from crm_raw_data';
    // $result_app_qry = mysqli_query($Conn1,$get_data);
    // $row_count_before_insert = mysqli_fetch_array($result_app_qry);

    for ($i = 0; $i < $count; $i++) {
        if ($dob[$i] != "" && $dob[$i] != null && $dob[$i] != "null"){
            $dob_get = dateformatymd($dob[$i]);
            if ($dob_get == "") {
                $dob_get = "1000-01-01";
            }
        };
        // print_r($phone_no[$i]);
        

        
        $row = array(
            'name' => $name[$i],
            'phone_no' => $phone_no[$i],
            'email_id' => $email_id[$i],
            'pincode' => $pincode[$i],
            'dob' => $dob[$i],
            'net_income' => $net_income[$i]
        );
        // $todayDate = date('Y-m-d');
        $array_where = array(
            "phone_no = '".$phone_no[$i]."'"
        );
        print_r($row);
        exit();
        // if ($communication_type[$i] == 1 || $communication_type[$i] == 2) {
        //     $array_where[] = "mobile_no =" . $mobile_no[$i];
        // } else if ($communication_type[$i] == 6) {
        //     $array_where[] = "email_id =" . $email_id[$i];
        // }
        // echo "hihi";
        // $chek_data = $queryModel->get_rawdata($array_where,10);
        // echo $chek_data;
        // echo "jjiiii";
        // exit();
        // $chek_data  = "select * from crm_raw_data where phone_no = '".$phone_no[$i]."'";
        // // echo $chek_data;
        // // $chek_data1 = $db_handle->runQuery($chek_data);
        // $res_qry_get = mysqli_query($Conn1,$chek_data);
        // // print_r($res_qry_get); 
        // $res_qry1 = mysqli_fetch_array($res_qry_get);
        // print_r($res_qry1);
        // exit();
        // if(empty($res_qry)){
            $insert_qry =  "INSERT INTO crm_raw_data set ";
            foreach ($row as $key => $val) {
                $insert_qry .= $comma . $key . " = '" . $val . "'";
                $comma = ", ";
                } 
            $insert_qry.= ";";
            echo $insert_qry;
            
            $insert_data = mysqli_query($Conn1,$insert_qry);
            // echo "sucess";
            // $insert_qry = $query_model->insertQueryData('mlc_trigger_sms',$row);
            // $insert_data = $db_handle->insertRows($insert_qry);   
        // }else{
        //     $rows = array('status' => 'error', 'message' => 'Duplicate entry','insert_Data' => $insert_row);
        // }
    }
    // $row_count  = $queryModel->getrowcount(); 
    // $row_count  = "select count(id) as total_count from crm_raw_data";
    // // echo $row_count;
    // // exit();
    // $row_count_after_insert =  mysqli_query($Conn1,$row_count);
    // $countAfterInsert = $row_count_after_insert['total_count'];
    // $countBeforeInsert = $row_count_before_insert['total_count'];
    // $insert_row = $countAfterInsert - $countBeforeInsert;

    if ($insert_data != false) {
        $rows =array('status' => 'success', 'message' => 'Data Uploaded Successfully','insert_Data' => $insert_row);
    } else {
        $rows = array('status' => 'error', 'message' => $insert_data,'insert_Data' => $insert_row);
    }
}
// echo $rows;
// exit();
header('Content-Type: application/json');
echo json_encode($rows);
?>