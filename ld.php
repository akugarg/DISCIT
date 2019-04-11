<?php 
 require 'info.php';
 
 $userid=$_SESSION['userid'];

if (isset($_POST['action'])) {
  $post_id = $_POST['post_id'];
  $action = $_POST['action'];
  switch ($action) {
  	case 'upvote':
        $sql="INSERT INTO ld (ld_author, ld_post, vote) 
            VALUES ('".$_SESSION['userid']."', '".$post_id."', 'upvote') 
            ON DUPLICATE KEY UPDATE vote='upvote'";		
        break;
  	case 'un_upvote':
	      $sql="DELETE FROM ld WHERE ld_author=".$_SESSION['userid']." AND ld_post='".$post_id."'";
	      break;
  	default:
  		break;
  }

  mysqli_query($info, $sql);
}

function numvotes($post_id)
{
  global $info;
  $sql = "SELECT COUNT(*) FROM ld 
  		  WHERE ld_post = '".$post_id."' AND vote='upvote'";
  $rs = mysqli_query($info, $sql);
  $result = mysqli_fetch_array($rs);
  return $result[0];
}

function rating($post_id)
{
  $rating = array();
  $qupvotes= "SELECT COUNT(*) FROM ld WHERE ld_post = '".$post_id."' AND vote='upvote'";
  $upvote_res = mysqli_query($info, $qupvotes);
  $votes = mysqli_fetch_array($upvote_res);
  $rating = [
  	'votes' => $votes[0],
  ];
  return json_encode($rating);
}


function voted($post_id)
{ global $info;
  global $userid;
  $sql = "SELECT * FROM ld WHERE ld_author=".$userid."
  		  AND ld_post=".$post_id." AND vote='upvote'";
  $result = mysqli_query($info,$sql);
  echo mysqli_error($info);
  if (mysqli_num_rows($result)==1) {
  	return true;
  }else{
  	return false;
  }
}

$sql = "SELECT * FROM posts";
$result = mysqli_query($info, $sql);
$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
if (isset($_POST['action'])) {
  echo '{"votes":"'.numvotes($_POST['post_id']).'"}';
}
?>