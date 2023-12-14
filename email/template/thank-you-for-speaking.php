<?php
$level_id_type = "";
$level_src = "";

if($case_id != "") {
    $level_id_type = base64_encode(2);
    $level_src = base64_encode($case_id);
} else if($query_id != '') {
    $level_id_type = base64_encode(1);
    $level_src = base64_encode($query_id);
}

$template_body = "
<table align='center' width='100%' cellpadding='2' cellspacing='0' style='max-width: 690px; margin: 0 auto;line-height: 25px;'>
    <tr>
        <td style='padding:20px 0px;font-family:Calibri, Helvetica, sans-serif; font-size:12px; color:#080808;' align='center'></td>
    </tr>
</table>
<table cellpadding='0' cellspacing='0' style='border: 0px solid #000000; max-width: 690px; min-width:320px; text-align: center; margin: auto; background: #f3f3f3; border-spacing: 0px; line-height: 25px'>
    <tr>
        <td width='70%' style='width:70%; padding:15px 0 10px 20px; text-align:left;'>
            <img src='https://mailer-img.myloancare.co/logo.png' border='0' width='185' alt='MyLoanCare.in' title='MyLoanCare.in'>
        </td>
        <td width='30%' style='width:30%; padding:15px 20px 10px 10px; text-align:right !important;text-align: right;'>
            <a href='' style='font-size: 13px;font-weight: 600;color: #18375f;'></a>
        </td>
    </tr>

    <tr>
        <td colspan='3' style='line-height: 0; border-top:1px solid #d8d8d8; font-size: 0; background-color='#ffffff' height='1'>&nbsp;</td>
    </tr>

    <tr>
        <td colspan='2' style='text-align: left;font-family:Calibri, Helvetica, sans-serif; font-size:19px; padding: 0px 11px'>
            <div style='background-color: #fff;margin-top: .6rem; border-radius: 5px;overflow: hidden; box-shadow: 0px 0px 0px 2px rgba(0, 0, 0, .03); margin-bottom: .7rem;'>
                <div style='background-color: #ffffff;color: #000000; padding: 0px 20px;'>
                    <p>Dear <b> ".$name." ,</b></p>
                    <p style='font-size: 16px'>Thank you for speaking with MyLoanCare`s loan officer regarding a <b>".$loan_type_name."</b> enquiry of <b>Rs. ".$loan_amt."</b>. We need few more details to process your <b>".$loan_type_name."</b> application.</p><p style='font-size: 16px'>Please share additional details to process it at the earliest.</p>

                    <p style='font-weight: bold'><a href='".$api_head_url."apply/customer-details.php?type_id=".$level_id_type."&src_id=".$level_src."'>Please Fill the Details</a></p>

                </div>
                <div style='background-color: #fff;color: #030303; padding: 0px 20px;'>
                    <p style='font-size: 16px; margin-bottom: 0px;'>Our services are FREE for our customers. Please feel free to write or call your advisor for any assistance that you may require.</p>
                    <table cellspacing='0' cellpadding='0' width='100%'>
                        <tr>
                            <td style='padding: 10px 0px;text-align: left;width: 90%;display: inline-block;line-height: 20px'>
                                <b style='color:#000000; font-size: 15px;'>Best Regards,</b><br>
                                <b style='color:#000000; font-size: 15px;'>MyLoanCare.in Team</b><br>
                                <b style='color:#000000; font-size: 15px;'>Contact No : +91-8448389600 </b>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </td>
    </tr>
    <tr>
        <td colspan='2' style='padding: 0px 11px;'><table width='100%' cellpadding='2' cellspacing='0' style='text-align: center;background-color: transparent;margin-top: .1rem;border-radius: 5px; overflow: hidden;box-shadow: 0px 0px 0px 0px rgba(0, 0, 0, .03);;margin-bottom: 0rem;'>
            <tbody>
                <tr>
                    <td style='font-size:12px; font-family:Calibri, Helvetica, sans-serif; padding:9px; line-height:16px; color:##030303;text-align: center;'>Please add this sender id to your address book to ensure delivery of your loan related mails to your inbox.<br> MyLoanCare Ventures Pvt Ltd B-38, Sector - 32, Institutional Area, Gurgaon 122003 *T&C Apply<br> <a href=;https://www.myloancare.in/email-unsubscribe/?access_token=var9' > Click Here to unsubscribe from the mailer. </a></td>
                </tr>
            </tbody>
        </td>
    </tr>
</table>";?>