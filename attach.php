<?php
 ?>
<html>
 <head>
<title>Accepting file</title>
</head>
<body>
<form action="attach.php" method="POST" enctype="multipart/form-data">
<input type="file" name="file"><br><br>
<button type="submit" name="submit">Submit</button><br>
</form>
</body>
</html>
<?php
 require 'info.php';
 if(isset($_POST['submit']))
{
	$file=$_FILES['file'];
	$file_name=$_FILES['file']['name'];
	$file_temp=$_FILES['file']['tmp_name'];
    //$file_size=$_FILES['file']['size'];
	$file_type=$_FILES['file']['type'];
	
	$fileExt=explode('.',$file_name);
	$file_Actext=strtolower(end($fileExt));    //to store actual extension of file selected.
	$allowed=array('jpg','jpeg','png');        //allowed files to be uploaded
	if(in_array($file_Actext,$allowed))		   //checking whether given ext is allowed
	{   	    
		$direc='upload2/';
	    $target_file=$direc.$file_name;        //final location
	    move_uploaded_file($file_temp,$target_file);
		
		$q2= "INSERT INTO files(file_id,file) VALUES(Null,'$target_file')";
		$q2_try=mysqli_query($info,$q2);
		 
		/* $row=mysqli_fetch_array($q2_try,MYSQLI_ASSOC);
         echo '<b>'.$row['file'].'</b>';*/
	 
		 //header("Location: upload.php?uploadsuccess");
	}
	else
	{
		echo '<script type="text/javascript"> alert("YOU CANNOT UPLOAD FILES OF THIS TYPE.")</script>';  
	}
	
}
?>
											 										