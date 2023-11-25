<?php 
class leadAssignment {
       function fetchData($product,$source,$city=0,$user=0,$plan=0){
            $query_to_exec = "SELECT slab.*,assignUser.id as assignUser_id,user_id,is_available_today,city.city_name,source.value as source_name,plan.value as plan_name from lead_assign_slab as slab INNER JOIN lms_city as city ON slab.city_id = city.city_id INNER JOIN master_plan as plan ON slab.plan_id = plan.id INNER JOIN master_source as source ON slab.source_id = source.id INNER JOIN lead_assign_user as assignUser ON slab.id = assignUser.filter_id where product_id = ".$product." and source_id=".$source ;
            if(is_numeric($city) && $city > 0){
                $query_to_exec .= " and slab.city_id = ".$city;
            }
            if(is_numeric($plan) && $plan > 0){
                $query_to_exec .= " and slab.plan_id = ".$plan;
            }
            if(is_numeric($user) && $user > 0){
                $query_to_exec .= " and assignUser.user_id = ".$user;
            }
            $query_to_exec .= " ORDER BY slab.id ";
           return $query_to_exec;
       }
       function getSLabData($filter_id){
            return $query_to_exec = "select * from lead_assign_user where filter_id = ".$filter_id;
        }
    function updateUser($user_id_fetch=0,$is_avail_flag,$filter_id){
        return $query_to_exec = "update lead_assign_user set user_id = '".$user_id_fetch."',is_available_today='".$is_avail_flag."' where id = ".$filter_id;
    }
    function leadAssignTo($product_id ,$plan_id,$city_id,$source_id){
        return $query_to_exec = "SELECT assign.id,assign.user_id from lead_assign_slab as slab INNER JOIN lead_assign_user as assign ON slab.id = assign.filter_id WHERE product_id = ".$product_id." and plan_id = ".$plan_id." and source_id =".$source_id." and city_id = ".$city_id." and is_available_today = 1 and user_id <> 0 ORDER BY last_lead_assign_on LIMIT 1" ;
    }
    function updateAssgnUserData($filter_id){
        return $query_to_exec = "update lead_assign_user set last_lead_assign_on = NOW() where id = ".$filter_id ;
    }
    function assignHistory($columns,$values){
        if(!empty($columns) && !empty($values) && count($columns) == count($values)){
            $new_insert_values = [];
            foreach($values as $key => $value) {
                $new_insert_values[] = "'".$value."'";
            }
            $queryReturn = "INSERT INTO lead_assign_history (".implode(',',$columns).") VALUES (".implode(',',$new_insert_values).")";
        }
        return $queryReturn;
    }
}
    
?>