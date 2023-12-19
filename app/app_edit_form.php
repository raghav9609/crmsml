<script src="../../include/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="../../include/js/format_amount.js"></script>
<?php
$api_radio_to_be_checkd = base64_decode($_REQUEST['app_id']);
$partner_desc= '';
if($exe_app_on['bank_crm_lead_on'] != '' ){
    $get_status = mysqli_query($Conn1,"select description,status from partner_lead_status where app_id = '".$exe_app_on['app_id']."' order by status_id desc limit 1");
		$count_status = mysqli_num_rows($get_status);
		$partner_desc= '';
		if($count_status > 0){
		    $result_status = mysqli_fetch_array($get_status); 
		    $partner_desc = " <span class='green'>(".$result_status['status']." ".$result_status['description'].")</span>"; }
}
$cashback_msg = '';
$cashback_qry = mysqli_query($Conn1,"select count(*) as total from tbl_cash_bonanza where app_id = '".$exe_app_on['app_id']."' and sent_flag = 1");
$result_qry = mysqli_fetch_assoc($cashback_qry);
if($result_qry['total'] > 0){
  $cashback_msg = "(Cashback <span class='green'>&#10003;</span>)";
}
$card_id = $exe_app_on['credit_card_id'];
$card_name = get_display_name('credit_card_list',$card_id);
$banker_name_qry = mysqli_query($Conn1,"select assign_id,sales_name,sales_mobile from tbl_app_assign_banker where app_id = '".$exe_app_on['app_id']."'");
$result_banker_qry = mysqli_fetch_array($banker_name_qry);
$qry_count_api_elig = mysqli_query($Conn1,"select * from tbl_customer_application_api_elig where app_id = '".$exe_app_on['app_id']."'");
$res_count_elig_check = mysqli_num_rows($qry_count_api_elig);
?>    
                        <input type='hidden' name='apply_app_id1_<?php echo $rw_id; ?>' id='apply_app_id1_<?php echo $rw_id; ?>' value = "<?php echo $case_id; ?>">
                        <input type='hidden' name='apply_app_id_<?php echo $rw_id; ?>' id='apply_app_id_<?php echo $rw_id; ?>' value = "<?php echo $exe_app_on['app_id']; ?>">
                        <input type='hidden' name='apply_app_status_on_<?php echo $rw_id; ?>' id='apply_app_status_on_<?php echo $rw_id; ?>' value = "<?php echo $exe_app_on['app_status_on']; ?>">
                        <input type='hidden' name='lead_view_id_<?php echo $rw_id; ?>'  value = "<?php echo $last_view_id; ?>">
                        <input type='hidden' name='click_to_call_id_<?php echo $rw_id; ?>' id='click_to_call_id'  value = "">
                        <input type='hidden' name='apply_pre_login_status_<?php echo $rw_id; ?>' id='apply_pre_login_status_<?php echo $rw_id; ?>' value = "<?php echo $exe_app_on['pre_login_status']; ?>">
<tr style="color:#FF5100;font-size: 14px;font-weight:bold;"><td colspan='8'><b><input type='radio' name='apply_app_num' id='apply_app_num' <?php echo $api_radio_to_be_checkd == $exe_app_on['app_id'] ? 'checked' : ""; ?> value='<?php echo $exe_app_on['id']."_"."$app_count"; ?>'></b><u><?php echo get_display_name('bank_name',$exe_app_on['app_bank_on']); ?></u><?php echo $partner_desc; ?>  <span class='blue'><?php if($loan_type == '71'){  echo '( '.$card_name.' )'; }?></span> &nbsp;&nbsp; &nbsp;&nbsp;<?php if((($exe_app_on['app_bank_on'] == 75 || $exe_app_on['app_bank_on'] == 127  || $exe_app_on['app_bank_on'] == 129 || $exe_app_on['app_bank_on'] == 16) && $loan_type == 56 && $exe_app_on['bank_crm_lead_on'] != '') || $exe_app_on['app_bank_on'] == 75 && $loan_type == 11){ ?>
<a href="send-email-bank.php?case_id=<?php echo urlencode(base64_encode($case_id));?>&loan_type=<?php echo $loan_type;?>&bnk=<?php echo $exe_app_on['app_bank_on'];?>" target="blank" class="has_link">Banker Email</a><?php } echo $cashback_msg; ?></td></tr>
						  <?php if($res_count_elig_check >0){?>
<tr><td ><input type="button" style="float:left;" class="buttonsub" name="check_elig" value="Check Eligibility" onclick="show_egidetal('<?php echo $exe_app_on['app_id'];?>');"></td></tr>	
						  <?php } ?>	
<tr>
<td>Banks Offered</td>
<td><?php $finl_val = "'".$rw_id."'"; echo get_dropdown('bank_name_','app_bank_'.$rw_id,$exe_app_on['app_bank_on'],''); ?>
<input type='hidden' name='bank_type_id_get_<?php echo $rw_id;?>' id='bank_type_id_get_<?php echo $rw_id;?>' value='<?php echo $bank_type_id_fetch;?>'/></td>   
  <td width="21%"><span class="bodytext">Pre Login Status</span></td>
  <td width="15%">
<?php echo get_dropdown('pre_login','pre_status_'.$rw_id,$exe_app_on['pre_login_status'],'onchange="status_on_login(this.id);"'); ?>
</td>
<td width="21%"><span class="bodytext">Post Login Status</span></td>
  <td width="15%"><?php echo get_dropdown('post_login','status_'.$rw_id,$exe_app_on['app_status_on'],'onchange ="status_on_disb(check=1);"');?></td>
</tr><tr>
      <td><span class="bodytext">Applied Amount</span></td>
     <td><input type="text" class="text-input loan_net_incm numonly" name="applied_amount_<?php echo $rw_id; ?>" id="applied_amount_<?php echo $rw_id; ?>" value="<?php echo $exe_app_on['applied_amount_on'];?>" />
     <div class='word_below orange'><b class='applied_amount_<?php echo $rw_id; ?>_value_formt'></b></div>
     </td>
  
 <td><span class="bodytext">Rate Type </span></td>
    <td><?php echo get_dropdown('rate_type','rate_type_'.$rw_id,$exe_app_on['rate_type_on'],'');?></td>
<td><span class="bodytext">Partner</span></td>
   <td><?php echo get_dropdown('app_pat_list','partner_'.$rw_id,$exe_app_on['partner_on'],'');?></td></tr>
 <tr class='log_details <?php if($exe_app_on['pre_login_status'] != '6'){?> hidden <?php } ?>'>  
<td><span class="bodytext">Login Date</span></td>
     <td><input type="text" class="text-input dat" name="login_date_<?php echo $rw_id; ?>" id="login_date_<?php echo $rw_id; ?>" placeholder="yyyy-mm-dd" value="<?php echo $exe_app_on['login_date_on'];?>" /></td>
     <td><span class="bodytext">Sanctioned Amount</span></td>
     <td><input type="text" class="text-input loan_net_incm num-only" name="sanctioned_amount_<?php echo $rw_id; ?>" id="sanctioned_amount_<?php echo $rw_id; ?>" value="<?php echo $exe_app_on['sanctioned_amount_on'];?>" />
     <div class='word_below orange'><b class='sanctioned_amount_<?php echo $rw_id; ?>_value_formt'></b></div>
     </td> 
<td><span class="bodytext">Sanction Date</span></td>
             <td><input type="text" class="text-input dat" name="sanction_date_<?php echo $rw_id; ?>" id="sanction_date_<?php echo $rw_id; ?>" placeholder="yyyy-mm-dd" value="<?php echo $exe_app_on['sanction_date_on'];?>" /></td>
</tr>
<tr class='log_details <?php if($exe_app_on['pre_login_status'] != '6'){?> hidden <?php } ?>'>
<td><span class="bodytext">Loan Tenure in Months</span></td>
<td><input type="text" class="text-input numonly" name="loan_tenure_<?php echo $rw_id; ?>" id="loan_tenure_<?php echo $rw_id; ?>" placeholder="Loan Tenure in Months"  value="<?php echo $exe_app_on['loan_tenure_on'];?>" /></td>   
<td><span class="bodytext">If Fixed, Tenure for which rate is fixed</span></td>
<td><input type="text" class="text-input numonly" name="fixed_tenure_<?php echo $rw_id; ?>" id="fixed_tenure_<?php echo $rw_id; ?>" value="<?php echo $exe_app_on['fixed_tenure_on'];?>"/></td>
<td><span class="bodytext">Rate of Interest</span></td>
<td><input type="text" class="text-input" name="rate_of_in_<?php echo $rw_id; ?>" id="rate_of_in_<?php echo $rw_id; ?>" placeholder ="Rate of Interest" value="<?php echo $exe_app_on['rate_of_in_on'];?>"/></td>
 </tr>
<tr id="disbursed<?php echo $rw_id;?>">
<td><span class="bodytext">Disbursed Amount</span></td>
<td><input type="text" class="text-input loan_net_incm numonly" name="disbursed_amount_<?php echo $rw_id; ?>" id="disbursed_amount_<?php echo $rw_id; ?>" placeholder="Disbursed Amount" value="<?php echo $exe_app_on['disbursed_amount_on'];?>"/>
<div class='word_below orange'><b class='disbursed_amount_<?php echo $rw_id; ?>_value_formt'></b></div>
</td>	
<td><span class="bodytext">First Disb Date</span></td>
<td><input type="text" class="text-input dat" name="first_disb_date_<?php echo $rw_id; ?>" id="first_disb_date_<?php echo $rw_id; ?>" placeholder ="First Disb Date" value="<?php echo $exe_app_on['first_disb_date_on'];?>" /></td>
<td><span class="bodytext">Last Disb Date</span></td>
<td><input type="text" class="text-input dat" name="last_disb_date_<?php echo $rw_id; ?>" id="last_disb_date_<?php echo $rw_id; ?>" placeholder ="Last Disb Date" value="<?php echo $exe_app_on['last_disb_date_on'];?>" /></td>
</tr>
<tr>
<td><span class="bodytext">Bank CRM/ Lead Id</span></td>
<td><input type="text" class="text-input alpha-num-hash" name="bank_crm_lead_<?php echo $rw_id; ?>" id="bank_crm_lead_<?php echo $rw_id; ?>" placeholder ="Bank CRM/ Lead Id" value="<?php echo $exe_app_on['bank_crm_lead_on'];?>" maxlength="30" /></td>
<td><span class="bodytext">Bank Application No.</span></td>
<td><input type="text" class="text-input alpha-num-hyphen" name="bank_app_num_<?php echo $rw_id; ?>" id="bank_app_num_<?php echo $rw_id; ?>" placeholder ="Bank Application No." value="<?php echo $exe_app_on['bank_app_no_on'];?>" maxlength="30"/></td>
<td class='log_details <?php if($exe_app_on['pre_login_status'] != '6'){?> hidden <?php } ?>'><span class="bodytext">Cashback Offered</span></td>
<td class='log_details <?php if($exe_app_on['pre_login_status'] != '6'){?> hidden <?php } ?>'><input type="text" class="text-input numonly" name="cash_offers_<?php echo $rw_id; ?>" id="cash_offers_<?php echo $rw_id; ?>" placeholder ="Cashback Offered" value="<?php echo $exe_app_on['cash_offers_on'];?>" maxlength="30" /></td>
</tr>
<tr><td><span class="bodytext">Follow Up Type</span></td>
<td><?php echo get_dropdown('follow_up_type','follow_type_'.$rw_id,$exe_app_on['follow_up_type_on'],'');?></td>
<td><span class="bodytext">Follow Up Date</span></td>
     <td><input type="text" class="text-input dat" name="follow_date_<?php echo $rw_id; ?>" id="follow_date_<?php echo $rw_id; ?>" placeholder="yyyy-mm-dd" value="<?php echo $exe_app_on['follow_up_date_on'];?>" /> </td>
      <td><span class="bodytext">Follow Up Time</span></td>
    <td>
      <?php
      if($exe_app_on['follow_up_time'] == '00:00:00' || $exe_app_on['follow_up_date_on'] == "0000-00-00" || $exe_app_on['follow_up_date_on'] == "1970-01-01" || $exe_app_on['follow_up_date_on'] == "" || $exe_app_on['follow_up_type_on'] == "" || $exe_app_on['follow_up_type_on'] == 0) {
        $follow_time =  "";
      } else {
        $follow_time = $exe_app_on['follow_up_time'];
      }
      ?>
      <input type="text" class="text-input fol_time" name="follow_up_time_<?php echo $rw_id; ?>" id="follow_up_time_<?php echo $rw_id; ?>" placeholder="h:i:s" value="<?php echo $follow_time; ?>" /> 
    </td>
      </tr>
     <tr>
     <td><span class="bodytext">Description</span></td>
  <td><textarea name="description_<?php echo $rw_id; ?>" id="description_<?php echo $rw_id; ?>" placeholder="Description"><?php echo $exe_app_on['app_description'];?></textarea></td>
         <?php if($loan_type == 57){ ?>
             <td>Bill Type :</td>
             <td><?php echo get_dropdown('bil_type','bil_type_'.$rw_id, $exe_app_on['bil_type'],'');?></td>
         <?php }else if(in_array($loan_type,array('51','54','52'))){ ?>
             <td>Property Status :</td>
             <td><?php echo get_dropdown('app_property_status','property_status_'.$rw_id, $exe_app_on['property_status'],'');?></td>
         <?php } ?>
         <!--<td>Legal OK :</td>
     <td><input type="radio" name='legal_ok_<?php /*echo $rw_id; */?>' value="1" <?php /*echo $exe_app_on['legal_ok'] == 1 ? "checked" : "" ; */?>> Yes &nbsp; &nbsp; &nbsp;
      <input type="radio" name='legal_ok_<?php /*echo $rw_id; */?>' value="0" <?php /*echo $exe_app_on['legal_ok'] != 1 ? "checked" : "" ; */?>> No
    </td>
 <td >Technical OK : </td>
  <td> <input type="radio" name='tech_ok_<?php /*echo $rw_id; */?>' value="1" <?php /*echo $exe_app_on['tech_ok'] == 1 ? "checked" : "" ; */?>> Yes &nbsp; &nbsp; &nbsp;
      <input type="radio" name='tech_ok_<?php /*echo $rw_id; */?>' value="0" <?php /*echo $exe_app_on['tech_ok'] != 1 ? "checked" : "" ; */?>> No </td>-->
 </tr>

<tr>
  <td>Cibil Score</td>
  <td><input type="text" class="text-input num-hyphen" name="cibil_score_num_<?php echo $rw_id; ?>" id="cibil_score_num_<?php echo $rw_id; ?>" placeholder="Cibil Score" value="<?php echo $exe_app_on['cibil_score'];?>" maxlength="5"/></td>
</tr>

  <tr>
     <td class='cashback_sms_<?php echo $rw_id; ?>'><span class="bodytext">Do you want to send Cashback SMS? </span></td>
<td class='cashback_sms_<?php echo $rw_id; ?>'><input type='radio' name = 'cashback_sms_<?php echo $rw_id; ?>' value='1' <?php if($exe_app_on['cashback_sms_flag'] == '1'){ ?>checked <?php } ?>>Yes
<input type='radio' name = 'cashback_sms_<?php echo $rw_id; ?>' value='0' <?php if($exe_app_on['cashback_sms_flag'] != 1){ ?>checked <?php } ?>>No</td>
 </tr>
 <tr><td colspan="6">&nbsp;</td></tr>
 <tr>
<?php if($exe_app_on['app_bank_on'] == 42){ ?>
<td><span class="bodytext">LOS Captured </span></td>
<td><input type='radio' name = 'los_radio_<?php echo $rw_id; ?>' value='1' <?php if($exe_app_on['los_flag'] == '1'){ ?>checked <?php } ?>>Yes
<input type='radio' name = 'los_radio_<?php echo $rw_id; ?>' value='0' <?php if($exe_app_on['los_flag'] != 1){ ?>checked <?php } ?>>No</td>
<?php } ?>
     <td><span class="orange f_12">Last Updated Date </span></td><td><?php echo (date("Y-m-d", strtotime($exe_app_on['la_st_up_date'])) == '0000-00-00' || date("Y-m-d", strtotime($exe_app_on['la_st_up_date'])) == '' || date("Y-m-d", strtotime($exe_app_on['la_st_up_date'])) == '1970-01-01') ? '--' : date("d-m-Y h:i:s", strtotime($exe_app_on['la_st_up_date'])) ;?></td>
	<?php if($exe_app_on['bank_rm_name'] != ''){ ?>
	<td><span class="orange f_12">RM Name</span></td><td><?php echo $exe_app_on['bank_rm_name'] ;?></td><?php } ?>
	<?php if($exe_app_on['bank_rm_contact_no'] != ''){ ?>
	<td><span class="orange f_12">RM Contact No.</span></td><td><?php echo $exe_app_on['bank_rm_contact_no'] ;?></td><?php } ?>
    <?php if($result_banker_qry['assign_id'] != '' && $result_banker_qry['assign_id'] != 0){ ?> <td><span class="orange f_12">Assign To </span></td><td><?php echo $result_banker_qry['sales_name']." (".$result_banker_qry['sales_mobile'].")" ;?></td><?php } ?>
 </tr>
 <tr><td>&nbsp;</td></tr>
  <?php if($res_count_elig_check >0){?>
 <tr><td colspan="6" id="data_<?php echo $exe_app_on['app_id'];?>"> 
 <table width="100%" class="gridTable hidden" id="elig_detail_<?php echo $exe_app_on['app_id'];?>" >
<tr><td colspan="9"><input type="button" style="float:left;" class="buttonsub" name="check_elig" value="Check Eligibility" onclick="show_egidetal(<?php echo $exe_app_on['app_id'];?>);"></td></tr>
<tr>
<th>Loan Amount</th>
<th>Tenure</th>
<th>Interest Rate</th>
<th>Processing Fee</th>
<th>EMI</th>
<th>Company PF</th>
<th>Special Rate</th>
<th>Special PF</th>
<th>Special PF Percent</th>
</tr>
<?php 

while($res_app_fetch = mysqli_fetch_array($qry_count_api_elig)){?>
<tr>
<td><?php echo $res_app_fetch['loanamount'];?></td>
<td><?php echo $res_app_fetch['tenure'];?></td>
<td><?php echo $res_app_fetch['interestrate'];?></td>
<td><?php echo $res_app_fetch['processingfee'];?></td>
<td><?php echo $res_app_fetch['emi'];?></td>
<td><?php echo $res_app_fetch['companypf'];?></td>
<td><?php echo $res_app_fetch['splroi'];?></td>
<td><?php echo $res_app_fetch['splpf'];?></td>
<td><?php echo $res_app_fetch['splpfper'];?></td>
</tr>
<?php } ?>

</table></td></tr>
 <tr><td>&nbsp;</td></tr>
  <?php } ?>
<?php if(!empty($partner_data)) { ?>
<table>
  <tr style="color: #FF5100; font-size: 14px; font-weight: bold;">
    <td>
        <input type="button" name="req_res_btn" id="req_res_btn" class="cursor" value="Show Request Response" onclick="callReqResAjax(<?php echo $exe_app_on['app_id']; ?>, <?php echo $res_partner['pat_id']; ?>)">
    </td>
  </tr>
</table>
<div id="req_res_div_<?php echo $res_partner['pat_id']; ?>">

</div>
<?php } ?>
<table>
<script src="../../include/js/common-function.js"></script>