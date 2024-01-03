<?php
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../config/config.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../include/header.php');
require_once(dirname(__FILE__) . '/../model/queryHelper.php');
require_once "../include/helper.functions.php";
require_once "../include/display-name-functions.php";
require_once "../include/case-query-function-insert.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link href="<?php echo $head_url; ?>/assets/css/grid-form.css?v=1.1" rel="stylesheet">
</head>
<body>
    <div class="pl-md-3 pl-2 pr-md-3 pr-2 col-12">
        <div class="gen-box white-bg">
        <div class="blue-bg col-12 font-weight-nb pb-2 pt-2 white font-20 brdr-top-gray pe-none" style = "text-align:center;" data-toggle="step1" id="switch_step1">
            <span id="text_step1" ></span> Customer Details<div id="error-message" class="error-message"></div></div>    
                <form method="POST" name="frmmain" action="mask_assign.php">
                        <table width="100%" class="gridtable">
                            <tr>
                                <th>Lead Id <br>Application Id<th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                
                            </tr>
                        </table>

                </form>
        </div>
        </div>
    </div>
    
</body>
</html>