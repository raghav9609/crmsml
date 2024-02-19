<?php
$enq_data = array();
$experian_report_query = "SELECT ac_his.experian_history_id, ac_his.history_id, web_status.short AS acc_status, ac_type.description AS account_type, ac_his.Amount_Past_Due AS Amount_Past_Due, ac_his.Subscriber_Name AS Subscriber_Name,ac_his.Open_Date AS Open_Date, ac_his.Current_Balance AS Current_Balance, ac_his.Highest_Credit_or_Original_Loan_Amount AS Credit_Limit_Amount,ac_his.Date_Reported AS Date_Reported, ac_his.AccountHoldertypeCode AS AccountHoldertypeCode, acc_type.description AS account_holder_type FROM `customer_account_report_summary_history` AS ac_his LEFT JOIN experian_expected_on_web_status AS web_status on ac_his.Account_Status = web_status.value LEFT JOIN experian_account_type AS ac_type ON ac_his.Account_Type = ac_type.value LEFT JOIN experian_acc_holder_type_code AS acc_type ON ac_his.AccountHoldertypeCode = acc_type.value WHERE ac_his.experian_history_id = (select max(experian_history_id) FROM customer_cibil_report_summary_history WHERE cust_id = ".$cust_id.") and ac_his.cust_id = ".$cust_id." group by ac_his.history_id";
$get_experian_report = mysqli_query($Conn1, $experian_report_query);
$sr_no = 0;
while($result_experian = mysqli_fetch_array($get_experian_report)) {
++$sr_no;
$experian_history_id = $result_experian['experian_history_id'];
$dpdval = 0;
$pdd = array();
$dpd_query = mysqli_query($Conn1,"SELECT CASE WHEN (Asset_Classification = 'M' OR Asset_Classification = 'D' OR Asset_Classification = 'L' OR Asset_Classification = 'B') THEN 1 ELSE 0 END as total,Days_Past_Due FROM customer_credit_account_history WHERE account_report_id = ".$result_experian['history_id']." order by year desc,month desc limit 3");
while($result_dpd_query = mysqli_fetch_array($dpd_query)){
    $dpdval += $result_dpd_query['total'];
    $pdd[] = $result_dpd_query['Days_Past_Due'];
}
$qry_get_create_date = mysqli_query($Conn1, "SELECT report_created_date from experian_report_pull_history where history_id ='".$experian_history_id."'");
$res_get_create_date = mysqli_fetch_array($qry_get_create_date);
$report_created_date = $res_get_create_date['report_created_date'];
$data[] = "<tr><td class='dstr-td'>".$sr_no."</td><td class='dstr-td'>".ucfirst(strtolower($result_experian['account_type']))."</td><td class='dstr-td'>".$result_experian['account_holder_type']."</td><td class='dstr-td'>".ucfirst(strtolower($result_experian['acc_status']))."</td><td class='dstr-td'>".date("d-m-Y", strtotime($result_experian['Open_Date']))."</td><td class='dstr-td'>".custom_money_format($result_experian['Credit_Limit_Amount'])."</td><td class='dstr-td'>".custom_money_format($result_experian['Current_Balance'])."</td><td class='dstr-td'>".custom_money_format($result_experian['Amount_Past_Due'])."</td><td class='dstr-td'>".$dpdval." (".implode('/ ',$pdd)." )</td><td class='dstr-td'>".date("d-m-Y", strtotime($result_experian['Date_Reported']))."</td></tr>";
}

$qry_get_enquiry_data = mysqli_query($Conn1,"SELECT Subscriber_Name,Date_of_Request,Enquiry_Reason,search_desc from customer_credit_enquiry_report_history as cc_enq_his INNER JOIN experian_search_type as exp_acc ON cc_enq_his.Enquiry_Reason = exp_acc.search_val where experian_history_id='".$experian_history_id."'");

while($res_get_enquiry_data = mysqli_fetch_array($qry_get_enquiry_data)) {	  
$enq_data[] = "<tr><td class='dstr-td'>".$res_get_enquiry_data['Subscriber_Name']."</td><td class='dstr-td'>".date("d-m-Y", strtotime($res_get_enquiry_data['Date_of_Request']))."</td><td class='dstr-td'>".$res_get_enquiry_data['search_desc']."</td></tr>"; 
}

$credit_query = mysqli_query($Conn1,"SELECT count(*) as total_count,GROUP_CONCAT(search.search_desc SEPARATOR '/ ') as banks FROM customer_credit_enquiry_report_history as hist left join experian_search_type as search on hist.Enquiry_Reason = search.search_val WHERE experian_history_id = ".$experian_history_id." and Date_of_Request between DATE_SUB(CURDATE(), INTERVAL 3 MONTH) and CURDATE() group by Subscriber_Name");

$result_credit_enquirey = mysqli_fetch_array($credit_query);
?>
<tr>
    <?php
    $rc_date = "--";
    if(trim($report_created_date) != "" && trim($report_created_date) != "0000-00-00 00:00:00") {
        $rc_date = date("d-m-Y", strtotime($report_created_date));
    }
    ?>
    <?php
    $display_cibil_score = "--";
    if(trim($cibil_score) != "") {
        $display_cibil_score = $cibil_score;
    }
    ?>
    <th colspan='10' class='dstr-td' style='background: #19375f; text-align: center; color: white'>CREDIT REPORT SUMMARY <label style='float: right'><?php echo "SCORE : ".$display_cibil_score; ?> ( <?php echo $rc_date; ?> )</label> </th>
</tr>
<tr>
    <th class='dstr-td' style='background:#b8d1f3;'>Sr. No.</th>
    <th class='dstr-td' style='background:#b8d1f3;'>Account type</th>
    <th class='dstr-td' style='background:#b8d1f3;'>Ownership</th>
    <th class='dstr-td' style='background:#b8d1f3;'>Account Status</th>
    <th class='dstr-td' style='background:#b8d1f3;'>Date Opened</th>
    <th class='dstr-td' style='background:#b8d1f3;'>Sanction Amt / Highest Credit</th>
    <th class='dstr-td' style='background:#b8d1f3;'>Current Balance</th>
    <th class='dstr-td' style='background:#b8d1f3;'>Amount Overdue</th>
    <th class='dstr-td' style='background:#b8d1f3;'>DPDs (In last 3 months)</th>
    <th class='dstr-td' style='background:#b8d1f3;'>Date Reported</th>
</tr>
<?php
$no_records = "<tr>
<td colspan='10' style='text-align: center' class='dstr-td'>No Records</td>
</tr>";
?>
<?php echo (trim(implode($data)) != "") ? implode($data) : $no_records; ?>
<tr><th colspan='10'>&nbsp;</th></tr>
<tr>
    <td colspan='10' style='padding: 0px'>
        <table style='width:100%;text-align: left;' >
            <tr>
                <th colspan='10' class='dstr-td' style='background: #19375f; color: white; text-align:center'> CREDIT ENQUIRIES</th>
            </tr>
            <tr>
                <th class='dstr-td' style='background: #b8d1f3; text-align: center'>Institution Name</th>
                <th class='dstr-td' style='background: #b8d1f3; text-align: center'>Date of Request</th>
                <th class='dstr-td' style='background: #b8d1f3; text-align: center'>Account Type</th>
            </tr>
            <?php echo (trim(implode($enq_data)) != "") ? implode($enq_data) : $no_records; ?>
        </table>
    </td>
</tr>