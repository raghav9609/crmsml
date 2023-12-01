<?php
if(!function_exists('get_dropdown')){
    function get_dropdown($code_id,$name,$selected_val='',$func_call=''){
        global $Conn1;
         $arr = array();
         switch ($code_id){
            case "city":
                $qry = "select id as id,city_name as value from crm_master_city where is_active = 1";
            break;
            case "state":
                $qry = "select id as id, state_name as value from crm_master_state where is_active = 1";
            break;
            case "user":
                $qry = "select id as id,name as value from crm_master_user where is_active = 1";
            break;
            case "crm_master_city_sub_group":
                $qry = "select id as id,city_sub_group_name as value from crm_master_city_sub_group where is_active = 1";
            break;
            default:
            $qry = "select id,value from crm_masters where crm_masters_code_id = ".$code_id." and is_active = 1";
            break;
         }
        $data = mysqli_query($Conn1,$qry);
        if(mysqli_num_rows($data) > 0){
            echo "<select name='".$name."' id='".$name."' $func_call><option value= ''>Select ".str_replace('_',' ',ucfirst($name))."</option>";
            while($get_data = mysqli_fetch_array($data)){
                echo "<option value='".$get_data['id']."'>".$get_data['value']."</option>";
            }
            echo "</select>";
        }
    }
}
?>