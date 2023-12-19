<?php 
require_once "../../include/check-session.php";
require_once "../../include/config.php";

error_reporting(0);
ini_set('memory_limit', '512M');
ini_set('max_execution_time', '180'); 

$bank_rec = replace_special($_POST['bank_rec']);
$partner = replace_special($_POST['partnersearch']);
$date_from = replace_special($_POST['date_from']);
$date_to = replace_special($_POST['date_to']);
$filename = "application.csv";
       
header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=$filename");
header("Pragma: no-cache");
header("Expires: 0");

$sql = "select app.case_id as case_id,app.bank_app_no_on as bnk_app_no,app.bank_crm_lead_on as bnk_crm_lead,c.query_id as qry_id,c.cust_id as cust_id, c.loan_type as loan_type, app.partner_on as partner_on, app.app_bank_on as bank_on, app.app_status_on as app_status_on, c.user_id as user_id, app.la_st_up_date as la_st_up_date,app.app_id as app_id,c.required_loan_amt as required_loan_amt,app.pre_login_status as pre_login_status,   app.applied_amount_on as applied_amount_on, app.sanctioned_amount_on as sanctioned_amount_on,app.disbursed_amount_on as disbursed_amount_on, app.login_date_on as login_date_on,app.sanction_date_on as sanction_date_on,app.first_disb_date_on as first_disb_date_on, app.date_created as created,app.source as source  from tbl_mint_app as app JOIN tbl_mint_case as c ON app.case_id = c.case_id where app.date_created >= '".$date_from."' and  app.date_created <='".$date_to."' ";
if($bank_rec != ""){
$sql .= " and app.app_bank_on = '".$bank_rec."'";
}
if($partner != ""){
$sql .= " and partner_on = '".$partner."'";
}
$sql .= " order by app.id";
$content = array();

$title = array("Case No","Application No","Name","CONTACT NO", "City", "Loan Type", "Loan Amount", "Partner", "Bank","Pre Login Status","Post Login Status","Applied Amount","Sanctioned Amount","Disbursed Amount","Login Date","Sanction Date","First Disbursed Date","Bank CRM/ Lead Id","Bank Application No","user Name","Last status Update","Date","Page URL","Source");


$results = mysqli_query($Conn1,$sql);
while($rs = mysqli_fetch_array($results)) {
      $qry_id      	= $rs['qry_id'];
      $cust_id      	= $rs['cust_id'];
      $loan_type   	= $rs['loan_type'];
      $partner_on   	= $rs['partner_on'];
      $app_bank_on   	= $rs['bank_on'];
      $pre_login_status	= $rs['pre_login_status'];
      $app_status_on   	= $rs['app_status_on'];
      $user_id   	= $rs['user_id'];
      $la_st_up_date   	= $rs['la_st_up_date'];
      $la_st_up_datef 	 = date("Y-m-d",strtotime($la_st_up_date));
      $source = $rs['source'] == '1' ?"MLC":"CRM";
       $query_url = mysqli_query($Conn1,"select page_url from form_merge_data where id ='".$qry_id."'");
      $result_url = mysqli_fetch_array($query_url);
      $page_url  = $result_url['page_url'];

      $qry_cust    = "SELECT name,phone,id,city_id,gold_city from tbl_mint_customer_info where id = ".$cust_id."";
      $result_cust = mysqli_query($Conn1,$qry_cust);
      $rs_cust 	   = mysqli_fetch_array($result_cust);
      $name 	   = $rs_cust['name'];
      $phone       = $rs_cust['phone'];
      $city_id     = $rs_cust['city_id'];
      $gold_city_id = $rs_cust['gold_city'];
      $qry_loan    = "SELECT loan_type_name from lms_loan_type where  loan_type_id = '".$loan_type."'";
      $result_loan = mysqli_query($Conn1,$qry_loan);
      $rs_loan     = mysqli_fetch_array($result_loan);
      $loan_name   = $rs_loan['loan_type_name'];
      
	$qrycity = "select city_name from lms_city where city_id = '".$city_id."'";
	$rescity = mysqli_query($Conn1,$qrycity);
	$execity = mysqli_fetch_array($rescity);
     $city_name = $execity['city_name']; 
	
	
      $qry_user    = "SELECT user_name from tbl_user_assign where user_id = '".$user_id."'";
      $result_user = mysqli_query($Conn1,$qry_user);
      $rs_user     = mysqli_fetch_array($result_user);
      $user_name       = $rs_user['user_name'];
      
      $qrydesc_partner = "select partner_name from tbl_mlc_partner where partner_id = '".$partner_on."'";
      $resdesc_partner = mysqli_query($Conn1,$qrydesc_partner);
      $exedesc_partner = mysqli_fetch_array($resdesc_partner);
      $partner_name    = $exedesc_partner['partner_name'];
      
      $q_bank_on       = "select bank_name from tbl_bank where bank_id = '".$app_bank_on."'";
      $r_bank_on       = mysqli_query($Conn1,$q_bank_on);
      $e_bank_on       = mysqli_fetch_array($r_bank_on);
      $name_bank_on    = $e_bank_on['bank_name'];
      
     $q_app_statuson  = "select app_status from tbl_app_status where app_status_id = '".$app_status_on."'";
     $r_app_statuson   = mysqli_query($Conn1,$q_app_statuson);
     $e_app_statuson   = mysqli_fetch_array($r_app_statuson);
     $name_app_statuson = $e_app_statuson['app_status'];
      
     $q_pre_statuson  = "select pre_status_name from tbl_app_pre_login where pre_status_id = '".$pre_login_status."'";
     $r_pre_statuson   = mysqli_query($Conn1,$q_pre_statuson);
     $e_pre_statuson   = mysqli_fetch_array($r_pre_statuson);
     $name_pre_statuson = $e_pre_statuson['pre_status_name'];
     
    $row = array();
    $row[] = stripslashes($rs["case_id"]);
    $row[] = stripslashes($rs["app_id"]);
    $row[] = stripslashes($name);
    $row[] = stripslashes($phone);
    $row[] = stripslashes($city_name);
    $row[] = stripslashes($loan_name);
    $row[] = stripslashes($rs["required_loan_amt"]);
    $row[] = stripslashes($partner_name);
    $row[] = stripslashes($name_bank_on);
     $row[] = stripslashes($name_pre_statuson);
    $row[] = stripslashes($name_app_statuson);
    $row[] = stripslashes($rs["applied_amount_on"]);
    $row[] = stripslashes($rs["sanctioned_amount_on"]);
    $row[] = stripslashes($rs["disbursed_amount_on"]);
    $row[] = stripslashes($rs["login_date_on"]);
    $row[] = stripslashes($rs["sanction_date_on"]);
    $row[] = stripslashes($rs["first_disb_date_on"]);
    $row[] = stripslashes($rs["bnk_crm_lead"]);
    $row[] = stripslashes($rs["bnk_app_no"]);
    $row[] = stripslashes($user_name);
    $row[] = stripslashes($la_st_up_datef);
    $row[] = stripslashes($rs["created"]);
     $row[] = stripslashes($page_url);
     $row[] = $source;
    $content[] = $row;    
}

$output = fopen('php://output', 'w');

fputcsv($output, $title);
foreach ($content as $con) {
    fputcsv($output, $con);
}
include("../../include/footer_close.php"); 
?>