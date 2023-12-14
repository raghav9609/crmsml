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
				<p>Dear '.ucwords(strtolower($salutn_name.' '.$name)).',</p>
				<p>We thank you for your interest in '.$loan_type_name.' with MyLoanCare.in. Your advisor will assist you and keep you updated about your loan status.</p>
				<p>Here is the list of documents required for '.$loan_type_name.'.</p>';
 if($loan_type_id == 56){
	$template_body .='<p style="font-size: 15px;font-weight: bold;color: #ed7023">Salaried Documents</p>
				<ul>
					<li>PAN card copy & one photograph for all individuals joining the loan.</li>
					<li>Latest residence address proof (Aadhaar Card/Passport copy/ Voter ID card/ Utility bill) for all individuals joining the loan.( Relationship proof along with declaration can be given for Co-applicants, not having separate address proof).</li>
					<li>Latest 3 months salary slip, increment letter (in case there is any in latest 3 months).</li>
					<li>Copy of Appointment letter, if recently joined in current organization (within 1 year).</li>
					<li>Latest 2 years Form-16 & ITR.</li>
					<li>Latest 6 months bank statement showing 6 salaries credited.</li>
					<li>Detail of all running loans with repayment track record & latest 6 months bank statement from where EMIs are being paid.</li>
				</ul>';
        } if($loan_type_id == 51 || $loan_type_id == 54){
            if($occup_id == 1){
			$template_body .='<p style="font-size: 15px;font-weight: bold;color: #ed7023">Salaried Documents</p>
				<ul>
					<li>Loan application form with 3 passport size photographs for all individuals joining the loan.</li>
					<li>Identity proof such as PAN Card/ Aadhaar Card/Passport copy/ Voter ID card/ Drivers License.</li>
					<li>Latest residence address proof (Aadhaar Card/Passport copy/ Voter ID card/ Utility bill) for all individuals joining the loan.</li>
					<li>Latest 3 months salary slip, increment letter (in case there is any in latest 3 months).</li>
					<li>Latest 2 years Form-16 & ITR.</li>
					<li>Latest 6 months bank statement showing 6 salaries credited.</li>
					<li>Detail of all running loans with repayment track record & latest 6 months bank statement from where EMIs are being paid.</li>
				</ul>';
                    }else {
					$template_body .='<p style="font-size: 15px;font-weight: bold;color: #ed7023">Self Employed Documents</p>
				<ul>
					<li>Loan application form with 3 passport size photographs for all individuals joining the loan.</li>
					<li>Latest residence address proof (Aadhaar Card/Passport copy/ Voter ID card/ Utility bill) for all individuals joining the loan.</li>
					<li>Detail of all running loans with repayment track record & latest 6 months bank statement from where EMIs are being paid.</li>
					<li>Latest 3 years ITR and 6 months bank statement.</li>
					<li>Balance Sheet & Profit & Loss account for last 3 years</li>
					<li>Business License Details (or equivalent)</li>
					<li>TDS Certificate (Form 16A, if applicable)</li>
					<li>Certificate of qualification (for C.A./ Doctor and other professionals)</li>
				</ul>';
				}



			$template_body .='<p style="font-size: 15px;font-weight: bold;color: #ed7023">Property Documents</p>
				<ul>
					<li>Permission for construction (where applicable)</li>
					<li>Registered Agreement for Sale (only for Maharashtra)/Allotment Letter/Stamped Agreement for Sale</li>
					<li>Occupancy Certificate (in case of ready to move property)</li>
					<li>Share Certificate (only for Maharashtra), Maintenance Bill, Electricity Bill, Property Tax Receipt</li>
					<li>Approved Plan copy (Xerox Blueprint) & Registered Development Agreement of the builder, Conveyance Deed (For New Property)</li>
					<li>Payment Receipts or bank A/C statement showing all the payments made to Builder/Seller</li>

				</ul>';
				 }
				 if($loan_type_id == 57){
					if($occup_id == 2){
						$template_body .= '<p>List of Documents for Self Employed Professionals</p>
					 <ul>
					 <li>One passport size photo of applicant & co-applicant.</li>
					 <li>Clear copy of PAN Card and Aadhaar Card of applicant & co-applicant.</li>
					 <li>Office and residence address proof.</li>
					 <li>Registration of degree.</li>
					 <li>Professional degree copy.</li>
					 <li>Last 12 month current A/c, or CC A/c or saving A/c bank statement.</li>
					 <li>Last 3 Yr complete Financial.</li>					 
					 </ul>';
					}
            else{
			$template_body .='<p style="font-size: 15px;font-weight: bold;color: #ed7023">List of Document for Proprietor</p>
				<ul>
					<li>One Passport size photo of Applicant.</li>
					<li>Clear copy of PAN Card and Voter ID/Passport of Applicant & Co-applicant.</li>
					<li>Office and Residence Address Proof.</li>
					<li>Registration of firm.</li>
					<li>Last 6 Month Current A/c, CC A/c and Saving A/c Bank Statement.</li>
					<li>All Rent Agreement with 6 month rent credit in A/c.(if any).</li>
					<li>Last 3 year ITR with Complete Financial of Firm. (From 3cb, 3cd, Audit Report, P&L A/c, Balance Sheet, and All Annexure.</li>
					<li>All Running Loan Schedule/Sanction Latter.</li>

				</ul>'; 
                
			$template_body .= '<p style="font-size: 15px;font-weight: bold;color: #ed7023">List of Document for Partnership firm</p>
				<ul>
					<li>One Passport size photo of Firm and All Partners.</li>
					<li>Clear copy of PAN Card and Voter ID/Passport of Firm and All Partners.</li>
					<li>Office and Residence Address Proof of Firm and All Partner.</li>
					<li>Registration of firm.</li>
					<li>Partnership Deed(All).</li>
					<li>List of Partners as on date with shareholding on latter head.</li>
					<li>Last 6 Month Current A/c, CC A/c and Saving A/c Bank Statement of Firm and All Partner.</li>
					<li>All Rent Agreement with 6 month rent credit in A/c.(if any).</li>
					<li>Last 3 year ITR with Complete Financial of Firm. (From 3cb, 3cd, Audit Report, P&L A/c, Balance Sheet, and All annexure of Firm and All Partner.</li>
					<li>All Running Loan Schedule./Sanction Latter of Firm and All Partner.</li>
					<li>Last 6 month Vat return.</li>

				</ul>

				<p style="font-size: 15px;font-weight: bold;color: #ed7023">List of Document for Pvt. Ltd.</p>
				<ul>
					<li>One Passport size photo of Company and all Directors.</li>
					<li>Clear copy of Pan Card and Voter ID/Passport of Applicant & Co-applicant of Company and all Directors.</li>
					<li>Office and Residence Address Proof of Company and all Directors.</li>
					<li>Registration of Company.</li>
					<li>MOA.</li>
					<li>List of Directors Shareholding as on date on latter head.</li>
					<li>Last 6 Month Current A/c, CC A/c and Saving A/c Bank Statement of Company and all Directors.</li>
					<li>All Rent Agreement With 6 Month Rent Credit in A/c.(if any).</li>
					<li>Last 3 year ITR with Complete Financial of Company. (From 3cb, 3cd, Audit Report, P&L A/c, Balance Sheet, and All annexure of Company and all Directors.</li>
					<li>All Running Loan Schedule/Sanction Latter of Company and all Directors.</li>

				</ul>
				<p style="font-size: 15px;font-weight: bold;color: #ed7023">List of documents for Lendingkart</p>
				<ul>
					<li>Business Registration Proof (GST/VAT/ TIN No.)</li>
					<li>1 Year bank statement of current account</li>
					<li>PAN Card</li>
					<li>Aadhaar Card</li>
					<li>1 Passport size photograph</li>
				</ul>';
				}
				 }
				 if($loan_type_id == 63){
					$template_body .= '<p>List of Documents for Self Employed Professionals</p>
				 <ul>
				 <li>One passport size photo of applicant & co-applicant.</li>
				 <li>Clear copy of PAN Card and Aadhaar Card of applicant & co-applicant.</li>
				 <li>Office and residence address proof.</li>
				 <li>Registration of degree.</li>
				 <li>Professional degree copy.</li>
				 <li>Last 12 month current A/c, or CC A/c or saving A/c bank statement.</li>
				 <li>Last 3 Yr complete Financial.</li>					 
				 </ul>';
				}
				if($loan_type_id == 60){
			$template_body .='<ul>
					<li>PAN card & 2 photographs.</li>
					<li>Current residence address proof (Aadhaar Card/Passport copy/ Voter ID card/ Utility bill).</li>
					<li>Bank statement of 2 months.</li>
					<li>3 cancel cheques required if saving account is in different bank.</li>
				</ul>';
				}
				if($loan_type_id == 71){
				    if($occup_id == 1){
				$template_body .='<p style="font-size: 15px;font-weight: bold;color: #ed7023">Salaried Documents</p>
				<ul>
					<li>PAN card copy, Aadhaar Card & 2 photographs.</li>
					<li>Latest residence address proof (Rent Agreement/Aadhaar Card/Passport Copy/ Voter ID Card/Postpaid Bill/Company letter head if company provided accommodation).</li>
					<li>Latest 3 months salary slip and 6 months bank statement.</li>
				</ul>';
				    }else {
				$template_body .='<p style="font-size: 15px;font-weight: bold;color: #ed7023">Self Employed Documents</p>
				<ul>
					<li>PAN card copy, Aadhaar Card & 2 photographs.</li>
					<li>Latest residence address proof (Rent Agreement/Aadhaar Card/Passport Copy/ Voter ID Card/Postpaid Bill/Company letter head if company provided accommodation).</li>
					<li>Latest 3 years ITR.</li>
					<li>Latest 6 months bank statement.</li>
				</ul>';
				}
				$template_body .='<p style="font-size: 15px;font-weight: bold;color: #ed7023">Card to Card Sourcing</p>
				<ul>
					<li>PAN card copy, Aadhaar Card & 2 photographs.</li>
					<li>Latest residence address proof (Rent Agreement/Aadhaar Card/Passport Copy/ Voter ID Card/Postpaid Bill/Company letter head if company provided accommodation).</li>
                    <li>Front copy of existing credit card and latest statement of credit card.</li>
                    <li>Pencil impression of existing credit card.</li>

				</ul>';
				}

$template_body .= '</td>
		</tr>
		'.$f_ins_team_contact.$f_ins_assurance.$f_ins_services.$f_ins_2.'
	</table>
</body>
</html>'; ?>