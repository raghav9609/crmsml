<?php
 $template_body  = "<table  width ="70%" border="1" style="border-collapse:collapse;">
<tr><td>
<table width="100%" border="1" style="border-collapse:collapse;">
<tr><td width="20%"><img width="95" height="80" style="margin-left:41px;" src="http://creditscore-creditreport.com/mailer-images/logo.png" alt="myloancare"/>
</td>
<td><h3 style="color:#2B2B8A;">Comparison of <span style="color:#E87D24;"><?php echo $loan_type_name;?></span> Rates and Options for you; List of documents attached below</h3></td>
</tr>
<table>
<tr>
<td>Dear <?php echo $salutn_name;?> <?php echo $name;?>,</td>
</tr>
<tr><td><div class="text">It was nice talking to you regarding your <span style="color:#E87D24; font-weight:bold;">Rs. <?php echo number_format($loan_amt);?></span> <?php echo $loan_type_name;?> query with MyLoanCare. We understand that you may need the loan later and not now. Given below are our current offers. When you wish to pursue your loan, simply reply back to this email  or call <span style="color:#E87D24; font-weight:bold;"><?php echo $user_name;?></span> on <span style="color:#E87D24; font-weight:bold;"><?php echo $contact_no;?></span>. Else, you may check the best offer online at <a href="http://creditscore-creditreport.com/gbfhgnjhfijnedsfok/njhiunijhujksdfjlodh/go4home.php">www.myloancare.in</a>. Here is the comparison* of loan offers from India's leading banks for you. </div>

<table border="1" width="100%" style="border-collapse:collapse;">
<tr><th text-align="center">Bank</th>
<th>Interest Rate*</th>
<th>EMI*</th>
<th>Special Offer on Fee</th>
</tr>
<tr>
<td style="text-align:center;"><span style="color:#E87D24;"><b><?php echo $bank_name_tem;?></b></span></td>
<td style="text-align:center;"><?php echo $interest;?>%</td>
<td style="text-align:center;"><b>Rs. <?php echo number_format($emi_final);?></b><br> For<?php echo round($tenr_rate);?> Years</td>
<td style="text-align:center;"><b><span style='text-decoration: line-through;'>Rs. <?php echo number_format($process_fee);?> </span></b><br> <?php echo number_format($proc_fee_final);?> one time</td>
</tr>
<?php }?>
</table>
<tr><td></td></tr>
</td></tr>
<tr><td><div class="text">Avoid applying for loan at multiple places as that may hurt your credit score. In case of any query, please reply to this mail and we will be glad to assist you.</div></td></tr>
<tr><td></td></tr>
<tr><td>Check list of documents required for <?php echo $loan_type_name;?> at <a href="<?php echo $url_doc;?>">Here.</a></td></tr>
<tr><td> <?php include('crm-insert.php');?></td></tr>
</table>
</table>
</td></tr>
</table>";;?>