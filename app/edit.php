<?php
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../config/config.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../include/header.php');
require_once(dirname(__FILE__) . '/../model/queryHelper.php');
require_once(dirname(__FILE__) . '/../include/helper.functions.php');
require_once(dirname(__FILE__) . '/../include/display-name-functions.php');

if (isset($_REQUEST['page'])) {
    $page = replace_special($_REQUEST['page']);
}
if (isset($_REQUEST['app_id'])) {
    $id = replace_special(urldecode(base64_decode($_REQUEST['app_id'])));
    $ut = replace_special($_REQUEST['ut']);
}
$qryyy_id = $id;
$qry = "Select * from  crm_query_application where id ='".$qryyy_id."'";

$res = mysqli_query($Conn1, $qry) or die(mysqli_error($Conn1));
$exe_form = mysqli_fetch_array($res);


if ($exe_form['id'] == '' || $exe_form['id'] == 0) {
    if ($user_role == 3) {
        header("location:user.php");
    } else if ($user_role == 2) {
        header("location:index.php");
    }
} else {
  
    $name_bank = $exe_form['bank_id'];
    $get_bank_name = get_name("",$name_bank);
    $application_status = $exe_form['application_status'];
    $app_u_assign = $exe_form['user_id'];
    $applied_amount = $exe_form['applied_amount'];
    $sanction_amount = $exe_form['sanction_amount'];
    $disbursed_amount = $exe_form['disbursed_amount'];
    $login_date = $exe_form['login_date'];
    $sanction_date = $exe_form['sanction_date'];
    $disburse_date = $exe_form['disburse_date'];
    $bank_application_no = $exe_form['bank_application_no'];
    $remarks_by_user = $exe_form['description_by_user'];
    $remarks_by_bank=$exe_form['description_by_bank'];
    $follow_up_date=$exe_form['follow_up_date'];
    $follow_up_time=$exe_form['follow_up_time'];
    $follow_up_given_by=$exe_form['follow_up_given_by'];
    $tennure=$exe_form['tennure'];
    $roi=$exe_form['roi'];
?>

<!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Application Form</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo $head_url; ?>/assets/css/cms.style-new.css" />
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <link href="<?php echo $head_url; ?>/assets/css/grid-form.css?v=1.1" rel="stylesheet">
        <script src="../assets/js/jquery.timepicker.js"></script>
        <link rel="stylesheet" href="../assets/css/jquery.timepicker.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <style>
            .fa-icon { 
                font-size: 18px;
            }
            .fa-mobile {
                font-size: 25px !important;
            }
            #form_step4 b.caret{
                margin-left:215px!important;
                display: inline;
            }
            #form_step4 .border-class{
                font-size: 14px;
                margin-left: 6px!important;
                border-bottom: 1px solid #ced4da!important;
                width: 100%!important;
                }
                #form_step4 .dropdown-menu {
                left: -150px;
                width: 241px;
            }
            .error-message {
                color: red;
            }
            .application_status {
                margin-bottom: 10px;
                position: relative;
            }

            .application_status label {
                display: block;
                font-weight: 300;
                margin-bottom: -2px;
                
            }

            .application_status select {
                width: 100%;
                padding: 9px;
                font-size: 12px;
                border: 1px solid #ccc;
                border-radius: 5px;
            }
            .application_status label.required:after {
                content: ' *';
                color: red; /* Adjust the color as needed */
            }

            .fa-icon {
                /* Add your FontAwesome styling here */
                margin-right: 10px; /* Adjust as needed */
            }
        </style>
    </head>

    <body>
        <div class="color-bar-1"></div>
        <div class="color-bar-2 color-bg"></div>
        <div class="container-fluid main-container">
            <div class="row">
                <div class="span9">
                    <div class="wrapper">
                        <span class='orange f_13' style="font-weight:bold;"></span>
                        <?php 
                            $filter=0;
                            $class="np-amberbtn";
                            $style="visibility: hidden;";
                            if($filterstatus != ""){
                                $filter=1;
                                if($filterstatus=="Green"){
                                    $class="np-greenbtn";
                                } else if($filterstatus=="Red"){
                                    $class="np-redbtn";
                                } else{
                                    $class="np-amberbtn";
                                }
                            }
                          //  include("../query/js-insert.php");
                            include("form_index_app.php");
                            include("application-history.php");
                            ?>
                            <br>
                           
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<script type="text/javascript" src="../assets/js/jquery.timeentry.js"></script>
<script>
    // document.addEventListener('DOMContentLoaded', function () {
    //     $(document).ready(function () {
    //         $('.datepicker').datepicker({
    //             dateFormat: 'yy-mm-dd', 
    //             changeMonth: true,
    //             changeYear: true,
    //             yearRange: 'c-100:2050'
    //         });

    //         flatpickr('.flatpickr', {
    //             enableTime: true,
    //             noCalendar: true,
    //             dateFormat: "H:i",
    //             time_24hr: true,
    //             minuteIncrement: 15
    //         });
    //     });
    // });
    
//     document.addEventListener('DOMContentLoaded', function() {
//     //amount 
//     var appliedAmountInput = document.getElementById('applied_amount');
//     var sanctionAmountInput = document.getElementById('sanction_amount');
//     var disbursementInput = document.getElementById('disbursed_amount');
//     var submit_app = document.getElementById('submit_app');

//     var messageElement = document.createElement('span');
//     messageElement.className = 'error-message';
//     disbursementInput.parentNode.appendChild(messageElement);

//     function validateDisbursement() {
//         var appliedAmount = parseFloat(appliedAmountInput.value) || 0;
//         var sanctionAmount = parseFloat(sanctionAmountInput.value) || 0;
//         var disbursementAmount = parseFloat(disbursementInput.value) || 0;

//         if (appliedAmount >= disbursementAmount || sanctionAmount >= disbursementAmount) {
//             messageElement.textContent = ' Disbursement Amount should not be smaller than Applied Amount and Sanction Amount.';
//             submit_app.setAttribute('disabled', 'disabled');
//         } else {
//             messageElement.textContent = '';
//             submit_app.removeAttribute('disabled');
//         }
//     }

//     appliedAmountInput.addEventListener('input', function() {
//         validateDisbursement();
//     });

//     sanctionAmountInput.addEventListener('input', function() {
//         validateDisbursement();
//     });

//     disbursementInput.addEventListener('input', function() {
//         validateDisbursement();
//     });


// });

// document.addEventListener('DOMContentLoaded', function () {
// function datevalidate() {
//   var logindateInput = document.getElementById('login_date');
//   var sanctiondateInput = document.getElementById('sanction_date');
//   var disbursementInputdate = document.getElementById('disburse_date');
//   var submit_app = document.getElementById('submit_app');
//   var errormessageElement = document.getElementById('error-message');

//   var login_date = new Date(logindateInput.value);
//   var sanction_date = new Date(sanctiondateInput.value);
//   var disburse_date = new Date(disbursementInputdate.value);

//   login_date.setHours(0, 0, 0, 0);
//   sanction_date.setHours(0, 0, 0, 0);
//   disburse_date.setHours(0, 0, 0, 0);

//   if (disburse_date < login_date || disburse_date < sanction_date) {
//     errormessageElement.textContent = 'Disbursement Date should not be smaller than Login Date and Sanction Date.';
//     submit_app.setAttribute('disabled', 'disabled');
//   } else {
//     errormessageElement.textContent = '';
//     submit_app.removeAttribute('disabled');
//   }
// }

$("#login_date").datepicker({
        //   minDate: '0',
        //   maxDate: '90',
          changeMonth: true, 
          changeYear: true,
          dateFormat: 'yy-mm-dd',
          onSelect: function(value, ui) {
              var today = new Date();
              var date = Date.parse(value);
             
          },
          onClose: function( selectedDate ) {
            $("#login_date_t").val(selectedDate);
          }
      });

    $("#follow_up_date").datepicker({
          minDate: '0',
          maxDate: '90',
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
              var int=30;

              if(datetoday == date) {
                  $('#follow_up_time').timepicker({disableTextInput: true}).val("");
                  var min = formatTime(today);
                  if(min) {
                      var minval = min;
                  } else {
                      var minval = "19:30:00";
                  }
                  $('#follow_up_time').timepicker('option', {
                    minTime: minval, 
                    maxTime: '20:00:00',
                    step: int,
                    disableTextInput: true
                  });                
              } else {
                  $('#follow_up_time').timepicker({disableTextInput: true}).val(""); 
                  $('#follow_up_time').timepicker('option', {
                      minTime: '09:30:00', 
                      maxTime: '20:00:00', 
                      step: int,
                      disableTextInput: true      
                  });
              }        
          },
          onClose: function( selectedDate ) {
            $("#follow_up_date_t").val(selectedDate);
          }
      });

      function formatTime(dt) {
        var hour = dt.getHours();
        var hournext = dt.getHours()+1;
        var chhour = ((dt.getMinutes() >= 30) ? hournext : hour);
        if(18 > chhour) {
        return ((dt.getMinutes() >= 30) ? hournext : hour)  + ':' + ((dt.getMinutes() < 30) ? '30' : '00').slice(-2) + (chhour >= 12 ? 'pm' : 'am')
        } else {
            return false;
        }
    }

    function validatedata(statusId){
        var statusid = statusId;
        alert(statusid);
        if (statusid == 26){
            $(".logindetails").removeClass("hidden");
        }

    }

</script>
<?php } ?>



