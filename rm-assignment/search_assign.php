<?php
require_once "../../../include/check-session.php";
require_once "../../../include/config.php";
require_once "../../../include/dropdown.php";


$loan_type = replace_special($_REQUEST['loan_type']);
$mlc_user = replace_special($_REQUEST['mlc_user']);
$partner_mlc = replace_special($_REQUEST['partner_mlc']);
$qry = "select distinct(loan_type), app_user_id, partner_id from tbl_mint_app_assign where assign_id != '0'";
if($loan_type != ''){
$qry .= " and loan_type = '".$loan_type."'";
}
if($partner_mlc != ''){
$qry .= " and partner_id = '".$partner_mlc."'";
}
if($mlc_user != ''){
$qry .= " and app_user_id = '".$mlc_user."'";
}
$qry .= " order by assign_id desc";
$result_record_query = mysqli_query($Conn1,$qry);
?>
<div style="margin:0 auto; width:90%; padding:10px; background-color:#fff; height:800px;">
<form action="" method="POST">
<table class="gridtable" width="100%;">
<tr><th colspan="5"><input type="submit" name="update" class="buttonsub ml10"  value="Update" /></th></tr>
<tr><th>Loan Type</th><th>MLC Partner</th><th>MLC User</th></tr>
<?php
while($result_record = mysqli_fetch_array($result_record_query)){
$loan_type = $result_record['loan_type'];
$id_user = $result_record['app_user_id'];
$id_partner = $result_record['partner_id'];

$loan = mysqli_query($Conn1,"select loan_type_name from lms_loan_type where loan_type_id = '".$loan_type."'");
$res_loan = mysqli_fetch_array($loan);
$loan_name = $res_loan['loan_type_name'];

$record_query = "select * from tbl_mint_app_assign where loan_type = '".$loan_type."'";
if($id_user != ''){
$record_query .= " and app_user_id = '".$id_user."'";
}
if($id_partner != ''){
$record_query .= " and partner_id = '".$id_partner."'";
}
$record_query .= " order by assign_id desc";
$query_record = mysqli_query($Conn1,$record_query);
$row_counter = mysqli_num_rows($query_record);
?>
<tr><th rowspan="<?php echo $row_counter ?>"><?php echo $loan_name?></th>
<?php

while($result_record = mysqli_fetch_array($query_record)){
$id= $result_record['assign_id'];
$partner_id = $result_record['partner_id'];
$user_id = $result_record['app_user_id'];
$script[]='<script type="text/javascript">
$("#'.$id.'").change(function(){
if (this.checked) {
            $("#'.$id.'_user").removeAttr("disabled");
            $("#'.$id.'_partner").removeAttr("disabled");
            $("#'.$id.'_user").addClass("new_textbox");
            $("#'.$id.'_partner").addClass("new_textbox");
            } else {
            $("#'.$id.'_user").attr("disabled", true);
            $("#'.$id.'_partner").attr("disabled", true);
            $("#'.$id.'_user").removeClass("new_textbox"); 
            $("#'.$id.'_partner").removeClass("new_textbox"); 
        }
});
</script>';
?>

<td><input type="checkbox" name="ch_edit[]" value="<?php echo $id ?>" id="<?php echo $id ?>" class="loan_type"  />&nbsp;&nbsp;&nbsp;
<?php echo get_dropdown('partner_list',$id.'_partner',$partner_id ,'disabled=""'); ?>
</td>
<td>
<?php echo get_dropdown('user_assign',$id.'_user',$user_id,'disabled=""'); ?>
</td>

</tr>
<?php }  } ?>
</table>
</form>
</div>

<?php echo implode($script);?>

