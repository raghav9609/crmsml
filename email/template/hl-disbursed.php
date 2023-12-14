<?php
include("crm-insert.php");
$template_body = '<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Credit Card Documents Mailer</title>
	</head>
	<body style="margin: auto;background: #fff8f3;font-family: Calibri, Helvetica, sans-serif;line-height: 25px;">
		<table align="center" width="100%" cellpadding="2" cellspacing="0" style="max-width: 690px; margin: 0 auto;line-height: 25px;">
			<tr>
				<td style="padding:20px 0px;font-family:Calibri, Helvetica, sans-serif; font-size:12px; color:#080808;" align="center">
					<td style="padding:20px 0px;font-family:Calibri, Helvetica, sans-serif; font-size:12px; color:#080808;" align="center">'.$loan_type_name.' Disbursed</td>	
				</td>		
			</tr>
		</table>
		<table cellpadding="0" cellspacing="0" style="border: 1px solid #000000;max-width: 690px;min-width:320px;text-align: center;margin: auto;background: #ffffff;border-spacing: 0px;line-height: 25px">
			<tr>
				<td width="80%" style="width:80%; padding:15px 0 10px 20px;" align="left">
					<img src="https://dpja4fdtwlj2f.cloudfront.net/logo.png" border="0" width="185" alt="MyLoanCare.in" title="MyLoanCare.in">
				</td>
				<td width="20%" style="width:20%; padding:15px 20px 10px 10px; text-align:right !important;" align="right"></td>
			</tr>
			<tr>
				<td colspan="3" style="line-height: 0; border-top:1px solid #d8d8d8; font-size: 0;" bgcolor="#ffffff" height="1">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="3" style="line-height: 0; border-top:1px solid #d8d8d8; font-size: 0;" bgcolor="#ffffff" height="1">&nbsp;</td>
			</tr>
			<tr>
				<td align="left" colspan="2" style="font-family:Calibri, Helvetica, sans-serif; font-size:19px; color:#002856;  padding: 0px 45px">
					<p><b>Dear '.ucwords(strtolower($salutn_name.' '.$name)).',</b></p>
					<p style="font-size: 18px">Congratulations! Your <b>'.$loan_type_name.'</b> has been disbursed through MyLoanCare.in. Kindly share your feedback about your experience with us <a href="http://www.myloanmail.co.in/gbfhgnjhfijnedsfok/go4-link/login/cashback-login.php" target="_blank" style="color: #008db1;">here</a> and claim your assured cashback of <b>Rs. '.$cash_offers_on.'</b>.
					</p>
					<p style="font-size: 18px">We will keep you posted with news related to rate changes, repo rates, MCLR rates and others and will be happy to serve you again in the future.
					</p>
					<p style="font-size: 18px">We also invite you to our Loyalty Benefits Programme - <i>Refer to earn handsome referral bonus</i></p>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="padding: 10px 25px">
					<table cellspacing="0" cellpadding="0" width="100%">
						<tbody>
							<tr>
								<td>
									<table cellpadding="0" cellspacing="0" width="100%">
										<tbody>
											<tr>
												<td align="left" valign="middle" style="color: #002856; font-family: Calibri, Helvetica, sans-serif; font-size:15px; line-height:20px; font-weight: bold; padding:10px;letter-spacing:0.3px;">
													<div style="background: #d6d6d6;padding: 15px;">
														<p style="color: #ed7023;font-size: 18px;margin: auto;margin-bottom: 8px"><b>How to refer your friends looking for loans to MyLoanCare.in?</b></p>
														<ul style="margin: auto;padding: 0px;list-style: inside;margin-bottom: 15px">
															<li>All existing customers of MyLoanCare.in can refer their friends and colleagues seeking a loan.</li>
														</ul>
														<p style="color: #ed7023;font-size: 18px;margin: auto;margin-bottom: 8px"><b>What rewards will you get for referring leads?</b></p>
														<ul style="margin: auto;padding: 0px;list-style: inside;margin-bottom: 15px">
															<li>You would be eligible to receive referral bonus from MyLoanCare.in for each disbursed loan as per slabs applicable from time to time.</li>
														</ul>
														<p style="color: #ed7023;font-size: 18px;margin: auto;margin-bottom: 8px"><b>Who can refer leads to MyLoanCare.in?</b></p>
														<ul style="margin: auto;padding: 0px;list-style: inside;margin-bottom: 15px">
															<li>Customers who would like to help their friends and colleagues looking for home loan, personal loan, gold loan, business loan and loan against property.</li>
														</ul>
													</div>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
			<tr>
				<td align="left" colspan="2" style="font-family:Calibri, Helvetica, sans-serif; font-size:19px; color:#002856;  padding: 0px 45px">
					<p style="font-size: 16px">To be eligible, the person must be a resident Indian citizen of at least 18 years of age and hold a valid PAN and address proof.</p>
				</td>
			</tr>
			<tr>
				<td colspan="3" style="line-height: 0; border-top:1px solid #d8d8d8; font-size: 0;" bgcolor="#ffffff" height="1">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="3" style="line-height: 0; border-top:1px solid #d8d8d8; font-size: 0;" bgcolor="#ffffff" height="1">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="2">
					<table cellspacing="0" cellpadding="0" width="100%">
						<tr>
							<td style="padding:0px 15px; ">
								<table cellspacing="0" cellpadding="0">
									<tr>
										<td style="padding: 10px 15px;text-align: left;line-height: 20px">
											<b style="font-size: 15px;">Best Regards,</b><br>
											<b style="font-size: 15px;">MyLoanCare.in Team</b><br>
											<b style="font-size: 15px;">Advisor : </b><span>'.$user_name.'</span><br>
											<b style="font-size: 15px;">Contact No : </b><span>'.$contact_no.'</span><br>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<!-- <tr>
			<td colspan="2"><img src="https://dpja4fdtwlj2f.cloudfront.net/mlc-mailer-compaign-footer.jpg" style="width:100%;display: block;" alt="MyLoanCare.in Assurance" title="MyLoanCare.in Assurance"></td>
			</tr> -->
		</table>
		<table align="center" width="100%" cellpadding="2" cellspacing="0" style="max-width: 650px; margin: 0 auto;">
			<tbody>
				<tr>
					<td align="center" style="font-size:12px; font-family:Calibri, Helvetica, sans-serif; padding:9px; line-height:20px; color:#080808;">Please add this sender id to your address book to ensure delivery of your loan related mails to your inbox.<br>
					MyLoanCare Ventures Pvt Ltd B-38, Sector - 32, Institutional Area, Gurgaon 122003 *T&C Apply<br>
					</td>
				</tr>
			</tbody>
		</table>
	</body>
</html>'; ?>