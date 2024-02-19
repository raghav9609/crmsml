<?php 
require_once "../../include/crm-header.php";

if(isset($_POST['activate'])){
	$ids = replace_special($_POST['abc']);
	foreach($ids as $up){
		$user_id = explode('_',$up);
		 $qry_stat = mysqli_query($Conn1,"Update tbl_user_assign set status = '1' where user_id = '".$user_id[0]."'");
		 $qry_ad_stat = mysqli_query($Conn1,"Update tbl_admin set status = '1' where admin_id = '".$user_id[1]."'");
	}
echo "<span class='green'>Updated Successfully!!</span>";
} else if(isset($_POST['inactivate'])){
	$ids_in = replace_special($_POST['abc']);
	foreach($ids_in as $up_in){
		$user_id_in = explode('_',$up_in);
		 $qry_stat = mysqli_query($Conn1,"Update tbl_user_assign set status = '0' where user_id = '".$user_id_in[0]."'");
		 $qry_ad_stat = mysqli_query($Conn1,"Update tbl_admin set status = '0' where admin_id = '".$user_id_in[1]."'");
}
echo "<span class='green'>Updated Successfully!!!</span>";
 }

?>
<style>
fieldset { 
    display: block;
    margin-left: 2px;
    margin-right: 2px;
    padding-top: 0.35em;
    padding-bottom: 0.625em;
    padding-left: 0.75em;
    padding-right: 0.75em;
    border: 2px groove (internal value);
}

.buttonsub {
    webkit-box-shadow: rgba(0,0,0,0.2) 0 1px 0 0;
    -moz-box-shadow: rgba(0,0,0,0.2) 0 1px 0 0;
    box-shadow: rgba(0,0,0,0.2) 0 1px 0 0;
    color: #000;
    background-color: #ffa84c;
    border-radius: 5px;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    border: none;
    text-decoration: none;
    font-family: roboto;
    font-size: 16px;
    font-weight: 700;
    height: 32px;
    padding: 4px 16px;
    text-shadow: ;
}
</style>
<div style="padding: 3%;">
<a href="index.php">Back</a> 
<form name="status_check" method="POST">
<fieldset><legend>Search</legend>
User Name: <select name="status" id="status"><option value="">Select status</option>
<option value="1" <?php if($_POST['status'] == '1'){?>selected<?php } ?>>Active</option><option value="0" <?php if($_POST['status'] == '0'){?>selected<?php } ?>>InActive</option>
</select> 
<input type="submit" name="submit" value="SUBMIT"/></fieldset>
</form>
</div>

<?php if(isset($_POST['submit'])){?>
<form name="" method="POST">
<table class="gridtable" style='margin-left:8%;width:80%;'>
<tr><th colspan="5"> <input type="submit" class="buttonsub" style="margin-left:40%;float:left;" name="activate" id="activate" value="Activate">  <input type="submit" class="buttonsub" style="margin-left:40%;" name="inactivate" id="inactivate" value="Inactivate"></th></tr>
<tr><th>Select</th><th>User Name</th><th>Email ID</th><th>Contact No.</th><th>Status</th></tr>
<?php
	$qry_user = "select u_assign.user_id as user_id, u_assign.user_name as user_name, u_assign.status as status, ad.admin_id, u_assign.email as email, u_assign.Contact_no as Contact_no from tbl_user_assign as u_assign left JOIN tbl_admin as ad ON u_assign.email = ad.user_name";
		if($_POST['status'] != ''){
			$qry_user .= " where u_assign.status='".$_POST['status']."' order by u_assign.user_name";
		}
        $result_user = mysqli_query($Conn1,$qry_user);
	while($res_user = mysqli_fetch_array($result_user)){ 
		if($res_user['status'] == 0){
			$status = "<span style='color:red'>InActive</span>";
			} else { 
			$status = "<span style='color:green'>Active</span>";
			}	?>
	<tr><td><input type="checkbox" name="abc[]" value="<?php echo $res_user['user_id']."_".$res_user['admin_id'];?>"/></td>
	<td><?php echo $res_user['user_name'];?></td>
	<td><?php echo $res_user['email'];?></td>
	<td><?php echo $res_user['Contact_no'];?></td>
   <td><?php echo $status; ?></td>
   </tr>
<?php } ?>

	
</table>
</form>
<?php } ?>