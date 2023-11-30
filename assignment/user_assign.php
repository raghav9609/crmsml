<?php 
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../config/config.php');
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
echo "select u_assign.id As user_id, u_assign.name As user_name from crm_master_user as u_assign left JOIN crm_user_loan_type_mapping as l_assign ON u_assign.id = l_assign.user_id  where l_assign.loan_type='".replace_special($_REQUEST['loan_type'])."'";

$qry_user = mysqli_query($Conn1,"select u_assign.id As user_id, u_assign.name As user_name from crm_master_user as u_assign left JOIN crm_user_loan_type_mapping as l_assign ON u_assign.id = l_assign.user_id  where l_assign.loan_type='".replace_special($_REQUEST['loan_type'])."'");
while($res_user = mysqli_fetch_array($qry_user)){?>
  <option value="<?php echo $res_user['user_id'];?>"><?php echo $res_user['user_name'];?></option>
  <?php } ?>
  </select>
  <select name="<?php echo $name.'_flag';?>[]" ><option value="">Avail Flag</option><option value="0">0</option><option value="1">1</option></select> <br>

