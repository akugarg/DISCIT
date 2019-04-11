<?php
  SESSION_START();
  require 'info.php';
?>
<html>
<head>
<center>
<title>Signup page</title>
<meta charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style2.css">
<script type="text/javascript">
   <!--Original code for this javascript function(format) taken from stackoverflow-->
    function PrevImage()
	{
		var oFReader=new FileReader();
		oFReader.readAsDataURL(document.getElementById("imglk").files[0]);
		
		oFReader.onload=function(oFREvent)
		{
			document.getElementById("uploadPreview").src=oFREvent.target.result;
		};
		
	};
	</script>
    </center>
    </head>
    <body bgcolor=#ff7675>
    <br><br>
    <form class="myform" action="signup.php" method="post" enctype="multipart/form-data" >
    <div id="style2">
    <br>
    <center>
   <h1>Registration page</h1>
   </center>
     <img id="uploadPreview" src="default.jpg" class="pic"><br>
     <center><input type="file" id="imglk" name="imglk" accept=".jpg,.jpeg,.png" onchange="PrevImage();"/></center><!--to accept image in given format-->
	 <br>
	<center>
	<label><b>Full name:</b></label><br>
    <input name="name" type="text" class="val1" placeholder="Please enter your name."required/><br>
	<label><b>Email Id:</b></label><br>
    <input name="email" type="email" class="val1" placeholder="Please enter your email id."required/><br>
    <label><b>Username:</b></label><br>
    <input name="username" type="text" class="val1" placeholder="Please enter your username."required/><br>
    <label><b>Password:</b></label><br>
    <input name="pass1" type="password" class="val1" placeholder="Your password."required/><br>
    <label><b>Confirm Password:</b></label><br>
    <input name="pass2" type="password" class="val1" placeholder="Renter your password."required/><br>
    <a href="signup.php"><input name="submit_btn" type="submit" id="btn1" value="Submit"/></a><br>
    <a href="login.php"><input type="button" id="btn3" value="Back to Login"></a><br>
	 </center>
	 <br>
     </form> 
	 <?php
	  if(!(isset($_SESSION['sign_in'])&&$_SESSION['sign_in']==true)){
      if(isset($_POST['submit_btn']))
	  {
	  $email=$_POST['email'];
	  $name=$_POST['name'];
	  $username=$_POST['username'];
	  $password=$_POST['pass1'];
	  $confirm=$_POST['pass2'];
	  
	  $img_name=$_FILES['imglk']['name'];      //predefined in php
	  $img_size=$_FILES['imglk']['size'];      
      $img_tmp=$_FILES['imglk']['tmp_name'];   //temporary name to upload image
	  
	  $direct='upload/';
	  $target_file=$direct.$img_name;  //final location
	  
	  if($password==$confirm)	 
	  {
		 $q1="SELECT * FROM user_info2 WHERE username='$username'";
		 $q1_try=mysqli_query($info,$q1);
		 if(mysqli_num_rows($q1_try)>0)
		 {
			 echo '<script type="text/javascript"> alert("user already exists,try another")</script>';
		 }
		 else if($img_size>2097152)
		 {
			  echo '<script type="text/javascript"> alert("Image file size greater than 2mb....Choose another file ")</script>';
		 }
		 else
		 {
	      move_uploaded_file($img_tmp,$target_file);      //to transfer the given file into the folder
		  $hash=password_hash($password,PASSWORD_BCRYPT); //hashing the passwords using PASSWORD_BYCRYPT alogarithm
		  $q2= "INSERT INTO user_info2(userid,username,password,name,email,img) VALUES(Null,'$username','$hash','$name','$email','$target_file')";
		  $q2_try=mysqli_query($info,$q2);
		 
		 if($q2_try)
		 {
		 echo '<script type="text/javascript"> alert("User registered...Go to login page")</script>';
		 }
		 else
		 {
		    echo '<script type="text/javascript"> alert("ERROR")</script>';
		 }
	  }}
	  else
	  {
      echo '<script type="text/javascript"> alert("Passwords entered does not match")</script>';
	  }}
	  }
	  else
	  {
		  echo '<script type="text/javascript"> alert("YOU ARE ALREADY LOGGED IN")</script>';  
		  echo "<script> location.href='home.php'; </script>";
	  }	  
?>
   </div>
</body>

</html>