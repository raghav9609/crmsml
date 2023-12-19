<?php
require_once "../../include/crm-header.php";
require_once "../../include/dropdown.php";
require_once "../../include/display-name-functions.php";
include ("../../include/paging_class.php");

if(isset($_REQUEST['fil_case_id'])) {
    $fil_case_id = replace_special($_REQUEST['fil_case_id']);
}
if(isset($_REQUEST['fil_app_id'])) {
    $fil_app_id = replace_special($_REQUEST['fil_app_id']);
}
if(isset($_REQUEST['fil_phone_no'])) {
    $fil_phone_no = replace_special($_REQUEST['fil_phone_no']);
}
if(isset($_REQUEST['fil_city_sub_group'])) {
    $fil_city_sub_group = replace_special($_REQUEST['fil_city_sub_group']);
}
if(isset($_REQUEST['fil_user_assign'])) {
    $fil_user_assign = replace_special($_REQUEST['fil_user_assign']);
}
if(isset($_REQUEST['fil_disb_date_from'])) {
    $fil_disb_date_from = replace_special($_REQUEST['fil_disb_date_from']);
}
if(isset($_REQUEST['fil_disb_date_to'])) {
    $fil_disb_date_to = replace_special($_REQUEST['fil_disb_date_to']);
}
if(isset($_REQUEST['city_type'])) {
    $city_type = $_REQUEST['city_type'];
}
if(isset($_REQUEST['masked_phone'])) {
    $masked_phone = $_REQUEST['masked_phone'];
}
if(isset($_REQUEST['banksearch'])) {
    $banksearch = $_REQUEST['banksearch'];
}
if(isset($_REQUEST['to_disb_amount'])) {
    $to_disb_amount = $_REQUEST['to_disb_amount'];
}
if(isset($_REQUEST['from_disb_amount'])) {
    $from_disb_amount = $_REQUEST['from_disb_amount'];
}
if(isset($_REQUEST['from_net_incm'])) {
    $from_net_incm = $_REQUEST['from_net_incm'];
}
if(isset($_REQUEST['to_net_incm'])) {
    $to_net_incm = $_REQUEST['to_net_incm'];
}

$ring_disbursal_query = "SELECT CONCAT_WS(' ', cust.name, cust.lname) AS cust_name, cust.city_id AS city_id, mcase.loan_type AS loan_type, cust.id AS cust_id, cust.phone AS cust_phone, app.app_id AS app_id, app.case_id AS case_id, app.disbursed_amount_on AS loan_amt, city.city_sub_group_id AS sub_group_id, app.app_created_by AS user_assigned, app.first_disb_date_on AS disbursal_date, cust.net_incm AS net_incm FROM tbl_mint_app AS app INNER JOIN tbl_mint_case AS mcase ON app.case_id = mcase.case_id INNER JOIN tbl_mint_customer_info AS cust ON cust.id = mcase.cust_id INNER JOIN lms_city AS city ON cust.city_id = city.city_id INNER JOIN tbl_ringing_status_new AS ring ON mcase.loan_type = ring.loan_type INNER JOIN tbl_ringing_status_user AS ring_user on ring.id = ring_user.ringing_id WHERE app.pre_login_status = 1019 AND ring.query_status = 1019 AND ring.city_group_id = city.city_sub_group_id AND ring.min_net_incm <= cust.net_incm AND ring.max_net_incm >= cust.net_incm AND ring.min_loan_amt <= app.disbursed_amount_on AND ring.max_loan_amt >= app.disbursed_amount_on AND (app.regenerate_query = '' OR app.regenerate_query = 0 OR app.regenerate_query IS NULL) ";

if($fil_disb_date_from == "" && $fil_disb_date_to == "") {
    $ring_disbursal_query .= " AND IF(mcase.loan_type = '60', app.first_disb_date_on < CURDATE() - INTERVAL 90 DAY, app.first_disb_date_on < CURDATE() - INTERVAL 180 DAY) ";
}
if($masked_phone != "") {
    if(strpos($masked_phone, 'XXX') !== false) {
        $initial = explode("XXX", $masked_phone);
        if(strlen($initial[0]) == 4 && strlen($initial[1]) == 3) {
            $ring_disbursal_query .= " AND cust.phone LIKE '".$initial[0]."___".$initial[1]."'";
        }
    }
}
if($fil_case_id != "") {
    $ring_disbursal_query .= " AND mcase.case_id = '".$fil_case_id."' ";
}
if($fil_app_id != "") {
    $ring_disbursal_query .= " AND app.app_id = '".$fil_app_id."' ";
}
if($fil_phone_no != "") {
    $ring_disbursal_query .= " AND cust.phone = '".$fil_phone_no."' ";
}
if($fil_city_sub_group != "") {
    $ring_disbursal_query .= " AND ring.city_group_id = '".$fil_city_sub_group."' ";
}
if($fil_user_assign != "") {
    $ring_disbursal_query .= " AND ring_user.user_id = '".$fil_user_assign."' ";
}
if($fil_disb_date_from != "") {
    $ring_disbursal_query .= " AND app.first_disb_date_on >= '".$fil_disb_date_from."' ";
}
if($fil_disb_date_to != "") {
    $ring_disbursal_query .= " AND app.first_disb_date_on <= '".$fil_disb_date_to."' ";
}
if($user_role == 3) {
    $ring_disbursal_query .= " AND ring_user.user_id = '".$user."' ";
}
if($banksearch > 0) {
    $ring_disbursal_query .= " AND app.app_bank_on = '".$banksearch."'";
}
if($search_city_id != '' && $search_city_id != 0) {
    $ring_disbursal_query .= " AND cust.city_id = '".$search_city_id."'";
}
if($from_disb_amount != '') {
    $ring_disbursal_query .= " AND app.disbursed_amount_on >= '".$from_disb_amount."' ";
}
if($to_disb_amount != '') {
    $ring_disbursal_query .= " AND app.disbursed_amount_on <= '".$to_disb_amount."' ";
}
if($from_net_incm != '') {
    $ring_disbursal_query .= " AND cust.net_incm >= '".$from_net_incm."' ";
}
if($to_net_incm != '') {
    $ring_disbursal_query .= " AND cust.net_incm <= '".$to_net_incm."' ";
}

$ring_disbursal_query .= " GROUP BY app.app_id ORDER BY app.first_disb_date_on DESC LIMIT ".$offset.",".$max_offset;

$ring_disbursal_exe = mysqli_query($Conn1, $ring_disbursal_query);
$disbursal_count = mysqli_num_rows($ring_disbursal_exe);
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../../include/css/jquery-ui.css">
        <script type="text/javascript" src="../../include/js/jquery-1.10.2.js"></script>
        <script type="text/javascript" src="../../include/js/jquery-ui.js"></script>
        <script>
        function resetform() {
            window.location.href = 'disbursal.php';
        }
        function regen_query(case_id, app_id, cust_id) {
            var confirm_msg = confirm("Do you really want to re-generate Query?");
            if(confirm_msg == 1) {
                window.location.href = "regenerate-query.php?app_id="+app_id+"&case_id="+case_id+"&cust_id="+cust_id;
            } else {
                return false;
            }
        }
        $(function() {
            jQuery('#fil_disb_date_from').datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: 'yy-mm-dd',
                beforeShow: function() {
                    jQuery(this).datepicker('option', 'maxDate', jQuery('#fil_disb_date_to').val());
                }
            });
            jQuery('#fil_disb_date_to').datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: 'yy-mm-dd',
                beforeShow : function() {
                    jQuery(this).datepicker('option', 'minDate', jQuery('#fil_disb_date_from').val());
                }
            });
            $("#city_type").autocomplete({
                source: "../../include/city_name.php",
                minLength: 2
            });
        });
        </script>
    </head>
    <body>
        <div class="container main-container">
            <div class="row">
                <div class="span9">
                    <fieldset>
                        <legend>Contest Filter</legend>
                        <form method="GET" action="disbursal.php" name="searchfrm" autocomplete="off">

                            <input type="text" class="text-input numonly" name="fil_case_id" id="fil_case_id" placeholder="Case ID" maxlength="30" value="<?php echo $fil_case_id; ?>" />
                            <input type="text" class="text-input numonly" name="fil_app_id" id="fil_app_id" placeholder="App ID" maxlength="10" value="<?php echo $fil_app_id; ?>" />
                            <input type="text" class="text-input numonly" name="fil_phone_no" id="fil_phone_no" placeholder="Phone No." maxlength="10" value="<?php echo $fil_phone_no; ?>" />
                            <input type="text"class="text-input alnum-wo-space" name="masked_phone" id="masked_phone" placeholder="Masked Phone No." value="<?php echo $masked_phone ;?>" maxlength="10"/>
                            <?php echo get_dropdown('city_sub_group', 'fil_city_sub_group', $fil_city_sub_group, ''); ?>
                            <?php echo get_dropdown('user_assign', 'fil_user_assign', $fil_user_assign, ''); ?>
                            <input type="text" class="text-input" name="fil_disb_date_from" id="fil_disb_date_from" placeholder="Disbursal Date From" maxlength="10" value="<?php echo $fil_disb_date_from; ?>" readonly="readonly" />
                            <input type="text" class="text-input" name="fil_disb_date_to" id="fil_disb_date_to" placeholder="Disbursal Date To" maxlength="10" value="<?php echo $fil_disb_date_to; ?>" readonly="readonly" />
                            <?php echo get_textbox('city_type', $city_type, 'placeholder="City Name (Enter few words)" class="alpha-num-space" maxlength="25"'); ?>
                            <?php echo get_dropdown('bank_name_', 'banksearch', $banksearch, ''); ?>
                            <input type="text" class="text-input" name="from_disb_amount" id="from_disb_amount" placeholder="From Disbursal Amount" value="<?php echo $from_disb_amount; ?>" maxlength="10"/>
                            <input type="text" class="text-input" name="to_disb_amount" id="to_disb_amount" placeholder="To Disbursal Amount" value="<?php echo $to_disb_amount;?>" maxlength="10"/>
                            <input type="text" class="text-input" name="from_net_incm" id="from_net_incm" placeholder="From Net Income" value="<?php echo $from_net_incm; ?>" maxlength="10"/>
                            <input type="text" class="text-input" name="to_net_incm" id="to_net_incm" placeholder="To Net Income" value="<?php echo $to_net_incm; ?>" maxlength="10"/>
                            
                            <input type="submit" name="searchsubmit" value="Filter" class="cursor">
                            <input type="button" onclick="resetform()" value="Clear" class="cursor">
                        </form>
                    </fieldset>
                    <table width="100%" class="gridtable">
                        <tr>
                            <th width="10%">Case ID & Application ID</th>
                            <th width="10%">Customer Name & Phone</th>
                            <th width="10%">City & Net Income</th>
                            <th width="10%">Disbursed Amount & Date</th>
                            <th width="10%">User Assigned</th>
                            <th width="10%">Action</th>
                        </tr>
                        <?php
                        if($disbursal_count > 0) {
                            $records = 0;
                            while($ring_disbursal_result = mysqli_fetch_array($ring_disbursal_exe)) {
                                $records++;
                                if($records > 10) {
                                    continue;
                                }
                                $cust_phone     = $ring_disbursal_result['cust_phone'];
                                if($user_role != '1') {
                                    $masked_number = substr_replace($cust_phone, 'XXX', 4, 3);
                                } else {
                                    $masked_number = $cust_phone;
                                }
                                $app_id         = $ring_disbursal_result['app_id'];
                                $case_id        = $ring_disbursal_result['case_id'];
                                $loan_amt       = $ring_disbursal_result['loan_amt'];
                                $sub_group_id   = $ring_disbursal_result['sub_group_id'];
                                $user_assigned  = $ring_disbursal_result['user_assigned'];
                                $disbursal_date = $ring_disbursal_result['disbursal_date'];
                                $net_incm       = $ring_disbursal_result['net_incm'];
                                $cust_id        = $ring_disbursal_result['cust_id'];
                                $loan_type      = $ring_disbursal_result['loan_type'];
                                $cust_name      = $ring_disbursal_result['cust_name'];
                                $cust_city_id   = $ring_disbursal_result['city_id'];

                                $city_sub_group_name = get_display_name("city_sub_group", $sub_group_id);
                                $mlc_user_name = get_display_name("mlc_user_name", $user_assigned);
                                $cust_city_name = get_display_name("city_name", $cust_city_id);
                                ?>
                                <tr>
                                    <td><?php echo "<a href='/sugar/cases/edit.php?case_id=".base64_encode($case_id)."&ut=2'>".$case_id."</a>"." <br> <a href='edit_applicaton.php?case_id=".base64_encode($case_id)."&app_id=".base64_encode($app_id)."&cust_id=".base64_encode($cust_id)."&loan_type=".$rec_id."'>".$app_id; ?></td>
                                    <td><?php echo $cust_name."<br>".$masked_number; ?></td>
                                    <td><?php echo $cust_city_name."<br>₹ ".number_format($net_incm); ?></td>
                                    <td><?php echo "₹ ".number_format($loan_amt)."<br>".(($disbursal_date != "" && $disbursal_date != "0000-00-00" && $disbursal_date != "1970-01-01") ? date("d-m-Y", strtotime($disbursal_date)) : "--"); ?></td>
                                    <td><?php echo $mlc_user_name; ?></td>
                                    <td>
                                        <!-- <a href="edit_applicaton.php?case_id=<?php echo base64_encode($case_id); ?>&app_id=<?php echo base64_encode($app_id); ?>&cust_id=<?php echo base64_encode($cust_id); ?>&loan_type=<?php echo $rec_id; ?>" class="has_link"><input type="button" class = "pointer_n" value="Edit" style="border-radius: 5px; background-color: #18375f; font-weight: bold;"></a> -->
                                        <br />
                                        <a href="javascript:void(0);" onclick="regen_query('<?php echo $case_id; ?>', '<?php echo $app_id; ?>', '<?php echo $cust_id; ?>')" class="has_link blue"><input type="button" class="pointer_n" value="Regenerate Query" style="border-radius: 5px; background-color: #18375f; font-weight: bold;"></a>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                            <input type ="hidden" name="page"  value="<?php echo $page;?>"/>
                            <?php
                            if($records > 0) {
                                ?>
                                <table width="width:90%;margin-left:4%;" border="0" align="center" cellpadding="4" cellspacing="1" class="pagination">
                                    <tr class="sidemain">
                                        <td>
                                            <?php
                                            if($page > 1) {
                                                echo "<a class='page gradient' href='disbursal.php?page=1&fil_case_id=$fil_case_id&fil_app_id=$fil_app_id&fil_phone_no=$fil_phone_no&fil_city_sub_group=$fil_city_sub_group&fil_user_assign=$fil_user_assign&fil_disb_date_from=$fil_disb_date_from&fil_disb_date_to=$fil_disb_date_to&city_type=$city_type&masked_phone=$masked_phone&banksearch=$banksearch&from_net_incm=$from_net_incm&to_net_incm=$to_net_incm&from_disb_amount=$from_disb_amount&to_disb_amount=$to_disb_amount'>First</a>";
                                                echo "<a class='page gradient' href='disbursal.php?page=" . ($page - 1) . "&fil_case_id=$fil_case_id&fil_app_id=$fil_app_id&fil_phone_no=$fil_phone_no&fil_city_sub_group=$fil_city_sub_group&fil_user_assign=$fil_user_assign&fil_disb_date_from=$fil_disb_date_from&fil_disb_date_to=$fil_disb_date_to&city_type=$city_type&masked_phone=$masked_phone&banksearch=$banksearch&from_net_incm=$from_net_incm&to_net_incm=$to_net_incm&from_disb_amount=$from_disb_amount&to_disb_amount=$to_disb_amount'>Prev</a>";
                                            }
                                            echo "<a class='page gradient' href='javascript:void;'>".$page."</a>";
                                            if($records > $display_count) {
                                                echo "<a class='page gradient' href='disbursal.php?page=".($page + 1)."&fil_case_id=$fil_case_id&fil_app_id=$fil_app_id&fil_phone_no=$fil_phone_no&fil_city_sub_group=$fil_city_sub_group&fil_user_assign=$fil_user_assign&fil_disb_date_from=$fil_disb_date_from&fil_disb_date_to=$fil_disb_date_to&city_type=$city_type&masked_phone=$masked_phone&banksearch=$banksearch&from_net_incm=$from_net_incm&to_net_incm=$to_net_incm&from_disb_amount=$from_disb_amount&to_disb_amount=$to_disb_amount'>Next</a>";
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                </table>
                            <?php
                            }
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>