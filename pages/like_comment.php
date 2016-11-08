<?php 

require '../core/init.php';
$general->logged_out_protect();

$username 	    = htmlentities($user['username']); // storing the user's username after clearning for any html tags.    
$designer_id 	= htmlentities($user['id']); // storing the user's username after clearning for any html tags. 

$id = $_GET['id']; // gets the Id of the (reply or comment)
$m_id = $_GET['m_id'];
$display_comments = $chartforum->list_comments($m_id); // function to display all comments related to the message
$like_comment = $chartforum->insert_likes($id);

//header('location: list_messages.php');
header('location: comments.php?m_id='.$m_id);


?>