<?php 
$no_head = 1;
$btn_txt = '';
$goto = '';

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
    if(!empty($user_data) && $user_data[0]['is_active'] == 1){
        if($user_data[0]['is_ip_restriction_enable'] == 0 || ($user_data[0]['is_ip_restriction_enable'] == 1 && ipRestrictionCheck($_SERVER['REMOTE_ADDR']) == 1)){
            if(password_verify($_POST['otp'], $user_data[0]['password'])){
                $login_history_update = $get_user->updateLoginDateTime($user_data[0]['id'],currentDateTime24());
                $login_history_insert = $get_user->loginHistory(array('crm_master_user_id','login_ip'),array($user_data[0]['id'],$_POST['deviceId']));
                $db_handle->insertRows($login_history_insert);
                $db_handle->updateRows($login_history_update);
                session_start();
                $_SESSION['userDetails'] = array(
                                                "user_id"=>$user_data[0]['id'],
                                                "user_name"=>$user_data[0]['name'],
                                                "email"=>$user_data[0]['email_id'],
                                                "contact_no"=>$user_data[0]['mobile_no'],
                                                "role_id"=>$user_data[0]['role_id'],
                                                "user_login_datetime"=>$user_data[0]['last_login_on']
                                            );
                $status = 'success';
                $message = 'Details Fetch Successfully';
                $goto = $head_url."/query/";               
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
print_r($_SESSION);
echo json_encode(array("status" => $status, "message" => $message, "step" => $step, "btn_text" => $btn_txt, "goto" => $goto));
?>