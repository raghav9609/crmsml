<?php
$dialog_pop_up_disabled_flag = 1;
iconv_set_encoding("internal_encoding", "UTF-8");
require_once "../../include/crm-header.php";
$case_id = urldecode(base64_decode($_REQUEST['case_id'])); 
$query_id = urldecode(base64_decode($_REQUEST['query_id'])); 
$source_furl     = $_REQUEST['source'];
$cust_id_furl    = $_REQUEST['cust_id'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script src="<?php echo $head_url; ?>/include/js/jquery-1.3.2.min.js" type="text/javascript" type="text/javascript"></script>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script language="javascript">
function myMail_function(){
var temp_id = $( "#template" ).val() ;
 $.ajax({
			type: "GET",
			data: "temp=" + temp_id+ "&app_id=" + $( "#cust_app_id" ).val()  +"&case_id=<?php echo $case_id; ?>&query_id=<?php echo $query_id; ?>",
			url: "email_query.php",
			success: function(html)
			{
			var data = JSON.parse(html);
                CKEDITOR.instances['email_query'].setData(atob(data.html_temp));
                $("#bank_option").html(data.bank_opt);

                $('.bank_option').click(function (){
                    var id = this.value;
                    document.getElementById(id).disabled = true;
                    CKEDITOR.instances['email_query'].document.$.getElementById(id).remove();

                });
			}
 });   		
  $.ajax({
			type: "POST",
			data: "temp=" + temp_id,
			url: "email_subject.php",
			success: function(html)
			{
			$( "#subject" ).val(html);
			}
 });
}  

function new_myMail_function(e) {
  // CKEDITOR.instances['email_query'].setData(e);
  var cust_id_furl  = "<?php echo base64_decode($cust_id_furl); ?>";
  var cust_query_id = "<?php echo $query_id; ?>";
  var cust_case_id  = "<?php echo $case_id; ?>";

  $.ajax({
		type: "POST",
		data: "type=" + e + "&cust_id=" + cust_id_furl + "&query_id=" + cust_query_id + "&case_id=" + cust_case_id,
		url: "banker_agent_template.php",
		success: function(response) {
		  CKEDITOR.instances['email_query'].setData(response);
		}
  });
}
</script>
</head>
<?php 

if ($query_id != "")
{
$qrycase = "select qry.cust_id as cust_id, qry.loan_type as loan_type, stats.user_id as user_id, qry.loan_amt as loan_amt, qry.loan_emi as loan_emi from tbl_mint_query as qry left JOIN tbl_mint_query_status_detail as stats ON qry.query_id = stats.query_id where qry.query_id = ".$query_id."";
}
else{
$qrycase = "select * from tbl_mint_case where case_id = ".$case_id."";
}
$rescase = mysqli_query($Conn1,$qrycase);
$execase = mysqli_fetch_array($rescase); 
$cust_id = $execase['cust_id'];
$loan_type = $execase['loan_type'];
$user_id = $execase['user_id'];
if ($case_id != "")
{
$ext_emi = $execase['ext_emi'];
$required_loan_amt = $execase['required_loan_amt'];
$secd_user_id = $execase['secd_user_id'];
}
else{
$required_loan_amt = $execase['loan_amt'];
$ext_emi = $execase['loan_emi'];
}
$qrycust = "select * from tbl_mint_customer_info where id = ".$cust_id."";
$rescust = mysqli_query($Conn1,$qrycust);
$execust = mysqli_fetch_array($rescust);
$name = $execust['name'];
$email = $execust['email'];
$city_id = $execust['city_id'];
$salu_id = $execust['salu_id'];
$gold_city = $execust['gold_city'];
$phone = $execust['phone'];

$qrycity = "select * from lms_city where city_id = '".$city_id."'";
$rescity = mysqli_query($Conn1,$qrycity);
$execity = mysqli_fetch_array($rescity);
$city_name = $execity['city_name']; 

$qryuser = "select * from tbl_user_assign where user_id = '".$user_id."'";
$resuser = mysqli_query($Conn1,$qryuser);
$exeuser = mysqli_fetch_array($resuser);
$username = $exeuser['user_name'];
$contact_no = $exeuser['contact_no'];
$user_email = $exeuser['email'];


$qryuser = "select email from tbl_user_assign where user_id = '".$secd_user_id."'";
$resuser = mysqli_query($Conn1,$qryuser);
$exeuser = mysqli_fetch_array($resuser);
$secd_user_email = $exeuser['email'];

$qrysalu = "select * from tbl_saluation where salutn_id = '".$salu_id."'";
$ressalu = mysqli_query($Conn1,$qrysalu);
$exesalu = mysqli_fetch_array($ressalu);
$salutn_name = $exesalu['salutn_name'];

$qryloan = "select * from lms_loan_type where loan_type_id = '".$loan_type."'";
$resloan = mysqli_query($Conn1,$qryloan);
$exeloan = mysqli_fetch_array($resloan);
$loan_name = $exeloan['loan_type_name'];

$qryapp = "select * from tbl_mint_app where case_id = ".$case_id." and (app_status_on = '6' or app_status_on = '7') ";
$resapp = mysqli_query($Conn1,$qryapp);
$exeapp = mysqli_fetch_array($resapp);
$bank_id = $exeapp['app_bank_on'];

$qrybank = "select * from tbl_bank where bank_id = '".$bank_id."'";
$resbank = mysqli_query($Conn1,$qrybank);
$exebank = mysqli_fetch_assoc($resbank);
$bank_name = $exebank['bank_name'];

$qryemail = "select email from tbl_mint_email where id = '2'";
$resultemail = mysqli_query($Conn1,$qryemail);
$rsemail = mysqli_fetch_array($resultemail);
$semail = $rsemail['email'];
$sender_mail = 'MyLoanCare<'.$semail.'>';

if($secd_user_email != '' && $secd_user_email != 0){
$maile_send =  $user_email.','.$secd_user_email ;
}else{
$maile_send =  $user_email ;
}
?>
<body>
<div align="center">
<div class="wrapper">
<form name="sendemail" method="post" action="send-email-process.php">
<table class="adminbox admintext" width="100%">

	 	<input type = "hidden" name= "user" id="user" value="<?php echo $user;?>">
	 	<input type = "hidden" name= "user_name" id="user_name" value="<?php echo $username;?>">
            	<input type =  "hidden" name= "contact_no" id="contact_no" value="<?php echo $contact_no;?>">
             	<input type =  "hidden" name= "salu_name" id="salu_name" value="<?php echo $salutn_name;?>">
            	<input type = "hidden" name= "page" id="page" value="<?php echo $page;?>">
             	<input type = "hidden" name= "ext_emi" id="ext_emi" value="<?php echo $ext_emi;?>">
               	<input type = "hidden" name= "case_id" id="case_id" value="<?php echo $case_id;?>">
               	 <input type = "hidden" name= "query_id" id="query_id" value="<?php echo $query_id;?>">
               	<input type = "hidden" name= "cust_id" id="cust_id" value="<?php echo $cust_id;?>">
               	<input type="hidden"  name="user_email" id="user_email" value="<?php echo $user_email; ?>"/>
               	
  <tr>
    <td><span class="bodytext">Sender Email-id </span></td>
    <td><input type="text" readonly name="sender_email" id="sender_email" value="<?php echo $sender_mail ; ?>"/></td>

     <td><span class="bodytext">Recipient Email-id  </span> </td>
      <td> <input type="text"  name="recipient_email" id="recipient_email" value="<?php echo ($source_furl != "custdoc") ? $email : ""; ?>"/></td>
  </tr>
  
   <tr>
    	<td><span class="bodytext">CC Email-id </span> </td>
         <td> <input type="text" name="cc_recipient_email" id="cc_recipient_email" value="<?php echo ($source_furl != "custdoc") ? $maile_send : "";  ?>" /></td>
          <td><span class="bodytext"> Name </span> </td>
          <td> <input type="text" readonly name="name" id="name" value="<?php echo ($source_furl != "custdoc") ? $name : ""; ?>" /></td>
 
  </tr>
  
  <tr>
    	<td><span class="bodytext">Loan Amount </span> </td>
         <td><input type = "text" readonly name= "loan_amount" id="loan_amount" value="<?php echo $required_loan_amt;?>"></td>
       	
         <td><span class="bodytext"> Loan Type </span> </td>
         <td> <input type="text" readonly name="loan_type" id="loan_type" value="<?php echo $loan_name; ?>" /></td>
 
  </tr>
   <tr>
         <td><span class="bodytext"> City  </span></td>
         <td> <input type="text" name="city_name" id="city_name" readonly value="<?php echo $city_name; ?>" /></td>
        
       <?php if($case_id != ""){ ?>
  <td><span class="bodytext">Select App Id:</span> </td>
<td><select name="cust_app_id" id="cust_app_id" onchange="myMail_function(this.value);">
                    <option value="">Select Application</option>
                <?php $cust_app_qry = "select app.app_id as app_id,bank.bank_name as bank_name from tbl_mint_app as app left join tbl_bank as bank on app.app_bank_on = bank.bank_id where case_id = ".$case_id."";
               $app_cust_bank = mysqli_query($Conn1,$cust_app_qry) or die("Error :".mysqli_error($Conn1));
               while($cust_bank_app = mysqli_fetch_array($app_cust_bank)){
               $appl_no= $cust_bank_app['app_id'];
               ?>
                    <option value="<?php echo $appl_no ;?>"><?php echo $appl_no." (".$cust_bank_app['bank_name'].")";?></option>
                    <?php }?>
                  </select></td>	
<?php } ?>
</tr> 
<tr>
<td><span class="bodytext">Select Template:</span> </td>

<?php if($source_furl != "custdoc") {
$ty_temp_loan_arr = array(51, 54, 56);
?>
         <td><select name="template" id="template" onchange="myMail_function(this.value);">
                    <option value="">Select template</option>
                <?php $sql_mail = "Select temp_id,template_name from tbl_mint_mail_temp where temp_id NOT IN (19) order by temp_id";
               $qry_mail = mysqli_query($Conn1,$sql_mail) or die("Error :".mysqli_error($Conn1));
               while($res_mail = mysqli_fetch_array($qry_mail)){
               $temp_id = $res_mail['temp_id'];
              	$temp_body= $res_mail['temp_body'];
                $template_name = $res_mail['template_name'];
                if($temp_id == 23) {
                  if(in_array($loan_type, $ty_temp_loan_arr)) {
                    ?>
                      <option value="<?php echo $temp_id;?>"><?php echo $template_name ;?></option>
                    <?php
                  }
                } else { ?>
                  <option value="<?php echo $temp_id;?>"><?php echo $template_name ;?></option>
                <?php }
              } ?>
            </select>       
    </td>
<?php } else { ?>
<td>
  <select name="template" id="template" onchange="new_myMail_function(this.value);">
    <option value="">--Select Template--</option>
    <option value="1">Send To Agent</option>
    <option value="2">Send To Banker</option>
  </select>
</td>
<?php } ?>
<td>Subject:- </td><td colspan="5" width="26%"><input type="text" name="subject" id="subject" Placeholder="Subject" size="50" value="<?php echo ($source_furl != 'custdoc') ? '' : 'Document uploaded against customer Id: '.base64_decode($cust_id_furl) ; ?>"/>
</td></tr>
<tr id="bank_option">
</tr>
<tr>
<td>Description:- </td>

<td colspan="5">
<textarea name="description" id="email_query" class="CKeditor" cols="80" rows="10"></textarea><?php include('../../include/ckeditor.php');?>
</td>    
</tr>

    
</tr>
<tr> <td><input type="submit" name="send" id="send" class="buttonsub" value="Send Email"/></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
  

        </table>
   </form>
 </div>   
</div>
<br/><br/><br/><br/><br/>
</body>
</html>
<?php include("../../include/footer_close.php"); ?>