<?php
session_start();
$dialog_pop_up_disabled_flag = 1;
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../include/header.php');
require_once(dirname(__FILE__) . '/../config/config.php');
require_once "../include/helper.functions.php";
require_once "../include/display-name-functions.php";

$dialog_pop_up_disabled_flag = 1;
$level_id =3;

if (isset($_REQUEST['page'])) {
    $page = replace_special($_REQUEST['page']);
}
$case_id = replace_special(urldecode(base64_decode($_REQUEST['case_id'])));
$cust_id = replace_special(urldecode(base64_decode($_REQUEST['cust_id'])));
$loan_type = replace_special($_REQUEST['loan_type']);
$m_app = replace_special($_REQUEST['m_app']);
$ut = 2/*replace_special($_REQUEST['ut'])*/;

$loantype_name = get_display_name("loan_type",$loan_type);

$case_ch_qry = "select count(*) as cs_cnt,prop_city,query_id,loan_type from tbl_mint_case where case_id = " . $case_id . " and cust_id = " . $cust_id;
if ($user_role == 3 && $ut != 2) {
    $case_ch_qry .= " and (user_id = '" . $user . "' or secd_user_id = '" . $user . "')";
} else if (($user_role == 2 || $user_role == 4) && $ut != 2) {
    $case_ch_qry .= " and loan_type IN ($tl_loan_type)";
	if($user_role == 2){
		$case_ch_qry .= " and user_id IN ($tl_member,0) ";
	}
}

$ol_level_id = 3;
$ol_case_id = $case_id;
$ol_priority_id = str_replace(array('P','p'),'',$_REQUEST['priority']);
$ol_user_id = $user;
$ol_date = date("Y-m-d h:i:s");
if($_REQUEST['search_type'] == '' || $_REQUEST['search_type'] == 0){
        $search_type = 3;
    }else{
        $search_type = $_REQUEST['search_type'];
    }
        $insert_one_lead = mysqli_query($Conn1, "insert into one_lead_history set id = '" . $case_id . "', level_id = '3', priority_id = '".$ol_priority_id."', user_id = '".$user."', date = NOW(), search_type = '".$search_type."', url = '".$_SERVER['REQUEST_URI']."', referer_url = '".$_SERVER['HTTP_REFERER']."'");
    $last_view_id = mysqli_insert_id($Conn1);

$result_case_qry = mysqli_query($Conn1, $case_ch_qry);
$che_case = mysqli_fetch_row($result_case_qry);
$prop_city = $che_case[1];
$query_id = $che_case[2];
$total_cnt = $che_case[0];
$loan_type = $che_case[3];
if ($total_cnt <= 0){
    header("location:index.php");
    /*session_destroy();
    header('location:../../logout.php');*/
}else{
?>
<!DOCTYPE html>
<html>
<head>
    <link href = "../../include/css/jquery-ui.css" rel = "stylesheet">
    <script src = "../../include/js/jquery-1.10.2.js"></script>
    <script src = "../../include/js/jquery-ui.js"></script>
    <script type="text/javascript" src="../../include/js/jquery.timeentry.js"></script>
    <script src="../../include/js/jquery.timepicker.js"></script>
<link href="../../include/css/jquery.timepicker.min.css" rel="stylesheet"/> 
    <style>
        .resp-tab-content {
            /* display: block!important; */
        }
        .fixed_move_btn{
            right: 20.2%!important;
            padding: 3px!important;
        }

        /* Changes - AppEditStatusDialog - Akash - Starts */
        .box {
            width: 40%;
            margin: 0 auto;
            background: rgba(255,255,255,0.2);
            padding: 35px;
            border: 2px solid #fff;
            border-radius: 20px/50px;
            background-clip: padding-box;
            text-align: center;
        }
        
        .overlay {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.7);
            transition: opacity 500ms;
            visibility: hidden;
            opacity: 0;
            z-index: 1050;
        }
        .popup-overlay {
            visibility: visible;
            opacity: 1;
        }

        .popup {
            margin: 70px auto;
            border-radius: 5px;
            width: 80%;
            position: relative;
            overflow: hidden;
            transition: all 5s ease-in-out;
        }

        .popup h2 {
            margin-top: 0;
            color: #333;
            font-family: Tahoma, Arial, sans-serif;
        }
        .popup .close {
            position: absolute;
            top: 20px;
            right: 30px;
            transition: all 200ms;
            font-size: 30px;
            font-weight: bold;
            text-decoration: none;
            color: #333;
            color: white;
            right: 10;
            top: 0;
            font-size: 25px;
        }
        .popup .close:hover {
            color: #EB9B42;
        }
        .popup .content {
            overflow: auto;
            background: #fff;
        }
        .check-label {
            display: inline-block;
            text-rendering: auto;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            font-size: 20px;
            color: #000000;
            cursor: pointer;
            float: none!important;
            font-size: 13px;
            padding: 0px 5px;
            position: relative;
            width: auto;
        }
        #dialog-step input[type="checkbox"] {
            position: absolute;
            left: -99999px;
        }
        #dialog-step input[type="checkbox"]:checked~.checkbox:before {
            content: "\f046";
            -webkit-transition: all .3s ease 0s;
            -moz-transition: all .3s ease 0s;
            -ms-transition: all .3s ease 0s;
            -o-transition: all .3s ease 0s;
            transition: all .3s ease 0s;
        }
        #dialog-step input[type="checkbox"]~.checkbox:before {
            font: normal normal normal 18px/1 FontAwesome;
            content: '\f096';
            -webkit-transition: all .3s ease 0s;
            -moz-transition: all .3s ease 0s;
            -ms-transition: all .3s ease 0s;
            -o-transition: all .3s ease 0s;
            transition: all .3s ease 0s;
            padding-right: 5px;
            color: #eb6c04;
            vertical-align: middle;
        }
        .ft-sz-12 {
            font-size: 12px !important;
        }
        .un-ln {
            text-decoration: underline !important;
        }

        .dialog-cur:disabled {
            cursor: pointer;
        }
        /* Changes - AppEditStatusDialog - Akash - Ends */

    </style>
    <?php
    $email_qry = mysqli_query($Conn1, "select * from tbl_mint_customer_info where id =" . $cust_id);
    $result_mail_qry = mysqli_fetch_array($email_qry);
    $mail_cust = $result_mail_qry['email'];
    $mobile_status = $result_mail_qry['mobile_status'];
    $m_sub = "Your cashback on disbursement";
    $city_id_get = $result_mail_qry['city_id'];
    
    $customer_name      = $result_mail_qry['name']." ".$result_mail_qry['lname'];
    $customer_mobile    = $result_mail_qry['phone'];
    $city_name_query = mysqli_query($Conn1, "SELECT city_name FROM lms_city WHERE city_id = '".$city_id_get."' LIMIT 0, 1 ");
    $customer_city_name = mysqli_fetch_array($city_name_query)['city_name'];

    $qry_disb_on = "select * from tbl_mint_app where app_id = " . $m_app;
    $res_disb_on = mysqli_query($Conn1, $qry_disb_on);
    $exe_disb_on = mysqli_fetch_array($res_disb_on);
    $disb_email_flag = $exe_disb_on['disb_email_flag'];
    ?>
    <script type="text/javascript">
       <?php //if ($m_app != "" && $m_app != 0 && $mail_cust != "" && $disb_email_flag != 1){  ?>
            //traceObjectSelf($m_app." ".$mail_cust." ". $disb_email_flag);
        //     $msg = 'TO: ' . $mail_cust . '\n Subject: ' . $m_sub; ?>
        // $( document ).ready(function() {
        //     $("html body").css('overflow','hidden');
        //     var myPos = [ $(window).width() / 2, 50 ];
        //     var dialog = $('<p>Do u want to send disbursement email to customer?</p>').dialog({
        //         maxWidth:300,
        //         maxHeight: 200,
        //         width: 300,
        //         height: 200,
        //         modal: true,
        //         position: {
        //             my: "center",
        //             at: "center",
        //             of: $("#horizontalTab")
        //         },
        //         buttons: {
        //             "Yes": function() { 
                        
        //                 window.open("disb_app_mail.php?m_app=<?php echo $m_app;?>&case_id=<?php echo $case_id;?>&sub=<?php echo $m_sub;?>","_blank");

        //                 var red_url_y = "edit_applicaton.php?case_id=<?php echo $_REQUEST['case_id'];?>&cust_id=<?php echo $_REQUEST['cust_id'];?>&app_id=<?php echo $_REQUEST['app_id']; ?>&loan_type=<?php echo $_REQUEST['loan_type'];?>";

        //                 var temp_sd_flag = "<?php echo $_REQUEST['sd_flag']; ?>";
        //                 var temp_cl_flag = "<?php echo $_REQUEST['cl_flag']; ?>";

        //                 if(temp_sd_flag != "") {
        //                     red_url_y = red_url_y + "&sd_flag="+temp_sd_flag;
        //                 }
        //                 if(temp_cl_flag != "") {
        //                     red_url_y = red_url_y + "&cl_flag="+temp_cl_flag;
        //                 }

        //                 window.location.href = red_url_y;
        //             },
        //             "No":  function() {

        //                 var red_url_n = "edit_applicaton.php?case_id=<?php echo $_REQUEST['case_id'];?>&cust_id=<?php echo $_REQUEST['cust_id'];?>&app_id=<?php echo $_REQUEST['app_id']; ?>&loan_type=<?php echo $_REQUEST['loan_type'];?>";

        //                 var temp_sd_flag = "<?php echo $_REQUEST['sd_flag']; ?>";
        //                 var temp_cl_flag = "<?php echo $_REQUEST['cl_flag']; ?>";

        //                 if(temp_sd_flag != "") {
        //                     red_url_n = red_url_n + "&sd_flag="+temp_sd_flag;
        //                 }
        //                 if(temp_cl_flag != "") {
        //                     red_url_n = red_url_n + "&cl_flag="+temp_cl_flag;
        //                 }

        //                 window.location.href = red_url_n;
        //             }
        //         }
        //     });
        //     $(".ui-dialog-titlebar-close").click( function() {
        //         $("html body").css('overflow','auto');
        //     });
        // });
        <?php //}
         if($user_role == 3 && $_SESSION['one_lead_flag'] == 1 && $_REQUEST['upated'] == 1){ ?>
       $( document ).ready(function() {
           $("html body").css('overflow','hidden');
           var myPos = [ $(window).width() / 2, 50 ];
           var dialog = $('<p>Do u want to update any other details in this application?</p>').dialog({
               maxWidth:300,
               maxHeight: 200,
               width: 300,
               height: 200,
               modal: true,
               position: {
                   my: "center",
                   at: "center",
                   of: $("#horizontalTab")
               },
               buttons: {
                   "Yes": function() {
                       $("html body").css('overflow','auto');
                       dialog.dialog('close');
                   },
                   "No":  function() {
                       window.location.href="../all_query/user.php";}
               }
           });
           $(".ui-dialog-titlebar-close").click( function() {
               $("html body").css('overflow','auto');
           });
       });
        <?php } ?>
    </script>
</head>

<body>
<div style="width:100%">
    <div style="padding-left: 1%;padding-right: 1%;">
        <div id="fixed_tab">
            <?php $level_type = 3; ?>
            <?php echo common_call_btn($user, $Conn1, $result_mail_qry['phone'], 0, $case_id, 1, $level_type,$mobile_status,0,$loantype_name,$loan_type); ?>
            <a href="../email/send-email.php?case_id=<?php echo urlencode(base64_encode($case_id)); ?>"
               style="float:right;position: relative;z-index: 15;border: none;font-size: 13px;margin: 10px 5px;padding: 7px 16px;font-weight: normal;" class="buttonsub cursor valid">Send Email</a>
               <?php $docsrc="../customer-document/upload-document/index.php?cust_id=".base64_encode($cust_id)."&level_id=".urlencode(base64_encode($case_id))."&level_t=". base64_encode(3)?>
      <?php if($user_role==1 || $user_role==4){?>
      <a href="<?php echo $docsrc;?>" target='_blank' style='float:right;position: relative;z-index: 15;border: none;font-size: 13px;margin: 10px 5px;padding: 7px 16px;font-weight: normal;'  class="buttonsub"> Upload Document</a>
      <?php } ?>
        </div>
    </div>
</div>

<input type="hidden" id="c_customer_name" value="<?php echo $customer_name; ?>">
<input type="hidden" id="c_customer_city" value="<?php echo $customer_city_name; ?>">
<input type="hidden" id="c_customer_mobile" value="<?php echo $customer_mobile; ?>">

<input type="hidden" value="" id="c_app_status_change" name="c_app_status_change">
<?php
$qry_to_exe = "SELECT id, pre_login_status, app_status_on, sub_sub_status, app_bank_on, app_id FROM tbl_mint_app WHERE case_id = $case_id ";
if($_REQUEST['all_app'] != 1){
   $qry_to_exe .= " AND pre_login_status NOT IN (1015,1012,1013,1014,1020,1021,1393,1019)"; 
}

$dialog_box_query = mysqli_query($Conn1, $qry_to_exe);
if(mysqli_num_rows($dialog_box_query) > 0) {
?>
<div id="popup1" class="overlay">
	<div class="popup">
        <div style="font-size: 15px !important; font-weight: bold !important" class="blue-bg col-12 font-weight-nb pb-2 pt-2 white font-20">
            <span style="display: block; text-align: center">Application Status</span>
            <a class="close" id="cross-close" href="javascript:void();">&times;</a>
        </div>
		<div class="content" id="dialog-step">
            <p style="margin-top: 10px; display: flex; justify-content: center;" id="close_flag_msg" class="hidden green"></p>
            <div class="col-12 mb-2 d-flex">
                <div class="form-group col-xl-3 col-lg-3 col-md-6">
                    <label for="unknown-1" class="checkbox check-label"></label></span>
                </div>
                <div class="form-group col-xl-2 col-lg-2 col-md-6">
                    <label for="unknown-2" class="checkbox check-label ft-sz-12 un-ln">Status</label></span>
                </div>
                <div class="form-group col-xl-2 col-lg-2 col-md-6">
                    <label for="unknown-3" class="checkbox check-label ft-sz-12 un-ln">Sub Status</label></span>
                </div>
                <div class="form-group col-xl-2 col-lg-2 col-md-6">
                    <label for="unknown-4" class="checkbox check-label ft-sz-12 un-ln">Sub Sub Status</label></span>
                </div>
                <div class="form-group col-xl-2 col-lg-2 col-md-6">
                    <label for="unknown-5" class="checkbox check-label ft-sz-12 un-ln">Remarks</label></span>
                </div>
            </div>
            <form id="dialog-form-step" name="dialog-form-step" class="">
                <input type="hidden" value="<?php echo $case_id; ?>" name="dg_case_id" />
                <!-- Row - Starts -->
                <?php
                while($dialog_box_result = mysqli_fetch_array($dialog_box_query)) {
                    $new_dg_id  = $dialog_box_result['id'];
                ?>
                    <div class="col-12 mb-2 d-flex" id="pps_status_row_<?php echo $new_dg_id; ?>">
                        <div class="form-group col-xl-3 col-lg-3 col-md-6">
                            <span><input type="checkbox" class="bank_offers_checkbox valid" onclick="checkbox_change('<?php echo $new_dg_id; ?>', this)" name="bank_name_st[]" id="bank_name_st_<?php echo $new_dg_id; ?>" value="<?php echo $new_dg_id; ?>">
                            <label for="bank_name_st_<?php echo $new_dg_id; ?>" class="checkbox check-label ft-sz-12"> <?php echo get_display_name('bank_name', $dialog_box_result['app_bank_on']); ?> </label></span>
                        </div>
                        <div class="form-group col-xl-2 col-lg-2 col-md-6">
                            <span class="fa-icon fa-list-alt"></span>
                            <?php echo get_dropdown('status_', "dg_pre_$new_dg_id", $dialog_box_result['pre_login_status'],'class="dialog-cur valid form-control ft-sz-12" disabled onchange="dialog_status_change('.$new_dg_id.',this);" '); ?>
                        </div>

                        <?php $dialog_post_query = mysqli_query($Conn1, "SELECT status_id, description, fup_mandate_flag FROM status_master WHERE level_id = 3 AND (FIND_IN_SET('" . $loan_type . "',required_for_loan_type)  OR required_for_loan_type = '0') AND is_active = 1 AND parent_id = ".$dialog_box_result['pre_login_status']." AND parent_id > 0  ORDER BY description"); ?>

                        <div class="form-group col-xl-2 col-lg-2 col-md-6 ">
                            <span class="fa-icon fa-list-alt dg_pls_<?php echo $new_dg_id; ?> <?php echo (mysqli_num_rows($dialog_post_query) == 0) ? "hidden": ""; ?> "></span>
                            <select name="dg_post_<?php echo $new_dg_id; ?>" class="dialog-cur valid form-control ft-sz-12 dg_pls_<?php echo $new_dg_id; ?> <?php echo (mysqli_num_rows($dialog_post_query) == 0) ? "hidden": ""; ?> " id="dg_post_<?php echo $new_dg_id; ?>" disabled onchange="dialog_status_change('<?php echo $new_dg_id; ?>',this);">
                                <option value="">Select Sub Status</option>
                                <?php while($dialog_post_result = mysqli_fetch_assoc($dialog_post_query)) { ?>
                                    <option value="<?php echo $dialog_post_result['status_id']; ?>" <?php if($dialog_post_result['status_id'] == $dialog_box_result['app_status_on']){ echo 'selected';}?>><?php echo $dialog_post_result['description']; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <?php $dialog_sub_sub_query = mysqli_query($Conn1, "SELECT status_id, description, fup_mandate_flag FROM status_master WHERE level_id = 3 AND (FIND_IN_SET('" . $loan_type . "',required_for_loan_type) OR required_for_loan_type = '0') AND is_active = 1 AND parent_id = ".$dialog_box_result['app_status_on']." AND parent_id > 0 ORDER BY description"); ?>

                        <div class="form-group col-xl-2 col-lg-2 col-md-6">
                            <span class="fa-icon fa-list-alt dg_sss_<?php echo $new_dg_id; ?> <?php echo (mysqli_num_rows($dialog_sub_sub_query )== 0) ? "hidden": ""; ?> "></span>
                            <select name="dg_sub_<?php echo $new_dg_id; ?>" class="dialog-cur valid form-control ft-sz-12 dg_sss_<?php echo $new_dg_id; ?> <?php echo (mysqli_num_rows($dialog_sub_sub_query) == 0) ? "hidden": ""; ?> " disabled id="dg_sub_<?php echo $new_dg_id; ?>">
                                <option value="">Sub Sub Status</option>
                                <?php while($dialog_sub_sub_result = mysqli_fetch_assoc($dialog_sub_sub_query)){ ?>
                                    <option value="<?php echo $dialog_sub_sub_result['status_id']; ?>" <?php if($dialog_sub_sub_result['status_id'] == $dialog_box_result['sub_sub_status']){ echo 'selected';}?>><?php echo $dialog_sub_sub_result['description']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-xl-2 col-lg-2 col-md-6">
                            <span class="fa-icon fa-commenting"></span>
                            <textarea style="min-height: 32px !important" name="dg_remarks_<?php echo $new_dg_id; ?>" class="dialog-cur text valid form-control ft-sz-12" maxlength="200" disabled id="dg_remarks_<?php echo $new_dg_id; ?>"></textarea>
                        </div>
                    </div>
                <?php } ?>
                <!-- Row - Ends -->
                <div class="text-center col-12 mb-2" style="display: block; margin: auto">
                    <button class="btn btn-primary valid mr-2" id="dialog-submit-btn">Submit</button>
                    <button class="btn btn-primary valid" id="dialog-cancel-btn" >Cancel</button>
                </div>
            </form>
		</div>
	</div>
</div>
<?php } ?>

<div align="center">
    <div class="wrapper">

        <script type="application/x-javascript"> addEventListener("load", function () {
                setTimeout(hideURLbar, 0);
            }, false);

            function hideURLbar() {
                window.scrollTo(0, 1);
            } </script>
    </div>
    <div class="clear"></div>
    <?php
     if(in_array($user,$user_new_status) || in_array($loan_type,$loan_type_new_status) || new_staus_user_level == 1 ||  new_staus_loan_type_level == 1 || $user == 173){
        include('hl-journey-new-status/index.php');
    }else{
        include('hl-journey/index.php'); 
    }
     ?>
    <?php //if($user_role == 1){ ?>
        <div style="clear:both;padding:1%;"></div>
<!-- <div class='f_13 iframe_div hidden' style="padding:8px;width:89%;text-align:center;background-color:#000;color:#fff;">Document Link for Customer</div> -->
<div id='iframe_div'></div><?php  //}
    //include('../cases/insert_case.php');
    ?><br><br>
    <link href="../../include/css/tab_style.css" rel='stylesheet' type='text/css' />
<script src="../../include/js/easyResponsiveTabs.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
	    $('#horizontal_details_tab').easyResponsiveTabs({
		    type: 'default', //Types: default, vertical, accordion           
			width: 'auto', //auto or any width like 600px
			fit: true   // 100% fit in a container
        });
        
        var sd_flag = "<?php echo base64_decode($_REQUEST['sd_flag']); ?>";
        if(sd_flag != "") {
            var first_p = sd_flag.split('@#')[0];
            var sec_p   = sd_flag.split('@#')[1];
            status_dialog(first_p, sec_p);
        }

        var all_app = "<?php echo $_REQUEST['all_app']; ?>";
        if(all_app != "") {
            status_dialog("", "");
        }

        var cl_flag = "<?php echo $_REQUEST['cl_flag']; ?>";
        if(cl_flag != "") {
            $("#close_flag_msg").removeClass("hidden").html("Please close other applications as well!");
        } else {
            $("#close_flag_msg").addClass("hidden").html("");
        }

	});

</script>
<script>
    var loaded_case_details = false;
    var loaded_cust_info = false;
    var loaded_show_number = false;
    var loaded_call_log = false;
    var loaded_app_req_res = false;
    var loaded_bnk_mapp = false;
    var loaded_application = false;
    var loaded_one_lead = false;
    var loaded_page_summary = false;
    var loaded_cross_sell = false;
    var loaded_document = false;
    var loaded_follow_up = false;
    var loaded_pending_documnets = false;
    var loaded_missed_call = false;
    function callAjaxData(e) {
        //case_details, cust_info
        if(e.id == "case_details") {
            console.log("case_details");
            var cust_id = "<?php echo $cust_id; ?>";
            if(loaded_case_details) return;
            if(cust_id) {
                $.ajax({
                    type: "POST",
                    url: "../cases/ajax_insert_case.php",
                    data: "cust_id="+cust_id,
                    beforeSend: function () {
                        $(".tab-1 > .facts > .register > .table_set").html('<div class="img">Please wait while we are fetching the details...</div><div class="img"><img style="width: 10%" src="../../include/img/common-loader.gif" /></div>');
                    },
                    success: function(msg) {
                        console.log(msg);
                        if(msg.trim() == "") {
                            $(".tab-1 > .facts > .register > .table_set").html("<h3>No Data Found</h3>");
                        } else {
                            $(".tab-1 > .facts > .register > .table_set").html(msg);
                        }
                    }
                });
            } else {
                $(".tab-1 > .facts > .register > .table_set").html("<h3>No Data Found</h3>");
            }
            loaded_case_details = true;
        } else if(e.id == "cust_info") {
            console.log("cust_info");
            var cust_id = "<?php echo $cust_id; ?>";
            if(loaded_cust_info) return;
            if(cust_id) {
                $.ajax({
                    type: "POST",
                    url: "../insert/ajax_insert_cust_info.php",
                    data: "cust_id="+cust_id,
                    beforeSend: function () {
                        $(".tab-2 > .facts > .register > .table_set").html('<div class="img">Please wait while we are fetching the details...</div><div class="img"><img style="width: 10%" src="../../include/img/common-loader.gif" /></div>');
                    },
                    success: function(msg) {
                        console.log(msg);
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
            loaded_cust_info = true;
        } else if(e.id == "app_req_res") {
            console.log("app req res");
            if(loaded_app_req_res) return;
            var case_id = "<?php echo base64_decode($_REQUEST['case_id']); ?>";
            if(case_id) {
                $.ajax({
                    type: "POST",
                    url: "../app/case_app_req_res.php",
                    data: "case_id="+case_id,
                    beforeSend: function () {
                        $(".tab-3 > .facts > .register > .table_set").html('<div class="img">Please wait while we are fetching the details...</div><div class="img"><img style="width: 10%" src="../../include/img/common-loader.gif" /></div>');
                    },
                    success: function(msg) {
                        console.log(msg);
                        if(msg.trim() == "") {
                            $(".tab-3 > .facts > .register > .table_set").html("<h3>No Data Found</h3>");
                        } else {
                            $(".tab-3 > .facts > .register > .table_set").html(msg);
                            show_hide(".request_send");
                            show_hide(".response_recv");
                        }
                    }
                });
            } else {
                $(".tab-3 > .facts > .register > .table_set").html("<h3>No Data Found</h3>");
            }     
            loaded_app_req_res = true;
        } else if(e.id == "show_number") {
            console.log("show_number");
            if(loaded_show_number) return;
            var case_id = "<?php echo base64_decode($_REQUEST['case_id']); ?>";
            if(case_id) {
                $.ajax({
                    type: "POST",
                    url: "../insert/show_number_history.php",
                    data: "case_id="+case_id+"&type=app",
                    beforeSend: function () {
                        $(".tab-4 > .facts > .register > .table_set").html('<div class="img">Please wait while we are fetching the details...</div><div class="img"><img style="width: 10%" src="../../include/img/common-loader.gif" /></div>');
                    },
                    success: function(msg) {
                        console.log(msg);
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
            loaded_show_number = true;
        } else if(e.id == "call_log") {
            console.log("call log");
            if(loaded_call_log) return;
            var case_id = "<?php echo base64_decode($_REQUEST['case_id']); ?>";
            if(case_id) {
                $.ajax({
                    type: "POST",
                    url: "../insert/call_log.php",
                    data: "case_id="+case_id+"&type=app",
                    beforeSend: function () {
                        $(".tab-5 > .facts > .register > .table_set").html('<div class="img">Please wait while we are fetching the details...</div><div class="img"><img style="width: 10%" src="../../include/img/common-loader.gif" /></div>');
                    },
                    success: function(msg) {
                        console.log(msg);
                        if(msg.trim() == "") {
                            $(".tab-5 > .facts > .register > .table_set").html("<h3>No Data Found</h3>");
                        } else {
                            $(".tab-5 > .facts > .register > .table_set").html(msg);
                        }
                    }
                });
            } else {
                $(".tab-5 > .facts > .register > .table_set").html("<h3>No Data Found</h3>");
            }
            loaded_call_log = true;
        } else if(e.id == "bnk_mapp") {
            console.log("bank mapp log");
            if(loaded_bnk_mapp) return;
            var case_id = "<?php echo base64_decode($_REQUEST['case_id']); ?>";
			var loan_type="<?php echo $loan_type;?>";
			if(loan_type == 51 || loan_type == 54){
				var city_id = "<?php echo $prop_city;?>";
			} else {
			var city_id = "<?php echo $city_id_get;?>";
			}
            if(case_id) {
                $.ajax({
                    type: "POST",
                    url: "../insert/bankers_mapping.php",
                    data: "case_id="+case_id+"&type=app&loan_type="+loan_type+"&city_id="+city_id,
                    beforeSend: function () {
                        $(".tab-6 > .facts > .register > .table_set").html('<div class="img">Please wait while we are fetching the details...</div><div class="img"><img style="width: 10%" src="../../include/img/common-loader.gif" /></div>');
                    },
                    success: function(msg) {
                        console.log(msg);
                        if(msg.trim() == "") {
                            $(".tab-6 > .facts > .register > .table_set").html("<h3>No Data Found</h3>");
                        } else {
                            $(".tab-6 > .facts > .register > .table_set").html(msg);
                        }
                    }
                });
            } else {
                $(".tab-6 > .facts > .register > .table_set").html("<h3>No Data Found</h3>");
            }
            loaded_bnk_mapp = true;
        } else if(e.id == "app_app") {
            console.log("application tab");
            if(loaded_application) return;
            var case_id = "<?php echo base64_decode($_REQUEST['case_id']); ?>";
            var cust_id = "<?php echo $cust_id; ?>";
            var loan_type = "<?php echo $loan_type; ?>";
            if(case_id && cust_id && loan_type) {
                $.ajax({
                    type: "POST",
                    url: "../insert/ajax_insert_cust_query_history.php",
                    data: "case_id="+case_id+"&loan_type="+loan_type+"&cust_id="+cust_id+"&type=app",
                    beforeSend: function () {
                        $(".tab-7 > .facts > .register > .table_set").html('<div class="img">Please wait while we are fetching the details...</div><div class="img"><img style="width: 10%" src="../../include/img/common-loader.gif" /></div>');
                    },
                    success: function(msg) {
                        console.log(msg);
                        if(msg.trim() == "") {
                            $(".tab-7 > .facts > .register > .table_set").html("<h3>No Data Found</h3>");
                        } else {
                            $(".tab-7 > .facts > .register > .table_set").html(msg);
                        }
                    }
                });
            } else {
                $(".tab-7 > .facts > .register > .table_set").html("<h3>No Data Found</h3>");
            }
            loaded_application = true;
        } else if(e.id == "one_lead") {
            var case_id = "<?php echo base64_decode($_REQUEST['case_id']); ?>";
            console.log(case_id);
            if(loaded_one_lead) return;
            if(case_id) {
                $.ajax({
                    type: "POST",
                    url: "../insert/one_lead_history.php",
                    data: "case_id="+case_id+"&type=app",
                    beforeSend: function () {
                        $(".tab-8 > .facts > .register > .table_set").html('<div class="img">Please wait while we are fetching the details...</div><div class="img"><img style="width: 10%" src="../../include/img/common-loader.gif" /></div>');
                    },
                    success: function(msg) {
                        console.log(msg);
                        if(msg.trim() == "") {
                            $(".tab-8 > .facts > .register > .table_set").html("<h3>No Data Found</h3>");
                        } else {
                            $(".tab-8 > .facts > .register > .table_set").html(msg);
                        }
                    }
                });
            } else {
                $(".tab-8 > .facts > .register > .table_set").html(msg);
            }
            loaded_one_lead = true;
        } else if(e.id == "page_summary") {
            var case_id = "<?php echo base64_decode($_REQUEST['case_id']); ?>";
            var query_id = 0;
            console.log(case_id);
            if(loaded_page_summary) return;
            if(case_id) {
                $.ajax({
                    type: "POST",
                    url: "../insert/page_submit_summary.php",
                    data: "case_id="+case_id+"&query_id="+query_id,
                    beforeSend: function () {
                        $(".tab-9 > .facts > .register > .table_set").html('<div class="img">Please wait while we are fetching the details...</div><div class="img"><img style="width: 10%" src="../../include/img/common-loader.gif" /></div>');
                    },
                    success: function(msg) {
                        if(msg.trim() == "") {
                            $(".tab-9 > .facts > .register > .table_set").html("<h3>No Data Found</h3>");
                        } else {                            
                            $(".tab-9 > .facts > .register > .table_set").html(msg);
                        }
                    }
                });
            } else {
                $(".tab-9 > .facts > .register > .table_set").html("<h3>No Data Found</h3>");
            }
            loaded_page_summary = true;
        } else if(e.id == "cross_sell") {
            var case_id = "<?php echo base64_decode($_REQUEST['case_id']); ?>";
            if(loaded_cross_sell) return;
            if(case_id) {
                $.ajax({
                    type: "POST",
                    url: "../insert/cross_sell_details.php",
                    data: "case_id="+case_id+"&type=app&query_id=0",
                    beforeSend: function () {
                        $(".tab-10 > .facts > .register > .table_set").html('<div class="img">Please wait while we are fetching the details...</div><div class="img"><img style="width: 10%" src="../../include/img/common-loader.gif" /></div>');
                    },
                    success: function(msg) {
                        console.log(msg);
                        if(msg.trim() == "") {
                            $(".tab-10 > .facts > .register > .table_set").html("<h3>No Data Found</h3>");
                        } else {
                            $(".tab-10 > .facts > .register > .table_set").html(msg);
                        }
                    }
                });
            } else {
                $(".tab-10 > .facts > .register > .table_set").html("<h3>No Data Found</h3>");
            }
            loaded_cross_sell = true;
        }else if(e.id == 'documents'){
            if(loaded_document) return;
                $.ajax({
                    type: "POST",
                    url: "../customer-document/edit.php?tab=1&cust_id=<?php echo base64_encode($cust_id) ?>",
                    beforeSend: function () {
                        $(".tab-11 > .facts > .register > .table_set").html('<div class="img">Please wait while we are fetching the details...</div><div class="img"><img style="width: 10%" src="../../include/img/common-loader.gif" /></div>');
                    },
                    success: function(msg) {
                        console.log(msg);
                        if(msg.trim() == "") {
                            $(".tab-11 > .facts > .register > .table_set").html("<h3>No Data Found</h3>");
                        } else {                            
                            $(".tab-11 > .facts > .register > .table_set").html(msg);
                        }
                    }
                });
            loaded_document = true;
        } else if(e.id == "follow_up_history") {
            if(loaded_follow_up) return;
            var case_id = "<?php echo base64_decode($_REQUEST['case_id']); ?>";
            $.ajax({
                type: "POST",
                url: "../insert/application_followup.php?case_id="+case_id,
                beforeSend: function () {
                    $(".tab-12 > .facts > .register > .table_set").html('<div class="img">Please wait while we are fetching the details...</div><div class="img"><img style="width: 10%" src="../../include/img/common-loader.gif" /></div>');
                },
                success: function(msg) {
                    console.log(msg);
                    if(msg.trim() == "") {
                        $(".tab-12 > .facts > .register > .table_set").html("<h3>No Data Found</h3>");
                    } else {                            
                        $(".tab-12 > .facts > .register > .table_set").html(msg);
                    }
                }
            });
            loaded_follow_up = true;
        }else if(e.id == "pending_documents") {
            if(loaded_pending_documnets) return;
            var case_id = "<?php echo base64_decode($_REQUEST['case_id']); ?>";
            $.ajax({
                type: "POST",
                url: "../insert/pending-documents.php?case_id="+case_id,
                beforeSend: function () {
                    $(".tab-13 > .facts > .register > .table_set").html('<div class="img">Please wait while we are fetching the details...</div><div class="img"><img style="width: 10%" src="../../include/img/common-loader.gif" /></div>');
                },
                success: function(msg) {
                    console.log(msg);
                    if(msg.trim() == "") {
                        $(".tab-13 > .facts > .register > .table_set").html("<h3>No Data Found</h3>");
                    } else {                            
                        $(".tab-13 > .facts > .register > .table_set").html(msg);
                    }
                }
            });
            loaded_pending_documnets = true;
        } else if(e.id == "missed_call_log") {
            var cust_phone = "<?php echo $customer_mobile; ?>";
            if(loaded_missed_call) return;
            if(cust_phone) {
                $.ajax({
                    type: "POST",
                    url: "../insert/missed_call_log.php",
                    data: "type=app&cust_phone="+cust_phone,
                    beforeSend: function () {
                        $(".tab-14 > .facts > .register > .table_set").html('<div class="img">Please wait while we are fetching the details...</div><div class="img"><img style="width: 10%" src="../../include/img/common-loader.gif" /></div>');
                    },
                    success: function(msg) {
                        if(msg.trim() == "") {
                            $(".tab-14 > .facts > .register > .table_set").html("<h3>No Data Found</h3>");
                        } else {
                            $(".tab-14 > .facts > .register > .table_set").html(msg);
                        }
                    }
                });
            } else {
                $(".tab-14 > .facts > .register > .table_set").html("<h3>No Data Found</h3>");
            }
            loaded_missed_call = true;
        }
    }
</script>
<br>
<div style="width: 90%; clear: both; margin: 0 auto;">
    <div class="main">
        <div class="sap_tabs" style="width: 100%">	
            <div id="horizontal_details_tab" style="display: block; width: 100%; margin: 0px;">
                <ul class="resp-tabs-list">
                    <li class="resp-tab-item tab-view" aria-controls="details_tab_1" id="case_details" role="tab" onclick="callAjaxData(this)">
                        <span>Case Detail</span>
                    </li>
                    <li class="resp-tab-item lost tab-view" aria-controls="details_tab_2"  id="cust_info"  role="tab" onclick="callAjaxData(this)">
                        <span>Customer Info</span>
                    </li>
                    <li class="resp-tab-item lost tab-view" aria-controls="details_tab_3"  id="app_req_res"  role="tab" onclick="callAjaxData(this)">
                        <span>Api Response</span>
                    </li>
                    <li class="resp-tab-item lost tab-view" aria-controls="details_tab_4"  id="show_number"  role="tab" onclick="callAjaxData(this)">
                        <span>Show Number</span>
                    </li>
                    <li class="resp-tab-item lost tab-view" aria-controls="details_tab_5"  id="call_log"  role="tab" onclick="callAjaxData(this)">
                        <span>Call Log</span>
                    </li>
					<li class="resp-tab-item lost tab-view" aria-controls="details_tab_6"  id="bnk_mapp"  role="tab" onclick="callAjaxData(this)">
                        <span>Banker</span>
                    </li>
                    <li class="resp-tab-item lost tab-view" aria-controls="details_tab_7"  id="app_app"  role="tab" onclick="callAjaxData(this)">
                        <span>Application</span>
                    </li>
                    <li class="resp-tab-item lost tab-view" aria-controls="details_tab_8"  id="one_lead"  role="tab" onclick="callAjaxData(this)">
                        <span>Lead Display</span>
                    </li>
                    <li class="resp-tab-item lost tab-view" aria-controls="details_tab_9"  id="page_summary"  role="tab" onclick="callAjaxData(this)">
                        <span>Summary</span>
                    </li>
                    <li class="resp-tab-item lost tab-view" aria-controls="details_tab_10"  id="cross_sell"  role="tab" onclick="callAjaxData(this)">
                        <span>Cross Sell</span>
                    </li>
                    <li class="resp-tab-item lost tab-view" aria-controls="details_tab_11"  id="documents"  role="tab" onclick="callAjaxData(this)">
                        <span>Documents</span>
                    </li>
                    <li class="resp-tab-item lost tab-view" aria-controls="details_tab_12"  id="follow_up_history"  role="tab" onclick="callAjaxData(this)">
                        <span>Follow Up</span>
                    </li>
                     <li class="resp-tab-item lost tab-view" aria-controls="details_tab_13"  id="pending_documents"  role="tab" onclick="callAjaxData(this)">
                        <span>Pending Docs</span>
                    </li>
                    <li class="resp-tab-item lost tab-view" aria-controls="details_tab_14"  id="missed_call_log" role="tab" onclick="callAjaxData(this)">
                        <span>Missed Call</span>
                    </li>
                    <div class="clear"></div>
                </ul>
                <div class="resp-tabs-container">
                    <div class="tab-1 resp-tab-content" aria-labelledby="details_tab_1">
                        <div class="facts">
                            <div class="register">
                                <div class="table_set">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-2 resp-tab-content" aria-labelledby="details_tab_2">
                        <div class="facts">
                            <div class="register">
                                <div class="table_set">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-3 resp-tab-content" aria-labelledby="details_tab_3">
                        <div class="facts">
                            <div class="register">
                                <div class="table_set">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-4 resp-tab-content" aria-labelledby="details_tab_4">
                        <div class="facts">
                            <div class="register">
                                <div class="table_set">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-5 resp-tab-content" aria-labelledby="details_tab_5">
                        <div class="facts">
                            <div class="register">
                                <div class="table_set">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="tab-6 resp-tab-content" aria-labelledby="details_tab_6">
                        <div class="facts">
                            <div class="register">
                                <div class="table_set">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-7 resp-tab-content" aria-labelledby="details_tab_7">
                        <div class="facts">
                            <div class="register">
                                <div class="table_set">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-8 resp-tab-content" aria-labelledby="details_tab_8">
                        <div class="facts">
                            <div class="register">
                                <div class="table_set">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-9 resp-tab-content" aria-labelledby="details_tab_9">
                        <div class="facts">
                            <div class="register">
                                <div class="table_set">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-10 resp-tab-content" aria-labelledby="details_tab_10">
                        <div class="facts">
                            <div class="register">
                                <div class="table_set">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-11 resp-tab-content" aria-labelledby="details_tab_11">
                        <div class="facts">
                            <div class="register">
                                <div class="table_set">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-12 resp-tab-content" aria-labelledby="details_tab_12">
                        <div class="facts">
                            <div class="register">
                                <div class="table_set">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-13 resp-tab-content" aria-labelledby="details_tab_13">
                        <div class="facts">
                            <div class="register">
                                <div class="table_set">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-14 resp-tab-content" aria-labelledby="details_tab_14">
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
<div style="clear: both; padding: 2%;"></div>
</div>
</div>
</body>
<?php
//include("app_function.php");
}
include("../../include/footer_close.php");
?>
<script>
function callReqResAjax(app_id, pat_id) {
  if(!isNaN(app_id)) {
    $.ajax({
      type: "POST",
      url: "app_req_res.php",
      data: "app_id=" + app_id + "&pat_id=" + pat_id,
      success: function(msg) {        
        if(msg) {
          $("#req_res_div_"+pat_id).html(msg);
          // $('table').find('#req_res_div_'+pat_id).append(msg);
        } else {
          $("#req_res_div_"+pat_id).html("<h3>Data not found</h3>");
          // $('table').find('#req_res_div_'+pat_id).append(msg);
        }
      }
    });
  } else {
    alert("Invalid Application Id");
  }
}

    function show_hide(class_name) {
        var maxLength = 100;
        $(class_name).each(function() {
            var myStr = $(this).text();
            if($.trim(myStr).length > maxLength) {
                var newStr = myStr.substring(0, maxLength);
                var removedStr = myStr.substring(maxLength, $.trim(myStr).length);
                $(this).empty().html(newStr);
                $(this).append(' <a href="javascript:void(0);" class="read-more"> Read more... </a>');
                $(this).append('<span class="more-text hidden">' + removedStr + '<a href="javascript:void(0);" class="read-less"> Read less... </a> </span>');
            }
        });

        $(".read-more").click(function() {
            $(this).siblings(".more-text").removeClass("hidden");
            $(this).addClass("hidden");
        });

        $(".read-less").click(function() {
            $(this).parent().addClass("hidden");
            $(this).parent().prev().removeClass("hidden");
        });
    }
    function open_iframe(application_id_to_open){
        $(".iframe_div").removeClass("hidden");
        $('html, body').animate({
        'scrollTop' : $("#switch_step99").position().top
    });
        $("#iframe_div").html("");
         $("#iframe_div").html("<iframe style='width:89%;height:350px' src='https://myloancrm.com/sugar/customer-document/documents-for-customer.php?level_id="+application_id_to_open+"&level_type=Mw=='></iframe>");
    }
     $(".fol_time").timeEntry();

</script>
</body>
</html>