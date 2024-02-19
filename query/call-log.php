<?php
$no_head = 1;
if(isset($_POST)) {
    require_once(dirname(__FILE__) . '/../config/session.php');
    require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
    require_once(dirname(__FILE__) . '/../config/config.php');
    require_once(dirname(__FILE__) . '/../model/queryHelper.php');
    $db_handle = new DBController();
    $get_qry_det = new queryModel();
    $return_html = '';
    $query_id = $_POST['query_id'];
    $call_log_his_qry = $get_qry_det->getQueryRecord('tbl_query_click_to_call_history',$columns_to_fetch = array("status_id,call_button_type,entered_date"),array('lead_id = "'.$query_id.'"'),'entered_date', 'DESC');
    $call_log_his_count = $db_handle->numRows($call_log_his_qry);
    $call_log_his_res = $db_handle->runQuery($call_log_his_qry);
    if($call_log_his_count > 0){
        $return_html .='<table class="gridtable " style="width:100%;" border="1">
        <tbody>
            <tr class="font-weight-bold">
                <th>Query Disposition</th>
                <th>Call Type</th>
                <th>Date & Time</th>
            </tr>';
            foreach($call_log_his_res as $call_log_arr){ 
                    $status_fet = get_query_status('description ',array('id ='.$call_log_arr['status_id']));
					$stats_name = $db_handle->runQuery($status_fet);
                    if($call_log_arr['call_button_type'] == 1){ $call_dis = 'Call1'; }else { $call_dis = 'Call2'; }

                    $return_html .= '<tr class="center-align">
                                    <td>'.$stats_name[0][0].'</td>
                                    <td>'.$call_dis.'</td>
                                    <td>'.date('d-m-Y h:i:s A',strtotime($call_log_arr['entered_date'])).'</td>
                                    </tr>  ';
             }  
             $return_html .='</tbody>
    </table>';
    }
    echo $return_html;
} ?>