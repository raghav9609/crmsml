<?php 
include("crm-insert.php");
$template_body = '<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Your Cashback on Disbursement</title>
</head>
<body style="margin: auto;background: #fff8f3;font-family: Calibri, Helvetica, sans-serif;line-height: 25px;">
	<table align="center" width="100%" cellpadding="2" cellspacing="0" style="max-width: 690px; margin: 0 auto;line-height: 25px;">
		<tr>
			<td style="padding:20px 0px;font-family:Calibri, Helvetica, sans-serif; font-size:12px; color:#080808;" align="center"><td style="padding:20px 0px;font-family:Calibri, Helvetica, sans-serif; font-size:12px; color:#080808;" align="center">Your Cashback on Disbursement</td>	</td>		</tr>
	</table>
	<table cellpadding="0" cellspacing="0" style="border: 1px solid #000000;max-width: 690px;min-width:320px;text-align: center;margin: auto;background: #ffffff;border-spacing: 0px;line-height: 25px">
	'.$h_ins.'
		<tr>
                                  <td align="left" colspan="2" style="font-family:Calibri, Helvetica, sans-serif; font-size:19px; color:#002856;  padding: 0px 45px">
				<p><b>Dear '.ucwords(strtolower($salutn_name.' '.$name)).',</b></p>
				<p style="font-size: 18px">Congratulations! Your '.$loan_type_name.' has been disbursed through MyLoanCare.in. Kindly share your feedback about your experience with us at <a href="http://www.myloanmail.co.in/gbfhgnjhfijnedsfok/go4-link/login/cashback-login.php" target="_blank" style="color: #008db1;">here</a> and claim your assured cashback of Rs.'.$cash_offers_on.'.
				</p>
				<p style="font-size: 18px">We will keep you posted with news related to your loan rate changes, repo rates, MCLR rates and others and will be happy to serve you again in the future.
				</p>
				<p style="font-size: 18px">We also invite you to our Loyalty Benefits Programme - <i style="text-decoration: underline;">Refer to earn handsome referral bonus</i></p>
			</td>
		</tr>
		<tr>
			<td style="text-align: left;padding: 5px 40px; font-size: 18px" colspan="2">
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
		<tr>
            <td colspan="3" style="line-height: 0; border-top:1px solid #d8d8d8; font-size: 0;" bgcolor="#ffffff" height="1">&nbsp;</td>
          </tr><tr>
            <td colspan="3" style="line-height: 0; border-top:1px solid #d8d8d8; font-size: 0;" bgcolor="#ffffff" height="1">&nbsp;</td>
          </tr>
		'.$f_ins_team_contact.$f_ins_mailer_compaign.'
      </tbody></table>
</body>
</html>'; ?>