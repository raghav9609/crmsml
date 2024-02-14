<?php
// require_once "../../include/crm-header.php";
// require_once "../../include/dropdown.php";
require_once(dirname(__FILE__) . '/../../config/session.php');
require_once(dirname(__FILE__) . '/../../helpers/common-helper.php');
require_once "../../include/header.php";
include("../../include/helper.functions.php");

$msg = $_REQUEST['msg'];
$message = "";
if($msg == 1) {
    $message = "<label style='color: red'>Password Fields empty</label>";
} else if($msg == 2) {
    $message = "<label style='color: red'>User not found</label>";
} else if($msg == 3) {
    $message = "<label style='color: red'>Existing (OLD) password does not match</label>";
} else if($msg == 4) {
    $message = "<label style='color: red'>New and confirm password does not match</label>";
} else if($msg == 5) {
    $message = "<label style='color: green'>Successfully Updated</label>";
} else {
    $message = "";
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../../assets/css/multiselect.css">
    <link rel="stylesheet" type="text/css" href="../../assets/style.css" />
    <style>
    </style>
    <script src="../../assets/js/jquery-1.10.2.js"></script>
    <script>
    function validatePassword() {
        var old_pass = $("#old_password").val();
        var new_pass = $("#new_password").val();
        var confirm_new_pass = $("#confirm_new_password").val();
        var alnu_regex = /((^[0-9]+[a-zA-Z]+)|(^[a-zA-Z]+[0-9]+))+[0-9a-zA-Z]*$/i;

        if(new_pass != confirm_new_pass) {
            alert("New Password and Confirm Password does not match");
            return false;
        }

        if(old_pass.length != 8 || new_pass.length != 8 || confirm_new_pass.length != 8) {
            alert("All Password Fields should be of 8 characters");
            return false;
        }

        if(!new_pass.match(alnu_regex)) {
            alert("Alphanumeric required in New Password");
            return false;
        }

        if(!confirm_new_pass.match(alnu_regex)) {
            alert("Alphanumeric required in Confirm Password");
            return false;
        }
    }
    </script>
</head>
<body>
    <div style="padding-left: 10%; padding-top: 2%;">
        <h4 id="err_suc"><?php echo $message;?></h4>
        <form action="update.php" method="POST" autocomplete="OFF" onsubmit="return validatePassword()">
            <table class="gridtable" style='margin-left:2%;width:80%;'>
                <tbody>
                    <tr><th colspan="2"><label style='font-size: 15px'>Reset Password</label></th></tr>
                    <tr>
                        <th colspan="2">
                            <input type="submit" class="buttonsub" name="submit" id="submit" value="Update">                            
                        </th>
                    </tr>
                    <tr>
                        <td>Old Password <label style='color: red'>*</label> :</td>
                        <td>
                            <input type="password" name="old_password" id="old_password" value="" placeholder="Old Password" maxlength="10" required/>
                            <small style='color: red'>* 8 digit required</small>
                        </td>
                    </tr>
                    <tr>
                        <td>New Password <label style='color: red'>*</label> :</td>
                        <td>
                            <input type="password" name="new_password" id="new_password" value="" placeholder="New Password" maxlength="8" required/>
                            <small style='color: red'>* 8 digit required</small>
                        </td>
                    </tr>
                    <tr>
                        <td>Confirm New Password <label style='color: red'>*</label> :</td>
                        <td>
                            <input type="password" name="confirm_new_password" id="confirm_new_password" value="" placeholder="Confirm New Password" maxlength="8" required/>
                            <small style='color: red'>* 8 digit required</small>
                        </td>
                    </tr>                   
                </tbody>
            </table>
        </form>
    </div>    
</body>
</html>