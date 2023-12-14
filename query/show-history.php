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
    $show_no_his_qry = $get_qry_det->getQueryRecord('crm_show_number_history',$columns_to_fetch = array("user_id,datetime"),array('lead_id = "'.$query_id.'"'),'datetime', 'DESC');
    $show_no_his_count = $db_handle->numRows($show_no_his_qry);
    $show_no_his_res = $db_handle->runQuery($show_no_his_qry);
    if($show_no_his_count > 0){
        $return_html .='<table class="gridtable " style="width:100%;" border="1">
        <tbody>
            <tr class="font-weight-bold">
                <th>User Name </th>
                <th>Date & Time</th>
            </tr>';
            foreach($show_no_his_res as $show_no_arr){ 
                $user_fet = get_username('user_name ',array('user_id ='.$show_no_arr['user_id']));
                $user_name = $db_handle->runQuery($user_fet);
                    $return_html .= '<tr class="center-align">
                                    <td>'.$user_name[0][0].'</td>
                                    <td>'.dateformat($show_no_arr['datetime']).'</td>
                                    </tr>  ';
             }  
             $return_html .='</tbody>
    </table>';
    }
    echo $return_html;
} ?>