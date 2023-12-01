<?php
//require_once "../../include/con-config.php";
require_once "../../include/check-session.php";
require_once "../../include/config.php";
require_once "../../include/helper.functions.php";

$loan_type = replace_special($_REQUEST['loan_type']);
$partner_id = replace_special($_REQUEST['partner_id']);
$mlc_crm_offers_arr = array("51", "54", "60","57", "11", "63");

$qry = "select * from bre_stp_decision as bre where bre.loan_type = ".$loan_type;
if($partner_id > 0){
  $get_bank_id = mysqli_query($Conn1,"select bank_id from tbl_mlc_partner where partner_id = ".$partner_id);
  $result_bank_id  = mysqli_fetch_assoc($get_bank_id);
  if($result_bank_id['bank_id'] > 0 && is_numeric($result_bank_id['bank_id'])){
    $qry .= " and bank_id = '".$result_bank_id['bank_id']."'";
  }
}

$qry .= " and is_active=1 group by bre.bank_name order by bre.bank_name";
$query = mysqli_query($Conn1, $qry) or die(mysqli_error($Conn1));
if(in_array($loan_type, $mlc_crm_offers_arr)) {
  $th_array = array("MLC Offers", "CRM Offers","Cashback Strip","Pan India Flag");
} else {
  $th_array = array("No Of Applications","Disb. Applications Count","Min Lead Score","Max Lead Score","Mean Lead Score","Median Lead Score","Cut of Score Top Decile","Cut of Score Top Quatrile","Cut of Score Top 50","Cut of Score Top 80","A2D Ratio (%)","MLC Offers","CRM Offers","Offers on Site (Min /Max)","Offers on CRM (Min /Max)","Score Slab 1 (From /To)","Score Slab 2 (From /To)","Score Slab 3 (From /To)","Approval Chance Slab 1 (From /To) %","Approval Chance Slab 2 (From /To) %","Approval Chance Slab 3 (From /To) %","Cashback Strip","Pan India Flag");
}
                $first_tbl = '';
                $secd_tbl = '';
                while ($result_query = mysqli_fetch_array($query)){
                    $id = $result_query['id'];

                    $is_offer_website_0 = ($result_query['is_offers_website'] == 0)?'selected':'';
                    $is_offer_website_1 = ($result_query['is_offers_website'] == 1)?'selected':'';
                    $is_offer_website_2 = ($result_query['is_offers_website'] == 2)?'selected':'';
                    $is_offer_website_10 = ($result_query['is_offers_website'] == 10)?'selected':'';
                    $is_offer_website_11 = ($result_query['is_offers_website'] == 11)?'selected':'';
                    $is_offer_crm_0 = ($result_query['is_offers_crm'] == 0)?'selected':'';
                    $is_offer_crm_1 = ($result_query['is_offers_crm'] == 1)?'selected':'';

                    $cashback_strip_0 = ($result_query['is_cashback_strip'] == 0)?'selected':'';
                    $cashback_strip_1 = ($result_query['is_cashback_strip'] == 1)?'selected':'';

                    $city_flag_0 = ($result_query['city_flag'] == 0)?'selected':'';
                    $city_flag_1 = ($result_query['city_flag'] == 1)?'selected':'';

                    $bank_name_f = $result_query['bank_name'];
                    if($result_query['bank_id'] == 23){
                        $bank_name_f = 'SCB';
                    }

                    $initial_bank_name = substr($bank_name_f, 0, 15);

                 $first_tbl .= "<tr>
                    <td><input type='hidden' name='bank_id_select_".$id."' value='".$result_query['bank_id']."'>
                    <input type='hidden' name='loan_id_select_".$id."' value='".$result_query['loan_type']."'>
                    <input type='checkbox' name='ch_edit[]' value='".$id."' id='".$id."' onchange='removeDisabled(this);' class='loan_type'/></td><td title='".$bank_name_f."'>".$initial_bank_name."</td></tr>";
                    $secd_tbl .= "<tr>";
                    if(!in_array($loan_type, $mlc_crm_offers_arr)) {
                      $secd_tbl .= "<td>".custom_money_format($result_query['no_of_applications'], 0)."</td>
                      <td>".custom_money_format($result_query['no_of_disbursed_cases'], 0)."</td>
                      <td>".custom_money_format($result_query['min_lead_score'], 0)."</td>
                      <td>".custom_money_format($result_query['max_lead_score'], 0)."</td>
                      <td>".custom_money_format($result_query['mean_score'], 0)."</td>
                      <td>".custom_money_format($result_query['median_score'], 0)."</td>
                      <td>".custom_money_format($result_query['cut_of_score_top_decile'], 0)."</td>
                      <td>".custom_money_format($result_query['cut_of_score_top_quatrile'], 0)."</td>
                      <td>".custom_money_format($result_query['cut_of_score_of_top_50'], 0)."</td>
                      <td>".custom_money_format($result_query['cut_of_score_of_top_80'], 0)."</td>
                      <td>".custom_money_format($result_query['a2d_ratio'], 0)."</td>";
                    }
                  
                     $secd_tbl .= "<td><select name='is_offers_website_".$id."' id='is_offers_website_".$id."' disabled='' class='".$id."_chng'>
                            <option value=''>Select</option>
                            <option value='0' ".$is_offer_website_0.">No Apply Button</option>
                            <option value='1' ".$is_offer_website_1.">Apply STP</option>
                            <option value='2' ".$is_offer_website_2.">Apply Non STP No Delta Form</option>
                            <option value='10' ".$is_offer_website_10.">Apply Non STP with Delta Form</option>
                            <option value='11' ".$is_offer_website_11.">No offer Display</option>
                        </select>
                    </td>
                    <td><select name='is_offers_crm_".$id."'
                        id='is_offers_crm_".$id."' disabled='' class='".$id."_chng'>
                            <option value=''>Select</option>
                            <option value='0' ".$is_offer_crm_0.">No offer Display</option>
                            <option value='1' ".$is_offer_crm_1.">Display Offer</option>
                        </select>
                    </td>";
                  
                  if(!in_array($loan_type, $mlc_crm_offers_arr)) {
                    $secd_tbl .= "<td>
                    <div class='field-txt'>
                        <input id='min_score_for_offer_on_site_".$id."' name='min_score_for_offer_on_site_".$id."' value='".custom_money_format($result_query['min_score_for_offer_on_site'], 0)."' onkeyup='offer_on_mlc_site_min(".$id.",this.value);' class='".$id."_chng numonly max_val_1000' disabled='' type='tel' maxlength='4'/>
                        <input id='max_score_for_offer_on_site_".$id."' name='max_score_for_offer_on_site_".$id."' value='".custom_money_format($result_query['max_score_for_offer_on_site'], 0)."' onkeyup='offer_on_mlc_site_max(".$id.",this.value);' onfocusout='offer_on_mlc_site_max_f(".$id.",this.value);' class='".$id."_chng numonly max_val_1000' disabled='' type='tel' maxlength='4'/>
                        <span class='error error_msg_min_site".$id." hidden'>Max Score is greater than Min Score</span>
                        </div></td>
                    <td><div class='field-txt'>
                        <input id='min_score_for_offer_on_crm_".$id."' name='min_score_for_offer_on_crm_".$id."' value='".custom_money_format($result_query['min_score_for_offer_on_crm'], 0)."' class='".$id."_chng numonly max_val_1000' disabled='' type='tel' maxlength='4'/>
                        
                        <input id='max_score_for_offer_on_crm_".$id."' name='max_score_for_offer_on_crm_".$id."' value='".custom_money_format($result_query['max_score_for_offer_on_crm'], 0)."' onfocusout='offer_on_crm_site_max_f(".$id.",this.value);' class='".$id."_chng numonly max_val_1000' disabled='' type='tel' maxlength='4'/>
                        <span class='error error_msg_min_crm".$id." hidden'>Max Score is greater than Min Score</span>
                        </div></td>
                    <td><div class='field-txt'>
                    <span id='score_slab1_from1_".$id."'>".custom_money_format($result_query['score_slab1_from'], 0)."</span>
                        &nbsp;&nbsp;&nbsp;&nbsp; - &nbsp;&nbsp;&nbsp;&nbsp;<span id='score_slab1_to1_".$id."'>".custom_money_format($result_query['score_slab1_to'], 0)."</span>
                        <input id='score_slab1_from_".$id."' name='score_slab1_from_".$id."' value='".custom_money_format($result_query['score_slab1_from'], 0)."' type='hidden'/>
                      
                        <input id='score_slab1_to_".$id."' name='score_slab1_to_".$id."' value='".custom_money_format($result_query['score_slab1_to'], 0)."'  type='hidden'/></div>
                        </td>
                    <td><div class='field-txt'>
                    <span id='score_slab2_from1_".$id."'>".custom_money_format($result_query['score_slab2_from'], 0)."</span>
                       &nbsp;&nbsp;&nbsp;&nbsp; - &nbsp;&nbsp;&nbsp;&nbsp; <span id='score_slab2_to1_".$id."'>".custom_money_format($result_query['score_slab2_to'], 0)."</span>
                        <input id='score_slab2_from_".$id."' name='score_slab2_from_".$id."' value='".custom_money_format($result_query['score_slab2_from'], 0)."' type='hidden'/>
                        
                        <input id='score_slab2_to_".$id."' name='score_slab2_to_".$id."' value='".custom_money_format($result_query['score_slab2_to'], 0)."' type='hidden'/>
                        </div></td>
                    <td><div class='field-txt'>
                    <span id='score_slab3_from1_".$id."'>".custom_money_format($result_query['score_slab3_from'], 0)."</span>
                        &nbsp;&nbsp;&nbsp;&nbsp; - &nbsp;&nbsp;&nbsp;&nbsp;<span id='score_slab3_to1_".$id."'>".custom_money_format($result_query['score_slab3_to'], 0)."</span>
                        <input id='score_slab3_from_".$id."' name='score_slab3_from_".$id."' value='".custom_money_format($result_query['score_slab3_from'], 0)."'  type='hidden'/>
                        
                        <input id='score_slab3_to_".$id."' name='score_slab3_to_".$id."' value='".custom_money_format($result_query['score_slab3_to'], 0)."' type='hidden'/>
                        </div></td>
                    <td><div class='field-txt'>
                        <input id='approval_chance_slab1_".$id."' name='approval_chance_slab1_".$id."' value='".custom_money_format($result_query['approval_chance_slab1'], 0)."' class='".$id."_chng numonly max_val' disabled='' type='tel' maxlength='3'/>
                    <input id='approval_chance_slab1_to_".$id."' name='approval_chance_slab1_to_".$id."' value='".custom_money_format($result_query['approval_chance_slab1_to'], 0)."' class='".$id."_chng numonly max_val' onfocusout='app_slab_1_f(".$id.",this.value);' disabled='' type='tel' maxlength='3'/>
                    <span class='error error_app_slab1".$id." hidden'>To Score is greater than From Score</span>
                    </div></td>
                    <td><div class='field-txt'>
                        <input id='approval_chance_slab2_".$id."' name='approval_chance_slab2_".$id."' value='".custom_money_format($result_query['approval_chance_slab2'], 0)."' class='".$id."_chng numonly max_val' disabled='' type='tel' maxlength='3'/>
                        
                     <input id='approval_chance_slab2_to_".$id."' name='approval_chance_slab2_to_".$id."' value='".custom_money_format($result_query['approval_chance_slab2_to'], 0)."' class='".$id."_chng numonly max_val' onfocusout='app_slab_2_f(".$id.",this.value);' disabled='' type='tel' maxlength='3'/>
                     <span class='error error_app_slab2".$id." hidden'>To Score is greater than From Score</span>
                     </div></td>
                    <td><div class='field-txt'>
                        <input id='approval_chance_slab3_".$id."' name='approval_chance_slab3_".$id."' value='".custom_money_format($result_query['approval_chance_slab3'], 0)."' class='".$id."_chng numonly max_val' disabled='' type='tel' maxlength='3'/>
                     <input id='approval_chance_slab3_to_".$id."' name='approval_chance_slab3_to_".$id."' value='".custom_money_format($result_query['approval_chance_slab3_to'], 0)."' onfocusout='app_slab_3_f(".$id.",this.value);' class='".$id."_chng numonly max_val' disabled='' type='tel' maxlength='3'/>
                     <span class='error error_app_slab3".$id." hidden'>To Score is greater than From Score</span>
                     </div></td>";
                  }
                  $secd_tbl .= "
                  <td><select name='cashback_strip_".$id."' id='cashback_strip_".$id."' disabled='' class='".$id."_chng'>
                            <option value=''>Select</option>
                            <option value='1' ".$cashback_strip_1.">Yes</option>
                            <option value='0' ".$cashback_strip_0.">No</option>
                        </select>
                    </td>
                    <td><select name='city_flag_".$id."' id='city_flag_".$id."' disabled='' class='".$id."_chng'>
                    <option value=''>Select</option>
                    <option value='1' ".$city_flag_1.">Yes</option>
                    <option value='0' ".$city_flag_0.">No</option>
                </select>
            </td>
                  
                  </tr>";
                    ?>
                <?php } ?>
            <!-- </tbody>
            </table>
        </form>
    </div> -->  
    <form action="" method="POST" onsubmit="return form_valid();">
        <input type="submit" name="update" value="Update" class="btn buttonsub mall_10 cursor" style="
    margin-left: 341px;
">
<input type="button" name="download" value="Download" class="btn buttonsub mall_10 cursor" style="margin-left: 20px;" onclick="download_csv('<?php echo $partner_id; ?>', '<?php echo $loan_type; ?>')" />
            <input type="hidden" value="<?php echo $loan_type; ?>" name ="search_loan_type">
            <input type="hidden" value="<?php echo $partner_id; ?>" name ="search_partner_id">
    <div class="tbl-pwrapper">
    <table class="sticky-left" style="width:200px!important;">
      <thead>
        <tr>
          <th><input type="checkbox" name="selectAll[]" id="selectAll">All</th>
          <th>Bank Name</th>
        </tr>
      </thead>
      <tbody>
        <?php echo $first_tbl; ?>
      </tbody>
    </table>
    <table class="content-table">
      <thead>
        <tr>
          <th><?php echo implode("</th><th>",$th_array); ?></th>
        </tr>
      </thead>
      <tbody>
        <?php echo $secd_tbl; ?>
      </tbody>
    </table>
  </div>
</form>
    <style>
        div#loan{margin: auto; width: 90%;}
        /* div#loan form{width:1340px;} */

.tbl-pwrapper table, th, td {
  border: 1px solid #efefef;
  border-collapse: collapse;
  text-align: center;
  padding: 5px 0px;
  font-size: 12px;
}

.tbl-pwrapper table th{
    border-color: #bbbbbb;
    background-color: #18375f;
    color:#ffffff;
}


.tbl-pwrapper .sticky-left {
  text-align: left;
  left: 0;
  position: sticky;
  z-index: 4;
}
span.error{position: absolute;color: red;font-size: 10px;bottom: -5px;width: 100%;margin: auto;}

.tbl-pwrapper .sticky-left td {
  /* max-width: 200px;
  min-width: 200px; */
  background: lightgrey;
  line-height: 32px;
}
.tbl-pwrapper .sticky-left thead th {
  padding:7px 0px;
  line-height: 30px;
  font-weight: 500;
  position: -webkit-sticky;
    position: sticky;
    top: 0;
}

.tbl-pwrapper thead th {
  padding: 15px 5px;
  background: #f4f3f8;
  font-size: 14px;
  border: none;
  color: #ffffff;
  /* max-width: 200px;
  min-width: 200px; */
  background-color: #18375f; 
}
.tbl-pwrapper .sticky-left{ width: 16.5%;}
.minwidth{min-width: 170px;}
.sticky-left th:first-child {
    width: 34%;
}
.tbl-pwrapper .content-table thead th{  max-width: 120px;
    min-width: 210px;
    padding:7px 0px;
    font-size: 12px;
    border: 1px solid #fff;
    line-height: 30px;
    position: -webkit-sticky;
    position: sticky;
    top: 0;
    z-index: 1;
    font-weight: normal;}
 .content-table thead tr th:nth-child(20) {font-size: 12px;}
 .content-table thead tr th:nth-child(21) {font-size: 12px;}
 .content-table thead tr th:nth-child(22) {font-size: 12px;}
.sticky-left td:last-child {
    text-align: left;
    padding-left: 5px;
    padding-bottom: 4.5px;
}
/* .tbl-pwrapper .content-table {
    margin-left: 6.9rem;
} */
.field-txt {
    display: flex;
    width: 93%;
    margin: auto;
    position: relative;
    min-height: 31px;
    min-height: 31px;
}
.lineheight{ line-height: 19px;}
.field-txt input {
    width: 46%;
    margin: 0px 5px;
}
<?php if($loan_type == 56) { ?>
.tbl-pwrapper td select{margin: 0px;}
.tbl-pwrapper {
  display: -webkit-box;;
  overflow: auto;
  height: 560px;
  width: 100%;
  /* margin: auto; */
}
<?php } else { ?>
  .tbl-pwrapper td select{margin: 0px; height: 31px!important;}
  .tbl-pwrapper {
  display: -webkit-box;;
  width: 100%;
  /* margin: auto; */
}
  .content-table{
    width:80%!important;
  }
<?php } ?>
/* Table End */
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
        function removeDisabled(e){
            if($(e).is(":checked")){
                $("."+e.id+"_chng").removeAttr("disabled");
                $("#" + e.id + "_chng").addClass("new_textbox");
            }else{
                $("."+e.id+"_chng").attr("disabled",true);
            }
        }
        function offer_on_mlc_site_min(id,fval){
          fval = fval.replace(/,/g, '');
            var score_slab1_to_val = Math.round(parseInt(fval, 10)+ ((parseInt($("#max_score_for_offer_on_site_"+id).val().replace(/,/g, ''), 10)-parseInt(fval, 10))/3));
            var score_slab2_from = parseInt(score_slab1_to_val,10)+1;
            var score_slab_2_to_val = Math.round(parseInt(score_slab2_from, 10)+parseInt(score_slab1_to_val, 10)-(parseInt(fval, 10)+1));
            var score_slab3_from = parseInt(score_slab_2_to_val,10)+1;
            //var score_slab3_to = Math.round(parseInt(score_slab3_from, 10)+parseInt(score_slab_2_to_val, 10) - parseInt(score_slab2_from, 10));
            $("#score_slab1_from_"+id).val(fval);
            $("#score_slab1_to_"+id).val(score_slab1_to_val);
           $("#score_slab2_from_"+id).val(score_slab2_from);
           $("#score_slab2_to_"+id).val(score_slab_2_to_val);
           $("#score_slab3_from_"+id).val(score_slab3_from);
           $("#score_slab3_to_"+id).val($("#max_score_for_offer_on_site_"+id).val());
           
           $("#score_slab1_from1_"+id).html(fval);
            $("#score_slab1_to1_"+id).html(score_slab1_to_val);
           $("#score_slab2_from1_"+id).html(score_slab2_from);
           $("#score_slab2_to1_"+id).html(score_slab_2_to_val);
           $("#score_slab3_from1_"+id).html(score_slab3_from);
           $("#score_slab3_to1_"+id).html($("#max_score_for_offer_on_site_"+id).val());
        }
        function offer_on_mlc_site_max(id,fval){
            fval = fval.replace(/,/g, '');
            var score_slab1_to_val = Math.round(parseInt($("#score_slab1_from_"+id).val().replace(/,/g, ''), 10)+((parseInt(fval, 10)-parseInt($("#score_slab1_from_"+id).val().replace(/,/g, ''), 10))/3));
            var score_slab2_from = parseInt(score_slab1_to_val,10)+1;
            var score_slab_2_to_val = Math.round(parseInt(score_slab2_from, 10)+parseInt(score_slab1_to_val, 10)-(parseInt($("#score_slab1_from_"+id).val().replace(/,/g, ''), 10)+1));
            var score_slab3_from = parseInt(score_slab_2_to_val,10)+1;
            //var score_slab3_to = Math.round(parseInt(score_slab3_from, 10)+parseInt(score_slab_2_to_val, 10) - parseInt(score_slab2_from, 10));
            $("#score_slab1_to_"+id).val(score_slab1_to_val);
            $("#score_slab2_from_"+id).val(score_slab2_from); 
             $("#score_slab2_to_"+id).val(score_slab_2_to_val);  
              $("#score_slab3_from_"+id).val(score_slab3_from);   
              $("#score_slab3_to_"+id).val(fval); 
              $("#score_slab1_to1_"+id).html(score_slab1_to_val);
            $("#score_slab2_from1_"+id).html(score_slab2_from); 
             $("#score_slab2_to1_"+id).html(score_slab_2_to_val);  
              $("#score_slab3_from1_"+id).html(score_slab3_from);   
              $("#score_slab3_to1_"+id).html(fval); 
        }
        function offer_on_mlc_site_max_f(id,fval){
          fval = fval.replace(/,/g, '');
          if(parseInt(fval,10) < parseInt($("#min_score_for_offer_on_site_"+id).val().replace(/,/g, ''),10)){
            $(".error_msg_min_site"+id).removeClass("hidden").val("");
          }else{
             $(".error_msg_min_site"+id).addClass("hidden");
          }
        }
        function offer_on_crm_site_max_f(id,fval){
            fval = fval.replace(/,/g, '');
            if(parseInt(fval,10) < parseInt($("#min_score_for_offer_on_crm_"+id).val().replace(/,/g, ''),10)){
            $(".error_msg_min_crm"+id).removeClass("hidden").val("");
          }else{
             $(".error_msg_min_crm"+id).addClass("hidden");
          }
        }
        function app_slab_1_f(id,fval){
          fval = fval.replace(/,/g, '');
          if(parseInt(fval,10) < parseInt($("#approval_chance_slab1_"+id).val().replace(/,/g, ''),10)){
            $(".error_app_slab1"+id).removeClass("hidden").val("");
          }else{
             $(".error_app_slab1"+id).addClass("hidden");
          }
        }
        function app_slab_2_f(id,fval){
          fval = fval.replace(/,/g, '');
          if(parseInt(fval,10) < parseInt($("#approval_chance_slab2_"+id).val().replace(/,/g, ''),10)){
            $(".error_app_slab2"+id).removeClass("hidden").val("");
          }else{
             $(".error_app_slab2"+id).addClass("hidden");
          }
        }
        function app_slab_3_f(id,fval){
          fval = fval.replace(/,/g, '');
          if(parseInt(fval,10) < parseInt($("#approval_chance_slab3_"+id).val().replace(/,/g, ''),10)){
            $(".error_app_slab3"+id).removeClass("hidden").val("");
          }else{
             $(".error_app_slab3"+id).addClass("hidden");
          }
        }
    </script>
    <br><BR><BR>
<?php
mysqli_close($mlc);
include("../../include/footer_close.php");
?>