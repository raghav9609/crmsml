<?php 
class FormModel {
    function applicationdatafetch($id,$query){
        $queryReturn = "select * from crm_query_application where id = '".$id."' and crm_query_id = '".$query_id."'";
        return $queryReturn;

    }
}
$formmodelExport = new FormModel();
    
?>