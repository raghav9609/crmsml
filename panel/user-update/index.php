<?php 
require_once "../../include/crm-header.php";
$messge = $_REQUEST['msg'];
if($messge == "1"){
	$meassage = "CRM Id Created Successfully !!!!!";
} 
if($messge == "2"){
	$meassage = "User Information Updated Successfully !!!!!";
}
if($messge == "3") {
	$meassage = "Invalid length of Password";
}

?>

<h3 class="ml30 mt30">CRM Dashboard</h3>

<table class="gridtable" style="margin-left:2%;width:80%;">
<tbody>
<tr><td>Create New Joinee CRM Id</td><td><a href="joinee_form.php"><b>Create New Joinee CRM Id</b></a>
	 </td></tr>
<tr><td>Update User Information</td><td><a href="edit.php"><b>Update User Information</b></a></td></tr>
</tbody>
</table>