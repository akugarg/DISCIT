<?php
   SESSION_START();
   require 'info.php';
?>

<html>
<head>
  <meta charset="UTF-8">
  <meta name="description" content="Clear It - Discussion Forum">
  <meta name="keywords" content="IITK, Clear It">
  <meta name="viewport" content="width=device-width initial-scale=1.0">
  <title>DiscIt : LeaderBoard</title>
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
                <ul class="nav navbar-nav navbar-right">
                  <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> LOG OUT</a></li>
                </ul>';
   ?>
    </div>
	</nav>
	
 <?php   
  //Retrieving post_id, upvotes for the post, and username of the author of the post from database   
    $sql1="SELECT posts.post_id,ld.vote FROM posts LEFT JOIN ld ON ld.ld_post=posts.post_id";
    $result1=mysqli_query($info,$sql1);
	
	$sql2="SELECT posts.post_id,user_info2.username FROM posts LEFT JOIN user_info2 ON posts.post_author=user_info2.userid";
    $result2=mysqli_query($info,$sql2);

    if(!$result1){
        echo 'Error retreiving data';
    }
    else{
        
		$arr1=array();
		
		//Populating arr1 with key as post_id and value as number of upvotes for that post_id.
        while($row=mysqli_fetch_assoc($result1)){
			
		    if(!(array_key_exists($row['post_id'],$arr1)))
				$arr1[$row['post_id']]=1;
			
			else
       			$arr1[$row['post_id']]=$arr1[$row['post_id']]+1;			
           
        }		
		     
    }
	
	if(!$result2){
        echo 'Error retreiving data';
    }
    else{
		$arr2=array();
		
		//Populating arr2 with key as username of the author and value as sum of number of upvotes received by all the posts of the author.
        while($row=mysqli_fetch_assoc($result2)){
			
		    if(!(array_key_exists($row['username'],$arr2)))
				if(!(array_key_exists($row['post_id'],$arr1)))
					$arr2[$row['username']]=0;
				else
					$arr2[$row['username']]=$arr1[$row['post_id']];
			
			else
       			$arr2[$row['username']]=$arr2[$row['username']]+$arr1[$row['post_id']];		
           
        }	
		     
    }
	
	//Sorting arr2 on basis of values in descending order.
    arsort($arr2);
	
	//Displaying username and number of upvotes received by the author in tabular form.
    echo '<div class="container"  style="width:100%;">
		     <table class="table table-condensed">
             <thead><tr><th>AUTHOR</th><th>NUMBER OF UPVOTES</th></tr></thead>';
    foreach($arr2 as $key=>$value)
	  echo '<tbody><tr><td>'.$key.'</td><td>'.$value.'</td></tr>';
    
    echo '</tbody></table></div>';	
   }
	
  //Giving JavaScript alert if user not signed in.	
  else
   echo '<script type="text/javascript"> alert("YOU ARE NOT LOGGED IN...PLEASE FIRST LOGIN.")</script>';
  
?>

</body>
</html>