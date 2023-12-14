<?php 
include("crm-insert.php");
$template_body = '<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Disbursement and Cashback</title>
</head>
<body style="margin: auto;background: #ddd;font-family: sans-serif;">
	<table cellpadding="0" cellspacing="0" style="border: 1px solid #008db1;max-width: 600px;min-width:320px;text-align: center;margin: auto;background: #ffffff;border-spacing: 0px">
		<tr><td height="10"></td></tr>
		'.$h_ins.'
		<tr style="background: #f7f7f7">
			<td style="text-align: left;padding: 0px 5%;font-size: 14px">
				<p style="font-size: 15px">Dear '.ucwords(strtolower($salutn_name.' '.$name)).',</p>
				<p>Hope you had a happy experience of availing a loan from MyLoanCare.in. Please remember to claim your Rs. '.$cash_offers_on.' cashback for '.$bank_name.' '.$loan_type_name.' lying in your account. You can opt to take the cash back in the form of Flipkart gift vouchers or as a direct transfer to your bank account.</p>
				<p>Login to your <a href = "http://myloancareindia.com/gbfhgnjhfijnedsfok/go4-link/login/login.php">MLC account </a> to claim the cashback. Do leave your feedback on your experience with us. Please feel free to write to us or call your loan officer for any assistance that you may require.</p>
			</td>
		</tr>
		
   '.$f_ins_team_contact.$f_ins_2.'
	</table>
</body>
</html>'; ?>