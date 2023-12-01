<?php 
require_once "../../../include/check-session.php";
require_once "../../../include/config.php";
$loan_type_id = replace_special($_REQUEST['loan_type_id']);

$partner_name_query= "SELECT partner_id,partner_name FROM tbl_mlc_partner WHERE partner_id IN (SELECT pat_id FROM tbl_pat_loan_type_mapping WHERE loan_type=$loan_type_id AND disp_flag=1)";

$partner_name_run= mysqli_query($Conn1,$partner_name_query);
	
while($partner_name = mysqli_fetch_array($partner_name_run)){?>
	<input type="checkbox" name="partner_mlc[]" value="<?php echo $partner_name['partner_id'];?>"><?php echo $partner_name['partner_name']; 
}?>

	 