<?php
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../config/config.php');
require_once(dirname(__FILE__) . '/../model/assignmentModel.php');


$loan_type = replace_special($_REQUEST['loan_type']);
$sml_user = replace_special($_REQUEST['sml_user']);
$city_sub_grp = replace_special($_REQUEST['city_sub_grp']);

$filterArr = array("city_sub_group_id"=>$city_sub_grp,"loan_type"=>$loan_type,"user_id"=>$sml_user,"is_active"=>1);
 $qry = $leadAssignmentClassexport->searchFilter($filterArr);

$query = mysqli_query($Conn1, $qry) or die(mysqli_error($Conn1));
?>

    <div style="margin:0 auto; width:90%; padding:10px; background-color:#fff; height:800px;">
        <form action="" method="POST">
            <table class="gridtable" width="95%;">
                <tr>
                    <th colspan="10"><input type="submit" name="update" class="buttonsub ml10 cursor" value="Update"/></th>
                </tr>
                <tr>
                    <th><input type="checkbox" name="selectAll[]" id="selectAll">Select All</th>
                    <th>City Group</th>
                    <th>Salary Range</th>
                    <th>Loan Amount</th>
                    <th>Ist Shift</th>
                    <th>IInd Shift</th>
                </tr>
                <?php
                    $row_counter = mysqli_num_rows($query);
                    while ($result_query = mysqli_fetch_array($query)){
                        $id = $result_query['filter_id'];
                        $loan_type = $result_query['loan_type'];
                        $sub_group_name = $result_query['city_sub_group_name'];
                        $min_loan = $result_query['min_loan'];
                        $max_loan = $result_query['max_loan'];
                        $min_sal = $result_query['min_sal'];
                        $max_sal = $result_query['max_sal'];
      

                        $get_loan_name_qry = mysqli_query($Conn1, "select value As loan_type_name from crm_masters where crm_masters_code_id = 1 and id = '" . $loan_type . "'");
                        $result_loan_name = mysqli_fetch_array($get_loan_name_qry);
                        $loan_name = $result_loan_name['loan_type_name'];

                        if ($loan_type != '' && $loan_type > 0) {
                            $get_qry_user = "select user.id as user_id,user.name as user_name from crm_master_user as user join crm_user_loan_type_mapping as map on user.id = map.user_id where user.is_active = 1 and map.loan_type = '" . $loan_type . "' group by user.id order by user.name";
                        } else {
                            $get_qry_user = "select id As user_id,name As user_name from crm_master_user where is_active = 1";
                        }
                        $user_query_data = "select * from crm_lead_assignment where id = $id ";
                        $script[] = '<script type="text/javascript">
                            $("#' . $id . '").change(function(){
                            if (this.checked) {
                                $(".' . $id . '_chng").removeAttr("disabled");
			                    $(".' . $id . '_chng").addClass("new_textbox");
                            } else { 
			                    $(".' . $id . '_chng").attr("disabled", true);
                                $(".' . $id . '_chng").removeClass("new_textbox"); 
                                $("#selectAll").removeAttr("checked");
                            }
                            });
                        </script>';
                    ?>
                <tr>
                    <td><input type="checkbox" name="ch_edit[]" value="<?php echo $id ?>" id="<?php echo $id ?>" class="loan_type abcd"/></td>

                    <td rowspan="<?php echo $row_counter ?>">
                        <?php echo $sub_group_name . "<br><span class='orange'>" . $loan_name  ."</span><br>"; ?>
                    </td>
                    <td>
                        <input id="<?php echo $id ?>_amt" name="salary_<?php echo $id ?>" value="<?php echo $min_sal . " - " . $max_sal ?>" class="<?php echo $id; ?>_chng" disabled="" type="text"/>
                    </td>
                    <td>
                        <input type='hidden' name='loan_id' value='<?php echo $loan_type; ?>'/>
                        <input id="<?php echo $id ?>_lamt" name="loan_amt_<?php echo $id ?>" value="<?php echo $min_loan . " - " . $max_loan ?>" class="<?php echo $id; ?>_chng" disabled="" type="text"/>
                    </td>
                  
                    <td>
                        <?php
                        $shift_1_qry = mysqli_query($Conn1, $user_query_data . " and shift_id = 1");
                        while ($result_user_query = mysqli_fetch_assoc($shift_1_qry)) {
                            $datacheck = $result_user_query['shift_id'];
                            $user_id_first = $result_user_query['user_id'];
                            //$assign_id = $result_user_query['assign_id'];
                            if ($datacheck == 1) {
                                $user_query = mysqli_query($Conn1, $get_qry_user);
                                ?>
                                <select id="<?php echo $id ?>_name" disabled="" name="user_id_<?php echo $id ?>[]"
                                        class="<?php echo $id ?>_test <?php echo $id; ?>_chng">
                                    <option value="0,<?php // echo $assign_id; ?>">Select User</option>
                                    <?php
                                    while ($result_user_query = mysqli_fetch_array($user_query)) {
                                        $sml_user_id = $result_user_query['user_id'];
                                        $sml_user_name = $result_user_query['user_name']; ?>
                                        <option value="<?php echo $sml_user_id; ?>" <?php if ($sml_user_id == $user_id_first) { ?> selected <?php } ?>><?php echo $sml_user_name; ?></option>
                                    <?php } ?>
                                </select>&nbsp;&nbsp;
                                <?php
                            }
                        } ?>
                    </td>
                    <td>
                        <?php
                        $shift_2_qry = mysqli_query($Conn1, $user_query_data . " and shift_id = 2");
                        while ($result_user_query = mysqli_fetch_assoc($shift_2_qry)) {
                            $datacheck = $result_user_query['shift_flag'];
                            $user_id_first = $result_user_query['user_id'];
                            //$assign_id = $result_user_query['assign_id'];

                            $i = 1;
                            if ($datacheck == 2) {
                                mysqli_data_seek($user_query, 0);
                                $user_query = mysqli_query($Conn1, $get_qry_user);
                                ?>
                                <select id="<?php echo $id ?>_name1" disabled="" name="user_id1_<?php echo $id ?>[]"
                                        class="<?php echo $id ?>_test1 <?php echo $id; ?>_chng">
                                    <option value="0">Select User</option>
                                    <?php
                                    while ($result_user_query = mysqli_fetch_array($user_query)) {
                                        $sml_user_id = $result_user_query['user_id'];
                                        $sml_user_name = $result_user_query['user_name']; ?>
                                        <option value="<?php echo $sml_user_id; ?>" <?php if ($sml_user_id == $user_id_first) { ?> selected <?php } ?>><?php echo $sml_user_name; ?></option>
                                    <?php } ?>
                                </select>&nbsp;&nbsp;
                                <?php
                            }

                        }
                        ?>
                    </td>
                </tr>
                    <?php } ?>
            </table>
        </form>
    </div>
<?php echo implode($script); ?>
    <style>
        .fade {
            display: none;
            position: fixed;
            top: 0%;
            left: 0%;
            width: 100%;
            height: 100%;
            background-color: #000;
            z-index: 1001;
            -moz-opacity: 0.7;
            opacity: .70;
            filter: alpha(opacity=70);
        }

        .light {
            display: none;
            border-radius: 10px;
            position: fixed;
            top: 30%;
            left: 5%;
            width: 60%;
            height: 370px;
            margin-left: 10px;
            margin-top: -100px;
            padding: 10px;
            border: 2px solid #E87D24;
            background: #FFF;
            z-index: 1002;
            overflow-x: hidden;
        }

        .close-btn {
            border: 2px solid #c2c2c2;
            padding: 1px 5px;

            top: 13%;
            background-color: #605F61;
            left: 65.9%;
            border-radius: 20px;
            font-size: 30px;
            position: fixed;
            font-weight: bold;
            color: white;
            text-decoration: none;
            cursor: pointer;
        }

        @media (max-width: 480px) {
            .close-btn {
                left: 88.9%;
                top: 12%;
            }

            #light {
                left: 2%
            }
        }
    </style>
    <script type="text/javascript">
        $('#selectAll').click(function (event) {
            if (this.checked) {
// Iterate each checkbox
                $(':checkbox:not(".onoff")').each(function () {
                    this.checked = true;
                    var id = $(this).attr("id");
                    $("." + id + "_chng").removeAttr("disabled");
                    $("#" + id + "_chng").addClass("new_textbox");
                });
            } else {
                $(':checkbox:not(".onoff")').each(function () {
                    this.checked = false;
                    var dis_id = $(this).attr("id");
                    $("." + dis_id + "_chng").attr("disabled", true);
                });
            }
        });
    </script>
<?php
include("../include/footer_close.php");
?>
