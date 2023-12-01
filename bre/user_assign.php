<?php 
require_once "../../include/config.php";
$loan_type = $_REQUEST['loan_type'];
$type = replace_special($_REQUEST['type']);
if($type === 'user_ist'){
	$name = 'user_ist';
} else if($type === 'user_2nd'){ 
	$name = 'user_2nd';
} 
?>
<select name="<?php echo $name;?>[]"><option value="">Select User Name</option>
<?php 
$qry_user = mysqli_query($Conn1,"select u_assign.user_id, u_assign.user_name from tbl_user_assign as u_assign left JOIN tl_loan_type_assign as l_assign ON u_assign.user_id = l_assign.tl_id  where l_assign.loan_type='".replace_special($_REQUEST['loan_type'])."'");
while($res_user = mysqli_fetch_array($qry_user)){?>
  <option value="<?php echo $res_user['user_id'];?>"><?php echo $res_user['user_name'];?></option>
  <?php } ?>
  </select>
  <select name="<?php echo $name.'_flag';?>[]" ><option value="">Avail Flag</option><option value="0">0</option><option value="1">1</option></select> <br>

