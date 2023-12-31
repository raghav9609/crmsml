<?php 
require_once(dirname(__FILE__) . '/../../config/session.php');
require_once(dirname(__FILE__) . '/../../helpers/common-helper.php');
require_once "../../config/config.php";
	 $user_id = replace_special($_REQUEST['user_select']);
     replace_special($_REQUEST['status']);
?>

<table class="gridtable" style='margin-left:2%;width:90%;'>
<tr><th>User ID</th><th>User Name</th><th>Email</th><th>Cell number </th><th>Status</th><th>Last Login</th><th>Action</th></tr>
<?php 
	 $qry_info = "select u_ass.id as user_id,u_ass.name as user_name, u_ass.email_id as email, u_ass.mobile_no as contact_no, u_ass.last_login_on as user_login_datetime, u_ass.is_active as status, urole.id as role_id, urole.role_name as role_type from crm_master_user as u_ass left join crm_master_user_role As urole on urole.id = u_ass.role_id left join crm_user_loan_type_mapping As ultyass on ultyass.user_id = u_ass.id where u_ass.id != ''";	 
   	 if($user_id != ''){
   	 	$qry_info .= " and u_ass.name LIKE '".$user_id."%'";
   	 }
    if($_REQUEST['status'] != ''){
    	$qry_info .= " and u_ass.is_active = '".$_REQUEST['status']."'";
    }

    if(trim($_REQUEST['mobile_number']) != "") {
      $qry_info .= " and u_ass.mobile_no = '".$_REQUEST['mobile_number']."' ";
    }
    
    if(trim($_REQUEST['loan_type']) != "") {
      $qry_info .= " and crm_user_loan_type_mapping.loan_type = '".$_REQUEST['loan_type']."' ";
    }
    if(trim($_REQUEST['last_login']) != "" && trim($_REQUEST['last_login']) != "1970-01-01" && trim($_REQUEST['last_login']) != "0000-00-00") {
      $qry_info .= " and date(u_ass.last_login_on) = '".$_REQUEST['last_login']."' ";
    }
    $qry_info .= " group by u_ass.id";

    $result_info = mysqli_query($Conn1,$qry_info);
	while($res_info = mysqli_fetch_array($result_info)){
    if($res_info['status'] == 0){
      $status = "<span class='red'>Inactive</span>";
    } else { 
       $status = "<span class='green'>Active</span>";
    }
    ?>
<tr>
<td><?php echo $res_info['user_id'];?></td>
<td><?php echo $res_info['user_name'];?></td>
<td><?php echo $res_info['email'];?></td>
<?php

$contact_number = ($res_info['contact_no'] != "" && $res_info['contact_no'] > 0) ? $res_info['contact_no'] : "--";

?>
<td><?php echo $contact_number;?></td>

<td><?php echo $status;?></td>

<td><?php echo  (date("d-m-Y", strtotime($res_info['user_login_datetime'])) != "" && date("d-m-Y", strtotime($res_info['user_login_datetime'])) != "01-01-1970" && date("d-m-Y", strtotime($res_info['user_login_datetime'])) != "00-00-0000") ? date("d-m-Y H:i A", strtotime($res_info['user_login_datetime'])) : "--"; ?></td>
<?php
if($user_role == 9) {
?>
<td>
  
  <a href="javascript:void(0);" onclick='user_status_change(<?php echo $res_info['user_id']; ?>, "<?php echo $res_info['user_name']; ?>", <?php echo $res_info['status']; ?>)'>
  <?php
  if($res_info['status'] == 0) {
    echo "Active";
  } else {
    echo "Inactive";
  }
  ?>
  </a>
</td>
<?php
} else {
?>
<td><a href="search_info.php?value=<?php echo urlencode(base64_encode($res_info['user_id']));?>">Edit </a></td>
<?php
}
?>
</tr>
<?php } ?>
</table>
<script>
function user_status_change(user_id, user_name, status) {
  if(confirm("Pl. confirm to change the status of User: " + user_name)) {
    console.log("true");
    $.ajax({
        type: "POST",
        url: "../../sugar/insert/update_user_status.php",
        data: "user_id="+user_id+"&status="+status,
        success: function(msg) {
         response = JSON.parse(msg);
         console.log(response);
         if(response.status == 0) {
           alert("Failed");
         } else {
           alert("Successfully Updated");
           location.reload();
         }
        }
    });
  } else {
    return false;
  }
}
</script>