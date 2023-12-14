<?php 
include("crm-insert.php");
$template_body = '<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>WE TRIED REACHING YOU</title>
</head>
<body style="margin: auto;background: #ddd;font-family: sans-serif;">
	<table cellpadding="0" cellspacing="0" style="border: 1px solid #008db1;max-width: 600px;min-width:320px;text-align: center;margin: auto;background: #ffffff;border-spacing: 0px">
		<tr><td height="10"></td></tr>
		'.$h_ins.'
		<tr style="background: #f7f7f7">
			<td style="text-align: left;padding: 0px 5%;font-size: 15px">
				<p>Dear '.ucwords(strtolower($salutn_name.' '.$name)).',</p>
				<p style="font-size: 14px">We tried reaching you regarding your '.$loan_type_name.' enquiry of <b>Rs. '.number_format($loan_amt).'</b> with MyLoanCare.in. You are just a step away from getting the right loan. We have already shortlisted a few offers for you based on your details and eligibility.
				</p>
				<p style="font-size: 14px">Please feel free to call back your loan officer on his number mentioned below or reply to this email to set up a convenient time. Our services are completely FREE for our customers and we offer attractive cashbacks on loan availed through us.</p>
			</td>
		</tr>
		<tr style="background: #f7f7f7">
			<td colspan="2">
				<table style="width: 100%;border-spacing: 0px;">
				'.$email_table.'
				</table>
			</td>
		</tr>
		
	    '.$f_ins_team_contact.$f_ins_assurance.$f_ins_2.'
		
	</table>
</body>
</html>'; ?>