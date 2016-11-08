<?php
require '../core/init.php';

$general->logged_out_protect();

$designer_id   = htmlentities($user['id']); // logged in designer id

//$m_id  = $_GET['m_id'];

$view_messages = $chartforum->list_messages();

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

    <li><a href="send_message.php">Add message</a></li><br>

    <form method="post" action="">

      <?php foreach ($view_messages as $key) { ?>

     <p> <?php echo $key['message']?><br>
     	<li><a href="comments.php?m_id=<?php echo $key['id']?>">comments</a></li>
     </p>

      <?php }?>
    </form>
    <br>
        <li><a href="home.php">back</a></li>

        <li><a href="logout.php">logout</a></li>




</body>
</html>