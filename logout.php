<?php 
    
    
    require_once(dirname(__FILE__) . '/include/constant.php');
    require_once(dirname(__FILE__) . '/helpers/common-helper.php');
    require_once(dirname(__FILE__) . '/config/config.php');	
    session_start();
    $login_ip = ipAddress();
    if (!empty($_SESSION['userDetails']['user_id'])){
        $insert_arr = array(
            "mlc_master_user_id"=>(int)$_SESSION['userDetails']['user_id'],
            "ip"=>$login_ip,
            "login_type"=>2
        );
        $ins_qry = $query_model->insertQueryData('sml_user_login_history',$insert_arr);
        $db_handle->insertRows($ins_qry);
    }
    session_destroy();
    header("Location: https://astechnos.com/crmsml");
    header("location:".$head_url);
    echo '<script>window.location.href = "'.$head_url.'";</script>';
    exit();
?>