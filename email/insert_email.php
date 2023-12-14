<?php 
$slave = 1;
require_once "../../include/check-session.php";
require_once "../../include/config.php";
?>
<?php
//Changes - NewTabsInCases - Akash - Starts - Table width changed to 100% and others too
$return_html = "";
$case_id = $_REQUEST['case_id'];
?>
<?php
$qry_sugar_case = "select * from tbl_mint_mail_new where case_id=".$case_id;
$res_sugar_case = mysqli_query($Conn1,$qry_sugar_case) or die(mysqli_error($Conn1));
?>
<?php
$res_sugar_rows = mysqli_num_rows($res_sugar_case);
if($res_sugar_rows > 0) {
$sr_no = 0;
?>
    <?php $return_html .= "<div style='clear:both;'></div><table width='100%' class='gridtable'>"; ?>
    <?php $return_html .= "<tr class='font-weight-bold'><th style='width: 6%'>Sr. No.</th><th>Subject</th><th style='width: 10%'>Case Number</th><th style='width: 10%'>date</th></tr>"; ?>
    <?php while($exe_sugar_case = mysqli_fetch_array($res_sugar_case)){
    ++$sr_no;
    $case_id = $exe_sugar_case['case_id']; 
    $date = ($exe_sugar_case['date'] == "" || $exe_sugar_case['date'] == "1970-01-01" || $exe_sugar_case['date'] == "0000-00-00") ? "--" : date("d-m-Y", strtotime($exe_sugar_case['date']));
    $mail_id = $exe_sugar_case['mail_id'];
    $qry_l = "select * from lms_loan_type where loan_type_id=".$loan_type;
    $res_l = mysqli_query($Conn1,$qry_l);
    $exe_l = mysqli_fetch_array($res_l);
    $loan = $exe_l['loan_type_name'];
    $qry_case = "select * from tbl_mint_mail_detail where mail_id=".$mail_id;
    $res_case = mysqli_query($Conn1,$qry_case) or die(mysqli_error($Conn1));
    $exe_case = mysqli_fetch_array($res_case);
    $subject = $exe_case['subject'];

    ?>
    <?php $return_html .= "<tr class='center-align'>"; ?>
    <?php $return_html .= "<td>".$sr_no."</td><td><a href='../email/email-detail.php?mail_id=$mail_id&case_id=$case_id'>".$subject."</a></td><td>".$case_id."</td><td>".$date."</td></tr>"; ?>
    <?php } ?>
    <?php $return_html .= "</table>"; ?>
<?php } ?>
<?php echo $return_html; ?>
<?php //Changes - NewTabsInCases - Akash - Ends - Table width changed ?>