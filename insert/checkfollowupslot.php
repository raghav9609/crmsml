<?php
require_once "../../include/check-session.php";
require_once "../../include/config.php";
$followupdate=$_POST['followupdate'];
$today=date('Y-m-d');

//print_r($_SESSION);
if($today==$followupdate){
    $fcount=$_SESSION['followup_slots_count_today'];
}
else{
    $fcount=  $_SESSION['followup_slots_count'];
}
 $query="SELECT count(follow_id),follow_time FROM tbl_mint_case_followup 
where date(follow_date)='".$followupdate."'  and mlc_user_id=$user 
group by follow_time having count(follow_id)>=".$fcount."
  ";
  $query_rec = mysqli_query($Conn1,$query);
  while($row=mysqli_fetch_array($query_rec))
  {
    $key=$row['follow_time'];
    $endTime = strtotime("+1 minutes", strtotime($key));
    $stTime = strtotime("+0 minutes", strtotime($key));
    $start=date('h:i a', $stTime);
    $time=date('h:i a', $endTime);    
    $arr[]= [$start,$time];
   
  }
  if(count($arr)>0){
    echo json_encode($arr);
  }
 else{
    echo json_encode([]);
 }
  exit;
?>