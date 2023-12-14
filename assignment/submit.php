<?php
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../config/config.php');
$user_first = replace_special($_REQUEST['user_ist']);
$avail_first = replace_special($_REQUEST['user_ist_flag']);
$user_secnd = replace_special($_REQUEST['user_2nd']);
$avail_secnd = replace_special($_REQUEST['user_2nd_flag']);

$arr = array('user_ist' => $user_first, 'user_2nd' => $user_secnd);

foreach ($arr as $user => $val) {
    if ($user == 'user_ist') {
        $shift = 1;
    } else {
        $shift = '2';
    }
    $count = count($val);
   
    if (!empty($val)) {
       
        for ($i = 0; $i < $count; $i++) {
            echo "hi";
            $user_id = $val[$i];
            echo $user_id;
            $qry_search = mysqli_query($Conn1, "select * from crm_lead_assignment where loan_type ='" . replace_special($_REQUEST['loan_type']) . "' and min_loan_amount = '" . replace_special($_REQUEST['loan_frm']) . "' and max_loan_amount ='" . replace_special($_REQUEST['loan_to']) . "' and min_net_income ='" . replace_special($_REQUEST['salry_from']) . "' and max_net_income ='" . replace_special($_REQUEST['salry_to']) . "' and city_sub_group_id ='" . replace_special($_REQUEST['city_sub_group']) . "' and user_id = '".$user_id."' and shift_id ='" . replace_special($shift) . "'");
            echo $qry_search;
            $res_search = mysqli_num_rows($qry_search);
            echo $res_search;
            echo "hi";
            exit();
        
            if ($res_search == '0') {
            
                $qry_ins = mysqli_query($Conn1, "INSERT into crm_lead_assignment set loan_type='" . replace_special($_REQUEST['loan_type']) . "', min_loan_amount = '" . replace_special($_REQUEST['loan_frm']) . "', max_loan_amount='" . replace_special($_REQUEST['loan_to']) . "',min_net_income ='" . replace_special($_REQUEST['salry_from']) . "', max_net_income ='" . replace_special($_REQUEST['salry_to']) . "', city_sub_group_id='" . replace_special($_REQUEST['city_sub_group']) . "',shift_id ='" . $shift . "',user_id = '".$user_id."'");
            
                $filter = mysqli_insert_id($Conn1);
        
            }
        }
    }
} 

// header("location:https://astechnos.com/crmsml/assignment/index.php?msg=1");

echo '<script>window.location.href = https://astechnos.com/crmsml/assignment/index.php?msg=1;</script>';

?>