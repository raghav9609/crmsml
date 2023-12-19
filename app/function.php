<?php if(isset($_REQUEST['page'])){
		$page = replace_special($_REQUEST['page']);
	}?>

<script src="<?php echo $head_url; ?>/include/js/jquery-1.3.2.min.js" type="text/javascript"></script>
<script>
 function status_on_disb(){
 
	$('#disbursed').hide(); 
	  if($('#status_on').val() == "6" || $("#status_on").val() == "7") {
           $('#disbursed').show(); 
        }     
        
         else{$('#disbursed').hide(); }     
 }
 
 function status_tw_disb(){
 
	  $('#disbursed_tw').hide(); 
	  if($('#status_tw').val() == "6" || $("#status_tw").val() == "7") {
           $('#disbursed_tw').show(); 
        } 
        else{$('#disbursed_tw').hide(); }    
 }
 

 function add_other_bank(){
	$('#adminbox_tw').hide(); 
	$('#adminbox_th').hide(); 
	$('#adminbox_fr').hide(); 

	
	
	if($('#app_bank_tw').val() != "" )
	{
		$('#adminbox_tw').show(); 
		$('#add_bank_on').hide(); 
	document.getElementById("but_add").value = "button_add_another";
		
	}
	
	if($('#app_bank_th').val() != "" )
	{
		$('#adminbox_th').show(); 
		$('#add_bank_tw').hide(); 
		document.getElementById("but_add_tw").value = "button_add_another_tw"; 
	}
	
	if($('#app_bank_fr').val() != "" )
	{
		$('#adminbox_fr').show(); 
		$('#add_bank_th').hide(); 
		
	}

 }

 $(function() {
   
		$('#adminbox_tw').hide();  
		$('#adminbox_th').hide(); 
		$('#adminbox_fr').hide(); 
		
		$('#add_bank_on').click(function(){
        $('#adminbox_tw').show(); 
         document.getElementById("but_add").value = "button_add_another";

      });

$('#add_bank_tw').click(function(){
           $('#adminbox_th').show(); 
document.getElementById("but_add_tw").value = "button_add_another_tw"; 
});
$('#add_bank_th').click(function(){
           $('#adminbox_fr').show(); 

});
 });

 </script>