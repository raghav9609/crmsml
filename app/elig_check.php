<table width="100%" class="gridTable hidden" id="elig_detail_<?php echo $_REQUEST['app_id'];?>" >
<tr><td colspan="9"><input type="button" style="float:left;" class="buttonsub" name="check_elig" id="check_elig_<?php echo $_REQUEST['app_id'];?>" value="Check Eligibility" onclick="show_egidetal(<?php echo $_REQUEST['app_id'];?>);"></td></tr>
<tr>
<th>Loan Amount</th>
<th>Tenure</th>
<th>Interest Rate</th>
<th>Processing Fee</th>
<th>EMI</th>
<th>Company PF</th>
<th>Special Rate</th>
<th>Special PF</th>
<th>Special PF Percent</th>
</tr>
<?php 
$qry_app_fetch = mysqli_query($Conn1,"select * from tbl_customer_application_api_elig where app_id = '".$_REQUEST['app_id']."'");
while($res_app_fetch = mysqli_fetch_array($qry_app_fetch)){?>
<tr>
<td><?php echo $res_app_fetch['loanamount'];?></td>
<td><?php echo $res_app_fetch['tenure'];?></td>
<td><?php echo $res_app_fetch['interestrate'];?></td>
<td><?php echo $res_app_fetch['processingfee'];?></td>
<td><?php echo $res_app_fetch['emi'];?></td>
<td><?php echo $res_app_fetch['companypf'];?></td>
<td><?php echo $res_app_fetch['splroi'];?></td>
<td><?php echo $res_app_fetch['splpf'];?></td>
<td><?php echo $res_app_fetch['splpfper'];?></td>
</tr>
<?php } ?>

</table>