<?php 
$recordcount= 0;
 $qryd = "select * from crm_lead_summary_history where lead_id = '".$qryyy_id."' and type = 2 order by id desc"; 
$res = mysqli_query($Conn1,$qryd) or die("Error: ".mysqli_error($Conn1));
$recordcount = mysqli_num_rows($res);
?>

<div class="pl-md-3 pl-2 pr-md-3 pr-2 col-12">
    
    <div class="gen-box white-bg">
        <div class="blue-bg col-12 font-weight-nb pb-2 pt-2 white font-20 brdr-top-gray pe-none" data-toggle="step1" id="switch_step1">
            <span id="text_step1"></span>Follow Up History<div id="error-message" class="error-message"></div></div>
            <table class="gridtable" style="width:100%;" id="maintable">
                <tr>
                    <th>S No.</th>
                    <th>User</th>
                    <th>Remarks By User</th>
                    <th>Remarks By Bank</th>
                    <th>Follow Up Date Time</th>
                    <th>Created On</th>
                </tr>
                <?php 
                if($recordcount > 0) {
                    $record = 0;
                    while($exe = mysqli_fetch_array($res)) {
                        $record++;
                        
                        $user_id_get = $exe['user_id'];
                        $user_name_get = get_name('user_id', $user_id_get);
                        $user_name = $user_name_get['name'];
                        $description_bank = $exe['description_by_bank'];
                        $description_by_user = $exe['description_by_user'];
                        $follow_up_date_get = $exe['follow_up_date'];
                        if($follow_up_date_get == "" || $follow_up_date_get == '0000-00-00' || $follow_up_date_get == "1970-01-01"){
                            $follow_up_date = '';
                        }else{
                            $follow_up_date = date("d-m-Y", strtotime($follow_up_date_get));
                        }
                        
                        if($exe['follow_up_time'] == "" || $exe['follow_up_time'] == '00:00:00'){
                            $follow_up_time = '';
                        }else{
                            $follow_up_time = date("H:i a", strtotime($exe['follow_up_time']));
                        }
                        
                        $created_on = date("d-m-Y H:i a",strtotime($exe['created_on']));
                ?>
                <tr>
                    <td><?php echo $record; ?></td>
                    <td><?php echo $user_name; ?></td>
                    <td><?php echo $description_bank; ?></td>
                    <td><?php echo $description_by_user; ?></td>
                    <td><?php echo $follow_up_date." ".$follow_up_time; ?></td>
                    <td><?php echo $created_on; ?></td>
                </tr>
                <?php 
                    }
                } 
                ?>
            </table>

        <?php if ($recordcount > 0) { ?>

        <table width="width:90%;margin-left:4%;" border="0" align="center" cellpadding="4" cellspacing="1" class="pagination">
            <tr class="sidemain">
            <td>
                <?php if($page > 1) {
                    echo "<a class='page gradient' href='/crmsml/app/edit.php?page=".($page - 1)."&app_id=" . urlencode(base64_encode($qryyy_id)) . "&cust_id=" . urlencode(base64_encode($cust_id)) . "&loan_type=" . urlencode(base64_encode($loan_type)) . "'>Prev</a>";
                }
                echo "<a class='page gradient' href='javascript:void;'>".$page."</a>";
                if($recordcount > $display_count) {
                    echo "<a class='page gradient' href='/crmsml/app/edit.php?page=".($page + 1)."&app_id=" . urlencode(base64_encode($qryyy_id)) . "&cust_id=" . urlencode(base64_encode($cust_id)) . "&loan_type=" . urlencode(base64_encode($loan_type)) ."'>Next</a>";
                }
                ?>
            </td>
            </tr>
        </table>
        <?php } ?>	
    </div>
</div>