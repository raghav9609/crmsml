<?php
$cron_file = 1;
require_once(dirname(__FILE__) . '/../../include/check-session.php');
require_once(dirname(__FILE__) . '/../../include/config.php');
require_once(dirname(__FILE__) . '/../../include/class.mailer.php');
require_once(dirname(__FILE__) . '/../../include/helper.functions.php');
require_once(dirname(__FILE__) . '/../../include/display-name-functions.php');

$user_email_query = "Select DISTINCT user_name,user_id,role_id,email from tbl_user_assign as user INNER JOIN tl_loan_type_assign as loan ON user.user_id = loan.tl_id where user_id NOT IN (19) and is_fos  = 0 and status = 1 and role_id = 3 and loan.loan_type IN (51,54) order by status desc";
               $user_email_result= mysqli_query($Conn1,$user_email_query ) or die("Error :".mysqli_error($Conn1));
               while($user_email_fetch= mysqli_fetch_array($user_email_result)){
               $mlc_user_name = $user_email_fetch['user_name'];
               $mlc_user_id = $user_email_fetch['user_id'];
               $user_role = $user_email_fetch['role_id'];
               $user_email =$user_email_fetch['email'];
               $get_tl_loan_type= array();
               $tl_loan_qry = mysqli_query($Conn1,"select loan_type from tl_loan_type_assign where tl_id = '".$mlc_user_id."'");
	      while($result_loan_qry = mysqli_fetch_array($tl_loan_qry)){
	          $get_tl_loan_type[] = $result_loan_qry['loan_type'];
	      }
	      $tl_loan_type=implode(",",$get_tl_loan_type);
               
$admin_arr = array();
/* Code for primary user starts*/
$update_history_query = "Select app.app_description as description,cse.user_id as user_asign, hstry.app_id as app_id,hstry.pre_login as pre_login,hstry.post_login as post_login,hstry.case_id as case_id,hstry.date as date,hstry.time as time,hstry.user_id as up_date_user,cse.cust_id as cust_id,cse.required_loan_amt as loan_amt,app.app_bank_on as bank_id ,cse.loan_type as loan_type from tbl_application_history as hstry join tbl_mint_case as cse on hstry.case_id = cse.case_id join tbl_mint_app as app on hstry.app_id = app.app_id  where (hstry.pre_login <> 1 or hstry.post_login <> 8 )and hstry.date >= DATE_SUB(CURDATE(),INTERVAL 1 DAY) and cse.user_id = '".$mlc_user_id."' group by app.app_id order by hstry.date Desc,hstry.time DESC";
               $app_history_result = mysqli_query($Conn1,$update_history_query ) or die("Error :".mysqli_error($Conn1));
               $record_count = mysqli_num_rows($app_history_result);
               $mail_temp = "<span style ='color:green;font-weight:bold;font-size:14px;'>".$mlc_user_name." (Primary Cases)</span><table width='100%' style='font-family: verdana,arial,sans-serif;font-size:11px;color:#333333;border-width: 1px;border-color: #666666;border-collapse: collapse;'><th style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>Application ID</th><th style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>Customer Info</th><th style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>Amount</th><th style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>Loan type</th><th style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>Bank Name</th><th style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>Status</th><th style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>Date</th><th style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>Owner/Updated By</th><th style='border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;'>Remarks</th></tr>";
               while($result_app_history_query = mysqli_fetch_array($app_history_result)){
               $app_id = $result_app_history_query['app_id'];
               $case_id = $result_app_history_query['case_id'];
               $pre_login = $result_app_history_query['pre_login'];
               $post_login = $result_app_history_query['post_login'];
               //$time = strtotime($result_app_history_query ['time']);
               $app_bank_id = $result_app_history_query['bank_id'];
               $cust_id = $result_app_history_query['cust_id'];
               $loan_type = $result_app_history_query['loan_type'];
               $loan_amt = $result_app_history_query['loan_amt'];
               $update_by = $result_app_history_query['up_date_user'];
               $user_asign =$result_app_history_query['user_asign'];
               $app_desc =$result_app_history_query['description'];
               $date_time = date("d-M-Y", strtotime($result_app_history_query ['date']))." ".$time;
              
               $pre_status_query = "Select pre_status_name from tbl_app_pre_login where pre_status_id ='$pre_login' and pre_status_id != 6";
               $pre_status_result = mysqli_query($Conn1,$pre_status_query) or die("Error :".mysqli_error($Conn1));
               $pre_status_fetch = mysqli_fetch_array($pre_status_result);
               $pre_status_name = $pre_status_fetch['pre_status_name']; 
               if($pre_status_name == ''){
                      $pre_status_name = get_display_name('snew_status_name',$pre_login);  
                    }
               $post_status_query = "Select app_status from tbl_app_status where app_status_id='$post_login' and app_status_id != 8";
               $post_status_result = mysqli_query($Conn1,$post_status_query) or die("Error :".mysqli_error($Conn1));
               $post_status_fetch = mysqli_fetch_array($post_status_result);
               $post_status_name = $post_status_fetch['app_status'];
               if($post_status_name == ''){
                 $post_status_name = get_display_name('snew_status_name',$post_login);  
               }

               $cust_info_query = "Select name,city_id from tbl_mint_customer_info where id='$cust_id'";
               $cust_info_result = mysqli_query($Conn1,$cust_info_query ) or die("Error :".mysqli_error($Conn1));
               $cust_info_fetch = mysqli_fetch_array($cust_info_result);
               $cust_name = $cust_info_fetch['name']; 
               $cust_city_id = $cust_info_fetch['city_id'];
                           
               $cust_city_query = "Select city_name from  lms_city where city_id='$cust_city_id'";
               $cust_city_result= mysqli_query($Conn1,$cust_city_query ) or die("Error :".mysqli_error($Conn1));
               $cust_city_fetch= mysqli_fetch_array($cust_city_result);
               $cust_city_name=$cust_city_fetch['city_name'];
                              
               $cust_loan_type_query = "Select loan_type_name from lms_loan_type where loan_type_id='$loan_type'";
               $cust_loan_type_result= mysqli_query($Conn1,$cust_loan_type_query ) or die("Error :".mysqli_error($Conn1));
               $cust_loan_type_fetch= mysqli_fetch_array($cust_loan_type_result);
               $cust_loan_type_name=$cust_loan_type_fetch['loan_type_name'];

               $bank_query = "Select bank_name from tbl_bank where bank_id='$app_bank_id'";
               $bank_result= mysqli_query($Conn1,$bank_query) or die("Error :".mysqli_error($Conn1));
               $bank_fetch= mysqli_fetch_array($bank_result);
               $bank_name=$bank_fetch['bank_name'];

               $user_asign_query = "Select user_name from tbl_user_assign where user_id='$user_asign'";
               $user_asign_result= mysqli_query($Conn1,$user_asign_query) or die("Error :".mysqli_error($Conn1));
               $user_asign_fetch= mysqli_fetch_array($user_asign_result);
               $user_name_asign =$user_asign_fetch['user_name'];
  
               $user_name_query = "Select user_name from tbl_user_assign where user_id='$update_by'";
               $user_name_result= mysqli_query($Conn1,$user_name_query) or die("Error :".mysqli_error($Conn1));
               $user_name_fetch= mysqli_fetch_array($user_name_result);
               $user_name_update =$user_name_fetch['user_name'];
               if($user_name_update == ''){
               $user_name_update = "Admin";
               }else{
               $user_name_update = $user_name_update;
               }          
$mail_temp .="<tr><td style='border:1px solid black;'>".$app_id."</td>
     <td style='border:1px solid black;'>".$cust_name." (".$cust_city_name.")</td>
     <td style='border:1px solid black;'>".$loan_amt."</td>
     <td style='border:1px solid black;'>".$cust_loan_type_name."</td>
     <td style='border:1px solid black;'>".$bank_name."</td>
     <td style='border:1px solid black;'>".$pre_status_name."".$post_status_name."</td>
     <td style='border:1px solid black;'>".$date_time."</td>
     <td style='border:1px solid black;'>".$user_name_asign."/".$user_name_update."</td>
     <td style='border:1px solid black;'>".$app_desc."</td></tr>"; }
if($record_count == 0){
$mail_temp .= "<tr><td style='border:1px solid black;text-align:center;' colspan ='9'>Didn't found any updation</td></tr>";
}
/* Code for primary user ends*/


$mail_temp .= "</table><br>";
$user_final_mail = $mail_temp ;

$subject = "Application Updates";
$recep_mail = $replytomail = array($user_email);
$cctomail = array();
mailSend($recep_mail,$cctomail,$replytomail,$subject,$mail_temp);
$admin_mail[] = $user_final_mail;
$email_admin[] = $user_final_mail;
array_push($email_admin,$mlc_user_id);
}
$admin_mail_temp = implode("",$admin_mail);
$subject = "Application Updates";

$recep_mail = $replytomail = array("sanjay.kumar@myloancare.in");
$cctomail = array();
mailSend($recep_mail,$cctomail,$replytomail,$subject,$admin_mail_temp);

$sql_tl = mysqli_query($Conn1,"select user_id,user_name,email,role_id from tbl_user_assign where role_id = 2 and status = 1");
$tl_mail = array();
while($result_tl = mysqli_fetch_assoc($sql_tl)){
    $member_id =array();
    $tl_member_qry = mysqli_query($Conn1,"select user_id from tl_user_assignment where tl_id = '".$result_tl['user_id']."'"); 
	      while($result_member_qry = mysqli_fetch_array($tl_member_qry)){
	          $member_id[] = $result_member_qry['user_id'];
	      }
$user_name_tl = $result_tl['user_name'];
$user_email_tl = $result_tl['email'];
$tl_mail = array();
foreach($member_id as $mem_key => $mem_val){
$key = array_search($mem_val,$email_admin);
$tl_mail[] = $email_admin[$key-1];
}
$user_email_tl = $user_email_tl; 
$final_email_tl = implode("",$tl_mail);
$subject = "Application Updates";

$recep_mail = $replytomail = array($user_email_tl);
$cctomail = array();
mailSend($recep_mail,$cctomail,$replytomail,$subject,$final_email_tl);
}
mysqli_close($Conn);
require_once(dirname(__FILE__) . '/../../include/footer_close.php');
?>