<base target="_parent" />
<?php
require_once "../../include/config.php";
if($_GET['id'] != ''){
$user = replace_special($_REQUEST['id']);	
}
else{
$user = replace_special($_REQUEST['user']);	
}

?>
<table border="1" width="100%">
<h4>Tommorow Case Follow Up</h4>
<tr><td>Case No.</td><td>Name</td><td>Follow Up Date <br>& Time</td><td>Loan Amount<br>& Type</td>
<?php if($_GET['id'] == '' or $_GET['id'] == 0){ ?><td>Case Status</td><?php } ?></tr>
<?php 
$query_follow = "select case_id,cust_id,loan_type,c_follow_date,required_loan_amt from tbl_mint_case where case_status ='1' and c_follow_date > CURDATE()  and ((user_id =  '".$user."' and fup_user_type != 2) or (secd_user_id =  '".$user."' and fup_user_type =2))  order  by c_follow_date desc , c_follow_time desc"; 
$result_follow = mysqli_query($Conn1,$query_follow);
while($info_follow_query = mysqli_fetch_array($result_follow)){ 
$case_id = $info_follow_query['case_id'];
$cust_id = $info_follow_query['cust_id'];
$loan_type = $info_follow_query['loan_type'];
$follow_time = date('H:i a', strtotime($info_follow_query['c_follow_time']));

$query_info = "select name,phone from tbl_mint_customer_info where id =$cust_id"; 
$result_info = mysqli_query($Conn1,$query_info);
$info_cust = mysqli_fetch_array($result_info);
$name = $info_cust['name'];
if($user_role == '1' ){
    $phone = "<br>".$info_cust['phone'];
}
else
{
    $phone = "";
}

$query_loan = "select loan_type_name from lms_loan_type where loan_type_id =$loan_type"; 
$result_loan = mysqli_query($Conn1,$query_loan);
$info_loan = mysqli_fetch_array($result_loan);
$loan_name = $info_loan['loan_type_name'];
?>
<tr><td><?php echo $case_id; ?></td><td><?php echo $name.$phone; ?></td><td><?php echo $info_follow_query['c_follow_date']."<br>".$follow_time; ?></td><td><?php echo $info_follow_query['required_loan_amt']."<br>".$loan_name; ?></td>
<?php if($_GET['id'] == '' or $_GET['id'] == 0){ ?><td><a href="../cases/edit.php?case_id=<?php echo $case_id ?>&user=<?php echo $user ?>">Update</a></td><?php } ?>
</tr>
<?php } ?>
</table>
