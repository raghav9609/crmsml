<?php
$temp_case_id = $case_id;
 
$email_template ="Team,<br><br>Please find below customer details : <br><br><table width='60%;' style='font-family: verdana,arial,sans-serif;font-size:11px;color:#333333;border-width: 1px;border-color: #666666;border-collapse: collapse;'>
<tr>
<td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>Lead ID</td><td  style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;'>".$temp_case_id."</td></tr>
<tr>
<td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>Name of Customer</td>
<td  style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;'>".$name." ".$mname." ".$lname."</td></tr>
<tr>
<td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>Mobile No. </td>
<td  style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;'>".$phone."</td></tr>
<tr>
<td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>Email</td>
<td  style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;'>".$email."</td></tr>
<tr>
<td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>Category</td>
<td  style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;'>".$loan_name."</td></tr>
<tr>
<td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>Area</td>
<td  style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;'>".$get_pat_city_name."</td></tr>
<tr>
<td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>Branch Area</td>
<td  style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;'>".$get_pat_city_name."</td></tr>
<tr>
<td style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>Company</td>
<td  style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;'>MyLoanCare Ventures Pvt. Ltd.</td></tr>
</table><br><br>
Team MyLoancare";
?>