<?php
require_once "../config/config.php";
require_once "../include/helper.functions.php";
require_once "../include/display-name-functions.php";

/* if($user == '173'){
echo "select * from tbl_updated_query_details where query_id='".$qryyy_id."'";
} */
$qryyy_id = $_REQUEST['query_id'];
$return_html = "";

 $qry_get_data = "select * from crm_raw_data as raw_data left join crm_query as qry on raw_data.id = qry.crm_raw_data_id where qry.id = ".$qryyy_id;
$res = mysqli_query($Conn1, $qry_get_data);
 $recordcount = mysqli_num_rows($res);
if($recordcount > 0) {
    $res_data = mysqli_fetch_array($res);
  // print_r($res_data);
    $company_nm = "";
    // $cust_id = $res_data['cust_id'];
    if($res_data['company_id'] != '0') {
        $company_nm = get_display_name('comp_name',$res_data['company_id']); 
    } else {
        $company_nm = $res_data['company_name'];
    }
   
    $net_incm = ($res_data['net_income'] > 0) ? $res_data['net_income'] : "--";
 
    $pan_card_get = trim($res_data['pan_no']);
    
    $pan_card = ($pan_card_get != "") ? $pan_card_get : "--";
    $salary_pay_id = (!empty($res_data['mode_of_salary'])) ? $res_data['mode_of_salary'] : "";
    
    $salry_py_mod = "--";
    if(!empty($salary_pay_id)) {
        $salry_py_mod = get_display_name('salary_method',$salary_pay_id);
    }

    $city_nm = "--";
    if(!empty($res_data['city_id'])) {
        $city_nm = get_display_name('city_name',$res_data['city_id']); 
    }
    $return_html .= "<table class='gridtable table_set' border='1'><tr class='font-weight-bold'><th>Net Monthly Income</th><th>Company</th><th>Salary Payment Mode</th><th>PAN Card</th><th>City</th><th>Pin Code</th><th>Loan Amount</th><th>Email Id</th><th>Name</th><th>DOB</th></tr>";

    $pincode = ($res_data['pincode'] > 0) ? $res_data['pincode'] : "--";

    $return_html .= "<tr class='center-align'><td>".$net_incm."</td><td>".$company_nm."".$comp_name_other."</td><td>".$salry_py_mod."</td><td>".$pan_card."</td><td>".$city_nm."</td><td>".$pincode."</td><td>".$res_data['loan_amount']."</td><td>".$res_data['email_id']."</td><td>".$res_data['name']."</td><td>".$res_data['dob']."</td></tr>";
    $return_html .= "</table>";
    echo $return_html; 

    }
?>