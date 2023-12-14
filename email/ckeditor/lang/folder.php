<form action="" method="post">
<input type="text" name="t1"><input type="submit" name="sub">
</form>
<?php 
extract($_POST);
$dp=opendir($t1);
while($file=readdir($dp))
{
if($file!='.'&&$file!='..')
$file_name[]=$file;
}
foreach($file_name as $f)
{
echo $f."<br>";
}
?>