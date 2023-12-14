<?php
$template_body = '<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Customised offers for you</title>
</head>
<body style="margin: auto;background: #fff8f3;font-family: Calibri, Helvetica, sans-serif;line-height: 25px;">
	<table align="center" width="100%" cellpadding="2" cellspacing="0" style="max-width: 690px; margin: 0 auto;line-height: 25px; ">
	<tr>
		<td style="padding:20px 0px;font-family:Calibri, Helvetica, sans-serif; font-size:12px; color:#080808;" align="center"><td style="padding:20px 0px;font-family:Calibri, Helvetica, sans-serif; font-size:12px; color:#080808;" align="center">Customised offers for you</td>	</td>
	</tr>
	</table>

	<table cellpadding="0" cellspacing="0" style="border: 1px solid #000000;max-width: 690px;min-width:320px;text-align: center;margin: auto;background: #ffffff;border-spacing: 0px;line-height: 25px; ">
		<tr>
	        <td width="80%" style="width:80%; padding:15px 0 10px 20px;" align="left">
				<img src="https://dpja4fdtwlj2f.cloudfront.net/logo.png" border="0" width="185" alt="MyLoanCare.in" title="MyLoanCare.in"></td>
	        <td width="20%" style="width:20%; padding:15px 20px 10px 10px; text-align:right !important;" align="right"></td>
	      </tr>
	      
		<tr>
            <td colspan="3" style="line-height: 0; border-top:1px solid #d8d8d8; font-size: 0;" bgcolor="#ffffff" height="1">&nbsp;</td>
		</tr>
		<tr>
            <td colspan="3" style="line-height: 0; border-top:1px solid #d8d8d8; font-size: 0;" bgcolor="#ffffff" height="1">&nbsp;</td>
        </tr>
		<tr>
            <td align="left" colspan="2" style="font-family:Calibri, Helvetica, sans-serif; font-size:19px; color:#002856;  padding: 0px 20px">
				<p><b>Dear Mr./Ms. '.$name.',</b></p>
				<p style="font-size: 18px">Thank you for speaking with MyLoanCare’s officer regarding a <b> Fixed Deposit </b> enquiry of <b> '.custom_money_format($loan_amt).'.</b>
				</p>
				<p style="font-size: 18px">Here are the current fixed deposit offers based on your details.</p>
			</td>
		</tr>
		<tr>
			<td colspan="2" style="padding:0px 10px;font-family: Calibri, Helvetica, sans-serif;">
				<table style="width: 100%;border-spacing: 0px;font-size: 16px;border: 1px solid #dddddd;border-collapse: collapse;color: #18375f;vertical-align: middle; ">
					<tr style="background: #18375f;color: #ffffff;">
						<th style="border:1px solid #dddddd;width: 25%;">Bank/NBFC</th>
						<th style="border:1px solid #dddddd;width: 25%;">Bajaj Finserv</th>
						<th style="border:1px solid #dddddd;width: 25%;">PNB Housing Finance</th>
						<th style="border:1px solid #dddddd;width: 35%;">ICICI Home Finance</th>
					</tr>
				</table>
				<table style="width: 100%;border-spacing: 0px;font-size: 14px;border: 1px solid #dddddd;border-collapse: collapse;color: #18375f;vertical-align: middle;word-break: break-all;border-top: 0px; ">
					<tr>
						<td style="border:1px solid #dddddd;width: 25%;padding-left: 10px; text-align: left;" valign="top"><b>Interest Rates (General)</b></td>
						<td style="border:1px solid #dddddd;width: 25%;" valign="top">'.$bajaj_general_cell.'</td>
						<td style="border:1px solid #dddddd;width: 25%;" valign="top">'.$pnb_general_cell.'</td>
						<td style="border:1px solid #dddddd;width: 25%;" valign="top">'.$icici_general_cell.'</td>
					</tr>
					<tr>
						<td style="border:1px solid #dddddd;width: 25%;padding-left: 10px; text-align: left;" valign="top"><b>Senior Citizen Rates <br> are Higher </br></b></td>
						<td style="border:1px solid #dddddd;width: 25%;" valign="top">'.$bajaj_senior_cell.'</td>
						<td style="border:1px solid #dddddd;width: 25%;" valign="top">'.$pnb_senior_cell.'</td>
						<td style="border:1px solid #dddddd;width: 25%;" valign="top">'.$icici_senior_cell.'</td>
					</tr>
					<tr>
						<td style="border:1px solid #dddddd;width: 25%;padding-left: 10px; text-align: left;" valign="top"><b>Key Features</b></td>
						<td style="border:1px solid #dddddd;width: 25%;" valign="top">'.$bajaj_key_features.'</td>
						<td style="border:1px solid #dddddd;width: 25%;" valign="top">'.$pnb_key_features.'</td>
						<td style="border:1px solid #dddddd;width: 25%;" valign="top">'.$icici_key_features.'</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr><td colspan="2" style="padding:0px 15px; " align="left"><p>Our services are FREE for our customers. Please feel free to write or call your advisor for any assistance that you may require.</p></td></tr>
           <tr>
           <td colspan="2">
              	<table cellspacing="0" cellpadding="0" width="100%" style="">
                    <tr>
	                     <td style="padding:0px 15px; ">
	                      	<table cellspacing="0" cellpadding="0" style="">
		                         <tr>
		                            <td style="padding: 10px 15px;text-align: left;width: 90%;display: inline-block;line-height: 20px">
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
		<tr>
			<td colspan="2"><img src="https://dpja4fdtwlj2f.cloudfront.net/service-strip.jpg" style="width:100%;display: block;" alt="MyLoanCare.in Assurance" title="MyLoanCare.in Assurance"></td>
		</tr>
	</table>
	<table align="center" width="100%" cellpadding="2" cellspacing="0" style="max-width: 650px; margin: 0 auto; ">
        <tbody><tr>
          <td align="center" style="font-size:12px; font-family:Calibri, Helvetica, sans-serif; padding:9px; line-height:20px; color:#080808;">Please add this sender id to your address book to ensure delivery of your loan related mails to your inbox.<br>
MyLoanCare Ventures Pvt Ltd B-38, Sector - 32, Institutional Area, Gurgaon 122003 *T&C Apply<br>
         </td>
        </tr>
      </tbody></table>
</body>
</html>

	';
?>

