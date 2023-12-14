<?php 
include("crm-insert.php");
$template_body = '<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Generic MLC Mail</title>
</head>
<body style="margin: auto;background: #ddd;font-family: Calibri, Helvetica, sans-serif;">
	<table cellpadding="0" cellspacing="0" style="border: 1px solid #008db1;max-width: 600px;min-width:320px;text-align: center;margin: auto;background: #ffffff;border-spacing: 0px;line-height: 20px;margin: 10px auto">
		<tr><td height="10">&nbsp;</td></tr>
	'.$h_ins.'
		<tr style="background: #f7f7f7">
			<td style="text-align: left;padding: 0px 5%;font-size: 15px">
				<p style="font-size: 14px;font-weight: bold;">Dear '.ucwords(strtolower($salutn_name.' '.$name)).',</p>
				<p style="font-size: 16px">Thank you for referring to India’s leading online loans marketplace MyLoanCare.in. Your <span style="color: #ec6c03">Flipkart Voucher of Rs. 500</span> has been sent to your email id '.$email_cust.'.<br>Please check your account and confirm credit. 
				</p><p style="font-size: 16px">Now refer another friend looking for a loan and win <span style="color: #ec6c03">Rs. 500 Flipkart e-cash voucher </span> on disbursement of your friend’s loan.<br>To refer, send a mail to <a href="mailto:care@myloancare.in">care@myloancare.in</a> with your friend’s details.
				</p>
			</td>
		</tr>
		'.$f_ins_team_contact.$f_ins_assurance.$f_ins_services.$f_ins_2.'
		</tr>
	</table>
</body>
</html>'; ?>