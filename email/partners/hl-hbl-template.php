<?php
$email_template = "<table width='60%;' style='font-family: verdana,arial,sans-serif;font-size:11px;color:#333333;border-width: 1px;border-color: #666666;border-collapse: collapse;'>
<tr>
<td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>Lead ID</td><td  style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;'>".$case_id."</td></tr>";
if($bank_crm_id_app != '' && $bank_crm_id_app != 0){
   $email_template .=  "<tr>
<td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>Bank Lead ID</td>
<td  style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;'>".$bank_crm_id_app."</td></tr>";
}
$email_template .= "<tr>
<td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>Customer</td><td  style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;'>".$name." ".$mname." ".$lname."<br>".$phone."<br>".$email."<br>".$city_name."<br>DOB: ".$dob."</td></tr>
<tr>
<td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>Occupation</td><td  style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;'>".$occu_name." ".$sal_title." Rs. ".$net_incm."</td></tr>
<tr>
<td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>Loan Amount/ Type</td><td  style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;'>Rs. ".$loan_amt." / ".$loan_name."(".$nat_loan_name.")<br>".$ext_bank_name." ".$ext_roi_tit."</td></tr>
<tr>
<td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>Property</td><td  style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;'>Property @ ".$prop_city_name."<br>".$asset_tit."<br>".$prop_typ_name." ".$iden_prop_tit."<br>".$prop_market_tit."</td></tr>

<td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>Remarks</td><td  style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;'>".$bank_descccc."</td></tr>
</table><br><div style='color:blue;font-weight:bold;'>Connector name - Shalini Gupta, Code - NDEL273 </div>";
?>