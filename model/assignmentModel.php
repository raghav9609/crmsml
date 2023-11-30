<?php 
class leadAssignMent{
    function searchFilter($data){
        $query_to_execute = "select tbl_assign_l.id As filter_id, tbl_assign_l.min_loan_amt as min_loan,tbl_assign_l.max_loan_amt as max_loan, tbl_assign_l.min_net_income as min_sal,tbl_assign_l.max_net_income as max_sal,tbl_assign_l.loan_type, city_group.city_sub_group_name from crm_lead_assignment As tbl_assign_l INNER JOIN crm_master_city_sub_group as city_group on tbl_assign_l.city_sub_group_id = city_group.id  where tbl_assign_l.is_active = ".$data['is_active'];
        if($data['city_sub_group_id'] > 0){
            $query_to_execute .= " and city_sub_group_id = ".$data['city_sub_group_id'];
        }
        if($data['loan_type'] > 0){
            $query_to_execute .= " and loan_type = ".$data['loan_type'];
        }
        if($data['user_id'] > 0){
            $query_to_execute .= " and user_id = ".$data['user_id'];
        }
        $query_to_execute .= " order by city_sub_group_id";
        
        return $query_to_execute;
    }
    function leadAssignment($data){
        $query_to_execute = "select * from crm_lead_assignment where city_sub_group_id = ".$data['city_sub_group_id']." and min_net_income = ".$data['min_net_income']." and max_net_income = ".$data['max_net_income']." and min_loan_amount= ".$data['min_loan_amount']." and max_loan_amount =".$data['max_loan_amount']." and user_id = ".$data['user_id']." and is_active = ".$data['is_active']." and shift_id = ".$data['shift_id']." order by last_lead_assign_on DESC LIMIT 1";
        return $query_to_execute;
    }
    function updateLeadAssignment($data){
        $query_to_execute = "update crm_lead_assignment set min_net_income = ".$data['min_net_income'].",max_net_income = ".$data['max_net_income'].", min_loan_amount= ".$data['min_loan_amount']." , max_loan_amount =".$data['max_loan_amount']." , user_id = ".$data['user_id']." where id =".$data['id'];
        return $query_to_execute;
    }
    function updateLastLeadAssignDate($data){
        $query_to_execute = "update crm_lead_assignment set last_lead_assign_on = NOW() where id =".$data['id'];
        return $query_to_execute;
    }
}

$leadAssignmentClassexport = new leadAssignMent();

?>