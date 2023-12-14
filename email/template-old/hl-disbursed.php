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
				<p>Congratulations! Your '.$loan_type_name.' has been disbursed through MyLoanCare.in. Kindly share your feedback about your experience with us <a href="http://www.myloanmail.co.in/gbfhgnjhfijnedsfok/go4-link/login/cashback-login.php" target="_blank" style="color: #008db1;">here</a> and claim your assured cashback of Rs.'.$cash_offers_on.'.
				</p>
				<p>We will keep you posted with news related to your loan rate changes, repo rates, MCLR rates and others and will be happy to serve you again in the future.
				</p>
				<p>We also invite you to our Loyalty Benefits Programme - <i style="text-decoration: underline;">Refer to earn handsome referral bonus</i></p>
			</td>
		</tr>
		<tr style="background: #f7f7f7">
			<td style="text-align: left;padding: 5px 15px;font-size: 14px">
				<p><b style="color: #ec6c03">How to refer your friends looking for loans to MyLoanCare.in?</b></p>
				<ul>
					<li>All existing customers of MyLoanCare.in can refer their friends and colleagues seeking a loan.</li>
				</ul>
				<p><b style="color: #ec6c03">What rewards will you get for referring leads?</b></p>
				<ul>
					<li>You would be eligible to receive referral bonus from MyLoanCare.in for each disbursed loan as per slabs applicable from time to time.</li>
				</ul>
				<p><b style="color: #ec6c03">Who can refer leads to MyLoanCare.in?</b></p>
				<ul>
					<li>Customers who would like to help their friends and colleagues looking for home loan, personal loan, gold loan, business loan, loan against property and credit card.</li>
				</ul>
				<p>To be eligible, the person must be a resident Indian citizen of at least 18 years of age and hold a valid PAN and address proof.</p>
			</td>
		</tr>
   '.$f_ins_team_contact.$f_ins_2.'
	</table>
</body>
</html>'; ?>