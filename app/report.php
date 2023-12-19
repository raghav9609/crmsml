<?php
require_once "../../include/crm-header.php";
require_once "../../include/dropdown.php";

$app_new_status     = $_REQUEST['app_new_status'];
$sub_status         = $_REQUEST['sub_status'];
$sub_sub_status     = $_REQUEST['sub_sub_status'];
// if($user == 173) {
//     echo base64_decode($_REQUEST['query']);
// }

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
			var startDate = $("#date_from").datepicker('getDate');
			startDate.setMonth(startDate.getMonth()+1);
            jQuery( this ).datepicker('option', {minDate:jQuery('#date_from').val() ,maxDate:startDate});
        }
    });
  });

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
<body>
<div align="center">
<div class="wrapper">
<form method = "post" name="frmmain" action ="export-app.php" autocomplete="off">
<table width="100%" border="1" cellpadding ="8px" style="border-collapse:collapse;">
<tr>
<td><div style="margin-bottom: 5px;font-weight: bold;">Download Application</div>
<?php echo get_dropdown('bank_name_','bank_rec[]','','multiple');?>
<input type="text" class="text-input" name="from_sanctioned_amount" id="from_sanctioned_amount" placeholder=" From Sanctioned Amount" value="<?php echo $from_loan_amount;?>" size="8"/>
<input type="text" class="text-input" name="to_sanctioned_amount" id="to_sanctioned_amount" placeholder="To Sanctioned Amount" value="<?php echo $to_loan_amount;?>" size="8"/>
<?php echo get_dropdown('loan_type','loan_type',$search,'required');?>
<?php echo get_dropdown('app_pat_list','partnersearch',$patnersearch,'');

// if($user == 173 || $user == 307) {
// if(in_array($user,$user_new_status) || in_array($loan_type,$loan_type_new_status) || new_staus_user_level == 1 || new_staus_loan_type_level == 1) {
 echo get_dropdown('pre_login','app_status_pre','','');
 echo get_dropdown('post_login','app_status_post','','');

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

// } else {
//   echo get_dropdown('pre_login','app_status_pre','','');
//  echo get_dropdown('post_login','app_status_post','','');
// }

echo get_dropdown('user_assign','u_assign',$u_assign,'');?>
<input type="text" class="text-input" name="date_from" id="date_from" placeholder="Date From (yyyy-mm-dd)" value="<?php echo $date_from;?>" required />
<input type="text" class="text-input" name="date_to" id="date_to" placeholder="Date To (yyyy-mm-dd)" value="<?php echo $date_to;?>" required />
<input type="text" class="text-input" name="from_loan_amount" id="from_loan_amount" placeholder="From Loan Amount" value="<?php echo $from_loan_amount;?>" size="8"/>
<input type="text" class="text-input" name="to_loan_amount" id="to_loan_amount" placeholder="To Loan Amount" value="<?php echo $to_loan_amount;?>" size="8"/>
<select name="mobile_verify" id="mobile_verify"><option value="">Mobile Verify</option>
<option value="1">Verified</option>  <option value="0">UnVerified</option></select>
		<input type="submit" id="application" name="application" value="Export" class="cursor"></td>
        </tr>
    </table>
    </form>
</div>
<?php 
if($_REQUEST['msg'] == '1'){
	echo "<div class='f_14 green mt20 '>Report Will Download After Some Time and Display in History Table Below.</div>";
}
?>
</div>
<?php include('../cron/download.php'); ?>
 </body></html>
 <?php require_once "../../include/footer_close.php"; ?>
