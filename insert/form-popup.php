<?php
// $mov_email_exec = mysqli_query($Conn1, "SELECT id, source_type FROM master_data_verification_source WHERE is_active = 1 AND email_flag = 1");

// $mov_pancard_exec = mysqli_query($Conn1, "SELECT id, source_type FROM master_data_verification_source WHERE is_active = 1 AND pancard_flag = 1");

// $mov_phone_exec = mysqli_query($Conn1, "SELECT id, source_type FROM master_data_verification_source WHERE is_active = 1 AND phone_flag = 1");
?>
<div class="dark-box">
	<div class="lightinside-box">
		<div class="close-darkbox">&#10540;</div>
        <!-- Email Popup -->
		<form action="" class="col-12 form-step" id="verification_popup">

            <input type="hidden" name="popup_cust_id" id="popup_cust_id" value="<?php echo $cust_id; ?>">
            <input type="hidden" name="btn_type_id" id="btn_type_id" value="">

            <div class="form-group col-xl-6 col-lg-4 col-md-6 hidden phone-popup">
                <span class="fa-icon fa-bank"></span>
                <select name="verify_phone" id="verify_phone" onchange="mov_field(this)">
                    <option value="">Select</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
                <label for="verify_phone" class="label-tag">Is Phone Verified?</label>
            </div>
            <div class="form-group col-xl-6 col-lg-4 col-md-6 hidden" id="verify_phone_div">
                <span class="fa-icon fa-bank"></span>
                <select name="verify_phone_mode" id="verify_phone_mode">
                    <option value="">Select</option>                    
                    <?php //while($mov_phone_result = mysqli_fetch_array($mov_phone_exec)) { ?>
                        <!-- <option value="<?php // echo $mov_phone_result['id']; ?>"><?php // echo $mov_phone_result['source_type']; ?></option> -->
                    <?php // } ?>
                </select>
                <label for="verify_phone_mode" class="label-tag">Mode of Verification?</label>
            </div>

            <div class="form-group col-xl-12" style="margin-top: 0; margin-bottom: 0;"></div>

            <div class="form-group col-xl-6 col-lg-4 col-md-6 hidden email-popup">
                <span class="fa-icon fa-bank"></span>
                <select name="verify_email" id="verify_email" onchange="mov_field(this)">
                    <option value="">Select</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
                <label for="verify_email" class="label-tag">Is Email Verified?</label>
            </div>
            <div class="form-group col-xl-6 col-lg-4 col-md-6 hidden" id="verify_email_div">
                <span class="fa-icon fa-bank"></span>
                <select name="verify_email_mode" id="verify_email_mode">
                    <option value="">Select</option>                    
                    <?php //while($mov_email_result = mysqli_fetch_array($mov_email_exec)) { ?>
                        <!-- <option value="<?php // echo $mov_email_result['id']; ?>"><?php // echo $mov_email_result['source_type']; ?></option> -->
                    <?php //} ?>
                </select>
                <label for="verify_email_mode" class="label-tag">Mode of Verification?</label>
            </div>
            <!-- <div class="form-group col-xl-6 col-lg-4 col-md-6 hidden" id="email-val-field">
                <span class="fa-icon fa-bank"></span>
                <select name="validate_email" id="validate_email">
                    <option value="">Select</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
                <label for="validate_email" class="label-tag">Is Email Validated?</label>
            </div> -->

            <div class="form-group col-xl-12" style="margin-top: 0; margin-bottom: 0;"></div>

            <div class="form-group col-xl-6 col-lg-4 col-md-6 hidden pancard-popup">
                <span class="fa-icon fa-bank"></span>
                <select name="verify_pan_card" id="verify_pan_card" onchange="mov_field(this)">
                    <option value="">Select</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
                <label for="verify_pan_card" class="label-tag">Is PAN Card Verified?</label>
            </div>
            <div class="form-group col-xl-6 col-lg-4 col-md-6 hidden" id="verify_pancard_div">
                <span class="fa-icon fa-bank"></span>
                <select name="verify_mode" id="verify_mode">
                    <option value="">Select</option>
                    <?php //while($mov_pancard_result = mysqli_fetch_array($mov_pancard_exec)) { ?>
                        <!-- <option value="<?php // echo $mov_pancard_result['id']; ?>"><?php // echo $mov_pancard_result['source_type']; ?></option> -->
                    <?php // } ?>
                </select>
                <label for="verify_mode" class="label-tag optional-tag">Mode of Verification?</label>
            </div>
            <!-- <div class="form-group col-xl-6 col-lg-4 col-md-6 hidden" id="pancard-val-field">
                <span class="fa-icon fa-bank"></span>
                <select name="validate_pan_card" id="validate_pan_card">
                    <option value="">Select</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
                <label for="validate_pan_card" class="label-tag">Is PAN Card Validated?</label>
            </div> -->

            <div class="text-center col-12 mb-2">
                <input type="button" class="btn btn-primary" name="popup_submit" id="popup_submit" value="SUBMIT">
            </div>
        </form>
	</div>
</div>

<style>.dark-box{position:fixed;width:100%;height:100%;background:rgb(0 0 0 / 56%);overflow:auto;left:0;top:0;display:none;z-index: 99;}.lightinside-box{background:#fff;width:50%;margin:0 auto;border-radius:8px;margin-top:10%;padding:20px;position:relative}.close-darkbox{position:absolute;right:-10px;top:-10px;background:#f13b3b;color:#fff;width:30px;height:30px;font-size:22px;text-align:center;line-height:30px;cursor:pointer;border-radius:50%}.close-darkbox:hover{background:#da3131}</style>