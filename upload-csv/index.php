<?php
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
	<link rel="stylesheet" type="text/css" href="<?php echo $head_url; ?>/assets/css/cms.style-new.css" />
	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
	<style>
		.table_new {
			width: 100%;
			border-collapse: collapse;
			font-size:12px;
			margin-bottom:10px;
		}
		.table_new, .table_new td, .table_new th {
			padding: 6px;
			border: 1px solid #ddd;
			position:relative;
		}
		.table_new-bodered, .table_new-bodered td, .table_new-bodered th {
			border: 1px solid #ddd;
			padding: 10px;
		}
		.table_new th, table_new th {
			font-weight:bold;
			background: #18375f !important;
			color: #fff;
			text-align: left;
		}
		.table_new tr td a {
			margin: 0 10px;
		}
	</style>

</head>
    <body>

	<div class="pl-md-3 pl-2 pr-md-3 pr-2 col-12">
    
    <div class="gen-box white-bg">
    <div class="blue-bg col-12 font-weight-nb pb-2 pt-2 white font-20 brdr-top-gray pe-none" data-toggle="step1" id="switch_step1">
			<h2><?php if($message){echo "<span class='".$class."'>".$message ."</span>";} else { echo "";}?></h2>
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
						
							<input type='button' name='download_format' value='Download Format' id='download_format' class='buttonsub ml10 cursor'  onclick="download_csv_format_file()"/>
							
						</div>
					</div>							
				</div>
			<h3 id="heading" style="display: none;">List of Data</h3>
			<div class="addon" style="display: none;" id="csv_file_data"></div>
		</div>
	</div>
	</div>
	</body>
</html>


<script>
function download_csv_format_file() {
    var csv = 'name,phone_no,email_id,pincode,loan_amount,dob,net_income,loan_type' ;
    var hiddenElement = document.createElement('a');
    hiddenElement.href = 'data:text/csv;charset=utf-8,' + encodeURI(csv);
    hiddenElement.target = '_blank';
    hiddenElement.download = 'upload-csv-data.csv';
    hiddenElement.click();
}

function resetform(path){
    window.location.href = path;
}

$('#upload_csv').on('click', function(event){
	event.preventDefault();
    $(this).prop("disabled", true);
	var formdata = new FormData();
	formdata.append('upload_files', $('#upload_files').get(0).files[0]);
	var filelist = document.getElementById("upload_files").files;
	if(filelist.length == 0){
		alert("Please Select a file"),
        $(this).prop("disabled", false);
        return false;
	}else{
		for (var i = 0; i < filelist.length; i++) {
			var ext = $('#upload_files').val().split('.').pop().toLowerCase();
			if($.inArray(ext, ['csv']) == -1) {
					alert('Select only CSV File').then(
                    function () {
                        window.location = '';
                    },
            )
				return false;
			}
		}
	}
	$.ajax({
	url: "upload-csv.php",
	method: "POST",
   
	data: formdata,
	dataType: 'json',
	contentType: false,
	cache: false,
	processData: false,
	
	success: function(data) {
        if(data !== null){
            if (data.hasOwnProperty('status') && data.status === 'Error') {
					alert(data.message).then(
                    function () {
                    window.location.href = '';
                });
            } else if ((data.length)>0) {
                html = updateTable(currentPage, data.length, data);	

                $('#heading').css('display', 'block');
                $('#csv_file_data').css('display', 'block');
                $('#csv_file_data').html(html);
            
            } 
        }else{
				alert('File is empty').then(
                    function () {
                window.location.href = '';
            });
    
            }
		}
	})
	});


	function toggle(source) {
		checkboxes = document.getElementsByName("chkbox");
		for(var i=0, n=checkboxes.length;i<n;i++) {
		checkboxes[i].checked = source.checked;
		}

		$('.checkbox').change(function(){
				if($('.checkbox:checked').length == $('.checkbox').length){
						$('.checked_all').prop('checked',true);
				}else{
						$('.checked_all').prop('checked',false);
				}
			});
		}
	function toggle1(){
		$('.checkbox').change(function(){
			if($('.checkbox:checked').length == $('.checkbox').length){
					$('.checked_all').prop('checked',true);
			}else{
					$('.checked_all').prop('checked',false);
			}
		});
		}
    


	$(document).on('click', '#import_data', function () {
		if ($('.checkbox:checked').length > 0) {
			var arr =[];
        
			$('.checkbox:checked').each(function(i) {
                arr.push($(this).val());
				});
				var count          = arr.length;
				var name     	   =  [];
				var phone_no       =  [];
				var email_id       =  [];
				var pincode        =  [];
				var loan_amount    =  [];
				var dob            =  [];
				var net_income     =  [];
				var loan_type     =  [];
				

				for(i=0; i<arr.length; i++){
					name[i] =$('.name'+arr[i]).val();
					email_id[i] =$('.email_id'+arr[i]).val();
					phone_no[i] =$('.phone_no'+arr[i]).val();
					pincode[i] =$('.pincode'+arr[i]).val();
					loan_amount[i] = $('.loan_amount'+arr[i]).val()
					dob[i] =$('.dob'+arr[i]).val();
					net_income[i] =$('.net_income'+arr[i]).val();
					loan_type[i] =$('.loan_type'+arr[i]).val();
				}
				var chkvalue=$("input[name='checkbox']:checked").val();

				$.ajax({
				url:"add.php",
				method:"POST",
				data: {name :name,phone_no :phone_no,email_id :email_id,pincode:pincode,loan_amount:loan_amount,dob:dob,net_income:net_income,loan_type:loan_type},
                beforeSend: function () {
                    $("#import_data").val('processing....');
                    $("#import_data").attr('disabled','disabled');
                },
				success:function(data)
				{
					if (data && data.status === 'error') {
						if (data && data.message === null) {
							data.message = "Duplicate Entry";
						} else {
							data.message = data.message;
						}
						const insertData = data.insert_Data || "";

						data_show = data.message + " " + "Total Row Insert (" + insertData + ")";
						
						if (window.confirm(data_show)) {
							window.location.href = '/crmsml/upload-csv/index.php';
						}
					} else if (data && data.status === 'success') {
						const message = data.message || "";
						const insertData = data.insert_Data || "";

						data_show = message + " " + "Total Row Insert (" + insertData + ")";
						
						if (window.confirm(data_show)) {
							window.location.href = '/crmsml/upload-csv/index.php';
						}
					} else {
						if (window.confirm(data)) {
							window.location.href = '/crmsml/upload-csv/index.php';
						}
					}

				}
				});
        }else{
				alert("Please select any checkbox")
                }
	});

	let currentPage = 1;
	let display_count = 50;
    function updateTable(page, dataLength, data) {
		$('#csv_file_data').html("");
		let start = (page - 1) * display_count;
    	let end = Math.min(start + display_count, data.length);
        

		html = '<div class="" ><div class="col-md-48 "><table class="table_new"><tbody><tr class="blue-bg"><th colspan="48-48" class="align:center" style="text-align:center;"><button type="button" id="import_data" class="cursor buttonsub"  >Add</button></tr></tbody></table</div>';
		html += '<table class="table_new" >';
		html += '<tr ><th><input name="product_all" class="checked_all" type="checkbox" value="as" onClick="toggle(this)"> Select All</th><th>Name</th><th>Phone No</th><th>Email Id</th><th>Pincode</th><th>Loan Amount</th><th>DOB</th><th>Net Income</th><th>Loan Type</th></tr>';

		for (let count = start; count < end; count++) {
			let row = data[count];
            html += '<tr><td><input type="checkbox" value="'+count+'" id="'+count+'" name="chkbox" class="checkbox" onClick="toggle1()"><input type="hidden" value="'+row.name+'" class="name'+count+'"><input type="hidden" value="'+row.phone_no+'" class="phone_no'+count+'"><input type="hidden" value="'+row.email_id+'" class="email_id'+count+'"><input type="hidden" value="'+row.pincode+'" class="pincode'+count+'"><input type="hidden" value="'+row.loan_amount+'" class="loan_amount'+count+'"><input type="hidden" value="'+row.dob+'" class="dob'+count+'"><input type="hidden" value="'+row.net_income+'" class="net_income'+count+'"><input type="hidden" value="54" class="loan_type'+count+'"></td>';


			html += '<td>' + row.name + '</td>';
			html += '<td>' + row.phone_no + '</td>';
			html += '<td>' + row.email_id + '</td>';
			html += '<td>' + row.pincode + '</td>';
			html += '<td>' + row.loan_amount + '</td>';
			html += '<td>' + row.dob + '</td>';
			html += '<td>' + row.net_income + '</td>';
			html += '<td>54</td>';
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