<?php 
require_once(dirname(__FILE__) . '/../../config/session.php');
require_once(dirname(__FILE__) . '/../../helpers/common-helper.php');
require_once "../../config/config.php";
	 $user_id = replace_special($_REQUEST['user_select']);
     replace_special($_REQUEST['status']);
?>

<table class="gridtable" style='margin-left:2%;width:90%;'>
<tr><th>User ID</th><th>User Name</th><th>Email</th><th>Cell number / Dialer number</th><th>Lead View / Count</th><th>Status</th><th>Hot Lead Limit</th><th>SME Flag</th><th>Last Login</th><th>Action</th></tr>
<?php 
	 $qry_info = "select u_ass.user_id as user_id,u_ass.user_name as user_name, u_ass.email as email,u_ass.contact_no as contact_no, u_ass.scontact_no as scontact_no, u_ass.one_lead_flag as one_lead_flag, u_ass.user_login_datetime as user_login_datetime, u_ass.status as status, u_ass.total_lead_limit as total_lead_limit, u_ass.open_lead_limit as open_lead_limit, tbl_user_role.role_id, tbl_user_role.role_type, u_ass.hot_lead_limit as hot_lead_limit, u_ass.sme_flag as sme_flag from tbl_user_assign as u_ass left join tbl_user_role on tbl_user_role.role_id = u_ass.role_id left join tl_loan_type_assign on tl_loan_type_assign.tl_id = u_ass.user_id where u_ass.user_id != ''";	 
   	 if($user_id != ''){
   	 	$qry_info .= " and u_ass.user_name LIKE '".$user_id."%'";
   	 }
    if($_REQUEST['status'] != ''){
    	$qry_info .= " and u_ass.status = '".$_REQUEST['status']."'";
    }
    if($_REQUEST['lead_view'] != '') {
      $qry_info .= " and u_ass.one_lead_flag = '".$_REQUEST['lead_view']."'";
    }
    if($_REQUEST['support_desk_flag'] != '') {
      $qry_info .= " and u_ass.support_desk_flag = '".$_REQUEST['support_desk_flag']."'";
    }
    
    if($_REQUEST['mobile_recording_flag'] != "") {
      $qry_info .= " and u_ass.mobile_recording_flag = '".$_REQUEST['mobile_recording_flag']."' ";
    }
    if(trim($_REQUEST['mobile_number']) != "") {
      $qry_info .= " and u_ass.contact_no = '".$_REQUEST['mobile_number']."' ";
    }
    if(trim($_REQUEST['dialer_number']) != "") {
      $qry_info .= " and u_ass.scontact_no = '".$_REQUEST['dialer_number']."' ";
    }
    if(trim($_REQUEST['loan_type']) != "") {
      $qry_info .= " and tl_loan_type_assign.loan_type = '".$_REQUEST['loan_type']."' ";
    }
    if(trim($_REQUEST['last_login']) != "" && trim($_REQUEST['last_login']) != "1970-01-01" && trim($_REQUEST['last_login']) != "0000-00-00") {
      $qry_info .= " and date(u_ass.user_login_datetime) = '".$_REQUEST['last_login']."' ";
    }
    $qry_info .= "group by u_ass.user_id";

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
$scontact_no = ($res_info['scontact_no'] != "" && $res_info['scontact_no'] > 0) ? $res_info['scontact_no'] : "--";
$contact_number = ($res_info['contact_no'] != "" && $res_info['contact_no'] > 0) ? $res_info['contact_no'] : "--";
$open_count = ($res_info['open_lead_limit'] != "" && $res_info['open_lead_limit'] > 0) ? $res_info['open_lead_limit'] : "--";
$total_count = ($res_info['total_lead_limit'] != "" && $res_info['total_lead_limit'] > 0) ? $res_info['total_lead_limit'] : "--";
?>
<td><?php echo $contact_number."<br>(Dialer : ".$scontact_no.")";?></td>
<td><?php echo ($res_info['one_lead_flag'] == 1 ? "One Lead" : "Grid View")."<br>";
if($res_info['role_id'] == 3) {
  echo "(Open Limit : ".$open_count.") / (Total Limit : ".$total_count.")";
}
?></td>
<td><?php echo $status;?></td>
<td><?php echo $res_info['hot_lead_limit'];?></td>
<td><?php if($res_info['sme_flag'] == 0){      echo "<span class='red'>Inactive</span>";    } else { 
       echo "<span class='green'>Active</span>";    } ?></td>
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