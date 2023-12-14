<?php 
include("crm-insert.php");
$template_body = '<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Attractive Cashbacks</title>
	<style type="text/css">
		.table{
			background: #ffffff;width: 290px;font-size: 14px;border: 1px solid #a5a5a5;border-spacing: 0px;border-radius: 5px;text-align: left;display: inline-block;margin: 2%;
		}
	</style>
</head>
<body style="margin: auto;background: #fff8f3;font-family: Calibri, Helvetica, sans-serif;line-height: 25px;">
	<table align="center" width="100%" cellpadding="2" cellspacing="0" style="max-width: 690px; margin: 0 auto;line-height: 25px;">
		<tr>
			<td style="padding:20px 0px;font-family:Calibri, Helvetica, sans-serif; font-size:12px; color:#080808;" align="center"><td style="padding:20px 0px;font-family:Calibri, Helvetica, sans-serif; font-size:12px; color:#080808;" align="center">Attractive Cashbacks</td>	</td>		</tr>
	</table>
	<table cellpadding="0" cellspacing="0" style="border: 1px solid #000000;max-width: 690px;min-width:320px;text-align: center;margin: auto;background: #ffffff;border-spacing: 0px;line-height: 25px">
		'.$h_ins.'
			<td align="left" colspan="2" style="font-family:Calibri, Helvetica, sans-serif; font-size:19px; color:#002856;  padding: 0px 45px">
				<p><b>Dear '.ucwords(strtolower($salutn_name.' '.$name)).',</b></p>
				<p style="font-size: 18px">We tried reaching you regarding your '.$loan_type_name.' enquiry of <b>Rs. '.number_format($loan_amt).'</b> with MyLoanCare.in. You are just a step away from getting the right loan. We have already shortlisted a few offers for you based on your details and eligibility.
				</p>
				<p style="font-size: 18px">Please feel free to call back your loan officer on his number mentioned below or reply to this email to set up a convenient time. Our services are completely FREE for our customers and we offer attractive cashbacks on loan availed through us.</p>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<table style="width: 100%;border-spacing: 0px;">'.$email_table.'</table>
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