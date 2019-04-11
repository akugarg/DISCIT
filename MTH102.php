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
  <title>DISCIT : MTH102</title>
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
				<li><a href="search.php">SEARCH</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                  <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> LOG OUT</a></li>
                </ul>';
   ?>
   </div>
</nav>
   <nav class="navbar navbar-default">
  <div class="container-fluid">
    <ul class="nav navbar-nav">
      <li class="active"><a href="newpost.php">NEW POST</a></li>
  </div>
</nav>
	  
    <?php
        
		//Retrieving id of the thread, content of the thread, name of the author and date on which thread was created from the database.
        $sql="SELECT op.op_id,op.op_content,user_info2.name,op.op_date FROM op LEFT JOIN user_info2 ON op.op_author=user_info2.userid WHERE op.op_subject='MTH102'";
        $result=mysqli_query($info,$sql);

        if(!$result){
           echo 'Original Post could not be retrieved';
        }
        else if(mysqli_num_rows($result) == 0){
           echo 'No Posts for this subject';
        }
        else{
		   
           //Displaying date on which thread was created, Name of the author of the thread and thread content in a tabular form.		   
           echo '<div class="container"  style="width:100%;">
		         <table class="table table-condensed">
                 <thead><tr><th>Created At</th><th>Posted By</th><th>Post</th></tr></thead>';
        
           while($row=mysqli_fetch_assoc($result)){
 
              echo '<tbody><tr>';
              echo '<td>'.date('d-m-Y',strtotime($row['op_date'])).'</td>';
              echo '<td>'.$row['name'].'</td>';
              echo '<td><h4><a href="op.php?id='.$row['op_id'].'">'.$row['op_content'].'</a></h4></td>';
			  echo '<td></td>';
              echo '</tr>';

           }		   
		   echo '</tbody></table></div>';
        }
      }
	  //Giving JavaScript alert if user not signed in.
      else{		  
	   echo '<script type="text/javascript"> alert("YOU ARE NOT LOGGED IN...PLEASE FIRST LOGIN.")</script>';   
	   echo "<script> location.href='login.php'; </script>";
      }
?>

</body>
</html>