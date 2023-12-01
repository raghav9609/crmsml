<?php 
require_once(dirname(__FILE__) . '/../../config/session.php');
require_once(dirname(__FILE__) . '/../../helpers/common-helper.php');
require_once "../../include/header.php";
include("../../include/helper.functions.php");
	$user_id = base64_decode(urldecode($_REQUEST['value']));
	$qry_info = mysqli_query($Conn1,"SELECT u_ass.id as user_id,u_ass.name as user_name,u_ass.email_id as email, u_ass.mobile_no as contact_no, u_ass.role_id as role_id, u_ass.sms_flag as sms_flag, u_ass.is_active as status,GROUP_CONCAT(l_typ.loan_type SEPARATOR ',') as loan_type, GROUP_CONCAT(l_typ.user_id SEPARATOR ',') as tl_id, GROUP_CONCAT(l_ass.user_id SEPARATOR ',') as user_assign, GROUP_CONCAT(l_ass.tl_user_id SEPARATOR ',') as tl_assign,u_ass.show_number_flag as show_number_flag FROM crm_master_user as u_ass LEFT JOIN crm_tl_user_mapping as l_ass ON l_ass.user_id = u_ass.id LEFT JOIN crm_user_loan_type_mapping as l_typ ON l_typ.user_id = u_ass.id where u_ass.id = '".$user_id."'");
	$res_info = mysqli_fetch_array($qry_info);
	$tl_id_arr = explode(',',$res_info['tl_assign']);
    $loan_type_arr = explode(',',$res_info['loan_type']);
   
?>
<style>
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
<script>
function joinee_validation() {
    var alnu_regex = /((^[0-9]+[a-zA-Z]+)|(^[a-zA-Z]+[0-9]+))+[0-9a-zA-Z]*$/i;
    var password_field = $("#password_flag").val();
    if(password_field.trim() != "") {
        if(!password_field.match(alnu_regex)) {
            alert("Alphanumeric required in Password");
            return false;
        } else {
            return true;
        }
    } else {
        return true;
    }
}
</script>
<div style="padding-left: 5%; padding-top: 2%;">
    <a href="index.php">Back</a> 
<h3>Employee Details !!!</h3>
	<form name="info_up" method="POST" action="update.php" onsubmit="return joinee_validation()">
	<table class="gridtable" style='margin-left:2%;width:80%;'>
<tbody>
<input type="hidden" name="user" value="<?php echo $res_info['user_id'];?>">
<input type="hidden" name="admin" value="<?php echo $res_info['admin_id'];?>"/>
<input type='hidden' name='user_updated' value='<?php echo $_SESSION['user_id'];?>'/>

<tr>
<?php if($res_info['role_id'] == 1) { ?>
    <?php if($user_role == 1) { ?>
        <th colspan="2">
            <input type="submit" class="buttonsub cursor" name="submit" id="submit" value="SUBMIT">
        </th>
    <?php } else { ?>
        <th colspan="2">
        </tr>
    <?php } ?>
<?php } else { ?>
    <th colspan="2">
        <input type="submit" class="buttonsub" name="submit" id="submit" value="SUBMIT">
    </th>
<?php } ?>
</tr>

<tr><td>User Name :</td><td><input type="text" name="name" id="name" value="<?php echo $res_info['user_name'];?>" required/></td></tr>
<tr><td>Email :</td><td><input type="email" name="email" id="email" value="<?php echo $res_info['email'];?>" required/></td></tr>
<tr><td>Cell number :</td><td><input type="tel" name="sphone" id="sphone" maxlength="10" value="<?php echo $res_info['contact_no'];?>" /></td></tr>


<tr><td>Role Id :</td><td><select name="role_id" id="role_id" required onchange="change();">
<?php $qry_role = mysqli_query($Conn1,"select id as role_id,role_name as role_type from crm_master_user_role");
     while($res_role = mysqli_fetch_array($qry_role)) {?>
        <?php if($res_role['role_id'] == 1) { ?>
            <?php if($user_role == 1) { ?>
                <option value="<?php echo $res_role['role_id'];?>" <?php if($res_role['role_id'] == $res_info['role_id']){?>selected<?php } ?>><?php echo $res_role['role_type'];?></option>
            <?php } ?>
        <?php } else { ?>
            <option value="<?php echo $res_role['role_id'];?>" <?php if($res_role['role_id'] == $res_info['role_id']){?>selected<?php } ?>><?php echo $res_role['role_type'];?></option>
        <?php } ?>
	<?php } ?>
</select></td></tr>


<tr class="password_flag hidden">
    <td>Password :</td>
    <td>
        <input type="password" name="password_flag" id="password_flag" value="" maxlength="8" placeholder="Password"/>
        <small style='color: red'>* 8 digit required</small>
    </td>
</tr>
<tr class="show_number_flag hidden">
    <td>Show Number Flag :</td>
    <td>
        <select name="show_number_flag" id="show_number_flag">
            <option value="">Show Number Status</option>
            <option value="1" <?php echo ($res_info['show_number_flag'] == 1) ? "selected" : "";  ?>>Fully Visible</option>
            <option value="2" <?php echo ($res_info['show_number_flag'] == 2) ? "selected" : "";  ?>>Partially Visible</option>
            <option value="3" <?php echo ($res_info['show_number_flag'] == 3) ? "selected" : "";  ?>>Completely Invisible</option>
        </select>
    </td>
</tr>


<tr><td>Sms On Lead :</td><td><select name="sms_flag" id="sms_flag" required><option value="">Sms on lead</option><option value="1" <?php if($res_info['sms_flag'] == 1){?>selected<?php }?>>Yes</option><option value="0" <?php if($res_info['sms_flag'] == 0){?>selected<?php }?>>No</option></select></td></tr>

<tr><td>Status : </td><td><select name="status" id="status" ><option value="">Status</option><option value="0" <?php if($res_info['status'] == 0){?>selected<?php }?>>Inactive</option><option value="1" <?php if($res_info['status'] == 1){?>selected<?php }?>>Active</option></select></td></tr>

<tr id="t_lead"><td>Team Leader : </td><td>
<?php $qry_tl = mysqli_query($Conn1,"select name as user_name, id as user_id from crm_master_user where role_id = 2 and is_active = 1");
while($res_tl = mysqli_fetch_array($qry_tl)){?>
<input type="checkbox" name="tl[]" value="<?php echo $res_tl['user_id'];?>" <?php if(in_array($res_tl['user_id'],$tl_id_arr)){?>checked<?php }?>><?php echo $res_tl['user_name'];?>
<?php } ?></td></tr>
<tr id="t_loan"><td>Loan Name</td><td width="70%">
<?php $qry_ln = mysqli_query($Conn1,"select id as loan_type_id,value as loan_type_name from crm_masters where crm_masters_code_id = 1 and is_active = 1");
      while($res_ln = mysqli_fetch_array($qry_ln)){?>
 <input type="checkbox" name="loan_type[]" value="<?php echo $res_ln['loan_type_id'];?>" <?php if(in_array($res_ln['loan_type_id'],$loan_type_arr)){?>checked<?php }?>><?php echo $res_ln['loan_type_name'];?>
	  <?php } ?> </td></tr>
</tbody>
</table>
</form>
</div>

<script>
function change() { 
    var role = $("#role_id").val();
    var login_role = "<?php echo $user_role; ?>";
    var login_user = "<?php echo $user; ?>";
    if(role == '3'){
        $("#t_lead,#t_loan").removeClass("hidden");
    } else if(role == '5'){
        $("#t_lead,#t_loan").addClass("hidden");
    } else {
        if(role == '4' ||  role == '9') {
            $("#t_lead").addClass("hidden");
            $("#t_loan").removeClass("hidden");
        } else {
            $("#t_lead,#t_loan").addClass("hidden");
        }
    }	
}

$(document).ready(function() {
    var role_id = $("#role_id option:selected").val();
    var login_role = "<?php echo $user_role; ?>";

    var login_user_id = "<?php echo $user; ?>";
    if(login_role == 1 || login_user_id == 241 || login_user_id == 16 || login_user_id == 83 || login_user_id == 318 || login_user_id == 150 || login_user_id == 314) {
        $(".password_flag").removeClass("hidden");
    } else {
        $(".password_flag").addClass("hidden");
    }

    if(login_role == 1 || login_user_id == 241 || login_user_id == 16 || login_user_id == 83 || login_user_id == 314) {
        $(".show_number_flag").removeClass("hidden");
    } else {
        $(".show_number_flag").addClass("hidden");
    }
});
</script>