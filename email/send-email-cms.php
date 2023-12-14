<?php
$dialog_pop_up_disabled_flag = 1;
iconv_set_encoding("internal_encoding", "UTF-8");
require_once "../../include/check-session.php";
require_once "../../include/config.php";
require_once "../cms/include/header.php";
require_once "../cms/include/css-call.php";
require_once "../../include/class.sms_helper.php";
require_once "../../include/display-name-functions.php";
$cid    = $_REQUEST['cid'];


$query=mysqli_query($Conn1, "select * from tblcomplaints where complaintNumber='".$cid."'");
$rw = mysqli_fetch_array($query);
$complaintNumber = $rw['complaintNumber'];
$cur_date =  date("Y-m-d");
$query1=mysqli_query($Conn1, "select * from tbl_cms_mail_detail_history where complaintNumber = '".$complaintNumber."' and DATE(created_on) = '".$cur_date."'");
$count_email_exist = mysqli_num_rows($query1);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script src="<?php echo $head_url; ?>/include/js/jquery-1.3.2.min.js" type="text/javascript" type="text/javascript"></script>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
</head>
<body>

<div class="wrapper">
		<div class="container">
			<div class="row">
				<div class="content" <?php if($user_role == 1){?>style="width:100%"<?php }?>>
				<link href="/sugar/all_query/hl-journey/assets/css/grid.css?v=1.1" rel="stylesheet">
<style>
.set-label-pos { display: flex !important;}

.set_amt_frmt {position: absolute;top: 2.5rem;font-size: 13px; width: 100%;text-align: right;right: 15px;color: green!important;}

.cus_phone_icon { top: 38% !important;}
.new-label label:after { top: 4.5px!important; }

.ui-autocomplete { width: 16% !important; text-align: left !important;}

.ui-menu .ui-menu-item { padding: 0px; }
.fa-icon {  font-size: 18px; }
.fa-mobile {  font-size: 25px !important; }
.fa-medium { font-size: 16px !important; }
.col-xl-3 { flex: 0 0 24%; max-width: 24%; }
.valid { width: calc(100% - 30px); top: -18px; background: 0 0; color: #18375F; font-size: 12px; left: 15px;}

.value-exists~label.label-tag {width: calc(100% - 30px);top: -18px;background: 0 0;color: #18375F;font-size: 12px;left: 15px;}
.select {height: 47px!important;width: 114% !important;}
.form-group label{top:2px;}
.select {height: 33px!important;width: 100% !important;}
.cke_skin_kama .cke_wrapper{width:99%!important;}
</style>
        <main> 
            <section class="d-flex flex-wrap">
                <div class="pl-md-3 pl-2 pr-md-3 pr-2 col-12">
				<div class="content">

						<div class="module">
							<div class="module-head">
							<h3>Communications Type</h3>
							</div>

<form name="" method="post" action="">
  <table class="adminbox admintext m-3" width="100%">
    <tr>
      <td><span class="bodytext">Trigger Communications</span></td>
      <td>
		  <style>
			.labelbox {width: 40%;display: inline-block;}
		  </style>
		  <label class="labelbox">
			  <input type="checkbox" readonly name="comm_mode" id="comm_mode1" value="email"/> 
			  <span style="<?php if($count_email_exist>0){ echo 'color:green; font-weight:bold;'; }?> vertical-align: middle;">Email</span>
		  </label>
		  <label class="labelbox">
			  <input type="checkbox"  name="comm_mode" id="comm_mode2" value="sms"/> 
			  <span style="vertical-align: middle;">SMS</span> 
		  </label>
	  </td>
    </tr>
  </table>
</form>
</div>
<div class="module">
<form name="sendemail" id="sendemail" class="hidden form-step col-12" method="post" action="send-email-process-cms.php">
<div class="row div-width">	
<input type = "hidden" name= "comp_no" id="comp_no" value="<?php echo $cust_id;?>">
	 	<input type = "hidden" name= "user_name" id="user_name" value="<?php echo $rw['cust_name']; ?>">
            	<input type =  "hidden" name= "contact_no" id="contact_no" value="<?php echo $rw['phone_no']; ?>">
               	<input type = "hidden" name= "cust_id" id="cust_id" value="<?php echo $cust_id;?>">
               	<input type="hidden"  name="user_email" id="user_email" value="<?php echo $rw['email']; ?>"/>
   <div class="form-group pr-4 col-xl-3">
    <span class="fa-icon fa-user pl-2"></span>
    <input type="text" id="sender_email" name="sender_email" value="<?php echo $rw['email']; ?>" placeholder="Sender Email Id" class="form-control alpha-w-space blank "  maxlength="30">
    <label for="sender_email" class="missed-id-tag label-tag set-label-pos">Sender Email Id</label>
    </div>
	
	<div class="form-group pr-4 col-xl-3">
    <span class="fa-icon fa-user pl-2"></span>
    <input type="text" id="recipient_email" name="recipient_email" placeholder="Recipient Email-id" class="form-control alpha-w-space blank <?php if($rw['email'] != ''){?> Valid <?php } ?>" value="<?php echo $rw['email']; ?>" maxlength="30">
    <label for="recipient_email" class="missed-id-tag label-tag set-label-pos">Recipient Email-id</label>
    </div>
	
	<div class="form-group pr-4 col-xl-3">
    <span class="fa-icon fa-user pl-2"></span>
    <input type="text" id="cc_recipient_email" name="cc_recipient_email" placeholder="CC Email-id " class="form-control alpha-w-space blank"  maxlength="30">
    <label for="cc_recipient_email" class="missed-id-tag label-tag set-label-pos">CC Email-id </label>
    </div>
	
	<div class="form-group pr-4 col-xl-3">
    <span class="fa-icon fa-user pl-2"></span>
    <input type="text" id="name" name="name" placeholder="Name" value="<?php echo $rw['cust_name']; ?>" class="form-control alpha-w-space blank <?php if($rw['cust_name'] != ''){?> Valid <?php } ?>"  maxlength="30">
    <label for="name" class="missed-id-tag label-tag set-label-pos">Name </label>
    </div>
	
	<div class="form-group pr-4 col-xl-3">
    <span class="fa-icon fa-user pl-2"></span>
    <input type="text" id="loan_amount" name="loan_amount" placeholder="Phone Number " value="<?php echo $rw['phone_no']; ?>" class="form-control alpha-w-space blank"  maxlength="30">
    <label for="loan_amount" class="missed-id-tag label-tag set-label-pos">Phone Number  </label>
    </div>
	<div class="form-group pr-4 col-xl-3">
    <span class="fa-icon fa-user pl-2"></span>
    <input type="text" id="loan_type" name="loan_type" placeholder="Complaint Number " value="<?php echo $rw['complaintNumber']; ?>" class="form-control alpha-w-space blank"  maxlength="30">
    <label for="loan_type" class="missed-id-tag label-tag set-label-pos">Complaint Number </label>
    </div>
	
	<div class="form-group pr-4 col-xl-3">
    <span class="fa-icon fa-user pl-2"></span>
    <input type="text" id="city_name" name="city_name" placeholder="City" value="<?php echo $rw['city']; ?>" class="form-control alpha-w-space blank"  maxlength="30">
    <label for="city_name" class="missed-id-tag label-tag set-label-pos">City</label>
    </div>
	
	<div class="form-group pr-4 col-xl-3">
    <span class="fa-icon fa-user pl-2"></span>
    <input type="text" id="loan_type" name="loan_type" placeholder="Complaint Type" value="<?php echo $rw['complaintType']; ?>" class="form-control alpha-w-space blank"  maxlength="30">
    <label for="loan_type" class="missed-id-tag label-tag set-label-pos">Complaint Type</label>
    </div>
	
	
	<div class="form-group pr-4 col-xl-3">
	<span class="fa-icon fa-emptype pl-2"></span>
	<select name="template" id="template" class="form-control select blank" onchange="myMail_function(this.value);" >
		<option value="0">Select Template</option>
		<option value="1">Customer Enquiry</option>
        <option value="2">Complaint Resolved</option>
	</select>
	<label for="template" class="missed-id-tag label-tag set-label-pos">Template </label>
	</div> 
	
	<div class="form-group pr-4 col-xl-3">
    <span class="fa-icon fa-user pl-2"></span>
    <input type="text" id="subject" name="subject" placeholder="Subject" value="Customer Complaint" class="form-control alpha-w-space blank"  maxlength="30">
    <label for="subject" class="missed-id-tag label-tag set-label-pos">Subject</label>
    </div>
	
	
	<div class="form-group pr-4 col-xl-12">
    <p>Description</p>
    <textarea name="description" id="email_query" class="CKeditor"></textarea><?php include('../../include/ckeditor.php');?>
    </div>
	</div>

	 <div class="row div-width">
                                <div class="form group col-xl-5 col-lg-5 col-md-5">
                                </div>
                                <div class="form group col-xl-2 col-lg-2 col-md-2">
                                    <input type="submit" class="btn btn-primary" name="send"  value="Send Email" id="send">
                                </div>
                            </div>
								
   </form>
</div>
<div class="module">
<?php $phone_encode = base64_encode(9871379799); //base64_encode($rw['phone_no']);
$dual_encode = base64_encode($phone_encode); ?>
<form name="sendsms" id="sendsms" method="post" action="" class="hidden form-step col-12">
<input type="hidden"  name="recipient_phone" id="recipient_phone" value="<?php echo $dual_encode; ?>" />
<div class="row div-width">	

<div class="form-group pr-4 col-xl-3">
	<span class="fa-icon fa-emptype pl-2"></span>
	<select name="template2" id="template2" class="form-control select blank" onchange="myMail_function_sms(this.value);" >
		<option>Select Template</option>
		<option value="1">Customer Enquiry</option>
        <option value="2">Complaint Resolved</option>
	</select>
	<label for="template2" class="missed-id-tag label-tag set-label-pos">Template </label>
</div> 


	<div class="form-group col-md-12">
		<textarea style="width:100%;" name="description" id="sms_query" placeholder="Description..."></textarea>
    </div>
</div>	
	<div class="row div-width">
    <div class="form group col-xl-5 col-lg-5 col-md-5"></div>
     <div class="form group col-xl-2 col-lg-2 col-md-2">
                                    <input type="submit" class="btn btn-primary" name="sendsmsapi"  value="Send SMS" id="sendsmsapi">
                                </div>
                            </div>
   </form>

</div>
 </div>   
</div>
</section>
</main>
<br/><br/><br/><br/><br/>
</body>
</html>
<?php 
if($_REQUEST['sendsmsapi']){
  $temp = $_REQUEST['template'];
  $phone = replace_special(base64_decode($_REQUEST['recipient_phone']));
  $new_phone = base64_decode($phone);
  $phone_no = replace_special($new_phone);
  $msg = $_REQUEST['description'];
  $sender_id_acl = 'SHORTTSMSAPI';

   if($phone_no > 6000000000 && $msg != ''){
     callAPI($phone_no,$msg,'SHORTTSMSAPI',2);
   }else {
     callAPI($phone_no,$msg,'SHORTTSMSAPI',1);
   }
}
?>
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
  $("input:checkbox").change(function() {
    var myArray = [];

    $("input:checkbox").each(function() {
        if ($(this).is(":checked")) {
          myArray.push($(this).val());
        }
    });
    if ($.inArray('email', myArray) != -1){
      $("#sendemail").removeClass("hidden");
    }else{
      $("#sendemail").addClass("hidden");
    }

    if ($.inArray('sms', myArray) != -1){
      $("#sendsms").removeClass("hidden");
    }else{
      $("#sendsms").addClass("hidden");
    }
});

function myMail_function(temp_id){
 $.ajax({
			type: "POST",
			data: "temp=" + temp_id,
			url: "sms_temp_cms.php",
			success: function(response)
			{
        CKEDITOR.instances['email_query'].setData(response);
			}
 });   				  		  
} 

function myMail_function_sms(temp_id){
 $.ajax({
			type: "POST",
			data: "temp=" + temp_id,
			url: "sms_temp_cms.php",
			success: function(response)
			{
        $( "#sms_query" ).val(response.trim()) ;
			}
 });   				  		  
} 

function initInputBlur() {
$('input, select').on('blur', function(event) {
var inputValue = this.value;
if (inputValue) {
this.classList.add('value-exists');
} else {
this.classList.remove('value-exists');
}
});
}
initInputBlur();
</script>
<style>
.value-exists~label.label-tag {
	width: calc(100% - 30px);
	top: -18px;
	background: 0 0;
	color: #18375F;
	font-size: 12px;
	left: 15px;
}
</style>
<?php 
include("../../include/script-call.php");
include("../../include/footer_close.php"); 
?>