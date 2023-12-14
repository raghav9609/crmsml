<?php 
include("crm-insert.php");
$template_body = '<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Your Cashback on Referral</title>
</head>
<body style="margin: auto;background: #fff8f3;font-family: Calibri, Helvetica, sans-serif;line-height: 25px;">
	<table align="center" width="100%" cellpadding="2" cellspacing="0" style="max-width: 690px; margin: 0 auto;line-height: 25px;">
		<tr>
			<td style="padding:20px 0px;font-family:Calibri, Helvetica, sans-serif; font-size:12px; color:#080808;" align="center"><td style="padding:20px 0px;font-family:Calibri, Helvetica, sans-serif; font-size:12px; color:#080808;" align="center">Your Cashback on Referral</td>	</td>		</tr>
	</table>
	<table cellpadding="0" cellspacing="0" style="border: 1px solid #000000;max-width: 690px;min-width:320px;text-align: center;margin: auto;background: #ffffff;border-spacing: 0px;line-height: 25px">
		'.$h_ins.'
		<tr><td align="left" colspan="2" style="font-family:Calibri, Helvetica, sans-serif; font-size:19px; color:#002856;  padding: 0px 45px">
				<p><b>Dear '.ucwords(strtolower($salutn_name.' '.$name)).',</b></p>
				<p style="font-size: 18px">Thank you for referring to India’s leading online loans marketplace MyLoanCare.in. Your <span style="color: #ec6c03">Flipkart Voucher of Rs. 500</span> has been sent to your email id '.$email_cust.'.<br>Please check your account and confirm credit. 
				</p>
				<p style="font-size: 18px">Now refer another friend looking for a loan and win <span style="color: #ec6c03">Rs. 500 Flipkart e-cash voucher </span> on disbursement of your friend’s loan.<br>To refer, send a mail to care@myloancare.in with your friend’s details. 
				</p>
			</td>
		</tr>
		<tr><td colspan="3" style="line-height: 0; border-top:1px solid #d8d8d8; font-size: 0;" bgcolor="#ffffff" height="1">&nbsp;</td>
                          </tr><tr>
                            <td colspan="3" style="line-height: 0; border-top:1px solid #d8d8d8; font-size: 0;" bgcolor="#ffffff" height="1">&nbsp;</td>
                          </tr>
                          '.$f_ins_team_contact.$f_ins_mailer_compaign.'
      </tbody></table>
</body>
</html>'; ?>