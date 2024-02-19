<table class="TFtable">
<tr><td colspan = "10" align="center" style="color:#FF9000;"><b>User Lead Details</b></td></tr>
<tr><td>Time Period</td><td>Total Assigned</td><td>Open</td><td>Ringing/ SO1</td><td>Ringing/ SO2</td><td>Ringing/ SO3</td><td>Duplicate</td><td>Junk</td><td>Case Created</td><td>Others</td></tr>
<?php
$qry_total  = "select count(*) as total_assign from form_merge_data ";
$qry_open = "select count(*) as total_open from form_merge_data ";
$qry_case = "select count(*) as total_case from tbl_mint_case ";
$qry_oth = "select count(*) as total_other from form_merge_data " ;

/* Coding for  Today & Yesterday Starts*/
for($i=0;$i<2;$i++){
$total_query  = mysqli_query($Conn1,$qry_total." where assign_date = '$date[$i]' and user_id = $user");
$info_total_query = mysqli_fetch_array($total_query);
echo  "<td>".$period[$i]."</td><td>".$info_total_query['total_assign']."</td>";

for($j = 0;$j<6;$j++){ 
$open_query  = mysqli_query($Conn1,$qry_open." where assign_date = '$date[$i]' and query_status IN ($qry_status[$j]) and user_id = $user");
$info_open_query = mysqli_fetch_array($open_query);
echo  "<td>".$info_open_query['total_open']."</td>";
}

$case_query  = mysqli_query($Conn1,$qry_case." where date_created = '$date[$i]' and case_created = 1 and user_id = $user");
$info_case_query = mysqli_fetch_array($case_query);
echo  "<td>".$info_case_query['total_case']."</td>";

$other_query  = mysqli_query($Conn1,$qry_oth." where assign_date = '$date[$i]' and user_id = $user and query_status NOT IN (11,5,1,2,3,16,17,18,19)");
$info_other_query = mysqli_fetch_array($other_query);
echo  "<td>".$info_other_query['total_other']."</td></tr>";
}

/* Coding for  Today & Yesterday Ends */

/* Coding for Week & Month Starts*/
for($k=2;$k<4;$k++){
$total_query  = mysqli_query($Conn1,$qry_total." where assign_date >= '$date[$k]' and user_id = $user");
$info_total_query = mysqli_fetch_array($total_query);
echo "<td>".$period[$k]."</td><td>".$info_total_query['total_assign']."</td>";

for($l = 0;$l<6;$l++){ 
$open_query  = mysqli_query($Conn1,$qry_open." where assign_date >= '$date[$k]' and query_status IN ($qry_status[$l]) and user_id = $user");
$info_open_query = mysqli_fetch_array($open_query);
echo "<td>".$info_open_query['total_open']."</td>";
}

$case_query  = mysqli_query($Conn1,$qry_case." where date_created >= '$date[$k]' and case_created = 1 and user_id = $user");
$info_case_query = mysqli_fetch_array($case_query);
echo "<td>".$info_case_query['total_case']."</td>";

$other_query  = mysqli_query($Conn1,$qry_oth." where assign_date >= '$date[$k]' and user_id = $user and query_status NOT IN (11,5,1,2,3,16,17,18,19)");
$info_other_query = mysqli_fetch_array($other_query);
echo "<td>".$info_other_query['total_other']."</td></tr>";
}
/* Coding for Week & Month Ends*/?>
</table>