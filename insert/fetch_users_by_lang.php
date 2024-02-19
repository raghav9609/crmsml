<?php
require_once "../../include/check-session.php";
require_once "../../include/config.php";

$lang_id = $_REQUEST['lang_id'];
$output_html = "";

$users_for_lang_query = mysqli_query($Conn1, "SELECT tbl_language_user_map.user_id AS user_id, tbl_user_assign.user_name AS user_name FROM tbl_language_user_map INNER JOIN tbl_user_assign ON tbl_user_assign.user_id = tbl_language_user_map.user_id WHERE lang_id = $lang_id AND tbl_language_user_map.status = 1 ");

$output_html .= "<option value=''>Select Users</option>";
while($users_for_lang_result = mysqli_fetch_array($users_for_lang_query)) {
    $output_html .= "<option value='".$users_for_lang_result['user_id']."'>".$users_for_lang_result['user_name']."</option>";
}

echo $output_html;

include("../../include/footer_close.php");