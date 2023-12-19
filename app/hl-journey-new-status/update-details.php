<?php  
require_once "../../../include/check-session.php";
require_once "../../../include/config.php";
require_once "../../../include/helper.functions.php";

require_once "../../../include/class.mailer.php";
$is_cashback_sent_email_sms = 0 ;
$step = replace_special($_REQUEST["step_app"]);
$case_id = replace_special($_REQUEST['case_id']);
$loan_type = replace_special($_REQUEST['loan_type']);
$main_application_id = replace_special($_REQUEST['main_application_id']);
if(!in_array($step,array(1,2)) || !is_numeric($case_id) || !is_numeric($loan_type) || ($step == 1 && !is_numeric($main_application_id))){
	exit; 
}
$cust_id = replace_special($_REQUEST['cust_id']);
$rw_id = replace_special($_REQUEST['rw_id']);
$query_id = replace_special($_REQUEST['query_id']);
$lead_view_id = replace_special($_REQUEST['lead_view_id']);
$click_to_call_id = replace_special($_REQUEST['click_to_call_id']);
$app_bank = replace_special($_REQUEST['app_bank']);
$partner = replace_special($_REQUEST['partner']);
$app_bank_applied = replace_special($_REQUEST['app_bank_applied']);
$pre_status = replace_special($_REQUEST['pre_status']);
$post_login_status = replace_special($_REQUEST['post_login_status']);
$rate_type = replace_special($_REQUEST['rate_type']);
$applied_amount = replace_special($_REQUEST['applied_amount']);
$loan_tenure = replace_special($_REQUEST['loan_tenure']);
$fixed_tenure = replace_special($_REQUEST['fixed_tenure']);
$rate_of_in = $_REQUEST['rate_of_in'];
$login_date = $_REQUEST['login_date'];
$sanctioned_amount = replace_special($_REQUEST['sanctioned_amount']);
$sanction_date = $_REQUEST['sanction_date'];
$disbursed_amount = replace_special($_REQUEST['disbursed_amount']);
$first_disb_date = $_REQUEST['first_disb_date'];
$last_disb_date = $_REQUEST['last_disb_date'];
$sub_sub_status = $_REQUEST['sub_sub_status'];
$bank_crm_lead = $_REQUEST['bank_crm_lead'];
$bank_app_num = $_REQUEST['bank_app_num'];
$apply_sub_sub_status  = $_REQUEST['apply_sub_sub_status'];
$cash_offers = replace_special($_REQUEST['cash_offers']);
$description = $_REQUEST['description'];
$bnk_description = $_REQUEST['bnk_description'];
$cibil_score_num = replace_special($_REQUEST['cibil_score_num']);
$follow_type = replace_special($_REQUEST['follow_type']);
$follow_date = $_REQUEST['follow_date'];
$follow_up_time = $_REQUEST['follow_up_time'];
$bil_type = replace_special($_REQUEST['bil_type']);
$deposit_tenure = replace_special($_REQUEST['deposit_tenure']);
$property_status = replace_special($_REQUEST['property_status']);
$cashback_sms_new = replace_special($_REQUEST['cashback_sms']);
$multiple_sub_sub_status_array = $_REQUEST['case_multiple_sub_sub_status'];
$multiple_sub_status_array = $_REQUEST['case_multiple_sub_status'];
$other_statuses = implode(',',$multiple_sub_sub_status_array);
if($follow_type == '' || $follow_type == 4 || $follow_type == 0){
	$follow_date = $follow_up_time = '';
}else{
	$follow_date = date('Y-m-d',strtotime($follow_date));
	$follow_up_time = date('H:i:s',strtotime($follow_up_time));
}

$case_cf 			= $_REQUEST['case_cf'];
$case_closed_val 	= $_REQUEST['case_closed_val'];
$main_app_id = $_REQUEST['main_app_id'];

$existing_cash_offers = "";
$cashback_limit = $_REQUEST['cashback_limit'];
if($pre_status == 1019) {
	$existing_cash_qry = mysqli_query($Conn1, "SELECT cash_offers_on FROM tbl_mint_app WHERE app_id='".$main_application_id."' ORDER BY app_id DESC LIMIT 0, 1 ");
	$existing_cash_res = mysqli_fetch_array($existing_cash_qry);
	$existing_cash_offers = $existing_cash_res['cash_offers_on'];
}

if($case_cf == 1) {
	$case_closed_val = 2;
}
$cashback_sms = '';
    if(in_array($pre_status,array(1019,1016,1017,1020,1021))){
		
		$get_ref_mobile_qry = mysqli_query($Conn1,"select ref_mobile,app.query_id as app_query_id from tbl_mint_app as app INNER JOIN tbl_mint_query as qry ON app.query_id = qry.query_id where app.id = ".$rw_id." and qry.ref_mobile > 0 and qry.refer_form_type = 2");
		if(mysqli_num_rows($get_ref_mobile_qry) > 0){
		$result_ref_mobile = mysqli_fetch_assoc($get_ref_mobile_qry);
		$ref_partner_id = $result_ref_mobile['ref_mobile'];
		$app_query_id =  $result_ref_mobile['app_query_id'];
		}
        if($pre_status == 1019){
            $last_disb_date = $last_disb_date;
            $disbursed_amount = $disbursed_amount;
            $first_disb_date = $first_disb_date;
            $cashback_sms = $cashback_sms_new;

			if($post_login_status == 1098){
				//echo "select * from tbl_mint_app where app_id = ".$main_application_id." and disb_email_flag = 0";
                $check_qry = mysqli_query($Conn1,"select * from tbl_mint_app where app_id = ".$main_application_id." and disb_email_flag = 0");
                if(mysqli_num_rows($check_qry) > 0){
                    $check_qry_cashback = mysqli_query($Conn1,"select * from tbl_pat_loan_type_mapping where loan_type = ".$loan_type." and bank_id = ".$app_bank_applied." and is_cashback_strip = 1");
                    if(mysqli_num_rows($check_qry_cashback) > 0){
                        $is_cashback_sent_email_sms = 1;
                    }
                }
            }
        }else {
            $last_disb_date ='';
            $disbursed_amount = '';
            $first_disb_date = '';
        }
        $sanctioned_amount = $sanctioned_amount;
		$sanction_date = $sanction_date;
		if($ref_partner_id > 0 && in_array($pre_status,array(1019,1017))){
			$check_status_on_tbl_qry = mysqli_query($Conn1,"select * from partner_apn_on_statuses where partner_id=".$ref_partner_id." and lead_id = ".$app_query_id." and status = ".$pre_status);
			if(mysqli_num_rows($check_status_on_tbl_qry) == 0){
				mysqli_query($Conn1,"insert into partner_apn_on_statuses set source='Application Edit - ".$main_application_id."',level_id =3,lead_id=".$app_query_id.",partner_id=".$ref_partner_id.",status=".$pre_status.",flag=0");
			}
			if($pre_status == 1019){
				$check_status_on_tbl_qry_c = mysqli_query($Conn1,"select * from partner_apn_on_statuses where partner_id=".$ref_partner_id." and status = 9999");
				if(mysqli_num_rows($check_status_on_tbl_qry_c) == 0){
					mysqli_query($Conn1,"insert into partner_apn_on_statuses set source='Application Edit - ".$main_application_id."',level_id =3,lead_id=".$app_query_id.",partner_id=".$ref_partner_id.",status=9999,flag=0");
				}
				$check_partner_of_partner = mysqli_query($Conn1,"select * from tbl_mint_partner_info where partner_id=".$ref_partner_id." and mlc_user_id > 0 and agent_type= 2 and status =0");
				if($check_partner_of_partner){
					$check_wallet_summary = mysqli_query($Conn1,"select * from partner_wallet_data where credit_against_type =1 and type_id =".$main_application_id);
					if(mysqli_num_rows($check_wallet_summary) == 0){
						$result_partner_partner_id = mysqli_fetch_assoc($check_partner_of_partner);
						$check_total_sum_wallet = mysqli_query($Conn1,"select sum(amount) as total_sum from partner_wallet_data where credit_against_type =1 and partner_id=".$result_partner_partner_id['mlc_user_id']." and sub_partner_id = ".$ref_partner_id);
						$result_total_sum = mysqli_fetch_assoc($check_total_sum_wallet);
						if(($result_total_sum['total_sum'] + 250 ) <= 10000){
							mysqli_query($Conn1,"INSERT INTO partner_wallet_data set voucher_type=1,credit_against_type =1,partner_id=".$result_partner_partner_id['mlc_user_id'].",transaction_type=2,type_id=".$main_application_id.",amount=250,sub_partner_id = ".$ref_partner_id);
							$get_partner_token_id = mysqli_query($Conn1,"select * from tbl_mint_partner_info where partner_id = '".$result_partner_partner_id['mlc_user_id']."' and status = 0");
							if(mysqli_num_rows($get_partner_token_id) > 0){
								$result_ref_mobile_no = mysqli_fetch_assoc($get_partner_token_id);
								$ref_partner_phone_no = $result_ref_mobile_no['phone'];
								$get_ref_token = mysqli_query($Conn1,"select * from notification where mobile='".$ref_partner_phone_no."' and is_active =1 group by token");
								while($result_ref_token = mysqli_fetch_assoc($get_ref_token)){
									$refer_token_id = $result_ref_token['token'];
									if($refer_token_id != ''){
									$noti_title_q = "Congrats, you have rewards in your wallet";
									$partner_noti_desc_q = 'You have successfully referred';
									$content_q = '{"registration_ids":["'.$refer_token_id.'"],
									"data":
									{"title":"'.$noti_title_q.'",
									"body":"'.$partner_noti_desc_q.'",
									"icon":"ic_launcher.png",
									"deepLink":"YourStatement",
									"image":"'.$head_url.'/api/images/referral-partner-noti/cashback.jpg"}
									}';
								$noti_resp_q = curl_helper('https://fcm.googleapis.com/fcm/send',$header,$content_q);
								$noti_data_decode_q = json_decode($noti_resp_q,true);
								if($noti_data_decode_q['failure'] == 1){
								mysqli_query($Conn1,"update notification set is_active = 0 where mobile='".$ref_partner_phone_no."' and token = '".$refer_token_id."'");
							}
								mysqli_query($Conn1,"insert into notification_history set source='Rewards Points Cashback App',redirectTo='YourStatement',noti_title='".$noti_title_q."',user_type=2,sms_send_to_fos='".$partner_noti_desc_q."',notification_request='".base64_encode($content_q)."',response_from_api='".base64_encode($noti_resp_q)."',fos_user_id='".$result_check_noti_qry['mlc_user_id']."',device_token_id='".$refer_token_id."',is_success=".$noti_data_decode_q['success']);
							}
							}
							}
						
						}
					}
				}
			}
		}
    }else{
        if(in_array($pre_status,array(1016,1020))){
            $login_date= $login_date;
        }else{
            $login_date = '';
        }
        $sanctioned_amount = '';
        $sanction_date = '';
        $disbursed_amount = '';
        $first_disb_date= '';
        $last_disb_date = '';
    }
$qry_to_execute = '';
    if($step == 1){
    	$qry_to_execute = "update tbl_mint_app ";
    	$last_concat = " where id = ".$rw_id." limit 1";
    }else if($step == 2){
    	$chk_exis = mysqli_query($Conn1,"select * from tbl_mint_app where case_id = ".$case_id." and app_bank_on = '".$app_bank ."'");
    	if(mysqli_num_rows($chk_exis) == 0){
    		$mlc_product_id_qry = mysqli_query($Conn1,"select mlc_product_id from lms_loan_type where loan_type_id = '".$loan_type."'");
			    $result_product_id = mysqli_fetch_array($mlc_product_id_qry);
			    $mlc_product_id = $result_product_id['mlc_product_id'];
			    if($mlc_product_id != '' && $mlc_product_id != 0 && $loan_type !='' && $loan_type != 0){
			        if(strlen($app_bank) == 3){
			            $app_bank_tw = $app_bank;
			        }else{
			            $app_bank_tw = "0".$app_bank;
			        }
			        $main_application_id = $mlc_product_id.$loan_type.$app_bank_tw.$case_id;
			    $qry_to_execute = "INSERT INTO tbl_mint_app ";
			    $last_concat = ",query_id='".$query_id."',case_id=".$case_id.",app_id=".$main_application_id.",app_created_by=".$user.",app_bank_on=".$app_bank.",date_created = CURDATE()";
    	}
    }
}
if($qry_to_execute != ''){
	$final_qry  = $qry_to_execute." set property_status='".$property_status."',
	pre_login_status ='".$pre_status."',
	loan_tenure_on='".$loan_tenure."', 
	fixed_tenure_on ='".$fixed_tenure."',
	app_status_on ='".$post_login_status."',	
    sub_sub_status = '".$sub_sub_status."',
	rate_type_on = '".$rate_type."',
	rate_of_in_on = '".$rate_of_in."', 
	sanction_date_on= '".$sanction_date."',
	partner_on = '".$partner."', 
    other_status = '".$other_statuses."',
	applied_amount_on = '".$applied_amount."',
	sanctioned_amount_on ='".$sanctioned_amount."',
	disbursed_amount_on = '".$disbursed_amount."',
	first_disb_date_on = '".$first_disb_date."',
	last_disb_date_on ='".$last_disb_date."',
	bank_app_no_on = '".$bank_app_num."', 
	bank_crm_lead_on = '".$bank_crm_lead."',
	login_date_on = '".$login_date."',
	app_description= '".mysqli_real_escape_string($Conn1,$description)."',
	bnk_description='".mysqli_real_escape_string($Conn1, $bnk_description)."',
	cashback_sms_flag='".$cashback_sms."',
	bil_type = '".$bil_type."', 
	cibil_score = '".$cibil_score_num."', 
	bank_wise_tennure = '".$deposit_tenure."',
	main_app_id='".$main_app_id."',
	la_st_up_date = NOW() ";

	if($step == 1 && $follow_type != "" && $follow_date != '0000-00-00' && $follow_date != '' && $follow_date != '0000-00-00') {
		if(($user_role == 6) && $_REQUEST['rm_fup'] == 1) {
			$update_rm_app = "UPDATE tbl_mint_app SET rm_fup_type = '".$follow_type."', rm_fup_date = '".$follow_date."', rm_fup_time = '".$follow_up_time."' WHERE id = ".$rw_id." LIMIT 1";
			mysqli_query($Conn1, $update_rm_app);

			mysqli_query($Conn1, " INSERT INTO tbl_mint_case_followup SET follow_time = '".$follow_up_time."', case_id = ".$case_id.", app_id = '".$main_application_id."', app_flag = 1, follow_date = '".$follow_date."',follow_type = '".$pre_status."', follow_status = '".$follow_type."', description = '".$description."', cust_id = '".$cust_id."', date = CURDATE(), time = CURTIME(), mlc_user_id = '".$user."', is_rm = 1 ");

		} else {

			if($user_role == 6 && ($loan_type == 51 || $loan_type == 52 || $loan_type == 54) && $_REQUEST['follow_up_for'] == 1) {
				$update_rm_app = "UPDATE tbl_mint_app SET rm_fup_type = '".$follow_type."', rm_fup_date = '".$follow_date."', rm_fup_time = '".$follow_up_time."' WHERE id = ".$rw_id." LIMIT 1";
				mysqli_query($Conn1, $update_rm_app);

				mysqli_query($Conn1, " INSERT INTO tbl_mint_case_followup SET follow_time = '".$follow_up_time."', case_id = ".$case_id.", app_id = '".$main_application_id."', app_flag = 1, follow_date = '".$follow_date."',follow_type = '".$pre_status."', follow_status = '".$follow_type."', description = '".$description."', cust_id = '".$cust_id."', date = CURDATE(), time = CURTIME(), mlc_user_id = '".$user."', is_rm = 1 ");
				
			} else if($loan_type == 51 || $loan_type == 52 || $loan_type == 54) {

				$update_rm_app = "UPDATE tbl_mint_app SET rm_fup_type = '0', rm_fup_date = '', rm_fup_time = '' WHERE id = ".$rw_id." LIMIT 1";
				mysqli_query($Conn1, $update_rm_app);

				$hl_case_fup_datetime = mysqli_query($Conn1, "SELECT c_follow_date, c_follow_time FROM tbl_mint_case WHERE case_id = $case_id");
				$hl_case_fup_dt_result = mysqli_fetch_array($hl_case_fup_datetime);

				if($hl_case_fup_dt_result['c_follow_date'] < date("Y-m-d")) {
					//follow added by user to be updated
					mysqli_query($Conn1, "UPDATE tbl_mint_case SET c_follow_date = '".$follow_date."', c_follow_time = '".$follow_up_time."', c_follow_type = '".$follow_type."',case_status=1058 WHERE case_id = $case_id ");

					mysqli_query($Conn1, " INSERT INTO tbl_mint_case_followup SET follow_time = '".$follow_up_time."', case_id = ".$case_id.", app_id = '".$main_application_id."', app_flag = 1, follow_date = '".$follow_date."',follow_type = '".$pre_status."', follow_status = '".$follow_type."', description = '".$description."', cust_id = '".$cust_id."', date = CURDATE(), time = CURTIME(), mlc_user_id = '".$user."' ");

				} else if($hl_case_fup_dt_result['c_follow_date'] > date("Y-m-d")) {
					//compare follow added by user and case follow up then minimum to be udpated
					if($hl_case_fup_dt_result['c_follow_date'] > $follow_date) {
						mysqli_query($Conn1, "UPDATE tbl_mint_case SET c_follow_date = '".$follow_date."', c_follow_time = '".$follow_up_time."', c_follow_type = '".$follow_type."',case_status=1058 WHERE case_id = $case_id ");

						mysqli_query($Conn1, " INSERT INTO tbl_mint_case_followup SET follow_time = '".$follow_up_time."', case_id = ".$case_id.", app_id = '".$main_application_id."', app_flag = 1, follow_date = '".$follow_date."',follow_type = '".$pre_status."', follow_status = '".$follow_type."', description = '".$description."', cust_id = '".$cust_id."', date = CURDATE(), time = CURTIME(), mlc_user_id = '".$user."' ");
					} else if($hl_case_fup_dt_result['c_follow_date'] < $follow_date) {
						mysqli_query($Conn1, "UPDATE tbl_mint_case SET c_follow_date = '".$hl_case_fup_dt_result['c_follow_date']."', c_follow_time = '".$hl_case_fup_dt_result['c_follow_time']."', c_follow_type = '".$follow_type."',case_status=1058 WHERE case_id = $case_id ");

						mysqli_query($Conn1, " INSERT INTO tbl_mint_case_followup SET follow_time = '".$hl_case_fup_dt_result['c_follow_time']."', case_id = ".$case_id.", app_id = '".$main_application_id."', app_flag = 1, follow_date = '".$hl_case_fup_dt_result['c_follow_date']."',follow_type = '".$pre_status."', follow_status = '".$follow_type."', description = '".$description."', cust_id = '".$cust_id."', date = CURDATE(), time = CURTIME(), mlc_user_id = '".$user."' ");
					} else {
						mysqli_query($Conn1, "UPDATE tbl_mint_case SET c_follow_date = '".$follow_date."', c_follow_time = '".$follow_up_time."', c_follow_type = '".$follow_type."',case_status=1058 WHERE case_id = $case_id ");

						mysqli_query($Conn1, " INSERT INTO tbl_mint_case_followup SET follow_time = '".$follow_up_time."', case_id = ".$case_id.", app_id = '".$main_application_id."', app_flag = 1, follow_date = '".$follow_date."',follow_type = '".$pre_status."', follow_status = '".$follow_type."', description = '".$description."', cust_id = '".$cust_id."', date = CURDATE(), time = CURTIME(), mlc_user_id = '".$user."' ");
					}
				} else if($hl_case_fup_dt_result['c_follow_date'] == date("Y-m-d")) {
					//case followup to be updated
					mysqli_query($Conn1, "UPDATE tbl_mint_case SET c_follow_date = '".$hl_case_fup_dt_result['c_follow_date']."', c_follow_type = '".$follow_type."',case_status=1058 WHERE case_id = $case_id ");

					mysqli_query($Conn1, " INSERT INTO tbl_mint_case_followup SET case_id = ".$case_id.", app_id = '".$main_application_id."', app_flag = 1, follow_date = '".$hl_case_fup_dt_result['c_follow_date']."',follow_type = '".$pre_status."', follow_status = '".$follow_type."', description = '".$description."', cust_id = '".$cust_id."', date = CURDATE(), time = CURTIME(), mlc_user_id = '".$user."' ");
				}
			} else {

				$update_rm_app = "UPDATE tbl_mint_app SET rm_fup_type = '0', rm_fup_date = '', rm_fup_time = '' WHERE id = ".$rw_id." LIMIT 1";
				mysqli_query($Conn1, $update_rm_app);

				mysqli_query($Conn1, "UPDATE tbl_mint_case SET c_follow_date = '".$follow_date."', c_follow_time = '".$follow_up_time."', c_follow_type = '".$follow_type."',case_status=1058 WHERE case_id = $case_id ");
				mysqli_query($Conn1, " INSERT INTO tbl_mint_case_followup SET follow_time = '".$follow_up_time."', case_id = ".$case_id.", app_id = '".$main_application_id."', app_flag = 1, follow_date = '".$follow_date."',follow_type = '".$pre_status."', follow_status = '".$follow_type."', description = '".$description."', cust_id = '".$cust_id."', date = CURDATE(), time = CURTIME(), mlc_user_id = '".$user."' ");
			}

		}
	} else {
		$final_qry .= ", follow_up_type_on =0, follow_up_date_on = '', follow_up_time='', rm_fup_type = '0', rm_fup_date = '', rm_fup_time = '' ";
	}


	$final_qry .= " , cash_offers_on = '".$cash_offers."' ";

	$final_qry .= $last_concat;
	mysqli_query($Conn1,$final_qry);
}
if($pre_status == 1019){
	$m_app_id = $main_application_id;
}
$pre_login_status = replace_special($_REQUEST['apply_pre_login_status']);
$app_status_on = replace_special($_REQUEST['apply_app_status_on']);
if($pre_status != $pre_login_status  || ($post_login_status != $app_status_on  && $app_status_on > 0 && $app_status_on != '') || ($apply_sub_sub_status != $sub_sub_status && $sub_sub_status > 0 && $sub_sub_status != '')){
        $qry_app_history = "insert into tbl_application_history set case_id = ".$case_id.",app_id= '".$main_application_id."',pre_login= '".$pre_status ."',post_login='".$post_login_status."',sub_sub_status = '".$sub_sub_status."',date=CURDATE(),time=CURTIME(), user_id= '".$user."'";
        $insert_app_history = mysqli_query($Conn1,$qry_app_history);
	}
	$total_no_of_app = mysqli_query($Conn1,"select * from tbl_mint_app where case_id=".$case_id." and pre_login_status NOT IN (1015,1012,1013,1014,1020,1021,1393,1019)");

		if(in_array($pre_status,array(1015,1012,1013,1014,1020,1021,1393)) && $_REQUEST['case_closed_val'] == 1 && mysqli_num_rows($total_no_of_app) == 0){
			mysqli_query($Conn1,"update tbl_mint_case set case_status = 1406,c_follow_date='0000-00-00',c_follow_time='00:00:00',c_follow_type=0 where case_id =".$case_id." LIMIT 1");
			mysqli_query($Conn1,"INSERT INTO tbl_mint_case_followup set follow_type = 1406,case_id =".$case_id.",description='Application status changed',mlc_user_id=".$user.",date=CURDATE(),time=CURTIME()");
		}else if($pre_status == 1019 && $_REQUEST['case_closed_val'] == 1){
			mysqli_query($Conn1,"update tbl_mint_case set case_status = 1406,c_follow_date='0000-00-00',c_follow_time='00:00:00',c_follow_type=0 where case_id =".$case_id." LIMIT 1") OR die(mysqli_error($Conn1));
				mysqli_query($Conn1,"update tbl_mint_app set pre_login_status = 1014,app_status_on=0,sub_sub_status=0,other_status=1468 where case_id =".$case_id." and pre_login_status NOT IN (1393,1016,1017,1018,1019,1020,1021) ") or die(mysqli_error($Conn1));
			
			mysqli_query($Conn1,"INSERT INTO tbl_mint_case_followup set follow_type = 1406,case_id =".$case_id.",description='Application status changed',mlc_user_id=".$user.",date=CURDATE(),time=CURTIME()") or die(mysqli_error($Conn1));
		}	
	if($case_id > 0){
mysqli_query($Conn1,"update tbl_mint_case set is_nstp=1 where case_id = ".$case_id." LIMIT 1");
}
if($is_cashback_sent_email_sms == 1 && $post_login_status == 1098 && $step == 1 && $loan_type != 58){
    $data  = curl_get_helper('https://myloancrm.com/sugar/app/disbursement-email-sms.php?m_app='.$m_app_id.'&case_id='.$case_id);
}
    echo $head_url."/sugar/app/edit_applicaton.php?case_id=".base64_encode($case_id)."&m_app=$m_app_id&cust_id=".base64_encode($cust_id)."&loan_type=".$loan_type."&app_id=".base64_encode($main_application_id)."&errmsg=edit sucessfully!&upated=1";
?>