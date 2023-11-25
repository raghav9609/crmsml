<?php 
class headerModel {
    function getHeader ($offset, $max_offset, $columns_to_fetch = array("*")){
        $queryReturn = "select ".implode(',',$columns_to_fetch)." from crm_master_header  where id > 0  and status =1 ORDER BY id ASC LIMIT ".$offset.", ".$max_offset;
        return $queryReturn;
    }
	
	function getMainHeader ($user_role,$user,$parent_id=0){
        $queryReturn = "select * from crm_master_header where id > 0 and status =1 AND parent_id = ".$parent_id." AND (find_in_set('".$user_role."',role) OR find_in_set('".$user."',user_id)) ";
		return $queryReturn;
	}

    function updateHeader ($upd_arr, $where=array()){
        $queryReturn = "Update crm_master_header SET " ;
        $comma = " ";
        $query = '';
        foreach($upd_arr as $key => $val) {
            $query .= $comma . $key . " = '" . $val. "'";
            $comma = ", ";
        }
        if(!empty($query)){
            $queryReturn .= $query;
        }
        if(!empty($where)){
            $queryReturn .= " where ".implode(' and ',$where);
        }
        return $queryReturn;
    }
    
    function insertHeader ($insert_arr){
        $queryReturn = "Insert crm_master_header SET " ;
        $comma = " ";
        $query = '';
        foreach($insert_arr as $key => $val) {
                $query .= $comma . $key . " = '" . $val. "'";
                $comma = ", ";
        }
        if(!empty($query)){
            $queryReturn .= $query;
        }
        return $queryReturn;
    }
	
}
    
?>