<?php
  SESSION_START();
  require 'info.php';
  if(isset($_POST["email"]) && isset($_POST["email"]))
  {
	  $email=mysqli_real_escape_string($info,$_POST["email"]);
	  $token=mysqli_real_escape_string($info,$_POST["token"]);
	  $q1="SELECT userid FROM user_info2 WHERE email='$email' AND token='$token'";
	  q1_try=mysqli_query($info,$q1);
	  if(mysqli_num_rows($q1_try)>0)
	  {
		  $str="qwertyuiop";
		  $str-str_shuffle($str);
		  $str=substr($str,0,10);
		  $password=sha1($str);
		  $q2="UPDATE user_info2 SET password='$password' token='' WHERE email='$email'";
	  }
	  else
	  {
	  echo '<script type="text/javascript"> alert("PLEASE CHECK YOUR LINK.")</script>'; 
	  }
  }
  else
  {
	  header("Location: login.php");
	  exit();
  }
?>