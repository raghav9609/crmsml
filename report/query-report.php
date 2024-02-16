<?php 
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../include/header.php');
require_once(dirname(__FILE__) . '/../config/config.php');
if (isset($_REQUEST['u_assign'])) {
    $u_assign = replace_special($_REQUEST['u_assign']);
}
if (isset($_REQUEST['date_from'])) {
    $date_from = replace_special($_REQUEST['date_from']);
}
if (isset($_REQUEST['date_to'])) {
    $date_to = replace_special($_REQUEST['date_to']);
}

if (isset($_REQUEST['query_status'])) {
    $query_status = replace_special($_REQUEST['query_status']);
}

if (isset($_REQUEST['application_status'])) {
    $application_status = replace_special($_REQUEST['application_status']);
}

$getreport = "SELECT usr.name As user_name,count(qry.id) As Total_count, stat.value As status FROM `crm_query` As qry left JOIN crm_master_user As usr ON qry.lead_assign_to = usr.id LEFT JOIN crm_master_status As stat ON qry.query_status = stat.id WHERE stat.status_type = 1 ";

if ($u_assign != '') {
    $default = 1;
        $getreport .= " and qry.lead_assign_to = '" . $u_assign . "'";
}
if ($query_status != '') {
    $default = 1;
        $getreport .= " and qry.query_status = '" . $query_status . "'";
}
if ($follow_date_from != '' && $follow_date_to != '') {
    $default = 1;
    $getreport .= " and qry.follow_date between '" . $follow_date_from . "' and '" . $follow_date_to . "' ";
}
if ($date_from != '' && $date_to != '') {
    $default = 1;
    $getreport .= " and date(qry.created_on) between '" . $date_from . "' and '" . $date_to . "' ";
}
$getreport .= " GROUP by qry.query_status,qry.lead_assign_to";


echo $getreport;

$resreport = mysqli_query($Conn1,$getreport);

$getappreport = "SELECT usr.name As user_name,count(app.id) As Total_count, stat.value As status FROM `crm_query_application` As app left JOIN crm_master_user As usr ON app.user_id = usr.id LEFT JOIN crm_master_status As stat ON app.application_status = stat.id WHERE stat.status_type = 2 ";

if ($u_assign != '') {
    $default = 1;
    $getappreport .= " and qry.lead_assign_to = '" . $u_assign . "'";
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

echo "<br>".$getappreport;
$resappreport = mysqli_query($Conn1,$getappreport);
?>

<fieldset>
    <legend>Report Filter</legend>
    <form method="post" action="query-report.php" name="searchfrm" autocomplete="off" onsubmit="return filter_validation()">
        <input type="text" class="text-input" name="date_from" id="date_from" placeholder="Date From" maxlength="10" value="<?php echo $date_from; ?>" readonly="readonly" />
        <input type="text" class="text-input" name="date_to" id="date_to" placeholder="Date To" maxlength="10" value="<?php echo $date_to; ?>" readonly="readonly" />
        <?php echo get_dropdown('query_status', 'query_statussearch', $query_statussearch, '');
        echo get_dropdown('application_status', 'application_status', $application_status, ''); 
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
            <th width="10%">Query Status</th>
            <th width="10%">Total Leads</th>
        </tr>
        <?php  while($resdata = mysqli_fetch_array($resreport)){
            if($resdata['user_name'] == ''){$userName = 'Unassigned'; } else {$userName = $resdata['user_name'];}?>
            <tr>
                <td><span><?php echo $userName;?> </span> </td>
                <td><span><?php echo $resdata['status'];?> </span> </td>
                <td><span><?php echo $resdata['Total_count'];?> </span> </td>
            </tr>
        <?php } ?>
    </tbody>
</table>


<h2>Application Report</h2>
<table width="80%" class="gridtable" style="margin-left:5%">
    <tbody>
        <tr>
            <th width="10%">User Name </th>
            <th width="10%">Query Status</th>
            <th width="10%">Total Leads</th>
        </tr>
        <?php  while($resappdata = mysqli_fetch_array($resappreport)){
            if($resappdata['user_name'] == ''){$userappName = 'Unassigned'; } else {$userappName = $resappdata['user_name'];}?>
            <tr>
                <td><span><?php echo $userappName;?> </span> </td>
                <td><span><?php echo $resappdata['status'];?> </span> </td>
                <td><span><?php echo $resappdata['Total_count'];?> </span> </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php //print_r($resultqryReport);

?>