<?php 
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../include/header.php');
require_once(dirname(__FILE__) . '/../config/config.php');
$getreport = "SELECT usr.name As user_name,count(qry.id) As Total_count, stat.value As status FROM `crm_query` As qry left JOIN crm_master_user As usr ON qry.lead_assign_to = usr.id LEFT JOIN crm_master_status As stat ON qry.query_status = stat.id WHERE stat.status_type = 1 GROUP by qry.query_status,qry.lead_assign_to";
$resreport = mysqli_query($Conn1,$getreport);

$getappreport = "SELECT usr.name As user_name,count(app.id) As Total_count, stat.value As status FROM `crm_query_application` As app left JOIN crm_master_user As usr ON app.user_id = usr.id LEFT JOIN crm_master_status As stat ON app.application_status = stat.id WHERE stat.status_type = 2 GROUP by app.application_status,app.user_id";
$resappreport = mysqli_query($Conn1,$getappreport);
?>
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