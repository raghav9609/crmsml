<?php 
require_once "../../include/check-session.php";
require_once "../../include/config.php";
?>
<div style="clear:both;"></div>
<table width="93%" class="gridtable">

<tr><th colspan="3" style="background-color:#000;color:#fff;">Email Detail</th></tr>
<?php 
$qry_sugar_case = "select * from tbl_mint_mail_new where case_id =".$case_id."";
$res_sugar_case = mysqli_query($Conn1,$qry_sugar_case) or die(mysqli_error($Conn1));
?>
<tr>
<th>Subject</th>
<th>Case Number</th>
<th>date</th>
</tr>
<?php while($exe_sugar_case = mysqli_fetch_array($res_sugar_case)){

$case_id = $exe_sugar_case['case_id']; 
$date = ($exe_sugar_case['date'] == "" || $exe_sugar_case['date'] == "1970-01-01" || $exe_sugar_case['date'] == "0000-00-00") ? "--" : date("d-m-Y", strtotime($exe_sugar_case['date']));
$mail_id = $exe_sugar_case['mail_id'];
$qry_l = "select * from lms_loan_type where loan_type_id = '".$loan_type."'";
$res_l = mysqli_query($Conn1,$qry_l);
$exe_l = mysqli_fetch_array($res_l);
$loan = $exe_l['loan_type_name'];
$qry_case = "select * from tbl_mint_mail_detail where mail_id = '".$mail_id."'";
$res_case = mysqli_query($Conn1,$qry_case) or die(mysqli_error($Conn1));
$exe_case = mysqli_fetch_array($res_case);
$subject = $exe_case['subject'];

?>
<tr>
<td><a href="../email/email-detail.php?mail_id=<?php echo $mail_id;?>&case_id=<?php echo $case_id;?>"><?php echo $subject;?></a></td>
<td><?php echo $case_id;?></td>
<td><?php echo $date;?></td>
</tr>
<?php } ?>
</table>