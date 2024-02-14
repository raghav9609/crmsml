<?php 
session_start();
$no_head = 1;
$btn_txt = '';
$goto = '';
global $Conn1;
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
if(requestMethod() != 'POST'){ 
    $status = 'error';
    $message = 'Not on correct page !!!!!!!';
}else if(!empty($_POST['id']) && $_POST['step'] == 0){
    $step = $_POST['step'];
    require_once(dirname(__FILE__) . '/../config/config.php');
    require_once(dirname(__FILE__) . '/../model/loginHelper.php');
    $get_user = new userModel();
    $user_query = $get_user->userDetails(array("email_id = '".$_POST['id']."'"));
    $db_handle = new DBController();
    $user_data = $db_handle->runQuery($user_query);
    // print_r($user_data);
    // echo $_POST['otp']."-----".$user_data[0]['password'];
    if(!empty($user_data) && $user_data[0]['is_active'] == 1){
        if($user_data[0]['is_ip_restriction_enable'] == 0 || ($user_data[0]['is_ip_restriction_enable'] == 1 && ipRestrictionCheck($_SERVER['REMOTE_ADDR']) == 1)){
            $user_password = md5($_POST['otp']);
            // if(password_verify($_POST['otp'], $user_data[0]['password'])){
            if ($user_password === $user_data[0]['password']) {
                $login_history_update = $get_user->updateLoginDateTime($user_data[0]['id'],currentDateTime24());
                $login_history_insert = $get_user->loginHistory(array('crm_master_user_id','login_ip'),array($user_data[0]['id'],$_POST['deviceId']));
                $db_handle->insertRows($login_history_insert);
                $db_handle->updateRows($login_history_update);
                $gettluserList = array();
                $gettlloanList = array();
                $getrmPartnerList = array();
                if($user_data[0]['role_id'] == 2){
                    // $gettluserList = $db_handle->runQuery($get_user->gettlUserList($user_data[0]['id']));
                    // $gettlloanList = $db_handle->runQuery($get_user->gettlloanList($user_data[0]['id']));
                    $user_list_qry = mysqli_query($Conn1, "select * from crm_tl_user_mapping where is_active = 1 and tl_user_id = ".$user_id);
                    $gettluserList = mysqli_fetch_array($user_list_qry);
                    $loan_list_qry = mysqli_query($Conn1, "select * from crm_user_loan_type_mapping where is_active = 1 and user_id = ".$user_id);
                    $gettlloanList = mysqli_fetch_array($loan_list_qry);
                    
                }else if ($user_data[0]['role_id'] == 4){
                    $getrmPartnerList = $db_handle->runQuery($get_user->getrmPartnerList($user_data[0]['id']));
                }
                session_start();
                $_SESSION['userDetails'] = array(
                                                "user_id"=>$user_data[0]['id'],
                                                "user_name"=>$user_data[0]['name'],
                                                "email"=>$user_data[0]['email_id'],
                                                "contact_no"=>$user_data[0]['mobile_no'],
                                                "role_id"=>$user_data[0]['role_id'],
                                                "user_login_datetime"=>$user_data[0]['last_login_on'],
                                                "tluserlist"=>$gettluserList['user_id'],
                                                "tlloanlist"=>$gettlloanList,
                                                "rmpartnerlist"=>$getrmPartnerList
                                            );
                $status = 'success';
                $message = 'Details Fetch Successfully';
                if($user_data[0]['role_id'] == 4){
                    $goto = $head_url."/app/"; 
                }else{
                    $goto = $head_url."/query/"; 
                }
                              
            }else{
                $status = 'error';
                $message = 'Enter Correct Password';  
            }
            
        }else{
            $status = 'error';
            $message = 'You are not authorized to access this CRM account';
        }
    }else{
        $status = 'error';
        $message = 'Enter a Valid UserName';
    }
}
echo json_encode(array("status" => $status, "message" => $message, "step" => $step, "btn_text" => $btn_txt, "goto" => $goto));
?>