<?php 
class userModel {
    function userDetails ($where=array(),$columns_to_fetch = array("*"), $order_by = null, $order = null, $limit = null){
        $queryReturn = "select ".implode(',',$columns_to_fetch)." from crm_master_user";
        if(!empty($where)){
            $queryReturn .= " where ".implode(' and ',$where);
        }
        if(!empty($order_by)){
            $queryReturn .= " ORDER BY ".$order_by." ".$order;
        }
        if(!empty($limit)){
            $queryReturn .= " LIMIT 0, ".$limit;
        }
        return $queryReturn;
    }
    function loginHistory($columns,$values){
        if(!empty($columns) && !empty($values)){
            $queryReturn = "INSERT INTO crm_history_user_login (".implode(',',$columns).") VALUES (".implode(',',$values).")";
        }
        return $queryReturn;
    }
	function fetchLoginHistory($offset = 0,$where=array(),$max_offset=11,$columns_to_fetch = array("*")){
        $queryReturn = "select ".implode(',',$columns_to_fetch)." from crm_history_user_login as hist INNER JOIN crm_master_user as user ON hist.crm_master_user_id = user.id";
        if(!empty($where)){
            $queryReturn .= " where ".implode(' and ',$where);
        }
            $queryReturn .= " ORDER BY hist.created_on DESC";
        if(!empty($limit)){
            $queryReturn .= " LIMIT ".$offset.", ".$max_offset;
        }
        return $queryReturn;
    }

    function updateLoginDateTime($user_id,$current_date_time){
        if($user_id > 0 && is_numeric($user_id)){
            $queryReturn = "update crm_master_user set last_login_on = '".$current_date_time."' where id = ".$user_id;
        }
        return $queryReturn;
    }
	function updateDetails($user_id,$update_data=array()){
        if($user_id > 0 && is_numeric($user_id)){
            $queryReturn = "update crm_master_user set ".implode(', ',$update_data)." where id = ".$user_id;
        }
        return $queryReturn;
    }

    function updateIsAvailToday($user_id,$is_avail_today){
        if($user_id > 0 && is_numeric($user_id)){
            $queryReturn = "update crm_master_user set is_available_today = '".$is_avail_today."' where id = ".$user_id;
        }
        return $queryReturn;
    }
    function getrmPartnerList($user_id){
        $queryReturn = "select group_concat(partner_id) as userlist from crm_rm_assignment where is_active = 1 and rm_user_id = ".$user_id;
        return $queryReturn;
    }
    function gettlUserList($user_id){
        $queryReturn = "select group_concat(user_id) as userlist from crm_tl_user_mapping where is_active = 1 and tl_user_id = ".$user_id;
        return $queryReturn;
    }
    function gettlloanList($user_id){
        $queryReturn = "select group_concat(loan_type) as userlist from crm_user_loan_type_mapping where is_active = 1 and user_id = ".$user_id;
        return $queryReturn;
    }
    function attendanceHistory($columns,$values){
        if(!empty($columns) && !empty($values) && count($columns) == count($values)){
            $new_insert_values = [];
            foreach($values as $key => $value) {
                $new_insert_values[] = "'".$value."'";
            }
            $queryReturn = "INSERT INTO crm_history_user_login (".implode(',',$columns).") VALUES (".implode(',',$new_insert_values).")";
        }
        return $queryReturn;
    }

    
}
    
?>