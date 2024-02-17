<?php 
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../include/header.php');
require_once(dirname(__FILE__) . '/../config/config.php');

require_once(dirname(__FILE__) . '/../include/helper.functions.php');
require_once(dirname(__FILE__) . '/../include/display-name-functions.php');

if (isset($_REQUEST['u_assign'])) {
    $u_assign = replace_special($_REQUEST['u_assign']);
}
if (isset($_REQUEST['date_from'])) {
    $date_from = replace_special($_REQUEST['date_from']);
}
if (isset($_REQUEST['date_to'])) {
    $date_to = replace_special($_REQUEST['date_to']);
}
if (isset($_REQUEST['follow_date_from'])) {
    $follow_date_from = replace_special($_REQUEST['follow_date_from']);
}
if (isset($_REQUEST['follow_date_to'])) {
    $follow_date_to = replace_special($_REQUEST['follow_date_to']);
}
if (isset($_REQUEST['application_status'])) {
    $application_status = replace_special($_REQUEST['application_status']);
}
?>
<!DOCTYPE html>
    <html>

    <head>
        <link rel="stylesheet" href="../assets/css/jquery-ui.css">
        <script type="text/javascript" src="../assets/js/jquery-1.10.2.js"></script>
        <script type="text/javascript" src="../assets/js/jquery-ui.js"></script>
        <script>
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
            });

            function resetform() {
                window.location.href = "<?php echo $head_url; ?>/report/app-report.php";
            }
            function filter_validation() {
                if ($("#email_search").val().trim() != "") {
                    var email_regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
                    if (!email_regex.test($("#email_search").val())) {
                        alert("Customer Email not valid")
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
            <!-- End Header -->

            <div class="row">
                <!--Container row-->
                <!-- Title Header -->
                <div class="span9">
                    <?php 
                        $getappreport = "SELECT usr.name As user_name,count(app.id) As Total_count, stat.value As status FROM `crm_query_application` As app left JOIN crm_master_user As usr ON app.user_id = usr.id LEFT JOIN crm_master_status As stat ON app.application_status = stat.id WHERE stat.status_type = 2 ";

                        if ($u_assign != '') {
                            $default = 1;
                            $getappreport .= " and app.user_id = '" . $u_assign . "'";
                        }
                        if ($application_status != '') {
                            $default = 1;
                            $getappreport .= " and app.application_status = '" . $application_status . "'";
                        }
                        if ($follow_date_from != '' && $follow_date_to != '') {
                            $default = 1;
                            $getappreport .= " and app.follow_up_date between '" . $follow_date_from . "' and '" . $follow_date_to . "' ";
                        }
                        if ($date_from != '' && $date_to != '') {
                            $default = 1;
                            $getappreport .= " and date(app.created_on) between '" . $date_from . "' and '" . $date_to . "' ";
                        }
                        $getappreport .= " GROUP by app.application_status,app.user_id";
                        $resappreport = mysqli_query($Conn1,$getappreport);
                        while($resappdata = mysqli_fetch_array($resappreport)){
                            if($resappdata['user_name'] == ''){$userappName = 'Unassigned'; } else {$userappName = $resappdata['user_name'];}
                            $datadisp[$userappName][$resappdata['status']] = $resappdata['Total_count'];
                            $userdata[] = $userappName;
                            $statusdata[] = $resappdata['status'];
                        }
                    ?>

                    <fieldset>
                        <legend>Report Filter</legend>
                        <form method="post" action="app-report.php" name="searchfrm" autocomplete="off" onsubmit="return filter_validation()">
                            <input type="text" class="text-input" name="date_from" id="date_from" placeholder="Date From" maxlength="10" value="<?php echo $date_from; ?>" readonly="readonly" />
                            <input type="text" class="text-input" name="date_to" id="date_to" placeholder="Date To" maxlength="10" value="<?php echo $date_to; ?>" readonly="readonly" />
                            <?php echo get_dropdown('application_status', 'application_status', $application_status, ''); 
                            if ($user_role != 3) { 
                                echo get_dropdown('user_id_3', 'u_assign', $u_assign, ''); 
                            } ?>
                            <input type="text" class="text-input" name="follow_date_from" id="follow_date_from" placeholder="Follow Date From" maxlength="10" value="<?php echo $follow_date_from; ?>" readonly="readonly" />
                            <input type="text" class="text-input" name="follow_date_to" id="follow_date_to" placeholder="Follow Date To" maxlength="10" value="<?php echo $follow_date_to; ?>" readonly="readonly" />
                            <input class="cursor" type="submit" name="searchsubmit" value="Filter"><input class="cursor" type="button" onclick="resetform()" value="Clear">
                        </form>
                    </fieldset>

                    <h2>Application Report</h2>
                    <table width="80%" class="gridtable" style="margin-left:5%">
                        <tbody>
                            <tr>
                                <th width="10%">User Name </th>
                                <th width="10%">Attempted - Call Back</th>
                                <th width="10%">Follow Up</th>
                                <th width="10%">Login</th>
                                <th width="10%">Sanction</th>
                                <th width="10%">Disbursed</th>
                                <th width="10%">Not Eligible/Foir</th>
                                <th width="10%">Not Interested</th>
                                <th width="10%">Not Eligible Negative Profile</th>
                                <th width="10%">Future Prospect</th>
                                <th width="10%">Not Eligible - Cibil/ Recent Bounces</th>
                                <th width="10%">Sent to Bank</th>
                            </tr>
                            <?php  foreach(array_unique($userdata) As $dat){?>
                            <tr>
                                <td><span><?php echo $dat;?> </span> </td>
                                <td><span><?php echo $datadisp[$dat]['Attempted - Call Back'];?> </span> </td>
                                <td><span><?php echo $datadisp[$dat]['Follow Up'];?> </span> </td>
                                <td><span><?php echo $datadisp[$dat]['Login'];?> </span> </td>
                                <td><span><?php echo $datadisp[$dat]['Sanction'];?> </span> </td>
                                <td><span><?php echo $datadisp[$dat]['Disbursed'];?> </span> </td>
                                <td><span><?php echo $datadisp[$dat]['Not Eligible/Foir'];?> </span> </td>
                                <td><span><?php echo $datadisp[$dat]['Not Interested'];?> </span> </td>
                                <td><span><?php echo $datadisp[$dat]['Not Eligible Negative Profile'];?> </span> </td>
                                <td><span><?php echo $datadisp[$dat]['Future Prospect'];?> </span> </td>
                                <td><span><?php echo $datadisp[$dat]['Not Eligible - Cibil/ Recent Bounces'];?> </span> </td>
                                <td><span><?php echo $datadisp[$dat]['Sent to Bank'];?> </span> </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>
