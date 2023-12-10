<?php 
class breDetails{
    function searchFilter($data){
        $query_to_execute = "select * from crm_offer_eligibilty where 1";
        if($data['partner_id'] > 0){
            $query_to_execute .= " and partner_id = ".$data['partner_id'];
        }
        $query_to_execute .= " order by partner_id";
        return $query_to_execute;
    }
   
}

$breDetailsExport = new breDetails();

?>