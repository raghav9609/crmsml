<?php
include("crm-insert.php");
$template_body = '<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>List of Documents</title>
</head>
<body style="margin: auto;background: #ddd;font-family: sans-serif;">
	<table cellpadding="0" cellspacing="0" style="border: 1px solid #008db1;max-width: 600px;min-width:320px;text-align: center;margin: auto;background: #ffffff;border-spacing: 0px">
		<tr><td height="10"></td></tr>
		'.$h_ins.'
		<tr style="background: #f7f7f7">
			<td style="text-align: left;padding: 0px 5%;font-size: 14px">
				<p style="font-size: 15px">Dear '.ucwords(strtolower($salutn_name.' '.$name)).',</p>

			</td>
		</tr>
	'.$f_ins_team_contact.$f_ins_assurance.$f_ins_services.$f_ins_2.'
		</tr>
	</table>
</body>
</html>'; ?>