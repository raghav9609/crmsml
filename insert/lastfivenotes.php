<?php
require_once "../../include/config.php";
require_once "../../include/helper.functions.php";
require_once "../../include/check-session.php";

$selectnote="select * from sticky_note where user_id=$user order by id desc limit 5";
$resultnote = mysqli_query($Conn1, $selectnote) or die(mysqli_error($Conn1));
$i=1;
while($rownote = mysqli_fetch_array($resultnote)){

$lastfivenote.="<div class='notes-text'><span> Remarks  ".$i++. " : </span><span>".$rownote['remarks']."</span></div>";
//echo "<div class='label-text'>Queryid-".$rownote['level_id']."->Remarks---".$rownote['remarks']."</div>";
 } 
 echo $lastfivenote;
 ?>