<?php 


$app_query = mysqli_query($Conn1,"select * from tbl_mint_app where app_id ='".$app_id."'");
$result_app_query = mysqli_fetch_array($app_query);
$app_bnk_id = $result_app_query['app_bank_on'];
$bnk_appl_no = $result_app_query['bank_app_no_on'];
if($bnk_appl_no != ""){
$bnk_appl_no = "application no. ".$bnk_appl_no ;
} 

$bnk_query = mysqli_query($Conn1,"select * from tbl_bank where bank_id = '".$app_bnk_id."'");
$result_bnk_qry = mysqli_fetch_array($bnk_query);
$application_bank = $result_bnk_qry['bank_name'];

$cash_query = mysqli_query($Conn1,"select * from tbl_cash_bonanza where app_id = '".$app_id."'");
$result_cash_qry = mysqli_fetch_array($cash_query);
$vou_type = $result_cash_qry['sent_voucher_type'];
$vou_amt = $result_cash_qry['sent_voucher_amt'];
$neft_date = $result_cash_qry['neft_date'];
$cust_bnk= $result_cash_qry['vou_bank_name'];

$bnk_cust_query = mysqli_query($Conn1,"select * from tbl_bank where bank_id = '".$cust_bnk."'");
$result_bnk_cst_qry = mysqli_fetch_array($bnk_cust_query);
$vou_bnk = $result_bnk_cst_qry['bank_name'];



if($vou_type == 1){
$head_msg = "<span style='color:#ff6600;'>Flipkart Voucher</span> sent to your email id";
$msg = "<span style='color:#ff6600;'>Flipkart Voucher</span> has been sent to your email id <span style='color:#ff6600;'>".$c_email."</span>";
}
else if($vou_type == 2){
$head_msg = "<span style='color:#ff6600;'>Cash Back</span> has been credited to your account with ".$vou_bnk;
$msg = "<span style='color:#ff6600;'>Cashback</span> has been sent to you by NEFT on <span style='color:#ff6600;'>".$neft_date."</span> and should appear as credit from 'My Finance Care Advisors Pvt Ltd'";
}
$template_body = "<table width='780' border='0' cellpadding='0' cellspacing='0' style='border: 1px #949494 solid' align='center'>

  <tr>
            <td valign='top'><table width='100%' border='0' style='border-bottom: 1px #949494 solid;'>
              <tr>
                <td width='21%' height='128'><img src='https://myloancareindia.com/mailer-images/logo.png' width='136' height='126' alt='myloancare' title='myloancare' align='left' border='0' /></td>
                <td width='79%' valign='top' style='padding:10px 10px 5px 10px;line-height:22px;'>
            <div style='padding:0; margin:0; font-family:Calibri;color:#1E4D7D;font-size:20px;line-height:32px;font-weight:bold;'><strong>Thank You for your feedback.<span style='color:#ff6600;'> Rs. ".$vou_amt."/- </span> ".$head_msg." and another<span style='color:#ff6600;'> Rs. 500/- </span>voucher is waiting for you</strong></div>
        </td></tr></table></td>
  </tr>
     <tr>
         <td><span style='font-family:Calibri;font-weight:bold;text-shadow:1px 1px #CCC;font-size:16px;color:#333;'>Dear ".$salutn_name."  ".$name.",</span></td>
    </tr>
    
    <tr>
     <td  valign='top' style='font-family:calibri;padding:10px 10px 5px 10px;line-height:22px;'><strong>Thank you for your feedback regarding ".$application_bank." ".$loan_type." ".$bnk_appl_no." availed through India's leading online loans marketplace <a href='https://myloancareindia.com/gbfhgnjhfijnedsfok/njhiunijhujksdfjlodh/go4home.php'>www.myloancare.in</a>. This will help other loan borrowers make more informed decisions and help us improve our services. </strong></span></td>
    </tr>
    <tr>
      <td  valign='top' style='font-family:calibri;padding:10px 10px 5px 10px;line-height:22px;'><strong>Your <span style='color:#ff6600;'>Rs. ".$vou_amt."/-</span> ".$msg.". Please check your account and confirm credit.</strong></td>
    </tr>
    <tr>
      <td  valign='top' style='font-family:calibri;padding:10px 10px 5px 10px;line-height:22px;'><strong>Now, refer a friend looking for a loan and win a <span style='color:#ff6600;'>Rs. 500/- Flipkart e-cash voucher</span> of first disbursement of your friend’s loan. To refer send a mail to<a href='mailto:care@myloancare.in'> care@myloancare.in </a> with your friend’s details.

</strong></td>
    </tr>
    <tr>
      <td  valign='top' style='padding:10px 10px 5px 10px;line-height:22px;'><span style='padding:0; margin:0; font-family:Calibri;font-size:15px;line-height:22px;'> From Sun soaked beaches in Goa to the Himalayas in Guwahati, from tech valley in Bangalore to business hubs in Delhi and Coimbatore, from business-focused Ahmedabad to weekend-focused Gurgaon – we are changing the way people choose and avail loans in India.</span></td>
    </tr>
    <tr>
        <td  valign='top'>&nbsp;
        </td>
    </tr>
   	<tr><td  valign='top'><strong>Best Regards,</strong></td></tr>
	<tr><td  valign='top'><strong>MyLoanCare Customer Care - 0124 4603660/ <a href='mailto:care@myloancare.in'>care@myloancare.in</a></strong></td></tr>
	 <tr><td  valign='top'><strong>Loan Officer -&nbsp;<span style='color:#ff6600;'>".$user."</span></strong></td></tr>
	 <tr><td  valign='top'><strong>Loan Officer Contact No -&nbsp;<span style='color:#ff6600;'>".$contact_no."</span></strong></td></tr>
    <tr>
        <td  valign='top' style='padding:10px 10px 5px 5px;'>
            <p style='padding:0; margin:0; font-family:Calibri;font-weight:bold;font-size:15px;'> <span style='color:#E87D24;'>Kuchh Baat Aapke Interest Ki</span></p>
        </td>
    </tr>
    <tr>
        <td  valign='top'><div style='font-family:Arial;font-size:11px; text-align:justify; color:#767676;padding:0px 10px 0px 10px'>MyLoanCare Ventures Pvt Ltd., or https://www.myloancare.in/ is a bank neutral channel partner of banks in India and not a lender. Myloancare does not represent any government, government body, regulator, bank, lender or credit information bureau. Information presented is based on perusal of public sources, is not and should not be construed as an offer or solicitation or invitation to borrow or lend. The Company does not assure as to the correctness of information, FAQ&rsquo;s, graphics, images, text, and/ or various tools and calculators (together called &ldquo;Information&rdquo;). The loan information shown above is indicative and current as of date to the best of our knowledge. Actual terms offered to a customer for loan may be different and may depend upon multiple evaluation factors of each bank/ lender. Loans granted at sole discretion of the respective bank.</div></td>
    </tr>
    <tr>
        <td valign='top' >&nbsp;</td>
      </tr>
    
    </table>";?>

 