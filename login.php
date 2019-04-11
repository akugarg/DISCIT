<?php
   SESSION_START();
   require 'info.php';
?>
<html>
<head>
<title>Login page</title>
<link rel="stylesheet" type="text/css" href="style2.css">
</head>
<body bgcolor=#3c40c6>
<br><br>
<div id="style2">
<br>
   <center>
     <h1>Login page</h1>
   </center>
   <img src="default.jpg" class="pic">
     <form class="myform" action="login.php" method="post">
     <label><b>Username:</b></label><br>
     <input name="username" type="text" class="val1" placeholder="Please enter your username."required/<br><!--adding required field-->
     <label><b>Password:</b></label><br>
     <input name="password" type="password" class="val1" placeholder="Please enter your password."required/><br>
     <a href="home.php"><input name="login" type="submit" id="btn1" value="Login"/></a><br>
	 <!--<a href=""><input name="login" type="submit" id="btn4" value="Forgot your password."/></a><br>-->
     <a href="signup.php"><input type="button" id="btn2" value="New user?Register here."></a><br>
     </form>
     <?php
	   if(!(isset($_SESSION['sign_in'])&&$_SESSION['sign_in']==true)) //To check whether user is already logged in 
	   {
	    if(isset($_POST['login']))  //Checking if login button is clicked
	    {
		   $username=mysqli_real_escape_string($info,$_POST['username']);   //to prevent from SQL Injection
		   $password=mysqli_real_escape_string($info,$_POST['password']);
		   $q1="SELECT * FROM user_info2 WHERE username='$username'";
		   $q1_try=mysqli_query($info,$q1);
		   if(mysqli_num_rows($q1_try)>0)
		   {
			   $data=mysqli_fetch_array($q1_try,MYSQLI_ASSOC);
			   if(password_verify($password,$data['password']))
			   {
			   //creating session variables.
			   $_SESSION['sign_in']=true;
               $_SESSION['username']=$username;
			   $_SESSION['userid']=$data['userid'];
			   $_SESSION['name']=$data['name'];
			   $_SESSION['imglk']=$data['imglk'];
			   header('location:home.php');
		       }
		   }
		   else
		   {
			 echo '<script type="text/javascript"> alert("INVALID DETAILS")</script>';   
		   }
	    } 
	   }
	   
	    else{
			echo '<script type="text/javascript"> alert("YOU ARE ALREADY LOGGED IN")</script>'; 
            echo "<script> location.href='home.php'; </script>";  // if user already logged in then direct to home page.
	   }
	 ?>	 
   