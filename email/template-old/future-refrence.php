<?php
include("crm-insert.php");
$template_body = '<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Future Prospect</title>
</head>
<body style="margin: auto;background: #ddd;font-family: sans-serif;">
	<table cellpadding="0" cellspacing="0" style="border: 1px solid #008db1;max-width: 600px;min-width:320px;text-align: center;margin: auto;background: #ffffff;border-spacing: 0px">
		<tr><td height="10"></td></tr>
'.$h_ins.'
		<tr style="background: #f7f7f7">
			<td style="text-align: left;padding: 0px 5%;font-size: 15px">
				<p>Dear '.ucwords(strtolower($salutn_name.' '.$name)).',</p>
				<p style="font-size: 14px">It was pleasure speaking with you regarding your <b>Rs. '.number_format($loan_amt).'</b> '.$loan_type_name.'. We understand that you are not looking to take a loan immediately or would want to take the loan from a different bank than our offered bank.<br><br>Please write or call us on <b>'.$contact_no.'</b> for any loan requirements in future. MyLoanCare.in is a FREE of cost service for borrowers. We look forward to working with you in the future.
				</p>
				<p style="font-size: 14px">Here are the current loan offers based on your details and eligibility.</p>
			</td>
		</tr>
		<tr style="background: #f7f7f7">
			<td colspan="2">
				<table style="width: 100%;border-spacing: 0px;">'.$email_table.'</table>
			</td>
		</tr>
		'.$f_ins_team_contact.$f_ins_assurance.$f_ins_services.$f_ins_2.'
		</tr>
	</table>
</body>
</html>'; ?>