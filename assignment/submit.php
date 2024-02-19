<?php
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../config/config.php');
$user_first = replace_special($_REQUEST['user_ist']);
$avail_first = replace_special($_REQUEST['user_ist_flag']);
$user_secnd = replace_special($_REQUEST['use_secnd']);
$avail_secnd = replace_special($_REQUEST['user_2nd_flag']);

// $arr = array('user_ist' => $user_first, 'user_2nd' => $user_secnd);
if (!empty($user_first)) {
    $firstuserValues[] = $user_first;
}

if (!empty($user_secnd)) {
    $seconduserValues[] = $user_secnd;
}

// foreach ($arr as $user => $val) {
//     if ($user == 'user_ist') {
//         $shift = 1;
//     } else {
//         $shift = '2';
//     }
//     $count = count($val);
//     print_r($val);
//     exit();
//     if (!empty($val)) {
       
//         for ($i = 0; $i < $count; $i++) {
//             $user_id = $val[$i];

//             $qry_search = mysqli_query($Conn1, "select * from crm_lead_assignment where loan_type ='" . replace_special($_REQUEST['loan_type']) . "' and min_loan_amount = '" . replace_special($_REQUEST['loan_frm']) . "' and max_loan_amount ='" . replace_special($_REQUEST['loan_to']) . "' and min_net_income ='" . replace_special($_REQUEST['salry_from']) . "' and max_net_income ='" . replace_special($_REQUEST['salry_to']) . "' and city_sub_group_id ='" . replace_special($_REQUEST['city_sub_group']) . "' and (shift1user_id = '".$user_id."' or shift2_user_id ='" . replace_special($user_id) . "')");
            
//             $res_search = mysqli_num_rows($qry_search);
        
//             if ($res_search == '0') {
            
//                 $qry_ins = mysqli_query($Conn1, "INSERT into crm_lead_assignment set loan_type='" . replace_special($_REQUEST['loan_type']) . "', min_loan_amount = '" . replace_special($_REQUEST['loan_frm']) . "', max_loan_amount='" . replace_special($_REQUEST['loan_to']) . "',min_net_income ='" . replace_special($_REQUEST['salry_from']) . "', max_net_income ='" . replace_special($_REQUEST['salry_to']) . "', city_sub_group_id='" . replace_special($_REQUEST['city_sub_group']) . "',shift1user_id ='" . $user_id . "',shift2_user_id = '".$user_id."'");
            
//                 $filter = mysqli_insert_id($Conn1);
        
//             }
//         }
//     }
// } 
// 


foreach ($firstuserValues as $user_id_array1) {
        foreach ($user_id_array1 as $user_id) {
            if (!empty($user_id)){   
            // $qry_search = mysqli_query($Conn1, "SELECT * FROM crm_lead_assignment WHERE loan_type = '" . replace_special($_REQUEST['loan_type']) . "' AND min_loan_amount = '" . replace_special($_REQUEST['loan_frm']) . "' AND max_loan_amount = '" . replace_special($_REQUEST['loan_to']) . "' AND min_net_income = '" . replace_special($_REQUEST['salry_from']) . "' AND max_net_income = '" . replace_special($_REQUEST['salry_to']) . "' AND city_sub_group_id = '" . replace_special($_REQUEST['city_sub_group']) . "' AND shift1user_id = '" . $user_id . "'");
            $res_search = $db_handle->runQuery("SELECT * FROM crm_lead_assignment WHERE loan_type = '" . replace_special($_REQUEST['loan_type']) . "' AND min_loan_amount = '" . replace_special($_REQUEST['loan_frm']) . "' AND max_loan_amount = '" . replace_special($_REQUEST['loan_to']) . "' AND min_net_income = '" . replace_special($_REQUEST['salry_from']) . "' AND max_net_income = '" . replace_special($_REQUEST['salry_to']) . "' AND city_sub_group_id = '" . replace_special($_REQUEST['city_sub_group']) . "' AND shift2_user_id = '" . $user_id . "'");

           
            // $res_search = mysqli_num_rows($qry_search);
            if (!empty($res_search)){
        
                $qry_update = mysqli_query($Conn1, "
                UPDATE crm_lead_assignment 
                SET shift1user_id = '" . $user_id . "'
                WHERE id = '" . $res_search[0]['id'] . "'
            ");
            }elseif ($res_search == 0) {
                $qry_ins = mysqli_query($Conn1, "INSERT INTO crm_lead_assignment SET loan_type = '" . replace_special($_REQUEST['loan_type']) . "', min_loan_amount = '" . replace_special($_REQUEST['loan_frm']) . "', max_loan_amount = '" . replace_special($_REQUEST['loan_to']) . "', min_net_income = '" . replace_special($_REQUEST['salry_from']) . "', max_net_income = '" . replace_special($_REQUEST['salry_to']) . "', city_sub_group_id = '" . replace_special($_REQUEST['city_sub_group']) . "', shift1user_id = '" . $user_id . "', shift2_user_id = ''");

                $filter = mysqli_insert_id($Conn1);
            }
}
}
}
$index = 0;
foreach ($seconduserValues as $user_id_array) {
    
    foreach ($user_id_array as $user_id) {   
        
    // $qry_search = mysqli_query($Conn1, "SELECT * FROM crm_lead_assignment WHERE loan_type = '" . replace_special($_REQUEST['loan_type']) . "' AND min_loan_amount = '" . replace_special($_REQUEST['loan_frm']) . "' AND max_loan_amount = '" . replace_special($_REQUEST['loan_to']) . "' AND min_net_income = '" . replace_special($_REQUEST['salry_from']) . "' AND max_net_income = '" . replace_special($_REQUEST['salry_to']) . "' AND city_sub_group_id = '" . replace_special($_REQUEST['city_sub_group']) . "' AND shift1user_id = '" . $user_id . "'");
    $res_search = $db_handle->runQuery("SELECT * FROM crm_lead_assignment WHERE loan_type = '" . replace_special($_REQUEST['loan_type']) . "' AND min_loan_amount = '" . replace_special($_REQUEST['loan_frm']) . "' AND max_loan_amount = '" . replace_special($_REQUEST['loan_to']) . "' AND min_net_income = '" . replace_special($_REQUEST['salry_from']) . "' AND max_net_income = '" . replace_special($_REQUEST['salry_to']) . "' AND city_sub_group_id = '" . replace_special($_REQUEST['city_sub_group']) . "' AND (shift1user_id != 0 OR shift1user_id = '" . $user_id . "')");
    
    // $res_search = mysqli_num_rows($qry_search);
 
    if (!empty($res_search)){
        $qry_update = mysqli_query($Conn1, "
        UPDATE crm_lead_assignment 
        SET shift2_user_id = '" . $user_id . "'
        WHERE id = '" . $res_search[$index]['id'] . "'
    ");
    }elseif ($res_search == 0) {
        if (!empty($user_id)){   
        $qry_ins = mysqli_query($Conn1, "INSERT INTO crm_lead_assignment SET loan_type = '" . replace_special($_REQUEST['loan_type']) . "', min_loan_amount = '" . replace_special($_REQUEST['loan_frm']) . "', max_loan_amount = '" . replace_special($_REQUEST['loan_to']) . "', min_net_income = '" . replace_special($_REQUEST['salry_from']) . "', max_net_income = '" . replace_special($_REQUEST['salry_to']) . "', city_sub_group_id = '" . replace_special($_REQUEST['city_sub_group']) . "', shift1user_id = '', shift2_user_id = '" . $user_id . "'");

        $filter = mysqli_insert_id($Conn1);
        
    }
}
$index++;
}
}


// header("location:https://astechnos.com/crmsml/assignment/index.php?msg=1");

echo '<script>window.location.href = "'.$head_url.'/assignment/index.php?msg=1";</script>';
exit();
?>