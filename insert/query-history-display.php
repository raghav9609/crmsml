<?php 
if ($dob == "0000-00-00"){$dob_age = 0; }else{$dob_age = date_diff(date_create($dob), date_create('today'))->y." Years";}
$hist_adrs_prof = mysqli_query($Conn1,"Select * from tbl_address_proof where proof_id IN (".implode(',',$addrs_proof).")");
               while($res_adrs_proof_hist = mysqli_fetch_assoc($hist_adrs_prof)){
               $proof_name_hist[] = $res_adrs_proof_hist['proof_name'];
               
}
$min_rt_qry = mysqli_query($Conn1,"Select rate from lms_rates where occupation_id ='1' and loan_type_id ='56'");
            $res_min_rt = mysqli_fetch_array($min_rt_qry);
               $min_rate = $res_min_rt['rate'];
               
$max_tenure_qry = mysqli_query($Conn1,"Select max(tenure_max) as tenure_max from tbl_pl_bank_min_max_new where occup_id = '1'");
               $res_max_tenure = mysqli_fetch_assoc($max_tenure_qry);
               $max_tenure = $res_max_tenure['tenure_max'];

    $yer_formula = $max_tenure;
     $intt_formula = $min_rate / (12 * 100);
    $emi_sem_formula = ($loan_amt * $intt_formula * pow((1 + $intt_formula), $yer_formula)) / (pow((1 + $intt_formula), $yer_formula) - 1);
   $emi_final_formula = round($emi_sem_formula * 100) / 100;    

$foir = round((($total_obligations*100)/$net_incm),2);
$foir_new = round(((($total_obligations+$emi_final_formula)*100)/$net_incm),2);

?>
<style>
 .li_class {
  display: block;
}

.accordion {
  width: 0px;
  margin: 0 auto;
}

.accordion .accordion-item {
  background: #2767ba;
   color: #fff5ed;
  display: block;
  height: 30px;
  font-size: 18px;
  text-align: left;
  padding-left: 15px;
  box-shadow: 0px 5px 5px 0px #c0c0c0;
  margin-bottom: 1.5px;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  display: -webkit-flex;
  -webkit-box-align: center;
  -ms-flex-align: center;
  align-items: center;
  -webkit-align-items: center;
}

.accordion .inner {
  display: none;
  background: #f1f6f6;
  padding-left: 0px;
  text-align: left;
  padding-top: 0px;
  padding-bottom: 7px;
  box-shadow: 0px 5px 5px 0px #c0c0c0;
  margin-bottom: 1.5px;
}

.accordion .accordion-arrow {
  position: absolute;
  width: 0;
  height: 0;
  border-left: 6px solid transparent;
  border-right: 6px solid transparent;
  margin-left: 330px;
  margin-top: 3px;
}

.accordion .accordion-down {
  border-top: 6px solid #eb9b42;
}

.accordion .accordion-up {
  border-bottom: 6px solid #eb9b42;
}
 
 .hist_tbl{
width:100%;
 }
.hist_tbl td {
font-size: 13px;
border: 0.1em solid;				/* resetted to a default of 0.1em width */		
width: 10em;					
padding: 6px;
background-color: #eeefee; 		}	/* added data cell background color (light green) */


.hist_tbl th {	
border: 0.1em solid;				/* resetted to a default of 0.1em width */
text-align: center;
padding: 0px;
width: 10em;
background-color: #eb9b42; 
color: #fff5ed;
    
}
.hist_tbl tr {
    height: 0px !important;
}
</style>
<ul class="accordion" style='margin-left: -10%; margin-right: 5%;'>
  <li class="li_class">
    <a class="accordion-item" href="javascript:void(0);">Customer, Requirement 
				<div class="accordion-arrow accordion-down"> </div>
			    </a>
    <div class="inner">
        <table class="hist_tbl">
            <tr><th>Query Details</th></tr>
            <tr><td>&#9679; <?php echo $name.' '.$mname.' '.$lname;?> / <?php echo $city_name;?>/ <?php echo 'DOB:'.$dob.'/ Age: '.$dob_age;?> </td></tr>
		<tr><td> &#9679; <?php echo 'Rs.'.number_format($loan_amt).' / '.$loantype_name.' / '.get_display_name("loan_nature",$loan_nature);?></td></tr>
        <tr><td style="color:#bb6215;"> &#9758; Note that this amount is <?php echo number_format($loan_amt/$net_incm);?> x times of cmr’s salary.</td></tr>
        </table>
     <p></p>
    </div>
  </li>

  <li class="li_class">
    <a class="accordion-item" href="javascript:void(0);">Occupation
				<div class="accordion-arrow accordion-down"></div>
			    </a>

    <div class="inner">
              <table class="hist_tbl">
            <tr><th>Query Details</th></tr>
            <tr><td>&#9679; <?php echo get_display_name("occupation",$occup);?> @  <?php echo $comp_name; ?> / NTH <?php echo 'Rs.' .number_format($net_incm);?> </td></tr>
           <tr><td>&#9679; <?php if ($salary_pay_id > 0 ) { ?> Salary by <?php if ($salary_pay_id == 1){ echo "Transfer to ".get_display_name("bank_name",$main_account);} else{ echo get_display_name("salary_method",$salary_pay_id);}}else { echo "Please Check mode of Salary";}?></td></tr>
           <tr><td>&#9679; Total Exp - <?php echo $twe.' Months / Current Exp - '.$ccwe.' Months';?></td></tr>
		
        </table>
        <table class="hist_tbl">
            <tr><th>Suggestions</th></tr>
            <tr><td style="color:#bb6215;"><?php if($salary_pay_id == '3' || $employer_type == '56473'){echo "&#9758; No banks offer loans for cash salary/ Prop/ Partnership";}
            if($salary_pay_id == '2' && $employer_type != '56473'){ echo "&#9758; Indus, RBL Bank, Fullerton offer loans for chq salary";}
            if ($employer_type == '56470' && $salary_pay_id != '3'){echo "<br/>&#9758; Options are HDFC Bank, ICICI Bank (if sal acc holder), IDFC Bank (commissioned officers only).";}
            if ($employer_type == '38665' || $employer_type == '56472'){echo '<br/>&#9758; for those not getting salary slip like teachers, offer  Capital First/IIFL/HDB (Salary certificate is mandatory in all of the 3 banks) <br/>';if($twe < 12 && $twe > 0){echo 'HDFC Bank for Cat A and above.';}
        else if ($twe >=12 and $twe < 36){echo "HDFC Bank, ICICI Bank (except open mkt), IIFL,  Yes Bank, Tata (except Cat C and open mkt), HDB, IDFC, Capital First";}
        else if ($twe >= 36){echo "All";}else {echo '<table class="hist_tbl">
            <tr><th><12 months</th><th>1 – 3 years</th><th>3 years and above</th></tr>
        <tr><td>&#9758; HDFC Bank for Cat A and above.</td><td>HDFC Bank, ICICI Bank (except open mkt), IIFL,  Yes Bank, Tata (except Cat C and open mkt), HDB, IDFC, Capital First</td>
        <td>All</td></tr></table>';}}else{ echo "";}?>
            </td></tr>
		<tr><td style="color:#bb6215;" ><?php if($employer_type == '56473'){echo "&#9758; Offer Fullerton in case of own/family owned house in same city, NTH>=25K, CWE- 2 Years";} ?>
		<?php if ($employer_type == '38665' || $employer_type == '56472'){echo '&#9758; Can offer Fullerton if NTH>=25k even to Class IV employees,  except housekeeping staff';}?>
		<?php if ($employer_type == '56470'){echo '&#9758; Can offer Fullerton if NTH>=30k';}?></td></tr>
		<tr><td style="color:#bb6215;"><?php if ($ccwe < 12){echo "HDB (Cat A, B, C), Capital First (3 months current exp), IIFL (6 month current experience if Cat A, Super A)";} ?></td></tr>
        </table>
    </div>
  </li>

  <li class="li_class">
    <a class="accordion-item" href="javascript:void(0);">Residential Type/ Address Proof
				<div class="accordion-arrow accordion-down"></div>
			    </a>
    <div class="inner">
                    <table class="hist_tbl">
            <tr><th>Query Details</th></tr>
        <tr><td><?php if ($rented_id > 0){ echo "&#9679; ".get_display_name("residential_type",$rented_id); if(!empty($proof_name_hist)){echo '<br/>('.implode(', ', $proof_name_hist).')';}} 
        else { echo "&#9758; Check Residential Type";}?></td></tr>
        </table>
 <table class="hist_tbl">
            <tr><th>Suggestions</th></tr>
        <tr><td style="color:#bb6215;"><?php if($rented_id =='4'){echo "&#9758; IDFC, IIFL, ICICI Insta, Capital First if NTH> 60K, HDB- guarantor’s KYC is reqd";}
        else if($rented_id =='6'){echo "&#9758; All options available. Bajaj available if NTH >50 K, HDB if having clean unsecured loan track of 12 months min";}
        else if($rented_id =='1' || $rented_id =='3' || $rented_id =='5'){ echo "&#9758; All banks available";}
        else if ($rented_id =='2'){echo "&#9758; All banks available <br/> HDB- co applicant is reqd if cibil is 0/-1
Non financial co applicant if having cibil history
";}else{ echo '<table class="hist_tbl">
            <tr><th>Resi Type</th><th>Bank Options</th></tr>
        <tr><td>PG</td><td>IDFC, IIFL, ICICI Insta, Capital First if NTH> 60K, HDB- guarantor’s KYC is reqd</td></tr>
        <tr><td>With Friends/ Bachelor Acco</td><td>All options available. Bajaj available if NTH >50 K, , HDB if having clean unsecured loan track of 12 months min</td></tr>
        <tr><td>Self Owned </td><td>All banks available</td></tr>
        <tr><td>Owned by Family/ Spouse</td><td>All banks available <br/>HDB- co applicant is reqd if cibil is 0/-1
Non financial co applicant if having cibil history
</td></tr>
        <tr><td>Rented with Family</td><td>All banks available</td></tr>
        </table>';} ?></td></tr>
        </table>
    </div>
  </li>
  <li class="li_class">
    <a class="accordion-item" href="javascript:void(0);">Existing Loans & Credit Cards
				<div class="accordion-arrow accordion-down"></div>
			    </a>
    <div class="inner">
        <table class="hist_tbl">
            <tr><th>Query Details</th></tr>
            <tr><td>&#9679; Total Obligation: <?php echo $total_obligations; ?><br/>
           &#9679; Current FOIR: <?php echo $foir; ?>%<br/>
           <span style="color:#bb6215;"> &#9758; FOIR with new loan: <?php if($loan_nature ==2){ echo $foir. '%';} else { echo $foir_new."% @ ". $min_rate."% for ".$max_tenure." months";}?> <br/>
            <?php if($lform_flag == 1){ if($exis_loans == 0 && $credit_running ==0 ){echo "&#9758; CIBIL – 1 case";}} else {echo "&#9758; Check Existing Loans and Credit Cards";}?> </span></td></tr>
		
        </table>
<table class="hist_tbl">
            <tr><th>Suggestions</th></tr>
        <tr><td style="color:#bb6215;">&#9758; <?php if($foir_new <= 50){ echo 'FOIR is less than 50% - all banks available; prefer Tier 1 banks like HDFC, ICICI, Yes, Bajaj, Citi, IDFC';
            
        }else if($foir_new > 50){echo "FOIR is high. Overleveraged profile. Prefer NBFC’s like Capital First (Upto 70% FOIR), IIFL, HDB (Upto 70% FOIR).";}else { echo "";}
         ?><br/>&#9758; Check DPD’s/ pull Experian<br/>&#9758; Actual DBR may be higher if cmr holds cardit card. You need to add 5% of 
         outstanding amount (and not credit card limit) as obligation to calculate DBR.<br/>
         <?php if($lform_flag == 1 && $exis_loans == 0 && $credit_running ==0 ){echo "&#9758; CIBIL – 1 case: options are Capital First, Bajaj (only in Tier 3 locations), 
         ICICI Bank, HDFC Bank, HDB, IDFC Bank (company shdl be listed, max loan amt  Rs 3 lakh) Yes Bank (only if NTH >35K) 
         and IndusInd (only if NTH >30K, own house and Cat A/ B, max loan amt 3 lakh), Tata Capital (Avg Bank Balance needed, 
         Age shld be <25 years, company shld be listed), IIFL (NTH req is min 35k + own house in case of listed co) , and in case of non listed NTH req  is 50K) .";}?></td></tr>
        </table>

    </div>
     <?php if($query_history > 0){ ?> <li class="li_class">
  </li>
    <a class="accordion-item" href="javascript:void(0);">Repeat Customer
				<div class="accordion-arrow accordion-down"> </div>
			    </a>
    <div class="inner">
        <table class="hist_tbl">
            <tr><td><b>&#9679; Past Query</b>: <?php echo implode(', ',$query_count_arr); ?></td></tr>
             <tr><td><?php if (mysqli_num_rows($query_sts_result) > 0 || mysqli_num_rows($case_sts_result) > 0 || mysqli_num_rows($app_sts_result) > 0){?> <b style="color:red">&#9679; Not Eligible: <?php echo implode('/',$query_sts_arr)." ".implode('/',$case_sts_arr)." ".implode('/',$app_sts_arr); }?></b>
             <?php if (mysqli_num_rows($query_last_result) > 0){?><br/>&#9679; Last Query: <?php echo '<a href="'.$head_url.'/query/edit.php?id='.urlencode(base64_encode($query_last_id)).'">'.$query_last_id.'</a>('.$query_last_user_name.'/'.$query_last_date.')/'.get_display_name("loan_type",$loan_type);}?>
            <?php if (mysqli_num_rows($case_last_result) > 0){?><br/>&#9679; Last Case: <?php echo '<a href="'.$head_url.'/sugar/cases/edit.php?case_id='.urlencode(base64_encode($case_last_id)).'">'.$case_last_id.'</a>('.$case_last_user_name.'/'.$case_last_date.')/'.get_display_name("loan_type",$loan_type);}?> </td></tr>
        </table>
     <p></p>
    </div>
  </li>
 <?php } ?>
</ul>

<script>
$('.accordion-item').click(function(e) {
  e.preventDefault();
  var $this = $(this);
  var $arrow = $('.accordion-arrow');
  var $current = $(this).find(".accordion-arrow");
  $arrow.not($current).removeClass("accordion-up").addClass("accordion-down");
  $current.toggleClass("accordion-up accordion-down");
  if ($this.next().hasClass('show')) {
  } else {
    $this.parent().parent().find('li .inner').removeClass('show');
    $this.next().slideToggle(350);
  }
}).eq(0).click();
</script>