<?php
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../config/config.php');
$user_first = replace_special($_REQUEST['user_ist']);
$avail_first = replace_special($_REQUEST['user_ist_flag']);
$user_secnd = replace_special($_REQUEST['user_2nd']);
$avail_secnd = replace_special($_REQUEST['user_2nd_flag']);

echo "select * from crm_lead_assignment where loan_type ='" . replace_special($_REQUEST['loan_type']) . "' and min_loan_amount = '" . replace_special($_REQUEST['loan_frm']) . "' and max_loan_amount ='" . replace_special($_REQUEST['loan_to']) . "' and min_net_income ='" . replace_special($_REQUEST['salry_from']) . "' and max_net_income ='" . replace_special($_REQUEST['salry_to']) . "' and city_sub_group_id ='" . replace_special($_REQUEST['city_sub_group']) . "'";

$qry_search = mysqli_query($Conn1, "select * from crm_lead_assignment where loan_type ='" . replace_special($_REQUEST['loan_type']) . "' and min_loan_amount = '" . replace_special($_REQUEST['loan_frm']) . "' and max_loan_amount ='" . replace_special($_REQUEST['loan_to']) . "' and min_net_income ='" . replace_special($_REQUEST['salry_from']) . "' and max_net_income ='" . replace_special($_REQUEST['salry_to']) . "' and city_sub_group_id ='" . replace_special($_REQUEST['city_sub_group']) . "'");
$res_search = mysqli_num_rows($qry_search);
if ($res_search == '0') {
    $arr = array('user_ist' => $user_first, 'user_2nd' => $user_secnd);
    $qry_select = mysqli_query($Conn1, "select id as filter_id,shift_id As shift_flag from crm_lead_assignment order by id desc limit 1");
    $res_select = mysqli_fetch_array($qry_select);

    $qry_ins = mysqli_query($Conn1, "INSERT into crm_lead_assignment set loan_type='" . replace_special($_REQUEST['loan_type']) . "', min_loan_amount = '" . replace_special($_REQUEST['loan_frm']) . "', max_loan_amount='" . replace_special($_REQUEST['loan_to']) . "',min_net_income ='" . replace_special($_REQUEST['salry_from']) . "', max_net_income ='" . replace_special($_REQUEST['salry_to']) . "', city_sub_group_id='" . replace_special($_REQUEST['city_sub_group']) . "',shift_id ='" . replace_special($res_select['shift_flag']) . "'");
    $filter = mysqli_insert_id($Conn1);



    // foreach ($arr as $user => $val) {
    //     $avail_flag = replace_special($_REQUEST[$user . "_flag"]);
    //     if ($user == 'user_ist') {
    //         $shift = 1;
    //     } else {
    //         $shift = '2';
    //     }
    //     $count = count($val);
    //     for ($i = 0; $i < $count; $i++) {
    //         $qry_ins = mysqli_query($Conn1, "INSERT into tbl_assign_user_query_filter set filter_id = '" . $filter . "',user_id='" . $val[$i] . "',avail_flag='" . $avail_flag[$i] . "',shift_flag='" . $shift . "',update_assign=NOW()");
    //         $qry_ins_history = mysqli_query($Conn1, "INSERT into tbl_assign_user_query_filter_history set filter_id = '" . $filter . "',user_id='" . $val[$i] . "',avail_flag='" . $avail_flag[$i] . "',shift_flag='" . $shift . "',update_assign=NOW(),updated_by_user='".$user."',date=NOW()");

    //     }
    // }
    header("location:index.php?msg=1");
} else {
    header("location:index.php?msg=2");
}


?>