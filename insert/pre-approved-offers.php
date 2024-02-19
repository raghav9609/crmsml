<?php
$slave=1;
require_once "../../include/config.php";
require_once "../../include/helper.functions.php";
require_once "../../include/display-name-functions.php";
$cust_id = $_REQUEST['cust_id'];
$web_fmd_id = $_REQUEST['web_fmd_id'];
$query_id = $_REQUEST['query_id'];
if(is_numeric($cust_id) && $cust_id > 0){
	$qry = mysqli_query($Conn1,"select off.*,loan.loan_type_name,pat.partner_name from banks_pre_approved_offers as off LEFT JOIN lms_loan_type as loan ON off.loan_type_id = loan.loan_type_id LEFT JOIN tbl_mlc_partner as pat ON off.partner_id = pat.partner_id where cust_id = ".$cust_id." and date > DATE_SUB(NOW(),INTERVAL 3 MONTH) and is_offers = 1 ORDER BY date DESC");
	if(mysqli_num_rows($qry) > 0){
		echo "<table class='gridtable table_set' border='1'><tr><th>S No.</th><th>Loan Name</th><th>Partner Name</th><th>Product</th><th>Loan Amount</th><th>Tenure</th><th>Interest Rate</th><th>Date</th><th>Action</th></tr></tr>";
		$count = 0;
		while($result = mysqli_fetch_assoc($qry)){
			$count++;
			$tennure = $result['tennure']." months";
			$eligible_loan_amt = custom_money_format($result['eligible_loan_amount']);
			if($tennure == 0 || $tennure == ''){
				$tennure = ' - ';
			}
			if($eligible_loan_amt == 0 || $eligible_loan_amt == ''){
				$eligible_loan_amt = ' - ';
			}
			$loan_type_name = $result['loan_type_name'];
			if($result['loan_type_name'] == ''){
				$loan_type_name = ' - ';
			}
			$partner_name = $result['partner_name'];
			if($result['partner_name'] == ''){
				$partner_name = ' - ';
			}
			$roi = !empty( $result['rate_of_interest'] ) ? $result['rate_of_interest'].'%' : '';
			if($result['partner_id']==23){
				
				$qryApp = mysqli_query($Conn1, "SELECT app_id FROM `tbl_mint_app` where app_bank_on='11' and query_id=".$query_id." ");
				if(mysqli_num_rows($qryApp) == 0){

					$yer_emi = $result['tennure'];	
					$intt_emi = $result['rate_of_interest']/(12*100);
					$emi_sem_emi = ($result['eligible_loan_amount'] * $intt_emi * pow((1+$intt_emi),$yer_emi))/(pow((1+$intt_emi),$yer_emi)-1);
					$emi_axis = round($emi_sem_emi*100)/100;
					$axis_url = $api_head_url.'apply/bank-apply.php?uid=' . base64_encode($web_fmd_id) . '&apply=' . base64_encode($result['partner_id'] . "@#Axis Bank@#" .$result['tennure']. "@#" .$result['rate_of_interest']. "@#" .$result['processing_fee']. "@#" .$emi_axis).'&axis=cHJlQXBwcm92ZWQ=';
					$axis_url1 = "<td><a class='btn btn-primary valid' href='".$axis_url."' target='_blank'>Apply Now</a></td>";
				}
				else{
					$axis_url1 = '<td></td>';
				}
			}else{
				$axis_url1 = '<td></td>';
			}
			echo "<tr><td>".$count."</td><td>".$loan_type_name."</td><td>".$partner_name."</td><td>".$result['product_approved_for']."</td><td>".$eligible_loan_amt."</td><td>".$tennure."</td><td>".$roi."</td><td>".date('d M Y H:i',strtotime($result['date']))."</td>".$axis_url1."</tr>";
		}
		echo "</table>";
	}	
}
?>