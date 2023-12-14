<?php 
include("crm-insert.php");
$template_body = '<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Cashback Referral Mailer</title>
	
</head>
<body style="margin: auto;background: #fff8f3;font-family: Calibri, Helvetica, sans-serif;line-height: 25px;">
	<table align="center" width="100%" cellpadding="2" cellspacing="0" style="max-width: 690px; margin: 0 auto;line-height: 25px;">
		<tr>
			<td style="padding:20px 0px;font-family:Calibri, Helvetica, sans-serif; font-size:12px; color:#080808;" align="center"><td style="padding:20px 0px;font-family:Calibri, Helvetica, sans-serif; font-size:12px; color:#080808;" align="center">Cashback Referral</td>	</td>		</tr>
	</table>
	<table cellpadding="0" cellspacing="0" style="border: 1px solid #000000;max-width: 690px;min-width:320px;text-align: center;margin: auto;background: #ffffff;border-spacing: 0px;line-height: 25px">
		<tr>
	        <td width="80%" style="width:80%; padding:15px 0 10px 20px;" align="left">
				<img src="https://dpja4fdtwlj2f.cloudfront.net/logo.png" border="0" width="185" alt="MyLoanCare.in" title="MyLoanCare.in"></td>
	        <td width="20%" style="width:20%; padding:15px 20px 10px 10px; text-align:right !important;" align="right"></td>
	      </tr>
	      
		<tr>
                            <td colspan="3" style="line-height: 0; border-top:1px solid #d8d8d8; font-size: 0;" bgcolor="#ffffff" height="1">&nbsp;</td>
                          </tr><tr>
                            <td colspan="3" style="line-height: 0; border-top:1px solid #d8d8d8; font-size: 0;" bgcolor="#ffffff" height="1">&nbsp;</td>
                          </tr>
		<tr>
                                  <td align="left" colspan="2" style="font-family:Calibri, Helvetica, sans-serif; font-size:19px; color:#002856;  padding: 0px 45px">
				<p><b>Dear '.ucwords(strtolower($salutn_name.' '.$name)).',</b></p>
				<p style="font-size: 18px">We are glad to inform that a loan has been disbursed to your reference, '.$ref_name.'. Thanks for sharing the referral.
				</p>
				<p style="font-size: 18px">You are eligible for a cashback under our <b>Refer and Earn</b scheme. You can opt for a bank transfer or get Flipkart Voucher to claim your cashback
				</p>
				<p style="font-size: 18px"><b>For Bank transfer, share the following details at care@myloancare.in</b></p>
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
													<ol style="margin: auto;padding: 0px;padding-left: 20px;">
														<li>Account Number</li>
														<li>IFSC Code</li>
														<li>PAN Number</li>
														<li>Valid Email id</li>
														<li>Registered Mobile Number</li>
														<li>Soft Copy of PAN</li>
														<li>Permanent Address</li>
													</ol>
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
				<p style="font-size: 16px">For Flipkart voucher, share your Email ID at care@myloancare.in.</p>
				<p style="font-size: 16px">We look forward to working closely with you in the future for a rewarding relationship.</p>
				<p style="font-size: 16px">*Terms and Conditions apply.<br></p>
			</td>
		</tr>
		<tr>
                            <td colspan="3" style="line-height: 0; border-top:1px solid #d8d8d8; font-size: 0;" bgcolor="#ffffff" height="1">&nbsp;</td>
                          </tr><tr>
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
			                            <b style="font-size: 15px;">Contact No : </b><span>+91-8448389600</span><br>
			                         </td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
			<tr>
                            <td colspan="3" style="line-height: 0; border-top:1px solid #d8d8d8; font-size: 0;" bgcolor="#ffffff" height="1">&nbsp;</td>
                          </tr><tr>
                            <td colspan="3" style="line-height: 0; border-top:1px solid #d8d8d8; font-size: 0;" bgcolor="#ffffff" height="1">&nbsp;</td>
                          </tr>
        
		<!-- <tr>
			<td colspan="2"><img src="https://dpja4fdtwlj2f.cloudfront.net/mlc-mailer-compaign-footer.jpg" style="width:100%;display: block;" alt="MyLoanCare.in Assurance" title="MyLoanCare.in Assurance"></td>
		</tr> -->
	</table>
	<table align="center" width="100%" cellpadding="2" cellspacing="0" style="max-width: 650px; margin: 0 auto;">
        <tbody><tr>
          <td align="center" style="font-size:12px; font-family:Calibri, Helvetica, sans-serif; padding:9px; line-height:20px; color:#080808;">Please add this sender id to your address book to ensure delivery of your loan related mails to your inbox.<br>
MyLoanCare Ventures Pvt Ltd B-38, Sector - 32, Institutional Area, Gurgaon 122003 *T&C Apply<br>
         </td>
        </tr>
      </tbody></table>
</body>
</html>'; ?>