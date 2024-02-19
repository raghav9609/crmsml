<?php
if(!empty($_REQUEST['pat_ids'])){
	require_once "../../include/check-session.php";
	require_once "../../include/config.php";
	require_once "../../include/dropdown.php";
	require_once "../../include/helper.functions.php";
	$pat_ids = explode(',',$_REQUEST['pat_ids']);
    $bank_slect = explode(',',$_REQUEST['bank_slect']);
	$case_id = base64_decode($_REQUEST['id']);
    $cust_id = $_REQUEST['cust_id'];
    $hdfc_api_type = $_REQUEST['hdfc_api_type'];
    $bajaj_twl_api_type = $_REQUEST['bajaj_twl_api_type'];
    $kotak_pl_api_type = $_REQUEST['kotak_pl_api_type'];
	if(replace_special($case_id) != '' && is_numeric($case_id)){
		$case_data = mysqli_query($Conn1,"SELECT cse.cust_id as cust_id,cse.appointment_date,cse.appointment_time,cse.loan_type as loan_type,cse.query_id as query_id,cse.sbi_applied as sbi_applied,cse.apply_for_card as apply_for_card,cse.residential_id as residential_id,cse.loan_purpose as loan_purpose,cse.monthly_rent_amount as monthly_rent_amount, cse.purpose_name as purpose_name,cse.current_residence_since as  current_residence_since,cse.course_study as course_study,cse.processing_fee AS processing_fees,cse.pref_loan_tenur AS pref_loan_tenur, cse.car_name_id AS car_name_id, cse.car_model AS car_model, address_proof_no AS address_proof_no, year_at_city AS year_at_city FROM tbl_mint_case as cse where cse.case_id = ".$case_id." order by cse.case_id desc");
		if(mysqli_num_rows($case_data) > 0){
			$fetch_sugar = mysqli_fetch_assoc($case_data);
            $course_study = $fetch_sugar['course_study'];
            $pref_tenure_f = $fetch_sugar['pref_loan_tenur'];
            $processing_fees = $fetch_sugar['processing_fees'];
            $current_residence_since = $fetch_sugar['current_residence_since'];
			$query_id = $fetch_sugar['query_id'];
            $loan_type = $fetch_sugar['loan_type'];
			$sbi_applied = $fetch_sugar['sbi_applied'];
			$sbi_applied_card = $fetch_sugar['apply_for_card'];
            $appointment_time = $fetch_sugar['appointment_time'];
            $appointment_date = $fetch_sugar['appointment_date'];
            $sbi_applied_card_arr  = explode(",",$sbi_applied_card);
            
            $twl_make_id        = $fetch_sugar['car_name_id'];
            $twl_model_id       = $fetch_sugar['car_model'];
            $id_proof_type_twl  = $fetch_sugar['address_proof_no'];
            $year_at_city       = $fetch_sugar['year_at_city'];
            $residential_id     = $fetch_sugar['residential_id'];
            $loan_purpose       = $fetch_sugar['loan_purpose'];
            $monthly_rent_amount= $fetch_sugar['monthly_rent_amount'];
            $purpose_name       = $fetch_sugar['purpose_name'];

            if(in_array(131,$pat_ids)){
                
                $qry_residential = mysqli_query($Conn1, "SELECT mwide_id FROM tbl_residential_type where rented_id = '" . $residential_id . "'");
                $result_residential = mysqli_fetch_array($qry_residential);
                $mwide_residence_id = $result_residential['mwide_id'];
        
                $qry_loanp = mysqli_query($Conn1, "SELECT mwide FROM purpose_of_loan where id = '" . $loan_purpose . "'");
                $result_loanp = mysqli_fetch_array($qry_loanp);
                $mwide_loanp_id = $result_loanp['mwide'];
            }
		}
	}
    if(replace_special($cust_id) != '' && is_numeric($cust_id)){
        $cust_data = mysqli_query($Conn1,"SELECT cust.account_no as account_no,cust.permanent_res_address as permanent_res_address,cust.bank_id as bank_account_with,cust.email as email,cust.res_address as res_address,cust.maritalstatus as maritalstatus, cust.offce_address as offce_address,cust.ofc_pincode as ofc_pincode, cust.pan_card as pan_card,cust.ofc_email as ofc_email,intt.relation_bank as relation_bank,intt.designation_id as designation_id,intt.profession_id as profession_id,cust.ofc_contact as ofc_contact,cust.account_no as account_no,cust.offce_address as offce_address,intt.qualification as qualification,intt.type_company as type_company,intt.ref_1_name AS ref_1_name, intt.ref_1_mobile AS ref_1_mobile, cust.caste as caste, intt.no_of_dependent AS no_of_depend, intt.religion_id AS religion_id, cust.city_id AS city_id, intt.pincode AS pincode, cust.dob AS dob, cust.email AS email, intt.ref_2_name AS ref_2_name, intt.ref_2_mobile AS ref_2_mobile, intt.fs_first_name AS fs_first_name, intt.fs_last_name AS fs_last_name, intt.mother_first_name AS mother_first_name, intt.mother_last_name AS mother_last_name, intt.fst_ref_address, intt.sec_ref_address, intt.fst_ref_relation, intt.sec_ref_relation, intt.resi_landmark, intt.ofc_landmark, intt.place_of_birth, intt.industry_id AS industry_id, intt.cur_comp_wrk_exp AS cwe_f, intt.totl_wrk_exp AS twe_f FROM tbl_mint_customer_info as cust left join tbl_mint_cust_info_intt as intt on cust.id = intt.cust_id where cust.id = ".$cust_id." order by cust.id desc");
        if(mysqli_num_rows($cust_data) > 0){
            $fetch_sugar_cust = mysqli_fetch_assoc($cust_data);
            $email = $fetch_sugar_cust['email'];
            $bank_account_with = $fetch_sugar_cust['bank_account_with'];
            $account_no = $fetch_sugar_cust['account_no'];
            $pan_card = $fetch_sugar_cust['pan_card'];
            $caste = $fetch_sugar_cust['caste'];
            $no_of_depend = $fetch_sugar_cust['no_of_depend'];
            $religion_id = $fetch_sugar_cust['religion_id'];
            $ref_1_name = $fetch_sugar_cust['ref_1_name'];
            $ref_1_mobile = $fetch_sugar_cust['ref_1_mobile'];
            $type_company = $fetch_sugar_cust['type_company'];
            $qualification = $fetch_sugar_cust['qualification'];
            $account_no = $fetch_sugar_cust['account_no'];
            $offce_address = $fetch_sugar_cust['offce_address'];
            $ofc_contact = $fetch_sugar_cust['ofc_contact'];
            $relation_bank = $fetch_sugar_cust['relation_bank'];
            $profession_id = $fetch_sugar_cust['profession_id'];
            $designation_id= $fetch_sugar_cust['designation_id'];
            $res_address = $fetch_sugar_cust['res_address'];
            $permanent_res_address = $fetch_sugar_cust['permanent_res_address'];
            $maritalstatus = $fetch_sugar_cust['maritalstatus'];
            $ofc_email = $fetch_sugar_cust['ofc_email'];
            $ofc_pincode = $fetch_sugar_cust['ofc_pincode'];

            $city_id    = $fetch_sugar_cust['city_id'];
            $pin_code   = $fetch_sugar_cust['pincode'];
            $dob_val    = $fetch_sugar_cust['dob'];
            $email      = $fetch_sugar_cust['email'];

            $mother_f_name = $fetch_sugar_cust['mother_first_name'];
            $mother_l_name = $fetch_sugar_cust['mother_last_name'];
            $office_extension = $fetch_sugar_cust['ofc_extn_no'];
            $fs_first_name = $fetch_sugar_cust['fs_first_name'];
            $fs_last_name = $fetch_sugar_cust['fs_last_name'];
            $ref_2_name = $fetch_sugar_cust['ref_2_name'];
            $ref_2_mobile = $fetch_sugar_cust['ref_2_mobile'];

            $fst_ref_address = $fetch_sugar_cust['fst_ref_address'];
            $sec_ref_address = $fetch_sugar_cust['sec_ref_address'];
            $fst_ref_relation = $fetch_sugar_cust['fst_ref_relation'];
            $sec_ref_relation = $fetch_sugar_cust['sec_ref_relation'];
            $resi_landmark = $fetch_sugar_cust['resi_landmark'];
            $ofc_landmark = $fetch_sugar_cust['ofc_landmark'];
            $place_of_birth = $fetch_sugar_cust['place_of_birth'];
            $industry_id = $fetch_sugar_cust['industry_id'];

            $ccwe_f = $fetch_sugar_cust['ccwe_f'];
            $twe_f = $fetch_sugar_cust['twe_f'];

            $bajaj_twl_city = mysqli_query($Conn1, "SELECT bajaj_twl_city_id FROM tbl_mint_city_pat_map WHERE mlc_city_id = $city_id");
            $btwl_city_id = mysqli_fetch_array($bajaj_twl_city)['bajaj_twl_city_id'];
        }
    }
?>
<div class="row div-width">
<?php if(in_array(24,$pat_ids)){?>
    <div class="form-group col-xl-3 col-lg-4 col-md-6">
        <span class="fa-icon fa-file-code-o"></span>
        <select name="kotak_pl_los" id="kotak_pl_los" class="form-control valid" onchange="getExtrafields();" required>
            <option value=''>Type of API</option>
            <option value="1" <?php if($kotak_pl_api_type == 1){?> selected <?php } ?>>Paperless</option>
            <option value="2" <?php if($kotak_pl_api_type == 2){?> selected <?php } ?>>Normal</option>
        </select>
        <label for="kotak_pl_los" class="label-tag">Type of Kotak API</label>
    </div>
    <?php } if(in_array(27,$pat_ids)){?>
    <div class="form-group col-xl-3 col-lg-4 col-md-6">
        <span class="fa-icon fa-file-code-o"></span>
        <select name="hdfc_pl_los" id="hdfc_pl_los" class="form-control valid" onchange="getExtrafields();" required>
            <option value=''>Type of API</option>
<?php //if(in_array($user,array(16,173,121))){ ?>            
<!-- <option value="1" <?php //if($hdfc_api_type == 1){?> selected <?php //} ?>>Paperless</option> -->
<?php //} ?>
            <?php //if(in_array($user,array(16,173,121))){ ?>
                <option value="2" <?php if($hdfc_api_type == 2){?> selected <?php } ?>>Normal</option>
            <?php //} ?>
            
        </select>
        <label for="hdfc_pl_los" class="label-tag">Type of HDFC API</label>
    </div>
    <?php } if(in_array(96,$pat_ids)){ ?>
        <div class="form-group col-xl-3 col-lg-4 col-md-6">
        <span class="fa-icon fa-file-code-o"></span>
        <select name="bajaj_twl_api_type" id="bajaj_twl_api_type" class="form-control valid" onchange="getExtrafields();" required>
            <option value=''>Type of API</option>
            <option value="1" <?php if($bajaj_twl_api_type == 1){?> selected <?php } ?>>Soft Lead</option>
            <option value="2" <?php if($bajaj_twl_api_type == 2){?> selected <?php } ?>>Hard Lead</option>
        </select>
        <label for="bajaj_twl_api_type" class="label-tag">Type of Bajaj TWL API</label>
    </div>
   <?php } if(in_array(62,$pat_ids)){?>
     <div class="form-group col-xl-3 col-lg-4 col-md-6">
        <span class="fa-icon fa-file-code-o"></span>
        <select name="yes_bank_api" id="yes_bank_api" class="form-control valid" required>
            <option value=''>Type of API</option>
            <option value="1">Digital API</option>
            <?php if(in_array($user,array(173,270,16))){ ?> 
                <option value="2">Non Digital API</option> 
            <?php } ?>
        </select>
        <label for="yes_bank_api" class="label-tag">Type of Yes Bank API</label>
    </div>
	<?php } ?>
	<?php if(in_array(77,$pat_ids) || (in_array(27,$pat_ids) && $hdfc_api_type == 1) || in_array(38,$pat_ids) || in_array(122,$pat_ids) || in_array(87,$pat_ids) ||  in_array(24,$pat_ids) || /*in_array(79,$pat_ids) ||*/ ($loan_type == 56 && in_array(31,$pat_ids)) || (in_array(96, $pat_ids)  && $bajaj_twl_api_type == 2) || (in_array(112, $pat_ids)) || (in_array(24, $pat_ids) && $kotak_pl_api_type == 1) || (in_array(75, $pat_ids) && $user == 173) || (in_array(121, $pat_ids)) ){?>
	<div class="form-group col-xl-3 col-lg-4 col-md-6">
                                    <span class="fa-icon fa-pan"></span>
                                    <input type="text" class="form-control valid" id="pan_card" name="pan_card" maxlength="10" placeholder="Pan Card" value="<?php echo strtoupper($pan_card); ?>" required >
                                    <label for="pan_card" class="label-tag">Pan Card No.<span class='blue f_12'>(Take cibil consent)</span></label>
                                </div>
	<?php } if(in_array(77,$pat_ids) || (in_array(27,$pat_ids) && $hdfc_api_type == 1) || in_array(122,$pat_ids) || in_array(38,$pat_ids) || in_array(87,$pat_ids) || ($loan_type == 56 && in_array(31,$pat_ids)) || (in_array(112, $pat_ids))  || (in_array(131, $pat_ids)) || (in_array(24, $pat_ids) && $kotak_pl_api_type == 1) || (in_array(75, $pat_ids) && $user == 173) ){?>
<div class="form-group col-xl-3 col-lg-4 col-md-6">
    <label for="maritalstatus" class="radio-tag label-tag">Marital Status</label>
    <div class="radio-button error_contain">
    <input type="radio" name="maritalstatus" id="maritalstatusoth1"  value="Y" <?php if($maritalstatus == "Y"){ ?>checked <?php } ?> required>
    <label for="maritalstatusoth1">Married</label>
    <input type="radio" name="maritalstatus" id="maritalstatusoth2" value="N" <?php if($maritalstatus == "N"){ ?>checked <?php } ?> required>
    <label for="maritalstatusoth2">UnMarried</label> 
    </div>
    </div>
<?php } if((in_array(31,$pat_ids) || (in_array(112, $pat_ids)) || (in_array(131, $pat_ids)))) {?>
    <div class="form-group col-xl-3 col-lg-4 col-md-6">
        <span class="fa-icon fa-graduation-cap"></span>
        <?php echo get_dropdown('qualification_credit','qualification',$qualification,'class="form-control valid" required'); ?>
        <label for="qualification" class="label-tag">Qualification</label>
    </div>

<?php } 
//if(in_array(131, $pat_ids) && in_array($mwide_residence_id,array(1,6))) {?>
        <!-- <div class="form-group col-xl-3 col-lg-4 col-md-6 monthly_rent_amount">
            <span class="fa-icon fa-amnt"></span>
            <input type="text" class="text form-control" name="monthly_rent_amount" id="monthly_rent_amount" value="<?php //if($monthly_rent_amount!=0){ echo $monthly_rent_amount ; }?>" required />
            <label for="monthly_rent_amount" class="label-tag">Monthly Rent Amount</label>
        </div> -->
<?php //} 
if(in_array(131, $pat_ids) && $mwide_loanp_id == 8) {?>
    <div class="form-group col-xl-3 col-lg-4 col-md-6 purpose_name ">
        <span class="fa-icon fa-amnt"></span>
        <input type="text" class="text form-control" name="purpose_name" id="purpose_name" value="<?php echo $purpose_name ;?>" required />
        <label for="purpose_name" class="label-tag">Purpose Name</label>
    </div>
<?php } if(in_array(131, $pat_ids) && $bank_account_with == 124) {?>
    <div class="form-group col-xl-3 col-lg-4 col-md-6 main_acc">
        <span class="fa-icon fa-bank"></span>
        <?php echo get_dropdown('banks_type_other','main_acc',$bank_account_with,'class="form-control valid" required'); ?>
        <label for="main_acc" class="label-tag">Main Account</label>
    </div>
<?php } if(in_array(131, $pat_ids)) {?>
    <div class="form-group col-xl-3 col-lg-4 col-md-6 ">
        <span class="fa-icon fa-map-marker"></span>
        <input type="text" class="text form-control numonly valid" minlength="6" maxlength="6" name="ofc_pincode" id="ofc_pincode" value="<?php echo $ofc_pincode ;?>" required />
        <label for="ofc_pincode" class="label-tag">Office Pincode</label>
    </div>
<?php } if(in_array(87,$pat_ids) || in_array(38,$pat_ids)){?>
    <div class="form-group col-xl-3 col-lg-4 col-md-6">
    <span class="fa-icon fa-bank"></span>
    <input type="text" id="account_no" name="account_no" value="<?php echo $account_no ;?>" placeholder="Account Number" class="form-control alpha-num valid" maxlength="15" required>
                                <label for="account_no" class="label-tag">Account Number</label>
                            </div>
 <?php } if(in_array(47,$pat_ids)){?>
    <div class="form-group col-xl-3 col-lg-4 col-md-6">
        <span class="fa-icon fa-calendar"></span>
        <input type="text" class="text form-control numonly valid" name="rcas_id" maxlength="20" id="rcas_id" value=""/>
        <label for="rcas_id" class="label-tag">RCAS ID</label>
    </div>
    <div class="form-group col-xl-3 col-lg-4 col-md-6">
        <span class="fa-icon fa-briefcase"></span>
        <?php echo get_dropdown('profession','profession_id',$profession_id,'class="form-control valid" required'); ?>
        <label for="profession" class="label-tag">Profession</label>
    </div>
    
<?php } 
if(in_array(121, $pat_ids)){?>
    <div class="checkbox checkbox-info new-check col-sm-12">
    <input type="checkbox" id="delta_cr_consent" name="delta_cr_consent" class="" checked value="1">
    <label for="delta_cr_consent" class="longform-label checkbox ">
    <span>I allow MyLoanCare.in to access my credit information with Credit Information Companies (Experian) in order to understand my creditworthiness and curate personalized values for me.</span>
    </label>
    </div>
    
    <?php }

if((in_array(96, $pat_ids) && $bajaj_twl_api_type == 2) || (in_array(24, $pat_ids) && $kotak_pl_api_type == 1) /* || (in_array(62, $pat_ids) && $user == 173) */ ) {
    if(in_array(96, $pat_ids)  && $bajaj_twl_api_type == 2) {
    ?>
    
    <div class="form-group col-xl-3 col-lg-4 col-md-6">
        <span class="fa-icon fa-calendar"></span>
        <input type="tel" class="text form-control numonly valid" name="dob" maxlength="10" id="dob" value="<?php echo $dob_val != '0000-00-00'? $dob_val : '' ;?>" required/>
        <label for="dob" class="label-tag">Date of Birth</label>
    </div>
    
    <div class="form-group col-xl-3 col-lg-4 col-md-6">
        <span class="fa-icon fa-envelope"></span>
        <input type="email" class="form-control valid" name="email_id" maxlength="50" placeholder="Email ID" id="email_id" value="<?php echo $email; ?>" required/>
        <label for="email_id" class="label-tag">Email Id</label>
    </div>
    
    <?php
        $twm_query = "SELECT DISTINCT(twm.id), twm.value FROM two_wheeler_partner_dealer_details AS twpdd LEFT JOIN two_wheeler_make AS twm ON twm.id = twpdd.mN WHERE (twpdd.f1cId = '".$btwl_city_id."' OR twpdd.pinC = '".$pin_code."') ";
        $twm_execute = mysqli_query($Conn1, $twm_query);
        if(mysqli_num_rows($twm_execute) > 0) {
            ?>
            <div class="form-group col-xl-3 col-lg-4 col-md-6">
                <span class="fa-icon fa-bank"></span>
                <select id="twl_make" name="twl_make" class="form-control valid" required>
                    <option value="">-- Select Make --</option>
                    <?php
                    while($twm_result = mysqli_fetch_array($twm_execute)) {
                    ?>
                        <option value="<?php echo $twm_result['id']; ?>" <?php echo ($twm_result['id'] == $twl_make_id) ? "selected" : "" ?> ><?php echo $twm_result['value']; ?></option>
                    <?php
                    }
                    ?>
                </select>
                <label for="twl_make" class="label-tag">Select Make</label>
            </div>
    
            <?php
            $twm_query = mysqli_query($Conn1, "SELECT DISTINCT(twm.id), twm.value FROM two_wheeler_partner_dealer_details AS twpdd LEFT JOIN two_wheeler_model AS twm ON twm.id = twpdd.moN WHERE twpdd.mN = '".$twl_make_id."' AND (twpdd.f1cId = '".$btwl_city_id."' OR twpdd.pinC = '".$pin_code."') ");
            ?>
            <div class="form-group col-xl-3 col-lg-4 col-md-6">
                <span class="fa-icon fa-bank"></span>
                <select name="twl_model" id="twl_model" class="form-control valid" <?php echo ($twl_make_id == "") ? "disabled" : "required"; ?> >
                    <option value="">-- Select Model --</option>
                    <?php while($twm_result = mysqli_fetch_array($twm_query)) { ?>
                        <option value="<?php $twm_result['id']; ?>" <?php echo ($twm_result['id'] == $twl_model_id) ? "selected": ""; ?> ><?php $twm_result['value']; ?></option>
                    <?php } ?>
                </select>
                <label for="twl_model" id="twl_model_label" class="label-tag <?php echo ($twl_make_id == "") ? "optional-tag" : ""; ?>">Select Model</label>
            </div>
        <?php
    }
    ?>
    <?php
    }
    ?>
    <div class="form-group col-xl-3 col-lg-4 col-md-6">
        <span class="fa-icon fa-calendar"></span>
        <select name="years_at_city" id="years_at_city" class="form-control valid" required>
            <option value="">-- Select Year at City --</option>
            <?php
            $current_year = date('Y');
            $last_year = date("Y",strtotime("-50 year"));
            for($i = $last_year; $i <= $current_year; $i++) {
                if($year_at_city == $i){
                    $selected_value = 'selected';
                } else {
                    $selected_value = '';
                }
                echo "<option value='".$i."' ".$selected_value.">".$i."</option>";
            }
            ?>
        </select>
        <label for="years_at_city" class="label-tag">Years at current city</label>
    </div>
    <?php
    if(in_array(96, $pat_ids) && $bajaj_twl_api_type == 2) {
    ?>
    <?php
    $id_proof_query = "SELECT tap.proof_id, tap.proof_name FROM address_proof_partner_mapping AS adpm INNER JOIN tbl_address_proof AS tap ON tap.proof_id = adpm.proof_id WHERE adpm.partner_id = 96 AND adpm.is_active = 1 ";
    $id_proof_exe   = mysqli_query($Conn1, $id_proof_query);
    ?>
    <div class="form-group col-xl-3 col-lg-4 col-md-6">
        <span class="fa-icon fa-pan"></span>
        <select name="twl_id_proof_type" id="twl_id_proof_type" class="form-control valid" required>
            <option value="">-- Select ID Proof --</option>
            <?php
            while($id_proof_result = mysqli_fetch_array($id_proof_exe)) {
            ?>
                <option value="<?php echo $id_proof_result['proof_id']; ?>" <?php echo ($id_proof_type_twl == $id_proof_result['proof_id']) ? "selected" : ""; ?> ><?php echo $id_proof_result['proof_name']; ?></option>
            <?php
            }
            ?>
        </select>
        <label for="twl_id_proof_type" class="label-tag">ID Proof Type</label>
    </div>
    <?php
    }
}
?>
<?php if((in_array(24, $pat_ids) && $kotak_pl_api_type == 1) /* || (in_array(62, $pat_ids) && $user == 173) */ ) { ?>
    <div class="form-group col-xl-3 col-lg-4 col-md-6">
        <span class="fa-icon fa-user"></span>
        <input type="text" id="fs_f_name" name="fs_f_name" value="<?php echo $fs_first_name; ?>" placeholder="Father/Spouse First Name" class="form-control alpha-wo-space valid" maxlength="20" required>
        <label for="fs_f_name" class="label-tag">Father/Spouse First Name</label>
    </div>
    <div class="form-group col-xl-3 col-lg-4 col-md-6">
        <span class="fa-icon fa-user"></span>
        <input type="text" id="fs_l_name" name="fs_l_name" value="<?php echo $fs_last_name; ?>" placeholder="Father/Spouse Last Name" class="form-control alpha-wo-space valid" maxlength="20" required>
        <label for="fs_l_name" class="label-tag">Father/Spouse Last Name</label>
    </div>

    <div class="form-group col-xl-3 col-lg-4 col-md-6">
        <span class="fa-icon fa-user"></span>
        <input type="text" id="mother_f_name" name="mother_f_name" value="<?php echo $mother_f_name; ?>" placeholder="Mother First Name" class="form-control alpha-wo-space valid" maxlength="20" required>
        <label for="mother_f_name" class="label-tag">Mother First Name</label>
    </div>
    <div class="form-group col-xl-3 col-lg-4 col-md-6">
        <span class="fa-icon fa-user"></span>
        <input type="text" id="mother_l_name" name="mother_l_name" value="<?php echo $mother_l_name; ?>" placeholder="Mother Last Name" class="form-control alpha-wo-space valid" maxlength="20" required>
        <label for="mother_l_name" class="label-tag">Mother Last Name</label>
    </div>
<?php } ?>
<?php

//if(in_array(62, $pat_ids) && $user == 173) {
    ?>
    <!-- <div class="form-group col-xl-3 col-lg-4 col-md-6">
        <span class="fa-icon fa-home"></span>
        <input type="text" id="place_of_birth" name="place_of_birth" value="<?php echo $place_of_birth; ?>" placeholder="Place of Birth" class="form-control alpha-wo-space valid" maxlength="20" required>
        <label for="place_of_birth" class="label-tag">Place of Birth</label>
    </div> -->
<?php
//}

if(in_array(28,$pat_ids)){?>
<div class="form-group col-xl-3 col-lg-4 col-md-6">
    <span class="fa-icon fa-calendar"></span>
    <input type="tel" class="text form-control numonly valid" name="apptmnt_date" maxlength="10" id="apptmnt_date" value="<?php echo $appointment_date != '0000-00-00'? $appointment_date: '' ;?>" required/>
    <label for="apptmnt_date" class="label-tag">Appointment Date</label>
 </div>
<div class="form-group col-xl-3 col-lg-4 col-md-6">
    <span class="fa-icon fa-clock-o"></span>
    <input type="tel" class="time text form-control valid" name="apptmnt_time" maxlength="10" id="apptmnt_time" value="<?php echo $appointment_time != '00:00:00'?$appointment_time:'' ;?>" required/>
    <label for="apptmnt_date" class="label-tag">Appointment Time</label>
</div>
<?php }if((in_array(27,$pat_ids) && $hdfc_api_type == 1)){?>
    <div class="form-group col-xl-3 col-lg-4 col-md-6">
    <label for="relation_with_hdfc_bank" class="radio-tag label-tag">Relation With HDFC Bank</label>
    <div class="radio-button error_contain">
    <input type="radio" name="relation_with_hdfc_bank" id="relation_with_hdfc_bank1"  value="1" <?php if($bank_account_with == 42){ ?>checked <?php } ?> required>
    <label for="relation_with_hdfc_bank1">Yes</label>
    <input type="radio" name="relation_with_hdfc_bank" id="relation_with_hdfc_bank2" value="0" <?php if($bank_account_with != 42){ ?>checked <?php } ?> required>
    <label for="relation_with_hdfc_bank2">NO</label> 
    </div>
    </div>
    <div class="form-group col-xl-3 col-lg-4 col-md-6 account_no <?php if($bank_account_with != 42){ ?> hidden <?php } ?>">
    <span class="fa-icon fa-bank"></span>
    <input type="text" id="account_no" name="account_no" <?php if($bank_account_with != 42){ ?> value='' <?php }else{ ?> value="<?php echo $account_no ;?>" <?php } ?> placeholder="HDFC Bank Account No." class="form-control valid alpha-num" maxlength="16">
    <label for="account_no" class="label-tag">HDFC Bank Account No.</label>
    </div>
    <div class="form-group col-xl-3 col-lg-4 col-md-6 bank_branch_name <?php if($bank_account_with != 42){ ?> hidden <?php } ?>">
    <span class="fa-icon fa-bank"></span>
    <input type="text" id="bank_branch_name" name="bank_branch_name" placeholder="Account Branch Name" class="form-control valid alpha-num" maxlength="50">
    <label for="bank_branch_name" class="label-tag">Account Branch Name</label>
    </div>
    <div class="form-group col-xl-3 col-lg-4 col-md-6">
        <span class="fa-icon fa-users"></span>
        <?php echo get_dropdown('caste_type','caste_f',$caste,'class="form-control valid" required'); ?>
        <label for="caste_f" class="label-tag">Caste</label>
    </div>
    <?php } if((in_array(27,$pat_ids) && $hdfc_api_type == 1) || (in_array(24, $pat_ids) && $kotak_pl_api_type == 1) /* || (in_array(62, $pat_ids) && $user == 173) */ ) {?>
    <div class="form-group col-xl-3 col-lg-4 col-md-6">
        <span class="fa-icon fa-users"></span>
        <?php echo get_dropdown('religion','religion_id_f',$religion_id,'class="form-control valid" required'); ?>
        <label for="religion_id_f" class="label-tag">Religion</label>
    </div>
    <?php } if((in_array(27,$pat_ids) && $hdfc_api_type == 1) || ($loan_type == 56 && in_array(31,$pat_ids))){?>
    <div class="form-group col-xl-3 col-lg-4 col-md-6">
    <span class="fa-icon fa-calendar"></span>
    <input type="text" id="current_residence_since" name="current_residence_since" value="<?php echo $current_residence_since ;?>" placeholder="Cur Res Since (yyyy-mm-dd)" class="form-control valid" maxlength="10" required>
    <label for="current_residence_since" class="label-tag">Current Residence Since</label>
    </div>
    <?php } /*if((in_array(27,$pat_ids) && $hdfc_api_type == 1) || in_array(24,$pat_ids) || ($loan_type == 56 && in_array(31,$pat_ids))){?>
    <div class="form-group col-xl-3 col-lg-4 col-md-6">
        <span class="fa-icon fa-user"></span>
        <?php echo get_dropdown('residential_type','res_type_f',$rented_id,'class="form-control valid" required'); ?>
        <label for="res_type_f" class="label-tag">Residential Type</label>
    </div>
  <?php }*/ 
  if((in_array(27,$pat_ids) && $hdfc_api_type == 1) || in_array(47,$pat_ids) || (in_array(112, $pat_ids)) || in_array(122,$pat_ids) || ($loan_type == 56 && in_array(31,$pat_ids)) || (in_array(24, $pat_ids) && $kotak_pl_api_type == 1) /* || (in_array(62, $pat_ids) && $user == 173)  */){?>
    <div class="form-group col-xl-3 col-lg-4 col-md-6">
    <span class="fa-icon fa-home"></span>
    <input type="text" id="address" name="address" value="<?php echo $res_address ;?>" placeholder="Residence address" class="form-control  valid" maxlength="200" required>
    <label for="address" class="label-tag">Residence Address</label>
    </div>
<?php }

if(in_array(62, $pat_ids) && $user == 173) {
    ?>
    <!-- <div class="form-group col-xl-3 col-lg-4 col-md-6">
        <span class="fa-icon fa-home"></span>
        <input type="text" id="resi_landmark" name="resi_landmark" value="<?php echo $resi_landmark; ?>" placeholder="Residence Landmark" class="form-control alpha-num valid" maxlength="20" required>
        <label for="resi_landmark" class="label-tag">Residence Landmark</label>
    </div> -->
<?php
}

if( in_array(47,$pat_ids)){?>
    <div class="form-group col-xl-3 col-lg-4 col-md-6">
    <span class="fa-icon fa-home"></span>
    <input type="text" id="perm_address" name="perm_address" value="<?php echo $permanent_res_address ;?>" placeholder="Permanent address" class="form-control  valid" maxlength="200" required>
    <label for="address" class="label-tag">Permanent Address</label>
    </div>
<?php } 
//if(/*in_array(79,$pat_ids) || */in_array(24,$pat_ids)){?>
    <!-- <div class="form-group col-xl-3 col-lg-4 col-md-6">
        <span class="fa-icon fa-building"></span>
        <?php //echo get_dropdown('type_of_company','type_comp',$type_company,'class="form-control valid" required'); ?>
        <label for="type_comp" class="label-tag">Type of Company</label>
    </div> -->
<?php //}
if(in_array(77,$pat_ids) || in_array(47,$pat_ids) || (in_array(112, $pat_ids))  || (in_array(27,$pat_ids) && $hdfc_api_type == 1) || (in_array(24, $pat_ids) && $kotak_pl_api_type == 1) || (in_array(75, $pat_ids) && $user == 173) ){?>
                                <div class="form-group col-xl-3 col-lg-4 col-md-6">
                                    <span class="fa-icon fa-envelope"></span>
                                    <input type="email" class="form-control valid" name="ofc_email" maxlength="50" placeholder="Office Email" id="ofc_email" value="<?php echo lower_case($ofc_email);?>" required/>
                                    <label for="ofc_email" class="label-tag">Office Email Id</label>
                                </div>
<?php }if(in_array(38,$pat_ids) || in_array(87,$pat_ids)  || in_array(24,$pat_ids)  || (in_array(27,$pat_ids) && $hdfc_api_type == 1) || (in_array(24, $pat_ids) && $kotak_pl_api_type == 1) ){?>
    <div class="form-group col-xl-3 col-lg-4 col-md-6">
    <span class="fa-icon fa-mobile"></span>
    <input type="tel" class="form-control valid" name="ofc_contact" maxlength="10" id="ofc_contact"  placeholder="Office Contact No." value="<?php echo $ofc_contact ;?>" required/>
    <label for="ofc_contact" class="label-tag">Office Contact No.</label>
    </div>
<?php } if((in_array(27,$pat_ids) && $hdfc_api_type == 1) || (in_array(112, $pat_ids)) || in_array(122,$pat_ids) || in_array(38,$pat_ids) || in_array(87,$pat_ids) || in_array(47,$pat_ids) || ($loan_type == 56 && in_array(31,$pat_ids)) || (in_array(24, $pat_ids) && $kotak_pl_api_type == 1)/*  || (in_array(62, $pat_ids) && $user == 173) */ ){?>
    <div class="form-group col-xl-3 col-lg-4 col-md-6">
    <span class="fa-icon fa-building"></span>
    <input type="text" id="offce_address" name="offce_address" value="<?php echo $offce_address ;?>" placeholder="Office address" class="form-control valid" maxlength="200" required>
    <label for="offce_address" class="label-tag">Office Address</label>
    </div>
<?php } 

if(in_array(131, $pat_ids)) {
    ?>
    <!-- <div class="form-group col-xl-3 col-lg-4 col-md-6">
        <span class="fa-icon fa-home"></span>
        <input type="text" id="ofc_landmark" name="ofc_landmark" value="<?php echo $ofc_landmark; ?>" placeholder="Office Landmark" class="form-control alpha-num valid" maxlength="20" required>
        <label for="ofc_landmark" class="label-tag">Office Landmark</label>
    </div>-->

    <div class="form-group col-xl-3 col-lg-4 col-md-6">
        <span class="fa-icon fa-building"></span>
        <?php echo get_dropdown('industry_bl', 'industry_id', $industry_id,'class="form-control valid" required'); ?>
        <label for="industry_id" class="label-tag">Industry Type</label>
    </div> 
    
<?php
}


if((in_array(27,$pat_ids) && $hdfc_api_type == 1)){?>
    <div class="form-group col-xl-3 col-lg-4 col-md-6">
        <span class="fa-icon fa-graduation-cap"></span>
        <?php echo get_dropdown('course_of_study','course_id_f',$course_study,'class="form-control valid" required'); ?>
        <label for="course_id_f" class="label-tag">Educational Course</label>
    </div>
    <?php } if((in_array(27,$pat_ids) && $hdfc_api_type == 1) /* || (in_array(62, $pat_ids) && $user == 173) */ ) {?>
<div class="form-group col-xl-3 col-lg-4 col-md-6">
    <span class="fa-icon fa-users"></span>
    <input type="tel" id="no_of_depend_f" name="no_of_depend_f" value="<?php echo $no_of_depend ;?>" placeholder="No. of Dependents" class="form-control numonly valid" maxlength="2" required>
    <label for="no_of_depend_f" class="label-tag">No. of Dependents</label>
    </div>
    <?php } if((in_array(27,$pat_ids) && $hdfc_api_type == 1) || (in_array(24, $pat_ids) && $kotak_pl_api_type == 1)/*  || (in_array(62, $pat_ids) && $user == 173) */ ){?>
<div class="form-group col-xl-3 col-lg-4 col-md-6">
    <span class="fa-icon fa-user"></span>
    <input type="text" id="ref_1_name_f" name="ref_1_name_f" value="<?php echo $ref_1_name ;?>" placeholder="Ref 1 Name" class="form-control alpha-num valid" maxlength="20" required>
    <label for="ref_1_name_f" class="label-tag">Ref 1 Name</label>
    </div>
    <?php } if((in_array(27,$pat_ids) && $hdfc_api_type == 1) || (in_array(24, $pat_ids) && $kotak_pl_api_type == 1) /* || (in_array(62, $pat_ids) && $user == 173) */ ){?>
<div class="form-group col-xl-3 col-lg-4 col-md-6">
    <span class="fa-icon fa-mobile"></span>
    <input type="text" id="ref_1_mobile_f" name="ref_1_mobile_f" value="<?php echo $ref_1_mobile ;?>" placeholder="Ref 1 Mobile" class="form-control numonly valid" maxlength="10" required>
    <label for="ref_1_mobile_f" class="label-tag">Ref 1 Mobile</label>
    </div>
     <?php }

    if(in_array(62, $pat_ids) && $user == 173) {
    ?>
    <!-- <div class="form-group col-xl-3 col-lg-4 col-md-6">
        <span class="fa-icon fa-home"></span>
        <input type="text" id="ref_1_address" name="ref_1_address" value="<?php echo $fst_ref_address; ?>" placeholder="Ref 1 Address" class="form-control valid" maxlength="200" required>
        <label for="ref_1_address" class="label-tag">Ref 1 Address</label>
    </div>

    <div class="form-group col-xl-3 col-lg-4 col-md-6">
        <span class="fa-icon fa-users"></span>
        <select name='ref_1_relation' id='ref_1_relation' class="form-control valid" required>
            <option value=''>Select Relation</option>
            <?php
            $fetch_relations = mysqli_query($Conn1, "SELECT id, name FROM tbl_cb_relations");
            while($result_relations = mysqli_fetch_array($fetch_relations)) {
                $selected_rel = ($fst_ref_relation == $result_relations['id']) ? "selected" : "";
            ?>
                <option value='<?php echo $result_relations['id']; ?>' <?php echo $selected_rel; ?> ><?php echo $result_relations['name']; ?></option>
            <?php
            }
            ?>
        </select>
        <label for="ref_1_relation" class="label-tag">Ref 1 Relation</label>
    </div> -->
    <?php
    }
     
    if((in_array(24, $pat_ids) && $kotak_pl_api_type == 1)/*  || (in_array(62, $pat_ids) && $user == 173) */) {
    ?>
        <div class="form-group col-xl-3 col-lg-4 col-md-6">
            <span class="fa-icon fa-user"></span>
            <input type="text" id="ref_2_name_f" name="ref_2_name_f" value="<?php echo $ref_2_name; ?>" placeholder="Ref 2 Name" class="form-control alpha-w-space valid" maxlength="20" required>
            <label for="ref_2_name_f" class="label-tag">Ref 2 Name</label>
        </div>
        <div class="form-group col-xl-3 col-lg-4 col-md-6">
            <span class="fa-icon fa-mobile"></span>
            <input type="text" id="ref_2_mobile_f" name="ref_2_mobile_f" value="<?php echo $ref_2_mobile; ?>" placeholder="Ref 2 Mobile" class="form-control numonly valid" maxlength="10" required>
            <label for="ref_2_mobile_f" class="label-tag">Ref 2 Mobile</label>
        </div>
    <?php
    }

    if(in_array(62, $pat_ids) && $user == 173) {
        ?>
        <!-- <div class="form-group col-xl-3 col-lg-4 col-md-6">
            <span class="fa-icon fa-home"></span>
            <input type="text" id="ref_2_address" name="ref_2_address" value="<?php echo $sec_ref_address; ?>" placeholder="Ref 2 Address" class="form-control valid" maxlength="200" required>
            <label for="ref_2_address" class="label-tag">Ref 2 Address</label>
        </div>

        <div class="form-group col-xl-3 col-lg-4 col-md-6">
            <span class="fa-icon fa-users"></span>
            <select name='ref_2_relation' id='ref_2_relation' class="form-control valid" required>
                <option value=''>Select Relation</option>
                <?php
                $fetch_relations = mysqli_query($Conn1, "SELECT id, name FROM tbl_cb_relations");
                while($result_relations = mysqli_fetch_array($fetch_relations)) {
                    $selected_rel2 = ($sec_ref_relation == $result_relations['id']) ? "selected" : "";
                ?>
                    <option value='<?php echo $result_relations['id']; ?>' <?php echo $selected_rel2; ?> ><?php echo $result_relations['name']; ?></option>
                <?php
                }
                ?>
            </select>
            <label for="ref_2_relation" class="label-tag">Ref 2 Relation</label>
        </div> -->
    <?php
    }

    if(in_array(75, $pat_ids) && $user == 173) {
    ?>
        <div class="form-group col-xl-3 col-lg-4 col-md-6">
            <span class="fa-icon fa-clock-o"></span>
            <input type="tel" id="ccwe_f" name="ccwe_f" value="<?php echo $ccwe_f; ?>" placeholder="Cur. Comp. Work Exp." class="form-control numonly valid" maxlength="3" required>
            <label for="ccwe_f" class="label-tag">Cur. Comp. Work Exp.</label>
        </div>
        <div class="form-group col-xl-3 col-lg-4 col-md-6">
            <span class="fa-icon fa-clock-o"></span>
            <input type="tel" id="twe_f" name="twe_f" value="<?php echo $twe_f; ?>" placeholder="Total Work Exp." class="form-control numonly valid" maxlength="3" required>
            <label for="twe_f" class="label-tag">Total Work Exp.</label>
        </div>
        <div class="form-group col-xl-3 col-lg-4 col-md-6">
            <span class="fa-icon fa-user"></span>
            <input type="text" id="property_name_f" name="property_name_f" value="<?php echo $property_name_f; ?>" placeholder="Property Name" class="form-control alpha-w-space valid" maxlength="20" required>
            <label for="property_name_f" class="label-tag">Property Name</label>
        </div>
        <div class="form-group col-xl-3 col-lg-4 col-md-6">
            <span class="fa-icon fa-clock-o"></span>
            <input type="tel" id="property_cost_f" name="property_cost_f" value="<?php echo $property_cost_f; ?>" placeholder="Property Cost" class="text form-control valid loan_net_incm" maxlength="12" required>
            <div class='word_below orange'><b class='property_cost_f_value_formt money_format'></b></div>
            <label for="property_cost_f" class="label-tag">Property Cost</label>
        </div>
    <?php
    }
     
     if((in_array(27,$pat_ids) && $hdfc_api_type == 1)){?>
<div class="form-group col-xl-3 col-lg-4 col-md-6">
    <span class="fa-icon">%</span>
    <input type="tel" id="processing_fees_f" name="processing_fees_f" value="<?php echo $processing_fees ;?>" placeholder="Processing Fees" class="form-control numonly valid" maxlength="10" required>
    <label for="processing_fees_f" class="label-tag">Processing Fees</label>
    </div>
    <?php } if((in_array(27,$pat_ids) && $hdfc_api_type == 1) /* || (in_array(62, $pat_ids) && $user == 173) */){?>
<div class="form-group col-xl-3 col-lg-4 col-md-6">
    <span class="fa-icon fa-clock-o"></span>
    <input type="tel" id="pref_tenure_f" name="pref_tenure_f" value="<?php echo $pref_tenure_f ;?>" placeholder="Pref Tenure" class="form-control numonly valid" maxlength="10" required>
    <label for="pref_tenure_f" class="label-tag">Pref Tenure (In months)</label>
    </div>
<?php }if(in_array(112,$pat_ids) || in_array(131,$pat_ids)  || (in_array(24, $pat_ids) && $kotak_pl_api_type == 1)) { ?>
    <div class="form-group col-xl-3 col-lg-4 col-md-6">
                                    <span class="fa-icon fa-user-plus"></span>
                                    <?php echo get_dropdown('designation','designation_id',$designation_id,'class="form-control valid" required'); ?>
                                    <label for="designation_id" class="label-tag">Designation</label>
                                </div>
<?php } if(in_array(77,$pat_ids)){?>
    <div class="form-group col-xl-3 col-lg-4 col-md-6">
    <label for="maritalstatus" class="radio-tag label-tag">Have you applied in last 3 months in SBI</label>
    <div class="radio-button error_contain">
    <input type="radio" name="sbi_applied" id="sbi_applied1"  value="1" <?php if($sbi_applied == "1"){ ?>checked <?php } ?> required>
    <label for="sbi_applied1">Yes</label>
    <input type="radio" name="sbi_applied" id="sbi_applied2" value="2" <?php if($sbi_applied == "2"){ ?>checked <?php } ?> required>
    <label for="sbi_applied2">No</label> 
    </div>
    </div>
    <div class="form-group col-xl-3 col-lg-4 col-md-6">
                                    <span class="fa-icon fa-user-plus"></span>
                                    <?php echo get_dropdown('designation','designation_id',$designation_id,'class="form-control valid" required'); ?>
                                    <label for="designation_id" class="label-tag">Designation</label>
                                </div>
                                <div class="form-group col-xl-3 col-lg-4 col-md-6">
                                    <span class="fa-icon fa-bank"></span>
                                    <?php echo get_dropdown('bank_name','relation_bank',$relation_bank,'class="form-control valid" required'); ?>
                                    <label for="relation_bank" class="label-tag">Relationship With Bank</label>
                                </div>
                                <div class="form-group col-xl-3 col-lg-4 col-md-6">
                                    <span class="fa-icon fa-credit-card"></span>
                                    <select name="sbi_card" id="sbi_card" class="form-control valid" required>
										<option value="">Select SBI Card</option>
										<?php $qry_crd = mysqli_query($Conn1,"select card_id,card_name from tbl_cc_card_name where bank_id = '40'");
										while($res_crd =mysqli_fetch_array($qry_crd)){ ?>
									    <option value="<?php echo $res_crd['card_id'];?>" <?php if (in_array($res_crd['card_id'], $bank_slect)) {echo "selected";} ?> ><?php echo $res_crd['card_name'];?></option>
									<?php } ?>
									</select>
                                    <label for="sbi_card" class="label-tag">Select SBI Card Name</label>
                                </div>
                            <?php }if(in_array(68,$pat_ids)){ ?>
                                <div class="form-group col-xl-3 col-lg-4 col-md-6">
                                    <span class="fa-icon fa-credit-card"></span>
                                    <select name="card_id" id="card_id" class="form-control valid" required>
                                        <option value="">Select ICICI Card</option>
                                        <?php $qry_crd_icici = mysqli_query($Conn1,"SELECT card_id,card_name,mlc_card_id FROM credit_cards_name where is_active =1");
                                        while($res_crd_icici =mysqli_fetch_array($qry_crd_icici)){ ?>
                                        <option value="<?php echo $res_crd_icici['card_id'];?>" <?php if (in_array($res_crd_icici['mlc_card_id'], $bank_slect)) {echo "selected";} ?> ><?php echo $res_crd_icici['card_name'];?></option>
                                    <?php } ?>
                                    </select>
                                    <label for="card_id" class="label-tag">Select ICICI Card</label>
                                </div>
                                <div class="form-group col-xl-3 col-lg-4 col-md-6">
                                    <span class="fa-icon fa-credit-card"></span>
                                    <select name='product_code' id='produc_code' class="form-control valid" required>
                                                                    <option value=''>Select Card Type</option>
                                                                    <?php $qry_card_cat = mysqli_query($Conn1,"select * from credit_cards_pricing_mapping");
                                                                    while($res_card_cat = mysqli_fetch_array($qry_card_cat)){?>
                                                                        <option value='<?php echo $res_card_cat['price_id'];?>'><?php echo $res_card_cat['pricing_code'];?></option>
                                                                    <?php } ?>
                                                                </select>
                                    <label for="product_code" class="label-tag">Select Card Type</label>
                                </div>
                            <?php } ?>
                            </div>
<?php } if(in_array(27,$pat_ids) && $hdfc_api_type == 1) { ?>
    <script>
        $( document ).ready(function() {
            $("input[name='relation_with_hdfc_bank']").on('change',function(){
                console.log(this.value);
                if(this.value == 1){
                    $("#account_no,#bank_branch_name,.account_no,.bank_branch_name").removeClass('hidden');
                    $("#account_no,#bank_branch_name,.account_no,.bank_branch_name").removeClass('hidden').attr('required',true);
                }else{
                    $("#account_no,#bank_branch_name,.account_no,.bank_branch_name").addClass('hidden').removeAttr('required').val('');
                }
            });
        });

    </script>
<?php }

if(in_array(28, $pat_ids)){ ?>
<script>
    function cse_formatTime(dt) {
        var hour = dt.getHours();
        var hournext = dt.getHours()+1;
        var chhour = ((dt.getMinutes() >= 30) ? hournext : hour);
        if(19 > chhour) {
        return ((dt.getMinutes() >= 30) ? hournext : hour)  + ':' + ((dt.getMinutes() < 30) ? '30' : '00').slice(-2) + (chhour >= 12 ? 'pm' : 'am')
        } else {
            return false;
        }
    }
    $(document).ready(function() {
        $( "#apptmnt_date" ).datepicker({
            minDate: '0',
            maxDate:'+20d',
            changeMonth: true, 
            changeYear: true,
            dateFormat: 'yy-mm-dd',
            onSelect: function(value, ui) {
                var today = new Date();
                var date = Date.parse(value);
                var month = today.getMonth()+1;
                var days = today.getDate();
                if (days < 10) {
                    days = "0" + days;
                }
                if (month < 10) {
                    month = "0" + month;
                }
                var tday = today.getFullYear()+"-"+month+"-"+days;
                var datetoday = Date.parse(tday);
                var user =  "<?php echo $_SESSION['user_id']; ?>"; 
                if(user == '1' || user == '3'){
                    var int=15;
                } else {
                    var int=30;
                }
                if(datetoday == date) {
                    $('#apptmnt_time').timepicker({disableTextInput: true}).val("");
                    var min = cse_formatTime(today);
                    if(min) {
                        var minval = min;
                    } else {
                        var minval = "19:30:00";
                    }
                    $('#apptmnt_time').timepicker('option', {minTime: minval, 
                        maxTime: '20:00:00',
                        step: int,
                        disableTextInput: true
                    });                
                } else {
                    $('#apptmnt_time').timepicker({disableTextInput: true}).val(""); 
                    $('#apptmnt_time').timepicker('option', {
                        minTime: '09:30:00', 
                        maxTime: '20:00:00', 
                        step: int,
                        disableTextInput: true      
                    });
                }        
            },
            onClose: function( selectedDate ) {
                //$("#apptmnt_date" ).datepicker( "option", "maxDate", selectedDate );
            }
        }).val();

        $("#apptmnt_time").timeEntry();
    });
</script>
<?php } ?>

<?php if(in_array(96, $pat_ids) && $bajaj_twl_api_type == 2) { ?>
<script>
$("#lp_date").datepicker({
    changeMonth: true,
    changeYear:  true,
    dateFormat:  'yy-mm-dd',
    yearRange:   "0:+2",
    minDate:     0
});

$("#dob").datepicker({
    changeMonth: true,
    changeYear: true,
    dateFormat: 'yy-mm-dd',
    yearRange: "-65:-18",
    defaultDate: '-21yr',
});

$('select[name="twl_make"]').on('change', function () {
    $.ajax({
        type: "POST",
        data: "twl_make=" + $("#twl_make option:selected").val() + "&city_id=<?php echo $btwl_city_id; ?>&pincode=<?php echo $pin_code; ?>",
        cache: false,
        url: "/sugar/insert/get_twl_model.php",
        success: function (response) {
            if(response.trim() != "") {
                $("#twl_model").attr("disabled", false);
                $("#twl_model").attr("required", true);
                $("#twl_model_label").removeClass("optional-tag");
                $("#twl_model").empty().append(response);
            } else {
                $("#twl_model").attr("required", false);
                $("#twl_model").attr("disabled", true);
                $("#twl_model_label").addClass("optional-tag");
                $("#twl_model").empty().append("<option value=''>Select Model</option>");
            }
        }
    });
});
</script>
<?php } ?>

<?php if(in_array(62, $pat_ids) && $user == 173) { ?>
<script>
$("#place_of_birth").autocomplete({
	source: "../../include/city_name.php",
	minLength: 1
});
</script>
<?php } ?>

<?php if(in_array(75, $pat_ids) && $user == 173) { ?>
<script>
$('input.loan_net_incm').keyup(function() {
    if($(this).val() != undefined) {
        var amount = $(this).val().replace(/,/gi, "");
    } else {
        var amount = $(this).val();
    }
        
    var inout_id = $(this).attr('id');
    var min_idval =  $(this).attr('data-rule-min');

    var finl_in = amount.replace(',','');
    if (finl_in.length < 1)
        $("#"+inout_id).val('');
    else {
        var val = parseFloat(finl_in);
        var formatted = inrFormat(finl_in);
        if(formatted.indexOf('.') > 0) {
            var split = formatted.split('.');
            formatted = split[0] + '.' + split[1].substring(0, 2);
        }
            
        if(inout_id == 'loan_amount') {
            var max = '10';
            $("#"+inout_id).attr('maxlength','10');
        } else if(inout_id == 'net_month_inc' ) {
            var max = '9';
            $("#"+inout_id).attr('maxlength','9');
        }

        $("#"+inout_id).val(amount);

        if($("#"+inout_id).val() != undefined || $("#"+inout_id).val() != "" || $.trim($("#"+inout_id).val()) != "") {
            var temp_val = $("#"+inout_id).val()
            if(temp_val.length > 12) {
                $("#" + inout_id).val("");
                return false;
            }
        }
    }
        
    var words = new Array();
    words[0] = '';
    words[1] = 'One';
    words[2] = 'Two';
    words[3] = 'Three';
    words[4] = 'Four';
    words[5] = 'Five';
    words[6] = 'Six';
    words[7] = 'Seven';
    words[8] = 'Eight';
    words[9] = 'Nine';
    words[10] = 'Ten';
    words[11] = 'Eleven';
    words[12] = 'Twelve';
    words[13] = 'Thirteen';
    words[14] = 'Fourteen';
    words[15] = 'Fifteen';
    words[16] = 'Sixteen';
    words[17] = 'Seventeen';
    words[18] = 'Eighteen';
    words[19] = 'Nineteen';
    words[20] = 'Twenty';
    words[30] = 'Thirty';
    words[40] = 'Forty';
    words[50] = 'Fifty';
    words[60] = 'Sixty';
    words[70] = 'Seventy';
    words[80] = 'Eighty';
    words[90] = 'Ninety';
    amount = amount.toString();
    var atemp = amount.split(".");
    var number = atemp[0].split(",").join("");
    var n_length = number.length;
    var words_string = "";
    if (n_length <= 10) {
        var n_array = new Array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        var received_n_array = new Array();
        for (var i = 0; i < n_length; i++) {
            received_n_array[i] = number.substr(i, 1);
        }
        for (var i = 9 - n_length, j = 0; i < 9; i++, j++) {
            n_array[i] = received_n_array[j];
        }
        for (var i = 0, j = 1; i < 9; i++, j++) {
            if (i == 0 || i == 2 || i == 4 || i == 7) {
                if (n_array[i] == 1) {
                    n_array[j] = 10 + parseInt(n_array[j]);
                    n_array[i] = 0;
                }
            }
        }
        value = "";
        for (var i = 0; i < 10; i++) {
            if (i == 0 || i == 2 || i == 4 || i == 7) {
                value = n_array[i] * 10;
            } else {
                value = n_array[i];
            }
            if (value != 0) {
                words_string += words[value] + " ";
            }
            if ((i == 1 && value != 0) || (i == 0 && value != 0 && n_array[i + 1] == 0)) {
                words_string += "Crores ";
            }
            if ((i == 3 && value != 0) || (i == 2 && value != 0 && n_array[i + 1] == 0)) {
                words_string += "Lakhs ";
            }
            if ((i == 5 && value != 0) || (i == 4 && value != 0 && n_array[i + 1] == 0)) {
                words_string += "Thousand ";
            }
            if ((i == 6 || i == 7) && value != 0 && (n_array[i + 1] != 0 && n_array[i + 2] != 0)) {
                words_string += "Hundred and ";
            } else if (i == 6 && value != 0) {
                words_string += "Hundred ";
            }
        }
        words_string = words_string.split("  ").join(" ");
    }
    var finl_amt_rs = capitalizeFirstLetter(words_string);

    if(amount == 0 || amount == "" || amount.trim() == "" || isNaN(amount)) {
        $("."+inout_id+"_value_formt").text("");
    } else {
        $("."+inout_id+"_value_formt").text("Rs. "+finl_amt_rs);
    }
});
</script>
<?php } ?>
