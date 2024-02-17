<?php
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../include/header.php');
require_once(dirname(__FILE__) . '/../config/config.php');

if (isset($_REQUEST['u_assign'])) {
    $u_assign = replace_special($_REQUEST['u_assign']);
}
?>
<!DOCTYPE html>
    <html>

    <head>
        <link rel="stylesheet" href="../assets/css/jquery-ui.css">
        <script type="text/javascript" src="../assets/js/jquery-1.10.2.js"></script>
        <script type="text/javascript" src="../assets/js/jquery-ui.js"></script>
        <script>
            function resetform() {
                window.location.href = "<?php echo $head_url; ?>/report/login-report.php";
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
                        $qry = "SELECT us.name,cl.created_on FROM crm_history_user_login As cl INNER JOIN crm_master_user As us ON cl.crm_master_user_id = us.id Where 1 ";

                        if ($u_assign != '') {
                            $default = 1;
                            $qry .= " and cl.crm_master_user_id = '" . $u_assign . "'";
                        }
                        
                        $qry .= " ORDER by DESC limit " . $offset . "," . $max_offset;
                    ?>

                    <fieldset>
                        <legend>Report Filter</legend>
                        <form method="post" action="login-report.php" name="searchfrm" autocomplete="off" onsubmit="return filter_validation()">
                            <?php 
                                if ($user_role != 3) { 
                                echo get_dropdown('user_id_3', 'u_assign', $u_assign, ''); 
                                } ?>
                            <input class="cursor" type="submit" name="searchsubmit" value="Filter">
                            <input class="cursor" type="button" onclick="resetform()" value="Clear">
                        </form>
                    </fieldset>

                    <h2>User Login Report</h2>
                    <table width="80%" class="gridtable" style="margin-left:5%">
                        <tbody>
                            <tr>
                                <th width="10%">User Name </th>
                                <th width="10%">Login Date/Time</th>
                            </tr>
                            <?php
                            $result = mysqli_query($Conn1,$qry) or die("Error: " . mysqli_error($Conn1));
                            $recordcount = mysqli_num_rows($result); // 11
                            echo $recordcount;
                            if ($recordcount > 0) {
                                $record = 0;
                                while ($datafetch = mysqli_fetch_array($result)) {
                                    $record++;
                                    if ($record > 10) {
                                        continue;
                                } ?>
                            <tr>
                                <td><span><?php echo $datafetch['name'];?> </span> </td>
                                <td><span><?php echo $datafetch['created_on'];?> </span> </td>
                            </tr>
                            <?php  } ?>
                        </tbody>
                    </table>
                    <?php if ($recordcount > 0) { ?>
                        <table width="85%" style="float:left" border="0" align="center" cellpadding="4" cellspacing="1" class="pagination">
                            <tr class="sidemain">
                                <td>
                                    <?php
                                    if ($page > 1) {
                                        echo "<a class='page gradient' href='login-report.php?page=1&u_assign=$u_assign'>First</a>";
                                        echo "<a class='page gradient' href='login-report.php?page=" . ($page - 1) . "&u_assign=$u_assign'>Prev</a>";
                                    }
                                    echo "<a class='page gradient' href='javascript:void;'>" . $page . "</a>";
                                    if ($recordcount > $display_count) {
                                        echo "<a class='page gradient' href='login-report.php?page=" . ($page + 1) . "&u_assign=$u_assign'>Next</a>";
                                    }
                                    ?>
                                </td>
                            </tr>
                        </table>
                    <?php }
                } ?>
                </div>
            </div>
        </div>
    </body>
</html>