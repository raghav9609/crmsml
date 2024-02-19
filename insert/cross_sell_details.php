<?php
require_once "../../include/check-session.php";
require_once "../../include/config.php";
require_once "../../include/helper.functions.php";
require_once "../../include/display-name-functions.php";

$return_html = "";
$return_html_original_query = "";
$return_html_case = "";
$return_html_app = "";

$type = $_REQUEST['type'];

$query_id = $_REQUEST['query_id'];

if($type == 'app') {
    $case_id = $_REQUEST['case_id'];
    $query_id_qry = "SELECT tbl_mint_query.query_id as query_id, tbl_mint_query.tool_type as tool_type FROM tbl_mint_case INNER JOIN tbl_mint_query ON tbl_mint_query.query_id = tbl_mint_case.query_id WHERE tbl_mint_case.case_id = $case_id AND tbl_mint_query.tool_type = 'Cross Sell - Auto' ";
    $query_id_exe = mysqli_query($Conn1, $query_id_qry);
    if(mysqli_num_rows($query_id_exe) > 0) {
        $query_id_result = mysqli_fetch_array($query_id_exe);
        $query_id = $query_id_result['query_id'];
    }
}

$cross_sell_query = "";

if($query_id > 0) {
    $cross_sell_query = " SELECT lead_id as original_id, lms_loan_type.loan_type_name as new_query_product_name, loan_nature_name as new_query_loan_nature, new_lead_id as new_query_id, lead_created_on as query_created_datetime, query_lead_upload.level_id as original_level_id, level_type, original_lms_loan_type.loan_type_name as original_query_product_name, criteria_description, no_of_days FROM query_lead_upload LEFT JOIN lms_loan_type ON lms_loan_type.loan_type_id = query_lead_upload.loan_type LEFT JOIN tbl_loan_nature ON tbl_loan_nature.loan_nature_id = query_lead_upload.loan_nature LEFT JOIN cross_sell_criteria ON query_lead_upload.cross_sell_criteria_id = cross_sell_criteria.id LEFT JOIN lms_loan_type original_lms_loan_type ON original_lms_loan_type.loan_type_id = cross_sell_criteria.loan_type_id WHERE new_lead_id = '".$query_id."' ORDER BY query_lead_upload.id DESC LIMIT 0,1 ";
}

if(trim($cross_sell_query) != "") {
    $cross_sell_exe = mysqli_query($Conn1, $cross_sell_query);
    if(mysqli_num_rows($cross_sell_exe) > 0) {
        $return_html_original_query .= "<table class='gridtable' style='width: 100%'> <tr class='font-weight-bold'> <th>Original Product Name</th> <th>Original ID</th> <th>New Query Product Name / Loan Nature</th> <th>New Query ID</th> <th>Description</th> <th>Query Created Date-Time</th> </tr>";
        // while($cross_sell_res = mysqli_fetch_array($cross_sell_exe)) {
            $cross_sell_res = mysqli_fetch_array($cross_sell_exe);
            $original_id = ($cross_sell_res['original_id'] > 0) ? $cross_sell_res['original_id'] : "--";
            $new_query_product_name = (trim($cross_sell_res['new_query_product_name']) != "") ? $cross_sell_res['new_query_product_name'] : "--";
            $new_query_loan_nature = (trim($cross_sell_res['new_query_loan_nature']) != "") ? "(".$cross_sell_res['new_query_loan_nature'].")" : "--";
            $new_query_id = ($cross_sell_res['new_query_id'] > 0) ? $cross_sell_res['new_query_id'] : "--";
            $query_created_datetime = ($cross_sell_res['new_query_id'] != "0000-00-00 00:00:00" && date("d-m-Y", strtotime($cross_sell_res['query_created_datetime'])) != "" && date("d-m-Y", strtotime($cross_sell_res['query_created_datetime'])) != "00-00-0000" && date("d-m-Y", strtotime($cross_sell_res['query_created_datetime'])) != "01-01-1970") ? date("d-m-Y H:i:s A", strtotime($cross_sell_res['query_created_datetime'])) : "--";

            $level_type = (trim($cross_sell_res['level_type']) != "") ? "(".$cross_sell_res['level_type'].")" : "--";

            $original_level_id = ($cross_sell_res['original_level_id'] > 0) ? $cross_sell_res['original_level_id'] : 0;

            $description = (trim($cross_sell_res['criteria_description']) != "") ? $cross_sell_res['criteria_description'] : "";
            $original_product_name = (trim($cross_sell_res['original_query_product_name']) != "") ? $cross_sell_res['original_query_product_name'] : "--";

            $return_html_original_query .= "<td align='center'>".$original_product_name."</td><td align='center'>".$original_id."<br><span class='fs-12'>".$level_type."</span></td><td align='center'>".$new_query_product_name."<br>".$new_query_loan_nature."</td><td align='center'>".$new_query_id."</td><td align='center' style='width: 35%'>".$description."</td><td align='center'>".$query_created_datetime."</td></tr></table>";

            if($original_level_id > 0) {
                $case_details_query = "";
                //FOR CASE
                if($original_level_id == 2) {
                    if($original_level_id == 1) {
                        $case_details_query = "SELECT tbl_mint_case_followup.follow_type as case_status, tbl_user_assign.user_name as user_name, tbl_mint_case_followup.follow_date as follow_date, tbl_mint_case_followup.follow_time as follow_time, tbl_mint_case_followup.date as date, tbl_mint_case_followup.time as time, tbl_mint_case_followup.description as description, tbl_mint_case.case_id as case_id from tbl_mint_case, tbl_mint_case_followup, tbl_user_assign, tbl_case_status,tbl_follow_status WHERE tbl_mint_case.case_id = tbl_mint_case_followup.case_id AND tbl_mint_case.query_id = $original_id AND tbl_user_assign.user_id = tbl_mint_case_followup.mlc_user_id AND tbl_follow_status.follow_id = tbl_mint_case_followup.follow_status ORDER BY tbl_mint_case_followup.follow_id DESC LIMIT 0,1";
                    } else if($original_level_id == 2) {
                        $case_details_query = "SELECT tbl_mint_case_followup.follow_type as case_status, tbl_user_assign.user_name as user_name, tbl_mint_case_followup.follow_date as follow_date, tbl_mint_case_followup.follow_time as follow_time, tbl_mint_case_followup.date as date, tbl_mint_case_followup.time as time, tbl_mint_case_followup.description as description, tbl_mint_case.case_id as case_id from tbl_mint_case, tbl_mint_case_followup, tbl_user_assign, tbl_case_status,tbl_follow_status where tbl_mint_case.case_id = tbl_mint_case_followup.case_id AND tbl_mint_case.case_id = $original_id AND tbl_user_assign.user_id = tbl_mint_case_followup.mlc_user_id AND (tbl_follow_status.follow_id = tbl_mint_case_followup.follow_status OR tbl_mint_case_followup.follow_status = 0) ORDER BY tbl_mint_case_followup.follow_id DESC LIMIT 0,1";
                    } else if($original_level_id == 3) {
                        $case_details_query = "SELECT tbl_mint_case_followup.follow_type as case_status, tbl_user_assign.user_name as user_name, tbl_mint_case_followup.follow_date as follow_date, tbl_mint_case_followup.follow_time as follow_time, tbl_mint_case_followup.date as date, tbl_mint_case_followup.time as time, tbl_mint_case_followup.description as description, tbl_mint_case.case_id as case_id FROM tbl_mint_app, tbl_mint_case, tbl_mint_case_followup, tbl_user_assign, tbl_case_status,tbl_follow_status WHERE tbl_mint_app.app_id = $original_id AND tbl_mint_case.case_id = tbl_mint_app.case_id AND tbl_mint_case_followup.case_id =  tbl_mint_app.case_id AND tbl_user_assign.user_id = tbl_mint_case_followup.mlc_user_id AND tbl_follow_status.follow_id = tbl_mint_case_followup.follow_status ORDER BY tbl_mint_case_followup.follow_id DESC LIMIT 0,1";
                    }

                    if($case_details_query != "") {
                        $case_details_exe = mysqli_query($Conn1, $case_details_query);
                        if(mysqli_num_rows($case_details_exe) > 0) {
                            
                            $return_html_case .= "<table class='gridtable' style='width: 100%'> <tr class='font-weight-bold'><th colspan='6'>Original Case Status</th></tr> <tr class='font-weight-bold'> <th>Level Type / Level ID</th> <th>Follow Up Status & Type</th> <th>Follow Date & Time</th> <th>User</th> <th>Update Date & Time</th> <th>Remarks</th> </tr>";
                            
                            $case_details_res = mysqli_fetch_array($case_details_exe);
                            $case_status = get_display_name('case_status',$case_details_res['case_status']);
                            if($case_status == ''){
                                $case_status = get_display_name('new_status_name',$case_details_res['case_status']);
                           }
                            $case_status = (trim($case_status) != "") ? $case_status : "--";
                            $user_name = (trim($case_details_res['user_name']) != "") ? "(By: ".$case_details_res['user_name'].")" : "--";
                            $users_name = (trim($case_details_res['user_name']) != "") ? $case_details_res['user_name'] : "--";
                            $follow_date = ($case_details_res['follow_date'] != "0000-00-00" && $case_details_res['follow_date'] != "" && $case_details_res['follow_date'] != "1970-01-01") ? date("d-m-Y", strtotime($case_details_res['follow_date'])) : "--";

                            if($follow_date != "--" && $case_details_res['follow_time'] != "" && $case_details_res['follow_time'] != "00:00:00") {
                                $follow_time = date("H:i A", strtotime($case_details_res['follow_time']));
                            }

                            $date = ($case_details_res['date'] != "0000-00-00" && $case_details_res['date'] != "" && $case_details_res['date'] != "1970-01-01") ? date("d-m-Y", strtotime($case_details_res['date'])) : "--";

                            if($date != "--" && $case_details_res['time'] != "" && $case_details_res['time'] != "00:00:00") {
                                $time = date("H:i A", strtotime($case_details_res['time']));
                            }

                            $remarks = (trim($case_details_res['description']) != "") ? $case_details_res['description'] : "--";
                            $case_details_id = $case_details_res['case_id'];

                            $return_html_case .= "<tr><td align='center'>Case<br>(".$case_details_id.")</td><td align='center'>".$case_status."<br>".$user_name."</td><td align='center'>".$follow_date."<br>".$follow_time."</td><td align='center'>".$users_name."</td><td align='center'>".$date."<br>".$time."</td><td align='center' style='width: 20%'>".$remarks."</td></tr>";
                            $return_html_case .= "</table>";
                        }
                    }
                }
                //FOR APPLICATION:
                if($original_level_id == 3) {
                    if($original_level_id == 1) {
                        $app_query = "SELECT tbl_mint_app.app_id as app_id, tbl_mint_app.case_id as case_id, 
                        tbl_mint_app.app_status_on as app_status_on, tbl_mint_app.app_bank_on as app_bank_on,  
                        tbl_mint_app.pre_login_status as pre_login_status, tbl_mint_app.app_description as app_description,
                        tbl_mint_app.date_created as date_created, tbl_mint_app.la_st_up_date as la_st_up_date,
                        tbl_mint_app.follow_up_type_on as follow_up_type_on, tbl_mint_app.follow_up_date_on as follow_up_date_on, tbl_bank.bank_name, tbl_mint_case.loan_type as loan_type, tbl_user_assign.user_name as user_name, tbl_mlc_partner.partner_name as partner_name, tbl_mint_app.login_date_on as login_date_on, tbl_mint_app.sanction_date_on as sanction_date_on, tbl_mint_app.first_disb_date_on as first_disb_date_on, tbl_mint_app.loan_tenure_on AS loan_tenure_on, tbl_mint_app.rate_of_in_on AS rate_of_in_on, tbl_mint_app.applied_amount_on AS applied_amount_on FROM tbl_mint_app INNER JOIN tbl_mint_case ON tbl_mint_case.case_id = tbl_mint_app.case_id LEFT JOIN tbl_follow_status ON tbl_mint_app.follow_up_type_on = tbl_follow_status.follow_id LEFT JOIN tbl_bank ON tbl_bank.bank_id = tbl_mint_app.app_bank_on INNER JOIN tbl_user_assign ON tbl_user_assign.user_id = tbl_mint_case.user_id LEFT JOIN tbl_pat_loan_type_mapping ON tbl_pat_loan_type_mapping.loan_type = tbl_mint_case.loan_type AND tbl_pat_loan_type_mapping.bank_id = tbl_mint_app.app_bank_on LEFT JOIN tbl_mlc_partner ON tbl_pat_loan_type_mapping.pat_id = tbl_mlc_partner.partner_id  WHERE tbl_mint_case.case_id = tbl_mint_app.case_id AND tbl_mint_case.query_id = $original_id";

                    } else if($original_level_id == 2) {
                        $app_query = "SELECT tbl_mint_app.app_id as app_id, tbl_mint_app.case_id as case_id,  tbl_mint_app.app_bank_on as app_bank_on, tbl_mint_app.app_status_on as app_status_on,
                        tbl_mint_app.pre_login_status as pre_login_status, tbl_mint_app.app_description as app_description,
                        tbl_mint_app.date_created as date_created, tbl_mint_app.la_st_up_date as la_st_up_date,
                        tbl_mint_app.follow_up_type_on as follow_up_type_on, tbl_mint_app.follow_up_date_on as follow_up_date_on,  tbl_bank.bank_name, tbl_mint_case.loan_type as loan_type, tbl_user_assign.user_name as user_name, tbl_mlc_partner.partner_name as partner_name, tbl_mint_app.login_date_on as login_date_on, tbl_mint_app.sanction_date_on as sanction_date_on, tbl_mint_app.first_disb_date_on as first_disb_date_on, tbl_mint_app.loan_tenure_on AS loan_tenure_on, tbl_mint_app.rate_of_in_on AS rate_of_in_on, tbl_mint_app.applied_amount_on AS applied_amount_on FROM tbl_mint_app LEFT JOIN tbl_follow_status ON tbl_mint_app.follow_up_type_on = tbl_follow_status.follow_id INNER JOIN tbl_bank ON tbl_bank.bank_id = tbl_mint_app.app_bank_on INNER JOIN tbl_mint_case ON tbl_mint_case.case_id = tbl_mint_app.case_id INNER JOIN tbl_user_assign ON tbl_user_assign.user_id = tbl_mint_case.user_id LEFT JOIN tbl_pat_loan_type_mapping ON tbl_pat_loan_type_mapping.loan_type = tbl_mint_case.loan_type AND tbl_pat_loan_type_mapping.bank_id = tbl_mint_app.app_bank_on LEFT JOIN tbl_mlc_partner ON tbl_pat_loan_type_mapping.pat_id = tbl_mlc_partner.partner_id WHERE tbl_mint_app.case_id = $original_id";

                    } else if($original_level_id == 3) {
                        $app_query = "SELECT tbl_mint_app.app_id as app_id, tbl_mint_app.case_id as case_id,  tbl_mint_app.app_bank_on as app_bank_on, tbl_mint_app.app_status_on as app_status_on, tbl_mint_app.pre_login_status as pre_login_status, tbl_mint_app.app_description as app_description, tbl_mint_app.date_created as date_created, tbl_mint_app.la_st_up_date as la_st_up_date, tbl_mint_app.follow_up_type_on as follow_up_type_on, tbl_mint_app.follow_up_date_on as follow_up_date_on, tbl_bank.bank_name, tbl_mint_case.loan_type as loan_type, tbl_user_assign.user_name as user_name, tbl_mlc_partner.partner_name as partner_name, tbl_mint_app.login_date_on as login_date_on, tbl_mint_app.sanction_date_on as sanction_date_on, tbl_mint_app.first_disb_date_on as first_disb_date_on, tbl_mint_app.loan_tenure_on AS loan_tenure_on, tbl_mint_app.rate_of_in_on AS rate_of_in_on, tbl_mint_app.applied_amount_on AS applied_amount_on FROM tbl_mint_app LEFT JOIN tbl_follow_status ON tbl_mint_app.follow_up_type_on = tbl_follow_status.follow_id  INNER JOIN tbl_bank ON  tbl_bank.bank_id = tbl_mint_app.app_bank_on INNER JOIN tbl_mint_case ON tbl_mint_case.case_id = tbl_mint_app.case_id INNER JOIN tbl_user_assign on tbl_user_assign.user_id = tbl_mint_case.user_id LEFT JOIN tbl_pat_loan_type_mapping ON tbl_pat_loan_type_mapping.loan_type = tbl_mint_case.loan_type AND tbl_pat_loan_type_mapping.bank_id = tbl_mint_app.app_bank_on LEFT JOIN tbl_mlc_partner ON tbl_pat_loan_type_mapping.pat_id = tbl_mlc_partner.partner_id WHERE app_id = $original_id";
                    }

                    if($app_query != "") {
                        $app_exe = mysqli_query($Conn1, $app_query);
                        if(mysqli_num_rows($app_exe) > 0) {
                            $sr_no = 0;
                            
                            $return_html_app .= "<table class='gridtable' style='width: 100%'> <tr class='font-weight-bold'><th colspan='8'>Original Application</th></tr> <tr class='font-weight-bold'> <th>Sr. No.</th> <th>Application Id / Case Id</th> <th>Bank / Partner</th> <th>Pre Login/Post Login</th> <th>Description</th> <th>Post Login Date</th> <th>Created Date</th> <th>Last Updated</th> </tr>";

                            while($app_res = mysqli_fetch_array($app_exe)) {
                                ++$sr_no;
                                $case_id = ($app_res['case_id'] > 0) ? $app_res['case_id'] : "--";
                                $f_type = $app_res['follow_up_type_on'];
                                $follow_up_date_on = ($app_res['follow_up_date_on'] == '0000-00-00' || $app_res['follow_up_date_on'] == "" || $app_res['follow_up_date_on'] == "1970-01-01") ? '--' : date("d-m-Y", strtotime($app_res['follow_up_date_on']));
                                $app_id = $app_res['app_id'];
                                $app_bank_on = $app_res['app_bank_on'];
                                $pre_login_status = $app_res['pre_login_status'];
                                $app_description = $app_res['app_description'];
                                $loan_type = $app_res['loan_type'];
                                $user_by = (trim($app_res['user_name']) != "") ? "(By: ".$app_res['user_name'].")" : "";
                                $partner_name = (trim($app_res['partner_name']) != "") ? "(".$app_res['partner_name'].")" : "--";

                                $date_created = (trim($app_res['date_created']) != "" && $app_res['date_created'] != "0000-00-00" && $app_res['date_created'] != "1970-01-01") ? date("d-m-Y", strtotime($app_res['date_created'])) : "--";

                                $last_updated = "--";
                                if(trim($app_res['la_st_up_date']) != "") {
                                    $last_updated = (date('Y-m-d', strtotime($app_res['la_st_up_date'])) != "0000-00-00" || date('Y-m-d', strtotime($app_res['la_st_up_date'])) != "1970-01-01" || date('Y-m-d', strtotime($app_res['la_st_up_date'])) != "") ? date('d-m-Y h:i A', strtotime($app_res['la_st_up_date'])) : "--";
                                }

                                $pre_login_name = $app_res['pre_status_name'];
                                $pre_login_name = get_display_name('pre_login',$app_res['pre_login_status']);
            if($pre_login_name == ''){
                $pre_login_name = get_display_name('new_status_name',$app_res['pre_login_status']);
            }
            $post_status_name = get_display_name('post_login',$app_res['app_status_on']);
            if($post_status_name == ''){
                $post_status_name = get_display_name('new_status_name',$app_res['app_status_on']);
            }

                                $app_st_date = "--";
                                if($app_res['app_status_on'] == 3) {
                                    $app_st_date = (($app_res['login_date_on']) == "0000-00-00" || $app_res['login_date_on'] == "" || $app_res['login_date_on'] == "1970-01-01") ? '--' : "Login Date: ".date("d-m-Y", strtotime($app_res['login_date_on']));
                                } else if($app_res['app_status_on'] == 5) {
                                    $app_st_date = (($app_res['sanction_date_on']) == "0000-00-00" || $app_res['sanction_date_on'] == "" || $app_res['sanction_date_on'] == "1970-01-01") ? '--' : "Sanctioned Date: ".date("d-m-Y", strtotime($app_res['sanction_date_on']));
                                } else if($app_res['app_status_on'] == 6 || $app_res['app_status_on'] == 7) {
                                    $app_st_date = (($app_res['first_disb_date_on']) == "0000-00-00" || $app_res['first_disb_date_on'] == "" || $app_res['first_disb_date_on'] == "1970-01-01") ? '--' : "First Disbursal Date: ".date("d-m-Y", strtotime($app_res['first_disb_date_on']));
                                }

                                $applied_amount_on = ($app_res['applied_amount_on'] > 0) ? "LA: ".custom_money_format($app_res['applied_amount_on']).", " : "";
                                $rate_of_in_on = ($app_res['rate_of_in_on'] > 0) ? "ROI: ".$app_res['rate_of_in_on']." %, " : "";
                                $loan_tenure_on = ($app_res['loan_tenure_on'] > 0) ? "LT: ".$app_res['loan_tenure_on']." months" : "";
                                $collection = $applied_amount_on."".$rate_of_in_on."".$loan_tenure_on;
                                $final_collection = "";
                                if(trim($collection) != "") {
                                    $final_collection = "(".rtrim(trim($collection), ",").")";
                                }
                                
                                $return_html_app .= '<tr class="center-align"><td>'.$sr_no.'</td><td>'.$app_id.'</a><br><span class="fs-12">('.$case_id.')</span></td><td style="width: 7%">'.$app_res['bank_name'].'<br><span class="fs-12">'.$partner_name.'</span></td><td>'.$pre_login_name."/".$post_status_name.'</td><td>'.$app_description.'<br>'.$final_collection.'</td><td>'.$app_st_date.'</td><td style="width: 7%">'.$date_created.'<br>'.$user_by.'</td><td>'.$last_updated.'</td></tr>';
                            }
                            $return_html_app .= '</table>';
                            
                        }
                    }
                }
            }
        // }
    }
}

if($return_html_app != "") {
    $return_html = $return_html_app;
} else if($return_html_case != "") {
    $return_html = $return_html_case;
}
if($return_html_original_query != "") {
    $return_html .= "<br>";
    $return_html .= $return_html_original_query;
}


echo $return_html;