<?php
require_once "../../include/crm-header.php";
require_once "../../include/dropdown.php";
require_once "../../include/display-name-functions.php";
require_once "../../include/helper.functions.php";
?> 
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../../include/style.css" />
        <link rel="stylesheet" href="../../include/css/jquery-ui.css">
        <script type="text/javascript" src="../../include/js/jquery-1.10.2.js"></script>
        <script src="../../include/js/jquery-ui.js"></script>
        <script src="../../include/js/common-function.js"></script>
        <script>
            $(document).ready(function() {
                var msg = "<?php echo $_REQUEST['msg']; ?>";
                if(msg == 1) {
                    $("#message").css({"color":"green", "margin-left":"15px"}).html("Successfully updated")
                }
            });
        </script>
    </head>
    <body>
        <div style="clear: both; margin-top: 10px"></div>
        <?php
            $records_query = "SELECT id, app_id, loan_type, grid_amt, approved_amt, user FROM tbl_cashback_offered WHERE ((is_approved IS NULL) OR (is_approved = '') OR (is_approved = 0)) ";
            if($user == 318) {  //sanjay - HL, LAP, CPL
                $records_query .= " AND loan_type IN (51, 52, 54) ";
            }
            if($user == 208) {  //annu - GL
                $records_query .= " AND loan_type = 60 ";
            }
            if($user == 397 || $user == 16) {   //jitender, kanchan
                $records_query .= " AND loan_type IN (56, 57, 63) ";
            }
            $records_query .= " ORDER BY id DESC LIMIT ".$offset.",".$max_offset;
            $records_exe = mysqli_query($Conn1, $records_query);
        ?>
        <label id="message"></label>
        <table width="98%" style="margin-left: 1%" class="gridtable">
            <tr>
                <th width="10%">Application ID</th>
                <th width="10%">Loan Type</th>
                <th width="10%">Grid Amount</th>
                <th width="10%">Approved Amount</th>
                <th width="10%">Requested By</th>
                <th width="10%">Action</th>
            </tr>
            <?php
            $recordcount = mysqli_num_rows($records_exe);
            if($recordcount > 0) {
                while($records_res = mysqli_fetch_array($records_exe)) {
                    $id = $records_res['id'];
                    $app_id = $records_res['app_id'];
                    $grid_amt = $records_res['grid_amt'];
                    $approved_amt = $records_res['approved_amt'];
                    $user = $records_res['user'];
                    $loan_type = $records_res['loan_type'];

                    $loan_type_name = get_display_name("loan_type", $loan_type);
                    $user_name = get_display_name("mlc_user_name", $user);

                    $case_id_qry = mysqli_query($Conn1, "SELECT case_id FROM tbl_mint_app WHERE app_id = $app_id ");
                    $case_id_res = mysqli_fetch_array($case_id_qry);
                    $case_id_result = $case_id_res['case_id'];
                    $case_id_enc = base64_encode($case_id_result);

                    $cust_id_qry = mysqli_query($Conn1, "SELECT cust_id FROM tbl_mint_case WHERE case_id = $case_id_result ");
                    $cust_id_res = mysqli_fetch_array($cust_id_qry);
                    $cust_id_result = $cust_id_res['cust_id'];
                    $cust_id_enc = base64_encode($cust_id_result);

                    ?>
                    <form action="cashback-app-rej.php" method="POST">
                        <tr>
                            <td><?php echo "<a class='has_link' href='/sugar/app/edit_applicaton.php?case_id=".$case_id_enc."&app_id=".base64_encode($app_id)."&cust_id=".$cust_id_enc."&loan_type=".$loan_type."'>".$app_id."</a>"; ?></td>
                            <td><?php echo $loan_type_name; ?></td>
                            <td><?php echo custom_money_format($grid_amt); ?></td>
                            <td><?php echo custom_money_format($approved_amt); ?></td>
                            <td><?php echo $user_name; ?></td>
                            <td>
                                <input type="hidden" name="grid_amt" value="<?php echo $grid_amt; ?>">
                                <input type="hidden" name="app_amt" value="<?php echo $approved_amt; ?>">
                                <input type="hidden" name="app_id" value="<?php echo $app_id; ?>" />
                                <input type="hidden" name="co_id" value="<?php echo $id; ?>" />
                                <input type="submit" name="submit" value="Approve" class="buttonsub ml10 cursor" />
                                <input type="submit" name="submit" value="Reject" class="buttonsub ml10 cursor" />
                            </td>
                            
                        </tr>
                    </form>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="17">No records found</td>
                </tr>
                <?php
            }
            ?>
        </table>

        <?php if($recordcount > 0) { ?>
            <table width="85%" style="text-align: center; float:left" border="0" align="center" cellpadding="4" cellspacing="1" class="pagination">
                <tr class="sidemain">
                    <td>
                    <?php
				        if($page > 1) {
                            echo "<a class='page gradient' href='index.php?page=1'>First</a>";

					        echo "<a class='page gradient' href='index.php?page=" . ($page - 1) . "'>Prev</a>";
					    }
                        echo "<a class='page gradient' href='javascript:void(0);'>".$page."</a>";
                        if($recordcount > $display_count) {
                            echo "<a class='page gradient' href='index.php?page=".($page + 1)."'>Next</a>";
                        }
					?>
                    </td>
                </tr>
            </table>
        <?php } ?>

    </body>
</html>