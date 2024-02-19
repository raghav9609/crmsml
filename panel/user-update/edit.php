<?php 
require_once(dirname(__FILE__) . '/../../config/session.php');
require_once(dirname(__FILE__) . '/../../helpers/common-helper.php');
require_once "../../include/header.php";
require_once "../../include/helper.functions.php";
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
    text-shadow: '';
}
</style>
<div style="padding: 3%;">
<a href="index.php">Back</a> 

<form name="update_form" method="POST">
<fieldset><legend>Search</legend>
User Name: <input type="text" name="user_select" id="user_select" placeholder="User Name"/>
Status: <select name="status" id="status"><option value="">Select User Status</option><option value="1">Active</option> <option value="0">Inactive</option></select>
Loan Type: <?php echo get_dropdown(1, "loan_type", "", ""); ?>
Mobile Number: <input type="text" name="mobile_number" id="mobile_number" placeholder="Mobile Number"/>

Last Login Date: <input type="text" class="text-input" name="last_login" id="last_login" placeholder="Last Login Date" maxlength="10" value="">

<input type="button" name="submit" value="SUBMIT" onclick="search_as()"/></fieldset>
</form>

<div id="user"></div>
</div>

<link rel="stylesheet" href="../../assets/css/jquery-ui.css">
<script type="text/javascript" src="../../assets/js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="../../assets/js/jquery-ui.js"></script>
<script>
$(function() {
    $("#user_select").autocomplete({
	    source: "../../include/name_search.php",
	    minLength: 3,
    });

    $('#last_login').datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd'
    });
});

function search_as(){ 
    var user =  $("#user_select").val();
    var status = $("#status").val();

    var mobile_number = $("#mobile_number").val();
    var loan_type = $("#loan_type").val();
    var last_login = $("#last_login").val();

    $.ajax({
        type:  "POST",
        cache:  false ,
        url:  "<?php echo $head_url; ?>/panel/user-update/search_data.php",
        data: "user_select="+user+"&status="+status+"&mobile_number="+mobile_number+"&loan_type="+loan_type+"&last_login="+last_login,
        success: function(html){
            $("#user").html(html);
        }
    });
}
</script>