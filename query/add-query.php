<?php 
session_start();
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../include/header.php');
require_once(dirname(__FILE__) . '/../include/helper.functions.php');
require_once(dirname(__FILE__) . '/../model/queryHelper.php');
?>

<link href="<?php echo $head_url; ?>/assets/css/grid.css?v=1.1" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<style>
.set-label-pos {
    display: flex !important;
}

.set_amt_frmt {
    position: absolute;
    top: 2.5rem;
    font-size: 13px;
    width: 100%;
    text-align: right;
    right: 15px;
    color: green!important;
}

.cus_phone_icon {
    top: 38% !important;
}
.new-label label:after {
    top: 4.5px!important;
}

.ui-autocomplete {
    width: 16% !important;
    text-align: left !important;
}

.ui-menu .ui-menu-item {
    padding: 0px;
}
.fa-icon {
    font-size: 18px;
}
.fa-mobile {
    font-size: 25px !important;
}
.fa-medium {
    font-size: 16px !important;
}
</style>
<div class="main-app-form">
    <div class="main-crmform col-12">
        <main> 
            <section class="d-flex flex-wrap">
                <div class="pl-md-3 pl-2 pr-md-3 pr-2 col-12">
                    <div class="gen-box white-bg">
                
                        <form method="POST" action="add_process.php" class="form-step col-12" autocomplete="off" id="add_query_form">

                            <input type="hidden" name="page" id="page" value="<?php echo $page;?>" />
                            <input type="hidden" name="cust_id" id="cust_id" value="<?php echo $cust_id;?>" />
                            <input type="hidden" name="missed_id" id="missed_id" value="<?php echo base64_decode($_REQUEST['missedId']); ?>" />
                            <input type="hidden" name="cust_phn" id="cust_phn" value="<?php echo base64_decode($_REQUEST['cust_phn']); ?>" />

                            <input type="hidden" name="regen_lead_id" id="regen_lead_id" value="<?php echo base64_decode($_REQUEST['lead_id']); ?>">
                            <input type="hidden" name="regen_level_type" id="regen_level_type" value="<?php echo base64_decode($_REQUEST['level_type']); ?>">

                            <div class="row div-width">
                                <div class="form-group col-xl-3 col-lg-4 col-md-6">
                                    <span class="fa-icon fa-mobile cus_phone_icon"></span>
                                    <input type="tel" id="customer_phone" name="customer_phone" value="<?php echo base64_decode($_REQUEST['cust_phn']); ?>" placeholder="Customer Phone" class="form-control" maxlength="10" minlength="10">
                                    <label id="customer_phone-error" class="error hidden" style='bottom: unset !important;' for="customer_phone">This field is required.</label>
                                    <label for="customer_phone" class="label-tag set-label-pos">Customer Phone</label>
                                </div>
                                <div class="form-group col-xl-3 col-lg-4 col-md-6">
                                    <input type="button" name="fetch_details" id="fetch_details" value="Fetch Details" class='btn btn-primary' />
                                </div>
                            </div>

                            <div class="row div-width">
                                <div class="heading-offers">
                                    <div class="exclamatry-text">Personal Details</div>
                                </div>
                                <div class="form-group col-xl-6 col-lg-4 col-md-6 occupation_id hidden">
                                    <label for="" class="radio-tag set-label-pos label-tag">Employment Type</label>
                                    <div class="radio-button error_contain new-label">

                                        <input type="radio" name="occupation_id" id="occupation_id1"  value="1" >
                                        <label for="occupation_id1" class="occupation1">Salaried</label>

                                        <input type="radio" name="occupation_id" id="occupation_id2" value="2" >
                                        <label for="occupation_id2" class="occupation2">Self Employed - Professional</label>

                                        <input type="radio" name="occupation_id" id="occupation_id3" value="3" >
                                        <label for="occupation_id3" class="occupation3">Self Employed - Business</label>

                                    </div>
                                </div>
                            </div>

                            <div class="row div-width">
                                <div class="form-group col-xl-3 col-lg-4 col-md-6 name">
                                    <span class="fa-icon fa-user"></span>
                                    <input type="text" id="name" name="name" value="" placeholder="Name" class="form-control alpha-w-space" maxlength="30">
                                    <label for="name" class="missed-id-tag label-tag set-label-pos">Name</label>
                                </div>

                                <div class="form-group col-xl-3 col-lg-4 col-md-6 phone_no">
                                    <span class="fa-icon fa-mobile"></span>
                                    <input type="tel" id="phone_no" name="phone_no" value="" placeholder="Mobile" class="form-control numonly"  maxlength="10" minlength="10">
                                    <label for="phone_no" class="missed-id-tag label-tag set-label-pos">Mobile</label>
                                </div>

                                <div class="form-group col-xl-3 col-lg-4 col-md-6 city_id">
                                    <span class="fa-icon fa-map-marker"></span>
                                    <input type="text" id="city_name" name="city_name" value="" placeholder="City or Pincode" class="form-control city_pin_search ui-autocomplete-input alpha-num-space" autocomplete="zxc" maxlength="30" >
                                    <label for="city_id" class="missed-id-tag label-tag set-label-pos">City or Pincode</label>
                                </div>

                                <div class="form-group col-xl-3 col-lg-4 col-md-6 pl_dob">
                                    <span class="fa-icon fa-calendar"></span>
                                    <input type="text" id="pl_dob" name="date_of_birth" value="" placeholder="Date of Birth" class="form-control" maxlength="15" minlength="10">
                                    <label for="pl_dob" id="label-for-dob" class="label-tag set-label-pos optional-tag">Date of Birth</label>
                                </div>

                                <div class="form-group col-xl-3 col-lg-4 col-md-6 net_inc">
                                    <span class="fa-icon fa-inr"></span>
                                    <input type="text" id="net_month_inc" name="net_month_inc" value="" placeholder="Net Monthly Income" class="form-control numonly" maxlength="8" onkeyup="nmi_in_words.innerHTML=price_in_words(this.value)">
                                    <label for="net_month_inc" id="nmi_label" class="label-tag set-label-pos">Net Monthly Income</label>
                                    <div class='word_below set_amt_frmt orange'><b id="nmi_in_words" class=' net_month_inc_value_formt'></b></div>
                                </div>

                                <div class="form-group col-xl-3 col-lg-4 col-md-6 salary_method hidden">
                                    <span class="fa-icon fa-money"></span>
                                    <?php echo get_dropdown(4, 'mode_of_salary'); ?>
                                    <label for="salary_method" id="salary_method_label" class="label-tag set-label-pos">Salary Paid By</label>
                                </div>

                                <div class="form-group col-xl-3 col-lg-4 col-md-6 banks_list hidden">
                                    <span class="fa-icon fa-bank"></span>
                                    <?php echo get_dropdown(2, 'banks_list', '', ''); ?>
                                    <label for="banks_list" class="label-tag set-label-pos">Banks</label>
                                </div>

                                <div class="form-group col-xl-3 col-lg-4 col-md-6 company hidden">
                                    <span class="fa-icon fa-industry"></span>
                                    <input type="text" id="comp_name" name="comp_name" value="" placeholder="Company Name" class="form-control alpha-num-space" maxlength="30" >
                                    <label for="comp_name" id="comp_name_label" class="label-tag set-label-pos">Company Name</label>
                                </div>
                            </div>

                            <div class="row div-width" style="margin-top: 10px">
                                <div class="heading-offers">
                                    <div class="exclamatry-text">Loan Details</div>
                                </div>
                                <div class="form-group col-xl-3 col-lg-4 col-md-6">
                                    <span class="fa-icon fa-amnt"></span>
                                    <?php echo get_dropdown(1, 'loan_type', '', 'onchange="loan_type_chng();" class=""'); ?>
                                    <label for="loan_type" class="missed-id-tag label-tag set-label-pos">Loan Type</label>
                                </div>
                            
                                <div class="form-group col-xl-3 col-lg-4 col-md-6 amt_deposit hidden">
                                    <span class="fa-icon fa-inr"></span>
                                    <input type="text" id="amt_deposit" name="amt_deposit" value="" placeholder="Amount to Deposit" class="form-control numonly" maxlength="10" onkeyup="ad_in_words.innerHTML=price_in_words(this.value)">
                                    <label for="amt_deposit" class="label-tag set-label-pos">Amount you wish to deposit</label>
                                    <div class='word_below set_amt_frmt orange'><b id="ad_in_words" class=' amt_deposit_value_formt'></b></div>

                                </div>

                                <div class="form-group col-xl-3 col-lg-4 col-md-6 loan_amount">
                                    <span class="fa-icon fa-inr"></span>
                                    <input type="text" id="loan_amount" name="loan_amount" value="" placeholder="Loan Amount" class="form-control numonly" maxlength="10" onkeyup="la_in_words.innerHTML=price_in_words(this.value)">
                                    <label for="loan_amount" class="label-tag set-label-pos">Loan Amount</label>
                                    <div class='word_below set_amt_frmt orange'><b id="la_in_words" class=' loan_amount_value_formt'></b></div>
                                </div>
                            
                                <div class="form-group col-xl-3 col-lg-4 col-md-6 gl_fields hidden">
                                    <span class="fa-icon fa-balance-scale "></span>
                                    <input type="tel" id="gl_gram" name="gl_gram" value="" placeholder="Weight of Gold" class="form-control numonly" >
                                    <label for="gl_gram" class="label-tag set-label-pos optional-tag">Weight of Gold</label>
                                </div>
                                <div class="form-group col-xl-3 col-lg-4 col-md-6 gl_fields hidden">
                                    <span class="fa-icon fa-gold-loan"></span>
                                    <input type="tel" id="gl_carat" name="gl_carat" value="" placeholder="Weight of Gold" class="form-control numonly" >
                                    <label for="gl_carat" class="label-tag set-label-pos optional-tag">Carats of Gold</label>
                                </div>

                                <div class="form-group col-xl-3 col-lg-4 col-md-6 business hidden">
                                    <span class="fa-icon fa-inr"></span>
                                    <input type="text" id="anl_trn" name="anl_trn" value="" placeholder="Annual Turnover" class="form-control numonly" maxlength="10" onkeyup="at_in_words.innerHTML=price_in_words(this.value)">
                                    <label for="anl_trn" class="label-tag set-label-pos optional-tag">Annual Turnover</label>
                                    <div class='word_below set_amt_frmt orange'><b id="at_in_words" class='anl_trn_value_formt'></b></div>
                                </div>

                                

                               

                                <div class="form-group col-xl-3 col-lg-4 col-md-6 bank_account_type hidden">
                                    <span class="fa-icon fa-bank"></span>
                                    <?php echo get_dropdown(13, 'bank_account_type', '', ''); ?>
                                    <label for="bank_account_type" class="label-tag set-label-pos">Bank Account Type</label>
                                </div>

                                <div class="form-group col-xl-3 col-lg-4 col-md-6 gross_anl_recpt hidden">
                                    <span class="fa-icon fa-inr"></span>
                                    <input type="text" id="gross_annual_receipt" name="gross_annual_receipt" value="" placeholder="Gross Annual Receipt" class="form-control numonly" maxlength="10" onkeyup="gar_in_words.innerHTML=price_in_words(this.value)">
                                    <label for="gross_annual_receipt" id="gar_label" class="label-tag set-label-pos">Gross Annual Receipt</label>
                                    <div class='word_below set_amt_frmt orange'><b id="gar_in_words" class=' gross_annual_receipt_value_formt'></b></div>
                                </div>

                                <!-- <div class="form-group col-xl-3 col-lg-4 col-md-6 anl_profit hidden">
                                    <span class="fa-icon fa-inr"></span>
                                    <input type="text" id="anl_prof" name="anl_prof" value="" placeholder="Annual Profit" class="form-control numonly " maxlength="10" onkeyup="ap_in_words.innerHTML=price_in_words(this.value)">
                                    <label for="anl_prof" class="label-tag set-label-pos optional-tag">Annual Profit</label>
                                    <div class='word_below set_amt_frmt orange'><b id="ap_in_words" class='anl_prof_value_formt'></b></div>
                                </div> -->

                               

                                <div class="form-group col-xl-3 col-lg-4 col-md-6 assign_to user_ass hidden">
                                    <label for="" class="radio-tag set-label-pos label-tag optional-tag">Assign To</label>
                                    <div class="radio-button error_contain new-label">

                                        <input type="radio" name="assign_to" id="assign_to1"  value="1" checked>
                                        <label for="assign_to1">Self</label>

                                        <input type="radio" name="assign_to" id="assign_to2" value="2" >
                                        <label for="assign_to2">Auto</label>

                                        <input type="radio" name="assign_to" id="assign_to3" value="3" >
                                        <label for="assign_to3">Choose User</label>
                                        
                                    </div>
                                </div>

                                <!-- <div class="form-group col-xl-3 col-lg-4 col-md-6 user_assign hidden">
                                    <span class="fa-icon fa-user"></span>
                                <?php // echo get_dropdown('u_assign', 'u_assign', '', ''); ?>
                                    <label for="u_assign" id="u_assign_label" class="label-tag set-label-pos optional-tag">User Assign</label>
                                </div>

                                <div class="form-group col-xl-3 col-lg-4 col-md-6 acq_mod  hidden">
                                    <span class="fa-icon fa-medium"></span>
                                    <?php // echo get_dropdown('acq_mode', 'acq_id', '5', 'onchange= "acqtype(this.value);"'); ?>
                                    <label for="acq_id" class="label-tag set-label-pos optional-tag">Acquistion Mode</label>
                                </div> -->

                                <div class="form-group col-xl-3 col-lg-4 col-md-6 ref_type" style="display:none;">
                                    <span class="fa-icon fa-sitemap"></span>
                                    <select name="ref_type" id="ref_type" class="form-control">
                                    <option value='' class="">Select Referrer </option>
                                        <option value='1'>Customer</option>
                                        <option value='2'>Partner</option>
                                    </select>
                                    <label for="u_assign" class="label-tag set-label-pos">Referred By</label>
                                </div>

                                <div class="form-group col-xl-3 col-lg-4 col-md-6 ref_mob" style="display:none;">
                                    <span class="fa-icon fa-mobile"></span>
                                    <input type="tel" id="ref_mob" name="ref_mob" value="" placeholder="Referral Mobile" class="form-control numonly"  maxlength="10" minlength="10">
                                    <label for="ref_mob" class="label-tag set-label-pos">Referral Mobile</label>
                                </div>
                            </div>

                            <div class="row div-width">
                                <div class="form group col-xl-5 col-lg-5 col-md-5">
                                </div>
                                <div class="form group col-xl-2 col-lg-2 col-md-2">
                                    <input type="submit" class="btn btn-primary" name="submit"  value="Submit" >
                                </div>
                            </div>

                            
                            <div class="row div-width">
                                <div class="form group col-xl-12 col-lg-12 col-md-12">
                                &nbsp;&nbsp;&nbsp;
                                </div>
                            </div>

                            
                        </form>
                    </div>
                </div>
            </section>
        </main>
    </div>
</div>
<?php include(dirname(__FILE__) . '/../include/loader.php'); ?>

<script>
    var negative_ques_val = '<?php echo $property_negative_ques ?>';
    var industry_id = '<?php echo $industry_id; ?>';
    var user_role = "<?php echo $_SESSION['user_role']; ?>";
    var one_lead = "<?php echo $_SESSION['one_lead_flag']; ?>";
</script>
<script src="<?php echo $head_url; ?>/assets/js/jquery-1.10.2.js"></script>
<script src="<?php echo $head_url; ?>/assets/js/jquery-ui.js"></script>
<script src="../assets/js/new-journey-add-query.js?v=5"></script>
<script src="../assets/js/common-function-call.js"></script>
<script>
function price_in_words(price) {
  var sglDigit = ["Zero", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine"],
    dblDigit = ["Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen", "Nineteen"],
    tensPlace = ["", "Ten", "Twenty", "Thirty", "Forty", "Fifty", "Sixty", "Seventy", "Eighty", "Ninety"],
    handle_tens = function(dgt, prevDgt) {
      return 0 == dgt ? "" : " " + (1 == dgt ? dblDigit[prevDgt] : tensPlace[dgt])
    },
    handle_utlc = function(dgt, nxtDgt, denom) {
      return (0 != dgt && 1 != nxtDgt ? " " + sglDigit[dgt] : "") + (0 != nxtDgt || dgt > 0 ? " " + denom : "")
    };

  var str = "",
    digitIdx = 0,
    digit = 0,
    nxtDigit = 0,
    words = [];
  if (price += "", isNaN(parseInt(price))) str = "";
  else if (parseInt(price) > 0 && price.length <= 10) {
    for (digitIdx = price.length - 1; digitIdx >= 0; digitIdx--) switch (digit = price[digitIdx] - 0, nxtDigit = digitIdx > 0 ? price[digitIdx - 1] - 0 : 0, price.length - digitIdx - 1) {
      case 0:
        words.push(handle_utlc(digit, nxtDigit, ""));
        break;
      case 1:
        words.push(handle_tens(digit, price[digitIdx + 1]));
        break;
      case 2:
        words.push(0 != digit ? " " + sglDigit[digit] + " Hundred" + (0 != price[digitIdx + 1] && 0 != price[digitIdx + 2] ? " and" : "") : "");
        break;
      case 3:
        words.push(handle_utlc(digit, nxtDigit, "Thousand"));
        break;
      case 4:
        words.push(handle_tens(digit, price[digitIdx + 1]));
        break;
      case 5:
        words.push(handle_utlc(digit, nxtDigit, "Lakh"));
        break;
      case 6:
        words.push(handle_tens(digit, price[digitIdx + 1]));
        break;
      case 7:
        words.push(handle_utlc(digit, nxtDigit, "Crore"));
        break;
      case 8:
        words.push(handle_tens(digit, price[digitIdx + 1]));
        break;
      case 9:
        words.push(0 != digit ? " " + sglDigit[digit] + " Hundred" + (0 != price[digitIdx + 1] || 0 != price[digitIdx + 2] ? " and" : " Crore") : "")
    }
    str = "Rs. " + words.reverse().join("")
  } else str = "";
  return str

}
</script>