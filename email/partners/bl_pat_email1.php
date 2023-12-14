<?php
if($bk_pat_id == 31){
$fs_code = "<tr><td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>FSCODE</td><td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;'>MA084</td></tr><tr style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'><td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>FSNAME</td><td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;'>MyLoanCare Ventures Pvt Ltd PRIVATE LIMITED (MY LOAN CARE)</td></tr>";
}else if($bk_pat_id == 62){
$fs_code = "<tr><td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>Source/ DSA Code</td><td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;'>DSADGTLBL4</td></tr>";
}else if($bk_pat_id == 66){
$fs_code = "<tr><td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'><div style='color:blue;font-weight:bold;'>IMPORTANT - &#34;Capture Referral code as &#34;5432&#34; (vendor name &#45; MyLoanCare Ventures Pvt Ltd) at the time of Login/Approval.&#34;</div></td></tr>";
}else{
$fs_code = '';
}

if($bk_pat_id == 27){
$fs_hdfc_code = "<div style='color:blue;font-weight:bold;'>IMPORTANT - &#34;Capture DSA code as &#34;324637&#34; (vendor name &#45; MyLoanCare Ventures Pvt Ltd) in Finone at the time of QDE/ Login.&#34;</div>";
}else{
$fs_hdfc_code = '';
}
$email_template = $fs_hdfc_code."<br><table width='60%;' style='font-family: verdana,arial,sans-serif;font-size:11px;color:#333333;border-width: 1px;border-color: #666666;border-collapse: collapse;'>".$fs_code."<tr>
<td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>Myloancare Lead ID</td><td  style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;'>".$case_id."</td></tr>";
if($bank_crm_id_app != '' && $bank_crm_id_app != 0){
   $email_template .=  "<tr>
<td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>Bank Lead ID</td>
<td  style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;'>".$bank_crm_id_app."</td></tr>";
}
$email_template .= "<tr>
<td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>Customer</td><td  style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;'>".$name." ".$mname." ".$lname."<br>".$phone."<br>".$email."<br>".$get_pat_city_name." (".$city_name.")<br>DOB: ".$dob."</td></tr>
<tr>
<td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>Residence Detail</td>
<td  style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;'>".$res_addrs."<br>".$pin_code."</td></tr>
<tr>
<td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>Office Detail</td>
<td  style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;'>".$offce_address."<br>".$wcity_name."<br>".$ofc_pincode
."</td></tr>
<tr>
<td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>Occupation</td><td  style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;'> NTH Rs. ".$net_incm."<br>Business Existing from: ".$ext_year_name."<br>Annual Turnover: ".$anl_trunover_name."<br>Nature of Business: ".$bus_nature_name."<br>ITR Available: ".$bussiness_itr_name."<br>Register Type: ".$reg_type_name."<br>Security Type: ".$security_name."</td></tr>
<tr>
<td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>DOB</td><td  style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;'>".$dob."</td></tr>
<tr>
<td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>Pan Card</td><td  style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;'>".$pan_card."</td></tr>

<tr>
<td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>Priority</td>
<td  style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;'>".$priority."</td></tr>
<tr>
<td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>Account No.</td>
<td  style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;'>".$account_no."</td></tr>
<tr>
<td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>Loan Amount/ Type</td><td  style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;'>Rs. ".$loan_amt." / ".$loan_name."</td></tr>
<tr>
<td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>Residential Type/ Address Proof</td><td  style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;'>".$residential_name."<br>".$adrs_pro."</td></tr>
<tr>
<td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>Remarks</td><td  style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;'>".$bank_descccc."</td></tr>
<tr>
<td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>Myloancare User</td><td  style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;'>".$user_name_asign."</td></tr>
</table>";
?>