<?php
require_once "../../include/check-session.php";
require_once "../../include/config.php";

$type       = $_REQUEST['type'];
$cust_id    = $_REQUEST['cust_id'];
$query_id   = $_REQUEST['query_id'];
$case_id    = $_REQUEST['case_id'];

$final_template = "";

$loan_amount    = "";
$loan_type      = "";

if($case_id != "") {
    $cust_loan_details = "SELECT lms_loan_type.loan_type_name, tbl_mint_case.required_loan_amt AS loan_amount FROM tbl_mint_case LEFT JOIN lms_loan_type ON lms_loan_type.loan_type_id = tbl_mint_case.loan_type WHERE tbl_mint_case.case_id = $case_id LIMIT 0, 1 ";
} else {
    $cust_loan_details = "SELECT lms_loan_type.loan_type_name, tbl_mint_query.loan_amt AS loan_amount FROM tbl_mint_query LEFT JOIN lms_loan_type ON lms_loan_type.loan_type_id = tbl_mint_query.loan_type WHERE tbl_mint_query.query_id = $query_id LIMIT 0, 1";
}

$cust_loan_exe  = mysqli_query($Conn1, $cust_loan_details);
$cust_loan_res  = mysqli_fetch_array($cust_loan_exe);
$loan_amount    = $cust_loan_res['loan_amount'];
$loan_type      = $cust_loan_res['loan_type_name'];

$get_customer_info = mysqli_query($Conn1,"SELECT CONCAT_WS(' ', name, lname) AS full_name, email, phone FROM tbl_mint_customer_info WHERE id= ".$cust_id."");
$result_get_cust_info = mysqli_fetch_array($get_customer_info);
$customer_name  = $result_get_cust_info['full_name'];
$customer_phone = $result_get_cust_info['phone'];

$doc_cust_query = "SELECT * FROM customer_document WHERE cust_id = ".$cust_id." AND delete_flag = 0 AND doc_id != 1 ";
if($type == 2) {
    $doc_cust_query .= " AND is_verified = 1 ";
}
$document_customer_qry = mysqli_query($Conn1, $doc_cust_query);
$count = mysqli_num_rows($document_customer_qry);

if($count > 0) {
    if($type == 1) {
        $final_template .= "$customer_name / $cust_id, Documents have been received and verified.<br><br>";
    } else {
        $final_template .= "<div style='text-align: center; font-weight: bold; color: green'><u>Document Details</u></div>";
        $final_template .= "<span style='font-weight: bold; color: orange; width: 10%; float: left;'>Name: </span><span style='width: 15%; float: left;'>".$customer_name."</span> ";
        $final_template .= "<span style='font-weight: bold; color: orange; width: 10%; float: left;'>Mobile: </span><span style='width: 15%; float: left;'>".substr_replace($customer_phone, 'XXX', 4, 3)."</span> ";
        $final_template .= "<span style='font-weight: bold; color: orange; width: 10%; float: left;'>Loan Type: </span><span style='width: 15%; float: left;'>".$loan_type."</span> ";
        $final_template .= "<span style='font-weight: bold; color: orange; width: 10%; float: left;'>Loan Amount: </span><span style='width: 15%; float: left;'>".$loan_amount."</span> <br><br>";

    }
    $final_template .= "<div style='text-align: center; font-weight: bold; color: green'><u>Document Details</u></div>";
    $final_template .= '<table width="95%" class="gridtable ml20 mt20 mb20">';
    $final_template .= '<tbody><tr><th width="3%" style="background-color: #18375f; border-color: #bbbbbb; color: #ffffff;">Sr No.</th><th width="10%" style="background-color: #18375f; border-color: #bbbbbb; color: #ffffff;">Document Type</th><th width="7%" style="background-color: #18375f; border-color: #bbbbbb; color: #ffffff;">Information</th><th width="8%" style="background-color: #18375f; border-color: #bbbbbb; color: #ffffff;">Uploaded On</th><th width="8%" style="background-color: #18375f; border-color: #bbbbbb; color: #ffffff;">Verified</th><th width="8%" style="background-color: #18375f; border-color: #bbbbbb; color: #ffffff;">Remarks</th></tr>';
    while($result_customer_qry = mysqli_fetch_array($document_customer_qry)) {
        $i++;
        $proof_customer_qry = mysqli_query($Conn1, "SELECT proof_name from tbl_address_proof where proof_id = '".$result_customer_qry['doc_id']."'");
        $doc_name = mysqli_fetch_array($proof_customer_qry);
        
        $subproof_customer_qry = mysqli_query($Conn1, "SELECT doc_name from tbl_subproof where id = '".$result_customer_qry['docid_first']."'");
        $subdoc_name = mysqli_fetch_array($subproof_customer_qry);
        $sub_doc_name = $subdoc_name['doc_name'];

        if($result_customer_qry['docid_sec'] != 0) {
            $subproof1_customer_qry = mysqli_query($Conn1, "SELECT doc_name from tbl_subproof2 where id = '".$result_customer_qry['docid_sec']."'");
            $subdoc1_name = mysqli_fetch_array($subproof1_customer_qry);
            $sub1_doc_name = "(".$subdoc1_name['doc_name'].")";
        }

        if($result_customer_qry['bank_id'] != 0) {
            $bank_customer_qry = mysqli_query($Conn1,"select bank_name from tbl_bank where bank_id = '".$result_customer_qry['bank_id']."'");
            $rs_bank_name = mysqli_fetch_array($bank_customer_qry);
            $sub_doc_name = $rs_bank_name['bank_name']."<br>(".date('M-Y',strtotime($result_customer_qry['start_period']))." to ".date('M-Y',strtotime($result_customer_qry['end_period'])).")";
        }

        $final_template .= "<tr class='center'><td>".$i."</td>
            <td class='orange'>".$doc_name['proof_name']."</td>
            <td>".$sub_doc_name." ".$sub1_doc_name."</td>
            <td>".date('d-M-Y',strtotime($result_customer_qry['date_upload']))."</td>
            <td>".($result_customer_qry['is_verified']=='1'?'Yes':'No')."</td>
            <td>".$result_customer_qry['remarks_ver']."</td></tr>";
    }
    $final_template .= "</tbody></table>";
}

echo $final_template;