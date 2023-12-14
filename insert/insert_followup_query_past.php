<base target="_parent" />
<?php
require_once "../../include/config.php";
if($_GET['id'] != ''){
$user = replace_special($_REQUEST['id']);	
}
else{
$user = replace_special($_REQUEST['user']);	
}
$page = replace_special($_REQUEST['page']);	
?>
<table border="1" width="100%">
<h4>PAST Query Follow Up</h4>
<tr><td>Follow up Type</td><td>Name</td><td>Follow Up Date <br>& Time</td><td>Loan Amount<br>& Type</td>
<?php if($_GET['id'] == '' or $_GET['id'] == 0){ ?><td>Query Status</td><?php } ?></tr>
<?php 
$query_follow = "select loan_type,q_follow_type,name,phone,id,q_follow_time,loan_amt,q_follow_date from form_merge_data where q_follow_date < CURDATE() and q_follow_date != '0000-00-00' and (user_id = $user or r_user = $user) and query_status IN (5,16,17,15) order by q_follow_date desc";
$result_follow = mysqli_query($Conn1,$query_follow);
while($info_follow_query = mysqli_fetch_array($result_follow)){ 
$loan_type = $info_follow_query['loan_type'];
$follow_type = $info_follow_query['q_follow_type'];
$name = $info_follow_query['name'];
if($user_role == '1' ){
    $phone = "<br>".$info_cust['phone'];
}
else
{
    $phone = "";
}
$id = $info_follow_query['id'];

$follow_time = date('H:i a', strtotime($info_follow_query['q_follow_time']));

$follow_query= "select follow_status from tbl_follow_status where follow_id = $follow_type"; 
$result_follow_status = mysqli_query($Conn1,$follow_query);
$info_follow = mysqli_fetch_array($result_follow_status);
$follow_name = $info_follow['follow_status']; 

$query_loan = "select loan_type_name from lms_loan_type where loan_type_id =$loan_type"; 
$result_loan = mysqli_query($Conn1,$query_loan);
$info_loan = mysqli_fetch_array($result_loan);
$loan_name = $info_loan['loan_type_name'];
?>
<tr><td><?php echo $follow_name; ?></td><td><?php echo $name.$phone; ?></td><td><?php echo $info_follow_query['q_follow_date']."<br>".$follow_time; ?></td><td><?php echo $info_follow_query['loan_amt']."<br>".$loan_name; ?></td>
<?php if($_GET['id'] == '' or $_GET['id'] == 0){ ?>
<td><a href="../query/update_follow_up.php?id=<?php echo $id?>&page=<?php echo $page?>&user=<?php echo $user?>">Update</a></td><?php } ?>
</tr>
<?php } ?>
</table>