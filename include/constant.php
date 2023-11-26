<?php
$no_head = 0;
$multi_browser_array = array();
$global_otp_flag = 1; //1 - Dynamic OTP, 2 - Static OTP , 3- For Auto Login
$sms_api_vendor = 1;
$head_url = 'https://astechnos.com/crmsml';

date_default_timezone_set('Asia/Calcutta');
$page = 1;
$offset = 0;
$start_limit = 0;
$max_offset = 11;
$display_count = 10;
// if ($_REQUEST['page']!= "") {
//     $page = $_REQUEST['page'];
//     $offset = ($page - 1) * $display_count;
// }

$page_no_onboarding = 1;
$onboarding_offset = 0;
$onboarding_max_offset = 110;
$onboarding_display_count = 100;
// if (isset($_REQUEST['page_no_onboarding'])) {
//     $page_no_onboarding = replace_special($_REQUEST['page_no_onboarding']);
//     $onboarding_offset = ($page_no_onboarding - 1) * $onboarding_display_count;
// }

if($no_head != 1){ ?>
    <script>
    var headURL = "<?php echo $head_url; ?>";
</script>
<?php } ?>

