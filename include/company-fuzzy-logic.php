<?php
session_start();
if (isset($_REQUEST['comp_name'])){
    $type = $_REQUEST['type'];
	//$slave =1; 
    require_once(dirname(__FILE__) . '/../config/session.php');
    require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
    require_once(dirname(__FILE__) . '/../config/config.php');
    require_once "../include/helper.functions.php";
    $input = replace_special($_REQUEST['comp_name']);
    $comp_category = replace_special($_REQUEST['comp_category']);

    $sub_comp_category = replace_special($_REQUEST['sub_comp_category']);
    $sub_sub_comp_category = replace_special($_REQUEST['sub_sub_comp_category']);
    $govt_cat_state_id = replace_special($_REQUEST['govt_cat_state_id']);
    $explode_array = explode(" ",$input);
    if($type == 'select'){
        $data = 0;
    // foreach($explode_array as $value){
    //     $data = check_company_category($value);
    //     if($data > 0){
    //         break;
    //     }
    // }
   
        $class = 'col-xl-2';

    if($data == 1){ ?>
    <div class="form-group col-xl-3 col-lg-4 col-md-6 gvt_cat state_drop">
    <input type="hidden" name="main_comp_category" value="<?php echo $data; ?>" >
        <label for="company_sub_cat" class="radio-tag label-tag">Select Any One</label>
        <div class="radio-button">
        <input type="radio" name="company_sub_cat" required id="company_sub_cat1" <?php if($sub_comp_category == 1){?>checked<?php } ?> value="1" class="valid">
        <label for="company_sub_cat1" class="cursor">Central Police</label>
        <input type="radio" name="company_sub_cat" required id="company_sub_cat2" <?php if($sub_comp_category == 5){?>checked<?php } ?> value="5" class="valid">
        <label for="company_sub_cat2" class="cursor">Para military Forces</label> 
        <input type="radio" name="company_sub_cat" required id="company_sub_cat3" <?php if($sub_comp_category == 2){?>checked<?php } ?> value="2" class="valid">
        <label for="company_sub_cat3" class="cursor">State Police</label> 
        </div>
    </div>
    <?php }else if($data == 2){ ?>
    <div class="form-group <?php echo $class; ?> col-lg-4 col-md-6 gvt_cat">
    <input type="hidden" name="main_comp_category" value="<?php echo $data; ?>" >
        <label for="company_sub_cat" class="radio-tag label-tag">Are you working with Indian Army?</label>
        <div class="radio-button">
        <input type="radio" name="company_sub_cat" id="company_sub_cat1" <?php if($sub_comp_category == 4){?>checked<?php } ?> required value="4" class="valid">
        <label for="company_sub_cat1" class="cursor">Yes</label>
        <input type="radio" name="company_sub_cat" id="company_sub_cat2" required value="0" class="valid">
        <label for="company_sub_cat2" class="cursor">No</label> 
        </div>
    </div>
   <?php }else if($data == 3){ ?>
    <div class="form-group <?php echo $class; ?> col-lg-4 col-md-6 gvt_cat">
    <input type="hidden" name="main_comp_category" value="<?php echo $data; ?>" >
        <label for="company_sub_cat" class="radio-tag label-tag">You Work for?</label>
        <div class="radio-button">
        <input type="radio" name="company_sub_cat" id="company_sub_cat1" <?php if($sub_comp_category == 1){?>checked<?php } ?> required value="1" class="valid">
        <label for="company_sub_cat1" class="cursor">Indian Railway</label>
        <input type="radio" name="company_sub_cat" id="company_sub_cat2" required value="0" class="valid">
        <label for="company_sub_cat2" class="cursor">IRCTC</label> 
        </div>
   </div>
  <?php }else if($data == 4){ ?>
      <div class="form-group col-xl-3 col-lg-4 col-md-6 gvt_cat state_drop">
      <input type="hidden" name="main_comp_category" value="<?php echo $data; ?>" >
      <label for="company_sub_cat" class="radio-tag label-tag">Select Any One </label>
      <div class="radio-button">
      <input type="radio" name="company_sub_cat" id="company_sub_cat1" required <?php if($sub_comp_category == 1){?>checked<?php } ?> value="1" class="valid">
      <label for="company_sub_cat1" class="cursor">Central Govt Authority</label>
      <input type="radio" name="company_sub_cat" id="company_sub_cat2" required <?php if($sub_comp_category == 2){?>checked<?php } ?> value="2" class="valid">
      <label for="company_sub_cat2" class="cursor">State Govt Authority</label> 
      <input type="radio" name="company_sub_cat" id="company_sub_cat3" required <?php if($sub_comp_category == 3){?>checked<?php } ?> value="3" class="valid">
      <label for="company_sub_cat3" class="cursor">Private Authority</label> 
      </div>
      </div>
   <?php }else if($data == 5){ ?>
    <div class="form-group <?php echo $class; ?> col-lg-4 col-md-6 gvt_cat">
    <input type="hidden" name="main_comp_category" value="<?php echo $data; ?>" >
        <label for="company_sub_cat" class="radio-tag label-tag">Are you working with Indian Navy?</label>
        <div class="radio-button">
        <input type="radio" name="company_sub_cat" id="company_sub_cat1" <?php if($sub_comp_category == 4){?>checked<?php } ?> required value="4" class="valid">
        <label for="company_sub_cat1" class="cursor">Yes</label>
        <input type="radio" name="company_sub_cat" id="company_sub_cat2" required value="0" class="valid">
        <label for="company_sub_cat2" class="cursor">No</label> 
        </div>
    </div>
<?php }else if($data == 6){ ?>
    <div class="form-group <?php echo $class; ?> col-lg-4 col-md-6 gvt_cat">
    <input type="hidden" name="main_comp_category" value="<?php echo $data; ?>" >
        <label for="company_sub_cat" class="radio-tag label-tag">Are you working with Indian Airforce?</label>
        <div class="radio-button">
        <input type="radio" name="company_sub_cat" id="company_sub_cat1" required <?php if($sub_comp_category == 4){?>checked<?php } ?> value="4" class="valid">
        <label for="company_sub_cat1" class="cursor">Yes</label>
        <input type="radio" name="company_sub_cat" id="company_sub_cat2" required value="0" class="valid">
        <label for="company_sub_cat2" class="cursor">No</label> 
        </div>
    </div>
<?php }else if(in_array($data,array(7,8,9,10,11))){ if($data == 7){
    $heading = 'Type of Institute';
}else if($data == 8){
    $heading = 'Type of College';
}else if($data == 9){
    $heading = 'Type of School';
}else if($data == 10){
    $heading = 'Type of Hospital';
}else if($data == 11){
    $heading = 'Type of University';
}?>
    <div class="form-group col-xl-3 col-lg-4 col-md-6 gvt_cat state_drop">
    <input type="hidden" name="main_comp_category" value="<?php echo $data; ?>" >
    <label for="company_sub_cat" class="radio-tag label-tag"><?php echo $heading; ?></label>
    <div class="radio-button">
    <input type="radio" name="company_sub_cat" id="company_sub_cat1" <?php if($sub_comp_category == 1){?>checked<?php } ?> value="1" required class="valid">
    <label for="company_sub_cat1" class="cursor">Central Govt</label>
    <input type="radio" name="company_sub_cat" id="company_sub_cat2" <?php if($sub_comp_category == 2){?>checked<?php } ?> value="2" required class="valid">
    <label for="company_sub_cat2" class="cursor">State Govt</label> 
    <input type="radio" name="company_sub_cat" id="company_sub_cat3" <?php if($sub_comp_category == 3){?>checked<?php } ?> value="3" required class="valid">
    <label for="company_sub_cat3" class="cursor">Private</label> 
    </div>
    </div>
<?php if(in_array($data,array(7,8,9,11))){ ?>
    <div class="form-group col-xl-3 col-lg-4 col-md-6 gvt_cat">
    <label for="company_sub_sub_cat" class="radio-tag label-tag">Role</label>
    <div class="radio-button">
    <input type="radio" name="company_sub_sub_cat" id="company_sub_sub_cat1" <?php if($sub_sub_comp_category == 1){?>checked<?php } ?> required value="1" class="valid">
    <label for="company_sub_sub_cat1" class="cursor">Teaching</label>
    <input type="radio" name="company_sub_sub_cat" id="company_sub_sub_cat2" <?php if($sub_sub_comp_category == 2){?>checked<?php } ?> required value="2" class="valid">
    <label for="company_sub_sub_cat2" class="cursor">Non Teaching</label> 
    </div>
    <?php } }else if($data == 12 || $data == 14){ ?>
    <div class="form-group col-xl-3 col-lg-4 col-md-6 gvt_cat state_drop">
    <input type="hidden" name="main_comp_category" value="<?php echo $data; ?>" >
    <label for="company_sub_cat" class="radio-tag label-tag">Select Any One</label>
    <div class="radio-button">
    <input type="radio" name="company_sub_cat" id="company_sub_cat1" required value="1" <?php if($sub_comp_category == 1){?>checked<?php } ?> class="valid">
    <label for="company_sub_cat1" class="cursor">Central Govt</label>
    <input type="radio" name="company_sub_cat" id="company_sub_cat2" required value="2" <?php if($sub_comp_category == 2){?>checked<?php } ?> class="valid">
    <label for="company_sub_cat2" class="cursor">State Govt</label> 
    </div>
    </div>
<?php } ?>
<script>
function chnage_state_comp_cat(){
    var selected_val = $("input[name='company_sub_cat']:checked").val();
    var main_cat_id = $("input[name='main_comp_category']").val();
        $(".comp_cat_state").remove();
        if(selected_val == 2 || (main_cat_id == 1 && selected_val == 1)){
            $.ajax({
                method: "POST",
                url: "<?php echo $head_url;?>/include/state-name.php?main_cat_id="+main_cat_id+"&value="+selected_val+"&state_id=<?php echo $govt_cat_state_id; ?>",
                success: function(data) {
                    $(data).insertAfter(".state_drop");
                }
        });
    }  
}
    $("input[name='company_sub_cat']").change(function(){
        chnage_state_comp_cat();
    });
    chnage_state_comp_cat();
</script>
<?php }
        if($data == 0){
            $array = array();
            $check_company_name_exist = mysqli_query($Conn1,"select * from crm_master_company where company_name = '".$input."' and is_active = 1 ");
            if(mysqli_num_rows($check_company_name_exist) == 0){
                $query = "select id As comp_id,company_name as comp_name from crm_master_company where company_name <> '".$input."' and is_active = 1 ORDER by company_name";
                $get_company_name_qry = mysqli_query($Conn1,$query) OR DIE(mysqli_error($Conn1));
                $count = mysqli_num_rows($get_company_name_qry);
                if($count > 0){
                    $percent_data = '';
                    while($result_connection = mysqli_fetch_assoc($get_company_name_qry)){
                            $word = $result_connection['comp_name'];

                            $lev = levenshtein($input, $word);
                            $similar_lev = similar_text($input, $word,$percent);
                            if($percent >= 80){
                                $percent_data .= "<option value='".$word."'>".$word."</option>";
                                $array[] = array("matched_company_id"=>$result_connection['comp_id'],"matched_company_name"=>$word);
                            }
                        }
                    }
            }
            if(!empty($array)){
                if($type == 'select'){
                    echo "<div class='form-group col-xl-2 col-lg-4 col-md-6 gvt_cat'>
                    <span class='fa-icon'></span>
                    <select name='second_comp_name' id='second_comp_name' onchange='change_secd_comp_name(this.value);' class='form-control salaried valid'>
                    <option value=''>Select</option>".$percent_data;
                    echo "<option disabled value=''>-------------------------------------</option><option value='".$input."'>".$input."</option>
                    </select>
                    <label for='second_comp_name' class='label-tag'>Similar Company Name</label>
                    </div>";
                }else{
                    echo json_encode(array("status"=>"success","is_data_found"=>1,"data"=>$array));
                }   
            }
        }
    }
    
?>