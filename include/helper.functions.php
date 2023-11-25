<?php
define("current_date_time", date('d-m-Y H:i'));
define("current_day", date('l'));
define("start_working_hrs", date('d-m-Y 09:30'));
define("end_working_hours", date('d-m-Y 18:00'));
define("SECRET_KEY", "kYp3s5v8");
if (!defined('Notification_Access_Key')) {
    define('Notification_Access_Key', 'AIzaSyAX5SuwQZriJ3Yi7RhYnRkMkcSvctqm3YE');
}
if (!defined('Partner_APP_Notification_Access_Key')) {
    define('Partner_APP_Notification_Access_Key', 'AAAA2_De9QA:APA91bEKS38xWcqnmNUHAvPTq3_FGsFXF_-430E0BqvsbFSnaK6gxONxdE-Rh_cmTNCZHow_TqQQBNhfznuT_XRd6ofTdR0skes01hPsS6O0OF0YjqbY5dGK-H7o3tOYsyavIktlrCvC');
}
if (php_sapi_name() != 'cli' && $cron_file == 1) {
    header("Location:" . $head_url);
    die();
    exit;
}
setlocale(LC_MONETARY, "en_IN");
if (!function_exists('custom_money_format')) {
    //function custom_money_format($amount, $type = 1)
    // {
    //         if ($type == 1) {
    //             return money_format('%.0n', $amount);
    //         } else {
    //             return money_format('%i', $amount);
    //         }
    // }
    if (!function_exists('check_company_category')) {
        function check_company_category($val)
        {
            global $Conn1;
            $category_id = 0;
            $query = mysqli_query($Conn1, "select * from tbl_company_categories where find_in_set('" . $val . "',description)");
            if (mysqli_num_rows($query) > 0) {
                $result = mysqli_fetch_assoc($query);
                $category_id = $result['id'];
            }
            return $category_id;
        }
    }
    if (!function_exists('before_api_call')) {
        function before_api_call($connection,$request,$client_name='',$api_key='',$url='',$apiType='')
        {
            $query = mysqli_query($connection, "INSERT INTO api_log set api_type='".$apiType."',request='".$request."',client_name='".$client_name."',api_key='".$api_key."',url='".$url."'");
            $last_insert_id = mysqli_insert_id($connection);
            return $last_insert_id;
        }
    }
    if (!function_exists('after_api_call')) {
        function after_api_call($connection,$last_insert_id,$response)
        {
            $query = mysqli_query($connection, "UPDATE api_log set response='".$response."' where id = ".$last_insert_id);
        }
    }
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
if (!function_exists('get_status_id')) {
    function get_status_id($parent_id_array = array(), $fnc = 0)
    {
        if (!empty($parent_id_array)) {
            global $Conn1;
            $qry_to_exec = "SELECT GROUP_CONCAT(CONCAT_WS(',',smid.status_id,mid.status_id,mid.parent_id) SEPARATOR ',') as status_id_array FROM status_master as mid LEFT JOIN status_master as smid ON mid.status_id = smid.parent_id LEFT JOIN status_master as ssmid ON smid.status_id = ssmid.parent_id WHERE mid.parent_id IN (" . implode(',', $parent_id_array) . ")";
            $qry = mysqli_query($Conn1, $qry_to_exec);
            $result_array = mysqli_fetch_assoc($qry);
            $return_array_val = explode(',', $result_array['status_id_array']);
            if ($fnc == 1) {
                $return_array_val = array_diff($return_array_val, array(1113, 1123));
            }
            return array_filter(array_unique($return_array_val));
        }
    }
}
if (!function_exists('getTagName')) {
    function getTagName($parent_id_array = array())
    {
        $return_array_val = array();
        if (!empty($parent_id_array)) {
            global $Conn1;
            $qry_to_exec = "select tag_id from tag_group_mapping where tag_group_id IN (" . implode(',', $parent_id_array) . ") and flag = 1 and tag_id_type=2";
            $qry = mysqli_query($Conn1, $qry_to_exec);
            while ($result_array = mysqli_fetch_assoc($qry)) {
                $return_array_val[] = $result_array['tag_id'];
            }
        }
        return array_filter(array_unique($return_array_val));
    }
}
function autoCaseFUP($loan_type, $loan_amount = "0")
{
    if (!in_array($loan_type, array('51', '54', '71'))) {
        if (strtotime(start_working_hrs) <= strtotime(current_date_time) && strtotime(end_working_hours) >= strtotime(current_date_time)) {
            $follow_up_date = date('Y-m-d');
            $follow_up_time = date('H:i', strtotime('+15 minute'));
        } else {
            $follow_up_date = date('Y-m-d', strtotime('+1 day'));
            $follow_up_time = '11:00:00';
        }
    } else if (in_array($loan_type, array('51', '52', '54'))) {
        if ($loan_amount > 2500000) {
            if (strtotime(start_working_hrs) <= strtotime(current_date_time) && strtotime(end_working_hours) >= strtotime(current_date_time)) {
                $follow_up_date = date('Y-m-d');
                $follow_up_time = date('H:i', strtotime('+15 minute'));
            } else {
                $follow_up_date = date('Y-m-d', strtotime('+1 day'));
                $follow_up_time = '11:00:00';
            }
        } else {
            if (current_day == 'Sunday') {
                $follow_up_date = date('Y-m-d', strtotime('+2 day'));
            } else if (current_day == 'Saturday') {
                if (strtotime(start_working_hrs) <= strtotime(current_date_time) && strtotime(end_working_hours) >= strtotime(current_date_time)) {
                    $follow_up_date = date('Y-m-d', strtotime('+2 day'));
                } else {
                    $follow_up_date = date('Y-m-d', strtotime('+3 day'));
                }
            } else {
                if (strtotime(start_working_hrs) <= strtotime(current_date_time) && strtotime(end_working_hours) >= strtotime(current_date_time)) {
                    $follow_up_date = date('Y-m-d', strtotime('+1 day'));
                } else {
                    $follow_up_date = date('Y-m-d', strtotime('+2 day'));
                }
            }
            $follow_up_time = '15:00:00';
        }
    } else if (in_array($loan_type, array('71'))) {
        if (current_day == 'Sunday') {
            $follow_up_date = date('Y-m-d', strtotime('+2 day'));
        } else if (current_day == 'Saturday') {
            if (strtotime(start_working_hrs) <= strtotime(current_date_time) && strtotime(end_working_hours) >= strtotime(current_date_time)) {
                $follow_up_date = date('Y-m-d', strtotime('+2 day'));
            } else {
                $follow_up_date = date('Y-m-d', strtotime('+3 day'));
            }
        } else {
            if (strtotime(start_working_hrs) <= strtotime(current_date_time) && strtotime(end_working_hours) >= strtotime(current_date_time)) {
                $follow_up_date = date('Y-m-d', strtotime('+1 day'));
            } else {
                $follow_up_date = date('Y-m-d', strtotime('+2 day'));
            }
        }
        $follow_up_time = '15:00:00';
    }
    return array('case_status' => '1', 'fup_date' => $follow_up_date, 'fup_time' => $follow_up_time);
}
function dateDiff($date1, $date2)
{
    $d1 = new DateTime($date1);
    echo $d2 = new DateTime($date2);
    echo $interval = $d2->diff($d1);
    return $interval->format('%m months');
}
function common_call_btn($user, $Conn1, $phone, $p_status = 0, $p_id, $ver_phone = 1, $level_type, $mobile_status = 0, $tool_type_filter = 0, $loanname = '', $loantype_id = '')
{
    global $lead_view_id; ?>
    <script>
        var is_new_dialer_flag = <?php echo $_SESSION['is_new_dialer']; ?>;
        console.log(is_new_dialer_flag);
        function openWin(link) {
            mynWindow = window.open('http://192.168.1.3/km/Dialer_sms/index.php?id=<?php echo base64_encode($_SESSION['user_id']); ?>&loginID=<?php echo base64_encode($_SESSION['loginID']); ?>&port=<?php echo base64_encode($_SESSION['port_id']); ?>&gateway=<?php echo base64_encode($_SESSION['gateway_id']); ?>&extension=<?php echo base64_encode($_SESSION['dialer_link']); ?>', 'mynWindow', 'width=1,height=1');
            setInterval(function() {
                mynWindow.close();
            }, 2000);

            if (is_new_dialer_flag == 1) {
                myWindow = window.open('http://192.168.1.11/clickcall/call.php?' + link, 'myWindow', 'width=10,height=10');
            } else {
                myWindow = window.open('http://192.168.1.100/click&call/call/' + link, 'myWindow', 'width=10,height=10');
            }
            setInterval(function() {
                myWindow.close();
            }, 5000);
        }
        var count = 2000;
        function call(link, querystatus, queryid, clickbtn, level_type, phone) {
            count++;
            var lead_view_id = $('#lead_view_id').val();
            var today = new Date();
            var date = today.getFullYear() + '' + (today.getMonth() + 1) + '' + today.getDate();
            var time = today.getHours() + "" + today.getMinutes() + "" + today.getSeconds();
            var dateTime = date + '' + time;
            var dialer_uniq_id = "<?php echo $user . "_"; ?>" + dateTime + "_" + queryid + "_" + count;
            $.ajax({
                data: 'dialer_uniq_id=' + dialer_uniq_id + '&lead_view_id=' + lead_view_id + '&querystatus=' + querystatus + '&queryid=' + queryid + '&clickbtn=' + clickbtn + '&leveltype=' + level_type + '&phone=' + phone,
                type: 'POST',
                url: '../insert/insert_onclick_button.php',
                success: function(data) {
                    if (data > 0) {
                        $('#click_to_call_id,.click_to_call_id').val(data);
                        $('input[name="click_to_call_id"]').val(data);
                        if (is_new_dialer_flag == 1) {
                            if (clickbtn == 'call1') {
                                openWin("exten=<?php echo $_SESSION['dialer_link']; ?>&mobile=" + btoa(phone) + "&ID=" + dialer_uniq_id + "&AGENTID=<?php echo $_SESSION['user_id']; ?>&LEVELTYPE=" + level_type + "&LEVELID=" + queryid + "&CALLTYPE=1&CLICKDATE=<?php echo strtotime(date('d-m-Y H:i:s')); ?>&AGENTNAME=<?php echo base64_encode($_SESSION['mlcuser_name']); ?>&LOANTYPE=<?php echo base64_encode($loanname); ?>&LOANID=<?php echo $loantype_id; ?>");
                            } else {
                                openWin("exten=<?php echo $_SESSION['dialer_link']; ?>&mobile=" + btoa("4" + phone) + "&ID=" + dialer_uniq_id + "&AGENTID=" + <?php echo $_SESSION['user_id']; ?> + "&LEVELTYPE=" + level_type + "&LEVELID=" + queryid + "&CALLTYPE=2&CLICKDATE=<?php echo strtotime(date('d-m-Y H:i:s')); ?>&AGENTNAME=<?php echo base64_encode($_SESSION['mlcuser_name']); ?>&LOANTYPE=<?php echo base64_encode($loanname); ?>&LOANID=<?php echo $loantype_id; ?>");
                            }
                        } else {
                            openWin(link);
                        }
                    }
                }
            })
        }
    </script>
<?php
    $btns = '';
    $btns1 = '';
    $btns2 = '';
    $call2 = 'call2';
    $call1 = 'call1';
    if ($_SESSION['dialer_link'] != '' && $mobile_status == 0) {
        $sql_port = "SELECT gateway.gateway_name as gateway_name FROM tbl_user_assign as u_assign JOIN dialer_gateway_mapping as gateway ON u_assign.gateway_id = gateway.gateway_id where u_assign.user_id = '" . $user . "'";
        $res_port = mysqli_query($Conn1, $sql_port);
        $result = mysqli_fetch_array($res_port);
        $gateway_name = $result['gateway_name'];
        $dialer_link1 = $gateway_name . "/" . $_SESSION['dialer_link'] . "/" . base64_encode($phone);
        $dialer_link2 = "gateway/" . $_SESSION['dialer_link'] . "/" . base64_encode('4' . $phone);
        $btns1 = '<input type="button" style="float:right;background: #1b8c1b; position: relative; z-index: 15;" class="buttonsub cursor" value="&#128222; Call2" onclick="call(\'' . $dialer_link2 . '\', \'' . $p_status . '\',\'' . $p_id . '\',\'' . $call2 . '\',\'' . $level_type . '\',\'' . $phone . '\');">';
        if ($ver_phone == 1 && $tool_type_filter == 0) {
            $btns2 = '<input type="button" style="float:right;background: #1b8c1b; position: relative; z-index: 15;" class="buttonsub cursor" value="&#128222; Call" onclick="call(\'' . $dialer_link1 . '\', \'' . $p_status . '\',\'' . $p_id . '\',\'' . $call1 . '\',\'' . $level_type . '\',\'' . $phone . '\');">';
        }
        $btns = $btns1 . $btns2;
    } else {
        if ($mobile_status == 1) {
            $btns = "<div style='float:right;background: red;color: white;padding: 5px;'>Customer is blocked for call. Please Don't Call this customer</div>";
        } else {
            $btns = "<div style='float:right;background: #1b8c1b;padding: 5px;'>You are not assigned with Dialer Extension. Please contact your TL</div>";
        }
    }
    return $btns;
}
class execution
{
    protected $Connection;

    public function __construct()
    {
        global $Conn1;
        $this->Connection = $Conn1;
    }
    public function selectQueryExecute($query_to_return)
    {
        $qry_execute = mysqli_query($this->Connection, $query_to_return);
        if (mysqli_num_rows($qry_execute) > 0) {
            $result = mysqli_fetch_assoc($qry_execute);
        } else {
            $result = 0;
        }
        return $result;
    }
    public function insertQueryExecute($query_to_return)
    {
        //echo $query_to_return;
        $qry_execute = mysqli_query($this->Connection, $query_to_return);
    }
}
class assignment extends execution
{
    function checkDuplicate($data)
    {
        $query = "select (CASE WHEN COUNT(*) > 1027 THEN 1 ELSE 11 END) AS total from tbl_mint_query as qry inner join tbl_mint_query_status_detail as stats
		 on qry.query_id = stats.query_id where qry.loan_type = " . $data['loanType'] . " and stats.query_status NOT IN (1,2) and qry.cust_id = " . $data['custId'] . " and stats.date = CURDATE()
		 order by qry.query_id desc";
        return $this->selectQueryExecute($query);
    }
    function leadAssignment($lead_assign_to, $data)
    {
        $query = "select user.assign_id,user.user_id from tbl_assign_lead_filter as filter
		inner join tbl_assign_user_query_filter as user on filter.filter_id = user.filter_id where filter.city_sub_group_id = " . $data['city_sub_group'] . "
		and find_in_set( " . $lead_assign_to . ",filter.loan_type) > 0 and user.user_id != 0 and user.avail_flag = 1 and user.shift_flag = filter.shift_flag";
        if ($data['loan_amount'] > 0) {
            $query .= " and filter.min_loan_amt <=  " . $data['loan_amount'] . " and filter.max_loan_amt >=  " . $data['loan_amount'];
        }
        if ($data['net_incm'] > 0) {
            $query .= " and filter.min_salary <=  " . $data['net_incm'] . " and filter.max_salary >=  " . $data['net_incm'];
        }
        $query .= " order by user.update_assign limit 1; ";
        return $this->selectQueryExecute($query);
    }
}
function name_title_case($val)
{
    return ucwords(strtolower($val));
}
function upper_case($val)
{
    return strtoupper($val);
}
function lower_case($val)
{
    return strtolower($val);
}
function date_filteration($date_var)
{
    if ($date_var == "" || $date_var == "1970-01-01" || $date_var == "0000-00-00") {
        $date_var = "--";
    }
    return $date_var;
}
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
function check_hot_lead()
{
    global $user, $Conn1, $positive_query_status, $positive_case_status, $fol_date;
    $qry = mysqli_query($Conn1, "select query_id as id from tbl_mint_query_status_detail where hot_case = 1 and `q_follow_date` IN ('" . $fol_date . "','0000-00-00') and user_id = " . $user . " and query_status IN (" . implode(',', $positive_query_status) . ") UNION Select case_id as id from tbl_mint_case where hot_case = 1 and `c_follow_date` IN ('" . $fol_date . "','0000-00-00') and user_id = " . $user . " and case_status IN (" . implode(',', $positive_case_status) . ")");
    $total_count = mysqli_num_rows($qry);
    if ($total_count < $_SESSION['hot_lead_limit']) {
        return 1;
    } else {
        return 0;
    }
}
function special_encryption($sData)
{
    $sResult = '';
    $secretKey = SECRET_KEY;
    for ($i = 0; $i < strlen($sData); $i++) {
        $sChar = substr($sData, $i, 1);
        $sKeyChar = substr($secretKey, ($i % strlen($secretKey)) - 1, 1);
        $sChar = chr(ord($sChar) + ord($sKeyChar));
        $sResult .= $sChar;
    }
    return str_replace('-', '878688', encode_base64($sResult));
}
function special_decryption($sData)
{
    $secretKey = SECRET_KEY;
    $sResult = '';
    $sData = str_replace('878688', '-', $sData);
    $sData = decode_base64($sData);
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
function encode_base64($sData)
{
    $sBase64 = base64_encode($sData);
    return str_replace('=', '', strtr($sBase64, '+/', '-_'));
}

function decode_base64($sData)
{
    $sBase64 = strtr($sData, '-_', '+/');
    return base64_decode($sBase64 . '==');
}
if (!function_exists('lead_reassignment')) {

    function lead_reassignment($loan_type, $net_incm, $loan_amount, $city_sub_group_id, $assign_user = 0)
    {
        $cross_sell_flag = 0;
        global $Conn1,$anl_turnover;
        if ($assign_user == 99999999990) {
            $user_array = array(0, 113);
        } else {
            $user_array = array(0, 13, 113, $assign_user);
        }

        $query = "select user.assign_id,user.user_id from tbl_assign_lead_filter as filter left join tbl_assign_user_query_filter as user on filter.filter_id = user.filter_id where filter.city_sub_group_id = '" . $city_sub_group_id . "' and find_in_set(" . $loan_type . ",filter.loan_type) > 0 and user.user_id NOT IN (" . implode(',', $user_array) . ") and user.avail_flag = 1 and user.shift_flag = filter.shift_flag";
        if ($cross_sell_flag == 1) {
            $query .= " and cross_sell_flag = '" . $cross_sell_flag . "'";
        } else {
            $query .= " and cross_sell_flag = 0";
        }

        if ($loan_type == 57) {
            $query .= " and filter.min_itr_amt <= '" . $anl_turnover . "' and filter.max_itr_amt >= '" . $anl_turnover . "'";
        } else if ($net_incm > 0) {
            $query .= " and filter.min_salary <= '" . $net_incm . "' and filter.max_salary >= '" . $net_incm . "'";
        }
        if ($loan_amount > 0) {
            $query .= " and filter.min_loan_amt <= '" . $loan_amount . "' and filter.max_loan_amt >= '" . $loan_amount . "'";
        }
        $query .= " order by user.update_assign limit 1";

        $get_query = mysqli_query($Conn1, $query);
        if (mysqli_num_rows($get_query) > 0) {
            $result_qry = mysqli_fetch_array($get_query);
            return $result_qry['user_id'];
        } else {
            return 0;
        }
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
function assignment_on_status_change($loan_type, $city_group_id, $net_incm, $loan_amt, $f_stats, $assign_user = 0)
{
    global $Conn1;
    $query = "select statuser.user_id,statuser.id from tbl_ringing_status_new as stats INNER JOIN tbl_ringing_status_user as statuser ON stats.id = statuser.ringing_id where stats.loan_type = '" . $loan_type . "' and stats.city_group_id ='" . $city_group_id . "' and stats.query_status =" . $f_stats . " and stats.min_net_incm <= " . $net_incm . " and stats.max_net_incm >=" . $net_incm . " and stats.min_loan_amt <= " . $loan_amt . " and stats.max_loan_amt >= " . $loan_amt . " and statuser.user_id > 0 and statuser.status = 1 ";
    if ($assign_user > 0) {
        $query .= " and user_id NOT IN (" . $assign_user . ")";
    }
    $query .= " order by statuser.last_assignment_on limit 1";
    $user_assign = mysqli_query($Conn1, $query);
    $result_ass_qry = mysqli_fetch_array($user_assign);

    mysqli_query($Conn1, "update tbl_ringing_status_user set last_assignment_on = NOW() where id=" . $result_ass_qry['id'] . " limit 1");
    return $result_ass_qry['user_id'];
}
function refarming_application_id($loan_type = 0, $city_group_id = 0, $net_incm = 0, $loan_amt = 0, $partner_id = 0)
{
    global $Conn1;
    $query = "select statuser.id,statuser.user_id from tbl_app_refarming as stats INNER JOIN tbl_app_refarming_user as statuser ON stats.id = statuser.refarming_id where stats.partner_id = '" . $partner_id . "' and stats.loan_type = '" . $loan_type . "' and stats.city_group_id ='" . $city_group_id . "' and stats.min_net_incm <= " . $net_incm . " and stats.max_net_incm >=" . $net_incm . " and stats.min_loan_amt <= " . $loan_amt . " and stats.max_loan_amt >= " . $loan_amt . " and statuser.user_id > 0 and statuser.status = 1 order by statuser.updated_at limit 1";
    $user_assign = mysqli_query($Conn1, $query);
    $result_ass_qry = mysqli_fetch_array($user_assign);

    mysqli_query($Conn1, "update tbl_app_refarming_user set updated_at = NOW() where id=" . $result_ass_qry['id'] . " limit 1");
    return $result_ass_qry['user_id'];
}
// function replace(string $string, iterable $replacements): string
// {
//     return str_replace(
//         array_map(
//             function ($k) {
//                 return sprintf("{%s}", $k);
//             },
//             array_keys($replacements)
//         ),
//         array_values($replacements),
//         $string
//     );
// }
function refarming($loan_type, $net_incm, $city_sub_group_id, $loan_amount)
{
    if ($loan_type != 32) {
        global $Conn1;
        $query_refarming = mysqli_query($Conn1, "SELECT user.id,user.user_id FROM tbl_refarming_slab as slab INNER JOIN tbl_refarming_slab_user as user ON slab.id=user.refarming_id where slab.loan_type = " . $loan_type . " and slab.city_group_id = " . $city_sub_group_id . " and slab.min_net_incm <= " . $net_incm . " and slab.max_net_incm >= " . $net_incm . " and slab.min_loan_amt <= " . $loan_amount . " and slab.max_loan_amt >= " . $loan_amount . " and user.status=1 and user.user_id > 0 order by user.status desc,user.last_assignment_on");
        $result_refarming = mysqli_fetch_assoc($query_refarming);
        if ($result_refarming['user_id'] > 0 && $result_refarming['user_id'] != '') {
            mysqli_query($Conn1, "update tbl_refarming_slab_user set last_assignment_on = NOW() where id = " . $result_refarming['id']);
            return $result_refarming['user_id'];
        } else {
            return 0;
        }
    } else {
        return 0;
    }
}
if (!function_exists('check_status_attempts')) {
    function check_status_attempts($loan_type_applied = 0, $status_to_be_changed, $is_verified = 1, $loan_amount = 0)
    {
        $time_inerval = 0;
        $last_status_to_check = '0';
        $no_of_attempts = '0';
        $old_status_to_check = 0;
        if ($loan_type_applied > 0) {
            if ($status_to_be_changed == 1120 || $status_to_be_changed == 1110 ||  $status_to_be_changed == 1209 || $status_to_be_changed == 1219) {
                $not_to_checked = 5;
            } else if ($status_to_be_changed == 1121 || $status_to_be_changed == 1111 || $status_to_be_changed == 1210 || $status_to_be_changed == 1220) {
                $not_to_checked = 16;
            } else if ($status_to_be_changed == 1112 || $status_to_be_changed == 1122 || $status_to_be_changed == 1211 || $status_to_be_changed == 1221) {
                $not_to_checked = 17;
            }
            if ($status_to_be_changed == 1111 || $status_to_be_changed == 1121 || (in_array($status_to_be_changed, array(1113, 1123)) && in_array($loan_type_applied, array(51, 52, 54)) && $loan_amount < 3000000)) {
                $time_inerval = 7200;
                $last_status_to_check = array(1110, 1120, 1400);
                $old_status_to_check = 5;
                $no_of_attempts = 2;
            } else if (in_array($status_to_be_changed, array(1112, 1122)) && (!in_array($loan_type_applied, array(51, 52, 54)) || (in_array($loan_type_applied, array(51, 52, 54)) && $loan_amount > 3000000))) {
                $time_inerval = 7200;
                $last_status_to_check = array(1111, 1121, 1400);
                $old_status_to_check = 16;
                $no_of_attempts = 2;
            } else if (in_array($status_to_be_changed, array(1113, 1123)) && !in_array($loan_type_applied, array(51, 52, 54))) {
                $time_inerval = 7200;
                $old_status_to_check = 17;
                $last_status_to_check = array(1112, 1122, 1400);
                $no_of_attempts = 2;
            } else if (in_array($status_to_be_changed, array(1113, 1123)) && in_array($loan_type_applied, array(51, 52, 54)) && $loan_amount > 3000000) {
                $time_inerval = 7200;
                $old_status_to_check = 17;
                $last_status_to_check = array(1112, 1122);
                $no_of_attempts = 2;
            } else if ($status_to_be_changed == 1210 || $status_to_be_changed == 1220) {
                $time_inerval = 7200;
                $last_status_to_check = array(1209, 1219);
                $old_status_to_check = 5;
                $no_of_attempts = 2;
            } else if ($status_to_be_changed == 1211 || $status_to_be_changed == 1221) {
                $time_inerval = 7200;
                $last_status_to_check = array(1210, 1220);
                $old_status_to_check = 16;
                $no_of_attempts = 2;
            } else if ($status_to_be_changed == 1212 || $status_to_be_changed == 1222) {
                $time_inerval = 7200;
                $last_status_to_check = array(1211, 1221);
                $old_status_to_check = 17;
                $no_of_attempts = 2;
            }
            if ($loan_type_applied == 60) {
                if ($status_to_be_changed == 1004) {
                    $time_inerval = 7200;
                    $last_status_to_check = 1457;
                    $old_status_to_check = 0;
                    $no_of_attempts = 1;
                } else if ($status_to_be_changed == 1009) {
                    $time_inerval = 7200;
                    $last_status_to_check = 1458;
                    $old_status_to_check = 0;
                    $no_of_attempts = 1;
                }
            }
        }
        if ($is_verified == 0) {
            $no_of_attempts = 1;
        } else if ($_SESSION['no_of_ringing_slots'] > 0 && is_numeric($_SESSION['no_of_ringing_slots']) && $no_of_attempts > 0) {
            $no_of_attempts = $_SESSION['no_of_ringing_slots'];
        }
        if (in_array($loan_type_applied, array(51, 52, 54)) && $loan_amount >= 3000000 && $loan_amount <= 5000000) {
            return array('time_interval' => 0, 'last_status_to_check' => '', 'no_of_attempts' => 0, 'old_status_to_check' => $old_status_to_check, 'not_to_checked' => $not_to_checked);
        } else {
            return array('time_interval' => $time_inerval, 'last_status_to_check' => $last_status_to_check, 'no_of_attempts' => $no_of_attempts, 'old_status_to_check' => $old_status_to_check, 'not_to_checked' => $not_to_checked);
        }
    }
}
if (!function_exists('checkCompany')) {
    function checkCompany($comp_name = '')
    {
        $main_comp = $comp_name;
        $company_name_arr = explode(" ", $comp_name);
        for ($i = (count($company_name_arr) - 1); $i >= 0; $i--) {
            $fcomp_name = strrev(implode(strrev(""), explode(strrev($company_name_arr[$i]), strrev($comp_name), 2)));
            //str_replace($company_name_arr[$i],"",$comp_name);
            $comp_name = trim($fcomp_name);
            $array[] =  trim($fcomp_name);
        }
        if (!empty(array_filter($array))) {
            $query = "select comp_id,comp_name from pl_company where comp_name LIKE '" . $main_comp . "%'";
            foreach ($array as $val) {
                if ($val != '') {
                    $query .= " UNION select comp_id,comp_name from pl_company where comp_name LIKE '" . $val . "%'";
                }
            }
            return $query .= " LIMIT 1";
        }
    }
}
if (!function_exists("search_city_pincode")) {
    function search_city_pincode($pincode)
    {
        global $Conn1;
        if (preg_match('/^[1-9][0-9]{5}$/', $pincode)) {
            $get_city_id = mysqli_query($Conn1, "select city_id from lms_city where city_pincode_min_value <= '" . $pincode . "' and city_pincode_max_value >= '" . $pincode . "' limit 1");
            $result_city_id = mysqli_fetch_assoc($get_city_id);
            if ($result_city_id['city_id'] > 0 && $result_city_id['city_id'] != '') {
                $city_id = $result_city_id['city_id'];
            } else {
                $qry = mysqli_query($Conn1, "SELECT cty.city_id as city_id,pin.pin_code  FROM lms_pincode as pin left join lms_city as cty on pin.city_id = cty.city_id WHERE pin.pin_code = '" . $pincode . "'");

                $result_qry = mysqli_fetch_array($qry);
                if ($result_qry['city_id'] != '' && $result_qry['city_id'] > '0') {
                    $city_id = $result_qry['city_id'];
                } else {
                    $qry_find_city = mysqli_query($Conn1, "(select CASE WHEN (city_pincode_min_value - '" . $pincode . "') <= 0 THEN 999999999 ELSE (city_pincode_min_value - '" . $pincode . "') END as data,city_id,state_id,crm_city_sub_group_id from lms_city where city_pincode_min_value > " . $pincode . "
order by city_pincode_min_value limit 1) UNION
(select CASE WHEN ('" . $pincode . "' - city_pincode_max_value) <= 0 THEN 999999999 ELSE ('" . $pincode . "' - city_pincode_max_value) END as data,city_id,state_id,crm_city_sub_group_id from lms_city where city_pincode_max_value < " . $pincode . "
order by city_pincode_max_value limit 1) order by data ASC LIMIT 1");
                    if (mysqli_num_rows($qry_find_city) > 0) {
                        $result_qry_find = mysqli_fetch_array($qry_find_city);
                        $city_id = $result_qry_find['city_id'];
                    }
                }
            }
            if ($city_id != '' && $city_id != '0') {
                $city_id = $city_id;
            } else {
                $city_id = '26';
            }
            $pincode_val = $pincode;
        } else if (preg_match('/^[a-zA-Z0-9]/', $pincode)) {
            $qry = mysqli_query($Conn1, "SELECT city_id,main_city_id FROM lms_city WHERE city_name = '" . $pincode . "'");
            $result_qry = mysqli_fetch_array($qry);
            $main_city_id = $result_qry['main_city_id'];
            if ($main_city_id > 0 && is_numeric($main_city_id)) {
                $city_id_oth = $main_city_id;
            } else {
                $city_id_oth = $result_qry['city_id'];
            }
            if ($city_id_oth != '' && $city_id_oth != '0') {
                $city_id = $city_id_oth;
            } else {
                $city_id = '26';
            }
            $pincode_val = 0;
        }
        return json_encode(array("final_ctiy_id" => $city_id, "final_pincode_val" => $pincode_val));
    }
}
if (!function_exists("documentList")) {
    function documentList($connection,$loanType='',$occup_id=''){
        $parent_id_array = array();
        $exec_query = "SELECT * from master_documents where is_active= 1 and parent_id IS NULL";
        if($loanType != '' && $loanType > 0){
            $exec_query .= " AND (find_in_set(".$loanType.",loan_type) OR loan_type IS NULL)";
        }
        if($occup_id != '' && $occup_id > 0){
            $exec_query .= " AND (find_in_set(".$occup_id.",occup_id) OR occup_id IS NULL)";
        }
        $query = mysqli_query($connection,$exec_query);
        if(mysqli_num_rows($query) > 0){
            while($result_query = mysqli_fetch_assoc($query)){
                $parent_id = $result_query['id'];
                $document_name = $result_query['value'];
                $child_array = array();
                $exec_query1 = "SELECT * from master_documents where is_active= 1 and parent_id = ".$parent_id;
                if($loanType != '' && $loanType > 0){
                    $exec_query1 .= " AND (find_in_set(".$loanType.",loan_type) OR loan_type IS NULL)";
                }
                if($occup_id != '' && $occup_id > 0){
                    $exec_query1 .= " AND (find_in_set(".$occup_id.",occup_id) OR occup_id IS NULL)";
                }
                $query1 = mysqli_query($connection,$exec_query1);
                if(mysqli_num_rows($query1) > 0){
                    while($result_query1 = mysqli_fetch_assoc($query1)){
                        $child_array[$result_query1['id']] = $result_query1['value'];
                    }
                }
                $parent_id_array[] = array('doc_id'=>$parent_id,'docs_name'=>$document_name,'child_docs'=>$child_array);
            }
        }
        return json_encode($parent_id_array);
    }
}
?>