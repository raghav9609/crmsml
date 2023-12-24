<?php
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../config/config.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../model/assignmentModel.php');

$fetch_unassign_leads = $db_handle->runQuery($leadAssignmentClassexport->getUnassignleadData());
foreach($fetch_unassign_leads as $key=>$value){
    $loan_amount = $value['loan_amount'];
    $query_id = $value['query_id'];
    $loan_type_id = $value['loan_type_id'];
    $qnet_income = $value['qnet_income'];
    $cnet_income = $value['cnet_income'];
    $city_sub_group_id = $value['city_sub_group_id'];

    if($qnet_income > 0 && is_numeric($qnet_income)){
        $final_net_income = $qnet_income;
    }else{
        $final_net_income = $cnet_income;
    }

    $data = array("city_sub_group_id"=>$city_sub_group_id,"net_income"=>$final_net_income,"loan_amount"=>$loan_amount,"loan_type_id"=>$loan_type_id);
    $getLeadAssignment = $db_handle->runQuery($leadAssignmentClassexport->leadAssignment($data));

        preArray($getLeadAssignment);

    $data_to_update = array("lead_assign_to"=>$getLeadAssignment[0]['shift1user_id'],"query_id"=>$query_id);

    echo $leadAssignmentClassexport->userQueryID($data_to_update);
    echo "<br><BR>";

    $updateUserIdQuery = $db_handle->runQuery($leadAssignmentClassexport->userQueryID($data_to_update));


    $data_to_insert = array("lead_assign_to"=>$getLeadAssignment[0]['shift1user_id'],"query_id"=>$query_id);

    echo $leadAssignmentClassexport->leadAssignmentHistory($data_to_insert);
    echo "<br><BR>";


    $insertHistory = $db_handle->runQuery($leadAssignmentClassexport->leadAssignmentHistory($data_to_insert));
    $updateLastLeadAssignOn = array("id"=>$getLeadAssignment[0]['id']);

    echo $leadAssignmentClassexport->updateLastLeadAssignDate($updateLastLeadAssignOn);
    echo "<br><BR>";

    $updateLastLeadAssignmentBucket = $db_handle->runQuery($leadAssignmentClassexport->updateLastLeadAssignDate($updateLastLeadAssignOn));

}


?>