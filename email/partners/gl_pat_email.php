<?php
if($bk_pat_id == '44'){
$get_src = "<tr><td style='font-family:Calibri;color:blue;font-weight:bold;'>Source: MyLoanCare/ DSAGLNNCR1 &#45; MyLoanCare Ventures Pvt Ltd</td>
          </tr>";
$ext_text  = "<tr><td style='color:blue;font-weight:bold;'>Please capture source/ DSA code as DSAGLNNCR1 in Finone at the time of QDE. Name &#45; MyLoanCare Ventures Pvt Ltd Pvt. Ltd.</td></tr>";
$fs_hdfc_code = "";
}else if($bk_pat_id == '28'){
$get_src = $ext_text  = '';
$fs_hdfc_code = "<div style='color:blue;font-weight:bold;'>IMPORTANT - &#34;Capture DSA code as &#34;324637LGR&#34; (vendor name &#45; MyLoanCare Ventures Pvt Ltd) in Finone at the time of QDE/ Login.&#34;</div>";
}else if($bk_pat_id == '29'){
$get_src = $ext_text  = '';
$fs_hdfc_code = "<div style='color:blue;font-weight:bold;'>IMPORTANT - &#34;Capture DSA code as &#34;DSAGLGUR0040&#34; (vendor name &#45; MyLoanCare Ventures Pvt Ltd) in Finone at the time of QDE/ Login.&#34;</div>";
}else{
$fs_hdfc_code = $get_src = $ext_text ='';

}
$email_template = "<table align='center'  style='border-left:1px solid #838181; border-bottom:1px solid #838181; border-top:1px solid #838181;border-right:1px solid #838181;color:#292929;padding:1%;' width='70%' cellspacing='0' cellpadding='0'>
        <tbody>".$get_src."
          <tr>
             <td style='font-family:Calibri;font-weight:bold;'>Gold Loan Enquiry</td>
          </tr>
           <tr><td style='font-family:Calibri;font-weight:bold;font-size:16px;color:#333;'>Loan Amount: Rs. ".$loan_amt."</td></tr>
            <tr><td style='font-family:Calibri;font-weight:bold;font-size:16px;color:#333;'>Weight of Gold: ".$gold_weight." gms</td></tr>
            <tr><td style='font-family:Calibri;font-weight:bold;font-size:16px;color:#333;'>Purity of Gold: ".$purity_gold." karat</td></tr>
            <tr>
            <td>&nbsp;<td>
            </tr>
          <tr>
            <td><span style='font-family:Calibri;font-weight:bold;font-size:16px;color:#333;'>Dear <span style='color:#D47204;'>".$bank_contact_user_name."</span></td>
          </tr>
              <tr>
            <td style='font-family:Calibri;font-weight:bold;font-size:16px;color:#333;'>Please call <span style='color:#D47204;'>".$name." ".$mname." ".$lname."</span> @ <span style='color:#D47204;'>".$phone."</span> in <span style='color:#D47204;'>".$city_name."</span>. He/She is looking for <span style='color:#D47204;'>Rs. ".$loan_amt."</span> Gold Loan against <span style='color:#D47204;'>".$gold_weight." gms</span> gold of <span style='color:#D47204;'>".$purity_gold." karat</span>. Give ref to his query on MyLoanCare.</td>
          </tr>
          <tr>
          <td style='font-family:Calibri;font-weight:bold;font-size:16px;color:#333;'>In case of any issue, please inform me.</td>
          </tr>
          <tr>
            <td>&nbsp;<td>
            </tr>
	<tr><td style='font-family:Calibri;font-weight:bold;'><strong>".$user_name_asign."(".$user_mobile_asign.")</strong></td></tr>
	<tr><td style='font-family:Calibri;font-weight:bold;'><strong>MyLoanCare</strong></td></tr>".$ext_text."
    </tbody></table><div style='clear:both;'></div>".$fs_hdfc_code;
    ?>