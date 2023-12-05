<?php
session_start();
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../include/header.php');
require_once(dirname(__FILE__) . '/../model/queryHelper.php');
require_once(dirname(__FILE__) . '/../include/loader.php');
require_once(dirname(__FILE__) . '/../config/config.php');
$level_id = 1;
if (isset($_REQUEST['page'])) {
    $page = replace_special($_REQUEST['page']);
}
if (isset($_REQUEST['id'])) {
    $id = replace_special(urldecode(base64_decode($_REQUEST['id'])));
} 
$qryyy_id = $id;
$get_qry_det = new queryModel();
$lead_disp_arr = array(
    'lead_id'=>$qryyy_id,
    'level_id'=>1,
    'user_id'=>$_SESSION['userDetails']['user_id'],
    'created_on'=>currentDateTime24(),
);
// $lead_disp_qry = $get_qry_det->insertQueryData('lead_display_history',$lead_disp_arr);
// $lead_view_id = $db_handle->insertRows($lead_disp_qry);


echo $qry_dets = $get_qry_det->getQueryData($qryyy_id,$user_id,$user_role);
$get_num_data = $db_handle->numRows($qry_dets);
if($get_num_data == 0){
    header("location:index.php");
}
$qry_data_arr = $db_handle->runQuery($qry_dets);

print_r($qry_data_arr);


$cust_id = $qry_data_arr[0]['cust_id'];
$customer_name = $qry_data_arr[0]['customer_name'];
$email_id = $qry_data_arr[0]['email_id'];
$phone_no = $qry_data_arr[0]['phone_no'];
$encoded_no = base64_encode($phone_no);
$alternate_phone_no = $qry_data_arr[0]['alternate_phone_no'];
$city_id = $qry_data_arr[0]['city_id'];
$pincode = $qry_data_arr[0]['pincode'];
$address = $qry_data_arr[0]['address'];
$query_status = $qry_data_arr[0]['query_status'];
$is_mobile_blocked = $qry_data_arr[0]['is_mobile_blocked'];
$verify_phone = $qry_data_arr[0]['verify_phone'];
$prod_name = $qry_data_arr[0]['prod_name'];
$product_id = $qry_data_arr[0]['product_id'];
$plan_name = $qry_data_arr[0]['plan_name'];
$created_on = $qry_data_arr[0]['created_on'];
$updated_on = $qry_data_arr[0]['updated_on'];
$verfiy_phone = $qry_data_arr[0]['verfiy_phone'];
$assign_date_time = $qry_data_arr[0]['assign_date_time'];
$follow_up_date_time = $qry_data_arr[0]['follow_up_date_time'];
$remarks = $qry_data_arr[0]['remarks'];
$city_name = $qry_data_arr[0]['city_name'];
//$phone_no_up = mobile_hide($phone_no);
$phone_no_up = ($phone_no);
// $status_his_qry = $get_qry_det->getQueryRecord('status_history',$columns_to_fetch = array("*"),array('lead_id = "'.$qryyy_id.'"'), 'Created_on', 'DESC');
// $status_his_count = $db_handle->numRows($status_his_qry);
// $status_his_res = $db_handle->runQuery($status_his_qry);
?>
<html>
    <head>
    <title>Edit Query</title>
        <link href="<?php echo $head_url; ?>/assets/query/css/grid.css?v=1.1" rel="stylesheet">
        <link href="<?php echo $head_url;?>/assets/css/tab_style.css" rel='stylesheet' type='text/css' />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link href="<?php echo $head_url;?>/assets/css/jquery.timepicker.min.css" rel="stylesheet"/> 
        <link href="<?php echo $head_url;?>/assets/css/edit.css" rel='stylesheet' type='text/css' />
        <link rel="shortcut icon" href="<?php echo $head_url; ?>/assets/images/favicon.png" type="image/x-icon">
        <link rel="icon" href="<?php echo $head_url; ?>/assets/images/favicon.png" type="image/x-icon">
        <script>
            function openWin(link) {
           myWindow = window.open('http://192.168.1.11/clickcall/call.php?' + link, 'myWindow', 'width=10,height=10');
            setInterval(function() {
                myWindow.close();
            }, 5000);
        }
        <?php if($user_role == 3){ ?>
            var isoneLead = 1;
         <?php } ?>
        
        var count = 2000;
        function call(clickbtn) {
            count++;
            var lead_view_id = "<?php echo $lead_view_id; ?>";
            var querystatus = "<?php echo $query_status; ?>";
            var queryid = "<?php echo $qryyy_id; ?>";
            var product_id = "<?php echo $product_id; ?>";
            var prod_name = "<?php echo $prod_name; ?>";
            var phone = "<?php echo base64_encode($phone_no); ?>";
            var customerId = "<?php echo $cust_id ?>";
            var c2phone = "<?php echo base64_encode("4".$phone_no); ?>";
            var today = new Date();
            var date = today.getFullYear() + '' + (today.getMonth() + 1) + '' + today.getDate();
            var time = today.getHours() + "" + today.getMinutes() + "" + today.getSeconds();
            var dateTime = date + '' + time;
            var dialer_uniq_id = "<?php echo $user_id . "_"; ?>" + dateTime + "_" + queryid + "_" + count;
            $.ajax({
                data: 'dialer_uniq_id=' + dialer_uniq_id + '&lead_view_id=' + lead_view_id + '&querystatus=' + querystatus + '&queryid=' + queryid + '&clickbtn=' + clickbtn + '&leveltype=1&phone=' + phone+"&customerId="+customerId,
                type: 'POST',
                url: '../include/insert_onclick_button.php',
                success: function(data) {
                    if (data > 0) {
                        $('#click_to_call_id,.click_to_call_id').val(data);
                        $('input[name="click_to_call_id"]').val(data);
                            if (clickbtn == 1) {
                                openWin("exten=<?php echo $_SESSION['userDetails']['dialer_extension_no']; ?>&mobile=" + btoa(phone) + "&ID=" + dialer_uniq_id + "&AGENTID=<?php echo $_SESSION['userDetails']['user_id']; ?>&LEVELTYPE=1&LEVELID=" + queryid + "&CALLTYPE=1&CLICKDATE=<?php echo strtotime(date('d-m-Y H:i:s')); ?>&AGENTNAME=<?php echo base64_encode($_SESSION['userDetails']['user_name']); ?>&LOANTYPE=<?php echo base64_encode($prod_name); ?>&LOANID=<?php echo $product_id; ?>");
                            } else {
                                openWin("exten=<?php echo $_SESSION['userDetails']['dialer_extension_no']; ?>&mobile=" + c2phone + "&ID=" + dialer_uniq_id + "&AGENTID=" + <?php echo $_SESSION['userDetails']['user_id']; ?> + "&LEVELTYPE=1&LEVELID=" + queryid + "&CALLTYPE=2&CLICKDATE=<?php echo strtotime(date('d-m-Y H:i:s')); ?>&AGENTNAME=<?php echo base64_encode($_SESSION['userDetails']['user_name']); ?>&LOANTYPE=<?php echo base64_encode($prod_name); ?>&LOANID=<?php echo $product_id; ?>");
                            }
                    }
                }
            })
        }

        function showNo(value){
            var queryid = "<?php echo $qryyy_id; ?>";
            $.ajax({
                data: '&queryid=' + queryid + '&type=1&source=1',
                type: 'POST',
                url: '../include/mobile-history.php',
                success: function(data) {
                    $("#phone_no").val(atob(value));
                    $("#showNo").remove();
                }
            })
            
        }
        </script>
    </head>
    <body>
        <input type="hidden" name="final_query_id" value="<?php echo base64_encode($id);?>">
        <div class="container-fluid main-container">
            <div class="d-block row">
                <div class="span9">
                    <div style="width:70%;float:left;">
                        <div class="wrapper">
                            <div class="main-crmform col-12">
                                <div class="popup-ctext up-list-box">
                                    <h2 class="f_14 fw_bold">Lead Detail</h2>
                                    <span class="orange f_13 mt10" style="font-weight:bold;">
                                        <span class="fs-13" style="font-weight: normal; color: #000">Lead ID: </span><span style="font-weight: 600; color: #000;"><?php echo $qryyy_id; ?></span>
                                        <span class="ml10 fs-13" style="font-weight: normal; color: #000">Lead Date: </span><span style="font-weight: 600; color: #000;"><?php echo date('d-m-Y h:i A',strtotime($created_on)); ?></span>
                                    </span>
                                    <div class="f_13 mt10" style="font-weight:bold;">
                                        <b class="fw_bold"><?php echo $customer_name; ?></b>  looking for a <b class="fw_bold orange"><?php echo $prod_name; ?> (<?php echo $plan_name; ?>)</b> Product Residing in <b class="fw_bold orange"> <?php echo $city_name; ?> </b>
                                        <?php if($mobile_status == 0 && $_SESSION['userDetails']['dialer_extension_no'] > 0 && $_SESSION['userDetails']['dialer_gateway_id'] > 0){ if($verify_phone == 1){?>
                                            <input type="button" class="cursor" value="Call1" onclick="call(1);"> <?php } ?><input type="button" class="cursor" value="Call2" onclick="call(2);">
                                            <?php if($_SESSION['userDetails']['show_number_flag'] != 1) {?>
                                            <input type="button" class="cursor bluebutton" id="showNo" value="Show No" onclick="showNo('<?php echo $encoded_no; ?>');">
                                      <?php  }}else if($mobile_status == 1){
                                          echo "<div style='background: red;color: white;padding: 5px;'>Customer is blocked for call. Please Don't Call this customer</div>";
                                      }else{
                                        echo "<div style='background: #1b8c1b;color: white;padding: 5px;'>You are not assigned with Dialer Extension. Please contact your TL</div>";
                                      } ?>
                                        
                                    </div>
                                    
                                </div>
                                
                            </div>
                            <main> 
                                <section class="d-flex flex-wrap">
                                    <div class="pl-md-3 pl-2 pr-md-3 pr-2 col-12">
                                        <div class="gen-box white-bg">
                                            <div class="blue-bg col-12 font-weight-nb pb-2 pt-2 white font-20 brdr-top-gray pe-none" data-toggle="step1" id="switch_step1">
                                               Query Details
                                            </div> 

                                            <!--Page Content --->
                                            <form action="" class="form-step col-12" autocomplete="off" id="query_form">
                                                <input type="hidden" name="query_id" id="query_id" value="<?php echo base64_encode($qryyy_id); ?>" class="valid">
                                                <input type="hidden" name="cust_id" id="cust_id" value="<?php echo base64_encode($cust_id); ?>" class="valid">
                                                <input type="hidden" name="city_idss" id="city_idss" value="<?php echo $city_id; ?>" class="valid">
                                                <div class="row div-width">
                                                    <div class="heading-offers">
                                                        <div class="exclamatry-text">Personal Details</div>
                                                    </div>
                                                    
                                                    <div class="form-group col-xl-3 col-lg-4 col-md-6">
                                                        <span class="fa-icon fa-user"></span>
                                                        <input type="text" id="name" name="name" value="<?php echo $customer_name ;?>" placeholder="Enter Customer Name" class="form-control valid alphaonly" maxlength="20" required>
                                                        <label for="name" class="label-tag">Customer Name</label>
                                                    </div>

                                                    <div class="form-group col-xl-3 col-lg-4 col-md-6">
                                                        <span class="fa-icon fa-envelope"></span>
                                                        <input type="email" class="form-control valid" value="<?php echo $email_id ;?>" name="email" maxlength="50" id="email" value="" required="">
                                                        <label for="email" class="label-tag ">Email</label>
                                                    </div>

                                                    <div class="form-group col-xl-3 col-lg-4 col-md-6">
                                                        <span class="fa-icon fa-mobile"></span>
                                                        <input type="tel" class="text form-control valid" name="phone_no" id="phone_no" value="<?php echo $phone_no_up ;?> " aria-invalid="false">
                                                        <?php if ($verify_phone == "1") { echo "<span class='green fs-11 valign-mid'>&#10003</span>"; } else { echo "<span class='red fs-11 valign-mid'>X</span>"; } ?> 
                                                        <label for="phone_no" class="label-tag">Mobile</label>
                                                    </div>

                                                    <div class="form-group col-xl-3 col-lg-4 col-md-6">
                                                        <span class="fa-icon fa-map-marker"></span>
                                                        <input type="tel" class="text form-control numonly valid" name="pin_code" id="pin_code" minlength="6" maxlength="6" required="" value="<?php echo $pincode ;?>">
                                                        <label for="pin_code" class="label-tag">Pin Code</label>
                                                    </div>

                                                    <div class="form-group col-xl-3 col-lg-4 col-md-6">
                                                        <span class="fa-icon fa-map-marker"></span>
                                                        <span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span><input type="text" class="text city_search form-control alpha-num valid" name="city_name" maxlength="30" id="city_id" value="<?php echo $city_name;?>" required="" autocomplete="off" aria-invalid="false">
                                                        <label for="city_id" class="label-tag">City </label>
                                                    </div>

                                                    <div class="form-group col-xl-3 col-lg-4 col-md-6">
                                                        <span class="fa-icon fa-home"></span>
                                                        <textarea name="address" class="text valid form-control" id="address" maxlength="200"><?php echo $address; ?></textarea>
                                                        <label for="address" class="label-tag  optional-tag ">Address</label>
                                                    </div>
                                                </div>

                                                <div class="text-center col-12 mb-2">
                                                    <input type="submit" class="btn btn-primary valid" name="submit" id="qry_form" value="SUBMIT">
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="text-center col-12 mb-2 succ_msg">

                                    </div>
                                </section>
                            </main>
                        </div>


                        <div class="ml-3" style="width: 98%;">
                        <div class="main">
                            <div class="sap_tabs" style="width: 100%">
                                <div id="horizontal_details_tab" style="display: block; width: 100%; margin: 0px;">
                                    <ul class="resp-tabs-list">
                                        <li class="resp-tab-item tab-view resp-tab-active" aria-controls="tab_item-0" id="fup_his" role="tab">
                                            <span>Follow Up</span>
                                        </li>
                                        
                                        <li class="resp-tab-item lost tab-view" aria-controls="tab_item-8" id="call_log" role="tab" onclick="callAjaxData(this)">
                                            <span>Call Log</span>
                                        </li>

                                        
                                        <li class="resp-tab-item lost tab-view" aria-controls="tab_item-10" id="one_lead" role="tab" onclick="callAjaxData(this)">
                                            <span>Lead Display</span>
                                        </li>
                                        <li class="resp-tab-item lost tab-view" aria-controls="tab_item-4" id="show_history" role="tab" onclick="callAjaxData(this)">
                                            <span>Show History</span>
                                        </li>
                                       
                                        <div class="clear"></div>
                                    </ul>
                                    <div class="resp-tabs-container">
                                        <h2 class="resp-accordion resp-tab-active" role="tab" aria-controls="tab_item-0">
                                            <span class="resp-arrow"></span>
                                            Follow Up
                                        </h2>
                                        <div class="tab-1 resp-tab-content resp-tab-content-active" aria-labelledby="tab_item-0" style="display:block">
                                            <div class="facts">
                                                <div class="register">
                                                    <div class="table_set">
                                                        
                                                        <!-- <input type="button" class="cursor valid" name="ad_follow" id="ad_follow" value="Add Follow Up"> -->
                                                        <div id="ad_form" style="border: 1px solid #CCC;padding:10px;">
                                                            <form method="POST" id="follow_up_form">
                                                                <input type="hidden" name="query_fup_id" id="query_fup_id" value="<?php echo base64_encode($qryyy_id); ?>" class="valid">
                                                                <div class="row div-width">       
                                                                    <div class="form-group col-xl-3 col-lg-4 col-md-6">
                                                                        <span class="fa-icon fa-list-alt"></span>
                                                                        <?php // echo get_dropdown('query_status','f_stats','','onchange="cng_status(this);"'); ?>
                                                                        <label for="f_stats" class="label-tag">Select Query Status</label> 
                                                                    </div>
                                                                    
                                                                    <div class="form-group col-xl-3 col-lg-4 col-md-6 fol_date hidden">
                                                                        <span class="fa-icon fa-calendar"></span>
                                                                        <input type="text" name="fol_date" id="fol_date" placeholder="yyyy-mm-dd" class="valid onlybackspace form-control" maxlength="10" autocomplete="off">
                                                                        <label for="fol_date" class="label-tag">Follow Up Date</label>
                                                                    </div>
                                                                    
                                                                    <div class="form-group col-xl-3 col-lg-4 col-md-6 fol_time hidden">
                                                                        <span class="fa-icon fa-clock-o"></span>
                                                                        <input type="text" name="fol_time" id="fol_time" class="form-control time  valid onlybackspace" placeholder="Follow Up Time" maxlength="8" autocomplete="off">
                                                                        <label for="fol_time" class="label-tag">Follow Up Time</label>
                                                                    </div>
                                                                
                                                                    <div class="form-group col-xl-3 col-lg-4 col-md-6">
                                                                        <span class="fa-icon fa-commenting"></span>
                                                                        <textarea name="remark" id="remark" placeholder="Remarks" class="form-control border-class" autocomplete="off"></textarea>
                                                                        <label for="remark" class="label-tag optional-tag">Remarks</label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-xl-12 col-lg-4 col-md-6">
                                                                    <input type="submit" name="submit" id="ad_query" class="buttonsub cursor valid" value="Submit" aria-invalid="false">
                                                                </div>
                                                            </form>
                                                        </div>                  
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                           
                                           
                                        
                                        <h2 class="resp-accordion" role="tab" aria-controls="tab_item-8"><span class="resp-arrow"></span>
                                            Call Log
                                        </h2><div class="tab-2 resp-tab-content" aria-labelledby="tab_item-8">
                                            <div class="facts">
                                                <div class="register">
                                                    <div class="table_set">
                                                                
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <h2 class="resp-accordion" role="tab" aria-controls="tab_item-10"><span class="resp-arrow"></span>
                                            Lead Display
                                        </h2><div class="tab-3 resp-tab-content" aria-labelledby="tab_item-10">
                                            <div class="facts">
                                                <div class="register">
                                                    <div class="table_set">
                                                    
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                            <h2 class="resp-accordion" role="tab" aria-controls="tab_item-4"><span class="resp-arrow"></span>
                                            Show History
                                        </h2><div class="tab-4 resp-tab-content" aria-labelledby="tab_item-4">
                                            <div class="facts">
                                                <div class="register">
                                                    <div class="table_set">
                                                    
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>




                    </div>

                    <div style="width:30%;float:right;">
                    <?php if($status_his_count > 0){?>
                        <div id="side-status">
                        <h1>Follow Up Status</h1>
                        <!-- div repeat -->
                        <?php 
                        //foreach($status_his_res as $status_his_record){
                                // $follow_up_status = $status_his_record['follow_up_type'];
                                // $user_id = $status_his_record['updated_by'];
                                // $status_fet = get_query_status('description ',array('id ='.$follow_up_status));
								// $stats_name = $db_handle->runQuery($status_fet);

                                // $user_fet = get_username('user_name ',array('user_id ='.$user_id));
								// $user_name = $db_handle->runQuery($user_fet);

                                // $created_on_dt = $status_his_record['created_on'];
                                // $fup_date_time = $status_his_record['fup_date_time'];
                        ?>
                        <!-- <div class="status-box">
                            <div class="date-time">
                                <?php //echo date('d-m-Y',strtotime($created_on_dt)); 
                                ?> <span><?php //echo date('h:i A',strtotime($created_on_dt));
                                 ?></span>
                            </div>
                            <div class="track-detail">
                                User: <td><?php //echo $user_name[0][0]; ?></td><br>
                                Status: <?php // echo $stats_name[0][0]; ?><br>
                                Remark: <?php // echo $status_his_record['remarks']; ?><br>
                                Date: <?php  //echo date('d-m-Y',strtotime($fup_date_time)); ?><br>
                                Time: <?php // echo date('h:i A',strtotime($fup_date_time)); ?>
                            </div>
                        </div> -->
                        <?php // } ?>
                    </div>
                    <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <div id="slide-tc-script" class="fabs-telecaller" style="bottom: 66%; position: fixed; margin: 1em; right: 0;">
            <a style='display: block; width: 50px; height: 50px; border-radius: 50%; text-align: center; color: white; margin: 0; box-shadow: 0px 5px 11px -2px rgba(0, 0, 0, 0.18), 0px 4px 12px -7px rgba(0, 0, 0, 0.15); cursor: pointer; -webkit-transition: all .1s ease-out; transition: all .1s ease-out; position: relative; background-color: #EB9B42' target="_blank" class="fab" tooltip="Share" title="Telecaller Script"><i style='position: inherit; color: #fff;' class="fa-icon fa-file"></i></a>
        </div>
        <?php include("telecaller_script.php"); ?>
</body>
</html>

<script src="<?php echo $head_url;?>/assets/js/jquery-1.10.2.js"></script>
<script src="<?php echo $head_url;?>/assets/js/jquery-ui.js"></script> 
<script src="<?php echo $head_url;?>/assets/js/jquery.validate.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="<?php echo $head_url;?>/assets/js/jquery.timepicker.js"></script>
<script src="<?php echo $head_url;?>/assets/js/easyResponsiveTabs.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo $head_url;?>/assets/js/query-validation.js?v=1"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#horizontal_details_tab').easyResponsiveTabs({
            type: 'default',
            width: 'auto',
            fit: true
        });
    });
    var loaded_qry_tab = false;
    var loaded_lead_alloc = false;
    var loaded_call_log = false;
    var loaded_show_history = false;
    function callAjaxData(e) {
        if(e.id == "one_lead") {
            var query_id = "<?php echo $qryyy_id; ?>";
            if(loaded_lead_alloc) return;
            if(query_id) {
                $.ajax({
                    type: "POST",
                    url: "/query/lead-display.php",
                    data: "query_id="+query_id,
                    beforeSend: function () {
                        $(".tab-3 > .facts > .register > .table_set").html('<div class="img">Please wait while we are fetching the details...</div><div class="img"><img style="width: 10%" src="<?php echo $head_url.'/assets/images/common-loader.gif';?>" /></div>');
                    },
                    success: function(msg) {
                        if(msg.trim() == "") {
                            $(".tab-3 > .facts > .register > .table_set").html("<h3>No Data Found</h3>");
                        } else {
                            $(".tab-3 > .facts > .register > .table_set").html(msg);
                        }
                    }
                });
            } else {
                $(".tab-3 > .facts > .register > .table_set").html("<h3>No Data Found</h3>");
            }
            loaded_lead_alloc = true;
        } else if(e.id == "call_log") {
            var  query_id= "<?php echo $qryyy_id; ?>";
            if(loaded_call_log) return;
            if(query_id) {
                $.ajax({
                    type: "POST",
                    url: "/crmdemo/query/call-log.php",
                    data: "query_id="+query_id,
                    beforeSend: function () {
                        $(".tab-2 > .facts > .register > .table_set").html('<div class="img">Please wait while we are fetching the details...</div><div class="img"><img style="width: 10%" src="<?php echo $head_url.'/assets/images/common-loader.gif';?>" /></div>');
                    },
                    success: function(msg) {
                        if(msg.trim() == "") {
                            $(".tab-2 > .facts > .register > .table_set").html("<h3>No Data Found</h3>");
                        } else {
                            $(".tab-2 > .facts > .register > .table_set").html(msg);
                        }
                    }
                });
            } else {
                $(".tab-2 > .facts > .register > .table_set").html("<h3>No Data Found</h3>");
            }
            loaded_call_log = true;
        } 
        else if(e.id == "show_history") {
            var  query_id= "<?php echo $qryyy_id; ?>";
            if(loaded_show_history) return;
            if(query_id) {
                $.ajax({
                    type: "POST",
                    url: "/crmdemo/query/show-history.php",
                    data: "query_id="+query_id,
                    beforeSend: function () {
                        $(".tab-4 > .facts > .register > .table_set").html('<div class="img">Please wait while we are fetching the details...</div><div class="img"><img style="width: 10%" src="<?php echo $head_url.'/assets/images/common-loader.gif';?>" /></div>');
                    },
                    success: function(msg) {
                        if(msg.trim() == "") {
                            $(".tab-4 > .facts > .register > .table_set").html("<h3>No Data Found</h3>");
                        } else {
                            $(".tab-4 > .facts > .register > .table_set").html(msg);
                        }
                    }
                });
            } else {
                $(".tab-4 > .facts > .register > .table_set").html("<h3>No Data Found</h3>");
            }
            loaded_show_history = true;
        }
    }
    function cng_status(val) {
        $(".fol_date, .fol_time").removeClass("hidden");
    }
</script>