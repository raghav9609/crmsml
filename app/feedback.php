<?php 
require_once "../../include/crm-header.php";
require_once "../../include/dropdown.php";
$app_id = base64_decode($_REQUEST['app_id']);
$qry_fetch_data = mysqli_query($Conn1,"select * from tbl_application_feed_back where app_id='".$app_id."'");
$res_fetch_data = mysqli_fetch_array($qry_fetch_data);
$count = mysqli_num_rows($qry_fetch_data);
if($count > 0){
    $rating = $res_fetch_data['rating'];
	$bank_rating = $res_fetch_data['bank_rating'];
    $connector_attempt = $res_fetch_data['connector_attempt'];
    $rating_made_by = $res_fetch_data['rating_made_by'];
    $cashbck_done = $res_fetch_data['cashback_made'];
    $issues = $res_fetch_data['mlc_experience'];
	$issues_bank = $res_fetch_data['banker_experience'];
    $feed_back = $res_fetch_data['feedback'];
    $follow = $res_fetch_data['follow_up'];
    $follow_date = $res_fetch_data['follow_up_date'];
    $follow_time = $res_fetch_data['follow_up_time'];
    $follow_date_connector = $res_fetch_data['follow_up_date_connector'];
    $follow_time_connector = $res_fetch_data['follow_up_time_connector'];
    $priority_cust = $res_fetch_data['priority_cust'];
	
$issues_bank_arr = explode(",",$issues_bank);
$mlc_issues_arr = explode(",",$issues);
}
?>
<span style='margin:10px;' class='center'>CashBack Feedback</span>
<form name='feed_form' id="feed_form" action='feedback-update.php' method='POST' style='padding:2%;'>
    <input type='hidden' name='application_id' value='<?php echo $app_id;?>'/>
<table class="gridtable" style="margin-left:2%;width:80%;">
<tbody>
<tr><th>MyLoanCare Service</th>
<td width='20%'><select name='rating' class='remov_req' required>
    <option value=''>Select Rating</option>
    <?php for($i='1';$i<=10;$i++){?>
    <option value='<?php echo $i;?>' <?php if($rating == $i){?> selected <?php } ?>><?php echo $i;?></option>
    <?php } ?>
</select></td>
<th>Connector Attempts</th>
<td><select name='conn_attmpt' id='conn_attmpt' required class='remov_req' onchange="opn_follow_date_connector();">
    <option value=''>Select Connector Attempts</option>
<?php $qry_attmt  = mysqli_query($Conn1,"select * from tbl_connector_attempts where type = 1");
    while($res_attmt = mysqli_fetch_array($qry_attmt)){?>
    <option value='<?php echo $res_attmt['id'];?>' <?php if($connector_attempt == $res_attmt['id']){?> selected <?php } ?>><?php echo $res_attmt['connector_response'];?></option>
    <?php } ?>
</select></td>
</tr>
<tr><th>Bank Service</th>
<td width='20%'><select name='bank_rating' class='remov_req' required>
    <option value=''>Select Rating</option>
    <?php for($i='1';$i<=10;$i++){?>
    <option value='<?php echo $i;?>' <?php if($bank_rating == $i){?> selected <?php } ?>><?php echo $i;?></option>
    <?php } ?>
</select></td>
</tr>
<tr><th>FeedBack Made By</th>
<td>
    <input type='radio' value='customer' <?php if($rating_made_by == 'customer'){?> checked <?php } ?> name='feed_given' class='remov_req' required>Customer
    <input type='radio' value='self' <?php if($rating_made_by == 'self'){?> checked <?php } ?> name='feed_given' class='remov_req' required>Self
</td>

<th class='folo_date_connector <?php if($connector_attempt == '' || $connector_attempt == '0' || $connector_attempt == '1' || $connector_attempt == '2'){?>hidden <?php } ?>'>Follow Up Date</th>
<td class='folo_date_connector <?php if($connector_attempt == '' || $connector_attempt == '0' || $connector_attempt == '1' || $connector_attempt == '2'){?>hidden <?php } ?>'><input type="text" name="fol_date_connector" id="fol_date_connector"  class='fol_date' placeholder="yyyy-mm-dd" autocomplete="off" style="display: inline-block;" 
value='<?php if( $follow_date_connector != '0000-00-00'){echo $follow_date_connector;}?>' ></td>

</tr>
<tr><th>Referral Provided By Customer</th>
<td><input type='radio' name='pri_cust' value='Y' <?php if($priority_cust == 'Y'){?> checked <?php } ?> class='remov_req' required>Yes
<input type='radio' name='pri_cust' value='N' <?php if($priority_cust == 'N'){?> checked <?php } ?> class='remov_req' >No</td>

<th class='folo_time_connector <?php if($connector_attempt == '' || $connector_attempt == '0' || $connector_attempt == '1' || $connector_attempt == '2'){?> hidden <?php } ?>'>Follow Up Time</th>
<td class='folo_time_connector <?php if($connector_attempt == '' || $connector_attempt == '0' || $connector_attempt == '1' || $connector_attempt == '2'){?> hidden <?php } ?>'><input type="text" name="fol_time_connector" id="fol_time_connector" class='fol_time' placeholder="Follow Up Time" autocomplete="off" style="display: inline-block;" 
value='<?php if($follow_time_connector != '00:00:00'){echo $follow_time_connector;}?>' ></td>

</tr>
<tr><th>Cashback Made</th>
<td colspan='3'><input type='radio' name='cshbck' value='Y' <?php if($cashbck_done == 'Y'){?> checked <?php } ?> class='remov_req' required>Yes
<input type='radio' name='cshbck' value='N' <?php if($cashbck_done == 'N'){?> checked <?php } ?> class='remov_req'>No</td></tr>
<tr><th>Customer Experience with MLC</th>
<td colspan='3'>
<select name="issue[]" id="issue" multiple class='remov_req' required>
<?php $qry_mlc_issue = mysqli_query($Conn1,"select id,issue_face from tbl_feed_back_issue where flag = 1");
	    while($result_mlc_issue = mysqli_fetch_array($qry_mlc_issue)){?>		
		<option value="<?php echo $result_mlc_issue['id'];?>" <?php if(in_array($result_mlc_issue['id'],$mlc_issues_arr)){echo "selected"; } ?> ><?php echo $result_mlc_issue['issue_face'];?></option>	
		<?php } ?>
		</select>
</td></tr>

<tr><th>Customer Experience with Bank</th>
<td colspan='3'><select name="issue_bank[]" id="issue_bank" multiple class='remov_req' required>
<?php $qry_mlc_issue = mysqli_query($Conn1,"select id,issue_face from tbl_feed_back_issue where flag = 2");
	    while($result_mlc_issue = mysqli_fetch_array($qry_mlc_issue)){?>		
		<option value="<?php echo $result_mlc_issue['id'];?>" <?php if(in_array($result_mlc_issue['id'],$issues_bank_arr)){echo "selected"; } ?> ><?php echo $result_mlc_issue['issue_face'];?></option>	
		<?php } ?>
		</select></td></tr>
<tr><th>Follow Up</th>
<td colspan='3'><?php echo get_dropdown('feedback_follow_up','follow',$follow,'onchange="opn_follow_date();"');?></td>
</tr>
<tr <?php if($follow == '' || $follow == '0'){?>class='hidden' <?php } ?> id='folo_date'><th>Follow Up Date</th>
<td colspan='3'><input type="text" name="fol_date" id="fol_date" class='fol_date' placeholder="yyyy-mm-dd" autocomplete="off" style="display: inline-block;" 
value='<?php if( $follow_date != '0000-00-00'){echo $follow_date;}?>' ></td>
</tr>
<tr <?php if($follow == '' || $follow == '0'){?>class='hidden' <?php } ?> id='folo_time'><th>Follow Up Time</th>
<td colspan='3'><input type="text" name="fol_time" id="fol_time" class='fol_time' placeholder="Follow Up Time" autocomplete="off" style="display: inline-block;" 
value='<?php if($follow_time != '00:00:00'){echo $follow_time;}?>' ></td>
</tr>
<tr>
    <th >Send Email To User</th>
    <td colspan='3'><input type="radio" name="send_mail" value='Y'> Yes
    <input type="radio" name="send_mail" value='N' checked> No</td>
</tr>
<tr><th>FeedBack</th>
<td colspan='3'><textarea name='feed_desc' class='remov_req' required rows="8" cols="100"/><?php echo $feed_back;?></textarea></td></tr>
<?php if($count > 0){?>
<tr><th colspan="4"><input type="submit" class="buttonsub" name="update" id="update" value="Update"></th></tr>
<?php } else {?>
<tr><th colspan="4"><input type="submit" class="buttonsub" name="submit" id="submit" value="SUBMIT"></th></tr>
<?php } ?>
</tbody>
</table>
</form>
<?php require_once "../../include/footer_close.php"; ?>
<link rel="stylesheet" href="../../include/css/jquery-ui.css">
<script type="text/javascript" src="../../include/js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="../../include/js/jquery-ui.js"></script>	
<script type="text/javascript" src="../../include/js/jquery.timeentry.js"></script>		
<script>
$(function() { 
   $( ".fol_date" ).datepicker({
     minDate: '0',
      changeMonth: true, 
      changeYear: true,
      dateFormat: 'yy-mm-dd',
      onClose: function( selectedDate ) {
      $(".fol_date" ).datepicker( "option", "maxDate", selectedDate );
      }
    }).val();
    
    	$('.fol_time').timeEntry();
});
     function opn_follow_date(){
       var value = $("select#follow option:selected").val();
	 
       if(value != ''){
		   $(".remov_req").removeAttr('required');
           $("#folo_date,#folo_time").removeClass("hidden");
		   $("#fol_date,#fol_time").addAttr('required');
       } else {
           $("#fol_date,#fol_time").val("").removeAttr('required');
           $("#folo_date,#folo_time").addClass("hidden");
		   $(".remov_req").addAttr('required');
		   
       }
    } 

     function opn_follow_date_connector(){
       var value_connector = $("select#conn_attmpt option:selected").val();
       if(value_connector == '3' || value_connector == '4'){
           $(".folo_date_connector,.folo_time_connector").removeClass("hidden");
		   $(".fol_date_connector,.fol_time_connector").addAttr('required');
       } else {
           $("#fol_date_connector,#fol_time_connector").val("").removeAttr('required');
           $(".folo_date_connector,.folo_time_connector").addClass("hidden");
       }
    }  
</script>