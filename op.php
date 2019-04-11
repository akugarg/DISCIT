<?php
   SESSION_START();
   require 'info.php';
   require 'ld.php';

   if (!isset($_POST['action'])) {
    echo '<html>
    <head>
     <meta charset="UTF-8">
     <meta name="description" content="DISCIT - Discussion Forum">
     <meta name="keywords" content="IITK, DISCIT">
     <meta name="viewport" content="width=device-width initial-scale=1.0">
     <link rel="stylesheet" href="style.css" type="text/css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
     <script src="ld.js" type="text/javascript"></script>
    </head>
    <body>';
   }
?>

<?php
    if (!isset($_POST['action'])) {
        $sql='SELECT op_id,op_content FROM op WHERE op_id='.mysqli_real_escape_string($info, $_GET['id']);

    $result=mysqli_query($info,$sql);

    if(!$result){
        echo '<br>The thread could not be displayed. Please try again later.';
    }
    else{
        $row=mysqli_fetch_assoc($result);
        echo '<h2>'.$row['op_content'].'</h3>';
    }

    $sql="SELECT posts.post_id,posts.post_op,posts.post_content,posts.post_date,posts.post_author,user_info2.username
    FROM posts LEFT JOIN user_info2
    ON posts.post_author=user_info2.userid
    WHERE posts.post_op=".mysqli_real_escape_string($info, $_GET['id']);

    $result=mysqli_query($info,$sql);

    if(!$result){
        echo '<br>The posts could not be displayed.Please try again later.';
    }
    else{
        if(mysqli_num_rows($result)==0){
            echo '<br>There are no posts in this thread yet!';
        }
        else{
            echo '<table><tr><th>Date</th><th>Author</th><th>Post</th><th>Upvote</th></tr>';
            while($row=mysqli_fetch_assoc($result)){
                echo '<tr>';
                echo	'<td>';echo date('d-m-y',strtotime($row['post_date']));echo '</td>';
                echo '<td>'.$row['username'].'</td>';
                echo '<td><h4>'.$row['post_content'].'</h4></td>';
				echo '<td>';
				?>    
      	              <i id="likeButton" <?php if (voted($row['post_id'])): ?>
      		          class="fa fa-thumbs-up like-btn"
      	              <?php else: ?>
      		          class="fa fa-thumbs-o-up like-btn"
      	              <?php endif ?>
      	              data-id="<?php echo $row['post_id'] ?>"></i>
      	              <span class="votes"><?php echo numvotes($row['post_id']); ?></span>				  
					   
				<?php	   
				echo '</td>';  				
                echo '</tr>';
            }
        }      
        echo '<form method="post" action="reply.php">
              Reply:<textarea name="post_content"></textarea><br><br>
              <input type="submit" value="Submit"><br><br>
              <input style="display:none;" name="id" type="text" value="'.$_GET['id'].'"/>
              </form>';
		echo '<p><button type="button"><a href="home.php">BACK</a></button></p>';	  
     }
       echo '</body>
        </html>';
    }
?>
