<table width="93%" class="gridtable">
<tr><th colspan="3" style="background-color:#000;color:#fff;">Application Follow-Up</th></tr>
<?php 
$qrygrp_app = mysqli_query($Conn1,"select app_id from tbl_mint_case_followup where case_id = ".$case_id." and app_id != 0 and app_flag = 1 group by app_id");
while($res_grp_app = mysqli_fetch_array($qrygrp_app)){
$application_no = $res_grp_app['app_id'];
$fetch_app_detail = mysqli_query($Conn1,"select app_bank_on from tbl_mint_app where app_id = '".$application_no."'");
$result_app_detail = mysqli_fetch_assoc($fetch_app_detail);
$bank_application = $result_app_detail['app_bank_on'];
$fetch_bnk_detail = mysqli_query($Conn1,"select bank_name from tbl_bank where bank_id ='".$bank_application."'");
$res_bank_details = mysqli_fetch_array($fetch_bnk_detail); 
$application_bank = $res_bank_details['bank_name'];
?>
<tr><th colspan="3" style="background-color:#ECE4E433;color:#000;"><?php echo $application_bank."(".$application_no.")"; ?></th></tr>
<?php
$fup_app_detail = mysqli_query($Conn1,"select follow_date,follow_type,description from tbl_mint_case_followup where app_id = '".$application_no."' and app_flag = 1 order by date desc");
while($result_fup_detail = mysqli_fetch_array($fup_app_detail)){
$app_fup_date = $result_fup_detail['follow_date'];
$app_fup_type = $result_fup_detail['follow_type'];
$app_fup_description = $result_fup_detail['description'];

$qry_follow_status = mysqli_query($Conn1,"select follow_status from tbl_follow_status where follow_id = '".$app_fup_type."'");
$result_follow_det = mysqli_fetch_assoc($qry_follow_status);
$follow_status_name = $result_follow_det['follow_status'];

echo "<tr><td>".$application_no."</td><td>".$follow_status_name."<br>".$app_fup_date."</td><td>".$app_fup_description."</td></tr>";
}}
?>
</table>