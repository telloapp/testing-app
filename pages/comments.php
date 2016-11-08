<?php
require '../core/init.php';
$general->logged_out_protect();

$m_id = $_GET['m_id'];
//$id   = $_GET['id'];
$designer_id   = htmlentities($user['id']); // logged in designer id

$display_comments = $chartforum->list_comments($m_id); // function to display all comments related to the message
$chartforum->delete_notifications($m_id,$designer_id); // funtion to update status column to "read"



	if(isset($_POST['submit']))
	{
	$reply          = htmlentities($_POST['reply']);
	$likes          = htmlentities($_POST['likes']);
	//$message_id     = htmlentities($_POST['message_id']);

	$comments = $chartforum->insert_comments($m_id,$designer_id,$reply);
	header('Location: list_messages.php');

	}


?>

<!DOCTYPE html>
<html>
 <head>
	<title>view | Comments</title>
 </head>
	<body>
		<form method="post" action="">

		<?php foreach ($display_comments as $row) { ?>
			<?php echo $row['username']?>&nbsp; :
		     <?php echo $row['reply']?> &nbsp;...
             <?php echo $row['likes']?> likes&nbsp;

             <a href="like_comment.php?id=<?php echo $row['id']?>&m_id=<?php echo $row['m_id']?>">like</a>

		     <br>

		<?php }?>

		<li><a href="list_messages.php?m_id=<?php echo $m_id?>">Back</a></li>


			<label>Your Comment</label>
			<textarea id="textarea" name="reply"></textarea>
			<br><br>
			<button type="submit" name="submit" class="btn bg-blue btn-block">comment</button>
		</form>		
   </body>
</html>