<?php 
$slave =1;
require_once "../../include/config.php";
require_once "../../include/helper.functions.php";
require_once "../../include/check-session.php";
$case_id = $_REQUEST['case_id'];
$get_all_app_data = mysqli_query($Conn1,"select group_concat(app_id SEPARATOR ',') as app_ids from tbl_mint_app where case_id = ".$case_id);
if(mysqli_num_rows($get_all_app_data) > 0){
	$result_app_data = mysqli_fetch_assoc($get_all_app_data);
	$get_data = mysqli_query($Conn1,"select * from documents_list_sent_to_customers where level_id IN (".$result_app_data['app_ids'].") and document_upload = 0");
	if(mysqli_num_rows($get_data) > 0){	?>
		<table class='gridtable' width='100%'>
			<tr><th>Application ID</th><th>Bank Name</th><th>Proof Type</th><th>Document Name</th><th>Link Sent On</th><th>Link Expired On</th></tr>
		<?php while($result_data = mysqli_fetch_assoc($get_data)){
		$get_bank_name = mysqli_query($Conn1,"select bank_name from tbl_mint_app as app INNER JOIN tbl_bank as bank ON app.app_bank_on = bank.bank_id where app_id = ".$result_data['level_id']);
		$result_bank_name = mysqli_fetch_assoc($get_bank_name);
		 ?>
			<tr>
				<td><?php echo $result_data['level_id']; ?></td>
				<td><?php echo $result_bank_name['bank_name']; ?></td>
				<td><?php if($result_data['proof_type'] == 1){
					echo "KYC";
				}else if($result_data['proof_type'] == 2){
					echo "Income Proof";
				}else if($result_data['proof_type'] == 4){
					echo "Photograph";
				}else if($result_data['proof_type'] == 5){
					echo "Other";
				}; ?></td>
				<td>
					<?php $get_document_name_qry = mysqli_query($Conn1,"select group_concat(proof_name SEPARATOR ', ') as proof_name from  `tbl_address_proof` where proof_id IN (".$result_data['document_list'].")");
					$result_document_name_qry = mysqli_fetch_assoc($get_document_name_qry);
					echo $result_document_name_qry['proof_name']; ?>
				</td>
				<td><?php echo date('d M Y',strtotime($result_data['date'])); ?></td><td><?php echo date('d M Y',strtotime($result_data['expired_on'])); ?></td>
			</tr>
		<?php } ?>
	</table>
	<?php }else{
		echo "No Data Found";
	}
}else{
	echo "No Data Found";
}
?>
