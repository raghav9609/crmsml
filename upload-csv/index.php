<?php
$no_head=1;

require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../config/config.php');
require_once(dirname(__FILE__) . '/../include/constant.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../include/header.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Upload File</title>
	<link rel="stylesheet" href="<?php echo $head_url; ?>/assets/css/multiselect.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $head_url; ?>/assets/css/style.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $head_url; ?>/assets/css/jquery-ui.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $head_url; ?>/assets/css/cms.style.css" />
	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
    <body>

	<div class="pl-md-3 pl-2 pr-md-3 pr-2 col-12">
    
    <div class="gen-box white-bg">
    <div class="blue-bg col-12 font-weight-nb pb-2 pt-2 white font-20 brdr-top-gray pe-none" data-toggle="step1" id="switch_step1">
			<!-- <h2><?php //if($message){echo "<span class='".$class."'>".$message ."</span>";} else { echo "";}?></h2> -->
		<!-- </div> -->
			<div class="color-bar-2 color-bg"></div>
			<h3 style = "background-color: #18375f;color:#ffffff;text-align:center;">Upload File</h3>
				<div class="boxview">
					<div class="tablebox">
						<div class="tablecolum">
							<label>Upload File:</label>
							<input type="file" name="upload_files" id="upload_files" accept=".csv" required/>
						</div>
					
						<div class="tablecolum text-center padding-fixbox trigger-varibale-new">	
								
							<input type="submit" class="cursor buttonsub" name="upload_csv" id="upload_csv" value="upload">		
							
							<input class="cursor buttonsub" type="button" onclick="resetform('<?php echo $head_url; ?>/upload-csv/')" value="Clear">
						
							<input type='button' name='download_format' value='Download Format' id='download_format' class='buttonsub ml10 cursor'  onclick="download_csv_format_sms_trigger()"/>
							<!-- <a href="trigger-variable.php"><input type="button" class="cursor buttonsub " name="Variables" id="Variable" value="variable"></a> -->
						</div>
					</div>							
				</div>
			<h3 id="heading" style="display: none;">List of Data</h3>
			<div class="addon" style="display: none;" id="csv_file_data"></div>
		</div>
	</div>
	</div>
	<?php include("../../include/footer.php");?>
	</body>
</html>
<?php include('../main-js-css-insert.php');?>	


<script>
function download_csv_format_sms_trigger() {
    var csv = 'Name,Email_id,Phone_no,Pincode,Loan_Amount,Dob,Net_Income' ;
    var hiddenElement = document.createElement('a');
    hiddenElement.href = 'data:text/csv;charset=utf-8,' + encodeURI(csv);
    hiddenElement.target = '_blank';
    hiddenElement.download = 'upload-csv-data.csv';
    hiddenElement.click();
}

function resetform(path){
    window.location.href = path;
}


$(document).on('click', '#import_data', function () {
		if ($('.checkbox:checked').length > 0) {
			var arr =[];
        
			$('.checkbox:checked').each(function(i) {
                arr.push($(this).val());
				});
				var count          = arr.length;
				var mobile_no     =  [];
				var email_id        =  [];
				var var1        =  [];
				var var2        =  [];
				var var3           =  [];
				var var4         =  [];
				var var5      =  [];
				var var6          =  [];
				var var7        =  [];
				var var8          =  [];
				var var9        =  [];
				var var10          =  [];
				var sms_trigger_on =  [];
				var is_sms_triggered        =  [];
				var transaction_id     =  [];
				var sms_text     =  [];
				var url     =  [];
				var var_url     =  [];
				var source     =  [];
				var sms_type     =  [];
				var purpose     =  [];
				var temp_name     =  [];
				var communication_type     =  [];
				var mlc_master_communication_trigger_instant_id     =  [];
				var status_from_api     =  [];
				var api_request     =  [];
				var api_response     =  [];
				var cli     =  [];
				var callstatus     =  [];
				var callstarttime     =  [];
				var Campaignname     =  [];
				var callduration     =  [];
				var msisdn     =  [];
				var callreferenceid     =  [];
				var callendtime     =  [];
				var param1     =  [];
				var image_url     =  [];
				var statusdescription     =  [];
				var send_type     =  [];
				var schedule_date_from     =  [];
				var schedule_date_to     =  [];
				var whatsapp_type     =  [];
				var trigger_type     =  [];
				var mlc_campaign_send_sms_id     =  [];
				var schedule_datetime     =  [];
				var handsetTime     =  [];
				var failed_code     =  [];

				for(i=0; i<arr.length; i++){
					mobile_no[i] =$('.mobile_no'+arr[i]).val();
					email_id[i] =$('.email_id'+arr[i]).val();
					var1[i] =$('.var1'+arr[i]).val();
					var2[i] =$('.var2'+arr[i]).val();
					var3[i] =$('.var3'+arr[i]).val();
					var4[i] =$('.var4'+arr[i]).val();
					var5[i] =$('.var5'+arr[i]).val();
					var6[i] =$('.var6'+arr[i]).val();
					var7[i] =$('.var7'+arr[i]).val();
					var8[i] =$('.var8'+arr[i]).val();
					var9[i] =$('.var9'+arr[i]).val();
					var10[i] =$('.var10'+arr[i]).val();
					sms_trigger_on[i] =$('.sms_trigger_on'+arr[i]).val();
					is_sms_triggered[i] =$('.is_sms_triggered'+arr[i]).val();
					transaction_id[i] =$('.transaction_id'+arr[i]).val();
					sms_text[i] =$('.sms_text'+arr[i]).val();
					url[i] =$('.url'+arr[i]).val();
					var_url[i] =$('.var_url'+arr[i]).val();
					source[i] =$('.source'+arr[i]).val();
					sms_type[i] =$('.sms_type'+arr[i]).val();
					purpose[i] =$('.purpose'+arr[i]).val();
					temp_name[i] =$('.temp_name'+arr[i]).val();
					communication_type[i] =$('.communication_type'+arr[i]).val();
					mlc_master_communication_trigger_instant_id[i] =$('.mlc_master_communication_trigger_instant_id'+arr[i]).val();
					status_from_api[i] =$('.status_from_api'+arr[i]).val();
					api_request[i] =$('.api_request'+arr[i]).val();
					api_response[i] =$('.api_response'+arr[i]).val();
					cli[i] =$('.cli'+arr[i]).val();
					callstatus[i] =$('.callstatus'+arr[i]).val();
					callstarttime[i] =$('.callstarttime'+arr[i]).val();
					Campaignname[i] =$('.Campaignname'+arr[i]).val();
					callduration[i] =$('.callduration'+arr[i]).val();
					msisdn[i] =$('.msisdn'+arr[i]).val();
					callreferenceid[i] =$('.callreferenceid'+arr[i]).val();
					callendtime[i] =$('.callendtime'+arr[i]).val();
                    param1[i] =$('.param1'+arr[i]).val();
                    image_url[i] =$('.image_url'+arr[i]).val();
					send_type[i] =$('.send_type'+arr[i]).val();
					statusdescription[i] =$('.statusdescription'+arr[i]).val();
					schedule_date_from[i] =$('.schedule_date_from'+arr[i]).val();
					schedule_date_to[i] =$('.schedule_date_to'+arr[i]).val();
					whatsapp_type[i] =$('.whatsapp_type'+arr[i]).val();
					trigger_type[i] =$('.trigger_type'+arr[i]).val();
					mlc_campaign_send_sms_id[i] =$('.mlc_campaign_send_sms_id'+arr[i]).val();
					schedule_datetime[i] =$('.schedule_datetime'+arr[i]).val();
					handsetTime[i] =$('.handsetTime'+arr[i]).val();
					failed_code[i] =$('.failed_code'+arr[i]).val();
				}
				var chkvalue=$("input[name='checkbox']:checked").val();

				// alert(temp_name+"abc"+purpose)
				$.ajax({
				url:"add.php",
				method:"POST",
				data: {mobile_no :mobile_no,email_id :email_id,var1 :var1,var2:var2,var3:var3,var4:var4,var5 :var5,var6:var6,var7 :var7,var8 :var8,var9 :var9,var10 :var10,sms_trigger_on :sms_trigger_on,is_sms_triggered :is_sms_triggered,transaction_id :transaction_id,sms_text :sms_text,url :url,var_url :var_url,source :source,sms_type :sms_type,purpose :purpose,temp_name :temp_name,communication_type :communication_type,mlc_master_communication_trigger_instant_id :mlc_master_communication_trigger_instant_id,status_from_api :status_from_api,api_request :api_request,api_response :api_response,cli :cli,callstatus :callstatus,callstarttime :callstarttime,Campaignname :Campaignname,callduration :callduration,msisdn :msisdn,callreferenceid :callreferenceid,callendtime :callendtime,param1:param1,image_url:image_url,send_type :send_type,statusdescription :statusdescription,schedule_date_from :schedule_date_from,schedule_date_to :schedule_date_to,whatsapp_type :whatsapp_type,trigger_type :trigger_type,mlc_campaign_send_sms_id :mlc_campaign_send_sms_id,schedule_datetime :schedule_datetime,handsetTime :handsetTime,failed_code :failed_code},
                beforeSend: function () {
                    $("#import_data").val('processing....');
                    $("#import_data").attr('disabled','disabled');
                },
				success:function(data)
                
				{
                    console.log(data);
                    alert(data);
                    if (data && data.status === 'error') {
                        if (data && data.message === null ) {
                            data.message = "Duplicate Entry";
                        } else {
                            data.message = data.message;
                        }
                        const insertData = data.insert_Data || "";
                       
                        data_show = data.message+" "+ "Total Row Insert (" + insertData +")";
                        Swal.fire({
                            title: 'Error',
                            text: data_show,
                            icon: 'error'
                        }).then(function() {
                            window.location.href = '';
                        });
                    } else if (data && data.status === 'success' ) {
                        const message = data.message || "";
                        const insertData = data.insert_Data || "";

                        data_show = message +" "+ "Total Row Insert (" + insertData +")";
                        Swal.fire({
                            title: 'Success',
                            text: data_show,
                            icon: 'success',
                            timer: 5000
                        }).then(function() {
                            window.location.href = '';
                        });
                    }else {
                        Swal.fire({
                            title: 'error',
                            text: data,
                            icon: 'error',
                            timer: 5000
                        }).then(function() {
                            window.location.href = '';
                        });
                        
                    }

				}
				});
        }else{
                Swal.fire({
                    title: 'error',
                    text: "Please select any checkbox",
                    icon: 'error',
                    timer: 5000
                })
                }
	});

	let currentPage = 1;
	let display_count = 50;
    function updateTable(page, dataLength, data) {
        
		$('#csv_file_data').html("");
		let start = (page - 1) * display_count;
    	let end = Math.min(start + display_count, data.length);
        

		html = '<div class="row"><div class="col-md-48 "><table class="table"><tbody><tr class="updatec"><th colspan="48-48" class="align:center" style="text-align:center;"><button type="button" id="import_data" class="cursor buttonsub"  >Add</button></tr></tbody></table</div>';
		html += '<table class="table">';
		html += '<tr><th><input name="product_all" class="checked_all" type="checkbox" value="as" onClick="toggle(this)"> Select All</th><th>Mobile No</th><th>Email ID</th><th>Var1</th><th>Var2</th><th>Var3</th><th>Var4</th><th>Var5</th><th>Var6</th><th>Var7</th><th>Var8</th><th>Var9</th><th>Var10</th><th>SMS Trigger On</th><th>Is SMS Triggered</th><th>Transaction ID</th><th>SMS Text</th><th>URL</th><th>Var URL</th><th>Source</th><th>SMS Type</th><th>Purpose</th><th>Temp Name</th><th>Communication Type</th><th>MLC Master Communication Trigger Instant ID</th><th>Status From API</th><th>API Request</th><th>API Response</th><th>CLI</th><th>Call Status</th><th>Call Start Time</th><th>Campaign Name</th><th>Call Duration</th><th>MSISDN</th><th>Call Reference ID</th><th>Call End Time</th><th>Param1</th><th>Image URL</th><th>Status Description</th><th>Send Type</th><th>Schedule Date From</th><th>Schedule Date To</th><th>WhatsApp Type</th><th>Trigger Type</th><th>MLC Campaign Send SMS ID</th><th>Schedule Datetime</th><th>Handset Time</th><th>Failed Code</th></tr>';

		for (let count = start; count < end; count++) {
			let row = data[count];
            html += '<tr><td><input type="checkbox" value="'+count+'" id="'+count+'" name="chkbox" class="checkbox" onClick="toggle1()"><input type="hidden" value="'+row.mobile_no+'" class="mobile_no'+count+'"><input type="hidden" value="'+row.email_id+'" class="email_id'+count+'"><input type="hidden" value="'+row.var1+'" class="var1'+count+'"><input type="hidden" value="'+row.var2+'" class="var2'+count+'"><input type="hidden" value="'+row.var3+'" class="var3'+count+'"><input type="hidden" value="'+row.var4+'" class="var4'+count+'"><input type="hidden" value="'+row.var5+'" class="var5'+count+'"><input type="hidden" value="'+row.var6+'" class="var6'+count+'"><input type="hidden" value="'+row.var7+'" class="var7'+count+'"><input type="hidden" value="'+row.var8+'" class="var8'+count+'"><input type="hidden" value="'+row.var9+'" class="var9'+count+'"><input type="hidden" value="'+row.var10+'" class="var10'+count+'"><input type="hidden" value="'+row.sms_trigger_on+'" class="sms_trigger_on'+count+'"><input type="hidden" value="'+row.is_sms_triggered+'" class="is_sms_triggered'+count+'"><input type="hidden" value="'+row.transaction_id+'" class="transaction_id'+count+'"><input type="hidden" value="'+row.sms_text+'" class="sms_text'+count+'"><input type="hidden" value="'+row.url+'" class="url'+count+'"><input type="hidden" value="'+row.var_url+'" class="var_url'+count+'"><input type="hidden" value="'+row.source+'" class="source'+count+'"><input type="hidden" value="'+row.sms_type+'" class="sms_type'+count+'"><input type="hidden" value="'+row.purpose+'" class="purpose'+count+'"><input type="hidden" value="'+row.temp_name+'" class="temp_name'+count+'"><input type="hidden" value="'+row.communication_type+'" class="communication_type'+count+'"><input type="hidden" value="'+row.mlc_master_communication_trigger_instant_id+'" class="mlc_master_communication_trigger_instant_id'+count+'"><input type="hidden" value="'+row.status_from_api+'" class="status_from_api'+count+'"><input type="hidden" value="'+row.api_request+'" class="api_request'+count+'"><input type="hidden" value="'+row.api_response+'" class="api_response'+count+'"><input type="hidden" value="'+row.cli+'" class="cli'+count+'"><input type="hidden" value="'+row.callstatus+'" class="callstatus'+count+'"><input type="hidden" value="'+row.callstarttime+'" class="callstarttime'+count+'"><input type="hidden" value="'+row.Campaignname+'" class="Campaignname'+count+'"><input type="hidden" value="'+row.callduration+'" class="callduration'+count+'"><input type="hidden" value="'+row.msisdn+'" class="msisdn'+count+'"><input type="hidden" value="'+row.callreferenceid+'" class="callreferenceid'+count+'"><input type="hidden" value="'+row.callendtime+'" class="callendtime'+count+'"><input type="hidden" value="'+row.param1+'" class="param1'+count+'"><input type="hidden" value="'+row.image_url+'" class="image_url'+count+'"><input type="hidden" value="'+row.statusdescription+'" class="statusdescription'+count+'"><input type="hidden" value="'+row.send_type+'" class="send_type'+count+'"><input type="hidden" value="'+row.schedule_date_from+'" class="schedule_date_from'+count+'"><input type="hidden" value="'+row.schedule_date_to+'" class="schedule_date_to'+count+'"><input type="hidden" value="'+row.whatsapp_type+'" class="whatsapp_type'+count+'"><input type="hidden" value="'+row.trigger_type+'" class="trigger_type'+count+'"><input type="hidden" value="'+row.mlc_campaign_send_sms_id+'" class="mlc_campaign_send_sms_id'+count+'"><input type="hidden" value="'+row.schedule_datetime+'" class="schedule_datetime'+count+'"><input type="hidden" value="'+row.handsetTime+'" class="handsetTime'+count+'"><input type="hidden" value="'+row.failed_code+'" class="failed_code'+count+'"></td>';


			html += '<td>' + row.mobile_no + '</td>';
			html += '<td>' + row.email_id + '</td>';
			html += '<td>' + row.var1 + '</td>';
			html += '<td>' + row.var2 + '</td>';
			html += '<td>' + row.var3 + '</td>';
			html += '<td>' + row.var4 + '</td>';
			html += '<td>' + row.var5 + '</td>';
			html += '<td>' + row.var6 + '</td>';
			html += '<td>' + row.var7 + '</td>';
			html += '<td>' + row.var8 + '</td>';
			html += '<td>' + row.var9 + '</td>';
			html += '<td>' + row.var10 + '</td>';
			html += '<td>' + row.sms_trigger_on + '</td>';
			html += '<td>' + row.is_sms_triggered + '</td>';
			html += '<td>' + row.transaction_id + '</td>';
			html += '<td>' + row.sms_text + '</td>';
			html += '<td>' + row.url + '</td>';
			html += '<td>' + row.var_url + '</td>';
			html += '<td>' + row.source + '</td>';
			html += '<td>' + row.sms_type + '</td>';
			html += '<td>' + row.purpose + '</td>';
			html += '<td>' + row.temp_name + '</td>';
			html += '<td>' + row.communication_type + '</td>';
			html += '<td>' + row.mlc_master_communication_trigger_instant_id + '</td>';
			html += '<td>' + row.status_from_api + '</td>';
			html += '<td>' + row.api_request + '</td>';
			html += '<td>' + row.api_response + '</td>';
			html += '<td>' + row.cli + '</td>';
			html += '<td>' + row.callstatus + '</td>';
			html += '<td>' + row.callstarttime + '</td>';
			html += '<td>' + row.Campaignname + '</td>';
			html += '<td>' + row.callduration + '</td>';
			html += '<td>' + row.msisdn + '</td>';
			html += '<td>' + row.callreferenceid + '</td>';
			html += '<td>' + row.callendtime + '</td>';
			html += '<td>' + row.param1 + '</td>';
			html += '<td>' + row.image_url + '</td>';
			html += '<td>' + row.statusdescription + '</td>';
			html += '<td>' + row.send_type + '</td>';
			html += '<td>' + row.schedule_date_from + '</td>';
			html += '<td>' + row.schedule_date_to + '</td>';
			html += '<td>' + row.whatsapp_type + '</td>';
			html += '<td>' + row.trigger_type + '</td>';
			html += '<td>' + row.mlc_campaign_send_sms_id + '</td>';
			html += '<td>' + row.schedule_datetime + '</td>';
			html += '<td>' + row.handsetTime + '</td>';
			html += '<td>' + row.failed_code + '</td>';
			html += '</tr>';
			
	}

	html += '</table></div></div>';
	
	let paginationHTML = '<div class="row">';
	paginationHTML += '<div class="col-md-12" style="position:relative;">';
	paginationHTML += '<table class="paginatiowidth">';
	paginationHTML += '<tr class="sidemain">';
	paginationHTML += '<td>';

	if (page > 1) {
    paginationHTML += "<a class='page gradient' id='pageid' href='javascript:void(0)' onclick='updateTable(" + (page - 1) + "," + data.length + "," + JSON.stringify(data) + ")'><</a>";
    paginationHTML += "<a class='page gradient' id='pageid' href='javascript:void(0)' onclick='updateTable(" + (currentPage) + "," + data.length + "," + JSON.stringify(data) + ")'><<</a>";
    
    
	}

	for (let i = 1; i <= Math.ceil(data.length / display_count); i++) {
		if (i === page) {
			paginationHTML += "<a class='page gradient current' href='javascript:void(0)'>" + i + "</a>";
		}
	}

	if (page < Math.ceil(data.length / display_count)) {
		paginationHTML += "<a class='page gradient' href='javascript:void(0)' onclick='updateTable(" + (page + 1) + "," + data.length + "," + JSON.stringify(data) + ")'>></a>";
}
		

		paginationHTML += '</td>';
		paginationHTML += '</tr>';
		paginationHTML += '</table>';
		paginationHTML += '</div>';
		paginationHTML += '</div>';
		paginationHTML += '</div>';
		
		html += paginationHTML;
		$('#csv_file_data').html(html);
        }

</script>