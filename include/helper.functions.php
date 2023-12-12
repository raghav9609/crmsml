<?php
if(!function_exists('get_dropdown')){
    function get_dropdown($code_id,$name,$selected_val='',$func_call=''){
        global $Conn1;
         $arr = array();
         switch ($code_id){
            case "city":
                $qry = "select id as id,city_name as value,'City' as code_value from crm_master_city where is_active = 1";
            break;
            case "state":
                $qry = "select id as id, state_name as value,'State' as code_value from crm_master_state where is_active = 1";
            break;
            case "user":
                $qry = "select id as id,name as value,'User' as code_value from crm_master_user where is_active = 1";
            break;
            case "user_id_2":
                $qry = "select id as id,name as value,'User' as code_value from crm_master_user where is_active = 1 and role_id = 2";
            break;
            case "user_id_3":
                $qry = "select id as id,name as value,'User' as code_value from crm_master_user where is_active = 1 and role_id = 3";
            break;
            case "user_id_4":
                $qry = "select id as id,name as value,'User' as code_value from crm_master_user where is_active = 1 and role_id = 4";
            break;
            case "crm_master_city_sub_group":
                $qry = "select id as id,city_sub_group_name as value,'City Sub Group' as code_value from crm_master_city_sub_group where is_active = 1";
            break;
            default:
            $qry = "select master.id,master.value,code.value as code_value from crm_masters as master INNER JOIN crm_masters_code as code ON master.crm_masters_code_id = code.id where crm_masters_code_id = ".$code_id." and master.is_active = 1";
            break;
         }
        $data = mysqli_query($Conn1,$qry);
        if(mysqli_num_rows($data) > 0){
            $i=0;
            while($get_data = mysqli_fetch_array($data)){
                $i++;
                if($i == 1){
                    echo "<select name='".$name."' id='".$name."' $func_call><option value= ''>Select ".$get_data['code_value']."</option>";
                }
                echo "<option value='".$get_data['id']."'>".$get_data['value']."</option>";
            }
            echo "</select>";
        }
    }
}

function get_textbox($name, $selected_val, $fun_call)
{
    echo "<input type= 'text' name ='" . $name . "' id ='" . $name . "' value='" . $selected_val . "' " . $fun_call . ">";
}

if(!function_exists('get_name')){
    function get_name($code_id,$id){
        global $Conn1;
         $arr = array();
         switch ($code_id){
            case "city_id":
                $qry = "select * from crm_master_city where id = ".$id;
            break;
            case "city_name":
                $qry = "select * from crm_master_city where city_name = '".$id."'";
            break;
            case "state_id":
                $qry = "select * from crm_master_state where id = ".$id;
            break;
            case "state_name":
                $qry = "select * from crm_master_state where state_name = '".$id."'";
            break;
            case "user_id":
                $qry = "select * from crm_master_user where id = ".$id;
            break;
            
            case "user_name":
                $qry = "select * from crm_master_user where name = '".$id."'";
            break;
            case "crm_master_city_sub_group_id":
                $qry = "select * from crm_master_city_sub_group where id = ".$id;
            break;
            case "crm_master_city_sub_group_name":
                $qry = "select * from crm_master_city_sub_group where city_sub_group_name = '".$id."'";
            break;
            case "master_code_id":
                $qry = "select * from crm_masters where value = '".$id."'";
            break;
            default:
            $qry = "select * from crm_masters as master where id = ".$id;
            break;
         }
        $data = mysqli_query($Conn1,$qry);
        return $data_to_return = mysqli_fetch_assoc($data);

    }
}
?>