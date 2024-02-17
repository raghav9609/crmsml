<?php
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../include/header.php');
require_once(dirname(__FILE__) . '/../model/loginHelper.php');
require_once(dirname(__FILE__) . '/../model/queryHelper.php');
$get_user = new userModel();
$get_qry_det = new queryModel();
$where = '1 ';
if (!empty($_REQUEST['active_users'])) {
    $user_id = replace_special($_REQUEST['active_users']);
    $where .= ' and assign_user = "'.$user_id.'"';
}
if ($user_role == 3) {
    $where .= ' and assign_user = "'.$user_id.'"';
}
if (!empty($_REQUEST['query_status'])) {
    $query_status = replace_special($_REQUEST['query_status']);
    $where .= ' and query_status = "'.$query_status.'"';
}
if (!empty($_REQUEST['fol_date'])) {
    $fol_date = replace_special($_REQUEST['fol_date']);
    $where .= ' and DATE(follow_up_date_time) = "'.$fol_date.'"';
}
$whr_arr = array($where);
$fup_qry = $get_qry_det->getQueryRecord('query_details',$columns_to_fetch = array("query_id, assign_user,query_status,follow_up_date_time,remarks"), $whr_arr,'Created_on', 'ASC', $offset, 11);
$fup_count = $db_handle->numRows($fup_qry);
$fup_res = $db_handle->runQuery($fup_qry);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Follow Up</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
        <link href="<?php echo $head_url; ?>/assets/css/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <style>
            td input[type='button']:nth-child(2) {
                float: left!important;
            }

            .filter-triangle,
            .filter-bar {
            position: absolute;
            top: 0;
            left: 0;
            width: 1em;
            text-align: center;
            color:#da6f13;
            }

            .filter-bar {
            top: 0.1em;
            }
            .status_label{
                top: 13px;
                position: relative;
                left: 10px;
            }
            table.gridtable th{
                text-align:left;
            }
            .switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 26px;
            }

            .switch input { 
            opacity: 0;
            width: 0;
            height: 0;
            }

            .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #dc2c2c;
            -webkit-transition: .4s;
            transition: .4s;
            }

            .slider:before {
            position: absolute;
            content: "";
            height: 18px;
            width: 18px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
            }

            input:checked + .slider {
            background-color: #008000;
            }

            input:focus + .slider {
            box-shadow: 0 0 1px #008000;
            }

            input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
            }

            /* Rounded sliders */
            .slider.round {
            border-radius: 34px;
            }

            .slider.round:before {
            border-radius: 50%;
            }
            .filter-icon{
                border: none;
                background: transparent;
                cursor: pointer;
            }
            .filter-icon img{
                width: 40px;
                margin-top: 12px;
                margin-right: 50px
            }
            .text-right{text-align:right;}
        </style>
    </head>
    <body leftmargin="0" topmargin="0">
            <div class="color-bar-1"></div>
            <div class="color-bar-2 color-bg"></div>
            <div class="container main-container">
            <div class="row">
                <!-- <div class="text-right">
                <span class="filter-icon" onclick="filterFunc()"><img src="<?php echo $head_url; ?>/assets/images/filter.png" alt="Filter"></span>
                </div> -->
                <div class="span9">
                
                <fieldset id="FilterView">
                    <legend>Followup Filter</legend>
                   
                    <form method="post" action="follow-up.php" name="searchfrm"  autocomplete="off" onsubmit="return filter_validation()"> 
                    <?php if($user_role != 3){
                        echo $get_drop_qry = get_dropdown('active_users','active_users',$user_id,''); 
                    } ?>                           
                        <?php  echo $get_drop_qry = get_dropdown('query_status','query_status',$query_status,''); ?>                       
                        <label for="fol_date" class="label-tag">Follow Up Date</label>
                        <input type="text" name="fol_date" id="fol_date" placeholder="yyyy-mm-dd" value="<?php if(!empty($fol_date)){ echo $fol_date; } ?>" class="valid onlybackspace" maxlength="10" autocomplete="off">
                        
                       
                        <input class="cursor" type="submit" name="searchsubmit" value="Filter">
                        <input class="cursor" type="button" onclick="resetform()" value="Clear">
                    </form>
                </fieldset>
                <form action="update.php" method="POST" onsubmit="return header_validation()">
                    <table width="95%" class="ml30 gridtable">
                        <tr>
                            <th>Query ID</th>
                            <th>Assign User</th>
                            <th>Disposition & Time</th>
                            <th>Remarks</th>
                            <th>Action</th>
                        </tr>
                        <?php
                        if($fup_count > 0) {
                            $record = 0;
                            foreach($fup_res as $exe_form) {
                                $record++;
                                if($record > 10) {
                                    continue;
                                }
                                $query_id            = $exe_form['query_id'];
                                $fup_status          = $exe_form['query_status'];
                                $fup_date_time       = $exe_form['follow_up_date_time'];
                                $remarks       = $exe_form['remarks'];
                                $assign_user       = $exe_form['assign_user'];

                                $user_fet = get_username('user_name', array('user_id = "'.$assign_user.'"'));
                                $user_name = $db_handle->runQuery($user_fet);
                                

                                $status_fet = get_query_status('description ',array('id ='.$fup_status));
								$stats_name = $db_handle->runQuery($status_fet);
                                
                                if($fup_date_time == '0000-00-00 00:00:00' || $fup_date_time == '1970-00-00 00:00:00' || $fup_date_time == ''){
                                    $due =  '-';
                                }else{
                                    $due = dateformat($fup_date_time);
                                }
                                ?>
                                    <tr>
                                        <td><?php echo $query_id; ?> </td>
                                        <td><?php echo $user_name[0][0]; ?> </td>
                                        <td><?php echo $stats_name[0][0] .'<br>'. $due; ?></td>
                                        <td><?php echo $remarks; ?>
                                        <td><a href="<?php echo $head_url; ?>/query/edit.php?ut=<?php echo $ut; ?>&id=<?php echo urlencode(base64_encode($query_id)); ?>" class="has_link"><input type="button" class="pointer_n" value="View" style="border-radius: 5px; background-color: #18375f; font-weight: bold;"></a> </td>
                                    </tr>
                                <?php }  } else {?>
                                <tr>
                                <td colspan = "4" align="center">
                                    No Record Found
                                </td>
                                </tr>
                                <?php } ?>
                    </table>
                </form>
                <?php if($fup_count > 10) { ?>
                    <table width="85%" style="float:left" border="0" align="center" cellpadding="4" cellspacing="1" class="pagination ml30">
                        <tr class="sidemain">
                            <td>
                                <?php
                                if($page > 1) {
                                    echo "<a class='page gradient' href='follow-up.php?page=1'>First</a>";
                                    echo "<a class='page gradient' href='follow-up.php?page=".($page - 1)."'>Prev</a>";
                                }
                                echo "<a class='page gradient' href='javascript:void;'>".$page."</a>";
                                if($fup_count > $display_count) {
                                    echo "<a class='page gradient' href='follow-up.php?page=".($page + 1)."'>Next</a>";
                                }
                                ?>
                            </td>
                        </tr>
                    </table>
                <?php
                }
            
            ?>
        </div>
<script src="<?php echo $head_url;?>/assets/js/jquery-1.10.2.js"></script>
<script src="<?php echo $head_url;?>/assets/js/jquery-ui.js"></script>        
<script>
    function resetform() {
        window.location.href = "follow-up.php";
    }

    function filterFunc() {
    var x = document.getElementById("FilterView");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
    }

    var minimum_days = 0;
    var maximum_days = 30;
    $('#fol_date').datepicker( {
        minDate: minimum_days,
        maxDate: maximum_days,
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd',
        autoclose: true,
    });

</script>
</body>
</html>