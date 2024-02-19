<?php
require_once "../../include/check-session.php";
require_once "../../include/config.php";

$q_up="select cust.id as id,cust.name as name,cust.phone as phone,cse.date_created as date_created,cse.case_id as case_id,cse.loan_type	as loan_type from tbl_mint_customer_info as cust JOIN tbl_mint_case as cse on cust.id=cse.cust_id where cust.phone IN(".implode(',',$mobile).")";   
                       $result_q = mysqli_query($Conn1,$q_up);
		       while($res_q = mysqli_fetch_array($result_q)){			
			$name=$res_q['name']; 			
			$case_id=$res_q['case_id'];
			$phone=$res_q['phone'];
                        $cust_id=$res_q['id'];
                        $loan_type=$res_q['loan_type'];
			$lead_created=$res_q['date_created']; 
			//$app_id='11'.$loan_type.$case_id;
			$l_key= array_search($phone, $mobile);
			
$q_app= "select bank_crm_lead_on,app_id from tbl_mint_app where case_id='$case_id' and app_bank_on = '11' and (bank_crm_lead_on='0' OR bank_crm_lead_on='') order by date_created ASC";
			$result_app = mysqli_query($Conn1,$q_app);			
		$fetch_app = mysqli_fetch_array($result_app);
		$app_id = $fetch_app['app_id'];
	if( mysqli_num_rows($result_app) > 0) {
	$home_loan_data[]="<tr id='tr_".$app_id."'><td><input type='checkbox' id='lead_check' name='lead_check[]' class='selectedId' value='".$app_id."'></td><td><a href = '../app/edit_applicaton.php?case_id=".urlencode(base64_encode($case_id))."&cust_id=".urlencode(base64_encode($cust_id))."&loan_type=".$loan_type."' target='_blank' class='app_data'>".$name."</a></td><td>".$phone."</td><td>".$app_id."</td><td><input type='text' value='".$lead_no[$l_key]."' name='lead_".$app_id."' id='lead_id' class='trans_box' style='width:200px;' readonly/></td><td>".$lead_created."</td></tr>";	
		
	}		
}

if(!empty($home_loan_data)){
$tbl="<table width='100%' class='preview '><tr><th colspan='6'><input type='submit' value='Update' class='update_button' onclick='return check_validate();' name='update'></th></tr> 
<tr><th><input type='checkbox' id='selectall' value=''>Select all</th><th>Name</th><th>Mobile No.</th><th>Application ID</th><th>New Lead No.</th><th>Lead created date</th>";
$fnl_home_loan_data = implode("",$home_loan_data);
echo $final_home_loan_data = $tbl.$fnl_home_loan_data."</table>";
}else{
$err_tbl="<table width='100%' class='preview'>
<tr><th>Select all</th><th>Name</th><th>Mobile No.</th><th>Application ID</th><th>New Lead No.</th><th>Lead created date</th>";
$error_msg="<tr><th colspan='6'>No Record Found In Database !!</th></tr>";
 ?>
<script>
sweetAlert("Oops...</span>", "No record found in databse !!", "error");			
</script>

<?php
echo $err_tbl.$error_msg."</table>";
}
?>

<script type="text/javascript">

function check_validate() {
 if (!$("[id^=lead]").is(':checked')) {
        sweetAlert("Oops...</span>", "Please select checkbox for update Lead-ID!", "error");
        return false;
    }
update_data();
}


$(document).ready(function () {
    $('#selectall').click(function () {
        $('.selectedId').prop('checked', this.checked);
    });

    $('.selectedId').change(function () {
        var check = ($('.selectedId').filter(":checked").length == $('.selectedId').length);
        $('#selectall').prop("checked", check);
    });
});

function update_data() {       
  var lead_check=new Array;    
    var lead_id=new Array;
    $('#lead_check:checked').each(function() {
        if ($(this).is(':checked')) {
                var current = $(this).val();
               lead_id.push($(this).parents("tr").find("#lead_id").val())
               }
    lead_check.push($(this).val());
    });    
var json_lead_check = JSON.stringify(lead_check);
var json_lead_id = JSON.stringify(lead_id);
var check_count= $('#lead_check:checked').length;           
        $.ajax({
                    type: "POST",                                      
                    url: "update_lead_data.php",                  
                    data: 'lead_check='+json_lead_check+'&lead_id='+json_lead_id+'&check_count='+check_count,                    
                    cache: false,                                                           
                    success: function(response) {
                       swal("Update successfully!!", check_count + " Bank CRM/Lead Id updated.","success");                                                                      
                       $('#lead_check:checked').each(function() {
                       var cache = $(this).closest('tr');
                        cache.fadeOut(600, function(){
                              cache.remove();
                            });
                       });                                                                      
                    }                   
                  }); 
                }
</script>
