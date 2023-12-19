<?php 
$slave = 1;
require_once "../../include/crm-header.php";
require_once "../../include/dropdown.php";
require_once "../../include/display-name-functions.php";
if(isset($_REQUEST['app_no'])) {   
    $app_no = replace_special($_REQUEST['app_no']); 
}
if(isset($_REQUEST['city'])) {
    $city_search = replace_special($_REQUEST['city']); 
}
if(isset($_REQUEST['bank_name_'])) {
    $banksearch = replace_special($_REQUEST['bank_name_']); 
}
if(isset($_REQUEST['pre_login'])) {
    $pre_statussearch = replace_special($_REQUEST['pre_login']); 
}
if(isset($_REQUEST['post_login'])) {
    $app_statussearch = replace_special($_REQUEST['post_login']); 
}
if(isset($_REQUEST['user_fetch'])) {
    $user_fetch = replace_special($_REQUEST['user_fetch']); 
}
if(isset($_REQUEST['date_from'])) { 
    $date_from = replace_special($_REQUEST['date_from']);
}
if(isset($_REQUEST['date_to'])) {  
    $date_to = replace_special($_REQUEST['date_to']);
}
if(isset($_REQUEST['loan_type_value'])) {
    $loan_type_value = replace_special($_REQUEST['loan_type_value']);
}

if(isset($_REQUEST['app_new_status'])) {
    $app_new_status = replace_special($_REQUEST['app_new_status']);
}
if(isset($_REQUEST['sub_status'])) {
    $sub_status = replace_special($_REQUEST['sub_status']);
}
if(isset($_REQUEST['sub_sub_status'])) {
    $sub_sub_status = replace_special($_REQUEST['sub_sub_status']);
}

?>
<!DOCTYPE html>
<html>
<head>
   <link rel="stylesheet" type="text/css" href="../../include/css/jquery-ui.css" />
 <script type="text/javascript" src="../../include/js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="../../include/js/jquery-ui.js"></script>	
 <script>
$(function() {
jQuery('#date_from').datepicker({
changeMonth: true, 
      changeYear: true,
      dateFormat: 'yy-mm-dd',
	    beforeShow : function(){
            jQuery( this ).datepicker('option','maxDate', jQuery('#date_to').val() );
        }
    });
    jQuery('#date_to').datepicker({
changeMonth: true, 
      changeYear: true,
      dateFormat: 'yy-mm-dd',
        beforeShow : function(){
            jQuery( this ).datepicker('option','minDate',    jQuery('#date_from').val() );
        }
    });
  });
  
function resetform() {
window.location.href = "index.php";	
}

function new_qs_change(e, sub_lvl) {
    var level_id = 3;
    var parent_id = e.value;
    var sub_level = sub_lvl;
    var new_status_id = e.id;

    if(parent_id == "") {
        if(new_status_id == "sub_status") {
            $("#sub_sub_status").remove();
        } else if(new_status_id == "app_new_status") {
            $("#sub_status").remove();
            $("#sub_sub_status").remove();
        }
        return;
    }

    $.ajax({
        type: 'POST',
        url: "../insert/sub_status_dropdown.php",
        data: "level_id=" + level_id + "&parent_id=" + parent_id + "&sub_level=" + sub_level,
        async:false,
        success: function(data) {
            console.log(data);
            if(sub_level == 1) {
                $("#sub_status").remove();
                $("#sub_sub_status").remove();
                $("#app_new_status").after(data);
            } else if(sub_level == 2) {
                $("#sub_sub_status").remove();
                $("#sub_status").after(data);
            }
        }
    });
}

</script>
</head>
<?php 
$qry = "SELECT app.sub_sub_status,user.user_name as user_name,bnk.bank_name as bank_name,cust.name as name,cust.mname as mname,cust.lname as lname,city.city_name as city_name, app.app_description as description, hstry.app_id as app_id,app.pre_login_status as pre_login_status, app.app_status_on as app_status_on,cust.id as id,cse.loan_type as loan_type,hstry.case_id as case_id,hstry.date as date,hstry.time as time,hstry.user_id as up_date_user,cse.required_loan_amt as loan_amt, app.app_bank_on as bank_id ,loan.loan_type_name as loan_type_name from tbl_application_history as hstry INNER join tbl_mint_app as app on hstry.app_id = app.app_id INNER join tbl_mint_case as cse on hstry.case_id = cse.case_id INNER join tbl_mint_customer_info as cust on cse.cust_id = cust.id INNER join lms_city as city on cust.city_id = city.city_id INNER join lms_loan_type as loan on cse.loan_type = loan.loan_type_id INNER join tbl_bank as bnk on app.app_bank_on = bnk.bank_id INNER join tbl_user_assign as user on cse.user_id = user.user_id where 1 ";
if($user_role == 3){
    $qry .= " and cse.user_id = '".$user."' ";
}if($user_role == 2 || $user_role == 4){ 
if($user_role == 2){
	$qry .= " and cse.user_id IN (".$tl_member.")";
}
    $qry .= " and cse.loan_type IN (".$tl_loan_type.") ";
}
if($app_statussearch != '') {
    $qry .= "  and hstry.post_login = '".$app_statussearch."'";
}
if($pre_statussearch != '') {
    $qry .= " and hstry.pre_login = '".$pre_statussearch."'";
}
if($app_new_status != "") {
    $default = 1;
    if($sub_sub_status != "" && $sub_sub_status > 0) {
        $qry .= " and hstry.sub_sub_status = $sub_sub_status ";
    } else if($sub_status != "" && $sub_status > 0) {
        $get_statuses = mysqli_query($Conn1, "SELECT GROUP_CONCAT(status_id) AS status_arr FROM status_master WHERE parent_id = $sub_status and level_id = 3 AND is_active_for_filter = 1 ");
        $get_status_result = mysqli_fetch_array($get_statuses)['status_arr'];
        if($get_status_result != "") {
            $status_arr = $get_status_result;
            $qry .= " AND hstry.sub_sub_status IN ($status_arr) ";
        } else {
            $qry .= " AND hstry.post_login = $sub_status ";
        }
    } else {
        $get_statuses = mysqli_query($Conn1, "SELECT GROUP_CONCAT(status_id) AS status_arr FROM status_master WHERE parent_id = $app_new_status AND level_id = 3 AND is_active_for_filter = 1 ");
        $get_status_result = mysqli_fetch_array($get_statuses)['status_arr'];

        if($get_status_result != "") {
            $status_arr = $get_status_result;
            $get_sub_statuses = mysqli_query($Conn1, "SELECT GROUP_CONCAT(DISTINCT(status_id)) AS status_sub_arr FROM status_master WHERE parent_id in ($status_arr) AND level_id = 3 AND is_active_for_filter = 1 ");
            $get_sub_status_result = mysqli_fetch_array($get_sub_statuses)['status_sub_arr'];
            if($get_sub_status_result != "") {
                $status_sub_arr = $get_sub_status_result;
                $qry .= " AND hstry.sub_sub_status IN ($status_sub_arr) ";
            } else {
                $qry .= " AND hstry.post_login IN ($status_arr) ";
            }
        } else {
            $qry .= " AND hstry.pre_login = $app_new_status ";
        }
    }
}

if($banksearch != '') {
    $qry .= " and app.app_bank_on = '".$banksearch."'";
}
if($app_no != '') {
    $qry .= " and app.app_id ='".$app_no."'";
}
if($city_search != '') {
    $qry .= " and cust.city_id = '".$city_search."'";
}
if($user_fetch != '' ) {
    $qry .= " and cse.user_id = '".$user_fetch."'";   
}
if($loan_type_value != "") {
    $default = 1;
    $qry .= " AND cse.loan_type = '".$loan_type_value."' ";
}
if($date_from != "" && $date_to != "" && $date_from != "0000-00-00" && $date_to != "0000-00-00"){$default = 1;
        $qry .= " and app.la_st_up_date between '".$date_from."' and '".$date_to."'";
}if($default != '1'){
        $qry .= " and app.la_st_up_date between DATE_SUB(CURDATE(),INTERVAL 3 DAY) and CURDATE()";
    }
$qry .= " group by app.app_id order by hstry.app_history_id desc limit ".$offset.",".$max_offset;
?>
<fieldset><legend>Application Filter</legend>
<form method="post" action="update-history.php" name="searchfrm" autocomplete="off">
<input type="text" class="text-input" name="app_no" id="app_no" placeholder="Application No" value="<?php echo $app_no;?>" maxlength="15"/>
<?php echo get_dropdown('city','city',$city_search,'');
echo get_dropdown('bank_name_','bank_name_',$banksearch,''); 

if(in_array($user, $user_new_status) || in_array($loan_type,$loan_type_new_status) || new_staus_user_level == 1 || new_staus_loan_type_level == 1) {
// if($user == 173) {
    echo get_dropdown('pre_login','pre_login',$pre_statussearch,'');
    echo get_dropdown('post_login','post_login',$app_statussearch,'');
    echo get_dropdown('app_new_status', 'app_new_status', $app_new_status, 'onchange="new_qs_change(this, 1);"');
    if($app_new_status != "") {
        $get_status_query   = mysqli_query($Conn1, "SELECT status_id, description FROM status_master WHERE level_id = 3 AND parent_id = $app_new_status AND is_active_for_filter = 1 ");
        if(mysqli_num_rows($get_status_query) > 0) {
            ?>
            <select name='sub_status' id='sub_status' onchange="new_qs_change(this, 2);">
                <option value="">Select Sub Status</option>
            <?php
            while($get_status_res = mysqli_fetch_array($get_status_query)) {
                $selected = ($get_status_res['status_id'] == $sub_status) ? "selected" : "";
            ?>
                <option value="<?php echo $get_status_res['status_id']; ?>" <?php echo $selected; ?> ><?php echo $get_status_res['description']; ?></option>    
            <?php
            }
            ?>
            </select>
            <?php
        }

        if($sub_status != "") {
            $get_status_query   = mysqli_query($Conn1, "SELECT status_id, description FROM status_master WHERE level_id = 3 AND parent_id = $sub_status AND is_active_for_filter = 1 ");
            if(mysqli_num_rows($get_status_query) > 0) {
                ?>
                <select name='sub_sub_status' id='sub_sub_status'>
                    <option value="">Select Sub Sub Status</option>
                <?php
                while($get_status_res = mysqli_fetch_array($get_status_query)) {
                    $selected = ($get_status_res['status_id'] == $sub_sub_status) ? "selected" : "";
                ?>
                    <option value="<?php echo $get_status_res['status_id']; ?>" <?php echo $selected; ?> ><?php echo $get_status_res['description']; ?></option>    
                <?php
                }
                ?>
                </select>
                <?php
            }
        } 
    }
} else {
    echo get_dropdown('pre_login','pre_login',$pre_statussearch,'');
    echo get_dropdown('post_login','post_login',$app_statussearch,'');
}
echo get_dropdown('user_assign','user_fetch',$user_fetch,'');
echo get_dropdown('loan_type', 'loan_type_value', $loan_type_value, '');
?>   
<input type="text" class="text-input" name="date_from" id="date_from" placeholder="Date From" value="<?php echo $date_from;?>" maxlength="10"/>
<input type="text" class="text-input" name="date_to" id="date_to" placeholder="Date To" value="<?php echo $date_to;?>" maxlength="10"/>
<input type="submit" name="searchsubmit" value="Filter">                                                 
<input type="submit" onclick="resetform()" value="Clear">
</td></tr></table>                                    
</form>
</fieldset>
 <table width="100%" class="gridtable">
<tr>
<th width="10%">Case No <br>Application No</th>
<th width="10%">Name <br> City</th>
<th width="10%">Loan amount & Loan Type</th>
<th width="10%">Bank Name</th>
<th width="10%">Application Status</th>
<th width="10%">Date</th>
<th width="10%">MLC User/ Updated By</th>
<th width="10%">App Description</th>
<th width="10%">Case Description</th>
</tr>
<?php
 /*if($user == 173){
    echo $qry;
    die();
  }*/   
  $app_history_result = mysqli_query($Conn1,$qry ) or die("Error :".mysqli_error($Conn1));
		$recordcount = mysqli_num_rows($app_history_result);
		if($recordcount > 0){
			$record = 0;
    while($result_app_history_query = mysqli_fetch_array($app_history_result)){
			$record++;
  		if($record > 10){
  			continue;
  	}
               $app_id = $result_app_history_query['app_id'];
               $loan_type = $result_app_history_query['loan_type'];
               $case_id = $result_app_history_query['case_id'];
               $cust_id = $result_app_history_query['id'];
               $pre_login_status = $result_app_history_query['pre_login_status'];
               $app_status_on = $result_app_history_query['app_status_on'];
               $sub_sub_status = $result_app_history_query['sub_sub_status'];
               $loan_amt = ($result_app_history_query['loan_amt'] > 0 && $result_app_history_query['loan_amt'] != "" && is_numeric($result_app_history_query['loan_amt'])) ? custom_money_format($result_app_history_query['loan_amt']) : "--";
               $update_by = $result_app_history_query['up_date_user'];
               $user_name_asign =$result_app_history_query['user_name'];
               $app_desc =$result_app_history_query['description'];
               $date_time = ($result_app_history_query['date'] == "" || $result_app_history_query['date'] == "0000-00-00" || $result_app_history_query['date'] == "1970-01-01") ? "--" : date("d-m-Y", strtotime($result_app_history_query ['date']));
               $cust_name = $result_app_history_query['name']." ".$result_app_history_query['mname']." ".$result_app_history_query['lname']; 
               $cust_city_name = ($result_app_history_query['city_name'] != "") ? "(".$result_app_history_query['city_name'].")" : "";
               $cust_loan_type_name = ($result_app_history_query['loan_type_name'] != "") ? "(".$result_app_history_query['loan_type_name'].")" : "";
               $bank_name=$result_app_history_query['bank_name'];
               
               $user_name_query = "Select user_name from tbl_user_assign where user_id='$update_by'";
               $user_name_result= mysqli_query($Conn1,$user_name_query) or die("Error :".mysqli_error($Conn1));
               $user_name_fetch= mysqli_fetch_array($user_name_result);
               $user_name_update =$user_name_fetch['user_name'];
               $datetime = ($desc_fetch['updatedDate'] != "") ? "(<span class='fs-12' style='color: #0000EE'>".date('d-m-Y h:i A',strtotime($desc_fetch['updatedDate']))."</span>)" : "";

               $name_app_statuson = get_display_name('post_login',$app_status_on);
            if($name_app_statuson == ''){
              $name_app_statuson = get_display_name('snew_status_name',$app_status_on);  
            }
            $name_pre_statuson = get_display_name('pre_login',$pre_login_status);
            if($name_pre_statuson == ''){
              $name_pre_statuson = get_display_name('snew_status_name',$pre_login_status);  
            }
            $sub_status_name = '';
            if($sub_sub_status > 0){
              $sub_status_name = get_display_name('snew_status_name',$sub_sub_status);  
            }
            $final_pre_status_name = (trim($name_pre_statuson) == '') ?'' : $name_pre_statuson;
            $final_app_status_name = (trim($name_app_statuson) == '') ?'' : "/ ".$name_app_statuson;
            $final_sub_status_name = (trim($sub_status_name) == '') ?'' : "/ ".$sub_status_name;

               if($user_name_update == ''){
               $user_name_update = "Admin";
               }else{  $user_name_update = $user_name_update;  }         
               
               $desc_query = mysqli_query($Conn1,"Select CONCAT_WS(' ',date, time) as updatedDate, description as descc from tbl_mint_case_followup where case_id='$case_id' and  case_flag = 1 order by follow_id desc");
               $desc_fetch= mysqli_fetch_array($desc_query);
               
            echo "<tr><td>
			<a href='../cases/edit.php?case_id=".base64_encode($case_id)."' class='has_link'>".$case_id."</a><br><br>
			<a href='edit_applicaton.php?case_id=".urlencode(base64_encode($case_id))."&cust_id=".urlencode(base64_encode($cust_id))."&loan_type=".$loan_type."' class='has_link'>".$app_id."</a></td>
     <td><span class='fs_13'>".name_title_case($cust_name)."</span><br><span class='fs-12'>".$cust_city_name."</span></td>
     <td><span class='fs-13'>".$loan_amt."</span><br><span class='fs-12'>".$cust_loan_type_name."</span></td>
     <td>".$bank_name."</td>
     <td><span class='fs-13'>".$final_pre_status_name.$final_app_status_name.$final_sub_status_name."</span></td>
     <td>".$date_time."</td>
     <td>".name_title_case($user_name_asign)."/ ".name_title_case($user_name_update)."</td>
     <td><span class='fs-11'>".$app_desc."</span></td>
	 <td>".$desc_fetch['descc']."<br>".$datetime."</td></tr>"; }
 ?>
</table>
<?php }if ($recordcount > 0) { ?>
<table width="width:90%;margin-left:4%;" border="0" align="center" cellpadding="4" cellspacing="1" class="pagination">
            <tr class="sidemain">
                <td>
                    <?php
					if($page > 1) {
                        echo "<a class='page gradient' href='update-history.php?page=1&city=$city_search&pre_login=$pre_statussearch&user_fetch=$user_fetch&date_from=$date_from&date_to=$date_to&post_login=$app_statussearch&app_no=$app_no&bank_name_=$banksearch&loan_type_value=$loan_type_value&app_new_status=$app_new_status&sub_status=$sub_status&sub_sub_status=$sub_sub_status'>First</a>";
			            echo "<a class='page gradient' href='update-history.php?page=" . ($page - 1) . "&city=$city_search&pre_login=$pre_statussearch&user_fetch=$user_fetch&date_from=$date_from&date_to=$date_to&post_login=$app_statussearch&app_no=$app_no&bank_name_=$banksearch&loan_type_value=$loan_type_value&app_new_status=$app_new_status&sub_status=$sub_status&sub_sub_status=$sub_sub_status'>Prev</a>";
					}
                    echo "<a class='page gradient' href='javascript:void;'>".$page."</a>";
                    if($recordcount > $display_count) {
                        echo "<a class='page gradient' href='update-history.php?page=".($page+1) ."&city=$city_search&pre_login=$pre_statussearch&user_fetch=$user_fetch&date_from=$date_from&date_to=$date_to&post_login=$app_statussearch&app_no=$app_no&bank_name_=$banksearch&loan_type_value=$loan_type_value&app_new_status=$app_new_status&sub_status=$sub_status&sub_sub_status=$sub_sub_status'>Next</a>";
                    }
                    ?></td>
            </tr>
        </table>
      <?php } ?>	            
   </div>
</body>
</html>
<?php include("../../include/footer_close.php");  ?>