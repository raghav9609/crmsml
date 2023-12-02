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
        if($data['sm_name'] != ""){
            $query_to_execute .= " and name = '".$data['sm_name']."'";
        }
        if($data['sm_email_id'] != ""){
            $query_to_execute .= " and email_id = '".$data['sm_email_id']."'";
        }if($data['phoneno'] > 0){
            $query_to_execute .= " and mobile_no = '".$data['phoneno']."'";
        }
        $query_to_execute .= " order by partner_id";
        
        return $query_to_execute;
    }
}

$partnerDetailsExport = new partnerDetails();

?>