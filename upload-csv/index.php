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
	<script src="path/to/sweetalert2.all.min.js"></script>

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

$('#upload_csv').on('click', function(event){
	event.preventDefault();
    $(this).prop("disabled", true);
	var formdata = new FormData();
	formdata.append('upload_files', $('#upload_files').get(0).files[0]);
	var filelist = document.getElementById("upload_files").files;
	if(filelist.length == 0){
		// Swal.fire({
        //     title: 'Please Select a file',
        //     timer: 3000,
        //     icon:"error"
        //     }),
		alert("Please Select a file"),
        $(this).prop("disabled", false);
        return false;
	}else{
		for (var i = 0; i < filelist.length; i++) {
			var ext = $('#upload_files').val().split('.').pop().toLowerCase();
			if($.inArray(ext, ['csv']) == -1) {
                // Swal.fire({
                //     title: 'Select only CSV File',
                //     timer: 3000,
                //     icon:"error"
                //     }).then(
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
	url: "upload-sms-csv.php",
	method: "POST",
   
	data: formdata,
	dataType: 'json',
	contentType: false,
	cache: false,
	processData: false,
	
	success: function(data) {
        if(data !== null){
            if (data.hasOwnProperty('status') && data.status === 'Error') {
                // Swal.fire({
                //     title: 'Error',
                //     text: data.message,
                //     icon: 'error'
                // }).then(function() {
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
            // Swal.fire({
            //     title: 'Error',
            //     text: "File is empty",
            //     icon: 'error'
            // }).then(function() {
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
				var name     =  [];
				var phone_no        =  [];
				var email_id        =  [];
				var pincode        =  [];
				var dob           =  [];
				var net_income         =  [];
				

				for(i=0; i<arr.length; i++){
					name[i] =$('.name'+arr[i]).val();
					phone_no[i] =$('.phone_no'+arr[i]).val();
					email_id[i] =$('.email_id'+arr[i]).val();
					pincode[i] =$('.pincode'+arr[i]).val();
					dob[i] =$('.dob'+arr[i]).val();
					net_income[i] =$('.net_income'+arr[i]).val();
				}
				var chkvalue=$("input[name='checkbox']:checked").val();

				// alert(temp_name+"abc"+purpose)
				$.ajax({
				url:"add.php",
				method:"POST",
				data: {name :name,phone_no :phone_no,email_id :email_id,pincode:pincode,dob:dob,net_income:net_income},
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
                        // Swal.fire({
                        //     title: 'Error',
                        //     text: data_show,
                        //     icon: 'error'
                        // }).then(function() {
							alert(data_show).then(
                    		function () {
                            window.location.href = '';
                        });
                    } else if (data && data.status === 'success' ) {
                        const message = data.message || "";
                        const insertData = data.insert_Data || "";

                        data_show = message +" "+ "Total Row Insert (" + insertData +")";
                        // Swal.fire({
                        //     title: 'Success',
                        //     text: data_show,
                        //     icon: 'success',
                        //     timer: 5000
                        // }).then(function() {
							alert(data_show).then(
                    		function () {
                            window.location.href = '';
                        });
                    }else {
                        // Swal.fire({
                        //     title: 'error',
                        //     text: data,
                        //     icon: 'error',
                        //     timer: 5000
                        // }).then(function() {
							alert(data).then(
                    		function () {
                            window.location.href = '';
                        });
                        
                    }

				}
				});
        }else{
                // Swal.fire({
                //     title: 'error',
                //     text: "Please select any checkbox",
                //     icon: 'error',
                //     timer: 5000
                // })
				alert("Please select any checkbox")
                }
	});

	let currentPage = 1;
	let display_count = 50;
    function updateTable(page, dataLength, data) {
        
		$('#csv_file_data').html("");
		let start = (page - 1) * display_count;
    	let end = Math.min(start + display_count, data.length);
        

		html = '<div class="row"><div class="col-md-48 "><table class="table"><tbody><tr class="blue-bg"><th colspan="48-48" class="align:center" style="text-align:center;"><button type="button" id="import_data" class="cursor buttonsub"  >Add</button></tr></tbody></table</div>';
		html += '<table class="table">';
		html += '<tr><th><input name="product_all" class="checked_all" type="checkbox" value="as" onClick="toggle(this)"> Select All</th><th>Name</th><th>Phone No</th><th>Email Id</th><th>Pincode</th><th>DOB</th><th>Net Income</th></tr>';

		for (let count = start; count < end; count++) {
			let row = data[count];
            html += '<tr><td><input type="checkbox" value="'+count+'" id="'+count+'" name="chkbox" class="checkbox" onClick="toggle1()"><input type="hidden" value="'+row.name+'" class="name'+count+'"><input type="hidden" value="'+row.phone_no+'" class="phone_no'+count+'"><input type="hidden" value="'+row.email_id+'" class="email_id'+count+'"><input type="hidden" value="'+row.pincode+'" class="pincode'+count+'"><input type="hidden" value="'+row.dob+'" class="dob'+count+'"><input type="hidden" value="'+row.net_income+'" class="net_income'+count+'"></td>';


			html += '<td>' + row.name + '</td>';
			html += '<td>' + row.phone_no + '</td>';
			html += '<td>' + row.email_id + '</td>';
			html += '<td>' + row.pincode + '</td>';
			html += '<td>' + row.dob + '</td>';
			html += '<td>' + row.net_income + '</td>';
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