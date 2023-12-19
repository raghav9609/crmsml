<?php 
$slave = 1;
require_once "../../include/crm-header.php";
require_once "../../include/dropdown.php";
require_once "../../include/display-name-functions.php";
if(!in_array($user_role,array(1,2,3,4,5,6))){
  header("location:../../logout.php");
}
if(isset($_REQUEST['app_no'])) {   
    $app_no = replace_special($_REQUEST['app_no']); 
}
if(isset($_REQUEST['case_no'])) {   
    $case_no = replace_special($_REQUEST['case_no']); 
}
if(isset($_REQUEST['user_fetch'])) {
    $user_fetch = replace_special($_REQUEST['user_fetch']); 
}
if(isset($_REQUEST['date_from'])) { 
    $date_from = replace_special($_REQUEST['date_from']);
}
if(isset($_REQUEST['date_to'])) {  
    $date_to = replace_special($_REQUEST['date_to']);
}if(isset($_REQUEST['user_fetch'])) {
    $user_fetch = replace_special($_REQUEST['user_fetch']); 
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
  window.location.href = "history.php";	
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
$qry = "select cse.c_follow_time,cse.case_id,hist.app_id,cse.user_id,cse.loan_type,cse.cust_id,cse.case_status,cse.c_follow_date,CONCAT_WS(' ',cust.name,cust.lname) as name,city.city_name from tbl_application_history as hist INNER JOIN tbl_mint_case as cse ON hist.case_id = cse.case_id INNER JOIN tbl_mint_customer_info as cust ON cse.cust_id = cust.id INNER JOIN lms_city as city ON cust.city_id = city.city_id where hist.date >= DATE_SUB(CURDATE(),INTERVAL 4 DAY) and CONCAT_WS('',pre_login,post_login) NOT IN (10110,18,10) and pre_login > 0 ";
if($user_role == 3){
    $qry .= " and cse.user_id = '".$user."' ";
}
if($user_role == 2 || $user_role == 4){ 
  if($user_role == 2){
  	$qry .= " and cse.user_id IN (".$tl_member.")";
  }
  if($tl_loan_type != '' ){
    $qry .= " and cse.loan_type IN (".$tl_loan_type.") ";
  }
}
if($app_no != '') {
    $qry .= " and hist.app_id ='".$app_no."'";
}
if($case_no != '') {
    $qry .= " and hist.case_id ='".$case_no."'";
}
if($app_new_status != "") {
    $default = 1;
    if($sub_sub_status != "" && $sub_sub_status > 0) {
        $qry .= " and hist.sub_sub_status = $sub_sub_status ";
    } else if($sub_status != "" && $sub_status > 0) {
        $qry .= " AND hist.post_login = $sub_status ";
    } else {
        $qry .= " AND hist.pre_login = $app_new_status ";
    }
}
if($user_fetch != '' ) {
    $qry .= " and cse.user_id = '".$user_fetch."'";   
}
if($date_from != "" && $date_to != "" && $date_from != "0000-00-00" && $date_to != "0000-00-00"){$default = 1;
        $qry .= " and hist.date between '".$date_from."' and '".$date_to."'";
}
 $qry .= " group by hist.app_id order by hist.app_history_id desc limit ".$offset.",".$max_offset;
?>
<fieldset><legend>Application Filter</legend>
<form method="post" action="history.php" name="searchfrm" autocomplete="off">
  <input type="text" class="text-input" name="case_no" id="case_no" placeholder="Case ID" value="<?php echo $app_no;?>" maxlength="15"/> 
<input type="text" class="text-input" name="app_no" id="app_no" placeholder="Application No" value="<?php echo $app_no;?>" maxlength="15"/>   
<input type="text" class="text-input" name="date_from" id="date_from" placeholder="Last feedback date from" value="<?php echo $date_from;?>" maxlength="10"/>
<input type="text" class="text-input" name="date_to" id="date_to" placeholder="Last feedback date to" value="<?php echo $date_to;?>" maxlength="10"/>
<?php if(in_array($user, $user_new_status) || in_array($loan_type,$loan_type_new_status) || new_staus_user_level == 1 || new_staus_loan_type_level == 1) {
// if($user == 173) {
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
echo get_dropdown('user_assign','user_fetch',$user_fetch,'');?>
<input class="cursor" type="submit" name="searchsubmit" value="Filter">                                                 
<input class="cursor" type="button" onclick="resetform()" value="Clear">
</td></tr></table>                                    
</form>
</fieldset>
 <table width="100%" class="gridtable">
  <tr>
<th colspan="2">Case</th>
<th colspan="4">Application</th>
<th rowspan="2">Action</th>

</tr>
<tr>
<th>Case No./ Name/ Location</th>
<th>Case Status</th>
<!-- <th>Application ID</th> -->
<th>Bank/ Partner</th>
<th>Last Feedback</th>
<th>Last Feedback By</th>
<th>Application Status</th>
</tr>
<?php
 /*if($user == 173){
    echo $qry;
    die();
  } */  
  $app_history_result = mysqli_query($Conn1,$qry ) or die("Error :".mysqli_error($Conn1));
		$recordcount = mysqli_num_rows($app_history_result);
		if($recordcount > 0){
			$record = 0;
    while($result_app_history_query = mysqli_fetch_array($app_history_result)){
			$record++;
  		if($record > 10){
  			continue;
  	}
    $case_status = ' - ';
    if($result_app_history_query['case_status'] > 0){
      $case_status = get_display_name('new_status_name',$result_app_history_query['case_status']);
    }


      $case_fup_date = (!in_array($result_app_history_query['c_follow_date'],array('1970-01-01','0000-00-00')))?date('d-m-Y',strtotime($result_app_history_query['c_follow_date'])):' - ';
      $c_follow_time = (!in_array($result_app_history_query['c_follow_time'],array('00:00:00')))?date('h:i a',strtotime($result_app_history_query['c_follow_time'])):' - ';

      $check_mint_case_follow = mysqli_query($Conn1,"select app_id from tbl_mint_case_followup  where case_id=".$result_app_history_query['case_id']." order by follow_id DESC LIMIT 1");
                    if(mysqli_num_rows($check_mint_case_follow) > 0){
                        $result_follow_date = mysqli_fetch_assoc($check_mint_case_follow);
                    }
      
              $get_no_of_app = mysqli_query($Conn1,"select app.la_st_up_date,app.app_id,bank.bank_name,pat.partner_name,app.app_description,app.pre_login_status,app.app_status_on,app.sub_sub_status from tbl_mint_app as app INNER JOIN tbl_bank as bank ON app.app_bank_on = bank.bank_id INNER JOIN tbl_mlc_partner as pat ON app.partner_on = pat.partner_id where case_id = ".$result_app_history_query['case_id']); 
              $total_application = mysqli_num_rows($get_no_of_app);
              $count_imp_0 = $count_imp_n0 = '';
              if($total_application > 0){
                $count=0;
                  while($result_application_qry = mysqli_fetch_assoc($get_no_of_app)){
                    $app_follow_date = '';
                    if($result_follow_date['app_id'] == $result_application_qry['app_id']){
                      $app_follow_date =  $case_fup_date." ". $c_follow_time;
                    }

                    $get_updated_by_user = mysqli_query($Conn1,"select user.user_name,user.is_fos,user.role_id from tbl_application_history as hist INNER JOIN tbl_user_assign as user ON hist.user_id = user.user_id where hist.app_id = ".$result_application_qry['app_id']." order by hist.app_history_id DESC limit 1");
                    $app_created_by = 'System';
                    $is_fos_c = 0;
                    $app_user_role = 1;
                    $result_updated_by_user = mysqli_fetch_assoc($get_updated_by_user);
                    if($result_updated_by_user['user_name'] != ''){
                      $app_created_by = $result_updated_by_user['user_name'];
                      $is_fos_c = $result_updated_by_user['is_fos'];
                      $app_user_role = $result_updated_by_user['role_id'];
                    }

                    if($is_fos_c == 1){
                      $bc_color = "#87c387";
                    }else if($app_user_role == 3){
                      $bc_color = "#c5c59f";
                    }else{
                      $bc_color = "#f3aa26";
                    }

                    $final_status = '';
                    $name_app_statuson = get_display_name('post_login',$result_application_qry['app_status_on']);
                    if($name_app_statuson == ''){
                      $name_app_statuson = get_display_name('snew_status_name',$result_application_qry['app_status_on']);  
                    }
                    $name_pre_statuson = get_display_name('pre_login',$result_application_qry['pre_login_status']);
                    if($name_pre_statuson == ''){
                      $name_pre_statuson = get_display_name('snew_status_name',$result_application_qry['pre_login_status']);
                    }
                    if($sub_sub_status > 0){
                      $sub_status_name = get_display_name('snew_status_name',$result_application_qry['sub_sub_status']);  
                    }
                    $final_status = $name_pre_statuson;
                    if($name_app_statuson != ''){
                       $final_status .= "/ ".$name_app_statuson;
                    }
                    if($sub_status_name != ''){
                       $final_status .= "/ ".$sub_status_name;
                    }
                    $borde = '';
                    if($result_app_history_query['app_id'] == $result_application_qry['app_id']){
                      $borde = 'color:##322480;font-weight:bold;';
                    }
                    $app_url = "edit_applicaton.php?case_id=".base64_encode($result_app_history_query['case_id'])."&app_id=".base64_encode($result_application_qry['app_id'])."&cust_id=".base64_encode($result_app_history_query['cust_id'])."&loan_type=".$result_app_history_query['loan_type'];
                    if($count == 0){
                      /*<td style='background-color:".$bc_color.";".$borde."border-bottom: 1px solid black;'>".$result_application_qry['app_id']."</td>*/
                      $count_imp_0 .= "<td style='background-color:".$bc_color.";".$borde."border-bottom: 1px solid black;'>".$result_application_qry['bank_name']."/ ".$result_application_qry['partner_name']."<br>".$app_follow_date."</td><td style='border-bottom: 1px solid black;background-color:".$bc_color.";".$borde."'>".$result_application_qry['app_description']."</td><td style='border-bottom: 1px solid black;background-color:".$bc_color.";".$borde."'>".$app_created_by."<br>".date('d-m-Y',strtotime($result_application_qry['la_st_up_date']))."</td><td style='border-bottom: 1px solid black;background-color:".$bc_color.";".$borde."'>".$final_status." <span class='cursor f_16' onclick='call_case_status(".$result_app_history_query['case_id'].",3,".$result_app_history_query['cust_id'].",".$result_app_history_query['loan_type'].",".$result_app_history_query['app_id'].");'>&#9997;</span></td><td style='border-bottom: 1px solid black;background-color:".$bc_color.";".$borde."'><a href='".$app_url."' target='_blank' class='has_link'><input type='button' class='pointer_n' value='View' style='border-radius: 5px; background-color: #18375f; font-weight: bold;'></a></td>";
                    }else{
                      $count_imp_n0 .= "<tr><td style='background-color:".$bc_color.";".$borde."border-bottom: 1px solid black;'>".$result_application_qry['bank_name']."/ ".$result_application_qry['partner_name']."<br>".$app_follow_date."</td><td style='border-bottom: 1px solid black;background-color:".$bc_color.";".$borde."'>".$result_application_qry['app_description']."</td><td style='border-bottom: 1px solid black;background-color:".$bc_color.";".$borde."'>".$app_created_by."<br>".date('d-m-Y',strtotime($result_application_qry['la_st_up_date']))."</td><td style='border-bottom: 1px solid black;background-color:".$bc_color.";".$borde."'>".$final_status." <span class='cursor f_16' onclick='call_case_status(".$result_app_history_query['case_id'].",3,".$result_app_history_query['cust_id'].",".$result_app_history_query['loan_type'].",".$result_app_history_query['app_id'].");'>&#9997;</span></td><td style='border-bottom: 1px solid black;background-color:".$bc_color.";".$borde."'><a href='".$app_url."' target='_blank' class='has_link'><input type='button' class='pointer_n' value='View' style='border-radius: 5px; background-color: #18375f; font-weight: bold;'></a></td></tr>";
                    }
                    $count++;
                  }
              }
              
          ?>
               
            <tr>
              <td rowspan="<?php echo $total_application; ?>"><a href="../cases/edit.php?case_id=<?php echo base64_encode($result_app_history_query['case_id']); ?>"><?php echo $result_app_history_query['case_id']."</a><br>".$result_app_history_query['name']."<br>".$result_app_history_query['city_name']; ?></td>
              <td rowspan="<?php echo $total_application; ?>"><?php echo $case_status." <span class='cursor f_16' onclick='call_case_status(".$result_app_history_query['case_id'].",2,".$result_app_history_query['cust_id'].",".$result_app_history_query['loan_type'].",".$result_app_history_query['app_id'].");'>&#9997;</span><br>".$case_fup_date." ".$c_follow_time; ?></td>
                  <?php echo $count_imp_0; ?>
            </tr>
              <?php echo $count_imp_n0; } ?>
</table>
<?php }if ($recordcount > 0) { ?>
<table width="width:90%;margin-left:4%;" border="0" align="center" cellpadding="4" cellspacing="1" class="pagination">
            <tr class="sidemain">
                <td>
                    <?php
					if($page > 1) {
                        echo "<a class='page gradient' href='history.php?page=1&date_from=$date_from&date_to=$date_to&app_no=$app_no&user_fetch=$user_fetch&app_new_status=$app_new_status&sub_status=$sub_status&sub_sub_status=$sub_sub_status&case_no=$case_no'>First</a>";
			            echo "<a class='page gradient' href='update-history.php?page=" . ($page - 1) . "&date_from=$date_from&date_to=$date_to&app_no=$app_no&user_fetch=$user_fetch&app_new_status=$app_new_status&sub_status=$sub_status&sub_sub_status=$sub_sub_status&case_no=$case_no'>Prev</a>";
					}
                    echo "<a class='page gradient' href='javascript:void;'>".$page."</a>";
                    if($recordcount > $display_count) {
                        echo "<a class='page gradient' href='history.php?page=".($page+1) ."&date_from=$date_from&date_to=$date_to&app_no=$app_no&user_fetch=$user_fetch&app_new_status=$app_new_status&sub_status=$sub_status&sub_sub_status=$sub_sub_status&case_no=$case_no'>Next</a>";
                    }
                    ?></td>
            </tr>
        </table>
      <?php } ?>	            
   </div>
   <?php
   $heading_pop_up = 'Application Status';
   include("../insert/status-dialog.php");
   ?>
</body>
</html>
<script>
  function call_case_status(lead_id,level_id,cust_id,loan_type_id,appli_id){
     $("#dialog-step").html("");
     if(level_id == 2){
      $.ajax({
        type:"POST",
        data:"lead_id="+lead_id,
        url:"../insert/case-status-pop-up.php",
        success:function(response){
           $("#popup1").addClass("popup-overlay");
           $("#dialog-step").html(response);
        }
      })
     }else if(level_id == 3){
      $.ajax({
        type:"POST",
        data:"case_id="+btoa(lead_id)+"&cust_id="+btoa(cust_id)+"&app_id="+btoa(appli_id)+"&loan_type="+loan_type_id,
        url:"../insert/app-popup.php",
        success:function(response){
           $("#popup1").addClass("popup-overlay");
           $("#dialog-step").html(response);
        }
      })
     }
  }
</script>
<?php include("../../include/footer_close.php");  ?>