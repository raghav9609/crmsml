<?php
$slave =1;
require_once "../../include/check-session.php";
require_once "../../include/config.php";
require_once "../../include/helper.functions.php";
$lead_id = $_REQUEST['lead_id'];
$level_id = $_REQUEST['level_id'];
$select="select sms_from,sms_to,sms_message,sms_date from dialer_getsms_logs where level_id=$level_id and lead_id=$lead_id";
$query_id_exe = mysqli_query($Conn1, $select);
if(mysqli_num_rows($query_id_exe) > 0) {

 $return_html_original_query .= "<table class='gridtable' style='width: 100%'> 
<tr class='font-weight-bold'> <th>SR No</th><th>From Mobile</th> <th>To Mobile</th>  <th>SMS</th> <th>SMS Received Date-Time</th> </tr>";
$sr=1;
while($rows = mysqli_fetch_array($query_id_exe)) {
    $smsfrom=$rows['sms_from'];
    $smsto=$rows['sms_to'];
    if($user_role != '1') {
        $echo_numbersmsfrom = substr_replace($smsfrom,'XXX',4,3);
        $echo_numbersmsto = substr_replace($smsto,'XXX',4,3);
	} else {
       $echo_numbersmsto =  $smsto;
       $echo_numbersmsfrom = $smsfrom;
	}
$return_html_original_query .="<tr><td>".$sr++."</td><td>".$echo_numbersmsfrom."</td><td>".$echo_numbersmsto."</td><td>".$rows['sms_message']."</td><td>".$rows['sms_date']."</td></tr>";
echo $return_html_original_query .="</table>";
}
}
else {
    echo 0;
}