<?php
require_once(dirname(__FILE__) . '/../../include/header.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload File </title>
    <?php include('../../include/main-css.php');?>
    <body>
		
	
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<a href="index.php"><input type="button" class="buttonsub cursor" value="Back"></a>
            <table class="table" id="maintable">
                <tbody>
                    <?php $array_lbl = array("mobile_no" =>"Mobile No of the customer(Mandetory)",'email_id'=>'Email Id','var1'=>'Name of Customer(Mandetory)','var2'=>' Loan Type(Personal Loan)','var3'=>'Loan Amount(100000)','var4'=>'null','var5'=>'null','var6'=>'null','var7'=>'null','var8'=>'null','var9'=>'null','var10'=>'null','sms_trigger_on'=>'Trigger date','is_sms_triggered'=>'0','transaction_id'=>'null','sms_text'=>'null','url'=>'null','var_url'=>'Mandetory for all, whatsapp(for ex:- personal-loan)','source'=>'CRM','sms_type'=>'For sms  SHORTTSMSAPI(Transactional) / SHORTPSMSAPI(Promotional) ','purpose'=>'Template Name ','temp_name'=>'Template Name','communication_type'=>'1 for sms 2 for whatsapp 3 for OBD','mlc_master_communication_trigger_instant_id'=>0,'status_from_api'=>'null','api_request'=>'null','api_response'=>'null','cli'=>'null','callstatus'=>'null','callstarttime'=>'null','Campaignname'=>'Campaign Name','callduration'=>0,'msisdn'=>0,'callreferenceid'=>'null','callendtime'=>'null','param1'=>'null','image_url'=>'Image Url for whatsapp','statusdescription'=>'null','send_type'=>' 2 For Campaign','schedule_date_from'=>'Schedule Date from ','schedule_date_to'=>'Schedule Date To','failed_code'=>'null','handsetTime'=>'','whatsapp_type'=>'1. Normal 2. CTA Based','trigger_type'=>'1 - Schedule , 2 - Test','mlc_campaign_send_sms_id'=>0,'schedule_datetime'=>'For INSTANT current time and for schedule Schedule time ') ;
                        
                    ?>
                    <tr>
                        <th style="text-align:center;"> Variable Name     </th>
                        <th style="text-align:center;"> Varible Description     </th>
                    </tr>
                    <?php 
                    foreach($array_lbl as $key=>$value){?>
                        <tr>
                            <td class="text_align_center"><?php echo $key ;?></td>
                            <td style="text-align:center;"><?php echo $value ; ?></td>
                        </tr>
                    <?php }?>
                    </tr>
                </tbody>
            </table>
		</div>
	</div>
</div>
<?php include('../main-js-css-insert.php');?>
</body>
</html>


