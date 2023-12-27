<?php
$no_head =1;

require_once(dirname(__FILE__) . '/../../config/session.php');
require_once(dirname(__FILE__) . '/../../model/smsModel.php');

if(!empty($_FILES['upload_files']['name']))
{
$file_data = fopen($_FILES['upload_files']['tmp_name'], 'r');
$column = fgetcsv($file_data);
$numcols=count($column);

$status = "";
$message = "";
if($numcols > 0){
    while (($row = fgetcsv($file_data)) !== false) {
        if (count($row) === $numcols && !empty(array_filter($row))) {
        $datato_insert[] = array(
            "mobile_no" => $row[0],
            "email_id" => $row[1],
            "var1" => $row[2],
            "var2" => $row[3],
            "var3" => $row[4],
            "var4" => $row[5],
            "var5" => $row[6],
            "var6" => $row[7],
            "var7" => $row[8],
            "var8" => $row[9],
            "var9" => $row[10],
            "var10" => $row[11],
            "sms_trigger_on" => $row[12],
            "is_sms_triggered" => $row[13],
            "transaction_id" => $row[14],
            "sms_text" => $row[15],
            "url" => $row[16],
            "var_url" => $row[17],
            "source" => $row[18],
            "sms_type" => $row[19],
            "purpose" => $row[20],
            "temp_name" => $row[21],
            "communication_type" => $row[22],
            "mlc_master_communication_trigger_instant_id" => $row[23],
            "status_from_api" => $row[24],
            "api_request" => $row[25],
            "api_response" => $row[26],
            "cli" => $row[27],
            "callstatus" => $row[28],
            "callstarttime" => $row[29],
            "Campaignname" => $row[30],
            "callduration" => $row[31],
            "msisdn" => $row[32],
            "callreferenceid" => $row[33],
            "callendtime" => $row[34],
            "param1" => $row[35],
            "image_url" => $row[36],
            "statusdescription" => $row[37],
            "send_type" => $row[38],
            "schedule_date_from" => $row[39],
            "schedule_date_to" => $row[40],
            "whatsapp_type" => $row[41],
            "trigger_type" => $row[42],
            "mlc_campaign_send_sms_id" => $row[43],
            "schedule_datetime" => $row[44],
            "handsetTime" => $row[45],
            "failed_code" => $row[46]
        );
        }
    }
    
        $record_count = count($datato_insert);
        if ($record_count > 100000) {
            $response = array(
                'status' => 'Error',
                'message' => 'The file contains more than 100000 records.'
            );
            echo json_encode($response);
            exit;
        }

    }else{
        $response = array(
            'status' => "Error",
            'message' => "Excel Should have 48 Columns"
        );
        echo json_encode($response);
            exit;
    }

}else{
    $response = array(
        'status' => "Error",
        'message' => "empty file"
    );
    echo json_encode($response);
        exit;
}

echo json_encode($datato_insert);
?>