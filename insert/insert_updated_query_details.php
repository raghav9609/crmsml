<?php
/* if($user == '173'){
echo "select * from tbl_updated_query_details where query_id='".$qryyy_id."'";
} */

$qry_get_data = mysqli_query($Conn1,"select * from tbl_updated_query_details where query_id='".$qryyy_id."'");
$res_data = mysqli_fetch_array($qry_get_data);
if($res_data['company'] > '0'){ $company_nm = get_display_name('comp_name',$res_data['company']); } else { $company_nm = ''; }

$net_incm = $res_data['net_incm'];
$pan_card = $res_data['pan_card'];
$comp_name_other = $res_data['comp_name_other'];
$salary_pay_id = $res_data['sal_pay_id'];
 $salry_py_mod = get_display_name('salary_method',$salary_pay_id);
 $city_nm = get_display_name('city_name',$res_data['city']); 
 
 if(($net_incm != '0' && $net_incm != '') || ($res_data['pan_card'] != '0' && $pan_card != '') || $city_nm != '' || $company_nm != '' || $comp_name_other != '' || ($salary_pay_id != '0' && $salary_pay_id != '')){
?>
<table class="gridtable table_set" border='1' style=''>
<tr><th colspan='2'>Raw Details in Query</th></tr> 
<?php if($net_incm != '0' && $net_incm != ''){?>
<tr><td>Net Monthly Income</td><td><?php echo custom_money_format($res_data['net_incm']);?></td></tr>
<?php } if($res_data['pan_card'] != '0' && $pan_card != ''){?>
<tr> <td>PAN Card</td><td><?php echo $res_data['pan_card'];?></td></tr> 
<?php } if($city_nm != ''){ ?>
<tr> <td>City</td><td><?php echo $city_nm;?></td></tr> 
<?php } if($salary_pay_id != '0' && $salary_pay_id != ''){ ?>
<tr> <td>Salary Payment Mode</td><td><?php echo $salry_py_mod;?></td></tr>
<?php } if($res_data['pincode'] != '0' && $res_data['pincode'] != ''){?>
<tr> <td>Pin Code</td><td><?php echo $res_data['pincode'];?></td></tr> 
<?php } if($res_data['company'] > '0' || $res_data['comp_name_other'] != ''){?>
<tr> <td>Company</td><td><?php if($res_data['company'] > '0'){ echo $company_nm; } else { echo $res_data['comp_name_other']; } ?></td></tr> 
<?php } ?>
</table>
 <?php } ?>