<?php
   SESSION_START();
   require 'info.php';
?>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand">DISCIT</a>
    </div>

  <?php
      //Checking if user signed in
      if($_SESSION['sign_in']){
		  echo '<p class="navbar-text">WELCOME&nbsp&nbsp'.$_SESSION['name'].'</p>
               <ul class="nav navbar-nav">
                <li><a href="leaderboard.php">LEADER BOARD</a></li>
				<li><a href="profile.php">VIEW PROFILE</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
				<li><a href="home.php">HOME</a></li>
                <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> LOG OUT</a></li></ul>';}
	  else
	  {		  
	   echo '<script type="text/javascript"> alert("YOU ARE NOT LOGGED IN...PLEASE FIRST LOGIN.")</script>';   
      }
   ?>
   </div>
   </nav>
        <p><h1 style="text-align: center; color: #8B4513; font-family: Comic Sans MS;"><b>SELECT CLASS</b></h1></p>
		
		<!-- Styling for all buttons-->
		
        <div class="media">
		<div class="media-left">
		<img src="ESC101.jpg" class="media-object" style="width:80px; height:60px;">
		</div>
		<div class="media-body" >
		<a href="ESC101.php"><input type="button" class="btn btn-primary btn-lg btn-block" value="ESC101"></a>
		</div>
		</div>
		
		<div class="media">
		<div class="media-left">
		<img src="PHY103.jpg" class="media-object" style="width:80px; height:60px;">
		</div>
		<div class="media-body" >
		<a href="PHY103.php"><input type="button" class="btn btn-primary btn-lg btn-block" value="PHY103"></a>
		</div>
		</div>
		
		<div class="media">
		<div class="media-left">
		<img src="PHY102.jpg" class="media-object" style="width:80px; height:60px;">
		</div>
		<div class="media-body" >
		<a href="PHY102.php"><input type="button" class="btn btn-primary btn-lg btn-block" value="PHY102"></a>
		</div>
		</div>
		
		<div class="media">
		<div class="media-left">
		<img src="LIF101.jpg" class="media-object" style="width:80px; height:60px;">
		</div>
		<div class="media-body" >
		<a href="LIF101.php"><input type="button" class="btn btn-primary btn-lg btn-block" value="LIF101"></a>
		</div>
		</div>
		
		<div class="media">
		<div class="media-left">
		<img src="TA101.jpg" class="media-object" style="width:80px; height:60px;">
		</div>
		<div class="media-body" >
		<a href="TA101.php"><input type="button" class="btn btn-primary btn-lg btn-block" value="TA101"></a>
		</div>
		</div>
		
		<div class="media">
		<div class="media-left">
		<img src="MTH101.jpg" class="media-object" style="width:80px; height:60px;">
		</div>
		<div class="media-body" >
		<a href="MTH101.php"><input type="button" class="btn btn-primary btn-lg btn-block" value="MTH101"></a>
		</div>
		</div>
		
		<div class="media">
		<div class="media-left">
		<img src="MTH102.jpg" class="media-object" style="width:80px; height:60px;">
		</div>
		<div class="media-body" >
		<a href="MTH102.php"><input type="button" class="btn btn-primary btn-lg btn-block" value="MTH102"></a>
		</div>
		</div>
</body>
</html>
