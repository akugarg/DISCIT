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
  <title>DISCIT : SEARCH</title>
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
                <li ><a href="leaderboard.php">LEADER BOARD</a></li>
				<li><a href="profile.php">VIEW PROFILE</a></li>
                </ul>
				<form class="navbar-form navbar-left" method="post" action="search.php">
				<div class="input-group">
				<input type="text"  placeholder="search" name="q1">
				<div class="input-group-btn">
				<button class="btn btn-default" type="submit" name="submit">
				<i class="glyphicon glyphicon-search"></i>
				</button></div></div></form>
                <ul class="nav navbar-nav navbar-right">
                <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> LOG OUT</a></li>
                </ul>';
   ?>
   </div>
</nav>

  <?php
      if(isset($_POST['submit']))
	  {
      $query = $_POST['q1'];
      $min_length = 6;

      if(strlen($query) >= $min_length)
	  {
          $query = htmlspecialchars($query);  // changes characters used in html to their equivalents, for example: < to &gt;
          $query = mysqli_real_escape_string($info,$query);  // To prevent SQL injection
		  
          $raw_results = mysqli_query($info,"SELECT * FROM op
                                            WHERE (`op_content` LIKE '%".$query."%')") OR die(mysql_error());
		  $re=mysqli_fetch_array($raw_results);
		  
          if(mysqli_num_rows($raw_results) > 0)
		  {
              while($res = mysqli_fetch_array($raw_results))
			  {
                  
				  $q2="SELECT * FROM user_info2 WHERE userid=' ".$res['op_author']." ' ";
		          $q2_try=mysqli_query($info,$q2);
		          $re2=mysqli_fetch_array($q2_try);	  
                  echo "<p><h3><font color=#e74c3c>SUBJECT-  ".$res['op_subject']." </font></h3><i><h4>".$res['op_content']."</h4></i>
				  <h4><i>POSTED ON-  ".$res['op_date']."</i></h4><h4><i>POSTED BY-  ".$re2['name']."</i></h4></p>";
              }
          }
          else
		  {
             echo "No results";
          }
      }
      else
	  { 
	      // if query length is less than minimum
          echo "Please enter atleast 6 letters";
      }
	  }}
	  else{		  
	   echo '<script type="text/javascript"> alert("YOU ARE NOT LOGGED IN...PLEASE FIRST LOGIN.")</script>';  
       echo "<script> location.href='login.php'; </script>";	   
      }
  ?>
</body>
</html> 
