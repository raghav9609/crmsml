<?php
error_reporting(0); 
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../config/config.php');
require_once(dirname(__FILE__) . '/../model/headerModel.php');

?>
<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400" rel="stylesheet">
<link href="<?php echo $head_url; ?>/assets/css/header.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $head_url; ?>/assets/css/adminstylesheet.css" rel="stylesheet" type="text/css" />
<?php if($user_role == 3 && $_SESSION['one_lead_flag'] != 1) { ?>
    <style>
    .nav-menu1 a { text-decoration: none;  border-radius: .2em; }
    .wn-badge { position: absolute; top: 5px; right: 106px; padding: 3px 5px; border-radius: 50%; background: #0037ff; color: white; font-weight: bold; font-size: 9px  }
    </style>
<?php } else { ?>
    <style>
    .nav-menu1 a { text-decoration: none;  border-radius: .2em; }
    </style>
<?php } ?>
<div id="menu-fixed" style='width:100%;z-index:10'>
        <div class="nav-bar menu-fixed-custom" style='width:86%;float:left;'>
  <ul class="nav-menu">
  <?php
	$get_header_qr = new headerModel();
	$get_main_head = $get_header_qr->getMainHeader($user_role,$user_id);
	$db_handle = new DBController();
	$details_fetch = $db_handle->runQuery($get_main_head);
  
  foreach($details_fetch as $main_header_key => $main_header_val){
        // For Initial Level menu
        if($main_header_val['link'] == ''){
            $main_header_link = 'javascript:void(0);';
        }else{
            $main_header_link = $main_header_val['link'];            
        }
        $header_var = "<li><a href='".$main_header_link."'>".$main_header_val['description'];
        if($main_header_val['class_flag'] == '1'){
             $header_var .= "<span class='caret'></span>";
        }
        $header_var .= "</a>";
        // For First Level menu
		
		$sub_details_fetch = array();
       if($main_header_val['class_flag'] == '1'){
		   $get_sub_head = $get_header_qr->getMainHeader($user_role,$user_id,$main_header_val['id']);
			$sub_details_fetch = $db_handle->runQuery($get_sub_head);
            $header_var .= "<ul>";
                 foreach($sub_details_fetch as $sub_header_key=> $sub_header_val){
                        if($sub_header_val['link'] == ''){
                            $sec_header_link = 'javascript:void(0);';
                        }else{
                            $sec_header_link = $sub_header_val['link'];
                        }
                            $header_var .= "<li><a href='".$sec_header_link."'>".$sub_header_val['description'];
                            if($sub_header_val['class_flag'] == '1'){
                                 $header_var .= "<span class='caret'></span>";
                            }
                                $header_var .= "</a>";
                            if($sub_header_val['class_flag'] == '1'){
								$get_sub_sub_head = $get_header_qr->getMainHeader($user_role,$user_id,$sub_header_val['id']);
								$_sub_sub_details_fetch = $db_handle->runQuery($get_sub_sub_head);
                                $header_var .= "<ul>";
                                    foreach($_sub_sub_details_fetch as $sub_sub_header_key=> $sub_sub_header_val){
                                            if($sub_sub_header_val['link'] == ''){
                                                $sec_sub_header_link = 'javascript:void(0);';
                                            }else{
                                                $sec_sub_header_link = $sub_sub_header_val['link'];
                                            }
                                                $header_var .= "<li><a href='".$sec_sub_header_link."' > " .$sub_sub_header_val['description']." </a></li>";
                                    }
                                $header_var .= "</ul>";
                           }     
                                
                    
                     $header_var .= "</li>";
                } 
            $header_var .= "</ul>";
       }
      echo $header_var .= "</li>";
    }
?>
	</ul>
      </div>
    <div class="nav-bar1" style='width:14%;float:right;'>
	  <ul class='nav-menu1 nav-menu1-custom nav-resetbtn'>
          
        <li><span class="f_20 white">
        <?php echo $_SESSION['userDetails']['user_name']; ?></span>&nbsp;&nbsp;
        <a href="<?php echo $head_url; ?>/change-password/index.php"> 
            <img style='width: 15%;' src="<?php echo $head_url; ?>/assets/images/reset-icon.png" alt="Reset"> </a>&nbsp;&nbsp;
            <a href="<?php echo $head_url; ?>/logout.php" class=""><img style='width:15%;' src="<?php echo $head_url; ?>/assets/images/logout.png" alt="Logout"></a>
        </li>
	  </ul> </div>
</div>
<div style='clear:both;'></div>