<?php
   SESSION_START();
   require 'info.php';
?>

<html>
<head>
 <meta charset="UTF-8">
 <meta name="description" content="DISCIT- Discussion Forum">
 <meta name="keywords" content="IITK, DISCIT">
 <meta name="viewport" content="width=device-width initial-scale=1.0">
 <title>DISCIT: NewPost</title>
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
	echo '<form method="post" action="">SUBJECT:'.'	'.'<select name="op_subject"><option value="ESC101">ESC101</option>
	                                                                             <option value="MTH101">MTH101</option>
																				 <option value="LIF101">LIF101</option>
																				 <option value="PHY102">PHY102</option>
																				 <option value="PHY103">PHY103</option>
																				 <option value="MTH102">MTH102</option>
																				 <option value="TA101">TA101</option></select>
                                        <br><br>
                                        NEW POST:'.'	'.'<textarea name="op_content"></textarea>
										<br><br>
	                                    <input name="submit" type="submit" value="Create new post">
	                                    </form>';
	   
         if(isset($_POST['submit']))
		 {
         $sql="INSERT INTO op(op_content,op_subject,op_author,op_date) VALUES('".mysqli_real_escape_string($info, $_POST['op_content'])."','"
                                                                              .mysqli_real_escape_string($info, $_POST['op_subject'])."','"
		                                                                      .$_SESSION['userid']."',NOW())";
         $result=mysqli_query($info,$sql);
         if(!$result)
		  {
           echo mysqli_error($info);
           echo 'An error occured while creating a new post. Please try again later.';
          }
         else
		  {
           echo 'A new post has been created successfully!';
          }
         }
	  }
      else{
	   echo '<script type="text/javascript"> alert("YOU ARE NOT LOGGED IN...PLEASE FIRST LOGIN.")</script>';  
       echo "<script> location.href='login.php'; </script>";	   
   }
?> 

<p><br><br><button type="button"><a href="home.php">BACK</a></button></p>
</body>
</html>



