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
    $lead_disp_his_qry = $get_qry_det->getQueryRecord('lead_display_history',$columns_to_fetch = array("*"),array('lead_id = "'.$query_id.'"'),'Created_on', 'DESC');
    $lead_disp_his_count = $db_handle->numRows($lead_disp_his_qry);
    $lead_disp_his_res = $db_handle->runQuery($lead_disp_his_qry);
    if($lead_disp_his_count > 0){
        $return_html .='<table class="gridtable " style="width:100%;" border="1">
        <tbody>
            <tr class="font-weight-bold">
                <th>Level ID</th>
                <th>User Name</th>
                <th>Date & Time</th>
            </tr>';
            foreach($lead_disp_his_res as $lead_disp_arr){ 
                    $user_fet = get_username('user_name ',array('user_id ='.$lead_disp_arr['user_id']));
                    $user_name = $db_handle->runQuery($user_fet);
                    $return_html .= '<tr class="center-align">
                                    <td>'.$lead_disp_arr['level_id'].'</td>
                                    <td>'.$user_name[0][0].'</td>
                                    <td>'.date('d-m-Y h:i:s A',strtotime($lead_disp_arr['created_on'])).'</td>
                                    </tr>  ';
             }  
             $return_html .='</tbody>
    </table>';
    }
    echo $return_html;
} ?>