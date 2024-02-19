<?php
require_once "../../include/check-session.php";
require_once "../../include/config.php";

if($user_role == 3) {
    $fup_count_query = mysqli_query($Conn1, "SELECT count(id) AS unread_count FROM dialer_sms_history WHERE user_id = '".$user."' AND (is_read = 0 OR is_read = '') ");
    $fup_count_result = mysqli_fetch_array($fup_count_query);
    echo $fup_count_result['unread_count'];
}
