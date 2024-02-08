<?php
$query_id = $id;
?>
<script src="<?php echo $head_url; ?>/include/js/query-follow-up.js?version=1.83"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="../../include/css/style.css"/>
<style type="text/css">
    .query_follow li {
        color: blue;
    }
    .query_follow li:nth-child(odd) {
        color: #18365E;
    }

    .query_follow li:nth-child(even) {
        color: #d8450b;
    }
    .open>.dropdown-menu {
    display: block;
}
label.checkbox{
    margin-top:1px!important;
}

.multiselect-container {
    position: absolute!important;
    list-style-type: none!important;;
    margin: 0!important;
    padding: 0!important;
}
.dropdown-menu {
    z-index: 1000;
    display: none;
    float: left;
    padding: 5px 0;
    margin: 2px 0 0;
    font-size: 14px;
    text-align: left;
    list-style: none;
    background-color: #fff;
    border: 1px solid #ccc;
      left: -205px;
    width: 255px;
}
.add_checkbox{
    position: unset!important;
}

.dropdown-menu>li>a {
    display: block;
    padding: 3px 20px;
    clear: both;
    font-weight: 400;
    line-height: 1.42857143;
    color: #333;
    white-space: nowrap;
}
.multiselect{margin-top: 11px;border-radius: 0px!important;box-shadow: none!important;}

.multiselect-container>li>a {
    padding: 0;
}
b.caret{
    margin-left:228px!important;
    display: inline;
}
.dropdown-menu>li>a:focus, .dropdown-menu>li>a:hover {
    color: #262626;
    text-decoration: none;
    background-color: #f5f5f5;
}

.checkbox, .radio {
    position: relative;
    display: block;
    margin-top: 10px;
    margin-bottom: 10px;
}

.multiselect-container>li>a>label {
    margin: 0;
    height: 100%;
    cursor: pointer;
    font-weight: 400;
}


.multiselect-container>li>a>label.checkbox, .multiselect-container>li>a>label.radio {
    margin: 0;
}

.dropdown-menu>li>a {
    display: block;
    padding: 3px 20px;
    clear: both;
    font-weight: 400;
    line-height: 1.42857143;
    color: #333;
    white-space: nowrap;
}

.form-group label {
    font-size: 12px;
    font-weight: 500;
    width: 100px;
    color: #636363;
    display: block;
    background: #ffffff;
    padding: 3px 0px!important 0px 0px;
    cursor: text;
    -webkit-transition: all .3s ease 0ms;
    -moz-transition: all .3s ease 0ms;
    -ms-transition: all .3s ease 0ms;
    -o-transition: all .3s ease 0ms;
    transition: all .3s ease 0ms;
}
.border-class, .register textarea{
    width: 85%;
    outline: medium none;
    background: transparent none repeat scroll 0% 0%;
    border: none;
    border-bottom: 1px solid #eb9b42;
    height: 25px;
    font-family: roboto;
    font-size: 12px;
    color: #000;
    text-decoration: none;
    line-height: 1;
    text-align: left;
    }
    .multiple-sub-status-label{
        width: calc(100% - 30px);
        top: -18px;
        background: 0 0;
        color: #18375f;
        font-size: 12px;
        left: 15px;
    }
    </style>
<input type="button" class="cursor" name="ad_follow" id="ad_follow" value="Add Follow Up">
<div id="ad_form" style="display:none;border: 1px solid #CCC;padding:10px;">
    <form method="POST" id="follow_up_form">
    <input type="hidden" name="query_id" id="query_id" value="<?php echo $query_id; ?>">
    
    <div class="row div-width">       
        <div class="form-group col-xl-3 col-lg-4 col-md-6">
        <span class="fa-icon fa-list-alt"></span>
        <?php echo get_dropdown('status_', 'f_stats', '', 'onchange = "cng_status(this);" class="valid" required'); ?>
        <label for="f_stats" class="label-tag">Select Status</label>
        </div>
        <div class="new-heading-offers sub_status_div hidden"></div>
        <!-- Checkbox New status Div ends -->
        <div class="form-group col-xl-3 col-lg-4 col-md-6 hidden foll_type">
        <span class="fa-icon fa-tty"></span>
        <?php echo get_dropdown('follow_up_type', 'foll_type', '', 'class="hidden valid"'); ?>
        <label for="foll_type" class="label-tag">Select Follow Up Type</label>
        </div>        


        <div class="form-group col-xl-3 col-lg-4 col-md-6">
        <span class="fa-icon fa-user"></span>
        <select name='folow_given' id='folow_given' class="valid" required>
            <option value="">Feedback Given By</option>
			
                <option value='1'>Customer</option>
                <option value='2' selected="selected">SML User</option>
            
        </select>
        <label for="folow_given" class="label-tag">Feedback Given By</label>
        </div>
        
        <div class="form-group col-xl-3 col-lg-4 col-md-6 fol_date hidden">
        <span class="fa-icon fa-calendar"></span>
        <input type="text" name="fol_date" id="fol_date" placeholder="yyyy-mm-dd" class="hidden valid onlybackspace" maxlength="10" autocomplete="off">
        <label for="fol_date" class="label-tag">Follow Up Date</label>
        </div>
        <div class="form-group col-xl-3 col-lg-4 col-md-6 fol_time hidden">
        <span class="fa-icon fa-clock-o"></span>
        <input type="text" name="fol_time" id="fol_time" class="time hidden valid onlybackspace" placeholder="Follow Up Time" maxlength="8" autocomplete="off">
        <label for="fol_time" class="label-tag">Follow Up Time</label>
        </div>
        
        
        <div class="form-group col-xl-3 col-lg-4 col-md-6">
        <span class="fa-icon fa-commenting"></span>
        <textarea name="remark" id="remark" placeholder="Remarks" class="valid border-class" autocomplete="off"></textarea>
        <label for="remark" class="label-tag optional-tag">Remarks</label>
        </div>
        
        </div>
        <div class="form-group col-xl-12 col-lg-4 col-md-6">
        <input type="button" name="ad_query" id="ad_query" class="buttonsub cursor valid" value="Submit">
        </div>
    </form>
</div>

die();
<br><br>
<table class="gridtable " style="width:100%;" border="1">
    <?php
$followup_history_query = "SELECT fol.follow_id as follow_id, fol.follow_given_by as follow_given_by, fol.follow_date as follow_date,fol.follow_time as follow_time,fol.follow_type as follow_type, fol.description as description,fol.date as date,fol.time as time,fol.mlc_user_id as mlc_user_id,fol.follow_status as follow_status, lms_city.city_name as city_name, fol.ogl_pincode as pincode,user.user_name as user_name, fol.level_type_id as level_type_id, fol.level_reference_no as level_reference_no FROM tbl_mint_case_followup as fol  LEFT JOIN tbl_user_assign as user on fol.mlc_user_id = user.user_id LEFT JOIN lms_city on lms_city.city_id = fol.ogl_city_id WHERE fol.query_id = $id AND fol.query_flag = 1 ";
$ni_loan_type_arr = array(51, 52, 54);
if ($_SESSION['ni_user'] == 1 && $user_role == 3 && in_array($loan_type, $ni_loan_type_arr)) {
    $followup_history_query .= " AND (fol.mlc_user_id = $user OR fol.follow_type in (7, 8, 9,1003,1004,1009,1010) ) ";
}

$followup_history_query .= " ORDER BY fol.follow_id DESC ";

$query_follow_up = mysqli_query($Conn1, $followup_history_query);
$one = 0;
if (mysqli_num_rows($query_follow_up) > 0) {
    ?>
    <tr class="font-weight-bold">
        <th>Follow Up Status</th>
        <th>Update Date & Time</th>
        <th>Remarks</th>
        <th>User</th>
        <th>Pincode</th>
        <th>City</th>
        <th>Follow Date & Time & Type</th>
        <!-- <th>Status</th> -->
    </tr>
    <?php
while ($result_query = mysqli_fetch_array($query_follow_up)) {
        $one++;
        $f_date = ($result_query['follow_date'] == '0000-00-00' || $result_query['follow_date'] == "" || $result_query['follow_date'] == '1970-01-01') ? '--' : date("d-m-Y", strtotime($result_query['follow_date']));
        $follow_given_by_c = $result_query['follow_given_by'];
        $given_by = "MLC User";
        if ($follow_given_by_c == '1') {
            $given_by = "Customer";
        }else if ($follow_given_by_c == '5') {
            $given_by = "Auto FUP by Customer";
        } else if ($follow_given_by_c == '3') {
            $given_by = "Support Desk";
        } else if ($follow_given_by_c == '4') {
            $given_by = "Missed Call";
        }

        $level_type_id = $result_query['level_type_id'];
        $level_type_name = "";
        if ($level_type_id == 1) {
            $level_type_name = "<b class='fw_bold'>Level:</b> Query";
        } else if ($level_type_id == 2) {
            $level_type_name = "<b class='fw_bold'>Level:</b> Case";
        } else if ($level_type_id == 3) {
            $level_type_name = "<b class='fw_bold'>Level:</b> Application";
        }

        $level_reference_no = ($result_query['level_reference_no'] != "" && $result_query['level_reference_no'] != 0) ? "<b class='fw_bold'>Ref. No.:</b> " . $result_query['level_reference_no'] : "";

        $f_time = $result_query['follow_time'];
        $f_type = $result_query['follow_type'];
        $desc = $result_query['description'];
        $f_modified = ($result_query['date'] == "0000-00-00" || $result_query['date'] == "" || $result_query['date'] == "1970-01-01") ? "--" : date("d-m-Y", strtotime($result_query['date']));
        $follow_time = $result_query['time'];
//$mlc_user_id = $result_query['mlc_user_id'];
        $follow_status = $result_query['follow_status'];
        // $fol_time = (date('H:i a', strtotime($f_time)) == '00:00 am') ? '--' : date('H:i a', strtotime($f_time));
        $time_update = date('H:i:s a', strtotime($follow_time));
        $follow_up_name = $result_query['qy_status'];
        $user_name = $result_query['user_name'];
        $pincode_his = (trim($result_query['pincode']) != "" && $result_query['pincode'] != "0") ? $result_query['pincode'] : "--";
        $city_name = (trim($result_query['city_name']) != "" && trim($result_query['city_name'] != "0")) ? $result_query['city_name'] : "--";
        if ($f_date == "--" || $f_time == '') {
            $fol_time = "--";
        } else {
            $fol_time = (date('H:i a', strtotime($f_time)) == '00:00 am') ? '--' : date('H:i a', strtotime($f_time));
        }
        $fol_type = mysqli_query($Conn1, "select * from tbl_follow_status");
        while ($result_fol_type = mysqli_fetch_array($fol_type)) {
            $fol_type_name = $result_fol_type['follow_status'];
            $fol_type_id = $result_fol_type['follow_id'];
            if ($fol_type_id == $follow_status) {
                $seelct1 = "selected";
            } else {
                $seelct1 = "";
            }
            $foll_stats_arr[] = "<option " . $seelct1 . " value = '$fol_type_id'>" . $fol_type_name . "</option>";
        }
        $follow_up_name = get_display_name('query_status',$f_type);
        if($follow_up_name == ''){
            $follow_up_name = get_display_name('new_status_name',$f_type);;
        }
        $query_follow = mysqli_query($Conn1, "select * from tbl_follow_status where follow_id = $follow_status");
        $result_query_status = mysqli_fetch_array($query_follow);
        $follow_status_name = $result_query_status['follow_status'];
        if ($follow_status == 1) {
            $status = "<i class = 'fa fa-phone'></i>";
        } else if ($follow_status == 2) {
            $status = "<i class = 'fa fa-users'></i>";
        } else if ($follow_status == 3) {
            $status = "<i class = 'fa fa-book'></i>";
        } else {
            $status = "<i class = 'fa fa-close'></i>";
        }
        echo "<tr class='center-align'><td>" . $follow_up_name . "<br>(" . $given_by . ")" . $input_fname . "</td>
<td>" . $f_modified . " " . $time_update . "</td><td>" . $desc . "" . $input_desc . "<br>" . $level_type_name . " " . $level_reference_no . "</td><td>" . $user_name . "</td><td>" . $pincode_his . "</td><td>" . $city_name . "</td><td>" . $f_date . "<br>" . $fol_time . "<br>" . $status . "" . $input_type . "</td></tr>";
    }

}
?>
<div id="up_desc"></div>
</table>

<script type='text/javascript'>
$("#fol_time").focusout(function() {
    if($("#fol_time").val() != "") {
        $("#follow_up_time_t").val($("#fol_time").val());
    }
});
</script>