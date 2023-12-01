<?php 
require_once(dirname(__FILE__) . '/../../config/session.php');
require_once(dirname(__FILE__) . '/../../helpers/common-helper.php');
require_once "../../include/header.php";
include("../../include/helper.functions.php");

echo $user_role;

 $msg = $_REQUEST['msg'];
if($msg == '1'){ 
 $message = "<span class='green'>Id Created Successfully!!!</span>";
} else if($msg == '2') {
     $message = "<span class='red'>Email Id Already Exists</span>";
} else if($msg == '3') {
    $message = "<span class='red'>Password should be of 8 characters</span>";
} else {
    $message = '';
}
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
    text-shadow: '';
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
<div style="padding-left: 10%;padding-top: 2%;">
<a href="index.php">Back</a> 

<h3>Create New Joinee CRM Id </h3>
<h4><?php echo $message;?></h4>
<form name="joinee_form" action="submit.php" method="POST" autocomplete="OFF" onsubmit="return joinee_validation()">
<table class="gridtable" style='margin-left:2%;width:80%;'>
<tbody>
<tr><th colspan="2"><input type="submit" class="buttonsub cursor" name="submit" id="submit" value="SUBMIT"></th></tr>
<tr><td>User Name :</td><td><input type="text" name="name" id="name" value="" required/></td></tr>
<tr><td>Email :</td><td><input type="email" name="email" id="email" value="" required/></td></tr>

<tr><td>Role Id :</td><td><select name="role_id" id="role_id" required onchange="change();">
<?php $qry_role = mysqli_query($Conn1,"select id as role_id,role_name As role_type from crm_master_user_role");
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
<tr class="lead_view_row hidden">
    <td>Lead View :</td>
    <td>
        <select name="lead_view" id="lead_view">
            <option value="">Select Lead View Type</option>
            <option value="0">Grid View</option>
            <option value="1">One Lead</option>
        </select>
    </td>
</tr>
<tr class="support_desk_flag_row hidden">
    <td>Support Desk Flag :</td>
    <td>
        <select name="support_desk_flag" id="support_desk_flag">
            <option value="" selected>Support Desk Status</option>
            <option value="0">Inactive</option>
            <option value="1">Active</option>
        </select>
    </td>
</tr>

<tr class="total_lead_limit hidden">
    <td>Maximum Lead Count :</td>
    <td>
        <input type="text" name="total_lead_limit" id="total_lead_limit" value="" placeholder="Maximum Lead Count"/>
    </td>
</tr>
<tr class="open_lead_limit hidden">
    <td>Maximum Open Query Count :</td>
    <td>
        <input type="text" name="open_lead_limit" id="open_lead_limit" value="" placeholder="Open Lead Count"/>
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
            <option value="1">Fully Visible</option>
            <option value="2">Partially Visible</option>
            <option value="3">Completely Invisible</option>
        </select>
    </td>
</tr>

<tr id="sms_active"><td>Sms On Lead :</td><td><select name="sms_flag" id="sms_flag" required><option value="">Sms on lead</option><option value="1">Yes</option><option value="0" selected>No</option></select></td></tr>
<tr><td>Status : </td><td><select name="status" id="status" ><option value="">Status</option><option value="0">INACTIVE</option><option value="1" selected>ACTIVE</option></select></td></tr>


<tr id="t_lead"><td>Team Leader : </td><td>
<?php $qry_tl = mysqli_query($Conn1,"select name as user_name, id as user_id from crm_master_user where role_id = 2 and is_active = 1 ");
while($res_tl = mysqli_fetch_array($qry_tl)){?>
<input type="checkbox" name="tl[]" value="<?php echo $res_tl['user_id'];?>"><?php echo $res_tl['user_name'];?>
<?php } ?></select></td></tr>
<tr id="t_loan"><td>Loan Name</td><td width="70%">
<?php $qry_ln = mysqli_query($Conn1,"select id As loan_type_id, value as loan_type_name from crm_masters where crm_masters_code_id = 1 and is_active = 1");
      while($res_ln = mysqli_fetch_array($qry_ln)){?>
		  <input type="checkbox" name="loan_type[]" value="<?php echo $res_ln['loan_type_id'];?>"><?php echo $res_ln['loan_type_name'];?>
	  <?php } ?> </td></tr>
</tbody>
</table>
</form>
</div>
<script src="<?php echo $head_url; ?>/include/js/jquery-1.10.2.js" type="text/javascript"></script>
<script>
function change() {
var login_role = "<?php echo $user_role; ?>";
var login_user = "<?php echo $user; ?>";
var role = $("#role_id").val();
if(role != '3' && role != '2'){
	$("#t_lead").addClass("hidden");
    if(role != '4' && role != '9' && role != '3' && role != '2') {
	    $("#t_loan").addClass("hidden");
    } else {
        $("#t_loan").removeClass("hidden");
    }
    $(".is_fos_flag").addClass("hidden");
} else {
		$("#t_lead").removeClass("hidden");
    $("#t_loan").removeClass("hidden");
    if(role == 2) {
        $(".city_sub_group").removeClass("hidden");
    }
    $(".is_fos_flag").removeClass("hidden");
}	
if(role != '3') {
    $("#sms_active").addClass("hidden");
    $("#t_lead").addClass("hidden");
    $(".lead_view_row").addClass("hidden");
    $(".support_desk_flag_row").addClass("hidden");
    $(".total_lead_limit").addClass("hidden");
    $(".open_lead_limit").addClass("hidden");
    if(role == 2) {
        $(".city_sub_group").removeClass("hidden");
        $(".is_fos_flag").removeClass("hidden");
        if(login_role == 1 || login_user == 241) {
            $(".lead_view_row").removeClass("hidden");
        }
    } else {
        $(".city_sub_group").addClass("hidden");
        $(".is_fos_flag").addClass("hidden");
    }
} else {
        $("#sms_active").removeClass("hidden"); 
        if(login_role == 1 || login_user == 241) {
            $(".lead_view_row").removeClass("hidden");
        }
        $(".support_desk_flag_row").removeClass("hidden");
        $(".total_lead_limit").removeClass("hidden");
        $(".open_lead_limit").removeClass("hidden");
        $(".is_fos_flag").removeClass("hidden");
    }
}
 
$(document).ready(function() {
    var role_id = $("#role_id option:selected").val();
    var login_role = "<?php echo $user_role; ?>";

    var login_user_id = "<?php echo $user; ?>";
    if(login_role == 1 || login_user_id == 241 || login_user_id == 16 || login_user_id == 83 || login_user_id == 314) {
        $(".password_flag").removeClass("hidden");
        $(".show_number_flag").removeClass("hidden");
    } else {
        $(".password_flag").addClass("hidden");
        $(".show_number_flag").addClass("hidden");
    }

    if(login_role == 1 || login_user_id == 241) {
        $(".user_employee_code").removeClass("hidden");
    } else {
        $(".user_employee_code").addClass("hidden");
    }

    if(role_id == 3) {
        if(login_role == 1 || login_user_id == 241) {
            $(".lead_view_row").removeClass("hidden");
        }
        $(".support_desk_flag_row").removeClass("hidden");
        $(".total_lead_limit").removeClass("hidden");
        $(".open_lead_limit").removeClass("hidden");
        $(".is_fos_flag").removeClass("hidden");
    }
    if(role_id == 2) {
        $(".city_sub_group").removeClass("hidden");
        $(".is_fos_flag").removeClass("hidden");
        if(login_role == 1 || login_user_id == 241) {
            $(".lead_view_row").removeClass("hidden");
        }
    }
});

document.getElementById("total_lead_limit").addEventListener("keypress", function (evt) {
    if (evt.which < 48 || evt.which > 57) {
        evt.preventDefault();
    }
});
document.getElementById("open_lead_limit").addEventListener("keypress", function (evt) {
    if (evt.which < 48 || evt.which > 57) {
        evt.preventDefault();
    }
});
</script>
