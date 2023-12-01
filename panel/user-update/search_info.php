<?php 
require_once "../../include/crm-header.php";
include("../../include/dropdown.php");
	$user_id = base64_decode(urldecode($_REQUEST['value']));
	$qry_info = mysqli_query($Conn1,"SELECT u_ass.user_id as user_id,u_ass.user_name as user_name,u_ass.gateway_id as gateway_id,u_ass.email as email,u_ass.contact_no as contact_no, u_ass.scontact_no as scontact_no,u_ass.role_id as role_id, u_ass.case_secd_user as case_secd_user, u_ass.sms_flag as sms_flag, mobile_recording_flag, total_lead_limit, open_lead_limit, super_a_flag, u_ass.is_fos as is_fos, u_ass.status as status,u_ass.port_id as port_id,u_ass.extension as extension,tb_ad.admin_id as admin_id, tb_ad.otp_flag as otp_flag, GROUP_CONCAT(l_typ.loan_type SEPARATOR ',') as loan_type, GROUP_CONCAT(l_typ.tl_id SEPARATOR ',') as tl_id, GROUP_CONCAT(l_ass.user_id SEPARATOR ',') as user_assign, u_ass.one_lead_flag as one_lead_flag, support_desk_flag, GROUP_CONCAT(l_ass.tl_id SEPARATOR ',') as tl_assign, u_ass.hot_lead_limit as hot_lead_limit, u_ass.sme_flag as sme_flag, u_ass.user_employee_code as user_employee_code, u_ass.show_number_flag as show_number_flag, u_ass.is_new_dialer, u_ass.no_of_ringing_slots AS no_of_ringing_slots, u_ass.fos_tl_user AS fos_tl FROM tbl_user_assign as u_ass LEFT JOIN tbl_admin as tb_ad ON tb_ad.user_name = u_ass.email LEFT JOIN tl_user_assignment as l_ass ON l_ass.user_id = u_ass.user_id LEFT JOIN tl_loan_type_assign as l_typ ON l_typ.tl_id = u_ass.user_id where u_ass.user_id='".$user_id."'");
	$res_info = mysqli_fetch_array($qry_info);
	$tl_id_arr = explode(',',$res_info['tl_assign']);
    $loan_type_arr = explode(',',$res_info['loan_type']);
    $no_of_ringing_slots = $res_info['no_of_ringing_slots'];
    $fos_tl = $res_info['fos_tl'];
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
<tr><td>Dailer number :</td><td><input type="tel" name="phone" id="phone" maxlength="10" value="<?php echo $res_info['scontact_no'];?>" /></td></tr>
<tr class="user_employee_code hidden">
    <td>Employee Code :</td>
    <td>
        <input type="text" name="user_employee_code" id="user_employee_code" value="<?php echo $res_info['user_employee_code']; ?>" maxlength="10" placeholder="Employee Code"/>
    </td>
</tr>
<tr><td>Role Id :</td><td><select name="role_id" id="role_id" required onchange="change();">
<?php $qry_role = mysqli_query($Conn1,"select role_id,role_type from tbl_user_role");
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

<tr><td>Secondry User :</td><td><select name="user_ids" id="user_ids" ><option value=''>Select Secondry User</option>
<?php $user_ids = mysqli_query($Conn1,"select user_id, user_name from tbl_user_assign where status = '1' order by user_name");
     while($res_user = mysqli_fetch_array($user_ids)){?>
     <option value="<?php echo $res_user['user_id'];?>" <?php if($res_user['user_id'] == $res_info['case_secd_user']){?>selected<?php } ?>><?php echo $res_user['user_name'];?></option>
    <?php } ?>
</select></td></tr>
<tr class="lead_view_row ">
    <td>Lead View :</td>
    <td>
        <select name="lead_view" id="lead_view">
            <option value="">Select Lead View Type</option>
            <option value="0" <?php echo ($res_info['one_lead_flag'] == 0) ? "selected" : "";  ?>>Grid View</option>
            <option value="1" <?php echo ($res_info['one_lead_flag'] == 1) ? "selected" : "";  ?>>One Lead</option>
        </select>
    </td>
</tr>
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
<tr class="support_desk_flag_row hidden">
    <td>Support Desk Flag :</td>
    <td>
        <select name="support_desk_flag" id="support_desk_flag">
            <option value="">Support Desk Status</option>
            <option value="0" <?php echo ($res_info['support_desk_flag'] == 0) ? "selected" : "";  ?>>Inactive</option>
            <option value="1" <?php echo ($res_info['support_desk_flag'] == 1) ? "selected" : "";  ?>>Active</option>
        </select>
    </td>
</tr>
<tr class="mobile_recording_flag">
    <td>Mobile Recording Flag :</td>
    <td>
        <select name="mobile_recording_flag" id="mobile_recording_flag">
            <option value="" selected>Mobile Recording Status</option>
            <option value="0" <?php echo ($res_info['mobile_recording_flag'] == 0) ? "selected" : "";  ?>>Inactive</option>
            <option value="1" <?php echo ($res_info['mobile_recording_flag'] == 1) ? "selected" : "";  ?>>Active</option>
        </select>
    </td>
</tr>
<tr class="total_lead_limit hidden">
    <td>Maximum Lead Count :</td>
    <td>
        <input type="text" name="total_lead_limit" id="total_lead_limit" value="<?php echo $res_info['total_lead_limit'];?>" placeholder="Maximum Lead Count"/>
    </td>
</tr>
<tr class="open_lead_limit hidden">
    <td>Maximum Open Query Count :</td>
    <td>
        <input type="text" name="open_lead_limit" id="open_lead_limit" value="<?php echo $res_info['open_lead_limit'];?>" placeholder="Open Lead Count"/>
    </td>
</tr>
<tr class="super_a_flag">
    <td>Super A Flag :</td>
    <td>
        <select name="super_a_flag" id="super_a_flag">
            <option value="">Super A Status</option>
            <option value="0" <?php echo ($res_info['super_a_flag'] == 0) ? "selected" : "";  ?>>Inactive</option>
            <option value="1" <?php echo ($res_info['super_a_flag'] == 1) ? "selected" : "";  ?>>Active</option>
        </select>
    </td>
</tr>

<tr>
    <td>No. of Ringing Slots :</td>
    <td><input type="text" class="numonly" name="no_of_ringing_slots" id="no_of_ringing_slots" value="<?php echo $no_of_ringing_slots; ?>"/></td>
</tr>

<tr><td>Sms On Lead :</td><td><select name="sms_flag" id="sms_flag" required><option value="">Sms on lead</option><option value="1" <?php if($res_info['sms_flag'] == 1){?>selected<?php }?>>Yes</option><option value="0" <?php if($res_info['sms_flag'] == 0){?>selected<?php }?>>No</option></select></td></tr>

<tr class='is_fos_flag hidden'>
    <td>is FOS : </td>
    <td>
        <select name="is_fos_flag" id="is_fos_flag">
            <option value="">--Select FOS Flag--</option>
            <option value="0" <?php if($res_info['is_fos'] == 0) { ?> selected <?php }?>>Inactive</option>
            <option value="1" <?php if($res_info['is_fos'] == 1) { ?> selected <?php }?>>Active</option>
        </select>
    </td>
</tr>

<tr>
    <td>FOS TL :</td>
    <td>
        <?php echo get_dropdown("user_assign", "fos_tl", $fos_tl, ""); ?>
    </td>
</tr>

<tr><td>Status : </td><td><select name="status" id="status" ><option value="">Status</option><option value="0" <?php if($res_info['status'] == 0){?>selected<?php }?>>Inactive</option><option value="1" <?php if($res_info['status'] == 1){?>selected<?php }?>>Active</option></select></td></tr>
<!--<tr><th>OTP Flag :</th><td><select name="otp_flag" id="otp_flag" required><option value="">OTP Flag</option><option value="0" <?php if($res_info['otp_flag'] == 0){?>selected<?php }?>>Inactive</option><option value="1" <?php if($res_info['otp_flag'] == 1){?>selected<?php }?>>Active</option></select></td></tr>-->
<tr><td>Extension</td><td>
    <input type='text' name='extension' id='extension' value='<?php echo $res_info['extension'];?>'/></td></tr>
<tr><td>Port</td><td>
<input type='text' name='port_id' id='port_id' value='<?php echo $res_info['port_id'];?>'/></td></tr>

	
<tr><td>Hot Lead Limit : </td><td><input type='text' name='hot_lead_limit' id='hot_lead_limit' value='<?php echo $res_info['hot_lead_limit'];?>'/></td></tr>

<tr><td>SME Flag : </td><td><select name="sme_flag" id="sme_flag" ><option value="">Status</option><option value="0" <?php if($res_info['sme_flag'] == 0){?>selected<?php }?>>Inactive</option><option value="1" <?php if($res_info['sme_flag'] == 1){?>selected<?php }?>>Active</option></select></td></tr>
	
	
<tr><td>Gateway No : </td><td><select name="gateway" id="gateway" > 
<option value="">--Select Gateaway--</option>
<?php $qry_gateway = mysqli_query($Conn1,"select * from dialer_gateway_mapping");
     while($res_gateway = mysqli_fetch_array($qry_gateway)){?>
	 <option value="<?php echo $res_gateway['gateway_id'];?>" <?php if($res_gateway['gateway_id'] == $res_info['gateway_id']){?>selected<?php } ?>><?php echo $res_gateway['gateway_name'].' ('.$res_gateway['gateway_ip'];?>)</option>
	<?php }?></select></td></tr>

<?php if($user_role == 1 || $user == 83 || $user == 314) { ?>
    <tr>
        <td>Dialer Type : </td>
        <td>
            <select name="is_dialer" id="is_dialer">
                <option value="">--Select Dialer--</option>
                <option value="0" <?php echo ($res_info['is_new_dialer'] == 0) ? "selected" : ""; ?> >Neron</option>
                <option value="1" <?php echo ($res_info['is_new_dialer'] == 1) ? "selected" : ""; ?> >In-House</option>
            </select>
        </td>
    </tr>
<?php } ?>

<?php
$city_group_qry = "select GROUP_CONCAT(city_sub_group_id SEPARATOR ',') as city_group_id from tl_city_subgroup_assign where tl_id = '".$user_id."' and status = 1";
$city_group_exe = mysqli_query($Conn1,$city_group_qry);
$city_group_res = mysqli_fetch_array($city_group_exe);

$city_group_id = explode(',', $city_group_res['city_group_id']);
?>
<tr class="city_sub_group hidden" id="city_sub_group">
    <td>City Subgroup :</td>
    <td>
    <?php
        $city_sub_group_qry = mysqli_query($Conn1, "select city_sub_group_id, city_sub_group_name from lms_city_sub_group");
        while($city_sub_group_res = mysqli_fetch_array($city_sub_group_qry)) {
            ?>
            <input type="checkbox" name="c_s_group[]" value="<?php echo $city_sub_group_res['city_sub_group_id'];?>" <?php if(in_array($city_sub_group_res['city_sub_group_id'], $city_group_id)) { ?> checked <?php } ?>>
            <?php echo $city_sub_group_res['city_sub_group_name'];
        }
    ?>
    </td>
</tr>


<tr id="t_lead"><td>Team Leader : </td><td>
<?php $qry_tl = mysqli_query($Conn1,"select user_name, user_id from tbl_user_assign where role_id='2' and status='1'");
while($res_tl = mysqli_fetch_array($qry_tl)){?>
<input type="checkbox" name="tl[]" value="<?php echo $res_tl['user_id'];?>" <?php if(in_array($res_tl['user_id'],$tl_id_arr)){?>checked<?php }?>><?php echo $res_tl['user_name'];?>
<?php } ?></td></tr>
<tr id="t_loan"><td>Loan Name</td><td width="70%">
<?php $qry_ln = mysqli_query($Conn1,"select loan_type_id,loan_type_name from lms_loan_type where  flag='1'");
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
  
    $("#t_lead,#t_loan,.support_desk_flag_row, .total_lead_limit, .open_lead_limit, .is_fos_flag").removeClass("hidden");
    $(".city_sub_group").addClass("hidden");
}else if(role == '5'){
    // $("#t_lead,#t_loan,.lead_view_row, .total_lead_limit, .open_lead_limit, .super_a_flag").addClass("hidden");
    $("#t_lead,#t_loan, .total_lead_limit, .open_lead_limit, .city_sub_group, .is_fos_flag").addClass("hidden");
    $(".support_desk_flag_row").removeClass("hidden");
} else {
    if(role == '4' ||  role == '9') {
        $("#t_lead,.support_desk_flag_row, .total_lead_limit, .open_lead_limit, .is_fos_flag").addClass("hidden");
        $("#t_loan").removeClass("hidden");
    } else {
        $("#t_lead,#t_loan,.support_desk_flag_row, .total_lead_limit, .open_lead_limit, .is_fos_flag").addClass("hidden");
        if(role == '2') {
            $(".city_sub_group").removeClass("hidden");
        } else {
            $(".city_sub_group").addClass("hidden");
        }
    }

    if(role == 2) {
        $(".is_fos_flag").removeClass("hidden");
    } else {
        $(".is_fos_flag").addClass("hidden");
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

    if(login_role == 1 || login_user_id == 241) {
        $(".user_employee_code").removeClass("hidden");
    } else {
        $(".user_employee_code").addClass("hidden");
    }

    if(role_id == 3) {
        $(".support_desk_flag_row").removeClass("hidden");
        $(".open_lead_limit").removeClass("hidden");
        $(".total_lead_limit").removeClass("hidden");
        $(".is_fos_flag").removeClass("hidden");
    }else if(role_id == 5){
        $(".support_desk_flag_row").removeClass("hidden");
    } else if(role_id == 2) {
        $(".city_sub_group").removeClass("hidden");
        $(".is_fos_flag").removeClass("hidden");
        
    }
});
</script>