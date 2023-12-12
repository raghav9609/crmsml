<?php 
require_once "../../include/check-session.php";
require_once "../../include/config.php";
$case_id = replace_special($_REQUEST['case_id']);
$pat_id = replace_special($_REQUEST['pat_id']);
$cs_index = replace_special($_REQUEST['cs_index']);
$cust_qry = mysqli_query($Conn1,"select cust.name as name,cust.lname as lname,cust.dob as dob, cust.phone as phone,cust.pan_card as pan_card,loan.loan_type_name,city.city_name from tbl_mint_case as cse left join tbl_mint_customer_info as cust on cse.cust_id = cust.id join lms_loan_type as loan on cse.loan_type = loan.loan_type_id join lms_city as city on cust.city_id = city.city_id where cse.case_id = ".$case_id."");
$result_qry = mysqli_fetch_array($cust_qry);
$name = $result_qry['name'];
$lname = $result_qry['lname'];
$phone = $result_qry['phone'];
$dob = $result_qry['dob'];
$loan_name = $result_qry['loan_type_name'];
$city_name = $result_qry['city_name'];
$pan_card = $result_qry['pan_card'];
?>
<style>
.text-intent{
    font-size:14px!important;
    font-weight:600;
}
.pop-up{position: fixed;
    top: 28%;
    left: 38%;
    width: 380px;
    height: 250px;
    z-index: 5;
    padding: 5px;
    border-radius: 5px;
    box-shadow: 0 0 21px #444;
    background: linear-gradient(to bottom,#f8fbfd 20%,#fbedd1 55%);
    text-align: center;}
	.pop-up .close_li {font-family: sans-serif;
    color: #0C2950;
    z-index: 2;
    font-size: 27px;
    font-weight: bold;
    position: absolute;
    right: 8px;
    margin-top: -5px;
    cursor: pointer;}
	.btn,.btn1{float: left;margin: 3% 8%;width: 90px;padding: 1%;color:#fff;}.btn{background-color: #2767BA;}.btn1{background-color: #EB9B42;}
</style>
<div id="modal">
<div class="pop-up">
<div id="close_li" class="close_li" onclick="leaveintent_fun();">x</div>
<div id=''>
    <form name='cust_verification' id="cust_verification" action="">
        <div class="text text-intent"><b>Phone No.:</b><span class='blue'><b> <?php echo $phone; ?> </b></span></div>
<div class="text text-intent"><b>Name: </b> <span class='blue'><b><input type='text' name='name' id='name' value="<?php echo $name; ?>" style='width:34%;'> <input type='text' name='lname' id='lname' value="<?php echo $lname; ?>"></b></span></div>

<div class="text text-intent"><b>DOB (DD-MM-YYYY): </b><span class='blue'><b> <input type="text" name = "dob" id = "dob" value="<?php echo date('d-m-Y',strtotime($dob)); ?>"> </b></span></div>
<div class="text text-intent"><b>Pan Card: </b> <input type='text' name='pancard' id='pancard' value="<?php echo trim($pan_card); ?>">
</div>
<input type="button" name="yes" value="With Cibil" class="btn bnk_intent" onclick="cibil_sc('1');">
<input type="button" name="no" value="Without Cibil" class="btn1 bnk_intent" onclick="cibil_sc('2');">
<input type='hidden' id='pat_class' value='0'>
</div>
<div style="clear:both"></div>
<div id="link_redirect" style='display:none;'>
Please use IDFC portal to access Cibil
<!--<a href='https://consumer.cibil.com/<?php echo base64_encode($phone); ?>' target="_blank" onclick='leaveintent_fun();'>Cibil</a>-->
</div>
</div>
</div>
<script>
var ver;
var chng_contact;
function cibil_sc(btn){    
    var txtpan = $("#pancard").val();
    var name = $("#name").val();
    var lname = $("#lname").val();
    var dob = $("#dob").val();
    var city = '<?php echo $city_name; ?>';
    if(name =='' || name.length < 3){
        alert("Enter First Name");
    }else if(lname ==''){
         alert("Enter Second Name");
    }else if(dob == '' || dob == '00-00-0000'){
        alert("Enter Valid DOB");
    }else if(!txtpan.match(/[a-zA-z]{5}\d{4}[a-zA-Z]{1}/) || txtpan.length != '10' || txtpan == ''){
        alert("Not a valid PAN number")
    }else{
        
         if(btn != 2){
		    $("#pat_class").val("<?php echo $pat_id; ?>");
		        var $input = $("<input type='checkbox' name='sms_contact[]' value='9810031952##"+city+"' checked=''/> 9810031952 (Dheeraj Mahajan)<br>");
		        var $input1 = $("<input type='checkbox' name='partner_email[]' class='42' value='42##dheeraj.mahajan@IDFCBANK.COM##"+city+"' checked=''/>dheeraj.mahajan@IDFCBANK.COM<br>");
                $(".bnk_intent").hide();
                $("#link_redirect").show();
                $("#pat_class").val("0");
		        $("#cibil_flag").val("1");
                //$(".idfc_pl_sms").text("");
                $(".idfc_pl_sms").append($input);
                //$(".idfc_pl_email").text("");
                $(".idfc_pl_email").append($input1);
                chng_contact = '1';
		    }else{
		        chng_contact = '0';
		        leaveintent_fun();
		    }
    }
 }
function leaveintent_fun(){
    var pat_class = $("#pat_class").val();
    var cs_index = '<?php echo $cs_index;?>';
document.getElementById('id01').style.display = 'none';
 if(pat_class != 0){
        $(".idfc_pl").click();
    }else{
        if(cs_index == 1){
            window.location.href="<?php echo $head_url; ?>/sugar/lead/pl-bl-leads.php?case_id=<?php echo $case_id; ?>&pat_id=<?php echo $pat_id; ?>&chng_contact="+chng_contact;
        }else{
            $("#edit_cust").css('pointer-events','');
        }
    }
}
</script>