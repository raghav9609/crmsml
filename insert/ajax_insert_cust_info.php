<?php
$slave =1;
require_once "../../include/config.php";
require_once "../../include/helper.functions.php";
require_once "../../include/check-session.php";

$cust_id = $_REQUEST['cust_id'];
$user_role = $_SESSION['user_role'];
$return_html = "";
?>
<?php
$res_sugar_case = mysqli_query($Conn1,"select cust.name as name,cust.mname as mname,cust.lname as lname,cust.email as email,cust.phone as phone,cust.net_incm as net_incm,city.city_name as city_name,occup.occupation_name as occupation_name,det.subject as subject,cse.case_id as case_id,cse.la_st_up_date as la_st_up_date,loan.loan_type_name as loan_type_name from tbl_mint_case as cse left join tbl_mint_case_detail as det on cse.case_id = det.case_id left join tbl_mint_customer_info as cust on cse.cust_id = cust.id 
left join lms_loan_type as loan on cse.loan_type = loan.loan_type_id left join lms_city as city on cust.city_id = city.city_id left join lms_occupation as occup on cust.occup_id = occup.occupation_id where 
cse.cust_id = ".$cust_id." group by cse.case_id order by cse.case_id desc limit 1") or die(mysqli_error($Conn1));
if(mysqli_num_rows($res_sugar_case) > 0) {
    $exe_sugar_case = mysqli_fetch_array($res_sugar_case);

    $case_id = $exe_sugar_case['case_id'];
    $last_modified = $exe_sugar_case['la_st_up_date'];
    $modified_date = ($last_modified == "" || $last_modified == "0000-00-00" || $last_modified == "1970-01-01") ? "--" : date("d-m-Y",strtotime($last_modified));
    $loan = (trim($exe_sugar_case['loan_type_name']) != "") ? $exe_sugar_case['loan_type_name'] : "--";
    $subject = (trim($exe_sugar_case['subject']) != "") ? $exe_sugar_case['subject'] : "--";
    $name	= $exe_sugar_case['name']." ".$exe_sugar_case['mname']." ".$exe_sugar_case['lname'];
    $name = (trim($name) != "") ? $name : "--";
    $email = "--";
    if($user_role == '3') {
        $email	= (trim($exe_sugar_case['email']) != "") ? $exe_sugar_case['email'] : "--";
    } else {
        $email	= (trim($exe_sugar_case['email']) != "") ? "<br><span class='fs-12'>(".$exe_sugar_case['email'].")</span>" : "--";
    }
        
    $mobile	= ($exe_sugar_case['phone'] != "" && $exe_sugar_case['phone'] > 0) ? $exe_sugar_case['phone'] : "--";
    $net_incm = ($exe_sugar_case['net_incm'] > 0) ? custom_money_format($exe_sugar_case['net_incm']) : "--";
    $city_name = (trim($exe_sugar_case['city_name']) != "") ? "(".$exe_sugar_case['city_name'].")" : "--";
    $occupation_name = (trim($exe_sugar_case['occupation_name']) != "") ? "(".$exe_sugar_case['occupation_name'].")" : "--";
?>
    <?php $return_html .= "<div style='clear: both; padding: 1%;'></div><table width='100%' class='gridtable'>"; ?>
        <?php $return_html .= "<tr><th width='10%'>Name & City</th><th width='10%'>Mobile & Email</th><th width='10%'>Net Income & Occupation</th></tr><tr class='center-align'>"; ?>
    <?php $return_html .= "<td><a href='../cust_account/edit.php?cust_id=".urlencode(base64_encode($cust_id))."' target='_blank'>".$name."</a><br/><span class='fs-12'>".$city_name."</span></td><td>"; ?>
        <?php 
            if($user_role != '1') {
                $return_html .= "";
            } else {
                $return_html .= $mobile;
            } 
        ?>
    <?php $return_html .= $email."</td><td><span>".$net_incm."</span><br/><span class='fs-12'>".$occupation_name."</span></td></tr></table>"; ?>
<?php
}
echo $return_html;
?>