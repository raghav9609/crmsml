<?php
$no_head = 1;
if(isset($_POST)) {
    require_once(dirname(__FILE__) . '/../config/session.php');
    require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
    require_once(dirname(__FILE__) . '/../config/config.php');
    require_once(dirname(__FILE__) . '/../model/queryHelper.php');
    $db_handle = new DBController();
    $get_qry = new queryModel();
    $qry_id = base64_decode($_POST['query_fup_id']);
    $fol_up_date_time = $_POST['fol_date'].' '.date('H:i:s',strtotime($_POST['fol_time']));
    $qry_upd_arr = array(
        'query_status'              => $_POST['f_stats'],
        'follow_up_date_time'      => $fol_up_date_time,
        'remarks'                  => $_POST['remark'],
    );

    $status_history_ins_arr = array(
        'lead_id'      => $qry_id,
        'level_id'     => 1,
        'follow_up_type'  => $_POST['f_stats'], 
        'fup_date_time'   => $fol_up_date_time, 
        'remarks'   => $_POST['remark'],
        'updated_by'   => $_SESSION['userDetails']['user_id'],
        'created_on'   => currentDateTime24()
    );

    $update_cust_query = $get_qry->updateQueryData('query_details',$qry_upd_arr,array("query_id = '".$qry_id."'"));
    $update_cust_res = $db_handle->updateRows($update_cust_query);

    if( $update_cust_res){
        $update_status_his_qry = $get_qry->insertQueryData('status_history',$status_history_ins_arr);
        echo $update_status_his_res = $db_handle->insertRows($update_status_his_qry);
    }
            
}else{
    return false;
}