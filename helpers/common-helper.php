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
?>