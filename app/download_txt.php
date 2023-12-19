<?php
require_once "../../include/config.php";
$id = $_REQUEST['id'];
$virtual_id = $_REQUEST['virtual_id'];
if(empty($id)) {
    echo "<script>alert('Invalid ID for download'); window.close();</script>";
} else {
    $req_res_data = "";
    $qry = "SELECT helper_id, application_id, request_send, response_from_api, date, bank_name, partner_name, api_rule_master.url AS url FROM api_helper 
    INNER JOIN tbl_mlc_partner ON api_helper.partner_id = tbl_mlc_partner.partner_id LEFT JOIN tbl_bank ON tbl_bank.bank_id = tbl_mlc_partner.bank_id LEFT JOIN api_rule_master ON api_rule_master.id = api_helper.rule_id WHERE helper_id = '" . $id . "'";
    $qry_exe = mysqli_query($Conn1, $qry);
    if(mysqli_num_rows($qry_exe) > 0) {
        $qry_res = mysqli_fetch_array($qry_exe);
        if(!empty($qry_res['helper_id'])) {
            $bank_name = (trim($qry_res['bank_name']) != "") ? $qry_res['bank_name'] : "";
            $partner_name = (trim($qry_res['partner_name']) != "") ? $qry_res['partner_name'] : "";
            $pushed_date = "--";
            if($qry_res['date'] != "") {
                $pushed_date = (date("Y-m-d", strtotime($qry_res['date'])) != "0000-00-00" || date("Y-m-d", strtotime($qry_res['date'])) != "1970-01-01" || date("Y-m-d", strtotime($qry_res['date'])) != "") ? date("d-m-Y h:i:s A", strtotime($qry_res['date'])) : "--";
            }

            $api_url = (trim($qry_res['url']) != "") ? "URL: ".$qry_res['url']." \n \n" : "";

            if($bank_name != "") {
                $req_res_data .= "Application Pushed to ".$bank_name." (".$partner_name.") \n \n";
            } else {
                $req_res_data .= "Application Pushed to ".$partner_name."\n \n";
            }
            $req_res_data .= "Application Pushed Date: ".$pushed_date."\n \n";
            $req_res_data .= "MyLoanCare Application No: ".$qry_res['application_id']."\n \n";
            $req_res_data .= $api_url;
            $req_res_data .= "REQUEST: \n \n";
            $req_res_data .= $qry_res['request_send']."\n \n";
            $req_res_data .= "RESPONSE: \n \n";
            $req_res_data .= $qry_res['response_from_api']."\n \n";

            $modified_bank_name = str_replace(" ", "_", $bank_name);

            $file_name = "Application_".$modified_bank_name."_Req_Res_".$qry_res['application_id']."_".$virtual_id.".txt";
            $handle = fopen($file_name, "w");
            fwrite($handle, $req_res_data);
            fclose($handle);
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.basename($file_name));
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file_name));
            readfile($file_name);
            exit;
        } else {
            echo "<script>alert('Response ID not found'); window.close();</script>";    
        }
    } else {
        echo "<script>alert('Data not found'); window.close();</script>";
    }
}