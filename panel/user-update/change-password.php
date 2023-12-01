<?php 
require_once "../../include/crm-header.php";
?>
<form>
<h3>Update CRM USER Password</h3>

<table class="gridtable" style="margin-left:2%;width:80%;">
<tbody>
<tr><td colspan="2"><div id="msg" style="font-size:15;"></div></td></tr>
<tr><th>User Name</th><td><select name="user" id="user" required><option value="">Select user name</option>
<?php $qry_use = mysqli_query($Conn1,"select user_name,user_id,status from tbl_user_assign order by user_name");
     while($res_qry = mysqli_fetch_array($qry_use)){
		 $status =$res_qry['status'];
		 if($status == '1'){
			 $status = 'Active';			 
		 }else{
			 $status = 'Inactive';
		 }
		 ?>
	 
	 <option value="<?php echo $res_qry['user_id'];?>"><?php echo $res_qry['user_name']." (".$status.")";?></option>
	 <?php } ?></select>
	 </td></tr>
<tr><th>New Password</th><td><input type="password" name="new_pass" id="new_pass" required/></td></tr>
<tr><th>Confirm Password</th><td><input type="password" name="confrm_pass" id="confrm_pass" required/></td></tr>
<tr><th colspan="2"><input type="button" name="submit" id="submit" class="buttonsub" value="Update" onclick="check();"/></th></tr>
</tbody>
</table>
</form>

<script type="text/javascript" src="../include/js/jquery-1.10.2.js"></script>
<script>
function check(){
	var pass = $("#new_pass").val();
	var cnfrm = $("#confrm_pass").val();
	var user = $("#user option:selected").val();
	
	if (user == ''){
		$("#msg").html("Plz select atleast one username !!!!!");
	}
	else if (pass == '' || pass == '0'){
		$("#msg").html("Plz Enter new password!!!!!");
	}
	else if(pass == cnfrm){
		$.ajax({
         type: "POST",
		 data: "pass="+pass+"&user="+user,
		   beforeSend: function(){
              $("#submit").attr('value','Processing...');
        },
		 url: "pass_change.php",
		 success: function(data){
			 $("#submit").attr('value','Update Password');
			$("#msg").html("<span class='green'>Password updated successfully!!!!!</span>");
			location.reload();
		 }
		});
	} else { 
	$("#msg").html("<span class='red'>Password did not match!!!!!</span>");
	}
	
}
</script>