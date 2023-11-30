<?php
require_once "../../include/config.php";
$user_first = replace_special($_REQUEST['user_ist']);
$avail_first = replace_special($_REQUEST['user_ist_flag']);
$user_secnd = replace_special($_REQUEST['user_2nd']);
$avail_secnd = replace_special($_REQUEST['user_2nd_flag']);

$qry_search = mysqli_query($Conn1, "select * from tbl_assign_lead_filter where loan_type ='" . replace_special($_REQUEST['loan_type']) . "' and min_loan_amt = '" . replace_special($_REQUEST['loan_frm']) . "' and max_loan_amt ='" . replace_special($_REQUEST['loan_to']) . "' and min_salary ='" . replace_special($_REQUEST['salry_from']) . "' and max_salary ='" . replace_special($_REQUEST['salry_to']) . "' and city_sub_group_id ='" . replace_special($_REQUEST['city_sub_group']) . "' and cross_sell_flag=" . replace_special($_REQUEST['crasssell']) . "");
$res_search = mysqli_num_rows($qry_search);
if ($res_search == '0') {
    $arr = array('user_ist' => $user_first, 'user_2nd' => $user_secnd);
    $qry_select = mysqli_query($Conn1, "select filter_id,shift_flag from tbl_assign_lead_filter order by filter_id desc limit 1");
    $res_select = mysqli_fetch_array($qry_select);

    $qry_ins = mysqli_query($Conn1, "INSERT into tbl_assign_lead_filter set occup_id = '" . replace_special($_REQUEST['occupation']) . "',loan_type='" . replace_special($_REQUEST['loan_type']) . "',min_itr_amt = '" . replace_special($_REQUEST['itr_frm']) . "', max_itr_amt='" . replace_special($_REQUEST['itr_to']) . "', min_loan_amt = '" . replace_special($_REQUEST['loan_frm']) . "', max_loan_amt='" . replace_special($_REQUEST['loan_to']) . "',min_salary='" . replace_special($_REQUEST['salry_from']) . "',max_salary='" . replace_special($_REQUEST['salry_to']) . "',city_sub_group_id='" . replace_special($_REQUEST['city_sub_group']) . "',shift_flag='" . replace_special($res_select['shift_flag']) . "',cross_sell_flag=" . replace_special($_REQUEST['crasssell']) . "");
    $filter = mysqli_insert_id($Conn1);

    $qry_ins_history = mysqli_query($Conn1, "INSERT into tbl_assign_lead_filter_history set occup_id = '" . replace_special($_REQUEST['occupation']) . "',loan_type='" . replace_special($_REQUEST['loan_type']) . "',min_itr_amt = '" . replace_special($_REQUEST['itr_frm']) . "', max_itr_amt='" . replace_special($_REQUEST['itr_to']) . "', min_loan_amt = '" . replace_special($_REQUEST['loan_frm']) . "', max_loan_amt='" . replace_special($_REQUEST['loan_to']) . "',min_salary='" . replace_special($_REQUEST['salry_from']) . "',max_salary='" . replace_special($_REQUEST['salry_to']) . "',city_sub_group_id='" . replace_special($_REQUEST['city_sub_group']) . "',shift_flag='" . replace_special($res_select['shift_flag']) . "',cross_sell_flag='".replace_special($_REQUEST['crasssell']) ."',updated_by_user='".$user."',date=NOW()");

    foreach ($arr as $user => $val) {
        $avail_flag = replace_special($_REQUEST[$user . "_flag"]);
        if ($user == 'user_ist') {
            $shift = 1;
        } else {
            $shift = '2';
        }
        $count = count($val);
        for ($i = 0; $i < $count; $i++) {
            $qry_ins = mysqli_query($Conn1, "INSERT into tbl_assign_user_query_filter set filter_id = '" . $filter . "',user_id='" . $val[$i] . "',avail_flag='" . $avail_flag[$i] . "',shift_flag='" . $shift . "',update_assign=NOW()");
            $qry_ins_history = mysqli_query($Conn1, "INSERT into tbl_assign_user_query_filter_history set filter_id = '" . $filter . "',user_id='" . $val[$i] . "',avail_flag='" . $avail_flag[$i] . "',shift_flag='" . $shift . "',update_assign=NOW(),updated_by_user='".$user."',date=NOW()");

        }
    }
    header("location:index.php?msg=1");
} else {
    header("location:index.php?msg=2");
}


?>