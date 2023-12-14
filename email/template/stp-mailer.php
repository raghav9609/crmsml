
<?php 
 if($loan_amt > 0){$mailer_loan_amt =  "of Rs. ".custom_money_format($loan_amt,0);}
$stp_template = '<!DOCTYPE html>
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body style="margin: auto;background: #fff8f3;font-family: Calibri, Helvetica, sans-serif;line-height: 25px;">
	<table cellpadding="0" cellspacing="0"
		style="border: 0px solid #000000;max-width: 690px;min-width:320px;text-align: center;margin: auto;background: #f3f3f3;border-spacing: 0px;line-height: 25px">
		<tr>
			<td width="70%" style="width:70%; padding:15px 0 10px 20px;" align="left">
				<img src="https://dpja4fdtwlj2f.cloudfront.net/logo.png" border="0" width="185" alt="MyLoanCare.in"
					title="MyLoanCare.in"></td>
			<td width="30%" style="width:30%; padding:15px 20px 10px 10px; text-align:right !important;" align="right">
				<a href="" style="font-size: 13px;font-weight: 600;color: #18375f;"></a></td>
		</tr>

		<tr>
			<td colspan="3" style="line-height: 0; border-top:1px solid #d8d8d8; font-size: 0;" bgcolor="#ffffff"
				height="1">&nbsp;</td>
		</tr>

		<tr>
			<td align="left" colspan="2"
				style="font-family:Calibri, Helvetica, sans-serif; font-size:19px; padding: 0px 11px">
				<div
					style="background-color: #fff;margin-top: .6rem; border-radius: 5px;overflow: hidden; box-shadow: 0px 0px 0px 2px rgba(0, 0, 0, .03); margin-bottom: .6rem;">
					<div style="background-color: #2b478b;color: #ffffff; padding: 15px;">
						<p style="margin-top: 0px;"><b>Dear '.ucwords(strtolower($result_get_qry['name'])).' ,</b></p>
						<p style="font-size: 18px; margin-bottom: 0px;">Your <b>'.$loan_name.'</b> application has been
							successfully submitted to <b>'.$result_fil_part['bank_name'].'</b> as per below details.</p>
					</div>

					<div style="background-color: #fff;color: #030303; padding: 15px;">
						<table style="width: 100%;border-spacing: 0px;font-size: 14px;border: 1px solid #030303;border-collapse: collapse;color: #030303;vertical-align: middle;word-break: break-all;border-top: 0px;">
							<tr>
								<td style="border:1px solid #dddddd; width: 25%; text-align:left; padding-left: 15px;">
									'.$result_fil_part['bank_name'].' CRM Id</td>
								<td style="border:1px solid #dddddd; width: 25%; text-align:left; padding-left: 15px;">
									'.$bank_crm_id_app.'</td>
							</tr>
							<tr>
								<td style="border:1px solid #dddddd; width: 25%; text-align:left; padding-left: 15px;">
									MyLoanCare Tracking Id</td>
								<td style="border:1px solid #dddddd; width: 25%; text-align:left; padding-left: 15px;">
									'.$app_id.'</td>
							</tr>
							<tr>
								<td colspan="2"
									style="border:1px solid #dddddd; width: 25%; text-align:left; padding-left: 15px;color:#fff;background-color:#2b478b;">
									<b>Details of your application</b></td>
							</tr>

							<tr>
								<td style="border:1px solid #dddddd; width: 25%; text-align:left; padding-left: 15px;">
									Name</td>
								<td style="border:1px solid #dddddd; width: 25%; text-align:left; padding-left: 15px;">
									'.ucwords(strtolower($result_get_qry['name'])).'</td>
							</tr>
							<tr>
								<td style="border:1px solid #dddddd; width: 25%; text-align:left; padding-left: 15px;">
									Place of Residence</td>
								<td style="border:1px solid #dddddd; width: 25%; text-align:left; padding-left: 15px;">
									'.$city_name.'</td>
							</tr>
							<tr>
								<td style="border:1px solid #dddddd; width: 25%; text-align:left; padding-left: 15px;">
									Applied for</td>
								<td style="border:1px solid #dddddd; width: 25%; text-align:left; padding-left: 15px;">
									'.$loan_name.' '.$mailer_loan_amt.'</td>
							</tr>
							<tr>
								<td style="border:1px solid #dddddd; width: 25%; text-align:left; padding-left: 15px;">
									Submitted On </td>
								<td style="border:1px solid #dddddd; width: 25%; text-align:left; padding-left: 15px;">
									'.date("d-m-Y").'</td>
							</tr>
						</table>
						
						<table cellspacing="0" cellpadding="0" width="100%">
							<tr>
								<td style="padding:0px; ">
									<table cellspacing="0" cellpadding="0" style="width: 100%;">
										<tr>
											<td colspan="2">
												<table cellspacing="0" cellpadding="0" width="100%">
													<tr>
														<td style="padding:0px 5px; ">
															<table cellspacing="0" cellpadding="0">
																<tr>
																	<td style="padding: 10px 0px;text-align: left;width: 100%;display: inline-block;line-height: 20px">
																		<tr>
																			<td colspan="2" style="width: 100%;border-spacing: 0px;font-size: 16px;border-collapse: collapse;color: #030303;vertical-align: middle; " align="left"><p style="margin-top: 0px;"><b>'. $result_fil_part['bank_name'].'</b> sales team in <b>'.$city_name.'</b> will contact you to complete the rest of the process. </p>';
																				 if($user_sms_flag == 1){
																				$stp_template .= '<p><b>MyLoanCare </b> advisor <b>'. $user_name_asign.'</b> <b>'.$user_mobile_asign.'</b> will be available to assist you or answer your queries. </p>';
																			}
																				$stp_template .= '<p>MyLoanCare customer care can be contacted at <a href="mailto:care@myloancare.in">care@myloancare.in</a></p>
																			</td>
																		</tr>
																	</td>
																</tr>
															</table>
														</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
						
						<table cellspacing="0" cellpadding="0" width="100%">
							<tr>
								<td style="padding:0px; ">
									<table cellspacing="0" cellpadding="0" style="width: 100%;">
										<tr>
											<td colspan="2">
												<table cellspacing="0" cellpadding="0" width="100%">
													<tr>
														<td style="padding:0px 5px; ">
															<table cellspacing="0" cellpadding="0">
																<tr>
																	<td
																		style="padding: 10px 0px;text-align: left;width: 100%;display: inline-block;line-height: 20px">
																		<b style="font-size: 15px;">Best
																			Regards,</b><br>
																		<b style="font-size: 15px;">MyLoanCare Team</b><br>
																		<b style="font-size: 15px;">Contact No : +91-8448389600 </b>
																	</td>
																</tr>
															</table>
														</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</td>
		</tr>
		<tr>
			<td colspan="2" style="padding: 0px 11px;">
				<table align="center" width="100%" cellpadding="2" cellspacing="0" style="background-color: transparent;margin-top: .1rem;border-radius: 5px;
				overflow: hidden;box-shadow: 0px 0px 0px 0px rgba(0, 0, 0, .03);;margin-bottom: 0rem;">
					<tbody>
						<tr>
							<td align="center"
								style="font-size:12px; font-family:Calibri, Helvetica, sans-serif; padding:9px; line-height:16px; color:##030303;">
								Please add this sender id to your address book to ensure delivery of your loan related
								mails to your
								inbox.<br> MyLoanCare Ventures Pvt Ltd B-38, Sector - 32, Institutional Area, Gurgaon
								122003 *T&C Apply<br>
								<a href="var2"> Click Here to unsubscribe from the mailer. </a>
							</td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
	</table>
</body>

</html>';
?>