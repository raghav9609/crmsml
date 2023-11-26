<?php
    if(!function_exists('ipRestrictionCheck')){
        function ipRestrictionCheck($ip){
            $return = 1;
            if(!in_array($ip,array('203.122.45.233', '203.122.45.234', '103.93.179.249','103.93.179.250'))){
                $return = 0;
            }
            return $return;
        }
    }
    if(!function_exists('ipAddress')){
        function ipAddress() {
            $ipaddress = '';
            if (isset($_SERVER['HTTP_CLIENT_IP']))
                $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
            else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
                $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
            else if(isset($_SERVER['HTTP_X_FORWARDED']))
                $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
            else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
                $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
            else if(isset($_SERVER['HTTP_FORWARDED']))
                $ipaddress = $_SERVER['HTTP_FORWARDED'];
            else if(isset($_SERVER['REMOTE_ADDR']))
                $ipaddress = $_SERVER['REMOTE_ADDR'];
            else
                $ipaddress = '';
            return $ipaddress;
        }
    }
	if(!function_exists('dateformat')){
        function dateformat($date_time){
			$timestamp = strtotime($date_time);
				return $new_date = date("d-m-Y H:i:s", $timestamp);
        }
    }
	
    if(!function_exists('currentDate')){
        function currentDate(){
            return date("Y-m-d");
        }
    }
    if(!function_exists('currentDatedmy')){
        function currentDatedmy(){
            return date("d-m-Y");
        }
    }
    if(!function_exists('currentTime24')){
        function currentTime24(){
            return date("H:i:s");
        }
    }
    if(!function_exists('currentTime12')){
        function currentTime12(){
            return date("h:i:s a");
        }
    }
    if(!function_exists('currentDateTime24')){
        function currentDateTime24(){
            return date("Y-m-d H:i:s");
        }
    }
    if(!function_exists('currentDateTime12')){
        function currentDateTime12(){
            return date("Y-m-d h:i:s a");
        }
    }
    if(!function_exists('currentDateTime24dmy')){
        function currentDateTime24dmy(){
            return date("d-m-Y H:i:s");
        }
    }
    if(!function_exists('currentDateTime12dmy')){
        function currentDateTime12dmy(){
            return date("d-m-Y h:i:s a");
        }
    }
    if(!function_exists('preArray')){
        function preArray($array=array()){
            echo "<pre>";
            print_r($array);
            echo "</pre>";
        }
    }
    if(!function_exists('gateway_ip')){
        function gateway_ip($val){
            $array = array(1=>"192.168.1.212",2=>"192.168.1.208",3=>"192.168.1.204",4=>"192.168.1.206");
            return $array[$val];
        }
    }
    if(!function_exists('replace_special')){
        function replace_special($postData)
        {
            return preg_replace('/[^A-Za-z0-9\-@_#%. ]/', '', $postData);
        }
    }
    if(!function_exists('alnum_ar_un_hy')){
        function alnum_ar_un_hy($str) {
            return preg_match('/^[a-zA-Z0-9_@ -]+$/',$str);
        }
    }
    if(!function_exists('requestMethod')){   
        function requestMethod(){
            return $_SERVER['REQUEST_METHOD'];
        }
    }
    if(!function_exists('custom_money_format')){
        function custom_money_format($num, $type = 1)
        {
            $explrestunits = "";
            if (strlen($num) > 3) {
                $lastthree = substr($num, strlen($num) - 3, strlen($num));
                $restunits = substr($num, 0, strlen($num) - 3); // extracts the last three digits
                $restunits = (strlen($restunits) % 2 == 1) ? "0" . $restunits : $restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
                $expunit = str_split($restunits, 2);
                for ($i = 0; $i < sizeof($expunit); $i++) {
                    // creates each of the 2's group and adds a comma to the end
                    if ($i == 0) {
                        $explrestunits .= (int)$expunit[$i] . ","; // if is first value , convert into integer
                    } else {
                        $explrestunits .= $expunit[$i] . ",";
                    }
                }
                $thecash = $explrestunits . $lastthree;
            } else {
                $thecash = $num;
            }
            return $thecash; // writes the final format where $currency is the currency symbol.
        }
    }
    if(!function_exists('dateDiff')){
        function dateDiff($date1, $date2)
        {
            $d1 = new DateTime($date1);
            echo $d2 = new DateTime($date2);
            echo $interval = $d2->diff($d1);
            return $interval->format('%m months');
        }
    }
if (!function_exists('date_filteration')) {
    function date_filteration($date_var)
    {
        if ($date_var == "" || $date_var == "1970-01-01" || $date_var == "0000-00-00") {
            $date_var = "--";
        }
        return $date_var;
    }
}
if (!function_exists('common_time_filter')) {
    function common_time_filter($time_var, $time_a = "")
    {
        if (!empty($time_a) && $time_a == "am_pm") {
            $time_var = date("H:i a", strtotime($time_var));
        } else {
            if ($time_var == "00:00:00") {
                $time_var = "--";
            }
        }
        return $time_var;
    }
}
if (!function_exists('special_decryption')) {
    function special_decryption($sData)
    {
        $secretKey = "kYp3s5v8";
        $sResult = '';
        $sData = str_replace('878688', '-', $sData);
        $sData = base64_decode($sData);
        for ($i = 0; $i < strlen($sData); $i++) {
            $sChar = substr($sData, $i, 1);
            //echo "$sChar\n";
            $sKeyChar = substr($secretKey, ($i % strlen($secretKey)) - 1, 1);
            //echo "$sKeyChar\n";
            $sChar = chr(ord($sChar) - ord($sKeyChar));
            //echo "$sChar\n";
            $sResult .= $sChar;
            //echo "$sResult\n";
        }
        //echo $sResult;
        return $sResult;
    }
}
if (!function_exists('special_encryption')) {
function special_encryption($sData)
{
    $sResult = '';
    $secretKey = "kYp3s5v8";
    for ($i = 0; $i < strlen($sData); $i++) {
        $sChar = substr($sData, $i, 1);
        $sKeyChar = substr($secretKey, ($i % strlen($secretKey)) - 1, 1);
        $sChar = chr(ord($sChar) + ord($sKeyChar));
        $sResult .= $sChar;
    }
    return str_replace('-', '878688', base64_encode($sResult));
}
}
if (!function_exists('curl_helper')) {
    function curl_helper($url, $header = array('content-type:application/json'), $content = '')
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 60);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        $response = curl_exec($curl);
        $error = curl_error($curl);
        $status = curl_getinfo($curl);
        curl_close($curl);
        return $response;
    }
}
if (!function_exists('curl_get_helper')) {
    function curl_get_helper($url, $header = array("cache-control: no-cache"))
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 60);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        $response = curl_exec($curl);
        return $response;
    }
}
if(!function_exists('get_dropdown')){
    function get_dropdown($code_id,$name,$selected_val=''){
         $arr = array();
         switch ($code_id){
            case is_numeric($code_id):
            $qry = "select id,value from crm_masters where crm_masters_code_id = ".$code_id." and is_active = 1";
            break;
            case "city":
                $qry = "select id,city_name from crm_master_city where is_active = 1";
            break;
            case "state":
                $qry = "select id,state_name from crm_master_state where is_active = 1";
            break;
            case "user":
                $qry = "select id,name from crm_master_user where is_active = 1";
            break;
            case "crm_master_city_sub_group":
                $qry = "select id,city_sub_group_name from crm_master_city_sub_group where is_active = 1";
            break;
         }
         echo $qry;
    }
}
// function get_dropdown($type, $name, $selected_val, $fun_call)
//     {
//         global $user_role, $tl_loan_type, $tl_member, $rm_banks, $bnk_rm_id_imp, $loan_type, $Conn1, $language_barrier_loan_type,$level_id;
//         $arr = array();
//         switch ($type) {
//             case "master":
//                 $qry = "select id,value from crm_masters where is_active = 1 and crm_masters_code_id = ".$selected_val." order by id";
//             case "occupation":
//                 $qry = "select occupation_id,occupation_name from lms_occupation order by occupation_name";
//                 break;
//             case "document_type": 
//                 $qry = "Select proof_id,proof_name From tbl_address_proof WHERE is_active_for_upload = 1 order by proof_name";
//                 break;
//             case "utm_group":
//                 $qry = "select * from utm_group where is_active =1 and parent_group_id IS NULL order by id";
//                 break;
//             case "purpose_of_loan":
//                 $qry = "SELECT id,description FROM `purpose_of_loan` where is_active = 1 order by description";
//                 break;
//             case "employer_type":
//                 $qry = "select 	category_id,category_name from lms_employer_category order by category_name";
//                 break;
// 			case "employer_type_report":
// 				$qry = "select category_id,category_name from lms_employer_category where category_id <> '56473' order by category_name";
// 				break;
//             case "city_name":
//                 $qry = "select city_id,city_name from lms_city where city_group_id = 1 order by city_name";
//                 break;
//             case "credit_card_list":
//                 $qry = "SELECT card_id,card_name FROM credit_cards_name where is_active =1";
//                 break;
//             case "irr_type":
//                 $qry = "select irr_id,irr_name from irr_type order by irr_id";
//                 break;
//             case "city":
//                 $qry = "select city_id,city_name from lms_city order by city_name";
//                 break;
//                  case "ni_user":
//             $qry = "SELECT user_id, user_name FROM tbl_user_assign WHERE (status = 1 OR date(user_login_datetime) >= DATE_SUB(CURDATE(), INTERVAL 7 DAY))";
//             $qry .= " ORDER BY user_name ";
//             if ($user_role == 2) {
//                 $arr = explode(',', $tl_member);
//             }
//             break;
//             case "mlc_product":
//                 $qry = "select product_id,product_name from tbl_mlc_products order by product_name";
//                 break;
//             case "loan_type":
//                 $qry = "select loan_type_id,loan_type_name from lms_loan_type where flag = 1 ";
//                 $qry .= " order by loan_type_name";
//                 if ($tl_loan_type != '' && $user_role != 3) {
//                     $arr = explode(',', $tl_loan_type);
//                 }
//                 break;
//             case "loan_type_":
//                 $qry = "select loan_type_id,loan_type_name from lms_loan_type where flag = 1 order by loan_type_name";
//                 break;
//             case "bank_name":
//                 $qry = "select bank_id,bank_name from tbl_bank where strip_flag = 1 order by bank_name";
//                 break;
//             case "bank_name_":
//                 $qry = "select bank_id,bank_name from tbl_bank where bank_id NOT IN (120) order by bank_name";
//                 break;
//             case "asset_type":
//                 $qry = "Select asset_id,asset_name from tbl_asset_type order by asset_name";
//                 break;
//             case "loan_nature":
//                 $qry = "Select loan_nature_id,loan_nature_name from tbl_loan_nature order by loan_nature_name";
//                 break;
//             case "annual_turnover":
//                 $qry = "Select bus_anl_id,bus_anl_name from tbl_bussiness_anl_trunover order by sort_order";
//                 break;
//             case "nature_of_business":
//                 $qry = "Select bus_nature_id,bus_nature_name from tbl_bussiness_nature where display_flag = 1";
//                 break;
//             case "business_existing":
//                 $qry = "Select bus_ext_year_id,bus_ext_year_name from tbl_bussiness_extng_year order by sort_order";
//                 break;
//             case "ITR_available":
//                 $qry = "Select bus_itr_aval_id,bus_itr_aval_name from tbl_bussiness_itr_aval order by sort_order";
//                 break;
//             case "type_of_registration":
//                 $qry = "Select bus_reg_type_id,bus_reg_type_name from tbl_bussiness_reg_type where display_flag = 1 order by sort_order";
//                 break;
//             case "security_available":
//                 $qry = "Select bus_security_id,bus_security_name from tbl_bussiness_security";
//                 break;
//             case "country_of_study":
//                 $qry = "Select loc_id,loc_name from edu_course_loc order by loc_name";
//                 break;
//             case "course_of_study":
//                 $qry = "Select course_id,course_name from edu_courses order by course_name ";
//                 break;
//             case "degree":
//                 $qry = "Select degree_id,degree from edu_degree order by degree ";
//                 break;
//             case "car":
//                 $qry = "select id,car_name from tbl_car order by car_name";
//                 break;
//             case "car_model":
//                 $qry = "select id,model_name from tbl_car_model order by model_name	";
//                 break;
//             case "car_plan":
//                 $qry = "Select id,when_plan from car_plan";
//                 break;
//             case "car_age":
//                 $qry = "Select id,age_car from car_age_filter";
//                 break;
//             case "team_leader":
//                 $qry = "Select user_id,user_name from tbl_user_assign where role_id IN (2,9) and status =1";
//                 break;
//             case "profession":
//                 $qry = "select profession_id,profession_name from lms_profession where disp_flag = 1 order by sort_order ";
//                 break;
//             case "follow_up_type":
//                 $qry = "select follow_id,follow_status from tbl_follow_status order by follow_status";
//                 break;
//             case "partner_list":
//                 $qry = "SELECT pat.partner_id as partner_id,pat.partner_name as partner_name FROM tbl_pat_loan_type_mapping as map join tbl_mlc_partner as pat on map.pat_id = pat.partner_id where map.disp_flag = 1 ";
//                 if ($tl_loan_type != '') {
//                     $qry .= " and map.loan_type IN (" . $tl_loan_type . ")";
//                 }
//                 if ($rm_banks != '' && $user_role == 6) {
//                     $qry .= " and map.pat_id IN (" . $rm_banks . ")";
//                 }
//                 $qry .= " group by map.pat_id order by pat.partner_name";
//                 break;
//             case "partner_list_":
//                 $qry = "SELECT pat.partner_id as partner_id,pat.partner_name as partner_name FROM tbl_pat_loan_type_mapping as map join tbl_mlc_partner as pat on map.pat_id = pat.partner_id where 1 ";
//                 if ($tl_loan_type != '') {
//                     $qry .= " and map.loan_type IN (" . $tl_loan_type . ")";
//                 }
//                 if ($rm_banks != '' && $user_role == 6) {
//                     $qry .= " and map.pat_id IN (" . $rm_banks . ")";
//                 }
//                 $qry .= " group by map.pat_id order by pat.partner_name";
//                 break;
//             case "acq_mode":
//                 $qry = "select acq_id,acq_name from tbl_acquistion_mode order by acq_name";
//                 break;
//             case "salary_paid_by_pl":
//                 $qry = "select bank_id,bank_name from tbl_bank where salary_flag <> 0 order by salary_flag";
//                 break;
//             case "case_status":
//                 $qry = "Select cse_status_id,case_status from tbl_case_status where is_active = 1";
//                 if (!in_array($user_role, array(1, 4)) && $_SESSION['ni_user'] == 0) {
//                     $qry .= " and cse_status_id NOT IN (11,12,13,14) ";
//                 }
//                 $qry .= " order by case_status";
//                 break;
//             case "app_property_status":
//                 $qry = "Select id,description from tbl_application_property_status where display_flag =1 order by description";
//                 break;
//             case "case_status_fup":
//                 $qry = "Select cse_status_id,case_status from tbl_case_status where cse_status_id <> 2 order by case_status";
//                 break;
//             case "prop_sale_type":
//                 $qry = "Select property_type_id,property_type_name from lms_property_type ";
//                 if (in_array($loan_type, array(54, 52))) {
//                     $qry .= " where property_type_id IN (1,3)";
//                 }
//                 $qry .= "order by sort_order";
//                 break;
//             case "prop_type":
//                 $qry = "Select prop_id,prop_type from tbl_property_type order by prop_type";
//                 break;
//             case "experience_with_MLC":
//                 $qry = "select id,issue_face from tbl_feed_back_issue where flag = 1";
//                 break;
//             case "experience_with_banker":
//                 $qry = "select id,issue_face from tbl_feed_back_issue where flag = 2";
//                 break;
//             case "budget":
//                 $qry = "Select slab_id,budget_slab from lms_property_budget_slab";
//                 break;
//             case "prop_location":
//                 $qry = "Select loc_id,loc_type from lms_property_location where loc_id < 3";
//                 break;
//             case "property_size":
//                 $qry = "Select prop_size_id,prop_size_name from lms_property_size";
//                 break;
//             case "state":
//                 $qry = "Select state_id,state_name from ifsc_state order by state_name";
//                 break;
//             case "status_":
//                 $qry = "select status_id,description from status_master where parent_id=0 and level_id =".$level_id." and (FIND_IN_SET('" . $loan_type . "',required_for_loan_type) or required_for_loan_type ='0') and is_active = 1 ";
//                      if (!in_array($user_role, array(1, 4,5))) {
//                     $qry .= " and status_id NOT IN (2) ";
//                 } 
//                 $qry .= " order by sort_order";
//             break;
//             case "query_status":
//                 $qry = "Select qy_status_id,qy_status from tbl_query_status where display_flag = 1";
//                 if (!in_array($user_role, array(1, 4, 2, 5)) && $_SESSION['ni_user'] == 0) {
//                     $qry .= " and qy_status_id NOT IN (7,8,9,10,24,25,26,27,2) ";
//                 } else if (!in_array($user_role, array(1, 4, 2, 5)) && $_SESSION['ni_user'] == 1) {
//                     $qry .= " and qy_status_id NOT IN (2) ";
//                 }
//                 $qry .= " order by sort_order";
//                 break;
//             case "query_status_all":
//                 $qry = "Select qy_status_id,qy_status from tbl_query_status where display_flag = 1 ";
//                 if (!in_array($user_role, array(1, 4)) && $_SESSION['ni_user'] == 0) {
//                     $qry .= " and qy_status_id NOT IN (24,25,26,27,2) ";
//                 } else if (!in_array($user_role, array(1, 4)) && $_SESSION['ni_user'] == 1) {
//                     $qry .= " and qy_status_id NOT IN (2) ";
//                 }
//                 $qry .= " order by sort_order";
//                 break;
//             case "salary_method":
//                 $qry = "Select paid_id,paid_type from tbl_salary_py_method";
//                 break;
//             case "salutation":
//                 $qry = "select salutn_id,salutn_name from tbl_saluation";
//                 break;
//             case "mlc_product":
//                 $qry = "select product_id,product_name from tbl_mlc_products order by product_id";
//                 break;
//             case "residential_type":
//                 $qry = "select rented_id,residential_name from tbl_residential_type";
//                 break;
//             case "tool_type":
//                 $qry = "select tool_type_name from lms_tool_type order by tool_type_name";
//                 break;
//             case "business_type":
//                 $qry = "select bus_type_id,bus_type_name from  tbl_bussiness_type where display_flag =1 order by sort_order";
//                 break;
//             case "user_assign":
//                 $qry = "select user_id,user_name from tbl_user_assign where (status=1 OR date(user_login_datetime) >= DATE_SUB(CURDATE(), INTERVAL 7 DAY))";
//                 /* if($user_role == 2){
//                 $qry .= " and user_id IN ($tl_member)";
//                 } */
//                 $qry .= "order by user_name";
//                 if ($user_role == 2) {
//                     $arr = explode(',', $tl_member);
//                 } 
//                 break;
//             case "u_assign":
//                 $qry = "select user_id,user_name from tbl_user_assign where status=1";
//                 $qry .= " order by user_name";
//                 break;
//             case "user_lead_assign":
//                 $qry = "select user_id,user_name from tbl_user_assign where (status=1 OR date(user_login_datetime) >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)) order by user_name";
//                 break;
//             case "primary_user":
//                 $qry = "select user_id, user_name from tbl_user_assign where (status=1 OR date(user_login_datetime) >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)) and role_id='3' order by user_name";
//                 break;
//             case "feedback_follow_up":
//                 $qry = "select id,follow_up_name from tbl_feedback_followup";
//                 break;
//             case "secondry_user":
//                 $qry = "select user_id, user_name from tbl_user_assign where (status=1 OR date(user_login_datetime) >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)) and role_id != '1' order by user_name";
//                 break;
//             case "army":
//                 $qry = "select army_type_id,army_type_name from tbl_emp_army_type order by army_type_name";
//                 break;
//             case "pre_login":
//                 $qry = "select pre_status_id,pre_status_name from tbl_app_pre_login order by sort_order";
//                 break;
//             case "post_login":
//                 $qry = "select app_status_id,app_status from tbl_app_status where display_flag =1 order by sort_order";
//                 break;
//             case "app_pat_list":
//                 $qry = "select partner_id,partner_name from tbl_mlc_partner where app_flag = 1";
//                 break;
//             case "rate_type":
//                 $qry = "Select rate_character_id,rate_character_name from tbl_rate_character where is_active=1";
//                 break;
//             case "type_of_company":
//                 $qry = "Select cat_id,cat_name from tbl_company_categorization order by cat_name";
//                 break;
//             case "city_sub_group":
//                 $qry = "select city_sub_group_id,city_sub_group_name from lms_city_sub_group order by city_sub_group_name";
//                 break;
//             case "industry":
//                 $qry = "select 	industry_id,industry_name from tbl_industry_type order by industry_name";
//                 break;
//             case "swipe_machine_period":
//                 $qry = "select id,type_name from swipe_machine_period";
//                 break;

//             case "swipe_avg_transaction":
//                 $qry = "select id,type_name from swipe_avg_transaction";
//                 break;
//             case "bil_type":
//                 $qry = "select id, bil_type from tbl_bil_type order by bil_type";
//                 break;
//             case "qualification_credit":
//                 $qry = "Select id,qualification from tbl_credit_qualification order by qualification";
//                 break;
//             case "designation":
//                 $qry = "select id,designation_name from tbl_credit_designation";
//                 break;
//             case "educational_degree":
//                 $qry = "select id,degree_name from tbl_dl_educational_degree WHERE status = 1 order by id";
//                 break;
//             case "degree_specialization":
//                 $qry = "select id,specialization from tbl_dl_degree_specialization order by specialization";
//                 break;
//             case "sms_camp":
//                 $qry = "select temp_id, temp_name from tbl_campaign_templates order by temp_id desc";
//                 break;
//             case "gold_type":
//                 $qry = "select id, gold_type from tbl_gold_type_dropdown order by id";
//                 break;
//             case "cc_since":
//                 $qry = "select id, holding_since from tbl_credit_card_holding_since order by id";
//                 break;
//             case "km_loan_type":
//                 $qry = "select id, loan_type_url from km_url where parent_id = 0";
//                 break;
//             case "fos_users":
//                 $qry = "select user_id, user_name from tbl_user_assign where is_fos = 1 and status='1' ";
//                 break;
//             case "caste_type":
//                 $qry = "select id, name from lms_caste";
//                 break;
//             case "religion":
//                 $qry = "select id, name from religion";
//                 break;
//             case "voucher_vendor":
//                 $qry = "SELECT id, name FROM voucher_vendor";
//                 break;
//             case "voucher_type":
//                 $qry = "SELECT id, name FROM voucher_type";
//                 break;
//             case "constitution":
//                 $qry = "select id, name from lms_constitution";
//                 break;
//             case "banks_type":
//                 $qry = "select bank_id, bank_name from tbl_bank where (bank_type_id IN (1,2,4) and bank_id NOT IN (146,124,71,37,41,57,33,56)) OR bank_id IN (78,124) order by salary_flag DESC,bank_name ASC";
//                 break;
//             case "banks_type_other":
//                 $qry = "select bank_id, bank_name from tbl_bank where (bank_type_id IN (1,2,4) and bank_id NOT IN (146,124,71,37,41,57,33,56)) OR bank_id IN (78) order by salary_flag DESC,bank_name ASC";
//                 break;
//             case "bank_account_type":
//                 $qry = "select account_type_id, account_type_name from tbl_bank_account_type order by sort_order";
//                 break;
//             case "industry_bl":
//                 $qry = "select 	industry_id,industry_name from tbl_bl_industry_type order by industry_name";
//                 break;
//             case "languages":
//                 $qry = "SELECT id, name, status FROM tbl_language WHERE status = 1 ORDER BY id";
//                 break;
//             case "case_user":
//                 $qry = "select user_id,user_name from tbl_user_assign where (status=1 OR date(user_login_datetime) >= DATE_SUB(CURDATE(), INTERVAL 7 DAY))";
//                 $qry .= "order by user_name";
//                 if ($user_role == 2) {
//                     $arr = explode(',', $tl_member);
//                 }
//                 break;
//             case "app_user":
//                 $qry = "select user_id,user_name from tbl_user_assign where (status=1 OR date(user_login_datetime) >= DATE_SUB(CURDATE(), INTERVAL 7 DAY))";
//                 $qry .= "order by user_name";
//                 if ($user_role == 2) {
//                     $arr = explode(',', $tl_member);
//                 }
//                 break;
//             case "query_new_status":
//                 $qry = "SELECT status_id, description FROM status_master WHERE level_id = 1 AND parent_id = 0 AND is_active_for_filter = 1";
//                 if (!in_array($user_role, array(1, 4,5))) {
//                     $qry .= " and status_id NOT IN (2) ";
//                 } 
//                 $qry .= " ORDER BY sort_order";
//                 break;
//             case "case_new_status":
//                 $qry = "SELECT status_id, description FROM status_master WHERE level_id = 2 AND parent_id = 0 AND is_active_for_filter = 1";
//                  if (!in_array($user_role, array(1, 4,5))) {
//                     $qry .= " and status_id NOT IN (2) ";
//                 } 
//                 $qry .= " ORDER BY sort_order";
//                 break;
//             case "app_new_status":
//                 $qry = "SELECT status_id, description FROM status_master WHERE level_id = 3 AND parent_id = 0 AND is_active_for_filter = 1 ORDER BY sort_order";
//                 break;
//                 case "pre_app_new_status":
//                 $qry = "SELECT status_id, description FROM status_master WHERE level_id = 3 AND parent_id = 0 AND is_active_for_filter = 1 and status_id IN (1011,1012,1013,1014,1015)  ORDER BY sort_order";
//                 break;
//             case "refarming_user":
//                 $qry = "SELECT user_id, user_name FROM tbl_user_assign WHERE (status = 1 OR date(user_login_datetime) >= DATE_SUB(CURDATE(), INTERVAL 7 DAY))";
//                 $qry .= " ORDER BY user_name";
//                 if ($user_role == 2) {
//                     $arr = explode(',', $tl_member);
//                 }
//                 break;
//             case "fos_case_status":
//                 $qry = "SELECT status_id, description FROM status_master WHERE level_id = 2 AND parent_id = 0 AND is_active_for_filter = 1 AND is_fos = 1 ";
//                  if (!in_array($user_role, array(1, 4,5))) {
//                     $qry .= " AND status_id NOT IN (2) ";
//                 } 
//                 $qry .= " ORDER BY sort_order";
//                 break;
//             case "property_approved_from":
//                 $qry = "SELECT id, construction_type FROM tbl_construction_type WHERE is_active = '1' ORDER BY id";
//                 break;
//             case "company_categories":
//                 $qry = "SELECT id, description FROM tbl_company_categories WHERE is_active = 1 ORDER BY sort_order";
//                 break;
//             case "sub_utm_group":
//                 $qry = "SELECT id, value FROM utm_group WHERE is_active = 1 AND parent_group_id > 0";
//                 break;
// 			case "tag_group":
//                 $qry = "SELECT id, tag_group FROM master_tag_group WHERE is_active = 1 ";
//                 break;
//             case "utm_group":
//                 $qry = "SELECT id, value FROM utm_group WHERE is_active = 1 AND parent_group_id IS NULL";
//                 break;
//             case "support_desk_status":
//                 $qry = "SELECT id, status FROM tbl_support_desk_status WHERE display_flag = 1";
//                 break;
//             case "account_balance": 
//                 $qry = "SELECT id, monthly_balance FROM tbl_account_balance WHERE is_active = 1";
//                 break;
//             case "cust_bank_account_type": 
//                 $qry = "SELECT account_type_id, account_type_name FROM tbl_bank_account_type WHERE display_flag = 1 ORDER BY sort_order";
//                 break;
//         }
//         $result_row = mysqli_query($Conn1, $qry);
//         while ($result_rw = mysqli_fetch_array($result_row)) {
//             $get_row[$result_rw[0]] = $result_rw[1];
//         }
//         if ($fun_call != '') {
//             $clk_function = $fun_call;
//         } else {
//             $clk_function = '';
//         }

//         $finl_type = $type;

//         $option = array();
//         if ($type == 'salary_paid_by_pl') {
//             $finl_type = 'Salary Paid By';
//             $option[] = "<option value='2'>Cheque</option><option value='3'>Cash</option>";
//         }

//         if ($type == 'cc_since') {
//             $finl_type = 'Holding Credit Card Since';
//         }
//         if($type == 'banks_type'){
//             $finl_type = 'Bank';
//         } 
//         echo "<select name = '" . $name . "' id = '" . $name . "' " . $clk_function . "><option value=''>Select " . ucwords(str_replace('_', ' ', $finl_type)) . "</option>";
//         echo implode($option);
//         foreach ($get_row as $row_id => $row_name) {
//             if (in_array($row_id, explode(',', $selected_val))) {
//                 $sele = 'selected';
//             } else {
//                 $sele = '';
//             }
//             $s = 0;
//             if (!empty(array_filter($arr))) {
//                 if (!in_array($row_id, $arr)) {
//                     if ($type != 'query_status') {
//                         $s = 1;
//                     }
//                 }
//             }
//             if ($type == 'query_status' && $row_id == 2 && $user_role == 3) {
//                 $s = 1;
//             }
//             if ($s == 0) {
//                 if ($type != 'tool_type') {
//                     echo $option_final = "<option value='" . $row_id. "' data-target='" . $row_name . "'  " . $sele . ">" . ucwords(strtolower($row_name)) . "</option>";
//                 } else {
//                     echo $option_final = "<option value='" . $row_id . "' " . $sele . ">" . $row_id . "</option>";
//                 }
//             }
//         }
//         if ($selected_val == 'other') {
//             $sele_oth = 'selected';
//         } else {
//             $sele_oth = '';
//         }

//         if ($type == 'city_name' || $type == 'bank_name' || $type == 'salary_paid_by_pl') {
//             echo "<option value='other' " . $sele_oth . ">Others</option>";
//         }
//         echo "</select>";
//     }

    function get_radio_options_form($type, $name, $checked_val, $fun_call)
    {
        $bt_flg = 3;
        global $user_role, $tl_loan_type, $tl_member, $rm_banks, $bnk_rm_id_imp, $Conn1;
        $arr = array();
        switch ($type) {
            case "occupation":
                $qry = "select occupation_id,occupation_name from lms_occupation order by sort_order";
                break;
            case "entity_type":
                $qry = "select entity_id,entity_name from tbl_entity_type";
                break;
            case "salutation":
                $qry = "select salutn_id,salutn_name from tbl_saluation";
                break;
            case "salary_method":
                $qry = "Select paid_id,paid_type from tbl_salary_py_method";
                break;
            case "principle_business":
                $qry = "Select id,business_name from tbl_ifa_principle_business";
                break;
            case "loan_nature":
                $qry = "Select loan_nature_id,loan_nature_name from tbl_loan_nature";
                if ($bt_flg != 3) {
                    $qry .= " where loan_nature_id != 3";
                }
                break;
        }
        $result_qry = mysqli_query($Conn1, $qry);
        while ($row = mysqli_fetch_row($result_qry)) {
            if ($row[0] == $checked_val) {
                $sele = 'checked';
            } else {
                $sele = '';
            }
            if ($fun_call != '') {
                $clk_function = $fun_call;
            } else {
                $clk_function = '';
            }
            if ($type != 'principle_business' && $type != 'entity_type') {
                echo "<input type='radio' name='" . $name . "' " . $clk_function . " class='" . $type . $row[0] . "' id= '" . $name . $row[0] . "' value='" . $row[0] . "' " . $sele . ">
    <label class='" . $type . $row[0] . "' for='" . $name . $row[0] . "'> " . $row[1] . "</label>";
            } else {
                echo "<input type='radio' name='" . $name . "' " . $clk_function . " id= '" . $name . "' value='" . $row[0] . "' " . $sele . ">&nbsp;" . $row[1] . "&nbsp;";
            }
        }
    }

if (!function_exists('get_textbox')) {
	function get_textbox($name, $selected_val, $fun_call){
		echo "<input type= 'text' name ='" . $name . "' id ='" . $name . "' value='" . $selected_val . "' " . $fun_call . ">";
	}
}     

if (!function_exists('get_cityname')) {
	function get_cityname($value_fetch, $where=array()){
		$qry_return = "SELECT ".$value_fetch." from lms_city ";
		if(!empty($where)){
			$qry_return .=  " WHERE ".implode(' AND ', $where);
		}
		return $qry_return;
	}
} 
if (!function_exists('get_productname')) {
	function get_productname($value_fetch, $where=array()){
		$qry_return = "SELECT ".$value_fetch." from master_product ";
		if(!empty($where)){
			$qry_return .=  " WHERE ".implode(' AND ', $where);
		}
		return $qry_return;
	}
}  
if (!function_exists('get_planname')) {
	function get_planname($value_fetch, $where=array()){
		$qry_return = "SELECT ".$value_fetch." from master_plan ";
		if(!empty($where)){
			$qry_return .=  " WHERE ".implode(' AND ', $where);
		}
		return $qry_return;
	}
}  
if (!function_exists('get_query_status')) {
	function get_query_status($value_fetch, $where=array()){
		$qry_return = "SELECT ".$value_fetch." from status_master ";
		if(!empty($where)){
			$qry_return .=  " WHERE ".implode(' AND ', $where);
		}
		return $qry_return;
	}
}  

if (!function_exists('get_username')) {
	function get_username($value_fetch, $where=array()){
		$qry_return = "SELECT ".$value_fetch." from tbl_user_assign ";
		if(!empty($where)){
			$qry_return .=  " WHERE ".implode(' AND ', $where);
		}
		return $qry_return;
	}
}
if (!function_exists('get_sourcename')) {
	function get_sourcename($value_fetch, $where=array()){
		$qry_return = "SELECT ".$value_fetch." from master_source ";
		if(!empty($where)){
			$qry_return .=  " WHERE ".implode(' AND ', $where);
		}
		return $qry_return;
	}
} 

if(!function_exists("search_city_pincode")){
    function search_city_pincode($pincode){
        global $db_handle, $Conn1;
        if ($pincode) {
            $get_city_id = "select city_id,city_name from lms_city where city_pincode_min_value <= '" . $pincode . "' and city_pincode_max_value >= '" . $pincode . "' limit 1";
            $result_city_id = $db_handle->runQuery($get_city_id);
                $city_id = $result_city_id[0]['city_id'];
                $city_name = $result_city_id[0]['city_name'];
            if ($city_id != '' && $city_id != '0') {
                $city_id = $city_id;
                $city_name = $city_name;
            } else {
                $city_id = '26';
                $city_name = 'Others';
            }
            $pincode_val = $pincode;
        } else if (preg_match('/^[a-zA-Z0-9]/', $pincode)) {
            $qry = "SELECT city_id,main_city_id,city_name FROM lms_city WHERE city_name = '" . $pincode . "'";
            $result_qry = $db_handle->runQuery($qry);
            $main_city_id = $result_qry[0]['main_city_id'];
            $city_name = $result_qry[0]['city_name'];
            if ($main_city_id > 0 && is_numeric($main_city_id)) {
                $city_id_oth = $main_city_id;
            } else {
                $city_id_oth = $result_qry[0]['city_id'];
            }
            if ($city_id_oth != '' && $city_id_oth != '0') {
                $city_id = $city_id_oth;
            } else {
                $city_id = '26';
            }
            $pincode_val = 0;
        }
        return array("final_ctiy_id"=>$city_id,"final_ctiy_name"=>$city_name,"final_pincode_val"=>$pincode_val);
    }
}

if(!function_exists('mobile_hide')){
    function mobile_hide($mobile){
        $show_number_flag_sess = $_SESSION['userDetails']['show_number_flag'];
        if($show_number_flag_sess == 1){
            $phone_no_up = $mobile;
        } else if($show_number_flag_sess == 2){
            $phone_no_up = substr_replace($mobile, 'XXXX', 3, 4);
        }else if($show_number_flag_sess == 3){
            $phone_no_up = substr_replace($mobile, 'XXXXXXXXXX', 0,10);
        }
        return $phone_no_up;
    }
}
if(!function_exists('oneLead')){
    function oneLead() {
        global $db_handle;
       $data = $db_handle->runQuery("SELECT query_id,'1' as priority from query_details where assign_user = ".$_SESSION['userDetails']['user_id']." and follow_up_date_time BETWEEN DATE_SUB(NOW(),INTERVAL 45 MINUTE) and DATE_ADD(NOW(),INTERVAL 15 MINUTE) ORDER BY follow_up_date_time LIMIT 1");
       if(empty($data)){
        $data = $db_handle->runQuery("SELECT query_id,'2' as priority from query_details where assign_user = ".$_SESSION['userDetails']['user_id']." and query_status = 4 ORDER BY query_id LIMIT 1");
       }
       if(empty($data)){
        $data = $db_handle->runQuery("SELECT query_id,'3' as priority from query_details where assign_user = ".$_SESSION['userDetails']['user_id']." and follow_up_date_time < DATE_SUB(NOW(),INTERVAL 45 MINUTE) ORDER BY follow_up_date_time DESC LIMIT 1");
       }
       if(empty($data)){
        $data = $db_handle->runQuery("SELECT query_id,'4' as priority from query_details where assign_user = ".$_SESSION['userDetails']['user_id']." and follow_up_date_time > DATE_SUB(NOW(),INTERVAL 15 MINUTE) ORDER BY follow_up_date_time ASC LIMIT 1");
       }
       if(!empty($data)){
        return $data;
       }
    }
}
?>