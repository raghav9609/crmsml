<?php 
$slave =1;
require_once "../../include/config.php";
$type = $_REQUEST['type'];
$return_html = "";

$city_id = $_REQUEST['city_id'];

$new_city = $_REQUEST['new_city'];
if($new_city != "") {
	$new_city_query = "select city_id from lms_city where city_name = '".$new_city."' ";
	$new_city_exe = mysqli_query($Conn1, $new_city_query);
	if(mysqli_num_rows($new_city_exe) > 0) {
		$new_city_res = mysqli_fetch_array($new_city_exe);
		$city_id = $new_city_res['city_id'];
	}
}

$loan_type_id = $_REQUEST['loan_type'];
$case_id = $_REQUEST['case_id'];
$query_id = $_REQUEST['query_id'];
 	
if($type == 'query' || $type == 'case'){

	$get_pat_info = mysqli_query($Conn1,"select contact_id, partner_id,rm_name,rm_email,rm_mobile,sm_name,sm_email,sm_mobile from tbl_bank_contact_info_new where city_id ='".$city_id."' and loan_type='".$loan_type_id."' and (rm_email_flag = '1' OR rm_sms_flag = '1' OR sm_email_flag = '1' OR sm_sms_flag = '1') order by partner_id");
} else if( $type == 'app'){
	$get_app = mysqli_query($Conn1,"select GROUP_CONCAT(partner_id SEPARATOR ',') as partner_id from tbl_mlc_partner as ml_pat left JOIN tbl_mint_app as ap ON ml_pat.bank_id = ap.app_bank_on where ap.case_id='".$case_id."'");
	$res_app = mysqli_fetch_array($get_app);
	
	
	$get_pat_info = mysqli_query($Conn1,"select contact_id, partner_id,rm_name,rm_email,rm_mobile,sm_name,sm_email,sm_mobile from tbl_bank_contact_info_new where city_id ='".$city_id."' and loan_type='".$loan_type_id."' and (rm_email_flag = '1' OR rm_sms_flag = '1' OR sm_email_flag = '1' OR sm_sms_flag = '1') and partner_id IN (".$res_app['partner_id'].") order by partner_id");
}

	$number_result = mysqli_num_rows($get_pat_info);
    $sr_no = 0;
    if($number_result > 0) {
		$return_html .= "<table  class='gridtable' width='100%'><tr class='font-weight-bold'><th>Sr. No.</th><th>Partner Name</th><th>RM Name</th><th>RM Email</th><th>RM Mobile</th><th>SM Name</th><th>SM Email</th><th>SM Mobile</th></tr>";
		
		while($res_get_info = mysqli_fetch_array($get_pat_info)){
			++$sr_no;
			$partner_id = $res_get_info['partner_id'];
			$get_pat_name = mysqli_query($Conn1,"select partner_name from tbl_mlc_partner where partner_id ='".$partner_id."'");
			$res_pat_name = mysqli_fetch_array($get_pat_name);
			
if($res_get_info['rm_mobile'] == '' || $res_get_info['rm_mobile'] == '0'){$rm_mobile = '-';}else{ $rm_mobile = $res_get_info['rm_mobile']; }
if($res_get_info['rm_email'] == ''){$rm_email = '-';}else{ $rm_email = $res_get_info['rm_email']; }
if($res_get_info['sm_mobile'] == '' || $res_get_info['sm_mobile'] == '0'){$sm_mobile = '-';}else{ $sm_mobile = $res_get_info['sm_mobile']; }
if($res_get_info['sm_email'] == ''){$sm_email = '-';}else{ $sm_email = $res_get_info['sm_email']; }
if($res_get_info['rm_name'] == ''){$rm_name = '-';}else{ $rm_name = $res_get_info['rm_name']; }
if($res_get_info['sm_name'] == ''){$sm_name = '-';}else{ $sm_name = $res_get_info['sm_name']; }

$rm_name_new = $res_get_info['rm_name'];
$rm_email_new = $res_get_info['rm_email'];
$rm_mobile_new = $res_get_info['rm_mobile'];

$sm_name_new = $res_get_info['sm_name'];
$sm_email_new = $res_get_info['sm_email'];
$sm_mobile_new = $res_get_info['sm_mobile'];

			$contact_id = $res_get_info['contact_id'];

			$level_type = 1;					//query
			$record_id = $query_id;
			if($type == 'case') {
				$level_type = 2;				//case
				$record_id = $case_id;
			} else if($type == 'app') {
				$level_type = 3;				//app
				$record_id = $case_id;
			}

			$like = $rm = 1;
			$dislike = $sm = 2;

			$like_flag_rm = "";
			$dislike_flag_rm = "";
			$like_flag_sm = "";
			$dislike_flag_sm = "";

			$select_valid_rm = "select id, like_dislike_flag from valid_rm_sm where partner_id = '".$partner_id."' and name = '".$rm_name_new."' and email = '".$rm_email_new."' and mobile = '".$rm_mobile_new."' and manager_type = 1 and city_id = $city_id order by id desc limit 1";
			
			$select_valid_rm_exe = mysqli_query($Conn1, $select_valid_rm);
			
			if(mysqli_num_rows($select_valid_rm_exe) > 0) {
				$select_valid_rm_res = mysqli_fetch_array($select_valid_rm_exe);
				if($select_valid_rm_res['like_dislike_flag'] == 1) {
					$like_flag_rm = " style='color: green'";
				} else if($select_valid_rm_res['like_dislike_flag'] == 2) {
					$dislike_flag_rm = " style='color: red'";
				}
			}

			$select_valid_sm = "select id, like_dislike_flag from valid_rm_sm where partner_id = '".$partner_id."' and name = '".$sm_name_new."' and email = '".$sm_email_new."' and mobile = '".$sm_mobile_new."' and manager_type = 2 and city_id = $city_id order by id desc limit 1";
			
			$select_valid_sm_exe = mysqli_query($Conn1, $select_valid_sm);
			
			if(mysqli_num_rows($select_valid_sm_exe) > 0) {
				$select_valid_sm_res = mysqli_fetch_array($select_valid_sm_exe);
				if($select_valid_sm_res['like_dislike_flag'] == 1) {
					$like_flag_sm = " style='color: green'";
				} else if($select_valid_sm_res['like_dislike_flag'] == 2) {
					$dislike_flag_sm = " style='color: red'";
				}
			}
			
			$return_html .= "<tr class='center-align'><td>".$sr_no."</td><td>".$res_pat_name['partner_name']."</td><td class='like-dislike-td'><span class='rm-name'>".$rm_name."</span>";
			if($rm_name != "-" || $rm_email != "-" || $rm_mobile != "-") {
				$return_html .= "<span class='like-dislike-span'> <a href='javascript:void(0);' onclick='like_dislike_save(".$partner_id.", ".$contact_id.", ".$level_type.", ".$rm.", ".$like.", ".$loan_type_id.", ".$record_id.", ".$city_id.")'> <span id='".$contact_id."_".$rm."_".$like."_".$city_id."' title='Correct' ".$like_flag_rm."></span> </a> <a href='javascript:void(0);' onclick='like_dislike_save(".$partner_id.", ".$contact_id.", ".$level_type.", ".$rm.", ".$dislike.", ".$loan_type_id.", ".$record_id.", ".$city_id.")'>  <span id='".$contact_id."_".$rm."_".$dislike."_".$city_id."' title='Incorrect' ".$dislike_flag_rm."></span> </a> </span>";
			}

			$return_html .= "</td><td>".$rm_email."</td><td>".$rm_mobile."</td><td class='like-dislike-td'><span class='rm-name'>".$sm_name."</span>";
			if($sm_name != "-" || $sm_email != "-" || $sm_mobile != "-") {
				$return_html .= "<span class='like-dislike-span'> <a href='javascript:void(0);' onclick='like_dislike_save(".$partner_id.", ".$contact_id.", ".$level_type.", ".$sm.", ".$like.", ".$loan_type_id.", ".$record_id.", ".$city_id.")'> <span id='".$contact_id."_".$sm."_".$like."_".$city_id."' title='Correct' ".$like_flag_sm."></span> </a> <a href='javascript:void(0);' onclick='like_dislike_save(".$partner_id.", ".$contact_id.", ".$level_type.", ".$sm.", ".$dislike.", ".$loan_type_id.", ".$record_id.", ".$city_id.")'> <span id='".$contact_id."_".$sm."_".$dislike."_".$city_id."' title='Incorrect' ".$dislike_flag_sm."></span> </a> </span>";
			}
			
			$return_html .= "</td><td>".$sm_email."</td><td>".$sm_mobile."</td></tr>";
		}
		
	$return_html .= "</table>";
}
echo $return_html;
?>