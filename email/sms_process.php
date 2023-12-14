<?php
if($phone_no != 9870500558) {

    $ch = curl_init();
    $receipientno = $phone_no;
    $msgtxt = "" . $msg;
    curl_setopt($ch, CURLOPT_URL, "http://api.mVaayoo.com/mvaayooapi/MessageCompose");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "user=corporate@myloancare.in:loancare18&senderID=MLCARE&receipientno=$receipientno&msgtxt=$msgtxt");
    $buffer = curl_exec($ch);
    if (empty ($buffer)) {
        $status_from_mvayoo = " buffer is empty ";
    } else {
        $status_from_mvayoo = $buffer;
    }
    curl_close($ch);
    if ($bnk_campaing != '1') {
        $insert_msg_record = mysqli_query($Conn1, "insert into tbl_cust_message set description='" . $msg_desc . "',case_id = '" . $case_id . "',query_id = '" . $query_id . "', cust_contact_no = '" . $phone_no . "', mlc_user_id = '" . $user . "', temp_id = '" . $temp . "', msg = '" . $msg . "', date = CURDATE(),qry_flag = '" . $qry_flag . "',vendor='mvaayoo',senderid='MLCARE',status_from_vendor='" . base64_encode($status_from_mvayoo) . "',time = CURTIME()") or die(mysqli_error($Conn1));
    }
}
?>