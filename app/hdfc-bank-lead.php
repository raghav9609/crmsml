<?php
require_once "../../include/crm-header.php";
require("../../include/class.mailer.php");
error_reporting(0);
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../../include/style.css"> 
 <script type="text/javascript" src="../../include/js/jquery-1.10.2.js"></script>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.3/css/bootstrap.min.css"
        rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.3/js/bootstrap.min.js"></script>
    <link href="http://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/css/bootstrap-multiselect.css"
        rel="stylesheet" type="text/css" />
    <script src="http://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/js/bootstrap-multiselect.js"
        type="text/javascript"></script>
<script type="text/javascript">
        $(function () {
            $('#sub_grp').multiselect({
                includeSelectAllOption: true
            });
        });
    </script>
</head>
<body>
    <div  style= 'margin:20px;'>
<form method='POST' action =''>
<select id="sub_grp" name="sub_grp[]" multiple="multiple">
<?php
$qry_citygp = mysqli_query($Conn1,"select city_sub_gp_name_offer,city_sub_gp_id_offer from lms_city_subgroup_offer");
while($res_citygp = mysqli_fetch_array($qry_citygp)){
$city_sub_group_id = $res_citygp['city_sub_gp_id_offer'];
$city_sub_group_name = $res_citygp['city_sub_gp_name_offer'];
?>
<option value="<?php echo $city_sub_group_id;?>"><?php echo $city_sub_group_name;?></option>
                    <?php }?>
                  </select>
<input type ='submit' class = 'buttonsub' name = 'send' id ="send" value = 'Send Email'></form>
</div>
<?php 
if($_REQUEST['send']){
$sub_grp = replace_special($_POST['sub_grp']); 
$city_no = count($sub_grp);
$email_send = "<table style = 'font-family: verdana,arial,sans-serif;	font-size:11px;	color:#333333;border-width: 1px;border-color: #666666;border-collapse: collapse;' border = '1'><tr><th style ='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>Lead Date</th><th style ='border-width: 1px;padding: 8px;	border-style: solid;border-color: #666666;	background-color: #dedede;'>Branch Name (City)</th><th style ='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;	background-color: #dedede;'>Application/ CRM Number</th><th style ='border-width: 1px;padding: 8px;	border-style: solid;border-color: #666666;	background-color: #dedede;'>Profile</th><th style ='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;	background-color: #dedede;'>Customer Name</th><th style ='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;	background-color: #dedede;'>Phone</th><th style ='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;	background-color: #dedede;'>Salary</th><th style ='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;	background-color: #dedede;'>Company <br>Company Category</th><th style ='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;	background-color: #dedede;'>Status</th></tr>";

for($i=0;$i<$city_no;$i++){
$city_id_arr = array();
if($sub_grp[$i] != 16){
$qry_city = mysqli_query($Conn1,"select city_id from lms_city where city_sub_group_offer_id = '".$sub_grp[$i]."'");
while($res_city = mysqli_fetch_array($qry_city)){
 $city_id_arr[] = $res_city['city_id'];
}}else{
$qry_city = mysqli_query($Conn1,"select city_id from lms_city where city_sub_group_offer_id != 16");
while($res_city = mysqli_fetch_array($qry_city)){
 $city_id_arr[] = $res_city['city_id'];
}
}
$email_send_arr = array();
$email_final = '';
$appl_qry = ''; 
$appl_qry = "select app.app_id as app_id,app.date_created as date_created,cust.name as name,cust.city_id as city_id,cust.comp_name_other as comp_name_other,cust.comp_id as comp_id,cust.occup_id as occup_id,cust.net_incm as net_incm,cust.phone as phone, cse.loan_type as loan_type,app.bank_crm_lead_on as bank_crm_lead_on from tbl_mint_app as app left join tbl_mint_case as cse on app.case_id = cse.case_id left join tbl_mint_customer_info as cust on cse.cust_id = cust.id where app.app_bank_on = 42 and (cse.loan_type = 56 or cse.loan_type = 57) and app.bank_lead_id_status = 0 and app.bank_crm_lead_on != 0 and app.bank_crm_lead_on != '' ";
if($sub_grp[$i] != 16){
$appl_qry .= " and cust.city_id IN (".implode(",",$city_id_arr).")";
}if($sub_grp[$i] == 16){
$appl_qry .= " and cust.city_id NOT IN (".implode(",",$city_id_arr).")";
}
$appl_qry;
$appli_query = mysqli_query($Conn1,$appl_qry);
while($result_appli_qry = mysqli_fetch_array($appli_query)){
$name = $result_appli_qry['name'];
$phone = $result_appli_qry['phone'];
$loan_type = $result_appli_qry['loan_type'];
$bank_crm_lead_on = $result_appli_qry['bank_crm_lead_on'];
$app_id = $result_appli_qry['app_id'];
$cust_city_name = $result_appli_qry['city_id'];
$net_incm = $result_appli_qry['net_incm'];
$occup_id = $result_appli_qry['occup_id'];
$comp_id = $result_appli_qry['comp_id'];
$comp_name_other = $result_appli_qry['comp_name_other'];
$date_created = $result_appli_qry['date_created'];

$city_qry = mysqli_query($Conn1,"select city_name from lms_city where city_id = '".$cust_city_name."'");
$res_city = mysqli_fetch_array($city_qry);
$city_name = $res_city['city_name'];

$loan_qry = mysqli_query($Conn1,"select loan_type_name from lms_loan_type where loan_type_id = '".$loan_type."'");
$res_loan = mysqli_fetch_array($loan_qry);
$loan_name = $res_loan['loan_type_name'];

$occup_qry = mysqli_query($Conn1,"select occupation_name from lms_occupation where occupation_id = '".$occup_id."'");
$res_occup = mysqli_fetch_array($occup_qry);
$occup_name = $res_occup['occupation_name'];

$comp_qry = mysqli_query($Conn1,"select comp_name,hdfc_bank_cat from pl_company where comp_id = '".$comp_id."'");
$res_comp = mysqli_fetch_array($comp_qry);
$comp_name = $res_comp['comp_name'];
$hdfc_bank_cat = $res_comp['hdfc_bank_cat'];

$comp_cat_qry = mysqli_query($Conn1,"select category_name from pl_comp_bank_category where category_id = '".$hdfc_bank_cat."' and bank_id = 42");
$res_comp_cat = mysqli_fetch_array($comp_cat_qry);
$comp_cat_name = $res_comp_cat['category_name'];

$email_send_arr[] = "<tr><td>".$date_created."</td><td>".$city_name."</td><td>".$bank_crm_lead_on."</td><td>".$occup_name."</td><td>".$name."</td><td>".$phone."</td><td>".$net_incm."</td><td>".$comp_name.$comp_name_other."<br>".$comp_cat_name."</td><td>&nbsp;</td></tr>";

$update = "update tbl_mint_app set bank_lead_id_status = 1 where app_id = '".$app_id."'";
$update_qry = mysqli_query($Conn1,$update);
}
$email_final = $email_send.implode("",$email_send_arr)."</table><br>";
$subject = "HDFC CRM Lead ID Updates";
$recep_mail = $replytomail = array("rm1@myloancare.in","sumit@myloancareindia.in");
$cctomail = array("sumit@myloancareindia.in");
mailSend($recep_mail,$cctomail,$replytomail,$subject,$email_final);
/* $mail = new PHPMailer(true);

$mail->AddAddress("rm1@myloancare.in");
$mail->AddCC("deepak@myloancare.in");
//$mail->AddAddress("sumit@myloancare.in");
$mail->SetFrom("info@myloancareindia.in", "MyLoanCare");
$mail->Subject = $subject;
$mail->Body = $email_final;
$mail->IsHTML(true); 
try{
   $mail->Send();
  echo "";
} catch(Exception $e){
  echo "";
} */

}
echo "<script>alert('Email Send Successfully');</script>";
}
mysqli_close($Conn);
?>
</body></html>