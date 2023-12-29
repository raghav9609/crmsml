<?php
$no_head=1;
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../config/config.php');
require_once(dirname(__FILE__) . '/../model/smsModel.php');
require_once(dirname(__FILE__) . '/../model/queryHelper.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');

echo "hiiiiiiiii";
exit();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $mobile_no  = $_POST['mobile_no'];
    $email_id  = $_POST['email_id'];
    $var1 = $_POST['var1'];
    $var2 = $_POST['var2'];
    $var3 = $_POST['var3'];
    $var4 = $_POST['var4'];
    $var5 = $_POST['var5'];
    $var6 = $_POST['var6'];
    $var7 = $_POST['var7'];
    $var8 = $_POST['var8'];
    $var9 = $_POST['var9'];
    $var10 = $_POST['var10'];
    $sms_trigger_on = $_POST['sms_trigger_on'];
    $is_sms_triggered = $_POST['is_sms_triggered'];
    $transaction_id= $_POST['transaction_id'];
    $sms_text= $_POST['sms_text'];
    $url= $_POST['url'];
    $var_url= $_POST['var_url'];
    $source= $_POST['source'];
    $sms_type= $_POST['sms_type'];
    $purpose= $_POST['purpose'];
    $temp_name= $_POST['temp_name'];
    $communication_type= $_POST['communication_type'];
    $mlc_master_communication_trigger_instant_id= $_POST['mlc_master_communication_trigger_instant_id'];
    $status_from_api= $_POST['status_from_api'];
    $api_request= $_POST['api_request'];
    $api_response= $_POST['api_response'];
    $cli      = $_POST['cli']; 
    $callstatus    = $_POST['callstatus'];
    $callstarttime    = $_POST['callstarttime'];
    $Campaignname    = $_POST['Campaignname'];
    $callduration    = $_POST['callduration'];
    $msisdn    = $_POST['msisdn'];
    $callreferenceid    = $_POST['callreferenceid'];
    $callendtime    = $_POST['callendtime'];
    $param1    = $_POST['param1'];
    $image_url    = $_POST['image_url'];
    $statusdescription    = $_POST['statusdescription'];
    $send_type    = $_POST['send_type'];
    $schedule_date_from    = $_POST['schedule_date_from'];
    $schedule_date_to    = $_POST['schedule_date_to'];
    $whatsapp_type    = $_POST['whatsapp_type'];
    $trigger_type    = $_POST['trigger_type'];
    $mlc_campaign_send_sms_id    = $_POST['mlc_campaign_send_sms_id'];
    $schedule_datetime    = $_POST['schedule_datetime'];
    $handsetTime    = $_POST['handsetTime'];
    $failed_code    = $_POST['failed_code'];
    // print_r( $temp_name);
    $count = count($mobile_no);

    $rows = array();
    $row_count_before_insert  = $db_handle->runQuery($sms_model->getrowcount());
    for ($i = 0; $i < $count; $i++) {
        if ($sms_trigger_on[$i] != "" && $sms_trigger_on[$i] != null && $sms_trigger_on[$i] != "null"){
            $formatted_sms_trigger_on = dateformatymd($sms_trigger_on[$i]);
            if ($formatted_sms_trigger_on == "") {
                $formatted_sms_trigger_on = "1000-01-01";
            }
        };
        if ($schedule_date_from[$i] != "" && $schedule_date_from[$i] != null && $schedule_date_from[$i] != "null"){
            $formated_schedule_date_from = dateformatymd($schedule_date_from[$i]);
            if ($formated_schedule_date_from == "") {
                $formated_schedule_date_from = "1000-01-01";
            } 
        };
        if ($schedule_date_to[$i] != "" && $schedule_date_to[$i] != null && $schedule_date_to[$i] != "null"){
            $formated_schedule_date_to = dateformatymd($schedule_date_to[$i]);
            if ($formated_schedule_date_to == "") {
                $formated_schedule_date_to = "1000-01-01";
            } 
        };
        if ($schedule_datetime[$i] != "" && $schedule_datetime[$i] != null && $schedule_datetime[$i] != "null"){
            $formated_schedule_datetime = dateformatymd($schedule_datetime[$i]);
            if ($formated_schedule_datetime == "") {
                $formated_schedule_datetime = "1000-01-01";
            } 
        };
        if ($handsetTime[$i] != "" && $handsetTime[$i] != null && $handsetTime[$i] != "null"){
            $formated_handsetTimee = dateformatymd($handsetTime[$i]);
            if ($formated_handsetTimee == "") {
                $formated_handsetTimee = "1000-01-01";
            }
        } ;
        

        
        $row = array(
            'mobile_no' => $mobile_no[$i] ? $mobile_no[$i] : 0,
            'email_id' => $email_id[$i],
            'var1' => $var1[$i],
            'var2' => $var2[$i],
            'var3' => $var3[$i],
            'var4' => $var4[$i],
            'var5' => $var5[$i],
            'var6' => $var6[$i],
            'var7' => $var7[$i],
            'var8' => $var8[$i],
            'var9' => $var9[$i],
            'var10' => $var10[$i],
            'sms_trigger_on' => $formatted_sms_trigger_on ? $formatted_sms_trigger_on :"1000-01-01 ",
            'is_sms_triggered' => $is_sms_triggered[$i],
            'transaction_id' => $transaction_id[$i],
            'sms_text' => $sms_text[$i],
            'url' => $url[$i],
            'var_url' => $var_url[$i],
            'source' => $source[$i],
            'sms_type' => $sms_type[$i],
            'purpose' => $purpose[$i],
            'temp_name' => $temp_name[$i],
            'communication_type' => $communication_type[$i] ? $communication_type[$i] : 1,
            'mlc_master_communication_trigger_instant_id' => $mlc_master_communication_trigger_instant_id[$i] ? $mlc_master_communication_trigger_instant_id[$i] : 0,
            'status_from_api' => $status_from_api[$i],
            'api_request' => $api_request[$i],
            'api_response' => $api_response[$i],
            'cli' => $cli[$i] ? $cli[$i] : 0,
            'callstatus' => $callstatus[$i] ? $callstatus[$i] : 0,
            'callstarttime' => $callstarttime[$i],
            'Campaignname' => $Campaignname[$i],
            'callduration' => $callduration[$i] ? $callduration[$i] : 0,
            'msisdn' => $msisdn[$i] ? $msisdn[$i] : 0,
            'callreferenceid' => $callreferenceid[$i],
            'callendtime' => $callendtime[$i],
            'param1' => $param1[$i],
            'image_url' => $image_url[$i],
            'statusdescription' => $statusdescription[$i],
            'send_type' => $send_type[$i] ? $send_type[$i] : 1,
            'schedule_date_from' => $formated_schedule_date_from ? $formated_schedule_date_from :"1000-01-01 ",
            'schedule_date_to' => $formated_schedule_date_to ? $formated_schedule_date_to :"1000-01-01 ",
            'whatsapp_type' => $whatsapp_type[$i] ? $whatsapp_type[$i] : 1,
            'trigger_type' => $trigger_type[$i] ? $trigger_type[$i] : 1,
            'mlc_campaign_send_sms_id' => $mlc_campaign_send_sms_id[$i] ? $mlc_campaign_send_sms_id[$i] : 1,
            'schedule_datetime' => $formated_schedule_datetime ? $formated_schedule_datetime :"1000-01-01 00:00:00",
            'handsetTime' => $formated_handsetTimee ? $formated_handsetTimee: "1000-01-01",
            'failed_code' => $failed_code[$i]
        );
        $todayDate = date('Y-m-d');
        $array_where = array(
            "temp_name = '".$temp_name[$i]."'",
            'communication_type =' . $communication_type[$i],
            "DATE(created_on) = '" . $todayDate . "'"
        );
        // print_r($array_where);
        if ($communication_type[$i] == 1 || $communication_type[$i] == 2) {
            $array_where[] = "mobile_no =" . $mobile_no[$i];
        } else if ($communication_type[$i] == 6) {
            $array_where[] = "email_id =" . $email_id[$i];
        }
        $chek_data = $sms_model->fetchSMSTriggered($array_where,10);
        $chek_data1 = $db_handle->runQuery($chek_data);
        if(empty($chek_data1)){
            $insert_qry = $query_model->insertQueryData('mlc_trigger_sms',$row);
            $insert_data = $db_handle->insertRows($insert_qry);   
        }else{
            $rows = array('status' => 'error', 'message' => 'Duplicate entry','insert_Data' => $insert_row);
        }
    }
    $row_count_after_insert  = $db_handle->runQuery($sms_model->getrowcount()); 

    $countAfterInsert = $row_count_after_insert[0]['total_count'];
    $countBeforeInsert = $row_count_before_insert[0]['total_count'];
    $insert_row = $countAfterInsert - $countBeforeInsert;

    if ($insert_data != false) {
        $rows =array('status' => 'success', 'message' => 'Data Uploaded Successfully','insert_Data' => $insert_row);
    } else {
        $rows = array('status' => 'error', 'message' => $insert_data,'insert_Data' => $insert_row);
    }
}
header('Content-Type: application/json');
echo json_encode($rows);
?>