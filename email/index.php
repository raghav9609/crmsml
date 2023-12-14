<?php
require_once "../../include/crm-header.php";
require_once "../../include/display-name-functions.php";
if($_SESSION['one_lead_flag'] == 1){
    header("/../../logout.php");
    die();
}
?>
<!DOCTYPE html>
<html>
<head>
<script>
function resetform() {
document.getElementById("query_no").value = "";
}
</script>
</head>
<body>
<?php
	if(isset($_REQUEST['query_id'])){
	 $query_id = replace_special($_REQUEST['query_id']);
	}
$query_no = $_REQUEST['query_no'];
if ($user_role == 3 && $query_no == "" ){
$qry = "select mail.mail_id as mail_id, qry.query_id, qry.loan_type as loan_type, stats.user_id as user_id, qry.loan_amt as loan_amt,
cust.name as name, cust.mname as mname, cust.lname as lname, cust.phone as phone,cust.city_id as city_id, cust.email as email from tbl_mint_mail_new as mail
left JOIN tbl_mint_query as qry ON mail.query_id = qry.query_id left JOIN tbl_mint_query_status_detail as stats ON qry.query_id = stats.query_id
left JOIN tbl_mint_customer_info as cust ON qry.cust_id = cust.id where stats.user_id = '".$user."' order by mail.query_id desc";
} else if ($query_no != "" && ($user_role == 1 || $user_role == 5)){

$qry = "select mail.mail_id as mail_id, qry.query_id, qry.loan_type as loan_type, stats.user_id as user_id, qry.loan_amt as loan_amt,
cust.name as name, cust.mname as mname, cust.lname as lname, cust.phone as phone,cust.city_id as city_id, cust.email as email from tbl_mint_mail_new as mail
left JOIN tbl_mint_query as qry ON mail.query_id = qry.query_id left JOIN tbl_mint_query_status_detail as stats ON qry.query_id = stats.query_id
left JOIN tbl_mint_customer_info as cust ON qry.cust_id = cust.id where mail.query_id = '".$query_no."' order by mail.query_id desc";
}
else if ($query_no != "" && ($user_role == 2 || $user_role == 4)){
$qry = "select mail.mail_id as mail_id, qry.query_id, qry.loan_type as loan_type, stats.user_id as user_id, qry.loan_amt as loan_amt,
cust.name as name, cust.mname as mname, cust.lname as lname, cust.phone as phone,cust.city_id as city_id, cust.email as email from tbl_mint_mail_new as mail
left JOIN tbl_mint_query as qry ON mail.query_id = qry.query_id left JOIN tbl_mint_query_status_detail as stats ON qry.query_id = stats.query_id
left JOIN tbl_mint_customer_info as cust ON qry.cust_id = cust.id where mail.query_id = '".$query_no."' and qry.loan_type IN ($tl_loan_type) order by mail.query_id desc";
}
else if ($user_role == 3 && $query_no != "" ){
$qry = "select mail.mail_id as mail_id, qry.query_id, qry.loan_type as loan_type, stats.user_id as user_id, qry.loan_amt as loan_amt,
cust.name as name, cust.mname as mname, cust.lname as lname, cust.phone as phone,cust.city_id as city_id, cust.email as email from tbl_mint_mail_new as mail
left JOIN tbl_mint_query as qry ON mail.query_id = qry.query_id left JOIN tbl_mint_query_status_detail as stats ON qry.query_id = stats.query_id
left JOIN tbl_mint_customer_info as cust ON qry.cust_id = cust.id where mail.query_id = '".$query_no."' and stats.user_id = '".$user."' order by mail.query_id desc";
}
else {
if($user_role == 1 || $user_role == 5){
$qry = "select mail.mail_id as mail_id, qry.query_id, qry.loan_type as loan_type, stats.user_id as user_id, qry.loan_amt as loan_amt,
cust.name as name, cust.mname as mname, cust.lname as lname, cust.phone as phone,cust.city_id as city_id, cust.email as email from tbl_mint_mail_new as mail
left JOIN tbl_mint_query as qry ON mail.query_id = qry.query_id left JOIN tbl_mint_query_status_detail as stats ON qry.query_id = stats.query_id
left JOIN tbl_mint_customer_info as cust ON qry.cust_id = cust.id order by mail.query_id desc";
} if($user_role == 2 || $user_role == 4) {
$qry = "select mail.mail_id as mail_id, qry.query_id, qry.loan_type as loan_type, stats.user_id as user_id, qry.loan_amt as loan_amt,
cust.name as name, cust.mname as mname, cust.lname as lname, cust.phone as phone,cust.city_id as city_id, cust.email as email from tbl_mint_mail_new as mail
left JOIN tbl_mint_query as qry ON mail.query_id = qry.query_id left JOIN tbl_mint_query_status_detail as stats ON qry.query_id = stats.query_id
left JOIN tbl_mint_customer_info as cust ON qry.cust_id = cust.id where qry.loan_type IN ($tl_loan_type) order by mail.query_id desc";
}
$qry .= " limit ".$offset.",".$max_offset;
}
$res = mysqli_query($Conn1,$qry) or die("Error: ".mysqli_error($Conn1));
$recordcount = mysqli_num_rows($res);
?>
<fieldset><legend>Email Query Filter</legend>
<form method="post" action="index.php" name="searchfrm" autocomplete="off">
<input type="text" class="text-input" name="query_no" id="query_no" placeholder="Query No" value="<?php echo $query_no;?>" size="8"/>
<input class="cursor" type="submit" name="searchsubmit" value="Filter"><input class="cursor" type="submit" onclick="resetform()" value="Clear">
</form>
</fieldset>
<table width="100%" class="gridtable">
<tr>
<th width="5%">Query No</th>
<th width="10%">Name & Phone & City</th>
<th width="10%">Loan Type & Loan Amount</th>
<th width="5%">Recipient Email-id</th>
<th width="15%">Subject</th>
<th width="5%">Sender Email</th>
<th width="5%">CC Email-id</th>
<?php if($user ==''){ ?><th width="5%">User Name</th><?php } ?>
</tr>
<?php
if($recordcount > 0){
$record = 0;
while($exe = mysqli_fetch_array($res)){
	$record++;
	if($record > 10){
		continue;
	}
$case_id = $exe['case_id'];
$mail_id = $exe['mail_id'];
$query_id = $exe['query_id'];
$loan_type = $exe['loan_type'];
$user_id = $exe['user_id'];
$required_loan_amt = custom_money_format($exe['loan_amt']);
$name = $exe['name'];
$phone = $exe['phone'];
$emailid=$exe['email'];
if($user_role != '1'){
	$echo_number = substr_replace($phone,'XXX',4,3);
	$email = "XXXXXXXXXXXX";
} else {
   $echo_number =  $phone;
   $email=$emailid;
}

$city_id = $exe['city_id'];


$city_name = get_display_name('city_name',$city_id);
$assign = get_display_name('mlc_user_name',$user_id);
$loan_name = get_display_name('loan_type',$loan_type);
$qrydesc = "select * from tbl_mint_mail_detail where mail_id = '".$mail_id."'";
$resdesc = mysqli_query($Conn1,$qrydesc);
 $exedesc = mysqli_fetch_array($resdesc);
$sub = $exedesc['subject'];
$cc_mail = $exedesc['cc_mail'];
$sender_mail = $exedesc['sender_mail'];
$sender_mail_name = 'care@myloancaremail.in';

/*end */
?>
<tr>
<td><a href="../all_query/edit.php?id=<?php echo urlencode(base64_encode($query_id));?>&page=<?php echo $page;?>"><?php echo $query_id;?></a></td>
<td><?php echo $name;?><br/> <span style="color:orange;"><?php echo $city_name;?></span> </br><?php if($user_role != 2){ echo $echo_number; } ?></td>
<td><span style="color:orange;"><?php echo $loan_name;?></span> </br><?php echo $required_loan_amt;?></td>
<td><?php echo $email;?></td>
<td><a href="email-detail.php?mail_id=<?php echo $mail_id;?>&id=<?php echo $query_id;?>&page_no=<?php echo $page;?>"><?php echo $sub;?></a></td>
<td><?php echo $sender_mail_name;?></td>
<td><?php echo $cc_mail;?></td>
<?php if($user == '') { ?><td><?php echo $assign;?></td><?php } ?>
</tr>
	<?php } ?>
</table>
<?php if ($recordcount > 0) { ?>
<table width="width:90%;margin-left:4%;" border="0" align="center" cellpadding="4" cellspacing="1" class="pagination">
            <tr class="sidemain">
                <td>
                    <?php
										if($page > 1){
											echo "<a class='page gradient' href='index.php?page=1&query_no=$query_no&user=$user'>First</a>";

													echo "<a class='page gradient' href='index.php?page=" . ($page - 1) . "&query_no=$query_no&user=$user'>Prev</a>";
												}
													echo "<a class='page gradient' href='javascript:void;'>".$page."</a>";
													if($recordcount > $display_count){
															echo "<a class='page gradient' href='index.php?page=" . ($page + 1) . "&query_no=$query_no&user=$user'>Next</a>";
												}
                    ?></td>
            </tr>
        </table>
			<?php }} ?>
</body></html>
<?php  include("../../include/footer_close.php"); ?>
