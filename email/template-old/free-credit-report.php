<?php
include("crm-insert.php");
$template_body = '<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>THANK YOU CREDIT REPORT</title>
</head>
<body style="margin: auto;background: #ddd;font-family: sans-serif;">
	<table cellpadding="0" cellspacing="0" style="border: 1px solid #008db1;max-width: 600px;min-width:320px;text-align: center;margin: auto;background: #ffffff;border-spacing: 0px">
		<tr><td height="10"></td></tr>
		'.$h_ins.'
		<tr style="background: #f7f7f7">
			<td style="text-align: left;padding: 0px 5%;font-size: 14px">
				<p style="font-size: 15px">Dear '.ucwords(strtolower($salutn_name.' '.$name)).',</p>
				<p>Thanks for choosing MyLoanCare.in. Your free credit report made available by us has been generated and is available at the link below.
				</p>
				<p>Financial experts recommend tracking one’s credit score regularly. You can check your free credit score every month, by simply logging in your customer account at MyLoanCare.in
				</p>
				<p style="text-align: center;"><a href="https://www.myloancareindia.com/gbfhgnjhfijnedsfok/njhiunijhujksdfjlodh/go4cscore.php" target="_blank" style="color:#ffffff;display: inline-block;background: #ed7023;border-bottom:3px solid #964716;border-radius: 100px;padding: 8px 20px;text-decoration: none;font-weight: bold">View Credit Report</a></p>
				<p>You could also read a detailed analysis of your credit report and get advice from our experts on opportunities to save interest and get new loan at attractive rates.
				</p>
				
			</td>
		</tr>
		<tr style="background: #f7f7f7">
			<td style="text-align: left;padding: 0px 5%;font-size: 14px">
			&nbsp;
			</td>
		</tr>
     '.$f_ins_contact.$f_ins_services.$f_ins_2.'

	</table>
</body>
</html>'; ?>