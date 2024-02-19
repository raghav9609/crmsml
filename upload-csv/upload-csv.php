<?php
require_once(dirname(__FILE__) . '/../config/session.php');
if(!empty($_FILES['upload_files']['name']))
{
$file_data = fopen($_FILES['upload_files']['tmp_name'], 'r');
$column = fgetcsv($file_data);
$numcols=count($column);

$status = "";
$message = "";
// if($numcols > 0){
    while (($row = fgetcsv($file_data)) !== false) {
        if (count($row) === $numcols && !empty(array_filter($row))) {
        $datato_insert[] = array(
            "name" => $row[0],
            "phone_no" => $row[1],
            "email_id" => $row[2],
            "pincode" => $row[3],
            "loan_amount" => $row[4],
            "dob" => $row[5],
            "net_income" => $row[6],
        );
        }
    }
    
        $record_count = count($datato_insert);
        if ($record_count > 10) {
            $response = array(
                'status' => 'Error',
                'message' => 'The file contains more than 10 records.'
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

// }else{
//     $response = array(
//         'status' => "Error",
//         'message' => "empty file"
//     );
//     echo json_encode($response);
//         exit;
// }

echo json_encode($datato_insert);
?>