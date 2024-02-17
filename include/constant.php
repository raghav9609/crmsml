<?php
$no_head = 1;
$multi_browser_array = array();
$global_otp_flag = 1; //1 - Dynamic OTP, 2 - Static OTP , 3- For Auto Login
$sms_api_vendor = 1;
$head_url = 'https://astechnos.com/crmsml';
$email_username = "mycrm@switchmyloan.in";
$email_password = "ulri evon jayg hxem";
$email_name = "SwitchMyLoan";
date_default_timezone_set('Asia/Calcutta');
$page = 1;
$offset = 0;
$start_limit = 0;
$max_offset = 11;
$display_count = 10;

if ($_REQUEST['page'] != "") {
    $page = $_REQUEST['page'];
    $offset = ($page - 1) * $display_count;
}
$page_no_onboarding = 1;
$onboarding_offset = 0;
$onboarding_max_offset = 110;
$onboarding_display_count = 100;
if($no_head != 1){ ?>
    <script>
    var headURL = "<?php echo $head_url; ?>";
</script>
<?php } ?>

