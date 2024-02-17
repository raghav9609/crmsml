<?php
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../config/config.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../include/header.php');
require_once(dirname(__FILE__) . '/../model/queryHelper.php');
require_once "../include/helper.functions.php";
require_once "../include/display-name-functions.php";
if (isset($_REQUEST['page'])) {
    $page = replace_special($_REQUEST['page']);
}
if (isset($_REQUEST['app_id'])) {
    $id = replace_special(urldecode(base64_decode($_REQUEST['app_id'])));
    $ut = replace_special($_REQUEST['ut']);
}
$qryyy_id = $id;
$qry = "Select * from  crm_query_application where id ='".$qryyy_id."'";

$res = mysqli_query($Conn1, $qry) or die(mysqli_error($Conn1));
$exe_form = mysqli_fetch_array($res);


if ($exe_form['id'] == '' || $exe_form['id'] == 0) {
    if ($user_role == 3) {
        header("location:user.php");
    } else if ($user_role == 2) {
        header("location:index.php");
    }
} else {
  
    $name_bank = $exe_form['bank_id'];

    $get_bank_name = get_name("",$name_bank);

    $application_status = $exe_form['application_status'];

    $app_u_assign = $exe_form['user_id'];
    $applied_amount = $exe_form['applied_amount'];
    $sanction_amount = $exe_form['sanction_amount'];
    $disbursed_amount = $exe_form['disbursed_amount'];
    $login_date = $exe_form['login_date'];
    $sanction_date = $exe_form['sanction_date'];
    $disburse_date = $exe_form['disburse_date'];
    $bank_application_no = $exe_form['bank_application_no'];
    $remarks_by_user = $exe_form['description_by_user'];
    $remarks_by_bank=$exe_form['description_by_bank'];
    $follow_up_date=$exe_form['follow_up_date'];
    $follow_up_time=$exe_form['follow_up_time'];
    $follow_up_given_by=$exe_form['follow_up_given_by'];
    $tennure=$exe_form['tennure'];
    $roi=$exe_form['roi'];
?>

<!DOCTYPE html>
    <html>

    <head>
        <link rel="stylesheet" href="../assets/css/jquery-ui.css">
        <script type="text/javascript" src="../assets/js/jquery-1.10.2.js"></script>
        <script type="text/javascript" src="../assets/js/jquery-ui.js"></script>
    </head>

    <body>
        <div class="color-bar-1"></div>
        <div class="color-bar-2 color-bg"></div>
        <div class="container-fluid main-container">
            <div class="row">
                <div class="span9">
                    <div class="wrapper">
                        <span class='orange f_13' style="font-weight:bold;"></span>

                             <!-- Toggle Div -->
                             <?php 
                            if($filterstatus!=""){
                                $filter=1;
                            }
                            else{
                                $filter=0;
                            }
                            if($filterstatus!=""){
                            if($filterstatus=="Green"){
                               // $style="background: #1b8c1b;";
                                $class="np-greenbtn";
                            }
                            else if($filterstatus=="Red"){

                                $class="np-redbtn";
                            }
                            else{
                               // $style="background: orenge;";
                                $class="np-amberbtn";
                            }
                        }
                        else{
                            $style="visibility: hidden;";
                        }
                        ?>
                        <?php
                           
                           include("js-insert.php");
                            include("form_index_app.php");
                           
                              ?>
                            <br>
                           
                        </div>
                    </div>
                </div>
                </body>
</html>
<?php } ?>



