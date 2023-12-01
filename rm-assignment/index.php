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
</style>
<script>
function clear_fnc(){
$('#partner_mlc').val('');
$('#loan_type').val('');
$('#u_assign').val('');
}

function search_as(){ 
var loan_type =  $("#loan_type").val();
var partner_mlc =  $("#partner_mlc").val();
var user_mlc =  $("#u_assign").val();
$.ajax({
type:  "GET",
cache:  false ,
url:  "search_assign.php",
data: "loan_type=" + loan_type+"&mlc_user="+user_mlc+"&partner_mlc="+partner_mlc,
success: function(html)
{
$("#loan").html(html);
}
});
}
</script> 
</head>
<body>
<div style="width:100%;"> 
<fieldset style='width:90%;margin-left:5%;'><legend style= 'color:#2E2EAB;font-weight: bold;'>Search Filter</legend>
<?php 
echo get_dropdown('loan_type','loan_type','',''); 
echo get_dropdown('user_assign','u_assign','','');
echo get_dropdown('partner_list','partner_mlc','','');
?>
<input class="cusror" type = 'button' value='Search' name='search_btn' onclick= 'search_as();'>
<input class="cusror" type = 'button' value='Clear' name='clear_btn' onclick='clear_fnc();'>
<a href="add.php"><input type = 'button' value='Add' name='clear_btn' class='buttonsub cursor'></a>

</fieldset>
</div>
<div id="loan"></div>
<?php 
if(isset($_REQUEST["update"])){
$chech_id = replace_special($_REQUEST['ch_edit']);
for($i=0;$i<count($chech_id);$i++){
$user_ra = $chech_id[$i]."_user";
$partner_ra = $chech_id[$i]."_partner";

$user = replace_special($_REQUEST[$user_ra]);
$partner = replace_special($_REQUEST[$partner_ra]);
if($partner == ''){
$status = '0';
} else {
$status = '1';
}

$query = "update tbl_mint_app_assign SET app_user_id = '".$user."',partner_id = '".$partner."', status = '".$status."' WHERE assign_id = '".$chech_id[$i]."'";
 $update_auto_query = mysqli_query($Conn1,$query);
}
}
include("../../../include/footer_close.php");
?>
</body></html>