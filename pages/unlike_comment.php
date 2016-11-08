<?php 

require '../core/init.php';
$general->logged_out_protect();

$username 	    = htmlentities($user['username']); // storing the user's username after clearning for any html tags.
$message_id     = htmlentities($_POST['message_id']);
$designer_id 	= htmlentities($user['id']); // storing the user's username after clearning for any html tags. 

$id = $_GET['id'];
$like_comment = $chartforum->delete_likes($id,$designer_id);
$view_msg = $chartforum->get_msg_id();

hearder('Location: comments.php');

?>