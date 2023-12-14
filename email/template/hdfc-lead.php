<?php
include("crm-insert.php");
 $template_body  = '<table  width ="100%" border="1" style="border-collapse:collapse;">
<tbody>
<tr><td>
<table width="100%" border="0">
<tr><td width="20%"><img width="95" height="80" style="margin-left:41px;" src="https://myloancareindia.com/mailer-images/logo.png" alt="myloancare"/>
</td>
<td><h3 style="color:#2B2B8A;">Your <span style="color:#E87D24;">'.$loan_type_name.'</span> Request sent to <span style="color:#E87D24;">HDFC</span> in '.$city_name.'; List of documents attached below</h3></td>
</tr>
<table>
<tr>
<td>Dear '.$salutn_name.' '.$name.',</td>
</tr>
<tr><td><div class="text">Thanks for your <span style="color:#E87D24; font-weight:bold;">Rs. '.number_format($loan_amt).'</span> '.$loan_type_name.' query with MyLoanCare. Your request has been sent to HDFC. Their loan officers would contact you for processing your loan in '.$city_name.', typically within 24 hours. List of documents that you should keep ready for processing your loan is given below. Avoid applying for loan at multiple places as that may hurt your credit score. In case of any delay in receiving the call or for any other query, please reply to this mail and we will be glad to assist you.</div>
</td></tr>
<tr><td>Check list of documents required for <?php echo $loan_type_name;?> <a href="'.$url_doc.'">Here.</a></td></tr>
<tr><td>'.$f_ins.'</td></tr>
</table>
</table>
</td></tr>
</bbody></table>';
?>
