<?php
include("crm-insert.php");
$template_body = '<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Best Offers Compare and Select</title>
</head>
<body style="margin: auto;background: #ddd;font-family: sans-serif;">
	<table cellpadding="0" cellspacing="0" style="border: 1px solid #008db1;max-width: 600px;min-width:320px;text-align: center;margin: auto;background: #ffffff;border-spacing: 0px">
		<tr><td height="10"></td></tr>
		'.$h_ins.'
		<tr style="background: #f7f7f7">
			<td style="text-align: left;padding: 0px 5%;font-size: 15px">
				<p>Dear '.ucwords(strtolower($salutn_name.' '.$name)).',</p>
				<p style="font-size: 14px">Thank you for speaking with MyLoanCare’s loan officer regarding a <b>'.$loan_type_name.'</b> enquiry of  <b>Rs. '.number_format($loan_amt).'</b>. A dedicated loan officer will assist you throughout the loan process.<br><br>Our services are FREE for our customers. Please feel free to write or call your loan officer for any assistance that you may require.
				</p>
				<p style="font-size: 14px">Here are the current loan offers based on your details and eligibility.</p>
			</td>
		</tr>
		<tr style="background: #f7f7f7">
			<td colspan="2">
				<table style="width: 100%;border-spacing: 0px;"> '.$email_table.'</table>
			</td>
		</tr>
		'.$f_ins_team_contact.$f_ins_assurance.$f_ins_services.$f_ins_2.'
		</tr>
	</table>
</body>
</html>';?>