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
            <td align="left" colspan="2" style="font-family:Calibri, Helvetica, sans-serif; font-size:19px; color:#002856;  padding: 0px 45px">
				<p><b>Dear '.ucwords(strtolower($salutn_name.' '.$name)).',</b></p>
				<p style="font-size: 18px">Hope you had a happy experience of availing a loan from MyLoanCare.in. Please remember to claim your Rs. '.$cash_offers_on.' cashback for '.$loan_type_name.' lying in your account. You can opt to take the cash back in the form of Flipkart gift vouchers or as a direct transfer to your bank account.</p>
				<p style="font-size: 18px">Login to your <a href="https://www.myloancareindia.com/gbfhgnjhfijnedsfok/go4-link/login/login.php" target="_blank" style="color: #008db1;">MLC account</a> to claim the cashback. Do leave your feedback on your experience with us. Please feel free to write to us or call your loan officer for any assistance that you may require.
				</p>
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