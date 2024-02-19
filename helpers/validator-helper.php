<?php
if(!function_exists("experainValidator")){
    function experainValidator($data){
        $error = array();
        if($data["level_id"] == 0 || !is_numeric($data["level_id"])){
            $error[] = "invalid level id";
        }
        if($data["lead_id"] == 0 || !is_numeric($data["lead_id"])){
            $error[] = "invalid lead id";
        }
        if($data["product_id"] == 0 || !is_numeric($data["product_id"])){
            $error[] = "invalid product id";
        }
        if($data["customer_id"] == 0 || !is_numeric($data["customer_id"])){
            $error[] = "invalid customer id";
        }
        if($data["mobile_no"] == 0 || !is_numeric($data["mobile_no"]) || strlen($data["mobile_no"]) != 10){
            $error[] = "invalid mobile no";
        }
        if(!filter_var($data["email_id"], FILTER_VALIDATE_EMAIL)) {
            $error[] = "invalid email address";
       }
       if($data["pincode"] < 100000 || !is_numeric($data["pincode"]) || strlen($data["pincode"]) != 6){
            $error[] = "invalid pincode";
       }
       if($data["city_id"] == 0 || !is_numeric($data["city_id"])){
            $error[] = "invalid city id";
       }
       if($data["gender"] == 0 || !is_numeric($data["gender"])){
        $error[] = "invalid gender";
        }
        // if(!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$data["dob"])){
        //     $error[] = "invalid dob";
        // }
        if($data["pan_card"] == '' || !preg_match("/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/", $data["pan_card"])){
            $error[] = "invalid pan Card";
        }
       if($data["name"] == ''){
        $error[] = "invalid name";
      }
       return $error;
    }
}

if(!function_exists("programValidator")){
    function programValidator($data){
        $error = array();
        if($data["level_id"] == 0 || !is_numeric($data["level_id"])){
            $error[] = "invalid level id";
        }
        if(empty($data["offer_type"])){
            $error[] = "invalid offer type";
        }
        if($data["lead_id"] == 0 || !is_numeric($data["lead_id"])){
            $error[] = "invalid lead id";
        }
       return $error;
    }
}

if(!function_exists("bsaValidator")){
    function bsaValidator($data){
        $error = array();
        if($data["level_id"] == 0 || !is_numeric($data["level_id"])){
            $error[] = "invalid level id";
        }
        if($data["lead_id"] == 0 || !is_numeric($data["lead_id"])){
            $error[] = "invalid lead id";
        }
       return $error;
    }
}

if(!function_exists("verifyOtpValidator")){
    function verifyOtpValidator($data){
        $error = array();
        if(empty($data["otp"]) || !is_numeric($data["otp"])){
            $error[] = "invalid otp";
        }
        if(empty($data["otpId"]) || !is_numeric($data["otpId"])){
            $error[] = "invalid otpId";
        }
        if(empty($data["device_token"])){
            $error[] = "invalid device_token";
        }
        if(empty($data["device_type"]) || !in_array(strtolower($data["device_type"]),['android','ios','web'])){
            $error[] = "invalid device_type";
        }
        if(empty($data["email"]) || !filter_var($data["email"], FILTER_VALIDATE_EMAIL)){
            $error[] = "invalid email address";
        }
        if(empty($data["device_id"])){
            $error[] = "invalid device_id";
        }
        if(empty($data["phone_no"]) || !is_numeric($data["phone_no"])){
            $error[] = "invalid phone_no";
        }
        return $error;
    }
}

if(!function_exists("collectionDetailsValidator")){
    function collectionDetailsValidator($data){
        $error = array();
        if(empty($data["cod_id"]) || !is_numeric($data["cod_id"])){
            $error[] = "invalid cod_id";
        }
        if(empty($data["user_id"]) || !is_numeric($data["user_id"]) || $data["user_id"] < 0){
            $error[] = "invalid user_id";
        }
        if(empty(trim($data['latitude']))){
            $error[] = "invalid latitude";
        }
        if(empty(trim($data['longitude']))){
            $error[] = "invalid longitude";
        }
        if(empty(trim($data['address']))){
            $error[] = "invalid address";
        }
       return $error;
    }
}

if(!function_exists("sendPaymentLinkValidator")){
    function sendPaymentLinkValidator($data){
        $error = array();
        if(empty($data["cod_id"]) || !is_numeric($data["cod_id"])){
            $error[] = "invalid cod_id";
        }
        if(empty($data["link_send_by"]) || !is_numeric($data["link_send_by"]) || !in_array($data["link_send_by"],[1,2])){//1 for email, 2 for sms
            $error[] = "invalid link_send_by";
        }
        if(empty($data["method"]) || !in_array($data["method"],['lms-overdue-link','qr_code','foreclosure_link'])){
            $error[] = "invalid method";
        }
        return $error;
    }
}

if(!function_exists("dashboardValidator")){
    function dashboardValidator($data){
        $error = array();
        if(empty($data["user_id"]) || !is_numeric($data["user_id"]) || $data["user_id"] < 0){
            $error[] = "invalid user_id";
        }
        if(empty($data["latitude"]) || !is_numeric($data["latitude"])){
            $error[] = "invalid latitude";
        }
        if(empty($data["longitude"]) || !is_numeric($data["longitude"])){
            $error[] = "invalid longitude";
        }
        if(isset($data["page"]) && (!is_numeric($data["page"]) || $data["page"] < 0)){
            $error[] = "invalid page";
        }
        return $error;
    }
}

if(!function_exists("statusUpdateValidator")){
    function statusUpdateValidator($data){
        $error = array();
        if(empty($data["user_id"]) || !is_numeric($data["user_id"]) || $data["user_id"] < 0){
            $error[] = "invalid user_id";
        }
        if(empty($data["call_status"]) || !is_numeric($data["call_status"])){
            $error[] = "invalid call_status";
        }
        // if(empty($data["collection_done_by"]) || !is_numeric($data["collection_done_by"])){
        //     $error[] = "invalid collection_done_by";
        // }
        if(empty($data["collection_id"]) || !is_numeric($data["collection_id"])){
            $error[] = "invalid collection_id";
        }
        // if($data["collection_done_by"] == 2 && (empty($data["agency_id"]) || !is_numeric($data["agency_id"])) ){
        //     $error[] = "invalid agency_id";
        // }
        // if($data["collection_done_by"] == 2 && (empty($data["agency_user"]) || !is_numeric($data["agency_user"])) ){
        //     $error[] = "invalid agency_user";
        // }
        if(empty(trim($data['remarks']))){
            $error[] = "invalid remarks";
        }
        if(empty(trim($data['latitude']))){
            $error[] = "invalid latitude";
        }
        if(empty(trim($data['longitude']))){
            $error[] = "invalid longitude";
        }
        if(empty(trim($data['address']))){
            $error[] = "invalid address";
        }

        if($data["call_status"] == 9) {
            if(empty(trim($data['emi_paid_through']))){
                $error[] = "invalid emi_paid_through";
            }
        } else{
            if(empty($data["fup_date_time"]) || $data["fup_date_time"] == ""){
                $error[] = "invalid fup_date_time";
            }

            if($data["call_status"] == 3 || $data["call_status"] == 5) {
                if(empty($data["ptp_amount"]) || !is_numeric($data["ptp_amount"])){
                    $error[] = "invalid ptp_amount";
                }
                if(empty($data["ptp_date"]) || $data["ptp_date"] == ""){
                    $error[] = "invalid ptp_date";
                }
            }
        } 
       return $error;
    }
}

if(!function_exists("visitCustomerUpdateValidator")){
    function visitCustomerUpdateValidator($data){
        $error = array();
        if(empty($data["user_id"]) || !is_numeric($data["user_id"]) || $data["user_id"] < 0){
            $error[] = "invalid user_id";
        }
        if(empty($data["visit_options"]) || !is_numeric($data["visit_options"])){
            $error[] = "invalid visit_options";
        }
        if(empty($data["collection_id"]) || !is_numeric($data["collection_id"])){
            $error[] = "invalid collection_id";
        }
        if(empty(trim($data['remarks']))){
            $error[] = "invalid remarks";
        }
        if(empty(trim($data['latitude']))){
            $error[] = "invalid latitude";
        }
        if(empty(trim($data['longitude']))){
            $error[] = "invalid longitude";
        }
        if(empty(trim($data['address']))){
            $error[] = "invalid address";
        } 
        if(empty($data["fup_date_time"]) || $data["fup_date_time"] == ""){
            $error[] = "invalid fup_date_time";
        }   
        if(empty($data["image"])){
            $error[] = "invalid image";
        }   
        if(empty($data["upload_type"])){
            $error[] = "invalid upload type";
        } 
       return $error;
    }
}

if(!function_exists("summaryDetailsValidator")){
    function summaryDetailsValidator($data){
        $error = array();
        if(empty($data["type"]) || !in_array($data["type"],['total_assigned_cases','total_visits'])){
            $error[] = "invalid type";
        }
        if(empty($data["filter"]) || !in_array($data["filter"],['today','last_week','last_month','tomorrow','day_after_tomorrow'])){
            $error[] = "invalid filter";
        }
        if(empty($data["user_id"]) || !is_numeric($data["user_id"])){
            $error[] = "invalid user_id";
        }
        return $error;
    }
}

if(!function_exists("loginValidator")){
    function loginValidator($data){
        $error = array();
        if($data["email_id"] == '' || !filter_var($data["email_id"], FILTER_VALIDATE_EMAIL)) {
            $error[] = "invalid email address";
        }
        return $error;
    }
}

if(!function_exists("statusHistoryValidator")){
    function statusHistoryValidator($data){
        $error = array();
        if(empty($data["lead_id"]) || !is_numeric($data["lead_id"]) || $data["lead_id"] < 0){
            $error[] = "invalid lead id";
        }
        if(empty($data["user_id"]) || !is_numeric($data["user_id"]) || $data["user_id"] < 0){
            $error[] = "invalid user_id";
        }
        if(isset($data["page"]) && (!is_numeric($data["page"]) || $data["page"] < 0)){
            $error[] = "invalid page";
        }
       return $error;
    }
}

if(!function_exists("masterDataValidator")){
    function masterDataValidator($data){
        $error = array();
        if(empty($data["type"])){
            $error[] = "invalid type";
        }
        return $error;
    }
}

if(!function_exists("uploadDataValidator")){
    function uploadDataValidator($data){
        $error = array();
        if(empty($data["cod_id"]) || !is_numeric($data["cod_id"])){
            $error[] = "invalid cod_id";
        }
        if(empty($data["upload_type"])){
            $error[] = "invalid upload type";
        }
        if(empty($data["address"])){
            $error[] = "invalid address";
        }
        if(empty($data["latitude"])){
            $error[] = "invalid latitude";
        }
        if(empty($data["longitude"])){
            $error[] = "invalid longitude";
        }
        if(empty($data["remark"])){
            $error[] = "invalid remark";
        }
        if(empty($data["image"])){
            $error[] = "invalid image";
        }
        return $error;
    }
}

if(!function_exists("notificationListValidator")){
    function notificationListValidator($data){
        $error = array();
        if(empty($data["user_id"]) || !is_numeric($data["user_id"]) || $data["user_id"] < 0){
            $error[] = "invalid user_id";
        }
        if(isset($data["page"]) && (!is_numeric($data["page"]) || $data["page"] < 0)){
            $error[] = "invalid page";
        }
       return $error;
    }
}

if(!function_exists("clicktocallValidator")){
    function clicktocallValidator($data){
        $error = array();
        if(empty($data["lead_id"])){
            $error[] = "invalid lead_id";
        }
        if(empty($data["user_id"])){
            $error[] = "invalid user_id";
        }
        if(empty($data["phone_no"])){
            $error[] = "phone no can not be blank";
        }
        else{
            if(empty($data["phone_no"]) || $data["phone_no"] == 0 || !is_numeric($data["phone_no"]) || strlen($data["phone_no"]) != 10){
                $error[] = "invalid phone no";
            }
        }
        return $error;
    }
}

if(!function_exists("hangupValidator")){
    function hangupValidator($data){
        $error = array();
        if(empty($data["agent_id"])){
            $error[] = "invalid agent_id";
        }
        if(empty($data["unique_id"])){
            $error[] = "invalid unique_id";
        }
        return $error;
    }
}

if(!function_exists("uploadDataValidatorfos")){
    function uploadDataValidatorfos($data){
        $error = array();
        if(empty($data["phone_no"])){
            $error[] = "invalid phone_no";
        }
        
        if(empty($data["selfie_image"])){
            $error[] = "invalid image";
        }
        return $error;
    }
}

if(!function_exists("downloadDataValidatorfos")){
    function downloadDataValidatorfos($data){
        $error = array();
        if(empty($data["phone_no"])){
            $error[] = "invalid phone_no";
        }
        return $error;
    }
}

?>