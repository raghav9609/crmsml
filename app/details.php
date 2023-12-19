<?php 
require_once "../../include/crm-header.php";
require_once "../../include/helper.functions.php";

$case_id    = base64_decode($_REQUEST['case_id']);
$loan_type  = base64_decode($_REQUEST['loan_type']);
$bank_id    = base64_decode($_REQUEST['bank_id']);

$customers_details_query = mysqli_query($Conn1, "SELECT first_name, last_name, mobile_no, email_id, pan_card, res_address, permanent_address, office_address, middle_name, dob, comp_name, office_email_id, ccwe, previous_job_exp, net_incm, existing_emi, emi_for_pl FROM customer_details_send_to_partner WHERE case_id = '".$case_id."' AND loan_type = '".$loan_type."' AND bank_id = '".$bank_id."' ORDER BY id DESC LIMIT 0, 1 ");
$customers_details_result = mysqli_fetch_array($customers_details_query);
?>
<style>
.f-bold {
    font-weight: bold!important;
}
</style>
<div style="padding-left: 10%;padding-top: 2%;">
    <table class="gridtable" style='margin-left:2%;width:80%;'>
        <tbody>
            <tr><th colspan="2">Customer Details</th></tr>
            <tr>
                <td class="f-bold">Mobile Number :</td>
                <td><?php echo $customers_details_result['mobile_no']; ?></td>
            </tr>
            <tr>
                <td class="f-bold">Mail ID :</td>
                <td><?php echo $customers_details_result['email_id']; ?></td>
            </tr>
            <tr>
                <td class="f-bold">Name :</td>
                <td><?php echo $customers_details_result['first_name']." ".$customers_details_result['last_name']; ?></td>
            </tr>
            <tr>
                <td class="f-bold">DOB :</td>
                <td><?php echo ($customers_details_result['dob'] != "" && $customers_details_result['dob'] != "0000-00-00" && $customers_details_result['dob'] != "1970-01-01") ? date("d-M-Y", strtotime($customers_details_result['dob'])) : ""; ?></td>
            </tr>
            <tr>
                <td class="f-bold">PAN :</td>
                <td><?php echo $customers_details_result['pan_card']; ?></td>
            </tr>
            <tr>
                <td class="f-bold">Residence Address with Landmark :</td>
                <td><?php echo $customers_details_result['res_address']; ?></td>
            </tr>
            <tr>
                <td class="f-bold">Permanent Address with Landmark :</td>
                <td><?php echo $customers_details_result['permanent_address']; ?></td>
            </tr>
            <tr>
                <td class="f-bold">Company Name :</td>
                <td><?php echo $customers_details_result['comp_name']; ?></td>
            </tr>
            <tr>
                <td class="f-bold">Office Address :</td>
                <td><?php echo $customers_details_result['office_address']; ?></td>
            </tr>
            <tr>
                <td class="f-bold">Office Mail ID :</td>
                <td><?php echo $customers_details_result['office_email_id']; ?></td>
            </tr>
            <tr>
                <td class="f-bold">Current Job Exp. :</td>
                <td><?php echo $customers_details_result['ccwe']." months"; ?></td>
            </tr>
            <tr>
                <td class="f-bold">Previous Job Exp. :</td>
                <td><?php echo $customers_details_result['previous_job_exp']." months"; ?></td>
            </tr>
            <tr>
                <td class="f-bold">Net Monthly Income :</td>
                <td><?php echo custom_money_format($customers_details_result['net_incm']); ?></td>
            </tr>
            <tr>
                <td class="f-bold">Existing EMI :</td>
                <td><?php echo custom_money_format($customers_details_result['existing_emi']); ?></td>
            </tr>
            <tr>
                <td class="f-bold">EMI for Existing Personal Loan :</td>
                <td><?php echo custom_money_format($customers_details_result['emi_for_pl']); ?></td>
            </tr>
        </tbody>
    </table>
</div>
<script src="<?php echo $head_url; ?>/include/js/jquery-1.10.2.js" type="text/javascript"></script>