<?php 
class leadAssignMent{
    function searchFilter($data){
        $query_to_execute = "select tbl_assign_l.id As filter_id, tbl_assign_l.min_loan_amount as min_loan,tbl_assign_l.max_loan_amount as max_loan, tbl_assign_l.min_net_income as min_sal,tbl_assign_l.max_net_income as max_sal,tbl_assign_l.loan_type, city_group.city_sub_group_name,tbl_assign_l.shift1user_id,tbl_assign_l.shift2_user_id from crm_lead_assignment As tbl_assign_l INNER JOIN crm_master_city_sub_group as city_group on tbl_assign_l.city_sub_group_id = city_group.id  where tbl_assign_l.is_active = ".$data['is_active'];
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
    function getUnassignleadData(){
        $query_to_execute = "select query.id as query_id,query.loan_amount,query.loan_type_id,query.net_income as qnet_income,customer.city_id,customer.net_income as cnet_income,cgroup.city_sub_group_id from crm_query as query INNER JOIN crm_customer as customer ON query.crm_customer_id = customer.id INNER JOIN crm_master_city as cgroup ON customer.city_id = cgroup.id where is_lead_assign = 0 order by query.id DESC limit 50";
        return $query_to_execute;
    }
    function leadAssignment($data){
        $query_to_execute = "select * from crm_lead_assignment where city_sub_group_id = ".$data['city_sub_group_id']." and min_net_income <= ".$data['net_income']." and max_net_income >= ".$data['net_income']." and min_loan_amount <= ".$data['loan_amount']." and max_loan_amount >=".$data['loan_amount']." and loan_type >=".$data['loan_type_id']." and is_active = 1 order by last_lead_assign_on DESC LIMIT 1";
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
    function searchRM($data){
        $query_to_execute = "select * from crm_rm_assignment where 1 ";
        if($data['partner_id'] > 0){
            $query_to_execute .= " and partner_id = ".$data['partner_id'];
        }
        if($data['user_id'] > 0){
            $query_to_execute .= " and rm_user_id = ".$data['user_id'];
        }
        $query_to_execute .= " order by rm_user_id";
        
        return $query_to_execute;
    }
}

$leadAssignmentClassexport = new leadAssignMent();

?>