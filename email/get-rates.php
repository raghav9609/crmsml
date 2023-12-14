<?php
$formInputs = array('occup_id'=>$occup_id,'loan_type'=>$loan_type_id,'comp_id'=>$comp_id_l,'loan_nature'=>$pur_loan,'loan_amt'=>$loan_amt,'extng_amt'=>$extng_amt,'net_incm'=>$net_incm_long,'city_id'=>$city_id,'gold_type'=>$gold_type,'loan_emi'=>$loan_emi,'asset_type'=>$prop_type,'cur_rate'=>$cur_rate,'weight_gold'=>$weight_gold,'purity_gold'=>$purity_gold,'borrower_count'=>$borrower_count,'dob'=>$dob,'dob_on'=>$dob_on,'dob_tw'=>$dob_tw,'cur_emi_tw'=>$cur_emi_tw,'cur_emi_on'=>$cur_emi_on,'net_incm_on'=>$net_incm_on,'net_incm_tw'=>$net_incm_tw,'twe'=>$twe,'slry_paid'=>$slry_paid,'exis_loans'=>$no_of_loan,'credit_running'=>$no_of_credit_card,'profession_id'=>$profession_id,'bus_nature'=>$bus_nature,'annual_turnover_num'=>$annual_turnover_num,'business_existing_num'=>$business_existing_num,'itr_available_num'=>$itr_available_num,'property_identified_sale_type_id'=>$property_identified_sale_type_id,'property_location_id'=>$property_location_id,'property_size'=>$property_size,'property_city_id'=>$property_city_id,'property_identified'=>$property_identified,'template_id'=>$template,'compare_select'=>1,'query_id'=>$query_id,'user_id'=>$user);
$params = json_encode($formInputs);
$api_url = "https://myloancrm.com/sugar/offers/index.php";
$soap_do = curl_init(); 
curl_setopt($soap_do, CURLOPT_URL, $api_url );   
curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 10); 
curl_setopt($soap_do, CURLOPT_TIMEOUT,        500); 
curl_setopt($soap_do, CURLOPT_FOLLOWLOCATION, false);
curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, true ); 
curl_setopt($soap_do, CURLOPT_POST,           true ); 
curl_setopt($soap_do, CURLOPT_POSTFIELDS,$params); 
curl_setopt($soap_do, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',                                                                                
    'Content-Length: ' . strlen($params))                                                                       
); 
$get_rates_arr = curl_exec($soap_do);
$get_otuput = json_decode($get_rates_arr,true);
// if($user == 173){
// 	print_r($get_rates_arr);
// 	echo "<br>";
// }

$i = 1;
$count =0;
foreach($get_otuput['resp'] as $key=>$final_get_output){
	
    if ($i%2 == 0){
        $data_fetch .= '<tr>';
    }
if($final_get_output[fix_flo] !=''){
    $rate_type = '('.$final_get_output[$key][fix_flo].')';
}else {
    $rate_type = '';
} 
$data_fetch .= '<td style="padding: 10px 20px" id ="'.$final_get_output['bank_name']."_".$final_get_output['fix_flo'].'">
							<table style="background: #ffffff;width: 100%;font-size: 14px;border: 1px solid #a5a5a5;border-spacing: 0px;border-radius: 5px;text-align: left;">
								<tr>
									<td colspan="2" style="border-bottom: 1px solid #a5a5a5;padding: 6px;font-size: 18px;background: #ec6c03;border-radius: 5px 5px 0px 0px;text-align: center;">
										<b style="text-decoration:none;color: #ffffff;">'.$final_get_output[bank_name].'</b></td>
								</tr>
								<tr style="background: #004e63;color: #ffffff;font-size: 14px">
									<td style="padding: 5px 8px;border-right: 1px solid #dddddd;border-bottom: 1px solid #dddddd;width: 50%;"><b>Interest Rate*</b></td>
									<td style="padding: 5px 8px;border-bottom: 1px solid #dddddd">'.$final_get_output[rate].'% '.$final_get_output[rate_high].'</td>
								</tr>
								<tr style="font-size: 14px">
									<td style="color: #ec6c03;padding: 5px 8px;border-right: 1px solid #dddddd;border-bottom: 1px solid #dddddd;width: 50%;"><b>Processing Fees*:</b></td>
									<td style="padding: 5px 8px;border-bottom: 1px solid #dddddd">'.str_replace("\u20b9", "Rs. ", $final_get_output[fees]).'</td>
								</tr>
								<tr style="font-size: 14px">
									<td style="color: #ec6c03;padding: 5px 8px;border-right: 1px solid #dddddd;border-bottom: 1px solid #dddddd;width: 50%;"><b>EMI*:</b></td>
									<td style="padding: 5px 8px;border-bottom: 1px solid #dddddd">'.str_replace("\u20b9", "Rs. ", $final_get_output[emi]).' For '.$final_get_output[tennure].'</td>
								</tr>';
if($pur_loan != 2){
$data_fetch .= '<tr style="font-size: 14px">
									<td style="color: #ec6c03;padding: 5px 8px;border-right: 1px solid #dddddd;border-bottom: 1px solid #dddddd;width: 50%;"><b>Loan Amount*:</b></td>
									<td style="padding: 5px 8px;border-bottom: 1px solid #dddddd">Rs. '.$final_get_output[eligibility].'</td>
								</tr>';
}
$data_fetch .= '<tr style="font-size: 14px">
									<td style="color: #ec6c03;padding: 5px 8px;border-right: 1px solid #dddddd;border-bottom: 1px solid #dddddd;width: 50%;"><b>Cashback*:</b></td>
									<td style="padding: 5px 8px;border-bottom: 1px solid #dddddd">'.str_replace("\u20b9", "Rs. ", $final_get_output[cashback]).'/-*</td>
								</tr>

							</table>
						</td>';
     	if ($i%2 == 0){
        $data_fetch .= '</tr>';
    }
$final = $data_fetch;
$get_bank_option[] = array('bank'=>$final_get_output[bank_name],'rate_type'=>$final_get_output[fix_flo]);
$i++;
$count++;
}
//print_r($get_bank_option);
?>