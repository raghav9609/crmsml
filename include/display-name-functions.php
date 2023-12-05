<?php 
// if(!function_exists('get_display_name')){
function get_display_name($type,$selected_val){
	global $Conn1;
    switch ($type) {
    	case "occupation":
    	    $qry = "select occupation_name from lms_occupation where occupation_id = '".$selected_val."'";
        break;
        case "city_name":
            $qry = "select city_name from lms_city where city_id = '".$selected_val."'";
        break;
    	case "city_sub_group_name":
            $qry = "select grp.city_sub_group_name as city_sub_group_name from lms_city as city left join lms_city_sub_group as grp on city.city_sub_group_id = grp.city_sub_group_id where city.city_id = '".$selected_val."'";
        break; 
		case "credit_score":
			$qry = "SELECT YBLCR.app_id AS APP_ID, yblcs.Score AS SCORE as Score from ybl_credit_report as YBLCR 
                        LEFT JOIN ybl_credit_score as YBLCS ON YBLCR.report_id = YBLCS.report_id where YBLCR.app_id = '".$selected_val."'";
		break;
        case "comp_id":
           $qry = "select id as comp_id from crm_master_company where company_name = '".$selected_val."'";
        break;
         case "sub_employer":
           $qry = "select sub_employer from tbl_sub_employer where id = '".$selected_val."'";
        break;
    	case "comp_name":
           $qry = "select comp_name from pl_company where comp_id = '".$selected_val."'";
        break;
        case "city":
            $qry = "select city_id from lms_city where city_name = '".trim($selected_val)."'";
        break;
        case "loan_type":
            $qry = "select loan_type_name from lms_loan_type where loan_type_id = '".$selected_val."'";
        break;
    	case "mlc_product_id":
            $qry = "select mlc_product_id from lms_loan_type where loan_type_id = '".$selected_val."'";
        break;
        case "bank_name":
            $qry = "select bank_name from tbl_bank where bank_id = '".$selected_val."'";
        break;
        case "bank_name_mul":
            $qry = "select group_concat(bank_name separator '| ') from tbl_bank where bank_id IN (".$selected_val.")";
        break;
        case "mlc_product":
            $qry = "select product_name from tbl_mlc_products where product_id = '".$selected_val."'";
        break;
        case "bank_id":
            $qry = "select bank_id from tbl_bank where bank_name = '".$selected_val."'";
        break;
    	case "asset_type":
            $qry = "Select asset_name from tbl_asset_type where asset_id = '".$selected_val."'";
        break;
    	case "loan_nature":
            $qry = "Select loan_nature_name from tbl_loan_nature where loan_nature_id = '".$selected_val."'";
        break;
    	case "annual_turnover":
            $qry = "Select bus_anl_name from tbl_bussiness_anl_trunover where bus_anl_id = '".$selected_val."'";
        break;
    	case "nature_of_business":
            $qry = "Select bus_nature_name from tbl_bussiness_nature where bus_nature_id = '".$selected_val."'";
        break;
    	case "business_existing":
            $qry = "Select bus_ext_year_name from tbl_bussiness_extng_year where bus_ext_year_id = '".$selected_val."'";
        break;
    	case "ITR_available":
            $qry = "Select bus_itr_aval_name from tbl_bussiness_itr_aval where bus_itr_aval_id = '".$selected_val."'";
        break;
		case "city_pin_code":
            $qry = "Select city_id from lms_pincode where pin_code = '".$selected_val."'";
        break;
    	case "type_of_registration":
            $qry = "Select bus_reg_type_name from tbl_bussiness_reg_type where bus_reg_type_id = '".$selected_val."'";
        break;
        case "credit_card_list":
            $qry = "SELECT card_name FROM credit_cards_name where card_id = '".$selected_val."'";
        break;
        case "card_price_list":
            $qry = "SELECT pricing_code FROM credit_cards_pricing_mapping where price_id = '".$selected_val."'";
        break;
    	case "security_available":
            $qry = "Select bus_security_name from tbl_bussiness_security where bus_security_id = '".$selected_val."'";
        break;
    	case "country_of_study":
            $qry = "Select loc_name from edu_course_loc where loc_id = '".$selected_val."'";
        break;
    	case "course_of_study":
            $qry = "Select course_name from edu_courses where course_id= '".$selected_val."'";
        break;
        case "degree":
            $qry = "Select degree from edu_degree where degree_id = '".$selected_val."'";
        break;
    	case "car":
            $qry = "select car_name from tbl_car where id= '".$selected_val."'";
        break;
        case "car_model":
            $qry = "select model_name from tbl_car_model where id = '".$selected_val."'";
        break;
        case "profession":
            $qry = "select profession_name from lms_profession where profession_id = '".$selected_val."'";
        break;
        case "follow_up_type":
            $qry = "select follow_status from tbl_follow_status where follow_id = '".$selected_val."'";
        break;
        case "partner_list":
            $qry = "select partner_name from tbl_mlc_partner where partner_id = '".$selected_val."'";
        break;
    	case "prop_type":
    	   $qry = "Select prop_type from tbl_property_type where prop_id = '".$selected_val."'";
        break;
    	case "prop_sale_type":
            $qry = "Select property_type_name from lms_property_type where property_type_id = '".$selected_val."'";
        break;
    	case "budget":
           $qry = "Select budget_slab from lms_property_budget_slab where slab_id = '".$selected_val."'";
        break;
    	case "prop_location":
            $qry = "Select loc_type from lms_property_location where loc_id= '".$selected_val."'";
        break;
    	case "state":
            $qry = "Select state_name from ifsc_state where state_id = '".$selected_val."'";
        break;
        case "central_police":
            $qry = "Select description from tbl_central_police_force_list where id = '".$selected_val."'";
        break;
    	case "query_status":
           $qry = "Select qy_status from tbl_query_status where qy_status_id = '".$selected_val."'";
        break;
        case "case_status":
            $qry = "Select case_status from tbl_case_status where cse_status_id = '".$selected_val."'";
        break;
        case "pre_login":
            $qry = "select pre_status_name from tbl_app_pre_login  where pre_status_id = '".$selected_val."'";
        break;
        case "post_login":
            $qry = "select app_status from tbl_app_status  where app_status_id = '".$selected_val."'";
        break;
        case "new_status_name":
            $qry = "SELECT CONCAT_WS(' - ',main_status.description,sub_status.description,sub_sub_status.description) as case_status FROM status_master as sub_sub_status LEFT JOIN status_master as sub_status ON sub_sub_status.parent_id = sub_status.status_id LEFT JOIN status_master as main_status ON sub_status.parent_id = main_status.status_id where sub_sub_status.status_id = ".$selected_val." LIMIT 1";
        break;
         case "snew_status_name":
            $qry = "SELECT description FROM status_master where status_id = ".$selected_val." LIMIT 1";
        break;
    	case "salary_method":
            $qry = "Select paid_type from tbl_salary_py_method where paid_id = '".$selected_val."'";
        break;
    	case "salutation":
            $qry = "select salutn_name from tbl_saluation where salutn_id = '".$selected_val."'";
        break;
        case "residential_type":
            $qry = "select residential_name from tbl_residential_type where rented_id = '".$selected_val."'";
        break;
    	case "tool_type":
            $qry = "select tool_type_name from lms_tool_type   where tool_type_name = '".$selected_val."'";
        break;
        case "sml_user_name":
            $qry = "select user_name from tbl_user_assign where user_id = '".$selected_val."'";
        break;
        case "app_pat_list":
        	$qry = "select partner_name from tbl_mlc_partner where partner_id = '".$selected_val."'";
        break;
        case "rate_type":
            $qry = "Select rate_character_name from tbl_rate_character where rate_character_id = '".$selected_val."'";
        break;  
        case "type_of_company":
            $qry = "Select cat_name from tbl_company_categorization where cat_id = '".$selected_val."'";
        break; 
        case "city_sub_group":
            $qry = "select city_sub_group_name from lms_city_sub_group where city_sub_group_id = '".$selected_val."'";
        break; 
    	case "city_sub_group_id":
            $qry = "select city_sub_group_id from lms_city where city_id = '".$selected_val."'";
        break; 
        case "description":
            $qry = "select descc from tbl_mint_case_detail where case_id = '".$selected_val."'";
        break; 
        case "branch_name":
            $qry = "select branch_name from  ifsc_code where id ='".$selected_val."'";
        break; 
    	case "customer_id";
    		$qry = "select id from crm_customer where phone_no = '".$selected_val."'";
    	break;
    	case "cashback";
    		$qry = "select cback_amt from tbl_refer_cashback where loan_type = '".$selected_val."'";
    	break;
    	case "referer_partner_id";
    		$qry = "select partner_id from tbl_mint_partner_info where phone = '".$selected_val."'";
    	break;
    	case "bil_type_id";
    		$qry = "select id from tbl_bil_type where bil_type = '".$selected_val."'";
    	break;
    	case "api_status";
    		$qry = "select api_active_flag from tbl_mlc_partner where partner_id = '".$selected_val."'";
    	break;
		case "industry_type_name";
			$qry = "select industry_name from tbl_industry_type where industry_id ='".$selected_val."'";
		break;
		case "sml_user_id":
            $qry = "select user_id from tbl_user_assign where user_name = '".$selected_val."'";
        break;
        case "query_status_display":
            $qry = "Select display_status from tbl_query_status where qy_status_id = '".$selected_val."'";
            break;
        case "case_status_display":
            $qry = "Select case_description from tbl_case_status where cse_status_id = '".$selected_val."'";
            break;
        case "pre_login_display":
             $qry = "select pre_login_display from tbl_app_pre_login  where pre_status_id = '".$selected_val."'";
             break;
        case "post_login_display":
            $qry = "select post_login_display from tbl_app_status  where app_status_id = '".$selected_val."'";
            break;
        case "institute_id":
            $qry = "select institute_id from generic_institute where institute_name = '".$selected_val."'";
        break;

    }
	$result_qry = mysqli_query($Conn1,$qry);
	$row = mysqli_fetch_row($result_qry);
	return $row[0];
}
// }
?>