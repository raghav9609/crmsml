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
                $qry = "select id as id,name as value,'User' as code_value  from crm_master_user where is_active = 1";
            break;
            case "crm_master_city_sub_group":
                $qry = "select id as id,city_sub_group_name as value,'City Sub Group' as code_value from crm_master_city_sub_group where is_active = 1";
            break;
            default:
            $qry = "select id,value from crm_masters as master,code.value as code_value INNER JOIN crm_masters_code as code ON master.crm_masters_code_id = code.id where crm_masters_code_id = ".$code_id." and is_active = 1";
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
?>