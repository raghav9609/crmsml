<?php
$return_html = "";
$case_id = $_REQUEST['case_id'];
$loan_type = $_REQUEST['loan_type'];
require_once "../../include/check-session.php";
require_once "../../include/config.php";
require_once  "../../include/helper.functions.php";
$qry = "select * from tbl_mint_app where case_id = ".$case_id."";
$res = mysqli_query($Conn1,$qry) or die(mysqli_error($Conn1));
$res_num = mysqli_num_rows($res);
if($res_num > 0) {
    $sr_no = 0;
?>
   <?php $return_html = '<table width="100%" class="gridtable"><tr class="font-weight-bold"><th>Sr. No.</th><th>Application Id / Case Id </th><th>Bank / Partner</th><th>Pre Login/Post Login</th><th>Bank Response</th><th>API Status</th>
    <th>Follow up Date</th><th>Follow up type</th><th>Description</th><th>RM</th><th>SM</th><th>Created Date</th><th>Last Updated</th></tr>'; ?>

    <?php while($exe_app_history = mysqli_fetch_array($res)){
    ++$sr_no;
    $f_type = $exe_app_history['follow_up_type_on'];
    $follow_up_date_on = ($exe_app_history['follow_up_date_on'] == '0000-00-00' || $exe_app_history['follow_up_date_on'] == "" || $exe_app_history['follow_up_date_on'] == "1970-01-01") ? '--' : date("d-m-Y", strtotime($exe_app_history['follow_up_date_on']));
    $app_id = $exe_app_history['app_id'];
    $app_status_on = $exe_app_history['app_status_on'];
    $app_bank_on = $exe_app_history['app_bank_on'];
    $pre_login_status = $exe_app_history['pre_login_status'];
    $app_description = $exe_app_history['app_description'];

    $date_created = (trim($exe_app_history['date_created']) != "" && $exe_app_history['date_created'] != "0000-00-00" && $exe_app_history['date_created'] != "1970-01-01") ? date("d-m-Y", strtotime($exe_app_history['date_created'])) : "--";

    $last_updated = "--";
    if(trim($exe_app_history['la_st_up_date']) != "") {
        $last_updated = (date('Y-m-d', strtotime($exe_app_history['la_st_up_date'])) != "0000-00-00" || date('Y-m-d', strtotime($exe_app_history['la_st_up_date'])) != "1970-01-01" || date('Y-m-d', strtotime($exe_app_history['la_st_up_date'])) != "") ? date('d-m-Y h:i A', strtotime($exe_app_history['la_st_up_date'])) : "--";
    }

    $qry_f = "select * from tbl_follow_status where follow_id = '".$f_type."'";
    $res_f = mysqli_query($Conn1,$qry_f);
    $exe_f = mysqli_fetch_array($res_f);

    $qry_app_status = "select * from tbl_app_status where app_status_id = '".$app_status_on."'";
    $res_app_status = mysqli_query($Conn1,$qry_app_status);
    $exe_app_status = mysqli_fetch_array($res_app_status);


    $pre_app_status = "select pre_status_name from tbl_app_pre_login where pre_status_id = '".$pre_login_status."'";
    $pre_app_status = mysqli_query($Conn1,$pre_app_status);
    $pre_app_status = mysqli_fetch_array($pre_app_status);
    $pre_login_name = $pre_app_status['pre_status_name'];

    $qry_app_bank = "select * from tbl_bank where bank_id = '".$app_bank_on."'";
    $res_app_bank = mysqli_query($Conn1,$qry_app_bank);
    $exe_app_bank = mysqli_fetch_array($res_app_bank);

    $qry_cust = "select cust_id, tbl_user_assign.user_name as user_name from tbl_mint_case left join tbl_user_assign on tbl_user_assign.user_id = tbl_mint_case.user_id where case_id = ".$case_id."";
    $res_cust  = mysqli_query($Conn1,$qry_cust);
    $exe_cust  = mysqli_fetch_array($res_cust);
    $cust_id = $exe_cust['cust_id'];
    $user_by = (trim($exe_cust['user_name']) != "") ? "(By: ".$exe_cust['user_name'].")" : "";        

    $bank_response = "--";
    $score_card = "";
    $loanamount = "";
    $pat_id_qry = "select pat_id from tbl_pat_loan_type_mapping where bank_id = ".$app_bank_on." and loan_type = ".$loan_type;
    $pat_id_res = mysqli_query($Conn1, $pat_id_qry);
    $pat_id_result = mysqli_fetch_array($pat_id_res);
    $pat_id  = $pat_id_result['pat_id'];

    $kotak_resp_array = array('1'=>'Follow Up','2'=>'Declined','3'=>'Login','4'=>'Hold','5'=>'Disbursed','6'=>'Sanctioned','7'=>'Approved','8'=>'Closed','9'=>'In Process');

    if($pat_id != "" && $case_id != "") {
        $new_qry = "SELECT ref_id, response, res_desc from tbl_pat_retrn_respnse where case_id = ".$case_id." and partner_id = '".$pat_id."' ORDER BY resp_id desc limit 0, 1";
        $res_new_qry = mysqli_query($Conn1, $new_qry);
        if(mysqli_num_rows($res_new_qry) > 0) {
            $exe_new_qry = mysqli_fetch_array($res_new_qry);
            $bank_response = $exe_new_qry['response'];
            $resc_desc = (trim($exe_new_qry['res_desc']) != "") ? "(".$exe_new_qry['res_desc'].")" : "";
            if($pat_id == 48) {
                if ($bank_response == "4") {
                    $bank_response = "AIP Refer <br>" . $resc_desc;
                } else if ($bank_response == "0") {
                    $bank_response = "FAILURE/ERROR <br>" . $resc_desc;
                } else if ($bank_response == "3") {
                    $bank_response = "AIP Rejected <br>" . $resc_desc;
                } else if ($bank_response == "1") {
                    $bank_response = "AIP Approve <br>" . $resc_desc;
                } else {
                    $bank_response = "Error in API <br>" . $resc_desc;
                }
            } else if($pat_id == 58) {
                if ($bank_response == 'Amber') {
                    $bank_response = 'AIP Refered <br>' . $resc_desc;
                } else if ($bank_response == 'Red') {
                    $bank_response = 'AIP Reject <br>' . $resc_desc;
                } else if ($bank_response == 'Green') {
                    $bank_response = 'AIP OK <br>' . $resc_desc;
                } else {
                    $bank_response = $resc_desc;
                }
            } else if($pat_id == 5) {
                $bank_response = $resc_desc;
            } else if($pat_id == 84) {
                if($bank_response == "401") {
                    $bank_response == "Failed";
                } else {
                    $bank_response = $resc_desc;
                }
            } else if($pat_id == 24 ) {
                $bank_response = $kotak_resp_array[$bank_response] . " " . $resc_desc;
            } else if ($pat_id == 62 || $pat_id == 60 || $pat_id == 44) {
                $bnk_cibil_score = '';
                if ($pat_id == 62) {
                    $check_cibil_qry = mysqli_query($Conn1, "select Score from ybl_credit_score where requestReferenceNo ='" . $app_id . "'");
                    if (mysqli_num_rows($check_cibil_qry) > 0) {
                        $result_cibil_qry = mysqli_fetch_array($check_cibil_qry);
                        $bnk_cibil_score = "(<span class='green'>" . $result_cibil_qry['Score'] . "</span>)";
                    }
                }
                $bank_response = $exe_new_qry['ref_id'] . " " . $bnk_cibil_score;
            } else if ($pat_id == 42) {
                $check_res_qry = mysqli_query($Conn1, "select status from partner_lead_status where app_id ='" . $app_id . "' and partner_id = '42' order by status_id DESC LIMIT 1");
                if (mysqli_num_rows($check_res_qry) > 0) {
                    $result_res_qry = mysqli_fetch_array($check_res_qry);
                    $bnk_response = "<span class='green'>" . $exe_app_history['cibil_score'] . " " . $result_res_qry['status'] . "</span>";
                }

                $bank_response = $bnk_response;
            } else if($pat_id == 50 || $pat_id == 46 || $pat_id == 31 || $pat_id == 80 || $pat_id == 47 || $pat_id == 77 || $pat_id == 78 || $pat_id == 27 || $pat_id == 28 || $pat_id == 16 || $pat_id == 26 || $pat_id == 79 || $pat_id == 8 || $pat_id == 56 || $pat_id == 49 || $pat_id == 74 || $pat_id == 38 || $pat_id == 69 || $pat_id == 41 || $pat_id == 4 || $pat_id == 68) {
                $bank_response = $bank_response . " " . $resc_desc;
            }
        }

        $api_status = "";
        $api_status_qry = "SELECT respcode FROM api_helper LEFT JOIN tbl_bank_resp_code ON tbl_bank_resp_code.id = api_helper.status_id where application_id = '".$app_id."'";
        $api_status_exe = mysqli_query($Conn1, $api_status_qry);
        if(mysqli_num_rows($api_status_exe) > 0) {
            $api_status_res = mysqli_fetch_array($api_status_exe);
            $api_status = (trim($api_status_res['respcode']) != "") ? $api_status_res['respcode'] : "--";
        }
        if(trim($api_status) == "") {
            $api_status = "--";
        }

        //Starts --- email
        $rm_query = "select history_id, group_concat(distinct(banker_email)) as rm_email, banker_type, banker_name as rm_name from banker_email_history where case_id = '".$case_id."' and partner_id = '".$pat_id."' and banker_type = 'rm' ";
        $sm_query = "select history_id, group_concat(distinct(banker_email)) as sm_email, banker_type, banker_name as sm_name from banker_email_history where case_id = '".$case_id."' and partner_id = '".$pat_id."' and banker_type = 'sm' ";

        $rm_query_exe = mysqli_query($Conn1, $rm_query);
        $rm_emails = array();
        $rm_names = array();
        if(mysqli_num_rows($rm_query_exe) > 0) {
            $rm_query_res = mysqli_fetch_array($rm_query_exe);
            $rm_emails[] = $rm_query_res['rm_email'];
            $rm_names[] = $rm_query_res['rm_name'];
        }

        $sm_query_exe = mysqli_query($Conn1, $sm_query);
        $sm_emails = array();
        $sm_names = array();
        if(mysqli_num_rows($sm_query_exe) > 0) {
            $sm_query_res = mysqli_fetch_array($sm_query_exe);
            $sm_emails[] = $sm_query_res['sm_email'];
            $sm_names[] = $sm_query_res['sm_name'];
        }

        $rm_query_sms = "select history_id, group_concat(distinct(partner_contact_no)) as rm_contact, banker_type, banker_name as rm_c_name from banker_sms_history where case_id = '".$case_id."' and partner_id = '".$pat_id."' and banker_type = 'rm' ";
        $sm_query_sms = "select history_id, group_concat(distinct(partner_contact_no)) as sm_contact, banker_type, banker_name as sm_c_name from banker_sms_history where case_id = '".$case_id."' and partner_id = '".$pat_id."' and banker_type = 'sm' ";

        $rm_query_sms_exe = mysqli_query($Conn1, $rm_query_sms);
        $rm_contacts = array();
        $rm_c_name = array();
        if(mysqli_num_rows($rm_query_sms_exe) > 0) {
            $rm_query_sms_res = mysqli_fetch_array($rm_query_sms_exe);
            $rm_contacts[] = $rm_query_sms_res['rm_contact'];
            $rm_c_name[] = $rm_query_sms_res['rm_c_name'];
        }

        $sm_query_sms_exe = mysqli_query($Conn1, $sm_query_sms);
        $sm_contacts = array();
        $sm_c_name = array();
        if(mysqli_num_rows($sm_query_sms_exe) > 0) {            
            $sm_query_sms_res = mysqli_fetch_array($sm_query_sms_exe);
            $sm_contacts[] = $sm_query_sms_res['sm_contact'];
            $sm_c_name[] = $sm_query_sms_res['sm_c_name'];
        }

        $final_rm_emails = (!empty($rm_emails) && trim($rm_emails) != ",") ? implode(", ", $rm_emails) : "--";
        $final_sm_emails = (!empty($sm_emails) && trim($sm_emails) != ",") ? implode(", ", $sm_emails) : "--";
        
        $final_rm_names = (!empty($rm_names) && trim($rm_names) != ",") ? implode(", ", $rm_names) : "--";
        $final_sm_names = (!empty($sm_names) && trim($sm_names) != ",") ? implode(", ", $sm_names) : "--";

        $final_rm_c_names = (!empty($rm_c_name) && trim($rm_c_name) != ",") ? implode(", ", $rm_c_name) : "--";
        $final_sm_c_names = (!empty($sm_c_name) && trim($sm_c_name) != ",") ? implode(", ", $sm_c_name) : "--";

        if(trim($final_rm_emails) == "") {
            $final_rm_emails = "--";
        }
        if(trim($final_sm_emails) == "") {
            $final_sm_emails = "--";
        }

        if(trim($final_rm_names) == "") {
            if(trim($final_rm_c_names) == "") {
                $final_rm_names = "--";
            } else {
                $final_rm_names = $final_rm_c_names;
            }
        } else {
            $final_rm_names = "(".$final_rm_names.")";
        }
        if(trim($final_sm_names) == "") {
            if(trim($final_sm_c_names) == "") {
                $final_sm_names = "--";
            } else {
                $final_sm_names = $final_sm_c_names;
            }
        } else {
            $final_sm_names = "(".$final_sm_names.")";
        }

        $final_rm_contacts = (!empty($rm_contacts)) ? implode(", ", $rm_contacts) : "--";
        $final_sm_contacts = (!empty($sm_contacts)) ? implode(", ", $sm_contacts) : "--";

        if(trim($final_rm_contacts) == "") {
            $final_rm_contacts = "--";
        }
        if(trim($final_sm_contacts) == "") {
            $final_sm_contacts = "--";
        }
        //Ends
        $enc_cs = urlencode(base64_encode($case_id));

        $score_card_query = "select cibil_score, loanamount from tbl_customer_application_api_elig where app_id = $app_id and partner_id = $pat_id";
        $score_card_exe = mysqli_query($Conn1, $score_card_query);
        if(mysqli_num_rows($score_card_exe) > 0) {
            $score_card_res = mysqli_fetch_array($score_card_exe);
            $score_card = ($score_card_res['cibil_score'] != "" && $score_card_res['cibil_score'] != "0" && $score_card_res['cibil_score'] != "0.00") ? "(Cibil: ".$score_card_res['cibil_score'].")" : "";
            $loanamount = (trim($score_card_res['loanamount']) != "") ? "(API Amount: ".custom_money_format($score_card_res['loanamount']).")" : "";
        }
    }

    $partner_name = "--";
    if(!empty($pat_id)) {
        $pat_name_qry = "select partner_id, partner_name from tbl_mlc_partner where partner_id = '".$pat_id."'";
        $pat_name_exe = mysqli_query($Conn1, $pat_name_qry);
        if(mysqli_num_rows($pat_name_exe) > 0) {
            $pat_res = mysqli_fetch_array($pat_name_exe);
            $partner_res = $pat_res['partner_name'];
            $partner_name = (trim($partner_res) != "") ? "(".$partner_res.")" : "--";
        }
    }

    ?>
    <?php $return_html .= '<tr class="center-align"><td>'.$sr_no.'</td><td><a href = "../app/edit_applicaton.php?case_id='.urlencode(base64_encode($case_id)).'&app_id='.urlencode(base64_encode($app_id)).'&cust_id='.urlencode(base64_encode($cust_id)).'&loan_type='.$loan_type.'">'.$app_id.'</a><br><span class="fs-12">(<a href="../cases/edit.php?case_id='.$enc_cs.'">'.$case_id.'</a>)</span></td><td style="width: 7%">'.$exe_app_bank['bank_name'].'<br><span class="fs-12">'.$partner_name.'</span></td><td>'.$pre_login_name."/".$exe_app_status['app_status'].'</td><td>'.$bank_response.'</td><td>'.$api_status.'</td><td>'.$follow_up_date_on.'</td><td>'.$exe_f['follow_status'].'</td><td>'.$app_description.'</td><td style="word-break: break-all;">'.$final_rm_emails.'<br>'.$final_rm_contacts.'<br>'.$final_rm_names.'</td><td style="word-break: break-all;">'.$final_sm_emails.'<br>'.$final_sm_contacts.'<br>'.$final_sm_names.'</td><td style="width: 7%">'.$date_created.'<br>'.$user_by.'</td><td>'.$last_updated.'</td></tr>'; ?>
    <?php } ?>
    <?php $return_html .= '</table>'; ?>
<?php } ?>
<?php echo $return_html; ?>