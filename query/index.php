<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
is_writable(session_save_path());
print_r($_SESSION);

require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../include/header.php');
require_once(dirname(__FILE__) . '/../model/queryHelper.php');
if ($user_role != 3) {
    $ut = '';
	$filter_data_qry = array();
    if (isset($_REQUEST['u_assign'])) {
        $u_assign = replace_special($_REQUEST['u_assign']);
		if($_REQUEST['u_assign'] != ''){
			$filter_data_qry[] = 'assign_user='.$u_assign;
		}
    }
    if (isset($_REQUEST['phone'])) {
        $phone_search = replace_special($_REQUEST['phone']);
		if($_REQUEST['phone'] != ''){
			$filter_data_qry[] = 'phone_no='.$phone_search;
		}
    }
    if (isset($_REQUEST['query_statussearch'])) {
        $query_statussearch = replace_special($_REQUEST['query_statussearch']);
		if($_REQUEST['query_statussearch'] != ''){
			$filter_data_qry[] = 'query_status='.$query_statussearch;
		}
    }
    if (isset($_REQUEST['city_type'])) {
        $city_type = replace_special($_REQUEST['city_type']);
		if($_REQUEST['city_type'] != ''){
			$filter_data_qry[] = 'city_id='.$city_type;
		}
    }
    if (isset($_REQUEST['customer_id_search'])) {
        $customer_id_search = $_REQUEST['customer_id_search'];
		if($_REQUEST['customer_id_search'] != ''){
			$filter_data_qry[] = 'id='.$customer_id_search;
		}
    }
    if (isset($_REQUEST['email_search'])) {
        $email_search = $_REQUEST['email_search'];
		if($_REQUEST['email_search'] != ''){
			$filter_data_qry[] = 'email_id='.$email_search;
		}
    }
    if (isset($_REQUEST['name_search'])) {
        $name_search = replace_special($_REQUEST['name_search']);
		if($_REQUEST['name_search'] != ''){
			$filter_data_qry[] = 'customer_name='.$name_search;
		}
    }
    if (isset($_REQUEST['qry_search'])) {
        $qry_search = replace_special($_REQUEST['qry_search']);
		if($_REQUEST['qry_search'] != ''){
			$filter_data_qry[] = 'query_id = '.$qry_search;
		}
    }
    if (isset($_REQUEST['date_from'])) {
        $date_from = replace_special($_REQUEST['date_from']);
    }
    if (isset($_REQUEST['date_to'])) {
        $date_to = replace_special($_REQUEST['date_to']);
    }
	if($_REQUEST['date_from'] != '' && $_REQUEST['date_to'] != ''){
		$filter_data_qry[] = "DATE(created_on) between '".$date_from."' AND '".$date_to."'";
	}
    if (isset($_REQUEST['follow_date_from'])) {
        $follow_date_from = replace_special($_REQUEST['follow_date_from']);
    }
    if (isset($_REQUEST['follow_date_to'])) {
        $follow_date_to = replace_special($_REQUEST['follow_date_to']);
    }
	if($_REQUEST['follow_date_from'] != '' && $_REQUEST['follow_date_to'] != ''){
		$filter_data_qry[] = "DATE(follow_up_date_time) between '".$follow_date_from."' AND '".$follow_date_to."'";
	}
    if (isset($_REQUEST['product_type'])) {
        $product_type = replace_special($_REQUEST['product_type']);
		if($_REQUEST['product_type'] != ''){
			$filter_data_qry[] = 'product_id = '.$product_type;
		}
    }
	if (isset($_REQUEST['plan_type'])) {
        $plan_type = replace_special($_REQUEST['plan_type']);
		if($_REQUEST['plan_type'] != ''){
			$filter_data_qry[] = 'plan_id = '.$plan_type;
		}
    }
	if (isset($_REQUEST['source_type'])) {
        $source_type = replace_special($_REQUEST['source_type']);
		if($_REQUEST['source_type'] != ''){
			$filter_data_qry[] = 'source = '.$source_type;
		}
    }
?>
    <!DOCTYPE html>
    <html>
    <head>
    <title>Leads</title>
    <link rel="shortcut icon" href="<?php echo $head_url; ?>/assets/images/favicon.png" type="image/x-icon">
        <link rel="icon" href="<?php echo $head_url; ?>/assets/images/favicon.png" type="image/x-icon">
        <link rel="stylesheet" href="<?php echo $head_url; ?>/assets/css/jquery-ui.css">
        <script type="text/javascript" src="<?php echo $head_url; ?>/assets/js/jquery-1.10.2.js"></script>
        <script type="text/javascript" src="<?php echo $head_url; ?>/assets/js/jquery-ui.js"></script>
        
        <script>
            function selectAll(source) {
                checkboxes = document.getElementsByName('mask[]');
                for (var i in checkboxes)
                    checkboxes[i].checked = source.checked;
            }

            $(function() {
                jQuery('#date_from').datepicker({
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: 'yy-mm-dd',
                    beforeShow: function() {
                        jQuery(this).datepicker('option', 'maxDate', jQuery('#date_to').val());
                    }
                });
                jQuery('#date_to').datepicker({
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: 'yy-mm-dd',
                    beforeShow: function() {
                        jQuery(this).datepicker('option', 'minDate', jQuery('#date_from').val());
                    }
                });
                jQuery('#follow_date_from').datepicker({
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: 'yy-mm-dd',
                    beforeShow: function() {
                        jQuery(this).datepicker('option', 'maxDate', jQuery('#follow_date_to').val());
                    }
                });
                jQuery('#follow_date_to').datepicker({
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: 'yy-mm-dd',
                    beforeShow: function() {
                        jQuery(this).datepicker('option', 'minDate', jQuery('#follow_date_from').val());
                    }
                });
                $("#assign_to").hide();
                $("#query_search").hide();
                $('#assign').click(function() {
                    $('#assign_to').show();
                    $("#query_search").hide();
                });
                $("#city_type").autocomplete({
                    source: "../../include/city_name.php",
                    minLength: 2
                });
                $('#query').click(function() {
                    $('#query_search').show();
                    $("#assign_to").hide();

                });
            });
            function resetform() {
                window.location.href = "<?php echo $head_url; ?>/query/";
            }
            function filter_validation() {
                if ($("#email_search").val().trim() != "") {
                    var email_regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
                    if (!email_regex.test($("#email_search").val())) {
                       // alert("Customer Email not valid")
                        return false;
                    }
                }
            }
        </script>
    </head>

    <body>
        <div class="color-bar-1"></div>
        <div class="color-bar-2 color-bg"></div>
        <div class="container main-container">
            <div class="row">
                <div class="span9">
                    <fieldset>
                        <legend>Query Filter</legend>
                        <form method="post" action="index.php" name="searchfrm" autocomplete="off" onsubmit="return filter_validation()">
                            <input type="text" class="text-input alpha-wo-space" name="name_search" id="name_search" placeholder="Name" maxlength="30" value="<?php echo $name_search; ?>" />
                            <input type="text" class="text-input numonly" name="qry_search" id="qry_search" placeholder="Query Id" maxlength="30" value="<?php echo $qry_search; ?>" />
                            <input type="text" class="text-input numonly" name="phone" id="phone" placeholder="Phone No" value="<?php echo $phone_search; ?>" maxlength="10" />
                            <?php echo get_textbox('city_type', $city_type, 'placeholder ="City Name (Enter few words)" class="alpha-num-space" maxlength="25"'); ?>
                            <input type="text" class="text-input" name="date_from" id="date_from" placeholder="Date From" maxlength="10" value="<?php echo $date_from; ?>" readonly="readonly" />
                            <input type="text" class="text-input" name="date_to" id="date_to" placeholder="Date To" maxlength="10" value="<?php echo $date_to; ?>" readonly="readonly" />
                            <?php //echo get_dropdown('query_status', 'query_statussearch', $query_statussearch, '');
							 // echo get_dropdown('product', 'product_type', $product_type, '');
							  // echo get_dropdown('plan', 'plan_type', $plan_type, '');
							  // echo get_dropdown('source', 'source_type', $source_type, '');
							// if ($user_role != 3) { echo get_dropdown('user_assign', 'u_assign', $u_assign, ''); }
                             ?>
                            <input type="text" class="text-input" name="follow_date_from" id="follow_date_from" placeholder="Follow Date From" maxlength="10" value="<?php echo $follow_date_from; ?>" readonly="readonly" />
                            <input type="text" class="text-input" name="follow_date_to" id="follow_date_to" placeholder="Follow Date To" maxlength="10" value="<?php echo $follow_date_to; ?>" readonly="readonly" />
                            <input type="text" class="text-input numonly" name="customer_id_search" id="customer_id_search" placeholder="Customer ID" maxlength="30" value="<?php echo $customer_id_search; ?>" />
                            <input type="text" class="text-input alnum-wo-space" name="masked_phone" id="masked_phone" placeholder="Masked Phone No." value="<?php echo $masked_phone; ?>" maxlength="10" />
                            <input type="text" class="text-input no-space" name="email_search" id="email_search" placeholder="Customer Email" value="<?php echo $email_search; ?>" maxlength="100" autocomplete="null" />
                            <input class="cursor" type="submit" name="searchsubmit" value="Filter"><input class="cursor" type="button" onclick="resetform()" value="Clear">
                            <a href="add-query.php">
                            <input class="cursor" type="button" name="addQuery" value="Add Query">
                            </a>
                        </form>
                    </fieldset>
					
                    <form method="POST" name="frmmain" action="mask_assign.php">
                        <table width="100%" class="gridtable">
                            <tr>
                                <?php if ($user_role == 1) { ?>
                                    <th width="5%">
                                        <div><input type="checkbox" name="selectall" id="selectall" onClick="selectAll(this)">Select</div>
                                        </td><?php } ?>
                                    <th>Query Details</th>
                                    <th>Name & City</th>
									<th>Mobile / <br> Email </th>
                                    <th>Product Type / <br> Plan</th>
                                    <th>Query Status / <br> Follow up date & Time</th>
                                    <th>Assign To</th>
                                    <th>Action</th>                               
                            </tr>
        <?php $get_qry_det = new queryModel();
			  $qry_dets = $get_qry_det->fetchDetails($offset,$filter_data_qry);
              echo $qry_dets;
             // exit;
			  $get_num_data = $db_handle->numRows($qry_dets);
			 if ($get_num_data > 0) {
                $record = 0;
				$result_qry_data = $db_handle->runQuery($qry_dets);
				foreach($result_qry_data As $qry_key=>$qry_val){
					 $record++;
                     if ($record > 10) {
						continue;
                     } 
                     $echo_number = mobile_hide($phone_no);
                                $city_fet = get_cityname('city_name',array('city_id='.$qry_val['city_id']));
								$city_name = $db_handle->runQuery($city_fet);
								$prod_fet = get_productname('value',array('id ='.$qry_val['product_id']));
								$product_name = $db_handle->runQuery($prod_fet);
								$plan_fet = get_planname('value',array('id ='.$qry_val['plan_id']));
								$plan_name = $db_handle->runQuery($plan_fet);
								$status_fet = get_query_status('description ',array('id ='.$qry_val['query_status']));
								$stats_name = $db_handle->runQuery($status_fet);
								$user_fet = get_username('user_name ',array('user_id ='.$qry_val['assign_user']));
								$user_name = $db_handle->runQuery($user_fet);
								$source_fet = get_sourcename('value ',array('id ='.$qry_val['source']));
								$source_name = $db_handle->runQuery($source_fet);
                                $verify_phone = $qry_val['verify_phone'];
                                $show_number_flag_sess = $_SESSION['userDetails']['show_number_flag'];
                                if($show_number_flag_sess == 1){
                                    $phone_no_up = $qry_val['phone_no'];
                                } else if($show_number_flag_sess == 2){
                                    $phone_no_up = substr_replace($qry_val['phone_no'], 'XXXX', 3, 4);
                                }else if($show_number_flag_sess == 3){
                                    $phone_no_up = substr_replace($qry_val['phone_no'], 'XXXXXXXXXX', 0,10);
                                }
                                $follow_date_time ='';
                                if($qry_val['follow_up_date_time'] != '0000-00-00 00:00:00' && $qry_val['follow_up_date_time'] != '' ){
                                    $follow_date_time = dateformat($qry_val['follow_up_date_time']);
                                }
               ?>
              <tr><?php if ($user_role == 1) { ?>
				<td><input type="checkbox" name="mask[]" value="<?php echo $qry_val['query_id']; ?>"></td>
                <?php } ?>
                <td><span><?php echo $qry_val['query_id']; ?> </span><br><span class="fs-13"><?php echo dateformat($qry_val['created_on']);?></span><br><span><?php echo $source_name[0]['value']; ?> </span></td>
                <td><a href="<?php echo $head_url; ?>/query/edit.php?ut=<?php echo $ut; ?>&id=<?php echo urlencode(base64_encode($qry_val['query_id'])); ?>&page=<?php echo $page; ?>" class="has_link"><span><?php echo $qry_val['customer_name']; ?></span><br /><span class="fs-12"><?php echo $city_name[0]['city_name']; ?></span></a></td>
                <td><span><?php echo $phone_no_up; ?><b><?php if ($verify_phone == "1") { echo " &#10003; "; } ?></b> <?php if ($verify_phone != '1') { ?> <span class='red fs-11 valign-mid'> <b>X</b></span> <?php } ?></span><br /><span class="fs-12"><?php echo $qry_val['email_id']; ?></span></td>
                <td><span><?php echo $product_name[0]['value'];?></span> <br> <span class='green fs-12 valign-mid'><?php echo $plan_name[0]['value'];?></span> <br /></td>
                <td><span><?php echo $stats_name[0]['description']; ?></span> <br><span><?php echo $follow_date_time; ?></span></td>
                 <td> <?php echo $qry_val['assign_user'] > 0 ? $user_name[0]['user_name'] : " - ";?></td>
				  <td> <a href="<?php echo $head_url; ?>/query/edit.php?id=<?php echo base64_encode($qry_val['query_id']); ?>" class="has_link">
                  <input type="button" class="pointer_n bluebutton" value="View"></a> 
                  
               </tr>
        <?php  }
			 }			?>
                        </table>
                        <div class="clear ml10 pdT10" style="margin-top: 1%;">
                                <input type="radio" id="assign" class='cursor' name="assign"><label for='assign' class='cursor'>Assign to</label>
                                <span id="assign_to"><?php echo get_dropdown('active_users', 'assigned', '', ''); ?>
                                    <input type="submit" name="edit" value="Assign" />
                            </div>
                    </form>
                    <?php  if ($get_num_data > 0) { ?>
                        <table width="85%" style="float:left" border="0" align="center" cellpadding="4" cellspacing="1" class="pagination">
                            <tr class="sidemain">
                                <td>
                                    <?php
                                    if ($page > 1) {
                                        echo "<a class='page gradient' href='index.php?page=1&phone=$phone_search&u_assign=$u_assign&name_search=$name_search&query_statussearch=$query_statussearch&city_type=$city_type&date_from=$date_from&date_to=$date_to&product_type=$product_type&plan_type=$plan_type&source_type=$source_type&follow_date_from=$follow_date_from&follow_date_to=$follow_date_to&customer_id_search=$customer_id_search&email_search=$email_search'>First</a>";
                                        echo "<a class='page gradient' href='index.php?page=" . ($page - 1) . "&phone=$phone_search&u_assign=$u_assign&name_search=$name_search&query_statussearch=$query_statussearch&city_type=$city_type&date_from=$date_from&date_to=$date_to&product_type=$product_type&plan_type=$plan_type&source_type=$source_type&follow_date_from=$follow_date_from&follow_date_to=$follow_date_to&customer_id_search=$customer_id_search&email_search=$email_search'>Prev</a>";
                                    }
                                    echo "<a class='page gradient' href='javascript:void;'>" . $page . "</a>";
                                    if ($get_num_data > $display_count) {
                                        echo "<a class='page gradient' href='index.php?page=" . ($page + 1) . "&phone=$phone_search&u_assign=$u_assign&name_search=$name_search&query_statussearch=$query_statussearch&city_type=$city_type&date_from=$date_from&date_to=$date_to&product_type=$product_type&plan_type=$plan_type&source_type=$source_type&follow_date_from=$follow_date_from&follow_date_to=$follow_date_to&customer_id_search=$customer_id_search&email_search=$email_search'>Next</a>";
                                    }
                                    ?>
                                </td>
                            </tr>
                        </table>
                <?php } ?>
                </div>
            <?php } else { require_once(dirname(__FILE__) . '/../include/loader.php');  ?>
                <div id="data_not_found" class="main-text-position"></div>
                <script src="<?php echo $head_url; ?>/assets/js/jquery-1.10.2.js"></script>
                <script src="<?php echo $head_url; ?>/assets/js/jquery-ui.js"></script>
                <script>
                    $(document).ready(function() {
                        var url = 'one-lead.php';
                        $.ajax({
                            type: 'POST',
                            url: url,
                            async: false,
                            success: function(data) {
                                $("#loader").addClass("hidden");
                                var jsonparse = JSON.parse(data);
                                $("#loader").css("display", "none");
                                if (jsonparse.id != '' && jsonparse.id > 0) {
                                    window.location.href = jsonparse.URL;
                                } else {
                                    $("#data_not_found").html("Dear User, you do not have any query<br><br>Please contact your Team Leader for more queries.");
                                }
                            }

                        });
                    });
                    setTimeout(function() {
                        location.reload();
                    }, 30000);
                </script>
            <?php } ?>

    </body>

    </html>