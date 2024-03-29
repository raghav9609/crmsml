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
if (isset($_REQUEST['query_statussearch'])) {
    $query_statussearch = replace_special($_REQUEST['query_statussearch']);
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
                window.location.href = "<?php echo $head_url; ?>/report/query-report.php";
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
                        $getreport = "SELECT usr.name As user_name,count(qry.id) As Total_count, stat.value As status FROM `crm_query` As qry left JOIN crm_master_user As usr ON qry.lead_assign_to = usr.id LEFT JOIN crm_master_status As stat ON qry.query_status = stat.id WHERE stat.status_type = 1 ";

                        if ($u_assign != '') {
                            $default = 1;
                                $getreport .= " and qry.lead_assign_to = '" . $u_assign . "'";
                        }
                        if ($query_statussearch != '') {
                            $default = 1;
                                $getreport .= " and qry.query_status = '" . $query_statussearch . "'";
                        }
                        if ($follow_date_from != '' && $follow_date_to != '') {
                            $default = 1;
                            $getreport .= " and qry.follow_date between '" . $follow_date_from . "' and '" . $follow_date_to . "' ";
                        }
                        if ($date_from != '' && $date_to != '') {
                            $default = 1;
                            $getreport .= " and date(qry.created_on) between '" . $date_from . "' and '" . $date_to . "' ";
                        }
                        $getreport .= " GROUP by qry.lead_assign_to,qry.query_status";
                        
                        $resreport = mysqli_query($Conn1,$getreport);
                        while($resdata = mysqli_fetch_array($resreport)){
                            if($resdata['user_name'] == ''){$userName = 'Unassigned'; } else {$userName = $resdata['user_name'];}
                            $datadisp[$userName][$resdata['status']] = $resdata['Total_count'];
                            $userdata[] = $userName;
                            $statusdata[] = $resdata['status'];
                        }
                    ?>

                    <fieldset>
                        <legend>Report Filter</legend>
                        <form method="post" action="query-report.php" name="searchfrm" autocomplete="off" onsubmit="return filter_validation()">
                            <input type="text" class="text-input" name="date_from" id="date_from" placeholder="Date From" maxlength="10" value="<?php echo $date_from; ?>" readonly="readonly" />
                            <input type="text" class="text-input" name="date_to" id="date_to" placeholder="Date To" maxlength="10" value="<?php echo $date_to; ?>" readonly="readonly" />
                            <?php echo get_dropdown('query_status', 'query_statussearch', $query_statussearch, '');
                            if ($user_role != 3) { 
                                echo get_dropdown('user_id_3', 'u_assign', $u_assign, ''); 
                            } ?>
                            <input type="text" class="text-input" name="follow_date_from" id="follow_date_from" placeholder="Follow Date From" maxlength="10" value="<?php echo $follow_date_from; ?>" readonly="readonly" />
                            <input type="text" class="text-input" name="follow_date_to" id="follow_date_to" placeholder="Follow Date To" maxlength="10" value="<?php echo $follow_date_to; ?>" readonly="readonly" />
                            <input class="cursor" type="submit" name="searchsubmit" value="Filter"><input class="cursor" type="button" onclick="resetform()" value="Clear">
                        </form>
                    </fieldset>

                    <h2>Query Report</h2>
                    <table width="80%" class="gridtable" style="margin-left:5%">
                        <tbody>
                            <tr>
                                <th width="10%">User Name </th>
                                <th width="10%">Open</th>
                                <th width="10%">Ringing</th>
                                <th width="10%">Ringing1</th>
                                <th width="10%">Ringing2</th>
                                <th width="10%">Ringing3</th>
                                <th width="10%">Finally Not contactable</th>
                                <th width="10%">Not Interested</th>
                                <th width="10%">Call Back</th>
                                <th width="10%">Future Prospect</th>
                                <th width="10%">Not Eligible - Cibil/Recent Bounces</th>
                                <th width="10%">Not Eligible Negative Profile</th>
                                <th width="10%">Not Eligible/Foir</th>
                                <th width="10%">Foir</th>
                            </tr>
                        <?php  foreach(array_unique($userdata) As $dat){?>
                            <tr>
                                <td><span><?php echo $dat;?> </span> </td>
                                <td><span><?php echo $datadisp[$dat]['Open'] > 0 ? $datadisp[$dat]['Open']:0;?> </span> </td>
                                <td><span><?php echo $datadisp[$dat]['Ringing'] > 0 ? $datadisp[$dat]['Ringing'] : 0 ;?> </span> </td>
                                <td><span><?php echo $datadisp[$dat]['Ringing1'] > 0 ? $datadisp[$dat]['Ringing1'] : 0;?> </span> </td>
                                <td><span><?php echo $datadisp[$dat]['Ringing2'] > 0 ? $datadisp[$dat]['Ringing2'] : 0;?> </span> </td>
                                <td><span><?php echo $datadisp[$dat]['Ringing3'] > 0 ? $datadisp[$dat]['Ringing3'] : 0;?> </span> </td>
                                <td><span><?php echo $datadisp[$dat]['Finally Not contactable'] > 0 ? $datadisp[$dat]['Finally Not contactable'] : 0;?> </span> </td>
                                <td><span><?php echo $datadisp[$dat]['Not Interested'] > 0 ? $datadisp[$dat]['Not Interested'] : 0;?> </span> </td>
                                <td><span><?php echo $datadisp[$dat]['Call Back'] > 0 ? $datadisp[$dat]['Call Back'] : 0;?> </span> </td>
                                <td><span><?php echo $datadisp[$dat]['Future Prospect'] > 0 ? $datadisp[$dat]['Future Prospect'] : 0;?> </span> </td>
                                <td><span><?php echo $datadisp[$dat]['Not Eligible - Cibil/Recent Bounces'] > 0 ? $datadisp[$dat]['Not Eligible - Cibil/Recent Bounces'] : 0;?> </span> </td>
                                <td><span><?php echo $datadisp[$dat]['Not Eligible Negative Profile'] > 0 ? $datadisp[$dat]['Not Eligible Negative Profile'] : 0;?> </span> </td>
                                <td><span><?php echo $datadisp[$dat]['Not Eligible/Foir'] > 0 ? $datadisp[$dat]['Not Eligible/Foir'] : 0;?> </span> </td>
                                <td><span><?php echo $datadisp[$dat]['Foir'] > 0 ? $datadisp[$dat]['Foir'] : 0;?> </span> </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>
