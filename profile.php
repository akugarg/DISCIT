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
                <li class="active"><a href="leaderboard.php">LEADER BOARD</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
				<li><a href="home.php">HOME</a></li>
                <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> LOG OUT</a></li>
	           </ul>';
   ?>
   </div>
</nav>
   
	<?php
	$uname = $_SESSION['username'];
    $q2= "SELECT * FROM user_info2 WHERE username=\"".$uname."\";";
    $re = mysqli_query($info,$q2);
    $row=mysqli_fetch_array($re,MYSQLI_ASSOC);
	echo '<div class="container">';
	echo '<img class="img-circle" width="150" height="150" style="float:right;" src="'.$row['img'].'">';
    echo '<center><h2><b><i> AUTHOR - '.$row['name'].'</i></b></h2></center><br>';
	echo '<center><b> EMAIL ID - '.$row['email'].'</b></center><br>';
    $id = $_SESSION['userid'];
	$q1="SELECT * FROM op WHERE op_author = $id";
    $result=mysqli_query($info,$q1);
    if(mysqli_num_rows($result) > 0)
	  {
      while($row = mysqli_fetch_assoc($result))
	  {
      echo "<p><h3>SUBJECT-&nbsp &nbsp".$row['op_subject']."</h3><h4><i>POST-&nbsp &nbsp".$row['op_content']."</h4></i></p>";
      }
      }
     else
	 {
      echo "Nothing posted yet";
     }
	 }
	 else
	 {		  
	   echo '<script type="text/javascript"> alert("YOU ARE NOT LOGGED IN...PLEASE FIRST LOGIN.")</script>';   
	   echo "<script> location.href='login.php'; </script>";
     }
  ?>
</body>
</html>
	  