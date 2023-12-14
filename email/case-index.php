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
<script src="<?php echo $head_url; ?>/include/js/jquery-1.10.1.min.js" type="text/javascript"></script>
<script>
function resetform() {
document.getElementById("case_no").value = "";
}
</script>
</head>
<body>
<?php
$case_no = replace_special($_REQUEST['case_no']);
if ($user_role == 3 && $case_no == "" )
 {
 $qry = "select * from tbl_mint_mail_new as mail JOIN tbl_mint_case as c ON mail.case_id = c.case_id where user_id = '".$user."' order by mail.case_id desc ";
}
elseif ($case_no != "" && ($user_role == 1 || $user_role == 5))
 {
 $qry = "select * from tbl_mint_mail_new as mail JOIN tbl_mint_case as c ON mail.case_id = c.case_id where mail.case_id = '".$case_no."' order by mail.case_id desc ";
}
elseif ($case_no != "" && ($user_role == 2 || $user_role == 4))
 {
 $qry = "select * from tbl_mint_mail_new as mail JOIN tbl_mint_case as c ON mail.case_id = c.case_id where mail.case_id = '".$case_no."' and c.loan_type IN ($tl_loan_type) order by mail.case_id desc ";
}

else if ($user_role == 3 && $case_no != "" )
 {
 $qry = "select * from tbl_mint_mail_new as mail JOIN tbl_mint_case as c ON mail.case_id = c.case_id where c.user_id = '".$user."' and mail.case_id = '".$case_no."'order by mail.case_id desc";
}
else{
if($user_role == 1 || $user_role == 5){
 $qry = "select * from tbl_mint_mail_new as mail JOIN tbl_mint_case as c ON mail.case_id = c.case_id order by mail.case_id desc ";
 }
 if($user_role == 2 || $user_role == 4){
 $qry = "select * from tbl_mint_mail_new as mail JOIN tbl_mint_case as c ON mail.case_id = c.case_id and c.loan_type IN ($tl_loan_type) order by mail.case_id desc ";
 }
 $qry .= " limit ".$offset.",".$max_offset;
}
$res = mysqli_query($Conn1,$qry) or die("Error: ".mysqli_error($Conn1));
$recordcount = mysqli_num_rows($res);
?>
<fieldset><legend>Email Case Filter</legend>
<form method="post" action="case-index.php" name="searchfrm" autocomplete="off">
<input type="text" class="text-input" name="case_no" id="case_no" placeholder="Case No" value="<?php echo $case_no;?>" size="8"/>
<input type="hidden" name="user" value="<?php echo $user;?>">
<input class="cursor" type="submit" name="searchsubmit" value="Filter">
<input class="cursor" type="submit" onclick="resetform()" value="Clear">
</form>
</fieldset>
<table width="100%" class="gridtable">
<tr>
<th width="5%">Case Number</th>
<th width="10%">Name & Phone & City</th>
<th width="10%">Loan Type & Loan Amount</th>
<th width="5%">Recipient Email-id</th>
<th width="15%">Subject</th>
<th width="5%">Sender Email</th>
<th width="5%">CC Email-id</th>
<?php if($user =='') { ?><th width="5%">User Name</th><?php } ?>
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
$cust_id = $exe['cust_id'];
$mail_id = $exe['mail_id'];
$query_id = $exe['query_id'];
$user_id = $exe['user_id'];
$loan_type = $exe['loan_type'];
$required_loan_amt = $exe['required_loan_amt'];
$qrycustt = "select * from tbl_mint_customer_info where id = ".$cust_id." order by date desc";
$rescustt = mysqli_query($Conn1,$qrycustt);
$execustt = mysqli_fetch_array($rescustt);
$name = $execustt['name'];
$phone = $execustt['phone'];
if($user_role != '1'){
  $echo_number = substr_replace($phone,'XXX',4,3);
} else {
  $echo_number =  $phone;
}
$city_id = $execustt['city_id'];
$email = $execustt['email'];
$gold_city = $execust['gold_city'];
$city_name = get_display_name('city_name',$city_id);
$loan_name = get_display_name('loan_type',$loan_type);
$assign = get_display_name('mlc_user_name',$user_id);
$qrydesc = "select * from tbl_mint_mail_detail where mail_id = '".$mail_id."'";
$resdesc = mysqli_query($Conn1,$qrydesc);
$exedesc = mysqli_fetch_array($resdesc);
$sub = $exedesc['subject'];
$cc_mail = $exedesc['cc_mail'];
$sender_mail = $exedesc['sender_mail'];
$sender_mail_name = 'care@myloancaremail.in';
?>
<tr>
<td><a href="../cases/edit.php?case_id=<?php echo urlencode(base64_encode($case_id));?>&page=<?php echo $page;?>"><?php echo $case_id; ?></a></td>
<td><a href="../cust_account/edit.php?cust_id=<?php echo $cust_id;?>&cs_id=<?php echo $case_id;?>&page=<?php echo $page;?>"><?php echo $name;?></a><br/> <span style="color:orange;"><?php echo $city_name;?></span> </br><?php if($user_role != 2){ echo $echo_number; } ?></td>
<td><span style="color:orange;"><?php echo $loan_name;?></span> </br><?php echo $required_loan_amt;?></td>
<td><?php echo $email;?></td>
<td><a href="email-detail.php?mail_id=<?php echo $mail_id;?>&case_id=<?php echo $case_id;?>&page_no=<?php echo $page;?>"><?php echo $sub;?></a></td>
<td><?php echo $sender_mail_name;?></td>
<td><?php echo $cc_mail;?></td>
<?php if($user == '') { ?><td><?php echo $assign;?></td><?php } ?>
</tr>
<?php }?>
</table>

<?php if ($recordcount > 0) { ?>
<table width="width:90%;margin-left:4%;" border="0" align="center" cellpadding="4" cellspacing="1" class="pagination">
            <tr class="sidemain">
                <td>
                    <?php
                    if($page > 1){
											echo "<a class='page gradient' href='case-index.php?page=1&case_no=$case_no'>First</a>";

													echo "<a class='page gradient' href='case-index.php?page=" . ($page - 1) . "&case_no=$case_no'>Prev</a>";
												}
													echo "<a class='page gradient' href='javascript:void;'>".$page."</a>";
													if($recordcount > $display_count){
															echo "<a class='page gradient' href='case-index.php?page=" . ($page + 1) . "&case_no=$case_no'>Next</a>";
												}
                  ?></td>
            </tr>
        </table>
			<?php }} ?>
</body>
</html>
      <?php include("../../include/footer_close.php"); ?>
