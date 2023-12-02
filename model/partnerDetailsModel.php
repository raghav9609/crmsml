<?php 
class partnerDetails{
    function searchFilter($data){
        $query_to_execute = "select * from crm_partner_rm_sm_details As partner where 1";
        if($data['city_id'] > 0){
            $query_to_execute .= " and city_id = ".$data['city_id'];
        }
        if($data['partner_id'] > 0){
            $query_to_execute .= " and partner_id = ".$data['partner_id'];
        }if($data['agent_type'] > 0){
            $query_to_execute .= " and agent_type = ".$data['agent_type'];
        }
        $query_to_execute .= " order by partner_id";
        
        return $query_to_execute;
    }
}

$partnerDetailsExport = new partnerDetails();

?>