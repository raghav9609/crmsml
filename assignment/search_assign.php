<?php
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../config/config.php');
require_once(dirname(__FILE__) . '/../model/assignmentModel.php');


$loan_type = replace_special($_REQUEST['loan_type']);
$sml_user = replace_special($_REQUEST['sml_user']);
$city_sub_grp = replace_special($_REQUEST['city_sub_grp']);
echo "dsdsd";
$filterArr = array("city_sub_group_id"=>$city_sub_grp,"loan_type"=>$loan_type,"user_id"=>$sml_user,"is_active"=>1);
echo $qry = $leadAssignmentClassexport->searchFilter($filterArr);

exit;
$qry = "select tbl_assign_l.company_cat,tbl_assign_l.business_registered_with,tbl_assign_l.account_type,tbl_assign_l.hdfc_auto_push as hdfc_auto_push,tbl_assign_l.employer_type,tbl_assign_l.occup_id,tbl_assign_l.min_itr_amt,tbl_assign_l.max_itr_amt,tbl_assign_l.id, tbl_assign_l.min_loan_amt as min_loan,tbl_assign_l.max_loan_amt as max_loan,
tbl_assign_l.min_net_income as min_sal,tbl_assign_l.max_net_income as max_sal,tbl_assign_l.loan_type,
city_group.city_sub_group_name
from crm_lead_assignment as tbl_assign_l
inner join crm_master_city_sub_group as city_group on tbl_assign_l.city_sub_group_id = city_group.id
where tbl_assign_l.id > 0 ";
if ($loan_type != '') {
    $qry .= " and loan_type = ".$loan_type ;
}
if ($sml_user != '') {
    $qry .= " and tbl_assign_l.user_id = '" . $sml_user . "'";
}
if ($city_sub_grp != '') {
    $qry .= " and city_group.id = '" . $city_sub_grp . "' ";
}

$qry .= " group by tbl_assign_l.id order by tbl_assign_l.id";
echo $qry;

exit;
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
                    <?php if ($loan_type == 57) { ?>
                        <th>Annual Turnover
                        </th><?php } else if ($loan_type == 51 || $loan_type == 52 || $loan_type == 54) { ?>
                        <th>Auto Push</th>
                    <?php }else if($loan_type == 56){ ?>
                        <th>HDFC Company Category</th>
                   <?php } ?>
                    <th>Occupation</th>
                    <th>Ist Shift</th>
                    <th>IInd Shift</th>
                </tr>
                <?php
                //$row_counter = mysqli_num_rows($query);
                while ($result_query = mysqli_fetch_array($query)){
                $row_counter = mysqli_num_rows($result_query);
                $id = $result_query['filter_id'];
                $loan_type = $result_query['loan_type'];
                $sub_group_name = $result_query['city_sub_group_name'];
                $min_loan = $result_query['min_loan'];
                $max_loan = $result_query['max_loan'];
                $min_itr_amt = $result_query['min_itr_amt'];
                $max_itr_amt = $result_query['max_itr_amt'];
                $min_sal = $result_query['min_sal'];
                $max_sal = $result_query['max_sal'];
                $occupation = $result_query['occup_id'];
                $crasssell=$result_query['cross_sell_flag'];
                $company_cat=explode(',',$result_query['company_cat']);
                $cross=($crasssell == 1)?'Yes':'No';
                //$empl_ty = $result_query['employer_type'];
                $hdfc_auto_push = $result_query['hdfc_auto_push'];
                $account_type = $result_query['account_type'];
                $business_registered_with=$result_query['business_registered_with'];
                    $account_type_name = $business_registered_with_name = $final_business_registered_loan_name = '';
                    if($account_type == '1,5'){
                        $account_type_name= 'Current A/C';
                    }else if($account_type == '2,3,4'){
                        $account_type_name= 'Saving A/c';
                    }else if($account_type == '1,2,3,4,5'){
                        $account_type_name= 'All';
                    }
                    if($business_registered_with == '6,8'){
                        $business_registered_with_name = 'GST';
                    }else if($business_registered_with == '3,5,7,9'){
                        $business_registered_with_name = 'No GST';
                    }
                    if($business_registered_with_name != '' && $account_type_name != ''){
                        $final_business_registered_loan_name = $business_registered_with_name." + ".$account_type_name;
                    }

                $get_loan_name_qry = mysqli_query($Conn1, "select loan_type_name from lms_loan_type where loan_type_id = '" . $loan_type . "'");
                $result_loan_name = mysqli_fetch_array($get_loan_name_qry);
                $loan_name = $result_loan_name['loan_type_name'];

                if ($loan_type != '' && $loan_type > 0) {
                    $mlc_qry_user = "select user.user_id as user_id,user.user_name as user_name from tbl_user_assign as user join tl_loan_type_assign as map on user.user_id = map.tl_id where user.status = 1 and map.loan_type = '" . $loan_type . "' group by user.user_id order by user.user_name";
                } else {
                    $mlc_qry_user = "select user_id,user_name from tbl_user_assign where status = 1";
                }
                $user_query_data = "select * from tbl_assign_user_query_filter where filter_id = $id ";
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
                    <td><input type="checkbox" name="ch_edit[]" value="<?php echo $id ?>" id="<?php echo $id ?>"
                               class="loan_type abcd"/></td>

                     <td rowspan="<?php echo $row_counter ?>">
                            <?php echo $sub_group_name . "<br><span class='orange'>" . $loan_name  ."</span><br>".$final_business_registered_loan_name."<br> Cross Sell " ;echo ($cross!='')?$cross:'-'; ?>
                        </td>
                    <td><input id="<?php echo $id ?>_amt" name="salary_<?php echo $id ?>"
                               value="<?php echo $min_sal . " - " . $max_sal ?>" class="<?php echo $id; ?>_chng"
                               disabled="" type="text"/>
                    </td>
                    <td><input type='hidden' name='loan_id' value='<?php echo $loan_type; ?>'/>
                        <input id="<?php echo $id ?>_lamt" name="loan_amt_<?php echo $id ?>"
                               value="<?php echo $min_loan . " - " . $max_loan ?>" class="<?php echo $id; ?>_chng"
                               disabled="" type="text"/>
                    </td>
                    <?php
                    if($loan_type == 56){ ?>
                       <td> <select disabled="" multiple class="<?php echo $id; ?>_chng" name='hdfc_cat_<?php echo $id;?>[]'
                                id='<?php echo $id ?>_hdfc_cat'>
                                <option value=''>Select Company Category</option>
                                <?php
                                $qry = mysqli_query($Conn1,"select category_id,category_name from pl_comp_bank_category where bank_id  = 42 and is_active = 1");
                                while ($category_row = mysqli_fetch_array($qry)) {
                            $category_id = $category_row['category_id'];
                            $category_name = $category_row['category_name'];?>
                          <option value='<?php echo $category_id;?>' <?php if(in_array($category_id,$company_cat)){echo 'selected';} ?>><?php echo $category_name; ?></option>
                      <?php   } ?>
                        </select></td>
                  <?php  }else if ($loan_type == '57') {
                        ?>
                        <td><input id="<?php echo $id ?>_itr_amt" name="itr_amt_<?php echo $id; ?>"
                                   value="<?php echo $min_itr_amt . " - " . $max_itr_amt; ?>"
                                   class="<?php echo $id; ?>_chng" disabled="" type="text"/></td>
                    <?php } else if ($_REQUEST['loan_type'] == '51' || $_REQUEST['loan_type'] == '52' || $_REQUEST['loan_type'] == '54') { ?>
                        <td>
                        <select disabled="" class="<?php echo $id; ?>_chng" name='hdfc_<?php echo $id; ?>'
                                id='<?php echo $id ?>_hdfc'>
                            <option value='1' <?php if ($hdfc_auto_push == 1){ ?>selected<?php } ?>>Y</option>
                            <option value='0' <?php if ($hdfc_auto_push != 1){ ?>selected<?php } ?>>N</option>
                        </select></td>
                    <?php } ?>
                    <td>
                        <?php
                        $ocupt_select = "<select id='$id" . "_occupation' name='occupation_" . $id . "' disabled = '' class='$id" . "_test $id" . "_chng'>";
                        $ocupt_select .= "<option value='0'>Select Occupation</option>";
                        $occup_query = mysqli_query($Conn1, "SELECT * FROM `lms_occupation` ORDER BY sort_order");
                        while ($occup_row = mysqli_fetch_array($occup_query)) {
                            $occupation_id = $occup_row['occupation_id'];
                            $occup_name = $occup_row['occupation_name'];
                            $occup_sel_val = $occupation_id == $occupation ? "selected" : "";
                            $ocupt_select .= "<option value='$occupation_id' $occup_sel_val>$occup_name</option>";
                        }
                        $ocupt_select .= "</select>";
                        echo $ocupt_select;
                        ?></td>
                    <td>
                        <?php
                        $shift_1_qry = mysqli_query($Conn1, $user_query_data . " and shift_flag = 1");
                        while ($result_user_query = mysqli_fetch_assoc($shift_1_qry)) {
                            $datacheck = $result_user_query['shift_flag'];
                            $user_id_first = $result_user_query['user_id'];
                            $assign_id = $result_user_query['assign_id'];
                            if ($datacheck == 1) {
                                $user_query = mysqli_query($Conn1, $mlc_qry_user);
                                ?>
                                <select id="<?php echo $id ?>_name" disabled="" name="user_id_<?php echo $id ?>[]"
                                        class="<?php echo $id ?>_test <?php echo $id; ?>_chng">
                                    <option value="0,<?php echo $assign_id; ?>">Select User</option>
                                    <?php
                                    while ($result_user_query = mysqli_fetch_array($user_query)) {
                                        $sml_user_id = $result_user_query['user_id'];
                                        $sml_user_name = $result_user_query['user_name']; ?>
                                        <option value="<?php echo $sml_user_id . ',' . $assign_id; ?>" <?php if ($sml_user_id == $user_id_first) { ?> selected <?php } ?>><?php echo $sml_user_name; ?></option>
                                    <?php } ?>
                                </select>&nbsp;&nbsp;
                                <?php
                            }

                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        $shift_2_qry = mysqli_query($Conn1, $user_query_data . " and shift_flag = 2");
                        while ($result_user_query = mysqli_fetch_assoc($shift_2_qry)) {
                            $datacheck = $result_user_query['shift_flag'];
                            $user_id_first = $result_user_query['user_id'];
                            $assign_id = $result_user_query['assign_id'];

                            $i = 1;
                            if ($datacheck == 2) {
                                mysqli_data_seek($user_query, 0);
                                $user_query = mysqli_query($Conn1, $mlc_qry_user);
                                ?>
                                <select id="<?php echo $id ?>_name1" disabled="" name="user_id1_<?php echo $id ?>[]"
                                        class="<?php echo $id ?>_test1 <?php echo $id; ?>_chng">
                                    <option value="0,<?php echo $assign_id; ?>">Select User</option>
                                    <?php
                                    while ($result_user_query = mysqli_fetch_array($user_query)) {
                                        $sml_user_id = $result_user_query['user_id'];
                                        $sml_user_name = $result_user_query['user_name']; ?>
                                        <option value="<?php echo $sml_user_id . ',' . $assign_id; ?>" <?php if ($sml_user_id == $user_id_first) { ?> selected <?php } ?>><?php echo $sml_user_name; ?></option>
                                    <?php } ?>
                                </select>&nbsp;&nbsp;
                                <?php
                            }

                        }
                        ?>
                    </td>
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
mysqli_close($mlc);
include("../../include/footer_close.php");
?>
