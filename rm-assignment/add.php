<?php
require_once "../../../include/crm-header.php";
require_once "../../../include/dropdown.php";
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../../../include/style.css"> 
<style>
.new_textbox{
 background:#E6E6E6 none repeat scroll 0% 0%;
 color:#000;
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
        cursor: pointer;
}
.msg{
    margin: 10px 200px 10px 200px;
    padding: 20px 10px 20px 10px;
    font-size: 21px;
}
.exists{
    background-color: #f9d0d0;
}
.success{
    background-color: #d0f9db;
}
</style>
<script>
function clear_fnc(){
$('#partner_mlc').val('');
$('#loan_type').val('');
$('#u_assign').val('');
$("#partners").html('');
}
function get_partner(){
 var selected = $("#loan_type option:selected");
       var val = selected.val();
  
$.ajax({
        type: "POST",
        data: "loan_type_id="+val,
        url: "<?php echo $head_url; ?>/sugar/assign/disbursed-application/partner_checkbox.php",
        success: function (html){
        	if (html !='' || html !=null) {
           		$("#partners").html('<span>Select Partners</span><br>'+html);
        	}
        }
});

$('form').submit( function(ev){
         ev.preventDefault();
         checked = $("input[type=checkbox]:checked").length;
            if (checked<=0) {
                alert('Please select atleast one partner');
            }else{
         $(this).unbind('submit').submit()
            }

  });
}
</script> 
</head>
<body>
<div style="margin:0 auto; width:90%; padding:10px; background-color:#fff">
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="insert_form">

<table class="gridtable" style='width: 100%'>
    <tr>
        <th colspan="2"><input class="buttonsub" type = 'button' value='Clear' name='clear_btn' onclick='clear_fnc();'>
        <input class="buttonsub" type = 'submit' value='Insert' name='search_btn' id="submit_btn"></th>
    </tr>
    <tr>
        <td style="width: 50%; font-weight:600">Select Loan Type</td>
        <td><?php echo get_dropdown('loan_type','loan_type','','onchange="get_partner()" required'); ?></td>
    </tr>
    <tr>
        <td style="width: 50%; font-weight:600">Select User</td>
        <td><?php echo get_dropdown('user_assign','u_assign','','required');?></td>
    </tr>
    <tr>
        <td colspan="2">
            <div id="partners"></div>
        </td>
    </tr>
</table>

</form>
</div>
<div id="loan"></div>
<?php 
if (isset($_REQUEST['loan_type'])) {
	$loan_type=replace_special($_REQUEST['loan_type']);
	$u_assign=replace_special($_REQUEST['u_assign']);
	$partner_mlc=replace_special($_REQUEST['partner_mlc']);

	foreach ($partner_mlc as $partner) {	
 
         $insert_partner_query= "INSERT INTO tbl_mint_app_assign (`partner_id`,`loan_type`,`app_user_id`,`status`) SELECT $partner,$loan_type,$u_assign,1 FROM DUAL WHERE NOT EXISTS(SELECT partner_id FROM tbl_mint_app_assign WHERE partner_id=$partner AND loan_type=$loan_type AND app_user_id=$u_assign LIMIT 1)";
         if(!mysqli_query($Conn1,$insert_partner_query)){
            echo "Something Went wrong with the query";
         }
    }

    if (mysqli_affected_rows() > 0) {
                echo "<div class='success msg'> Records Successfully Inserted</div>";
            }elseif(mysqli_affected_rows() ==0){
                echo "<div class='exists msg'> Records already exists </div>";
    }
}
include("../../../include/footer_close.php");
?>
</body></html>
