<?php 
class leadAssignMent{
    function leadAssignment($data){
        $query_to_execute = "select * from crm_lead_assignment where city_sub_group_id = ".$data['city_sub_group_id']." and min_net_income = ".$data['min_net_income']." and max_net_income = ".$data['max_net_income']." and min_loan_amount= ".$data['min_loan_amount']." and max_loan_amount =".$data['max_loan_amount']." and user_id = ".$data['user_id']." and is_active = ".$data['is_active']." and shift_id = ".$data['shift_id']." order by last_lead_assign_on DESC LIMIT 1";
    }
    function updateLeadAssignment($data){
        $query_to_execute = "update crm_lead_assignment set min_net_income = ".$data['min_net_income'].",max_net_income = ".$data['max_net_income'].", min_loan_amount= ".$data['min_loan_amount']." , max_loan_amount =".$data['max_loan_amount']." , user_id = ".$data['user_id']." where id =".$data['id'];
    }
    function updateLastLeadAssignDate($data){
        $query_to_execute = "update crm_lead_assignment set last_lead_assign_on = NOW() where id =".$data['id'];
    }
}

$leadAssignmentClassexport = new leadAssignMent();

?>