<?php
require '../core/init.php';

//$general->logged_out_protect();
//$id   = htmlentities($user['id']); // storing the user's username after clearning for any html tags.

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

      <?php echo $key['message']?>

      <?php }?>
    </form>


</body>
</html>