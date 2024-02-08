<?php
$slave = 1;
require_once "../config/config.php";
require_once "../include/helper.functions.php";
require_once "../include/display-name-functions.php";
$type = $_REQUEST['type'];
$return_html = "";
/* coding for customer Query history start */
if($type == "query") {
    $cust_id = $_REQUEST['cust_id'];
    $query_history_query = "select stats.query_status,qry.query_id as id,qry.loan_amt as loan_amt,loan.loan_type_name as loan_type_name,stats.date as date,user.user_name as user_name from tbl_mint_query as qry left JOIN tbl_mint_query_status_detail as stats ON qry.query_id = stats.query_id left join lms_loan_type as loan on qry.loan_type = loan.loan_type_id left join tbl_user_assign as user on stats.user_id = user.user_id where qry.cust_id = ".$cust_id." order by qry.query_id desc limit 10";
    $query_history_result= mysqli_query($Conn1,$query_history_query);
    $query_history = mysqli_num_rows($query_history_result);
    $sr_no = 0;
    if($query_history > 0) {
        $return_html .= "<table  class='gridtable' width='100%'><tr><th>Sr. No.</th><th>Query Id</th><th>Loan Type & Amount </th><th>Status & User</th><th>Date</th></tr>";
        while($query_history_info = mysqli_fetch_array($query_history_result)) {
            ++$sr_no;
            $id = $query_history_info['id'];
            $loan_amt = $query_history_info['loan_amt'];
            $date = $query_history_info['date'];
            $loan_name = $query_history_info['loan_type_name'];
            $user_name = $query_history_info['user_name'];
            $query_status = $query_history_info['query_status'];
            $query_status_name = get_display_name('query_status',$query_status);
            if($query_status_name == ''){
                $query_status_name = get_display_name('new_status_name',$query_status);
            }
            $enc_id = urlencode(base64_encode($query_history_info['id']));
            $user_by = (trim($query_history_info['user_name']) != "") ? "(By: ".$query_history_info['user_name'].")" : "";
            $loan_amount = (($query_history_info['loan_amt'] > 0) && is_numeric($query_history_info['loan_amt'])) ? "(".custom_money_format($query_history_info['loan_amt']).")" : "";
            $return_html .= "<tr class='center-align'><td>".$sr_no."</td><td><a href='../query/edit.php?id=$enc_id&ut=2' target ='_blank'>".$query_history_info['id']."</a></td><td>".$query_history_info['loan_type_name']."<br><span class='fs-12'>".$loan_amount."</span></td><td>".$query_history_info['qy_status']."<br><span class='fs-12'>".$user_by."</span></td><td>".date('d-m-Y',strtotime($query_history_info['date']))."</td></tr>";
        }
        $return_html .= "</table><br>";
    /*}*/
    } else {
        $return_html = "";
    }
}
/* coding for customer Query history ends*/
/* coding for customer case history start */
if($type == "case") {
    $case_id = $_REQUEST['case_id'];
    $case_history_query = "select * from crm_lead_assignment_history where lead_id = '".$case_id."'";
    
    $case_history_result= mysqli_query($Conn1,$case_history_query);
    $case_count = mysqli_num_rows($case_history_result);
    $sr_no = 0;
    if($case_count > 0) {
        $return_html .= '<table  class="gridtable" width="100%"><tr><th>Sr. No.</th><th>User Assign From</th><th>User Assign To</th><th>Assign By</th><th>Date</th></tr>';
        while($case_history_info = mysqli_fetch_array($case_history_result)) {
            ++$sr_no;
            $user_assign_from_id =  $case_history_info['user_assign_from'];
            $user_assign_to_id = $case_history_info['user_assign_to'];
            $assign_by_id  = $case_history_info['assign_by'];
            $created_on = $case_history_info['created_on'];

            $user_assign_from_get = get_name('user_id',$user_assign_from_id);
            $user_assign_from = $user_assign_from_get['name'];
            $user_assign_to_get = get_name('user_id',$user_assign_to_id);
            $user_assign_to = $user_assign_to_get['name'];
            $assign_by_get = get_name('user_id',$assign_by_id);
            $assign_by = $assign_by_get['name'];

            $return_html .= "<tr class='center-align'><td>".$sr_no."</td><td>".$user_assign_from."</td><td>".$user_assign_to."</td><td>".$assign_by."</td><td>".date('d-m-Y', strtotime($created_on))."</td></tr>";
        }
        $return_html .= "</table><br>";
        /*}*/
    } else {
        $return_html = "";
    }
}
/* coding for customer case history ends*/ 
/* coding for customer application history start */
if($type == "app") {
    // $case_id = $_REQUEST['case_id'];
    // $loan_type = $_REQUEST['loan_type'];
    // $cust_id = $_REQUEST['cust_id'];
    // $app_history_query = "select app.app_id as app_id,app.partner_on as partner_on,app.app_bank_on as app_bank_on,app.app_status_on as app_status_on,app.date_created as date_created,user.user_name as user_name,app.login_date_on as login_date_on,app.sanction_date_on as sanction_date_on,app.first_disb_date_on as first_disb_date_on, app.la_st_up_date from tbl_mint_app as app join tbl_mint_case as cse on app.case_id = cse.case_id left join tbl_user_assign as user on cse.user_id = user.user_id where app.case_id = $case_id order by app.app_id desc";
    // $app_history_result= mysqli_query($Conn1, $app_history_query);
    // $app_history = mysqli_num_rows($app_history_result);
    // $sr_no = 0; 
    // if($app_history > 0) {
    //     $return_html .= '<table class="gridtable" width="100%"><tr class="font-weight-bold"><th>Sr. No.</th><th>App Id</th><th>Case Id</th><th>Partner</th><th>Status</th><th>Bank Response</th><th>Bank / User</th><th>Date</th><th>Last Updated</th></tr>';
    // while($app_history_info = mysqli_fetch_array($app_history_result)) {
    //     ++$sr_no;
    //     $app_id = $app_history_info['app_id'];
    //     $partner_on = $app_history_info['partner_on'];
    //     $app_bank_on  = $app_history_info['app_bank_on'];
    //     $app_status_on  = $app_history_info['app_status_on'];

    //     $last_updated = "--";
    //     if(trim($app_history_info['la_st_up_date']) != "") {
    //         $last_updated = (date('Y-m-d', strtotime($app_history_info['la_st_up_date'])) != "0000-00-00" || date('Y-m-d', strtotime($app_history_info['la_st_up_date'])) != "1970-01-01" || date('Y-m-d', strtotime($app_history_info['la_st_up_date'])) != "") ? date('d-m-Y h:i A', strtotime($app_history_info['la_st_up_date'])) : "--";
    //     }

    //     if($app_status_on == 3) {
    //         $app_st_date = ($app_history_info['login_date_on'] != "" || $app_history_info['login_date_on'] != "0000-00-00" || $app_history_info['login_date_on'] != "1970-01-01") ? "(".date("d-m-Y", strtotime($app_history_info['login_date_on'])).")" : "--";
    //     }
    //     else if($app_status_on == 5) {
    //         $app_st_date = ($app_history_info['sanction_date_on'] != "" || $app_history_info['sanction_date_on'] != "0000-00-00" || $app_history_info['sanction_date_on'] != "1970-01-01") ? "(".date("d-m-Y", strtotime($app_history_info['sanction_date_on'])).")" : "--";
    //     }
    //     else if($app_status_on == 6 || $app_status_on == 7) {
    //         $app_st_date = ($app_history_info['first_disb_date_on'] != "" || $app_history_info['first_disb_date_on'] != "0000-00-00" || $app_history_info['first_disb_date_on'] != "1970-01-01") ? "(".date("d-m-Y", strtotime($app_history_info['first_disb_date_on'])).")" : "--";
    //     }
    //     else{
    //         $app_st_date = "";
    //     }
    //     $q_app_statuson = "select app_status from tbl_app_status where app_status_id = '".$app_status_on."'";
    //     $r_app_statuson = mysqli_query($Conn1, $q_app_statuson);
    //     $e_app_statuson = mysqli_fetch_array($r_app_statuson);
    //     $name_app_statuson = $e_app_statuson['app_status'];

    //     $q_bank_on = "select bank_name from tbl_bank where bank_id = '".$app_bank_on."'";
    //     $r_bank_on = mysqli_query($Conn1, $q_bank_on);
    //     $e_bank_on = mysqli_fetch_array($r_bank_on);
    //     $name_bank_on = $e_bank_on['bank_name'];

    //     $qrydesc_partner = "select partner_name from tbl_mlc_partner where partner_id = '".$partner_on."'";
    //     $resdesc_partner = mysqli_query($Conn1, $qrydesc_partner);
    //     $exedesc_partner = mysqli_fetch_array($resdesc_partner);
    //     $partner_name = $exedesc_partner['partner_name'];
    //     $enc_cs = urlencode(base64_encode($case_id));
    //     $enc_cust = urlencode(base64_encode($cust_id));

    //     $pat_id_qry = "select pat_id from tbl_pat_loan_type_mapping where bank_id = ".$app_bank_on." and loan_type = ".$loan_type;
    //     $pat_id_res = mysqli_query($Conn1, $pat_id_qry);
    //     $pat_id_result = mysqli_fetch_array($pat_id_res);
    //     $pat_id  = $pat_id_result['pat_id'];
    //     $bank_response = "--";
    //     $kotak_resp_array = array('1'=>'Follow Up','2'=>'Declined','3'=>'Login','4'=>'Hold','5'=>'Disbursed','6'=>'Sanctioned','7'=>'Approved','8'=>'Closed','9'=>'In Process');
    //     if($pat_id != "" && $case_id != "") {
    //         $new_qry = "select ref_id, response, res_desc from tbl_pat_retrn_respnse where case_id = ".$case_id." and partner_id = '".$pat_id."'";
    //         $res_new_qry = mysqli_query($Conn1, $new_qry);
    //         if(mysqli_num_rows($res_new_qry) > 0) {
    //             $exe_new_qry = mysqli_fetch_array($res_new_qry);
    //             $bank_response = $exe_new_qry['response'];
    //             $resc_desc = (trim($exe_new_qry['res_desc']) != "") ? "(".$exe_new_qry['res_desc'].")" : "";
    //             if($pat_id == 48) {
    //                 if ($bank_response == "4") {
    //                     $bank_response = "AIP Refer <br>" . $resc_desc;
    //                 } else if ($bank_response == "0") {
    //                     $bank_response = "FAILURE/ERROR <br>" . $resc_desc;
    //                 } else if ($bank_response == "3") {
    //                     $bank_response = "AIP Rejected <br>" . $resc_desc;
    //                 } else if ($bank_response == "1") {
    //                     $bank_response = "AIP Approve <br>" . $resc_desc;
    //                 } else {
    //                     $bank_response = "Error in API <br>" . $resc_desc;
    //                 }
    //             } else if($pat_id == 58) {
    //                 if ($bank_response == 'Amber') {
    //                     $bank_response = 'AIP Refered <br>' . $resc_desc;
    //                 } else if ($bank_response == 'Red') {
    //                     $bank_response = 'AIP Reject <br>' . $resc_desc;
    //                 } else if ($bank_response == 'Green') {
    //                     $bank_response = 'AIP OK <br>' . $resc_desc;
    //                 } else {
    //                     $bank_response = $resc_desc;
    //                 }
    //             } else if($pat_id == 5) {
    //                 $bank_response = $resc_desc;
    //             } else if($pat_id == 84) {
    //                 if($bank_response == "401") {
    //                     $bank_response == "Failed";
    //                 } else {
    //                     $bank_response = $resc_desc;
    //                 }
    //             } else if($pat_id == 24 ) {
    //                 $bank_response = $kotak_resp_array[$bank_response] . " " . $res_desc;
    //             }
    //         }
    //     }

    //     $user_by = (trim($app_history_info['user_name']) != "") ? "(By: ".$app_history_info['user_name'].")" : "";

    //     $return_html .= "<tr class='center-align'><td>".$sr_no."</td><td><a href='../app/edit_applicaton.php?case_id=$enc_cs&cust_id=$enc_cust&loan_type=$loan_type&ut=2' target ='_blank'>".$app_id."</a></td><td><a href='../cases/edit.php?case_id=".$enc_cs."'>".$case_id."</a></td><td>".$partner_name."</td><td>".$name_app_statuson."<br><span class='fs-12'>".$app_st_date."</span></td><td>".$bank_response."</td><td>".$name_bank_on."<br><span class='fs-12'>".$user_by."</span></td><td>".date('d-m-Y',strtotime($app_history_info['date_created']))."</td><td>".$last_updated."</td></tr>";
    // }
    // $return_html .= "</table>";
    // } else {
    //     $return_html = "";
    // }
    $case_id = $_REQUEST['case_id'];
$loan_type = $_REQUEST['loan_type'];
$cust_id = $_REQUEST['cust_id'];
$case_id = $_REQUEST['case_id'];
$qry = "select * from crm_query_application where crm_query_id = ".$case_id."";
$res = mysqli_query($Conn1,$qry) or die(mysqli_error($Conn1));
$res_num = mysqli_num_rows($res);
if($res_num > 0) {
    $sr_no = 0;
?>
   <?php $return_html = '<table width="100%" class="gridtable"><tr class="font-weight-bold"><th>Sr. No.</th><th>Application Id / Case Id </th><th>Action</th></tr>'; ?>

    <?php while($exe_app_history = mysqli_fetch_array($res)){
        print_r($exe_app_history);
        // echo $return_html;
    ++$sr_no;
    // $f_type = $exe_app_history['follow_up_type_on'];
    // $follow_up_date_on = ($exe_app_history['follow_up_date_on'] == '0000-00-00' || $exe_app_history['follow_up_date_on'] == "" || $exe_app_history['follow_up_date_on'] == "1970-01-01") ? '--' : date("d-m-Y", strtotime($exe_app_history['follow_up_date_on']));
    // $app_id = $exe_app_history['app_id'];
    // $app_status_on = $exe_app_history['app_status_on'];
    // $app_bank_on = $exe_app_history['app_bank_on'];
    // $pre_login_status = $exe_app_history['pre_login_status'];
    // $app_description = $exe_app_history['app_description'];

    // $date_created = (trim($exe_app_history['date_created']) != "" && $exe_app_history['date_created'] != "0000-00-00" && $exe_app_history['date_created'] != "1970-01-01") ? date("d-m-Y", strtotime($exe_app_history['date_created'])) : "--";

    // $last_updated = "--";
    // if(trim($exe_app_history['la_st_up_date']) != "") {
    //     $last_updated = (date('Y-m-d', strtotime($exe_app_history['la_st_up_date'])) != "0000-00-00" || date('Y-m-d', strtotime($exe_app_history['la_st_up_date'])) != "1970-01-01" || date('Y-m-d', strtotime($exe_app_history['la_st_up_date'])) != "") ? date('d-m-Y h:i A', strtotime($exe_app_history['la_st_up_date'])) : "--";
    // }

    // $qry_f = "select * from tbl_follow_status where follow_id = '".$f_type."'";
    // $res_f = mysqli_query($Conn1,$qry_f);
    // $exe_f = mysqli_fetch_array($res_f);

    // /*$qry_app_status = "select * from tbl_app_status where app_status_id = '".$app_status_on."'";
    // $res_app_status = mysqli_query($Conn1,$qry_app_status);
    // $exe_app_status = mysqli_fetch_array($res_app_status);


    // $pre_app_status = "select pre_status_name from tbl_app_pre_login where pre_status_id = '".$pre_login_status."'";
    // $pre_app_status = mysqli_query($Conn1,$pre_app_status);
    // $pre_app_status = mysqli_fetch_array($pre_app_status);
    // $pre_login_name = $pre_app_status['pre_status_name'];*/

    // $pre_login_name = get_display_name('pre_login',$pre_login_status);
    //         if($pre_login_name == ''){
    //             $pre_login_name = get_display_name('new_status_name',$pre_login_status);
    //         }
    //         $post_login_name = get_display_name('post_login',$app_status_on);
    //         if($post_login_name == ''){
    //             $post_login_name = get_display_name('new_status_name',$app_status_on);
    //         }

    // $qry_app_bank = "select * from tbl_bank where bank_id = '".$app_bank_on."'";
    // $res_app_bank = mysqli_query($Conn1,$qry_app_bank);
    // $exe_app_bank = mysqli_fetch_array($res_app_bank);

    // $qry_cust = "select cust_id, tbl_user_assign.user_name as user_name from tbl_mint_case left join tbl_user_assign on tbl_user_assign.user_id = tbl_mint_case.user_id where case_id = ".$case_id."";
    // $res_cust  = mysqli_query($Conn1,$qry_cust);
    // $exe_cust  = mysqli_fetch_array($res_cust);
    // $cust_id = $exe_cust['cust_id'];
    // $user_by = (trim($exe_cust['user_name']) != "") ? "(By: ".$exe_cust['user_name'].")" : "";        

    // $bank_response = "--";
    // $score_card = "";
    // $loanamount = "";
    // $pat_id_qry = "select pat_id from tbl_pat_loan_type_mapping where bank_id = ".$app_bank_on." and loan_type = ".$loan_type;
    // $pat_id_res = mysqli_query($Conn1, $pat_id_qry);
    // $pat_id_result = mysqli_fetch_array($pat_id_res);
    // $pat_id  = $pat_id_result['pat_id'];

    // $kotak_resp_array = array('1'=>'Follow Up','2'=>'Declined','3'=>'Login','4'=>'Hold','5'=>'Disbursed','6'=>'Sanctioned','7'=>'Approved','8'=>'Closed','9'=>'In Process');

    // if($pat_id != "" && $case_id != "") {
    //     $new_qry = "SELECT ref_id, response, res_desc FROM tbl_pat_retrn_respnse WHERE case_id = ".$case_id." AND partner_id = '".$pat_id."' ORDER BY resp_id DESC LIMIT 0, 1";
    //     $res_new_qry = mysqli_query($Conn1, $new_qry);
    //     if(mysqli_num_rows($res_new_qry) > 0) {
    //         $exe_new_qry = mysqli_fetch_array($res_new_qry);
    //         $bank_response = $exe_new_qry['response'];
    //         $resc_desc = (trim($exe_new_qry['res_desc']) != "") ? "(".$exe_new_qry['res_desc'].")" : "";
    //         if($pat_id == 48) {
    //             if ($bank_response == "4") {
    //                 $bank_response = "AIP Refer <br>" . $resc_desc;
    //             } else if ($bank_response == "0") {
    //                 $bank_response = "FAILURE/ERROR <br>" . $resc_desc;
    //             } else if ($bank_response == "3") {
    //                 $bank_response = "AIP Rejected <br>" . $resc_desc;
    //             } else if ($bank_response == "1") {
    //                 $bank_response = "AIP Approve <br>" . $resc_desc;
    //             } else {
    //                 $bank_response = "Error in API <br>" . $resc_desc;
    //             }
    //         } else if($pat_id == 58) {
    //             if ($bank_response == 'Amber') {
    //                 $bank_response = 'AIP Refered <br>' . $resc_desc;
    //             } else if ($bank_response == 'Red') {
    //                 $bank_response = 'AIP Reject <br>' . $resc_desc;
    //             } else if ($bank_response == 'Green') {
    //                 $bank_response = 'AIP OK <br>' . $resc_desc;
    //             } else {
    //                 $bank_response = $resc_desc;
    //             }
    //         } else if($pat_id == 5) {
    //             $bank_response = $resc_desc;
    //         } else if($pat_id == 84) {
    //             if($bank_response == "401") {
    //                 $bank_response == "Failed";
    //             } else {
    //                 $bank_response = $resc_desc;
    //             }
    //         } else if($pat_id == 24 ) {
    //             $bank_response = $kotak_resp_array[$bank_response] . " " . $resc_desc;
    //         } else if ($pat_id == 62 || $pat_id == 60 || $pat_id == 44) {
    //             $bnk_cibil_score = '';
    //             if ($pat_id == 62) {
    //                 $check_cibil_qry = mysqli_query($Conn1, "select Score from ybl_credit_score where requestReferenceNo ='" . $app_id . "'");
    //                 if (mysqli_num_rows($check_cibil_qry) > 0) {
    //                     $result_cibil_qry = mysqli_fetch_array($check_cibil_qry);
    //                     $bnk_cibil_score = "(<span class='green'>" . $result_cibil_qry['Score'] . "</span>)";
    //                 }
    //             }
    //             $bank_response = $exe_new_qry['ref_id'] . " " . $bnk_cibil_score;
    //         } else if ($pat_id == 42) {
    //             $check_res_qry = mysqli_query($Conn1, "select status from partner_lead_status where app_id ='" . $app_id . "' and partner_id = '42' order by status_id DESC LIMIT 1");
    //             if (mysqli_num_rows($check_res_qry) > 0) {
    //                 $result_res_qry = mysqli_fetch_array($check_res_qry);
    //                 $bnk_response = "<span class='green'>" . $exe_app_history['cibil_score'] . " " . $result_res_qry['status'] . "</span>";
    //             }

    //             $bank_response = $bnk_response;
    //         } else if($pat_id == 50 || $pat_id == 46 || $pat_id == 31 || $pat_id == 80 || $pat_id == 47 || $pat_id == 77 || $pat_id == 78 || $pat_id == 27 || $pat_id == 28 || $pat_id == 16 || $pat_id == 26 || $pat_id == 79 || $pat_id == 8 || $pat_id == 56 || $pat_id == 49 || $pat_id == 74 || $pat_id == 38 || $pat_id == 69 || $pat_id == 41 || $pat_id == 4 || $pat_id == 68) {
    //             $bank_response = $bank_response . " " . $resc_desc;
    //         }
    //     }

    //     //Starts --- email
    //     $rm_query = "select history_id, group_concat(distinct(banker_email)) as rm_email, banker_type, banker_name as rm_name from banker_email_history where case_id = '".$case_id."' and partner_id = '".$pat_id."' and banker_type = 'rm' ";
    //     $sm_query = "select history_id, group_concat(distinct(banker_email)) as sm_email, banker_type, banker_name as sm_name from banker_email_history where case_id = '".$case_id."' and partner_id = '".$pat_id."' and banker_type = 'sm' ";

    //     $rm_query_exe = mysqli_query($Conn1, $rm_query);
    //     $rm_emails = array();
    //     $rm_names = array();
    //     if(mysqli_num_rows($rm_query_exe) > 0) {
    //         $rm_query_res = mysqli_fetch_array($rm_query_exe);
    //         $rm_emails[] = $rm_query_res['rm_email'];
    //         $rm_names[] = $rm_query_res['rm_name'];
    //     }

    //     $sm_query_exe = mysqli_query($Conn1, $sm_query);
    //     $sm_emails = array();
    //     $sm_names = array();
    //     if(mysqli_num_rows($sm_query_exe) > 0) {
    //         $sm_query_res = mysqli_fetch_array($sm_query_exe);
    //         $sm_emails[] = $sm_query_res['sm_email'];
    //         $sm_names[] = $sm_query_res['sm_name'];
    //     }

    //     $rm_query_sms = "select history_id, group_concat(distinct(partner_contact_no)) as rm_contact, banker_type, banker_name as rm_c_name from banker_sms_history where case_id = '".$case_id."' and partner_id = '".$pat_id."' and banker_type = 'rm' ";
    //     $sm_query_sms = "select history_id, group_concat(distinct(partner_contact_no)) as sm_contact, banker_type, banker_name as sm_c_name from banker_sms_history where case_id = '".$case_id."' and partner_id = '".$pat_id."' and banker_type = 'sm' ";

    //     $rm_query_sms_exe = mysqli_query($Conn1, $rm_query_sms);
    //     $rm_contacts = array();
    //     $rm_c_name = array();
    //     if(mysqli_num_rows($rm_query_sms_exe) > 0) {
    //         $rm_query_sms_res = mysqli_fetch_array($rm_query_sms_exe);
    //         $rm_contacts[] = $rm_query_sms_res['rm_contact'];
    //         $rm_c_name[] = $rm_query_sms_res['rm_c_name'];
    //     }

    //     $sm_query_sms_exe = mysqli_query($Conn1, $sm_query_sms);
    //     $sm_contacts = array();   
    //     $sm_c_name = array();   
    //     if(mysqli_num_rows($sm_query_sms_exe) > 0) {
    //         $sm_query_sms_res = mysqli_fetch_array($sm_query_sms_exe);
    //         $sm_contacts[] = $sm_query_sms_res['sm_contact'];
    //         $sm_c_name[] = $sm_query_sms_res['sm_c_name'];
    //     }

    //     $final_rm_emails = (!empty($rm_emails) && trim($rm_emails) != ",") ? implode(", ", $rm_emails) : "--";
    //     $final_sm_emails = (!empty($sm_emails) && trim($sm_emails) != ",") ? implode(", ", $sm_emails) : "--";

    //     $final_rm_names = (!empty($rm_names) && trim($rm_names) != ",") ? implode(", ", $rm_names) : "--";
    //     $final_sm_names = (!empty($sm_names) && trim($sm_names) != ",") ? implode(", ", $sm_names) : "--";

    //     $final_rm_c_names = (!empty($rm_c_name) && trim($rm_c_name) != ",") ? implode(", ", $rm_c_name) : "--";
    //     $final_sm_c_names = (!empty($sm_c_name) && trim($sm_c_name) != ",") ? implode(", ", $sm_c_name) : "--";

    //     if(trim($final_rm_emails) == "") {
    //         $final_rm_emails = "--";
    //     }
    //     if(trim($final_sm_emails) == "") {
    //         $final_sm_emails = "--";
    //     }

    //     if(trim($final_rm_names) == "") {
    //         if(trim($final_rm_c_names) == "") {
    //             $final_rm_names = "--";
    //         } else {
    //             $final_rm_names = $final_rm_c_names;
    //         }
    //     } else {
    //         $final_rm_names = "(".$final_rm_names.")";
    //     }
    //     if(trim($final_sm_names) == "") {
    //         if(trim($final_sm_c_names) == "") {
    //             $final_sm_names = "--";
    //         } else {
    //             $final_sm_names = $final_sm_c_names;
    //         }
    //     } else {
    //         $final_sm_names = "(".$final_sm_names.")";
    //     }

    //     $final_rm_contacts = (!empty($rm_contacts)) ? implode(", ", $rm_contacts) : "--";
    //     $final_sm_contacts = (!empty($sm_contacts)) ? implode(", ", $sm_contacts) : "--";

    //     if(trim($final_rm_contacts) == "") {
    //         $final_rm_contacts = "--";
    //     }
    //     if(trim($final_sm_contacts) == "") {
    //         $final_sm_contacts = "--";
    //     }
    //     //Ends
    //     $enc_cs = urlencode(base64_encode($case_id));

    //     $score_card_query = "select cibil_score, loanamount from tbl_customer_application_api_elig where app_id = $app_id and partner_id = $pat_id";
    //     $score_card_exe = mysqli_query($Conn1, $score_card_query);
    //     if(mysqli_num_rows($score_card_exe) > 0) {
    //         $score_card_res = mysqli_fetch_array($score_card_exe);
    //         $score_card = ($score_card_res['cibil_score'] != "" && $score_card_res['cibil_score'] != "0" && $score_card_res['cibil_score'] != "0.00") ? "(Cibil: ".$score_card_res['cibil_score'].")" : "";
    //         $loanamount = (trim($score_card_res['loanamount']) != "") ? "(API Amount: ".custom_money_format($score_card_res['loanamount']).")" : "";
    //     }
    // }

    // $partner_name = "--";
    // if(!empty($pat_id)) {
    //     $pat_name_qry = "select partner_id, partner_name from tbl_mlc_partner where partner_id = '".$pat_id."'";
    //     $pat_name_exe = mysqli_query($Conn1, $pat_name_qry);
    //     if(mysqli_num_rows($pat_name_exe) > 0) {
    //         $pat_res = mysqli_fetch_array($pat_name_exe);
    //         $partner_res = $pat_res['partner_name'];
    //         $partner_name = (trim($partner_res) != "") ? "(".$partner_res.")" : "--";
    //     }
    // }

    // $api_status = "";
    // $api_status_qry = "SELECT respcode FROM api_helper LEFT JOIN tbl_bank_resp_code ON tbl_bank_resp_code.id = api_helper.status_id where application_id = '".$app_id."'";
    // $api_status_exe = mysqli_query($Conn1, $api_status_qry);
    // if(mysqli_num_rows($api_status_exe) > 0) {
    //     $api_status_res = mysqli_fetch_array($api_status_exe);
    //     $api_status = (trim($api_status_res['respcode']) != "") ? $api_status_res['respcode'] : "--";
    // }
    // if(trim($api_status) == "") {
    //     $api_status = "--";
    // }

    ?>
    <?php $return_html .= '<tr class="center-align"><td>'.$sr_no.'</td><td><a href = "../app/edit_applicaton.php?case_id='.urlencode(base64_encode($case_id)).'&cust_id='.urlencode(base64_encode($cust_id)).'&loan_type='.$loan_type.'">'.$app_id.'</a><br><span class="fs-12">(<a href="../cases/edit.php?case_id='.$enc_cs.'">'.$case_id.'</a>)</span></td><td style="width: 7%">'.$exe_app_bank['bank_name'].'<br><span class="fs-12">'.$partner_name.'</span></td><td>'.$pre_login_name."/".$post_login_name.'</td><td>'.$bank_response.'</td><td>'.$api_status.'</td><td>'.$follow_up_date_on.'</td><td>'.$exe_f['follow_status'].'</td><td>'.$app_description.'</td><td style="word-break: break-all;">'.$final_rm_emails.'<br>'.$final_rm_contacts.'<br>'.$final_rm_names.'</td><td style="word-break: break-all;">'.$final_sm_emails.'<br>'.$final_sm_contacts.'<br>'.$final_sm_names.'</td><td style="width: 7%">'.$date_created.'<br>'.$user_by.'</td><td>'.$last_updated.'</td></tr>'; ?>
    <?php } ?>
    <?php $return_html .= '</table>';
    }
}

echo $return_html;
/* coding for customer application history ends*/
?>