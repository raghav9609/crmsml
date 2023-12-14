<?php
if($bk_pat_id == 31){
$fs_code = "<tr><td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>FSCODE</td><td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;'>MA084</td></tr><tr style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'><td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>FSNAME</td><td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;'>MyLoanCare Ventures Pvt Ltd PRIVATE LIMITED (MY LOAN CARE)</td></tr>";
}else if($bk_pat_id == 49 && $webtopno != ''){
    $fs_code = "<tr><td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>Webtop No</td><td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;'>".$webtopno."</td></tr>";
}else if($bk_pat_id == 38){
$fs_code = "<tr><td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>LAN No.</td>
<td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;'>".$lan_no."</td></tr>";
}else if($bk_pat_id == 79){
$fs_code = "<div style='color:blue;font-weight:bold;'>IMPORTANT - &#34;Capture DSA code as &#34;52523 MY LOAN CARE&#34; while punching case details over SFDC Portal</div>";
}else if($bk_pat_id == 23){
$fs_code = "<div style='color:blue;font-weight:bold;'>IMPORTANT - &#34;Capture DSA code as &#34;CON1111GUR while Login.</div>";
}else if($bk_pat_id == 62){
$fs_code = "<tr><td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>Source/ DSA Code</td><td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;'>DSADGTLPL4</td></tr>";
}else{
$fs_code = '';
}

if($bk_pat_id == 27){
$comp_query_cat = mysqli_query($Conn1,"select category_name from pl_comp_bank_category where category_id = '".$hdfc_bank_cat."' and bank_id = 42");
$result_comp_cat_query = mysqli_fetch_array($comp_query_cat);
$category_name = $result_comp_cat_query['category_name'];
if($category_name != '' ){
$hdfc_categry = "(".$category_name.")" ;
}
$fs_hdfc_code = "<div style='color:blue;font-weight:bold;'>IMPORTANT - &#34;Capture DSA code as &#34;324637&#34; (vendor name &#45; MyLoanCare Ventures Pvt Ltd) in Finone at the time of QDE/ Login.&#34;</div>";
}else if($bk_pat_id == 62){
    $fs_hdfc_code = "<div style='color:blue;font-weight:bold;'>Capture MyLoanCare DSA code DSADGTLPL4 while login.</div>";
}else{
$fs_hdfc_code = '';
$hdfc_categry = '';
}
$temp_case_id = $case_id;
 
$email_template = $fs_hdfc_code."<br><table width='60%;' style='font-family: verdana,arial,sans-serif;font-size:11px;color:#333333;border-width: 1px;border-color: #666666;border-collapse: collapse;'>".$fs_code."<tr>
<td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>MyLoanCare Lead ID</td><td  style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;'>".$temp_case_id."</td></tr>";
if($bank_crm_id_app != '' && $bank_crm_id_app != 0){
   $email_template .=  "<tr>
<td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>Bank Lead ID</td>
<td  style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;'>".$bank_crm_id_app."</td></tr>";
}
$email_template .= "<tr>
<td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>Customer</td><td  style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;'>".$name." ".$mname." ".$lname."<br>".$phone."<br>".$email."<br>".$get_pat_city_name."<br>DOB: ".$dob."</td></tr>
<tr>
<td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>Occupation</td><td  style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;'>".$occu_name." ".$comp_name_title." ".$hdfc_categry." ".$sal_title." Rs. ".$net_incm."<br>".$slry_paid_tit." ".$bank_name."<br>".$ccwe_tit." ".$twe_tit."</td></tr>
<tr>
<td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>Loan Amount/ Type</td><td  style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;'>Rs. ".$loan_amt." / ".$loan_name." / ".$nat_loan_name."</td></tr>
<tr>
<td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>Residential Type/ Address Proof</td><td  style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;'>".$residential_name."<br>".$adrs_pro."</td></tr>
<tr>
<td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>Existing Loans & Credit Cards</td><td  style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;'>".$exis_details_loan."<br>".$exis_details_credit."</td></tr>
<tr>
<td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>Remarks</td><td  style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;'>".$bank_descccc."</td></tr>
<tr>
<td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>MyLoanCare User</td><td  style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;'>".$user_name_asign."</td></tr>
</table>";
?>