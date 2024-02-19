<?php
class Auth{
    function apiAuth($source,$api_key,$api_client){
        return "select * from api_credentials where api_name = '".base64_encode(base64_encode($api_client))."' and api_client ='".$source."' and api_key = '".md5($api_key)."'";
    }
}
?>