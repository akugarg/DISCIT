<?php
   SESSION_START();
   require 'info.php';
?>

<html>
<head>
 <meta charset="UTF-8">
 <meta name="description" content="DISCIT - Discussion Forum">
 <meta name="keywords" content="IITK, DISCIT">
 <meta name="viewport" content="width=device-width initial-scale=1.0">
 <title>DISCIT: Reply</title>
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
      if($_SESSION['sign_in'])
	  {
		  echo '<p class="navbar-text">WELCOME&nbsp&nbsp'.$_SESSION['name'].'</p>
               <ul class="nav navbar-nav">
                <li><a href="leaderboard.php">LEADER BOARD</a></li>
				<li><a href="profile.php">VIEW PROFILE</a></li>
				<li><a href="search.php">SEARCH</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> LOG OUT</a></li>
                </ul>';
   ?>
</div>
</nav>
<?php

    $sql="INSERT INTO posts(post_op,post_content,post_author,post_date) VALUES('".mysqli_real_escape_string($info, $_POST['id'])."','"
                                                                               .mysqli_real_escape_string($info, $_POST['post_content'])."','"
                                                                               .$_SESSION['userid']."',NOW())";

    $result=mysqli_query($info,$sql);
    if(!$result)
	{
      echo 'Sorry, your reply could not be saved. Please try again later.';
    }
    else
	{ 
      echo 'Your reply has been successfully saved.';
    }
    echo '<p><br><br><button type="button"><a href="op.php?id='.$_POST['id'].'">BACK</a></button></p>';
   }
	  else
	  {		  
	   echo '<script type="text/javascript"> alert("YOU ARE NOT LOGGED IN...PLEASE FIRST LOGIN.")</script>'; 
       echo "<script> location.href='login.php'; </script>";	   
      }
?>

</body>
</html>