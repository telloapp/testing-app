<?php
require 'core/init.php';

$general->logged_out_protect();
$id   = htmlentities($user['id']); // storing the user's username after clearning for any html tags.


?>
<!DOCTYPE html>
<html>
<head>
    <title>Spearkers App</title>
</head>
<body>

<h1>Welcome to the speakers app</h1>
<p>What do you want to do ?</p>
<ol>
    <li><a href="add_speaker.php">Add Profile</a></li>
    <li><a href="logout.php">Logout</a></li>
</ol>

<h1>Dashboard</h1>

<br>
</body>
</html>